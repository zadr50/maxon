<div class="thumbnail box-gradient">
	<?php
	echo link_button('Add','','add','false',base_url().'index.php/receive/add');		
	echo link_button('print', 'print_receive()','print');		
	echo link_button('Search','','search','false',base_url().'index.php/receive/browse');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/receive/view/'.$shipment_id);		
	?>
	<div style='float:right'>
	<?php 
	echo link_button('Help', 'load_help(\'receive_etc\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('receive')">Help</div>
		<div onclick="show_syslog('receive','<?=$shipment_id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div> 
<?php 
$default_warehouse=$this->session->userdata("default_warehouse");
$readonly_gudang="";
if( $mode=="view" || $mode=="add" || $mode=="" )
{
	if($warehouse_code=="" || $warehouse_code=="0"){
		if( ! ($default_warehouse=="" || $default_warehouse=="MULTI") ){
			$readonly_gudang="readonly";
		}
		$warehouse_code=$default_warehouse;
	}
	
}
if ( $mode=="view" && $warehouse_code !="" ) $readonly_gudang="readonly";
?>

 
<form id="frmItem" method='post' >
   <table class='table' width='100%'>
	<tr>
		<td>Nomor Bukti</td><td>
		<?php echo form_input('shipment_id',$shipment_id,"id=shipment_id"); ?>
                </td>
		<td>Gudang</td><td><?php 
		if($readonly_gudang==""){
			echo form_dropdown('warehouse_code',$warehouse_list,$warehouse_code,"id='warehouse_code'");
		} else {
			echo form_input("warehouse_code",$warehouse_code,"id='warehouse_code' $readonly_gudang");
		}
		?></td>
				
	</tr>	 
   <tr>
		<td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received ,
		 class="easyui-datetimebox" required 
			data-options="formatter:format_date,parser:parse_date"
			');?>
		</td>
		<td>Pengirim</td><td><?php echo form_input('supplier_number',$supplier_number,'id=supplier_number');?></td>
   </tr>
   <tr>
		<td>Catatan</td><td colspan='4'><?php echo form_input('comments',$comments,'id=comments style="width:400px"');?></td>
   </tr>
   </table>
	<!-- LINEITEMS -->	
	<?=load_view('inventory/select_item_no_price.php')?>   
</form>

<?php echo load_view('inventory/inventory_select'); ?>

<div id="tb_item">
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit"  onclick="editItem()">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove"   onclick="deleteItem()">Delete</a>	
</div> 

<div id='divItem' style='display:<?=$mode=="add"?"":""?>'>
	<table id="dg" class="easyui-datagrid"  width="100%"
		data-options="
			iconCls: 'icon-edit',
			singleSelect: true,
			toolbar: '#tb',fitColumns:true,
			url: url_load_item
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
</div>	
<!-- LINEITEMS -->
</div> 
 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/receive/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/receive/del_item';

    function url_detail(){
	 	var nomor=$('#shipment_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/receive/items/'+nomor+'/json');
    }
	function print_receive(){
		nomor=$("#shipment_id").val();
		url="<?=base_url()?>index.php/receive/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/receive_non_po");
	}
function editItem(){
		var row = $('#'+grid_output).datagrid('getSelected');
		if (row){
			console.log(row);
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.quantity);
			$('#unit').val(row.unit);
			$('#line_number').val(row.line_number);
			 
		}
	}    
 </script>
