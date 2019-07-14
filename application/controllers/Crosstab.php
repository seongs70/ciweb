<?php

class Crosstab extends CI_Controller {

    function __construct(){
        parent::__construct();
        //데이터베이스 연결
        $this->load->database();
        //모델 crosstab_m 연결
        $this->load->model("crosstab_m");
        //페이지 네이션
        $this->load->library('pagination');
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
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : date("Y");

        //목록 읽기

        $base_url="/crosstab/lists/text1/$text1/page";


        //페이지값이 몇 번째에 있는지를 나타냄 페이지위치를 4인지 6인지 자동으로 알아내려면 substr_count함수를 이용하여
        //$base_url에서 "/" 개수를 세어 1을 더하면 된다. 예로 text1값이 없는 경우 "/crosstab/lists/page" 이므로 "/" 개수는 3이된다.
        //따라서 1을 더하면 페이지번호 위치는 4가 된다. strpos함수는 지정한 문자열이 처음 나타나는 위치 값을 알려주는 함수
        $page_segment = substr_count(substr($base_url,0,strpos($base_url,"page")) , "/")+1;

        $config["per_page"] = 2; //페이지당 표시할 line 수
        $config["total_rows"] = $this->crosstab_m->rowcount($text1); // 전체개수
        $config["uri_segment"] = $page_segment; // 페이지가 있는 segment
        $config["base_url"] = $base_url; //기본 uri "/crosstab/list/text1/값/page/페이지값"이되므로 페이지 값은 6번째에 나타난다.
        $this->pagination->initialize($config); // 페이지네이션 초기화

        $data["page"] = $this->uri->segment($page_segment,0); //시작위치, 없으면 0
        $data["pagination"] = $this->pagination->create_links(); // 페이지 소스 생성

        $start = $data["page"]; //n페이지 : 시작위치
        $limit = $config["per_page"]; //페이지 당 라인수

        $data["text1"] = $text1;


        $data["list"] = $this->crosstab_m->getlist($text1, $start, $limit); // 해당페이지 자료읽기

        //상단출력(메뉴)
        $this->load->view("main_header");
        //crosstab_list에 자료 전달
        $this->load->view("crosstab_list", $data);
        //하단 출력
        $this->load->view("main_footer");

    }


}
