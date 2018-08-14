<?php 
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Payment extends CI_Controller {
    private $limit=100;
    private $table_name='ls_invoice_header';
    private $file_view='leasing/payment';
    private $controller='leasing/payment';
    private $primary_key='invoice_number';
    private $sql="";
	private $title="DAFTAR PEMBAYARAN CICILAN";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->controller=="")$this->controller=$this->file_view;
		if($this->sql=="")$this->sql="select * from ".$this->table_name;
		if($this->help=="")$this->help=$this->table_name;
		$this->load->model('leasing/payment_model');
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
		 if ($this->form_validation->run()=== TRUE){
				$data=$this->get_posts();
				$this->loan_master_model->save_payment($data);
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
		$id=$this->input->post("loan_id");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->payment_model->save($data);
		} else {
			$ok=$this->payment_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}
	function update() {
		$data=$this->input->post();
		 
		$data['success']=false;
		$id=$data['frmPayment_id'];
		if( $id != '' ){
			$data['denda']=$data['denda_paid'];
			unset($data['denda_paid']);
			$data['bunga']=$data['bunga_paid'];
			unset($data['bunga_paid']);
			$data['pokok']=$data['pokok_paid'];
			unset($data['pokok_paid']);
			$id=$data['frmPayment_id'];
			unset($data['frmPayment_id']);
			unset($data['success']);
			$this->db->where('id',$id)->update('ls_invoice_payments',$data);
			$data['success']=true;
		}
		echo json_encode($data);
	}
    function view($id,$message=null)	{
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
		$data['field_key']=$this->primary_key;
		 
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
		$data['fields']=array("loan_id","app_id","loan_date","loan_amount","max_mount","status","cust_id");
		$data['fields_caption']=array("Kode","AppId","Tanggal","Jumlah","Tenor","Status","Pelanggan");
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Pelanggan","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get("sid_nama"))$sql .= " and description like '%".$this->input->get("sid_nama")."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->payment_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $table_name where loan_id='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function load_by_id($id) {
		$id=urldecode($id);
		$data['success']=false;
		if($q=$this->db->where('id',$id)->get('ls_invoice_payments')){
			if($q->num_rows()){
				$data=$q->row_array();
				$data['success']=true;
			}
		} 
		echo json_encode($data);
	}
	function add_payment($faktur,$data){

		$this->load->model("leasing/invoice_header_model");
		$this->load->model("leasing/payment_model");

		$faktur=urldecode($faktur);

		$ok = $this->payment_model->save($data);
		
		$ok = $this->invoice_header_model->recalc_saldo($faktur);
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}		
		
		
	}
	function import_csv(){
		echo "<h1>HALOOOO</h1>";
		if($this->input->post("submit")){
			 $filename=$_FILES["file_excel"]["tmp_name"];
			 $this->form_validation->set_rules('nomor','Jenis','required');
			 $this->form_validation->set_rules('jenis','Jenis','required');
			 $this->form_validation->set_rules('tanggal','Tanggal','required');
			 $this->form_validation->set_rules('jumlah','Jumlah','required');
			 $this->form_validation->set_rules('keterangan','Keterangan','required');
			 
			 if ($this->form_validation->run()=== TRUE AND $_FILES["file_excel"]["size"] > 0){
				$col=$this->input->post();
				$file = fopen($filename, "r");
				$i=0;
				$ok=false;
				$this->load->model("leasing/invoice_header_model");
				$this->load->model("leasing/payment_model");
				while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
				{
					$nomor=$emapData[$col['nomor']-1];
					$jenis=$emapData[$col['jenis']-1];
					$tanggal=$emapData[$col['tanggal']-1];
					$jumlah=$emapData[$col['jumlah']-1];
					$keterangan=$emapData[$col['keterangan']-1];
					if($i>0){	// baris pertama header
						$tanggal=date('d/m/Y H:i:s',strtotime($tanggal));
						$data=array("how_paid"=>$jenis,"date_paid"=>$tanggal,
							"amount_paid"=>$jumlah,"voucher_no"=>"IMPCSV".$nomor, 
							"invoice_number"=>$nomor,"pokok"=>0,"bunga"=>0);
						 $ok = $this->payment_model->save($data);
						 $ok = $this->invoice_header_model->recalc_balance($nomor);
						
					}
					$i=1;
				}
				fclose($file);
				if ($ok){echo json_encode(array("success"=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
			} else {
				$this->template->display("leasing/payment_import_csv");
			}
		} else {
			$this->template->display("leasing/payment_import_csv");
		}
	}
	function import_csv_bca(){
		if($this->input->post("submit")){
			 $filename=$_FILES["file_excel"]["tmp_name"];
			 $this->form_validation->set_rules('kode_per','Kode Perusahaan','required');
			 $this->form_validation->set_rules('cust_id','Nomor Pelanggan','required');
			 $this->form_validation->set_rules('tanggal','Tanggal','required');
			 $this->form_validation->set_rules('jumlah','Jumlah','required');
			 
			 if ($this->form_validation->run()=== TRUE AND $_FILES["file_excel"]["size"] > 0){
				$col=$this->input->post();
				$file = fopen($filename, "r");
				$i=0;
				$this->load->model("leasing/invoice_header_model");
				$this->load->model("leasing/payment_model");
				$msg='';
				while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
				{
					if ( $i == 0 ) {
						// baris pertama judul gak usah dimasukkan ke database
						$i++;
					} else {
						$ok=false;
						$jenis='Trans In';
						$kode_per=$emapData[$col['kode_per']-1];
						$kode_sub=$emapData[$col['kode_sub']-1];
						$cust_id=$emapData[$col['cust_id']-1];
						$cust_name=$emapData[$col['cust_name']-1];
						$curr_code=$emapData[$col['curr_code']-1];
						$jumlah=$emapData[$col['jumlah']-1];
						$tanggal=$emapData[$col['tanggal']-1];
						$waktu=$emapData[$col['waktu']-1];
						$lokasi=$emapData[$col['lokasi']-1];
						$berita1=$emapData[$col['berita1']-1];
						$berita2=$emapData[$col['berita2']-1];
						$loan_id=str_pad($kode_per, 5, "0", STR_PAD_LEFT).str_pad($cust_id, 6, "0", STR_PAD_LEFT);
						$newDate = explode( "/" , $tanggal);
						$tanggal = $newDate[1]."/".$newDate[0]."/".$newDate[2];
						$tanggal = $tanggal." ".$waktu;
						$nomor="IMPCSV".$cust_id.date("Ymd",strtotime($tanggal));
						//$nomor.="_".$filename;
						//$faktur='';	$bulan=$newDate[1]; $tahun=$newDate[2];				
						$jumlah=$jumlah+$this->last_titipan_loan($loan_id);
						$this->payment_model->paid_all($loan_id,$tanggal,$nomor,$jumlah,'Trans In');
					}
				}
				fclose($file);
				if ($msg==''){
					//echo json_encode(array("success"=>true));
					echo 'Success';
				} else {
					echo $msg;
					//echo json_encode(array("success"=>false,'msg'=>$msg));
				}
				// END PROSES
			} else {
				$this->template->display("leasing/payment_import_csv_bca");
			}
		} else {
			$this->template->display("leasing/payment_import_csv_bca");
		}
	}
	function last_titipan_loan($loan_id)
	{
		$retval=0;
		if($q=$this->db->select('idx_month')->where('loan_id',$loan_id)
		->where('paid',false)
		->order_by('idx_month')->get('ls_invoice_header'))
		{
			if($r=$q->row())
			{
				$idx_month=$r->idx_month;
				$idx_month=$idx_month-1;
				if($idx_month>0)
				{
					if($prev_inv=$this->db->select("loan_id,date_paid,voucher,invoice_number,saldo")
						->where("loan_id",$loan_id)
						->where("idx_month",$idx_month)
						->get("ls_invoice_header")->row())
					{ 
						$retval=$prev_inv->saldo;
						 
						if($retval>0){
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
			}
		}
		return $retval;
		
	}
	function kwitansi($invoice_number){
		$invoice_number=urldecode($invoice_number);
		$id=$this->db->select("id")->where("invoice_number",$invoice_number)->get('ls_invoice_payments')->row()->id;
		$this->kwitansi_by_id($id);
	}
	function kwitansi_by_id($id){
		$id=urldecode($id);
		
		$pay=$this->db->where("id",$id)->get("ls_invoice_payments")->row();
		$invoice_number=$pay->invoice_number;
		if($invoice_number==""){
			echo "Invoice Numbering is empty !";
			return false;
		}  
		$count_payment=$this->db->where('invoice_number',$invoice_number)
			->get("ls_invoice_payments")->num_rows();
 
		if($row=$this->db->where("invoice_number",$invoice_number)
			->get("ls_invoice_header")->row()){
			$rcust=$this->db->select("cust_name,street")->where("cust_id",$row->cust_deal_id)
			->get("ls_cust_master")->row();
			$nama=$rcust->cust_name;
			$alamat=$rcust->street;
			$z_pay=$this->db->query("select sum(amount_paid) as z_pay from ls_invoice_payments 
			where invoice_number='$invoice_number'")->row()->z_pay;
			$sisa=$this->db->select("count(1) as cnt")->where("loan_id",$row->loan_id)
			->get("ls_invoice_header")->row()->cnt;
			$total_tagih=$row->amount-$row->saldo_titip;
			$saldo=$total_tagih-$z_pay;
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
			echo "<table><tr><td colspan='2'><strong>TANDA TERIMA ANGSURAN<strong></td></tr>";
			echo " 
			 
			<tr><td>Nomor Tagihan </td><td>$row->invoice_number </td></tr>
			<tr><td>Tanggal </td><td>".Date("Y-m-d H:i:s")."</td></tr>
			<tr><td>Nama Debitur </td><td>$nama </td></tr>
			<tr><td>Alamat  </td><td>$alamat </td></tr>
			<tr><td>Tanggal Jatuh Tempo </td><td>".Date('Y-m-d',strtotime($row->invoice_date))."</td></tr>
			<tr><td>Angsuran Ke:  </td><td>$row->idx_month, Dari : $sisa </td></tr>
			<tr><td>1. Saldo Bulan Lalu Rp. </td><td> ".number_format($row->saldo_titip,2,".",",")."</td></tr>
			<tr><td>2. Denda Rp. </td><td> ".number_format($row->denda,2,".",",")."</td></tr>
			<tr><td>3. Administrasi Rp. </td><td> ".number_format($row->admin_amount,2,".",",")."</td></tr>
			<tr><td>4. Tagihan Rp. </td><td> ".number_format($row->amount,2,".",",")."</td></tr>
			<tr><td>5. Jumlah Tagihan (1+4) Rp. </td><td> ".number_format($total_tagih,2,".",",")."</td></tr>
			<tr><td><strong>Total Diterima Rp. </strong></td><td><strong> ".number_format($row->amount_paid,2,".",",")."<strong></td></tr>
			 
			
			";
			
			//if($q=$this->db->where("invoice_number",$invoice_number)
			//	->get("ls_invoice_payments")){
			//	foreach($q->result() as $pay) {
				echo "
				<tr><td>Nomor Kwitansi </td><td> ".$pay->voucher_no."</td></tr>
				<tr><td>Tanggal</td><td> ".date("Y-m-d H:i:s",strtotime($pay->date_paid))."</td></tr>
				<tr><td>Jumlah Bayar Kwitansi Rp. </td><td> ".number_format($pay->amount_paid,2,".",",")."</td></tr>";
			//	}
			//
			//}<tr><td colspan='2'>=======================================</td></tr>
			echo "<tr><td><strong>Sisa Tagihan Rp. </strong></td><td><strong> ".number_format($saldo,2,".",",")."</strong></td></tr>";
			echo "<tr><td>ID Petugas: </td><td>".$pay->create_by." </td></tr>";
			echo "<tr><td>Yang menerima </td><td> </td></tr>";
			echo "</table>";
			echo "</div>";
		}
		
	}
	function not_used()
	{
		/*
						if($query=$this->db->query("select invoice_number,paid 
							from ls_invoice_header
							where loan_id='$loan_id' 
							and year(invoice_date)<=$tahun and month(invoice_date)<=$bulan
							and (paid=0 or paid is null)
							order by  idx_month limit 1"))
							
						{
							//var_dump($query->num_rows());
							$rst=$query->row();
							if($rst){
								//ok data faktur bulan ini belum dibayar
								$ok=true;
								$faktur=$rst->invoice_number;
							} else {
								//faktur sudah dibayar bulan  ini
								$msg.="</br>".$loan_id." - bulan ".$bulan." sudah ada pembayaran ! ";
								// kalo gak ketemu bulannya ?
								// cari bulan sebelumnya yg belum bayar
								if($bulan==1){
									$bulan=12;
									$tahun=$tahun-1;
								} else {
									$bulan=$bulan-1;
								}
								// cari lagi bulan sebelumnya
								if($query=$this->db->select("invoice_number,voucher")
									->where('voucher',null)
									->where('loan_id',$loan_id)
									->where('year(invoice_date)='.$tahun.' and month(invoice_date)='.$bulan)
									->order_by('idx_month')->get('ls_invoice_header'))
								{
									if($rst=$query->row()){
										$voucher=$rst->voucher;
										if($voucher<>''){
											$ok=false;
											$msg.="</br>".$loan_id." - bulan ".$bulan." juga sudah bayar !";
										} else {
											// ok this month, save !
											$ok=true;
											$faktur=$rst->invoice_number;
										}
									} 								
								}
							}
						} 
						if($ok) {
							//load invoice_header,.. denda_tagih problem karena tanggal sistim
							//problemnya ketika load pertama tanggal sistim 
							//ketika setelah upload ternyata tanggal bayar bca beda 
							//ini bakal jadi masalah $tangggal
							$this->invoice_header_model->recalc_hari_telat($faktur,false,$tanggal);
							$this->invoice_header_model->recalc_saldo($faktur);
							$inv=$this->db->select("denda_tagih,bunga,pokok,hari_telat")->where("invoice_number",$faktur)
								->get("ls_invoice_header")->row();
							$data=array("how_paid"=>$jenis,"date_paid"=>$tanggal,
								"amount_paid"=>$jumlah,"voucher_no"=>$nomor, 
								"invoice_number"=>$faktur,"pokok"=>$inv->pokok,"bunga"=>$inv->bunga,
								"denda"=>$inv->denda_tagih); 
							//denda jgan dulu masuk karena blm tentu itu nilanya $inv->denda_tagih
							// denda_tagih berubah dengan hari_telat karena pakai tanggal bayar
							 $this->payment_model->save($data);
							 $this->invoice_header_model->recalc_saldo($faktur);
							 //-- masih salah recalc_balance $this->invoice_header_model->recalc_balance($faktur);
						}
	*/
	}
}
?>
