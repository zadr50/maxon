<?php
class Apps_model extends CI_Model {

	private $primary_key='id';
	private $table_name='maxon_apps';
	public $fields=null;

	function __construct(){
		parent::__construct();        
    
		$this->fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>"App Id",'control'=>'text');
		$this->fields[]=array('name'=>'app_name','type'=>'nvarchar','size'=>50,'caption'=>"App Name",'control'=>'text');
		$this->fields[]=array('name'=>'app_desc','type'=>'nvarchar','size'=>250,'caption'=>"Description",'control'=>'text');
		$this->fields[]=array('name'=>'app_type','type'=>'nvarchar','size'=>50,'caption'=>"Type",'control'=>'text');
		$this->fields[]=array('name'=>'app_controller','type'=>'nvarchar','size'=>250,'caption'=>"Controller",'control'=>'text');
		$this->fields[]=array('name'=>'app_path','type'=>'nvarchar','size'=>250,'caption'=>"Folder",'control'=>'text');
		$this->fields[]=array('name'=>'app_ico','type'=>'nvarchar','size'=>50,'caption'=>"Icon",'control'=>'text');
		$this->fields[]=array('name'=>'is_core','type'=>'int','size'=>5,'caption'=>"Is Core",'control'=>'text');
		$this->fields[]=array('name'=>'is_active','type'=>'int','size'=>5,'caption'=>"Is Active",'control'=>'text');
		$this->fields[]=array('name'=>'app_create_by','type'=>'nvarchar','size'=>50,'caption'=>"Create By",'control'=>'text');
		$this->fields[]=array('name'=>'app_url','type'=>'nvarchar','size'=>250,'caption'=>"Website",'control'=>'text');
		$this->fields[]=array('name'=>'id','type'=>'int','size'=>5,'caption'=>"Id",'control'=>'text');
		
		$this->load->dbforge();
		if(!$this->db->table_exists($this->table_name)){	
			foreach($this->fields as $fld){
				$size="";$type=$fld['type'];
				if($fld['type']=="nvarchar")$size="(".$fld['size'].")";
				if($fld['name']=="id"){
					$type="";
				} else {
					$type =" ".$type.' '.$size;
				}
				$this->dbforge->add_field($fld['name'].$type);
			}
			$this->dbforge->add_key($this->primary_key,TRUE);
			$this->dbforge->create_table($this->table_name);
		}	
			
	}
	function get_paged_list($limit=100,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['app_name']))$nama=$_GET['app_name'];
		if($nama!='')$this->db->where("app_name like '%$nama%'");

		if (empty($order_column)||empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else
			$this->db->order_by($order_column,$order_type);
			
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function list_app(){
		$ret['']='- Select -';
		if($query=$this->db->query("select id,app_name
			from maxon_apps order by app_name")) {
			foreach ($query->result() as $row){
				$ret[$row->id]=$row->app_name;
			}		 
		}
		return $ret;
	}
	function fields(){return $this->fields;}
}