<div class="thumbnail box-gradient" >  
	<?php
    echo link_button('Save','save_bukti();return false;','save');     
    echo link_button('Delete','hapus();return false','remove');		
	echo link_button("Print","print_bukti()","print");
	?>	
	<div style='float:right'>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',
		iconCls:'icon-tip',plain:false">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('stock_opname')">Help</div>
		<div onclick="show_syslog('stock_opname','<?=$transfer_id?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Help', 'load_help(\'stock_opname\')','help');?>		
    <?=link_button('Close','remove_tab_parent()','cancel');?>
	</div>
</div>
<div class="thumbnail">	
<form id="frmItem" method='post'>
   <table width="100%" class="table2">
	<tr>
		<td>Doc Number</td><td><?=form_input('transfer_id',$transfer_id,'id=transfer_id');?></td>
        <td>Create By</td><td><?=form_input("trans_by",$trans_by,"id='trans_by'")?></td>
	</tr>
       <tr>
		<td>Tanggal</td><td><?php  
                echo form_input('date_trans',$date_trans
				,"id='date_trans' class='easyui-datetimebox' required 
				data-options='formatter:format_date,parser:parse_date'");
                
        ?></td>
        <td>Verify By</td><td><?=form_input("verify_by",$verify_by,"id='verify_by'")?></td>
       </tr>
	<tr>
		<td>Gudang</td><td><?php 
            echo form_input('from_location',$from_location,'id=from_location');
            echo link_button('','dlgwarehouse_show()',"search","false");  
                
                ?></td>
        <td>Verify Date</td><td><?=form_input('verify_date',$verify_date,"id='verify_date' 
                    class='easyui-datetimebox' 
                    data-options='formatter:format_date,parser:parse_date'");?>
                    </td>
	</tr>
    <tr>
		<td>Catatan</td>
		<td><?php 
             	echo form_input('comments',$comments,'id=comments style="width:400px"');
        ?></td>
        <td>Doc Status</td><td><?=form_input("status",$status,"id='status'")?></td>
     </tr>
   </table>
<!-- LINEITEMS 	
<div id='dgItem'><?=load_view('inventory/select_item_no_price.php')?></div>

-->

<div id='divItem' style='display:<?=$mode=="add"?"":""?>'>
	<table id="dg" class="easyui-datagrid"  width="100%"
		data-options="
			iconCls: 'icon-edit',fitColumns:true,
			singleSelect: true,
			toolbar: '#tb_item',
			url: url_load_item
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
                <th data-options="<?=col_number('cost',2)?>">Cost</th>
                <th data-options="<?=col_number('total_amount',2)?>">Total</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
</div>	
<!-- LINEITEMS -->

</form>


</div>
<div id="tb_item" class='thumbnail'>
    <?php
        echo link_button('Add Item','addItem()','add');      
        echo link_button('Edit','editItem()','edit');      
        echo link_button('Delete','deleteItem()','remove');       
        echo link_button('Refresh','load_items()','reload');      
    
    ?>
</div> 

<?php 
    echo load_view("inventory/inventory_select_checkbox");
    echo $lookup_gudang;
    echo load_view('inventory/input_qty'); 
    echo load_view("inventory/select_unit");
    echo $lookup_inventory;

?>


<script type="text/javascript">
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/stock_opname/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/stock_opname/del_item';

	var qty_conv = 0;

    function url_detail(){
	 	var nomor=$('#transfer_id').val();
    	return ('<?=base_url()?>index.php/stock_opname/items/'+nomor+'/json');
    }
	
    function save_bukti(){
        if($("#transfer_id").val()=="AUTO"){
            log_err("Silahkan diklik AddItem.");
            return false;
        }
        
        var _param={transfer_id:$("#transfer_id").val(),
            date_trans:$("#date_trans").datetimebox('getValue'),
            from_location:$("#from_location").val(),
            comments:$("#comments").val(),
            status:$("#status").val(),
            trans_by:$("#trans_by").val()
            };
        $.ajax({
            type: "POST",
            url: "<?=base_url('stock_opname/update')?>",
            data: _param,
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    log_msg("Success");
                    $.messager.show({title: 'Success',msg: 'Success'});
                } else {
                    log_err("Error");
                    $.messager.show({title: 'Error',msg: result.msg });
                }
            },
            error: function(result){alert("Some error !");}
        });
    }

    function url_detail(){
	 	var nomor=$('#transfer_id').val();
    	return ('<?=base_url()?>index.php/stock_opname/items/'+nomor);
    }
	function print_bukti(){
		nomor=$("#transfer_id").val();
		url="<?=base_url()?>index.php/stock_opname/print_bukti/"+nomor;
		window.open(url,'_blank');
	}

	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/stock_opname");
	}
    function addItem(){
        if (!valid()) return false;        
        clear_input();
        qty_conv=0;        
        show_input_item();
    }
    function hitung(){
        calc_qty_unit();
    }
    function save_item(){
        if (!valid()) return false;        
        var _param=get_input_values();
        loading();
        $.ajax({
            type: "POST",
            url: url_save_item,
            data: _param,
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $("#transfer_id").val(result.transfer_id);
                    load_items();
                    $.messager.show({title: 'Success',msg: 'Success'});
                    log_msg("Success");
                    close_item();                    
                    loading_close();
                } else {
                	loading_close();
                	log_err(result.msg);
                    $.messager.show({title: 'Error',msg: result.msg });
                }
            },
            error: function(result){log_err(result);}
        });
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
        $('#id').val('');
        $('#quantity').val(1);
        $("#unit").val("Pcs");
        $("#id").val("");
        $("#mu_qty").val("");
        $("#multi_unit").val("");
        $("#mu_harga").val("");
    }
    function deleteItem(){
        var nomor=$('#transfer_id').val();
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

	function editItem(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.quantity);
			$('#unit').val(row.unit);
			$('#id').val(row.line_number);
			$('#mu_qty').val(row.mu_qty);
			$('#multi_unit').val(row.multi_unit);
			
			if($("#multi_unit").val()!=$("#unit").val()){
				$("#divMultiUnit").show();
			} else {
				//$("#divMultiUnit").hide();
			}
			
			show_input_item(); 
		}
	}     
    function valid(){
        var valid_date=true;
        var tanggal=$('#date_trans').datetimebox('getValue'); 
        
        var transfer_id=$('#transfer_id').val();
        if(transfer_id=='' ){alert('Isi nomor bukti !');return false;}
        if($('#from_location').val()==''){log_err('Isi gudang asal !');return false;} 
        
        return true;        
    } 
    function get_input_values(){
        var _param={transfer_id:$("#transfer_id").val(),
            date_trans:$("#date_trans").datetimebox('getValue'),
            from_location:$("#from_location").val(),
            comments:$("#comments").val(),
            trans_by:$("#trans_by").val(),
            item_number:$("#item_number").val(),
            unit:$("#unit").val(),
            description:$("#description").val(),
            quantity:$("#quantity").val(),          ref1:$("#ref1").val(),
            mu_qty:$("#mu_qty").val(),				doc_type:$("#doc_type").val(),
            multi_unit:$("#multi_unit").val(),		status:$("#status").val(),
            id:$("#id").val()};
       return _param; 
    }
    function load_items(){
        var nomor=$('#transfer_id').val();
        $('#dg').datagrid({url: url_detail()});
    }    
    $().ready(function(){
        load_items();
    })
    function hapus(){
        var nomor=$('#transfer_id').val();
        $.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
            if (r){
                url=CI_BASE+'index.php/stock_opname/delete/'+nomor;
                loading();
                $.ajax({
                    type: "GET",url: url,param: '',
                    success: function(result){
                        var result = eval('('+result+')');
                        if (result.success) {
                            remove_tab_parent();
                        };
                    },
                    error: function(msg){$.messager.alert('Info',msg);}
            });
                
            }
        })
    }
</script>