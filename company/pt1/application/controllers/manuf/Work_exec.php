<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Work_exec extends CI_Controller {

private $limit=10;
    private $file_view='manuf/work_exec';
    private $table_name='work_exec';
    private $sql="select work_exec_no,wo_number,start_date,expected_date,dept_code,person_in_charge,comments
            from work_exec
                ";
    private $primary_key='work_exec_no';
    private $controller='manuf/work_exec';

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('manuf/work_exec_model');
		$this->load->model('inventory_model');
	}
	function nomor_bukti($add=false)
	{
		$key="Work Exec Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!WOE~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!WOE~$00001');
				$rst=$this->work_exec_model->get_by_id($no);
				if($rst){
					if($rst->row())$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
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
		 $this->load->model("department_model");
		 $this->load->model("manuf/person_model");
		$data['dept_list']=$this->department_model->lookup();
		$data['person_list']=$this->person_model->lookup();
		return $data;
	}
	function index()
	{	
		$this->browse();			
	}
	function get_posts(){
		$data=$this->input->post();
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $data['detail']='';
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['work_exec_number']=$this->nomor_bukti(); 
			$this->work_exec_order_model->save($data);
			$this->nomor_bukti(true);
		} else {
			$data['mode']='add';
			$data['message']='';
			$this->template->display_form_input($this->file_view,$data,'');			
		}        

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
		$data2['work_exec_no']=$data['work_exec_no'];
		$data2['wo_number']=$data['wo_number'];
		$data2['start_date']=$data['start_date'];
		$data2['expected_date']=$data['expected_date'];
		$data2['dept_code']=$data['dept_code'];
		$data2['comments']=$data['comments'];
		$data2['person_in_charge']=$data['person_in_charge'];
		$data2['status']=$data['status'];
		if($mode=="add"){
			$ok=$this->work_exec_model->save($data2);
		} else {
			$ok=$this->work_exec_model->update($id,$data2);			
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
			$this->load->model('manuf/workorder_model');
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
						$data['wo_customer'] = $data['wo_customer'].' - ' . $row->company ;
					}
				
				}
			}
		 }
		 $this->template->display_form_input($this->file_view,$data,'');
	}
	function load_detail($id)
	{
		$id=urldecode($id);
		$sql="select item_number,description,quantity,unit,id
		from work_exec_detail where work_exec_no='$id'";
		$query=$this->db->query($sql);
		$i=0;$data='';
		if($query){
			foreach($query->result() as $row){
				$data[$i][]=$row->item_number;
				$data[$i][]=$row->description;
				$data[$i][]=$row->quantity;
				$data[$i][]=$row->unit;
				$data[$i][]=$row->id;
				$i++;
			}
		}
		$this->load->library('browse');
		$header=array('Item Number','Description','Quantity');
		$this->browse->set_header($header);
		$this->browse->data($data);
		return $this->browse->refresh();
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('work_exec_no','Work Exec Number', 'required|trim');
	}
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Kode WOE','Kode WO','Start Date','Exp Date','Person','Comments');
		$data['fields']=array( 'work_exec_no','wo_number','start_date','expected_date','person_in_charge','comments');
		$data['field_key']='work_exec_no';
		$data['caption']='DAFTAR WORK ORDER EXEC';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Kode WOE","sid_woe");
		$faa[]=criteria("Kode WO","sid_wo");
		
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
		$no=$this->input->get('sid_woe');
		if($no!='') {
			$sql.=" and work_exec_no='".$no."'";	
		} else {
			if($this->input->get('sid_wo')!='')$sql.=" work_order_no = '".$this->input->get('sid_wo')."'";
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql.=" and start_date between '$d1' and '$d2'";
		}

        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function delete($id){
		$id=urldecode($id);
	 	$this->work_exec_model->delete($id);
	 	$this->browse();
	}
	function items($nomor="")
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity,p.id as line_number,p.unit,
		p.price,p.total
		from work_exec_detail p
		left join inventory i on i.item_number=p.item_number
		where work_exec_no='$nomor'";
		echo datasource($sql);
	}
    function save_item(){
        $item_no=$this->input->post('item_number');
		$wo=$this->input->post('work_exec_no_item');
        $data['work_exec_no']=$wo;
        $data['item_number']=$item_no;
        $data['quantity']=$this->input->post('quantity');
        $data['unit']=$this->input->post('unit');
		$id=$this->input->post('line_number');
		if($id!='')$data['ID']=$id;
        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
		if($item){
            $data['description']=$item->description;
			if($data['unit']=='')$data['unit']=$item->unit_of_measure;
		}
		if($data['unit']=='')$data['unit']=$item->unit_of_measure;
        $this->load->model('manuf/work_exec_detail_model');
        
		if($id!=''){
			$ok=$this->work_exec_detail_model->update($id,$data);
		} else {
        	$ok=$this->work_exec_detail_model->save($data);
		}
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>mysql_error()));
		}
    }        
	function save_item_wo_detail($exec_no, $arLine,$arQtyExec)
	{
		$exec_no=urldecode($exec_no);
		$this->load->model('manuf/work_order_detail_model');
		$this->load->model('manuf/work_exec_detail_model');
		for($i=0;$i<count($arLine);$i++)
		{
			$id=$arLine[$i];
			$qty=$arQtyExec[$i];
			if($qty>0 and $id>0)
			{
				$q=$this->work_order_detail_model->get_by_id($id);
				if($q)
				{
					$wod=$q->row();
					$data_wod['qty_exec']=$wod->qty_exec+$qty;
					$data_wod['qty_bal']=$wod->quantity-$data_wod['qty_exec'];
					$this->work_order_detail_model->update($id,$data_wod);
					
					$data['work_exec_no']=$exec_no;
					$data['item_number']=$wod->item_number;
					$data['description']=$wod->description;
					$data['quantity']=$wod->quantity;
					$data['unit']=$wod->unit;
					$this->work_exec_detail_model->save($data);
				}
			}
		}
	}
    function delete_item($id=0){
		$id=urldecode($id);
    	if($id==0)$id=$this->input->post('line_number');
        $this->load->model('manuf/work_exec_detail_model');
        if($this->work_exec_detail_model->delete($id)) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
	function select()
	{
		$s="select work_exec_no,wo_number,start_date,expected_date,person_in_charge,comments 
		from work_exec";
		echo datasource($s);
	}
}
?>
