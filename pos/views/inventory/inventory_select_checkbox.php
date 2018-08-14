<div id="tb_search_isc" style="height:auto" class="box-gradient">
	<div style="float:left">
	<input type='checkbox' id='select_all_isc' style='width:30px'>Select All &nbsp
	
    <input type='checkbox' id='only_item_supplier_isc' name='only_item_supplier'  
        title='Filter by related selected supplier' style='width:30px'>Supplier &nbsp
	
	Field: <?php 
	$options=array("description"=>"description","item_number"=>"item_number","supplier_name"=>"supplier_name");
    $data="tb_field_isc";
    $selected="description";
    echo form_dropdown($data,$options,$selected,"id='tb_field_isc'");
    
    ?>
	Enter Text: <input  id="search_item_isc" style='width:100px' name="search_item_isc">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
	onclick="filterItemIsc();return false;">Search</a>        
	</div>
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selectSearchItemIsc();return false;">Select</a>
</div>

<div id='dlgSearchItemIsc' class="easyui-dialog" style="width:700px;height:380px;;left:100px;top:20px"
        closed="true" toolbar="#tb_search_isc">
     <form method='post' name='frmLovItemsIsc' id="frmLovItemsIsc">
     <div id='divItemSearchResultIsc'> 
		<table id="dgItemSearchIsc" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '',fitColumns:true,
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
                    <th data-options="field:'ck',width:50">Pilih</th>
					<th data-options="field:'description',width:250">Nama Barang</th>
					<th data-options="field:'item_number',width:100">Kode Barang</th>
					<th data-options="field:'category',width:80">Kelompok</th>
                    <th data-options="field:'supplier_name',width:180">Supplier</th>
				</tr>
			</thead>
		</table>
    </div>  
    </form> 
</div>


<script type="text/javascript">
    $().ready(function (){
        $('#select_all_isc').change(function() { 
            var checkboxes = $('#divItemSearchResultIsc').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        }); 
        filterItemIsc();
    });
	function selectSearchItemIsc(){
        var gudang=$("#warehouse_code").val();
        var po=$('#purchase_order_number').val();
        var url = '<?=base_url()?>index.php/purchase_order/save_item?po='+po+"&gdg="+gudang;

        if($("#mode").val()=="add"){alert("Simpan dulu nomor ini.");return false;};
        if(gudang==""){alert("Pilih dulu kode gudang !");return false;};
//          if(has_receive>0){alert("Nomor PO ini sudah ada penerimaan, tidak bisa diubah.");return false;};
        
        $('#frmLovItemsIsc').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+po+'/json'});
                    $('#dg').datagrid('reload');
                    
                    hitung();
                    
                    $.messager.show({
                        title: 'Success',
                        msg: 'Success'
                    });
                     $('#dlgSearchItemIsc').dialog('close');
                    
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
            }
        });
		    
	}
       function filterItemIsc(){
            nama=$('#search_item_isc').val();
            supplier=$("#supplier_number").val();
            only_item_supplier=$("#only_item_supplier_isc").is(':checked')
            param="?only_item_supplier="+only_item_supplier+"&";
            if(supplier!="")param=param+"supplier="+supplier;
            field=$("#tb_field_isc").val();
            if(field!="")param=param+"&field="+field;

            req_no=$("#req_no").val();
            param=param+"&req_no="+req_no;
            
            vUrl='<?=base_url()?>index.php/inventory/filter/'+nama+param;
            $('#dgItemSearchIsc').datagrid({url:vUrl});	           
       }

		function searchItemIsc()
		{
			$('#dlgSearchItemIsc').window({left:100,top:window.event.clientY+20});
			$('#dlgSearchItemIsc').dialog('open')
    			.dialog('setTitle','Cari data barang');

		}
		function dlgSearchItemIsc_Close(){
			$("#dlgSearchItemIsc").dialog("close");
		}

		
</script>