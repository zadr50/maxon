<form id='frmItem'>
    <h1>Pilih nama barang</h1>
    <h3>Silahkan pilih kode atau nama barang dibawah ini</h3>
    <p>Kemudian isi field quantity.</p>
    <table>
        <?=form_hidden('invoice_number',$invoice_number,'id=invoice_number')?>
        <tr><td>Nama Barang</td><td><?=form_dropdown('item_number',$item_lookup
                ,'','id=item_number  onblur="find()" style="width:30px"');?></td></tr>
        <tr><td>Quantity</td><td><?=form_input('quantity','1','id=quantity style="width:30px"')?></td></tr>
        <tr><td>Satuan</td><td><?=form_input('unit','','id=unit style="width:30px"')?></td></tr>
        <tr><td>Price</td><td><?=form_input('price','0','id=price  style="width:30px"')?></td></tr>        
        <tr><td></td><td><?=form_hidden('cost',0)?></td></tr>        
    </table>
</form>
<div id='item_no'></div>
<script language='javascript'>
function find(){
    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val();
    console.log(xurl);
    $.ajax({
                type: "GET",
                url: xurl,
                data:'item_no='+$('#item_number').val(),
                success: function(msg){
                    var obj=jQuery.parseJSON(msg);
                    $('#price').val(obj.retail);
                    $('#cost').val(obj.cost);
                    $('#unit').val(obj.unit_of_measure);
                },
                error: function(msg){alert(msg);}
    });
};
</script>