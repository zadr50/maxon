<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Diskusi extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
                
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		$this->load->library('template_eshop');
	}
	function index() {	
		$data['title']='Diskusi';
		if($q=$this->db->query("select i.description,c.* from eshop_discuss c 
		join inventory i on i.item_number=c.item_id 
		where (c.cm_userid='".cust_id()."' or i.create_by='".cust_id()."') order by c.cm_date desc")){
			$data['comments']=$q;
		}
		$this->template_eshop->display("diskusi",$data);		
	}
}