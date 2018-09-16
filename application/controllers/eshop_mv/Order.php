<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Order extends CI_Controller {
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
		$data['title']='Pesanan';
		if($q=$this->db->query("select i.*,c.company from sales_order i 
		left join customers c on c.customer_number=i.sold_to_customer 
		 where i.supplier_number='".cust_id()."'
		order by sales_date desc")){
			$data['orders']=$q;
		}
//		and sold_to_customer='".cust_id."' 
		$this->template_eshop->display("eshop/order",$data);		
	}
}