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
	        	<td><input id="description" name="description" style='width:300px'></td>
			</tr>        
	        <tr><td>Qty</td> 
	   	        <td><input id="quantity"  style='width:80px'  name="quantity" onblur="hitung()"></td>
	        </tr> 
	        <tr>
	        	<td>Unit</td>
	        	<td>
		         	<input id="unit" name="unit"  style='width:80px' >
		         	<?=link_button("", "searchUnit();return false;","search")?>
		         </td>
	        </tr>
			<tr>
				<td colspan=3>
					<span id='divMultiUnit' style='display:none'>
						M_Qty <?=form_input("mu_qty","","id='mu_qty' style='width:60px'")?>
						M_Unit <?=form_input("multi_unit","","id='multi_unit' style='width:60px' ")?>
						M_Price <?=form_input("mu_harga","","id='mu_harga'")?>
					</span>
				</td>
			</tr>
		</table>
		<input type='hidden' id='invoice_number_item' name='invoice_number_item'>
		<input type='hidden' id='line_number' name='line_number'>
    </form>

</div>
<div id='dlgItemBtn'>
	<?=link_button("Submit", "dlgItem_save();return false;","save")?>
	<?=link_button("Close", "dlgItem_close();return false;","cancel")?>
</div>

<script language="JavaScript">
	var qty_conv = 0;
	
	function dlgItem_close(){
		$("#dlgItem").dialog("close");	
	}
	function dlgItem_clear(){
		$('#frmItem').form('clear');
		$('#item_number').val('');
		$('#discount').val('0');
		$('#disc_2').val('0');
		$('#disc_3').val('0');
		$('#unit').val('');
		$('#description').val('');
		$('#line_number').val('');
		$('#quantity').val(1);
		$('#price').val(0);	
		$("#mu_qty").val("");
		$("#multi_unit").val("");
		$("#mu_price").val("");		
	}
	function calc_qty_unit(){
		if(qty_conv=="")qty_conv=1;
		if(qty_conv=="0")qty_conv=1;
		qty=$("#quantity").val();
		qty=qty*qty_conv;
		$("#mu_qty").val(qty);
	}
	
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
	function dlgItem_save(){
		var mode=$('#mode').val();
		if(mode=="add"){log_err("Simpan dulu nomor ini !");return false;}
		var url = '<?=base_url()?>index.php/invoice/save_item';
		$('#invoice_number_item').val($('#invoice_number').val());
		
		loading();
								 
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					dgItem_refresh();
					loading_close();
					log_msg("Success");
					dlgItem_close();
				} else {
					loading_close();
					log_err(result.msg);
				}
			}
		});
	}
		
</script>
