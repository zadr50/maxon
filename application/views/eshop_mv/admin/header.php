<nav class="navbar bg-head-foot bg-banner" role="navigation" >
    <div class="navbar-header">
		<a class="border-hover" href="<?=base_url()?>index.php/eshop_admin/dashboard">		
			<div class='logo-wrapper logo-maxon' style='float:left'></div>
		</a>
		<button type='button' class="btn btn-navbar navbar-toggle glyphicon glyphicon-align-justify" 
			data-toggle="collapse" 	data-target="#nav1"> 
		</button>
	</div> 
	<div class="collapse navbar-collapse" id='nav1'>	  
		<? if(isset($categories)){ ?>
      <ul class="nav navbar-nav navbar-left">
		  <form class="navbar-form " role="search">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search">
			</div>
			<div class="form-group">
				<select class='form-control' name="sc" id="cat-select" 
				class="cat-select absolute">
				<option value="0">Semua Kategori</option>
				<?php foreach($categories->result() as $cat) { ?>
				<option class="ml-10" value="<?=$cat->kode?>"><?=$cat->category?></option>
				<?php } ?>
				</select>
			</div>
			<button type="submit" class="btn btn-default glyphicon glyphicon-search"> Cari</button>
		  </form>
		</ul>
		<?php } ?>
		  <div class="nav navbar-nav navbar-right">	
			<?php
			$is_login=$this->session->userdata('cust_login');
			if($is_login){
			?>
				<a href="<?=base_url()?>index.php/eshop/login/logout" 
					class="btn btn-warning glyphicon glyphicon-off"> Logout</a>
			<?php } else { ?>
				<a href="<?=base_url()?>index.php/eshop/login" 
					class="btn btn-default glyphicon glyphicon-off"> Login</a>
			<?php } ?>
			<a href="<?=base_url()?>index.php/eshop/help" 
				class="btn btn-default glyphicon glyphicon-search"> Bantuan</a>
			
		  </div>
		</div>    
 
</nav>

<?php
	function menu($title,$url,$func=false){
		if(!$func){
			echo "<div><a href='".base_url()."index.php/".$url."' class='easyui-linkbutton' data-options='plain:true'>".$title."</a></div>";	
		} else {
			echo "<div><a href='#' onclick=\"load_menu('$url')\"  class='easyui-linkbutton' data-options='plain:true'>".$title."</a></div>";
		}
	}
	function add_menu_drop($menu_id,$caption,$mod_id) {
		if(allow_mod($mod_id)){
			echo "<li><a onclick=load_menu('$menu_id') href='#'>$caption</a></li>";
		}
	}
	function add_menu_drop_2($menu_id,$caption,$mod_id) {
		if(allow_mod($mod_id)){
			echo "<li><a href='".base_url()."index.php/$menu_id'
			class='info_link' >$caption</a></li>";
		}
	}
?> 
<script>
	$(document).ready(function(){
		//$("#divMenu").show();
/* 			$('ul.nav li.dropdown').hover(function() {
			  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
			}, function() {
			  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
			}); */
		
	});
	 function load_menu_cat(cat){
	     xurl='<?=base_url()?>index.php/eshop/categories/view/'+cat;
	     window.open(xurl,'_self');
	     return false;
	 }
</script>
