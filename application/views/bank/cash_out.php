<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	if($posted=="")$posted=0;
	if($closed=="")$closed=0;
	
	echo link_button('Save', 'save_this()','save');	
	echo link_button('Print', 'print_voucher()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/cash_out/add');		
	echo link_button('Search','','search','false',base_url().'index.php/cash_out');		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/cash_out/view/'.$voucher);		
	if($mode=="view") echo link_button('Delete','','remove','false',base_url().'index.php/cash_out/delete/'.$voucher);		
	
	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/cash_out/unposting/'.$voucher);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/cash_out/posting/'.$voucher);		
	}
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'cash_out\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('cash_out')">Help</div>
		<div onclick="show_syslog('cash_out','<?=$voucher?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">
<div class="easyui-tabs">
    <div title="General" style="padding:10px">

<?php 
    if($mode=='view'){
            echo form_open('cash_out/update','id=myform name=myform');
            $disabled='disable';
    } else {
            $disabled='';
            echo form_open('cash_out/save','id=myform name=myform'); 
    }
?>

       <input type='hidden' id='posted' name='posted' value='<?=$posted?>'>    
       <table class='table2' width='100%'>
    		<tr><td colspan=2>Jenis
    			<?php echo form_radio('trans_type','cash out',$trans_type=='cash out'," checked style='width:30px' ");?> Cash
    			<?php echo form_radio('trans_type','cheque out',$trans_type=='cheque out',"style='width:30px' ");?> Giro
                <?php echo form_radio('trans_type','trans out',$trans_type=='trans out',"style='width:30px' ");?> Transfer
                
    		</td>
    		<td>Voucher </td><td>
    			<?php
    				echo "<input type='hidden' name='mode' id='mode' value='$mode'>";
    			if($mode=='view'){
    				echo "<strong>".$voucher."</strong>";
    				echo "<input type='hidden' name='voucher' id='voucher' value='$voucher'>";
    			} else { 
    				echo form_input('voucher',$voucher);
    			}		
    			?>
    		</td>
    		</tr>
           <tr>
                <td>Rekening Dikeluarkan </td><td><?php echo form_input('account_number',$account_number,"id='account_number'");?>
                <?=link_button("","dlgbank_accounts_show();return false","search");?>
                </td>
                <td>Tanggal</td><td><?php echo form_input('check_date',$check_date,'id=check_date 
                 class="easyui-datetimebox"  style="width:150px;height:30px" 
    			 data-options="formatter:format_date,parser:parse_date"');?></td>
           </tr>
           <tr>
                <td>Jumlah Dikeluarkan</td>
    			<td>
                    <?php echo form_input('payment_amount',$payment_amount,"id='payment_amount'");?>
                </td>
                <td>Nama Bank Penerima</td><td><?php echo form_input('from_bank',$from_bank);?></td>
           </tr>
            <tr>
                <td>Kelompok Voucher </td><td><?php echo form_input('doc_type',$doc_type,"id='doc_type'");?>
                    <?=link_button('','dlgdoc_type_show();return false;','search','false');?>      
                </td>
                <td>Nomor Giro</td><td><?php echo form_input('check_number',$check_number);?></td>
            </tr>
            <tr>
                <td>Pembayaran Hutang</td>
                <td>
                    <?php echo form_checkbox('bill_payment',$bill_payment,$bill_payment==1?TRUE:FALSE);?>                
                </td>
                <td>Giro Cair <?php echo form_checkbox('cleared',$cleared,$cleared==1?TRUE:FALSE);?></td>
                <td>Giro Batal <?php echo form_checkbox('void',$void,$void==1?TRUE:FALSE);?></td>
           </tr>
           <tr>
                <td>Penerima / Supplier </td>
                <td><?php echo form_input('supplier_number',$supplier_number,"id='supplier_number'");?>
                <?=link_button("","dlgsuppliers_show();return false","search");?>
                </td>
                <td>Tanggal Jth Tempo</td><td><?php echo form_input('cleared_date',$cleared_date,'id=cleared_date 
                 class="easyui-datetimebox"   style="width:150px;height:30px" 
                 data-options="formatter:format_date,parser:parse_date"');?></td>
           </tr>
           <tr>
                <td>Dikeluarkan Untuk </td><td><?php echo form_input('payee',$payee,"id='payee'");?></td>
                <td>Nomor Transfer </td><td><?php echo form_input('bank_tran_id',$bank_tran_id);?></td>
               
           </tr>
           
           <tr>
                <td>Company Code</td><td><?php echo form_input('org_id',$org_id,"id='org_id'");?></td>
                <td>Doc Status</td><td><?=form_input('doc_status',$doc_status,"id='doc_status'")?>
                <?=link_button('','dlgdoc_status_show();return false;','search','false');?>      
    		    </td> 
    		</tr>
           </tr>
           
           <tr>
                <td>Keterangan</td><td colspan='6'><?php echo form_input('memo',$memo,"style='width:100%'");?></td>
           </tr>
       </table>
         </form>
    </div>
    <?php if ($mode=="view") {  ?>
    <div title="Perkiraan" style="padding:10px">
        <?=load_view("bank/cash_item",array("url_data"=>base_url("cash_out/items/$voucher")))?>
    </div>

	<?php 
	$data['gl_id']=$voucher;
	echo load_view("gl/jurnal_view",$data); 
	?> 
	<?php } ?>
</div>


</div>
 

<?=load_view('gl/select_coa')?>
<?=$lookup_suppliers?>
<?=$lookup_doc_type?>
<?=$lookup_doc_status?>
<?=$lookup_rekening?>
<?=$lookup_department?>

<script type="text/javascript">
$(function() {
 	
    $("#account_number").autocomplete("<?=base_url('banks/banks/select2')?>");
    $("#doc_status").autocomplete("<?=base_url('lookup/query_sysvar_lookup_ac/doc_status')?>");
         
});

    function save_this(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#check_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        if($('#voucher').val()===''){alert('Isi kode voucher !');return false;};
        if($('#trans_type').val()===''){alert('Isi jenis penerimaan !');return false;};
        if($('#account_number').val()===''){alert('Isi kode rekening !');return false;};
        if($('#payment_amount').val()===''){alert('Isi jumlah dikeluarkan !');return false;};
        if($('#payment_amount').val()==='0'){alert('Isi jumlah dikeluarkan !');return false;};
       $('#myform').submit();
    }
	function save_item(){
		var mode=$("#mode").val();
		if(mode=="add"){alert("Simpan dulu bagian header !");return false;}
		
		var url = '<?=base_url()?>index.php/cash_out/save_item';
		$('#voucher_item').val($('#voucher').val());
					 
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
				    $('#dlgItem').dialog('close');
					$('#dgItemCoa').datagrid('reload');
					$('#frmItem').form('clear');
					$('#account').val('');
					$('#description').val('');
					$('#line_number').val('');
					$('#amount').val('0');
					$.messager.show({
						title: 'Success',
						msg:  result.msg
					});
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	
		function deleteItem(){
			var row = $('#dgItemCoa').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if (r){
						url='<?=base_url()?>index.php/cash_out/delete_item';
						$.post(url,{line_number:row.line_number},function(result){
							if (result.success){
								$('#dgItemCoa').datagrid('reload');	// reload the user data
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
		}
		function editItem(){
			var row = $('#dgItemCoa').datagrid('getSelected');
			if (row){
				$('#frmItem').form('load',row);
				$('#account').val(row.account);
				$('#description').val(row.description);
				$('#line_number').val(row.line_number);
				$('#amount').val(row.amount);
			}
		}
		function print_voucher(){
            var nomor=$("#voucher").val();
            url="<?=base_url()?>index.php/cash_out/print_bukti/"+nomor;
            window.open(url,'_blank');
		}
		function addItem(){
              $('#dlgItem').dialog('open').dialog('setTitle','Input Item Detail');
		}
	
</script>  
