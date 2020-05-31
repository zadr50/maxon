<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Loan_close extends CI_Controller {
    private $limit=100;
    private $table_name='ls_loan_master';
    private $file_view='leasing/loan';
    private $controller='leasing/loan';
    private $primary_key='loan_id';
    private $sql="";
	private $title="PROSES PENUTUPAN AKAD KREDIT PELANGGAN";
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
    }
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		
		$data=data_table($this->table_name,$record);
		return $data;
    }
    function index(){
		$this->add();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		$this->template->display_form_input("leasing/loan_close",$data);			
    }
	function save($loan_id){
		//close loan yang dibayar / dilunasi pokok saja
		$retval = false; 
		$loan_id=urldecode($loan_id);
		$voucher="";
		if ($loan_id != '') $retval = true;
		if ($retval) {
			$data=$this->input->post();
			$amt_paid=$data['amount_paid'];
			$amt_disc=$data['discount'];
			$method=$data['how_paid'];
			$amt_paid = $amt_paid - $amt_disc;
			 
			
			$this->load->model('leasing/payment_model');
			//load semua invoice yg belum dibayar
			$retval = $query=$this->db->select('invoice_number,pokok,pokok_paid,saldo')
				->where("loan_id",$loan_id)->where("paid",0)->order_by("idx_month","ASC")
				->get("ls_invoice_header");
			if ( $retval ) {
				foreach($query->result() as $faktur){
					$voucher="P.".$faktur->invoice_number."-".date('md');
					$saldo_pokok=$faktur->pokok-$faktur->pokok_paid;
					//+$faktur->saldo;
					if( $amt_paid<$saldo_pokok ) $saldo_pokok = $amt_paid;
					if($amt_paid>0){
						$this->payment_model->add_payment_closing(
							$faktur->invoice_number,$saldo_pokok,$data['date_paid'],
							$data['how_paid'],$data['amount_paid'],
							$voucher);
						$saldo_pokok_total=$this->db->query("select sum(pokok) as z_pokok 
							from ls_invoice_payments where invoice_number='"
							.$faktur->invoice_number."'")->row()->z_pokok;
						$this->db->where('invoice_number',$faktur->invoice_number)
							->update('ls_invoice_header', 
							array("invoice_number"=>$faktur->invoice_number,
								"pokok_paid"=>$saldo_pokok,"bunga_paid"=>0,"denda"=>0,
								"voucher"=>$voucher,"paid"=>1,"amount_paid"=>$saldo_pokok_total,
								"payment_method"=>$data['how_paid'],
								"date_paid"=>Date("Y-m-d",strtotime($data['date_paid']))));
					}
					$amt_paid=$amt_paid-$saldo_pokok;
				}
				$this->db->where('loan_id',$loan_id)->update('ls_loan_master',array('status'=>2));
			}
		}
		if($retval){
			echo json_encode(array("success"=>true,"voucher"=>$voucher));
		} else {
			echo json_encode(array("msg"=>"Error."));
		}
 	}	
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
	function kwitansi_by_id($voucher){
		$voucher=urldecode($voucher);
		if($voucher==""){
			echo "<div class='alert alert-warning'>Voucher Not found [$vcoucher]</div>";
			return false;
		}
		$pokok=0;
		$amount_paid=0;
		$rcust=null;
		$invoice_number='';
		$loan_id='';
		$create_by="";
		$amount_alloc=0;
		$finalty=0;
	if($qpay=$this->db->query("select p.amount_paid,p.amount_alloc,p.invoice_number,
		p.create_by,p.finalty 
		from ls_invoice_payments p 
		left join ls_invoice_header h on h.invoice_number=p.invoice_number 
		where h.loan_id='$voucher' and dont_calculate=true"))
		{
			foreach($qpay->result() as $pay)
			{
				if($amount_alloc==0)$amount_alloc=$pay->amount_alloc;
				if($invoice_number=='')$invoice_number=$pay->invoice_number;
				if($create_by=="")$create_by=$pay->create_by;
				$amount_paid=$amount_paid+$pay->amount_paid;
				$finalty=$finalty+$pay->finalty;
				if($rcust==null)
				{
					$rcust=$this->db->query("select c.cust_name,c.cust_id,c.street
					,h.loan_id 
					from ls_invoice_header h 
					left join ls_loan_master m on m.loan_id=h.loan_id					
					left join ls_cust_master c on c.cust_id=m.cust_id 
					where h.invoice_number='$invoice_number'")->row();
				}
			}
		}
 
		if($amount_paid>0)
		{
			$nama=$rcust->cust_name;
			$alamat=$rcust->street;
			$saldo=$amount_alloc-$amount_paid;
			$loan_id=$rcust->loan_id;
			echo "<style>
				.nota {
					font-family: sans-serif;
				} 			
				.nota table {
					font-size:12px;
				}
				.nota table tr td {
					height:8px;
				}
				
			</style>";
			echo "<div class='nota'>";
			echo "<table><tr><td colspan='2'><strong>TANDA TERIMA PENUTUPAN<strong></td></tr>";
			echo " 
			 
			<tr><td>Nomor Kontrak </td><td>$loan_id </td></tr>
			<tr><td>Nomor Kwitansi </td><td> $voucher</td></tr>
			<tr><td>Tanggal </td><td>".Date("Y-m-d H:i:s")."</td></tr>
			<tr><td>Nama Debitur </td><td>$nama </td></tr>
			<tr><td>Alamat  </td><td>$alamat </td></tr>
			<tr><td><strong>Total Diterima Rp. </strong></td><td><strong> ".number_format($amount_alloc,2,".",",")."<strong></td></tr>
			<tr><td><strong>Total Finalty Rp. </strong></td><td><strong> ".number_format($finalty,2,".",",")."<strong></td></tr>
			<tr><td><strong>Total Bayar Rp. </strong></td><td><strong> ".number_format($amount_paid,2,".",",")."<strong></td></tr>
			<tr><td><strong>Saldo/Kembali Rp. </strong></td><td><strong> ".number_format($saldo,2,".",",")."<strong></td></tr>
			";
			 
			echo "<tr><td>ID Petugas: </td><td>$create_by</td></tr>";
			echo "<tr><td>Yang menerima </td><td> </td></tr>";
			echo "</table>";
			echo "</div>";
		}
		
	}	
}
?>
