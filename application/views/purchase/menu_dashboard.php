<?php  $CI =& get_instance(); ?>
<div class="easyui-tabs" id="tt"  >	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<div title="DASHBOARD" style="padding:10px">
		<div class='col-md-12'>
			<div class="easyui-panel themes" data-options="iconCls:'icon-save',closable:true,
					collapsible:true,minimizable:true,maximizable:true">
				<div class='col-md-8 thumbnail'>
					<img src="<?=base_url()?>images/purchase.png" usemap="#mapdata" class="map">
					<map id="mapdata" name="mapdata">
					<area shape="circle" alt="Supplier" coords="70,56,31" href="<?=base_url()?>index.php/supplier" class="info_link" title="Supplier" />
					<area shape="circle" alt="" coords="172,55,29" href="<?=base_url()?>index.php/purchase_order" class="info_link" title="Purchase Order"  />
					<area shape="circle" alt="" coords="275,55,30" href="<?=base_url()?>index.php/receive_po" class="info_link"  title="Receive Item PO" />
					<area shape="circle" alt="" coords="368,55,29"href="<?=base_url()?>index.php/purchase_invoice" class="info_link"  title="Invoice" />
					<area shape="circle" alt="" coords="471,53,30" href="<?=base_url()?>index.php/payables_payments" class="info_link"  title="Payment" />
					<area shape="circle" alt="" coords="163,212,31"href="<?=base_url()?>index.php/purchase_retur" class="info_link"  title="Retur" />
					<area shape="circle" alt="" coords="271,212,31" href="<?=base_url()?>index.php/purchase_dbmemo" class="info_link"  title="Debit Memo" />
					<area shape="circle" alt="" coords="92,323,30" href="<?=base_url()?>index.php/inventory" class="info_link"  title="Inventory" />
					<area shape="circle" alt="" coords="221,322,29" href="<?=base_url()?>index.php/shipping_locations" class="info_link"  title="Warehouse" />
					<area shape="circle" alt="" coords="470,317,29" href="<?=base_url()?>index.php/jurnal" class="info_link" title="General Ledger" />
					<area shape="circle" alt="Purchase Request" coords="70,212,30" href="<?=base_url()?>index.php/purchase_request" class="info_link" title="Purchase Request" />
					<area shape="circle" alt="Project" coords="338,320,30" href="<?=base_url()?>index.php/project/project" class="info_link"  title="Proyek" />
					<area shape="default" nohref="nohref" alt="" />
					</map>
				</div>
				
            <div class="col-md-3  " style="margin-left:5px">
                <div id='divGrafikSupplier' style="height:420px;width:250px">
                     <img src="<?=base_url('images/loading.gif')?>">      
                </div>              
            </div>
				
			</div>
		</div>	 
		
		<div class='col-xs-12'>
			<div class="easyui-panel themes" title="Reports" 
				data-options="iconCls:'icon-save',closable:true,
				collapsible:true,minimizable:true,maximizable:true">
				<?php include_once "menu_reports.php" ?>
			</div>
		</div>

		<div class="col-xs-5">
			<div id="p" class="easyui-panel themes" title="Faktur Jatuh Tempo" 
				data-options="iconCls:'icon-help',closable:true,
				collapsible:true,minimizable:true,maximizable:true">
				<table id="dgRetur" class="easyui-datagrid"  
					style="width:100%;height:300px"
					data-options="title: '',
							iconCls: 'icon-tip',
							singleSelect: true,
							toolbar: '',
							url: '<?=base_url()?>index.php/purchase_invoice/daftar_saldo_faktur'
					">
					<thead>
						<tr>
							<th data-options="field:'purchase_order_number',width:60">Faktur</th>
							<th data-options="field:'po_date',width:70">Tanggal</th>
							<th data-options="field:'due_date',width:70">Jth Tempo</th>
							<th data-options="field:'supplier_name',width:80">Supplier</th>
							<th data-options="field:'amount',width:80,align:'right',editor:'numberbox',
								formatter: function(value,row,index){
								return number_format(value,2,'.',',');}">Jumlah</th>
						</tr>
					</thead>
				</table>					
			</div>
			
		</div>
		<div class="col-xs-7">
			<div id="divExpPo" class="easyui-panel themes" title="PO Expire" 
				data-options="iconCls:'icon-help',closable:true,
				collapsible:true,minimizable:true,maximizable:true">
				<table id="dgPoExpire" class="easyui-datagrid"  
					style="width:100%;height:300px"
					data-options="title: '',
							iconCls: 'icon-tip',
							singleSelect: true,
							toolbar: '',
							url: '<?=base_url()?>index.php/purchase_order/po_expire'
					">
					<thead>
						<tr>
							<th data-options="field:'purchase_order_number',width:60">Nomor PO</th>
							<th data-options="field:'po_date',width:70">Tanggal</th>
							<th data-options="field:'due_date',width:70">Tgl Expire</th>
							<th data-options="field:'supplier_name',width:80">Supplier</th>
							<th data-options="field:'amount',width:80,align:'right',editor:'numberbox',
								formatter: function(value,row,index){
								return number_format(value,2,'.',',');}">Jumlah</th>
						</tr>
					</thead>
				</table>					
			</div>
		</div>
		
		<div class="col-md-12">
			<div id="p" class="easyui-panel themes" title="Saldo Hutang Supplier" 
				data-options="iconCls:'icon-help',closable:true,
				collapsible:true,minimizable:false,maximizable:false">
				<div id='divSupplier'  style="width:90%;height:350px;padding:5px;"></div>
			</div>                        
			<div id="p" class="easyui-panel themes" title="Pembelian"> 
				<div id='divPurchase'  style="width:90%;height:350px;padding:5px;"></div>
				<!--
				<div id='divFaktur'  style="width:600px;height:300px;padding:5px;"></div>
				<div id='divUmurHutangSupp'  style="width:600px;height:300px;padding:5px;"></div>
				<div id='divUmurHutangDetail'  style="width:600px;height:300px;padding:5px;"></div>
				<div id='divGL'  style="width:200px;height:600px;padding:5px;"></div>
				-->			
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=base_url()?>assets/maphilight-master/jquery.maphilight.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/excanvas.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.categories.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.pie.js"></script>

