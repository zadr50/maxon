 
		<img src='<?=base_url()?>images/ico_sales.png' 
		style='float:left;margin-right:20px'>
		<h1>Data Kantong Belanja</h1>
		<p>Selamat datang 
		<?=$this->session->userdata("cust_name")?> !! </p>
		<table class="table" id='tblCart'>
		<head><th>Kode</th><th>Nama Barang</th><th>Qty</th>
		<th>Harga</th><th>Jumlah</th><th>Action</th></thead>
		<tbody>
	<?php
		$total=0;
		for($i=0;$i<count($cart);$i++){
			//var_dump($cart[$i]);
			$qty=$cart[$i]['qty'];
			$item_id=$cart[$i]['item_number'];
			$rowid=$cart[$i]['rowid'];
			if($q=$this->db->select('item_number,description,item_picture,retail,category')
				->where('item_number',$item_id)->get('inventory')){
				if($item=$q->row()) {
					$jumlah=$qty*$item->retail;
					$total=$total+$jumlah;
					echo "<tr><td>$item->item_number</td><td>$item->description</td><td>$qty</td>
					<td align='right'>".number_format($item->retail)."</td>
					<td align='right'>".number_format($jumlah)."</td>
					<td><a href='#' class='btn btn-warning deleteLink' value='$rowid'>Delete</a>
					</td></tr>";
				}
			}
		}
		echo "<tr><td><strong>TOTAL</strong></td><td></td><td></td><td></td>
			<td align='right'><strong>".number_format($total)."</strong>
			</td><td></td></tr>";
		echo "</tbody>";
	?>
		</table>
		<a href="<?=base_url()?>index.php/eshop/cart/checkout" class='btn btn-primary'>Check Out</a>
	 
 
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
