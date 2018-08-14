<?php 
//var_dump($type_id);
if($type_id==""){
	echo "<p class='alert alert-warning'>Kode kelompok pelanggan belum dipilih</p>";	
} else {
	if($item_prices){
		echo "<p class='alert alert-info'>Isi harga jual barang dan discount untuk kelompok pelanggan 
		<strong>$type_id</strong> pada daftar tabel dibawah ini, 
		kemudian tekan tombol submit paling bawah: </p>";
		$s1="<table class='table' width='100%'>
		<thead><th>Item Description</th><th>Item No</th>
		<th>Sales Std Price</th><th>Sales Type Price</th>
		<th>Min Qty Sales</th><th>Disc From (%)</th><th>Disc To (%)</th>
		</thead><tbody>";
		$s="";
		for($i=0;$i<count($item_prices);$i++){
			$item=$item_prices[$i];
			$price=$item_prices[$i]['prices'];
			if($price){
				$sales_price=$price->sales_price;
				$min_qty=$price->min_qty;
				$disc_prc_from=$price->disc_prc_from;
				$disc_prc_to=$price->disc_prc_to;
				$id=$price->id;				
			} else {
				$sales_price=0;
				$min_qty=0;
				$disc_prc_from=0;
				$disc_prc_to=0;
				$id=0;
			}
			$no=$item['item_no'];
			$s.= "<tr><td>".$item['description']."</td>";
			$s.= "<td>$no</td><td>".$item['retail']."</td>";
			$s.=  "<td><input type='text' id='p_$no' value='$sales_price' style='width:90px'></td>
				<td><input type='text' id='q_$no' value='$min_qty' style='width:50px'></td>
				<td><input type='text' id='d1_$no' value='$disc_prc_from' style='width:50px'></td>
				<td><input type='text' id='d2_$no' value='$disc_prc_to' style='width:50px'></td>
				<td><input type='hidden' id='i_$no' value='$id' style='width:50px'></td>
				<td><input type='button' value='Save' class='btn btn-default' onclick=\"save_item('$no');return false;\"></td>
				</tr>";
		}
		echo $s1 . $s . "</tbody></table>";
	} else {
		echo "<p class='alert alert-warning'>Unknown Error !</p>";			
	}
}
?>
<script>
var cust_type='<?=$type_id?>';
function save_item(item_no){
	var param={cust_type:cust_type,item_no:item_no, 
		p:$('#p_'+item_no).val(), 
		q:$('#q_'+item_no).val(), 
		d1:$('#d1_'+item_no).val(), 
		d2:$('#d2_'+item_no).val(), 
		i:$('#i_'+item_no).val() 
		};
	console.log(param);
	
	$.ajax({
			type: "GET",
			url: "<?=base_url()?>index.php/customer_type/save_item_price",
			data: param,
			success: function(msg){
				var retval = eval('('+msg+')');
				console.log(retval);
				if(retval.success){
					$('i_'+item_no).val(retval.id);
					log_msg('Sukses');
				} else {
					log_err('Error!');
				}
				return true;
			},
			error: function(msg){log_err('Unknown');}
	}); 	
}
</script>