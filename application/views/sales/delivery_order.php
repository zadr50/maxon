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
	<?php 
		echo link_button('Save', 'save()','save');		
		echo link_button('Print', 'print()','print');		
//		echo link_button('Add','','add','false',base_url().'index.php/delivery_order/add');		
		if($mode=="view") echo link_button('Delete','','cut','false',base_url().'index.php/delivery_order/delete/'.$invoice_number);		
//		echo link_button('Search','','search','false',base_url().'index.php/delivery_order');		
		if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/delivery_order/view/'.$invoice_number);		
		echo link_button('Approve','approve()','man');		

		echo "<div style='float:right'>";

	?>
		<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help('delivery_order')">Help</div>
			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
		<?=link_button('Help', 'load_help(\'delivery_order\')','help');?>		
        <?=link_button('Close','remove_tab_parent()','cancel');      ?>
	</div>
</div>

<div class="thumbnail">	
	<div class="easyui-tabs" >
		<div id="divGeneral" title="General"  style='min-height:430px'>	
	
		<form id="frmDo"  method="post">
			<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	
		<table class='table2' width='100%'>     
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
				required style="width:200px" ');                 
	         ?>
	         </td>
	    </tr>
	     <tr>
		     <td>Pelanggan</td><td><?
	    	    echo form_input('sold_to_customer',$sold_to_customer,'id=sold_to_customer');?>
	        	<? if($mode=='add') { ?>
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
				onclick="dlgcustomers_show();return false;"></a>
				<? } ?>
	        </td>
			
	        <td rowspan="2" colspan="2" style="vertical-align: top;">
				<div id="customer_info" class="thumbnail" style="padding:10px;width:300px;height:100px">
					<?=$customer_info?>
				</div>
	        </td>       
	    </tr>
		 <tr>	    
	        <td>Gudang/Toko</td>
	        <td><?         
	            echo form_input('warehouse_code',$warehouse_code,"id='warehouse_code'");                 
	            echo link_button("","dlgwarehouse_show()","search");
	        ?>
	         
	         </td>      
		    
		    </tr>
	     <tr><td>Keterangan</td><td colspan="6">
	        <?   echo form_input('comments',$comments,'id=comments style="width:90%"');
			?>
			</td>
	       </tr>
		     <tr>
			     <td>Nomor SO Ref#</td><td><?         
			        echo form_input('sales_order_number',$sales_order_number,'id=sales_order_number');?>
		
		        	<? //if($mode=='add') { ?>
		
					<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
						onclick="dlgsales_order_open_show();return false;"></a>
		
					<? //} ?>
					</br><i>*Pilih satu atau lebih nomor sales order</i>
			     </td>
		     </tr>
	       
			</table>
			
			
			<div id="divItem">
				
			</div>
	   </form>
	
	
	</div>
		<div id='divItem2' title="Items" class='' style='min-height:430px'>
			<table id="dgItem" style="min-height:400px" width="100%" class="easyui-datagrid table"
				data-options="
					iconCls: 'icon-edit',fitColumns:true, 
					singleSelect: true,
					toolbar: '#dgItem_toolbar',
					url: ''
				">
				<thead>
					<tr>
						<th data-options="field:'item_number',width:80">Kode Barang</th>
						<th data-options="field:'description',width:200">Nama Barang</th>
						<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
						<th data-options="field:'unit',width:30,align:'left',editor:'text'">Unit</th>
						<th data-options="field:'mu_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">M Qty</th>
						<th data-options="field:'multi_unit',width:30,align:'left',editor:'text'">M Unit</th>
						<th data-options="field:'no_urut',width:30,align:'right'">NoUrut</th>
						<th data-options="field:'warehouse_code',width:30,align:'right'">Gudang</th>
						<th data-options="field:'from_line_type',width:30,align:'right'">RefType</th>
						<th data-options="field:'from_line_doc',width:30,align:'right'">Ref</th>
						<th data-options="field:'line_number',width:30,align:'right'">Line</th>
					</tr>
				</thead>
			</table>
		</div>
		
	</div> <!--tab -->
	
