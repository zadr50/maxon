<!-- PILIH FAKTUR --> 
<div id='dlgSelectFaktur'class="easyui-dialog" style="width:780px;height:380px;
padding:10px 20px;left:10px;top:50px"
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
					<th data-options="field:'terms',width:80">Termin</th>
                    <th data-options="field:'due_date',width:80">Due</th>
                    <th data-options="field:'supplier_number',width:80">Supplier</th>
                    <th data-options="field:'supplier_name',width:180">Supplier Name</th>
                    <th data-options="field:'doc_status',width:80">Status</th>
                    <th data-options="field:'bill_to_contact',width:80">Company</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="button-select-faktur" style="height:auto">
	Enter Text: <input  id="search_supp" style='width:180' name="search_supp" onchange="filter_po();return false;">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="filter_po();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selected_po();return false;">Select</a>
	<span style="float:right">
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="dlgSelectFaktur_Close();return false;">Cancel</a>        		
	</span>
</div>
<SCRIPT language="javascript">
    $().ready(function (){
        $('#dgSelectFaktur').datagrid({
            onDblClickRow:function(){
                var row = $('#dgSelectFaktur').datagrid('getSelected');
                if (row){
                	selected_po();
                }       
            }
        });        
    });
	function dlgSelectFaktur_Close(){
			$('#dlgSelectFaktur').dialog('close');		
	}
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
			$("#supplier_number").val(row.supplier_number);
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
		//$('#dgRcv').datagrid('reload'); dimatikan karena akan reload dua kali
	}
	
</SCRIPT>
<!-- END PILIH FAKTUR -->

