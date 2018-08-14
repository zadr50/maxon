<div id='dlgSet' class="easyui-dialog" style="width:600px;height:450px;
    padding:10px 20px;left:100px;top:20px" closed="true" 
    buttons="#btnDlgSet" modal='true'>
    <form action="" method="post" id="frmSet" name="frmSet">
        
    <table width='100%' class='table'>
    <tr><td><strong>Gudang Aktif </strong></td>
       <td><input  type='text' name='txtGudang' id='txtGudang' 
       value="<?=$default_warehouse?>">
       </br><i>*setting gudang user ada di menu->setting->user->warehose</i>
       </td>
    </tr>
    <tr>
        <td><strong>Ukuran Kertas Nota</strong></td>
        <td>
            <input type='text' name='ukuran_nota' id='ukuran_nota' value='<?=$ukuran_nota?>'>
            </br><i>*Ukuran nota: 0 - Kecil, 1 - Besar</i>
        </td>
    </tr>
    <tr>
        <td><strong>Ubah Tanggal</strong></td>
        <td>
        <input type='text' name='set_tanggal' id='set_tanggal' 
            value='<?=$tanggal?>' 
            class="easyui-datetimebox" 
                required style="width:250px"
                data-options="formatter:format_date,parser:parse_date">
        </br><i>*Ubah tanggal aktif untuk sistim kasir. Berlaku untuk session komputer ini untuk sehari.</i>        
        </td>
    </tr>
    <tr>
        <td><strong>Pembulatan</strong></td>
        <td><input name='pembulatan' value='<?=$pembulatan?>' type='text' id='pembulatan'></td>
    </tr>
    
    </table>

    </form>
    
</div>
<div id="btnDlgSet">
    <?=link_button("Simpan","save_setting()","save","false");?>
</div>
<script language="JavaScript">
    function dlgSetting_Show(){
        $("#dlgSet").dialog("open").dialog('setTitle','Setting');       
        
    }
    function save_setting(){
        var _url_save_setting="<?=base_url('pos.php/sessionset/save_setting')?>";
        $('#frmSet').form('submit',{
            url: _url_save_setting,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    window.open("<?=base_url('pos.php')?>","_self");                                 
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
            }
        });
    }

</script>