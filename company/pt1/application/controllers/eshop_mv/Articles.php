<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Articles extends CI_Controller {
	private $success=false;
	private	$message="";
	private $table_name="articles";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$data=data_table('articles');
		$data['message']='';
		$data['caption']="List Articles";
		$data['cmd']='list';
		$this->template_eshop->display('eshop/articles',$data);
	}
	function view($id='') {
		$id=urldecode($id);
		if($id==''){
			$this->index();
			exit;
		}
		$record=$this->db->where("id",$id)->get("articles")->row();
		$data=data_table('articles',$record); 
		$data['message']='';
		$data['caption']="View Articles";
		$data['cmd']='view';
		$data['mode']='view';
		$this->template_eshop->display('eshop/articles',$data);
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}

	
}
?>