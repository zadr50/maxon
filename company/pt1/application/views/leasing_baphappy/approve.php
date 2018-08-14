<div class='thumbnail box-gradient'>
	<?=link_button("Help","load_help()","help")?>
</div>
<? $CI =& get_instance(); ?>
<legend>PROSES APPROVAL KREDIT</legend>
<p>Dibawah ini adalah daftar aplikasi permohonan kredit yang sudah selesai 
sesuai tahapan permohonan kredit dan menunggu persetujuan pembuatan akad 
kredit dari anda.</p>
<p>Silahkan periksa / review nomor SPK dibawah ini</p>
<? 
echo form_open('',array("action"=>"","name"=>"frmMain","id"=>"frmMain"));
echo $not_approved_list;
echo form_close();
?>
<p>&nbsp</p>

<script language="javascript">
  	function save(){
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/approve/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/approve";
					log_msg('Data sudah tersimpan.');
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}	 
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/approve");
	}
	function view_spk(app_id){
		var url="<?=base_url()?>index.php/leasing/approve/view_spk/"+app_id;
		add_tab_parent("view_spk_"+app_id,url);
	}
	function view_cust(cust_id){
		var url="<?=base_url()?>index.php/leasing/cust_master/view/"+cust_id+"/view/false";
		add_tab_parent("ViewCst"+cust_id,url);
	}
	
</script>