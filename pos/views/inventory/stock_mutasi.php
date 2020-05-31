<div class="thumbnail box-gradient"> 
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	if($mode!=="add"){
	    //echo link_button('Save','save_bukti()','save');       
		echo link_button('Delete','','remove','false',base_url().'pos.php/stock_mutasi/delete/'.$transfer_id);		
	    if($posted){
	        echo link_button('UnPosting','unposting()','save');     
	        
	    } else {
	        echo link_button('Posting','posting()','save');     
	        
	    }		
			
		//echo link_button('Search','','search','false',base_url().'index.php/delivery');		
	    echo link_button('Refresh','reload_bukti()','reload');      
	}
    
	echo link_button("Print","print_mutasi()","print");
	echo link_button('Search','','search','false',base_url().'pos.php/stock_mutasi');		
		
	?>	
	<div style='float:right'>
		<?=link_button('Help', 'load_help(\'stock_mutasi\')','help');?>		
		<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help('stock_mutasi')">Help</div>
			<div onclick="show_syslog('stock_mutasi','<?=$transfer_id?>')">Log Aktifitas</div>
	
			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>	
		<?=link_button('Close','remove_tab_parent()','cancel');   ?>   
	</div>
</div> 
<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table class="table2" width="100%">
	<tr>
		<td>Nomor</td><td><?php 
                echo form_input('transfer_id',$transfer_id,'id=transfer_id');
        ?></td>
		<td>Status </td><td><?php 
            echo form_dropdown('status',$status_list,$status,'id=status');
			echo link_button("Update","update_status();return false","save");
        ?></td>
		
		
	</tr>
       <tr>
		<td>Tanggal</td><td><?php  
                echo form_input('date_trans',$date_trans,
                "id='date_trans' class='easyui-datetimebox' required 
				data-options='formatter:format_date,parser:parse_date' style'width:230px' ");
                
        ?></td>
		<td>Verify By</td>
		<td><?=form_input("verify_by",$verify_by," readonly id=verify_by")?></td>
       </tr>
	<tr>
		<td>Gudang Sumber</td>
		<td><?php 
			$gudang_locked="";
			//if($from_location!="")$gudang_locked="disabled";
            echo form_input('from_location',$from_location,"id=from_location $gudang_locked");                
			echo link_button("","dlgwarehouse_show();return false","search");
                                
        ?>
        </td>
		<td>Verify Date</td>
		<td><?=form_input("verify_date",$verify_date," readonly id=verify_date class='easyui-datetimebox'  
				data-options='formatter:format_date,parser:parse_date' style'width:230px' 
				")?></td>
	</tr>
	<tr>
		<td>Gudang Tujuan</td>
		<td><?php 
            echo form_input('to_location',$to_location,'id=to_location');
			echo link_button("","dlgwarehouse2_show();return false","search");
                        
        ?></td>
		<td>Doc Type</td>
		<td><?php 
            echo form_dropdown('doc_type',$doc_type_list,$doc_type,'id=doc_type');
        ?></td>
	</tr>
    <tr>
		<td>Catatan</td>
		<td colspan='3'><?php 
                	echo form_input('comments',$comments,'style="width:400px" id=comments');
        ?></td>
     </tr>
	 <tr><td>&nbsp </td><td>&nbsp </td></tr>
   </table>
<div class="easyui-tabs" >
    <div id='divGeneral' title='Items'> 
	<!-- LINEITEMS -->		
		<div id='divItem' style='display:<?=$mode=="add"?"":""?>'>
			<table id="dg" class="easyui-datagrid" width=900 
				data-options="
					iconCls: 'icon-edit',fitColumns:true,
					singleSelect: true,
					toolbar: '#tb_item',
					url: ''
				">
				<thead>
					<tr>
						<th data-options="field:'item_number',width:80">Kode Barang</th>
						<th data-options="field:'description',width:150">Nama Barang</th>
	                    <th data-options="<?=col_number('from_qty',2)?>">Qty</th>
						<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
	                    <th data-options="<?=col_number('mu_qty',2)?>">M Qty</th>
						<th data-options="field:'multi_unit',width:50,align:'left',editor:'text'">M Unit</th>
						<th data-options="field:'account',width:50,align:'left',editor:'text'">Cogs Account</th>
						<th data-options="field:'line_number',width:30,align:'right'">Line</th>
					</tr>
				</thead>
			</table>
		</div>	
	</div>
</div>

</form>



</div>
<!-- LINEITEMS -->

<?php 
	echo $lookup_gudang;
	echo $lookup_gudang2;
	echo $lookup_inventory;
    echo load_view('inventory/input_qty'); 
    echo load_view("inventory/select_unit");
    echo load_view("inventory/inventory_select_checkbox");

?>
<div id="tb_item" class='thumbnail'>
    <a href="#" class="easyui-linkbutton" iconCls="icon-save"  onclick="addItem();return false;">Add Item</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit"  onclick="editItem();return false;">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove"   onclick="deleteItem();return false;">Delete</a>	
    <?php echo link_button('Refresh','load_items()','reload');      ?>
</div> 


 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/stock_mutasi/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/stock_mutasi/del_item';
	
    $().ready(function (){
    	
        $('#dg').datagrid({
            onClickRow:function(){
            	editItem();
            }
        });        
    	
		load_items();
	});

    function url_detail(){
	 	var nomor=$('#transfer_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>pos.php/stock_mutasi/items/'+nomor+'/json');
    }
	function print_mutasi(){
		nomor=$("#transfer_id").val();
		url="<?=base_url()?>pos.php/stock_mutasi/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function update_status()
	{
		var status=$("#status").val();
	 	var nomor=$('#transfer_id').val();
		var url='<?=base_url()?>pos.php/stock_mutasi/verify/'+nomor+"?status="+status;
		var next_url='<?=base_url()?>pos.php/stock_mutasi/view/'+nomor;
		ajax_get(url,null,next_url);
	}
	function editItem(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.from_qty);
			$('#unit').val(row.unit);
			$('#id').val(row.line_number);
			$('#mu_qty').val(row.mu_qty);
			$('#multi_unit').val(row.multi_unit);
			$("#cost_account").val(row.account);
			$("#cost").val(row.cost);
			$("#total_amount").val(row.total_amount);
			if($("#multi_unit").val()!=$("#unit").val()){
				$("#divMultiUnit").show();
			} else {
				$("#divMultiUnit").hide();
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
                    log_msg("Success");
                    $.messager.show({title: 'Success',msg: 'Success'});
                    close_item();                    
                    loading_close();
                } else {
                	loading_close();
                	log_err(result.msg);
                    $.messager.show({title: 'Error',msg: result.msg });
                }
            },
            error: function(result){alert("Some error !");}
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
        $("#cost_account").val("");
        $("#cost").val("");
        $("#total_amount").val("");
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
        if($('#to_location').val()==''){log_err('Isi gudang tujuan !');return false;} 
        
        return true;        
    } 
    function get_input_values(){
        var _param={transfer_id:$("#transfer_id").val(),
            date_trans:$("#date_trans").datetimebox('getValue'),
            from_location:$("#from_location").val(),
            to_location:$("#to_location").val(),
            comments:$("#comments").val(),
            status:$("#status").val(),
            verify_by:$("#verify_by").val(),
            verify_date:$("#verify_date").datetimebox('getValue'),
            doc_type:$("#doc_type").val(),            
            item_number:$("#item_number").val(),
            unit:$("#unit").val(),
            description:$("#description").val(),
            quantity:$("#quantity").val(),
            mu_qty:$("#mu_qty").val(),
            multi_unit:$("#multi_unit").val(),
            cost_account:$("#cost_account").val(),
            cost:$("#cost").val(),
            total_amount:$("#total_amount").val(),
            id:$("#id").val()};
       return _param; 
    }



    
    function addItem(){
        if (!valid()) return false;
        
        clear_input();
        qty_conv=0;
        
        show_input_item();
    }
    function load_items(){
        var nomor=$('#transfer_id').val();
        $('#dg').datagrid({url: url_detail()});
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
            to_location:$("#to_location"),
            verify_by:$("#verify_by"),
            verify_date:$("#verify_date").datetimebox('getValue'),
            doc_type:$("#doc_type").val()
            };
        $.ajax({
            type: "POST",
            url: "<?=base_url('stock_mutasi/updatex')?>",
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
    function reload_bukti(){
    	var nomor=$("#transfer_id").val();
    	var url=CI_ROOT+"stock_mutasi/view/"+nomor;
    	window.open(url,'_self');
    }
    function posting(){
    	var nomor=$("#transfer_id").val();
    	var url=CI_ROOT+"stock_mutasi/posting/"+nomor;
    	window.open(url,'_self');    	
    }
    function unposting(){
    	var nomor=$("#transfer_id").val();
    	var url=CI_ROOT+"stock_mutasi/unposting/"+nomor;
    	window.open(url,'_self');    	
    }
 </script>