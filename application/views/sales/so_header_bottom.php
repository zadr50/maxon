	<div id='divTotal'> 
		<table class='table2' width='100%'>
			<tr><td colspan=4><h4>Total Info</h4></td></tr>
			<tr>
				<td>Sub Total: </td><td><input name='sub_total' id='sub_total' value='<?=number_format($subtotal)?>' style='width:100px'></td>				
				<td>Discount %: </td><td><input name='disc_total_percent' id='disc_total_percent' value='<?=$discount?>' style='width:50px'>
				<input type='hidden' id='tmp_disc_total_percent'>
				</td>
				<td>Discount  : </td><td><input name='disc_amount_1' id='disc_amount_1' value='<?=number_format($disc_amount_1)?>' style='width:100px'></td>
			</tr>
			<tr>
				<td>Ongkos Angkut: </td><td><input name='freight' id='freight' value='<?=$freight?>' style='width:80px'></td>
				<td>Pajak PPN %: </td><td><input name='sales_tax_percent' id='sales_tax_percent' value='<?=$sales_tax_percent?>' style='width:50px'></td>
				<td>Pajak PPN  : </td><td><input name='tax' id='tax' value='<?=number_format($tax)?>' style='width:100px'></td>
			</tr>
			<tr>
				<td>Biaya Lain: </td><td><input name='other' id='other' value='<?=$other?>' style='width:80px'></td>
				<td>&nbsp</td><td>&nbsp</td>
				<td>JUMLAH: </td><td><input name='total' id='total' value='<?=number_format($amount)?>' style='width:100px'>
					 <a id='divHitung' href="#" class="easyui-linkbutton" data-options="iconCls:'icon-sum'"  
					   plain='true' title='Hitung ulang' onclick='hitung_jumlah()'></a>
					
				</td>
			
			</tr>

		</table>		
	</div>   


 
