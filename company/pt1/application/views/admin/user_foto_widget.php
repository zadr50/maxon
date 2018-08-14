 
			<div id='divGambar'>
				<img width=300 height=300 src='
				<?php 
				if($path_image==""){
					echo base_url()."images/no-images.png";
				} else {
					echo base_url()."tmp/".$path_image;
				}
				?>'/>
			</div>
			
			<?=form_open_multipart(base_url()."index.php/user/do_upload_picture","id='frmUpload'");?>
			<input type='hidden' id='user_id_image'  name='user_id_image'  value='<?=$id?>'>
			<input type="file" name="userfile" id="userfile" size="20" title="Pilih Gambar" stye="float:left" />
			<input type="button" value="Submit" onclick="do_upload()" class='btn btn-primary'>  
			<?="</form>"?>
			<div id='error_upload'></div>
			<p><? echo $path_image ?></p>
 
<script language='javascript'>
  	function do_upload()
	{
		var xurl='<?=base_url()?>index.php/user/do_upload_picture';
		$('#frmUpload').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				console.log(result);
				var result = eval('('+result+')');
				if (result.success){
					
					//$.messager.show({
					//	title:'Success',msg:'Data sudah tersimpan. Silahkan simpan formulir ini.'
					//});
					
					var upload_data=result.upload_data;
					$('#divGambar').html("<img src='<?=base_url()?>tmp/"+upload_data['file_name']+"' width='300px' height='300px'>");
				} else {
					$('#error_upload').html(result.error);
				}
			}
		});
	}
</script>