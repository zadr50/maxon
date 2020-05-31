<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Add','','add','false',base_url().'index.php/receive/add');		
	echo link_button('print', 'print_receive()','print');		
	echo link_button('Search','','search','false',base_url().'index.php/receive/browse');		
	echo link_button('Refresh','reload_bukti()','reload');		
    
    if($posted){
        echo link_button('UnPosting','unposting()','save');     
        
    } else {
        echo link_button('Posting','posting()','save');     
        
    }
    
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
    	<?=link_button('Close','remove_tab_parent()','cancel');?>      
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

<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
	<div title="Umum" id="box_section" style="padding:10px">	
		<form id="frmItem" method='post' >
		
	   <table class='table2' width='100%'>
		<tr>
			<td>Nomor Bukti</td><td>
			<?php echo form_input('shipment_id',$shipment_id,"id=shipment_id"); ?>
	                </td>
			<td>Gudang</td><td><?php 
	            echo form_input('warehouse_code',$warehouse_code,'id=warehouse_code');
	            echo link_button('','dlgwarehouse_show()',"search","false");  
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
	        <td>Received By</td><td><?php echo form_input('receipt_by',$receipt_by,'id=receipt_by');?></td>
	        <td>Ref#</td><td><?php echo form_input('other_doc_number',$other_doc_number,"id='other_doc_number'");?></td>
	       
	   </tr>
	   <tr>
	        <td>Doc Type</td><td><?php echo form_input('doc_type',$doc_type,'id=doc_type');?></td>
	        <td>Doc Status</td><td><?php echo form_input('doc_status',$doc_status,'id=doc_status');?></td>
	       
	   </tr>
	   <tr>
	        <td>Posted</td><td><?php echo form_input('posted',$posted,'id=posted');?></td>
	        <td>Trans Type</td><td><?php echo form_input('trans_type',$trans_type,'id=trans_type');?></td>
	       
	   </tr>
	
	   <tr>
			<td>Catatan</td><td colspan='4'><?php echo form_input('comments',$comments,'id=comments style="width:500px"');?></td>
	   </tr>
	   <tr>
	        <td>Kode Akun (Credit)</td><td colspan=4><?php echo form_input('ref1',$ref1,"id='ref1' style='width:400px' ");
	            echo link_button('',"lookup_coa('ref1')",'search');
	            
	            ?></td>
	       
	   </tr>
	   </table>
		</form>
	</div>
	<div title="Items" id="box_section" style="padding:10px">
		<div id='divItem' style='display:<?=$mode=="add"?"":""?>'>
			<table id="dg" class="easyui-datagrid"  width="100%"
				data-options="
					iconCls: 'icon-edit',
					singleSelect: true,
					toolbar: '#tb_item',fitColumns:true 
				">
				<thead>
					<tr>
						<th data-options="field:'item_number',width:80">Kode Barang</th>
						<th data-options="field:'description',width:150">Nama Barang</th>
						<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
						<th data-options="field:'unit',width:50,align:'left',editor:'text'">Unit</th>
						<?=col_number2("cost","Cost")?>
						<th data-options="field:'mu_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">M Qty</th>
						<th data-options="field:'multi_unit',width:50,align:'left',editor:'text'">M Unit</th>
						<?=col_number2('mu_price','Mu Price')?>
						<?=col_number2('total_amount','Total')?>
						<th data-options="field:'warehouse_code',width:80">Gudang</th>
						<th data-options="field:'supplier_number',width:80">Asal</th>
						<th data-options="field:'line_number',width:30,align:'right'">Line</th>
					</tr>
				</thead>
			</table>
		</div>	
		<!-- LINEITEMS -->
		</div> 
	</div>
	
<div id="tb_item" class='thumbnail box-gradient'>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add"  onclick="addItem();return false;">Add</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit"  onclick="editItem();return false;">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove"   onclick="deleteItem();return false;">Delete</a>	
	<a href="#" class="easyui-linkbutton" iconCls="icon-reload"   onclick="refreshItem();return false;">Refresh</a>	
</div> 

<?php 
	echo $lookup_inventory;
    echo $lookup_gudang;
    echo load_view('inventory/input_qty'); 
    echo load_view("inventory/select_unit");
    echo load_view("inventory/inventory_select_checkbox");
    echo load_view('gl/select_coa_link');

