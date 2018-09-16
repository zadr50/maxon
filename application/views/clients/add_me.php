 
<?
	if(!isset($message))$message="";
?>
	<?php if (validation_errors()) { ?>
		<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<h4>Terjadi Kesalahan!</h4> 
		<?php echo validation_errors(); ?>
		</div>
	<?php } ?>
	 <?php if($message!="") { ?>
	<div class="alert alert-success"><?php echo $message;?></div>
	<? } ?>


	<form id="frmAddMyCompany" role="form" method="post"  enctype="multipart/form-data">
		<div class="form-group">
		<label for="mac_id" class="control-label">Judul yang tampil di bagian bawah</label>
			 				<input type="text" class="form-control" id="add_me_title" name="add_me_title" value="" 
					placeholder="Enter for title area">
		</div>
		<div class="form-group">
		<label for="mac_id" class=" control-label">Keterangan dan informasi perusahaan anda</label>
			 
				<textarea type="text" class="form-control" id="add_me_note" style="height:100px" name="add_me_note"  
					placeholder="Enter your company description"></textarea>
 		</div>
		<div class="form-group">
		<label for="mac_id" class="control-label">Upload Logo (Jenis JPG ukuran 100x100)</label>
		<input type="file"  class="btn btn-default" id="userfile" name="userfile" >
		</div>
		<div class="form-group">
			<input onclick="add_my_company()" type="button" class="btn btn-primary" id="add_me_submit" name="add_me_submit" value="Submit" >
		</div>


	</form>
<script>
function add_my_company()
	{
		var url='<?=base_url()?>index.php/welcome/add_my_company';
			$('#frmAddMyCompany').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					console.log(result);
					var result = eval('('+result+')');
					if (result.success){
						location.reload();
					} else {
						$('#error_upload').html(result.error);
					}
				}
			});
		 

	}
</script>