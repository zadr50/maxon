<?php
class Invoice_header_model extends CI_Model {

	private $primary_key='invoice_number';
	private $table_name='ls_invoice_header';

	function __construct(){
		parent::__construct();
		$this->load->model("periode_model");
		$this->load->model('jurnal_model');
		$this->load->model("leasing/loan_master_model");
		$this->load->model("leasing/payment_model");
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['cust_deal_id']))$nama=$_GET['cust_deal_id'];
		if($nama!='')$this->db->where("cust_deal_id like '%$nama%'");

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
		$data['invoice_date']=date('Y-m-d H:i:s', strtotime($data['invoice_date']));
		$ok=$this->db->insert($this->table_name,$data);  
		//$this->recalc_balance($data['invoice_number']);
		//$this->posting($data['invoice_number']);
		return $ok;
	}
	function update($id,$data,$with_recalc_balance=false,$with_posting=false){
		if(isset($data['invoice_date'])){
			$data['invoice_date']=date('Y-m-d H:i:s', strtotime($data['invoice_date']));
		}
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		//if($with_recalc_balance) $this->recalc_balance($id);
		//if($with_posting) $this->posting($id);
		return true;
		
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function list_not_paid_today(){
		$s="select c.cust_id,cust_name,i.invoice_number, i.invoice_date, 
		i.idx_month,i.amount,i.paid,i.voucher,i.amount_paid,i.payment_method,i.date_paid,
		i.hari_telat,i.loan_id,i.app_id,i.visit_count,i.pokok,i.bunga,i.denda_tagih,i.saldo_titip 
		from ls_invoice_header i left join ls_cust_master c on c.cust_id=i.cust_deal_id 
		where paid=0 and year(i.invoice_date)<=".date("Y")." and month(i.invoice_date)<=".date("m");
		$s.=" and i.hari_telat>0";
		$day=getvar("hari_telat",14);
		if(user_job_exist("SA")){
			$s.=" and i.hari_telat<=".$day;
		} else if(user_job_exist("COL")){
			$s.=" and i.hari_telat>".$day;
		};
		return $this->db->query($s);
	}
function posting($invoice_number,$display_error=false) {
		$gl_id=$invoice_number;
		if($this->jurnal_model->exist_gl_id($gl_id)){
			if($display_error) echo "ERR_EXIST_GLID";
			$this->unposting($gl_id);
			//return false;
		}
		if($q=$this->get_by_id($invoice_number)) {
			if($rec=$q->row()) {
				if($this->periode_model->closed($rec->invoice_date)){
					if($display_error) echo "ERR_PERIOD";
					return false;
				}
				$this->load->model('chart_of_accounts_model');
				$this->load->model('company_model');
				$this->load->model('bank_accounts_model');
				$default_account_hutang=$this->company_model->setting('accounts_payable');
				
				$date=$rec->invoice_date;
				$operation="Angsuran";
				$custsuppbank=$rec->cust_deal_id;				
 				//-- rekening kas untuk dp_amount
				$debit=$rec->amount+$rec->denda; $credit=0;
				$coa_kas=$this->bank_accounts_model->account_id('KAS');
				 
				$this->jurnal_model->add_jurnal($gl_id,$coa_kas,$date,
					$debit,$credit,$operation,"angsuran",'',$custsuppbank);
				//-- piutang usaha = sub total barang - dp
				$debit=0;$credit=$rec->pokok;
				$source="piutang usaha";
				$coa_piutang=$this->company_model->setting('accounts_receivable');			
				$this->jurnal_model->add_jurnal($gl_id,$coa_piutang,$date,
					$debit,$credit,$operation,$source,'',$custsuppbank);
				//-- jurnal bunga
				$debit=0;$credit=$rec->bunga;
				$source="pendapatan bunga";
				$coa_dapat_bunga=getvar('COA Pendapatan Bunga');			
				$this->jurnal_model->add_jurnal($gl_id,$coa_dapat_bunga,$date,
					$debit,$credit,$operation,$source,'',$custsuppbank);
				//-- jurnal denda
				if($rec->denda > 0){
					$debit=0;$credit=$rec->denda;
					$source="pendapatan denda";
					$coa_dapat_denda=getvar('COA Pendapatan denda');			
					$this->jurnal_model->add_jurnal($gl_id,$coa_dapat_denda,$date,
					$debit,$credit,$operation,$source,'',$custsuppbank);
				}
					
			}
		}
		// validate jurnal
		if($this->jurnal_model->validate($invoice_number,true)) {
			$data['posted']=true;	} else {$data['posted']=false;};
		return $this->db->where("invoice_number",$invoice_number)->update($this->table_name,$data);
	}
	function unposting($invoice_number) {
		
		$rec=$this->db->select("invoice_date")->where('invoice_number',$invoice_number)
			->get($this->table_name)->row();
		if($this->periode_model->closed($rec->invoice_date)){
			echo "ERR_PERIOD";
			return false;
		}
		// validate jurnal
		$this->load->model('jurnal_model');
		if($this->jurnal_model->del_jurnal($invoice_number)) {
			$data['posted']=false;
		} else {
			$data['posted']=true;
		}
		return $this->db->where("invoice_number",$invoice_number)->update($this->table_name,$data);
	}	
	function recalc_with_loan($loan_id)
	{
		$ok=false;
		if($q=$this->db->select("invoice_number")->where("loan_id",$loan_id)
			->where('year(invoice_date) <= year(now()) 
			and month(invoice_date)<=month(now()) and paid=0')	
			->order_by('idx_month')->get("ls_invoice_header"))	
		{
			foreach($q->result() as $row) 
			{
				$ok=false;
				$faktur=$row->invoice_number;
				if($ok=$this->recalc_hari_telat($faktur))
				{
					$ok=$this->recalc_saldo($faktur);
				}
				echo "</br>Proses: ".$faktur." ...".$ok;
			}
		}
		return $ok;
	}
	function recalc_with_loanx($loan_id){
		// hitung yang tanggal tagih kurang dari tanggal system saja
		// biar gak lemot
		//kadang ada yg inv_date tgl 30 bayar tgl 10
		$ok=false;
		if($q=$this->db->select("invoice_number,invoice_date")->where("loan_id",$loan_id)
			->where('year(invoice_date) <= year(now()) 
			and month(invoice_date)<=month(now()) and paid=0')	
			->order_by('idx_month')->get("ls_invoice_header"))	{
			foreach($q->result() as $row) {
//				if($row->invoice_date<date("Y-m-d", time())) {
					$faktur=$row->invoice_number;
					$ok=$this->recalc_hari_telat($faktur);
					$ok=$this->recalc_saldo($faktur);
					if( !$this->jurnal_model->exist_gl_id($faktur) ){
						$this->posting($faktur);
					}
//				}
			}
			//hitung saldo_titip_paid dimulai dari bulan terakhir
			$s="select invoice_number,saldo,saldo_titip,saldo_titip_paid 
			from ls_invoice_header where loan_id='$loan_id' 
			and  amount_paid>0
			order by idx_month desc";
			if($q=$this->db->query($s)){
				$start_here=false;
				foreach($q->result() as $row) {
					if($row->saldo>=0) $start_here=true;
					if($start_here){
						//hitung hanya dimulai dari saldo yang plus
						$saldo_titip_lama=$row->saldo_titip;
						$s="update ls_invoice_header  
						set paid=1,saldo_titip_paid=".(-1*$row->saldo_titip);
						$s.=" where invoice_number='".$row->invoice_number."'";						 
						$this->db->query($s);
					}
				}
			}
			$this->db->query("update ls_invoice_header set paid=0,saldo=0,saldo_titip=0  
				where loan_id='".$loan_id."' 
				and (amount_paid=0 or amount_paid is null)");
			
		}
		return $ok;
	}
	function recalc_balance_ex($faktur,$update_denda=false){
		$ok=false;
		$denda_prc=(real)getvar("denda_prc",5)*0.01;
		$denda_hari=(int)getvar("denda_hari",7);
		$inv_amount=0;		$loan_id=0;		$amt_paid=0;		$pokok=0;
		$bunga=0;			$paid=false;	$hari_telat=0;		
		$denda_tagih=0;		$denda=0;		$saldo_titip=0;		$saldo=0;		
		$invoice_date='';	$date_paid=null;	$hari_telat_invoice=0;
		$voucher=null;
		if($q=$this->db->select("invoice_date,invoice_number,loan_id,amount,
			amount_paid,pokok,bunga,paid,denda,hari_telat,date_paid,voucher,
			idx_month,saldo,denda_tagih")
			->where("invoice_number",$faktur)
			->get("ls_invoice_header")) 
		{
			if($invoice=$q->row())
			{
				$invoice_date=date('Y-m-d 23:59:59',strtotime($invoice->invoice_date));
				$loan_id=$invoice->loan_id;
				$bulan_ke=$invoice->idx_month;
				$hari_telat=0;	//$invoice->hari_telat;
				$denda_tagih=0;	//$invoice->denda_tagih;
				//tagihan
				$pokok=$invoice->pokok;
				$bunga=$invoice->bunga;				
				//pembayaran
				$amt_paid=$invoice->amount_paid;
				$paid=$invoice->paid;
				$denda=$invoice->denda;	/// field denda paid
				$saldo=$invoice->saldo;
				$denda_paid=0;
				$has_payment=false;
				/// warning pasti ada perbedaan hari telat, karena ketika upload blm ada date paid 
				/// setelah upload bisa saja tanggalnya beda dg tgl sistim
				/* gak dipakai dulu sebab ada bayar cepat dari tanggal faktur
				$date_paid=$invoice->date_paid;
				*/
				//apabila sudah ada pembayaran ambil pembayaran yg pertama
				//supaya hari telat gak dihitung lagi 
				if($qPay=$this->db->where('invoice_number',$faktur)->get('ls_invoice_payments')){
					if($qPay->num_rows()){
						if($rPay=$qPay->row()){
							$date_paid=$rPay->date_paid;
							$voucher=$rPay->voucher_no;
							$has_payment=true;
						}  
					}  
				}  
				 
				//-- hitungan denda dan hari telat
				//   jadi ada dua kemungkinan hari telat, 1.dihitung dari tglsekarang, 2.dihitung dari tgl bayar kalo udah bayar
				//   harusnya samakan aja tanggal sistim
				//   intinya sebelum ada date_paid hari telat terus menghitung
				//   hari telat yg dpakai date_sys atau date_paid
				// ---- aug-2015 hanya yang belum pembayaran 
				if($date_paid==null) {
					//$date_paid=date('Y-m-d');
					//$date_paid=date('Y-m-d',strtotime($date_paid));
					$date_sys=date('Y-m-d');
					//hitung hari telat apabila tanggal system lebih besar dari faktur
					if($invoice_date<$date_sys){
						$hari_telat=my_date_diff($invoice_date,$date_sys);
					}  
				}  else {
					if ($invoice_date<$date_paid) {
						$hari_telat=my_date_diff($invoice_date,$date_paid);
					}  
				}
				// belum dianggap hari telat apabila kurang dari 7 hari
				if($hari_telat>$denda_hari) {
					$denda_tagih=((($pokok+$bunga)*$denda_prc)/30)*$hari_telat;
				}  
				$inv_amount=$inv_amount+$denda_tagih;
				// hitung pembayaran, calculate total payment
				$pay=null;
				$sql="select sum(amount_paid) as z_amount,
					sum(bunga) as z_bunga, sum(denda) as z_denda, 
					sum(pokok) as z_pokok
					from ls_invoice_payments where invoice_number='".$faktur."'";
				if($q=$this->db->query($sql)){
					if($pay=$q->row()){
						$bunga_paid=$pay->z_bunga;
						$pokok_paid=$pay->z_pokok;
						$amount_paid=$pay->z_amount;
						$denda_paid=$pay->z_denda;
						//apabila denda_paid sudah dibayar denda jangan diupdate lagi 
						//$update_denda=false; 28/8/15 gak jadi karena ada masalah kalo import bca
					}					
				}
				// hitung lagi denda_paid alokasinya bisa jadi hari telat salah 
				// karena perbedaan tanggal sistim dan tanggal bayar
				if($denda_tagih<>$denda_paid || $update_denda){
					// update lagi denda_paid, kecuali kalo udah bayar
					//if($denda_paid==0)  28/8/15 gak jadi karena ada masalah kalo import bca 
					//$this->update_denda($faktur,$denda_tagih); //bikin kacau saja
					// LAGI hitung pembayaran, calculate total payment
					$pay=null;
					$sql="select sum(amount_paid) as z_amount,
						sum(bunga) as z_bunga, sum(denda) as z_denda, sum(pokok) as z_pokok
						from ls_invoice_payments where invoice_number='".$faktur."'";
					if($q=$this->db->query($sql)){
						if($pay=$q->row()){
							$bunga_paid=$pay->z_bunga;
							$pokok_paid=$pay->z_pokok;
							$amount_paid=$pay->z_amount;
							$denda_paid=$pay->z_denda;
						}					
					} 
					
				}	
				// hitung saldo bulan lalu
				$saldo_bulan_lalu=$this->saldo_titip($faktur);
				// bila semua sudah dihitung update lagi infonya ls_invoice_header
				$inv_amount=$pokok+$bunga+$denda_tagih;
				$saldo=$amount_paid-$inv_amount+$saldo_bulan_lalu;
				if($invoice_date<>"")	$data['invoice_date']=$invoice_date; //????
				//---- bill
				$data['amount']=round($inv_amount,2);
				$data["denda_tagih"]=round($denda_tagih,2);
				$data["hari_telat"]=(int)$hari_telat;
				//---- pay
				$data['pokok_paid']=round($pokok_paid,2);
				$data['bunga_paid']=round($bunga_paid,2);
				$data['amount_paid']=round($amount_paid,2);
				$data['denda']=round($denda_paid,2);
				//--- saldo
				$data['saldo']=round($saldo,2);
				$data['paid']=$saldo>=-1 and $saldo<=1 ? 1 : 0;
				$data['saldo_titip']=round($saldo_bulan_lalu,2);
				if($has_payment){
					$data['voucher']=$voucher;
					$data['date_paid']=$date_paid;
				} else {
					$data['voucher']=null;
					$data['date_paid']=null;					
				}
				//hanya yang belum paid yang di update 
				//if( !$paid ){
					$ok=$this->db->where('invoice_number',$faktur)->update("ls_invoice_header",$data);
				//}
				//apabila ada saldo titip bulan lalu lunasi otomatis/tambah payment 
				if($saldo_bulan_lalu<>0){
					//$this->pecah_payment_faktur($faktur);
				}
			}
		} 
		
		return $ok;	
	}
	function pecah_payment_faktur($faktur){
		/*
		nanti saja diperhitungkan akhir periode kontrak
		*/
		if($q=$this->db->select('loan_id,idx_month,saldo_titip,
			saldo_titip_paid,voucher,amount')
			->where('invoice_number',$faktur)
			->get('ls_invoice_header')) {
			if($invoice=$q->row()){
				$amount_tagih=$invoice->amount;
				$voucher=$invoice->voucher;
				$saldo_titip_paid=$invoice->saldo_titip_paid;
				$saldo_titip=$invoice->saldo_titip;
				$loan_id=$invoice->loan_id;
				$idx_month=$invoice->idx_month;
				$saldo=$saldo_titip_paid;
				//cari payment terakhir 
				$voucher='';
				$create_by='';
				$date_paid=date('Y-m-s H:i:s');
				$how_paid='';
				if($qpay=$this->db->where('invoice_number',$faktur)->order_by('date_paid desc')
					->get('ls_invoice_payments'))
				{
					if($rpay=$qpay->row())
					{
						$voucher=$rpay->voucher_no;
						$create_by=$rpay->create_by;
						$date_paid=$rpay->date_paid;
						$how_paid=$rpay->how_paid;
					}
				}
				 
					//jika titipan minus artinya bulan sebelumnya kurang bayar 
					//maka harus diinsert di bulan sebelumnya sejumlah itu
					if($saldo_titip_paid==0 and $saldo_titip<>0){
						if($idx_month>1){
							$idx_month--;
							if($rprev_inv_no=$this->db->query("select invoice_number,amount
								from ls_invoice_header where loan_id='".$loan_id."' 
								and idx_month=".$idx_month)->row()){
								$prev_inv_no=$rprev_inv_no->invoice_number;	
								$prev_inv_amount=$rprev_inv_no->amount;
								if($prev_inv_no!="")
								{
									if($prev_inv=$this->db->query("select * from qry_ls_inv_pay_sum 
										where invoice_number='".$prev_inv_no."'")->row())
									{
										//insert new payment ke faktur sebelumnya
										//bila pernah ada pembayaran 
										if($prev_inv->z_amount_paid>0 and $prev_inv->saldo<>0) {
											//var_dump($prev_inv);die();
											$saldo=$prev_inv->saldo+$saldo_titip;
											$new_denda=0;
											if($prev_inv->z_denda_paid>0){
												$new_denda=$prev_inv->denda_tagih-$prev_inv->z_denda_paid;
											}
											$new_bunga=0;
											if($prev_inv->z_bunga_paid>0){
												$new_bunga=$prev_inv->bunga-$prev_inv->z_bunga_paid;
											}
											$new_pokok=0;
											if($prev_inv->z_pokok_paid>0){
												$new_pokok=$prev_inv->pokok-$prev_inv->z_pokok_paid;
											}
											$new_amount=$new_denda+$new_bunga+$new_pokok;
											 
											if($new_amount<>0)
											{
												//cari data pembayaran last faktur
												//biar sama date_paid lalu
												$date_paid_last=date("Y-m-d H:i:s");
												if($qpay=$this->db->where('invoice_number',$prev_inv_no)->order_by('date_paid desc')
													->get('ls_invoice_payments'))
												{
													if($rpay=$qpay->row())
													{
														$voucher=$rpay->voucher_no;
														$create_by=$rpay->create_by;
														$date_paid=$rpay->date_paid;
														$how_paid=$rpay->how_paid;
													}
												}

												$pay['invoice_number']=$prev_inv_no;
												$pay['voucher_no']=$voucher;
												$pay['date_paid']=date('Y-m-d H:i:s',strtotime($date_paid));
												$pay['how_paid']=$how_paid;
												$pay['amount_paid']=$new_amount;
												$pay['denda']=$new_denda;
												$pay['bunga']=$new_bunga;
												$pay['pokok']=$new_pokok;
												$pay['create_by']=$create_by;
												$pay['create_date']=date('Y-m-d H:i:s');
												$this->db->insert('ls_invoice_payments',$pay);

												
											}
										}
									}		
								}
								
								//setelah dimasukan payment baru hitung ulang faktur sebelumnya 
								// dan hitung ulang juga faktur sekarang 
								if($pay_sum=$this->db->query("select * from qry_ls_pay_sum 
									where invoice_number='".$prev_inv_no."'")->row())
								{
									$inv_data['denda']=$pay_sum->z_denda_paid;
									$inv_data['pokok_paid']=$pay_sum->z_pokok_paid;
									$inv_data['bunga_paid']=$pay_sum->z_bunga_paid;
									$inv_data['amount_paid']=$pay_sum->z_amount_paid;
									$inv_data['saldo']=$prev_inv_amount-$pay_sum->z_amount_paid;
									$inv_data['update_date']=date('Y-m-d H:i:s');
									$inv_data['update_by']=$create_by;
									$inv_data['paid']=abs($inv_data['saldo'])<10?1:0;
									$this->db->where('invoice_number',$prev_inv_no)
									->update('ls_invoice_header',$inv_data);
									
								}
								// dan hitung ulang juga faktur sekarang 
								if($pay_sum=$this->db->query("select * from qry_ls_pay_sum 
									where invoice_number='".$faktur."'")->row())
								{
									$inv_data['denda']=$pay_sum->z_denda_paid;
									$inv_data['pokok_paid']=$pay_sum->z_pokok_paid;
									$inv_data['bunga_paid']=$pay_sum->z_bunga_paid;
									$inv_data['amount_paid']=$pay_sum->z_amount_paid;
									$inv_data['saldo']=$amount_tagih-$pay_sum->z_amount_paid;
									$inv_data['update_date']=date('Y-m-d H:i:s');
									$inv_data['update_by']=$create_by;
									$inv_data['paid']=abs($inv_data['saldo'])<10?1:0;
									$this->db->where('invoice_number',$faktur)
									->update('ls_invoice_header',$inv_data);
									
								}
								
							}
						}
					}
				  
			}
		}
		
	}
	function saldo_titip($faktur){
		$saldo_bulan_lalu=0;
		if($q=$this->db->select('loan_id,idx_month')->where('invoice_number',$faktur)
			->get('ls_invoice_header')) 
		{
			$loan=$q->row();
			$loan_id=$loan->loan_id;
			$idx_month=$loan->idx_month;
			if($idx_month>2){
				$idx_month--;
				$q=$this->db->query("select saldo from ls_invoice_header 
					where loan_id='".$loan_id."'
					and idx_month=".($idx_month));
				$saldo_bulan_lalu=$q->row()->saldo;
			}			
		}
		return (float)$saldo_bulan_lalu;
	}
	function update_denda($faktur,$denda_tagih){
		$inv=$this->db->select("denda_tagih,bunga,pokok")->where("invoice_number",$faktur)
			->get("ls_invoice_header")->row();
		if($qpay=$this->db->query("select * from ls_invoice_payments 
			where invoice_number='".$faktur."' and coalesce(denda,0)>0")){
			
			if ( $pay=$qpay->row() ) {
			
				$denda=floatval($inv->denda_tagih);	$bunga=floatval($inv->bunga);		$pokok=floatval($inv->pokok);
				
				$amt=floatval($pay->amount_paid);
				if($amt>$denda){
					$denda_paid=$denda;	$amt=$amt-$denda;
				} else {
					$denda_paid=$denda;
					$amt=0;
				}
				if($amt>$bunga){
					$bunga_paid=$bunga;	$amt=$amt-$bunga;
				} else {
					$bunga_paid=$bunga;
					$amt=0;
				}
				if($amt>$pokok){
					$pokok_paid=$pokok;	$amt=$amt-$pokok;
				} else {
					$pokok_paid=$amt;
					$amt=0;
				}
				
				$data=array("pokok"=>$pokok_paid,"bunga"=>$bunga_paid,"denda"=>$denda_paid); 		
				$this->db->where('id',$pay->id)->update($this->table_name,$data);
			
			}
		}
	}
	function recalc_hari_telat($invoice_number,$allow_paid_flag=false,$tanggal=null){
		$ok=false;
		$paid=false;
		$hari_telat=0;
		if(!$inv=$this->get_by_id($invoice_number)->row()) return false;
		
		$paid=$inv->paid;
		if($paid){
			//or $allow_paid_flag)
			return false;
		}
		$denda_prc=(real)getvar("denda_prc",5)*0.01;
		$denda_hari=(int)getvar("denda_hari",7);
		$denda_hari=$denda_hari+1; //plus satu hari besoknya
		$denda_tagih=0;
		$date_sys=date("Y-m-d");
		$date=$date_sys;
		$has_payment=false;
		//apabila sudah ada pembayaran ambil tanggal bayar terakhir
		if($q=$this->db->where('invoice_number',$invoice_number)->order_by("date_paid")->get('ls_invoice_payments')){
			if($pay=$q->row()){
				$has_payment=true;
				$date=$pay->date_paid;
			}
		}
		//apabila diset tanggal di parameter ambil tanggal ini 
		//karena tanggal upload bca bisa saja berbeda
		if($tanggal!=null){
			$date=$tanggal;
		}
		//hari telat dihitung hanya apabila tanggal invoice kurang dari tanggal bayar
		//dan belum ada pembayaran
		if(strtotime($inv->invoice_date)<strtotime($date) && !$has_payment){
			$hari_telat=my_date_diff($inv->invoice_date,$date);
		} else { 
			//nah apabila dibayar dua bulan ?? 
			//tanggal date_sys sekarang yg dipakai utk hitung hari telat
			//hitung hanya invoice yang kurang dari tanggal hari ini
			if(strtotime($inv->invoice_date)<=strtotime($date_sys)){
				$hari_telat=my_date_diff($inv->invoice_date,$date_sys);
			}
		}
		$denda_tagih=(((floatval($inv->pokok)+floatval($inv->bunga))*$denda_prc)/30)*$hari_telat;
		if($hari_telat<$denda_hari)$denda_tagih=0;
		//update invoice info hari_telat dan denda_tagih		
		$data["denda_tagih"]=round($denda_tagih);
		$data["hari_telat"]=(int)$hari_telat;
		$data['amount']=$inv->pokok+$inv->bunga+$denda_tagih;
		$ok=$this->update($invoice_number,$data);
		return $ok;
	}
	function recalc_saldo($invoice_number,$allow_update=false){
		$ok=false;
		if(!$inv=$this->get_by_id($invoice_number)->row()) return false;
		if($rpay=$this->db->where('invoice_number',$invoice_number)
			->get('ls_invoice_payments'))
		{
			if($pay=$rpay->row()){
				if(!$allow_update) {
					if($pay->dont_calculate) return false;
				}
			}
			//cek payment mismatch amount_paid=denda+bunga+pokok
			foreach($rpay->result() as $row_pay){
				$amount_paid=$row_pay->denda+$row_pay->bunga+$row_pay->pokok;
				$this->db->where("id",$row_pay->id)
				->update("ls_invoice_payments",array("amount_paid"=>$amount_paid));
			}
		}
		
		if($zpay=$this->payment_model->get_sum($invoice_number)){
			 
			$data['denda']=$zpay['denda'];	//denda paid
			$data['bunga_paid']=$zpay['bunga'];
			$data['amount_paid']=$zpay['amount_paid'];
			$data['pokok_paid']=$zpay['pokok'];
			$data['paid']=($zpay['amount_paid']+1) >= $inv->amount;
			if($zpay['amount_paid']==0){
				$data['saldo']=0;
				$data['voucher']=null;
				$data['pokok_paid']=0;
				$data['amount_paid']=0;
				$data['date_paid']=null;
			} else {
				$data['saldo']=$zpay['amount_paid']-$inv->amount;
				$data['saldo_titip']=0;	///set 0 karena saldo titip gak dipakai lagi
			}
			$ok=$this->update($invoice_number,$data);
		}
		return $ok;
	}
}
?>