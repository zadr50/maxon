<form id='frmItem'>
    <h1>Pilih nama barang</h1>
    <h3>Silahkan pilih kode atau nama barang dibawah ini</h3>
    <p>Kemudian isi field quantity.</p>
    <table>
        <?=form_hidden('shipment_id',$shipment_id,'id=shipment_id')?>
        <?=form_hidden('date_received',$date_received,'id=date_received')?>
        <?=form_hidden('supplier_number',$supplier_number,'id=supplier_number')?>
        <?=form_hidden('comments',$comments,'id=comments')?>

        <tr><td>Nama Barang</td><td><?=form_dropdown('item_number',$item_lookup,'','id=item_number');?></td></tr>
        <tr><td>Quantity</td><td><?=form_input('quantity_received','0','id=quantity_received')?></td></tr>
    </table>
</form>
