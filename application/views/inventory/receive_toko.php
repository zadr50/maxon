<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	//echo link_button('Add','','add','false',base_url().'index.php/receive_toko/add');		
	echo link_button('Print', 'cetak()','print');		
    if($mode=="view")echo link_button('Save', 'simpan()','save');        
    
	echo link_button('Search','','search','false',base_url().'index.php/receive_toko');		
	echo link_button('Refresh','load_items();return false','reload','false');		
//    echo link_button('Posting','','save','false',base_url().'index.php/receive_toko/posting');     
    
    
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'receive_toko\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('receive_toko')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');?>      
	</div>
	
</div>
<div class="thumbnail">	

   <table width="100%" class="table2">
	<tr>
		<td>Nomor Bukti</td><td>
		<?php
		  $id=$shipment_id;
		  echo form_input('shipment_id',$id,"id=shipment_id"); 
		?>
        </td>
		<td>Terima di</td><td>
		    <?php 
                echo form_dropdown('warehouse_code', $warehouse_list,$warehouse_code,'id=warehouse_code');
            ?>
        </td>
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date_received',$date_received,'id=date_received 
            class="easyui-datetimebox" required 
			data-options="formatter:format_date,parser:parse_date"');?>
            </td>
            <td>Asal dari </td><td>
                <?php echo form_dropdown('supplier_number',$warehouse_list,$supplier_number,'id=supplier_number');?></td>
       </tr>
       <tr>
            <td>Keterangan</td><td colspan='4'><?php echo form_input('comments',$comments,'id=comments style="width:400px"');?></td>
       </tr>
       <tr>
           <td>
               <?php 
                    echo form_hidden('ref1',$ref1,"id=ref1"); 
              ?>    
           </td>
       </tr>
   </table>
	<div id='divItem' class='box-gradient' >
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
					<th data-options="field:'cost',width:50,align:'left',editor:'text'">Cost</th>
					<th data-options="field:'total_amount',width:50,align:'left',editor:'text'">Total</th>
                    <th data-options="field:'ref1',width:50,align:'left',editor:'text'">Ref#</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	</div>	

</div>
   

<?php 

    echo '<div id="tb">';
        echo link_button("Add Item",'addItem()',"add","false"); 
        echo link_button("Del Item",'delItem()',"remove","false"); 
        echo link_button("Edit Item",'editItem()',"edit","false"); 
        echo link_button("Add SJ# Gudang",'recv_no()',"add","false"); 
    echo '</div>'; 

    echo $lookup_do_gudang;
    echo load_view('inventory/input_qty'); 
    echo load_view("inventory/select_unit");
    echo load_view("inventory/inventory_select_checkbox");
    echo load_view("inventory/inventory_select");
    
?>


 <script language='javascript'>
 
 	var _grid = "dg";
	var _url  =  CI_ROOT+'receive_toko';
	
  $().ready(function (){
        load_items();
    });
    function simpan(){
        if (!valid()) return false;
        var _param=get_input_values();
        $.ajax({
            type: "POST",
            url: _url+"/save",
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
	function cetak(){
		nomor=$("#shipment_id").val();
		window.open(_url+'/print_bukti/'+nomor,'_blank');
	}
	function delete_delivery()
	{
        if(!valid())return false;
        var  nomor=$("#shipment_id").val();
        $.messager.confirm('Confirm','Are you sure you want to remove this?',
            function(r){
                if (r){
        $.ajax({
                type: "GET",
                url: _url+'/delete/'+nomor,
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
            })

	
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
    function addItemAll(){
        var mode=$('#mode').val();
        if(mode=="add"){
            alert("Simpan dulu sebelum tambah item barang !");
            return false;
        }
        //$('#dlgSearchItemIsc').window({left:10,top:window.event.clientY*0.5});
        $("#dlgSearchItemIsc").dialog("open").dialog('setTitle','Pilih barang');
    }
    function show_input_item(){
        //$('#dgItemForm').window({left:10,top:window.event.clientY-50});
        $("#dgItemForm").dialog("open").dialog('setTitle','Input barang');
    }    
    function close_item(){
        clear_input();
        $("#dgItemForm").dialog("close");   
    }
    function findxxxxx(){
        xurl=CI_ROOT+'inventory/find/'+$('#item_number').val();
        console.log(xurl);
        $.ajax({
                    type: "GET",
                    url: xurl,
                    data:'item_no='+$('#item_number').val(),
                    success: function(msg){
                        var obj=jQuery.parseJSON(msg);
                        $('#item_number').val(obj.item_number);
                        $('#unit').val(obj.unit_of_measure);
                        $('#description').val(obj.description);
                    },
                    error: function(msg){alert(msg);}
        });
    };
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
            id:$("#id").val()};
       return _param; 
    }
    
    function save_item(){
        if (!valid()) return false;
        var _param=get_input_values();
        $.ajax({
            type: "POST",
            url: _url+"/save_item",
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
    function clear_input(){
        $('#item_number').val('');
        $('#description').val('');
        $('#line_number').val('');
        $('#quantity').val(1);
        $("#unit").val("Pcs");
        $("#id").val("");
    }
    function load_items(){
        var nomor=$('#shipment_id').val();
        $('#dg').datagrid({url: _url+'/items/'+nomor});
    }
    function delItem(){
        var nomor=$('#shipment_id').val();
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
                if (r){
                    url=_url+'/delete_item/'+row.line_number;
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
        show_input_item();
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#item_number').val(row.item_number);
            $('#description').val(row.description);
            $('#quantity').val(row.quantity);
            $('#unit').val(row.unit);
            $('#id').val(row.line_number);
        }
    }
	function recv_no(){
        if (!valid()) return false;
        
		search_id=$('#dlgdo_gudang_search_id').val();
		from_gudang=$("#supplier_number").val();
		to_gudang=$("#warehouse_code").val();
        from="";
        to="";
        
        
        var vUrl=CI_ROOT+'receive_toko/sj_from_gudang/'+from_gudang+'/'+to_gudang;
		$('#dgdo_gudang').datagrid({url:vUrl});

		idd_do_gudang="do_gudang";
        $("#dlgdo_gudang_search_id").focus();		
        $('#dlgdo_gudang').window({left:100,top:50});  
		$('#dlgdo_gudang').dialog('open').dialog('setTitle','Daftar Pilihan [do_gudang]');
        
	}
	function dlgdo_gudang_search(){
		recv_no();
	}
	function dlgdo_gudang_select(){
		
	}
	
	    
    function add_sj_item(nomor){
    	loading();
        target=$("#shipment_id").val();
        gudang=$("#warehouse_code").val();
        supplier=$("#supplier_number").val();
        $.ajax({
            type: "GET",url: _url+"/add_item_with_recv_no/"+target+'/'+nomor+'/'+gudang+'/'+supplier,
            success: function(result){
                var result = eval('('+result+')');
                if (result.success) {
                	loading_close();
                    $("#shipment_id").val(result.shipment_id);
                    load_items();
                    
                }
            },
            error: function(msg){loading_close();log_err(msg);}
        });
    }
</script>
