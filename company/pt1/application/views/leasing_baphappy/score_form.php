<?
if(!isset($score_value))$score_value=0;
?>
<legend>Score Value : <span name='score_value' name='score_value'>
<?=$score_value?></legend>

<?
echo form_open('',array("action"=>"","name"=>"frmMain","id"=>"frmMain"));
echo box_verify(1,"Nama Sesuai KTP",'v2_cust_name',$sa_v2_cust_name,$pv_v2_cust_name,isset($v2_cust_name)?$v2_cust_name:"");
//echo box_verify(2,"Alamat Saat Ini",'v1_street',$sa_v1_street,$pv_v1_street,isset($v1_street)?$v1_street:"");
echo box_verify(2,"Tempat Lahir",'v2_place_birth',$sa_v2_place_birth,$pv_v2_place_birth,isset($v2_place_birth)?$v2_place_birth:"");
echo box_verify(3,"Tanggal Lahir",'v2_date_birth',$sa_v2_date_birth,$pv_v2_date_birth,isset($v2_date_birth)?$v2_date_birth:"");
echo box_verify(4,"Nama Ibu Kandung",'v2_mother_name',$sa_v2_mother_name,$pv_v2_mother_name,isset($v2_mother_name)?$v2_mother_name:"");
echo box_verify(5,"Lama Menetap",'v1_lama_tahun',$sa_v1_lama_tahun,$pv_v1_lama_tahun,isset($v1_lama_tahun)?$v1_lama_tahun:"");
echo box_verify(6,"Status Rumah",'v1_house_status',$sa_v1_house_status,$pv_v1_house_status,isset($v1_house_status)?$v1_house_status:"");

echo box_verify(7,'Nama Saudara','v1_fam_name',$sa_v1_fam_name,$pv_v1_fam_name,isset($v1_fam_name)?$v1_fam_name:"");
echo box_verify(8,"Hubungan Keluarga",'v1_fam_relation',$sa_v1_fam_relation,$pv_v1_fam_relation,isset($v1_fam_relation)?$v1_fam_relation:"");
//echo box_verify(10,"Alamat Saudara",'v1_fam_street',$sa_v1_fam_street,$pv_v1_fam_street,isset($v1_fam_street)?$v1_fam_street:"");
//echo box_verify(8,"Kelurahan",'v1_fam_kel',$sa_v1_fam_kel,$pv_v1_fam_kel,isset($v1_fam_kel)?$v1_fam_kel:"");
//echo box_verify(9,"Kecamatan",'v1_fam_kec',$sa_v1_fam_kec,$pv_v1_fam_kec,isset($v1_fam_kec)?$v1_fam_kec:"");
//echo box_verify(10,"Kota",'v1_fam_kota',$sa_v1_fam_kota,$pv_v1_fam_kota,isset($v1_fam_kota)?$v1_fam_kota:"");
//echo box_verify(11,"Kode Pos",'v1_fam_pos',$sa_v1_fam_pos,$pv_v1_fam_pos,isset($v1_fam_pos)?$v1_fam_pos:"");
//echo box_verify(12,"Nomor Telpon",'v1_fam_phone',$sa_v1_fam_phone,$pv_v1_fam_phone,isset($v1_fam_phone)?$v1_fam_phone:"");
//echo box_verify(13,"Nama Customer",'cust_name',$sa_v1_cust_name,$pv_v1_cust_name,isset($v1_cust_name)?$v1_cust_name:"");
//echo box_verify(14,"Nama Ibu Kandung",'v1_mother_name',$sa_v1_mother_name,$pv_v1_mother_name,isset($v1_mother_name)?$v1_mother_name:"");
//echo box_verify(16,"RT/RW",'v1_rtrw',$sa_v1_rtrw,$pv_v1_rtrw,isset($v1_rtrw)?$v1_rtrw:"");
//echo box_verify(17,"Kelurahan",'v1_kel',$sa_v1_kel,$pv_v1_kel,isset($v1_kel)?$v1_kel:"");
//echo box_verify(18,"Kecamatan",'v1_kec',$sa_v1_kec,$pv_v1_kec,isset($v1_kec)?$v1_kec:"");
//echo box_verify(19,"Kota",'v1_kota',$sa_v1_kota,$pv_v1_kota,isset($v1_kota)?$v1_kota:"");
//echo box_verify(20,"Kode Pos",'v1_pos',$sa_v1_pos,$pv_v1_pos,isset($v1_pos)?$v1_pos:"");
//echo box_verify(14,"Nomor Telpon",'v1_phone',$sa_v1_phone,$pv_v1_phone,isset($v1_phone)?$v1_phone:"");
//echo box_verify(15,"Nomor Handphone",'v1_hp',$sa_v1_hp,$pv_v1_hp,isset($v1_hp)?$v1_hp:"");

echo box_verify(9,"Nama Perusahaan",'v3_com_name',$sa_v3_com_name,$pv_v3_com_name,isset($v3_com_name)?$v3_com_name:"");
//echo box_verify(12,"Alamat Perusahaan",'v3_street',$sa_v3_street,$pv_v3_street,isset($v3_street)?$v3_street:"");
//echo box_verify(13,"Bidang Usaha",'v3_bidang',$sa_v3_bidang,$pv_v3_bidang,isset($v3_bidang)?$v3_bidang:"");
echo box_verify(10,"Status Karyawan",'v3_emp_status',$sa_v3_emp_status,$pv_v3_emp_status,isset($v3_emp_status)?$v3_emp_status:"");
//echo box_verify(15,"Jabatan",'v3_jabatan',$sa_v3_jabatan,$pv_v3_jabatan,isset($v3_jabatan)?$v3_jabatan:"");
//echo box_verify(23,"Status Kepemilikan Perusahaan",'v3_com_status',$sa_v3_com_status,$pv_v3_com_status,isset($v3_com_status)?$v3_com_status:"");
echo box_verify(11,"Masa Kerja",'v3_year',$sa_v3_year,$pv_v3_year,isset($v3_year)?$v3_year:"");
echo box_verify(12,"Gaji Rp. ",'v3_salary',$sa_v3_salary,$pv_v3_salary,isset($v3_salary)?$v3_salary:"");
echo box_verify(13,"Nama Atasan",'v3_supervisor',$sa_v3_supervisor,$pv_v3_supervisor,isset($v3_supervisor)?$v3_supervisor:"");
echo box_verify(14,"Nama Bagian HRD",'v3_hrd',$sa_v3_hrd,$pv_v3_hrd,isset($v3_hrd)?$v3_hrd:"");

echo "<input type='hidden' name='id' id='id'>";
echo "<strong>Catatan : </strong><input type='text' name='catatan' id='catatan' value='$catatan' style='width:90%'>";
echo form_hidden("app_id",$app_id);
echo form_close();

function box_verify($nomor,$caption,$fld,$sa_text,$pv_text,$checked=""){
	$s="
	<div class='box_verify'>
		<table class='table2' style='width:100%'>
		<thead><tr><th>$nomor</th><th style='width:70%'>$caption</th>
		<th><input type='checkbox' id='$fld' name='$fld' value='1' style='width:50px' $checked >Sesuai</th></tr>
		</thead>
		<tbody>
			<tr><td><strong>SA</strong></td><td colspan=2>$sa_text</td></tr>
			<tr><td><strong>PV</strong></td><td colspan=2>$pv_text</td></tr>
		</tbody>
		</table>
	</div>";
	return $s;
}
?>
<style>
.box_verify {
	margin-bottom:5px;
}
</style>
