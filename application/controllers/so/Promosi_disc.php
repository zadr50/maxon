<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Promosi_disc extends CI_Controller {
    private $limit=10;
    private $table_name='promosi_disc';
    private $sql="select * from promosi_disc where category=1 ";
    private $file_view='sales/promosi_disc';
    private $primary_key='promosi_code';
    private $controller='so/promosi_disc';

    function __construct(){
        parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('template');
        $this->load->library('form_validation');
		$this->load->model('sales/promosi_model');
		$this->load->model('syslog_model');
		$this->load->model('category_model');
		$this->load->model('supplier_model');
    }
    function index(){
        $this->browse();

    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
        $data=data_table($this->table_name,$record);
        if($record==NULL){
            $data['date_from']= date("Y-m-d H:i:s");
            $data['date_to']= date("Y-m-d 23:59:59");    
		}
		$data['allow_add']=allow_mod('frmPromosiItem.Add');
		$data['allow_edit']=allow_mod('frmPromosiItem.Edit');
		$data['allow_delete']=allow_mod('frmPromosiItem.Delete');
		$data['lookup_inventory']=$this->list_of_values->lookup_inventory();
		$data['lookup_category']=$this->category_model->lookup();
		$data['lookup_supplier']=$this->supplier_model->lookup();
		$data['lookup_merk']=$this->inventory_model->lookup_merk();

        return $data;
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
			$this->promosi_model->save($data);
			$data['message']='update success';
			$data['mode']='view';
			$this->browse();
		} else {
            $data['promosi_code']='AUTO';
			$data['mode']='add';
			$data['message']='';
			$data['data']=$data;
			$this->template->display_form_input($this->file_view,$data);			
		}

    }
    function nomor_bukti($add=false)
	{
		$key="Promosi Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!PRM~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!PRM~$00001');
				$rst=$this->promosi_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
                    
        }
	}

	function save(){
		$data=$this->input->post();
		$id=$this->input->post("promosi_code");
        $mode=$data["mode"];	
		unset($data['mode']);
		$data['category']=1;

		if($mode=="add"){
			if($id=="AUTO")	$id=$this->nomor_bukti();							
			$data['promosi_code']=$id;
			$ok=$this->promosi_model->save($data);
			$this->nomor_bukti(true);
			$this->syslog_model->add($id,"promosi_disc","add");

		} else {
			$ok=$this->promosi_model->update($id,$data);				
			$this->syslog_model->add($id,"promosi_disc","edit");

		}
		if($ok){
			echo json_encode(array("success"=>true,"promosi_code"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".$this->db->error()));
		}
	}	
    function view($id,$message=null)	{
		$id=urldecode($id);
		$message=urldecode($message);
		$model=$this->promosi_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data[$this->primary_key]=$id;
		$data['mode']='view';
		$data['message']=$message;
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
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$this->load->library('search_criteria');
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nama Promosi','Kode Promosi','Tangal Awal','Tanggal Akhir','Jenis','Discount');
		$data['fields']=array('description','promosi_code','date_from','date_to','tipe','nilai');
		if(!$data=set_show_columns($data['controller'],$data)) return false; 			
		$data['field_key']='promosi_code';
		$data['caption']='DAFTAR KODE PROMOSI';
		$data['posting_visible']=true;		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Bukti","sid_number");
		$faa[]=criteria("Nama Promosi","sid_nama");		
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$nama=$this->input->get('sid_nama');
		$kode=$this->input->get('sid_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql=$this->sql;
        
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }
        
		if($kode!=''){
			$sql.=" and promosi_code='$kode'";
		} else {
//			$sql.="  between '$d1' and '$d2'";
			if($nama!='')$sql.=" and description like '%$nama%'";	
		}
        $sql.=" order by description";
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
		$sql.=" limit $offset,$limit";
        echo datasource($sql);    
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->promosi_model->delete($id);
		$this->syslog_model->add($id,"promosi_disc","delete");
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $this->table_name where $this->primary_key='$nomor'");
		echo json_encode($query->row_array());
	 }	
	function items($nomor){
		$sql="select * from promosi_item where promosi_code='$nomor' order by id";
		echo datasource($sql);
	}
	function delete_item($id){
		$id=urldecode($id);
		 $ok=$this->promosi_model->delete_item($id);
		 echo json_encode(array("success"=>$ok));
	}
	function save_item(){
		$id=0;
		$success=false;
		$item_number=$this->input->get("item_no");
		$promosi_code=$this->input->get("promosi_code");
		$item_type="item";
		if($itype=$this->input->get("item_type")){
			$item_type=$itype;
		}
		if($item_number && $promosi_code){
			$data['item_number']=$item_number;
			$data['promosi_code']=$promosi_code;
			$data['item_type']=$item_type;
			$id= $this->promosi_model->save_item($data);	
		}
		if($id>0)$success=true;
		echo json_encode(array("success"=>$success,"id"=>$id));
	}


}
