<div class='row'><h1>Brand</h1></div>
<?php
$brand_list=$this->db->query("select distinct manufacturer 
	from inventory where manufacturer<>''");
$i=0;
foreach($brand_list->result() as $brand) {
	$cnt=$this->db->where('manufacturer',$brand->manufacturer)->get('inventory')->num_rows();
	echo "<a href='".base_url()
		."index.php/eshop/categories/brand/$brand->manufacturer'>"
		.$brand->manufacturer."&nbsp<span class='badge'>"
		.$cnt."</span>&nbsp</a>";
}
?>