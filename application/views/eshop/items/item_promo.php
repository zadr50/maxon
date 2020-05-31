<?php
$items=$this->db->order_by("sales_count desc")->limit(4)->get('inventory');
?>
<div class='div-item' >
	<div class='row'>
		<div class='container-fluid well' style="border: #9E9E9E  solid 1px">
		    <div class='col-md-3'>
		        <legend>PROMO</legend>
		        <p>Section baris ini berisi daftar barang yang sedang promo</p>
		        <img src='<?=base_url()?>images/gazpacho.png'>
		    </div>
			<?php
		    $i=0;
			$new_row=false;
				foreach($items->result() as $item){
					
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
						class='box_item col-sm-2 col-xs-4 col-md-2'>
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
