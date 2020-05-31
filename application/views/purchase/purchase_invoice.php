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
		$disabled="";$disabled_edit="";
		if(!($mode=="add" or $mode=="edit"))$disabled=" readonly";
		if($supplier_number=="")$disabled="";
		if($terms=="")$disabled="";
			 
		echo link_button('Save', 'save_po()','save');		
		echo link_button('Print', 'print_faktur()','print');	
		//	echo link_button('Add','','add','false',base_url().'index.php/purchase_invoice/add');		
		//	echo link_button('Search','','search','false',base_url().'index.php/purchase_invoice');		
		if($mode!="add"){
			echo link_button('Refresh','','reload','false',base_url().'index.php/purchase_invoice/view/'.$purchase_order_number);		
			echo link_button('Delete', 'delete_nomor()','cut');
			if($posted) {
				echo link_button('UnPosting','','cut','false',base_url().'index.php/purchase_invoice/unposting/'.$purchase_order_number);		
			} else {
				echo link_button('Posting','','ok','false',base_url().'index.php/purchase_invoice/posting/'.$purchase_order_number);		
			}
				
		}
    ?>
	<div style='float:right'>
        <?php
//    	echo link_button('Doc Receive', 'select_receive();return false;','search');
        ?>
    	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
    	<div id="mmOptions" style="width:200px;">
    		<div onclick="load_help('purchase_invoice')">Help</div>
    		<div onclick="show_syslog('purchase_invoice','<?=$purchase_order_number?>')">Log Aktifitas</div>
    		<div>Update</div>
    		<div>MaxOn Forum</div>
    		<div>About</div>
    	</div>
        <?=link_button('Help', 'load_help(\'purchase_invoice\')','help','false')?>       
        <?=link_button('Close','remove_tab_parent()','cancel')?>      
	</div> 
