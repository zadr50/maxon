<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Add','','add','false',base_url().'index.php/retur_toko/add');		
	echo link_button('Print', 'print_delivery()','print');		
	echo link_button('Delete','','remove','false',base_url().'index.php/retur_toko/delete/'.$shipment_id);		
	echo link_button('Search','','search','false',base_url().'index.php/retur_toko');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/retur_toko/view/'.$shipment_id);		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'retur_toko\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('delivery')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');?>      
	</div>
	
</div>
<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table width="100%" class="table">
	<tr>
		<td>Nomor Bukti</td><td>
		<?php
		  $id=$shipment_id;
		  echo form_input('shipment_id',$id,"id=shipment_id"); 
		?>
        </td>
		<td>Dari Toko/Lokasi</td><td>
		    <?php 
              $gudang_locked="";
            //    if($warehouse_code!="")$gudang_locked="disabled";
		        
                echo form_dropdown('warehouse_code',
                    $warehouse_list,$warehouse_code,"id='warehouse_code' $gudang_locked");
                
            ?>
        </td>
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received 
                    class="easyui-datetimebox" required 
        			data-options="formatter:format_date,parser:parse_date"');?>
            </td>
        <td>Tujuan Gudang/Toko/Lokasi</td><td>
            <?php 
                echo form_dropdown('supplier_number',
                    $warehouse_list,$supplier_number,"id='supplier_number'");                
            ?>
        </td>
       </tr>
       <tr>
           <td>Faktur Beli</td><td><?php 
                echo form_input("other_doc_number",$other_doc_number,"id='other_doc_number'");
                echo link_button('', 'dlgpurchase_invoice_show()','search');
                
                ?>
           </td>
            <td>Status</td><td><?php 
                echo form_input('doc_status',$doc_status,"id='doc_status' ");
                echo link_button('', 'dlgdoc_status_show()','search');
                echo link_button('Approve','approve();return false','save');     
                
                ?></td>
           
       </tr>
       <tr>
            <td>Keterangan</td><td colspan='4'><?php echo form_input('comments',$comments,'id=comments style="width:400px"');?></td>
       </tr>
   </table>
	
	
	<?=load_view('inventory/select_item_no_price.php')?>
	
	
	<div id="tb_item">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit"  onclick="editItem()">Edit</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove"   onclick="deleteItem()">Delete</a>	
	</div> 
	<div id='divItem' class='box-gradient' style='display:<?=$mode=="add"?"":""?>'>
		<table id="dg" class="easyui-datagrid table"  width="100%"
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
					<th data-options="field:'cost',width:50,align:'left',editor:'text'">Cost</th>
					<th data-options="field:'total_amount',width:50,align:'left',editor:'text'">Total</th>
                    <th data-options="field:'ref1',width:50,align:'left',editor:'text'">Ref#</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	</div>	

</div>
   
</form>


<?php 
    echo load_view('inventory/inventory_select'); 
    echo $lookup_doc_status;
    echo $lookup_faktur;
?>


 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/retur_toko/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/retur_toko/del_item';

    function url_detail(){
	 	var nomor=$('#shipment_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/retur_toko/items/'+nomor+'/json');
    }
	function print_delivery(){
		nomor=$("#shipment_id").val();
		url="<?=base_url()?>index.php/retur_toko/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function delete_delivery()
	{
	            var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}


		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/retur_toko/delete/<?=$shipment_id?>",
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						window.open('<?=base_url()?>index.php/retur_toko','_self');
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}    
	function save() {
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}


        var url="<?=base_url()?>index.php/retur_toko/save";
		var shipment_id=$('#shipment_id').val();
  		if(shipment_id==''){alert('Isi nomor bukti !');return false;}
  		if($('#warehouse_code').val()==''){alert('Isi gudang!');return false;} 
		$('#item_number').val('XXX');
		save_item();		
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
			$("#ref1").val(row.ref1)
			 
		}
	}    
	function approve(){
        var nomor=$('#shipment_id').val();
	    if(nomor=="AUTO"){
	        alert("Nomor bukti belum dipilih !");
	        return false;
	    }
	    var faktur=$("#other_doc_number").val();
	    if(faktur==""){
	        alert("Pilih nomor faktur pembelian yang akan diretur !");return false;
	    }
        $.ajax({
                type: "GET",
                url: "<?=base_url()?>index.php/retur_toko/approve/"+nomor,
                data: {other_doc_number:$('#other_doc_number').val()},
                success: function(result){
                    var result = eval('('+result+')');
                    if(result.success){
                        $.messager.show({
                            title:'Success',msg:result.msg
                        }); 
                        remove_tab_parent();
                    } else {
                        $.messager.show({
                            title:'Error',msg:result.msg
                        });                         
                    };
                },
                error: function(msg){alert(msg);}
        });                 
	    
	}
	
 </script>
	
