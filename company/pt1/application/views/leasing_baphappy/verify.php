<div class='thumbnail box-gradient'>
<?=link_button("Help","load_help()","help")?>
</div>
<legend>PROSES VERIFIKASI</legend>
<p>Dibawah ini adalah daftar aplikasi permohonan kredit yang belum diverifikasi di area 
 [<?=$this->access->cid?>] 
silahkan klik nomor tersebut untuk diverifikasi</p>
<?=$not_verified?>
<p>&nbsp</p>
<div class='' id='divResult' style="display:none">
	<legend>STEP 1 - Info Aplikasi Kredit </legend>
	<p>Dibawah ini adalah data-data yang perlu anda verifikasi sebagai berikut: Tekan tombol <strong>Proses</strong> untuk mulai verifikasi </p>
	<div id='divResultContent'>
	
	</div>
	<p>&nbsp</p>
	<div class='thumbnail'>
	<button type="button" onclick="on_step1()" class="btn btn-info">PROSES</button>
	</div>
</div>

<p>&nbsp</p>
<div id='dlgVerifyData'class="easyui-dialog" style="width:600px;height:500px;padding:5px" closed="true" 
	buttons="#tbVerifyData">
	<? include_once "verify_form.php" ?>
</div>
<div id='tbVerifyData'>
	<button type="button" onclick="save_temp()" class="btn btn-info">SIMPAN</button>
	<button type="button" onclick="save()" class="btn btn-info">PROSES</button>
	<button type="button" onclick="save_cancel()" class="btn btn-warning">BATAL</button>
</div>

<script language="javascript">
	var m_app_id="";
	function step1(app_id){
		m_app_id=app_id;
		var url="<?=base_url()?>index.php/leasing/verify/step1/"+app_id;
		get_this(url,"","divResultContent");
		$("#divResult").fadeIn('slow');
		$("#divResultStep1").fadeOut('slow');
	}
	function verify_data() {
  		if(m_app_id==''){alert('Isi kode aplikasi !');return false;}
		url='<?=base_url()?>index.php/leasing/verify/data/'+m_app_id;
		$.ajax({
		type: "GET",
		url: url,
		success: function(msg){
			//console.log(msg);
			var result = eval('('+msg+')');
			$("#frmMain input[name=v2_cust_name_x").val(result.v2_cust_name_x);
			$("#frmMain input[name=v2_mother_name_x").val(result.v2_mother_name_x);
			$("#frmMain input[name=v1_house_status_x").val(result.v1_house_status_x);
			$("#frmMain input[name=v1_lama_tahun").val(result.v1_lama_tahun);
			$("#frmMain input[name=v2_place_birth").val(result.v2_place_birth);
			$("#frmMain input[name=v2_date_birth").val(result.v2_date_birth);
			$("#frmMain input[name=v1_street").val(result.v1_street);
			$("#frmMain input[name=v1_fam_name").val(result.v1_fam_name);
			$("#frmMain input[name=v1_fam_relation").val(result.v1_fam_relation);
			$("#frmMain input[name=v1_fam_street").val(result.v1_fam_street);
			$("#frmMain input[name=v1_fam_phone").val(result.v1_fam_phone);
			$("#frmMain input[name=v2_cust_name").val(result.v2_cust_name);
			$("#frmMain input[name=v2_mother_name").val(result.v2_mother_name);
			$("#frmMain input[name=v1_fam_street").val(result.v1_fam_street);
			$("#frmMain input[name=v1_house_status").val(result.v1_house_status);
			$("#frmMain input[name=v3_com_name").val(result.v3_com_name);
			$("#frmMain input[name=v3_year").val(result.v3_year);
			$("#frmMain input[name=v3_supervisor").val(result.v3_supervisor);
			$("#frmMain input[name=v3_hrd").val(result.v3_hrd);
			$("#frmMain input[name=v3_salary").val(result.v3_salary);
			$("#frmMain input[name=v3_emp_status").val(result.v3_emp_status);
			
		},
		error: function(msg){alert(msg);}
		}); 		
	}
	function on_step1(){
		verify_data();
		$("#dlgVerifyData").dialog("open").dialog('setTitle','Isi data verifikasi');;
	}
  	function save(){
  		if(m_app_id==''){alert('Isi kode aplikasi !');return false;}
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/verify/save/';
		$("#dlgVerifyData").dialog("close");
		$("#app_id").val(m_app_id);
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/verify";
					log_msg('Data sudah tersimpan.');
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	function save_cancel(){
		$("#dlgVerifyData").dialog("close");
	}
	function save_temp() {
  		if(m_app_id==''){alert('Isi kode aplikasi !');return false;}
		url='<?=base_url()?>index.php/leasing/verify/save/true';
		$("#dlgVerifyData").dialog("close");
		$("#app_id").val(m_app_id);
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/verify";
					log_msg('Data sudah tersimpan.');
					//window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
		
	}
	 
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/app_verify");
	}
	
</script>