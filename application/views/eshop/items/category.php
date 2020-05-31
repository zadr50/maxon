<?php
$cat_name='';
if(isset($cat)){
	$cat_name=$cat->category;
	$cat_id=$cat->kode;
	echo "<img  class='thumbnail col-md-12 col-sm-12' height='200px' 
	src='".load_picture($cat->item_picture)."'>
	<h5>$cat->description</h5>";
}
if(!isset($cat_items)){
	$cat_items=$this->db->order_by("sales_count desc")->get('inventory');
}
?>
<style>

</style>
<div class='div-itemx containerv' style="">
	<div class='row'>
		<div class='wellz'>
			<?php
		    $i=0;
			$new_row=false;
				foreach($cat_items->result() as $item){
					
					if($item->active){
						if($item->item_number=='00023'){
							//echo 'ok';
						}
						$i++;
						$s="";
						if(($i%5)==0){
							$s="<div class='row'>";
							$new_row=true;
						}
						$s.="<div style='color:black' onclick='view_item(\"$item->item_number\");return false;' 
						class='box_item  col-md-2 col-sm-4	 col-xs-4'>
						<div class='foto thumbnail'>
							<img  src='".load_picture($item->item_picture)."'>
						</div>
						<div class='content text-center'><i>$item->description</i></div>
						<div class='item-footer'>
							<div class='item_no'>Kode: $item->item_number</div>
							<div class='price'>Rp. ".number_format($item->retail)."</div>
							
						</div>
						</div>";
				        
				        if($new_row){
							$i=0;			        	
				        	$new_row=false;
				        	$s.="</div>";
							
				        }
				        echo $s;
						
					}
				}
			
			?>
			
		</div>
	</div>
</div>
<script language="javascript">
function view_item(id){
	var url="<?=base_url()?>index.php/eshop/item/view/"+id;
	window.open(url,"_self");
}
</script>	
