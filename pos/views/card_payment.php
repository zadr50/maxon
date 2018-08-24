<?php
$list_rekening=$this->bank_accounts_model->select_edc();
?>

<div id='dlgCard'  class="easyui-dialog"  closed="true"  buttons="#btnCard" 
style="width:500px;height:400px;padding:10px 10px;left:200px;top:100px">
    <div class='thumbnailx'>
        <table class='table' width="450px">
        <tr><td>Rekening Bank /EDC* </td><td><?=form_dropdown('credit_card_type',$list_rekening,'',"id='credit_card_type' style='width:200px'")?></td></tr>
        <tr><td>Jumlah Bayar </td><td><?=form_input('card_amount',"","id='card_amount' style='width:200px'")?></td></tr>
        <tr><td>Jenis Kartu </td><td><?=form_input('from_bank',"","id='from_bank' style='width:200px'")?></td></tr>
        <tr><td>Nomor Kartu </td><td><?=form_input('credit_card_number',"","id='credit_card_number' style='width:200px'")?></td></tr>
        <tr><td>Pemilik </td><td><?=form_input('authorization',"","id='authorization' style='width:200px'")?></td></tr>
        <tr><td>Expire </td><td> <?=form_input('expiration_date',"","id='expiration_date' style='width:200px'")?></td></tr>                
        <tr><td colspan=3><i>* Harus diisi</i></td></tr>
        <tr><td><?=form_input("dlgCard_flag1","","id='dlgCard_flag1' disabled style='width:50px'")?></td></tr>
        </table>
    </div>    
</div>
<div id="btnCard">
    <?=link_button("CANCEL","dlgCard_Cancel()","cancel");?>
    <?=link_button("SUBMIT","dlgCard_Ok()","save");?>
</div>
