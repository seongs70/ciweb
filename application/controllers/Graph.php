<?php

class Graph extends CI_Controller {

    function __construct(){
        parent::__construct();
        //데이터베이스 연결
        $this->load->database();
        //모델 graph_m 연결
        $this->load->model("graph_m");
        //헬퍼함수
        $this->load->helper(array("url","date"));
        // 지역설정
        date_default_timezone_set("Asia/Seoul");
        // 오늘날짜
        $today = date("Y-m-d");
    }
    public function index()
    {
        $this->lists();
    }

    public function lists()
    {
        $uri_array=$this->uri->uri_to_assoc(3);
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : date("Y-m-d",strtotime('-1 month'));
        $text2=array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]) : date("Y-m-d");

        $data["text1"] = $text1;
        $data["text2"] = $text2;
        $data["rowcount"] = $this->graph_m->rowcount($text1, $text2);
        $data["list"] = $this->graph_m->getlist($text1, $text2); // 해당페이지 자료읽기

        //상단출력(메뉴)
        $this->load->view("main_header");
        //graph_list에 자료 전달
        $this->load->view("graph_list", $data);
        //하단 출력
        $this->load->view("main_footer");

    }


}
