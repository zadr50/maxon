<legend>Data Survey Lokasi</legend>
<table class='table2' style='width:100%'>
<tr><td>Nomor SPK</td><td>
<a href='#' onclick='view_spk("<?=$app_id?>")'><?=$app_id?></a>
</td></tr>
<tr><td>Tanggal</td><td><?=date('Y-m-d')?></td></tr>
<tr><td>Survey Ke</td><td>1</td></tr>
<tr><td style='width:25%'>Nama Debitur</td><td><?=$cust_name?></td></tr>
<tr><td>Alamat</td><td><?=$street." Kec: $kec Kel: $kel Rt: $rt Rw: $rw"?></td></tr>
<tr><td>Hasil Survey</td><td><?=$hasil?></td></tr>
<tr><td>Nama Surveyor</td><td><?=$survey_by?></td></tr>
<tr><td>Foto Rumah Depan</td>
<td>
	<img style="width:100px;height:100px;"  src='<?=base_url()?>tmp/<?=$foto_depan==""?"no_img.png":$foto_depan?>'>
</td></tr>
<tr><td>Foto Samping Kanan</td><td>
	<img style="width:100px;height:100px;"  src='<?=base_url()?>tmp/<?=$foto_kanan==""?"no_img.png":$foto_kanan?>'>
</td></tr>
<tr><td>Foto Samping Kiri<td>
	<img style="width:100px;height:100px;"  src='<?=base_url()?>tmp/<?=$foto_kiri==""?"no_img.png":$foto_kiri?>'>
</td></tr>
<tr><td>Foto 1<td>
	<img  style="width:100px;height:100px;" src='<?=base_url()?>tmp/<?=$foto_1==""?"no_img.png":$foto_1?>'>
	<?=$foto_ket_1?>
</td></tr>
<tr><td>Foto 2<td>
	<img style="width:100px;height:100px;"  src='<?=base_url()?>tmp/<?=$foto_2==""?"no_img.png":$foto_2?>'>
	<?=$foto_ket_2?>
</td></tr>
<tr><td>Foto 3<td>
	<img style="width:100px;height:100px;" src='<?=base_url()?>tmp/<?=$foto_3==""?"no_img.png":$foto_3?>'>
	<?=$foto_ket_3?>
</td></tr>
<tr><td>Foto 4<td>
	<img style="width:100px;height:100px;"  src='<?=base_url()?>tmp/<?=$foto_4==""?"no_img.png":$foto_4?>'>
	<?=$foto_ket_4?>
</td></tr>
<tr><td>Foto 5<td>
	<img style="width:100px;height:100px;"  src='<?=base_url()?>tmp/<?=$foto_5==""?"no_img.png":$foto_5?>'>
	<?=$foto_ket_5?>
</td></tr>

<table>
<p></p> 
