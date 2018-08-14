<div class='row'>
	<div class='alert alert-info'>
		<p><img src="<?=base_url()?>images/ico_setting.png" style="float:left">
		Halaman ini berisi pengaturan dan setting yang diperlukan 
		untuk operasional MAXON secara otomatis, silahkan consult 
		cara mengisi setingan disini karena akan berpengaruh besar
		terhadap jalannya aplikasi.
		</p>
	</div>
</div>
<div class='row'>
	<div class='col-xs-8 col-sm-8 col-md-7'>
		<?php 
		$data["unit_of_measure"]=$unit;
		echo load_view('admin/unit_of_measure',$data);
		?>
	</div>
</div>