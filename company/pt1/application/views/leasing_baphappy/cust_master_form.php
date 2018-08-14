<?
if(isset($mode)){
	$disabled=$mode=="view"?" disabled ":"";
}

?>
	<div class='thumbnail box-gradient'>
	<form id="frmMain"  method="post" role='form' class="form-horizontal">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		
		<? 
		
		include_once "cust_master_form_top.php" ?>	
		<p class='alert alert-warning'><i>*** pastikan simpan dulu sebelum isi detail *** </i></p>
		
		<div class="easyui-tabs" >
			<div title='DATA PRIBADI' class='  box-gradient'><? 
			
			include_once "personal.php" ?></div>
			
			<div title='PENGHASILAN'><? include_once "penghasilan.php" ?></div>
			<div title='PEKERJAAN'><? include_once "pekerjaan.php" ?></div>
			<div title='ALAMAT'><? 
				if($mode=='view' or $mode=='edit') include_once "alamat.php" 
			?></div>
			<div title='KARTU KREDIT'><? 
				if($mode=='view' or $mode=='edit') include_once "kartukredit.php" 
			?></div>
			<div title='DATA LAINNYA'>
				<div class='col-sm-6'>
				<table width='100%' style="border:none">
					<tr><td>Nama Akhiran</td><td><?=form_input('last_name',$last_name, $disabled);?></td></tr>
					<tr><td>Alamat/Gedung</td><td><?=form_input('suite',$suite, $disabled);?></td></tr>
					<tr><td>Wilayah</td><td><?=form_input('region',$region, $disabled);?></td></tr>
					<tr><td>Negara</td><td><?=form_input('country',$country, $disabled);?></td></tr>
					<tr><td>Fax</td><td><?=form_input('fax',$fax, $disabled);?></td></tr>
					<tr><td>Email</td><td><?=form_input('email',$email, $disabled);?></td></tr>
				</table width='100%' style="border:none">
				</div>
				<div class='col-sm-6'>
				<table width='100%' style="border:none">
					<tr><td>Nama Bank</td><td><?=form_input('bank_name',$bank_name, $disabled);?></td></tr>
					<tr><td>Nomor Rek Bank</td><td><?=form_input('bank_acc_number',$bank_acc_number, $disabled);?></td></tr>
					<tr><td>Nomor Kartu Kredit</td><td><?=form_input('credit_card_number',$credit_card_number, $disabled);?></td></tr>
					<tr><td>Kirim Email</td><td><?=form_input('is_send_email',$is_send_email, $disabled);?></td></tr>
					<tr><td>Parent Cust Id</td><td><?=form_input('parent_cust_id',$parent_cust_id, $disabled);?></td></tr>				
				</table>
				</div>
			</div>		
			<div title="FOTO">
				<div class="cust_foto thumbnail" id='div_cust_foto'>
					<?
						if($cust_foto!=""){
							echo "<img src='".base_url()."tmp/".$cust_foto."'>";
						}
					?>
				</div>
				<div class='thumbnail'>
				<table class='table2' width='100%'>
				<tr><td>Foto 1 : </td><td>
					<input value="<?=$cust_foto?>" type='text' 
					name='cust_foto' id='cust_foto' >
					<?=link_button("Upload","upload_foto(0)","save",'false')?>
					<?=link_button("View","view_foto(0)","search",'false')?>
				</td></tr>
				<tr><td>Foto 2 : </td><td>
					<input value="<?=$cust_foto_2?>" type='text' 
					name='cust_foto_2' id='cust_foto_2' >
					<?=link_button("Upload","upload_foto(2)","save",'false')?>
					<?=link_button("View","view_foto(2)","search",'false')?>
				</td></tr>
				<tr><td>Foto 3 : </td><td>
					<input value="<?=$cust_foto_3?>" type='text' 
					name='cust_foto_3' id='cust_foto_3' >
					<?=link_button("Upload","upload_foto(3)","save",'false')?>
					<?=link_button("View","view_foto(3)","search",'false')?>
				</td></tr>
				<tr><td>Foto 4 : </td><td>
					<input value="<?=$cust_foto_4?>" type='text' 
					name='cust_foto_4' id='cust_foto_4' >
					<?=link_button("Upload","upload_foto(4)","save",'false')?>
					<?=link_button("View","view_foto(4)","search",'false')?>
				</td></tr>
				<tr><td>Foto 5 : </td><td>
					<input value="<?=$cust_foto_5?>" type='text' 
					name='cust_foto_5' id='cust_foto_5' >
					<?=link_button("Upload","upload_foto(5)","save",'false')?>
					<?=link_button("View","view_foto(5)","search",'false')?>
				</td></tr>
				</table>
				</div>
			</div>
		</div>
	</form>
	</div>	 
