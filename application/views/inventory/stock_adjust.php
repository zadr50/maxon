<div class="thumbnail box-gradient" >  
	<?php
	   $min_date=$this->session->userdata("min_date","");
	if($mode!=="add"){
	    echo link_button('Save','save_bukti()','save');       
		echo link_button('Delete','','remove','false',base_url().'index.php/stock_adjust/delete/'.$transfer_id);		
	    if($posted){
	        echo link_button('UnPosting','unposting()','save');     
	        
	    } else {
	        echo link_button('Posting','posting()','save');     
	        
	    }		
			
		//echo link_button('Search','','search','false',base_url().'index.php/delivery');		
	    echo link_button('Refresh','reload_bukti()','reload');      
	}
    
	
	echo link_button("Print","print_adjust()","print");
	echo link_button('Search','','search','false',base_url().'index.php/stock_adjust');		
    echo link_button('Pilih Nomor Opname','pilih_stock_opname();return false','search');     
	
	?>	
	<div style='float:right'>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',
		iconCls:'icon-tip',plain:false">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('stock_adjust')">Help</div>
		<div onclick="show_syslog('stock_adjust','<?=$transfer_id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Help', 'load_help(\'stock_adjust\')','help');?>		
    <?=link_button('Close','remove_tab_parent()','cancel');?>
	</div>
</div>
<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table width="100%" class="table2">
	<tr>
		<td>Nomor</td><td><?php 
                echo form_input('transfer_id',$transfer_id,'id=transfer_id');
        ?></td>
        <td>Doc Status</td><td><?=form_input("status",$status,"id='status'")?></td>
        
	</tr>
       <tr>
		<td>Tanggal</td><td><?php  
                echo form_input('date_trans',$date_trans
				,"id='date_trans' class='easyui-datetimebox' required 
				data-options='formatter:format_date,parser:parse_date' style='width:180px'");                
        ?></td>        
        <td>Create By</td><td><?=form_input("trans_by",$trans_by,"id='trans_by'")?></td>        
       </tr>
	<tr>
		<td>Gudang</td>
        <td><?php 
            echo form_input('from_location',$from_location,'id=from_location');
            echo link_button('','dlgwarehouse_show()',"search","false");                                     
            ?>
        </td>                
        <td>Doc Type</td><td class='field'> 
            <?php
            echo form_input("doc_type",$doc_type,"id='doc_type'");
            echo link_button('','dlgdoc_type_show();return false;',"search","false"); 
            echo link_button('',"dlgdoc_type_list('doc_type_adjust_stock');return false;","add","false"); 
            ?>
        </td>
	</tr>
    <tr>
		<td>Catatan</td>
		<td><?php 
            echo form_input('comments',$comments,'id=comments style="width:300px"');
        ?></td>
        <td>Ref1</td><td><?=form_input("ref1",$ref1,"id='ref1'")?></td>
     </tr>
   </table>
<!-- LINEITEMS -->	


<div id='divItem' style='display:<?=$mode=="add"?"":""?>;'>
	<table id="dg" class="easyui-datagrid"  style="min-height:300px"
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
				<th data-options="field:'from_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty Fisik</th>
                <th data-options="field:'to_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty Adj</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
				<th data-options="field:'mu_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">M Qty</th>
				<th data-options="field:'multi_unit',width:50,align:'left',editor:'text'">M Unit</th>
                <th data-options="field:'from_location',width:50,align:'left',editor:'text'">Gudang</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
                <th data-options="field:'date_trans',width:50,align:'left',editor:'text'">Date</th>
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
    echo $lookup_gudang;
    echo $lookup_stock_opname;
	echo $lookup_inventory;
//    echo load_view('inventory/inventory_select'); 
    echo load_view('inventory/input_qty'); 
    echo load_view("inventory/select_unit");
    echo load_view("inventory/inventory_select_checkbox");
	echo $lookup_doc_type;
	
	
    
?>
 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/stock_adjust/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/stock_adjust/del_item';

	var qty_conv = 0;
	
    function url_detail(){
	 	var nomor=$('#transfer_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/stock_adjust/items/'+nomor+'/json');
    }
    function before_submit_stock_opname(){
        console.log("before_submit");
        gudang=$("#from_location").val();
        $("#outlet").val(gudang);
    }
	function print_adjust(){
		nomor=$("#transfer_id").val();
		url="<?=base_url()?>index.php/stock_adjust/print_adjust/"+nomor;
		window.open(url,'_blank');
	}
    function selected_doc(){        
        var nomor=$('#transfer_id').val();
        loading();
        url="<?=base_url()?>index.php/stock_adjust/view/"+nomor;
        window.open(url,"_self");
    }
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/stock_adjust");
	}
    function pilih_stock_opname(){
        dlgstock_opname_show();
    }
    
	function editItem(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.to_qty);
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
    
    
    function hitung(){
        calc_qty_unit();
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

    function valid(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_trans').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
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

    function reload_bukti(){
    	var url="<?=base_url('stock_mutasi/view/'.$transfer_id)?>";
    	window.open(url,'_self');
    }
    function addItem(){
        if (!valid()) return false;        
        clear_input();
        qty_conv=0;        
        show_input_item();
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
            url: "<?=base_url('stock_adjust/update')?>",
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
    
    function load_items(){
        var nomor=$('#transfer_id').val();
        $('#dg').datagrid({url: url_detail()});
    }    
    $().ready(function(){
        load_items();
    })
    
</script>