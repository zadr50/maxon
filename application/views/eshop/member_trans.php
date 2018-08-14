<div class='thumbnail' style='margin-top:30px'>
<h3>DATA TAGIHAN</h3>
<?
$cust_id=$this->session->userdata("cust_id");
if($q=$this->db->select("sales_order_number,sales_date,status, 
	amount,payment_terms,paid,comments")
	->where("sold_to_customer",$cust_id)
	->get("sales_order")){
	echo "<table class='table'><thead><th>Invoice#</th><th>Tanggal</th>
	<th>Keterangan</th><th>Jumlah</th><th>Status</th><th>Lunas</th>
	<th>Exec</th></thead>
	<tbody>";
	foreach($q->result() as $so) {
		echo "<tr><td>$so->sales_order_number</td><td>$so->sales_date</td>
		<td>$so->comments</td><td align='right'>".number_format($so->amount)."</td>
		<td>$so->status</td>
		<td>$so->paid</td>
		<td><input type='button' nomor='$so->sales_order_number' 
			value='View' class='btn btn-primary' onclick='view_so(this);return false;'>
		</td></tr>";
	}
	echo "</tbody></table>";
}

?>
<p>*Keterangan</p>
<p><strong>Status</strong> 	0 - anda belum konfirmasi pembayaran, 1 - sudah dikonfirmasi, 2 - barang sudah dikirim, 
			3 - barang sudah diterima anda, 4 - order complete</p>
<p><strong>Lunas</strong> 0 - pembayaran belum diperiksa admin, 1 - sudah diperiksa admin</p>

</div>
<script language='javascript'>
function view_so(t){
	var so_number=t.getAttribute("nomor");
	if(so_number==""){alert("Nomor tidak dipilih !");return false;}
	var url="<?=base_url()?>index.php/eshop/sales/view/"+so_number;
	window.open(url,"_self");
}
</script>