<div class='row'>
<div class='col-md-5 alert alert-info'>
<p>Barang yang anda pilih di surat jalan akan diubah dan dialokasikan 
dengan barang penggantinya.</p>
<p><legend>Nama Barang Lama : <?=$item_desc_old?></legend></p>
<p>Quantity: <strong><?=$item_qty_old?></strong>, 
Kode : <strong><?=$item_no_old?></strong>, 
Nama barang: <strong><?=$item_desc_old?></strong>,
Line: <strong><?=$item_no_line?></strong>	</p>
<p>Pilih barang pengganti pada daftar dibawah ini, klik tombol 
<strong>Add</strong> untuk mulai mengganti.
</p>
</div>
</div>

<div class='row'>
<div class='col-md-10'>
<table><tr><td>Quantity</td><td>Kode</td><td>Nama Barang</td></tr>
<tr><td><?=form_input("qty","","style='width:50px' id='qty'")?></td>
<td><?=form_input("item","","style='width:90px' id='item'")?>
<?=link_button("","dlginventory_show();return false","search")?>
<td><?=form_input("desc","","id='desc'")?>
<?=link_button("Add","add_barang();return false","add")?>
<?=link_button("Save","save_barang();return false","save")?></td>
</tr>
</table>
</div>
</div>
<div class='row'>
	<div class='col-md-10' id='divItems'>
	
	</div>
</div>

<?php 
echo $lookup_items;
?>

<script language='javascript'>
	var total=0;
	var qty_need=<?=$item_qty_old?>;
function add_barang()
{

	var line="<?=$item_no_line?>";
	var qty=$("#qty").val();
	var item_no=$("#item").val();
	if(qty=="" || qty == "0"){alert("Isi quantity !");return false;};
	if(item_no==""){alert("Pilih kode barang !");return false;};
	loading();
	$.ajax({type:"GET",
		data: {from_line:line,qty: qty, item: item_no},
		url: CI_ROOT+"delivery_order/alloc_item_line_add/",
		success: function(msg){
			var result = eval('('+msg+')');
			if(result.success){
				console.log(result.data);
				void refresh_items(result.data);
				$("#qty").val("");
				$("#item").val("");
				$("#desc").val("");				
			} else {
				log_err(result.msg);
			}
		},
		error: function(msg){log_err(msg);}
	});
	loading_close();
}
function save_barang()
{
	if(total<qty_need){alert("Quantity masih kurang  !!");return false};
	var line="<?=$item_no_line?>";
	loading();
	$.ajax({type:"GET",
		data: {from_line:line},
		url: CI_ROOT+"delivery_order/alloc_item_submit/",
		success: function(msg){
			var result = eval('('+msg+')');
			if(result.success){
				$("#divItems").html("<h1>SUKSES.</h1><p>Silahkan di close tab ini dan refresh di tab delivery order");
			} else {
				log_err(result.msg);
			}
		},
		error: function(msg){log_err(msg);}
	});
	loading_close();
}
function refresh_items(data)
{
	var s="<table class='table'><thead><th>Kode</th><th>Nama Barang</th>"+
	"<th>Quantity</th><th>Unit</th></thead><tbody>";
	total=0;
	for(var i=0;i<data.length;i++)
	{
		total=total+parseFloat(data[i].quantity);
		s=s+"<td>"+data[i].item_number+'</td><td>'+data[i].description+"</td>"+
		"<td>"+data[i].quantity+"</td><td>"+data[i].unit+"</td></tr>";
	}
	s=s+"<tr><td>&nbsp</td><td>&nbsp</td><td><strong>"+total+"</strong></td><td>&nbsp</td><td>&nbsp</td></tr>";
	s = s + "</table>";
	$("#divItems").html(s);
}
</script>