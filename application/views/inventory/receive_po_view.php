 <div class="thumbnail box-gradient">
	<?php
	$min_date=$this->session->userdata("min_date","");
	
	echo link_button('Print', 'print_receive()','print');		
	echo link_button('Delete','delete_receive2()','remove','false');	
    echo link_button('Save', 'simpan()','save');        
    
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/receive_po/view/'.$shipment_id);		
    if($mode=="view") echo link_button('Verify', 'doc_status_verify()','save');       
    
	echo "<div style='float:right'>";
	echo link_button('Help', "load_help('receipt_po')",'help');		
    echo link_button('Close','remove_tab_parent()','cancel');      
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('receipt_po')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">	
    <form id='myform' method='post' action='<?=base_url()?>index.php/receive_po/save'>
    
   <table class='table2' width="100%">
       <tr>
           <td>Receipt No:</td><td><strong><?=$shipment_id?></strong>
               <?=form_hidden("shipment_id",$shipment_id)?>                        
           </td>
           <td>Nomor PO:</td><td><strong><a href="#" onclick="view_po('<?=$purchase_order_number?>');return false;"><?=$purchase_order_number?></a></strong></td>
           <td>Receipt By:</td><td><?=$receipt_by?></td>
       </tr>
       <tr>
            <td>Tanggal:</td>
            <td><?=form_input('date_received',
                    $date_received,'id=date_received class="easyui-datetimebox" required
                    data-options="formatter:format_date,parser:parse_date"
                    ');?>
            </td>
            <td>Gudang:</td><td><?php echo form_dropdown('warehouse_code',
                    $warehouse_list,$warehouse_code,'id=warehouse_code');?>
            </td>
           <td>Surat Jalan#:</td>
           <td><?=form_input('ref1',$ref1,'id=ref1');?></td>
			
       </tr>
       <tr>
            <td>Supplier:</td><td colspan='3'><?=$supplier_info?></td>            
			<td>Doc Status</td><td><?=$doc_status?></td>
       </tr>
       <tr>
            <td>Keterangan</td>
            <td colspan=4><?=form_input('comments',$comments,'id=comments style="width:300px"');?>
            </td>
			
       </tr>
       <tr>
            <td>Selected by Invoice? <?=$selected?></td>       	
       </tr>

   </table>
   
   </form>
   
	<table id="dgItems" class="easyui-datagrid table"  
		data-options="
			toolbar: '#toolbar-search-faktur',
			singleSelect: true,fitColumns: true,
			url: '<?=base_url()?>index.php/receive_po/receive_items/<?=$shipment_id?>'
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Item</th>
				<th data-options="field:'description',width:180">Description</th>
				<th data-options="field:'quantity_received',width:80">Qty</th>
				<th data-options="field:'unit',width:50">Unit</th>
				<th data-options="field:'cost',width:50">Cost</th>
				<th data-options="field:'total_amount',width:50">Total</th>
				<th data-options="field:'mu_qty',width:80">M Qty</th>
				<th data-options="field:'multi_unit',width:50">M Unit</th>
				<th data-options="field:'mu_price',width:50">M Price</th>
                <th data-options="field:'manufacturer',width:80">Merk</th>				
				<th data-options="field:'id',width:50">Id</th>
			</tr>
		</thead>
	</table>
</div>		
<script language='javascript'>

    function simpan(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#shipment_id').val()==''){alert('Isi dulu nomor bukti !');return false;}
        if($('#warehouse_code').val()==''){alert('Pilih kode gudang !');return false;}
        
        $('#myform').submit();
    }


	function view_po(nomor){
		var url="<?=base_url()?>index.php/purchase_order/view/<?=$purchase_order_number?>";
		add_tab_parent("view_po_<?=$purchase_order_number?>",url);
	}
	function print_receive(){
		url="<?=base_url()?>index.php/receive_po/print_bukti/<?=$shipment_id?>";
		window.open(url,'_blank');
	}
	function delete_receive2()
	{

        $.messager.confirm('Confirm','Are you sure you want to remove this ?',
        function(r){
            if(!r)return false;
        });
        var nomor="<?=$shipment_id?>";
		$.ajax({
				type: "GET",
				url: CI_ROOT+"receive_po/delete_by_shipment/"+nomor,
				data: "",
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
	function doc_status_verify(){
            $.ajax({
                    type: "GET",
                    url: "<?=base_url()?>/index.php/receive_po/status/<?=$shipment_id?>/VERIFIED",
                    data: "",
                    success: function(result){
                        var result = eval('('+result+')');
                        if(result.success){
                            $.messager.show({
                                title:'Success',msg:result.msg
                            }); 
                            window.open("<?=base_url('receive_po/view/'.$shipment_id)?>","_self");
                        } else {
                            $.messager.show({
                                title:'Error',msg:result.msg
                            });                         
                        };
                        log_msg(result.msg);
                    },
                    error: function(msg){alert(msg);}
            });                 
	    
	}
		
</script>		
