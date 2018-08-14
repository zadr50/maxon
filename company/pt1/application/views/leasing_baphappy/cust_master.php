<legend><?=$title?></legend>
<?	if($mode=='view'){ 	$disabled='disable';} else {$disabled='';}
	if(!isset($show_tool))$show_tool="true";
	$show=$show_tool=="true"?true:false;
	if($show){
		require_once(__DIR__.'../../aed_button.php');	
	}
	echo validation_errors(); 
?>
<? 

	include_once "cust_master_form.php";
	include_once "alamat_form.php"; 
	include_once "kartukredit_form.php";	
?>
<div id="dlgGambar" class="easyui-dialog"  
 style="width:300px;height:200px;padding:25px 25px" closed="true" >
	<div class="thumbnail box-gradient">
		<input type='hidden' name='dlgGambar_cust_id' id='dlgGambar_cust_id' value='<?=$cust_id?>'>
		<input type='hidden' name='field_foto' id='field_foto'>
		<?php 
		$url=base_url()."index.php/leasing/cust_master/upload_foto";
		echo form_open_multipart($url,"id='frmUpload'");
		?>
		<input type="file" name="userfile" id="userfile" size="20" title="Pilih Gambar" stye="float:left" />
		<input type="button" value="Submit" onclick="do_upload()">  
		<?=form_close();?>
	</div>
	<div id='error_upload'></div>
	<input type='hidden' name='no_gambar' id='no_gambar' value=0>
</div>
<div id='dlgProvKab' class="easyui-dialog"  buttons="#tbProvKab"
 style="width:400px;height:500px;padding:5px 5px" closed="true">
	<div id='divProvKab'>
	<table id="dgProvKab" class="easyui-datagrid"  data-options="toolbar: '',
			singleSelect: true,	url: '' ">
		<thead>
			<tr>
				<th data-options="field:'lokasi_nama',width:180">Nama Daerah</th>
				<th data-options="field:'kode',width:90">Kode</th>
			</tr>
		</thead>
	</table>
	</div>
</div>	
<div id='tbProvKab'>
	<input type='hidden' name='what_lokasi' id='what_lokasi'>
	<input id='txtFindLokasi' name='txtFindLokasi'>
	<? 
	echo link_button("Filter","cmdLokasiFind()","search");
	echo link_button("Select","cmdLokasiSelect()","ok");
	echo link_button("Close","cmdLokasiClose()","cancel");
	?>
