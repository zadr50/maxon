<div class='col-lg-10 col-md-10'>
	<div class='alert alert-info'>
		<p>Konfirmasi diperlukan untuk memeriksa pembayaran yang 
		anda lakukan sudah masuk ke nomor rekening kami.</p>
		<p>Untuk informasi status pengiriman barang yang anda beli 
		silahkan lihat pada menu preference akun anda.</p>
	</div>
</div>
<div class='col-md-5 thumbnail'>
		<form class="form" id='frmMain' method='post'>
			  <?php
			  $amount_paid=0;
			  if($amt_data=$this->session->userdata("ongkos")){
			  	$amount_paid=$amt_data['total'];
			  }
			  $bank_list=null;
			  $q=$this->db->select('bank_account_number,bank_name')->get('bank_accounts');
			  foreach($q->result() as $row)
			  {
				  $bank_list[$row->bank_account_number]=$row->bank_account_number.' - '.$row->bank_name;
			  }
			  echo my_dropdown("Transfer ke rekening","account_number",'',$bank_list);
			  echo my_input_2("Tanggal",'date_paid',date('Y-m-d H:i:s'));
			  echo "<i>tanggal anda melakukan pembayaran diteller atau atm</i>";
			  echo my_input_2("Jumlah Pembayaran",'amount_paid',$amount_paid);
			  echo my_input_2("Bank Pengirim",'from_bank');
			  echo my_input_2("Nomor Rekening bank pengirim",'from_account');
			  echo my_input_2("Nama Pemilik rekening",'authorization');
			  echo my_input_2("Bank Cabang pengirim",'credit_card_number');
			  ?>
		</form>
		
		<a href="#" onclick='frmMain_Save();return false;' 
		class='btn btn-primary'>Submit</a>
		
		<div id='message'></div>
</div> 
<div class='col-md-6'>
	
</div>
<script language='javascript'>
function frmMain_Save(){
  		if($('#account_number').val()==''){alert('Isi account_number !');return false;}
  		if($('#from_account').val()==''){alert('Isi from_account !');return false;}
		var account_number=$('#account_number').val();
		url='<?=base_url()?>index.php/eshop/cart/confirm_save';
		next_url='<?=base_url()?>index.php/eshop/setting/view/member_trans/2';
		$('#frmMain').ajax_post(url,'undefined',next_url); 
}
</script> 