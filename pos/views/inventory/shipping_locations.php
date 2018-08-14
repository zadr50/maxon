<div class="thumbnail box-gradient">
	<?
	echo link_button('Add','','add','false',base_url().'index.php/shipping_locations/add');		
	echo link_button('Save', 'simpan()','save');		
	echo link_button('Search','','search','false',base_url().'index.php/shipping_locations');		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'shipping_locations\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('shipping_locations')">Help</div>
		<div onclick="show_syslog('shipping_locations','<?=$location_number?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">	
	<div class="easyui-tabs" >
		<div title="Gudang" style="padding:10px">
	   <?php echo validation_errors(); ?>
	   <?php 
			if($mode=='view'){
				echo form_open('shipping_locations/update','id=myform');
				$disabled='disable';
			} else {
				$disabled='';
				echo form_open('shipping_locations/add','id=myform'); 
			}
			
	   ?>
	 
	   <table class="table" width="100%">
		<tr>
			<td>Gudang</td><td>
			<?php
			if($mode=='view'){
				echo form_input('location_number',$location_number,"id=location_number readonly");
			} else { 
				echo form_input('location_number',$location_number,"id=location_number");
			}		
			?></td>
		</tr>	 
		   <tr>
				<td>Jenis Gudang</td><td><?php echo form_input('address_type',$address_type);?></td>
		   </tr>
		   <tr>
				<td>Alamat</td><td><?php echo form_input('street',$street,"style='width:400px'");?></td>
		   </tr>
		   <tr>
				<td>Kota</td><td><?php echo form_input('city',$city);?></td>
		   </tr>
		   <tr>
				<td>Kontak Person</td><td><?php echo form_input('attention_name',$attention_name);?></td>
		   </tr>
		   <tr>
				<td>Nomor Urut</td><td><?php echo form_input('no_urut',$no_urut);?></td>
		   </tr>
		 
	   </table>
	   </div>
   		<div title="Stock" style="padding:10px">
			<table id="dgCard" class="easyui-datagrid" fitWidth='true'
				data-options="
					iconCls: 'icon-edit', fitColumns: true, 
					singleSelect: true,  url: '',toolbar:'#tbCard',
				">
				<thead>
					<tr>
						<th data-options="field:'item_number',width:80">Kode Barang</th>
						<th data-options="field:'description',width:180">Nama Barang</th>
						<th data-options="field:'qty_saldo',width:80,align:'right'">Qty</th>
						<th data-options="field:'unit',width:80">Unit</th>
						<th data-options="field:'amount_saldo',width:80,align:'right'">Amount</th>
						<th data-options="field:'category',width:180">Category</th>
						<th data-options="field:'supplier_number',width:180">Supplier</th>
						<th data-options="field:'supplier_name',width:180">Supplier Name</th>
					</tr>
				</thead>
			</table>
		
		</div>

	</div>
	
 </div>
<div id='tbCard'>
	<table class='box-gradient'>
	<tr>
	<td>Date To &nbsp &nbsp</td>
	<td><?=form_input('date_to',date("Y-m-d"),'id=date_to  class="easyui-datetimebox" ');?></td>
	<td><?=link_button('Search','search_cards()','search');?></td>
	</tr>
	</table>
</div>

 <script language="JavaScript">
 	function simpan(){
 		if($("#location_number")=="")alert("Isi kode gudang !");
 		$("#myform").submit();
 	}
	function search_cards()
	{
		var d2=$("#date_to").datebox('getValue');
		var gdg=$("#location_number").val();
		var xurl='<?=base_url()?>index.php/inventory/kartu_stock_gudang/'+gdg+'?d2='+d2;
		$('#dgCard').datagrid({url:xurl});
		$('#dgCard').datagrid('reload');
	}
	
 </script>
 