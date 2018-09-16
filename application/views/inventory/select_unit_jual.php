<div id="tb_search_unit" style="height:auto" class="box-gradient">
	<div style="float:left">
	Enter Text: <input  id="search_unit" style='width:100px' name="search_item">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
	onclick="searchUnit();return false;">Search</a>        
	</div>
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selectSearchUnit();return false;">Select</a>
</div>

<div id='dlgSearchUnit' class="easyui-dialog" style="width:500px;height:380px;;left:100px;top:20px"
        closed="true" toolbar="#tb_search_unit">
     
		<table id="dgItemSearchUnit" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '',fitColumns:true,
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'customer_pricing_code',width:150">Unit</th>
					<th data-options="field:'retail',width:80">Price</th> 
					<th data-options="field:'quantity_high',width:80">Qty Conv</th> 
					
				</tr>
			</thead>
		</table>
     
</div>


<script type="text/javascript">
    $().ready(function (){
        $('#dgItemSearchUnit').datagrid({
            onDblClickRow:function(){
                var row = $('#dgItemSearchUnit').datagrid('getSelected');
                if (row){
                    selectSearchUnit();
                }       
            }
        });        
    });


		function selectSearchUnit()
		{
			var row = $('#dgItemSearchUnit').datagrid('getSelected');
			if (row){
				qty_conv=row.quantity_high;
				if(qty_conv=="")qty_conv=1;
				qty=$("#quantity").val();
				if(qty=="")qty=0;
				if(qty_conv==0)qty_conv=1;
				qty=qty*qty_conv;
				$("#multi_unit").val($("#unit").val());
				$("#mu_harga").val($("#price").val());
				$("#mu_qty").val(qty);
				$('#unit').val(row.customer_pricing_code);
				$('#price').val(row.retail);
				$('#dlgSearchUnit').dialog('close');
			}
			
		}
		function searchUnit()
		{
			//$('#dlgSearchUnit').window({left:100,top:window.event.clientY+20});
			$('#dlgSearchUnit').dialog('open')
				.dialog('setTitle','Cari satuan');
			nama=$('#search_unit').val();
			item=$('#item_number').val();
			$('#dgItemSearchUnit').datagrid({url:'<?=base_url()?>index.php/inventory_prices/filter/'+item+'/'+nama});
			$('#dgItemSearchUnit').datagrid('reload');

		}
		function dlgSearchUnit_Close(){
			$("#dlgSearchUnit").dialog("close");
		}		
</script>