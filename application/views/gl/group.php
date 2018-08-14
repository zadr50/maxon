<div><h1>KELOMPOK PERKIRAAN<div class="thumbnail">
	<?
	echo link_button('Save', 'simpan()','save');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('coa_group')">Help</div>
		<div onclick="show_syslog('coa_group','<?=$group_type?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/inventory");
		}
	</script>
	
</div></H1>
<div class="thumbnail">	
	<?php echo validation_errors(); ?>
<?php 
    if($mode=='view'){
            echo form_open('coa_group/update','id=myform name=myform');
            $disabled='disable';
    } else {
            $disabled='';
            echo form_open('coa_group/add','id=myform name=myform'); 
    }
?>

    
   <table>
	<tr>
		<td>Kode Group</td><td>
		<?php
		if($mode=='view'){
			echo $group_type;
			echo form_hidden('group_type',$group_type,"id=group_type");
		} else { 
			echo form_input('group_type',$group_type,"id=group_type");
		}		
		?></td>
	</tr>	 
       <tr>
            <td>Nama Kelompok Perkiraan</td><td><?php echo form_input('group_name',$group_name,"style='width:400px'");?></td>
       </tr>
       <tr>
            <td>Parent Kode Group</td><td><?php echo form_input('parent_group_type',$parent_group_type);?>
            </td>
       </tr>
       <tr>
            <td>Jenis</td><td><?php echo form_dropdown( 'account_type',$account_type_list,$account_type);?></td>
       </tr>
 
   </table>
</form>
    

 </div>
 
<script language="JavaScript">
	function simpan(){
		if($("#group_type").val()=="")alert("Isi kode !");
		$("#myform").submit();
	}
</script>
