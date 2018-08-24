
<div id='dlgVoucher'  class="easyui-dialog"  closed="true"  buttons="#btnCard" 
style="width:500px;height:400px;padding:10px 10px;left:200px;top:100px">
    <div class='thumbnailx'>
        <table class='table' width="450px">
        <tr><td>Nomor Voucher </td><td><?=form_input('credit_card_number',"","id='voucher_no' style='width:200px'")?></td></tr>        
        <tr><td>Nominal </td><td><?=form_input('voucher_amount',"","id='voucher_amount' style='width:200px'")?></td></tr>        
        <tr><td> </td><td><?=form_input('dlgVoucher_flag',"","id='dlgVoucher_flag' disabled style='width:20px'")?></td></tr>        
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
        flag=$("#dlgVoucher_flag").val();
        if(flag=="9"){
        	dlgPaySplit_Voucher_Submit();
        } 
        $("#dlgVoucher").dialog("close");        
    }    
    
</script>