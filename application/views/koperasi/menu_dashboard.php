<script type="text/javascript" src="<?=base_url()?>assets/maphilight-master/jquery.maphilight.min.js"></script>

 <?
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="thumbnail">

 
<div style="margin:10px 0;"></div>
	<div title="Koperasi Dashboard" style="padding:10px">
		<div class="thumbnail">
			<? include "menu.php" ?>
		</div>
		<div class="row">
			<div class="thumbnail col-md-6 " >
				 
			</div>
			
			<div class="thumbnail col-md-6 " >
				 
			</div>
			<div class="thumbnail col-md-6 " >
					 
			</div>
			<div class="thumbnail col-md-6 " >
					 
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
