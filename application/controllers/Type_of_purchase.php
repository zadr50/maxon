<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Type_of_purchase extends CI_Controller {
    private $limit=10;
	function __construct()
	{
		parent::__construct();               
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model("syslog_model");
	}
	function index()
	{	
	}
    function select($search=''){
        $search=urldecode($search);
        $sql="select varvalue,keterangan from system_variables where varname='lookup.po_type' ";

        if($search!=""){
            $sql.=" where (varvalue like '$search%' 
                or keterangan like '$search%')";
        }
        $sql.=" order by varvalue ";
		
        $offset=0; $limit=10;
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);
    }		

}