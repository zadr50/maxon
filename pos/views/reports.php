<div class='container'>
    <div class='row'>
        <legend>Daftar Laporan</legend>
        <div class='alert alert-info'>
            <p>Silahkan pilih daftar laporan dibawah ini: </p>
        </div>
        
    </div>

<div class='row'>
    <div class='col-sm-6'>
        <div class='thumbnail'>
        <li><?=anchor(base_url("pos.php/reports/criteria/rangkum"),
            "01. Rangkuman Penjualan Harian","target='_blank'")?></li>
        <li><?=anchor(base_url("pos.php/reports/criteria/faktur_sum"),
            "02. Penjualan Summary","target='_blank'")?></li>
        <li><?=anchor(base_url("pos.php/reports/criteria/faktur_slsman"),
            "02. Penjualan per Kasir","target='_blank'")?></li>
        <li><?=anchor(base_url("pos.php/reports/criteria/pay_list"),
            "03. Penjualan per Jenis Pembayaran","target='_blank'")?></li>
        <li><?=anchor(base_url("pos.php/reports/criteria/sls_item"),
            "04. Penjualan per Kode Barang","target='_blank'")?></li>
        <li><?=anchor(base_url("pos.php/reports/criteria/sls_cat"),
            "05. Penjualan per Kelompok Barang","target='_blank'")?></li>
            
        <li><?=anchor(base_url("pos.php/reports/criteria/faktur_cust"),
            "06. Penjualan per Kode Pelanggan","target='_blank'")?></li>
        <li><?=anchor(base_url("pos.php/reports/criteria/print_faktur"),
            "07. Penjualan Nota Detail","target='_blank'")?></li>
        <li><?=anchor(base_url("pos.php/reports/criteria/sls_sistim"),
            "08. Penjualan per Sistim","target='_blank'")?></li>
        <li>08. Penjualan per Barang Supplier</li>
        <li>09. Penjualan per Counter</li>
        <li>10. Rugi Laba per Nota</li>
        <li>11. Rugi Laba per Kode Barang</li>
        <li>12. Rugi laba per Kelompok Barang</li>
        <li>13. Rugi Laba per Pelanggan</li>
        <li>14. Rugi Laba per Supplier</li>
        </div>
    </div>
    <div class='col-sm-6'>
        <div class='thumbnail'>
        <li>15. Daftar Kode Promo Aktif</li>
        <li>16. Daftar Kode Promo Expire</li>
        <li>17. Daftar Barang Promosi</li>
        <li>18. Daftar Nota Batal</li>
        <li>19. Daftar Barang (Price List)</li>
        <li>20. Daftar Kode Pelanggan</li>
        <li>21. Daftar Kode Counter</li>
        <li><?=anchor(base_url("pos.php/reports/criteria/slsman_list"),
            "22. Daftar Kode Kasir/SPG","target='_blank'")?></li>
        <li>23. Daftar Kode Supplier</li>
        <li>24. Daftar Kode Toko</li>
        </div>
    </div>
</div>    
    
</div>
<script>
    var CI_BASE="<?=base_url()?>";
</script>
<?php 
    echo $library_src;
    echo $script_head;
?>