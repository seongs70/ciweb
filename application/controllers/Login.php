<?php

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        //데이터베이스 연결
        $this->load->database();
        //모델 login_m 연결
        $this->load->model("login_m");
        //헬퍼함수
        $this->load->helper(array("url","date"));
    }
    public function index()
    {

    }

    public function check()
    {
        $uid = $this->input->post("uid",TRUE);
        $pwd = $this->input->post("pwd",TRUE);

        $row=$this->login_m->getrow($uid,$pwd);
        if($row)
        {
            $data=array(
                "uid" => $row->uid,
                "rank" => $row->rank
            );
            $this->session->set_userdata($data);
        }
        $this->load->view("main_header");
        $this->load->view("main_footer");
    }

    public function logout()
    {
        $data = array('uid', 'rank');
        $this->session->unset_userdata($data);

        $this->load->view("main_header");
        $this->load->view("main_footer");
    }

}
