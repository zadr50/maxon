		 
	<table id="dgPay" class="easyui-datagrid"    width='100%'
		data-options="
			iconCls: 'icon-edit', fitColumns: true,
			singleSelect: true,
			toolbar: '#tbPay',
			url: '<?=base_url()?>index.php/payment/data/<?=$invoice_number?>'
		">
		<thead>
			<tr>
				<th data-options="field:'no_bukti',width:80">Nomor Bukti</th>
				<th data-options="field:'date_paid',width:80">Tanggal Bayar</th>
				<th data-options="field:'how_paid',width:150,align:'left',editor:'text'">Cara Bayar</th>
				<th data-options="field:'amount_paid',width:60,align:'right',editor:'numberbox',
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');}">Jumlah</th>

				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>

<div id='dlgPayment'class="easyui-dialog" style="width:500px;height:350px;left:100px;top:20px;padding:10px 20px"
    closed="true" buttons="#dlg-buttons-pay">
	
	<?
	$no_bukti='';
	$date_paid=date("Y-m-d");
	$how_paid='Cash';
	$amount_paid=$amount;
	include_once "payment.php"; 
	
	?>

</div>
<div id="dlg-buttons-pay">
	<a href="#" class="easyui-linkbutton" iconCls="icon-save" onclick="save_pay()">Save</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="close_pay()">Close</a>	
</div>
<div id="tbPay" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="add_pay()">Add</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit_pay()">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="del_pay()">Delete</a>	
</div>

<script languange="javascript">
		function selectSearchItem()
		{
			var row = $('#dgItemSearch').datagrid('getSelected');
			if (row){
				$('#item_number').val(row.item_number);
				$('#description').val(row.description);
				find();
				$('#dlgSearchItem').dialog('close');
			}
			
		}
		function add_pay()
		{
			$("#amount_paid").val($("#saldo").val());
			$('#dlgPayment').dialog('open').dialog('setTitle','Tambah data pembayaran');
		}
		
		function save_pay(){
			url='<?=base_url()?>index.php/payment/add_payment';
			$('#frmAddPay').form('submit',{
				url: url,
				contentType: 'application/json; charset=utf-8',
                data:{invoice_number:$("#invoice_number").val()},
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dgPay').datagrid('reload');
						$('#no_bukti').val('');
						$('#date_paid').val('');
						$('#how_paid').val('Pcs');
						$('#amount_paid').val('');
						$('#line_number').val('');
						$.messager.show({
							title: 'Success',
							msg: 'Success'
						});
						hitung_jumlah();
						$('#dlgPayment').dialog('close');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
			
		}
		function close_pay(){$("#dlgPayment").dialog('close');}
		function edit_pay(){
			var row = $('#dgPay').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#frmAddPay').form('load',row);
				$('#mode_pay').val('edit');
				$('#line_number_pay').val(row.line_number);
				$('#dlgPayment').dialog('open').dialog('setTitle','Edit data pembayaran');
			}
		}
		function del_pay(){
			var row = $('#dgPay').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if (r){
						url='<?=base_url()?>index.php/payment/delete_payment';
						$.post(url,{line_number:row.line_number},function(result){
							if (result.success){
								$('#dgPay').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}

	
	
</script>
