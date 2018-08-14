
		<h1><?=$caption?></h1>
		<p>Silahkan lakukan konfirmasi pembayaran anda disini</p>

		<form class="form" id='frmMain' method='post'>
			  <?
			  $bank_list=null;
			  $q=$this->db->select('bank_account_number,bank_name')->get('bank_accounts');
			  foreach($q->result() as $row)
			  {
				  $bank_list[$row->bank_account_number]=$row->bank_account_number.' - '.$row->bank_name;
			  }
			  echo my_dropdown("Transfer ke rekening","account_number",'',$bank_list);
			  echo my_input("Tanggal",'date_paid',date('Y-m-d H:i:s'));
			  echo "<i>tanggal anda melakukan pembayaran diteller atau atm</i>";
			  echo my_input("Jumlah Pembayaran",'amount_paid');
			  echo my_input("Bank Pengirim",'from_bank');
			  echo my_input("Nomor Rekening bank pengirim",'from_account');
			  echo my_input("Nama Pemilik rekening",'authorization');
			  echo my_input("Bank Cabang pengirim",'credit_card_number');
			  ?>
		</form>
		
		<a href="#" onclick='frmMain_Save();return false;' 
		class='btn btn-primary'>Submit</a>
		
		<div id='message'></div>
 
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