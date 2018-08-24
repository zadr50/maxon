
<table>
	<tr>
		<td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
		<td>Harga</td><td>Disc%</td><td>Jumlah</td><td></td>
	</tr>
	<tr>
	    <form id="frmItem" method='post' >
	         <td><input onblur='find()' id="item_number" style='width:80' 
	         	name="item_number"   class="easyui-validatebox" required="true">
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
				onclick="searchItem()"></a>
	         </td>
	         <td><input id="description" name="description" style='width:280'></td>
	         <td><input id="quantity"  style='width:30'  name="quantity" onblur="hitung()"></td>
	         <td><input id="unit" name="unit"  style='width:30' ></td>
	         <td><input id="price" name="price"  style='width:80'   onblur="hitung()" class="easyui-validatebox" validType="numeric"></td>
	        <td><input id="discount" name="discount"  style='width:30'   onblur="hitung()" class="easyui-validatebox" validType="numeric"></td>
	        <td><input id="amount" name="amount"  style='width:80'  class="easyui-validatebox" validType="numeric"></td>
	        <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
     		   plain='true'	onclick='save_item()'></a>
			</td>
	        <input type='hidden' id='ref_number' name='ref_number'>
	        <input type='hidden' id='line_number' name='line_number'>
	    </form>
	</tr>
</table>
<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteItem()">Delete</a>	
</div>

<div id="tb_search" style="height:auto">
	Enter Text: <input  id="search_item" style='width:180' 
 	name="search_item" onblur="searchItem();return false;">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
	onclick="searchItem();return false"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="selectSearchItem();return false">Select</a>
</div>

<div id='dlgSearchItem'class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px;left:100px;top:20px"
        closed="true" buttons="#dlg-buttons">
     <div id='divItemSearchResult'> 
		<table id="dgItemSearch" class="easyui-datagrid"  
			data-options="
				toolbar: '#tb_search',
				singleSelect: true,
				url: '<?=base_url()?>index.php/inventory/filter'
			">
			<thead>
				<tr>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>	   

<script language="JavaScript"> 

    $().ready(function (){
        $('#dgItemSearch').datagrid({
            onDblClickRow:function(){
                var row = $('#dgItemSearch').datagrid('getSelected');
                if (row){
                   selectSearchItem();
                }       
            }
        });        
    });

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
			$('#price').val(row.price);
			$('#discount').val(row.discount);
			$('#amount').val(row.amount);
			$('#line_number').val(row.line_number);
		}
	}
	
	

		function hitung(){
	        if($('#quantity').val()==0)$('#quantity').val(1);
	        gross=$('#quantity').val()*$('#price').val();
	        disc_prc=$('#discount').val();
	        if(disc_prc>1){
	        	disc_prc=disc_prc/100;
	        	$('#discount').val(disc_prc);
	        }	
	        disc_amt=Math.round(gross*disc_prc,2);
	        $('#amount').val(gross-disc_amt);
	        hitung_jumlah();			
		}
		function save_item(){
			$('#frmItem').form('submit',{
				url: url_save_item,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#'+grid_output).datagrid({url:url_load_item});
						$('#'+grid_output).datagrid('reload');
						$('#frmItem').form('clear');
						$('#item_number').val('');
						$('#discount').val('0');
						$('#unit').val('Pcs');
						$('#description').val('');
						$('#line_number').val('');
						$('#quantity').val(1);
						$('#price').val('0');
						$('#amount').val('0');
						
						hitung();
						
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
				find();
				$('#dlgSearchItem').dialog('close');
			}
			
		}
		function searchItem()
		{
			//$('#dlgSearchItem').window({left:100,top:window.event.clientY+20});
			$('#dlgSearchItem').dialog('open').dialog('setTitle','Cari data barang');
			nama=$('#search_item').val();
			xurl='<?=base_url()?>index.php/inventory/filter/'+nama;
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
		                    $('#price').val(obj.retail);
		                    $('#cost').val(obj.cost);
		                    $('#unit').val(obj.unit_of_measure);
		                    $('#description').val(obj.description);
		                    hitung();
		                },
		                error: function(msg){alert(msg);}
		    });
		};


</script>
