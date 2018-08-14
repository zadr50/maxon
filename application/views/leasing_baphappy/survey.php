<div class='thumbnail box-gradient'>
<?=link_button("Help","load_help()","help")?>
</div>
<legend>PROSES PEMILIHAN SURVEYOR</legend>
<p>Dibawah ini adalah daftar aplikasi permohonan kredit yang belum disurvey
silahkan contreng nomor tersebut dan set tanggal dan surveyor yang ditugaskan 
untuk melakukan survey ke tempat debitur.</p>
<p>Tekan tombol <strong>PROSES</strong> untuk mulai menyimpan data</p>

<div class='thumbnail'>
	<button type="button" onclick="save()" class="btn btn-info">PROSES</button>
</div>	
<? 
echo form_open('',array("action"=>"","name"=>"frmMain","id"=>"frmMain"));
echo $not_surveyed;
echo form_close();
?>
<p>&nbsp</p>

<script language="javascript">
  	function save(){
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/survey/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/survey";
					log_msg('Data sudah tersimpan.');
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	 
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/app_survey");
	}
	function view_cust(nomor){
		var url="<?=base_url()?>index.php/leasing/cust_master/view/"+nomor+"/view/false";
		add_tab_parent("ViewCst"+nomor,url);
	}
</script>