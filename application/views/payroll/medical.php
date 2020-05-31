<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'simpan()','save');		
    echo link_button('Delete', 'on_delete()','remove');        
    echo link_button('Refresh', 'on_refresh()','reload');        
	?>
	<div style='float:right'>
	<?php echo link_button('Help', 'load_help(\'medical\')','help');	?>	
	<a href="#" class="easyui-splitbutton" 
	data-options="menu:'#mmOptions',iconCls:'icon-tip',plain:false">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('periode')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?php echo link_button('Close', 'remove_tab_parent()','cancel');        ?>
	</div>
</div> 

<?php echo validation_errors(); ?>

<div class='thumbnail'>
    
<form id="frmMedical"  method="post">

	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<input type='hidden' name='id' id='id'	value='<?=$id?>'>
	
	<table class='table'>
			<tr>
				<td>NIP</td>
				<td><? echo form_input('employeeid',$employeeid,"id=employeeid"); 
				echo link_button("","dlgemployee_show()","search")?>
				&nbsp<?=form_input('nama_pegawai',$nama_pegawai,"id=nama_pegawai disabled style='width:50%'");?></td>
			</tr>
		    <tr>
				<td>Tanggal </td><td><?=form_input('medicaldate',$medicaldate,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='from_date'");?></td>
				<td>&nbsp</td>
		   </tr>
			<tr>
				<td>Nilai Medical Rp</td>
				<td><?=form_input('amount',$amount,"id='amount' ");?></td>
				<td>&nbsp</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td colspan=2><?=form_input('description',$description,"id=description style='width:80%'");?></td>
			</tr>
	</table>	   
</form>

</div>

<?php 
 echo $lookup_employee;
?>

<script type="text/javascript">
    function simpan(){
        if($('#employeeid').val()===''){alert('Isi dulu NIP Karyawan !');return false;};

		url='<?=base_url()?>index.php/payroll/medical/save';
			$('#frmMedical').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#id').val(result.id);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
						remove_tab_parent();
					} else {
						log_err(result.msg);
					}
				}
			});
		
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/medical");
	}
	function on_delete(){
	    var id=$("#id").val();
        $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
                if(!r)return false;
        	    $.ajax({
        	        url: CI_ROOT+"payroll/medical/delete/"+id,
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
	    var id=$("#id").val();
	    window.open(CI_ROOT+"payroll/medical/view/"+id,"_self");
	}

</script>  
 
	
