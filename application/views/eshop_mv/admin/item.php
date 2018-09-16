<div class="row-fluid" >
	<?php
	if(!isset($controller)) $controller=base_url()."index.php/eshop_admin/items";
	if(!isset($cmd))$cmd='view';
	if($cmd=="list") {
		$this->load->library("browser");
		$browse=new browser();
		$config['tablename']='inventory';
		//$config['sql']="select item_number,description,unit_of_measure,retail,cost_from_mfg from inventory";
		$config['sql']='';
		$config['primary_key']="item_number";
		$config['order_by']="item_number";
		$config['where']="where create_by='".cust_id()."'";
		$config['use_bootstrap']=true;
		$config['id']="tbl";
		$config['limit']=$limit;
		$config['caption']='Manage Item Catalog';
		$config['fields']=array(
			'item_number'=>array("caption"=>"Kode",'size'=>10),
			'description'=>array('caption'=>'Nama Barang','size'=>50),
			'unit_of_measure'=>array('caption'=>'Unit','size'=>10),
			'retail'=>array('caption'=>'Harga Jual','size'=>9,'type'=>'numeric'),
			'cost'=>array('caption'=>'Beli','size'=>9,'type'=>'numeric'),
			'create_by'=>array('caption'=>'CreateBy','size'=>10)
			
		);
		 
		$config['controller']=$controller;

		if(!isset($page))$page=0;
		$config['page']=$page;

		$browse->init($config);
		$browse->render();		
		
	} else {
	?>
		<div class="col-md-10">
		
			<div class='row'>
				 <?php if($message!="") { ?>
				<div class="alert alert-success"><? echo $message;?></div>
				<?php } ?>
			</div>
			<div class="row">
				<?php 
				include_once "item_form.php"; 
				?>
			</div>
		</div>
		<script language='javascript'>
		function save_item(){
			var item_no=$("#item_number").val();
			var item_name=$("#description").val();
			if(item_no==""){alert("Isi kode barang !");return false}
			if(item_name==""){alert("Isi nama barang !");return false}
			var url="<?=$controller?>/save";
			var next_url='<?=$controller?>/browse';
			//need repopulate before ajax submit for ckeditor
			for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
			$('#frmBarang').ajax_post(url,'undefined',next_url); 
			
		};

		</script>
	
	<?php } ?>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

