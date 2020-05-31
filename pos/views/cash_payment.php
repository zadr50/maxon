<div id="dlgPayCash" name="dlgPayCash" class="easyui-dialog" style="width:550px;height:350px" buttons="#dlgPayCash_Button" closed="true" >
	<table width="100%" class="table">
		<tr>
			<td><b>Tagihan</b></td>
			<td><?=form_input('tagih',0,"id='dlgPayCash_Tagih' disabled  
				style='font-size:15px;width:150px;text-align:right'")?></td>
		</tr>
		<tr>
			<td><b>Bayar</b></td>
			<td><?=form_input('bayar',0,"id='dlgPayCash_Bayar'  onblur='dlgPayCash_Calc();return false;'  
				style='font-size:20px;width:150px;text-align:right'")?></td>
		</tr>
		<tr>
			<td><b>Kembalian</b></td>
			<td><?=form_input('kembali',0,"id='dlgPayCash_Kembali' disabled  
				style='font-size:20px;width:150px;text-align:right'")?></td>
		</tr>
		<tr>
			<td><b>Alokasi</b></td>
			<td><?=form_input('alokasi',0,"id='dlgPayCash_Alokasi' disabled  
				style='font-size:20px;width:150px;text-align:right'")?></td>
		</tr>
	</table>
	<div style="display:none">
		<?=form_input("dlgPayCash_Flag","","id='dlgPayCash_Flag' style='width:20px' disabled ")?>		
	</div>
</div>
<div id="dlgPayCash_Button">
        <?=link_button("Cancel","dlgPayCash_Cancel()","cancel","false");?>                
        <?=link_button("Submit","dlgPayCash_Submit()","save","false");?>                
</div>
