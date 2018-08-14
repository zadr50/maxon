<div id='dgItemInv' class="easyui-dialog" style="width:600px;height:400px;
	padding:5px 5px"
    closed="true" buttons="#btnItem" >

    <form id="frmItemInv" method='post' >
		<table class='table' width='100%'>
		<tr>
			<td>Kode Barang</td>
			<td><input onblur='find();return false;' id="item_number" style='width:100px' 
	         	name="item_number"  >
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
				onclick="searchItem();return false;"></a>
	         </td>
		</tr>
		<tr>
			<td>Nama Barang</td>
	         <td><input id="description" name="description" style='width:300px'></td>
		</tr>
		<tr>
	         <td>Qty</td><td><input id="quantity"  style='width:80px'  name="quantity" onblur="hitung()">
	         Unit <input id="unit" name="unit"  style='width:80px' >
			
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
				onclick="searchUnit();return false;" 
				style='display:none' id='cmdLovUnit'>
							 
			 
			 </td>
		</tr>
		<tr>
			<td>Harga</td>
	        <td><input id="price" name="price"  style='width:180px'   onblur="hitung()" class="easyui-validatebox" validType="numeric"></td>
		</tr>
		<tr>
			<td>Disc%1</td>
	        <td><input id="discount" name="discount"  style='width:80px'   onblur="hitung()" class="easyui-validatebox" validType="numeric">
	        Disc%2 <input id="disc_2" name="disc_2"  style='width:80px'   onblur="hitung()" class="easyui-validatebox" validType="numeric">
	        Disc%3 <input id="disc_3" name="disc_3"  style='width:80px'   onblur="hitung()" class="easyui-validatebox" validType="numeric">
			</td>
		</tr>
		<tr>
	        <td>Jumlah</td><td><input id="amount" name="amount"  style='width:80px'  class="easyui-validatebox" validType="numeric"></td>
		</tr>
		<input type='hidden' id='invoice_number_item' name='invoice_number_item'>
		<input type='hidden' id='line_number' name='line_number'>
		
		</table>
	</form>
</div>	
<div id='btnItem'>
	<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
	   plain='false'	onclick='save_item()'>Simpan</a>
</div>
<?php 
if(!isset($show_tool))$show_tool=true; 

if($show_tool){
?>
	<div id="tb" class='box-gradient'>
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addItem();return false;">Add</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem();return false;">Edit</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteItem(); return false;">Delete</a>	
	</div>
<?php } ?>
<?=load_view("inventory/select_unit_jual")?>
<script language="JavaScript">
	function addItem(){
		var mode=$('#mode').val();
		if(mode=="add"){
			alert("Simpan dulu sebelum tambah item barang !");
			return false;
		}
//		$('#dgItemInv').window({left:100,top:window.event.clientY+20});
		$("#dgItemInv").dialog("open").dialog('setTitle','Input barang');
	}
	function close_item(){
		clear_input();
		$("#dgItemInv").dialog("close");	
	}
 
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
						$('#discount').val(obj.disc_prc_1);
						$('#disc_2').val(obj.disc_prc_2);
						$('#disc_3').val(obj.disc_prc_3);
						
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
		loading();
		hitung();
					 
		$('#frmItemInv').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				loading_close();
				var result = eval('('+result+')');
				if (result.success){
					$('#dg').datagrid('reload');
///						$("#dgItem").datagrid("reload");
					
//						find();
					
					clear_input();
					$("#dgItemInv").dialog("close");						
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
	function clear_input(){
		$('#frmItemInv').form('clear');
		$('#item_number').val('');
		$('#discount').val('0');
		$('#unit').val('Pcs');
		$('#item_number').val('');
		$('#line_number').val('');
		$('#quantity').val(1);
		$('#description').val('');
		$('#price').val('');
		$('#disc_2').val('');
		$('#disc_3').val('');
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
			$('#frmItemInv').form('load',row);
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
			$('#invoice_number_item').val(row.invoice_number);
			
			//$('#dgItemInv').window({left:100,top:window.event.clientY+20});
			$("#dgItemInv").dialog("open").dialog('setTitle','Input barang');

		}
	}
		
</script>
