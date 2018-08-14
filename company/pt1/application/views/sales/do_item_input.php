<table class='table' width='100%'>
	<tr>
		<td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>Unit</td>
	</tr>
	<tr>
	    <form id="frmItem" method='post' >
	         <td><input onblur='find();return false;' id="item_number" style='width:80px' 
	         	name="item_number"  >
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
				onclick="searchItem()"></a>
	         </td>
	         <td><input id="description" name="description" style='width:300px'></td>
	         <td><input id="quantity"  style='width:80px'  name="quantity" onblur="hitung()"></td>
	         <td><input id="unit" name="unit"  style='width:80px' ></td>
	        <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
     		   plain='true'	onclick='save_item()'>SUBMIT</a>
			</td>
	        <input type='hidden' id='invoice_number_item' name='invoice_number_item'>
	        <input type='hidden' id='line_number' name='line_number'>
	    </form>
	</tr>
</table>
<?php 
if(!isset($show_tool))$show_tool=true; 
if($show_tool){
?>
	<div id="tb" class='box-gradient'>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem();return false;">Edit</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteItem(); return false;">Delete</a>	
	</div>
<?php } ?>

<div id="tb_search" class='box-gradient'>
	Enter Text: <input  id="search_item" style='width:180' 
 	name="search_item">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  
	onclick="searchItem();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selectSearchItem();return false;">Select</a>
</div>

<div id='dlgSearchItem'class="easyui-dialog" style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"
        closed="true" toolbar="#tb_search">
     <div id='divItemSearchResult'> 
		<table id="dgItemSearch" class="easyui-datagrid"  width='100%'
			data-options="
				toolbar: '',fitColumns: true, 
				singleSelect: true,
				url: ''
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
		function find(){
			var item=$("#item_number").val();
			if( item=="" || item=="undefined")return false;
			var cust_type=$('#cust_type').val();
		    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val()+'/'+cust_type;
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
		function hitung(){
	        if($('#quantity').val()==0)$('#quantity').val(1);
	        gross=$('#quantity').val()*$('#price').val();
	        disc_1=$('#discount').val(); if(disc_1>1)disc_1=disc_1/100;
			disc_2=$('#disc_2').val();  if(disc_2>1)disc_2=disc_2/100;
			disc_3=$('#disc_3').val(); if(disc_3>1)disc_3=disc_3/100;
			gross=gross-(gross*disc_1);
			gross=gross-(gross*disc_2);
			gross=gross-(gross*disc_3);
	        $('#amount').val(gross);			

	        hitung_jumlah();			
		}
		function save_item(){
			var mode=$('#mode').val();
			if(mode=="add"){alert("Simpan dulu nomor ini !");return false;}
			var url = '<?=base_url()?>index.php/invoice/save_item';
			$('#invoice_number_item').val($('#invoice_number').val());
						 
			$('#frmItem').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dg').datagrid('reload');
						$("#dgItem").datagrid("reload");
						
						$('#frmItem').form('clear');
						$('#item_number').val('');
						$('#discount').val('0');
						$('#unit').val('Pcs');
						$('#item_number').val('');
						$('#line_number').val('');
						$('#quantity').val(1);
						
						find();
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
			$('#dlgSearchItem').dialog('open').dialog('setTitle','Cari data barang');
			nama=$('#search_item').val();
			xurl='<?=base_url()?>index.php/inventory/filter/'+nama;
			$('#dgItemSearch').datagrid({url:xurl});
			$('#dgItemSearch').datagrid('reload');
		}
		function deleteItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if (r){
						url='<?=base_url()?>index.php/invoice/delete_item';
						$.post(url,{line_number:row.line_number},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
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
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#frmItem').form('load',row);
				$('#item_number').val(row.item_number);
				$('#description').val(row.description);
				$('#quantity').val(row.quantity);
				$('#unit').val(row.unit);
				$('#price').val(row.price);
				$('#discount').val(row.discount);
				$('#disc_2').val(row.disc_2);
				$('#disc_3').val(row.disc_3);
				$('#amount').val(row.amount);
				$('#line_number').val(row.line_number);
				$('#so_number').val(row.so_number);
			}
		}
		
</script>
