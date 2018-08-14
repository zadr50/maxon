<?php
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($CI->access->cid)->row();
//var_dump($book);
//var_dump($items);
$alamat_kepada=$book->ce_company." ".$book->ce_name." ".$book->ce_address1." "
    .$book->ce_address2." ".$book->ce_city." ".$book->ce_country." Phone: ".$book->ce_phone;
$alamat_dari=$book->company." ".$book->sender." ".$book->address1." "
    .$book->address2." ".$book->city." ".$book->country." Phone: ".$book->phone;
$terbilang="";

load_view('barcode/BarcodeGenerator.php');
load_view('barcode/BarcodeGeneratorPNG.php');
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="1" width='100%'> 
<tr><td colspan=5><h2>BUKTI TANDA TERIMA PENGIRIMAN</h2></td><td><?=$book->bk_date?></td></tr>
<tr><td colspan=5><h1>CONSIGNMENT NOTE</h2></td><td><h2>
    <?php
    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book->book_no, 
            $generator::TYPE_CODE_128)) . '">';
    echo '<br>'.$book->book_no;
    
    ?></h2></td></tr>
<tr><td colspan=3><h2>KEPADA/CONSIGNEE</td><td colspan=3><h2>DARI/SHIPPER</h2></td></tr>
<tr><td colspan=3><h4><?=$alamat_kepada?></h4></td><td colspan=3><h4><?=$alamat_dari?></h4></td></tr>
<?php 
echo "<tr><td><strong>Item</strong></td><td><strong>Notes</strong></td>
<td><strong>Qty</strong></td><td><strong>Weight</strong></td>
<td><strong>Volume</strong></td><td align='right'><strong>Biaya</strong></td></tr>";
$pcs=0; $weight=0;
$other=0;   $biaya=0;
foreach($items->result() as $item){
    echo "<tr><td>$item->item</td><td>$item->notes</td><td>$item->qty</td>
    <td>$item->weight</td><td>$item->dimension  </td><td align='right'>".number_format($item->biaya)."</td></tr>";
    $pcs+=$item->qty;
    $weight+=$item->weight;
    $biaya+=$item->biaya;
    
}

$terbilang= ucwords(terbilang(($biaya)));
?>
<tr><td><strong>Jumlah Titipan / Number Of Piece</strong></td>
    <td><strong>Berat / Weight</strong></td>
    <td><strong>Biaya Kirim / Freight</strong></td>
    <td colspan=2><strong>Terbilang</strong></td>
    <td><strong>Service</strong></td>
</tr>
<tr><td><?=$pcs?></td><td><?=$weight?></td>
    <td align='right'><?=number_format($biaya)?></td><td colspan=2><?=$terbilang?></td><td><?=$book->service?></td>
</tr>
<tr><td></td><td></td>
    <td><?=$book->other_amount?></td><td></td><td></td><td></td>
</tr>
<tr><td></td><td></td>
    <td><?=$book->co_amount+$book->other_amount?></td><td></td><td></td><td></td>
</tr>
<tr><td colspan=2><strong>ISI MENURUT PENGAKUAN / CONTENT</strong></td><td colspan=4>Dengan ini menyerahkan TITIPAN, selaku pengirim</td></tr>
<tr><td colspan=2></td><td colspan=4>kami menyatakan bahwa keterangan yang 
    ditulis / dicetak pada lembar ini adalan benar dan kami
    setuju serta tunduk pada pedoman dan syarat pengiriman
</td>
</tr>

<tr><td colspan=4><strong>CATATAN</strong></td><td><strong>Pengirim/Shipper</strong></td>
    <td><strong>Nama / Tanda Tangan</strong></td></tr>
<tr><td colspan=4>*  Alamat PO BOX tidak bisa diantarkan.</td><td></td><td></td></tr>
<tr><td colspan=4>*  Nama dan alamat harus ditulis jelas dan lengkap pada setiap titipan.</td><td></td><td></td></tr>
<tr><td colspan=4>*  Titipan dihari libur akan dikirimkan pada hari kerja berikutnya.</td><td></td><td>Tgl./Date.</td></tr>

</table>
 

