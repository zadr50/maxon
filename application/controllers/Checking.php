<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Checking extends CI_Controller {

private $limit=10;

	function __construct()
	{
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
		$this->load->library('form_validation');
	 
	}
	function index()
	{	
		$data['message']='';
		$this->template->display_form_input('checking',$data,'checking_left_menu');
	}
	 
	function next_step_2(){
		$data['message']='';
		$max=$this->input->post('row_count');
		for($i=1;$i<=$max;$i++){
			$wo=$this->input->post('id_'.$i);
			if($wo<>''){
				$s="update workorder set checking=1	where wo_number='".$wo."'";
				$query=$this->db->query($s);
				$data['message']=$data['message'].'<br/>Process: '.$wo;
			} 
			
		}
		 $data['message']=$data['message'].'<H2>Success</h2>
		 Nomor-nomor workorder sudah di checking untuk dipersiapkan ke proses selanjutnya
		 <br/>yaitu persiapan untuk di packing dan dikirim
		 
		 ';
		 
		$this->template->display('finish',$data);
	}
	 
}
