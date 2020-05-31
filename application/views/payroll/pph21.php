<?php
    $CI =& get_instance();        
    $CI->load->library("form_builder");
    echo load_view("aed_button");
    if($tahun=="")$tahun=date("Y");
    if($bulan=="")$bulan=date("m");    
?>
<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
    <div title="Umum" id="box_section" style="padding:10px">    
        <form id="frmMain" method='post' >
           <table class='table2' width='100%'>
                <tr>
                    <td>Nip</td><td>
                    <?php 
                        echo form_input('nip',$nip,"id='nip'"); 
                        echo link_button('','dlgemployee_show()',"search","false");                  
                    ?>
                    <span id='nama'></span>
                </tr>
                <tr><td>Nomor</td><td><?=form_input('nomor',$nomor,"id='nomor'");?></td></tr>    
                <tr><td>Keterangan</td><td><?=form_input('keterangan',$keterangan,"id='keterangan' style='width:300px'");?></td></tr>    
                <tr><td>Rumus</td><td><?=form_input('rumus',$rumus,"id='rumus' style='width:300px'");?></td></tr>    
                <tr><td>Kelompok</td><td><?=form_input('kelompok',$kelompok,"id='kelompok'");?></td></tr>    
                <tr><td>Tahun</td><td><?=form_input('tahun',$tahun,"id='tahun'");?></td></tr>    
                <tr><td>Bulan</td><td><?=form_input('bulan',$bulan,"id='bulan'");?></td></tr>    
            </table>
            <?=form_hidden("id",$id,"id='id'")?>
            <?=form_hidden("mode",$mode,"id='mode'")?>
        </form>
    </div>
</div>
<?php
echo $lookup_employee;
?>

<script language="JavaScript">
    function save_aed(){
        if($('#nip').val()==''){log_err('Isi kode/nip pegawai !');return false;}
        url='<?=base_url()?>index.php/payroll/pph21/save';
            $('#frmMain').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                        $("#id").val(result.id);
                        $('#mode').val('view');
                        remove_tab_parent();
                        log_msg('Data sudah tersimpan.');
                    } else {
                        log_err(result.msg);
                    }
                }
            });
        
    }
</script>
