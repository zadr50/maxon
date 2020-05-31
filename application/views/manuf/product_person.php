<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
    echo link_button('Delete', 'on_delete()','remove');     
    echo link_button('Refresh', 'on_refresh()','reload');     
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help()','help');		
	
	?>
		<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help('product_person')">Help</div>
			<div onclick="show_syslog('product_person','<?=$nip?>')">Log Aktifitas</div>

			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
        <?=link_button("Close","remove_tab_parent()","cancel")?>
		
	</div>
</div>
<legend>Master Data Karyawan Produksi</legend>
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


<form id="myform" role="form" method="post" action="<?=base_url()?>index.php/manuf/product_person/save"  class="form-horizontal" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<div class="form-group">
	<label for="id" class="col-sm-3 control-label">NIP Kode Karyawan</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="nip" name="nip" value="<?=$nip?>" placeholder="Kode">
		</div>
	</div>

	<div class="form-group">
	<label for="description" class="col-sm-3 control-label">Nama Karyawan</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="nama" name="nama" value="<?=$nama?>" placeholder="Nama Karyawan">
		</div>
	</div>
</form>

</div>

<script type="text/javascript">
    function save_this(){
        if($('#nip').val()===''){
            log_err('Isi dulu kode  !');
            return false;
        };
            $('#myform').form('submit',{
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                        log_msg('Data sudah tersimpan.');
                        remove_tab_parent();
                    } else {
                        log_err(result.msg);
                    }
                }
            });
        
        
    }
        function load_help() {
            window.parent.$("#help").load("<?=base_url()?>index.php/help/load/product_person");
        }
    function on_delete(){
        var id=$("#nip").val();

        $.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
            if(!r)return false;
        
            $.ajax({
                url: CI_ROOT+"manuf/product_person/delete/"+id,
                success: function(result){
                    log_msg("Success");
                    remove_tab_parent();
                },
                error:function(result){
                    log_msg("Error !");
                }
            })
        })
    }
    function on_refresh(){
        var id=$("#nip").val();
        window.open(CI_ROOT+"manuf/product_person/view/"+id,"_self");
    }    
    
</script>  

 