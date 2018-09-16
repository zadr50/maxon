	<div class='row'>
		<div class='col-md-11'>
			<h4>Item Product</h4>
			<ul class="list-group">
			<?php
			
			if($cat_item=$this->db->select('item_number,description,item_picture,
				retail')->limit(10)->get("inventory")) 
			{
				foreach($cat_item->result() as $c){
					echo "<li class='list-group-item'><a href='".base_url()."index.php/eshop/item/view/".$c->item_number."'>".$c->description."</a></li>";
				}
			}
			
			?>
			</ul>
		</div>
	</div>
