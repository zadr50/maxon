<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
    echo link_button('Save','save_bukti()','save');       
	echo link_button('Add','','add','false',base_url().'index.php/delivery/add');		
	echo link_button('Print', 'print_delivery()','print');		
	echo link_button('Delete','','remove','false',base_url().'index.php/delivery/delete/'.$shipment_id);		
	echo link_button('Search','','search','false',base_url().'index.php/delivery');		
    echo link_button('Refresh','reload_bukti()','reload');      
    
    if($posted){
        echo link_button('UnPosting','unposting()','save');     
        
    } else {
        echo link_button('Posting','posting()','save');     
        
    }
    	
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


<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table width="100%" class="table2">
	<tr>
		<td>Nomor Bukti</td><td>
		<?php
		  $id=$shipment_id;
		  echo form_input('shipment_id',$id,"id=shipment_id"); 
		?>
        </td>
        <td>Gudang</td><td><?php 
            echo form_input('warehouse_code',$warehouse_code,'id=warehouse_code');
            echo link_button('','dlgwarehouse_show()',"search","false");  
        ?></td>
        
        
        
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received 
            class="easyui-datetimebox" required 
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
            <td>Proyek</td><td><?=form_input('ref2',$ref2,"id='ref2' ");?>
                <?=link_button('','dlggl_projects_show()',"search","false"); ?>      
             </td>          
            <td>Perkiraan</td><td><?=form_input('cost_account',$cost_account,"id='cost_account' style='width:300px' ");?>
                <?=link_button('','dlgcost_account_show()',"search","false");?>      
             </td>                   
       </tr>
       <tr>
            <td>Keterangan</td><td colspan='4'><?php echo form_input('comments',$comments,'id=comments style="width:400px"');?></td>
       </tr>
   </table>
	<div id="tb_item" class='thumbnail'>
        <a href="#" class="easyui-linkbutton" iconCls="icon-add"  onclick="addItem()">Add Item</a>
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
    echo $lookup_project;
    echo $lookup_gudang;
    echo $lookup_doc_type;
    echo $lookup_cost_account;
    echo load_view('inventory/inventory_select'); 
    echo load_view('inventory/input_qty'); 
    echo load_view("inventory/select_unit");
    echo load_view("inventory/inventory_select_checkbox");
    echo load_view('gl/select_coa_link');
    
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
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}


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
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

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
    function reload_bukti(){
        nomor=$("#shipment_id").val();
        if(nomor=="AUTO"){
            alert("Simpan dulu !");
            return false;
        }
        url="<?=base_url()?>index.php/delivery/view/"+nomor;
        window.open(url,"_self");
        
    }
    function posting(){
        nomor=$("#shipment_id").val();
        if(nomor=="AUTO"){
            alert("Simpan dulu !");
            return false;
        }
        url="<?=base_url()?>index.php/delivery/posting/"+nomor;
        window.open(url,"_self");
        
    }
    function unposting(){
        nomor=$("#shipment_id").val();
        url="<?=base_url()?>index.php/delivery/unposting/"+nomor;
        window.open(url,"_self");
        
    }

   $().ready(function (){
        load_items();
    });
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
        var _param=get_input_values();
        $.ajax({
            type: "POST",
            url: url_save_item,
            data: _param,
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $("#shipment_id").val(result.shipment_id);
                    load_items();
                    $.messager.show({title: 'Success',msg: 'Success'});
                    close_item();                    
                } else {
                    $.messager.show({title: 'Error',msg: result.msg });
                }
            },
            error: function(result){alert("Some error !");}
        });
    }
    
    
    function hitung(){
        
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
        $("#id").val("");
    }

    function valid(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        var shipment_id=$('#shipment_id').val();
        if(shipment_id=='' ){alert('Isi nomor bukti !');return false;}
        if($('#warehouse_code').val()==''){alert('Isi gudang!');return false;} 
        if($('#supplier_number').val()==''){alert('Isi pengirim / customer!');return false;} 
        
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
            quantity:$("#quantity").val(),
            ref1:$("#ref1").val(),
            doc_type:$("#doc_type").val(),
            doc_status:$("#doc_status").val(),
            receipt_by:$("#receipt_by").val(),
            ref2:$("#ref2").val(),
            cost_account:$("#cost_account").val(),            
            id:$("#id").val()};
       return _param; 
    }



    
    function addItem(){
        if (!valid()) return false;
        clear_input();
        show_input_item();
    }
    function load_items(){
        var nomor=$('#shipment_id').val();
        $('#dg').datagrid({url: url_detail()});
    }
    function save_bukti(){
        if($("#shipment_id").val()=="AUTO"){
            alert("Silahkan diklik AddItem.");
            return false;
        }
        
        var _param={shipment_id:$("#shipment_id").val(),
            date_received:$("#date_received").datetimebox('getValue'),
            warehouse_code:$("#warehouse_code").val(),
            supplier_number:$("#supplier_number").val(),
            comments:$("#comments").val(),
            ref1:$("#ref1").val(),
            doc_type:$("#doc_type").val(),
            doc_status:$("#doc_status").val(),
            receipt_by:$("#receipt_by").val(),
            ref2:$("#ref2").val(),
            cost_account:$("#cost_account").val()};
        $.ajax({
            type: "POST",
            url: "<?=base_url('delivery/save_nomor')?>",
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
	
 </script>
	
