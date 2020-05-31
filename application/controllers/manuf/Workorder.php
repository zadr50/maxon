<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Workorder extends CI_Controller {

	private $limit=10;
    private $file_view='manuf/work_order';
    private $table_name='work_order';
	private $sql="select work_order_no,start_date,expected_date,customer_number,comments,
		wo_status,special_order
        from work_order";
    private $primary_key='work_order_no';
    private $controller='manuf/workorder';

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                 
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('manuf/workorder_model');
		$this->load->model(array('inventory_model','customer_model','sales_order_model'));
	}
	function nomor_bukti($add=false)
	{
		$key="Work Order Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!WO~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!WO~$00001');
				$rst=$this->workorder_model->get_by_id($no);
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
		$data['company']='';
		if($record==NULL)$data['work_order_no']="AUTO";//$this->nomor_bukti();
		if($data['start_date']=='')$data['start_date']= date("Y-m-d H:i:s");
		if($data['expected_date']=='')$data['expected_date']= date("Y-m-d H:i:s");			
		$data['street']='';
		$data['wo_status_list']=array("0"=>"Draft","1"=>"Open",
		"2"=>"Close","3"=>"Canceled","4"=>"Pending","5"=>"Auto Close");
		$data['customer_lookup']=$this->customer_model->lookup();
		$data['so_lookup']=$this->sales_order_model->lookup();
		$data['inventory_lookup']=$this->inventory_model->lookup_by_class();
		return $data;
	}
	function index()
	{	
		$this->browse();			
	}
	function get_posts(){
		$data['wo_number']=$this->input->post('wo_number');
		$data['wo_date']=$this->input->post('wo_date');
		$data['so_number']=$this->input->post('so_number');
		$data['customer']=$this->input->post('customer');
		$data['warehouse']=$this->input->post('warehouse');
		$data['amount']=$this->input->post('amount');
		$data['status']=$this->input->post('status');
		$data['ordered_by']=$this->input->post('ordered_by');
		$data['worked_by']=$this->input->post('worked_by');
		$data['comments']=$this->input->post('comments');

		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 $this->load->model('customer_model');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['work_order_number']=$this->nomor_bukti(); 
			$this->workorder_order_model->save($data);
			$this->nomor_bukti(true);
		} else {
			$data['mode']='add';
			$data['message']='';
            $data['customer_number']=$this->input->post('customer_number');
            $data['customer_list']=$this->customer_model->select_list();
			$this->template->display_form_input($this->file_view,$data,'');			
		}        

	}
	function save()
	{
		$data=$this->input->post();
		$mode=$data['mode'];
		$id=$data['work_order_no'];			
		if($mode=="add" || $id=="AUTO"){
	        $id=$this->nomor_bukti();
			$this->nomor_bukti(true);
		} 
		$data["work_order_no"]=$id;
		unset($data['mode']);
		unset($data['company']);
		
		if($mode=="add"){
			$ok=$this->workorder_model->save($data);
		} else {
			unset($data['work_order_no']);
			$ok=$this->workorder_model->update($id,$data);			
		}
		if ($ok){
			echo json_encode(array('success'=>true,'work_order_no'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	
	function update()
	{
	 
		 $data=$this->set_defaults(); 
		 $this->_set_rules();
 		 $id=$this->input->post('wo_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->workorder_model->update($id,$data);
		    $data['message']='update success';
		} else {
			$data['message']='Error Update';
		}
	  
		$this->view($data['wo_number'],$data);			
	}
	
	function view($id=null,$data=null){
		 if($id==null)	{
		 	///echo 'herer';
			 $data=$this->set_defaults();
			 $data['mode']='add';
			 $data['id']='';
			 $data['detail']='';
		 } else {
			 $model=$this->workorder_model->get_by_id($id)->row();
			 $data=$this->set_defaults($model);
			 $data['id']=$id;
			 $data['mode']='view';
			 $data['detail']=$this->load_detail($id);
		 }	
		 if($data['customer_number']!=''){
			$this->load->model('customer_model');
			if($q=$this->customer_model->get_by_id($data['customer_number'])){
				$data['company']=$q->row()->company;
				$data['street']=$q->row()->street.' Phone: '.$q->row()->phone;
			}
		 }
		 $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('wo_number','Workorder Number', 'required|trim');
		 $this->form_validation->set_rules('customer','Supplier Name',	 'required');
		 $this->form_validation->set_rules('so_number','SO Number',	 'required');
	}
	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'date format is not valid. yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Kode WO','Customer','Start Date','Exp Date','Comments','Status');
		$data['fields']=array( 'work_order_no','customer_number','start_date','expected_date','comments','wo_status');
		$data['field_key']='work_order_no';
		$data['caption']='DAFTAR WORK ORDER';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Pelanggan","sid_cust");
		$faa[]=criteria("Nomor WO","sid_number");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$no=$this->input->get('sid_number');
    	$sql=$this->sql." where 1=1";
		if($no!='') {
			$sql.=" and work_order_no='".$no."'";
		} else {
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql.=" and start_date between '$d1' and '$d2'";
			if($this->input->get('sid_number')!='')$sql.=" and customer_number='".$this->input->get('sid_number')."%'";
		}
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
		
        echo datasource($sql);
    }	 
	function delete($id){
	 	$this->workorder_model->delete($id);
	 	$this->browse();
	}
	
	function lookup(){
		$s='';
		$i=0;
		$query=$this->db->query("select wo_number,wo_date,so_number from workorder");
		 
  		foreach($query->result() as $row){
			$i++;
			$s=$s.'{"wo_number":"'.$row->wo_number.'","wo_date":"'.$row->wo_date.'"},
			"so_number":"'.$row->so_number.'"},"customer":"'.$row->customer.'"},			
			';
		}
		$s=substr($s,0,strlen($s)-1);
		$s='{"total":'.$i.',"rows":['.$s;	
		$s=$s.']}';
		echo $s;
		
 	}
	function load_detail($wo_number){
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No','Item Number','Description','Qty','Unit','Price','Total'
		,'Actions'
		);
		
		$i=0;
		if($query=$this->db->query("select * from work_order_detail where work_order_no='".$wo_number."'")){
			foreach($query->result() as $row){
				$this->table->add_row(++$i,$row->item_number,$row->description,
				$row->quantity,$row->unit,$row->price,$row->total,
				'<a  href="javascript:void(0)"  
				onclick="del_item('.$row->id.');return false;">Delete</a>'
				);
			}
		}
		$tmpl=$this->template->template_table("table");
		$this->table->set_template($tmpl);
		$ret= $this->table->generate();

		return $ret;
	}
	function items($nomor)
	{
		$sql="select p.item_number,i.description,p.quantity,p.id as line_number,p.unit,
		p.price,p.total,p.qty_exec,p.qty_bal
		from work_order_detail p
		left join inventory i on i.item_number=p.item_number
		where work_order_no='$nomor'";
		echo datasource($sql);
	}
    function save_item(){
        $item_no=$this->input->post('item_number');
		$wo=$this->input->post('work_order_no_item');
        $data['work_order_no']=$wo;
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
        $this->load->model('manuf/work_order_detail_model');
        
		if($id!=''){
			$ok=$this->work_order_detail_model->update($id,$data);
		} else {
        	$ok=$this->work_order_detail_model->save($data);
		}
		 
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>$this->db->display_error()));
		}
    }        
	
 	function save_detail(){
		$wo_number=$this->input->post('wo_number');
		$item_number=$this->input->post('item_number');
		$description=$this->input->post('description');
		$qty=$this->input->post('qty');
		$unit=$this->input->post('unit');
		$price=$this->input->post('price');
		$disc=0;	//$this->input->post('disc');
		$amount=$this->input->post('amount');
		$s="insert into workorder_detail set wo_number='$wo_number',item_number='$item_number',
			description='$description',quantity='$qty',unit='$unit',price='$price',
			disc_prc='$disc',total='$amount'";
		 
		$this->db->query($s);
		$url=base_url().'index.php/manuf/workorder/view/'.$wo_number;
		echo $this->load_detail($wo_number);
	}
    function delete_item($id=0){
    	if($id==0)$id=$this->input->post('line_number');
        $this->load->model('manuf/work_order_detail_model');
        if($this->work_order_detail_model->delete($id)) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
	function select_wo_open()
	{
		$s="select work_order_no,start_date,expected_date,wo_status from work_order";
		echo datasource($s);
	}
	function load_item_exec()
	{
	$q=$this->input->get('q');
	$wo_number=$this->input->get('wo');
		if($q)
		{
			$sql="select item_number,description,quantity,unit,qty_exec,qty_bal,id
			from work_order_detail
			where work_order_no='$wo_number'";
			$query=$this->db->query($sql);
			$i=0;
			$this->load->model('manuf/workorder_model');
			$data='';
			if($query){
				foreach($query->result() as $row){
					$data[$i][]=$row->item_number;
					$data[$i][]=$row->description;
					$data[$i][]=$row->quantity;
					$data[$i][]=$row->unit;
					$data[$i][]=$row->qty_bal;
					$data[$i][]=form_input('qty_exec[]');
					$data[$i][]=form_hidden('line[]',$row->id);
					$i++;
				}
			}
			$this->load->library('browse');
			$header=array('Item Number','Description','Qty Order','Unit','QtyBal','Qty Exec');
			$this->browse->set_header($header);
			$this->browse->data($data);
			echo $this->browse->refresh();
		}
	}
	function info($wo_number){
		$ok=false;
		if($q=$this->workorder_model->get_by_id($wo_number)){
			if($row=$q->row()){
				$data['success']=true;
				$data['sales_order_number']=$row->sales_order_number;
				$data['customer_number']=$row->customer_number;
				$data['start_date']=$row->start_date;
				$data['expected_date']=$row->expected_date;
				$data['comments']=$row->comments;
				$ok=true;
			}
		}
		if ($ok){
			echo json_encode($data);
		} else {
			echo json_encode(array('msg'=>$this->db->display_error()));
		}
	}
	function print_bukti($nomor){
		$nomor=urldecode($nomor);
        $data=$this->workorder_model->get_by_id($nomor)->row_array();
		$data['content']=load_view('manuf/rpt/work_order',$data);
        $this->load->view('pdf_print',$data);                

	}
}
?>