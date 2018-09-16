 <?php
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="thumbnail">

 
<div style="margin:10px 0;"></div>
	<div title="Sales Dashboard" style="padding:10px">
		<div class="thumbnail col-xs-8">
			<img src="<?=base_url()?>images/payroll.png" usemap="#sales" class="map">
			<map id="sales" name="sales">
			<area shape="circle" alt="Pegawai" coords="70,56,31" href="<?=base_url()?>index.php/payroll/employee" class="info_link" title="Pegawai" />
			<area shape="circle" alt="Absensi" coords="172,55,29" href="<?=base_url()?>index.php/payroll/absensi" class="info_link" title="Absensi"  />
			<area shape="circle" alt="Slip Gaji" coords="275,55,30" href="<?=base_url()?>index.php/payroll/salary" class="info_link"  title="Slip Gaji" />
			<area shape="circle" alt="" coords="368,55,29"href="<?=base_url()?>index.php/payroll/overtime" class="info_link"  title="Overtime" />
			<area shape="circle" alt="" coords="471,53,30" href="<?=base_url()?>index.php/payroll/pinjaman" class="info_link"  title="Pinjaman" />
			<area shape="circle" alt="" coords="163,212,31"href="<?=base_url()?>index.php/payroll/generate" class="info_link"  title="Generate Slip Gaji Bulanan" />
			<area shape="circle" alt="" coords="271,212,31" href="<?=base_url()?>index.php/payroll/periode" class="info_link"  title="Seting Periode Penggajian" />
			<area shape="circle" alt="" coords="92,323,30" href="<?=base_url()?>index.php/payroll/pph21" class="info_link"  title="Proses PPH 21" />
			<area shape="circle" alt="" coords="221,322,29" href="<?=base_url()?>index.php/payroll/medical" class="info_link"  title="Pengobatan" />
			<area shape="circle" alt="" coords="354,321,28" href="<?=base_url()?>index.php/payroll/group" class="info_link"  title="Group Level Penggajian" />
			<area shape="circle" alt="" coords="470,317,29" href="<?=base_url()?>index.php/payroll/cuti" class="info_link" title="Data Cuti Karyawan" />
			<area shape="default" nohref="nohref" alt="" />
			</map>
			 
		</div>
		<div class='col-xs-4'>
            <?php echo load_view("payroll/menu_reports"); ?>            
		</div>
		<div class="row">
			<div class="thumbnail col-xs-12 " >
			<?php
				//if (allow_mod('_18000.001'))	
				add_button_menu("Department","company/department","ico_payroll.png",
					"Data master department");
				add_button_menu("Divisi","company/division","ico_payroll.png",
					"Data master divisi");
				add_button_menu("Status Kawin","payroll/ptkp","ico_payroll.png",
					"Data master status perkawinan");
				add_button_menu("Level","payroll/employee/level","ico_payroll.png",
					"Group Level Pegawai");
			?>
			</div>
			
			<div class="thumbnail col-xs-12 " >
				 
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
			for(j=0;j<series.length;j++){
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
