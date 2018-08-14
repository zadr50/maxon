<!-- PILIH FAKTUR --> 
<div id='dlgSelectFaktur'class="easyui-dialog" style="width:600px;height:380px;
padding:10px 20px;left:100px;top:20px"
     closed="true" toolbar="#button-select-faktur">
     <div id='divSelectFaktur'> 
		<table id="dgSelectFaktur" class="easyui-datagrid"  
			data-options="
				toolbar: '',
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
<div id="button-select-faktur" style="height:auto">
	Enter Text: <input  id="search_supp" style='width:180' name="search_supp">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="filter_po();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selected_po();return false;">Select</a>
</div>
<SCRIPT language="javascript">
	function select_po(){
        //$('#dlgSelectFaktur').window({left:100,top:window.event.clientY-50});
		$('#dlgSelectFaktur').dialog('open').dialog('setTitle','Cari nomor PO');
		filter_po();
	};	
	function filter_po(){
        var supp=$('#supplier_number').val();
        var search=$("#search_supp").val();
        var vUrl='<?=base_url()?>index.php/purchase_order/select_open_po/'+supp+"?s="+search;
        $('#dgSelectFaktur').datagrid({url:vUrl});
	}
	function selected_po(){
		var row = $('#dgSelectFaktur').datagrid('getSelected');
		if (row){
			var nomor=row.purchase_order_number;
			$('#purchase_order_number').val(nomor);
			$('#dlgSelectFaktur').dialog('close');
	 		$("#divItem").fadeIn("slow");
			po_items(nomor);
		} else {
			alert("Pilih salah satu nomor purchase order !");
		}
	}	
	function po_items(nomor_po)
	{
		url=CI_ROOT+"purchase_order/items_not_received/"+nomor_po;
		$('#dgRcv').datagrid({url:url});
		$('#dgRcv').datagrid('reload');
	}
	
</SCRIPT>
<!-- END PILIH FAKTUR -->

