<form  id="frmSales" method='post' >
	<table>
		<tr>
			<td colspan="2"><h2>SETTING PENJUALAN</h2></td>
		</tr>
		<tr>
			<td>Boleh ubah discount ketika transaksi</td><td><?
			echo form_input('accounts_payable',$a,'id="accounts_payable" style="width:250px"');
			?></td>
		</tr>
		<tr>
			<td>Boleh ubah harga jual ketika transaksi</td><td><?
			echo form_input('po_freight',$a,'id="po_freight" style="width:250px"');
			?></td>
		</tr>
		<tr>
			<td>Boleh cetak surat jalan lebih dari sekali</td><td><?
			echo form_input('po_other',$a,'id="po_other" style="width:250px"');
			?></td>
		</tr>
		<tr>
			<td>Boleh cetak faktur lebih dari sekali</td><td><?
			echo form_input('po_tax',$a,'id="po_tax" style="width:250px"');
			?></td>
		</tr>
		<tr>
			<td>Boleh simpan faktur dibawah harga modal</td><td><?
			echo form_input('po_discounts_taken',$a,'id="po_discounts_taken" style="width:250px"');
			?></td>
		</tr>

	</table>
	
	<input type='submit' name='cmdSave'>
</form>

