<div id='dlgMenuProcess'  class="easyui-dialog"  closed="true">
    <div class='thumbnail' style='padding:10px'>
        <li><?=anchor(base_url("pos.php/receive_toko"),
            "01. Penerimaan Barang dari pusat","class='info_link2'")?></li>
        <li><?=anchor(base_url("pos.php/retur_toko"),
            "02. Retur barang ke pusat","class='info_link2'")?></li>
        <li><?=anchor(base_url("pos.php/stock_mutasi"),
            "03. Kirim barang ke toko lain","class='info_link2'")?></li>
    </div>    
</div>
<script type='text/javascript' language="JavaScript">
    function dlgMenuProcess_Show(){
        $("#dlgMenuProcess").dialog("open").dialog('setTitle','Menu Proses');        
    }    
</script>
