<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Toko extends CI_Controller {
	private $success=false;
	private	$message="";
	private $table_name="customers";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
	}
	function view($id='') {
		$id=urldecode($id);
		$record=$this->db->where("customer_number",$id)->get($this->table_name)->row();
		$data['message']='';
		$data['caption']="Informasi Toko";
		$data['cmd']='view';
		$data['mode']='view';
		$data['customer']=$record;
		$data['toko']=$this->db->where('user_id',$id)->get('eshop_toko')->row();
		$data['items']=$this->db->where('create_by',$id)->get('inventory');
		$this->template_eshop->display('eshop/toko',$data);
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}

	
}
?>