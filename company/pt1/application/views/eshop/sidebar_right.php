<div class='col-md-2 col-lg-2 col-sm-2' >
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-shopping-cart'></span> Shopping Cart</h3>
				  </div>
				  <div class="panel-body">
						<?php echo load_view('eshop/widget_cart');?>
				  </div>
				</div>				
			
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-pencil'></span> Articles</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/widget_articles');?>
				  </div>
				</div>		
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-pencil'></span> Range Harga</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/range_price');?>
				  </div>
				</div>				
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-pencil'></span> Jenis Harga</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view('eshop/jenis_harga');?>
				  </div>
				</div>				
			</div>