<script language="JavaScript">
	var CI_ROOT="<?=base_url()?>";
	var CI_BASE=CI_ROOT;
	
</script>
<?php
	echo $library_src;
	echo $script_head;
?>
<div class="container">
	
<legend>DAFTAR LAPORAN</legend>
<div class="alert alert-info">
	<p>Dibawah ini adalah daftar laporan untuk modul point of sales, 
		silahkan pilih salah salah satu kemudian isi kriteria tanggal 
		atau pilihan lainnya</p>
</div>
<div class='row'>
	
    <div class='col-sm-4'>
        <div class='thumbnail'>
        <!--
    	<li>
			<a href='#' onclick="open_report('reports/criteria/rangkum');">
				01. Rangkuman Penjualan Harian					
			</a>        		
    	</li>
    	-->
    	
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
        <li><?=anchor(base_url("pos.php/reports/criteria/print_faktur_tabel"),
            "07. Penjualan Nota Detail (Tabel)","target='_blank'")?></li>
            
        <li><?=anchor(base_url("pos.php/reports/criteria/sls_sistim"),
            "08. Penjualan per Sistim","target='_blank'")?></li>

		<li><?=anchor('reports/criteria/sls_item_supplier','08. Penjualan per Item Supplier',"class='info_link'")?></li>
		<li><?=anchor('reports/criteria/sls_rl_invoice','09. Rugi Laba per Nota',"class='info_link'")?></li>
		<li><?=anchor('reports/criteria/sls_rl_item','10. Rugi Laba per Item',"class='info_link'")?></li>
		<li><?=anchor('reports/criteria/sls_rl_cat','11. Rugi Laba per Category',"class='info_link'")?></li>
		<li><?=anchor('reports/criteria/sls_rl_supplier','12. Rugi Laba per Supplier',"class='info_link'")?></li>
		<li><?=anchor('reports/criteria/sls_rl_customer','13. Rugi Laba per Customer',"class='info_link'")?></li>
            
        </div>
    </div>
    <div class='col-sm-4'>
        <div class='thumbnail'>
<li><?=anchor('reports/criteria/sls_top_qty','Top Ten Sales by Qty',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/sls_top_amount','Top Ten Sales by Amount',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/sls_cat_wil','Penjualan Salesman, Kategori,Wilayah ',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/sls_wil_cat','Penjualan Wilayah, Kategori ',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/sls_wil_cat2','Penjualan Category, Wilayah ',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/sls_wil_cust','Penjualan Wilayah, Customer ',"class='info_link'")?></li>
        <li>15. Daftar Kode Promo Aktif</li>
        <li>16. Daftar Kode Promo Expire</li>
        <li>17. Daftar Barang Promosi</li>
        <li>18. Daftar Nota Batal</li>
        <li>19. Daftar Barang (Price List)</li>
        <li>21. Daftar Kode Counter</li>
        <li><?=anchor(base_url("pos.php/reports/criteria/slsman_list"),
            "22. Daftar Kode Kasir/SPG","target='_blank'")?></li>
        <li>23. Daftar Kode Supplier</li>
        <li>24. Daftar Kode Toko</li>
        </div>
    </div>
    <div class="col-sm-4">
    	<div class="thumbnail">
<li><?=anchor('reports/criteria/memo_list','Daftar Kredit/Debit Memo',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/pay_list','Daftar Pembayaran',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/pay_type','Pembayaran Per Jenis Bayar',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/cust_list','Daftar Pelanggan',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/slsman_list','Daftar Salesman',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/ar_sum','Kartu Piutang Summary',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/ar_dtl','Kartu Piutang Detail',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/age_sum','Umur Piutang Summary - By Invoice Date',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/age_dtl','Umur Piutang Detail - By Invoice Date',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/age_dtl_item','Umur Piutang Detail - By Invoice Date, Item',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/age_sum_due','Umur Piutang Summary - By Due Date',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/age_dtl_due','Umur Piutang Detail - By Due Date',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/age_dtl_due_item','Umur Piutang Detail - By Due Date, Item',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/retur_list','Daftar Retur Penjualan',"class='info_link'")?></li>
<li><?=anchor('reports/criteria/retur_item','Retur Per Item',"class='info_link'")?></li>
    	
    		
    	</div>
    </div>
</div>    

</div>

<?php 

//include_once "form_criteria.php";

?>
    
<script>
	function open_report(url){
		form_criteria_show();
		get_this(url,"","fc_filter");
//		window.open(url,"_blank");
		
	}
</script>