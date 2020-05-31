<? 
if(!isset($has_receive))$has_receive=false;
if(($mode=="add" or $mode=="edit" or $mode=="view")) { ?>

	<div id='dgItemForm' class="easyui-dialog" style="width:550px;height:380px;left:10px;top:10px;padding:5px 5px"
    closed="true" buttons="#tbItemForm" >
	
	<?php if (!$has_receive) { ?>
	    <form id="frmItem" method='post' >
	        <input type='hidden' id='po_number_item' name='po_number_item'>
	        <input type='hidden' id='line_number' name='line_number'>
	        <input type='hidden' id='gudang_item' name='gudang_item'>
				<table class='table2'  width="100%">
				 <tr><td >Kode Barang</td><td colspan='3'><input onblur='find()' id="item_number" style='width:180px' 
					name="item_number"   class="easyui-validatebox" required="true">
					<a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
					onclick="dlginventory_show();return false;"></a>
				 </td>
				 
				 </tr>
				 <tr><td>Nama Barang</td><td colspan='3'><input id="description" name="description" style='width:300px'></td></tr>
				 <tr><td>Qty</td><td><input id="quantity"  style='width:60px'  name="quantity" onblur="hitung()">
				 Unit <input id="unit" name="unit"  style='width:60px' >
					<a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
					onclick="searchUnit();return false;" 
					style='display:none' id='cmdLovUnit'></a> 
				 
				 Harga <input id="price" name="price"  style='width:80px'   onblur="hitung();return false;" class="easyui-validatebox" validType="numeric">
				 
				 </td></tr>
				<tr>
					<td colspan=3>
					<span id='divMultiUnit' style='display:none'>
						M_Qty <?=form_input("mu_qty","","id='mu_qty' style='width:60px'")?>
						M_Unit <?=form_input("multi_unit","","id='multi_unit' style='width:60px' ")?>
						M_Price <?=form_input("mu_harga","","id='mu_harga'")?>
					</span>
					</td>
				</tr>
				 
				 <tr><td></td><td colspan='3'>
					</td></tr>
					
					
				 <tr><td>Disc%1</td><td><input id="discount" name="discount"  style='width:50px'   onblur="hitung();return false;" class="easyui-validatebox" validType="numeric">
				 Disc%2 <input id="disc_2" name="disc_2"  style='width:50px'   onblur="hitung();return false;" class="easyui-validatebox" validType="numeric">
				 Disc%3 <input id="disc_3" name="disc_3"  style='width:50px'   onblur="hitung();return false;" class="easyui-validatebox" validType="numeric"></td></tr>
				 <tr><td>Jumlah</td><td colspan='3'><input id="amount" name="amount"  style='width:80px'  class="easyui-validatebox" validType="numeric"></td></tr>
				</table>
				 
	    </form>
	<?php } ?>	
	</div>
	
<? } ?>
	
<div id="tbItemForm">
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
		onclick='close_item();return false;' title='Close'>Cancel</a>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
		onclick='save_item();return false;' title='Save Item'>Submit</a>
</div>
<div id="tb" style="height:auto">
<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem();return false" data-options="plain:false">Add</a>
<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem();return false" data-options="plain:false">Edit</a>
<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem();return false" data-options="plain:false">Delete</a>
<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="reloadItem();return false" data-options="plain:false">Refresh</a>	
</div>
 
<?php 
	echo $lookup_inventory;
	echo load_view("inventory/select_unit");
	
?>
 
<script language="JavaScript">
 
	var qty_conv=0;
	
	function addItem(){
		var mode=$('#mode').val();
		if(mode=="add"){
			alert("Simpan dulu sebelum tambah item barang !");
			return false;
		}
		qty_conv=0;
		clear_input();
		//$('#dgItemForm').window({left:100,top:window.event.clientY+20});
		$("#dgItemForm").dialog("open").dialog('setTitle','Input barang');
	}
	function close_item(){
		clear_input();
		$("#dgItemForm").dialog("close");	
	}
	function find(){
		xurl=CI_ROOT+'inventory/find/'+$('#item_number').val();
		console.log(xurl);
		$.ajax({
					type: "GET",
					url: xurl,
					data:'item_no='+$('#item_number').val(),
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#item_number').val(obj.item_number);
						$('#price').val(obj.cost);
						if(obj.cost==0){
							$('#price').val(obj.cost_from_mfg);
						}  
						$('#cost').val(obj.cost);
						$('#unit').val(obj.unit_of_measure);
						$('#description').val(obj.description);
						if(obj.multiple_pricing){
							$("#cmdLovUnit").show();
							$("#divMultiUnit").show();
						} else {
							$("#cmdLovUnit").hide();
							$("#divMultiUnit").hide();
						}
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

		calc_qty_unit();
		hitung_jumlah();			
	}
		function calc_qty_unit(){
			if(qty_conv=="")qty_conv=1;
			if(qty_conv=="0")qty_conv=1;
			qty=$("#quantity").val();
			qty=qty*qty_conv;
			$("#mu_qty").val(qty);
		}
	
	function save_item(){
		var gudang=$("#warehouse_code").val();
		var url = '<?=base_url()?>index.php/purchase_order/save_item';
		var po=$('#purchase_order_number').val();

		if($("#mode").val()=="add"){alert("Simpan dulu nomor ini.");return false;};
		if(gudang==""){alert("Pilih dulu kode gudang !");return false;};
//			if(has_receive>0){alert("Nomor PO ini sudah ada penerimaan, tidak bisa diubah.");return false;};
		$('#po_number_item').val(po);
		$("#gudang_item").val(gudang);			 
		
		loading();
		
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					
					loading_close();
					
					$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+po+'/json'});
		//			$('#dg').datagrid('reload');
					
					hitung();
					
					$.messager.show({
						title: 'Success',
						msg: 'Success'
					});
					close_item();
					
				} else {
					
					loading_close();
					log_err(result.msg);
					
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	function clear_input(){
		$('#frmItem').form('clear');
		$('#item_number').val('');
		$('#discount').val('0');
		$('#disc_2').val('0');
		$('#disc_3').val('0');
		$('#unit').val('Pcs');
		$('#description').val('');
		$('#line_number').val('');
		$('#quantity').val(1);
		$('#price').val('0');
		$('#amount').val('0');
		$("#multi_unit").val("");
		$("#mu_qty").val("");
		$("#mu_harga").val("");						
	}
	function reloadItem(){
		var po=$('#purchase_order_number').val();
		var xurl='<?=base_url()?>index.php/purchase_order/items/'+po+'/json';
		$('#dg').datagrid({url: xurl});
		$('#dg').datagrid('reload');	// reload the user data
	}
	function deleteItem(){
		var po=$('#purchase_order_number').val();
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/purchase_order/delete_item/'+row.line_number;
					$.ajax({
						type: "GET",url: url,param: '',
						success: function(result){
							var result = eval('('+result+')');
							if (result.success)	void reloadItem();
						},
						error: function(msg){$.messager.alert('Info',msg);}
				});
					
				}
			})
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
			$('#amount').val(row.total_price);
			$('#line_number').val(row.line_number);
			$('#multi_unit').val(row.multi_unit);
			$('#mu_qty').val(row.mu_qty);
			$('#mu_harga').val(row.mu_harga);
			
			if($("#multi_unit").val()!=$("#unit").val()){
				$("#divMultiUnit").show();
			} else {
				$("#divMultiUnit").hide();
			}
			
		}
		//$('#dgItemForm').window({left:100,top:window.event.clientY+20});
		$("#dgItemForm").dialog("open");
		 
	}
	 
</script>
