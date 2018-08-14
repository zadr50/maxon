<div class='col-md-12 alert'>
	<div class='col-md-3'>
		<a href='<?=base_url()?>'>
		<img src="<?=base_url()?>images/logo_maxon.png" height='50px'>
		</a>
	</div>
	<div class='col-md-8'>
		<form class="navbar-form navbar-right" role="search" style='float:right'>
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-info">Search</button>
				&nbsp <a href="#" class="glyphicon glyphicon-flag"> Help</a>
				&nbsp <a href="#" class="glyphicon glyphicon-user"> <?=$this->access->username?></a>	  
		</form>
	</div>
</div>
<div class='col-md-3'>
	<div style="padding:10px"  class="easyui-panel themes" 
		title="Top 5 Sales Customer" 
		data-options="iconCls:'icon-help',closable:true,
		collapsible:true,maximizable:true">
		<div id='divCustomer' name='divCustomer' 
			style="float:left;height:200px;padding:5px;width:100%">
			 <img src="<?=base_url()?>images/loading.gif">		
		</div>
		<div id='divCustomerDetail'>
			<table id="dgCd" class="easyui-datagrid"  
				style="height:400px:width:90%"
				data-options="iconCls: 'icon-tip',
					singleSelect: true,
					toolbar: '',
					url: '<?=base_url()?>index.php/invoice/sales_by_customer'
				">
				<thead>
					<tr>
						<th data-options="field:'company',width:120">Customer</th>
						<th data-options="field:'jumlah',width:80,align:'right',editor:'numberbox',
							formatter: function(value,row,index){
								return number_format(value,2,'.',',');}">Amount</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>					
	<table id="dgOmzetSales" class="easyui-datagrid"  
		style="min-height:300px:width:100%"
		data-options="title: 'Sales by Person',
			iconCls: 'icon-tip',
			singleSelect: true,
			toolbar: '',
			url: '<?=base_url()?>index.php/invoice/omzet_salesman'
		">
		<thead>
			<tr>
				<th data-options="field:'salesman',width:120">Salesman</th>
				<th data-options="field:'jumlah',width:80,align:'right',editor:'numberbox',
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');}">Jumlah</th>
			</tr>
		</thead>
	</table>
	

</div>
<div class='col-md-6'>
	<div title="Sales Performance" style="padding:10px"  class="easyui-panel themes" 
		data-options="iconCls:'icon-help',closable:true,
		collapsible:true,maximizable:true">
		<div id="p" class="" title="Total Penjualan"  
			data-options="iconCls:'icon-help'" >
			<div id='divSales'  style="float:left;width:100%;height:400px;padding:5px;">
				<img src="<?=base_url()?>images/loading.gif">
			</div>
		</div>			
	</div> 	 
</div>
<div class='col-md-3'>
	<table id="dgOmzetSales" class="easyui-datagrid"  
		style="min-height:300px:width:100%"
		data-options="title: 'Sales by Category',
			iconCls: 'icon-tip',
			singleSelect: true,
			toolbar: '',
			url: '<?=base_url()?>index.php/invoice/sales_by_category'
		">
		<thead>
			<tr>
				<th data-options="field:'category',width:120">Category</th>
				<th data-options="field:'jumlah',width:80,align:'right',editor:'numberbox',
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');}">Jumlah</th>
			</tr>
		</thead>
	</table>
	<table id="dgOmzetSales" class="easyui-datagrid"  
		style="min-height:300px:width:100%"
		data-options="title: 'Sales by Item',
			iconCls: 'icon-tip',
			singleSelect: true,
			toolbar: '',
			url: '<?=base_url()?>index.php/invoice/sales_by_item'
		">
		<thead>
			<tr>
				<th data-options="field:'description',width:120">Item Name</th>
				<th data-options="field:'jumlah',width:80,align:'right',editor:'numberbox',
					formatter: function(value,row,index){
						return number_format(value,2,'.',',');}">Jumlah</th>
			</tr>
		</thead>
	</table>
	
</div>
<div class='col-md-6'>
	<div title="Purchase By Supplier" style="padding:10px"  class="easyui-panel themes" 
		data-options="iconCls:'icon-help',closable:true,
		collapsible:true,maximizable:true">
		<div id='divSupplier'  style="width:100%;height:300px;padding:5px;">
				<img src="<?=base_url()?>images/loading.gif">		
		</div>
	</div>
</div>
<div class='col-md-6'>
	<div title="Daily Purchase" style="padding:10px"  class="easyui-panel themes" 
		data-options="iconCls:'icon-help',closable:true,
		collapsible:true,maximizable:true">
		<div id='divPurchase'  style="width:100%;height:300px;padding:5px;">
				<img src="<?=base_url()?>images/loading.gif">		
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
			
			

  var datapur = [];
    var alreadyFetchedpur = {};
    var dataurlpur=CI_ROOT+'po/grafik/grafik_saldo_hutang';
    var optionspur = {
            bars: { show: true, barWidth: 0.6,  align: "center"
        },
            xaxis: {  mode: "categories", tickLength: 0
        }
    };	
    $.ajax({ url: dataurlpur, type: "GET", dataType: "json", 
        success: onDataReceivedPur
    });
    function onDataReceivedPur(series){
        if (!alreadyFetchedpur[series.label]) {
            alreadyFetchedpur[series.label] = true;
            datapur.push(series);
        }
        $.plot("#divSupplier", datapur,optionspur);
    }

    var dataurl2pur=CI_ROOT+'po/grafik/grafik_pembelian';
    var data2pur = [];
    var alreadyFetched2pur = {};
    var options2pur = {
            lines: { show: true, fill: false,  align: "center"
        },
            xaxis: {  mode: "categories", tickLength: 0
        }
    };	
    $.ajax({
        url: dataurl2pur, type: "GET", dataType: "json",
        success: onDataReceivedLine
    });
    function onDataReceivedLine(series) {
        if (!alreadyFetched2pur[series.label]) {
            alreadyFetched2pur[series.label] = true;
            data2pur.push(series);
        }
        $.plot("#divPurchase", data2pur,options2pur);
    }
	
</script>

	