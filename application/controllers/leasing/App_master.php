<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class App_master extends CI_Controller {
    private $limit=100;
    private $table_name='ls_app_master';
    private $file_view='leasing/app_master';
    private $controller='leasing/app_master';
    private $primary_key='app_id';
    private $sql="";
	private $title="DAFTAR PENGAJUAN KREDIT";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select am.*,c.cust_name,am.status from ls_app_master am 
			left join ls_cust_master c on c.cust_id=am.cust_id";
		if($this->help=="")$this->help=$this->table_name;
		$this->load->model('leasing/app_master_model');
    }
	function nomor_bukti($add=false) {
		$key="AppMaster Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!SPK~$000001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!SPK~$000001');
				$rst=$this->app_master_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}

	
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
		if($record==NULL)$data['app_id']=$this->nomor_bukti();
		$data['score']='';
		$data['cust_name']='';
		$data['counter_name']='';
		$data['loan_id']='';
		if($record==NULL) {
			$data['app_date']=date("Y-m-d H:i:s");
			$data['create_date']=date("Y-m-d H:i:s");
			$data['create_by']=user_id();
			$data['username']=user_name();
		} else {
			$data['username']=user_name($data['create_by']);
		}


		if(!$record==NULL){
			if($query=$this->db->select('cust_name')
			->where('cust_id',$data['cust_id'])
			->get('ls_cust_master')){
				if($query->row()){
					$data['cust_name']=$query->row()->cust_name;
				} 
			}
			if($query=$this->db->select('counter_name')
			->where('counter_id',$data['counter_id'])
			->or_where('area',$this->access->cid())
			->get('ls_counter')){
				if($query->row()){
					$data['counter_name']=$query->row()->counter_name;
				}
			}
		} else {
			$data['cust_name']='';
			$data['counter_name']='';
		}
		return $data;
    }
    function index(){
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
	function counter_name() {
		$retval='';
		if($query=$this->db->select('counter_name')
			->where('counter_id',$this->access->cid())
			->or_where('area',$this->access->cid())
			->get('ls_counter')){
				if($query->row()){
					$retval=$query->row()->counter_name;
				}
		}
		return $retval;
	}
    function add()   {
		$data=$this->set_defaults();
		$data['counter_id']=$this->access->cid();
		$data['counter_name']=$this->counter_name();
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
				$data=$this->get_posts();
				$this->app_master_model->save($data);
				$data['message']='update success';
				$data['mode']='view';
				$this->browse();
		} else {
				$data['mode']='add';
				$data['message']='';
				$data['data']=$data;
				$data['title']=$this->title;
				$data['help']=$this->help;
				$data['form_controller']=$this->controller;
				$data['field_key']=$this->primary_key;
				
				$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		 
		$id=$this->input->post("app_id");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->app_master_model->save($data);	
		} else {
			$ok=$this->app_master_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
		
	}	
    function view($id,$show_tool=true)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->app_master_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
				
		$data['mode']='view';
		$data['message']="";
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$data['risk_approved']="";
		if($query=$this->db->select("recomended")
			->where("app_id",$id)
			->get("ls_app_survey")){
				if($query->row()){
					$risk=$query->row()->recomended;
					$data['risk_approved']=$risk;
					$this->db->where("app_id",$id)->update("ls_app_master",array("risk_approved"=>$risk));
				}
		}
		$data['show_tool']=$show_tool;
		$loan_id="";
		if($q=$this->db->select("loan_id")->where("app_id",$id)->get("ls_loan_master")){
			if($row=$q->row()){
				$loan_id=$row->loan_id;
			}
		}
		$data['loan_id']=$loan_id;
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
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Pemohon","sid_nama");
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor SPK","sid_number");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Nomor','Tanggal','Nama Debitur','Status','Create','Update','Create Date','Update Date');
		$data['fields']=array('app_id','app_date','cust_name','status','create_by','update_by','create_date','update_date');
		$data['other_menu']="leasing/app_master_menu";
		$data['msg_left']="<i>Isi range tanggal pengajuan atau isi nomor pengajuan, lalu klik tombol cari.</i>";
		
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		if(user_admin() or $this->access->cid=="ALL"){
			$sql=$this->sql." where 1=1";
		} else {
			$sql=$this->sql." where am.create_by='".user_id()."'";
		}
		$no=$this->input->get('sid_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
		if($no!=''){
			$sql.=" and am.app_id='".$no."'";
		} else {
			$sql.=" and am.app_date between '$d1' and '$d2'";
		}
		
		if($this->input->get("sid_nama"))$sql .= " and cust_name like '%".$this->input->get("sid_nama")."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
		if($this->app_master_model->delete($id)){
			$this->browse();
		} else {
			show_error("Tidak bisa dihapus, 
			mungkin masih ada data kredit untuk nomor ini. !");		
		}		
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where app_id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function items($app_id,$id=''){
		$cmd=$app_id;
		if ($cmd=="save") {
			$this->add_item();
		} else if($cmd=="delete") {
			return $this->db->where("id",$id)->delete("ls_app_object_items");
		} else if ($cmd=="view") {
			if($row=$this->db->where("id",$id)
				->get("ls_app_object_items")->row()){
				$data=(array)$row;
				$data['success']=true;
				echo json_encode($data);
			}				
			
		} else {
			$sql="select * from ls_app_object_items where app_id='".$app_id."'";
			echo datasource($sql);
		}
	}
	function add_item(){
		$data=$this->input->post();
		
		$id=$data['frmAddItem_Id'];
		$dt['app_id']=$data['frmAddItem_AppId'];
		$dt['obj_id']=$data['item_no'];
		$dt['description']=$data['desc'];
		$dt['qty']=$data['qty'];
		$dt['price']=$data['price'];
		$dt['amount']=$data['qty']*$data['price'];
		if($id==""){
			$ok=$this->db->insert('ls_app_object_items',$dt);
		} else {
			$ok=$this->db->where("id",$id)->update('ls_app_object_items',$dt);
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}
	function get_dp_percent($amount){
		return $this->app_master_model->get_dp_percent($amount);
	}
	function get_bunga_percent($loan_amount){
		return $this->app_master_model->get_bunga_percent($loan_amount);
	}
	
	function calc_loan(){
		$price=$this->input->get("price");
		$tenor=$this->input->get("tenor");
		if($tenor==0)$tenor=3;
		if($price>0){
			$dp=$this->get_dp_percent($price);
			$dp_amount=(double)round($price*$dp);
			$aft_dp=$price-$dp_amount;
			$bunga=$this->get_bunga_percent($aft_dp);
			$bunga_amount=(double)round($bunga*$aft_dp);
			$loan_amount=$aft_dp/$tenor;
			$aft_tenor=$aft_dp*$bunga;
			$angsuran=$aft_tenor+$loan_amount;
			$admin=getvar("admin",100000);;
			$asuransi=0;
			$data=array("success"=>true,"dp"=>$dp,"dp_amount"=>$dp_amount,"bunga"=>$bunga,
				"bunga_amount"=>$bunga_amount,"admin"=>$admin,
				"asuransi"=>$asuransi,"angsuran"=>$angsuran);
			echo json_encode($data);
		} else {
			echo json_encode(array("success"=>false,"dp"=>0,"dp_amount"=>0,
			"bunga"=>0,"bunga_amount"=>0,"admin"=>0,"asuransi"=>0,"angsuran"=>0));
		}
	}
	function _recalc($nomor=''){
		$nomor=urldecode($nomor);
		$data=$this->app_master_model->recalc($nomor);
		return $data;
	}
	function recalc($nomor){
		$data=$this->_recalc($nomor);
		echo json_encode($data);
	}
	function print_app($app_id){
		$this->load->helper("pdf_helper");
		$obj_pdf=tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
//		$title = "PDF Report";
//		$obj_pdf->SetTitle($title);
//		$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
			// we can have any view part here like HTML, PHP etc
		$data="";
        $this->load->view("leasing/rpt/app_form",$data);    	
		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, true, false, true, false, '');
		$obj_pdf->Output('output.pdf', 'I');
	}
	function approve($app_id=""){
		$data['approved']='1';
		$data['status']='Wait Contract';
		$app_id=$this->input->get("app_id");
		$reason=$this->input->get("reason");
		$ok=$this->db->where("app_id",$app_id)->update($this->table_name,$data);
		if($ok){
			$message="Sukses nomor aplikasi $app_id sudah di setujui untuk dibuatkan akad kredit. 
			Catatan: $reason";
			$from=user_id();
			$app=$this->db->select("create_by,cust_id")->where("app_id",$app_id)
				->get("ls_app_master")->row();
			$to_user=$app->create_by;
			$cust=$this->db->where("cust_id",$app->cust_id)->get("ls_cust_master")->row();
			
			// send inbox ke user sa
			inbox_send($from,$to_user,$app_id." - Approved, Debitur: $cust->cust_name",$message);

			// send inbox ke user adminls
			$to_user=$this->access->user_with_job(array("admls","lsadm"));
			
			inbox_send($from,$to_user,$app_id." - Approved, Debitur: $cust->cust_name",$message);
			
			echo $message;
			
		} else {
			echo "Ada kesalahan update data aplikasi";
		}
	
	}
	function filter($id=""){
		//untuk user admls field CID diisi dengan area
		$sql="select a.app_id,a.app_date,b.cust_name,a.status, c.area,c.area_name, b.cust_id,b.kec,b.kel
		,a.counter_id,c.counter_name,a.loan_amount,a.inst_month
		,a.create_by as sales_id,u.username as sales_name
		from ls_app_master a left join ls_cust_master b on b.cust_id=a.cust_id 
		left join ls_counter c on c.counter_id=a.counter_id 
		left join `user` u on u.user_id=a.create_by
		where a.approved=1 and a.status not in ('Finish','Close','Kontrak Batal')";
		if( !($this->access->cid=="" or $this->access->cid=='ALL') )$sql.=" and (c.area='".$this->access->cid."' or c.area_name='".$this->access->cid."')";
		if($id!=""){
			$sql.=" and (a.app_id like '".$id."%' or b.cust_name like '%".$id."%')";
		}
		$sql.= " order by a.app_date";
		echo datasource($sql);	
	}
	function not_recomended(){
		$app_id=$this->input->get("app_id");
		$reason=$this->input->get("reason");
		$data['status']='Not Recomended';
		if($this->db->where("app_id",$app_id)->update("ls_app_master",$data)){
			$from=user_id();
			$to_user=$this->db->select("create_by")->where("app_id",$app_id)
				->get("ls_app_master")->row()->create_by;
			inbox_send($from,$to_user,$app_id." - Not Recomended",
				"Nomor Aplikasi: $app_id tidak setujui $from , dengan alasan $reason"); 
			echo "Sukses, status aplikasi sudah diberitahukan ke sales agentnya. Silahkan close dan refresh.";
		} else {
			echo "Ada kesalahan !";
		}	
	}
	
}
?>
