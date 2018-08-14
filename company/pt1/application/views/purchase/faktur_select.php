<!-- PILIH FAKTUR --> 
<div id='dlgSelectFaktur'class="easyui-dialog" style="width:600px;height:380px;
padding:10px 20px;left:100px;top:20px"
     closed="true" buttons="#toolbar-search-faktur">
     <div id='divSelectFaktur'> 
		<table id="dgSelectFaktur" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '',fitColumns: true, 
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'purchase_order_number',width:80">Faktur</th>
					<th data-options="field:'po_date',width:80">Tanggal</th>
					<th data-options="field:'terms',width:180">Termin</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="toolbar-search-faktur" style="height:auto" class='box-gradient'>
	Enter Text: <input  id="search_supp" style='width:180' name="search_supp">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"   onclick="select_faktur();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"   onclick="selected_faktur();return false;">Select</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-cancel"   onclick="dlgSelectFaktur_Close();return false;">Close</a>
</div>
<SCRIPT language="javascript">
	function select_faktur(){
			$('#dlgSelectFaktur').dialog('open').dialog('setTitle','Cari nomor faktur');
			supp=$('#supplier_number').val();
			$('#dgSelectFaktur').datagrid({url:'<?=base_url()?>index.php/purchase_invoice/select/'+supp});
			$('#dgSelectaktur').datagrid('reload');
	};	
	function selected_faktur(){
		var row = $('#dgSelectFaktur').datagrid('getSelected');
		if (row){
			$('#po_ref').val(row.purchase_order_number);
			//$('#company').val(row.company);
			$('#dlgSelectFaktur').dialog('close');
		} else {
			alert("Pilih salah satu nomor faktur !");
		}
	}	
	function dlgSelectFaktur_Close(){
		$("#dlgSelectFaktur").dialog("close");
	}
</SCRIPT>
<!-- END PILIH PELANGGAN -->

