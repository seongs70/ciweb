<?php



class Main extends CI_Controller {


    public function index()
    {
        $this->load->view("main_header");
        
        // $this->load->view("member_list");
        $this->load->view("main_footer");
    }


}
?>
