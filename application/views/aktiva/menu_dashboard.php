 <?php
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>
	<div title="DASHBOARD" style="padding:10px">
	
		<div class='col-xs-12'>
			<div class='thumbnail'>
			<img src="<?=base_url()?>images/aktiva.png" usemap="#mapdata" class="map">
			<map id="mapdata" name="mapdata">
				<area shape="circle" alt="Aktiva Tetap" coords="120,92,29" href="<?=base_url()?>index.php/aktiva/aktiva"  
						class="info_link" title="Aktiva Tetap" />
				<area shape="circle" alt="Kelompok" coords="412,98,29" href="<?=base_url()?>index.php/aktiva/aktiva_group"  class="info_link" title="Kelompok" />
				<area shape="circle" alt="Proses Bulanan" coords="264,94,29" href="<?=base_url()?>index.php/aktiva/aktiva_proses"  class="info_link" title="Proses Bulanan" />
				<area shape="circle" alt="Penjualan Aktiva" coords="134,251,28" href="<?=base_url()?>index.php/aktiva/aktiva_sale" class="info_link"  title="Penjualan Aktiva" />
				<area shape="circle" alt="Pembelian" coords="406,261,30" href="<?=base_url()?>index.php/aktiva/aktiva_purchase" class="info_link"  title="Pembelian Aktiva" />
				<area shape="circle" alt="Jurnal Umum" coords="263,300,29" href="<?=base_url()?>index.php/jurnal" class="info_link"  title="Jurnal Umum" />
				<area shape="default" nohref="nohref" alt="" />
			</map>
			</div>
		</div>
		
		
		<div class="easyui-panel themes" title="Reports" 
			data-options="iconCls:'icon-save',closable:true,
			collapsible:true,minimizable:true,maximizable:true">

			<?php include_once "menu_reports.php" ?>

		</div>

	<?php if($this->config->item('google_ads_visible')) $this->load->view('google_ads');?>
	

		<div id="p" class="easyui-panel" title="Daftar Aktiva" 
			data-options="iconCls:'icon-help'" >
			<div id='divRekx'   style="width:100%;height:100px;padding:5px;"></div>
			<table id="dgSaldo" class="easyui-datagrid"  
				style="width:100%"
				data-options="title: '',
						iconCls: 'icon-tip',
						singleSelect: true,
						toolbar: '',
						url: '<?=base_url()?>index.php/aktiva/aktiva/daftar_saldo'
				">
				<thead>
					<tr>
						<th data-options="field:'description',width:60">Asset</th>
						<th data-options="field:'useful_lives',width:50">Lives</th>
						<th data-options="field:'amount',width:90,align:'right',editor:'numberbox',
							formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Jumlah</th>
					</tr>
				</thead>
			</table>					
			
		</div>	
		
	</div>
</div>

 <script type="text/javascript" src="<?=base_url()?>assets/maphilight-master/jquery.maphilight.min.js"></script>


<script  language="javascript">
$().ready(function(){
	//void get_this(CI_ROOT+'banks/grafik_saldo','','divRek');
	//void get_this(CI_ROOT+'banks/daftar_giro_gantung','','divGiro');
	$('.map').maphilight({fade: false});
});
	
	
</script>

