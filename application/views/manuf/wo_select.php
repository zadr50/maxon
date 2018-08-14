<div id='dlgWo'class="easyui-dialog" style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"
		closed="true" buttons="#btnWo">
		<table id="dgWo" class="easyui-datagrid" data-options="singleSelect: true,fitColumns:true">
			<thead>
				<tr>
					<th data-options="field:'work_order_no',width:150">Nomor Work Order</th>
					<th data-options="field:'start_date',width:80">Tanggal Mulai</th>
					<th data-options="field:'expected_date',width:80">Tanggal Akhir</th>
					<th data-options="field:'wo_status',width:80">Status</th>
				</tr>
			</thead>
		</table>
</div>
<div id="btnWo"><?=link_button("Select","select_work_order();return false;","ok")?></div>	  


 <script language='javascript'>
	function lookup_work_order()
	{
		$('#dlgWo').dialog('open').dialog('setTitle','Cari nomor work order');
		$('#dgWo').datagrid({url:'<?=base_url()?>index.php/manuf/workorder/select_wo_open'});
		$('#dgWo').datagrid('reload');
	}
	function select_work_order()
	{
		var row = $('#dgWo').datagrid('getSelected');
		if (row){
			$('#purchase_order_number').val(row.work_order_no);
			$('#dlgWo').dialog('close');
		}
	}

 
 </script>