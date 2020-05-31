<?php
class Payment_model extends CI_Model {

	private $primary_key='id';
	private $table_name='ls_invoice_payments';

	function __construct(){
		parent::__construct();        
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['voucher_no']))$nama=$_GET['voucher_no'];
		if($nama!='')$this->db->where("voucher_no like '%$nama%'");

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
	function paid_all($loan_id,$tanggal,$nomor,$jumlah,$how_paid='Cash')
	{
		$retval=0;
		 
		
		if($loan_id!="")
		{
			if($q=$this->db->select('invoice_number')->where('loan_id',$loan_id)
				->where('paid',false)
				->order_by('idx_month')->get('ls_invoice_header'))
			{
				$stop=false;
				
				
				foreach($q->result() as $inv)
				{
					if($jumlah<>0 and ! $stop )
					{
						//supaya hari telat gak dihitung lagi maka ambil tanggal bayar yang dulu
						$inv_date_paid=$this->db->select('date_paid')->where('invoice_number',$inv->invoice_number)
								->get('ls_invoice_header')->row()->date_paid;
						if(!$inv_date_paid)$inv_date_paid=$tanggal;
						$this->invoice_header_model->recalc_hari_telat($inv->invoice_number,false,$inv_date_paid);
						$this->invoice_header_model->recalc_saldo($inv->invoice_number);
						$invoice=$this->invoice_header_model->get_by_id($inv->invoice_number)->row();
						$data['date_paid']=$tanggal;
						$data['voucher_no']=$nomor;
						$data['invoice_number']=$invoice->invoice_number;
						$data['denda']=$invoice->denda_tagih-$invoice->denda;
						$data['bunga']=$invoice->bunga-$invoice->bunga_paid;
						$data['pokok']=$invoice->pokok-$invoice->pokok_paid;
						$data['how_paid']=$how_paid;
						$saldo=floatval($data['denda'])+floatval($data['bunga'])+floatval($data['pokok']);
						//$data['saldo']=$saldo;
						
						if( $jumlah >= $saldo ){
							$amount_paid=$saldo;
							$jumlah = $jumlah - $saldo;
						} else {
							$amount_paid=$jumlah;
							$jumlah=0;
						}
						
						$data['amount_paid']=$amount_paid;
						$retval = $this->save($data);
						$this->invoice_header_model->recalc_saldo($inv->invoice_number);
						
						if ( abs($jumlah)<=1 ) $stop = true;
						
					}
				}				
			}
		 
			
		}
		return $retval;
	}
	function save($data2){
		//masalah-masalah pembayaran angsuran
		//1. bulan ini mau bayar ternyata ada saldo kurang sisanya untuk bulan depan
		//2. bulan ini mau bayar ternyata bulan kemarin belum lunas
		//sebelum bayar bulan ini cek dulu bulan kemarin ada sisa?
		$how_paid=$data2['how_paid'];
		$tgl=$data2['date_paid'];
		$tgl=date("Y-m-d",strtotime($tgl));
		if(date("Y",strtotime($tgl)<2000))$tgl=date("Y-m-d H:i:s",strtotime($tgl));
		$voucher_no=$data2['voucher_no'];
		$inv_no=$data2['invoice_number'];
		$denda=floatval(str_replace(",","",$data2['denda']));
		$bunga=floatval(str_replace(",","",$data2['bunga']));
		$pokok=floatval(str_replace(",","",$data2['pokok']));
		$amount_paid=floatval(str_replace(",","",$data2['amount_paid']));
		$amt_paid_old=$amount_paid;
		if (isset($data2['saldo_titip'])){
			$amount_paid=$amount_paid+floatval($data2['saldo_titip']);
			unset($data2['saldo_titip']);
		}
		//hitungan pembagian alokasi denda,pokok,bunga
		if($amount_paid>=$denda){
			$denda_paid=$denda;	$amount_paid = $amount_paid-$denda;
		} else {
			$denda_paid=$amount_paid; $amount_paid=0;
		}
		if($amount_paid>=$bunga){
			$bunga_paid=$bunga;	$amount_paid=$amount_paid-$bunga;
		} else {
			$bunga_paid=$amount_paid; $amount_paid=0;
		}
		if($amount_paid>=$pokok){
			$pokok_paid=$pokok;	$amount_paid=$amount_paid-$pokok;
		} else {
			$pokok_paid=$amount_paid; $amount_paid=0;
		}
		if($amount_paid>0){
			//lah masih ada sisa amount_paid ?
			//harus digimanain ?
			//mungkin titipan
		}
		$data2['date_paid']=date("Y-m-d H:i:s",strtotime($tgl));
		$data2['denda']=$denda_paid;
		$data2['bunga']=$bunga_paid;
		$data2['pokok']=$pokok_paid;
		$data2['create_by']=user_id();
		$data2['create_date']=date("Y-m-d H:i:s");
		$data2['amount_alloc']=$data2['amount_paid'];
		$data2['amount_paid']=$denda_paid+$bunga_paid+$pokok_paid;
		 
		$id=0;
		if($data2['amount_paid']==0){
			//echo "Warning: ".$data2['invoice_number']." amount paid = 0 ?? </br>";
		} else {
			$ok = $this->db->insert($this->table_name, $data2);
			if( $id = $this->db->insert_id() ) {
				//echo 'Invoice: '.$data2['invoice_number'].' - Success</br>';
			} else {
				//echo 'Invoice: '.$data2['invoice_number'].' - Error</br>';
			}
			$this->db->where('invoice_number',$inv_no)->where('date_paid',null)
				->update('ls_invoice_header',array('date_paid'=>$data2['date_paid'],
				'voucher'=>$voucher_no,'payment_method'=>$how_paid));
		}
		
		return $id;

	}
	function saveex($data2){
		$tgl=$data2['date_paid'];
		$tgl=date("Y-m-d",strtotime($tgl));
		if(date("Y",strtotime($tgl)<2000))$tgl=date("Y-m-d H:i:s",strtotime($tgl));
		$voucher_no=$data2['voucher_no'];
		$inv_no=$data2['invoice_number'];
		$invoice=$this->db->where('invoice_number',$inv_no)->get('ls_invoice_header')->row();
		$denda=floatval(str_replace(",","",$data2['denda']));		//if($denda==0)			$denda=$invoice->denda_tagih;
		$bunga=floatval(str_replace(",","",$data2['bunga']));		//if($bunga==0)			$bunga=$invoice->bunga;
		$pokok=floatval(str_replace(",","",$data2['pokok']));		//if($pokok==0)			$pokok=$invoice->pokok;
		$amount_paid=floatval(str_replace(",","",$data2['amount_paid']));
		$invoice_not_paid=$this->db->where('loan_id',$invoice->loan_id)
			->where('paid',false)->get('ls_invoice_header');
		
		//masalah-masalah pembayara
		//1. bulan ini mau bayar ternyata ada saldo kurang sisanya untuk bulan depan
		//2. bulan ini mau bayar ternyata bulan kemarin belum lunas
		//sebelum bayar bulan ini cek dulu bulan kemarin ada sisa?
		$bulan=$invoice->idx_month-1;
		var_dump('amt awal '.$amt.' bulan '.$bulan);
		die();
		if($amt>0 and $bulan>0)
		{	//masih ada sisa faktur sebelumnya ?
			if($q=$this->db->select('invoice_number,paid,saldo,denda_tagih,denda,
				bunga,bunga_paid,pokok,pokok_paid,amount_paid')
				->where('idx_month',$bulan)
				->where('loan_id',$invoice->loan_id)->get('ls_invoice_header'))
			{
					if( $inv_last=$q->row() )
					{
						if($inv_last->saldo<=$amt){	// apabila bulan kemarin kurang bayar
							$saldo=$inv_last->saldo;
							$bunga=0;
							if(abs($saldo)>=($inv_last->bunga-$inv_last->bunga_paid) 
								and ($inv_last->bunga-$inv_last->bunga_paid)>0){ 
								$bunga=abs($inv_last->bunga-$inv_last->bunga_paid);
								$saldo=$saldo-$bunga;
							}
							$pokok=0;
							if(abs($saldo)>=($inv_last->pokok-$inv_last->pokok_paid)
								and ($inv_last->pokok-$inv_last->pokok_paid)>0){ 
								$pokok=abs($inv_last->pokok-$inv_last->pokok_paid);
								$saldo=$saldo-$pokok;
							}
							$paynew['bunga']=$bunga;
							$paynew['pokok']=$pokok;
							$paynew['invoice_number']=$inv_last->invoice_number;
							$paynew['amount_paid']=$bunga+$pokok;
							$paynew['amount_alloc']=$data2['amount_paid'];
							$paynew['voucher_no']=$data2['voucher_no'];
							$paynew['date_paid']=$data2['date_paid'];
							$ok = $this->db->insert($this->table_name, $paynew);			
							$this->invoice_header_model->recalc_saldo($inv_last->invoice_number);
							//amount harus dikurangi karena udah bayar sebelumnya 
							$amt=$amt-($bunga+$pokok);
							
						} else {	// apabila bulan kemarin ada lebih bayar
							$saldo=$inv_last->saldo;
							$bunga=0;
							if(abs($saldo)>=($inv_last->bunga-$inv_last->bunga_paid) 
								and ($inv_last->bunga-$inv_last->bunga_paid)>0){ 
								$bunga=abs($inv_last->bunga-$inv_last->bunga_paid);
								$saldo=$saldo-$bunga;
							}
							$pokok=0;
							if(abs($saldo)>=($inv_last->pokok-$inv_last->pokok_paid)
								and ($inv_last->pokok-$inv_last->pokok_paid)>0){ 
								$pokok=abs($inv_last->pokok-$inv_last->pokok_paid);
								$saldo=$saldo-$pokok;
							}
							$paynew['bunga']=$bunga;
							$paynew['pokok']=$pokok;
							$paynew['invoice_number']=$inv_last->invoice_number;
							$paynew['amount_paid']=$bunga+$pokok;
							$paynew['amount_alloc']=$data2['amount_paid'];
							$paynew['voucher_no']=$data2['voucher_no'];
							$paynew['date_paid']=$data2['date_paid'];
							$ok = $this->db->insert($this->table_name, $paynew);			
							$this->invoice_header_model->recalc_saldo($inv_last->invoice_number);
							//amount harus dikurangi karena udah bayar sebelumnya 
							$amt=$amt-($bunga+$pokok);
						}
					} 
				}
		}
		
		/// ok masukan bulan sekarang dengan $amt yang udah dikurangi bulan lalu
		$voucher_no_exist=$this->db->where('voucher_no',$voucher_no)->get($this->table_name)->num_rows();
		$inv_no_exist=$this->db->where('invoice_number',$inv_no)->get($this->table_name)->num_rows();
		 
		//hitungan pembagian alokasi denda,pokok,bunga
		if($amt>=$denda){
			$denda_paid=$denda;	$amt=$amt-$denda;
		} else {
			$denda_paid=$amt;
			$amt=0;
		}
		if($amt>=$bunga){
			$bunga_paid=$bunga;	$amt=$amt-$bunga;
		} else {
			$bunga_paid=$amt;
			$amt=0;
		}
		if($amt>=$pokok){
			$pokok_paid=$pokok;	$amt=$amt-$pokok;
		} else {
			$pokok_paid=$amt;
			$amt=0;
		}
		$data2['date_paid']=date("Y-m-d H:i:s",strtotime($tgl));
		$data2['denda']=$denda_paid;
		$data2['bunga']=$bunga_paid;
		$data2['pokok']=$pokok_paid;
		 
		/* if($voucher_no_exist) {
			unset($data2['invoice_number']);
			$data2['update_by']=user_id();
			$data2['update_date']=date("Y-m-d H:i:s");
			$ok = $this->db->where('voucher_no',$voucher_no)->update($this->table_name, $data2);
		} else {   */
			$data2['create_by']=user_id();
			$data2['create_date']=date("Y-m-d H:i:s");
			$data2['amount_alloc']=$data2['amount_paid'];
			$data2['amount_paid']=$denda_paid+$bunga_paid+$pokok_paid;
			$ok = $this->db->insert($this->table_name, $data2);			
			$id= $this->db->insert_id();
		//}
		
		// update ls_invoice_header		
/* 		$dinv['date_paid']=date("Y-m-d H:i:s",strtotime($tgl));
		$dinv['payment_method']=$data2['how_paid'];
		$dinv['amount_paid']=floatval(str_replace(",","",$data2['amount_paid']));
		$dinv['voucher']=$data2['voucher_no'];
		$dinv['pokok_paid']=floatval(str_replace(",","",$data2['pokok']));
		$dinv['bunga_paid']=floatval(str_replace(",","",$data2['bunga']));
		$dinv['denda']=floatval(str_replace(",","",$data2['denda']));	//denda paid
		$id=0;
		$this->invoice_header_model->update($inv_no,$dinv);	
		//ambil
		if($q=$this->db->select("id")->where("voucher_no",$voucher_no)->get("ls_invoice_payments")){
			if($row=$q->row()){
				$id=$row->id;
			}
		}
 */		return $id;

	}
	function update($id,$data){
		if(isset($data['date_paid']))$data['date_paid']=date("Y-m-d H:i:s",strtotime($data['date_paid']));
		return $this->db->where($this->primary_key,$id)->update($this->table_name,$data);
	}
	function delete($id){
		$invoice_number="";
		if($row=$this->db->select("invoice_number")->where("id",$id)
			->get($this->table_name)->row())
		{
			$invoice_number=$row->invoice_number;
		}
		$this->db->where($this->primary_key,$id);
		if($this->db->delete($this->table_name)){
			$this->load->model('leasing/invoice_header_model');
			if($invoice_number!="")$this->invoice_header_model->recalc_hari_telat($invoice_number);
			if($invoice_number!="")$this->invoice_header_model->recalc_saldo($invoice_number);
		}
	}
	function recalc($id){
		$this->db->query("update ls_loan_master set total_amount_paid=(
			select sum(amount_paid)  
			from ls_invoice_header where loan_id='".$loan_id."')");
		$this->db->query("update ls_loan_master set ar_bal_amount=loan_amount-total_amount_paid 
		where loan_id='".$loan_id."'");
		$this->db->query("update ls_loan_master set paid=1 where ar_bal_amount<=0 
		and loan_id='".$loan_id."'");		
	}
	function get_sum($invoice_number){
		$data=null;
		$sql="select sum(bunga+denda+pokok) as z_amount,
			sum(bunga) as z_bunga, sum(denda) as z_denda, sum(pokok) as z_pokok
			from ls_invoice_payments where invoice_number='".$invoice_number."'";
		if($q=$this->db->query($sql)){
			if($pay=$q->row()){
				$data['amount_paid']=$pay->z_amount;
				$data['bunga']=$pay->z_bunga;
				$data['pokok']=$pay->z_pokok;
				$data['denda']=$pay->z_denda;
			}
		}
		return $data;
	}
	function summary($faktur){
		$data=$this->db->query("select i.invoice_number,i.invoice_date,
			i.amount-coalesce(p.z_amount,0) as amount,i.paid,i.saldo,i.saldo_titip,
			i.denda_tagih-coalesce(p.z_denda,0) as denda,
			i.bunga-coalesce(p.z_bunga,0) as bunga,
			i.pokok-coalesce(p.z_pokok,0) as pokok,
			i.denda_tagih-coalesce(p.z_denda,0) as denda_tagih
			from ls_invoice_header i 
			left join (select invoice_number,sum(amount_paid) as z_amount,
				sum(denda) as z_denda,sum(bunga) as z_bunga,sum(pokok) as z_pokok 
				from ls_invoice_payments 
				group by invoice_number) p 
			on p.invoice_number=i.invoice_number 
			where i.invoice_number='$faktur'")->row_array();
		return $data;
	}	
	function add_payment_closing($invoice_number,$pokok_paid,$date_paid,$how,
		$alloc,$voucher) {
		//echo "<br>$invoice_number: $pokok_paid date: $date_paid";
		$finalty=round(0.02 * $pokok_paid,2);
		$amount_paid=$pokok_paid+$finalty;
		$data["invoice_number"]=$invoice_number;
		$data["amount_paid"]=$amount_paid;
		$data["denda"]=0;
		$data["pokok"]=$pokok_paid;
		$data["bunga"]=0;
		$data['date_paid']=date('Y-m-d',strtotime($date_paid));
		$data['how_paid']=$how;
		$data['voucher_no']=$voucher;
		$data["dont_calculate"]=true;
		$data['create_by']=user_id();
		$data['create_date']=date('Y-m-d');
		$data['amount_alloc']=$alloc;
		$data['finalty']=$finalty;
		//echo "invoice=".$invoice_number.", pokok=".$pokok_paid."</br>";
		
		return $this->db->insert($this->table_name,$data);

	}
    function total_amount($faktur){
        $this->db->select("sum(amount_paid) as total_amount");
        $this->db->where("invoice_number",$faktur);
        $this->db->from("payments");
        $row=$this->db->get();
        $r=$row->row();
        return $r->total_amount;
    }

}
?>