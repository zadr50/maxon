<div class='thumbnail box-gradient'>
	<?=link_button("Help","load_help()","help")?>
</div>
<? $CI =& get_instance(); ?>
<legend>PROSES PERSETUJUAN KREDIT</legend>
<p>Sebelum menyetujui silahkan review terlebih dahulu data-data 
pengajuan kredit dibawah ini, meliputi data pelanggan, pengajuan 
dan hasil survey.</p>
<p></p>

<?
	if(isset($mode)){
		$disabled=$mode=="view"?" disabled ":"";
	}
	include_once "cust_master_form_top.php";
	
?>
<legend>DATA-DATA</legend>
<li><a href="#" onclick="view_cust();return false">Data Pelanggan Lengkap</a></li>
<li><a href="#" onclick="view_spk();return false">Data Pengajuan Kredit</a>
<li><a href="#" onclick="view_survey();return false">Data Hasil Survey</a>
<li><a href="#" onclick="view_scoring();return false">Data Hasil Scoring</a>
<p></p>
<p class='alert alert-warning'>Tekan tombol <strong>APPROVED/NOT</strong> untuk mulai menyimpan data 
nomor tersebut dan akan dibuatkan akad kredit. Jangan lupa isi alasannya.</p>
<h5><strong>CATATAN</strong></h5>
<textarea name='reason' id='reason' style="width:300px;height:100px"></textarea>
<p><i>*Isi alasan atau keterangannya</i></p>
<div class='row'>
	<div id='div_reason_msg' style='color:red'></div>
</div>	

<div class='thumbnail'>
	<button type="button" onclick="save()" class="btn btn-info">APPROVED</button>
	<button type="button" onclick="save_not_approved()" class="btn btn-warning">NOT Approved</button>
	<div id='save_output'></div>
</div>	


<script language="javascript">
function view_cust(){
	var cust_id="<?=$cust_id?>";
	var url="<?=base_url()?>index.php/leasing/cust_master/view/"+cust_id+'/view/false';
	add_tab_parent("view_cust_"+cust_id,url);
}
function view_spk(){
	var app_id="<?=$app_id?>";
	var url="<?=base_url()?>index.php/leasing/app_master/view/"+app_id+'/false';
	add_tab_parent("view_spk_detail_"+app_id,url);

}
function view_survey(){
	var app_id="<?=$app_id?>";
	var url="<?=base_url()?>index.php/leasing/survey/view_spk/"+app_id+'/false';
	add_tab_parent("view_survey_"+app_id,url);

}
function view_scoring(){
	var app_id="<?=$app_id?>";
	var url="<?=base_url()?>index.php/leasing/scoring/view_result/"+app_id;
	add_tab_parent("view_score_"+app_id,url);

}

function save(){
	var reason=$("#reason").val();
	if(reason==""){alert("Isi keterangan atau alasannya !");return false;}
	if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
	var xurl='<?=base_url()?>index.php/leasing/app_master/approve';
	console.log(xurl);
	var app_id="<?=$app_id?>";
	$.ajax({type: "GET",
		//async: false,
		url: xurl,
		data: {"reason":reason,"app_id":app_id},
		success: function(msg){
			parseScript(msg);
			msg=msg+" Silahkan refresh browsernya.";
			$('#div_reason_msg').html(msg);
			xurl='<?=base_url()?>index.php/leasing/menu/load/leasing';
			//remove_tab();
			setTimeOut(window.open(xurl,"_self"),3000);
			alert(msg);
			
		},error: function(msg){log_err(msg);}
	}); 
}
function save_not_approved(){
	var app_id="<?=$app_id?>";
	var reason=$("#reason").val();
	if(reason==""){alert("Isi keterangan atau alasannya !");return false;}
	$.ajax({type: "GET",
		url: '<?=base_url()?>index.php/leasing/app_master/not_recomended',
		data: {"reason":reason,"app_id":app_id},
		success: function(msg){parseScript(msg);$('#div_reason_msg').html(msg);						
		},error: function(msg){log_err(msg);}
	}); 
}
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/approve_process");
	}

</script>