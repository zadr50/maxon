			<h3>Item Barang yang dibeli</h3>
			<table class="table " id='tblCart'>
			<head><th>Kode</th><th>Nama Barang</th><th>Qty</th>
			<th>Harga</th><th>Jumlah</th></thead>
			<tbody>
		<?
			$total=0;
			foreach($so_detail->result() as $detail){
				echo "<tr><td>$detail->item_number</td>
				<td>$detail->description</td><td>$detail->quantity</td>
				<td align='right'>".number_format($detail->price)."</td>
				<td align='right'>".number_format($detail->amount)."</td>
				</tr>";
				$total=$total+$detail->amount;
			}
			echo "<tr><td><strong>TOTAL</strong></td><td></td><td></td><td></td>
				<td align='right'><strong>".number_format($total)."</strong>
				</td></tr>";
			echo "</tbody>";
		?>
			</table>