?>


 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/receive/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/receive/del_item';

   $().ready(function (){
        load_items();
    });
    function refreshItem(){
    	load_items();
    }
    function hitung3(){
    	calc_qty_unit();
    }
    function deleteItem(){
        var nomor=$('#shipment_id').val();
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
                if (r){
                    url=url_del_item+'/'+row.line_number;
                    $.ajax({
                        type: "GET",url: url,param: '',
                        success: function(result){
                            var result = eval('('+result+')');
                            if (result.success) load_items();
                        },
                        error: function(msg){$.messager.alert('Info',msg);}
                });
                    
                }
            })
        }
    }

    function save_item(){
        if (!valid()) return false;
        loading();
        var _param=get_input_values();
        console.log(_param);
        $.ajax({
            type: "POST",
            url: url_save_item,
            data: _param,
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                	loading_close();
                    $("#shipment_id").val(result.shipment_id);
                    load_items();
                    $.messager.show({title: 'Success',msg: 'Success'});
                    close_item();                    
                } else {
                	loading_close();
                	log_err(result.msg);
                    $.messager.show({title: 'Error',msg: result.msg });
                }
            },
            error: function(result){alert("Some error !");}
        });
    }
    
    
    function hitung2(){
        
    }


    function show_input_item(){
        //$('#dgItemForm').window({left:10,top:window.event.clientY-50});
        $("#dgItemForm").dialog("open").dialog('setTitle','Input barang');
    }    
    function close_item(){
        clear_input();
        $("#dgItemForm").dialog("close");   
    }


    function clear_input(){
        $('#item_number').val('');
        $('#description').val('');
        $('#line_number').val('');
        $('#quantity').val(1);
        $("#unit").val("Pcs");
        $('#mu_qty').val("");
        $("#multi_unit").val("");
        $("#mu_harga").val("");
        $("#total_unit").val("");
        $("#cost").val("");
        
        $("#id").val("");
    }

    function valid(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        var shipment_id=$('#shipment_id').val();
        if(shipment_id==''){log_err('Isi nomor bukti !');return false;}
        if($('#warehouse_code').val()==''){log_err('Isi gudang!');return false;} 
        //if($('#supplier_number').val()==''){log_err('Isi outlet atau tujuan!');return false;} 
        
        return true;        
    } 
    function get_input_values(){
        var _param={shipment_id:$("#shipment_id").val(),
            date_received:$("#date_received").datetimebox('getValue'),
            warehouse_code:$("#warehouse_code").val(),
            supplier_number:$("#supplier_number").val(),
            comments:$("#comments").val(),
            ref1:$("#ref1").val(),
            item_number:$("#item_number").val(),
            unit:$("#unit").val(),
            description:$("#description").val(),
            quantity_received:$("#quantity").val(),
            ref1:$("#ref1").val(),
            doc_type:$("#doc_type").val(),
            doc_status:$("#doc_status").val(),
            receipt_by:$("#receipt_by").val(),
            mu_qty:$("#mu_qty").val(),
            multi_unit:$("#multi_unit").val(),
            mu_price:$("#mu_harga").val(),
            multi_unit:$("#multi_unit").val(),
            total_amount:$("#total_amount").val(),cost:$("#cost").val(),
            id:$("#id").val()};
       return _param; 
    }



	
    function addItem(){
        if (!valid()) return false;
        clear_input();
        show_input_item();
    }

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
	function reload_bukti(){
        nomor=$("#shipment_id").val();
        if(nomor=="AUTO"){
            alert("Simpan dulu !");
            return false;
        }
        url="<?=base_url()?>index.php/receive/view/"+nomor;
        window.open(url,"_self");
	    
	}
	function posting(){
        nomor=$("#shipment_id").val();
        if(nomor=="AUTO"){
            alert("Simpan dulu !");
            return false;
        }
        url="<?=base_url()?>index.php/receive/posting/"+nomor;
        window.open(url,"_self");
        
    }
    function unposting(){
        nomor=$("#shipment_id").val();
        url="<?=base_url()?>index.php/receive/unposting/"+nomor;
        window.open(url,"_self");
        
    }

	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/receive_non_po");
	}
	
    function editItem(){
        show_input_item();
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#item_number').val(row.item_number);
            $('#description').val(row.description);
            $('#quantity').val(row.quantity);
            $('#unit').val(row.unit);
            $('#id').val(row.line_number);
            $('#mu_qty').val(row.mu_qty);
            $('#multi_unit').val(row.multi_unit);
            $('#cost').val(row.cost);
            $('#mu_harga').val(row.mu_price);
            $('#total_amount').val(row.total_amount);
        }
    }
    function load_items(){
        var nomor=$('#shipment_id').val();
        $('#dg').datagrid({url: url_detail()});
    }
	
 </script>
