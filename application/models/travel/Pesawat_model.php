<?php
class Pesawat_model extends CI_Model {

	private $primary_key='id';
	private $table_name='al_ticket_pesawat';
	public $fields=null;

	function __construct(){
		parent::__construct();        
       
		$this->load->model('customer_model');
		$this->load->model('travel/airline_model');
		$this->load->model('city_model');
		
		$this->fields[]=array('name'=>'ticket_no','type'=>"nvarchar",'size'=>50,'caption'=>"Ticket No",'control'=>'text');
		$this->fields[]=array('name'=>'ps_name','type'=>'nvarchar','size'=>50,'caption'=>"Passenger",'control'=>'text');
		$this->fields[]=array('name'=>'ps_salutation','type'=>'nvarchar','size'=>50,'caption'=>"Mr/Mrs",
			'control'=>'radio','list'=>array("Mr","Mrs"));
		$this->fields[]=array('name'=>'price','type'=>'double','size'=>0,'caption'=>"Price",'control'=>'text');
		$this->fields[]=array('name'=>'aci','type'=>'nvarchar','size'=>50,'caption'=>"ACI",
			'control'=>'radio','list'=>array("Adult","Children","Infant"));
		$this->fields[]=array('name'=>'note','type'=>'nvarchar','size'=>50,'caption'=>"Note",'control'=>'text');
		$this->fields[]=array('name'=>'cust_no','type'=>'nvarchar','size'=>50,'caption'=>"Cust No",
			'control'=>'dropdown','list'=>$this->customer_model->list_travel());
		$this->fields[]=array('name'=>'airline','type'=>'nvarchar','size'=>50,'caption'=>"Airline",
			'control'=>'dropdown','list'=>$this->airline_model->list_airline());
		$this->fields[]=array('name'=>'depart','type'=>'nvarchar','size'=>50,'caption'=>"Departure",
			'control'=>'dropdown','list'=>$this->city_model->list_city());
		$this->fields[]=array('name'=>'desti','type'=>'nvarchar','size'=>50,'caption'=>"Destination",
			'control'=>'dropdown','list'=>$this->city_model->list_city());
		$this->fields[]=array('name'=>'book_code','type'=>'nvarchar','size'=>50,'caption'=>"Kode Booking",'control'=>'text');
		$this->fields[]=array('name'=>'book_date','type'=>"date",'size'=>50,'caption'=>"Book Date",'control'=>'date');
		$this->fields[]=array('name'=>'issued_date','type'=>"date",'size'=>50,'caption'=>"Issued Date",'control'=>'date');
		$this->fields[]=array('name'=>'limit_hour','type'=>"nvarchar",'size'=>50,'caption'=>"Limit Hour",'control'=>'text');
		$this->fields[]=array('name'=>'depart_date','type'=>"nvarchar",'size'=>50,'caption'=>"Depart Time",'control'=>'text');
		$this->fields[]=array('name'=>'destin_date','type'=>"nvarchar",'size'=>50,'caption'=>"Destin Time",'control'=>'text');
		$this->fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->load->dbforge();
		//$this->dbforge->drop_table($this->table_name);
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
			$this->dbforge->create_table($this->table_name);
		}	
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
//		if(isset($_GET['tour_name']))$nama=$_GET['tour_name'];
//		if($nama!='')$this->db->where("tour_name like '%$nama%'");
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
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		if(isset($data['id']))unset($data['id']);
		$data['book_date']=date('Y-m-d H:i:s', strtotime($data['book_date']));
		$data['issued_date']=date('Y-m-d H:i:s', strtotime($data['issued_date']));
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$data['book_date']=date('Y-m-d H:i:s', strtotime($data['book_date']));
		$data['issued_date']=date('Y-m-d H:i:s', strtotime($data['issued_date']));
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
}