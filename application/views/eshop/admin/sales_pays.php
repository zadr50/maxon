
			<?php if(! $so_pay) { 	?>
				<p>Belum ada data pembayaran untuk nomor tagihan ini.</p>
				<a href='<?=base_url()?>index.php/eshop/cart/confirm' 
					class='btn btn-primary'>Konfirmasi</a>
			<?php } else { 
				echo "<h3>Data Pembayaran</h3>";
				echo "<table class='table'><tr><td>Tanggal Bayar : </td><td>$so_pay->date_paid</td></tr>
				<tr><td>Cara Bayar : </td><td>$so_pay->how_paid</td></tr>
				<tr><td>Jumlah Bayar </td><td>Rp. : ".number_format($so_pay->amount_paid)."</td></tr>
				<tr><td>Dari Bank : </td><td>$so_pay->from_bank</td></tr>
				<tr><td>Dari Rekening : </td><td>$so_pay->from_account</td></tr>
				<tr><td>Atas Nama: </td><td>$so_pay->authorization</td></tr>
				<tr><td>Rekening Tujuan : </td><td>$so_pay->account_number</td></tr>
				</table>
				";
			}
			?>
			
			
