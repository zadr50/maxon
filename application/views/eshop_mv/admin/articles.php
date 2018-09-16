
<div class='well'>
<h3><?=$caption?></h3>
<p>Dibawah ini adalah text artikel berisi content untuk tampilan toko online anda, 
silahkan edit pada baris yang diinginkan, tentukan dan setting posisi dimana 
article tersebut ingin ditampilkan.</p>
</div>
<div class="row-fluid" >
	<?php
	$limit=100;
	if($cmd=="list") {
		$this->load->library("browser");
		$browse=new browser();
		$config['tablename']='';
		$config['sql']='select id,title,category,date_post,author from articles';
		$config['primary_key']="id";
		$config['order_by']="title";
		$config['where']="where category='eshop'";
		$config['use_bootstrap']=true;
		$config['id']="tblArt";
		$config['limit']=$limit;
		$config['caption']='Manage Article';
		$config['fields']=array(
			'id'=>array("caption"=>"Id",'size'=>50),
			'title'=>array('caption'=>'Judul','size'=>50),
			'category'=>array('caption'=>'Kelompok','size'=>200),
			'date_post'=>array('caption'=>'Tanggal','size'=>50),
			'author'=>array('caption'=>'Author','size'=>50)
		);
		$config['controller']="articles";

		if(!isset($page))$page=0;
		$config['page']=$page;
		$config['exclude_script']=false;

		$browse->init($config);
		$browse->render();		
		
	} else {
 
	$form[]=array("input_type"=>"text","data"=>array("caption"=>"Judul artikel",
			"field_name"=>"title","value"=>$title,
			"sub_caption"=>"Isi judul artikel."));
	$form[]=array("input_type"=>"text","data"=>array("caption"=>"Section Position",
			"field_name"=>"section_name","value"=>$section_name,
			"sub_caption"=>"Konten ini akan ditampilkan di section mana."));
	$form[]=array("input_type"=>"text","data"=>array("caption"=>"Class Column Position",
			"field_name"=>"class_name","value"=>$class_name,
			"sub_caption"=>"Isi nama class untuk posisi kolom artikel akan ditampilkan."));
	$form[]=array("input_type"=>"text","data"=>array("caption"=>"Id",
			"field_name"=>"id","value"=>$id,
			"sub_caption"=>"Id untuk article ini."));
	$form[]=array("input_type"=>"textarea","data"=>array("caption"=>"Isi artikel dieditor dibawah ini",
			"caption_class"=>"col-md-4","text_class"=>"col-md-12","align"=>"left",
			"field_name"=>"content","value"=>$content,'text_class_field'=>'ckeditor',
			"sub_caption"=>"Isi konten artikel"));

			
	echo "<div class='col-md-10'>";
	echo form_open('','class="form-horizontal" id="frmMain" ');
	echo render_form($form);
	echo form_close();	
	echo "</div>";
	echo "<div class='col-md-8 well'>";
	echo "<button style='float:left' class='btn btn-warning' name='cmdCancel' onclick='cmdCancel_Click();return false;'>Cancel</button>";		
	echo "<button style='float:right' class='btn btn-primary' name='cmdSave' onclick='cmdSave_Click();return false;'>Save Changes</button>";		
	echo "</div>";

	
	?>
		<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
		<script language='javascript'>
		function cmdSave_Click(){
			var kode=$("#title").val();
			if(kode==""){alert("Isi judul artikel !");return false}
			var url="<?=base_url()?>index.php/eshop_admin/articles/save";
			var next_url='<?=base_url()?>index.php/eshop_admin/articles';
			for ( instance in CKEDITOR.instances ) {
				CKEDITOR.instances[instance].updateElement();
			}			
			$('#frmMain').ajax_post(url,'',next_url); 
		};
		function cmdCancel_Click() {
			var url="<?=base_url()?>index.php/eshop_admin/articles";
			window.open(url,"_self");
		}

		</script>
	
	<?php } ?>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

