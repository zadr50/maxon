<nav class="navbar-maxon navbar" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle  glyphicon glyphicon-align-justify" 
	  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle </span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand glyphicon glyphicon-home border-hover" 
	  href="<?=base_url()?>index.php/"> MaxOn</a>
    </div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav border-hover" >
        <li class="dropdown">
			<a href="<?=base_url()?>index.php/login/simple" class="glyphicon glyphicon-calendar"> Demo</a>
		</li>
	  </ul>
      <ul class="nav navbar-nav border-hover" >
        <li class="dropdown">
			<a href="<?=base_url()?>index.php/articles/view_category/news" class="glyphicon glyphicon-calendar"> Blog</a>
		</li>
	  </ul>
      <ul class="nav navbar-nav border-hover" >
        <li class="dropdown">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-calendar" data-toggle="dropdown"> Fitur <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="<?=base_url()?>index.php/articles/view_category/sales_features"  >Penjualan</a></li>
		        <li><a  href="<?=base_url()?>index.php/articles/view_category/purchase_features"  >Pembelian</a></li>
		        <li><a  href="<?=base_url()?>index.php/articles/view_category/inventory_features" >Inventory</a></li>
	            <li class="divider"></li>
		        <li><a  href="<?=base_url()?>index.php/articles/view_category/cashbank_features" >Kas-Bank</a></li>
		        <li><a  href="<?=base_url()?>index.php/articles/view_category/accounting_features" >Akuntansi</a></li>
	            <li class="divider"></li>
		        <li><a  href="<?=base_url()?>index.php/articles/view_category/fixedasset_features" >Aktiva Tetap</a></li>
		        <li><a  href="<?=base_url()?>index.php/articles/view_category/manufacture_features" >Manufacture</a></li>
		        <li><a  href="<?=base_url()?>index.php/articles/view_category/payroll_features" >Payroll</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav  border-hover">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-cog" data-toggle="dropdown"> Dokumentasi <b class="caret"></b></a>
          <ul class="dropdown-menu">
				<li><a href="<?=base_url()?>index.php/articles/view_category/user_doc" class="info_link glyphicon glyphicon-user" > User Dokumentasi</a></li>
				<li><a href="<?=base_url()?>index.php/articles/view_category/support_doc"  class="info_link glyphicon glyphicon-heart" > Support Dokumentasi</a></li>
				<li><a href="<?=base_url()?>index.php/articles/view_category/dev_doc"  class="info_link glyphicon glyphicon-qrcode" > Developer Dokumentasi</a></li>
				<li><a href="<?=base_url()?>index.php/articles/view_category/etc_doc" class="info_link glyphicon glyphicon-book" > Lain-lain</a></li>
          </ul>
        </li>
      </ul>


      <ul class="nav navbar-nav  border-hover">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-folder-open" data-toggle="dropdown"> Downloads  <b class="caret"></b></a>
          <ul class="dropdown-menu">
				<li><a href="<?=base_url()?>index.php/articles/view_category/download_latest"  class="info_link glyphicon glyphicon-shopping-cart"> Latest Version</a></li>
				<li><a href="<?=base_url()?>index.php/articles/view_category/download_history" class="info_link glyphicon glyphicon-gift"> Hisotrical Version</a></li>
				<li><a href="<?=base_url()?>index.php/articles/view_category/download_books" class="info_link glyphicon glyphicon-leaf"> Buku Panduan</a></li>
          </ul>
        </li>
      </ul>
      
      <form class="navbar-form navbar-right " role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-info">Search</button>
      </form>
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown  border-hover">
          <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown">
		   <?=$this->access->username?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
			<li><a href="<?=base_url()?>index.php/help/doc_help" class="info_link glyphicon glyphicon-question-sign"> Bantuan</a></li>
			<li><a href="<?=base_url()?>index.php/help/error" class="info_link glyphicon glyphicon-random"> Laporkan Masalah</a></li>
            <li class="divider"></li>
			<li><a href="<?=base_url()?>index.php/login/simple"  class="info_link  glyphicon glyphicon-user" > User Login</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 