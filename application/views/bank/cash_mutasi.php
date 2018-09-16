<div class="thumbnail box-gradient">
	<?php 
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_voucher()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/cash_mutasi/add');		
	echo link_button('Search','','search','false',base_url().'index.php/cash_mutasi');		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/cash_mutasi/view/'.$voucher);		
	if($mode=="view") echo link_button('Delete','','remove','false',base_url().'index.php/cash_mutasi/delete/'.$voucher);		
	
	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/cash_mutasi/unposting/'.$voucher);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/cash_mutasi/posting/'.$voucher);		
	}
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'cash_mutasi\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('cash_mutasi')">Help</div>
		<div onclick="show_syslog('cash_mutasi','<?=$voucher?>')">Log Aktifitas</div>

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

<div class="easyui-tabs" >
    <div title="General" style="padding:10px">   
		<input type='hidden' id='posted' name='posted' value='<?=$posted?>'>    
		<?php 
	    if($mode=='view'){
	        echo form_open('cash_mutasi/update','id=myform name=myform');
	        $disabled='disable';
	    } else {
	        $disabled='';
	        echo form_open('cash_mutasi/save','id=myform name=myform'); 
	    }
		?>
	   	<table class='table2' width='100%'>
	       <tr>
	            <td>Jenis</td><td colspan=3>
	                <?php echo form_radio('trans_type','cash trx',$trans_type=='cash trx',"style='width:20px'");?>Cash  &nbsp; &nbsp;
	                <?php echo form_radio('trans_type','cheque trx',$trans_type=='cheque trx',"style='width:20px'");?>Giro/Cek  &nbsp; &nbsp;
	                <?php echo form_radio('trans_type','trans trx',$trans_type=='trans trx',"style='width:20px'");?>Transfer  &nbsp; &nbsp;
	            </td>
	       </tr>
	       <tr>
	            <td>Tanggal</td><td><?php echo form_input('check_date',$check_date,'id=check_date 
	             class="easyui-datetimebox" required style="width:150px" 
				 data-options="formatter:format_date,parser:parse_date"');?></td>
	
	            <td>Nomor Giro</td><td><?php echo form_input('check_number',$check_number);?></td>
	
	       </tr>
	       <tr>
	            <td>Sumber Rekening</td><td><?php echo form_input('account_number',$account_number,"id='account_number'");?>
	            <?=link_button("","dlgbank_accounts_show();return false","search");?>
	            </td>
	
	            <td colspan=2>
	            	<?php 
	            	echo "Giro Cair";
	            	echo form_checkbox('cleared',$cleared,"","id='cleared' style='width:20px'");
	            	echo "Giro Batal"; 
	            	echo form_checkbox('void',$void,"","id='void' style='width:20px'");
					?>
	            </td>
	
	       </tr>
	       <tr>
	            <td>Tujuan Rekening</td><td><?php echo form_input('supplier_number',$supplier_number,"id='supplier_number'");?>
	            <?=link_button("","dlgbank_accounts2_show();return false","search");?>
	            </td>
	            
	            <td>Tanggal Jth Tempo</td><td><?php echo form_input('cleared_date',$cleared_date,'id=cleared_date 
	             class="easyui-datetimebox"   style="width:150px;height:30px" 
	             data-options="formatter:format_date,parser:parse_date"');?></td>
	            
	       </tr>
	       <tr>
	            <td>Jumlah</td><td><?php echo form_input('payment_amount',$payment_amount,"id='payment_amount'");?></td>
	
	            <td>Nomor Transfer </td><td><?php echo form_input('bank_tran_id',$bank_tran_id);?></td>
	
	       </tr>
	       <tr>
	            <td>Company Code</td><td><?php echo form_input('org_id',$org_id,"id='org_id'");?></td>
	            <td></td><td></td>
	       </tr>
	       <tr>
	            <td>Project#</td><td><?php 
	            	echo form_input('ref1',$ref1,"id='ref1'");
	            	echo  link_button("", "dlggl_projects_show();return false","search");
	            	?></td>
	            <td></td><td></td>
	       </tr>
	       <tr>
	            <td>Keterangan</td><td><?php echo form_input('memo',$memo,"style='width:300px'");?></td>
	       </tr>
	       <tr>
	            <td>Operator</td><td><?php echo form_input('payee',$payee);?></td>
	       </tr>
			<tr>
				<td>Voucher</td><td>
				<strong>
				<?php
				echo form_hidden('mode',$mode);
				if($mode=='view'){
					echo $voucher;
					echo form_hidden('voucher',$voucher);
				} else { 
					echo form_input('voucher',$voucher);
				}		
				?>
				</strong>
				</td>
			</tr>	 
	   </table>
		<?php
			echo form_close();
		?>
	</div>
	<div title="Jurnal" style="padding:10px">
		<?=load_view("gl/jurnal_view",array("gl_id"=>$voucher))?>
	</div>
</div>

<?=$lookup_rekening?>
<?=$lookup_rekening2?>
<?=$lookup_gl_projects?>

<script type="text/javascript">
    function save_this(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#check_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#voucher').val()===''){log_err('Isi kode voucher !');return false;};
        if($('#trans_type').val()===''){log_err('Isi jenis penerimaan !');return false;};
        
        if($('#account_number').val()===''){log_err('Isi kode rekening asal !');return false;};
        if($('#supplier_number').val()===''){log_err('Isi rekening tujuan !');return false;};
        if($('#payment_amount').val()==='0'){log_err('Isi jumlah dikeluarkan !');return false;};
        if($('#account_number').val()===$('#supplier_number').val()){log_err('Nomor rekening tidak boleh sama !');return false;};
        
        
       $('#myform').submit();
    }
</script>  

 