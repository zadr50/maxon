<?php 
if($q=$this->db->get('inventory_categories')){
	foreach($q->result() as $cat) {
		echo "<a href='".base_url()."index.php/eshop/categories/view/$cat->kode'>
			<h4>$cat->category</h4>
			</a>";
		echo "<div class='thumbnail '>
			<img class='' src='".load_picture($cat->item_picture)."' 
				height='100px' width='250px'>
			</div>";
		echo "<i>$cat->description</i>";
	}
} else {
	echo "<strong>Category Not Found !</strong>";
}
?>