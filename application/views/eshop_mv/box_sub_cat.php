<div class='row'>
<div class='col-md-11'>
	<h4>Categories</h4>
	<div class="list-group" >
	<?php 
	if( !isset($cat_id)) $cat_id='';
	$all_cat=$this->db->get("inventory_categories");	
	foreach($all_cat->result() as $c) {
		$cnt=$this->db->where("category",$c->kode)->get("inventory")->num_rows();
		$active=$c->kode==$cat_id?'active':'';
	?>
		<li class="list-group-item <?=$active ?> " >
			<a href="<?=base_url()?>index.php/eshop/categories/view/<?=$c->kode?>">
			<?=$c->category?> <span class='badge' style='float:right'><?=$cnt?></span></a>
			<?php
				if($active != "") {
					if($cat_sub=$this->db->where("parent_id",$c->kode)->get("inventory_categories"))
					{
						if($cat_sub->num_rows()) 
						{
							foreach($cat_sub->result() as $cat_sub_rec)
							{
								$url=base_url()."index.php/eshop/categories/view/".$cat_sub_rec->kode;
								echo "<li class='list-group-item'>";
								echo "<a href='$url'>&nbsp&nbsp&nbsp - $cat_sub_rec->category</a>";
								echo "</li>";
							}
						}
					}
				}
			
			?>
		</li>
	<?php } ?>
	</div>
</div>
</div>
