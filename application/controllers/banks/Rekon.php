<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Rekon extends CI_Controller {
    private $limit=10;
    private $table_name='check_writer';
    private $sql="select * from check_writer";
    private $file_view='bank/rekon';
    private $primary_key='tran_id';
    private $controller='banks/rekon';
    
	function __construct()
	{
		parent::__construct();
        
		if(!$this->access->is_login())redirect(base_url());
		
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('bank_accounts_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('syslog_model');
	}
	function index()
	{
        $setcom['dlgBindId']="bank_accounts";
        $setcom['dlgRetFunc']="$('#rekening').val(row.bank_account_number);";
        $setcom['dlgCols']=array( 
                    array("fieldname"=>"bank_account_number","caption"=>"Rekening","width"=>"180px"),
                    array("fieldname"=>"bank_name","caption"=>"Nama Bank","width"=>"200px")
                );          
        $data['lookup_bank_accounts']=$this->list_of_values->render($setcom);
	    	
		$this->template->display($this->file_view,$data);
	}

}
