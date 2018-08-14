<?php
class Rpt extends CI_Controller {
	    
    
	function __construct()
	{
		parent::__construct();        
         
        $this->load->helper(array('url','browse_select_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');

	}
	function index(){}
    
    function load($rpt){
        $data['controller']="banks/rpt/load/$rpt";
        $this->load->view("bank/rpt/$rpt",$data);        
    }
 
}
?>
