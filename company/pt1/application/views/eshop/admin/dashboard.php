<script type="text/javascript" src="<?=base_url()?>assets/flot/excanvas.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.categories.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.pie.js"></script>

<div class='row-fluid'>
	<div class="panel panel-info">
	  <div class="panel-heading">
		<h4 class="panel-title">Select Periode To View</h4>
	  </div>
	  <div class="panel-body">
		<div class='col-md-4'>
			<div class="btn-group" role="group" >
				  <button onclick="" type="button" class="btn btn-default">Hari</button>
				  <button onclick="" type="button" class="btn btn-default">Bulan</button>
				  <button onclick="" type="button" class="btn btn-default">Tahun</button>
			</div>
		</div>
		<div class='col-md-8'>
			<form class="form-inline">
			  <div class="form-group">
				<label class="sr-only" for="FromDate">Dari Tanggal</label>
				<input type="text" class="form-control" id="from_date" 
					class='col-md-1' placeholder="Dari Tanggal">
			  </div>
			  <div class="form-group">
				<label class="sr-only" for="ToDate">Sampai</label>
				<input type="text" class="form-control" id="to_date"
					class='col-md-1'  	placeholder="Sampai">
			  </div>			 
			  <button type="submit" class="btn btn-primary">Refresh</button>
			</form>
		
		</div>
	  </div>
	</div>
</div>

<div class='row-fluid'>
	<div class="panel panel-info">
	  <div class="panel-heading">
		<h4 class="panel-title">Ringkasan Kegiatan</h4>
	  </div>
	  <div class="panel-body">
		<div class='col-md-4'>
		<ul class="list-group">
		  <li class="list-group-item">Pengunjung Online  
				<span class="badge"> <?=$user_online_count?></span>
		  </li>
		  <li class="list-group-item">Keranjang Aktif  
				<span class="badge"> 42</span>
		  </li>
		 </ul>
		<h4>Pemberitahuan</h4>
		<ul class="list-group">
		  <li class="list-group-item">Pesan baru</li>
		  <li class="list-group-item">Review Produk</li>
		</ul>
		 
		 </div>
		 <div class='col-md-3'>
		<h4>Dalam Proses</h4>
		<ul class="list-group">
		  <li class="list-group-item">Pembelian</li>
		  <li class="list-group-item">Retur/Pengembalian</li>
		  <li class="list-group-item">Cart yang ditinggalkan</li>
		  <li class="list-group-item">Produk telah habis</li>
		</ul>
		 </div>
		 <div class='col-md-3'>
		<h5>Pelanggan dan Newsletter</h5>
		<ul class="list-group">
		  <li class="list-group-item">Pelanggan Baru</li>
		  <li class="list-group-item">Langganan Baru</li>
		  <li class="list-group-item">Total Pelanggan</li>
		</ul>
		
		 </div>
		
	  </div>
	</div>
</div>

