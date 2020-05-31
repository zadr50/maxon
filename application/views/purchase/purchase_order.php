<div class=" tool box-gradient" id="divToolbar">
	<?php 
	$sql="select sum(quantity) as total_qty from purchase_order_lineitems 
	where purchase_order_number='$purchase_order_number'";
	$q=$this->db->query($sql);
    $qty_total=0;
	if($q){
	   if($r=$q->row()){
	       $qty_total=$r->total_qty;
	   }   
	}
    
	$min_date=$this->session->userdata("min_date","");
	
	$disabled="";$disabled_edit="";
	if(!($mode=="add" or $mode=="edit"))$disabled=" readonly";
	//if($mode=="edit")$disabled_edit=" disabled";
	if($mode=="edit" or $mode=="add") echo link_button('Save', 'save_po()','save',"false");		
	if($mode=="view") {
		if (!($has_receive) || user_id()=="admin") echo link_button('Edit', '','edit','false',base_url().'index.php/purchase_order/view/'.$purchase_order_number.'/edit');				
		echo link_button('Add','','add','false',base_url().'index.php/purchase_order/add');		
		echo link_button('Refresh','','reload','false',base_url().'index.php/purchase_order/view/'.$purchase_order_number);		
		if (!$has_receive) echo link_button('Delete', 'delete_nomor()','cut','false');		
		echo link_button('Duplicate','','add','false',base_url().'index.php/purchase_order/duplicate/'.$purchase_order_number);		
	}
	echo link_button('Print', 'print_po()','print','false');		
//	echo link_button('Search','','search','false',base_url().'index.php/purchase_order');		
	
	echo "<div style='float:right'>";
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('purchase_order')">Help</div>
		<div onclick="show_syslog('purchase_order','<?=$purchase_order_number?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?php 
	echo link_button('Help', 'load_help(\'purchase_order\')','help','false');		
    echo link_button('Close','remove_tab_parent()','cancel');      
		echo "</div>";
	?>
