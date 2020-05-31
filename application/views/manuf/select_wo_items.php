<table class='table2' width='100%'>
	<tr>
		<td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
		<td>Action</td>
	</tr>
	<tr>
		<td><input onblur='find()' id="item_number" style='width:90px' 
			name="item_number"   class="easyui-validatebox" required="true">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
			onclick="dlginventory_show();return false;"></a>
		</td>
		<td><input id="description" name="description" style='width:280px'></td>
		<td><input id="quantity"  style='width:60px'  name="quantity"  ></td>
		<td><input id="unit" name="unit"  style='width:60px' ></td>

		<td><input type="hidden" id="wo_line"  style='width:30px'  name="wo_line"  >
			<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
			plain='false'	onclick='save_item();return false;'>Save Item</a>
		</td>
		<input type='hidden' id='ref_number' name='ref_number'>
		<input type='hidden' id='line_number' name='line_number'>
	</tr>
</table>
<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem()">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem()">Delete</a>	
</div>

<div id="tb_search" style="height:auto">
	Enter Text: <input  id="search_item" style='width:180px' 
 	name="search_item">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
	onclick="searchItem();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="false" 
	onclick="selectSearchItem();return false;">Select</a>
</div>

<div id='dlgSearchItem'class="easyui-dialog" style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"
        closed="true" buttons="#tb_search">
     <div id='divItemSearchResult'> 
		<table id="dgItemSearch" class="easyui-datagrid"  
			data-options="
				toolbar: '',
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'cost',width:80">Cost</th>
					<th data-options="field:'total',width:80">Total</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>	   

<script language="JavaScript"> 
	function deleteItem(){
		var row = $('#'+grid_output).datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					$.post(url_del_item,{line_number:row.line_number},function(result){
						if (result.success){
							$('#'+grid_output).datagrid('reload');	// reload the user data
						} else {
							$.messager.show({	// show error message
								title: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
	function editItem(){
		var row = $('#'+grid_output).datagrid('getSelected');
		if (row){
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.quantity);
			$('#unit').val(row.unit);
			$('#line_number').val(row.line_number);
		}
	}
		function save_item(){
			var id=$("#shipment_id").val();
			if(id==""){alert("Nomor bukti belum diisi !");return false}
			
			$('#frmItem').form('submit',{
				url: url_save_item,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');

					if (result.success){
						$("#shipment_id").val(result.shipment_id);
						$('#'+grid_output).datagrid({url:CI_BASE+"index.php/manuf/receive_prod/items/"+result.shipment_id+"/json"});
						$('#'+grid_output).datagrid('reload');
						$('#item_number').val('');
						$('#unit').val('Pcs');
						$('#description').val('');
						$('#line_number').val('');
						$('#quantity').val('1');
						$.messager.show({
							title: 'Success',
							msg: 'Success'
						});
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
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
				$('#wo_line').val(row.id);
				find();
				$('#dlgSearchItem').dialog('close');
			}
			
		}
		function searchItem()
		{
			var wo=$("#purchase_order_number").val();
			if(wo==''){
				alert("Pilih nomor work order !");
				return false;
			}
			$('#dlgSearchItem').dialog('open').dialog('setTitle','Cari data barang');
			nama=$('#search_item').val();
			xurl='<?=base_url()?>index.php/manuf/workorder/items/'+wo;
			$('#dgItemSearch').datagrid({url:xurl});
			$('#dgItemSearch').datagrid('reload');
		}
		function find(){
		    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val();
		    $.ajax({
		                type: "GET",
		                url: xurl,
		                data:'item_no='+$('#item_number').val(),
		                success: function(msg){
		                    var obj=jQuery.parseJSON(msg);
		                    $('#item_number').val(obj.item_number);
		                    $('#unit').val(obj.unit_of_measure);
		                    $('#description').val(obj.description);
		                    $('#quantity').val(1);
		                },
		                error: function(msg){alert(msg);}
		    });
		};


</script>
