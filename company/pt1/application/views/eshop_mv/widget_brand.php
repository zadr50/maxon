<?php
$brand_list=$this->db->query("select distinct manufacturer 
	from inventory where manufacturer<>''");
$i=0;
echo "<div class='list-group'>";
foreach($brand_list->result() as $brand) {
	$cnt=$this->db->where('manufacturer',$brand->manufacturer)->get('inventory')->num_rows();
	echo "		<li class='list-group-item'> <a href='".base_url()
		."index.php/eshop/categories/brand/$brand->manufacturer'>"
		.$brand->manufacturer."<span class='badge' style='float:right'>"
		.$cnt."</span></a></li>";
}
echo "</div>";

?>