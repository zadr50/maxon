<?
		echo form_open('',array("action"=>"","name"=>"frmMain","id"=>"frmMain"));
?>

<div class="easyui-tabs" >
<div title='DATA PRIBADI' class='box-gradient'>
<table class='table2' style='width:100%'>
	<tr><td>Nama Sesuai KTP</td><td><?=form_input("v2_cust_name_x")?></td></tr>
	<tr><td>Nama Ibu Kandung</td><td><?=form_input("v2_mother_name_x")?></td></tr>
	<tr><td>Status Rumah</td><td><?=form_input("v1_house_status_x")?></td></tr>
	<tr><td>Lama Menetap</td><td><?=form_input("v1_lama_tahun")?></td></tr>
	<tr><td>Tempat Lahir</td><td><?=form_input("v2_place_birth")?></td></tr>
	<tr><td>Tanggal Lahir</td><td><?=form_input("v2_date_birth",date('Y-m-d'),"class='easyui-datetimebox'")?></td></tr>
	<tr><td>Nama Saudara</td><td><?=form_input("v1_fam_name")?></td></tr>
	<tr><td>Hubungan Keluarga</td><td><?=form_input("v1_fam_relation")?></td></tr>
	<tr><td>Alamat</td><td><?=form_input("v1_fam_street")?></td></tr>
	<tr><td>HP/Telp Family</td><td><?=form_input("v1_fam_phone")?></td></tr>	
</table>
</div>
<div title="FAMILY" class="box-gradient"> 
<table class='table2' style='width:100%'>
	<tr><td>Nama Sesuai KTP</td><td><?=form_input("v2_cust_name")?></td></tr>
	<tr><td>Nama Ibu Kandung</td><td><?=form_input("v2_mother_name")?></td></tr>
	<tr><td>Alamat</td><td><?=form_input("v1_street")?></td></tr>
	<tr><td>Status Rumah</td><td><?=form_input("v1_house_status")?></td></tr>
	<tr><td>Nama Perusahaan</td><td><?=form_input("v3_com_name")?></td></tr>
</table>
</div>
<div title="PERUSAHAAN" class="box-gradient"> 
<table class='table2' style='width:100%'>
	<tr><td>Masa Kerja</td><td><?=form_input("v3_year")?></td></tr>
	<tr><td>Nama Atasan</td><td><?=form_input("v3_supervisor")?></td></tr>
	<tr><td>Nama HRD</td><td><?=form_input("v3_hrd")?></td></tr>
	<tr><td>Gaji Rp.</td><td><?=form_input("v3_salary")?></td></tr>
	<tr><td>Status Karyawan</td><td><?=form_input("v3_emp_status")?></td></tr>
<!--	
	<tr><td>Nama Perusahaan</td><td><?=form_input("v3_com_name")?></td></tr>
	<tr><td>Alamat</td>fam_hp_telp<td><?=form_input("v3_street")?></td></tr>
	<tr><td>Bidang Usaha</td><td><?=form_input("v3_bidang")?></td></tr>
	<tr><td>Jabatan</td><td><?=form_input("v3_jabatan")?></td></tr>
-->	
</table>
</div>
</div>
	
<?
		echo "<input type='hidden' name='id' id='id'>";
		echo "<input type='hidden' name='app_id' id='app_id'>";
		echo form_close();
?>            

