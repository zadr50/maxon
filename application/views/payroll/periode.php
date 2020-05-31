<div class="thumbnail box-gradient">
	<?php
    echo link_button('Save', 'save_periode()','save');      
	echo link_button('Closing', 'closing_periode()','edit');		
	echo link_button('ReOpen', 'reopen_periode()','edit');		
	?>
	<div style='float:right'>
    	<?php echo link_button('Help', 'load_help(\'periode\')','help');	?>	
    	<a href="#" class="easyui-splitbutton" 
    	data-options="menu:'#mmOptions',iconCls:'icon-tip',plain:false">Options</a>
    	<div id="mmOptions" style="width:200px;">
    		<div onclick="load_help('periode')">Help</div>
    		<div>Update</div>
    		<div>MaxOn Forum</div>
    		<div>About</div>
    	</div>
	   <?=link_button("Close", "remove_tab_parent()","cancel")?>
	</div>
</div> 
<?php 
	echo validation_errors();
	if($mode=='view'){
		echo form_open('payroll/periode/update','id=\'myform\' name=\'myform\' class=\'form-horizontal\' role=form');
		$disabled='disable';
	} else {
		$disabled='';
		echo form_open('payroll/periode/add','id=myform name=myform  class=form-horizontal  role=form'); 
	}
?>
<div class="thumbnail">    
    <table class='table' width='100%'>
    <?php 
    	echo my_input_tr("Periode Id",'period',$period);
    	echo my_input_tr("Periode Month",'period_name',$period_name);
    	echo my_input_tr("Start Dtae",'from_date',$from_date);
    	echo my_input_tr("End Date",'to_date',$to_date);
    	echo "<tr><td>Sudah Tutup Buku ?</td>
    		<td colspan='2'>".form_radio('status','No',$status=='0'||$status=='')
    		." &nbsp No ".form_radio('status','Yes',!($status=='0'||$status==''))
    		." &nbsp Yes </td></tr>";
    	echo form_close();
    ?>
    </table>
</div>

<script type="text/javascript">
    function save_periode(){
        if($('#period').val()===''){alert('Isi dulu kode periode !');return false;};
        
        
        $('#myform').form('submit',{
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
                    remove_tab_parent();
                } else {
                    log_err(result.msg);
                }
            }
        });

        
    }
</script>  

 	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/periode");
		}
	</script>
	
