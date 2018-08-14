<legend>Daftar Register Dokumen Baru</legend>
<div class="alert alert-info col-md-5 col-lg-5">
	Dibawah ini adalah daftar nomor-nomor yang dibuat otomatis 
	ketika anda memproses pembuatan kontrak kredit.
	<br>Untuk tanggal berbeda isi tanggal kemudian klik tombol [<strong>Refresh</strong>]
	<br>Silahkan direview kemudian contreng dan klik tombol [<strong>Approve</strong>] untuk diteruskan
	ke bagian masing-masing. <br>Tekan tombol [<strong>Cetak</strong>] untuk cetak dokumen 
	yang sudah dicontreng.
</div>
<div class="alert alert-warning">
<?php 
echo form_open(base_url()."index.php/leasing/loan/print_new_doc");
echo "<div style='float:left;margin-right:10px'>";
echo my_input_date("From","date_from",$date_from);
echo "</div>";
echo "<div style='float:left;margin-right:10px'>";
echo my_input_date("To","date_to",$date_to);
echo "</div>";
echo form_submit("submit","Filter","class='btn btn-primary'");
echo form_close();
?>
</div>
<legend>Daftar Surat Jalan</legend>
<?php

echo "<table class='table'>
<thead><th>Nomor#</th><th>Tanggal</th><th>Customer</th><th>Item</th>
<th>Qty</th></thead>
<tbody>"; 
foreach($list_do->result() as $do){
	echo "<tr>
	<td><a href='#' onclick=\"view_do('$do->invoice_number')\">$do->invoice_number</a></td>
	<td>$do->invoice_date</td>
	<td>$do->company</td><td>$do->description</td><td>$do->quantity</td>
	</tr>";
}
echo "</tbody></table>";
?>
<legend>Daftar Sales Order</legend>
<?php 
echo "<table class='table'>
<thead><th>Nomor#</th><th>Tanggal</th><th>Customer</th><th>Item</th>
<th>Qty</th></thead>
<tbody>"; 
foreach($list_so->result() as $so){
	echo "<tr>
	<td><a href='#' onclick=\"view_so('$so->sales_order_number')\">$so->sales_order_number</a></td>
	<td>$so->sales_date</td>
	<td>$so->company</td><td>$so->description</td><td>$so->quantity</td>
	</tr>";
}
echo "</tbody></table>";
?>

<legend>Daftar Purchase Order</legend>
<?php 
echo "<table class='table'>
<thead><th>Nomor#</th><th>Tanggal</th><th>Supplier</th><th>Item</th>
<th>Qty</th></thead>
<tbody>"; 
foreach($list_po->result() as $po){
	echo "<tr>
	<td><a href='#' onclick=\"view_po('$po->purchase_order_number')\">$po->purchase_order_number</a></td>
	<td>$po->po_date</td>
	<td>$po->supplier_name</td><td>$po->description</td><td>$po->quantity</td>
	</tr>";
}
echo "</tbody></table>";
?>

<legend>Daftar Mutasi Stock antar gudang</legend>
<?php 
echo "<table class='table'>
<thead><th>Nomor#</th><th>Tanggal</th><th>G.Asal</th>
<th>G.Tujuan</th><th>Item</th>
<th>Qty</th></thead>
<tbody>"; 
foreach($list_trx->result() as $trx){
	echo "<tr>
	<td><a href='#' onclick=\"view_trx('$trx->transfer_id')\">$trx->transfer_id</a></td>
	<td>$trx->date_trans</td>
	<td>$trx->from_location</td><td>$trx->to_location</td>
	<td>$trx->description</td><td>$trx->from_qty</td>
	</tr>";
}
echo "</tbody></table>";
?>
<script language="javascript">
	function view_do(nomor){
		var  url="<?=base_url()?>index.php/delivery_order/view/"+nomor;
		add_tab_parent('view_do_'+nomor,url);
	}
	function view_so(nomor){
		var  url="<?=base_url()?>index.php/sales_order/view/"+nomor;
		add_tab_parent('view_so_'+nomor,url);
	}
	function view_po(nomor){
		var  url="<?=base_url()?>index.php/purchase_order/view/"+nomor;
		add_tab_parent('view_po_'+nomor,url);
	}
	function view_trx(nomor){
		var  url="<?=base_url()?>index.php/stock_mutasi/view/"+nomor;
		add_tab_parent('view_trx_'+nomor,url);
	}
	
</script>
