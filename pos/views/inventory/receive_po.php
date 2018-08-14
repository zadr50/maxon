<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'simpan()','save');		
	echo "<div style='float:right'>";
	echo link_button('Help', "load_help('receive_po')",'help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('receive_po')">Help</div>
		<div onclick="show_syslog('receive_po','<?=$shipment_id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>

<div class="thumbnail">	
<form id='myform' method='post' action='<?=base_url()?>index.php/receive_po/proses'>
   <table class='table' width="100%">
       <tr>
            <td>Supplier:</td><td><?            
            echo form_input('supplier_number',$supplier_number,'id=supplier_number');
			echo link_button('','dlgsuppliers_show()',"search","true"); 
            ?></td>
            <td>Tanggal:</td>
            <td><?=form_input('date_received',
                    $date_received,'id=date_received class="easyui-datetimebox" required
					data-options="formatter:format_date,parser:parse_date"
					');?>
            </td>
			
       </tr>
       <tr>
            <td>Nomor PO:</td>
            <td>
            <?
                echo form_input('purchase_order_number',$purchase_order_number,
                "id=purchase_order_number");
				echo link_button('','select_po()',"search","true"); 
				if($purchase_order_number!=""){
				echo link_button('',"po_items('".$purchase_order_number."')",'reload');
				echo "<i>*bila item PO tidak tampil tekan tombol reload ini.</i>";
				}
            ?>
				
            </td>            

            <td>Gudang:</td><td><?php echo form_dropdown('warehouse_code',
                    $warehouse_list,$warehouse_code,'id=warehouse_code');?>
            </td>
			
       </tr>
       <tr>
           <td>No SuratJalan#:</td>
           <td><?=form_input('ref1',$ref1,'id=ref1');?></td>
            <td>Nomor Bukti:</td><td><?php    
            echo form_input('shipment_id',"AUTO",'id=shipment_id');
            echo "<br><i>$shipment_id</i>";
            ?></td>
           
       </tr>
       <tr>
            <td>Keterangan</td>
            <td colspan=4><?=form_input('comments',$comments,'id=comments style="width:300px"');?>
            </td>
       </tr>
       <tr>
           <td>Receipt By:</td>
           <td><?=form_input('receipt_by',$receipt_by,'id=receipt_by');?></td>
       </tr>
   </table>

	<table id="dgRcv" class="easyui-datagrid table"  data-options="
			iconCls: 'icon-edit',fitColumns: true,
			singleSelect: true, toolbar: '#tbRcv',
			url: ''
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:100">Item</th>
				<th data-options="field:'description',width:200">Description</th>
				<th data-options="field:'quantity',width:80">Qty Order</th>
				<th data-options="field:'unit',width:50">Unit</th>
				<th data-options="field:'qty_recvd',width:50">Recvd</th>
				<th data-options="field:'qty',width:80">Qty Recv</th>
				<th data-options="field:'line',width:50">Line</th>
			</tr>
		</thead>
	</table>
   
 </form>
	<div class='alert alert-info'>
		<p>Silahkan ubah atau isi di kolom <strong>qty recvd</strong> yang akan terisi secara otomatis 
		dengan saldo quantity yang belum diterima dari nomor PO ini.</p>
		<p>Apabila anda memasukan qty recvd melebihi barang yang dipesan maka akan dipakai quantity yang 
		dipesan.</p>
		<p>Apabila dibaris item tidak ada data barang, silahkan tekan tombol <strong>Reload</strong> 
		disebelah field nomor PO untuk diload dari quantity sisa nomor po tersebut.</p>
		<p>Yang ditampilkan di baris item hanyalah item-item barang yang belum sepenuhnya diterima, 
		dan yang sudah diterima tidak ditampilkan.</p>
	</div>
</div>


<?
echo $lookup_suppliers;
echo load_view('purchase/select_open_po');
?>

<script type="text/javascript">
	var mode='<?=$mode?>';
	var po_number='<?=$purchase_order_number?>';
    function cancel(){
        
    }
    function simpan(){
        if($('#shipment_id').val()==''){alert('Isi dulu nomor bukti !');return false;}
        $('#myform').submit();
    }

    function proses()
    {
        $('#myform').submit();
    }
    function load_po_items(){
    	$po=$("#purchase_order_number").val();
    	if($po!=""){
    		
    	}
    }
	$().ready(function(){
		void po_items(po_number);
	});
</script>    