</div>
<div class="thumbnail">	
<div class="easyui-tabs" >
    <div title="General" style="padding:5px">
	<form id='frmPo' method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table2" width="100%">
	<tr>
		<td>Nomor Faktur</td><td width=300>
		 <?php  
		  echo form_input('purchase_order_number',
                        $purchase_order_number,"id=purchase_order_number $disabled"); 
          ?>
        </td>
			
		<td rowspan='3' colspan='2'><div class='thumbnail' style='min-height:100px'>Nama Supplier : 
			    <br><span id='supplier_name'><?=$supplier_info?></span></div>
		</td>				
				
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
			validType:length[3,30]' ".$disabled);
			if($disabled=="") {
			    echo link_button('','dlgsuppliers_show();return false;',"search","false"); 			   
                echo link_button('','dlgsuppliers_list_master();return false;',"add","false");             
            }
			?>
            </td>
            
        </tr>	 
       <tr>
            <td>Termin</td><td><?php echo form_input('terms',$terms,"id='terms' 
			     class='easyui-validatebox' data-options='required:true' ".$disabled);
			    if($disabled=="") {
			        echo link_button('','dlgterms_show();return false;',"search","false");  
                    echo link_button('','dlgterms_list_master();return false;',"add");                      
                }
			
			?></td>

             <td>Jangka Waktu</td>
            <td><?=form_input('due_date',$due_date,'id=due_date  class="easyui-datetimebox" 
    			data-options="formatter:format_date,parser:parse_date"
    			required');?></td>
       </tr>
       <tr>
           <td>Rekening#</td>
           <td><?php 
                echo form_input("rekening",$rekening,"id='rekening' 
                    title='Rencana pembayaran hutang ini memakai rekening ini'");
                echo link_button('','dlgbank_accounts_bank_show();return false;',"search","false"); 
                echo link_button('','dlgbank_accounts_bank_list_master();return false;',"add"); 
                ?>
           </td>
           <td>Proyek</td><td><?=form_input('org_id',$org_id,"id='org_id' ");?>
                <?=link_button('','dlggl_projects_show();return false;',"search","false"); ?>      
                <?=link_button('','dlggl_projects_list_master(\'project\project\');return false;',"add"); ?>      
           </td>          
           
       </tr>
       <tr>
            <td>Gudang </td><td><?=form_input("warehouse_code",$warehouse_code,"id='warehouse_code' style='width:80px'")?>
            <?=link_button('','dlgwarehouse_show()',"search","false"); ?>  
            </td>
			<td>Sistim</td><td><?=form_input('type_of_invoice',$type_of_invoice,"id='type_of_invoice' style='width:50px'");?>
				<?=link_button('','dlgtype_of_invoice_show()',"search","false"); ?>		 
			 </td>			
           
       </tr>
       <tr>
            <td>Keterangan</td><td colspan="3"><?php echo form_input('comments'
                    ,$comments,'id=comments style="width:500px"');?></td>
       </tr>	  
   </table>
    <div id='divTotal' class='thumbnail'> 
            <table class="table2" width="100%">
                <tr>
                    <td>Sub Total: </td><td><input id='sub_total' value='<?=number_format($subtotal,2)?>' style='width:100px'></td>             
                    <td>Discount %: </td><td><input id='disc_total_percent' value='<?=number_format($discount,2)?>' style='width:50px'></td>
                    <td>Pajak PPN %: </td><td><input id='po_tax_percent' value='<?=number_format($tax,2)?>' style='width:50px'></td>
                </tr>
                <tr>
                    <td>Ongkos Angkut: </td><td><input id='freight' value='<?=number_format($freight,2)?>' style='width:80px'></td>
                    <td>Biaya Lain: </td><td><input id='others' value='<?=number_format($other,2)?>' style='width:80px'>
                        
                    <?=link_button('','add_expenses()','edit'); ?>  
                        
                    </td>
                    <td>JUMLAH: </td><td><input id='total' value='<?=number_format($amount,2)?>' style='width:100px'>
                         <a id='divHitung' href="#" class="easyui-linkbutton" data-options="iconCls:'icon-sum'"  
                           plain='false' title='Hitung ulang' onclick='hitung_jumlah();return false;'></a>                     
                    </td>
                </tr>
            </table>        
        </div>


  </form>
    
    </div>
    
	<div title="Items" style="padding:5px">
		<!-- PURCASE_ORDER_LINEITEMS -->	
		<div id='divItem'>
		<div id='dgItem'>
			<? if(!$posted) include_once "purchase_invoice_items.php"; ?>
			
			
		</div>
		<div class="thumbnail">
			<p class='alert alert-info'>
				Silahkan pilih tombol dibawah ini untuk menambahkan item barang dengan nomor Receipt atau nomor PO.
			</p>
			<table class="table2" width="100%">
	       <tr>
	            <td>Nomor Recv#/Pmb#  </td><td><?php 
	                echo form_input("ref1",$ref1,"id='ref1' 
	                    title='Pilih nomor terima barang untuk menambahkan item barang dibawah'");
	                echo link_button('','select_receive()',"search","false"); 
	                ?>
	            </td>    
	           
	            <td>Nomor PO#: </td><td><?php 
	                echo form_input("po_ref",$po_ref,"id='po_ref'");
	                echo link_button('','dlgpurchase_order_show()',"search","false"); 
	                ?>
	            </td>
	       </tr>
	       <tr>
	            <td>Tarik Data Sales#</td><td> <?php 
	                echo form_input("ref2",$ref2,"id='ref2'");
	                echo link_button('','dlgsales_show()',"search","false"); 
	                ?>
	             </td>   
	       </tr>
				
			</table>
			
		</div>
		
		<table id="dg" class="easyui-datagrid table2"  width="100%"
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
                    <th data-options="<?=col_number('quantity',2)?>">Qty</th>
                    <th data-options="field:'unit',width:80">Unit</th>
                    <th data-options="<?=col_number('price',2)?>">Harga</th>
                    <th data-options="field:'discount',width:50,editor:'numberbox'">Disc%1</th>
                    <th data-options="field:'disc_2',width:50,editor:'numberbox'">Disc%2</th>
                    <th data-options="field:'disc_3',width:50,editor:'numberbox'">Disc%3</th>
                    <th data-options="<?=col_number('total_price',2)?>">Jumlah</th>
                    <th data-options="field:'mu_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">M Qty</th>
                    <th data-options="field:'multi_unit',width:80">M Unit</th>
                    <th data-options="<?=col_number('retail',2)?>">H Jual</th>
                    <th data-options="field:'margin',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Margin</th>
                    <th data-options="field:'line_number',width:30,align:'right'">Line</th>
                    <th data-options="field:'no_urut',width:30,align:'right'">No</th>
					
				</tr>
			</thead>
		</table>
	<!-- END PURCHASE_ORDER_LINEITEMS -->
		
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
                    <th data-options="<?=col_number('amount_paid',2)?>">Jumlah</th>
					<th data-options="field:'line_number',width:80">Line</th>
					<th data-options="field:'trans_id',width:80">Trans Id</th>
					<th data-options="field:'bill_id',width:80">Bill Id</th>
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
			style="width:700px;min-height:300px"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,toolbar: '#tbRetur',
				url: '<?=base_url()?>index.php/purchase_invoice/list_retur/<?=$purchase_order_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'nomor',width:80">Nomor</th>
					<th data-options="field:'tanggal',width:150">Tanggal</th>
                    <th data-options="<?=col_number('amount',2)?>">Jumlah</th>
				</tr>
			</thead>
		</table>
	
	</DIV>

<!-- MEMO -->
	<div id='tbCrdb'>
		<?=link_button('Delete','delete_crdb()','remove');?>
	</div>
	<DIV title="Memo" style="padding:10px">
	
		<table id="dgCrdb" class="easyui-datagrid"  style='width:90%'
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true,toolbar:'#tbCrdb',
				url: '<?=base_url()?>index.php/purchase_invoice/list_crdb/<?=$purchase_order_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'nomor',width:50">Nomor</th>
					<th data-options="field:'tanggal',width:50">Tanggal</th>
                    <th data-options="<?=col_number('amount',2)?>">Jumlah</th>
                    <th data-options="field:'keterangan',width:100">Keterangan</th>
                    <th data-options="field:'transtype',width:50">Type</th>
				</tr>
			</thead>
		</table>
	
	</DIV>
	
	<?php 
		$data['gl_id']=$purchase_order_number;
		echo load_view("gl/jurnal_view",$data); 
	?> 
    <div title='Biaya' style="padding:10px">
        <?php include_once 'purchase_expenses.php'; ?>
    </div>

<!-- SUMMARY -->
	<DIV title="Summary" style="padding:10px">
		<div id='divSum' class='thumbnail'>
		
			<?=$summary_info?>
		
		</div>
			
	</DIV>


</div>	
	
	
<?php
    include_once 'select_receive_po_supplier.php'; 
    echo $lookup_rekening;
    echo $lookup_suppliers;
    echo $lookup_po;
    echo $lookup_project;
	echo $lookup_terms;
    echo $lookup_gudang;
	echo $lookup_po_type;
	
    include_once "select_sales_tran.php";
    
?>    
<script type="text/javascript">
	var url;	
	var posted=<?=$posted?>;
	var closed=<?=$closed?>;
	var has_payment=<?=$has_payment?>;
	var has_retur=<?=$has_retur?>;
	var has_memo=<?=$has_memo?>;
	
	function select_po_by_supplier(vUrl){
	    var supp=$("#supplier_number").val();
	    vUrl=vUrl+"&supplier_number="+supp;
	    return vUrl;
	}
	function add_item_with_po(){
        var supplier=$("#supplier_number").val();
        if(supplier==""){alert("Pilih supplier dulu !");return false};
        if($("#mode").val()=="add"){alert("Simpan dulu nomor ini !");return false};
	    
	    var po=$("#po_ref").val();
	    var faktur=$("#purchase_order_number").val();
	    $.ajax({
                type: "GET",
                url: "<?=base_url()?>index.php/purchase_invoice/add_item_with_po/"+po+"/"+faktur,
                data: "",
                success: function(result){
                    var result = eval('('+result+')');
                    if(result.success){
                        $.messager.show({
                            title:'Success',msg:result.msg
                        }); 
                        window.open('<?=base_url()?>index.php/purchase_invoice/view/'+faktur,'_self');
                    } else {
                        $.messager.show({
                            title:'Error',msg:result.msg
                        });                         
                    };
                },
                error: function(msg){alert(msg);}
        });     
        
	}
    function save_po(){
    	
    	loading();
    	
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
						//$('#dg').datagrid('reload');
						loading_close();
						
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
				url: "<?=base_url()?>index.php/purchase_invoice/delete/"+$('#purchase_order_number').val(),
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
            xurl=CI_ROOT+'payables_payments/delete_no_bukti/'+row['no_bukti']+'/'+row['line_number'];                             
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
    
