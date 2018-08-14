<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/salesman/kelompok/add');		
	echo link_button('Search','','search','true',base_url().'index.php/salesman/kelompok/browse');		
	echo link_button('Help', 'load_help(\'salesman_group\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('salesman')">Help</div>
		<div onclick="show_syslog('salesman_group','<?=$groupid?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
</div>
<div class="thumbnail">	
<form id="myform"  method="post" action="<?=base_url()?>index.php/salesman/kelompok/save">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php echo validation_errors(); ?>
   <table class='table' width='100%'>
	<tr>
		<td>Kelompok Salesman</td><td>
		<?php
		if($mode=='view'){
			echo "<strong>$groupid</strong>";
			echo form_hidden('groupid',$groupid,"id=groupid");
		} else { 
			echo form_input('groupid',$groupid,"id=groupid");
		}		
		?></td>
	</tr>	 
       <tr>
            <td>Komisi Rate (%)</td><td><?php echo form_input('komisiprc',$komisiprc);?></td>
       </tr>
       <tr>
            <td>Keterangan</td><td><?php echo form_input('remarks',$remarks);?></td>
       </tr>
   </table>
</form>
</div>   
<script type="text/javascript">
    function save_this(){
        if($('#groupid').val()===''){alert('Isi dulu kode kelompok salesman !');return false;};
        $('#myform').submit();
    }
</script>  

 
 