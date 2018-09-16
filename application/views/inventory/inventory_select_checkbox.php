<div id="tb_search_isc" style="height:auto" class="box-gradient">
	<input type='checkbox' id='select_all_isc' style='width:30px'>Select All &nbsp
    <input type='checkbox' id='only_item_supplier_isc' name='only_item_supplier'  
        title='Filter by related selected supplier' style='width:30px'>Supplier &nbsp
	
	Field: <?php 
	$options=array("description"=>"description","item_number"=>"item_number","supplier_name"=>"supplier_name");
    $data="tb_field_isc";
    $selected="description";
    echo form_dropdown($data,$options,$selected,"id='tb_field_isc'");
    ?>
	Enter Text: <input  id="search_item_isc" style='width:100px' name="search_item_isc" 
		onchange='filterItemIsc();return false;'>
	<?=link_button("Search", "filterItemIsc();return false","search")?>	
	<?=link_button("Select", "selectSearchItemIsc();return false","save")?>	
	<?=link_button("Close", "dlgSearchItemIsc_close();return false","cancel")?>	
</div>

<div id='dlgSearchItemIsc' class="easyui-dialog" style="width:780px;height:480px;;left:50px;top:20px"
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

        loading();
        
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
                    log_msg("Success");
                    $('#dlgSearchItemIsc').dialog('close');
                    loading_close();
                } else {
                	log_err(result.msg);
                    loading_close();
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

	function searchItemIsc(){
		$('#dlgSearchItemIsc').dialog('open')
			.dialog('setTitle','Cari data barang');

		}
	function dlgSearchItemIsc_Close(){
			$("#dlgSearchItemIsc").dialog("close");
	}
</script>