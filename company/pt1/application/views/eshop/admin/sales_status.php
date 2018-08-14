<table class='table'>
	<tr><td>Status Pesanan </td><td> 
		<?=form_dropdown('status',array(
		"0"=>"0 - Order belum dikonfirmasi",
		"1"=>"1 - Order sudah dikonfirmasi",
		"2"=>"2 - Barang sedang dikirim atau packing",
		"3"=>"3 - Barang sudah sampai diterima",
		"4"=>"4 - Order sudah selesai",
		"5"=>"5 - Order dibatalkan"),
		$so->status,'class="form-control" id="status" onblur="display_status();return false;"  ' )
		?>
		<div   id='divDelivery' style='margin-top:10px;padding:10px;display:none;height:300px;border:1px solid lightgray'>
			<h4>Enter your delivery information</h4>
			<table class='table'>
				<tr><td>Tanggal kirim</td>
				<td><?=form_input('date_delivery',$so->ship_date==''?date('Y-m-d'):$so->ship_date,
					'class="form-control" id="date_delivery" 
					data-date-format="yyyy-mm-dd"					');?></td>
				</tr>
				<tr><td>Nama Kurir</td>
				<td><?=form_input('courier',$so->shipped_via,"class='form-control' id='courier'")?></td></tr>	
				<tr><td>Perkiraan Lama Sampai</td>
				<td><?=form_input('day_delivery',$so->ship_day,"class='form-control' id='day_delivery'")?></td></tr>	
				<tr><td>Berat Total</td>
				<td><?=form_input('weight_items',$so->ship_weight,"class='form-control' id='weight_items'")?></td></tr>	
				<tr><td>Nomor Resi Pengiriman</td>
				<td><?=form_input('ship_no',$so->ship_no,"class='form-control' id='ship_no'")?></td></tr>	
			</table>
		</div>
	
	</td></tr>
	<tr><td>Status Pembayaran </td><td> 
		<?=form_dropdown('paid',array(
		"0"=>"0 - Belum dibayar",
		"1"=>"1 - Sudah dibayar dan sudah diperiksa")
		,$so->paid,'class="form-control" id="paid"')
		?>
		</td>					
	</tr>
</table>
 
<button class='btn btn-primary' 
onclick='save_sales_status("<?=$so->sales_order_number?>");return false;'>
Save Status Order</button>
 
<script language='javascript'>
$(document).ready(function(){
	$("#date_delivery").datepicker();
	
});
	function display_status(){

		if($("#status").val()=="2") {
			$("#divDelivery").fadeIn("slow");
		} else {
			$("#divDelivery").fadeOut("slow");
		}
	}	
	function save_sales_status(nomor) 
	{
		var courier=$("#courier").val();
		var status=$("#status").val();
		var paid=$("#paid").val();
		var ship_no=$("#ship_no").val();
		if(status=="2" && courier=="" && ship_no=="") { 
			$("#divDelivery").fadeIn("slow");
			alert("Isi nama pengiriman / courier / nomor resi pengiriman !");
			return false;
		}
		var param="sales_order_number=<?=$sales_order_number?>&status="+status+"&paid="+paid;
		param=param+"&courier="+courier+"&dvDate="+$("#date_delivery").val();
		param=param+"&dvDay="+$("#day_delivery").val();
		param=param+"&dvWg="+$("#weight_items").val();
		param=param+"&dvNo="+$("#ship_no").val();
		var url="<?=base_url()?>index.php/eshop_admin/orders/update/";
		var next_url="<?=base_url()?>index.php/eshop_admin/orders";
		ajax_get(url,param,next_url);
	}
</script>
			