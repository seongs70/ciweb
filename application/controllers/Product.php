<?php

class Product extends CI_Controller {

    function __construct(){
        parent::__construct();
        //데이터베이스 연결
        $this->load->database();
        //모델 product_m 연결
        $this->load->model("product_m");
        //헬퍼함수
        $this->load->helper(array("url","date"));
        //페이지 네이션
        $this->load->library('pagination');
        //이미지 업로드
        $this->load->library('upload');
        //섬네일 이미지
        $this->load->library('image_lib');
    }
    public function index()
    {
        $this->lists();
    }

    public function lists()
    {
        $uri_array=$this->uri->uri_to_assoc(3);

        $text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";

        //목록 읽기

        if($text1 == ""){
            $base_url = "/product/lists/page";
        } else {
            $base_url = "/product/lists/text1/$text1/page";
        }
        //페이지값이 몇 번째에 있는지를 나타냄 페이지위치를 4인지 6인지 자동으로 알아내려면 substr_count함수를 이용하여
        //$base_url에서 "/" 개수를 세어 1을 더하면 된다. 예로 text1값이 없는 경우 "/product/lists/page" 이므로 "/" 개수는 3이된다.
        //따라서 1을 더하면 페이지번호 위치는 4가 된다. strpos함수는 지정한 문자열이 처음 나타나는 위치 값을 알려주는 함수
        $page_segment = substr_count(substr($base_url,0,strpos($base_url,"page")) , "/")+1;

        $config["per_page"] = 2; //페이지당 표시할 line 수
        $config["total_rows"] = $this->product_m->rowcount($text1); // 전체개수
        $config["uri_segment"] = $page_segment; // 페이지가 있는 segment
        $config["base_url"] = $base_url; //기본 uri "/member/list/text1/값/page/페이지값"이되므로 페이지 값은 6번째에 나타난다.



        $this->pagination->initialize($config); // 페이지네이션 초기화

        $data["page"] = $this->uri->segment($page_segment,0); //시작위치, 없으면 0

        $data["pagination"] = $this->pagination->create_links(); // 페이지 소스 생성

        $start = $data["page"]; //n페이지 : 시작위치
        $limit = $config["per_page"]; //페이지 당 라인수

        $data["text1"] = $text1;
        $data["list"] = $this->product_m->getlist($text1,$start,$limit); // 해당페+이지 자료읽기

        //상단출력(메뉴)
        $this->load->view("main_header");
        //product_list에 자료 전달
        $this->load->view("product_list", $data);
        //하단 출력
        $this->load->view("main_footer");

    }
    public function view()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";
        //product 클래스의 view함수에 page 정보를 적용하기 위하여 처리한다. 먼저 URI에서 page값을 읽을 수 있어야 하며, page가 없는 경우 0값으로 초기화 시킴
        $page = array_key_exists("page", $uri_array) ? urldecode($uri_array["page"]) : 0;

        $data["text1"] = $text1;
        $data["page"] = $page;
        $data['row'] = $this->product_m->getrow($no);
        $this->load->view("main_header");
        //product_list에 자료 전달
        $this->load->view("product_view", $data);
        //하단 출력
        $this->load->view("main_footer");

    }
    //삭제할 no값을 알아내어 자료를 삭제하는 deleterow()함수를 호출한다
    public function del()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $no = array_key_exists("no",$uri_array) ? $uri_array["no"] : "";
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";
        $page = array_key_exists("page", $uri_array) ? "/page/" . urldecode($uri_array["page"]) : 0;
        $this->product_m->deleterow($no);

        redirect("/product/lists/".$text1 . $page);
    }

    public function add()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]) : "";
        $page = array_key_exists("page", $uri_array) ? "/page/" . urldecode($uri_array["page"]) : 0;



        $this->load->library("form_validation");

        $this->form_validation->set_rules("gubun_no","구분명","required");
        $this->form_validation->set_rules("name","이름","required|max_length[50]");
        $this->form_validation->set_rules("price","단가","required|numeric");

        //추가 버튼을 클릭한 경우, 추가화면으로 이동
        //!$_POST 대신에 run메소드 사용
        if($this->form_validation->run()==FALSE)
        {

            $data['list'] = $this->product_m->getlist_gubun();
            $this->load->view('main_header');
            $this->load->view('product_add', $data);
            $this->load->view('main_footer');

        } else {
            //저장버튼 클릭한 경우
            $data = array(
                "gubun_no" => $this->input->post("gubun_no",true),
                "name"=>$this->input->post("name",true),
                "price"=>$this->input->post("price",true),
                "jaego"=>$this->input->post("jaego",true),

            );
            $picname=$this->call_upload();
            if($picname){$data["pic"] = $picname;}
            //데이터 저장
            $result = $this->product_m->insertrow($data);
            redirect("/product/lists/".$text1 . $page);
        }
    }

    public function edit()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $no = array_key_exists("no",$uri_array) ? $uri_array["no"] : "";
        $text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]) : "";

        $no = $this->uri->segment(4);
        //폼검증 라이브러리 로드
        $page = array_key_exists("page",$uri_array) ? "/page/".urldecode($uri_array["page"]) : 0;

        $this->load->library("form_validation");

        $this->form_validation->set_rules("gubun_no","구분명","required");
        $this->form_validation->set_rules("name","이름","required|max_length[50]");
        $this->form_validation->set_rules("price","단가","required|numeric");


        if($this->form_validation->run()==FALSE)
        {
            $data['list'] = $this->product_m->getlist_gubun();
            $this->load->view('main_header');
            $data["row"] = $this->product_m->getrow($no);
            $this->load->view("product_edit", $data);
            $this->load->view('main_footer');
        } else {
            //저장버튼 클릭한 경우
            $data = array(
                "gubun_no"=>$this->input->post("gubun_no",true),
                "name"=>$this->input->post("name",true),
                "price"=>$this->input->post("price",true),
                "jaego"=>$this->input->post("jaego",true),

            );

            $picname = $this->call_upload();
            if($picname){ $data["pic"] = $picname; }
            //데이터 저장
            $result = $this->product_m->updaterow($data,$no);
            redirect("/product/lists/".$text1 . $page);
        }
    }

    public function call_upload()
    {
        $config['upload_path'] = './product_img';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $config['max_size']   = 10000000;
        $config['max_width']  = 10000;
        $config['max_height'] = 10000;
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('pic')){
            $picname="";
        } else {
            $picname = $this->upload->data("file_name");

            // 썸네일 환경 설정
            $config['image_library'] = 'gd2'; // g2 라이브러리 이용 선언
            $config['source_image'] = './product_img/'.$picname; // 원본 사진이름
            $config['thumb_marker'] = '';
            $config['new_image'] = './product_img/thumb'; //thumb 저장 폴더
            $config['create_thumb'] = 'TRUE';
            $config['maintain_ratio'] = 'TRUE'; // 가로세로 비율 유지
            $config['width'] = 200; //thumb 사진 가로길이
            $config['height'] = 150; //thumb 사진 세로길이
            $this->image_lib->initialize($config);//설정 적용

            $this->image_lib->resize();
        }
        return $picname;
    }

    public function jaego()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
        $page = array_key_exists("page", $uri_array) ? "/page/" . urldecode($uri_array["page"]) : 0;

        $data["text1"] = $text1;
        $data["page"] = $page;
        $this->product_m->cal_jaego();

        redirect("/product/lists" . $text1 . $page);
    }
}
