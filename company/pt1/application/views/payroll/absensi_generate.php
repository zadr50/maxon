<legend>Generate Data Absensi</legend>
<div class='alert alert-info'>
	<p>Halaman ini dipakai untuk generate data absensi secara otomatis pada 
	periode dan department yang dipilih.</p>
	<p>Data absensi yang digenerate berdasarkan kode absensi yang melekat dimaster
	data pegawai</p>
	<p>Isi kriteria dibawah ini kemudian klik tombol submit</p>
</div>
<form name='frmMain' method='post'>
	<table class='table'>			 
		<tr><td>Periode</td><td><?=form_dropdown('periode',$periode_list,$periode,"id='periode'")?></td></tr>
		<tr>
		<td>Department</td><td><?=form_dropdown('dept',$dept_list,$dept,'id=dept')?></td>
		</tr>
		<tr>
		<td>Divisi</td><td><?=form_dropdown('divisi',$divisi_list,$divisi,'id=divisi')?></td>
		</tr>
		<tr><td>NIP</td>
			<td><?=form_input('nip',$nip,"id='nip'") 
			. link_button('','dlgLovNip_show()','search')?>
			Nama <?=form_input('nama',$nama,'id=nama disabled')?>
			</td>
		</tr>
		<tr><td> &nbsp </td><td><input type='submit' class='btn btn-primary' value='Submit'></td></tr>
		</td>
		</tr>
	</table>
</form>


<?php echo $lookup_employee; ?>