<nav class="navbar-maxon navbar box-gradient">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle  glyphicon glyphicon-align-justify" 
		data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle </span>
      </button>
      <a class="navbar-brand glyphicon glyphicon-home border-hover" 
	  href="<?=base_url()?>index.php/"> MaxOn</a>
    </div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<?php if(!isset($hide_menu_header))$hide_menu_header=false;
		  if(!$hide_menu_header) {
	?>
      <ul class="nav navbar-nav border-hover" >
        <li class="dropdown">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-calendar" data-toggle="dropdown"> Transaksi <b class="caret"></b></a>
			  <ul class="dropdown-menu">
		        <?php if(allow_mod("_30000")) { ?>
					<li><a onclick="load_menu('sales')" href="#" >Penjualan</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_40000")) { ?>
					<li><a onclick="load_menu('purchase')"  href="#" >Pembelian</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_80000")) { ?>
					<li><a onclick="load_menu('inventory')"  href="#">Inventory</a></li>
	            <?php } ?>
				<li class="divider"></li>
		        <?php if(allow_mod("_60000")) { ?>
					<li><a onclick="load_menu('bank')" href="#">Kas-Bank</a></li>
				<?php } ?>
		        <?php if(allow_mod("_10000")) { ?>
					<li><a onclick="load_menu('gl')" href="#">Akuntansi</a></li>
				<?php } ?>
				<li class="divider"></li>
		        <?php if(allow_mod("_14000")) { ?>
					<li><a onclick="load_menu('aktiva')" href="#">Aktiva Tetap</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_12000")) { ?>
					<li><a onclick="load_menu('payroll')" href="#">Payroll</a></li>
				<?php } ?>
				<li><a href="http://tokodemo.maxonerp.com" target="_blank">Toko Online</a></li>
					
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav  border-hover">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-cog" data-toggle="dropdown"> Master <b class="caret"></b></a>
          <ul class="dropdown-menu">
		        <?php if(allow_mod("_30010")) { ?>
					<li><a href="<?=base_url()?>index.php/customer" class="info_link glyphicon glyphicon-user" > Pelanggan</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_40010")) { ?>
					<li><a href="<?=base_url()?>index.php/supplier"  class="info_link glyphicon glyphicon-heart" > Supplier</a></li>
						        <?php } ?>
		        <?php if(allow_mod("_80010")) { ?>
					<li><a href="<?=base_url()?>index.php/inventory"  class="info_link glyphicon glyphicon-qrcode" > Barang/Jasa</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_60000")) { ?>
					<li><a href="<?=base_url()?>index.php/banks" class="info_link glyphicon glyphicon-book" > Rekening</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_10010")) { ?>
					<li><a href="<?=base_url()?>index.php/coa" class="info_link glyphicon glyphicon-tasks" > Perkiraan</a></li>
		        <?php } ?>
          </ul>
        </li>
      </ul>


      <ul class="nav navbar-nav  border-hover">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-folder-open" data-toggle="dropdown"> Laporan  <b class="caret"></b></a>
          <ul class="dropdown-menu">
		        <?php if(allow_mod("_30000")) { ?>
				<li><a href="<?=base_url()?>index.php/sales/reports"  class="info_link glyphicon glyphicon-shopping-cart"> Penjualan</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_40000")) { ?>
				<li><a href="<?=base_url()?>index.php/purchase/reports" class="info_link glyphicon glyphicon-gift"> Pembelian</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_80000")) { ?>
				<li><a href="<?=base_url()?>index.php/inventory/reports" class="info_link glyphicon glyphicon-leaf"> Inventory</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_60000")) { ?>
				<li><a href="<?=base_url()?>index.php/banks/reports" class="info_link glyphicon glyphicon-book"> Kas-Bank</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_14000")) { ?>
				<li><a href="<?=base_url()?>index.php/aktiva/reports" class="info_link glyphicon glyphicon-qrcode"> Aktiva Tetap</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_10000")) { ?>
				<li><a href="<?=base_url()?>index.php/gl/reports" class="info_link glyphicon glyphicon-th-list"> Akuntansi</a></li>
		        <?php } ?>
		        <?php if(allow_mod("_12000")) { ?>
				<li><a href="<?=base_url()?>index.php/payroll/reports" class="info_link glyphicon glyphicon-user"> Payroll</a></li>
		        <?php } ?>

          </ul>
        </li>
      </ul>
	  
	  <?php } ?>
      
      <ul class="nav navbar-nav navbar-right" style='padding-right:20px'>
        <li class="dropdown  border-hover">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown">
		   <?=$this->access->username?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
			<li><a href="<?=base_url()?>index.php/maxon_inbox/list_msg" class="info_link glyphicon glyphicon-list-alt"> Message Inbox</a></li>
			<li><a href="<?=base_url()?>index.php/user/log_activity" class="info_link glyphicon glyphicon-list-alt"> Log Aktifitas</a></li>
			<li><a href="<?=base_url()?>index.php/user/preference" class="info_link glyphicon glyphicon-wrench"> Pengaturan</a></li>
            <li class="divider"></li>
			<li><a href="<?=base_url()?>index.php/login/logout" class="glyphicon glyphicon-log-in"> Logout</a></li>
            <li class="divider"></li>
			<li><a href="<?=base_url()?>index.php/company"  class="info_link  glyphicon glyphicon-home" > Perusahaan</a></li>
			<li><a href="<?=base_url()?>index.php/user"  class="info_link  glyphicon glyphicon-user" > User Login</a></li>
			<li><a href="<?=base_url()?>index.php/jobs"  class="info_link  glyphicon glyphicon-headphones"> User Jobs</a></li>
			<li><a  onclick="load_menu('admin')" href="#"  class="info_link  glyphicon glyphicon-certificate"> Administration</a></li>
          </ul>
        </li>
		
        <li class="dropdown  border-hover">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-flag" data-toggle="dropdown">
		   Help<b class="caret"></b></a>
          <ul class="dropdown-menu">
			<li><a href="<?=base_url()?>index.php/help/doc_help" class="info_link glyphicon glyphicon-question-sign"> Bantuan</a></li>
			<li><a href="<?=base_url()?>index.php/help/error" class="info_link glyphicon glyphicon-random"> Laporkan Masalah</a></li>
          </ul>
        </li>
      
		
      <form class="navbar-form navbar-right " role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-info">Search</button>
      </form>
		
		
      </ul>
	  
	  
    </div><!-- /.navbar-collapse -->
</nav>
<?
if(!function_exists("menu")){
	function menu($title,$url,$func=false){
		if(!$func){
			echo "<div><a href='".base_url()."index.php/".$url."' class='easyui-linkbutton' data-options='plain:true'>".$title."</a></div>";	
		} else {
			echo "<div><a href='#' onclick=\"load_menu('$url')\"  class='easyui-linkbutton' data-options='plain:true'>".$title."</a></div>";
		}
	}
}
if(!function_exists("add_menu_drop")){
	function add_menu_drop($menu_id,$caption,$mod_id) {
		if(allow_mod($mod_id)){
			echo "<li><a onclick=load_menu('$menu_id') href='#'>$caption</a></li>";
		}
	}
}
if(!function_exists("add_menu_drop_2")){
	function add_menu_drop_2($menu_id,$caption,$mod_id) {
		if(allow_mod($mod_id)){
			echo "<li><a href='".base_url()."index.php/$menu_id'
			class='info_link' >$caption</a></li>";
		}
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
	 function load_menu(path){
	     xurl='<?=base_url()?>index.php/menu/load/'+path;
	     window.open(xurl,'_self');
	     return false;
	 }
</script>
