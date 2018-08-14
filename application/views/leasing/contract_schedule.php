<div class='thumbnail box-gradient'>
	<?=link_button("Help","load_help()","help")?>
</div>
<? $CI =& get_instance(); ?>
<legend><?=$title?></legend>
<p>Dibawah ini adalah daftar nomor kontrak yang sudah disetujui dan 
baru saja dibuat oleh admin,silahkan tentukan tanggal yang diingingkan 
oleh debitur untuk dibuatkan kontrak sesuia tanggal tersebut.</p>
<p>Silahkan isi tanggal untuk dibuatkan kontrak dibaris ini:</p>
<div class='thumbnail'>
	<button type="button" onclick="cmdProses()" class="btn btn-info">Proses</button>
</div>

<? 
echo form_open('',array("action"=>"","name"=>"frmMain","id"=>"frmMain"));
echo "<table class='table2' width='100%'> 
	<thead><th>Nomor SPK</th><th>Tanggal</th><th>Debitur</th><th>Draft Kontrak</th>
	<th>Status</th><th>Tanggal Akad</th><th>Sa</th><th>Pilih</th>
	</thead>
	<tbody>
";
$tanggal=date("Y-m-d");
foreach($new_contract_list->result() as $row){
	echo "<tr><td>$row->app_id</td><td>$row->app_date</td><td>$row->cust_name</td>
	<td>$row->loan_id</td><td>$row->status</td>
	<td><input type='text' name='loan_date[]' class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' 
	value='$tanggal'></td>
	<td>$row->create_by</td>
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
		url='<?=base_url()?>index.php/leasing/loan_create_schedule/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/loan_create_schedule";
					log_msg('Data sudah tersimpan.');
					window.open(url,"_self");
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