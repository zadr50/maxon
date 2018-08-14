<?php 
	$cat_id=$this->session->userdata("current_category");
	$price_range_type=$this->session->userdata('price_range_type');
	$this->db->select_max("retail",'price_max');
	if($cat_id<>"" or $cat_id<>"all"){
		$this->db->where("category",$cat_id);
	}
	$price_max=$this->db->get("inventory")->row()->price_max;
	if($price_max==0)$price_max=1000000;
	$price_max_2=$price_max/4;
	$price_from=0;
	echo "<div class='list-group'>";
	$this->session->set_userdata('price_from',0);
	for($i=0;$i<4;$i++){
		$price_to=$price_max_2*($i+1);
		$var='range_price_'.($i+1);
		$range_price=number_format($price_from)." - ".number_format($price_to);
		$active="";
		if($price_range_type==$i) {
			$active="active";
			$this->session->set_userdata('price_to',$price_to);
		}
		echo "	<li class='list-group-item $active'>
				<a href='".base_url()."index.php/eshop/categories/view_price_range/$i'>$range_price</a>
				</li>";
	}
	echo "</div>";
?>