<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>


<script  language="javascript">
$().ready(function(){
    $('.map').maphilight({fade: false});
    void get_this(CI_ROOT+'purchase_invoice/daftar_saldo_faktur','','divFaktur');
    //void get_this(CI_ROOT+'supplier/daftar_umur_hutang','','divUmurHutangSupp');
    //void get_this(CI_ROOT+'purchase_invoice/daftar_umur_hutang_detail','','divUmurHutangDetail');
    //void get_this(CI_ROOT+'purchase_invoice/daftar_kartu_gl','','divGL');
});
	
	
</script>

<script type="text/javascript">
    var data = [];
    var alreadyFetched = {};
    var dataurl=CI_ROOT+'po/grafik/grafik_saldo_hutang';
    var options = {
            bars: { show: true, barWidth: 0.6,  align: "center"
        },
            xaxis: {  mode: "categories", tickLength: 0
        }
    };	
    $.ajax({ url: dataurl, type: "GET", dataType: "json", 
        success: onDataReceived
    });
    function onDataReceived(series){
        if (!alreadyFetched[series.label]) {
            alreadyFetched[series.label] = true;
            data.push(series);
        }
        $.plot("#divSupplier", data,options);
    }

    var dataurl2=CI_ROOT+'po/grafik/grafik_pembelian';
    var data2 = [];
    var alreadyFetched2 = {};
    var options2 = {
            lines: { show: true, fill: false,  align: "center"
        },
            xaxis: {  mode: "categories", tickLength: 0
        }
    };	
    $.ajax({
        url: dataurl2, type: "GET", dataType: "json",
        success: onDataReceivedLine
    });
    function onDataReceivedLine(series) {
        if (!alreadyFetched2[series.label]) {
            alreadyFetched2[series.label] = true;
            data2.push(series);
        }
        $.plot("#divPurchase", data2,options2);
    }
    
    var data_grafik_supplier=[];
    var alreadyFetched_supplier = {};
    var idx_supplier=0;
    
        $.ajax({
            url: CI_ROOT+'po/grafik/grafik_saldo_hutang',type: "GET",dataType: "json",
            success: onDataReceived_supplier          
        });
        function onDataReceived_supplier(series) {
            if (!alreadyFetched_supplier[series.label]) {
                alreadyFetched_supplier[series.label] = true;
                for(j=0;j<series.data.length;j++){
                    data_grafik_supplier[idx_supplier]={
                        label:series.data[j][0], 
                        data:series.data[j][1]
                    };
                    idx_supplier++;
                }
            }
            $.plot($('#divGrafikSupplier'), data_grafik_supplier, {
                series: {
                    pie: { show: true},
                    show: true
                },
                legend: {
                    show: false
                }
            });
       }  
        
    
</script>

