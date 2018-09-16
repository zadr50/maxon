<div class="thumbnail">
	

<div class="thumbnail box-gradient">
	<?php
	
	    echo link_button('Save','save_bukti()','save');       
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'sysvar\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('sysvar')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');?>      
	
	</div>
</div>


<?php 
if($mode=='view'){
    echo form_open('sysvar_data/update',"id='frmMain'");
    $disabled='disable';
} else {
    $disabled='';
    echo form_open('sysvar_data/add',"id='frmMain'"); 
}
?> 
<table class='table2'>
    <tr>
        <td>Var Name</td><td><?=form_input('varname',$varname,"style='width:300px'");?></td>
    </tr>    
    <tr>
        <td>Var Value</td><td><?php echo form_input('varvalue',$varvalue,'style="width:200px"');?></td>
    </tr>
    <tr>
        <td>Var Len</td><td><?=form_input('varlen',$varlen);?></td>
    </tr>    
    <tr>     
        <td>Keterangan</td><td><?php echo form_input('keterangan',$keterangan,'style="width:300px"');?></td>         
    </tr>
    <tr>     
        <td>Kelompok</td><td><?php echo form_input('category',$category,'style="width:300px"');?></td>         
    </tr>
    <tr>     
        <td>Section</td><td><?php echo form_input('section',$section,'style="width:300px"');?></td>         
    </tr>
    <tr>     
        <td>VarType</td><td><?php echo form_input('vartype',$vartype,'style="width:300px"');?></td>         
    </tr>
    <tr>     
        <td>VarList</td><td><?php echo form_input('varlist',$varlist,'style="width:300px"');?></td>         
    </tr>
    
    <tr>     
        <td>Id</td><td><?php echo form_hidden('id',$id," locked");?></td>         
    </tr>
     <tr><td><input type="hidden" value="Save" class='btn btn-primary'/></td><td>&nbsp;</td></tr>
   </table>
</form>
</div></div>

<script language="JavaScript">
	var url=CI_ROOT+'sysvar_data/view/<?=$id?>';
	function save_bukti(){
			$('#frmMain').form('submit',{
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					    remove_tab_parent();
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang');
				}
			});
		
	}	
	
</script>