</div>
 <script language='javascript'>
	var foto_no=0;
	function validnum(){
		var fld=['zip_pos','phone','rt','rw'];
		var n=0;
		for(i=0;i<fld.length;i++){
			n=$("#frmMain input[name="+fld[i]+"]").val();
			if(!isNumber(n)){
			alert("Isi field "+fld[i]+" dengan angka !!"); 
			return false;}
		}
		return true;
	}
	function valid(){
		var fld_spouse=["spouse_phone","spouse_name","spouse_birth_place",
		"spouse_phone","spouse_hp",
		"spouse_salary","spouse_salary_source"];
		var fld_com=["comp_name","since_year","job_level","job_type","com_street",
		,"emp_status","com_kec","comp_desc","com_kel","com_rtrw",
		"com_city","com_zip_pos","com_contact_phone","spv_name","hrd_name"];
		var fld=["cust_id","cust_name","street","city","kel","zip_pos","kec",
		"rtrw","hp","phone","first_name","call_name",
		"birth_place","date_place","id_card_no","lama_thn","mother_name",
		"salary","salary_source"];

		if($("#marital_status").val()==1){	//apabila nikah harus ada pasangan
			fld=fld.concat(fld_spouse);
		}
		if($("#job_status").val()==0){	// karyawan harus ada spv dan hrd
			fld=fld.concat(fld_com);
		}
		for(i=0;i<fld.length;i++){
			if($("#frmMain input[name="+fld[i]+"]").val()==""){
			var fldname="#frmMain input[name="+fld[i]+"]";
			alert('Isi field '+fld[i]+' !!'); 
			$(fldname).focus();
			return false;}
		}
		return true;		
	}
	function edit_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/edit/<?=$cust_id?>";	
		window.open(url,"_self");
	}
	function refresh_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/view/<?=$cust_id?>";	
		window.open(url,"_self");
	}
	function search_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>";	
		window.open(url,"_self");
	}
	function add_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/add";	
		window.open(url,"_self");
	}
  	function save_aed(){
		if(!valid())return false;
		if(!validnum())return false;
		url='<?=base_url()?>index.php/<?=$form_controller?>/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#mode').val('view');
					log_msg('Data sudah tersimpan.');
					var cust_id=result.cust_id;
					$("#cust_id").val(cust_id);
					url='<?=base_url()?>index.php/<?=$form_controller?>/view/'+cust_id;
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	function delete_aed() {
		$.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
			if (r){
				var url="<?=base_url()?>index.php/<?=$form_controller?>/delete/<?=$cust_id?>";	
				window.open(url,"_self");
			}
		})
	}
	function posting_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/posting/<?=$cust_id?>";	
		window.open(url,"_self");	
	}
	function print_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/print/<?=$cust_id?>";	
		window.open(url,"_self");
	}
	function view_foto(no){
		var cust_id=$("#cust_id").val();
		if(cust_id=="")return false;
		var url="<?=base_url()?>index.php/leasing/cust_master/view_foto/"+cust_id+'/'+no;
		get_this(url,'',"div_cust_foto");
	}
	function upload_foto(no){
		foto_no=no;
		$("#field_foto").val("cust_foto_"+foto_no);
		$("#userfile").val('');
		$('#dlgGambar').dialog('open').dialog('setTitle','Upload Gambar');
	}
  	function do_upload(){
		$('#frmUpload').form('submit',{
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				//console.log(result);
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Gambar sudah tersimpan.');
					var upload_data=result.upload_data;
					var img2=upload_data['file_name'];
					if(foto_no==0){
						$('#cust_foto').val(img2);
					} else {
						$('#cust_foto_'+foto_no).val(img2);						
					}
					$('#dlgGambar').dialog('close');
					$('.cust_foto').html('<img src="<?=base_url()?>tmp/'+img2+'" />');					
				} else {
					$('#error_upload').html(result.error);
				}
			}
		});
	}
	function cmdProv_Click(){
		$("#what_lokasi").val(0);
		$("#dlgProvKab").dialog("open").dialog("setTitle","Pilih");
		var xurl='<?=base_url()?>index.php/inf_lokasi/provinsi';
		$('#dgProvKab').datagrid({url:xurl});
		$('#dgProvKab').datagrid('reload');
	}
	function cmdCity_Click(){
		var prov=$("#province_id").val();
		if(prov==""){alert("Pilih kode provinsi !");return false;}
		$("#what_lokasi").val(1);
		$("#dlgProvKab").dialog("open").dialog("setTitle","Pilih");
		var xurl='<?=base_url()?>index.php/inf_lokasi/kabupaten/'+prov;
		$('#dgProvKab').datagrid({url:xurl});
		$('#dgProvKab').datagrid('reload');
	
	}
	function cmdKec_Click(){
		var prov=$("#province_id").val();
		if(prov==""){alert("Pilih kode provinsi !");return false;}
		var kab=$("#city_id").val();
		if(kab==""){alert("Pilih kode kabupaten/kota !");return false;}
		$("#what_lokasi").val(2);
		$("#dlgProvKab").dialog("open").dialog("setTitle","Pilih");
		var xurl='<?=base_url()?>index.php/inf_lokasi/kecamatan/'+prov+'/'+kab;
		$('#dgProvKab').datagrid({url:xurl});
		$('#dgProvKab').datagrid('reload');
	
	}
	function cmdKel_Click(){
		var prov=$("#province_id").val();
		if(prov==""){alert("Pilih kode provinsi !");return false;}
		var kab=$("#city_id").val();
		if(kab==""){alert("Pilih kode kabupaten/kota !");return false;}
		var kec=$("#kec_id").val();
		if(kec==""){alert("Pilih kode kecamatan !");return false;}
		
		$("#what_lokasi").val(3);
		$("#dlgProvKab").dialog("open").dialog("setTitle","Pilih");
		var xurl='<?=base_url()?>index.php/inf_lokasi/kelurahan/'+prov+'/'+kab+'/'+kec;
		$('#dgProvKab').datagrid({url:xurl});
		$('#dgProvKab').datagrid('reload');
	
	}
	function cmdLokasiClose(){
		$("#dlgProvKab").dialog("close");
	}
	function cmdLokasiFind(){
	
	}
	function cmdLokasiSelect(){
		var row = $('#dgProvKab').datagrid('getSelected');
		if (row){
			var what=$("#what_lokasi").val();
			if(what=="0"){
				$('#province_id').val(row.kode);
				$('#province').val(row.lokasi_nama);
			} else if(what=="1"){
				$('#city_id').val(row.kode);
				$('#city').val(row.lokasi_nama);
			
			} else if(what=="2"){
				$('#kec_id').val(row.kode);
				$('#kec').val(row.lokasi_nama);
			} else if(what=="3"){
				$('#kel_id').val(row.kode);
				$('#kel').val(row.lokasi_nama);
			}
			$('#dlgProvKab').dialog('close');
		}			
		
	}
</script>