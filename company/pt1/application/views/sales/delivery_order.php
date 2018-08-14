<?php 
    $min_date=$this->session->userdata("min_date","");
$default_warehouse=$this->session->userdata("default_warehouse");
$user_admin=$this->session->userdata("user_admin");

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
if($user_admin){
	$readonly_gudang="";
}

?>
<div class="thumbnail box-gradient">
	<? 
		echo link_button('Save', 'save()','save');		
		echo link_button('Print', 'print()','print');		
		echo link_button('Add','','add','false',base_url().'index.php/delivery_order/add');		
		if($mode=="view") echo link_button('Delete','','cut','false',base_url().'index.php/delivery_order/delete/'.$invoice_number);		
		echo link_button('Search','','search','false',base_url().'index.php/delivery_order');		
		if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/delivery_order/view/'.$invoice_number);		
		echo link_button('Approve','approve()','man');		

		echo "<div style='float:right'>";
		echo link_button('Help', 'load_help(\'delivery_order\')','help');		

	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('delivery_order')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>

<div class="thumbnail">	
<form id="frmDo"  method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class='table' width='100%'>     
	<tr><td>Nomor Surat Jalan</td>
        <td>  
            <?php
             echo form_input('invoice_number',$invoice_number,"id='invoice_number'");
            		
            ?>
        </td>
     	<td>Tanggal Kirim</td><td><?         
         echo form_input('invoice_date',$invoice_date,' id="invoice_date" 
            class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required ');                 
         ?>
         </td>
    </tr>
     <tr>
	     <td>Nomor SO Ref#</td><td><?         
	        echo form_input('sales_order_number',$sales_order_number,'id=sales_order_number');?>

        	<? if($mode=='add') { ?>

			<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
			onclick="select_so_open();return false;"></a>

			<? } ?>


	     </td>
         
     </tr>
     <tr>
	     <td>Pelanggan</td><td><?
    	    echo form_input('sold_to_customer',$sold_to_customer,'id=sold_to_customer');?>
        	<? if($mode=='add') { ?>
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
			onclick="select_customer();return false;"></a>
			<? } ?>
        </td>
		
        <td rowspan="4" colspan="2" style="vertical-align: top;">
			<div id="customer_info" class="thumbnail" style="padding:10px;width:300px;height:100px">
				<?=$customer_info?>
			</div>
        </td>       
    </tr>
	 <tr><td>Gudang </td><td><? 
		if($readonly_gudang==""){
			echo form_dropdown('warehouse_code',$warehouse_list,$warehouse_code,"id='warehouse_code'");
		} else {
			echo form_input("warehouse_code",$warehouse_code,"id='warehouse_code' $readonly_gudang");
		}
	    ?></td></tr>
	 <tr><td>Tanggal Kirim</td><td><? 
	     echo form_input('due_date',$due_date,'id=due_date  class="easyui-datetimebox"  
			data-options="formatter:format_date,parser:parse_date"
			');
	    ?></td></tr>
     <tr><td>Keterangan</td><td colspan="6">
        <?   echo form_input('comments',$comments,'id=comments style="width:90%"');
		?>
		</td>
       </tr>
       
		</table>
		

		<div id='divItem' class=''>
				<table id="dgItem" class="easyui-datagrid table"
					data-options="
						iconCls: 'icon-edit',fitColumns:true, 
						singleSelect: true,
						toolbar: '#tb',
						url: '<?=base_url()?>index.php/delivery_order/items/<?=$invoice_number?>/json'
					">
					<thead>
						<tr>
							<th data-options="field:'item_number',width:80">Kode Barang</th>
							<th data-options="field:'description',width:200">Nama Barang</th>
							<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
							<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
							<th data-options="field:'line_number',width:30,align:'right'">Line</th>
						</tr>
					</thead>
				</table>
		</div>
	   </form>
</div> 
    
<div id="tb">
<?php 

	echo load_view("sales/do_item_input",array("show_tool"=>false));

	echo link_button('Delete','dgItem_delete();return false;','remove');
	echo link_button('Alloc','dgItem_alloc();return false;','add');
	echo link_button('Refresh','dgItem_refresh();return false;','reload');


?>
</div>
<div id='dlgSelectSo'class="easyui-dialog" style="width:600px;height:380px;
padding:10px 20px;left:100px;top:20px"
     closed="true" toolbar="#button-select-so">
     <div id='divSelectSoResult'> 
		<table id="dgSelectSo" class="easyui-datagrid"  width='100%'
			data-options="
				toolbar: '',fixColumns: true,
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'sales_order_number',width:80">SO Number</th>
					<th data-options="field:'sold_to_customer',width:80">Kode Pelanggan</th>
					<th data-options="field:'company',width:180">Nama Pelanggan</th>
					<th data-options="field:'sales_date',width:80">Tanggal SO</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="button-select-so" class='box-gradient'>
	Enter Text: <input  id="search_so" style='width:180' name="search_so">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="select_so_open();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="selected_so_number();return false;">Select</a>
</div>


<?
	include_once 'customer_select.php';
	echo load_view('inventory/inventory_select');
?>

 <script language='javascript'>
	var allow_add=<?=$allow_add?>;
	var allow_edit=<?=$allow_edit?>;
	var allow_delete=<?=$allow_delete?>;
	var allow_print=<?=$allow_print?>;
	var allow_posting=<?=$allow_posting?>;
	var allow_approve=<?=$allow_approve?>;
 
  	function save(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#invoice_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
  	    
  		if($('#invoice_number').val()==''){alert('Isi nomor bukti !');return false;}
  		if($('#sold_to_customer').val()==''){alert('Isi pelanggan !');return false;}
		url='<?=base_url()?>index.php/delivery_order/save';
			$('#frmDo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#invoice_number').val(result.invoice_number);
						var nomor=$('#invoice_number').val();
						$('#mode').val('view');
						window.open("<?=base_url()?>index.php/delivery_order/view/"+nomor,"_self");  		
						
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
  	}
  	function print(){
            txtNo='<?=$invoice_number?>'; 
            window.open("<?=base_url().'index.php/delivery_order/print_faktur/'?>"+txtNo,"new");  		
  	}
  	function recalc(){
            txtNo='<?=$invoice_number?>';     
            $.ajax({
                type : 'GET',
                url : '<?=base_url();?>index.php/delivery_order/sum_info',
                data: 'nomor='+txtNo,
                success: function (data) {                
                    $("#divPayment").html(data);
                }
            })
  		
  	}
	    /*
   function append()
    {
        var param="invoice_number=<?=$invoice_number?>";
        var xurl='<?=base_url()?>index.php/delivery_order/add_item';
        $.ajax({
                    type: "GET",
                    url: xurl,
                    data: param,
                    success: function(msg){
                        $('#dlgItem').dialog({  
                           title: 'Pilih Nama Barang',  
                           width: 400,height: 400,  closed: false, cache: false,
                           modal: true,
                            buttons: [{
                                            text:'Ok',
                                            iconCls:'icon-ok',
                                            handler:function(){
                                               void save_item();
                                               void refresh_items();
                                               $('#dlgItem').dialog('close');
                                            }
                                    },{
                                            text:'Cancel',
                                            iconCls:'icon-cancel',
                                            handler:function(){
                                                $('#dlgItem').dialog('close');
                                            }
                                    }],

                           modal: true  
                       });
                        $('#divItem').html(msg);
                    },
                    error: function(msg){
                        alert(msg);
                    }
            }); 
         

          

     }
  function remove_item(){
            row = $('#dg').datagrid('getSelected');
            if (row){
                xurl=CI_ROOT+'delivery_order/delete_item/'+row['line_number'];                             
                console.log(xurl);
                xparam='';
                $.ajax({
                    type: "GET",
                    url: xurl,
                    param: xparam,
                    success: function(msg){
                        void refresh_items();
                    },
                    error: function(msg){$.messager.alert('Info',msg);}
                });         
			}
     }
     function refresh_items(){
         param="";
         get_this('<?=base_url()?>index.php/delivery_order/view_detail/<?=$invoice_number?>'
         ,param,'dgItem');
         return false;
     }   
      function save_item(){
        var url="<?=base_url()?>index.php/delivery_order/save_item";
        var param=$('#frmItem').serialize();
        void post_this(url,param,'message');
        void refresh_items();
      }      */

//-- search open sales order number 
	function load_so(nomor_so){
         get_this('<?=base_url()?>index.php/sales_order/list_item_delivery/'+nomor_so,'','divItem');					
	}
	function selected_so_number(){
		var row = $('#dgSelectSo').datagrid('getSelected');
		if (row){
			$('#sales_order_number').val(row.sales_order_number);
			$('#sold_to_customer').val(row.sold_to_customer);
			
			
			$('#dlgSelectSo').dialog('close');

			get_this(CI_BASE+"index.php/customer/info/"+row.sold_to_customer,null,"customer_info");
			
			load_so($('#sales_order_number').val());
			
			
		} else {
			alert("Pilih salah satu nomor SO !");
		}
	}
	
	function select_so_open(){
			search_so=$('#search_so').val();
			cust=$('#sold_to_customer').val();
			$('#dlgSelectSo').dialog('open').dialog('setTitle','Cari nomor sales order');
			$('#dgSelectSo').datagrid({url:'<?=base_url()?>index.php/sales_order/select_so_open/'+search_so+'/'+cust});
			$('#dgSelectSo').datagrid('reload');
	};
	function dgItem_refresh()
	{
		$("#dgItem").datagrid("reload");
	};
	function dgItem_edit()
	{
		alert('edit');
	}
	function dgItem_alloc()
	{
		var row = $('#dgItem').datagrid('getSelected');
		if (row){
			var url=CI_ROOT+"delivery_order/alloc_item_line/"+row.line_number;
			add_tab_parent("alloc_"+row.line_number,url);
		}
	};
	function dgItem_delete()
	{
		var row = $('#dgItem').datagrid('getSelected');
		if (row){
			var url=CI_ROOT+"delivery_order/alloc_item_line_delete/"+row.line_number;
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					$.post(url,{line_number:row.line_number},function(result){
						if (result.success){
							$("#dgItem").datagrid("reload");
						} else {
							$.messager.show({	// show error message
								title: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	};
	function dgItem_add()
	{
		 
	}
	
		function hitung_jumlah(){
		    url=CI_ROOT+'invoice/recalc/'+$('#invoice_number').val();
		    if($('#disc_total_percent').val()=='')$('#disc_total_percent').val(0);
		    if($('#sales_tax_percent').val()=='')$('#sales_tax_percent').val(0);
		    if($('#freight').val()=='')$('#freight').val(0);
		    if($('#others').val()=='')$('#others').val(0);
		    $.ajax({
                type: "GET",
                url: url,
				contentType: 'application/json; charset=utf-8',
                data:{discount:$("#disc_total_percent").val(),tax:$("#sales_tax_percent").val(),
                others:$("#others").val(),freight:$("#freight").val()}, 
                success: function(msg){
                    var obj=jQuery.parseJSON(msg);
                    $('#sub_total').val(obj.sub_total);
                    $('#total').val(obj.amount);
                    $('#total_retur').val(obj.retur);
                    $('#total_crdb').val(obj.crdb);
                    $('#total_payment').val(obj.payment);
                    $('#saldo').val(obj.saldo);
                    $('#disc_amount_1').val(obj.disc_amount_1);
                    $('#tax').val(obj.tax);
					
                },
                error: function(msg){alert(msg);}
		    });
			
		}
	function approve(){
		if(!allow_approve) {
			log_msg(ERR_ACCESS_MODULE);
			return false;
		}
		    url=CI_ROOT+'delivery_order/approve/'+$('#invoice_number').val();
		    $.ajax({type: "GET", url: url,
                success: function(msg){
					var result=eval('('+msg+')');
					if(result.success){
						log_msg(MSG_HAS_APPROVED); 
					} else {
						log_msg(result);
					}
				},
                error: function(msg){log_msg(msg);}
	    });			
	}        	
	function qty_max(qty,id){
	    var qty_input=$('#qty_id_'+id).val();
	    if(qty=="")qty=0;
	    if(qty==0)return false;
	    if(qty_input>qty){
	        alert("Quantity yang diijinkan untuk dikirim "+qty);
	        $("#qty_id_"+id).val(qty);
	        return false;
	    }
	}
 </script>
