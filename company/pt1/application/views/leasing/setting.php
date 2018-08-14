	<div class='thumbnail'><legend>Setting Global Leasing</legend>
		<form id='frmLainnya' name='frmLainnya' method='post'>
			<table class='table2' width='100%'><tr>
			<td>Biaya Administrasi Rp.</td>
			<td><?=form_input("admin",$admin)?>
			<td></td>
			</tr>
			<tr><td>Kolektibilitas (n Hari)</td><td><?=form_input("col_lancar",$col_lancar," style='width:50px'")?> Lancar sama dengan</td><td></td>
			<tr><td></td><td><?=form_input("col_no_lancar",$col_no_lancar," style='width:50px'")?> Tidak Lancar kurang dari</td><td></td>
			<tr><td></td><td><?=form_input("col_macet",$col_macet," style='width:50px'")?> Macet lebih dari</td><td></td>
			</tr>
			<tr><td colspan='2'>Dianggap telat apabila tagihan belum dibayar lebih dari <?=form_input("hari_telat",$hari_telat," style='width:50px'")?> hari </td><td></td>
			<tr><td colspan='2'>Penalty sebesar &nbsp<?=form_input("penalty",$penalty," style='width:50px'")?> &nbsp % 
				dari sisa angsuran</td>
			<tr><td colspan='2'>Denda <?=form_input("denda_prc",$denda_prc," style='width:50px'")?> % 
			untuk keterlambatan lebih dari &nbsp <?=form_input("denda_hari",$denda_hari," style='width:50px'")?> Hari</td>

			<tr><td>
			<input value='Simpan' type='button' class='btn btn-info' 
				onclick='frmLainnya_Save();return false;'>
			</td> <td></td> 
			<td></td></tr> 
			</table>
		</form>
	</div>

	<div class='clearfix'>
	
	</div>
	<table id="dgDp" class="easyui-datagrid" style="width:auto;min-height:200px"
		data-options="iconCls: 'icon-edit',	singleSelect: true,
			toolbar: '#tbDp', title: 'Seting Down Payment  - DP persen',
			url: '<?=base_url()?>index.php/leasing/setting/dp/list'
		">
		<thead>
			<tr>
				<th data-options="<?=col_number("dp_from")?>">From</th>
				<th data-options="<?=col_number("dp_to")?>">To</th>
				<th data-options="field:'dp_prc',align:'right'">Percent</th>
				<th data-options="field:'id',align:'right'">id</th>
			</tr>
		</thead>
	</table>
	<div id='tbDp'>
	<?=link_button('Add', 'dgDp_Add()','add');?>
	<?=link_button('Edit', 'dgDp_Edit()','edit');?>
	<?=link_button('Delete', 'dgDp_Delete()','remove');?>
	<?=link_button('Refresh', 'dgDp_Refresh()','reload');?>
	</div>

	<table id="dgBunga" class="easyui-datagrid" style="width:auto;min-height:200px"
		data-options="iconCls: 'icon-edit',	singleSelect: true,
			toolbar: '#tbBunga', title: 'Seting Rate Bunga',
			url: '<?=base_url()?>index.php/leasing/setting/bunga/list'
		">
		<thead>
			<tr>
				<th data-options="<?=col_number("amount_from")?>">From</th>
				<th data-options="<?=col_number("amount_to")?>">To</th>
				<th data-options="field:'bunga_prc',align:'right'">Percent</th>
				<th data-options="field:'id',align:'right'">id</th>
			</tr>
		</thead>
	</table>
	<div id='tbBunga'>
	<?=link_button('Add', 'dgBunga_Add()','add');?>
	<?=link_button('Edit', 'dgBunga_Edit()','edit');?>
	<?=link_button('Delete', 'dgBunga_Delete()','remove');?>
	<?=link_button('Refresh', 'dgBunga_Refresh()','reload');?>
	</div>
	
<div id='dlgDp' class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px" closed="true" 
	buttons="#tbDlgDp">
	<legend>Input Setting Range DP</legend>
	<?
	echo form_open('',array("action"=>"","name"=>"frmDp","id"=>"frmDp"));
	echo my_input("DP Dari Rp. : ","dp_from",0);
	echo my_input("DP Sampai Rp. : ","dp_to",0);
	echo my_input("Percent % : ","dp_prc",0);
	echo "<input type='hidden' name='dp_id' id='dp_id' value='0'>";
	echo form_close();
	?>
