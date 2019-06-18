<?php

class Member extends CI_Controller {

    function __construct(){
        parent::__construct();
        //데이터베이스 연결
        $this->load->database();
        //모델 Member_m 연결
        $this->load->model("member_m");
        //헬퍼함수
        $this->load->helper(array("url","date"));
        
    }
    public function index()
    {
        $this->lists();
    }

    public function lists()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";
        //목록 읽기
        $data["text1"] = $text1;
        $data["list"] = $this->member_m->getlist($text1);

        //상단출력(메뉴)
        $this->load->view("main_header");
        //member_list에 자료 전달
        $this->load->view("member_list", $data);
        //하단 출력
        $this->load->view("main_footer");

    }
    public function view()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";

        $data["text1"] = $text1;
        $data['row'] = $this->member_m->getrow($no);
        $this->load->view("main_header");
        //member_list에 자료 전달
        $this->load->view("member_view", $data);
        //하단 출력
        $this->load->view("main_footer");

    }
    //삭제할 no값을 알아내어 자료를 삭제하는 deleterow()함수를 호출한다
    public function del()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $no = array_key_exists("no",$uri_array) ? $uri_array["no"] : "";
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";

        $this->member_m->deleterow($no);

        redirect("/member/lists/".$text1);
    }

    public function add()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]) : "";
        $this->load->library("form_validation");

        $this->form_validation->set_rules("name","이름","required|max_length[20]");
        $this->form_validation->set_rules("uid","아이디","required|max_length[20]");
        $this->form_validation->set_rules("pwd","암호","required|max_length[20]");
        //추가 버튼을 클릭한 경우, 추가화면으로 이동
        //!$_POST 대신에 run메소드 사용
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('main_header');
            $this->load->view('member_add');
            $this->load->view('main_footer');
        } else {
            //저장버튼 클릭한 경우
            $tel1=$this->input->post("tel1",true);
            $tel2=$this->input->post("tel2",true);
            $tel3=$this->input->post("tel3",true);
            $tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
            $data = array(
                'name' => $this->input->post("name",true),
                'uid' => $this->input->post("uid",true),
                'pwd' => $this->input->post("pwd",true),
                'tel' => $tel,
                'rank' => $this->input->post("rank",true),
            );
            //데이터 저장
            $result = $this->member_m->insertrow($data);
            redirect("/member/lists/".$text1);
        }
    }

    public function edit()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $no = array_key_exists("no",$uri_array) ? $uri_array["no"] : "";
        $text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]) : "";
        $no = $this->uri->segment(4);
        //폼검증 라이브러리 로드
        $this->load->library("form_validation");

        $this->form_validation->set_rules("name","이름","required|max_length[20]");
        $this->form_validation->set_rules("uid","아이디","required|max_length[20]");
        $this->form_validation->set_rules("pwd","암호","required|max_length[20]");

        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('main_header');
            $data["row"] = $this->member_m->getrow($no);
            $this->load->view("member_edit", $data);
            $this->load->view('main_footer');
        } else {
            //저장버튼 클릭한 경우
            $tel1=$this->input->post("tel1",true);
            $tel2=$this->input->post("tel2",true);
            $tel3=$this->input->post("tel3",true);
            $tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
            $data = array(
                'name' => $this->input->post("name",true),
                'uid' => $this->input->post("uid",true),
                'pwd' => $this->input->post("pwd",true),
                'tel' => $tel,
                'rank' => $this->input->post("rank",true),
            );
            //데이터 저장
            $result = $this->member_m->updaterow($data,$no);
            redirect("/member/lists/".$text1);
        }
    }
}
