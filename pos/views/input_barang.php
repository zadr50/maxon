<table class='table2'>
<tr>
    <td>
        <span class='glyphicon glyphicon-barcode'></span> Cari nama barang atau scan barcode : 
    </td>
</tr>
<tr>
    <td>
        <?php echo form_input("barcode","","id='barcode' style='width:60%' onblur='find_barcode();return false;'
            title='Silahkan isi atau scan nama barang di kotak bawah ini'" );
            echo link_button('Find','dlginventory_show();return false;','search','false');
        ?>  
    </td>
</tr>    
<tr>
    <td>
    <?php echo form_input("item_nama_barang","","id='item_nama_barang' title='Nama Barang' style='width:60%'");?>    
    </td>    
</tr>
<tr>
    <td>
        Qty : <?=form_input("qty","0","id='qty' class='calc_input' style='width:40px'")?>
        Unit : <?=form_input("unit","","id='unit' class='calc_input' style='width: 40px'")?>
        <span id='cmdLovUnit' style="display:none">
            <?=link_button("", "searchUnit();return false","search")?>            
        </span>
    </td>
</tr>
<tr>
    <td>
        Harga : <?=form_input("item_price","0","id='item_price' class='calc_input'  style='width:100px'")?>        
    </td>    
</tr>
<tr>
    <td colspan="2">
        <div id="divMultiUnit" style="display:none">
            M Qty : <?=form_input("m_qty","0","id='m_qty' class='calc_input_m' style='width:50px'")?>
            M Unit : <?=form_input("m_unit","","id='m_unit' class='calc_input_m' style='width: 50px'")?>
            <br>M Price : <?=form_input("m_price","","id='m_price' class='calc_input_m' style='width: 100px'")?>
        </div>
    </td>
    
</tr>

<tr>
    <td>
        Disc% 1 : <?=form_input("item_disc_prc","0","id='item_disc_prc'  class='calc_input'  style='width:40px'")?>
        Rp.: <?=form_input("item_disc_amt","0","id='item_disc_amt' class='calc_input' style='width:100px'")?>
    </td>
</tr>
<tr>
    <td>
        Disc% 2 : <?=form_input("item_disc_prc_2","0","id='item_disc_prc_2'  class='calc_input'  style='width:40px'")?>
        Rp.: <?=form_input("item_disc_amt_2","0","id='item_disc_amt_2' style='width:100px'")?>
    </td>
</tr>
<tr>
    <td>
       Disc% 3 : <?=form_input("item_disc_prc_3","0","id='item_disc_prc_3'  class='calc_input'  style='width:40px'")?>
       Rp.: <?=form_input("item_disc_amt_3","0","id='item_disc_amt_3' style='width:100px'")?>
        
    </td>
</tr>
<tr>
    <td>
        Discount Rp.: <?=form_input("dis_amount_ex","0","id='disc_amount_ex' class='calc_input' ")?>        
    </td>
</tr>
<tr>
    <td>
        Jumlah Rp.: <?=form_input("item_total","0","id='item_total' disabled")?>
    </td>
</tr>
<tr>
    <td>
        Komisi Rp.: <?=form_input("item_komisi","0","id='item_komisi' style='width:100px'")?>
    </td>
</tr>
<tr>
    <td>
        Tenant : <?=form_input("item_tenant","","id='tenant' style='width:50px'")?>
        Ref# : <?=form_input("item_ref","","id='ref' style='width:80px'")?>
    </td>
</tr>
<tr>
    <td>
        <span id='divLineId' style='display:none'>
            Line: <?=form_input("line","","id='line' style='width:50px'")?>                   
        </span>
    </td>
</tr>
<tr>
    <td>
        <?=link_button('Add Item','add_row_sales()','save','false')?>
        QtySld <b><span id='qty_saldo'>0</span></b>
        QtyMin <b><span id='qty_min'>0</span></b>
    </td>
</tr>

</table>

<script language="JavaScript">
    
    function calc_qty_unit(){
        //console.log("calc_qty_unit");
        if(qty_conv=="")qty_conv=1;
        if(qty_conv=="0")qty_conv=1;
        qty2=$("#qty").val();
        qty2=qty2*qty_conv;
        //$("#m_qty").val(qty2);
    }


</script>
