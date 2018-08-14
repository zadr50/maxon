<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class item_master extends CI_Controller {
    private $limit=100;
    private $table_name='inventory';
    private $file_view='leasing/item_master';
    private $controller='leasing/item_master';
    private $primary_key='item_number';
	private $title="DAFTAR OBJECT KREDIT";
    private $sql="";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->sql=="")$this->sql="select item_number,description,retail,unit_of_measure 
			,category,cost_from_mfg from inventory";
		if($this->help=="")$this->help=$this->table_name;
		
		$this->load->model('inventory_model');
		 
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index(){
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
				$this->inventory_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
				$data['mode']='add';
				$data['message']='';
				$data['data']=$data;
				$data['title']=$this->title;
				$data['help']=$this->help;
				$data['form_controller']=$this->controller;
				$data['field_key']=$this->primary_key;
				
				$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("item_number");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->inventory_model->save($data);
		} else {
			$ok=$this->inventory_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}	
	function edit($id){
		$id=urldecode($id);
		$this->view($id,"edit");
	}
	
    function view($id,$mode="view",$show_tool=true)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->inventory_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$data['mode']=$mode;
		$data['show_tool']=$show_tool;
		$data['message']='';
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
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Barang","sid_nama","","style='width:400px'");
		$data['criteria']=$faa;
		$data['list_info_visible']=true;
		$data['import_visible']=true;
		$data['fields_caption']=array('Kode','Nama Barang','Kelompok','Harga Jual','Satuan');
		$data['fields']=array('item_number','description','category','retail','unit_of_measure');
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get("sid_nama"))$sql .= " and description like '%".$this->input->get("sid_nama")."%'";
		$sql.=" order by description";
		
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->inventory_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where item_number='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function list_info($offset=0){
		if(isset($_GET['offset'])){
			$offset=$_GET['offset'];
		}
		$data['offset']=$offset;
		$this->load->library('search_criteria');

		$faa[]=criteria("Kode","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Supplier","sid_supp");
		$faa[]=criteria("Kelompok","sid_cat");
	
		$data['criteria']=$faa;
		$data['criteria_text']=criteria_text($faa);
		$data['sid_kode']=$this->session->userdata('sid_kode');
		$data['sid_nama']=$this->session->userdata('sid_nama');
		$data['sid_supp']=$this->session->userdata('sid_supp');
		$data['sid_cat']=$this->session->userdata('sid_cat');
		
		$this->template->display_form_input('inventory/info_list',$data);	
	}
	function import_excel(){
		$filename=$_FILES["file_excel"]["tmp_name"];
		if($_FILES["file_excel"]["size"] > 0)
		{
			$file = fopen($filename, "r");
			$i=0;
			$ok=false;
			$this->db->trans_begin();
			while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
			{
				//print_r($emapData);
				//exit();
				$item_no=$emapData[0];
				if(! ($item_no == null or $item_no == "" or $item_no == "kode" ) ) {
					$item_no=$emapData[0];
					$i=1;
					$data=array("item_number"=>$item_no,"description"=>$emapData[1],
						"unit_of_measure"=>$emapData[2],"retail"=>$emapData[3],
						"cost"=>$emapData[4],"cost_from_mfg"=>$emapData[4],"class"=>"Stock Item",
						"create_by"=>"import");
					if($this->inventory_model->exist($item_no)){
						unset($data['item_number']);
						$ok=$this->inventory_model->update($item_no,$data)==1;
					} else {
						$ok=$this->inventory_model->save($data)==1;
					}
				}
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}			
			fclose($file);
			if ($ok){echo json_encode(array("success"=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
	}
	function import_leasing_item_master(){
		$data['caption']="IMPORT DATA MASTER";
		$this->template->display("leasing/import_master",$data);
	}	
}
?>
