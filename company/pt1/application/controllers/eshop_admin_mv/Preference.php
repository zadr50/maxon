<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Preference extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index() {	
		$data['message']='';
		$data['caption']="Preference";
		$this->template_eshop_admin->display('eshop/admin/preference',$data);
	}
	function store() {
		$msg='';
		if($dt=$this->input->post()){
			unset($dt['submit']);
			$this->db->where('company_code',$dt['company_code'])->update('preferences',$dt);
			$msg='Data sudah disimpan.';
		}
		$record=$this->db->limit(1)->get('preferences')->result_array('assoc');
		$data=data_table('preferences',$record[0]);
		$data['caption']="Informasi Toko";
		$data['message']=$msg;
		$this->template_eshop_admin->display('eshop/admin/myshop',$data);
	}
}