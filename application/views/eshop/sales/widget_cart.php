<?php
if($cart=$this->session->userdata('cart')){
		$total=0;
		echo "<table class='table'>";
		for($i=0;$i<count($cart);$i++){
			$qty=$cart[$i]['qty'];
			$item_id=$cart[$i]['item_number'];
			$rowid=$cart[$i]['rowid'];
			if($q=$this->db->select('item_number,description,item_picture,retail,category')
				->where('item_number',$item_id)->get('inventory')){
				if($item=$q->row()) {
					$jumlah=$qty*$item->retail;
					$total=$total+$jumlah;
					echo "<tr><td>$qty</td><td>$item->description</td>
					</tr>";
				}
			}
		}
	echo "</table>";
	echo "<a href='".base_url()."index.php/eshop/cart'>View</a>";
} else {
	echo "Kantong belanja masih kosong.";
}

?>