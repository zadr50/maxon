<div role="tabpanel">

	<h3>Nomor Tagihan : <?=$so->sales_order_number?></h3>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#tabSales" aria-controls="home" role="tab" 
				data-toggle="tab">
				Invoice
			</a>
		</li>
		<li role="presentation">
			<a href="#tabPayment" aria-controls="profile" role="tab" 
				data-toggle="tab">
				Payments
			</a>
		</li>
		<li role="presentation">
			<a href="#tabDelivery" aria-controls="profile" role="tab" 
				data-toggle="tab">
				Delivery
			</a>
		</li>
	</ul>

	<div class="tab-content">
	  <div role="tabpanel" class="tab-pane fade in active" id="tabSales">
			<table class='table'>
			<tr><td>Tanggal : </td><td><?=$so->sales_date?></td></tr>
			<tr><td>Nama : </td><td><?=$cust->company?></td></tr>
			<tr><td>Alamat : </td><td><?=$cust->street?></td></tr>
			<tr><td>Kota / Kode Pos : </td><td><?=$cust->city." / ".$cust->zip_postal_code ?></td></tr>
			<tr><td>Email / Phone : </td><td><?=$cust->email." / ".$cust->phone?></td></tr>
			</table>
			<h3>Item Barang yang dibeli</h3>
			<table class="table col-md-4" id='tblCart'>
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
		</div>
		
	 
		<div role="tabpanel" class="tab-pane fade" id="tabPayment">
			 
			
			
			<?php if(! $so_pay) { 	?>
				<p> </p><p> </p><p> </p>
				<p>Anda belum melakukan pembayaran untuk tagihan ini:</p>
				<h3>Tagihan Rp. <?=number_format($total)?></h3>
				<?php include_once "banks.php" ?>
				<a href='<?=base_url()?>index.php/eshop/cart/confirm' 
					class='btn btn-primary'>Konfirmasi</a>
				<p>
				<i>Klik tombol konfirmasi apabila anda sudah membayar</i>
				<i>Barang akan kami kirim dalam waktu kurang dari dua hari, 
				setelah pembayaran anda masuk ke rekening kami.</i>
				</p>
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
			 
		</div>

		<div role="tabpanel" class="tab-pane fade" id="tabDelivery">
			 
			
			<?php
			echo "<h3>Pengiriman</h3>";
			 
			if( $so->shipped_via == "" ) {
				echo "<p>Belum ada informasi pengiriman.</p>";
			} else {
				echo "<table class='table'><tr><td>Dikirim Via</td><td>$so->shipped_via</td></tr>
				<tr><td>Tanggal Kirim</td><td>$so->ship_date</td></tr>
				<tr><td>Perkiraan Sampai</td><td>$so->ship_day</td></tr>
				<tr><td>Berat </td><td>$so->ship_weight</td></tr>
				<tr><td>Nomor Resi Kiriman</td><td>$so->ship_no</td></tr>
				</table>";
			}
			
			
			?>
			 
		</div>
	</div>

</div>	