<div class="thumbnail box-gradient">
	<?
	echo link_button('Add','','add','false',base_url().'index.php/payroll/medical/add');		
	echo link_button('Search','','search','false',base_url().'index.php/payroll/medical');		
	echo link_button('Save', 'simpan()','save');		
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
	</div>
</div> 

<?php echo validation_errors(); ?>

<form id="frmMedical"  method="post">

	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<input type='hidden' name='id' id='id'	value='<?=$id?>'>
	
	<table class='table'>
			<tr>
				<td>NIP</td>
				<td><? echo form_input('employeeid',$employeeid,"id=employeeid"); 
				echo link_button("","dlgLovEmployee_show()","search")?>
				&nbsp<?=form_input('nama_pegawai',$nama_pegawai,"id=nama_pegawai disabled");?></td>
			</tr>
		    <tr>
				<td>Tanggal </td><td><?=form_input('medicaldate',$medicaldate,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='from_date'");?></td>
				<td>&nbsp</td>
		   </tr>
			<tr>
				<td>Keterangan</td>
				<td colspan=2><?=form_input('description',$description,"id=description style='width:80%'");?></td>
			</tr>
	</table>	   
</form>

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
					} else {
						log_err(result.msg);
					}
				}
			});
		
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/medical");
	}

</script>  
 
	
