<div id="dlgPayCash" name="dlgPayCash" class="easyui-dialog" style="width:400px;height:350px" buttons="#dlgPayCash_Button" closed="true" >
    <div class="thumbnail">
        <label>Jumlah tagihan</label>
        <p>
        <?=form_input('Jumlah Tagih',0,"id='dlgPayCash_Tagih' disabled align='right'")?>                    
        </p>
        
        <label>Jumlah bayar</label>
        <p>
        <?=form_input('Jumlah Bayar',0,"id='dlgPayCash_Bayar' align='right' onblur='dlgPayCash_Calc();return false;' ")?>                    
        </p>

        <label>Kembalian</label>
        <p>
        <?=form_input('Kembali',0,"id='dlgPayCash_Kembali' disabled  align='right'")?>                    
        </p>
        <p>
            <?=form_input("dlgPayCash_Flag","","id='dlgPayCash_Flag' style='width:20px' disabled ")?>
        </p>
    </div>
</div>
<div id="dlgPayCash_Button">
        <?=link_button("Cancel","dlgPayCash_Cancel()","cancel","false");?>                
        <?=link_button("Submit","dlgPayCash_Submit()","save","false");?>                
</div>
