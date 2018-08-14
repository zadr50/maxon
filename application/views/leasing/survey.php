<div class='thumbnail box-gradient'>
<?=link_button("Help","load_help()","help")?>
</div>
<legend>PROSES PEMILIHAN SURVEYOR</legend>
<p>Dibawah ini adalah daftar aplikasi permohonan kredit yang belum disurvey
silahkan contreng nomor tersebut dan set tanggal dan surveyor yang ditugaskan 
untuk melakukan survey ke tempat debitur.</p>
<div class='thumbnail'>
<table class='table'>
<tr><td>Dari Tanggal</td><td><input id='txtFrom' name='txtFrom' 
value='<?=date('Y-m-d H:i:s')?>' 
class='easyui-datetimebox'/></td>
<td>Sampai</td><td><input id='txtTo' name='txtTo' 
value='<?=date('Y-m-d H:i:s')?>'
class='easyui-datetimebox'/>
<button type='button' onclick='filter_survey();return false'>Filter</button>

</td>
</tr>
<tr><td>Wilayah/Area</td><td><input id='txtWilayah' name='txtWilayah'/>
</td>
<td>Surveyor</td><td><input id='txtSurveyor' name='txtSurveyor' />
</td>
</tr>

</table>
</div>
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
	function filter_survey(){
		from=$("#txtFrom").val();
		to=$("#txtTo").val();
		wilayah=$("#txtWilayah").val();
		surveyor=$("#txtSurveyor").val();
		param="&from="+from+"&to="+to+"&wilayah="+wilayah+"&surveyor="+surveyor;
		url="<?=base_url()?>index.php/leasing/survey/?"+param;
		window.open(url,"_self");
		
	}
</script>