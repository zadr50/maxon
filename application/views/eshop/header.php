<?
if( !isset($search_items) )$search_items='';
if( !isset($search_category)) $search_category='';
$current_cart=($this->session->userdata('cart')==true)?count($this->session->userdata('cart')):0;
$phone="(0264)2020202";
$workhour="Mon - Fri [10:00 - 19:00] ,  Sat [10:00 - 17:00],  Sun [12:00 - 17:00]";
$email="contact@talagasoft.com";
?>
<style>
</style>
 
<nav class="navbar container " role="navigation" >
    <div class="navbar-header col-md-12">
		<div  class='header-logo' style="float:left" >
		<a class="border-hover" href="<?=base_url()?>index.php/eshop/home">		
			<div class='logo-wrapper logo-maxon' ></h3>				
			</div>
		</a>
		</div>
		<div class='header-nama-toko'>
			<p class="hnt-nama">TOKO ONLINE</>
			<p class='hnt-desc'>Menjual perlengkapan komputer dan kantor</p>
		</div>
	</div> 
	<button type='button' class="btn btn-navbar navbar-toggle glyphicon glyphicon-align-justify" 
		data-toggle="collapse" 	data-target="#nav1"> 
	</button>
	
	<div class="collapse navbar-collapse col-md-12" id='nav1'>	
		<div class="hdr-manu col-md-7">
			<div class='hdr-menu-button col-md-12'>
			<li><a href="<?=base_url()?>index.php/eshop/home">
			<img src="<?=base_url()?>images/call.png"> Home</a></li>
			<li><a href="<?=base_url()?>index.php/eshop/cart">
			<img src="<?=base_url()?>images/cart.gif"> Keranjang</a></li>
			<li><a href="<?=base_url()?>index.php/eshop/cek_resi">
			<img src="<?=base_url()?>images/calendar.png"> Cek Resi</a></li>
			<li><a href="<?=base_url()?>index.php/eshop/cek_ongkos">
			<img src="<?=base_url()?>images/info.png"> Cek Ongkos Kirim</a></li>
			 
			</div>
		</div>
		<div class="hdr-manu col-md-5">
			<div class='hdr-menu-contact col-md-12' >
			<li><strong>Hp: 0831-129-281</strong></li>
			<li><strong>BBM: 3sd81</strong></li>
			<li><strong>WA: 0831-129-281</strong></li>
			</div>
		</div>
		
		<div class='col-md-12'>
		<? 
		$categories=$this->db->get("inventory_categories");
		if(isset($categories)){ ?>
		
			<ul class="nav navbar-nav  "  >
			  <form class="navbar-form " role="search" method='post' 			  
				action='<?=base_url()?>index.php/eshop/item/search'>
			
				
				<div class="form-group">
				  <input value='<?=$search_items?>' name='search_items' type="text" class="form-control"   placeholder="Search">
				</div>
				<div class="form-group">
					<select class='form-control' name="search_category" id="search_category" 
					class="cat-select absolute">
					<option value="">Semua Kategori</option>
					<? foreach($categories->result() as $cat) { ?>
						<option <?=$search_category==$cat->kode?'selected':''?> class="ml-10" value="<?=$cat->kode?>"><?=$cat->category?></option>
					<? } ?>
					</select>
				</div>
				<button type="submit" class="btn btn-default glyphicon glyphicon-search"> Cari</button>


			<a href="<?=base_url()?>index.php/eshop/cart" 
			class="btn btn-default glyphicon glyphicon-shopping-cart"> Troly <span class='badge'><?=$current_cart?></span></a>
			<?
			$is_login=$this->session->userdata('cust_login');
			if($is_login){
			?>
				<a href="<?=base_url()?>index.php/eshop/setting" 
					class="btn btn-default glyphicon glyphicon-user glyphicon "> Account</a>
				<a href="<?=base_url()?>index.php/eshop/login/logout" 
					class="btn btn-warning glyphicon glyphicon-off"> Logout</a>
			<? } else { ?>
				<a href="<?=base_url()?>index.php/eshop/login/start" 
					class="btn btn-default glyphicon glyphicon-off"> Login</a>
			<? } ?>
		   
		   
			  </form> 
			  
			</ul>   
		<? } ?>
		</div>
	</div>    
</nav> 