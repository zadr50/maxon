<?php
class Work_exec_model extends CI_Model {

private $primary_key='work_exec_no';
private $table_name='work_exec';

function __construct(){
	parent::__construct();        
      
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='work_exec_no',$order_type='asc')
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
		$id=$data['work_exec_no'];
		$data['start_date']= date( 'Y-m-d H:i:s', strtotime($data['start_date']));
		$data['expected_date']= date( 'Y-m-d H:i:s', strtotime($data['expected_date']));
		$data['wo_customer']='';		
		$ok=$this->db->insert($this->table_name,$data);
		$this->recalc_cost_material($id);
		return $ok;
	}
	function update($id,$data){
		$this->load->model('manuf/work_exec_detail_model');
		$this->work_exec_detail_model->update_items($id);
		$data['start_date']= date( 'Y-m-d H:i:s', strtotime($data['start_date']));
		$data['expected_date']= date( 'Y-m-d H:i:s', strtotime($data['expected_date']));
		
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		$this->recalc_cost_material($id);
		return $ok;
	}
	function delete($id){

		$this->db->where("work_exec_no",$id);
		$this->db->delete("work_exec_detail");

		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function recalc_cost_material($woe_number){
		if($q=$this->db->where("work_exec_no",$woe_number)->get("work_exec_detail")){
			foreach($q->result() as $woe_items){
				if($qmat=$this->db->query("select sum(amount) as z_amount,sum(cost) as z_cost  
					from mat_release_detail where line_exec_no='".$woe_items->id."'")){
					if($mat=$qmat->row()){
						$cost=0;
						if($mat->z_cost!="")$cost=$mat->z_cost;
						$amount=0;
						if($mat->z_amount!="")$amount=$mat->z_amount;
						$s="update work_exec_detail set price='$amount',total='".$amount."' 
							where work_exec_no='".$woe_number."' 
							and id='".$woe_items->id."'";
						$this->db->query($s);
					}
				}
			}
		}
	}
	function lookup($param=null){
    	$extra_ret_func="";
    	if(isset($param["dlgRetFunc"]))$extra_ret_func=$param["dlgRetFunc"];
		
        $lookup = $this->list_of_values->render(array(
        	"dlgBindId"=>"work_exec",
        	"dlgUrlQuery"=>"manuf/work_exec/select_open",
       		'show_checkbox'=>false,
       		'show_check1'=>false,'check1_title'=>"Supplier",'check1_field'=>'supplier_number',
        	"dlgRetFunc"=>"			
				$('#exec_number').val(row.work_exec_no);
				$('#wo_number').val(row.wo_number);
        	",
        	"dlgCols"=>array(
                array("fieldname"=>"work_exec_no","caption"=>"Kode WOE","width"=>"180px"),
                array("fieldname"=>"start_date","caption"=>"Tanggal","width"=>"180px"),
                array("fieldname"=>"customer","caption"=>"Cust No","width"=>"80px"),
                array("fieldname"=>"wo_number","caption"=>"Nomor WO","width"=>"180px"),
                array("fieldname"=>"status","caption"=>"Status","width"=>"80px"),
                array("fieldname"=>"comments","caption"=>"Comments","width"=>"180px")
        	)
        ));
		return $lookup;		
	}

}
