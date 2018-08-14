<legend>PENERIMAAN BARANG PRODUKSI</legend>
<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Add','','add','false',base_url().'index.php/manuf/receive_prod/add');		
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_receive()','print');		
	echo link_button('Search','','search','false',base_url().'index.php/manuf/receive_prod');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/manuf/receive_prod/view/'.$shipment_id);		
	echo "<div style='float:right'>";
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('prod_receive')">Help</div>
		<div onclick="show_syslog('prod_receive','<?=$shipment_id?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table class='table2' width='100%'>
	<tr>
		<td>Nomor Bukti</td><td>
		<?php echo form_input('shipment_id',$shipment_id,"id=shipment_id"); ?>
                </td>
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received ,
             class="easyui-datetimebox" required 
			data-options="formatter:format_date,parser:parse_date"
			');?>
            </td>
       </tr>
	<tr>
		<td>Gudang</td><td><?php 
                echo form_dropdown('warehouse_code',
                    $warehouse_list,$warehouse_code,"id='warehouse_code' style='height:30px'");
                ?></td>
	</tr>
       <tr>
            <td>WO Number</td><td><?php echo form_input('purchase_order_number',$purchase_order_number,'id=purchase_order_number');?>
				<?=link_button('','lookup_work_order()','search');?>			
			
			</td>
       </tr>
       <tr>
            <td>Catatan</td><td><?php echo form_input('comments',$comments,'id=comments style="width:400px"');?></td>
       </tr>
       <tr><td></td><td></td></tr>
       <tr>
           <td colspan="4">
           </td>
       </tr>
	 <tr><td> 
	 </td><td> 
        </td></tr>
   </table>
<!-- LINEITEMS -->	
	<div id='dgItem'>
		<?=load_view('manuf/select_wo_items.php')?>
	</div>
</form>

<div id='divItem' style='display:<?=$mode=="add"?"":""?>'>
	<table id="dg" class="easyui-datagrid"  width='100%'
		data-options="
			iconCls: 'icon-edit', fitColumns: true, 
			singleSelect: true,
			toolbar: '#tb',
			url: url_load_item
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'quantity_received',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
				<th data-options="field:'cost',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Cost</th>
				<th data-options="field:'total_amount',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Total</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
</div>	
<!-- LINEITEMS -->
</div>
 
<? 
	echo load_view("manuf/wo_select.php");
?>



 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/manuf/receive_prod/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/manuf/receive_prod/del_item';

    function url_detail(){
	 	var nomor=$('#shipment_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/manuf/receive_prod/items/'+nomor+'/json');
    }
	function print_receive(){
		nomor=$("#shipment_id").val();
		url="<?=base_url()?>index.php/manuf/receive_prod/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function save_this(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
		 
	}
	    
 </script>
