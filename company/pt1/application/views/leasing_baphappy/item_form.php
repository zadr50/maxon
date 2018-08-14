<div id='dlgAddItem'class="easyui-dialog" style="width:500px;height:400px;padding:10px 20px" 
	closed="true" buttons="#tbAddItem">
	<form method='post' id='frmAddItem'>
	<table class='table2' width='100%'>
	<tr><td>Kode Barang </td><td><input type='text' name='item_no' id='item_no'>
	<?=link_button("Cari","dlgFindItem_Show();return false","search")?>
	</td></tr>
	<tr><td>Nama Barang </td><td><input type='text' name='desc' id='desc' readonly style="width:300px"></td></tr>
	<tr><td>Quantity </td><td><input type='text' name='qty' id='qty' ></td></tr>
	<tr><td>Harga Jual </td><td><input type='text' name='price' id='price'></td></tr>
	</table>
	<?
		echo form_hidden("frmAddItem_AppId",$app_id,"id='frmAddItem_AppId'");
		echo "<input type='hidden' name='frmAddItem_Id' id='frmAddItem_Id'>";
	?>
	</form>
	<p>&nbsp</p>
	<div id='divCalc' name='divCalc' style='display:none'>
	<table class='table2' width='100%'>
		<tr><td colspan='2'><strong>PERHITUNGAN</strong></td></tr>
		<tr><td>Down Payment </td>
			<td><input disabled type='text' id='calc_dp_prc' name='calc_dp_prc' style="width:50px">
				<input disabled type='text' id='calc_dp_amt' name='calc_dp_prc'>
			</td>
		</tr>
		<tr><td>Bunga </td>
			<td><input disabled type='text' id='calc_bunga_prc' name='calc_bunga_prc' style='width:50px'>
				<input disabled type='text' id='calc_bunga_amt' name='calc_bunga_amt'>
			</td>
		</tr>
		<tr><td>Admin</td><td><input type='text' id='calc_admin' name='calc_admin'></td></tr>
		<tr><td>Asuransi</td><td><input type='text' id='calc_asuransi' name='calc_asuransi'></td></tr>
		<tr><td>Tenor x Bulan</td><td><input type='text' id='calc_tenor' name='calc_tenor' value='0'></td></tr>
		<tr><td>Angsuran/Bulan</td><td><input disabled type='text' id='calc_angsuran' name='calc_angsuran'></td></tr>
	</table>
	</div>
</div>	   
<div id='tbAddItem'>
	<?=link_button('Hitung', 'dlgAddItem_Calc()','ok');?>
	<?=link_button('Save', 'dlgAddItem_Save()','save');?>
	<?=link_button('Close', 'dlgAddItem_Close()','no');?>
</div>

<script language="JavaScript">
	function dlgAddItem_Calc(){	
		$("#divCalc").fadeIn("slow");
		var tenor=$("#calc_tenor").val();
		if(tenor==0)tenor=$("#inst_month").val();
		var price=$("#price").val();
		if(tenor==0)tenor=3;
		var qty=$("#qty").val();
		var total=price*qty;
		$("#calc_tenor").val(tenor);
		$.ajax({type: "GET",url: "<?=base_url()?>index.php/leasing/app_master/calc_loan",
				data: {"price":total,"tenor":tenor},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#calc_dp_prc").val(result.dp);
						$("#calc_dp_amt").val(number_format(result.dp_amount));
						$("#calc_bunga_prc").val(result.bunga);
						$("#calc_bunga_amt").val(number_format(result.bunga_amount));
						$("#calc_admin").val(number_format(result.admin));
						$("#calc_asuransi").val(number_format(result.asuransi));
						$("#calc_angsuran").val(number_format(result.angsuran));
					}
				},
				error: function(result){alert(result);}
		}); 		
	}
	function dlgAddItem_Save(){
  		if($('#app_id').val()==''){alert('Isi kode aplikasi !');return false;}
		url='<?=base_url()?>index.php/leasing/app_master/items/save';
		$('#frmAddItem').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					dlgAddItem_Close();				
					log_msg('Data sudah tersimpan.');
					dgItem_Refresh();					
				} else {
					log_err(result.msg);
				}
			}
		});
		dlgAddItem_Close();
	}
	function dlgAddItem_Close(){
		$('#dlgAddItem').dialog('close');
		$('#item_no').val("");
		$('#desc').val("");
		$('#qty').val("1");
		$('#price').val("0");
	}
</script>