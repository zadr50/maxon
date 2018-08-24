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
					<th data-options="field:'terms',width:80">Termin</th>
                    <th data-options="field:'supplier_number',width:80">Supplier</th>
                    <th data-options="field:'supplier_name',width:180">Supplier Name</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="toolbar-search-faktur" style="height:auto" class='box-gradient'>
	Enter Text: <input  id="search_supp" style='width:180' name="search_supp" onchange="filter_faktur();return false;">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"   onclick="filter_faktur();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"   onclick="selected_faktur();return false;">Select</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-cancel"   onclick="dlgSelectFaktur_Close();return false;">Close</a>
</div>
<SCRIPT language="javascript">

    $().ready(function (){
        $('#dgSelectFaktur').datagrid({
            onDblClickRow:function(){
                var row = $('#dgSelectFaktur').datagrid('getSelected');
                if (row){
                   selected_faktur();
                }       
            }
        });        
    });

	function select_faktur(){
	    filter_faktur();
		$('#dlgSelectFaktur').dialog('open').dialog('setTitle','Cari nomor faktur');
	};	
	function filter_faktur(){
        supp=$('#supplier_number').val();
        if(supp=='')supp=$("#search_supp").val();
        $('#dgSelectFaktur').datagrid({url:'<?=base_url()?>index.php/purchase_invoice/select/'+supp});
	    
	}
	function selected_faktur(){
		var row = $('#dgSelectFaktur').datagrid('getSelected');
		if (row){
			$('#po_ref').val(row.purchase_order_number);
			$('#supplier_number').val(row.supplier_number);
			$("#supplier_name").html(row.supplier_name);
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

