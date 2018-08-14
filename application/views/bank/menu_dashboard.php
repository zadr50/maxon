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
		<div class='col-lg-8 col-md-12 col-sm-12'>
			<div class="easyui-panel themes" data-options="iconCls:'icon-save',closable:true,
				collapsible:true,minimizable:true,maximizable:true">
				<div class='col-md-8'>
					<img src="<?=base_url()?>images/banks.png" usemap="#mapdata" class="map">
					<map id="mapdata" name="mapdata">
					<area shape="circle" alt="Receive Cash" coords="120,92,29" href="<?=base_url()?>index.php/cash_in"  class="info_link" title="Receive Cash" />
					<area shape="circle" alt="Bank Account" coords="264,94,29" href="<?=base_url()?>index.php/banks/banks"  class="info_link" title="Bank Accounts" />
					<area shape="circle" alt="Payment" coords="412,98,29" href="<?=base_url()?>index.php/cash_out"  class="info_link" title="Kas Keluar" />
					<area shape="circle" alt="Transfer Account" coords="134,251,28" href="<?=base_url()?>index.php/cash_mutasi" class="info_link"  title="Mutasi Antar Rekening" />
					<area shape="circle" alt="Cash Adjustment" coords="406,261,30" href="<?=base_url()?>index.php/cash_adjust" class="info_link"  title="Adjustment" />
					<area shape="circle" alt="Jurnal Umum"" coords="263,358,29" href="<?=base_url()?>index.php/jurnal" class="info_link"  title="Jurnal Umum" />
					<area shape="default" nohref="nohref" alt="" />
					</map>
				</div>
			</div>
		</div>
		
		

        <div class="col-md-4">

        <div id="p" class="easyui-panel" title="Saldo Rekening" 
            data-options="iconCls:'icon-help'" >
            <table id="dgSaldo" class="easyui-datagrid"  
                style="width:100%"
                data-options="title: '',
                        iconCls: 'icon-tip',
                        singleSelect: true,
                        toolbar: '',
                        url: '<?=base_url()?>index.php/banks/banks/daftar_saldo/10'
                ">
                <thead>
                    <tr>
                        <th data-options="field:'bank_account_number',width:60">Rek#</th>
                        <th data-options="field:'bank_name',width:70">Bank</th>
                        <th data-options="field:'amount',width:90,align:'right',editor:'numberbox',
                            formatter: function(value,row,index){
                            return number_format(value,2,'.',',');}">Jumlah</th>
                    </tr>
                </thead>
            </table>                    
            
        </div>
        
        </div>
		<?php if($this->config->item('google_ads_visible')) $this->load->view('google_ads');?>



        
        <div class='col-md-12'>
            <div id="p" class="easyui-panel" title="Reports" 
                data-options="iconCls:'icon-help'" >
                    <?php include("menu_reports.php"); ?>
            </div>
        </div>
        
        <div class='col-md-12'>
            <div id="p" class="easyui-panel" title="Grafik Saldo Rekening" 
                data-options="iconCls:'icon-help'" >
                <div id='divRek'   style="width:100%;height:300px;padding:5px;"></div>
            </div>
            
        </div>



		
	</div>
	
                     
	
</div>



<script  language="javascript">
$().ready(function(){
//	void get_this(CI_ROOT+'banks/grafik_saldo','','divRek');
	$('.map').maphilight({fade: false});
});
	
	
</script>

<script type="text/javascript">

	var data = [];
	var alreadyFetched = {};
	var dataurl=CI_ROOT+'banks/banks/grafik_saldo';
 
	
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
		$.plot("#divRek", data, options);
	}
	
			
</script>