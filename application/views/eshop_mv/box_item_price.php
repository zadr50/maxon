<?
if($q=$this->db->where("item_number",$item_id)->get("inventory_prices")){
	if($q->num_rows()){
	echo "<div class='row'>
		<div class='col-md-11'>
		<h4>Daftar Harga Grosir</h4>
		<table class='table'>";
	foreach($q->result() as $row)
	{
		echo "		<tr><td>".$row->quantity_high." - ".
		$row->quantity_low."</td><td>Rp. ".number_format($row->retail).",-</td></tr>";
	}
	echo "
			</table>
			</div>
		</div>";
	}
}
