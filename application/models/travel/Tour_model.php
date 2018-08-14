<?php
class Tour_model extends CI_Model {

	private $primary_key='tour_code';
	private $table_name='al_tourcode';

	function __construct(){
		parent::__construct();        
        
		$this->load->dbforge();
		if(!$this->db->table_exists($this->table_name)){	//DB_Driver
			$this->dbforge->add_field("tour_code nvarchar(50) not null");
			$this->dbforge->add_field("tour_name nvarchar(50)");
			$this->dbforge->add_field("agent nvarchar(50)");
			$this->dbforge->add_field("price double");
			$this->dbforge->add_field("destination nvarchar(50)");
			$this->dbforge->add_field("start datetime");
			$this->dbforge->add_field("until datetime");
			$this->dbforge->add_field("market nvarchar(50)");
			$this->dbforge->add_field("note nvarchar(50)");
			$this->dbforge->add_field("curr_code nvarchar(50)");
			$this->dbforge->add_key("tour_code",TRUE);
			$this->dbforge->create_table($this->table_name);
		}	
		if(!$this->db->table_exists('al_tourdetail')){	//DB_Driver
			$this->dbforge->add_field("tour_code nvarchar(50) not null");
			$this->dbforge->add_field("day_no int");
			$this->dbforge->add_field("place nvarchar(50)");
			$this->dbforge->add_field("description nvarchar(250)");
			$this->dbforge->add_field("id");
			$this->dbforge->create_table("al_tourdetail");
		}	
		
		
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['tour_name']))$nama=$_GET['tour_name'];
		if($nama!='')$this->db->where("tour_name like '%$nama%'");

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
		$data['start']=date('Y-m-d H:i:s', strtotime($data['start']));
		$data['until']=date('Y-m-d H:i:s', strtotime($data['until']));
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$data['start']=date('Y-m-d H:i:s', strtotime($data['start']));
		$data['until']=date('Y-m-d H:i:s', strtotime($data['until']));
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
}