<div class="row-fluid" >
	<?php
	if($cmd=="list") {
		echo $browse;		
	} else {
	    $bank_account_number="";
        $bank_name="";
        $contact_name="";
        $city="";
		if(!isset($readonly))$readonly='';
	?>
		<div class="col-md-10">
			<div class="row">
				<form  class="form" id='frmBank' method='post' >
					<input type='hidden' name='mode' id='mode' value='<?=$mode?>'>
					<?=my_input_2("Nomor Rekening","bank_account_number",$bank_account_number,'','',$readonly)?>
					<?=my_input_2("Nama Bank","bank_name",$bank_name)?>
					<?=my_input_2("Nama Pemilik Rekening","contact_name",$contact_name)?>
					<?=my_input_2("Cabang / Kota","city",$city)?>
				</form>			
			</div>
		</div>
		<script language='javascript'>
		function save_form(){
			var kode=$("#bank_account_number").val();
			if(kode==""){ alert("Kode Rekening harus diisi !");return false }
			var url="<?=base_url()?>index.php/eshop_admin/banks/save";
			var next_url='<?=base_url()?>index.php/eshop_admin/banks/browse';
			$('#frmBank').ajax_post(url,'undefined',next_url); 
		};
		</script>
	<?php } ?>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

