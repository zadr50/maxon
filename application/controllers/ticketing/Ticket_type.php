<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Ticket_type extends CI_Controller {
    private $limit=100;
    private $table_name='ticket_type';
    private $file_view='ticketing/ticket_type';
    private $controller='ticketing/ticket_type';
    private $primary_key='id';
    private $sql="";

    function __construct()    {
		parent::__construct();                
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		$this->load->model(array('ticketing/ticket_type_model','syslog_model','customer_model',
		'bank_accounts_model','chart_of_accounts_model'));
		$this->ticket_type_model->create_new_table();
		

    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		$data['lookup_coa1']=$this->chart_of_accounts_model->lookup('coa1');
		$data['lookup_coa2']=$this->chart_of_accounts_model->lookup('coa2');
		$data['lookup_coa3']=$this->chart_of_accounts_model->lookup('coa3');
		$data['lookup_coa4']=$this->chart_of_accounts_model->lookup('coa4');
		$data['lookup_coa5']=$this->chart_of_accounts_model->lookup('coa5');
		
		if($record==null) {
//			$data['tanggal']=date("Y-m-d H:i:s");
		}	
		return $data;
    }
    function index()    {	
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->ticket_type_model->save($data);
			$data['message']='update success';
			$data['mode']='view';
			$this->browse();
		} else {
			$data['mode']='add';
			$data['message']='';
			$data['data']=$data;
			$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("id");
		$data['coa1']=account_id($data['coa1']);
		$data['coa2']=account_id($data['coa2']);
		$data['coa3']=account_id($data['coa3']);
		$data['coa4']=account_id($data['coa4']);
		$data['coa5']=account_id($data['coa5']);		
		
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->ticket_type_model->save($data);
			$id=$this->db->insert_id();
			$this->syslog_model->add($id,"ticket_type","add");

		} else {
			$ok=$this->ticket_type_model->update($id,$data);				
			$this->syslog_model->add($id,"ticket_type","edit");

		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error "));
		}
	}	
    function view($id,$message=null)	{
		$id=urldecode($id);
		$message=urldecode($message);
		$data[$this->primary_key]=$id;
		$model=$this->ticket_type_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['coa1']=account($data['coa1']);
		$data['coa2']=account($data['coa2']);
		$data['coa3']=account($data['coa3']);
		$data['coa4']=account($data['coa4']);
		$data['coa5']=account($data['coa5']);
		
		
		$data['data']=$data;
		
		$data['mode']='view';
		$data['message']=$message;
		//$data['fields']=$this->fields;
		$this->template->display_form_input($this->file_view,$data);
    }
     // validation rules
    function _set_rules(){}
    function valid_date($str){
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str)){
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']=$this->controller;
		$oFlds=$this->ticket_type_model->fields;
		$fields=null;
		$fields_caption=null;
		if(is_array($oFlds)){
			for($i=0;$i<count($oFlds);$i++){
				$oFld=$oFlds[$i];
				if(is_object($oFld)){
					$fields[]=$oFld->name;
				} else {
					$fields[]=$oFld['name'];
				}
			}
		}
		
		$data['fields']=$fields;
//		$data['fields_format_numeric']=array("price","netto");
				
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']=$this->primary_key;
		$data['caption']='DAFTAR JENIS TICKET';

		$this->load->library('search_criteria');
		$faa[]=criteria("Jenis Ticket","sid_kode");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql;
		$kode=$this->input->get('sid_kode');
		if($kode<>""){
			$sql.=" where ticket_type like '%$kode%' ";		
		}
        $sql.="   order by ticket_type";
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
		
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$ok = $this->ticket_type_model->delete($id);
		$this->syslog_model->add($id,$this->table_name,"delete");
		$err=$this->db->error();
		if($err['message']=="")$err['message']='Success';
		echo json_encode(array("success"=>$ok,"msg"=>$err['message']));
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where id='$nomor'");
		echo json_encode($query->row_array());
 	}	
}
?>
