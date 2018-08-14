<div class='col-lg-12'>
	<div class='row col-lg-10'>
		<legend><?=$caption?></legend>
		<p class='alert alert-info'>Halaman ini dipakai untuk input saldo awal stock</p>
	</div>
	<div class='row col-lg-10'>
		Input tanggal stock awal : <input name='tanggal' id='tanggal' class='easyui-datetimebox' value='<?=date('y-m-d')?>' >
		Pilih gudang :  <input name='gudang' id='gudang'>
		<a href='#' class='btn btn-primary' onclick='load_stock();return false'>Load</a>
	</div>
	<div id='div_stock' class='row col-lg-10'>
	
	</div>
</div>

<script language='javascript'>
	function load_stock()
	{
		var url=CI_BASE+"index.php/inventory/saldo_stock";
		var param={tanggal:$("#tanggal").val(),gudang:$("#gudang").val()};
		loading();
		$.ajax({url: url, data: param, 
			error: function (xhr, ajaxOptions, thrownError) {
				$("#div_stock").html(xhr.responseText);
				loading_close();
			},
			success: function(result)
			{
				if(IsJsonString(result))
				{
					var result = eval('('+result+')');
					if (result.success)
					{
						console.log(result.data);
						var html="<table class='table'><thead><th>Item Number</th>" +
						"<th>Description</th><th>Category</th><th>Qty All</th><th>Qty Gdg</th></thead>" +
						"<tbody>";
						data=result.data;
						for(var i=0;i<data.length;i++)
						{
							html = html + "<tr><td>" + data[i].item_number + "</td>" +
							"<td>" + data[i].description + "</td>" +
							"<td>" + data[i].category + "</td>" +
							"<td>" + data[i].qty_all + "</td>" +
							"<td><input name='item[]' value='"+data[i].item_number + "' type='hidden'>" + 
							"<input name='qty[]' value='" + data[i].qty_gudang + "' type='text' style='width:50px'></td>" +
							"</tr>";
							console.log(html);
						}
						html = html + "</tbody></table>";
						$("#div_stock").html(html);
						loading_close();
						
					} else {
						loading_close();
						$("#div_stock").html(result.message);
					}
				} else { 
					loading_close();
					$("#div_stock").html(result);
				}
			}
		});				
		
	}
</script>