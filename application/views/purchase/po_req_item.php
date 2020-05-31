<div id='dgItem'>
	<div id='dgItemForm' class="easyui-dialog" 
	style="width:600px;height:350px;left:100px;top:100px;padding:5px 5px"
    closed="true" buttons="#tbItemForm" >
	    <form id="frmItem" method='post' >
	        <input type='hidden' id='po_number_item' name='po_number_item'>
	        <input type='hidden' id='line_number' name='line_number'>
	        <input type='hidden' id='gudang_item' name='gudang_item'>
				<table class='table2' style='float:left;' width='100%'>
				 <tr><td >Kode Barang</td><td colspan='3'>
				 	<input onblur='find();return false' id="item_number" style='width:180px' 
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
					id='cmdLovUnit'></a> 
				</td>
				<tr><td colspan=3>
					 <div id="divMultiUnit" style='display:none' >
						M_Qty: <?=form_input("mu_qty","","id='mu_qty' style='width:40px'")?>
						M_Unit: <?=form_input("multi_unit","","id='multi_unit' style='width:80px'")?>
					</div>	
				 </td>
				 </tr>
				 <tr><td>Category</td><td colspan='3'>
				 	<?=form_dropdown('line_type',array('Repeat'=>'Repeat','Non Repeat'=>'Non Repeat'),'Non Repeat');?>
				 </tr>
				 <tr><td>Status</td><td colspan='3'>
				 	<?=form_dropdown('line_status',array('Accept'=>'Accept','Pending'=>'Pending','Reject'=>'Reject'),'Pending');?>
				 </tr>
				 <tr><td>Alasan</td><td colspan='3'><input id="comment" name="comment" style='width:300px'></td></tr>
			</table>				
	    </form>
	</div>
</div>

	
<div id="tbItemForm">
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
		onclick='dgItem_close();return false;' title='Close'>Cancel</a>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
		onclick='dgItem_save();return false;' title='Save Item'>Submit</a>
</div>
 
<?php 
	echo $lookup_inventory;
//	echo load_view("inventory/inventory_select");
	echo load_view("inventory/select_unit");	
?>
 
<script language="JavaScript">



	function dgItem_add(){
		var mode=$('#mode').val();
		if(mode=="add"){
			log_err("Simpan dulu sebelum tambah item barang !");
			return false;
		}
		//$('#dgItemForm').window({left:window.event.clientX*0.5,top:window.event.clientY*0.5});
		$("#dgItemForm").dialog("open").dialog('setTitle','Input barang');
	}
	function dgItem_close(){
		dgItem_clear();
		$("#dgItemForm").dialog("close");	
	}
	
	function dgItem_save(){
		var gudang=$("#warehouse_code").val();
		var url = '<?=base_url()?>index.php/purchase_order/save_item';
		var po=$('#purchase_order_number').val();

		if($("#mode").val()=="add"){alert("Simpan dulu nomor ini.");return false;};
		if(gudang==""){alert("Pilih dulu kode gudang !");return false;};
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
					dgItem_reload();
					log_msg("Loading..");
					loading_close();		
					dgItem_close();					
				} else {
					loading_close();		
					log_err(result.msg);
				}
			}
		});
	}
	function dgItem_clear(){
		$('#frmItem').form('clear');
		$('#item_number').val('');
		$('#unit').val('Pcs');
		$('#description').val('');
		$('#line_number').val('');
		$('#quantity').val(1);
		$('#comment').val('');
		$("#mu_qty").val("");
		$("multi_unit").val("");
	}
	function dgItem_reload(){
		var po=$('#purchase_order_number').val();
		var xurl='<?=base_url()?>index.php/purchase_order/items/'+po+'/json';
		$('#dgItem').datagrid({url: xurl});
		//$('#dg').datagrid('reload');	// reload the user data
	}
	function dgItem_delete(){
		var po=$('#purchase_order_number').val();
		var row = $('#dgItem').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/purchase_order/delete_item/'+row.line_number;
					$.ajax({
						type: "GET",url: url,param: '',
						success: function(result){
							var result = eval('('+result+')');
							if (result.success)	void dgItem_reload();
						},
						error: function(msg){log_err(msg);}
				});					
				}
			})
		}
	}
	function dgItem_view(){
		var row = $('#dgItem').datagrid('getSelected');
		if (row){
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.quantity);
			$('#unit').val(row.unit);
			$('#line_type').val(row.line_type);			
			$('#line_status').val(row.line_status);
			$('#line_number').val(row.line_number);
			$('#comment').val(row.comment);
			$("#mu_qty").val(row.mu_qty);
			$("#multi_unit").val(row.multi_unit);
			$("#divUnit").show();
		}
		$("#dgItemForm").dialog("open");
	}
	function hitung(){
	    
	}
	function find(){
			var cust_type=$('#cust_type').val();
			 
			var item=$("#item_number").val();
			if( item=="" || item=="undefined")return false;
			var cust_no=$("#sold_to_customer").val();
		    xurl=CI_ROOT+'inventory/find/'+item+'/'+cust_type ;
			var param={item_no:item,cust_type:cust_type,cust_no:cust_no};
			
			loading();
			
		    $.ajax({
				type: "GET",
				url: xurl,
				data: param,
				success: function(msg){
					var obj=jQuery.parseJSON(msg);
					if(obj.success){
						$('#item_number').val(obj.item_number);
						$('#price').val(obj.retail);
						$('#cost').val(obj.cost);
						if(obj.cost)$("#cost").val(obj.cost_from_mfg);
						
						$('#unit').val(obj.unit_of_measure);
						$('#description').val(obj.description);
						$("#discount").val(obj.discount);
						if(obj.discount==0) $("#discount").val(obj.disc_prc_1);
						$("#disc_2").val(obj.disc_prc_2);
						$("#disc_3").val(obj.disc_prc_3);
						if(obj.multiple_pricing){
							$("#cmdLovUnit").show();
							$("#divMultiUnit").show();
						} else {
							$("#cmdLovUnit").hide();
							$("#divMultiUnit").hide();
						}
						$("#quantity").val("1");
						
					}

					loading_close();
					
					hitung();
				},
				error: function(msg){
					loading_close();
					log_err(msg);
				}
		    });
		};
		
		
</script>
    