</div>
<div id='tbDlgDp'>
	<?=link_button('Close', 'dlgDp_Close()','cancel');?>
	<?=link_button('Save', 'dlgDp_Save()','save');?>
</div>

<div id='dlgBunga' class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px" closed="true" 
	buttons="#tbDlgBunga">
	<legend>Input Setting Range Bunga</legend>
	<?
	echo form_open('',array("action"=>"","name"=>"frmBunga","id"=>"frmBunga"));
	echo my_input("Jumlah Dari Rp. : ","amount_from",0);
	echo my_input("Jumlah Sampai Rp. : ","amount_to",0);
	echo my_input("Percent % : ","bunga_prc",0);
	echo "<input type='hidden' name='bunga_id' id='bunga_id' value='0'>";
	echo form_close();
	?>
</div>
<div id='tbDlgBunga'>
	<?=link_button('Close', 'dlgBunga_Close()','cancel');?>
	<?=link_button('Save', 'dlgBunga_Save()','save');?>
</div>

<?=load_view('gl/select_coa_link')?>   	


<form id='frmGLLink' name='frmGLLink' method='post'>
	<table class='table2' width='100%'>
		<tr><td colspan='2'><h3>Kode Perkiraan GL Link</h3></td></tr>
		<tr><td>Default Cash</td><td>
		<? 	echo form_input(array("name"=>'default_cash_payment_account',
			"id"=>"default_cash_payment_account"
			,"style"=>"width:250px"),$default_cash_payment_account);
			echo link_button('','lookup_coa(\'default_cash_payment_account\')','search');
		?></td></tr>
		<tr><td>Piutang Usaha</td><td>
		<? 	echo form_input(array("name"=>'accounts_receivable',
			"id"=>"accounts_receivable"
			,"style"=>"width:250px"),$accounts_receivable);
			echo link_button('','lookup_coa(\'accounts_receivable\')','search');
		?></td></tr>
		<tr><td>Piutang Bunga</td><td>
		<? 	echo form_input(array("name"=>'ar_bunga',
			"id"=>"ar_bunga"
			,"style"=>"width:250px"),$ar_bunga);
			echo link_button('','lookup_coa(\'ar_bunga\')','search');
		?></td></tr>
		<tr><td>Pendapatan Leasing</td><td>
		<? 	echo form_input(array("name"=>'sales_leasing',
			"id"=>"sales_leasing"
			,"style"=>"width:250px"),$sales_leasing);
			echo link_button('','lookup_coa(\'sales_leasing\')','search');
		?></td></tr>
		<tr><td>Pendapatan Bunga</td><td>
		<? 	echo form_input(array("name"=>'sales_bunga',
			"id"=>"sales_bunga"
			,"style"=>"width:250px"),$sales_bunga);
			echo link_button('','lookup_coa(\'sales_bunga\')','search');
		?></td></tr>
		<tr><td>Pendapatan Administrasi</td><td>
		<? 
		
		echo form_input(array("name"=>'sales_admin',
			"id"=>"sales_admin"
			,"style"=>"width:250px"),$sales_admin);
			echo link_button('','lookup_coa(\'sales_admin\')','search');
		?></td></tr>
		<tr><td>Pendapatan Denda</td><td>
		<? 	echo form_input(array("name"=>'sales_denda',
			"id"=>"sales_denda"
			,"style"=>"width:250px"),$sales_denda);
			echo link_button('','lookup_coa(\'sales_denda\')','search');
		?></td></tr>
		<tr><td>Pendapatan DP</td><td>
		<? 	echo form_input(array("name"=>'sales_dp',
			"id"=>"sales_dp"
			,"style"=>"width:250px"),$sales_dp);
			echo link_button('','lookup_coa(\'sales_dp\')','search');
		?></td></tr>
		<tr><td>Persediaan Barang Leasing</td><td>
		<? 	echo form_input(array("name"=>'leasing_inventory',
			"id"=>"leasing_inventory"
			,"style"=>"width:250px"),$leasing_inventory);
			echo link_button('','lookup_coa(\'leasing_inventory\')','search');
		?></td></tr>
		<tr><td>Hutang Supplier</td><td>
		<? 	echo form_input(array("name"=>'accounts_payable',
			"id"=>"accounts_payable"
			,"style"=>"width:250px"),$accounts_payable);
			echo link_button('','lookup_coa(\'accounts_payable\')','search');
		?></td></tr>
		<tr><td colspan='2'>
		<input id='cmdSaveGlLink' name='cmdSaveGlLink' value='Simpan' type='button' class='btn btn-info' 
			onclick='frmGlLink_Save();return false;'>
		</td></tr>
	</table>
