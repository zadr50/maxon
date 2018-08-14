<p><i>*Silahkan isi atau scan nama barang di kotak bawah ini:</i></p>
<p><span class='glyphicon glyphicon-barcode'></span> Kode Barang : <br>
    <?php echo form_input("barcode","","id='barcode' style='width:200px'");
    echo link_button('Find','dlginventory_show();return false;','search','false');
    ?>
    </p>
<p><?php echo form_input("item_nama_barang","","id='item_nama_barang' title='Nama Barang' style='width:250px'");?></p>
<p>Qty : <?=form_input("qty","0","id='qty' class='calc_input' style='width:50px'")?>
    Harga : <?=form_input("item_price","0","id='item_price' class='calc_input'  style='width:100px'")?></p>
<p>Disc% 1 : <?=form_input("item_disc_prc","0","id='item_disc_prc'  class='calc_input'  style='width:40px'")?>
   Rp.: <?=form_input("item_disc_amt","0","id='item_disc_amt' class='calc_input' style='width:100px'")?></p>
<p>Disc% 2 : <?=form_input("item_disc_prc_2","0","id='item_disc_prc_2'  class='calc_input'  style='width:40px'")?>
   Rp.: <?=form_input("item_disc_amt_2","0","id='item_disc_amt_2' style='width:100px'")?></p>
<p>Disc% 3 : <?=form_input("item_disc_prc_3","0","id='item_disc_prc_3'  class='calc_input'  style='width:40px'")?>
   Rp.: <?=form_input("item_disc_amt_3","0","id='item_disc_amt_3' style='width:100px'")?></p>
<p>Discount Rp.: <?=form_input("dis_amount_ex","0","id='disc_amount_ex' class='calc_input' ")?></p>
<p>Jumlah Rp.: <?=form_input("item_total","0","id='item_total' disabled")?></p>
<p>TourGuide Rp.: <?=form_input("item_komisi_tour","0","id='item_komisi_tour' style='width:100px'")?></p>
<p>Tenant : <?=form_input("item_tenant","","id='tenant' style='width:50px'")?>
Ref# : <?=form_input("item_ref","","id='ref' style='width:80px'")?></p>
<?=link_button('Add Item','add_row_sales()','save','false')?>

