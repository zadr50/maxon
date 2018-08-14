<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Loan extends CI_Controller {
    private $limit=100;
    private $table_name='ls_loan_master';
    private $file_view='leasing/loan';
    private $controller='leasing/loan';
    private $primary_key='loan_id';
    private $sql="";
	private $title="DAFTAR KONTRAK KREDIT";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		if($this->help=="")$this->help=$this->table_name;
		
		$this->load->model('leasing/loan_master_model');
		$this->load->model('leasing/invoice_header_model');
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index(){
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
				$this->loan_master_model->save($data);
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
				$data['sales_name']='';
				$data['sales_id']='';
				
				$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("loan_id");
		$mode=$data["mode"];	unset($data['mode']);
		$app_id=$data['app_id'];
		$spk=$this->db->select('dp_amount,admin_amount')
			->where("app_id",$app_id)->get("ls_app_master")->row();
		if($spk){
			$data['adm_amount']=$spk->admin_amount;
			$data['dp_amount']=$spk->dp_amount;
		} else {
			$data['adm_amount']=0;
			$data['dp_amount']=0;			
		}
		if($mode=="add"){ 			
			$ok=$this->loan_master_model->save($data);
		} else {
			$data['loan_id']=$id;
			unset($data['app_id']);
			$ok=$this->loan_master_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error atau loan_id sudah ada."));
		}
	}	
    function view($id,$message=null){
		$id=urldecode($id);
		$message=urldecode($message);
		$data[$this->primary_key]=$id;
		$model=$this->loan_master_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;
		
		$data['mode']='view';
		$data['message']=$message;
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['form_controller']=$this->controller;
		$data['sales_name']="";
		$data['sales_id']="";
		if($query=$this->db->query("select a.create_by,u.username 
			from ls_app_master a 
			left join `user` u on a.create_by=u.user_id 
			where a.app_id='".$data['app_id']."'")){
			if($row=$query->row()){
				$data['sales_id']=$row->create_by;
				$data['sales_name']=$row->username;
			}
		}
		
		$data['field_key']=$this->primary_key;
		//$this->loan_master_model->calc_hari_telat($id);
		//$this->loan_master_model->update_all_invoice_with_query($id);
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
		$data['fields']=array("cust_name","loan_date","loan_id","loan_amount",
		"max_month","inst_amount","dealer_name","dealer_id","status");
		$data['fields_caption']=array("Pelanggan","Tanggal","Nomor Akad","Jumlah"
		,"Tenor","Angsuran","Counter","Counter Id","Status");
		$data['fields_format_numeric']=array("loan_amount","inst_amount");
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Pelanggan","sid_nama");
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Kontrak","sid_number");
		$data['criteria']=$faa;
		$data['other_menu']="leasing/loan_menu";
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$s="select c.cust_name,l.loan_date,l.loan_id,l.loan_amount,l.max_month,
		l.inst_amount,l.dealer_name,l.dealer_id,l.status
		from ls_loan_master l 
		left join ls_cust_master c on c.cust_id=l.cust_id ";
        $s .= ' where 1=1';
		$no=$this->input->get('sid_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
		if($no!=''){
			$s.=" and l.loan_id='".$no."'";
		} else {
			$s.=" and l.loan_date between '$d1' and '$d2'";
		}		
		if($this->input->get("sid_nama"))$s .= " and c.cust_name like '%".$this->input->get("sid_nama")."%'";
        echo datasource($s);
    }	   
	function delete($id){
		$id=urldecode($id);
		if($this->loan_master_model->delete($id)){
			$this->browse();
		} else {
			echo "<div class='alert alert-warning'><h2>Sudah ada pembayaran tidak bisa dihapus !</div>";
		}
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $this->table_name where loan_id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function items($loan_id,$id=''){
		$cmd=$loan_id;
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
			$sql="select * from ls_loan_obj_items where loan_id='".$loan_id."'";
			echo datasource($sql);
		}
	}	
	function proses(){
		$data['old_loan_id']=$this->input->post("frmLoanProses_loan_id");
		$data['new_loan_id']=$this->input->post("loan_id_new");
		$data['loan_date']=$this->input->post("tgl_tagih");
		if($this->db->where("loan_id",$data['new_loan_id'])->get("ls_loan_master")->num_rows()){
			echo json_encode(array("success"=>true,"exist"=>true));
		} else {
			$ok=$this->loan_master_model->proses_kredit($data);
			if($ok){
				echo json_encode(array("success"=>true));
			} else {
				echo json_encode(array("msg"=>"Error ".mysql_error()));
			}		
		}
	}
	function invoice($loan_id){
		echo datasource("select invoice_number,invoice_date,idx_month,
		amount-coalesce(saldo_titip,0) as amount2,amount,pokok,bunga,denda_tagih,
		paid,date_paid,amount_paid,pokok_paid,bunga_paid,denda,
		saldo,voucher,payment_method,saldo_titip,hari_telat
		from ls_invoice_header where loan_id='".$loan_id."' 
		order by invoice_date");
	}
	function list_all($search){
		$search=urldecode($search);
		$s="select c.cust_id,cust_name,i.invoice_number, i.invoice_date, 
		i.idx_month,i.amount,i.paid,i.voucher,i.amount_paid,i.payment_method,i.date_paid,i.hari_telat,
		i.bunga,i.pokok,i.bunga_paid,i.pokok_paid,i.denda_tagih,i.denda,i.saldo,i.saldo_titip,
		i.amount-coalesce(i.saldo_titip,0) as amount2
		from ls_invoice_header i left join ls_cust_master c on c.cust_id=i.cust_deal_id 
		where (i.loan_id='".$search."' or cust_name like '%".$search."%') 
		order by i.invoice_number LIMIT 100";
		echo datasource($s);	
	}
	function list_not_paid($search){
		$search=urldecode($search);
		 
		$s="select distinct loan_id from ls_invoice_header i 
		join ls_cust_master c on c.cust_id=i.cust_deal_id 
		where i.paid=0 and (c.cust_name like '%".$search."%' or i.loan_id='$search') ";
		//	and  month(invoice_date) = ".date("m")." 
		//	AND year(invoice_date) = ".date("Y");
		if($query=$this->db->query($s)){
			foreach($query->result() as $inv){
				$this->loan_master_model->calc_hari_telat($inv->loan_id); 				
			}
		} 
		$s="select c.cust_id,cust_name,i.invoice_number, i.invoice_date, 
		i.idx_month,i.amount,i.paid,i.voucher,i.amount_paid,i.payment_method,i.date_paid,i.hari_telat,
		i.bunga,i.pokok,i.bunga_paid,i.pokok_paid,i.denda_tagih,i.denda,i.saldo,i.saldo_titip,
		i.amount-coalesce(i.saldo_titip,0) as amount2
		 from ls_invoice_header i left join ls_cust_master c on c.cust_id=i.cust_deal_id 
		where paid=0 and  (cust_name like '%".$search."%'  or i.loan_id='$search') 
		order by i.invoice_number 
		LIMIT 100";
		echo datasource($s);		
	}
	function pay_with_titipan($jumlah,$base_faktur,$tgl)
	{
		$this->load->model("leasing/invoice_header_model");
		$this->load->model("leasing/payment_model");
		$retval=0;
		if($curr_inv=$this->db->select("loan_id,idx_month")->where("invoice_number",$base_faktur)
		->get("ls_invoice_header")->row())
		{
			$prev_idx_month=$curr_inv->idx_month-1;
			if($prev_idx_month>0)
			{
				if($prev_inv=$this->db->select("loan_id,date_paid,voucher,invoice_number")
					->where("loan_id",$curr_inv->loan_id)
					->where("idx_month",$prev_idx_month)
					->get("ls_invoice_header")->row())
				{ 
					 
					$retval=$this->payment_model->paid_all($prev_inv->loan_id,
						$tgl,$prev_inv->voucher,
						$jumlah,'Cash');
					//perlu diubah payment versi yg lalu
					$this->db->query("update ls_invoice_payments 
						set amount_paid=denda+pokok+bunga 
						where voucher_no='".$prev_inv->voucher."'");
					//perlu diubah juga invoice yg lalu 
					$this->invoice_header_model->recalc_saldo(
						$prev_inv->invoice_number,true);
				}
			}
		}				
		return $retval;
	}
	function add_payment($faktur){
		
		
		$this->load->model("leasing/invoice_header_model");
		$this->load->model("leasing/payment_model");

		$faktur=urldecode($faktur);

		$tgl=$this->input->post('date_paid');
		$next_number="P".$faktur.date("d",strtotime($tgl));
		$saldo_titip=$this->input->post('saldo_titip');
		$amount_paid=$this->input->post('amount_paid');
		 
		
		$id=0; 
		if($saldo_titip>0) { // bulan lalu ada bayar lebih ?
			$id=$this->pay_with_titipan($saldo_titip,$faktur,$tgl);
			$amount_paid=$amount_paid-$saldo_titip;
			$saldo_titip=0;
		}
		//baru bayar dg amount_paid sekarang
		$loan_id=$this->db->select("loan_id")->where("invoice_number",$faktur)
		->get("ls_invoice_header")->row()->loan_id;
		$id=$this->payment_model->paid_all(
				$loan_id,$tgl,$next_number,
				$amount_paid,$this->input->post('how_paid')
			);
/*		else {
			$max_id=$this->db->query("select max(id) as nmax from ls_invoice_payments")->row()->nmax;
			$max_id=$max_id+1;
			$next_number="P".$faktur."-".$max_id;
			//masuk ke tabel ls_invoice_payment sekaligus update ls_invoice_header
			$amount=$this->db->select('amount')->where('invoice_number',$faktur)
				->get('ls_invoice_header')->row()->amount;
			$data['saldo_titip']=$saldo_titip;
			$data["invoice_number"]=$faktur;
			$data["amount_paid"]=$amount_paid;
			$data["denda"]=$this->input->post("denda");
			$data["pokok"]=$this->input->post("pokok");
			$data["bunga"]=$this->input->post("bunga");
			$data['date_paid']=$tgl;
			$data['how_paid']=$this->input->post('how_paid');
			$data['voucher_no']=$next_number;
			$id = $this->payment_model->save($data);		
			$ok = $this->invoice_header_model->recalc_saldo($faktur);
		}
*/		
		if($id){
			echo json_encode(array("success"=>true,"id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}		
	}
	function tagih($invoice_no,$id){
		$invoice_no=urldecode($invoice_no);
		$data['invoice_no']=$invoice_no;
		if($this->input->post('submit')){
			$d1=$this->input->post("visit_date");
			$d1=date("Y-m-d H:i:s",strtotime($d1));	
			$data['visit_date']=$d1;
			$data['visit_notes']=$this->input->post("visit_notes");
			$data['visited']='1';
			$data['visit_ke']=$this->input->post("visit_ke");
			$this->db->where("invoice_no",$invoice_no)
					 ->where("id",$id)->update("ls_loan_col_sched",$data);
			//update ke visit_count billing
			$cnt=$this->db->query("select count(1) as cnt from ls_loan_col_sched 
				where invoice_no='".$invoice_no."'")->row()->cnt;
			$this->db->where("invoice_number",$invoice_no)->update("ls_invoice_header",
				array("visit_count"=>$cnt));
			$data['message']="Data sudah tersimpan silahkan close tab ini atau refresh.";
		} else {
			$data['message']="";
			$data['invoice_no']=$invoice_no;
			$lok=false;
			if($query=$this->db->query("select h.*,m.cust_name,m.street from ls_invoice_header h 
				left join ls_cust_master m on m.cust_id=h.cust_deal_id
				where invoice_number='$invoice_no'  and paid=0 ")){
				if($row=$query->row()){
					$data['invoice_date']=$row->invoice_date;
					$data['amount']=$row->amount;
					$data['cust_deal_id']=$row->cust_deal_id;
					$data['cust_name']=$row->cust_name;
					$data['street']=$row->street;
					$data['pokok']=$row->pokok;
					$data['bunga']=$row->bunga;
					$data['denda']=$row->denda;
					$data['idx_month']=$row->idx_month;
					$data['loan_id']=$row->loan_id;
					$data['hari_telat']=$row->hari_telat;
					$data['visit_ke']=$row->visit_count;
					$data['id']=$id;
					$lok=true;
				}
			}
			if(!$lok){
				$data['message']='Nomor faktur '.$invoice_no.' tidak ditemukan mungkin sudah bayar.';
			}
		}
		$this->template->display("leasing/kolektor_proses",$data);
	}
	function list_outstand($search_text){
		$search_text=urldecode($search_text);
		$s="select l.loan_id,l.loan_date,l.cust_id,c.cust_name,
		l.dealer_id,l.dealer_name,l.loan_amount,l.last_idx_month,
		l.last_amount_paid,l.total_amount_paid,l.ar_bal_amount
		from ls_loan_master l 
		left join ls_cust_master c on c.cust_id=l.cust_id 
		where (l.paid=0 or l.paid is null) and (l.status=1)";
		if($search_text!="")$s.=" and (l.loan_id='$search_text' 
		or c.cust_name like '%$search_text%') 
		"; 
		if($query=$this->db->query($s)){
			if($query->num_rows()){
				$t="<table class='table2'><thead><th>Loan Id</th>
				<th>Tanggal</th><th>Customer</th><th>Dealer</th>
				<th>Pinjaman Rp.</th><th>Bulan Ke</th><th>Pelunasan Rp.</th>
				<th>Saldo</th><th>Saldo Pokok</th><th>Action</th></thead><tbody>";
				foreach($query->result() as $row){
					
					$saldo_pokok=0;
					$sql="select sum(coalesce(q.pokok,0)-coalesce(z_pokok_paid,0))  as saldo_pokok
					from qry_ls_inv_pay_sum q 
					left join ls_invoice_header h on h.invoice_number=q.invoice_number
					where h.loan_id='$row->loan_id'";

					if($q=$this->db->query($sql)){
						$saldo_pokok=$q->row()->saldo_pokok;
					}
					$t.="<tr><td>".$row->loan_id."</td>
					<td>".$row->loan_date."</td><td>".$row->cust_name."</td>
					<td>".$row->dealer_name."</td><td cellalgin='right'>".number_format($row->loan_amount)."</td>
					<td>".$row->last_idx_month."</td><td cellalign='right'>".number_format($row->total_amount_paid)."</td>
					<td cellalign='right'>".number_format($row->ar_bal_amount)."</td>
					<td cellalign='right'>".number_format($saldo_pokok)."</td>
					<td><input style='width:100px'  type='button' class='btn btn-info' value='View'
					onclick=\"view_loan('".$row->loan_id."');return false;\" >
					<input style='width:100px' type='button' class='btn btn-warning' value='Bayar'
					onclick=\"dlgBayar_Show('".$row->loan_id."');return false;\" >					
					</tr>";
				}
				$t.="</tbody></table>";
				echo $t;
			} else {
				echo "Data tidak ditemukan !";
			}
		}
	}
	function view_summary($loan_id){
		$loan_id=urldecode($loan_id);
	}
	function unposting($loan_id) {
		$message=$this->loan_master_model->unposting($loan_id);
		$this->view($loan_id,$message);
	}
	function posting($loan_id) {
		$message=$this->loan_master_model->posting($loan_id);
		$this->view($loan_id,$message);
	}
	function tagih_view($invoice_no){
		$invoice_no=urldecode($invoice_no);
		$data['invoice_no']=$invoice_no;
		$data['message']="";
		$data['invoice_no']=$invoice_no;
		$lok=false;
		$sql="select lcs.*,h.*,m.cust_name,m.street from ls_invoice_header h 
			left join ls_cust_master m on m.cust_id=h.cust_deal_id 
			left join ls_loan_col_sched lcs on lcs.invoice_no=h.invoice_number
			where invoice_number='$invoice_no'";
		 
		if($query=$this->db->query($sql)){
			if($row=$query->row()){
				$data['invoice_date']=$row->invoice_date;
				$data['amount']=$row->amount;
				$data['cust_deal_id']=$row->cust_deal_id;
				$data['cust_name']=$row->cust_name;
				$data['street']=$row->street;
				$data['pokok']=$row->pokok;
				$data['bunga']=$row->bunga;
				$data['denda']=$row->denda;
				$data['idx_month']=$row->idx_month;
				$data['loan_id']=$row->loan_id;
				$data['hari_telat']=$row->hari_telat;
				$data['visit_ke']=$row->visit_ke;
				$data['visit_date']=$row->visit_date;
				$data['visit_notes']=$row->visit_notes;
				$data['amount_col']=$row->amount_col;
				$data['collected']=$row->collected;
				$data['promise_date']=$row->promise_date;
				$data['id']=$row->id;
				$lok=true;
			}
		}
		if(!$lok){
			$data['message']='Nomor faktur '.$invoice_no.' tidak ditemukan mungkin sudah bayar.';
		}
		
		$this->template->display("leasing/kolektor_view",$data);
	}
	function change_date_aggr($loan_id,$new_date) {
		$this->load->model("leasing/invoice_header_model");
		$tgl_tagih=date('Y-m-d 00:00:00', strtotime($new_date));
		$ok=$this->db->where("loan_id",$loan_id)->update("ls_loan_master", 
			array("loan_date_aggr"=>$tgl_tagih));
		$msg='Success. Silahkan refresh bila diperlukan.';
		if($q=$this->db->where("loan_id",$loan_id)->order_by("idx_month")->get("ls_invoice_header"))
		{
			foreach($q->result() as $inv) {
				$faktur=$inv->invoice_number;
				$idx_month=$inv->idx_month;
				$data['invoice_date']=add_date($tgl_tagih,0,$idx_month);
				$ok=$this->invoice_header_model->update($faktur,$data);
			}
		}
		echo json_encode(array("result"=>$ok,"message"=>$msg.mysql_error()));
	}
	function daily_process() {
		$this->loan_master_model->daily_process();
	}
	function recalc_balance_faktur($faktur){
		$this->invoice_header_model->recalc_balance($faktur);
	}
	function recreate_invoice($loan_id) {
		$loan_id=urldecode($loan_id);
		$this->loan_master_model->recreate_invoice($loan_id);
	}
	function recalc_all_invoice($loan_id){
		$loan_id=urldecode($loan_id);
		$this->loan_master_model->update_all_invoice_with_query($loan_id);
		$this->view($loan_id);
	}
    function cetak($id){
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->loan_master_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);
		$data['data']=$data;		
		$data['mode']='view';
		$data['title']=$this->title;
		$data['help']=$this->help;
		$data['sales_name']="";
		$data['sales_id']="";
		if($query=$this->db->query("select a.create_by,u.username 
			from ls_app_master a 
			left join `user` u on a.create_by=u.user_id 
			where a.app_id='".$data['app_id']."'")){
			if($row=$query->row()){
				$data['sales_id']=$row->create_by;
				$data['sales_name']=$row->username;
			}
		}
		
		$data['field_key']=$this->primary_key;
		$this->loan_master_model->calc_hari_telat($id);
		$data['items']=$this->db->where('loan_id',$id)->get('ls_loan_obj_items');
		$data['invoice']=$this->db->where('loan_id',$id)->order_by('idx_month')->get('ls_invoice_header');
		$this->template->display_form_input("leasing/loan_print",$data);
    }
	function saldo_pokok($loan_id)
	{
		$saldo_pokok=0;
		$result=false;
		$sql="select  sum(coalesce(q.pokok,0)-coalesce(z_pokok_paid,0))  as saldo_pokok
		from qry_ls_inv_pay_sum q 
		left join ls_invoice_header h on h.invoice_number=q.invoice_number
		where h.loan_id='$loan_id'";
		if($saldo_pokok=$this->db->query($sql)->row()->saldo_pokok)
		{
			$result=true;
		}
		echo json_encode(array("success"=>$result,"saldo_pokok"=>$saldo_pokok));
		
	}
}
?>
