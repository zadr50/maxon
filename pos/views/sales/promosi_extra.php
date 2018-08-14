<div class='alert alert-info'>
<strong>Setting promosi barang extra quantity</strong>
<p>Dibawah ini adalah data promosi extra quantity penjualan (Buy X get Y), silahkan tambahkan data barang yang
ada promosi dikotak pengisian dan klik tombol <strong>Submit</strong>
</p>
<p>Tombol <strong>Cari</strong> bisa dipakai untuk mencari data promosi yang 
sudah tersimpan</p>

</div>
<div>
<table class='table2'>
<tr>
		<th>Item No</th><th>Description</th><th>Date From/To</th>
		<th>Min Qty</th><th>Extra Qty</th>
		<th>Action</th>
</tr>
<tr>
		<td><input id='item_number' style='width:90px'/></td>
		<td><input id='description' style='width:180px'/>
			<?=link_button('','searchItem()','search')?>		

		</td>
		<td width="120px">
		<?php echo form_input('from_date',date("Y-m-d"),'id=from_date 
             class="easyui-datetimebox" required style="width:120px"
			data-options="formatter:format_date,parser:parse_date"
			');
			
			echo form_input('to_date',date("Y-m-d 23:59:59"),'id=to_date 
             class="easyui-datetimebox" required style="width:120px"
			data-options="formatter:format_date,parser:parse_date"
			');
			
			?>
		
		</td>
		<td><input id='min_qty' style='width:50px'/></td>
		<td><input id='extra_items' style='width:50px'/></td>
			<input id='id' type='hidden'/>
		</td>
		<td>
		<?php 
			echo link_button('Save', 'save_item()','save');		
			echo link_button('Print', 'print()','print');		
			echo link_button('Search','load_items()','search');		
		?>
		</td> 		  	
</tr>

</table>
<p><i>*Mohon isi tanggal dengan format YYYY-MM-DD</i></p>
</div>
<hr/>
<table class='table2' id='tbl_items'>
	<thead><tr>
		<th>Item No</th><th>Description</th><th>Date From</th>
		<th>Date To</th><th>Min Qty</th><th>Extra Items</th>
		<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<?php 
	echo load_view('inventory/inventory_select');
?>

<script language="javascript">
	var page=0;
	$().ready(function(){
		void load_items();
	});
	function clear_grid(){
		$("#tbl_items tbody tr").remove();
		
	}
	function load_items(){
		var xparam={item_number:$("#item_number").val(),
			description:$("#description").val(),from_date:$("#from_date").val(),
			to_date:$("#to_date").val(),min_qty:$("#min_qty").val(),
			extra_items:$("#extra_items").val()};
		loading();
		clear_grid();
		$.ajax({
            type: "GET",url: CI_BASE+"index.php/so/promosi_extra/load_items/"+page,
			data: xparam,
            success: function(msg){
				var result = eval('('+msg+')');
				if (result.success){
					add_row(result.data);
					loading_close();
				} else {
					loading_close();
					log_msg(result.message);
				}
            },
            error: function(msg){
				loading_close();
				log_msg(msg);
			}
        });         
	}
	function add_row(data){
		for(i=0;i<data.length;i++){
			var row=data[i];
			$("#tbl_items").append("  "
			+"<tr> "
			+"<td>"+row.item_number+"</td>"
			+"<td>"+row.description+"</td>"
			+"<td>"+row.from_date+"</td>"
			+"<td>"+row.to_date+"</td>"
			+"<td>"+row.min_qty+"</td>"
			+"<td>"+row.extra_items+"</td>"
			+"<td><a href='#' class='btn btn-warning'"
	        +"onclick='delete_item("+row.id+","+(i+1)+");return false;'>Del</a></td>"
			+"</tr>");
		}
	}
	function delete_item(idd,row){
		loading();
		$.ajax({
            type: "GET",url: CI_BASE+"index.php/so/promosi/delete_items/"+idd,
            success: function(msg){
				//console.log(msg);
				var result = eval('('+msg+')');
				if (result.success){
					log_msg("Berhasil");
					$("tr").eq(row).remove();
					loading_close();
				} else {
					loading_close();
					log_msg(result.message);
				}
            },
            error: function(msg){
				loading_close();
				log_msg(msg);
			}
        });         
	}
	function clear_input(){
		$("#item_number").val("");
		$("#description").val("");
		$("#min_qty").val("");
		$("#extra_items").val("");
	}
	function save_item(){
		loading();
		var xparam={item_number:$("#item_number").val(),
			description:$("#description").val(),from_date:$("#from_date").val(),
			to_date:$("#to_date").val(),min_qty:$("#min_qty").val(),
			extra_items:$("#extra_items").val()};
		$.ajax({
            type: "GET",
			data: xparam,
			url: CI_BASE+"index.php/so/promosi_extra/save/",
            success: function(msg){
				console.log(msg);
				var result = eval('('+msg+')');
				if (result.success){
					loading_close();
					log_err(result.message);
					xparam['id']=result.id;
					add_row_2(xparam);
					clear_input();
				} else {
					loading_close();
					log_msg(result.message);
				}
            },
            error: function(msg){
				loading_close();
				log_msg(msg);
			}
        });         
		
	}
	function add_row_2(row){
			$("#tbl_items").append("  "
			+"<tr> "
			+"<td>"+row.item_number+"</td>"
			+"<td>"+row.description+"</td>"
			+"<td>"+row.from_date+"</td>"
			+"<td>"+row.to_date+"</td>"
			+"<td>"+row.min_qty+"</td>"
			+"<td>"+row.extra_items+"</td>"
			+"<td>"+row.id+"</td>"
			+"</tr>");
		
	}
</script>

