
<div id='dlgVoucher'  class="easyui-dialog"  closed="true"  buttons="#btnCard" 
style="width:500px;height:400px;padding:10px 10px;left:200px;top:100px">
    <div class='thumbnailx'>
        <table class='table' width="450px">
        <tr><td><b>Nomor Voucher</b></td><td><?=form_input('credit_card_number',"","id='voucher_no' style='width:200px'")?></td></tr>        
        <tr><td><b>Dibayar Rp.</b></td><td><?=form_input('voucher_amount',"","id='voucher_amount' style='width:200px'")?></td></tr>        
        <tr><td><b>Voucher Rp.</b></td><td><?=form_input('voucher_alloc',"","id='voucher_alloc' style='width:200px' ")?></td></tr>        
        </table>
    </div>    
    <div style="display:none">
        <?=form_input('dlgVoucher_flag',"","id='dlgVoucher_flag' disabled style='width:20px'")?>    	
    </div>
</div>
<div id="btnCard">
    <?=link_button("CANCEL","dlgVoucher_Cancel()","cancel");?>
    <?=link_button("SUBMIT","dlgVoucher_Ok()","save");?>
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
        var voucher_amount=$("#voucher_amount").val();
        if(voucher_amount==""){
        	log_err("Isi nominal voucher !");return false;
        }
    	var ttl_sisa_split=cval("#dlgPaySplit_Sisa");
        
        if (voucher_amount>ttl_sisa_split && ttl_sisa_split>0){
        	$("#voucher_alloc").val(ttl_sisa_split);
        }
        flag=$("#dlgVoucher_flag").val();
        if(flag=="9"){
        	dlgPaySplit_Voucher_Submit();
        }
        has_voucher=true; 
        $("#dlgVoucher").dialog("close");        
        
    }    
    
</script>