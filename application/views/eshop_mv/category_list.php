<?php 
if($q=$this->db->get('inventory_categories')){
	echo "<table class='table'>";
	foreach($q->result() as $cat) {
		echo "<tr><td></td><td><a href='".base_url()."index.php/eshop/categories/view/$cat->kode'>
			<h4>$cat->category</a></h4></td>
		<td>$cat->parent_id</td></tr>";
		echo "<tr><td colspan='4'>
			<img style='height:100px' src='".base_url()."tmp/$cat->item_picture'>
			</td></tr>";
		echo "<tr><td colspan='4'>$cat->description</td></tr>";
	}
	echo "</table>";
}
?>