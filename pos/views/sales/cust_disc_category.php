<div class="row">
<legend>Discount by Item Category</legend>
<p class='alert alert-info'>
Dibawah ini adalah data discount category barang berdasarkan
pelanggan: <strong>[<?=$cust_no?>] - <?=$cust_name?></strong>
</p>
</div>
<div class='row'>
	<div class='col-sm-3'>
	<?php 
	echo my_dropdown("Category","category","",$cat_list);
	echo my_input_2("Minimum Qty Sold","min_qty");
	echo my_input_2("Sales Price","price");
	echo my_input_2("Discount % 1","disc_prc");
	echo my_input_2("Discount % 2","disc_prc_2");
	echo my_input_2("Discount % 3","disc_prc_3");
	echo my_input_2("Disc Amount","disc_amt");
	echo my_button("Submit","SaveDiscCat();return false","save","Submit dan tambah ke customer ini");
	echo "&nbsp &nbsp ";
	echo my_button("Refresh","RefreshDiscCat();return false","reload","Refresh daftar");
	?>
	</div>
	<div class="col-sm-9 col-md-9">
		<div id="DiscCatContent">
		
		</div>
	</div>
</div>
<script type="text/javascript">
var cust_no='<?=$cust_no?>';
$(document).ready(function(){
	cust_no='<?=$cust_no?>';
	RefreshDiscCat();
});
function SaveDiscCat()
{
	var cat=$("#category").val();
	if(cust_no==""){alert("Kode pelanggan belum dipilih !");return false};
	if(cat==""){alert("Category belum dipilih !");return false};
	
	var param={cust_no:cust_no,cat:cat, 
		disc_prc:$('#disc_prc').val(), 
		disc_prc_2:$('#disc_prc_2').val(), 
		disc_prc_3:$('#disc_prc_3').val(), 
		disc_amt:$('#disc_amt').val(), 
		price:$('#price').val(),
		min_qty:$("#min_qty").val()
		};
	
	$.ajax({type: "GET",
		url: "<?=base_url()?>index.php/category/discount/add",
		data: param,
		success: function(msg){
			var retval = eval('('+msg+')');
			if(retval.success){
				$("#category").val("");
				$("#price").val("");
				$("#disc_prc").val("");
				$("#disc_prc_2").val("");
				$("#disc_prc_3").val("");
				$("#disc_amt").val("");
				$("#min_qty").val("");
				log_msg('Data sudah ditambahkan, klik refresh untuk melihat data yang terbaru.');
			} else {
				log_err('Error! '+retval.message);
			}
			return true;
		},
		error: function(msg){log_err('Unknown');}
	}); 	
	
};
function RefreshDiscCat()
{
	if(cust_no==""){alert("Kode pelanggan belum dipilih !");return false};
	loading();
	$.ajax({type: "GET",
		url: CI_BASE+"index.php/category/discount/list/"+cust_no,
		success: function(data){
			var retval = eval('('+data+')');
			if(retval.success){
				var rows=retval.rows;
				var s="<table class='table'><thead><th>Kode</th>" +
				"<th>Category</th><th>Min Qty</th><th>Price</th>" +
				"<th>Disc%1</th><th>Disc%2</th><th>Disc%3</th>" +
				"<th>Disc Amt</th><th>Id</th></thead><tbody>";
				//console.log(rows);
				for(i=0;i<rows.length;i++)
				{
					r=rows[i];
					s=s + "<tr><td>"+r.kode+"</td><td>"+r.category +
					"</td><td>"+r.min_qty+"</td>" +
					"</td><td>"+r.price+"</td><td>"+r.disc_prc +
					"</td><td>"+r.disc_prc_2+"</td><td>"+r.disc_prc_3 +
					"</td><td>"+r.disc_amount+"</td>"+
					"<td><button class='btn btn-default' value='Delete' onclick='delete_this_row("+r.id+");return false'>Delete</button></td>"+
					"</tr>";
				}				
				s = s + "</tbody></table>";
				$("#DiscCatContent").html(s);
				loading_close();
			} else {
				log_err('Error!');
			}
			return true;
		},
		error: function(msg){log_err('Unknown');}
	}); 		
	
};
function delete_this_row(id){
	var param={id:id};	
	$.ajax({type: "GET",
		url: "<?=base_url()?>index.php/category/discount/delete",
		data: param,
		success: function(msg){
			var retval = eval('('+msg+')');
			if(retval.success){
				log_msg('Data sudah dihapus, klik refresh untuk melihat data yang terbaru.');
			} else {
				log_err('Error! '+retval.message);
			}
			return true;
		},
		error: function(msg){log_err('Unknown');}
	}); 	
}
</script>