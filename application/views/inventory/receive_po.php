<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
		echo link_button('Save', 'simpan()','save');		
		
		echo "<div style='float:right'>";
	
	    echo link_button('Close','remove_tab_parent()','cancel');      
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
   <table class='table2' width="100%">
       <tr>
            <td>Supplier:</td><td><?            
            echo form_input('supplier_number',$supplier_number,'id=supplier_number');
			echo link_button('','dlgsuppliers_show()',"search"); 
            ?></td>
            <td>Tanggal:</td>
            <td><?=form_input('date_received',
                    $date_received,"id='date_received' class='easyui-datetimebox' required
					data-options='formatter:format_date,parser:parse_date'
					style='width:180px'
					");?>
            </td>
			
       </tr>
       <tr>
            <td>Nomor PO:</td>
            <td>
            <?
                echo form_input('purchase_order_number',$purchase_order_number,"id=purchase_order_number");
				echo link_button('','dlgpo_open_show();return false;',"search"); 
				if($purchase_order_number!=""){
    				echo link_button('',"po_items('".$purchase_order_number."')",'reload',"false",'',"*bila item PO tidak tampil tekan tombol reload ini.");
				}
                echo link_button('View',"view_po();return false","edit", "false",'',"Lihat nomor PO");
            ?>
				
            </td>            

            <td>Gudang:</td><td><?php echo form_input('warehouse_code',
                    $warehouse_code,"id='warehouse_code'");?>
               <?=link_button("", "dlgwarehouse_show();return false;","search")?>
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
			singleSelect: true, toolbar: '#tbRcv' 
		" rownumbers="true" pagination="true">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:100">Item</th>
				<th data-options="field:'description',width:200">Description</th>
				<th data-options="field:'qty',width:80">Qty Recv</th>
				<th data-options="field:'quantity',width:80">Qty Order</th>
				<th data-options="field:'qty_recvd',width:50">Recvd</th>
				<th data-options="field:'unit',width:50">Unit</th>
				<th data-options="field:'mu_qty',width:80">M Qty</th>
				<th data-options="field:'multi_unit',width:80">M Unit</th>
				<th data-options="field:'no_urut',width:50">No Urut</th>
				<th data-options="field:'line',width:80">Line</th>
			</tr>
		</thead>
	</table>
   
 </form>
	<div class='alert alert-info' style="font-size:small">
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


<?php
echo $lookup_gudang;
echo $lookup_suppliers;
echo $lookup_po_open;
echo load_view('purchase/select_open_po');
?>

<script type="text/javascript">
	var mode='<?=$mode?>';
	var po_number='<?=$purchase_order_number?>';

	$().ready(function(){
		void po_items(po_number);
	});

    function cancel(){
        
    }
    function simpan(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        if(!valid_qty_recv){log_err("Quantity terima tidak benar !");return false;}
        
        if($('#shipment_id').val()==''){alert('Isi dulu nomor bukti !');return false;}
        if($('#warehouse_code').val()==''){alert('Pilih kode gudang !');return false;}
        
        $('#myform').submit();
    }
    function valid_qty_recv(){
    	
    	return true;
    }

    function proses()
    {
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

        $('#myform').submit();
    }
    function load_po_items(){
    	$po=$("#purchase_order_number").val();
    	if($po!=""){
    		
    	}
    }
	function view_po(){
	    var po=$("#purchase_order_number").val();
	    var url='<?=base_url("index.php/purchase_order/view/")?>';
	    if(po==""){
	        alert("Pilih nomor PO !");
	        return false;
	    }
	    add_tab_parent('view_po_'+po,url+'/'+po);
	}
	function calc_ratio(baris){
		console.log(baris);
		qty=c_($("#qty_"+baris).val());
		ratio=c_($("#ratio_"+baris).val());
		mu_qty=qty*ratio;
		$("#mu_qty_"+baris).val(mu_qty);
		
	}
	function calc_qty_recv(baris){
		qty=c_($("#qty_"+baris).val());
		ratio=c_($("#ratio_"+baris).val());
		qty_sisa=c_($("#qty_sisa_"+baris).val());
		
		console.log("qty sisa: "+qty_sisa+", input: "+qty);
		if(qty>qty_sisa){
			log_err("Qty yang diinput lebih dari sisa !");
			$("#qty_"+baris).val(qty_sisa);
		}
		
	}
	function po_open_selected(){
		var row = $('#dgpo_open').datagrid('getSelected');
		if (row){
			var nomor=row.purchase_order_number;
			$('#purchase_order_number').val(nomor);
			$("#supplier_number").val(row.supplier_number);
			$('#dlgSelectFaktur').dialog('close');
	 		$("#divItem").fadeIn("slow");
			url=CI_ROOT+"purchase_order/items_not_received/"+nomor;
			$('#dgRcv').datagrid({url:url});
			$("#dgRcv").datagrid("reload");
			console.log("po_open_selected");
		} else {
			log_err("Pilih salah satu nomor purchase order !");
		}
	}
	function dlgpo_open_find(){

	}
</script>    


