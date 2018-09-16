<div class="thumbnail box-gradient">
	<?php
   $min_date=$this->session->userdata("min_date","");
	
	
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/sales_retur/add');		
	echo link_button('Search','','search','false',base_url().'index.php/sales_retur');		
	if($mode=="view")echo link_button('Refresh','','reload','false',base_url().'index.php/sales_retur/view/'.$invoice_number);		
	if($mode=="view")echo link_button('Delete','','cut','false',base_url().'index.php/sales_retur/delete/'.$invoice_number);		
	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/sales_retur/unposting/'.$invoice_number);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/sales_retur/posting/'.$invoice_number);		
	}
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'sales_retur\')','help');		
	
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('sales_retur')">Help</div>
		<div onclick="show_syslog('sales_retur','<?=$invoice_number?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
		<?=link_button('Close', 'remove_tab_parent()','cancel');?>		
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

<div class="easyui-tabs"  >
	<div id='divGeneral' title='General'>
	<form id="myform"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		<table class='table2' width='100%'>
	    <tr>
			<td>Nomor</td>
	        <td>  			
	            <?php 
	            	echo form_input('invoice_number',$invoice_number,'id=invoice_number');
	            ?>
	        </td>
			<td rowspan='4'>
				<div id="customer_info" name="customer_info" class='thumbnail' style='width:300px;height:100px'>
					<?=$customer_info?>
				</div>
			</td>
			        
	    </tr>
		<tr>
	     	<td>Pelanggan</td><td><?
	        echo form_input('sold_to_customer',$sold_to_customer,'id=sold_to_customer'); 
	        ?>
	        	<? if($mode=='add') { ?>
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
				onclick="dlgcustomers_show();return false;"></a>
				<? } ?>     
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
			<td>Nomor Faktur</td>
			<td><?         
				echo form_input('your_order__',$your_order__,'id=your_order__');                 
				echo link_button('', 'dlginvoice_show();return false;','search');
	         ?></td>		
		</tr>
		
	     <tr>       
	        <td>Gudang/Toko</td>
	        <td><?         
	            echo form_input('warehouse_code',$warehouse_code,"id='warehouse_code'");                 
	            echo link_button("","dlgwarehouse_show()","search");
	        ?>
	         
	         </td>      
	        
	        </tr>
		
	     <tr>
	    <tr>
	         <td>Salesman</td><td><?php
	            echo form_input('salesman',$salesman,"id='salesman'");                 
	            echo link_button("","dlgsalesman_show()","search");
	                 
	        ?></td> 
	        <td>Termin <?php
	            echo form_input('payment_terms',$payment_terms,"id='payment_terms'");                 
	            echo link_button("","dlgtype_of_payment_show()","search");
	        ?></td>     
	    </tr>
	    
	             
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
					   plain='true' title='Hitung ulang' onclick='hitung_jumlah();return false'></a>
					
				</td>
			</tr>
		</table>		
	</div>
			
	</form>
	</div>
	<div id='divItem' title='Items'>
		<div id='dgItem'><? include_once "invoice_add_item_simple.php"; ?></div>
		
		<table id="dg" class="easyui-datagrid"  width='1200'
			data-options="
				iconCls: 'icon-edit', fitColumns: true, 
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/invoice/items/<?=$invoice_number?>/json'
			">
			<thead>
				<tr>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
						<th data-options="field:'price',width:60,align:'right',editor:'numberbox',
							formatter: function(value,row,index){
								return number_format(value,2,'.',',');}">Price</th>
					<th data-options="field:'discount',width:50,editor:'numberbox'">Disc%</th>
						<th data-options="field:'amount',width:60,align:'right',editor:'numberbox',
							formatter: function(value,row,index){
								return number_format(value,2,'.',',');}">Jumlah</th>
					<th data-options="field:'account',align:'left'">Account</th>
					<th data-options="field:'account_description',align:'left'">Account Description</th>
					<th data-options="field:'cost',width:60,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Cost</th>
					<th data-options="field:'mu_qty',align:'right',editor:{type:'numberbox',options:{precision:2}}">M Qty</th>
					<th data-options="field:'multi_unit',align:'left',editor:'text'">M Unit</th>
								
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	</div>
<!-- JURNAL -->
	<div title="Jurnal">
		<div id='divJurnal' class='thumbnail'>
		<table id="dgCrdb" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit',width: '100%',fitColumns: true, 
				singleSelect: true,toolbar:'',
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
			
	</div>	
</div>

	
	
<?php
    echo load_view('inventory/inventory_select');
    echo $lookup_gudang;
    echo $lookup_payment_terms;
    echo $lookup_salesman;
    echo $lookup_customer;
    echo $lookup_invoice;
?>

 <script language='javascript'>
	var url;	

    $(document).ready(function(){
    });
 
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
  		if($('#your_order__').val()==''){alert('Isi nomor faktur yang diretur !');return false;}
		url='<?=base_url()?>index.php/sales_retur/save';
			$('#myform').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
					    var url=CI_ROOT+"/sales_retur/view/"+result.invoice_number;
					    window.open(url,"_self");
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang');
					} else {
						log_err(result.msg);
					}
				}
			});
  	}
  	function print(){
            txtNo='<?=$invoice_number?>'; 
            window.open("<?=base_url().'index.php/sales_retur/print_bukti/'?>"+txtNo,"new");  		
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
                },
                error: function(msg){alert(msg);}
		    });
			
		}
		function searchItem()
		{
			var faktur=$('#your_order__').val();
			if(faktur==""){alert("Pilih nomor faktur yang akan diretur !");return false;}
			
			$('#dlgSearchItem').dialog('open').dialog('setTitle','Cari data barang atas nomor faktur');
			xurl='<?=base_url()?>index.php/invoice/list_item/'+faktur;
			$('#dgItemSearch').datagrid({url:xurl});
		
		}

		function hitung_jumlah(){
		    url=CI_ROOT+'invoice/recalc/'+$('#invoice_number').val();
		    if($('#disc_total_percent').val()=='')$('#disc_total_percent').val(0);
		    if($('#sales_tax_percent').val()=='')$('#sales_tax_percent').val(0);
		    if($('#freight').val()=='')$('#freight').val(0);
		    if($('#others').val()=='')$('#others').val(0);
		    loading();
		    $.ajax({
                type: "GET",
                url: url,
				contentType: 'application/json; charset=utf-8',
                data:{discount:$("#disc_total_percent").val(),tax:$("#sales_tax_percent").val(),
                others:$("#others").val(),freight:$("#freight").val()}, 
                success: function(msg){
                	loading_close();
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
                error: function(msg){loading_close();log_err(msg);}
		    });
			
		}
              
      
        
 </script>
     
 </body>
</html>

