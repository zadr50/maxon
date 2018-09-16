<div class="row-fluid" >
	<?php
	if($cmd=="list") {
		$this->load->library("browser");
		$browse=new browser();
		$config['tablename']='customers';
		$config['sql']='';
		$config['primary_key']="customer_number";
		$config['order_by']="customer_number";
		$config['where']="";
		$config['use_bootstrap']=true;
		$config['id']="tbl";
		$config['limit']=$limit;
		$config['caption']='Manage Customers';
		$config['fields']=array(
			'customer_number'=>array("caption"=>"Kode",'size'=>50),
			'company'=>array('caption'=>'Nama Customer','size'=>50),
			'street'=>array('caption'=>'Alamat','size'=>200),
			'city'=>array('caption'=>'Kota','size'=>50),
			'phone'=>array('caption'=>'Telp','size'=>50),
			'password'=>array('caption'=>'Password','size'=>50),
			'zip_postal_code'=>array('caption'=>'Kode Pos','size'=>50),
			'email'=>array('caption'=>'Email','size'=>59)
		);
		$config['controller']=base_url()."index.php/eshop_admin/customers";

		if(!isset($page))$page=0;
		$config['page']=$page;

		$browse->init($config);
		$browse->render();		
		
	} else {
	?>
		<div class="col-md-8">
			<div class="">
				<form  enctype="multipart/form-data" class="form-horizontal" id='frmMain' method='post' >
					<input type='hidden' name='mode' id='mode' value='<?=$mode?>'>
					<?=my_input("Kode Pelanggan","customer_number",$customer_number)?>
					<?=my_input("Nama Pelanggan","company",$company)?>
					<?=my_textarea("Alamat","street",$street)?>
					<?=my_input("Kode Pos","zip_postal_code",$zip_postal_code)?>				
					<?=my_input("Phone","phone",$phone)?>				
					<?=my_input("Email","email",$email)?>				
					<?=my_input("Password","password",$password)?>				
				</form>	  
			</div>
			<div  class=''>
				<button type="button" class="btn btn-primary" onclick='save_item();return false'>Save changes</button>
			</div>
		</div>
		<script language='javascript'>
		function save_item(){
			var kode=$("#customer_number").val();
			if(kode==""){alert("Isi kode !");return false}
			var url="<?=base_url()?>index.php/eshop_admin/customers/save";
			var next_url='<?=base_url()?>index.php/eshop_admin/customers/browse';
			$('#frmMain').ajax_post(url,'undefined',next_url); 
		};

		</script>
	
	<?php } ?>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

