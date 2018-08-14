<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Bca extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template','bca');;
	}
	function index()
	{	
//		var_dump($this->session);
		$data['message']='';
		$this->template->display_form_input('welcome_message',$data,'');
	}
 
}
 
  ini_set('display_errors',1);
  
  include('scrap.bca.php');
  $bca = new ScrapBCA();
  $data = $bca->start();

  if($data['ketemu']) {
    
    $cookie_1 = $data['cookie_1'];
    $cookie_2 = $data['cookie_2'];

    $is_login = $bca->login($cookie_1, $cookie_2);

    if($is_login) {
      $bca->show_menu($cookie_1, $cookie_2);

      $bca->info_rekening($cookie_1, $cookie_2);

      $bca->show_mutasi($cookie_1, $cookie_2);

      $bca->show_last_mutasi($cookie_1, $cookie_2);
      
      $bca->logout($cookie_1, $cookie_2);
    }

  }