<div class='row-fluid'>
	 
	<div class="panel panel-info ">
	  <div class="panel-heading">
		<h4 class="panel-title">Dashboard</h4>
	  </div>
	  <div class="panel-body">
			<div class='row-fluid'>
				<h4>Grafik Transaksi</h4>
				
				<div role="tabpanel">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#tab1" aria-controls="home" role="tab" 
							data-toggle="tab">
							Penjualan
						</a>
					</li>
					<li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">Pembelian</a></li>
					<li role="presentation"><a href="#tab3" aria-controls="messages" role="tab" data-toggle="tab">Nilai Belanja</a></li>
					</ul>
  
					<div class="tab-content">
					  <div role="tabpanel" class="tab-pane fade in active" id="tab1">
							<div id='divSales' style='width:600px;height:250px;'>
								<h4>Grafik Penjualan</h4>
								
							</div>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab2">
							<div id='divPurchase' style='width:600px;height:250px;'>
								<h4>Grafik Pembelian</h4>
							</div>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab3">
							<div id='divSalesValue' style='width:600px;height:250px;'>
								<h4>Grafik Nilai Belanja</h4>
							</div>
					  
					  </div>
					</div>
				</div>
			</div>
			<div class='row-fluid'>
				<h4>Grafik Visitor</h4>
				<div role='tabpanel'>
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation"  class="active">
							<a href="#tab4" aria-controls="settings" role="tab" 
								data-toggle="tab">
								Kunjungan
							</a>
						</li>
						<li role="presentation"><a href="#tab5" aria-controls="settings" role="tab" data-toggle="tab">Rate Konversi</a></li>
						<li role="presentation"><a href="#tab6" aria-controls="settings" role="tab" data-toggle="tab">Pendapatan Bersih</a></li>
					  </ul>
	  
					<div class="tab-content">
					  <div role="tabpanel" class="tab-pane fade in active" id="tab4">
							<div id='divVisit' style='width:600px;;height:250px;'>
								<h4>Grafik Visitor</h4>
							</div>				  
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab5">...Rate Konversi</div>
					  <div role="tabpanel" class="tab-pane fade" id="tab6">...Pendapatan Bersih</div>
					</div>
				</div>
			</div>
			<div class='row-fluid'>
				<h4>Grafik Perkiraan</h4>
				<div class="btn-group" role="group" >
					  <button onclick="" type="button" class="btn btn-default">Trafik</button>
					  <button onclick="" type="button" class="btn btn-default">Konversi</button>
					  <button onclick="" type="button" class="btn btn-default">Rata-rata keranjang</button>
					  <button onclick="" type="button" class="btn btn-default">Penjualan</button>
				</div>
			
			
			</div>
			<div class='row-fluid'>
				<div class='col-md-9'>
				<h4>Produk Dan Penjualan</h4>
				<div class="btn-group" role="group" >
					  <button onclick="" type="button" class="btn btn-default">Penjualan Terbaru</button>
					  <button onclick="" type="button" class="btn btn-default">Terlaris</button>
					  <button onclick="" type="button" class="btn btn-default">Paling Banyak Dilihat</button>
					  <button onclick="" type="button" class="btn btn-default">Paling Banyak Dicari</button>
				</div>
				</div>
				 <div class='col-md-3'>
				<h4>Trafik</h4>
				<ul class="list-group">
				  <li class="list-group-item">Kunjungan</li>
				  <li class="list-group-item">Pengunjung Unik</li>
				  <li class="list-group-item">Sumber Trafik</li>
				  <ul class='list-group'>
						<li class="list-group-item">Google</li>
						<li class="list-group-item">Direct</li>
					</ul>
				  </ul>
				 </div>
				
			</div>
	  </div>
	</div>
	 
	</div>
</div>
<script type="text/javascript">
	var divSales_options = {
			lines: {
				show: true,
				barWidth: 0.6,
				align: "center"
			},
			points: {
				show: true
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			}
	};	
	var divSales_data = [];
	var divSales_alreadyFetched = {};
	var divSales_dataurl=CI_ROOT+'eshop_admin/dashboard/gfx_sales';
 
	$.ajax({
		url: divSales_dataurl,
		type: "GET",
		dataType: "json",
		success: divSales_onDataReceived
	});
	function divSales_onDataReceived(series) {
		if (!divSales_alreadyFetched[series.label]) {
			divSales_alreadyFetched[series.label] = true;
			divSales_data.push(series);
		}
		console.log(divSales_data);
		$.plot("#divSales", divSales_data, divSales_options);
	}
	
	var divVisit_options = {
			lines: {
				show: true,
				barWidth: 0.6,
				align: "center"
			},
			points: {
				show: true
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			}
	};	
	var divVisit_data = [];
	var divVisit_alreadyFetched = {};
	var divVisit_dataurl=CI_ROOT+'eshop_admin/dashboard/gfx_visit';
 
	$.ajax({
		url: divVisit_dataurl,
		type: "GET",
		dataType: "json",
		success: divVisit_onDataReceived
	});
	function divVisit_onDataReceived(series) {
		if (!divVisit_alreadyFetched[series.label]) {
			divVisit_alreadyFetched[series.label] = true;
			divVisit_data.push(series);
		}
		console.log(divVisit_data);
		$.plot("#divVisit", divVisit_data, divVisit_options);
	}
	var divSalesValue_options = {
			lines: {
				show: true,
				barWidth: 0.6,
				align: "center"
			},
			points: {
				show: true
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			}
	};	
	var divSalesValue_data = [];
	var divSalesValue_alreadyFetched = {};
	var divSalesValue_dataurl=CI_ROOT+'eshop_admin/dashboard/gfx_item_value';
 
	$.ajax({
		url: divSalesValue_dataurl,
		type: "GET",
		dataType: "json",
		success: divSalesValue_onDataReceived
	});
	function divSalesValue_onDataReceived(series) {
		if (!divSalesValue_alreadyFetched[series.label]) {
			divSalesValue_alreadyFetched[series.label] = true;
			divSalesValue_data.push(series);
		}
		console.log(divSalesValue_data);
		$.plot("#divSalesValue", divSalesValue_data, divSalesValue_options);
	}	
	
</script>