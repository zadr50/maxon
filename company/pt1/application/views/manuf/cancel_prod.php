<div><div class="thumbnail">
<legend>CANCEL PRODUCTION</legend>

	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/cancel_prod/add');		
	echo link_button('Search','','search','true',base_url().'index.php/cancel_prod');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
		<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('cancel_prod')">Help</div>
		<div onclick="show_syslog('cancel_prod','<?=$prod_cancel_no?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/cancel_prod");
		}
	</script>

</div></H1>

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


<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/cancel_prod/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<div class="form-group">
	<label for="prod_cancel_no" class="col-sm-3 control-label">Kode Cancel</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="prod_cancel_no" name="prod_cancel_no" value="<?=$prod_cancel_no?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="wo_number" class="col-sm-3 control-label">Work Order Number</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="wo_number" name="wo_number" value="<?=$wo_number?>" placeholder="">
		</div>
	</div>

	<div class="form-group">
	<label for="warehouse_code" class="col-sm-3 control-label">Gudang</label>
		<div class="col-sm-8">
			<?=form_dropdown('warehouse_code',$warehouse_code_list,$warehouse_code,"class='form_control'")?>
		</div>
	</div>

	<div class="form-group">
	<label for="cancel_date" class="col-sm-3 control-label">Tanggal</label>
		<div class="col-sm-8">
			<input type="text" class="form-control easyui-datetimebox" id="cancel_date"
			name="cancel_date" value="<?=$cancel_date?>" placeholder="cancel_date" 
			data-options="formatter:format_date,parser:parse_date"
			style="width:150px">
		</div>
	</div>

	<div class="form-group">
	<label for="comments" class="col-sm-3 control-label">Keterangan</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="comments" name="comments" value="<?=$comments?>" placeholder="">
		</div>
	</div>
<!-- DAFTAR BARANG PRODUKSI YANG DIBATALKAN, kode,nama,qty,unit,cost,total_cost,gudang,comments -->
<!-- MATERIAL TERKAIT BARANG PRODUKSI YANG BATAL -->

	</form>
</div>

<script type="text/javascript">
    function save_this(){
                var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#cancel_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

        if($('#id').val()===''){alert('Isi dulu kode aktiva !');return false;};
        if($('#description').val()===''){alert('Isi dulu nama aktiva !');return false;};
        $('#myform').submit();
    }
</script>  

 