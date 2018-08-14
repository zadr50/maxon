<div id='dlgAddInvoice'class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px" closed="true" 
	buttons="#tbAddInvoice">	 
	<form method='post' id='frmAddInvoice'>
	<?
		echo my_input("Nomor Faktur",'invoice_number','','col-sm-5');
		echo my_input("Tanggal",'invoice_date',date("Y-m-d"),'col-sm-5');
		echo my_input("Bulan ke",'idx_month','','col-sm-5');
		echo my_input("Jumlah",'amount','','col-sm-5');
	?>
		<input type='hidden' id='mode' name='mode' value='edit'>
	</form>
</div>	   
<div id='tbAddInvoice'>
	<?=link_button('Save', 'dlgAddInvoice_Save()','ok');?>
	<?=link_button('Close', 'dlgAddInvoice_Close()','no');?>
</div>
<script language="JavaScript">
	function dgInvoice_Add(){
		$("#mode").val("add");
		$('#dlgAddInvoice').dialog('open').dialog('setTitle','Tambah Faktur');
	}
	function dgInvoice_Edit(){
		row = $('#dgInvoice').datagrid('getSelected');
		if (row){
			$("#invoice_number").val(row.invoice_number);
			$("#invoice_date").val(row.invoice_date);
			$("#idx_month").val(row.idx_month);
			$("#amount").val(row.amount);
		}
		$('#dlgAddInvoice').dialog('open').dialog('setTitle','Edit Faktur');
	}
	function dgInvoice_Delete(){
		alert("delete");
	}
	function dlgAddInvoice_Close(){
		$('#dlgAddInvoice').dialog('close');
	}
	function dlgAddInvoice_Save(){
		url='<?=base_url()?>index.php/leasing/invoice_header/save';
		$('#frmAddInvoice').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Data sudah tersimpan.');
					$("#dlgAddInvoice").dialog("close");
					$("#dgInvoice").datagrid("reload");
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
</script>
