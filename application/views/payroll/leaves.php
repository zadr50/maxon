<div class="thumbnail box-gradient">
	<?php
	echo link_button('Add','','add','false',base_url().'index.php/payroll/cuti/add');		
	echo link_button('Search','','search','false',base_url().'index.php/payroll/cuti');		
	echo link_button('Save', 'simpan()','save');		
	?>
	<div style='float:right'>
	<?php echo link_button('Help', 'load_help(\'cuti\')','help');	?>	
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

<?php echo validation_errors(); 
if(!isset($disabled))$disabled="";
?>

<form id="frmCuti"  method="post">

	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<input type='hidden' name='id' id='id'	value='<?=$id?>'>
	
	<table class='table'>
	    <tr><td colspan=4><strong>FORMULIR PERMOHONAN CUTI KARYAWAN</strong></td></tr>
			<tr>
				<td>NIP / Nomor Induk Pegawai</td>
				<td><? echo form_input('nip',$nip,"id='nip' $disabled"); 
				if($disabled=="") echo link_button("","dlgLovEmployee_show()","search")?>
				&nbsp<?=form_input('nama_pegawai',$nama_pegawai,"id='nama_pegawai' disabled style='width:300px'");?></td>
			</tr>
		    <tr>
				<td>Dari Tanggal </td><td><?=form_input('from_date',$from_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='from_date'");?></td>
				<td>&nbsp</td>
		   </tr>
		    <tr>
				<td>Sampai Tanggal </td><td><?=form_input('to_date',$to_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='to_date'");?></td>
				<td>&nbsp</td>
		   </tr>
            <tr>
                <td>Jumlah hari</td>
                <td><? echo form_input('leave_day',$leave_day,"id='leave_day' $disabled");?>                    
                </td>
            </tr>
            <tr>
                <td>Status Permohonan</td>
                <td><? echo form_input('doc_status',$doc_status,"id='doc_status' $disabled");
                    if($disabled=="") echo link_button("","dlgdoc_status_show()","search")?>                    
                    <?=link_button("","dlgdoc_status_list()","add")?>                    
                </td>
            </tr>
            <tr>
                <td>Doc Type</td>
                <td><? echo form_input('doc_type',$doc_type,"id='doc_type' $disabled");
                    if($disabled=="") echo link_button("","dlgdoc_type_show()","search")?>                    
                    <?=link_button("","dlgdoc_type_list()","add")?>                    
                </td>
            </tr>
            <tr>
                <td>Alasan cuti atau keterangan</td>
                <td colspan=2><?=form_input('reason',$reason,"id=reason style='width:80%'");?></td>
            </tr>
	</table>	   
</form>

<?php 
 echo $lookup_employee;
 echo $lookup_doc_status;
 echo $lookup_doc_type;
?>

<script type="text/javascript">
    function simpan(){
        if($('#employeeid').val()===''){alert('Isi dulu NIP Karyawan !');return false;};

		url='<?=base_url()?>index.php/payroll/cuti/save';
			$('#frmCuti').form('submit',{
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
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/cuti");
	}

</script>  
 
	
