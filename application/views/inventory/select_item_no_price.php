<div id='dgItemInv' class="alert alert-info">
	<table width="100%" class="table2">
		<tr>
			<td>Kode Barang</td>
			<td><input onblur='find()' id="item_number" style='width:180px' 
					name="item_number"   class="easyui-validatebox" >
					<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
					onclick="searchItem();return false;"></a>
			</td>
			<td>Qty</td>
			<td><input id="quantity"  style='width:80px'  name="quantity" >
				Unit <input id="unit" name="unit"  style='width:80px' >
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
					onclick="searchUnit();return false;" 
					style='display:none' id='cmdLovUnit'>	
			</td>
			<td>
			<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
			   onclick='save_item();return false;'>Save Item</a>
			</td>
		</tr>
		<tr><td>Nama Barang</td>
			<td colspan=5><input id="description" name="description" style='width:280px'></td>
		</tr>
		<input type='hidden' id='ref_number' name='ref_number'>
		<input type='hidden' id='line_number' name='line_number'>		
	</table>	
    <p style="font-size:small"><i>* Pilih kode barang dibawah ini kemudian isi quantity 
        dan klik tombol [Save Item] agar tampil didaftar barang 
        dibawah ini</i></p>
</div>

<?=load_view("inventory/select_unit_jual")?>

<script language="JavaScript"> 
	 
	function close_item(){
		clear_input();
		$("#dgItemInv").dialog("close");	
	}
	
	function deleteItem(){
		var row = $('#'+grid_output).datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line? '+row.line_number,function(r){
				if (r){
					$.post(url_del_item,{line_number:row.line_number},function(result){
						if (result.success){
							$('#'+grid_output).datagrid('reload');	// reload the user data
						} else {
							log_err(result.msg);
						}
					},'json');
				}
			});
		}
	}
	function editItem(){
		var row = $('#'+grid_output).datagrid('getSelected');
		if (row){
			console.log(row);
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.from_qty);
			///$('#from_qty').val(row.quantity);
			$('#unit').val(row.unit);
			$('#line_number').val(row.line_number);
			 
		}
	}
	function clear_input(){
		$('#item_number').val('');
		$('#unit').val('Pcs');
		$('#description').val('');
		$('#line_number').val('');
		$('#quantity').val('1');
	}
	function save_item(){
		//if($("#item_number").val()==""){alert("Pilih barang !");return false;}
		//if($("#quantity").val()==""){alert("Isi quantity !");return false;}
		$('#frmItem').form('submit',{
			param: {item_number:'aaaa'}, 
			url: url_save_item,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					log_msg("Data sudah tersimpan.");
					$("#shipment_id").val(result.shipment_id);
					$("#transfer_id").val(result.transfer_id);
                    url_load_item=url_detail();   
					$('#'+grid_output).datagrid({url:url_load_item});
					//$('#'+grid_output).datagrid('reload');
					clear_input();
					 
					
				} else {
					log_err(result.msg);
				}
			}
		});
	}
	
	function find(){
		xurl=CI_ROOT+'inventory/find/'+$('#item_number').val();
		console.log("find():"+xurl);
		$.ajax({
					type: "GET",
					url: xurl,
					data:'item_no='+$('#item_number').val(),
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#item_number').val(obj.item_number);
						$('#unit').val(obj.unit_of_measure);
						$('#description').val(obj.description);
						$('#quantity').val("1");
						if(obj.multiple_price){
							$("#cmdLovUnit").show();
						} else {
							$("#cmdLovUnit").hide();								
						}
						 
					},
					error: function(msg){alert(msg);}
		});
	};
	function hitung(){
		
	}

</script>