</div> 
    
<div id="dgItem_toolbar">
<?php 
	echo link_button('Add','dgItem_add();return false;','add');
	echo link_button('Delete','dgItem_delete();return false;','remove');
	echo link_button('Alloc','dgItem_alloc();return false;','add');
	echo link_button('Refresh','dgItem_refresh();return false;','reload');
?>
</div>
<?php
	echo load_view("inventory/select_unit_jual");
	include_once "do_item_input.php";
	include_once "so_item_selected.php";
    echo $lookup_gudang;
	echo $lookup_so_open;
	echo $lookup_customers;
	echo $lookup_inventory;
?>

 <script language='javascript'>
	var allow_add=<?=$allow_add?>;
	var allow_edit=<?=$allow_edit?>;
	var allow_delete=<?=$allow_delete?>;
	var allow_print=<?=$allow_print?>;
	var allow_posting=<?=$allow_posting?>;
	var allow_approve=<?=$allow_approve?>;
 	var has_input_qty=false;
	
	$().ready(function(){
		dgItem_refresh();		
	});
	function dgItem_add(){
		var mode=$('#mode').val();
		if(mode=="add"){
			log_err("Simpan dulu sebelum tambah item barang !");
			return false;
		}
		qty_conv=0;
		dlgItem_clear();
		$("#dlgItem").dialog("open").dialog('setTitle','Input barang');
	}
	function dgItem_delete(){
		var row = $('#dgItem').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/invoice/delete_item';
					loading();
					$.post(url,{line_number:row.line_number},function(result){
						if (result.success){
							loading_close();
							dgItem_refresh();
						} else {
							loading_close();
							log_err(result.msg);
						}
					},'json');
				}
			});
		}
	}
	function dgItem_edit(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.quantity);
			$('#unit').val(row.unit);
			$('#price').val(row.price);
			$('#discount').val(row.discount);
			$('#disc_2').val(row.disc_2);
			$('#disc_3').val(row.disc_3);
			$('#amount').val(row.amount);
			$('#line_number').val(row.line_number);
			$('#so_number').val(row.so_number);
			$('#mu_qty').val(row.mu_qty);
			$('#multi_unit').val(row.multi_unit);
			$("#dlgItem").dialog("open").dialog('setTitle','Input barang');
		}
	}
	function dgItem_refresh()
	{
		var do_number=$("#invoice_number").val();
		var _url='<?=base_url()?>index.php/delivery_order/items/'+do_number;								
		$('#dgItem').datagrid({url: _url});
	};
  	function save(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#invoice_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
  	    
  		if($('#invoice_number').val()==''){log_err('Isi nomor bukti !');return false;}
  		if($('#sold_to_customer').val()==''){log_err('Isi pelanggan !');return false;}
		if($('#warehouse_code').val()==''){
			log_err("Isi kode gudang !");
			return false;
		}
		
		url='<?=base_url()?>index.php/delivery_order/save';
		$('#frmDo').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					loading_close();
					$('#invoice_number').val(result.invoice_number);
					var nomor=$('#invoice_number').val();
					$('#mode').val('view');
					window.open("<?=base_url()?>index.php/delivery_order/view/"+nomor,"_self");  								
				} else {
					loading_close();
					log_err(result.msg);
				}
			}
		});
  	}
  	function print(){
      	var txtNo=$("#invoice_number").val(); 
        window.open("<?=base_url().'index.php/delivery_order/print_faktur/'?>"+txtNo,"new");  		
  	}
  	function recalc(){
        var   txtNo=$("#invoice_number").val();     
        $.ajax({
            type : 'GET',
            url : '<?=base_url();?>index.php/delivery_order/sum_info',
            data: 'nomor='+txtNo,
            success: function (data) {                
                $("#divPayment").html(data);
            }
        })  		
  	}
    function cek_this(i,qty){
        if($("#qty_id_"+i).val()==""){
            $("#qty_id_"+i).val(qty);            
        } else {
            $("#qty_id_"+i).val("");        
        }
    }
	function load_so_old(nomor_so){
         get_this('<?=base_url()?>index.php/sales_order/list_item_delivery/'+nomor_so,'','divItem');					
	}
	function load_so(nomor_so){
			$('#dlgSoItems').dialog('open').dialog('setTitle','Pilih barang dari SO terpilih');
			$('#dgSoItems').datagrid({url:'<?=base_url()?>index.php/sales_order/list_item_for_do/'+nomor_so});
		
	}
	function selected_so_number2(so){
		var cust=$("#sold_to_customer").val();		
		get_this(CI_BASE+"index.php/customer/info/"+cust,null,"customer_info");			
		load_so(so);
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
			log_err("Pilih salah satu nomor SO !");
		}
	}
	function select_so_open(){
			var search_so=$('#search_so').val();
			var cust=$('#sold_to_customer').val();
			$('#dlgSelectSo').dialog('open').dialog('setTitle','Cari nomor sales order');
			$('#dgSelectSo').datagrid({url:'<?=base_url()?>index.php/sales_order/select_so_open/'+search_so+'/'+cust});
	};
	function dgItem_alloc()
	{
		var row = $('#dgItem').datagrid('getSelected');
		if (row){
			var url=CI_ROOT+"delivery_order/alloc_item_line/"+row.line_number;
			add_tab_parent("alloc_"+row.line_number,url);
		}
	};
	function dgItemAlloc_delete()
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
							log_err(result.msg);
						}
					},'json');
				}
			});
		}
	};
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
	    loading();
	    $.ajax({type: "GET", url: url,
            success: function(msg){
            	loading_close();
				var result=eval('('+msg+')');
				if(result.success){					
					log_msg(MSG_HAS_APPROVED); 
				} else {
					log_msg(result);
				}
			},
            error: function(msg){
            	loading_close();
            	log_msg(msg);
            }
    });			
	}        	
	function qty_max(qty,id){
	    var qty_input=$('#qty_id_'+id).val();
	    if(qty=="")qty=0;
	    if(qty==0)return false;
	    if(qty_input>qty){
	        log_err("Quantity yang diijinkan untuk dikirim "+qty);
	        $("#qty_id_"+id).val(qty);
	        return false;
	    }
	}
	function find(){
			var cust_type=$('#cust_type').val();			 
			var item=$("#item_number").val();
			if( item=="" || item=="undefined")return false;
			var cust_no=$("#sold_to_customer").val();
		    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val()+'/'+cust_type ;
			var param={item_no:item,cust_type:cust_type,cust_no:cust_no};
			
			loading();
			
		    $.ajax({
				type: "GET",
				url: xurl,
				data: param,
				success: function(msg){
					var obj=jQuery.parseJSON(msg);
					$('#item_number').val(obj.item_number);
					$('#price').val(obj.retail);
					$('#cost').val(obj.cost);
					$('#unit').val(obj.unit_of_measure);
					$('#description').val(obj.description);
					$("#discount").val(obj.discount);
					if(obj.discount==0) $("#discount").val(obj.disc_prc_1);
					$("#disc_2").val(obj.disc_prc_2);
					$("#disc_3").val(obj.disc_prc_3);
					if(obj.multiple_pricing){
						$("#cmdLovUnit").show();
						$("#divMultiUnit").show();
					} else {
						$("#cmdLovUnit").hide();
						$("#divMultiUnit").hide();
					}
					$("#quantity").val("1");

					loading_close();
					
					hitung();
				},
				error: function(msg){
					loading_close();
					log_err(msg);
				}
		    });
		};	
 </script>
