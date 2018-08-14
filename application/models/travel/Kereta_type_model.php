<?php
class Kereta_type_model extends CI_Model {

	private $primary_key='kereta_code';
	private $table_name='al_kereta';
	public $fields=null;

	function __construct(){
		parent::__construct();        
        
		$this->fields[]=array('name'=>'kereta_code','type'=>"nvarchar",'size'=>50,'caption'=>"Kode Kereta",'control'=>'text');
		$this->fields[]=array('name'=>'kereta_name','type'=>'nvarchar','size'=>50,'caption'=>"Nama Kereta",'control'=>'text');
		
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
		if(isset($_GET['kereta_name']))$nama=$_GET['kereta_name'];
		if($nama!='')$this->db->where("kereta_name like '%$nama%'");

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
	function list_kereta(){
		$ret['']='- Select -';
		if($query=$this->db->query("select kereta_code, kereta_name
			from al_kereta order by kereta_name")) {
			foreach ($query->result() as $row){
				$ret[$row->kereta_code]=$row->kereta_name;
			}		 
		}
		return $ret;
	}
}