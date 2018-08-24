<div id="tb_search" style="height:auto" class="box-gradient">
	<div style="float:left">
	
	<input type='checkbox' id='only_item_supplier' name='only_item_supplier'  
	title='Filter by related selected supplier' style='width:30px'>Supplier
	Field: <?php 
	$options=array("description"=>"description","item_number"=>"item_number","supplier_name"=>"supplier_name");
    $data="tb_field";
    $selected="description";
    echo form_dropdown($data,$options,$selected,"id='tb_field'");
    
    ?>
	Enter Text: <input  id="search_item" style='width:100px' name="search_item" 
		onchange='filterItem();return false;' >
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
	onclick="filterItem();return false;">Search</a>        
	</div>
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selectSearchItem();return false;">Select</a>
</div>

<div id='dlgSearchItem' class="easyui-dialog" style="width:750px;height:480px;;left:50px;top:20px"
        closed="true" toolbar="#tb_search">
     <form method='post' name='frmLovItems' id="frmLovItems">
     <div id='divItemSearchResult'> 
		<table id="dgItemSearch" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '',fitColumns:true,
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
<!--                    <th data-options="field:'ck',width:50">Pilih</th>
 -->   
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
    $('#select_all').change(function() { 
        var checkboxes = $('#divItemSearchResult').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    }); 
    
    $('#dgItemSearch').datagrid({
        onDblClickRow:function(){
            var row = $('#dgItemSearch').datagrid('getSelected');
            if (row){
            	selectSearchItem();
            }       
        }
    });        
    
    filterItem();
    
    
    
});
		function find(){
			var cust_type=$('#cust_type').val();
			 
			var item=$("#item_number").val();
			if( item=="" || item=="undefined")return false;
			var cust_no=$("#sold_to_customer").val();
		    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val()+'/'+cust_type ;
			var param={item_no:item,cust_type:cust_type,cust_no:cust_no};
		    $.ajax({
				type: "GET",
				url: xurl,
				data: param,
				success: function(msg){
					var obj=jQuery.parseJSON(msg);
					$('#item_number').val(obj.item_number);
					$('#price').val(obj.retail);
					$('#cost').val(obj.cost);
					$('#unit').val(obj.unit_of_measure);
					$('#description').val(obj.description);
					$("#discount").val(obj.discount);
					if(obj.discount==0) $("#discount").val(obj.disc_prc_1);
					$("#disc_2").val(obj.disc_prc_2);
					$("#disc_3").val(obj.disc_prc_3);
					if(obj.multiple_pricing){
						$("#cmdLovUnit").show();
					} else {
						$("#cmdLovUnit").hide();
					}
					$("#quantity").val("1");
					hitung();
				},
				error: function(msg){alert(msg);}
		    });
		};
		function selectSearchItemSubmitxx(){
            url='<?=base_url()?>index.php/purchase_order/save_items';
            $('#frmLovItems').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                        $('#dlgSearchItem').dialog('close');
                        log_msg('Data sudah tersimpan. ');
                    } else {
                        log_err(result.msg);
                    }
                }
            });
		    
		}
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
		function filterItem(){
            nama=$('#search_item').val();
            supplier=$("#supplier_number").val();
            only_item_supplier=$("#only_item_supplier").is(':checked')
            param="?only_item_supplier="+only_item_supplier+"&";
            
            if(supplier!="")param=param+"supplier="+supplier;
            field=$("#tb_field").val();
            if(field!="")param=param+"&field="+field;
            
            req_no=$("#req_no").val();
            param=param+"&req_no="+req_no;


            vUrl='<?=base_url()?>index.php/inventory/filter/'+nama+param;
            $('#dgItemSearch').datagrid({url:vUrl});
            //$('#dgItemSearch').datagrid('reload');

		    
		}
		function searchItem()
		{
			//$('#dlgSearchItem').window({left:100,top:window.event.clientY-50});
			$('#dlgSearchItem').dialog('open').dialog('setTitle','Cari data barang');
		}
		function dlgSearchItem_Close(){
			$("#dlgSearchItem").dialog("close");
		}

		
</script>