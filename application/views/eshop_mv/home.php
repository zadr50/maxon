	<div class='col-md-12'>
		<?php 
		$rst=$this->db->where("section_name","section-content")->get("articles");
		foreach($rst->result() as $article)
		{
			echo "<div class='$article->class_name'>";
			echo $article->content;
			echo "</div>";
		}
		?>
	</div>	
	<div class='col-md-12'>
		<?php $this->load->view("slider"); ?>
	</div>
	<div class='col-md-12'>
	<?php
		if($q=$this->db->select("item_number,description,category,
			item_picture,retail")->limit(12)->order_by("sales_count desc")
			->get("inventory")){
			foreach($q->result() as $item){
				echo "<div onclick='view_item(\"$item->item_number\");return false;' 
				class='box_item col-md-3 col-sm-3 col-lg-3 thumbnail' align='center'>";
	?>
				<div class='foto'>
					<img  src='<?=base_url()."tmp/".$item->item_picture?>'>
				</div>
				<div class='content'><?=$item->description?></div>
				<div class='item-footer'>
					<div class='item_no'><?=$item->item_number?></div>
					<div class='price'>Rp. <?=number_format($item->retail)?></div>
				</div>
	<?php
				echo "</div>";
			}
		}
	?>
	</div>
 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
<script language="javascript">
function view_item(id){
	var url="<?=base_url()?>index.php/eshop/item/view/"+id;
	window.open(url,"_self");
}
</script>
