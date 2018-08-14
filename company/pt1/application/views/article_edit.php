<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
<div class="thumbnail box-gradient">
	<?
	if(!isset($show_tool))$show_tool="true";
	$show=$show_tool=="true"?true:false;
	if($show) echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_item()','print');		
	if($show) echo link_button('Add','','add','true',base_url().'index.php/articles/add');		
	echo link_button('Search','','search','true',base_url().'index.php/articles');		
	if($mode=="view") echo link_button('Refresh','','reload','true',base_url().'index.php/articles/view/'.$id);		
	if($show) echo link_button('Delete', 'delete_article()','remove');		
	echo link_button('Help', 'load_help()','help');	
	$mode=="view"?$readonly=" readonly":$readonly="";
	$mode=="view"?$disable=" disable":$disable="";
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
</div>

<div class="thumbnail">	

<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<h4>Terjadi Kesalahan!</h4> 
	<?php echo validation_errors(); ?>
	</div>
<?php } ?>
 <?php if($message!="") { ?>
<div class="alert alert-success"><? echo $message;?></div>
<? } ?>


<form id="myform" role="form" method="post" action=""  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<div class="form-group">
	<label for="id" class="col-sm-3 control-label">Kode</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="id" name="id" value="<?=$id?>" placeholder="" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="id" class="col-sm-3 control-label">Doc Name</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="doc_name" name="doc_name" value="<?=$doc_name?>" placeholder="" >
		</div>
	</div>
	 
	<div class="form-group">
	<label for="date_post" class="col-sm-3 control-label">Tanggal</label>
		<div class="col-sm-8">
			<input type="text" class="form-control easyui-datetimebox" 
				data-options='formatter:format_date,parser:parse_date' id="date_post"
			style="width:150px" name="date_post" value="<?=$date_post?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="title" class="col-sm-3 control-label">Judul</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="title" name="title" value="<?=$title?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="author" class="col-sm-3 control-label">Pembuat</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="author" name="author" value="<?=$author?>" placeholder="">
		</div>
	</div>
	<div class="form-group">
	<label for="category" class="col-sm-3 control-label">Category</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="category" name="category" value="<?=$category?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<textarea id='content' name='content' class="ckeditor" style="height:600px"><?=$content?></textarea>
		</div>
	</div>

<!-- ITEM DETIAL MATERIAL -->

	</form>
</div>

<script type="text/javascript">
    function save_this(){
		url='<?=base_url()?>index.php/articles/save';
		$('#myform').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#mode').val('view');
					log_msg('Data sudah tersimpan.');
					if($("#id").val()=="0"){
						$("#id").val(result.id);
					}
					alert("Data sudah tersimpan.");
				} else {
					log_err(result.msg);
				}
			}
		});
    }
	$(document).ready(function(){
		console.log('start my script');
		var telkomspeedy = $('[src*="u-ad.info"]');
		 if (telkomspeedy){
				console.log(telkomspeedy);
			   telkomspeedy.remove();
		 }
		 $('script:contains("u-ad.info")').remove();    
	});
</script>  

 