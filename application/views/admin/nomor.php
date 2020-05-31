<div class='thumbnail box-gradient'>
    <?=link_button("Save","on_save();return false;","save")?>
    <?=link_button("Delete","on_delete();return false;","remove")?>
    <div style='float:right'>
        <?=link_button("Close","remove_tab_parent()","cancel")?>
        
    </div>
</div>
<div class='thumbnail'>
    
<?php 
if($mode=='view'){
    $locked='readonly';
} else {
    $locked='';
}

echo form_open(base_url("index.php/nomor/save"),"name='frmNomor' id='frmNomor'");
?> 
<input type='hidden' value='<?=$id?>' id='id' name='id'>
<input type='hidden' value='<?=$mode?>' id='mode' name='mode'>

   <table class='table'>
	<tr>
		<td>Kode</td>
		<td>
		<?php
	    echo form_input('varname',$varname,"id='varname' $locked style='width:300px'");
		?>
		</td>
	</tr>	 
       <tr>
            <td>Value</td><td><?php echo form_input('varvalue',$varvalue,"id='varvalue' style='width:400px'");?>
            	</br><i>Isi formula penomoran dengan simbol pemisah ~. Simbol ! sisip text, @ simbol, 
            		#DD - tanggal, #MM -bulan, #YY - tahun, $00001 - nomor urut 5 digit mulai dari nomor 1,
            		?MM - reset nomor jadi 1 tiap bulan, ?YY - reset nomor jadi 1 tiap tahun,
            		@COM - sisip kode perusahaan, @GDG - sisip kode gudang</i>
            
            </td>

       </tr>
	<tr>	 
		<td>Keterangan</td><td><?php echo form_input('keterangan',
                        $keterangan,'style="width:400px"');?></td>		 
	</tr>
   </table>
</form>

</div>

<script language="JavaScript">
    
    function on_save(){
        var varname=$("#varname").val();
        if(varname==""){log_err("Isi varname !");return false};
        loading();
            $('#frmNomor').form('submit',{
                onSubmit: function(){
                    return $(this).form('validate');
                },
                url: CI_ROOT+"nomor/save",
                success: function(result){
                    loading_close();
                    var result = eval('('+result+')');
                    if (result.success){
                        log_msg('Data sudah tersimpan');
                        remove_tab_parent();
                    } else {
                        log_err(result.msg);
                    }
                }
            });
    }    
    function on_delete(){
        var id=$("#id").val();
        loading();
        $.ajax({
            type : 'GET',
            url : '<?=base_url();?>index.php/nomor/delete/'+id,
            success: function (result) {                
                var result = eval('('+result+')');
                if (result.success){
                    log_msg('Data berhasil dihapus.');
                    remove_tab_parent();
                } else {
                    log_err(result.msg);
                }
            }
        })
        
    }
</script>