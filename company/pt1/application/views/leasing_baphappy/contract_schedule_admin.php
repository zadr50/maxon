<div class='thumbnail box-gradient'>
	<?=link_button("Help","load_help()","help")?>
</div>
<? $CI =& get_instance(); ?>
<legend><?=$title?></legend>
<p>Dibawah ini adalah daftar nomor kontrak yang sudah 
disetujui antara Sales Agent dan calon Debitur.
</p>
<p>Silahkan pilih dan tekan proses untuk membuat nomor kontrak baru.</p>
<strong><i>*Apabila tanggal masih kosong mohon agar jangan dulu dicontreng 
tanyakan kepada sales agent yang bersangkutan</i></strong>
<div class='thumbnail'>
	<button type="button" onclick="cmdProses()" class="btn btn-info">Proses</button>
</div>

<? 
echo form_open('',array("action"=>"","name"=>"frmMain","id"=>"frmMain"));
echo "<table class='table2' width='100%'> 
	<thead><th>Nomor SPK</th><th>Tanggal</th><th>Debitur</th><th>Draft Kontrak</th>
	<th>Status</th><th>Sales Agent</th><th>Counter</th><th>Area</th>
	<th>Tanggal Akad</th><th>Pilih</th>
	</thead>
	<tbody>
";
foreach($new_contract_list->result() as $row){
	$tanggal=$row->loan_date_aggr;
	echo "<tr><td>$row->app_id</td><td>$row->app_date</td><td>$row->cust_name</td>
	<td>$row->loan_id</td><td>$row->status</td>
	<td>$row->create_by</td><td>$row->counter_id</td><td>$row->area</td>
	<td><input type='text' name='loan_date[]' value='$tanggal' readonly></td>
	<td><input type='checkbox' name='loan_id[]' value='$row->loan_id'></td>
	
	</tr>";
}
echo "</tbody></table>";
echo form_close();
?>
<p>&nbsp</p>

<script language="javascript">
  	function cmdProses(){
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/loan_create_schedule/save_admin';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/loan_create_schedule/admin";
					log_msg('Data sudah tersimpan.');
					//window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}	 
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/<?=$help?>");
	}
	function view_loan(loan_id){
		var url="<?=base_url()?>index.php/leasing/loan_master/view/"+loan_id;
		add_tab_parent("view_loan_"+loan_id,url);
	}
</script>