<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Review extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['title']='Review';
		if($q=$this->db->query("select i.description,c.* from eshop_comments c 
		join inventory i on i.item_number=c.item_id 
		where (c.cm_userid='".cust_id()."' or i.create_by='".cust_id()."') order by c.cm_date desc")){
			$data['comments']=$q;
		}
		$this->template_eshop->display("eshop/review",$data);		
	}
}