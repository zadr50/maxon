<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Zone extends CI_Controller {
    private $limit=100;
    private $table_name='zone';
    private $file_view='courier/zone';
    private $controller='courier/zone';
    private $primary_key='id';
    private $sql="";
	private $title="DAFTAR ZONE";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->model('courier/zone_model');
       
		$this->load->library(array('sysvar','template','form_validation'));

		$this->sql="select * from zone";
		if($this->help=="")$this->help=$this->table_name;
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
        $data['mode']='add';
        $data['title']=$this->title;
        $data['help']=$this->help;
        $data['message']='';
        $data['form_controller']=$this->controller;
        $data['field_key']=$this->primary_key;
		if($record) {
            $data['update_by']=user_id();
            $data['update_date']=date("Y-m-d H:i:s");            
		} else {
            $data['create_by']=user_id();
            $data['create_date']=date("Y-m-d H:i:s");
		}
        $data['lov_city']=$this->list_of_values->render(
            array("dlgBindId"=>"city",
                "dlgRetFunc"=>"$('#city_code').val(row.city_id);
                $('#city_name').val(row.city_name);",
                "dlgCols"=>array(
                    array("fieldname"=>"city_id","caption"=>"Kode","width"=>"100px"),
                    array("fieldname"=>"city_name","caption"=>"Nama Kota","width"=>"200px")
                    )
            )
        );        
        
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
            $data['data']=$data;
			$this->zone_model->save($data);
			$data['message']='update success';
			$data['mode']='view';
			$this->browse();
		} else {
			$data['data']=$data;
			$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=urldecode($data['id']);
		$mode=$data["mode"];	
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->zone_model->save($data);            
            $id=$this->zone_model->id;
		} else {
			$ok=$this->zone_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
		
	}	
    function view($id,$show_tool=true)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->zone_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);				
		$data['mode']='edit';
		$data['show_tool']=$show_tool;
		$this->template->display_form_input($this->file_view,$data);
    }
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
		$faa[]=criteria("Zone","sid_nama");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Code','Zone Name');
		$data['fields']=array('code','zone_name');
		$data['msg_left']="<i>Silahkan  isi criteria pencetakan...</i>";
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$sql=$this->sql." where 1=1";
		$name=urldecode($this->input->get('sid_nama'));        
		if($name!='')$sql.=" and zone like '$name%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
		if($this->zone_model->delete($id)){
			$this->browse();
		} else {
			show_error("Tidak bisa dihapus !");		
		}		
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $this->table_name where zone='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function items($cmd="",$id=''){
		if ($cmd=="save") {
			$this->add_item();
		} else if($cmd=="delete") {
			$this->db->where("id",$id)->delete("zone_detail");
            $data['success']=true;
            echo json_encode($data);
            
		} else if ($cmd=="view") {
			if($row=$this->db->where("id",$id)
				->get("zone_detail")->row()){
				$data=(array)$row;
				$data['success']=true;
				echo json_encode($data);
			}				
			
		} else {
		    $id=$cmd;		    
			$sql="select * from zone_detail where zone_code='$id'";
			echo datasource($sql);
		}
	}
	function add_item(){
		$data=$this->input->post();		
		$id=$data['id'];
        unset($data['id']);
		if($id==""){
			$ok=$this->db->insert('zone_detail',$data);
            $id=$this->db->insert_id();
		} else {
			$ok=$this->db->where("id",$id)->update('zone_detail',$data);
		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}
}
?>
