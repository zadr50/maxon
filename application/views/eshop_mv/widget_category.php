<?php
$categories=$this->db->limit(10)->get("inventory_categories");
$i=0;
echo "<div class='list-group'>";
foreach($categories->result() as $cat) {
	$active="";
	if(isset($cat_id)){
		if($cat->kode==$cat_id){
			$active="active";
		}
	}
	if($cat->icon_picture != ''){
		$ico=base_url()."/tmp/".$cat->icon_picture;
		$ico="<img src='".$ico."' width=25 height=25 style='float:left;margin-right:5px;'>";
	} else {
		$ico='';
	}
	$cnt=$this->db->where("category",$cat->kode)->get("inventory")->num_rows();

	echo "
	<li class='list-group-item $active'> $ico <a href='".base_url()
	."index.php/eshop/categories/view/$cat->kode'>"
	.$cat->category."<span class='badge' style='float:right'>".$cnt."</span></a></li>";
	
}
$cnt=$this->db->get('inventory')->num_rows();
echo "<li class='list-group-item'><a href='"
	.base_url()."index.php/eshop/categories/view/all'>ALL 
	<span class='badge' style='float:right'>".$cnt."</span>
	</a></li>";
echo "</div>";

?>