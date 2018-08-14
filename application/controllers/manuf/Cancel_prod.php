<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cancel_prod extends CI_Controller {

private $limit=10;
    private $file_view='manuf/cancel_prod';
    private $table_name='work_exec';
    private $sql="select work_exec_no,wo_number,start_date,expected_date,dept_code,
		person_in_charge,status,comments
        from work_exec
                ";
    private $primary_key='work_exec_no';
    private $controller='work_exec';

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                 
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('manuf/work_exec_model');
	}
	
	function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		if($record==NULL)$data['work_exec_no']=$this->nomor_bukti();
		if($data['start_date']=='')$data['start_date']= date("Y-m-d H:i:s");
		if($data['expected_date']=='')$data['expected_date']= date("Y-m-d H:i:s");						
		 $data['wo_customer']='';
		 $data['wo_date_from']='';
		 $data['wo_date_to']='';
		 $data['wo_comment']='';
		 $data['wo_so_number']='';
		
		return $data;
	}
	function index(){	
		echo "not available";
	}
	function get_posts(){
		$data=$this->input->post();
		return $data;
	}
	function save()
	{
		$mode=$this->input->post('mode');
		if($mode=="add"){
	        $id=$this->nomor_bukti();
		} else {
			$id=$this->input->post('work_exec_no');			
		}
		$data=$this->input->post();
		if(isset($data['line'])){
			$this->save_item_wo_detail($id,$data['line'],$data['qty_exec']);
			unset($data['line']);
			unset($data['qty_exec']);
		}
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->work_exec_model->save($data);
		} else {
			$ok=$this->work_exec_model->update($id,$data);			
		}
		if ($ok){
			if($mode=="add") $this->nomor_bukti(true);
			echo json_encode(array('success'=>true,'work_exec_no'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	function view($id=null,$data=null){
		 if($id==null)	{
			 $data=$this->set_defaults();
			 $data['mode']='add';
			 $data['id']='';
		 } else {
			$id=urldecode($id);
			 $model=$this->work_exec_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			 $data['id']=$id;
			 $data['mode']='view';
		 }
		 if($data['wo_number']!=''){
			$this->load->model('workorder_model');
			if($wo=$this->workorder_model->get_by_id($data['wo_number'])){
				$row=$wo->row();
				$data['wo_date_from']=$row->start_date;
				$data['wo_date_to']=$row->expected_date;
				$data['wo_so_number']=$row->sales_order_number;
				$data['wo_comment']=$row->comments;
				$data['wo_customer']=$row->customer_number;
				if($data['wo_customer']!=''){
					$this->load->model('customer_model');
					if($q=$this->customer_model->get_by_id($data['wo_customer'])){
						$row=$q->row();
						$data['wo_customer'] = '<strong>'.$data['wo_customer'].' - ' . $row->company . '</strong>';
					}
				
				}
			}
		 }
		 $this->template->display_form_input($this->file_view,$data,'');
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('work_exec_no','Work Exec Number', 'required|trim');
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity,p.id as line_number,p.unit,
		p.price,p.total
		from work_exec_detail p
		left join inventory i on i.item_number=p.item_number
		where work_exec_no='$nomor'";
		echo datasource($sql);
	}
}
?>
