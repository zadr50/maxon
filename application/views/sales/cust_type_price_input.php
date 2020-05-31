<div id='dlgItem' class="easyui-dialog" style="width:700px;height:400px;
    left:100px;top:20px;padding:5px 5px"
    closed="true" buttons="#dlgItemBtn" >

    <form id="frmItem" method='post' >
		<table class='table' width='100%'>
	    	<tr><td>Kode Barang</td>
		        <td><input onblur='find();return false;' id="item_number" style='width:150px' 
		         	name="item_number"  >
					<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
					onclick="dlginventory_show();return false;"></a>
		        </td>
	        </tr>
	        <tr><td>Nama Barang</td>
	        	<td><input id="description" name="description" style='width:300px' readonly=""></td>
			</tr>        
	        <tr><td>Harga Jual <?=$type_id?></td> 
	   	        <td><input id="sales_price"  name="sales_price" >
	   	        Harga Jual Master <b><span id="retail"  name="retail" readonly /></b>
	   	        
	        </tr> 
	        <tr><td>Minimum Qty</td> 
	   	        <td><input id="min_qty"  style='width:80px'  name="min_qty" ></td>
	        </tr> 
	        <tr>
	        	<td>Disc From %</td>
	        	<td>
		         	<input id="disc_prc_from" name="disc_prc_from"  style='width:80px' >
		         </td>
	        </tr>
			<tr>
	        	<td>Disc To %</td>
	        	<td>
		         	<input id="disc_prc_from" name="disc_prc_from"  style='width:80px' >
		         </td>
			</tr>
		</table>
		<input type='hidden' id='id' name='id'>
    </form>

</div>
<div id='dlgItemBtn'>
	<?=link_button("Submit", "dlgItem_save();return false;","save")?>
	<?=link_button("Close", "dlgItem_close();return false;","cancel")?>
</div>

<script language="JavaScript">
	function dlgItem_add(){
		dlgItem_clear();
		$("#dlgItem").dialog("open").dialog("setTitle","Input Price");
	}
	function dlgItem_close(){
		$("#dlgItem").dialog("close");	
	}
	function dlgItem_clear(){
		$('#frmItem').form('clear');
		$('#item_number').val('');
		$('#description').val('');
		$('#min_qty').val('0');
		$('#disc_prc_from').val('0');
		$('#disc_prc_to').val('0');
		$('#id').val('');
	}
	function dlgItem_save(){
		var cust_type='<?=$type_id?>';
		var url = CI_ROOT+'customer_type/save_item_price?cust_type='+cust_type;
		
		loading();
								 
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$("#dg").datagrid("reload");
					log_msg(result.msg);
					dlgItem_close();
					loading_close();
				} else {
					loading_close();
					log_err(result.msg);
				}
			}
		});
	}
		
</script>
