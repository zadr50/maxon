<?php
date_default_timezone_set("Asia/Jakarta");
//echo gmdate("Y-m-d H:i:s", time()+60*60*7);
date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y-M-d H:i:s");
if ($set_tanggal = $this->session->userdata("set_tanggal")) {
    $tanggal = $set_tanggal;
}

//$tanggal = date("d F Y");
//echo $tanggal;
/*
if($this->session->userdata('pos')==''){
	echo "<p>Belum ada session yang aktif untuk user anda, silahkan bikin terlebih dahulu.</p>";
	echo "<p><a href='".base_url()."index.php/pos/new_session'>Buat Session Baru</a></p>";
} else {
*/

///	header('Location: http://'.base_url().'index.php/pos');
//}
$ukuran_nota = getvar("ukuran_nota", 0);
if ($ukuran_nota == "") $ukuran_nota = 0;
if ($ukuran_nota == 1) {
    $width_nota = 800;
} else {
    $width_nota = 500;
    $width_nota = 300;
}
$user_id = user_id();
if ($pembulatan == "") $pembulatan = 0;

?>
<input type='hidden' id='debit' name='debit'>

<div class='row' style="background:#eee">
    <div class='col-md-12'>
        <div class='col-md-2 col-sm-2 col-xs-3 sidebar'>
            <div class='col-md-12'>
                <a href="<?= base_url() ?>" target="_blank">
                    <img src="<?= base_url('images/logo_maxon.png') ?>" width='100%' height='100px'>
                </a>
            </div>
            <div class='col-md-12'>
                <div class='row nama_toko'>
                    <?php include_once "page_toko.php"; ?>
                </div>
                <div class='row'>
                    <?php include_once "page_sidebar.php"; ?>
                </div>
            </div>
        </div>
        <div class='col-md-7 col-xs-6 gradient' style="padding:15px;overflow:scroll;">
            <div class='pos'>
                <div class='pos-content'>
                    <div class='col-md-12'>
                        <div class='row'>
                            <?php include_once "page_top.php"; ?>
                        </div>
                        <div class='row thumbnail'>
                            <div class='nota col-sm-12' id="divNota" style="overflow:scroll"></div>
                        </div>
                        <div class='row' style="border:1px solid lightgray;padding:5px">
                            <div class="col-md-10">
                                <?php include_once "page_tool_row.php"; ?>
                                <?php include_once "page_total.php"; ?>
                            </div>
                            <div class="col-md-2">
                                <div class="thumbnail" style="height:80px;width:100px">Picture</div>
                            </div>
                        </div>
                        <div class='row thumbnail' style="background: #e0d3f6; display:none">
                            <?php include_once "page_bayar.php"; ?>
                        </div>
                        <div class='row thumbnail' style="color:white;background: #6868a8;">
                            <p><span id='msg-box-wrap'>Ready..</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-3 col-xs-3' style="background: #6868a8;padding:2px;height:650px;
        background-image: linear-gradient(to right, rgba(255,0,0,0), #eff5ff);overflow-y:scroll">
            <div class='thumbnail'>
                <?php include_once "input_barang.php"; ?>
            </div>
            <div class='thumbnail' id="divButtons">
               <?php include_once "page_button_pos.php"; ?>
            </div>
            <div class='thumbnail'>
                <p><strong>Daftar Nota Open</strong>
                    <?= link_button("Show All", "dlgNotaOpen_show();return false;", "search") ?>
                </p>
                <div id="divNotaOpenLoading" style="display:none">
                    <img src="<?= base_url("images/loading_little.gif") ?>">
                </div>
                <div id='divNotaOpen'>
                </div>
            </div>
        </div>
    </div>
    <div id='dlgNotaPrint' class="easyui-dialog" closed="true" buttons="#btnPrint" style="width:<?= $width_nota ?>px;height:600px;padding:5px 5px;left:100px;top:20px">
        <div id='divNotaPrint' style="padding:10px; font-family: 'Arial';"></div>
    </div>
    <div id="btnPrint">
        <?= link_button("Close", "print_close()", "cancel", "false"); ?>
        <?= link_button("Cetak", "print_nota()", "print", "false"); ?>
    </div>

<?php
    echo $lov_customers;
    echo $lov_inventory;

    include_once "payment.php";
    include_once "setting.php";
    include_once "card_payment.php";
    include_once "voucher_payment.php";
    include_once "cash_payment.php";
    include_once "gopay_payment.php";
    include_once "split_payment.php";
    include_once "inventory/select_unit_jual.php";
    include_once "offline.php";
    //include_once "menu_reports.php";
    //include_once "nota_open.php";
    include_once "page_nota_open.php";
?>

<div id="dlgMain" name='dlgMain' class="easyui-dialog" 
    style="width:1000px;height:600px;padding:5px;left:10px;top:10px" closed="true">
    <div class="easyui-tabs" id="tt" style="padding:3px;min-height:600px"></div>
</div>

<script type='text/javascript' language="JavaScript">
    var base_url = '<?= base_url() ?>';
    var url_cat = '<?= base_url() ?>index.php/inventory/pos_category/';
    var url_item_filter = '<?= base_url() ?>index.php/inventory/pos_items_filter/';
    var url_list_barang = '<?= base_url() ?>index.php/inventory/pos_items/';
    var url_save_pos = "<?= base_url() ?>pos.php/invoice/save_pos";
    var url_edit_nota = "<?= base_url() ?>pos.php/invoice/edit_nota/";
    var url_print_nota = "<?= base_url() ?>pos.php/invoice/print_nota/";
    var url_nota = "<?= base_url() ?>pos.php/invoice/";
    var nama_toko = "<?= $nama_toko ?>";
    var alamat = "<?= $street ?>";
    var telp = "<?= $phone_number ?>";
    var kota = "<?= $city_state_zip_code ?>";
    var url_item_find = '<?= base_url() ?>index.php/inventory/find/';
    var tanggal = "<?= str_pad(date("Y-m-d H:i:s"), 10, "&nbsp") ?>";
    var kasir = "<?= str_pad(user_id(), 10, "&nbsp") ?>";
    var trun = 0;
    var ukuran_nota = <?= $ukuran_nota ?>;
    var pembulatan = <?= $pembulatan ?>;

    $(document).ready(function() {

        tambah();

        $(".link2").click(function(event) {
            event.preventDefault();
            $("#dlgMenuProcess").dialog("close");
            $("#dlgMain").dialog("open").dialog('setTitle', 'Dialog');
            var url = $(this).attr('href');
            console.log(url);
            var n = url.lastIndexOf("/");
            var j = url.lastIndexOf("#");
            if (j > 0) {
                var title = url.substr(j + 1);
            } else {
                var title = url.substr(n + 1);
            }
            add_tab_parent(title, url);
        });
        run_timer();
        run_timer_replicate();
    });
</script>