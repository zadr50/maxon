<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>

<div><div class="thumbnail">
<legend>EDIT ARTICLE</legend>

	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	
	?>
</div></H1>
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


<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/help/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<div class="form-group">
	<label for="doc_name" class="col-sm-3 control-label">Kode</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="doc_name" name="doc_name" value="<?=$doc_name?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="date_post" class="col-sm-3 control-label">Tanggal</label>
		<div class="col-sm-8">
			<input type="text" class="form-control easyui-datetimebox" id="date_post"
			style="width:150px" name="date_post" value="<?=$date_post?>" placeholder=""
			data-options="formatter:format_date,parser:parse_date"
			>
		</div>
	</div>

	<div class="form-group">
	<label for="category" class="col-sm-3 control-label">Kelompok</label>
		<div class="col-sm-8">
			<?=form_dropdown('category',$category_list,$category,"class='form_control'")?>
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
		<div class="col-md-5">
			<textarea id='content' name='content' class="ckeditor" ><?=$content?></textarea>
		</div>
	</div>

<!-- ITEM DETIAL MATERIAL -->

	</form>
</div>

<script type="text/javascript">
    function save_this(){
        if($('#doc_name').val()===''){alert('Isi dulu kode !');return false;};
        $('#myform').submit();
    }
</script>  

 