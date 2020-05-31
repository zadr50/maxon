<legend>Generate Slip Gaji</legend>
<div class='alert alert-info'>
<p>
	Halaman ini dipakai untuk membuat data slip gaji untuk semua karyawan 
	pada periode yang dipilih dibawah ini.</br>
	Pilihlah periode yang belum digenerate kemudian klik tombol [Proses]
</p>
<p>* optional boleh tidak diisi</p>
</div>
<?php 
$field=array("caption"=>"Select Periode : ",
	"field_name"=>"pay_period",
	"show_button"=> link_button("","dlgLovPeriode_show()","search").
	"  ".link_button("Proses","proses()","save")
	);
echo my_input($field,"pay_period",Date("Y-m"));
echo my_input(
	array(
		"caption"=>"* Hanya Satu NIP","field_name"=>"nip_cari"	
	),"nip_cari");
echo "</br>";
echo $lookup_periode;
?>
<div id='divGenerate'>

</div>
<script type="text/javascript">
    function proses(){
        if($('#pay_period').val()===''){alert('Isi dulu periode penggajian !');return false;};
		url='<?=base_url()?>index.php/payroll/generate/proses';
		get_this(url,{pay_period:$("#pay_period").val(),nip_cari:$("#nip_cari").val()},"divGenerate");
    }
</script>