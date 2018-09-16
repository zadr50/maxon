 <?php
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<div title="DASHBOARD" style="padding:10px">
	
		<div class="thumbnail">

 
<div style="margin:10px 0;"></div>
	<div title="Sales Dashboard" style="padding:10px">
		<div class='col-xs-12'>
		<div class="thumbnail">
			<img src="<?=base_url()?>images/manuf.png" usemap="#sales" class="map">
			<map id="sales" name="sales">
			<area shape="circle" alt="" coords="70,56,31" href="<?=base_url()?>index.php/manuf/workorder" class="info_link" title="Workorder" />
			<area shape="circle" alt="" coords="172,55,29" href="<?=base_url()?>index.php/manuf/work_exec" class="info_link" title="Workorder Execution"  />
			<area shape="circle" alt="" coords="275,55,30" href="<?=base_url()?>index.php/manuf/mat_release" class="info_link"  title="Material Release" />
			<area shape="circle" alt="" coords="368,55,29"href="<?=base_url()?>index.php/manuf/reports" class="info_link"  title="Reports" />
			<area shape="circle" alt="" coords="471,53,30" href="<?=base_url()?>index.php/manuf/dept_prod" class="info_link"  title="Department Produksi" />
			<area shape="circle" alt="" coords="163,212,31"href="<?=base_url()?>index.php/manuf/receive_prod" class="info_link"  title="Penerimaan Hasil Produksi" />
			<area shape="circle" alt="" coords="271,212,31" href="<?=base_url()?>index.php/manuf/cancel_prod" class="info_link"  title="Pembatalan produksi" />
			<area shape="circle" alt="" coords="92,323,30" href="<?=base_url()?>index.php/manuf/product" class="info_link"  title="Data Barang Jadi / Produksi" />
			<area shape="circle" alt="" coords="221,322,29" href="<?=base_url()?>index.php/shipping_locations" class="info_link"  title="Gudang" />
			<area shape="circle" alt="" coords="354,321,28" href="<?=base_url()?>index.php/manuf/product_person" class="info_link"  title="Personal dan tenaga kerja"/>
			<area shape="circle" alt="" coords="470,317,29" href="<?=base_url()?>index.php/manuf/material" class="info_link" title="Material dan bahan baku" />
			<area shape="default" nohref="nohref" alt="" />
			</map>
			 
		</div>

		
		
		</div>
		<div class='col-xs-12'>
			<?php include_once "reports.php" ?>
		
		</div>
	<?php if($this->config->item('google_ads_visible')) $this->load->view('google_ads');?>
	
		
		<div class="row">
			<div class="thumbnail col-xs-6 " >
				 
			</div>
			
			<div class="thumbnail col-xs-6 " >
				 
			</div>
			<div class="thumbnail col-xs-6 " >
					 
			</div>
			<div class="thumbnail col-xs-6 " >
					 
			</div>

		</div>
	</div>
</div>


	</div>
</div>


<script  language="javascript">

$().ready(function(){

		$('.map').maphilight({fade: false});
	 
	});
</script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/excanvas.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.categories.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.pie.js"></script>


<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>


<script type="text/javascript">

	var alreadyFetched = {};
	var dataurl=CI_ROOT+'customer/grafik_saldo3';
	var data = [], series = Math.floor(Math.random() * 6) + 3;
	var i=0;
	 
	$.ajax({
				url: dataurl,
				type: "GET",
				dataType: "json",
				success: onDataReceived
	});
	function onDataReceived(series) {
		if (!alreadyFetched[series.label]) {
			alreadyFetched[series.label] = true;
			for(j=0;j<5;j++){
				data[i]={label:series[j][0], data:series[j][1]};
				i++;
			}
		}
		 

		$.plot('#divCustomer', data, {
				series: {
					pie: { 
						show: true			
				}
				},
				legend: {
					show: false
				}
			});
	}
	


	var options2 = {
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
	var data2 = [];
	var alreadyFetched2 = {};
	var dataurl2=CI_ROOT+'invoice/grafik_penjualan';
 
	$.ajax({
				url: dataurl2,
				type: "GET",
				dataType: "json",
				success: onDataReceived2
	});
	

	function onDataReceived2(series) {
		if (!alreadyFetched2[series.label]) {
			alreadyFetched2[series.label] = true;
			data2.push(series);
		}
		$.plot("#divSales", data2, options2);
	}
			
			
			
	</script>
