<div>
<div class="thumbnail">
<?php echo validation_errors(); ?>
<?php 
if($mode=='view'){
    echo form_open('sysvar_data/update');
    $disabled='disable';
} else {
    $disabled='';
    echo form_open('sysvar_data/add'); 
}
?> 
<table class='table'>
    <tr>
        <td>Var Name</td><td><?=form_input('varname',$varname);?></td>
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
        <td>Id</td><td><?php echo form_input('id',$id," locked");?></td>         
    </tr>
     <tr><td><input type="submit" value="Save" class='btn btn-primary'/></td><td>&nbsp;</td></tr>
   </table>
</form>
</div></div>