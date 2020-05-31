<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	?>
	<div style="float:right">
	   <?=link_button('Help', 'load_help(\'ptkp\')','help')?>		
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
<legend>STATUS PERKAWINAN</legend>
<div class="thumbnail">	
<form id="frmEmployee"  method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<?php echo validation_errors(); ?>
   <table class='table' width='100%'>
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
       <tr><td>Keterangan</td><td colspan="4"><?=form_input('keterangan',$keterangan,"id=keterangan style='width:400px'");?></td></tr>
       <tr><td>PTKP Rp.</td><td><?=form_input('jumlah',$jumlah);?></td></tr>
       <tr></tr>
   </table>
   </form>
    
</div>   
<script type="text/javascript">
    function save_this(){
        if($('#kode').val()===''){alert('Isi kode !');return false;};

		url='<?=base_url()?>index.php/payroll/ptkp/save';
			$('#frmEmployee').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#kode').val(result.status);
						$('#mode').val('view');
						$.messager.show({
							title:'Success',msg:'Data sudah tersimpan.'
						});
						remove_tab_parent();
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
        
        
        
    }
</script>  

 
 