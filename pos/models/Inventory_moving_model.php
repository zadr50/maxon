<?php
class Inventory_moving_model extends CI_Model {

private $primary_key='transfer_id';
private $table_name='inventory_moving';
public $amount=0;

function __construct(){
	parent::__construct();        
        
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
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
        $this->transfer_id=$id;
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$data['date_trans']= date( 'Y-m-d H:i:s', strtotime($data['date_trans']));
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$data['date_trans']= date( 'Y-m-d H:i:s', strtotime($data['date_trans']));
		$this->db->where("id",$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
		$this->db->where('transfer_id',$id);
		$this->db->delete('inventory_moving');
	}
	function add_item($data){
            $this->db->insert('inventory_moving',$data);
            return $this->db->insert_id();
    } 			
	function nomor_bukti($add=false)
	{
		$key="Transfer Stock Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!TRX~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!TRX~$00001');
				$rst=$this->inventory_moving_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	function list_trx_new($d1,$d2){
		$sql="select im.transfer_id,im.date_trans,im.from_location,
			im.to_location, im.item_number,i.description, 
			im.from_qty 
			from inventory_moving im left join inventory i on i.item_number=im.item_number 
			where im.from_location<>im.to_location and im.date_trans between '$d1' and '$d2' 
			and (im.status is null or im.status=0)";
		return $this->db->query($sql);
	}
	
}
