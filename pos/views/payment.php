<div id='dlgPay' class="easyui-dialog" 
style="width:600px;height:450px;
    padding:10px 20px;left:100px;top:20px" closed="true" 
    buttons="#tbPay" modal='true'>
    <table width='100%' class='table'>
    <tr><td><strong>Jumlah Tagihan </strong></td>
       <td><input  type='text' name='dlgPay_tagih' id='dlgPay_tagih' disabled></td>
    </tr>
    <tr><td><strong>Bayar Pakai Cash</strong></td>
        <td><?=form_input('cash',"","id='cash' onblur='total_nota()'")?></td>
    </tr>
    <tr><td><strong>Bayar Credit Card</strong></td>
        <td><?=form_input('creditcard',"","id='creditcard'  onblur='total_nota()'")?></td>
    </tr>
    <tr><td><strong>Bayar Debit Card</strong></td>
        <td><?=form_input('debitcard',"","id='debitcard'  onblur='total_nota()'")?></td>
    </tr>
    <tr><td><strong>Jumlah Bayar</strong></td>
        <td><?=form_input('bayar',"","id='bayar'  onblur='total_nota()' disabled")?></td>
    </tr>
    <tr><td><strong>Jumlah Sisa/Kembalian </strong></td>
        <td><input  type='text' name='dlgPay_sisa' id='dlgPay_sisa' disabled></td>
    </tr>
    
    </table>
</div>  
<div id='tbPay'>
    <?=link_button('Submit','submit_payment()','save','false')?>
</div>