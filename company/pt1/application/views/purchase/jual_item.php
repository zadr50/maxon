<?php 
    echo $supplier_list;    
    echo "<div class='alert alert-info'>
        <p>Isi filter pilihan data-data penjualan barang supplier dibawah ini kemudian klik tombol [Refresh]</p>
        <p>Silahkan contreng pada tabel dibawah ini kemudian klik tombol [CreatePO] 
        untuk dibuatkan nomor purchase order (PO) baru atas supplier tersebut.";
    echo "</div>";
    echo form_open(base_url("index.php/po/item_jual/create_po"),"id='frmItem'");
    echo "<table width='100%'>";
    echo "<tr>";    
    $btn_search=link_button("","dlgsupplier_show();return false","search");
    echo my_input_td("Pilih Supplier","supplier_no",'',$btn_search);
    echo "</tr>";
    echo "<tr>";
    echo my_input_date_td("Date From","date_from",date("Y-m-1"));
    echo my_input_date_td("Date To","date_to",date("Y-m-d")." 23:59:59");
    echo "<td>".link_button("Refresh","reload()","reload")."</td>";
    echo "</tr>";
    echo "<div class='row'><div class='col-md-12'>";
    $this->browse->load_js(false);
    $this->browse->set_fields(array("ck","item_number","description","qty","amount"));
    $this->browse->set_url(base_url("index.php/po/item_jual/browse_data"));
    $this->browse->set_id("dgItems");
    $this->browse->set_tool("tb");
    echo $this->browse->refresh();
    echo "<div id='tb' class='box-gradient'>";
    echo form_checkbox("select_all","","","class='cls_select_all'")." Select All ";
    echo link_button("Create PO","create_po();return false","search");
    echo form_close();
    echo "</div>"

    
?>


<script type="text/javascript">
$( document ).ready(function() {
   $('.cls_select_all').change(function() {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));       
   });
});
    function create_po()
    {
        $("#frmItem").submit();
    }
    function reload(){
        var _supp=$("#supplier_no").val();
        var _from=$("#date_from").val();
        var _to=$("#date_to").val();
        var _url='<?=base_url()?>index.php/po/item_jual/browse_data/'+_supp+"/"+_from+"/"+_to;
        $('#dgItems').datagrid({url:_url});     
        $('#dgItems').datagrid('reload');
    }
    
</script>    