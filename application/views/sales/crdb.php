<form id='frmAddCrDb'>
	<table>
		<tr><td>Kode Cr Db:</td><td><?=form_input('kodecrdb',$kodecrdb)?></td></tr>
		<tr><td>Nomor Faktur:</td><td><?=$docnumber." ".form_hidden('docnumber',$docnumber)?></td></tr>
		<tr><td>Tanggal:</td><td><?=form_input('tanggal',$tanggal)?></td></tr>
		<tr><td>Jumlah:</td><td><?=form_input('amount',$amount)?></td></tr>
		<tr><td>Keterangan:</td><td><?=form_input('keterangan',$keterangan)?></td></tr>
		
	</table>
</form>
