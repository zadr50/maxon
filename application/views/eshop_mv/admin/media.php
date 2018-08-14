<div class='well'>
	<h3><?=$caption?></h3>
	<p>Dibawah ini adalah kumpulan file gambar/video dalam toko online anda.</p>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload</button>
</div>
<div class="row-fluid">
<?php 
	echo "<div style='overflow:scroll;height:400px'>";
	for($i=0;$i<count($img_files);$i++)
	{
		$file=$img_files[$i];
		echo "<div class='col-md-1' style='margin:10px;height:90px;padding:5px;' align='center'>";
		echo "<img width=80 height=80 src='".base_url()."$folder_images/$file'>";
		echo "</div>";
	}
	echo "</div>";
	
?>
</div>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Image Information</h4>
      </div>
      <div class="modal-body">
		<?php
			$form[]=array("input_type"=>"text","data"=>array("caption"=>"Judul",
					"field_name"=>"title","value"=>$title,
					"sub_caption"=>"Ketik judul untuk gambar ini."));
			$form[]=array("input_type"=>"textarea","data"=>array("caption"=>"Keterangan",
					"field_name"=>"description","value"=>$description,
					"sub_caption"=>"Keterangan gambar."));
			$form[]=array("input_type"=>"file","data"=>array("caption"=>"Select Image File",
					"field_name"=>"filename","value"=>$filename,
					"sub_caption"=>"Pilih nama file images."));
			$form[]=array("input_type"=>"hidden","data"=>array("caption"=>"id",
					"field_name"=>"id","value"=>$id,
					"sub_caption"=>"Id."));
			$form[]=array("input_type"=>"hidden","data"=>array("caption"=>"mode",
					"field_name"=>"mode","value"=>$mode,
					"sub_caption"=>"Mode."));
					
			echo "<div style='padding:20px'>";
			echo form_open('','class="form-horizontal" id="frmMain" role="form" ');
			echo render_form($form);
			echo form_close();
			echo "</div>";
		?>		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button onclick='frmMain_Save();return false' type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		<script language='javascript'>
		function frmMain_Save(){
			var url="<?=base_url()?>index.php/eshop_admin/media/save";
			var next_url='<?=base_url()?>index.php/eshop_admin/media';
			$('#frmMain').ajax_post(url,'',next_url); 
		};
		</script>

