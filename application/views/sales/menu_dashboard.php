<script type="text/javascript" src="<?=base_url()?>assets/maphilight-master/jquery.maphilight.min.js"></script>
<?php
	  $CI =& get_instance();
?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<div title="DASHBOARD">
		<div class="col-lg-12 col-md-12">
		<div title="Sales Dashboard" style="padding:1px"  class="easyui-panel themes" title="Saldo Hutang Supplier" 
					data-options="iconCls:'icon-help',closable:true,
					collapsible:true,minimizable:true,maximizable:true">
					
				<img src="<?=base_url()?>images/sales.png" usemap="#sales" class="map">
				<map id="sales" name="sales">
				<area shape="circle" alt="Customer" coords="70,56,31" href="<?=base_url()?>index.php/customer" class="info_link" title="Customer" />
				<area shape="circle" alt="" coords="172,55,29" href="<?=base_url()?>index.php/sales_order" class="info_link" title="Sales Order"  />
				<area shape="circle" alt="" coords="275,55,30" href="<?=base_url()?>index.php/delivery_order" class="info_link"  title="Delivery" />
				<area shape="circle" alt="" coords="368,55,29"href="<?=base_url()?>index.php/invoice" class="info_link"  title="Invoice" />
				<area shape="circle" alt="" coords="471,53,30" href="<?=base_url()?>index.php/payment" class="info_link"  title="Payment" />
				<area shape="circle" alt="" coords="163,212,31"href="<?=base_url()?>index.php/sales_retur" class="info_link"  title="Retur" />
				<area shape="circle" alt="" coords="271,212,31" href="<?=base_url()?>index.php/sales_crmemo" class="info_link"  title="Credit Memo" />
				<area shape="circle" alt="" coords="92,323,30" href="<?=base_url()?>index.php/inventory" class="info_link"  title="Inventory" />
				<area shape="circle" alt="" coords="221,322,29" href="<?=base_url()?>index.php/shipping_locations" class="info_link"  title="Warehouse" />
				<area shape="circle" alt="" coords="354,321,28" href="<?=base_url()?>index.php/salesman" class="info_link"  title="Salesman" />
				<area shape="circle" alt="" coords="470,317,29" href="<?=base_url()?>index.php/jurnal" class="info_link" title="General Ledger" />
				<area shape="default" nohref="nohref" alt="" />
				</map>
				
		</div>		 
        <div title="Daftar Laporan" style="padding:5px"  class="easyui-panel themes" 
            data-options="iconCls:'icon-help',closable:true,
            collapsible:true,minimizable:true,maximizable:true">          
            <?php include_once "menu_reports.php" ?>
        </div>                  
	
		<?php if($this->config->item('google_ads_visible')) $this->load->view('google_ads');?>
		
		<div title="Saldo" style="padding:10px"  class="easyui-panel themes" title="Saldo Hutang Supplier" 
			data-options="iconCls:'icon-help',closable:true,
			collapsible:true,minimizable:true,maximizable:true">
			<div id="p" class="" title="Total Penjualan"  
				data-options="iconCls:'icon-help'" >
				<div id='divSales'  style="float:left;width:500px;height:200px;padding:5px;">
					<img src="<?=base_url()?>images/loading.gif">
				</div>
			</div>			
		</div>
		<div title="Sales Dashboard" style="padding:10px"  
			class="easyui-panel themes" title="Saldo Hutang Supplier" 
			data-options="iconCls:'icon-help',closable:true,
			collapsible:true,minimizable:true,maximizable:true">				
			<div id="p" class="" title="Saldo Piutang Pelanggan"  
				data-options="iconCls:'icon-help'" > 
				
				<div id='divCustomer' name='divCustomer' 
					style="float:left;height:200px;padding:5px;width:100%">
					 <img src="<?=base_url()?>images/loading.gif">		
				</div>
				
	
					
			</div>
	   </div>
	    <table id="dgOutlet" class="easyui-datagrid"  
		            style="min-height:300px:width:100%"
		            data-options="title: 'Sales By Outlet',
		                iconCls: 'icon-tip',
		                singleSelect: true,
		                toolbar: '',
		                url: '<?=base_url()?>index.php/invoice/omzet_outlet'
		            ">
		            <thead>
		                <tr>
		                    <th data-options="field:'kode',width:180">Outlet</th>
		                    <th data-options="field:'jumlah',width:80,align:'right',editor:'numberbox',
		                        formatter: function(value,row,index){
		                            return number_format(value,2,'.',',');}">Jumlah</th>
		                </tr>
		            </thead>
		    </table>        
			<table id="dgRetur" class="easyui-datagrid"  
					style="min-height:300px"
					data-options="title: 'Faktur Jatuh Tempo',
						iconCls: 'icon-tip',
						singleSelect: true,
						toolbar: '',
						url: '<?=base_url()?>index.php/invoice/daftar_saldo_faktur'
					">
					<thead>
						<tr>
							<th data-options="field:'invoice_number',width:60">Faktur</th>
							<th data-options="field:'invoice_date',width:70">Tanggal</th>
							<th data-options="field:'due_date',width:70">Jth Tempo</th>
							<th data-options="field:'company',width:80">Pelanggan</th>
							<th data-options="field:'amount',width:80,align:'right',editor:'numberbox',
								formatter: function(value,row,index){
									return number_format(value,2,'.',',');}">Jumlah</th>
						</tr>
					</thead>
				</table>					
	
		</div>
	</div>
</div>
<script  language="javascript">
$().ready(function(){
	$("#tt").tabs("select","DASHBOARD");
	$('.map').maphilight({fade: false});
	
		//void get_this(CI_ROOT+'customer/grafik_saldo','','divCustomer');
		//void get_this(CI_ROOT+'invoice/grafik_penjualam','','divSales');
		 
		//void get_this(CI_ROOT+'customer/daftar_umur','','divUmur');
		//void get_this(CI_ROOT+'invoice/daftar_umur_faktur','','divUmurFaktur');
		//void get_this(CI_ROOT+'purchase_invoice/daftar_kartu_gl','','divGL');
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
			for(j=0;j<series.length;j++){
				data[i]={label:series[j][0], data:series[j][1]};
				i++;
			}
		}
		 

		$.plot($('#divCustomer'), data, {
			 
				series: {
					pie: { show: true}
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
