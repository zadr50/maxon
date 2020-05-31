<div>
<div class="thumbnail">
<?php 

echo load_view('gl/select_coa_link');    

echo validation_errors();

if($mode=='view'){
	echo form_open('lookup/update');
	$disabled='disable';
} else {
	$disabled='';
	echo form_open('lookup/add'); 
}
?> 
<legend>Lookup Variable Name</legend>
<table class='table'>
	<tr>
		<td>Kode</td><td>
		<?=form_input('varname',$varname,'style="width:200px"');?></td>
	</tr>	 
       <tr>
            <td>Value</td><td><?php echo form_input('varvalue',$varvalue,'style="width:200px"');?></td>
       </tr>
	<tr>	 
		<td>Keterangan</td><td><?php echo form_input('keterangan',$keterangan,'style="width:300px"');?></td>		 
	</tr>
    <tr>     
        <td>COA 1 (ex: Persediaan)</td><td><?php echo form_input('coa1',$coa1,"id='coa1' style='width:300px'");
                echo link_button('',"lookup_coa('coa1')","search","false"); 
            
            ?></td>         
    </tr>
    <tr>     
        <td>COA 2 (ex: Harga Pokok Penjualan)</td><td><?php echo form_input('coa2',$coa2,"id='coa2' style='width:300px'");
                echo link_button('',"lookup_coa('coa2')","search","false"); 
            
            ?></td>         
    </tr>
    <tr>     
        <td>COA 3 (ex: Penjualan)</td><td><?php echo form_input('coa3',$coa3,"id='coa3' style='width:300px'");
                echo link_button('',"lookup_coa('coa3')","search","false"); 
            
            ?></td>         
    </tr>
    <tr>     
        <td>COA 4</td><td><?php echo form_input('coa4',$coa4,"id='coa4' style='width:300px'");
                echo link_button('',"lookup_coa('coa4')","search","false"); 
            
            ?></td>         
    </tr>
    <tr>     
        <td>COA 5</td><td><?php echo form_input('coa5',$coa5,"id='coa5' style='width:300px'");
                echo link_button('',"lookup_coa('coa5')","search","false"); 
            
            ?></td>         
    </tr>
    <tr>     
        <td>Sifat (0 - Plus, 1 - Minus)</td><td><?php echo form_input('plus_minus',$plus_minus,"id='plus_minus' ");
            ?></td>         
    </tr>
    <tr>     
        <td>Id</td><td><?php echo form_input('id',$id,"id='id' readonly");
            ?></td>         
    </tr>
	
	 <tr><td><input type="submit" value="Save" class='btn btn-primary'/></td><td>&nbsp;</td></tr>
   </table>
</form>
</div></div>