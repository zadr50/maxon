<div class="thumbnail box-gradient">
	<?php
	    
	
	echo link_button('Add','','add','false',base_url().'index.php/delivery/add');		
	echo link_button('Print', 'print_delivery()','print');		
	echo link_button('Delete','','remove','false',base_url().'index.php/delivery/delete/'.$shipment_id);		
	echo link_button('Search','','search','false',base_url().'index.php/delivery');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/delivery/view/'.$shipment_id);		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'delivery\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('delivery')">Help</div>
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


<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table width="100%" class="table">
	<tr>
		<td>Nomor Bukti</td><td>
		<?php
		  $id=$shipment_id;
		  echo form_input('shipment_id',$id,"id=shipment_id style='width:200px'"); 
		?>
        </td>
		<td>Gudang</td><td>
		    <?php 
            if($readonly_gudang==""){
                echo form_dropdown('warehouse_code',$warehouse_list,$warehouse_code,"id='warehouse_code'");
            } else {
                echo form_input("warehouse_code",$warehouse_code,"id='warehouse_code' $readonly_gudang");
            }
            ?>
        </td>
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received 
            class="easyui-datetimebox" required style="width:200px"
			data-options="formatter:format_date,parser:parse_date"');?>
            </td>
            <td>Pengirim</td><td><?php echo form_input('supplier_number',$supplier_number,'id=supplier_number');?></td>
       </tr>
       <tr>
            <td>Jenis Transaksi</td><td><?=form_input('doc_type',$doc_type,"id='doc_type' ");?>
                <?=link_button('','dlgdoc_type_show()',"search","false"); ?>      
             </td>          
            <td>Nomor Ref#</td><td><?=form_input('ref1',$ref1,"id='ref1' ");?>   
             </td>          
       </tr>
       <tr>
            <td>Keterangan</td><td colspan='4'><?php echo form_input('comments',$comments,'id=comments style="width:400px"');?></td>
       </tr>
   </table>
    <legend>Daftar Items</legend>
   
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
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	</div>	

</div>
   
</form>


<?php 
    echo $lookup_doc_type;
    echo load_view('inventory/inventory_select'); 
    
?>


 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/delivery/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/delivery/del_item';

    function url_detail(){
	 	var nomor=$('#shipment_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/delivery/items/'+nomor+'/json');
    }
	function print_delivery(){
		nomor=$("#shipment_id").val();
		url="<?=base_url()?>index.php/delivery/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function delete_delivery()
	{
		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/delivery/delete/<?=$shipment_id?>",
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						window.open('<?=base_url()?>index.php/delivery','_self');
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
        var url="<?=base_url()?>index.php/delivery/save";
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
			 
		}
	}    
	
 </script>
	
