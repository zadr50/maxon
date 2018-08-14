 
<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	if($posted=="")$posted=0;
	if($closed=="")$closed=0;
	if(!isset($has_payment))$has_payment=false;
	if($has_payment=="")$has_payment=0;
	if(!isset($has_retur))$has_retur=false;
	if($has_retur=="")$has_retur=0;
	if(!isset($has_memo))$has_memo=false;
	if($has_memo=="")$has_memo=0;
	 
	echo link_button('Save', 'save_po()','save');		
	echo link_button('Print', 'print_faktur()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/purchase_invoice/add');		
	echo link_button('Search','','search','false',base_url().'index.php/purchase_invoice');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/purchase_invoice/view/'.$purchase_order_number);		
	echo link_button('Delete', 'delete_nomor()','cut');
	
	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/purchase_invoice/unposting/'.$purchase_order_number);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/purchase_invoice/posting/'.$purchase_order_number);		
	}
	echo "<div style='float:right'>";
	echo link_button('Doc Receive', 'select_receive();return false;','search');
?>
	 
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('purchase_invoice')">Help</div>
		<div onclick="show_syslog('purchase_invoice','<?=$purchase_order_number?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div> 
	
</div>
<div class="thumbnail">	
	<form id='frmPo' method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table" width="100%">
	<tr>
		<td>Nomor Faktur</td><td>
		<?php echo form_input('purchase_order_number',
                        $purchase_order_number,"id=purchase_order_number"); ?>
                </td>
			
			<td rowspan='3' colspan='3'><div class='thumbnail' style='min-height:100px'>Nama Supplier : <br><?=$supplier_info?></div></td>				
				
        </tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('po_date',$po_date,'id=po_date   class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required');?>
            </td>

        </tr>	 
       <tr>
            <td>Supplier</td><td><?php 
            
            echo form_input('supplier_number',$supplier_number,
            "id=supplier_number class='easyui-validatebox' data-options='required:true,
			validType:length[3,30]'");
			echo link_button('','select_supplier()',"search","true"); 
			   
			?>
            </td>
            
        </tr>	 
       <tr>
            <td>Termin</td><td><?php echo form_dropdown('terms'
                    ,$terms_list,$terms,"id=terms");?>
            </td>

             <td>Jangka Waktu</td>
            <td><?=form_input('due_date',$po_date,'id=due_date  class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required');?></td>
       </tr>
       <tr>
            <td>Keterangan</td><td colspan="3"><?php echo form_input('comments'
                    ,$comments,'id=comments style="width:300px"');?></td>
       </tr>	  
   </table>



  </form>

<div class="easyui-tabs" >
	<div title="Items" style="padding:5px">
		<!-- PURCASE_ORDER_LINEITEMS -->	
		<div id='divItem'>
		<div id='dgItem'>
			<? if(!$posted) include_once "purchase_invoice_items.php"; ?>
		</div>
		<table id="dg" class="easyui-datagrid table"  width="100%"
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/purchase_order/items/<?=$purchase_order_number?>/json'
			">
			<thead>
				<tr>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
					<th data-options="field:'price',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Harga</th>
					<th data-options="field:'discount',width:50,editor:'numberbox'">Disc%</th>
					<th data-options="field:'disc_2',width:50,editor:'numberbox'">Disc%2</th>
					<th data-options="field:'disc_3',width:50,editor:'numberbox'">Disc%3</th>
					<th data-options="field:'total_price',width:60,align:'right',editor:'numberbox'">Jumlah</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
					<th data-options="field:'from_line_doc',width:100,align:'right'">Ref</th>
					
				</tr>
			</thead>
		</table>
	<!-- END PURCHASE_ORDER_LINEITEMS -->
		<h5>TOTAL</H5>
		<div id='divTotal'> 
			<table class="table" width="100%">
				<tr>
					<td>Sub Total: </td><td><input id='sub_total' value='<?=$subtotal?>' style='width:100px'></td>				
					<td>Discount %: </td><td><input id='disc_total_percent' value='<?=$discount?>' style='width:50px'></td>
					<td>Pajak PPN %: </td><td><input id='po_tax_percent' value='<?=$tax?>' style='width:50px'></td>
				</tr>
				<tr>
					<td>Ongkos Angkut: </td><td><input id='freight' value='<?=$freight?>' style='width:80px'></td>
					<td>Biaya Lain: </td><td><input id='others' value='<?=$other?>' style='width:80px'></td>
					<td>JUMLAH: </td><td><input id='total' value='<?=$amount?>' style='width:100px'>
						 <a id='divHitung' href="#" class="easyui-linkbutton" data-options="iconCls:'icon-sum'"  
						   plain='true' title='Hitung ulang' onclick='hitung_jumlah()'></a>             		
					</td>
				</tr>
			</table>		
		</div>
	</div>		
	</div>

<!-- PAYMENTS -->
	<div id='tbPay'>
		<?=link_button('Delete','delete_payment()','remove');?>
	</div>
	<DIV title="Payments" style="padding:10px">
		
		<table id="dgPay" class="easyui-datagrid"  width="100%"
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true, toolbar: '#tbPay',
				url: '<?=base_url()?>index.php/purchase_invoice/list_payment/<?=$purchase_order_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'no_bukti',width:80">Nomor</th>
					<th data-options="field:'date_paid',width:150">Tanggal Bayar</th>
					<th data-options="field:'how_paid',width:50,align:'left',editor:'text'">Jenis</th>
					<th data-options="field:'amount_paid',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Jumlah</th>
				</tr>
			</thead>
		</table>
	
	</DIV>
	
<!-- RETURN -->
	<div id='tbRetur'>
		<?=link_button('Delete','delete_retur()','remove');?>
	</div>
	<DIV title="Retur" style="padding:10px">
	
		<table id="dgRetur" class="easyui-datagrid"  
			style="width:700px;min-height:700px"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,toolbar: '#tbRetur',
				url: '<?=base_url()?>index.php/purchase_invoice/list_retur/<?=$purchase_order_number?>'
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

<!-- MEMO -->
	<div id='tbCrdb'>
		<?=link_button('Delete','delete_crdb()','remove');?>
	</div>
	<DIV title="Memo" style="padding:10px">
	
		<table id="dgCrdb" class="easyui-datagrid"  
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true,toolbar:'#tbCrdb',
				url: '<?=base_url()?>index.php/purchase_invoice/list_crdb/<?=$purchase_order_number?>'
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
	
	<? 
		$data['gl_id']=$purchase_order_number;
		echo load_view("gl/jurnal_view",$data); 
	?> 

<!-- SUMMARY -->
	<DIV title="Summary" style="padding:10px">
		<div id='divSum' class='thumbnail'>
		
			<?=$summary_info?>
		
		</div>
			
	</DIV>


</div>	
	
	
<? include_once 'supplier_select.php' ?>
<? include_once 'select_receive_po_supplier.php' ?>
<?php var_dump($has_payment) ?>
<script type="text/javascript">
	var url;	
	var posted=<?=$posted?>;
	var closed=<?=$closed?>;
	var has_payment=<?=$has_payment?>;
	var has_retur=<?=$has_retur?>;
	var has_memo=<?=$has_memo?>;
	
    function save_po(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#po_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        //if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

		if(posted){alert("Nomor ini sudah di jurnal tidak bisa disimpan ulang !");return false;}
		if(closed){alert("Periode sudah ditutup tidak bisa disiman ulang !");	return false;}
	
        if($('#purchase_order_number').val()==''){alert('Isi nomor purchase order !');return false;}
        if($('#supplier_number').val()==''){alert('Pilih kode supplier !');return false;}
        if($('#terms').val()==''){alert('Pilih termin !');return false;}        
		
		hitung_jumlah();
		
		url='<?=base_url()?>index.php/purchase_invoice/save';

			$('#frmPo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#divItem').show('slow');
						$('#purchase_order_number').val(result.purchase_order_number);
						var nomor=$('#purchase_order_number').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+nomor+'/json'});
						$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
		function hitung_jumlah(){
		    url=CI_ROOT+'purchase_order/sub_total/'+$('#purchase_order_number').val();
		    if($('#disc_total_percent').val()=='')$('#disc_total_percent').val(0);
		    if($('#po_tax_percent').val()=='')$('#po_tax_percent').val(0);
		    if($('#freight').val()=='')$('#freight').val(0);
		    if($('#others').val()=='')$('#others').val(0);
		    $.ajax({
                type: "GET",
                url: url,
				contentType: 'application/json; charset=utf-8',
                data:{discount:$("#disc_total_percent").val(),tax:$("#po_tax_percent").val(),
                others:$("#others").val(),freight:$("#freight").val()}, 
                success: function(msg){
                    var obj=jQuery.parseJSON(msg);
                    $('#sub_total').val(obj.sub_total);
                    $('#total').val(obj.amount);
                },
                error: function(msg){alert(msg);}
		    });			
		}
		function print_faktur(){
			nomor=$("#purchase_order_number").val();
			url="<?=base_url()?>index.php/purchase_invoice/print_faktur/"+nomor;
			window.open(url,'_blank');
		}
	function delete_nomor()
	{

		if(posted){alert("Nomor ini sudah di jurnal tidak bisa dihapus !");return false;}
		if(closed){alert("Periode sudah ditutup tidak bisa dihapus !");	return false;}

		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/purchase_invoice/delete/"+$('#purchase_order_number').val(),
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						window.open('<?=base_url()?>index.php/purchase_invoice','_self');
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}		
	function delete_payment() {
	
        row = $('#dgPay').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'payables_payments/delete_no_bukti/'+row['no_bukti'];                             
            console.log(xurl);xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	$('#dgPay').datagrid('reload');
                },
                error: function(msg){$.messager.alert('Info',msg);
				}
			});         
		}
	}
	
	function delete_retur() {
        row = $('#dgRetur').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'purchase_invoice/delete_retur/'+row['nomor'];                             
            console.log(xurl);xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	$('#dgRetur').datagrid('reload');
                },
                error: function(msg){$.messager.alert('Info',msg);
           }
        });         
		}
	}	
	function delete_crdb() {
        row = $('#dgCrdb').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'purchase_invoice/delete_crdb/'+row['nomor'];                             
            console.log(xurl);xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	$('#dgCrdb').datagrid('reload');
                },
                error: function(msg){$.messager.alert('Info',msg);
           }
        });         
		}
	}
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/purchase_invoice");
	}



 
</script>
    