</div>
<div class='thumbnail'>	
<div class="easyui-tabs" >
	<div title="General" style="padding:10px">
		<form id='frmPo' method="post">
			<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
			<?php echo validation_errors(); ?>
		   <table class='table2' width="100%">
				<tr>
					<td>Nomor PO</td>
					<td width="180"><?php
						if($mode=="add")$purchase_order_number="AUTO";
						echo form_input('purchase_order_number',
						$purchase_order_number,"id='purchase_order_number' 
						class='easyui-validatebox' data-options='required:true,	
						validType:length[3,30]' ".$disabled.$disabled_edit); 
					?>
					</td>
					<td>Supplier</td>
					<td width="150"><?php 
						echo form_input('supplier_number',$supplier_number,
						"id=supplier_number class='easyui-validatebox' data-options='required:true,
						validType:length[3,30]'".$disabled.$disabled_edit." style='width:100px'");
						if($mode=="add") echo link_button('','dlgsuppliers_show()',"search","false"); 
					?>
					</td>
					<td>Status </td>
					<td><?=form_input("doc_status",$doc_status,"id='doc_status' style='width:80px'")?>
						<?=link_button('','dlgdoc_status_show()',"search","false"); ?>	
						<?php 
						if($doc_status=="OPEN"){
							echo link_button('Apprv','approve()',"save","false","","Approve this purchase order number.");                   
						}
					?>
					</td>
			   </tr>	 
			   <tr>
					<td>Tanggal</td><td><?php echo form_input('po_date',$po_date,'id=po_date  
					class="easyui-datetimebox" required:true 
					data-options="formatter:format_date,parser:parse_date"
					'.$disabled);?></td>

					<td colspan='4'>
						<b><span id='supplier_name' name='supplier_name' class='' style='height:50px;width:300px'><?=$supplier_info?></span></b>
					</td>
			   </tr>	 
			   <tr>
					<td>Termin</td><td><?php echo form_input('terms',$terms,"id='terms' 
						 class='easyui-validatebox' data-options='required:true' ".$disabled);
						if($disabled=="") echo link_button('','dlgterms_show()',"search","false");  
					
					?></td>
					<td>Contact</td><td><?=form_input('contact_person',$contact_person,"id='contact_person' style='width:100px'")?></td>
					<td>No.RFQ#   </td><td><?=form_input("req_no",$req_no,"id='req_no' style='width:80px'")?>
					<?=link_button('','dlgreq_no_show()',"search","false"); ?>  
					<?=link_button('View', 'view_rfq()','search','false');?>
					</td>
					
			   </tr>	 
			   <tr>
					
					<td>Tgl. Kirim</td>
					<td><?=form_input('due_date',$due_date,'id=due_date  class="easyui-datetimebox" required
					data-options="formatter:format_date,parser:parse_date"
					'.$disabled);?></td>
					<td>Sistim</td><td><?=form_input('type_of_invoice',$type_of_invoice,"id='type_of_invoice' style='width:50px'");?>
						<?=link_button('','dlgtype_of_invoice_show()',"search","false"); ?>		 
					 </td>			
					<td>Expire Day/Date</td><td>
						<?php
						echo form_input("expire_day",$expire_day,"style='width:50px'"); 
						echo form_input("po_expire_date",$po_expire_date,'id=po_expire_date  
					class="easyui-datetimebox" required:true 
					data-options="formatter:format_date,parser:parse_date"
					'.$disabled);?></td>
							
			   </tr>
			   <tr>
					<td>Company </td><td><?=form_input("bill_to_contact",$bill_to_contact,"id='bill_to_contact' style='width:80px'")?>
					<?=link_button('','dlgpreferences_show()',"search","false"); ?>  
					</td>
					<td>Gudang </td><td><?=form_input("warehouse_code",$warehouse_code,"id='warehouse_code' style='width:80px'")?>
					<?=link_button('','dlgwarehouse_show()',"search","false"); ?>  
					</td>
					<td>Jenis PO</td><td class='field'> 
						<?php
						echo form_input("doc_type",$doc_type,"id='doc_type'");
						echo link_button('','dlgdoc_type_show();return false;',"search","false"); 
						echo link_button('',"dlgdoc_type_list('doc_type_po');return false;","add","false"); 
						?>
					</td>                
			   </tr>
			   <tr>
					<td>Keterangan</td><td colspan="3"><?php echo form_input('comments',$comments,'id=comments style="width:80%"'.$disabled);?>
					</td><td>Dipesan Oleh</td><td colspan="3"><?php echo form_input('ordered_by',$ordered_by);?></td>
			   </tr>
		   </table>
		   <div id='divTotal' class='thumbnail'> 
					<table class="table2" width="90%">
						<tr><td colspan=6><strong>Total</strong></td></tr>
						<tr>
							<td>Sub Total: </td><td><input id='sub_total' value='<?=number_format($subtotal,2)?>' style='width:100px'></td>             
							<td>Discount %: </td><td><input name='discount' id='disc_total_percent' value='<?=$discount?>' style='width:50px'></td>
							<td>Pajak PPN %: </td><td><input name='tax' id='po_tax_percent' value='<?=$tax?>' style='width:50px'></td>
						</tr>
						<tr>
							<td>Ongkos Angkut: </td><td><input id='freight' value='<?=$freight?>' style='width:80px'>
							</td>
							<td>Biaya Lain: </td><td><input  id='others' value='<?=$other?>' style='width:80px'>
								
							<?=link_button('','add_expenses();return false','edit'); ?>  
								
							</td>
							<td>JUMLAH: </td><td><input id='total' value='<?=number_format($amount,2)?>' style='width:100px'>
								 <a id='divHitung' href="#" class="easyui-linkbutton" data-options="iconCls:'icon-sum'"  
								   plain='false' title='Hitung ulang' onclick='hitung_jumlah();return false'></a>
							</td>
						</tr>
						<tr><td colspan=6><i>*Total Qty: <?=$qty_total?></i></td></tr>
					</table>        
			</div>
		</form>
	</div> 
    <div title="Items" >
    	<!-- PURCASE_ORDER_LINEITEMS -->	
    	<div id='divItem' >		 
    		<div id='dgItem' style="padding:10px;min-height:400px">
    			<?php 
					include_once "purchase_order_items.php"; 
					echo load_view("purchase/po_item_list",
						 array("purchase_order_number"=>$purchase_order_number));
				?>
    	   </div>	
    	</div>
    	<!-- END PURCHASE_ORDER_LINEITEMS -->		
    </div>
	<div title='Receive' style="padding:10px">
	    <?=load_view("purchase/po_item_recv_list",array("purchase_order_number"=>$purchase_order_number))?>		
	</div>
	<div title='Invoice' style="padding:10px">
        <?=load_view("purchase/po_invoice_list",array("purchase_order_number"=>$purchase_order_number))?>     
	</div>
    <div title='Biaya' style="padding:10px">
        <?php include_once 'purchase_expenses.php'; ?>
    </div>
</div>
<?php 
	echo $lookup_po_type;
	echo $lookup_po_status;
	echo $lookup_req_no;
	echo $lookup_company;
	echo $lookup_gudang;
	echo $lookup_suppliers;
	echo $lookup_terms;
	echo $lookup_doc_type;
?>

<script type="text/javascript">
	var url;	
	var has_receive='<?=$has_receive?>';
    function save_po(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var po_date=$('#po_date').datetimebox('getValue'); 
        if(po_date<min_date){
            valid_date=false;
        }
        
        hitung_jumlah();
        loading();
        $("#divToolbar").hide();
        //if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        if($('#purchase_order_number').val()==''){alert('Isi nomor purchase order !');return false;}
        if($('#supplier_number').val()==''){alert('Pilih kode supplier !');return false;}
        if($('#terms').val()==''){alert('Pilih termin !');return false;}        
		url='<?=base_url()?>index.php/purchase_order/save';
			$('#frmPo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						loading_close();
						$("#divToolbar").show();
						$('#divItem').show('slow');
						$('#purchase_order_number').val(result.purchase_order_number);
						var nomor=$('#purchase_order_number').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+nomor+'/json'});
						//$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						$("#divToolbar").show();
						log_err(result.msg);
					}
				}
			});
    }
	function hitung_jumlah(){
		var po=$("#purchase_order_number").val();
		var url=CI_ROOT+'purchase_order/sub_total/'+po;
		if(po=="AUTO"){
			log_err("Simpan dulu !");return false;
		}

		if($('#disc_total_percent').val()=='')$('#disc_total_percent').val(0);
		disc_prc=$('#disc_total_percent').val();
		if(disc_prc>1){
			disc_prc=disc_prc/100;
			$('#disc_total_percent').val(disc_prc);
		}	

		if($('#po_tax_percent').val()=='')$('#po_tax_percent').val(0);
		tax_prc=$('#po_tax_percent').val();
		if(tax_prc>1){
			tax_prc=tax_prc/100;
			$('#po_tax_percent').val(tax_prc);
		}	
		
		if($('#freight').val()=='')$('#freight').val(0);
		if($('#others').val()=='')$('#others').val(0);
		$.ajax({
			type: "GET",
			url: url,
			contentType: 'application/json; charset=utf-8',
			data:{discount:disc_prc,tax:tax_prc,
			others:$("#others").val(),freight:$("#freight").val()}, 
			success: function(msg){
				var obj=jQuery.parseJSON(msg);
				$('#sub_total').val(obj.sub_total);
				$('#total').val(obj.amount);
			},
			error: function(msg){alert(msg);}
		});			
	}
	function print_po(){
		po_number=$("#purchase_order_number").val();
		if(po_number=="AUTO"){
			log_err("Simpan dulu !");return false;
		}
		
		url="<?=base_url()?>index.php/purchase_order/print_po/"+po_number;
		window.open(url,'_blank');
	}
    function approve(){
        po=$("#purchase_order_number").val();
	    if(po=="AUTO"){
	    	log_err("Simpan dulu !");return false;
	    }
        
        $.ajax({
                type: "GET",
                url: "<?=base_url()?>index.php/purchase_order/status/"+po+"/APPROVED",
                data: "",
                success: function(result){
                    var result = eval('('+result+')');
                    if(result.success){
                        $("#doc_status").val("APPROVED");
                        $.messager.show({
                            title:'Success',msg:result.msg
                        }); 
                        log_msg(result.msg);
                    } else {
                        $.messager.show({
                            title:'Error',msg:result.msg
                        });                         
                        log_msg(result.msg);
                    };
                },
                error: function(msg){alert(msg);}
        });                 
        
    }
	function delete_nomor()	{
		var po=$("#purchase_order_number").val();
	    if(po=="AUTO"){
	    	log_err("Simpan dulu !");return false;
	    }

		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/purchase_order/delete/"+po,
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						window.open('<?=base_url()?>index.php/purchase_order','_self');
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}		
	function view_rfq(){
	    var no=$("#req_no").val();
	    if(no==""){
	        alert("Pilih nomor RFQ terlebih dahulu !");
	        return false;
	    }
	    add_tab_parent("view_rfq_"+no,CI_ROOT+"purchase_request/view/"+no);
	}
	function calc_qty_unit(){
		if(qty_conv=="")qty_conv=1;
		if(qty_conv=="0")qty_conv=1;
		qty=$("#quantity").val();
		qty=qty*qty_conv;
		$("#mu_qty").val(qty);
	}
</script>
    
