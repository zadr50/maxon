<?php
if( !isset($search_items) )$search_items='';
if( !isset($search_category)) $search_category='';
$current_cart=($this->session->userdata('cart')==true)?count($this->session->userdata('cart')):0;
$phone="(0264)2020202";
$workhour="Mon - Fri [10:00 - 19:00] ,  Sat [10:00 - 17:00],  Sun [12:00 - 17:00]";
$email="contact@talagasoft.com";
$is_login=$this->session->userdata('cust_login');
?>
<style>
</style>
<nav class="navbar" role="navigation"  >
    <div class='col-md-12' style="height:35px;padding:5px;color:white">
            <div style="float:right">
                <span>Jam Operasional: 08:00~17:00 Contact: 087874006900  </span>
                <span><i class='glyphicon glyphicon-help'></i> Help</span>
            </div>
    </div>
    <div class="navbar-header col-lg-12">
        <div class='col-md-12' >
            <div  class='col-md-3 header-logo' >
                <a class="border-hover" href="<?=base_url()?>index.php/eshop/home">		
                    <div class='logo-wrapper logo-maxon'></div>
                </a>
            </div>
            <div class='col-md-9'  id="nav1" >
                <ul class="nav navbar-nav  nav-right" style="float:right;margin-right:10px" >                    
                    <form class="navbar-form " role="search" method='post'              
                        action='<?=base_url()?>index.php/eshop/item/search'>
                    
                        <div class="form-group">
                            <input value='<?=$search_items?>' name='search_items' type="text" 
                                class="form-control"   placeholder="Cari produk atau toko">
                        </div>
                        <button type="submit" class="btn btn-danger glyphicon glyphicon-search"> </button>
                            &nbsp;<a href="<?=base_url()?>index.php/eshop/cart" 
                                class="glyphicon glyphicon-shopping-cart  btn btn-primary">
                                <span class='badge'> <?=$current_cart?>&nbsp;</span></a>                    
                        <?php if($is_login){ ?>
                            &nbsp;<a href="<?=base_url()?>index.php/eshop/setting" 
                                class="glyphicon glyphicon-user glyphicon  btn btn-info"> Account</a>
                            &nbsp;<a href="<?=base_url()?>index.php/eshop/login/logout" 
                                class="glyphicon glyphicon-off  btn btn-warning"> Logout</a>
                        <?php } else { ?>
                            &nbsp;<a href="<?=base_url()?>index.php/eshop/login/start" 
                                class="btn btn-default glyphicon glyphicon-user  btn btn-warning"> Login</a>
                        <?php } ?>
                    </form> 
                </ul>   
            </div>
        </div>        
        <button type='button' class="btn btn-navbar navbar-toggle glyphicon glyphicon-align-justify" 
	        data-toggle="collapse" 	data-target="#nav1"> 
        </button>
	</div> 
</nav> 		
