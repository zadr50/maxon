<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {
 		$data['username']=$this->session->userdata("user_name","Guest");
		$data['url_search']="index.php/resto/search";
		$data['url_dashboard']='menu/load/resto';
		$this->load->view("resto/home",$data);
    }
}
