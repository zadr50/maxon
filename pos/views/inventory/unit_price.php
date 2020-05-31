<div id="dlgUnitPrice" class="easyui-dialog"  buttons="#tbUnitPrice"
	style="width:400px;height:300px;padding:5px 5px;left:100px;top:20px" closed="true" >
	<form id="frmUnitPrice" name="frmUnitPrice" method="POST">
	<table class="table2" width="100%">
		<tr><td>Kode</td><td><input type="text" name="customer_pricing_code" id="customer_pricing_code"></td></tr>
		<tr><td>Harga Jual</td><td><input type="text" name="retail" id="retail"></td></tr>
		<tr><td>Harga Beli</td><td><input type="text" name="cost" id="cost"></td></tr>
		<tr><td>From Qty</td><td><input type="text" name="quantity_low" id="quantity_low"></td></tr>
		<tr><td>To Qty</td><td><input type="text" name="quantity_high" id="quantity_high"></td></tr>
		<tr><td>From Date</td><td><input type="text" name="date_from" id="date_from"></td></tr>
		<tr><td>To Date</td><td><input type="text" name="date_to" id="date_to"></td></tr>
	</table>
	</form>
</div>
<div id='tbUnitPrice'>
	<?php
	echo link_button("Save","dlgUnitPrice_Save()","save");
	echo link_button("Delete","dlgUnitPrice_Delete()","remove");
	echo link_button("Close","dlgUnitPrice_Close()","cancel");
	?>
</div>
<script language="JavaScript">
	function dlgUnitPrice_Clear(){
		$("#customer_pricing_code").val("");
		$("#retail").val("");
		$("#quantity_high").val("");
		$("#quantity_low").val("");
		$("#date_from").val("");
		$("#date_to").val("");
		$("#cost").val("");
	}
	function dlgUnitPrice_Add(){
		dlgUnitPrice_Clear();
		$('#dlgUnitPrice').dialog('open').dialog('setTitle','Unit Price');
	}
	function dlgUnitPrice_Edit(){
		var row = $('#dgUnitPrice').datagrid('getSelected');
		if (row){
			var customer_pricing_code=row.customer_pricing_code;
			if(customer_pricing_code==""){alert("Kode tidak ada !");return false;}
			xurl=CI_ROOT+'inventory/unit_price_load/<?=$item_number?>/'+customer_pricing_code;                             
			$.ajax({
				type: "GET", url: xurl,
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#customer_pricing_code").val(result.customer_pricing_code);
						$("#retail").val(result.retail);
						$("#quantity_high").val(result.quantity_high);
						$("#quantity_low").val(result.quantity_low);
						$("#date_from").val(result.date_from);
						$("#date_to").val(result.date_to);
						$('#dlgUnitPrice').dialog('open').dialog('setTitle','Unit Price');
					}
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});       
		}
		
	}
	function dlgUnitPrice_Close(){
		$("#dlgUnitPrice").dialog("close");
	}
	function dlgUnitPrice_Save(){
		url='<?=base_url()?>index.php/inventory/unit_price_add/<?=$item_number?>';
		$('#frmUnitPrice').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					dlgUnitPrice_Close();
					dgUnitPrice_Refresh();
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
 	}
 	function dlgUnitPrice_Delete(){
		var item_number=$("#item_number").val();
		var kode='';
		if(item_number==""){alert("Kode belum diisi !");return false}
		var row = $('#dgUnitPrice').datagrid('getSelected');
		if (row) kode=row.customer_pricing_code;
        xurl=CI_ROOT+'inventory/delete_price/<?=$item_number?>/'+kode;                             
        $.ajax({
            type: "GET",
            url: xurl,
            success: function(msg){
				dlgUnitPrice_Close();
				dgUnitPrice_Refresh();
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });         
 	}
	
</script>