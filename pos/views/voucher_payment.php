
<div id='dlgVoucher'  class="easyui-dialog"  closed="true"  buttons="#btnCard" 
style="width:500px;height:400px;padding:10px 10px;left:200px;top:100px">
    <div class='thumbnailx'>
        <table class='table' width="450px">
        <tr><td>Nomor Voucher </td><td><?=form_input('credit_card_number',"","id='voucher_no' style='width:200px'")?></td></tr>        
        </table>
    </div>    
</div>
<div id="btnCard">
    <?=link_button("CANCEL","dlgVoucher_Cancel()","cancel");?>
    <?=link_button("OK","dlgVoucher_Ok()","ok");?>
</div>


<script language="JavaScript">
    function voucher_info(){
        $("#dlgVoucher").dialog("open").dialog('setTitle','Info Voucher');
    }
    function dlgVoucher_Cancel(){
        $("#voucher_no").val("");
        $("#dlgVoucher").dialog("close");
    }
    function dlgVoucher_Ok(){
        var voucher=$("#voucher_no").val();
        if(voucher==""){
            log_err("Isi nomor voucher !");
            return false;
        }
        $("#dlgVoucher").dialog("close");        
    }    
    
</script>