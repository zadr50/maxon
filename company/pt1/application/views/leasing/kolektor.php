<legend>BILLING LIST</legend>
<p>Dibawah ini adalah daftar tagihan yang telah lewat jatuh tempo dan perlu diadakan penagihan 
oleh bagian kolektor</p>
<p>Nomor faktur tagihan yang sudah lunas tidak ada didaftar ini </p>
<form id="frmMain" name="frmMain" method="post">
<table class='table2' width="100%">
<thead><tr><th>Pilih</th><th>Faktur#</th><th>Nama Debitur</th><th>Tgl Tagih</th>
	<th>Hari Telat</th><th>Angsuran Rp.</th><th>Tanggal</th><th>Kolektor</th>
	</tr><tr><th></th><th></th><th>Tagih Ke</th><th>Pokok</th><th>Bunga</th><th>Denda</th>
	</tr>
</thead>
<tbody>
	<?
	$row="";$i=0;
	foreach($faktur_telat->result() as $faktur){
		$row.="<tr>
		<td><input type='checkbox' name='faktur[]' value='".$faktur->invoice_number."'></td>		
		<td><input type='text' name='faktur_list[]' value='".$faktur->invoice_number."' readonly></td><td>".$faktur->cust_name."</td>
		<td>".date('d M',strtotime($faktur->invoice_date))."</td><td>".$faktur->hari_telat."</td>
		<td><div align='right'>".number_format($faktur->amount)."</div></td>
		<td><input type='text' value='".date('Y-m-d H:i:s')."' name='tanggal[]' class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' ></td>
		<td>".form_dropdown("kolektor[]",$kolektor_list)."</td>
		</tr>
		<tr>
		<td>&nbsp</td><td>&nbsp</td>
		<td><a href='#' onclick='coll_invoice_view(\"".$faktur->invoice_number."\")'>".$faktur->visit_count."</a></td>
		<td><div align='right'>".number_format($faktur->pokok)."</div></td>
		<td><div align='right'>".number_format($faktur->bunga)."</div></td>
		<td><div align='right'>".number_format($faktur->denda_tagih)."</div></td>
		
		</tr>";
	}
	echo $row;
	?>
</tbody>
</table>
</form>
 
<p>Contreng pada baris yang diinginkan untuk membuat jadwal penagihan dan pemilihan nama 
kolektor, tekan tombol [Proses] untuk menyimpan data jadwal kolektor</p>

<div class='thumbnail'>
	<button type="button" onclick="cmdProses()" class="btn btn-info">Proses</button>
</div>
<script language="javascript">
  	function cmdProses(){
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/kolektor/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/kolektor";
					log_msg('Data sudah tersimpan.');
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	function coll_invoice_view(nomor_faktur){	
		var  url="<?=base_url()?>index.php/leasing/loan/tagih_view/"+nomor_faktur;
		add_tab_parent('coll_invoice_view_'+nomor_faktur,url);
	}
	
</script>