</form>
		
		
<script language="JavaScript">
	function frmLainnya_Save(){
		var url=CI_ROOT+'leasing/setting/save';                             
		$('#frmLainnya').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});
	}
	function frmGlLink_Save(){
		var url=CI_ROOT+'leasing/setting/gl_link';                             
		$('#frmGLLink').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});
	}
	function dlgDp_Clear(){
		$("#dp_id").val("");
		$("#dp_from").val("");
		$("#dp_to").val("");
		$("#dp_prc").val("");	
	}
	function dlgDp_Save(){
		var url=CI_ROOT+'leasing/setting/dp/save/';                             
		$('#frmDp').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Data sudah tersimpan.');
					$('#dgDp').datagrid('reload');
					$("#dlgDp").dialog("close");
				} else {
					log_err(result.msg);
				}
			}
		});
		
	}
	function dlgDp_Close(){
	
		$("#dlgDp").dialog("close");
	}
	function dgDp_Add(){
		dlgDp_Clear();
		$('#dlgDp').dialog('open').dialog('setTitle','Tambah Aturan DP');
	}
	function dgDp_Edit(){
		row = $('#dgDp').datagrid('getSelected');
		if (row){
			$("#dp_id").val(row.id);
			$("#dp_from").val(number_format(row.dp_from));
			$("#dp_to").val(number_format(row.dp_to));
			$("#dp_prc").val(row.dp_prc);
			$("#dlgDp").dialog("open").dialog("setTitle","Edit aturan DP");
		}
	}
	function dgDp_Delete(){
		row = $('#dgDp').datagrid('getSelected');
		if (row){
			xurl=CI_ROOT+'leasing/setting/dp/delete/'+row.id;                             
			xparam='';
			$.ajax({
				type: "GET",
				url: xurl,
				param: xparam,
				success: function(msg){
					$('#dgDp').datagrid('reload');
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});         
		}
	}
	function dgDp_Refresh(){
		$('#dgDp').datagrid('reload');
	}	
	
	function dlgBunga_Clear(){
		$("#bunga_id").val("");
		$("#amount_from").val("");
		$("#amount_to").val("");
		$("#bunga_prc").val("");	
	}
	function dlgBunga_Save(){
		var url=CI_ROOT+'leasing/setting/bunga/save/';                             
		$('#frmBunga').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Data sudah tersimpan.');
					$('#dgBunga').datagrid('reload');
					$("#dlgBunga").dialog("close");
				} else {
					log_err(result.msg);
				}
			}
		});
		
	}
	function dlgBunga_Close(){
	
		$("#dlgBunga").dialog("close");
	}
	function dgBunga_Add(){
		dlgBunga_Clear();
		$('#dlgBunga').dialog('open').dialog('setTitle','Tambah Aturan Bunga');
	}
	function dgBunga_Edit(){
		row = $('#dgBunga').datagrid('getSelected');
		if (row){
			$("#bunga_id").val(row.id);
			$("#amount_from").val(number_format(row.amount_from));
			$("#amount_to").val(number_format(row.amount_to));
			$("#bunga_prc").val(row.bunga_prc);
			$("#dlgBunga").dialog("open").dialog("setTitle","Edit aturan bunga");
		}
	}
	function dgBunga_Delete(){
		row = $('#dgBunga').datagrid('getSelected');
		if (row){
			xurl=CI_ROOT+'leasing/setting/bunga/delete/'+row.id;                             
			xparam='';
			$.ajax({
				type: "GET",
				url: xurl,
				param: xparam,
				success: function(msg){
					$('#dgBunga').datagrid('reload');
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});         
		}
	}
	function dgBunga_Refresh(){
		$('#dgBunga').datagrid('reload');
	}	
	
	
</script>

