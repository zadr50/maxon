<?php
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($CI->access->cid)->row();
$terbilang="";

load_view('barcode/BarcodeGenerator.php');
load_view('barcode/BarcodeGeneratorPNG.php');
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="1" width='100%'> 
<tr><td colspan=9><h2>MANIFEST PENGIRIMAN</h2></td></tr>
<tr><td colspan=9><h2>
    <?php
    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($manifest->code, 
            $generator::TYPE_CODE_128)) . '">';
    echo '<br>'.$manifest->code;
    
    ?></h2></td></tr>
<tr><td>Tanggal</td><td><?=$manifest->date_mf?></td>
    <td>Berangkat</td><td><?=$manifest->date_go?></td>
    <td>Sampai</td><td><?=$manifest->date_to?></td>
    <td></td><td></td><td></td>
</tr>
<tr><td>Penanggung Jawab</td><td><?=$manifest->person?></td> 
<td>Kendaraan</td><td><?=$manifest->plat_no?></td>
    <td></td><td></td>
    <td></td><td></td><td></td>

</tr>
<?php 
echo "<tr><td><strong>BookNo</strong></td><td><strong>Barang</strong></td>
<td><strong>Qty</strong></td><td><strong>Weight</strong></td><td><strong>Volume</strong></td>
<td><strong>Pengirim</strong></td><td><strong>Penerima</strong><td><strong>Tujuan</strong></td>
<td align='right'><strong>Biaya</strong></td>
</tr>";
$qty=0;             $volume=0;
$berat=0;
$biaya=0;

foreach($items->result() as $item){
    echo "<tr><td>$item->book_no</td><td>$item->jenis_barang</td><td>$item->banyaknya</td>
    <td>$item->berat</td><td>$item->volume</td>
    <td>$item->pengirim</td><td>$item->penerima</td><td>$item->tujuan</td>
    <td align='right'>".number_format($item->biaya)."</td></tr>";
    $qty+=$item->banyaknya;
    $biaya+=$item->biaya;
    $berat+=$item->berat;
    $volume+=$item->volume;
}

?>
<tr><td><strong>Total Qty</strong></td><td><strong>Total Berat</strong></td>
    <td><strong>Total Volume</strong></td>
    <td></td><td></td>    
    <td></td><td></td><td></td>        
    <td align=right><strong>Total Biaya</strong></td>
</tr>
<tr><td><?=$qty?></td><td><?=$berat?></td><td><?=$volume?></td>
    <td></td><td></td>
    <td></td><td></td><td></td>    
    <td align=right><?=number_format($biaya)?></td>
</tr>
</table>
 

