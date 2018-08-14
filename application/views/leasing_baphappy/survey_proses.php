<?			echo "<div class='thumbnail box-gradient'>";
			echo link_button("Help","load_help()","help");
			echo "</div>";

	$CI =& get_instance();

?>
<legend>Data Survey Lokasi</legend>
<form name='frmMain' method='post' id='frmMain'>
<table class='table2' style='width:100%'>
<tr><td style='width:25%'>Nama Debitur</td>
<td><?=$ls_cust_master->cust_name?> [ 
<a href='#' onclick='view_cust("<?=$ls_app_master->cust_id?>")'>
<?=$ls_app_master->cust_id?>
 ]</td></tr>
<tr><td>Alamat</td><td><?
	echo $ls_cust_master->street
	.' Kec: '.$ls_cust_master->kec.' Kel: '.$ls_cust_master->kel
	.' Rt: '.$ls_cust_master->rt.' Rw: '.$ls_cust_master->rw;
	
	?></td></tr>
<tr><td>Tanggal</td><td><?=date('Y-m-d')?></td></tr>
<tr><td>Survey Ke</td><td>1 &nbsp Handphone : &nbsp <?=$ls_cust_master->hp?></td></tr>
<tr><td>Hasil Survey</td><td><textarea name='hasil' style='width:100%'></textarea></td></tr>
<tr><td>Nomor SPK</td><td> 
<a href='#' onclick='view_spk("<?=$ls_app_master->app_id?>")'><?=$ls_app_master->app_id?></a>

</td></tr>
<tr><td>Nama Surveyor</td><td><?=$CI->access->user_id()?></td></tr>
<tr><td>Foto Rumah Depan</td>
<td>
	<button type="button" onclick="upload_foto(0)" class="btn btn-info">Upload</button>	
	<div class="foto_depan"></div>
</td></tr>
<tr><td>Foto Samping Kanan</td><td>
	<button type="button" onclick="upload_foto(1)" class="btn btn-info">Upload</button>	
	<div class="foto_kanan"></div>
</td></tr>
<tr><td>Foto Samping Kiri<td>
	<button type="button" onclick="upload_foto(2)" class="btn btn-info">Upload</button>	
	<div class="foto_kiri"></div>
</td></tr>
<tr><td>Foto 1<td>
	<button type="button" onclick="upload_foto(3)" class="btn btn-info">Upload</button>	
	<input type="text" id="foto_ket_1" name="foto_ket_1"  style='width:300px'>
	<div class="foto_1"></div>
</td></tr>
<tr><td>Foto 2<td>
	<button type="button" onclick="upload_foto(4)" class="btn btn-info">Upload</button>	
	<input type="text" id="foto_ket_2" name="foto_ket_2"  style='width:300px'>
	<div class="foto_2"></div>
</td></tr>
<tr><td>Foto 3<td>
	<button type="button" onclick="upload_foto(5)" class="btn btn-info">Upload</button>	
	<input type="text" id="foto_ket_3" name="foto_ket_3"  style='width:300px'>
	<div class="foto_3"></div>
</td></tr>
<tr><td>Foto 4<td>
	<button type="button" onclick="upload_foto(6)" class="btn btn-info">Upload</button>	
	<input type="text" id="foto_ket_4" name="foto_ket_4"  style='width:300px'>
	<div class="foto_4"></div>
</td></tr>
<tr><td>Foto 5<td>
	<button type="button" onclick="upload_foto(7)" class="btn btn-info">Upload</button>	
	<input type="text" id="foto_ket_5" name="foto_5" style='width:300px'>
	<div class="foto_5"></div>
</td></tr>

<table>
<p></p> 
<input type='hidden' name='app_id' id='app_id' value='<?=$ls_app_master->app_id;?>'>
<input type='hidden' name='foto_depan' id='foto_depan' >
<input type='hidden' name='foto_kanan' id='foto_kanan' >
<input type='hidden' name='foto_kiri' id='foto_kiri' >
<input type='hidden' name='foto_1' id='foto_1' >
<input type='hidden' name='foto_2' id='foto_2' >
<input type='hidden' name='foto_3' id='foto_3' >
<input type='hidden' name='foto_4' id='foto_4' >
<input type='hidden' name='foto_5' id='foto_5' >
</form>

<div class='thumbail'>
	<button type="button" onclick="save()" class="btn btn-info">SIMPAN</button>	
</div>

<div id="dlgGambar" class="easyui-dialog"  
 style="width:300px;height:200px;padding:5px 5px" closed="true" >
	<div class="thumbnail">
		<?php 
		$url=base_url()."index.php/leasing/survey/upload_foto";
		echo form_open_multipart($url,"id='frmUpload'");
		?>
		<input type="file" name="userfile" id="userfile" size="20" title="Pilih Gambar" stye="float:left" />
		<input type="button" value="Submit" onclick="do_upload()">  
		<?=form_close();?>
	</div>
	<div id='error_upload'></div>
	<input type='hidden' name='no_gambar' id='no_gambar' value=0>
</div>



<script language="javascript">
  	function save(){
  		if($("#hasil").val()==''){alert('Isi hasil survey !');return false;}
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/survey/hasil_survey';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
//					log_msg('Data sudah tersimpan.');
//					window.parent.$('#tt').tabs("close", "proses_survey");
					window.parent.location.reload(); 
				} else {
					log_err(result.msg);
				}
			}
		});
  	}	 
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/survey_proses");
	}
	function upload_foto(nomor){
		$("#userfile").val('');
		$('#no_gambar').val(nomor);
		$('#dlgGambar').dialog('open').dialog('setTitle','Upload Gambar');
	}
  	function do_upload(){
		$('#frmUpload').form('submit',{
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				console.log(result);
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Gambar sudah tersimpan.');
					var upload_data=result.upload_data;
					var no_gambar=$("#no_gambar").val();
					img="foto_depan";
					if(no_gambar=="1")img="foto_kanan";
					if(no_gambar=="2")img="foto_kiri";
					if(no_gambar=="3")img="foto_1";
					if(no_gambar=="4")img="foto_2";
					if(no_gambar=="5")img="foto_3";
					if(no_gambar=="6")img="foto_4";
					if(no_gambar=="7")img="foto_5";
					
					var img2=upload_data['file_name'];
					$('#'+img).val(img2);
					$('#dlgGambar').dialog('close');
					$('.'+img).html('<img  style="width:100px;height:100px;" src="<?=base_url()?>tmp/'+img2+'" />');
					
				} else {
					$('#error_upload').html(result.error);
				}
			}
		});
	}
	function view_spk(app_id){
		var url="<?=base_url()?>index.php/leasing/app_master/view/"+app_id+"/false";
		add_tab_parent("view_spk_"+app_id,url);
	}
	function view_cust(cust_id){
		var url="<?=base_url()?>index.php/leasing/cust_master/view/"+cust_id+"/view/false";
		add_tab_parent("ViewCst"+cust_id,url);
	}
	
</script>