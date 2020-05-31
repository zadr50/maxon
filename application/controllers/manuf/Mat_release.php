<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Mat_Release extends CI_Controller {

private $limit=10;
    private $file_view='manuf/mat_release';
    private $table_name='mat_release_header';
    private $sql="select mat_rel_no,wo_number,exec_number,date_rel,warehouse,person,comments
            from mat_release_header
            ";
    private $primary_key='mat_rel_no';
    private $controller='manuf/mat_release';

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                  
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('manuf/mat_release_model');
		$this->load->model('manuf/work_exec_model');
		$this->load->model('inventory_model');
		$this->load->model('shipping_locations_model');
	}
	function nomor_bukti($add=false)
	{
		$key="Material Release Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!MR~$00001');
			for($i=0;$i<100;$i++){
				$no=$this->sysvar->autonumber($key,0,'!MR~$00001');
				$rst=$this->mat_release_model->get_by_id($no);
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
		if($record==NULL){
			$data['mat_rel_no']="AUTO";
			$data['warehouse']=current_gudang();
			$data['person']=user_id();
		}
		if($data['date_rel']=='')$data['date_rel']= date("Y-m-d H:i:s");
		$data['warehouse_list']=$this->shipping_locations_model->lookup();
		$data['work_exec_list']=$this->work_exec_model->lookup();

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
			$data['mat_rel_no']=$this->nomor_bukti(); 
			$this->mat_release_model->save($data);
			$this->nomor_bukti(true);
		} else {
			$data['mode']='add';
			$data['message']='';
			$this->template->display_form_input($this->file_view,$data,'');			
		}        

	}
	function save()
	{
		$data=$this->input->post();
		$mode=$data['mode'];
		$id=$data['mat_rel_no'];
		if($mode=="add"){
	        $id=$this->nomor_bukti();
			$this->nomor_bukti(true);
		}
		
		$data['mat_rel_no']=$id;
		
		if(isset($data['line'])){
			$this->save_item_exec_detail($id,$data['line'],$data['qty_rel']);
			unset($data['line']);
			unset($data['qty_rel']);
		}
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->mat_release_model->save($data);
		} else {
			$ok=$this->mat_release_model->update($id,$data);			
		}
		$this->mat_release_model->update_item_release($id);
		if ($ok){
			echo json_encode(array('success'=>true,'mat_rel_no'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'.$this->db->display_error()));
		}
	}
	function view($id=null,$data=null){
		 if($id==null)	{
			 $data=$this->set_defaults();
			 $data['mode']='add';
			 $data['id']='';
		 } else {
			$id=urldecode($id);
			 $model=$this->mat_release_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			 $data['id']=$id;
			 $data['mode']='view';
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
		$data['fields_caption']=array('Release No','Exec No','Date','Warehouse','Comments');
		$data['fields']=array( 'mat_rel_no','exec_number','date_rel','warehouse','comments');
		$data['field_key']='mat_rel_no';
		$data['caption']='DAFTAR MATERIAL RELEASE';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Release No","sid_rel_no");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$sql=$this->sql." where 1=1";
		$no=$this->input->get('sid_rel_no');
		if($no!=''){
			$sql.=" and mat_rel_no='".$no."'";	
		} else {
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql.=" and date_rel between '$d1' and '$d2'";		
		}
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function delete($id){
		$id=urldecode($id);
	 	$this->mat_release_model->delete($id);
	 	$this->browse();
	}
	function delete_material_release() {
		$mat_rel_no=$_POST['mat_rel_no'];
        $this->load->model('mat_release_detail_model');
        if($this->mat_release_detail_model->delete_by_number($mat_rel_no)) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}		
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity,p.id,p.unit,
		p.cost,p.amount,p.warehouse,p.line_exec_no  
		from mat_release_detail p
		left join inventory i on i.item_number=p.item_number
		where mat_rel_no='$nomor' and mat_rel_no<>''";
		echo datasource($sql);
	}
    function save_item(){
        $item_no=$this->input->post('item_number');
		$exec=$this->input->post('mat_release_item');
        $data['mat_rel_no']=$exec;
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
        
		if($id!=''){
			$ok=$this->mat_release_detail_model->update($id,$data);
		} else {
        	$ok=$this->mat_release_detail_model->save($data);
		}
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>$this->db->display_error()));
		}
    }        
	function save_item_exec_detail($exec_no, $arLine,$arQtyExec)
	{
		$exec_no=urldecode($exec_no);
		$this->load->model('manuf/mat_release_detail_model');
		for($i=0;$i<count($arLine);$i++)
		{
			$id=$arLine[$i];
			$qty=$arQtyExec[$i];
			if($qty>0 and $id>0)
			{
				$q=$this->mat_release_detail_model->get_by_id($id);
				if($q)
				{
					$mrd=$q->row();
					$data['mat_rel_no']=$exec_no;
					$data['item_number']=$wod->item_number;
					$data['description']=$wod->description;
					$data['quantity']=$wod->quantity;
					$data['unit']=$wod->unit;
					$this->mat_release_detail_model->save($data);
				}
			}
		}
	}
    function delete_item($id=0){
		$id=urldecode($id);
    	if($id==0)$id=$this->input->post('line_number');
        $this->load->model('mat_release_detail_model');
        if($this->mat_release_detail_model->delete($id)) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}    
	function print_bukti($nomor){
		$nomor=urldecode($nomor);
        $data=$this->mat_release_model->get_by_id($nomor)->row_array();
		$data['content']=load_view('manuf/rpt/mat_release',$data);
        $this->load->view('pdf_print',$data);                

	}
    
}
?>
