<script type="text/javascript" src="<?=base_url()?>assets/flot/excanvas.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.categories.js"></script>
 <?
  $CI =& get_instance();
 ?>
 <script type="text/javascript" src="<?=base_url()?>assets/maphilight-master/jquery.maphilight.min.js"></script>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
    	<div class='col-lg-12 col-md-12 col-sm-12'>
    
    		<div class="easyui-panel themes" data-options="iconCls:'icon-save',closable:true,
    			collapsible:true,minimizable:true,maximizable:true" 
    			title='Main Menu'>
    			<div class='col-md-8'>
    				<img src="<?=base_url()?>images/inventory.png" usemap="#mapdata" class="map">
    				<map id="mapdata" name="mapdata">
    				<area shape="circle" alt="Receive Purchase Order" coords="120,95,30" href="<?=base_url()?>index.php/receive_po"  class="info_link" title="Receive Purchase Order" />
    				<area shape="circle" alt="Inventory" coords="266,95,28" href="<?=base_url()?>index.php/inventory"  class="info_link" title="Inventory" />
    				<area shape="circle" alt="Delivery" coords="411,98,30" href="<?=base_url()?>index.php/delivery"  class="info_link" title="Delivery" />
    				<area shape="circle" alt="Transfer Item Between Warehouse" coords="134,252,29" href="<?=base_url()?>index.php/stock_mutasi" class="info_link"  title="Transfer Item Between Warehouse" />
    				<area shape="circle" alt="Stock Adjustment" coords="265,250,30" href="<?=base_url()?>index.php/stock_adjust" class="info_link"  title="Stock Adjustment" />
    				<area shape="circle" alt="Stock Card" coords="401,247,29" href="<?=base_url()?>index.php/inventory/rpt/cards_summary" class="info_link"  title="Stock Card" />
    				<area shape="circle" alt="Manage Warehouse" coords="117,362,29" href="<?=base_url()?>index.php/shipping_locations"  class="info_link" title="Manage Warehouse" />
    				<area shape="circle" alt="Jurnal Umum" coords="263,357,31" href="<?=base_url()?>index.php/jurnal" class="info_link"  title="Jurnal Umum" />
    				<area shape="default" nohref="nohref" alt="" />
    				</map>
    			</div>
    		</div>
    
    		<?php if($this->config->item('google_ads_visible')) $this->load->view('google_ads');?>
    	
    	</div>
    	
    	<div class='row'>
    	    
            <div class='col-lg-6 col-md-5 col-sm-12'>
                <div id="p" class="easyui-panel themes" title="Top Ten Sales" 
                    data-options="iconCls:'icon-help',closable:true,collapsible:true,
                    minimizable:true,maximizable:true" >
                    <div id='divSales'   style="width:90%;height:200px;padding:5px;"></div>
                </div>
            </div>
        	    
            <div class='col-lg-6 col-md-5 col-sm-12'>
        
                <div id='divFaktur'  style="height:200px;padding:5px;">
                    <table id="dgRetur" class="easyui-datagrid"  
                        style="min-height:300px"
                        data-options="title: 'New Sales Item',
                            iconCls: 'icon-tip',
                            singleSelect: true,
                            toolbar: '',
                            url: '<?=base_url()?>index.php/invoice/new_sales_register'
                        ">
                        <thead>
                            <tr>
                                <th data-options="field:'quantity',width:60">Qty</th>
                                <th data-options="field:'unit',width:70">Unit</th>
                                <th data-options="field:'invoice_number',width:70">Faktur</th>
                                <th data-options="field:'invoice_date',width:100">Tanggal</th>
                                <th data-options="field:'item_number',width:80">Item No</th>
                                <th data-options="field:'description' ,width:300">Description</th>
                            </tr>
                        </thead>
                    </table>                    
                </div>  
            </div>
            

    	    
    	</div>
	   <div class='row'>
	       <div class='col-lg-6'>
	           <?php include_once "menu_reports.php"; ?>
	       </div>
	   </div>
	
	</div>
</div>




<script  language="javascript">
$().ready(function(){
	//void get_this(CI_ROOT+'inventory/grafik_jual','','divSales');
	//void get_this(CI_ROOT+'inventory/grafik_stock_min','','divStockMin');
	//void get_this(CI_ROOT+'inventory/daftar_po_receive','','divPoReceive');
	//void get_this(CI_ROOT+'inventory/daftar_stock_sisa','','divStockSisa');
		$('.map').maphilight({fade: false});
});
	
	
</script>
<script type="text/javascript">

	var data = [];
	var alreadyFetched = {};
	var dataurl=CI_ROOT+'inventory/grafik_jual';
 
	
	var options = {
		bars: {
			show: true,
			barWidth: 0.6,
			align: "center"
		},
		xaxis: {
			mode: "categories",
			tickLength: 0
		}
	};	
	$.ajax({
				url: dataurl,
				type: "GET",
				dataType: "json",
				success: onDataReceived
	});
	function onDataReceived(series) {
		if (!alreadyFetched[series.label]) {
			alreadyFetched[series.label] = true;
			data.push(series);
		}
		$.plot("#divSales", data, options);
	}
	var $element=$(window),lastWidth=$element.width(),lastHeight=$element.height();	
	function checkForChanges(){			
	   if ($element.width()!=lastWidth||$element.height()!=lastHeight){	
		$('#tt').tabs('resize');
		lastWidth = $element.width();lastHeight=$element.height();	 
	   }
	   setTimeout(checkForChanges, 500);
	}
	checkForChanges();
	
			
</script>

