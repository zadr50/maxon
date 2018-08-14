<?
if($message==""){
?>
<legend>Data Kunjungan Kolektor</legend>
<form id="frmMain" name='frmMain' method='post'>
<input type='hidden' name='invoice_no' id='invoice_no' value='<?=$invoice_no?>'>
<table class='table2' width="100%">
<thead><th></th><th></th><th></th></thead>
<tbody>
<tr><td>Nomor Faktur# </td><td><?=$invoice_no?></td>
	<td>Tanggal Kunjungan </td><td><?=$visit_date?></td>
</tr>
<tr><td>Nama Debitur </td><td><?=$cust_name?></td><td><?$cust_deal_id?></td>
	

</tr>
<tr><td>Alamat </td><td><?=$street?></td>
	<td>Kunjungan Ke</td><td><?=$visit_ke?></td>
</tr>
<tr><td>Tanggal Tagih </td><td><?=$invoice_date?></td>
	<td>Alasan Tidak Tertagih </td><td></td>

</tr>
<tr><td>Angsuran Ke </td><td><?=$idx_month?></td>
	<td rowspan='10' colspan='2'><?=$visit_notes?></td>
</tr>
<tr><td>Jumlah Rp. </td><td><?=number_format($amount)?></td></tr>
<tr><td>Pokok Rp. </td><td><?=number_format($pokok)?></td></tr>
<tr><td>Bunga Rp. </td><td><?=number_format($bunga)?></td></tr>
<tr><td>Denda Rp. </td><td><?=number_format($denda)?></td></tr>
<tr><td>Hari Telat </td><td><?=$hari_telat?></td></tr>
<tr><td>Tertagih </td><td><?=form_dropdown("tertagih",array("0"=>"Tertagih","1"=>"Tidak Tertagih"),$collected)?></td></tr>
<tr><td>Tertagih Rp. </td><td><?=form_input("tertagih_jumlah",$amount_col)?></td></tr>
<tr><td>Janji Bayar Tanggal </td><td><?=$promise_date?></td></tr>
<tr><td>RowId</td><td><?=$id?></td></tr>
</tbody>
</table>
</form>
<? } else { 
	echo $message; 
}
?>

<script language="javascript">
  	function cmdProses(){
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/kolektor/proses_tagih';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/kolektor/proses_tagih";
					log_msg('Data sudah tersimpan.');
					top.frames.location.reload(false);
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
</script>
