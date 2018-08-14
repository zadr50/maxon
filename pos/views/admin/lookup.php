<div>
<div class="thumbnail">
<?php echo validation_errors(); ?>
<?php 
if($mode=='view'){
	echo form_open('lookup/update');
	$disabled='disable';
} else {
	$disabled='';
	echo form_open('lookup/add'); 
}
?> 
<legend>DATA LOOKUP</legend>
   <table class='table'>
	<tr>
		<td>Kode</td><td>
		<?php
		if($mode=='view'){
			echo $varname;
			echo form_hidden('varname',$varname);
		} else { 
			echo form_input('varname',$varname);
		}		
		?></td>
	</tr>	 
       <tr>
            <td>Value</td><td><?php echo form_input('varvalue',$varvalue,'style="width:200px"');?></td>

       </tr>
	<tr>	 
		<td>Keterangan</td><td><?php echo form_input('keterangan',$keterangan,'style="width:300px"');?></td>		 
	</tr>
	 <tr><td><input type="submit" value="Save" class='btn btn-primary'/></td><td>&nbsp;</td></tr>
   </table>
</form>
</div></div>