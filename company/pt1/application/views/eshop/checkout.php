 
		<? if($so_number == "") { ?>
			<div class="alert alert-warning" role="alert">Belum ada item yang dibeli.</div>
		<? } else {
			$so=$this->db->where('sales_order_number',$so_number)
				->get('sales_order')->row();
			$so_detail=$this->db->where('sales_order_number',$so_number)
				->get('sales_order_lineitems');
			?>
			<div class='col-lg-4'>
			<h1>CHECKOUT PROSES</h1>
			<p>Terimakasih anda sudah melakukan transaksi pembelian atas barang-barang 
			dibawah ini.</p>
			<p>Silahkan lakukan pembayaran ke rekening berikut ini 
			dalam waktu kurang dari 1 jam, lewat dari jam tersebut 
			sistim akan menghapus data belanja anda.</p>
			<p>Nomor tagihan yang baru dibuat adalah <h1><?=$so_number?></h1>
			Silahkan input nomor ini pada saat melakukan pembayaran di ATM/Bank</p>
			<p></p>
			<p>Tanggal : <?=$so->sales_date?></p>
			<p></p>
			<h4>Alamat Pengiriman </h4>
			<p>Nama : <?=$cust->company?></p>
			<p>Alamat : <?=$cust->street?></p>
			<p>Kota / Kode Pos : <?=$cust->city." / ".$cust->zip_postal_code ?></p>
			<p>Email / Phone : <?=$cust->email." / ".$cust->phone?></p>
			<p></p>
			</div>
			<div class='col-lg-8'>
			<h4>Item Barang yang dibeli</h4>
			<table class="table col-md-4" id='tblCart'>
			<head><th>Kode</th><th>Nama Barang</th><th>Qty</th>
			<th>Harga</th><th>Jumlah</th></thead>
			<tbody>
		<?
			$total=0;
			foreach($so_detail->result() as $item){
				$jumlah=$item->amount;
				$total=$total+$jumlah;
				echo "<tr><td>$item->item_number</td><td>$item->description</td>
				<td>$item->quantity</td>
				<td align='right'>".number_format($item->price)."</td>
				<td align='right'>".number_format($jumlah)."</td>
				</tr>";
			}
			echo "<tr><td><strong>TOTAL</strong></td><td></td><td></td><td></td>
				<td align='right'><strong>".number_format($total)."</strong>
				</td></tr>";
			echo "</tbody>";
		?>
			</table>
			</div>
			<div class='col-lg-5'>
			<h4>Total Tagihan Rp. <?=number_format($total)?></h4>
			<h5>Mohon ditransfer ke salah satu Rekening berikut </h5>
			<?
			  $q=$this->db->get('bank_accounts');
			  echo "<table class='table'><thead><th>Nomor Rekening</th><th>Nama Bank</th>
			  <th>Cabang</th><th>Atas Nama</th></thead>
			  <tbody>";
			  foreach($q->result() as $row)
			  {
				  $bank_list[$row->bank_account_number]=$row->bank_account_number.' - '.$row->bank_name;
				  echo "<tr><td>$row->bank_account_number</td><td>$row->bank_name</td>
				  <td>$row->city</td><td>$row->contact_name</td></tr>";
			  }
			  echo "</tbody></table>";
			?>
			<a href='<?=base_url()?>index.php/eshop/cart/confirm' 
				class='btn btn-primary'>Konfirmasi</a>
			<p>
			<i>Klik tombol konfirmasi apabila anda sudah membayar</i>
			<i>Barang akan kami kirim dalam waktu kurang dari dua hari, 
			setelah pembayaran anda masuk ke rekening kami.</i>
			</p>
			</div>
		<? } ?>
 
 
<script language='javascript'>
var cart=null;
$(document).ready(function() {
    $("#tblCart .deleteLink").on("click",function() {
        var tr = $(this).closest('tr');
        tr.css("background-color","#FF3700");
        tr.fadeOut(400, function(){
            tr.remove();
        });
		var idx=$(this).attr("value");
		var xurl="<?=base_url()?>index.php/eshop/item/del_cart/"+idx;
 		$.ajax({
			type: "GET", url: xurl,
			success: function(msg){
				console.log(msg);
			},
			error: function(msg){console.log(msg);}
		}); 
		
        return false;
    });
});

function edit_row(idx){
	alert(idx);
}
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
