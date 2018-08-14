<div class='col-md-3 col-sm-3 col-lg-3 visible-lg' >
				<?php 
					$cust_id=$this->session->userdata("cust_id");
					if($cust_id<>"") { 
				?>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h3 class="panel-title"><span class='glyphicon glyphicon-circle-arrow-right'></span> Dashboard</h3>
					  </div>
					  <div class="panel-body">
						<?php echo $menu ?>
					  </div>
					</div>				
				<?php } 	?>
				<?php if($category_menus!="") { ?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon glyphicon-circle-arrow-right'></span> Category</h3>
				  </div>
				  <div class="panel-body">
					<?php echo load_view($category_menus) ?>
				  </div>
				</div>				
				<?php } ?>
				<?php if($widget_brand!="") { ?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon  glyphicon-circle-arrow-right'></span> Brand</h3>
				  </div>
				  <div class="panel-body">
					<?php echo $widget_brand; ?>

				  </div>
				</div>				
				<?php } ?>
				<?php if($google_ads!='') { ?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class='glyphicon  glyphicon-circle-arrow-right'></span> Google</h3>
				  </div>
				  <div class="panel-body">
					<?php $google_ads ?>
				  </div>
				</div>				
				<?php } ?>
				  
			</div>
			