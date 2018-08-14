<?php
class Airline_model extends CI_Model {

	private $primary_key='airline_code';
	private $table_name='al_airline';
	public $fields=null;

	function __construct(){
		parent::__construct();        
        
        
		$this->load->model('city_model');
		$this->load->model("country_model");
		$this->fields[]=array('name'=>'airline_code','type'=>"nvarchar",'size'=>50,'caption'=>"Airline code",'control'=>'text');
		$this->fields[]=array('name'=>'airline_name','type'=>'nvarchar','size'=>50,'caption'=>"Airline Name",'control'=>'text');
		$this->fields[]=array('name'=>'address','type'=>'nvarchar','size'=>250,'caption'=>"Address",'control'=>'text');
		$this->fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>"Country",
				'control'=>'dropdown','list'=>$this->country_model->list_country());
		$this->fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>"Province",'control'=>'text');
		$this->fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>"City",
				'control'=>'dropdown','list'=>$this->city_model->list_city());
		$this->fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>"Phone",'control'=>'text');
		$this->fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>"Fax",'control'=>'text');
		$this->fields[]=array('name'=>'contact','type'=>'nvarchar','size'=>50,'caption'=>"Contact",'control'=>'text');
		$this->fields[]=array('name'=>'disc_percent','type'=>'real','size'=>0,'caption'=>"Discount %",'control'=>'text');
		$this->fields[]=array('name'=>'markup_percent','type'=>'real','size'=>0,'caption'=>"Markup %",'control'=>'text');
		$this->fields[]=array('name'=>'contract_no','type'=>'real','size'=>0,'caption'=>"Contract No",'control'=>'text');
		$this->fields[]=array('name'=>'contract_start','type'=>'date','size'=>0,'caption'=>"Ctr Start Date",'control'=>'date');
		$this->fields[]=array('name'=>'contract_end','type'=>'date','size'=>0,'caption'=>"Ctr End Date",'control'=>'date');
		
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
		if(isset($_GET['airline_name']))$nama=$_GET['airline_name'];
		if($nama!='')$this->db->where("airline_name like '%$nama%'");

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
		$data['contract_start']= date('Y-m-d H:i:s', strtotime($data['contract_start']));
		$data['contract_end']= date('Y-m-d H:i:s', strtotime($data['contract_end']));
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$data['contract_start']= date('Y-m-d H:i:s', strtotime($data['contract_start']));
		$data['contract_end']= date('Y-m-d H:i:s', strtotime($data['contract_end']));
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function list_airline(){
		$ret['']='- Select -';
		if($query=$this->db->query("select airline_code,airline_name
			from al_airline order by airline_name")) {
			foreach ($query->result() as $row){
				$ret[$row->airline_code]=$row->airline_name;
			}		 
		}
		return $ret;
	}
}