<?php

class Gigan extends CI_Controller {

    function __construct(){
        parent::__construct();
        //데이터베이스 연결
        $this->load->database();
        //모델 gigan_m 연결
        $this->load->model("gigan_m");

        //페이지 네이션
        $this->load->library('pagination');
        //헬퍼함수
        $this->load->helper(array("url","date"));
        // 지역설정
        date_default_timezone_set("Asia/Seoul");
        // 오늘날짜
        $today = date("Y-m-d");
        //엑셀
        $this->load->library('PHPExcel');

        date_default_timezone_set('Asia/Seoul');
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
        $text3=array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]) : '0';
        //목록 읽기

        $base_url="/gigan/lists/text1/$text1/text2/$text2/text3/$text3/page";


        //페이지값이 몇 번째에 있는지를 나타냄 페이지위치를 4인지 6인지 자동으로 알아내려면 substr_count함수를 이용하여
        //$base_url에서 "/" 개수를 세어 1을 더하면 된다. 예로 text1값이 없는 경우 "/gigan/lists/page" 이므로 "/" 개수는 3이된다.
        //따라서 1을 더하면 페이지번호 위치는 4가 된다. strpos함수는 지정한 문자열이 처음 나타나는 위치 값을 알려주는 함수
        $page_segment = substr_count(substr($base_url,0,strpos($base_url,"page")) , "/")+1;

        $config["per_page"] = 2; //페이지당 표시할 line 수
        $config["total_rows"] = $this->gigan_m->rowcount($text1,$text2,$text3); // 전체개수
        $config["uri_segment"] = $page_segment; // 페이지가 있는 segment
        $config["base_url"] = $base_url; //기본 uri "/gigan/list/text1/값/page/페이지값"이되므로 페이지 값은 6번째에 나타난다.
        $this->pagination->initialize($config); // 페이지네이션 초기화

        $data["page"] = $this->uri->segment($page_segment,0); //시작위치, 없으면 0
        $data["pagination"] = $this->pagination->create_links(); // 페이지 소스 생성

        $start = $data["page"]; //n페이지 : 시작위치
        $limit = $config["per_page"]; //페이지 당 라인수

        $data["text1"] = $text1;
        $data["text2"] = $text2;
        $data["text3"] = $text3;
        $data["list_product"] = $this->gigan_m->getlist_product();
        $data["list"] = $this->gigan_m->getlist($text1, $text2, $text3, $start, $limit); // 해당페이지 자료읽기

        //상단출력(메뉴)
        $this->load->view("main_header");
        //gigan_list에 자료 전달
        $this->load->view("gigan_list", $data);
        //하단 출력
        $this->load->view("main_footer");

    }

    public function excel()
    {
        $uri_array=$this->uri->uri_to_assoc(3); // 검색 조건 구하기
        $text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : date("Y-m-d",strtotime('-1 month'));
        $text2=array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]) : date("Y-m-d");
        $text3=array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]) : '0';
        $page = array_key_exists("page", $uri_array) ? "/page/" . urldecode($uri_array["page"]) : 0;

        $count = $this->gigan_m->rowcount($text1,$text2,$text3); //레코드 개수
        $list = $this->gigan_m->getlist_all($text1,$text2,$text3); //모든 자료 얻기

        $objPHPExcel = new PHPExcel();

        // 각 칼럼 (너비, 정렬)
        $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(12);

        $objPHPExcel->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal(PHPExcel_style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle("C:F")->getAlignment()->setHorizontal(PHPExcel_style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("G")->getAlignment()->setHorizontal(PHPExcel_style_Alignment::HORIZONTAL_LEFT);

        //제목 (글자 크기, 굵게)
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "매출입장");
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(13);
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

        //기간(정렬)
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", '기간:' . $text1 . "-" . $text2);
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //2행 : 헤더 가운데 정렬
        $objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //헤더 배경색(밝은 회색)
        $objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getFill()->getFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getFill()->getStartColor()->setARGB('FFCCCCCC');

        //헤더 글자 출력
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A2","날짜")
            ->setCellValue("B2","제품명")
            ->setCellValue("C2","단가")
            ->setCellValue("D2","매입수량")
            ->setCellValue("E2","매출수량")
            ->setCellValue("F2","금액")
            ->setCellValue("G2","비고");
            $i=3;
            foreach ( $list as $row) //3행부터 자료 출력
            {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$i",$row->writeday)
                ->setCellValue("B$i",$row->product_name)
                ->setCellValue("C$i",$row->price ? $row->price : "")
                ->setCellValue("D$i",$row->numi ? $row->numi : "")
                ->setCellValue("E$i",$row->numo ? $row->numo : "")
                ->setCellValue("F$i",$row->prices ? $row->prices : "")
                ->setCellValue("G$i",$row->bigo);
                $i++;
            }
            $objPHPExcel->setActiveSheetIndex(0);

            $fname = "매출입장($text1.$text2).xlsx";//파일이름 생성
            $fname = iconv("UTF-8","EUC-KR",$fname);//UTF8->ECU-KR로 변환

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;filename=$fname");
            header("Cache-Control: max-age=0");
            header("Cache-Control: max-age=1");

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
            $objWriter->save("php://output");// xlsx형식으로 파일 출력


    }

}
