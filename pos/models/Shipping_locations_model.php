<?php
class Shipping_locations_model extends CI_Model {

private $primary_key='location_number';
private $table_name='shipping_locations';

function __construct(){
	parent::__construct();        
         
    
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
                $nama='';
                if(isset($_GET['location_number'])){
                    $nama=$_GET['location_number'];
                }
                if($nama!='')$this->db->where("location_number like '%$nama%'");

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
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function select_list(){
			$query=$this->db->query("select * from ".$this->table_name.' order by location_number');
			$ret=array();
			$ret['']='- Select -';
			foreach ($query->result() as $row)
			{
					$ret[$row->location_number]=$row->location_number.' - '.$row->attention_name;
			}		 
			return $ret;
	}
	function get_all_array(){
		$sql="select location_number,no_urut from shipping_locations";
		$i=0;
		$retval=null;
		if($query=$this->db->query($sql)){
			foreach($query->result() as $row){
				$retval[$i]["gudang"]=$row->location_number;
				$retval[$i]["no_urut"]=$row->no_urut;
				$i++;
			}
		}
		
		return $retval;
	}
    function outlet($kode){
        $result="";
        $qoutlet=$this->db->select("attention_name")
        ->where("location_number",$kode)->get("shipping_locations");
        if($qoutlet){
            if($routlet=$qoutlet->row())$result=$routlet->attention_name;
        }
        return $result;    
    }
}
