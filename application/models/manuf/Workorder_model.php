<?php
class Workorder_model extends CI_Model {

private $primary_key='work_order_no';
private $table_name='work_order';

function __construct(){
	parent::__construct();        
      
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='work_order_no',$order_type='asc')
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
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$data['start_date']= date( 'Y-m-d H:i:s', strtotime($data['start_date']));
		$data['expected_date']= date( 'Y-m-d H:i:s', strtotime($data['expected_date']));
		$this->recalc_cost($data['work_order_no']);
		$ok = $this->db->insert($this->table_name,$data);
		return $ok;
	}
	function update($id,$data){
		$data['start_date']= date( 'Y-m-d H:i:s', strtotime($data['start_date']));
		$data['expected_date']= date( 'Y-m-d H:i:s', strtotime($data['expected_date']));
		$this->db->where($this->primary_key,$id);
		$ok = $this->db->update($this->table_name,$data);
		$this->recalc_cost($data['work_order_no']);
		return $ok;
		
	}
	function delete($id){

		$this->db->where("work_order_no",$id);
		$this->db->delete("work_order_detail");

		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function recalc_cost($work_order_no){
		$this->load->model("manuf/work_order_detail_model");
		if($qwo=$this->work_order_detail_model->lineitems($work_order_no)){
			foreach($qwo->result() as $wo_items){
				$price=$this->db->select('cost')
					->where("item_number",$wo_items->item_number)
					->get('inventory')->row()->cost;
				$total=$price*$wo_items->quantity;
				$this->db->where("id",$wo_items->id)
					->update("work_order_detail",
					array("price"=>$price,"total"=>$total));
			
			}
		}
	}
	function lookup($param=null){
    	$extra_ret_func="";
    	if(isset($param["dlgRetFunc"]))$extra_ret_func=$param["dlgRetFunc"];
		
        $lookup = $this->list_of_values->render(array(
        	"dlgBindId"=>"work_order",
        	"dlgUrlQuery"=>"manuf/workorder/select_wo_open",
       		'show_checkbox'=>false,
       		'show_check1'=>false,'check1_title'=>"Supplier",'check1_field'=>'supplier_number',
        	"dlgRetFunc"=>"			
				$('#wo_number').val(row.work_order_no);
        	",
        	"dlgCols"=>array(
                array("fieldname"=>"work_order_no","caption"=>"Kode WO","width"=>"180px"),
                array("fieldname"=>"start_date","caption"=>"Tanggal","width"=>"180px"),
                array("fieldname"=>"expected_date","caption"=>"Expect","width"=>"180px"),
                array("fieldname"=>"customer_number","caption"=>"Cust No","width"=>"80px"),
                array("fieldname"=>"sales_order_number","caption"=>"Nomor SO","width"=>"180px"),
                array("fieldname"=>"wo_status","caption"=>"Status","width"=>"80px"),
                array("fieldname"=>"comments","caption"=>"Comments","width"=>"180px")
        	)
        ));
		return $lookup;		
	}
	
}
