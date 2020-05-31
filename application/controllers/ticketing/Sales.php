<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sales extends CI_Controller {
    private $limit=100;
    private $table_name='ticket_sales';
    private $file_view='ticketing/sales';
    private $controller='ticketing/sales';
    private $primary_key='id';
    private $sql="";

    function __construct()    {
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		$this->load->model(array('ticketing/sales_model','syslog_model','customer_model',
		'bank_accounts_model','ticketing/ticket_type_model'));

    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		$data['lookup_customer']=$this->customer_model->lookup();
		$data['list_rekening']=$this->bank_accounts_model->select_edc();
		
    	
        //    $setting['dlgBindId']="ticket_type";
        //    $setting['sysvar_lookup']='ticket_type';
	    //    $setting['dlgRetFunc']="$('#ticket_type').val(row.varvalue);
	    //    $('#price').val(row.keterangan);";
        //    $data['lookup_ticket_type']=$this->list_of_values->render($setting);
			
			
		$data['lookup_ticket_type']=$this->ticket_type_model->lookup();
		
		if($record==null) {
			$data['tanggal']=date("Y-m-d H:i:s");
			$data['how_paid']='CASH';
			$data['qty_ticket']=1;
		}	
		
			
		return $data;
    }
    function index()    {	
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->city_model->save($data);
			$data['message']='update success';
			$data['mode']='view';
			$this->browse();
		} else {
			$data['mode']='add';
			$data['message']='';
			$data['data']=$data;
			$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		if($data['how_paid']=="0"){
			$data["edc"]="";
		}
	
		$id=$this->input->post("id");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->sales_model->save($data);
			$id=$this->db->insert_id();
			$this->syslog_model->add($id,"ticket_sales","add");

		} else {
			$ok=$this->sales_model->update($id,$data);				
			$this->syslog_model->add($id,"ticket_sales","edit");

		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}	
    function view($id,$message=null)	{
		$id=urldecode($id);
		$message=urldecode($message);
		$data[$this->primary_key]=$id;
		$model=$this->sales_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['message']=$message;
		//$data['fields']=$this->fields;
		$this->template->display_form_input($this->file_view,$data);
    }
     // validation rules
    function _set_rules(){}
    function valid_date($str){
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str)){
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']=$this->controller;
		$oFlds=$this->sales_model->fields;
		$fields=null;
		$fields_caption=null;
		if(is_array($oFlds)){
			for($i=0;$i<count($oFlds);$i++){
				$oFld=$oFlds[$i];
				if(is_object($oFld)){
					$fields[]=$oFld->name;
				} else {
					$fields[]=$oFld['name'];
				}
				
			}
		}
		
		$data['fields']=$fields;
		$data['fields_format_numeric']=array("price","netto");
				
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']=$this->primary_key;
		$data['caption']='DAFTAR TICKET SALES';

		$this->load->library('search_criteria');
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Id","sid_id");
		$faa[]=criteria("User Id","sid_user_id");
		$faa[]=criteria("Nama Member","sid_nama");
		$faa[]=criteria("Kode Member","sid_kode");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$nama=$this->input->get('sid_nama');
		$kode_cust=$this->input->get('sid_kode');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
    	
		$id=$this->input->get("sid_id");
		if($id<>""){
			$sql=$this->sql." where id='$id' ";		
		} else {
	        $sql=$this->sql." where tanggal between '$d1' and '$d2' ";
			$user_id=$this->input->get("sid_user_id");
			if($user_id!="")$sql.=" and user_id='$user_id' ";
		}
        
        $sql.="   order by tanggal";
        
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
		
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$ok = $this->sales_model->delete($id);
		$this->syslog_model->add($id,$this->table_name,"delete");
		$err=$this->db->error();
		if($err['message']=="")$err['message']='Success';
		echo json_encode(array("success"=>$ok,"msg"=>$err['message']));
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	public function print_nota($id)
	{
		if($r=$this->sales_model->get_by_id($id)){
			if($row=$r->row()){
				$how_paid="CASH";
				if($row->how_paid!="0")$how_paid="CARD";
				echo "
					<table >
						<tr><td colspan=5><b>TICKETING</b></td></tr>
						<tr><td colspan=6>--------------------------------</td></tr>
						<tr><td>Jenis Ticket</td><td><b>$row->ticket_type</b></td></tr>
						<tr><td>Tanggal</td><td>$row->tanggal</td></tr>
						<tr><td>Qty (Jml Ticket)</td><td><b>$row->qty_ticket</b></td></tr>
						<tr><td>Price</td><td>".number_format($row->price)."</td></tr>
						<tr><td>Disc ".number_format($row->disc_prc,2)."% </td><td>".number_format($row->disc_amt,2)."</td></tr>
						<tr><td>Amount</td><td><b>".number_format($row->netto,2)."</b></td></tr>
						<tr><td>Bayar</td><td>".number_format($row->bayar,2)."</td></tr>
						<tr><td>Kembali</td><td><b>".number_format($row->kembali,2)."</b></td></tr>
						<tr><td>How Paid</td><td>$how_paid</td></tr>
						<tr><td>Cust (Member Id)</td><td>$row->cust_no $row->cust_name</td></tr>
						<tr><td>Nomor (Id)</td><td>$row->id</td></tr>
						<tr><td>User (Kasir)</td><td>$row->user_id</td></tr>
						<tr><td>Note</td><td>$row->keterangan</td></tr>
						<tr><td>Mesin EDC# </td><td>$row->edc</td></tr>
																																			
					</table>
				";
			}
		}
	}
	function posting($id){
		$id=urldecode($id);
		$ok=$this->sales_model->posting($id);			
		echo json_encode(array("success"=>$ok,"message"=>$this->sales_model->message_text()));
		$this->view($id);		
	}    
	function unposting($id){
		$id=urldecode($id);
		$ok=$this->sales_model->unposting($id);			
		echo json_encode(array("success"=>$ok,"message"=>$this->sales_model->message_text()));
		$this->view($id);		
	}    
		
}
?>
