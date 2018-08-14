<div>
<div class="thumbnail">
<?php echo validation_errors(); ?>
<?php 
if($mode=='view'){
	echo form_open('nomor/update');
	$disabled='disable';
} else {
	$disabled='';
	echo form_open('nomor/add'); 
}
?> 
<legend>SISTIM PENOMORAN</legend>
   <table class='table'>
	<tr>
		<td>Kode</td><td>
		<?php
		if($mode=='view'){
			echo "<strong>$varname</strong>";
			echo form_hidden('varname',$varname);
		} else { 
			echo form_input('varname',$varname);
		}		
		?></td>
	</tr>	 
       <tr>
            <td>Value</td><td><?php echo form_input('varvalue',$varvalue,'style="width:400px"');?>
            	</br><i>Isi formula penomoran dengan simbol pemisah ~. Simbol ! sisip text, @ simbol, 
            		#DD - tanggal, #MM -bulan, #YY - tahun, $00001 - nomor urut 5 digit mulai dari nomor 1,
            		?MM - reset nomor jadi 1 tiap bulan, ?YY - reset nomor jadi 1 tiap tahun,
            		@COM - sisip kode perusahaan</i>
            </td>

       </tr>
	<tr>	 
		<td>Keterangan</td><td><?php echo form_input('keterangan',
                        $keterangan,'style="width:400px"');?></td>		 
	</tr>
	 <tr><td><input type="submit" value="Save" class='btn btn-primary'/></td><td>&nbsp;</td></tr>
   </table>
</form>
</div></div>