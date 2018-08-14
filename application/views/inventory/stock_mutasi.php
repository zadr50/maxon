<legend>MUTASI STOCK ANTAR LOKASI</legend>
<div class="thumbnail box-gradient"> 
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Add','','add','false',base_url().'index.php/stock_mutasi/add');		
	echo link_button("Print","print_mutasi()","print");
	echo link_button('Search','','search','false',base_url().'index.php/stock_mutasi');		
		
	?>	
	<div style='float:right'>
	<?=link_button('Help', 'load_help(\'stock_mutasi\')','help');?>		
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('stock_mutasi')">Help</div>
		<div onclick="show_syslog('stock_mutasi','<?=$transfer_id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>	
	</div>
</div> 
<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table class="table2" width="100%">
	<tr>
		<td>Nomor</td><td><?php 
                echo form_input('transfer_id',$transfer_id,'id=transfer_id');
        ?></td>
		<td>Status </td><td><?php 
            echo form_dropdown('status',$status_list,$status,'id=status');
			echo link_button("Update","update_status();return false","save");
        ?></td>
		
		
	</tr>
       <tr>
		<td>Tanggal</td><td><?php  
                echo form_input('date_trans',$date_trans
				,"id='date_trans' class='easyui-datetimebox' required 
				data-options='formatter:format_date,parser:parse_date'");
                
        ?></td>
		<td>Verify By</td>
		<td><?=form_input("verify_by",$verify_by," readonly")?></td>
       </tr>
	<tr>
		<td>Gudang Sumber</td><td><?php 
				$gudang_locked="";
				//if($from_location!="")$gudang_locked="disabled";
                echo form_dropdown('from_location',$warehouse_list,$from_location,'id=from_location '.$gudang_locked);
        ?></td>
		<td>Verify Date</td>
		<td><?=form_input("verify_date",$verify_date," readonly")?></td>
	</tr>
	<tr>
		<td>Gudang Tujuan</td>
		<td><?php 
            echo form_dropdown('to_location',$warehouse_list,$to_location,'id=to_location');
        ?></td>
		<td>Doc Type</td>
		<td><?php 
            echo form_dropdown('doc_type',$doc_type_list,$doc_type,'id=doc_type');
        ?></td>
	</tr>
    <tr>
		<td>Catatan</td>
		<td colspan='3'><?php 
                	echo form_input('comments',$comments,'style="width:400px"');
        ?></td>
     </tr>
	 <tr><td>&nbsp </td><td>&nbsp </td></tr>
   </table>
 
<!-- LINEITEMS -->	
	<div id='dgItem'><?=load_view('inventory/select_item_no_price.php')?></div>
	
	<div id='divItem' style='display:<?=$mode=="add"?"":""?>'>
		<table id="dg" class="easyui-datagrid"  
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true,
				toolbar: '#tb',
				url: url_load_item
			">
			<thead>
				<tr>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'from_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	</div>	
	
</form>



</div>
<!-- LINEITEMS -->

<?php echo load_view('inventory/inventory_select'); ?>
 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/stock_mutasi/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/stock_mutasi/del_item';

    function url_detail(){
	 	var nomor=$('#transfer_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/stock_mutasi/items/'+nomor+'/json');
    }
	function print_mutasi(){
		nomor=$("#transfer_id").val();
		url="<?=base_url()?>index.php/stock_mutasi/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function update_status()
	{
		var status=$("#status").val();
	 	var nomor=$('#transfer_id').val();
		var url='<?=base_url()?>index.php/stock_mutasi/verify/'+nomor+"?status="+status;
		var next_url='<?=base_url()?>index.php/stock_mutasi/view/'+nomor;
		ajax_get(url,null,next_url);
	}
    
 </script>