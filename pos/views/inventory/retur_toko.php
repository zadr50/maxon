<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
		echo link_button('Print', 'print_delivery()','print');		
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
		  echo form_input('shipment_id',$id,"id='shipment_id' style='width:150px' "); 
		?>
        </td>
		<td>Dari Toko/Lokasi</td><td>
		    <?php 
              $gudang_locked="";
				echo form_input('warehouse_code',$warehouse_code,"id='warehouse_code'");
               echo link_button("", "dlgwarehouse_show();return false;","search");                                
            ?>
        </td>
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received 
                    class="easyui-datetimebox" required 
        			data-options="formatter:format_date,parser:parse_date" style="width:150px" ');?>
            </td>
        <td>Tujuan Gudang/Toko/Lokasi</td><td>
            <?php 
				echo form_input('supplier_number',$supplier_number,"id='supplier_number'");
               	echo link_button("", "dlggudang_show();return false;","search");            
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
		
	<div id="tb_item">
		<?php
        echo link_button("Add Item",'addItem()',"add","false"); 
        echo link_button("Edit",'editItem()',"edit","false"); 
        echo link_button("Delete",'delItem()',"remove","false");
        echo link_button("Refresh",'load_items()',"reload","false");
		?> 
	</div> 
	<div id='divItem' class='box-gradient' style='display:<?=$mode=="add"?"":""?>'>
		<table id="dg" class="easyui-datagrid table"  width="100%"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,
				toolbar: '#tb',fitColumns:true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
                    <th data-options="field:'ref1',width:50,align:'left',editor:'text'">Ref#</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	</div>	

</div>
   
</form>


<?php 
    echo load_view('inventory/input_qty'); 
    echo load_view("inventory/select_unit");
    echo $lookup_doc_status;
    echo $lookup_faktur;
    echo $lookup_gudang1;
    echo $lookup_gudang2;
    echo $lookup_inventory;
?>


 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>pos.php/retur_toko/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>pos.php/retur_toko/del_item';

	var _url  =  CI_ROOT+'retur_toko';
	
    $().ready(function (){
        load_items();
    });
    function valid(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        var shipment_id=$('#shipment_id').val();
        if(shipment_id==''){alert('Isi nomor bukti !');return false;}
        if($('#warehouse_code').val()==''){log_err('Isi gudang yang menerima barang !');return false;} 
        if($('#supplier_number').val()==''){log_err('Isi pengirim atau gudang sumber !');return false;} 
        
        return true;        
    } 
    function addItem(){
        if (!valid()) return false;
        clear_input();
        show_input_item();
    }
    function show_input_item(){
        $("#dgItemForm").dialog("open").dialog('setTitle','Input barang');
    }    
    function close_item(){
        clear_input();
        $("#dgItemForm").dialog("close");   
    }
    
    function get_input_values(){
        var _param={shipment_id:$("#shipment_id").val(),
            date_received:$("#date_received").datetimebox('getValue'),
            warehouse_code:$("#warehouse_code").val(),
            supplier_number:$("#supplier_number").val(),
            comments:$("#comments").val(),
            ref1:$("#other_doc_number").val(),
            item_number:$("#item_number").val(),
            unit:$("#unit").val(),
            description:$("#description").val(),
            quantity_received:$("#quantity").val(),
            cost:$("#cost").val(),total_amount:$("#total_amount").val(),
            id:$("#id").val()};
       return _param; 
    }
    
    function load_items(){
        var nomor=$('#shipment_id').val();
        $('#dg').datagrid({url: _url+'/items/'+nomor});
    }
    function clear_input(){
        $('#item_number').val('');
        $('#description').val('');
        $('#line_number').val('');
        $('#quantity').val(1);
        $("#unit").val("Pcs");
        $("#cost").val("");
        $("#total_amount").val("");
        $("#id").val("");
    }

    function url_detail(){
	 	var nomor=$('#shipment_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>pos.php/retur_toko/items/'+nomor+'/json');
    }
	function print_delivery(){
		nomor=$("#shipment_id").val();
		url="<?=base_url()?>pos.php/retur_toko/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function delete_nomor()
	{
		var shipment_id=$("#shipment_id").val();
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

		var vUrl=CI_ROOT+"retur_toko/delete/"+shipment_id;
		
	    $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
        if (r){
			$.ajax({
					type: "GET",
					url: vUrl,
					data: "",
					success: function(result){
						var result = eval('('+result+')');
						if(result.success){
							log_msg("Data sudah dihapus");
							remove_tab_parent();
						} else {
							$.messager.show({
								title:'Error',msg:result.msg
							});							
						};
					},
					error: function(msg){alert(msg);}
			}) 				
        }
	})

	}    
	function save() {
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_received').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}


        var url="<?=base_url()?>pos.php/retur_toko/save";
		var shipment_id=$('#shipment_id').val();
  		if(shipment_id==''){alert('Isi nomor bukti !');return false;}
  		if($('#warehouse_code').val()==''){alert('Isi gudang!');return false;} 
		$('#item_number').val('XXX');
		save_item();		
	}
    function save_item(){
        if (!valid()) return false;
        var _param=get_input_values();
        loading();
        $.ajax({
            type: "POST",
            url: _url+"/save_item",
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
                    $.messager.show({title: 'Error',msg: result.msg });
                }
            },
            error: function(result){alert("Some error !");}
        });
    }	
	
	function editItem(){
       show_input_item();
        var row = $('#dg').datagrid('getSelected');
 		if (row){
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.quantity);
			$('#unit').val(row.unit);
			$('#line_number').val(row.line_number);
			$("#ref1").val(row.ref1);
            $("#cost").val(row.cost);
            $("#total_amount").val(row.total_amount);
            $('#id').val(row.line_number);
			 
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
    function delItem(){
        var nomor=$('#shipment_id').val();
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
                if (r){
                    url=_url+'/del_item/'+row.line_number;
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
 </script>
	
