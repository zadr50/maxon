<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/invoice/add');		
	echo link_button('Search','','search','false',base_url().'index.php/invoice');		
	if($mode=="view") echo link_button('Delete','','cut','false',base_url().'index.php/invoice/delete/'.$invoice_number);		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/invoice/view/'.$invoice_number);		

	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/invoice/unposting/'.$invoice_number);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/invoice/posting/'.$invoice_number);		
	}
	?>
    <div style='float:right'>
	<?php 
	   echo link_button('Help', 'load_help(\'invoice\')','help');			
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('invoice')">Help</div>
		<div onclick="show_syslog('invoice','<?=$invoice_number?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
 

<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<h4>Terjadi Kesalahan!</h4> 
	<?php echo validation_errors(); ?>
	</div>
<?php } ?>
 <?php if($message!="") { ?>
<div class="alert alert-success"><? echo $message;?></div>
<? } ?>

<div class="easyui-tabs" >
    <div id='divGeneral' title='General'>

    <form id="frmInvoice"  method="post">
    <input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
    <input type='hidden' id='cust_type' value='<?=$cust_type?>'>
    <table class='table2' width='100%'>
    <tr>
     	<td>Pelanggan</td><td><?
        echo form_input('sold_to_customer',$sold_to_customer,'id=sold_to_customer'); 
        ?>
        	<? if($mode=='add') { ?>
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
			onclick="select_customer()"></a>
			<? } ?>     
		</td>
		<td rowspan="3" colspan='6'>
				<div class="thumbnail" id="customer_info" style="width:300px;height:100px"><?=$customer_info?></div>
			</td>
	</tr>
	<tr>
		<td>Nomor</td>
        <td>  			
            <? 
            	echo form_input('invoice_number',$invoice_number,'id=invoice_number');
            ?>
        </td>
		        
    </tr>
     <tr><td>Tanggal</td><td><?         
			  echo form_input('invoice_date',$invoice_date,'id=invoice_date
             class="easyui-datetimebox" required style="width:150px"
			data-options="formatter:format_date,parser:parse_date"
			');                 
         ?></td>
	</tr>
	<tr>
		 <td>Salesman</td><td><?
			 echo form_dropdown('salesman',$salesman_list,$salesman); 
        ?></td> 
		<td>Termin</td><td><?
			echo form_dropdown('payment_terms',$payment_terms_list,$payment_terms,"id=payment_terms"); 
        ?></td>		
	</tr>
     
     	
	 
	<tr>
     	
		<td>Jatuh Tempo</td><td><? 
	     echo form_input('due_date',$due_date,'id=due_date 
             class="easyui-datetimebox" required style="width:150px"
			data-options="formatter:format_date,parser:parse_date"
			');
	    ?></td>
		
		<td>Nomor Surat Jalan</td>
		<td><?         
			echo form_input('sales_order_number',$sales_order_number,'id=sales_order_number');                 
			echo link_button("","select_do_open()","search");
		?>
		 
		 </td>		
	</tr>
     <tr>
		<td>Keterangan</td><td colspan="6">
			<?
         echo form_input('comments',$comments,'id=comments style="width:90%"');
		 	?>
		</td>
    </tr>
	</table>	
	<div id='divTotal' class='thumbnail'> 
		<table class='table2' width='100%'>
			<tr>
				<td>Sub Total: </td><td><input id='sub_total' value='<?=number_format($subtotal)?>' style='width:100px'></td>				
				<td>Discount %: </td><td><input id='disc_total_percent' name='discount' 
					value='<?=$discount?>' style='width:50px'>
				</td>
				<td>Disc Amount:</td>
				<td>
					<input id='disc_amount_1' name='disc_amount_1'
					value='<?=number_format($disc_amount_1)?>' style='width:100px'>
				</td>
			</tr>
			<tr>
				<td>Ongkos Angkut: </td><td><input id='freight' name='freight' value='<?=$freight?>' style='width:80px'></td>
				<td>Pajak PPN %: </td><td><input id='sales_tax_percent' name='sales_tax_percent'
					value='<?=$sales_tax_percent?>' style='width:50px'>
				</td>
				<td>Tax Amount:</td>
				<td>
					<input id='tax' name='tax'
					value='<?=number_format($tax)?>' style='width:100px'>
				</td>

			</tr>
			<tr>
				<td>Biaya Lain: </td><td><input id='other' name='other' value='<?=number_format($other)?>' style='width:80px'></td>
				<td>&nbsp</td><td>&nbsp</td>
				<td>JUMLAH: </td><td><input id='total' name='amount' value='<?=number_format($amount)?>' style='width:100px;'>
					 <a id='divHitung' href="#" class="easyui-linkbutton" data-options="iconCls:'icon-sum'"  
					   plain='true' title='Hitung ulang' onclick='hitung_jumlah()'></a>
					
				</td>
			</tr>
		</table>		
	</div>

				
    </form>
    
    </div>
    
    <div id='divItem' title='Items'>
		<div id='dgItem'>
			<? include_once "invoice_add_item_simple.php"; ?>
		</div>
		
		<table id="dg" class="easyui-datagrid"  width='100%'			 
			data-options="iconCls: 'icon-edit', fitColumns: true, 
				singleSelect: true,	toolbar: '#tb',
				url: '<?=base_url()?>index.php/invoice/items/<?=$invoice_number?>/json'"
				
			>
			<thead>
				<tr>
					<th data-options="field:'item_number'">Kode Barang</th>
					<th data-options="field:'description',width:200">Nama Barang</th>
					<th data-options="field:'quantity',align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',align:'left',editor:'text'">Satuan</th>
					<th data-options="field:'price',width:60,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Harga</th>

					<th data-options="field:'discount',editor:'numberbox'">Disc1%</th>
					<th data-options="field:'disc_2',editor:'numberbox'">Disc2%</th>
					<th data-options="field:'disc_3',editor:'numberbox'">Disc3%</th>
					<th data-options="field:'amount',width:60,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Jumlah</th>
<!--
					<th data-options="field:'account',align:'left'">Account</th>
					<th data-options="field:'account_description',align:'left'">Account Description</th>
					<th data-options="field:'cost',width:60,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Cost</th>
-->							
					<th data-options="field:'line_number',align:'right'">Line</th>
				</tr>
			</thead>
		</table>
		
			
		
	</div>

	<div id='divPay' title='Payments'>
	    
	<?php
		include_once "payment_list.php";
	?>
	</div>
	<div id='divRetur' title='Retur'>
		<table id="dgRetur" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit', fitColumns: true, 
				singleSelect: true,
				toolbar: '',
				url: '<?=base_url()?>index.php/invoice/retur/<?=$invoice_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'invoice_number',width:80">Nomor Bukti</th>
					<th data-options="field:'invoice_date',width:80">Tanggal Retur</th>
					<th data-options="field:'item_number',width:80">Item</th>
					<th data-options="field:'description',width:80">Description</th>
					<th data-options="field:'quantity',width:80">Quantity</th>
					<th data-options="field:'unit',width:80">Unit</th>
					<th data-options="field:'price',width:80">Price</th>
					<th data-options="field:'amount',width:80">Amount</th>
				</tr>
			</thead>
		</table>
	</div>
<!-- MEMO -->
	<div id='tbCrdb'>
		<?=link_button('Delete','delete_crdb()','remove');?>
	</div>
	<DIV title="Memo" style="padding:10px">	
		<table id="dgCrdb" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit', fitColumns: true, 
				singleSelect: true,toolbar:'#tbCrdb',
				url: '<?=base_url()?>index.php/invoice/list_crdb/<?=$invoice_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'nomor',width:80">Nomor</th>
					<th data-options="field:'tanggal',width:150">Tanggal</th>
					<th data-options="field:'amount',width:150">Jumlah</th>
				</tr>
			</thead>
		</table>
	
	</DIV>
	
<!-- JURNAL -->
	<DIV title="Jurnal" style="padding:10px">
		<div id='divJurnal' class='thumbnail'>
		<table id="dgCrdb" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit', fitColumns: true,
				singleSelect: true,toolbar:'#tbCrdb',
				url: '<?=base_url()?>index.php/jurnal/items/<?=$invoice_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'account',width:80">Akun</th>
					<th data-options="field:'account_description',width:150">Nama Akun</th>
					<th data-options="field:'debit',width:80,align:'right'">Debit</th>
					<th data-options="field:'credit',width:80,align:'right'">Credit</th>
					<th data-options="field:'custsuppbank',width:50">Ref</th>
					<th data-options="field:'operation',width:50">Operasi</th>
					<th data-options="field:'source',width:50">Keterangan</th>
					<th data-options="field:'transaction_id',width:50">Id</th>
				</tr>
			</thead>
		</table>
		</div>
			
	</DIV>	
<!-- SUMMARY -->
	<DIV title="Summary" style="padding:10px">
		<div id='divSum' class='thumbnail'>		
			<?=$summary_info?>		
		</div>
			
	</DIV>
	
	
</div>
		
<?php 
include_once 'customer_select.php'; 
include_once 'delivery_select.php';
echo load_view('inventory/inventory_select');
?>

</div> 

 <script language='javascript'>
	var url;	
 
  	function save(){
  		if($('#invoice_number').val()==''){alert('Isi nomor bukti !');return false;}
  		if($('#sold_to_customer').val()==''){alert('Isi pelanggan !');return false;}
  		if($('#salesman').val()==''){alert('Isi salesman; !');return false;}
  		if($('#payment_terms').val()==''){alert('Isi termin pembayaran !');return false;}
		hitung_jumlah();
		url='<?=base_url()?>index.php/invoice/save';
			$('#frmInvoice').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#invoice_number').val(result.invoice_number);
						var invoice=$('#invoice_number').val();
						$('#mode').val('view');
						$('#divItem').show('slow');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/invoice/items/'+invoice+'/json'});
						$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang');
					} else {
						log_err(result.msg);
					}
				}
			});
  	}
  	function print(){
            txtNo='<?=$invoice_number?>'; 
            window.open("<?=base_url().'index.php/invoice/print_faktur/'?>"+txtNo,"new");  		
  	}
  	function payment(){
            txtNo='<?=$invoice_number?>';     
             
            $.ajax({
                type : 'GET',
                url : '<?=base_url();?>index.php/payment/add/'+txtNo,
                data: '',
                success: function (data) {                
                    $("#divPayment").html(data);
                }
            })
  	}
  	function recalc(){
            txtNo='<?=$invoice_number?>';     
            $.ajax({
                type : 'GET',
                url : '<?=base_url();?>index.php/invoice/sum_info',
                data: 'nomor='+txtNo,
                success: function (data) {                
                    $("#divPayment").html(data);
                }
            })
  		
  	}
		
      function addnew_retur(){
			var param="invoice_number=<?=$invoice_number?>";
	        var xurl='<?=base_url()?>index.php/sales_retur/add';
	        $.ajax({
	                type: "GET",
	                url: xurl,
	                data: param,
	                success: function(msg){
	                    $('#dlgItem').dialog({  
	                       title: 'Tambah Retur Penjualan',  
	                       width: 500,height: 400,  closed: false, cache: false,
	                       modal: true,
	                        buttons: [{
	                                        text:'Ok',
	                                        iconCls:'icon-ok',
	                                        handler:function(){
	                                           void save_retur();
	                                           void refresh_retur();
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
      function remove_retur(){
            row = $('#dgRetur').datagrid('getSelected');
            if (row){
                xurl=CI_ROOT+'sales_retur/delete/'+row['no_retur'];                             
                console.log(xurl);
                xparam='';
                $.ajax({
                    type: "GET",
                    url: xurl,
                    param: xparam,
                    success: function(msg){
                        void refresh_retur();
                    },
                    error: function(msg){$.messager.alert('Info',msg);}
                });         
			}
      }
      function refresh_retur(){
         param="";
         get_this('<?=base_url()?>index.php/invoice/retur/list/<?=$invoice_number?>'
         ,param,'divDgRetur');
         return false;
      }
      function save_retur(){
        var url="<?=base_url()?>index.php/sales_retur/save";
        var param=$('#frmAddRetur').serialize();
        void post_this(url,param,'message');
        //void refresh_retur();
        return false;
      }
      function addnew_payment(faktur){
	 
			var param="invoice_number=<?=$invoice_number?>";
	        var xurl='<?=base_url()?>index.php/payment/add_invoice';
			
			if(faktur!="")param="invoice_number="+faktur;
			
	        $.ajax({
	                type: "GET",
	                url: xurl,
	                data: param,
	                success: function(msg){
	                    $('#dlgItem').dialog({  
	                       title: 'Data Pembayaran',  
	                       width: 400,height: 400,  closed: false, cache: false,
	                       modal: true,
	                        buttons: [{
	                                        text:'Ok',
	                                        iconCls:'icon-ok',
	                                        handler:function(){
	                                           void save_payment();
	                                           void refresh_payment();
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
      function remove_payment(){
            row = $('#dgPay').datagrid('getSelected');
            if (row){
                xurl=CI_ROOT+'payment/delete/'+row['no_bukti'];                             
                console.log(xurl);
                xparam='';
                $.ajax({
                    type: "GET",
                    url: xurl,
                    param: xparam,
                    success: function(msg){
                        void refresh_payment();
                    },
                    error: function(msg){$.messager.alert('Info',msg);}
                });         
			}
      }
      function refresh_payment(){
         param="";
         get_this('<?=base_url()?>index.php/invoice/payment/list/<?=$invoice_number?>'
         ,param,'divDgPay');
         xurl='<?=base_url()?>index.php/invoice/payment/list/<?=$invoice_number?>';
      }
      function save_payment(){
        var url="<?=base_url()?>index.php/payment/save_invoice";
        var param=$('#frmAddPay').serialize();
        void post_this(url,param,'message');
        void refresh_payment();
        return false;
      }	  
      function addnew_crdb(){
			var param="invoice_number=<?=$invoice_number?>";
	        var xurl='<?=base_url()?>index.php/crdb/add';
	        $.ajax({
	                type: "GET",
	                url: xurl,
	                data: param,
	                success: function(msg){
	                    $('#dlgItem').dialog({  
	                       title: 'Data Credit/Debit Memo',  
	                       width: 400,height: 400,  closed: false, cache: false,
	                       modal: true,
	                        buttons: [{
	                                        text:'Ok',
	                                        iconCls:'icon-ok',
	                                        handler:function(){
	                                           void save_crdb();
	                                           void refresh_crdb();
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
      function remove_crdb(){
            row = $('#dgCrDb').datagrid('getSelected');
            if (row){
                xurl=CI_ROOT+'crdb/delete/'+row['kodecrdb'];                             
                console.log(xurl);
                xparam='';
                $.ajax({
                    type: "GET",
                    url: xurl,
                    param: xparam,
                    success: function(msg){
                        void refresh_crdb();
                    },
                    error: function(msg){$.messager.alert('Info',msg);}
                });         
			}
      }
      function refresh_crdb(){
         param="";
         get_this('<?=base_url()?>index.php/invoice/crdb/list/<?=$invoice_number?>'
         ,param,'divDgCrDb');
         return false;
      }
      function save_crdb(){
        var url="<?=base_url()?>index.php/crdb/save";
        var param=$('#frmAddCrDb').serialize();
        void post_this(url,param,'msglog');
        void refresh_crdb();
        return false;
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
        
 </script>