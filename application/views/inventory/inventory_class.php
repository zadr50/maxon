<h1>KELAS BARANG</h1>
 <div id='thumbnail'>
   <?php 
   if(!isset($kode))$kode="";
   if(!isset($class))$class="";
   echo validation_errors(); ?>
   <?php 
   		if($mode=='view'){
			echo form_open('inventory_class/update','id=myform');
			$disabled='disable';
		} else {
			$disabled='';
   			echo form_open('inventory_class/add','id=myform'); 
   		}
		
   ?>
   
   <table>
	<tr>
		<td>Kode</td><td>
		<?php
		if($mode=='view'){
			echo $kode;
			echo form_hidden('kode',$kode);
		} else { 
			echo form_input('kode',$kode);
		}		
		?></td>
            <td>Kelas</td><td><?php echo form_input('class',$class);?></td>
		<td>
	 <input type="submit" value="Save" class="easyui-linkbutton" 
                   data-options="iconCls:'icon-save'" style="height:30px;width:60px"/>
	 
	 </td>
	 </tr>
   </table>
   </form>
</div>
  