	<div class="thumbnail">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_voucher()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/cash_mutasi/add');		
	echo link_button('Search','','search','true',base_url().'index.php/cash_mutasi');		
	if($mode=="view") echo link_button('Refresh','','reload','true',base_url().'index.php/cash_mutasi/view/'.$voucher);		
	if($mode=="view") echo link_button('Delete','','remove','true',base_url().'index.php/cash_mutasi/delete/'.$voucher);		
	
	if($posted) {
		echo link_button('UnPosting','','cut','true',base_url().'index.php/cash_mutasi/unposting/'.$voucher);		
	} else {
		echo link_button('Posting','','ok','true',base_url().'index.php/cash_mutasi/posting/'.$voucher);		
	}
	echo link_button('Help', 'load_help()','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('bank_adjust')">Help</div>
		<div onclick="show_syslog('bank_adjust','<?=$voucher?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/cash_mutasi");
		}
	</script>
	
</div>
<div class="thumbnail">

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

<?php 
    if($mode=='view'){
            echo form_open('cash_mutasi/update','id=myform name=myform');
            $disabled='disable';
    } else {
            $disabled='';
            echo form_open('cash_mutasi/save','id=myform name=myform'); 
    }
?>

   
   <table>
       <tr>
            <td>Jenis</td><td>
				<div class='thumbnail'>
                <?php echo form_radio('trans_type','cash trx',$trans_type=='cash trx');?>Cash  &nbsp; &nbsp;
                <?php echo form_radio('trans_type','cheque trx',$trans_type=='cheque trx');?>Giro/Cek  &nbsp; &nbsp;
                <?php echo form_radio('trans_type','trans trx',$trans_type=='trans trx',' checked ');?>Transfer  &nbsp; &nbsp;
				</div>
            </td>
       </tr>
       <tr>
            <td>Tanggal</td><td><?php echo form_input('check_date',$check_date,'id=check_date 
             class="easyui-datetimebox"
				data-options="formatter:format_date,parser:parse_date"  required style="width:150px"');?></td>
       </tr>
       <tr>
            <td>Sumber Rekening</td><td><?php echo form_dropdown( 'account_number',
                    $account_number_list,$account_number);?></td>
       </tr>
       <tr>
            <td>Operator</td><td><?php echo form_input('payee',$payee);?></td>
       </tr>
       <tr>
            <td>Tujuan Rekening</td><td><?php echo form_dropdown( 'supplier_number',
                    $account_number_list,$supplier_number);?></td>
       </tr>
       <tr>
            <td>Jumlah</td><td><?php echo form_input('payment_amount',$payment_amount);?></td>
       </tr>
       <tr>
            <td>Keterangan</td><td><?php echo form_input('memo',$memo,"style='width:300px'");?></td>
       </tr>
	<tr>
		<td>Voucher</td><td>
		<h3>
		<?php
		echo form_hidden('mode',$mode);
		if($mode=='view'){
			echo $voucher;
			echo form_hidden('voucher',$voucher);
		} else { 
			echo form_input('voucher',$voucher);
		}		
		?>
		</h3>
		</td>
	</tr>	 

   </table>
<?
echo form_close();
?>
</div></div>

<script type="text/javascript">
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
       $('#myform').submit();
    }
</script>  

 