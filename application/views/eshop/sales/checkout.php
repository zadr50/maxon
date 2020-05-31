 
		<?php if($so_number == "") { ?>
			<div class="alert alert-warning" role="alert">Belum ada item yang dibeli.</div>
		<?php } else {
			$so=$this->db->where('sales_order_number',$so_number)
				->get('sales_order')->row();
				
//			$so_detail=$this->db->where('sales_order_number',$so_number)
//				->get('sales_order_lineitems');
			
			$s="select il.item_number,il.description,il.quantity,il.unit,il.price,il.amount,s.weight 
			from sales_order_lineitems il left join inventory s on s.item_number=il.item_number 
			where il.sales_order_number='$so_number'";
			$so_detail=$this->db->query($s);
				$jasa_kirim_list=array("JNE","TIKI","POS","PCP","RPX","ESL");
				$jasa_kirim=1;
				
			?>

			
			
			<div class='col-lg-6'>
					<h4>Item Barang yang dibeli</h4>
					
					
					<table class="table col-md-4" id='tblCart'>
					<head><th>Kode</th><th>Nama Barang</th><th>Qty</th><th>Unit</th>
					<th>Harga</th><th>Jumlah</th><th>Berat (Kg)</th></thead>
					<tbody>
				<?php
					$total=0;
					$kg_total=0;
					foreach($so_detail->result() as $item){
						$jumlah=$item->amount;
						$total=$total+$jumlah;
						$kg=$item->weight;
						if($kg=="" || $kg=="0") $kg=1;
						$kg_total+=$kg;
						
						echo "<tr><td>$item->item_number</td><td>$item->description</td>
						<td>$item->quantity</td><td>$item->unit</td>
						<td align='right'>".number_format($item->price)."</td>
						<td align='right'>".number_format($jumlah)."</td>
						<td align='left'>".number_format($kg,2)."</td>
						</tr>";
					}
					echo "<tr><td><strong>TOTAL</strong></td><td></td><td></td><td></td><td></td>
						<td align='right'><strong>".number_format($total)."</strong>
						</td><td><b>".number_format($kg_total,2)."</b></td></tr>";
					echo "</tbody>";
					
				$ongkos=0;
				$total=$total-$ongkos;
					
				?>
			</table>
			
			

				<p><b>Total berat barang: </b> <?=$kg_total?> Kg</b></p>
				<p><b>Jasa Kiriman</b>: <?=form_dropdown("jasa_kirim",$jasa_kirim_list,$jasa_kirim,
					"id='jasa_kirim' style='width:200px' ")?></p>
				<p><strong>Ongkos Kirim: Rp. </strong><?=form_input("ongkos",$ongkos,
					"id='ongkos' onblur='calc_total();return false;'")?></p>
				<p><a href='https://rajaongkir.com/' target="_blank">Cek Ongkos Kirim</a></p>
				
				<div class='alert alert-warning'>
					<h4>Total Tagihan Rp. <span id='span_total'><?=number_format($total)?></span></h4>
					<p></p>
					<a href='#' onclick="confirm_order();return false;" 
						class='btn btn-primary'>Konfirmasi</a>
					<p>
				</div>
					
					
				<i>* Klik tombol konfirmasi apabila anda sudah membayar</i>
				</br><i>* Barang akan kami kirim dalam waktu kurang dari dua hari, 
					setelah pembayaran anda masuk ke rekening kami.
				</i>
				</p>
				
				<p><b>Mohon ditransfer ke salah satu Rekening berikut </b></p>
				<?php
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
		 
		 			
			</div>

			<div class='col-lg-4'>
				<h1>CHECKOUT</h1>
				<p>Terimakasih anda sudah melakukan transaksi pembelian atas barang-barang 
				dibawah ini.</p>
				<p>Silahkan lakukan pembayaran ke rekening berikut ini 
				dalam waktu kurang dari 1 jam, lewat dari jam tersebut 
				sistim akan menghapus data belanja anda.</p>
				<p><b>Tanggal : <?=$so->sales_date?></b></p>
				<p></p>
				
				<p>Nomor tagihan yang baru dibuat adalah 
				<div class='alert alert-info'>	
					<b><?=$so_number?></b>
				</div>	
				Silahkan input nomor ini pada saat melakukan pembayaran di ATM/Bank</p>
				<p></p>
				<div class='alert alert-info'>
					<h4>Alamat Pengiriman </h4>
					<p>Nama : <?=$cust->company?></p>
					<p>Alamat : <?=$cust->street?></p>
					<p>Kota / Kode Pos : <?=$cust->city." / ".$cust->zip_postal_code ?></p>
					<p>Email / Phone : <?=$cust->email." / ".$cust->phone?></p>
				</div>
				<p></p>			
			</div>

			
		<?php } ?>
 
			
 
<script language='javascript'>
var cart=null;
var total=<?=$total?>;
var jumlah=0;

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function calc_total(){
	var ongkos=$("#ongkos").val();
	jumlah=parseInt(total)+parseInt(ongkos);
	$("#span_total").html(formatNumber(jumlah));
}
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
function confirm_order(){
	var ongkos=$("#ongkos").val();
	if(ongkos=="" || ongkos=="0"){
		alert("Isi jumlah ongkos kirim !");
		return false;
	}
	var jkirim=$("#jasa_kirim").val();
	var xurl="<?=base_url()?>index.php/eshop/cart/confirm_json";
	$.ajax({
		type: "GET", url: xurl, 
		data: {jasa_kirim: jkirim, ongkir:ongkos,total: jumlah}, 
		success: function(msg){
			console.log(msg);
			var result = eval('('+msg+')');
			if (result.success){
			    url="<?=base_url()?>index.php/eshop/cart/confirm";
			    window.open(url,"_self");
				log_msg('Data sudah tersimpan. Silahkan pilih nama barang');
			} else {
				log_err(result.msg);
			}
		},
		error: function(msg){console.log(msg);}
	}); 
}
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
