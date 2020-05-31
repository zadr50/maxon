<div id='dlgSoItems' class="easyui-dialog"  
    style="width:700px;height:400px;padding:5px 5px;top:10px;left:10px"
    closed="true" modal="true"  
    data-options="iconCls:'icon-search',buttons:'#dlgSoItems_buttons'"
>
	<p>* Pilih dan isi quantity di kolom Q_Kirim dibawah ini:</p>
	<p>* Setelah diisi quantity dikirim kemudian anda klik tombol [submit] 
		dan hasil inputan barangnya bisa anda lihat ditab section items</p>

		<form id="dlgSoItems_form" method="POST">
			
		<table id="dgSoItems" class="easyui-datagrid"  width="99%"
			data-options="iconCls: 'icon-edit',singleSelect: true, toolbar: '',  
			pagination:false,fitColumns: false, url: '' ">
			<thead>
				<tr>
					<th data-options="field:'input_field',width:'70' ">Q Kirim</th>
					<th data-options="field:'quantity'">Q Order</th>
					<th data-options="field:'unit'">Unit</th>
					<th data-options="field:'ship_qty'">Q Tkirim</th>
					<th data-options="field:'q_sisa'">Q Sisa</th>
					<th data-options="field:'item_number'">Item Number</th>
					<th data-options="field:'description'">Description</th>
					<th data-options="field:'input_field_id',width:30">Line</th>
				</tr>
			</thead>
		</table>

		</form>


</div>
<div id='dlgSoItems_buttons'>
	<?=link_button("Submit", "dlgSoItems_submit()","save")?>
	<?=link_button("Cancel", "dlgSoItems_cancel()","cancel")?>
</div>
<script language="JavaScript">
	function dlgSoItems_cancel(){
		$("#dlgSoItems").dialog("close");
	}
	function dlgSoItems_submit(){		
		$("#dlgSoItems").dialog("close");
		var nomor_do=$("#invoice_number").val();
		var vurl=CI_ROOT+'delivery_order/save_items_so?nomor_do='+nomor_do;
		loading();
			$('#dlgSoItems_form').form('submit',{
				url: vurl,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						log_msg('Data sudah tersimpan.');
						loading_close();
						dgItem_refresh();
						
					} else {
						log_err(result.msg);
					}
				}
			});
		
		
	}
</script>