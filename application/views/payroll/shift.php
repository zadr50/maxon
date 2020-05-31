<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_this()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/payroll/shift/add');		
	echo link_button('Search','','search','false',base_url().'index.php/payroll/shift');		
	
	echo "<div style='float:right'>";
		echo link_button('Help', 'load_help(\'shift\')','help');		
		
		?>
		<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help()">Help</div>
			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
		<?=link_button('Close', 'remove_tab_parent()','cancel')?>		
	</div>
</div>
<div class="thumbnail">	
<form id="frmShift"  method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<?php echo validation_errors(); ?>
   <table class='table2' width='90%'>
	<tr>
		<td>Kode</td>
		<td><?php
		if($mode=='view'){
			echo "<strong>$kode</strong>";
			echo form_hidden('kode',$kode,"id=kode");
		} else { 
			echo form_input('kode',$kode,"id=kode");
		}		
		?></td>
	</tr>	 
       <tr><td>Jam Masuk (HH:MM)</td><td><?=form_input('time_in',$time_in,"id=time_in");?></td></tr>
       <tr><td>Jam Keluar  (HH:MM)</td><td><?=form_input('time_out',$time_out);?></td></tr>
       <tr><td>Lama Jam Kerja</td><td><?=form_input('time_count',$time_count);?></td></tr>
       <tr><td>Jam Istirahat</td><td><?=form_input('time_rest',$time_rest);?></td></tr>
       <tr><td>Lama Jam Istirahat</td><td><?=form_input('time_rest_count',$time_rest_count);?></td></tr>
       <tr><td>Beda Hari (0-Sama, 1-Beda)</td><td><?=form_input('different_day',$different_day);?></td></tr>
   </table>
   </form>
    
</div>   
<script type="text/javascript">
    function save_this(){
        if($('#kode').val()===''){alert('Isi kode !');return false;};

		url='<?=base_url()?>index.php/payroll/shift/save';
		loading();
			$('#frmShift').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					loading_close();
					var result = eval('('+result+')');
					if (result.success){
						$('#kode').val(result.status);
						$('#mode').val('view');
						$.messager.show({
							title:'Success',msg:'Data sudah tersimpan.'
						});
						remove_tab_parent();
					} else {
						loading_close();
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
        
        
        
    }
</script>  

 
 