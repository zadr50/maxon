<div title="Items" style="padding:10px">
	<div id='dgItemPromo_tool'  class='box-gradient'>
		<?=link_button("New Item","newItem()","add")?>
		<?=link_button("New Category","newItemCat()","add")?>
		<?=link_button("New Supplier","newItemSupp()","add")?>
		<?=link_button("New Merk","newItemManuf()","add")?>
		<?=link_button("Delete Item","deleteItem()","remove")?>
		<?=link_button("Refresh Item","load_items()","reload")?>
	</div>
	<table id="dgItemPromo" class="easyui-datagrid"  
	style="width:auto;min-height:200px"
	data-options="
			iconCls: 'icon-edit',fitColumns: true, 
			singleSelect: true,
			url: ''
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:100">Kode barang</th>
				<th data-options="field:'description',width:180">Nama Barang</th>
				<th data-options="field:'item_type',width:80">Item Type</th>
				<th data-options="field:'id',width:80">Id</th>

			</tr>
		</thead>
	</table>
</div>
<?=form_input("item_number","","id='item_number' style='display:none'")?>
<?=form_input("category","","id='category' style='display:none'")?>
<?=form_input("supplier_number","","id='supplier_number' style='display:none'")?>
<?=form_input("merk","","id='merk' style='display:none' ")?>

<script type="text/javascript">
		var url;
		function newItemManuf(){
			dlgmerk_show();
		}
		function newItem(){
			dlginventory_show();
		}
		function newItemCat(){
			dlginventory_categories_show();
		}
		function newItemSupp(){
			dlgsuppliers_show();
		}
		function newItem2(){
			$('#dlg').dialog('open').dialog('setTitle','Tambah data barang');
			$('#fm').form('clear');
			$('#sales_order_number').val('<?=$promosi_code?>');
			url = '<?=base_url()?>index.php/so/promosi_disc/save_item';
		}
		function saveItem(){
			 
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		function deleteItem(){
			var row = $('#dgItemPromo').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if (r){
						url='<?=base_url()?>index.php/so/promosi_disc/delete_item/'+row.id;
						$.post(url,{id:row.id},function(result){
							if (result.success){
								$('#dgItemPromo').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
		
		function dlginventory_find(){
		    xurl=CI_ROOT+'so/promosi_disc/save_item';
		    $.ajax({
		                type: "GET",
		                url: xurl,
		                data:{item_no:$('#item_number').val(),promosi_code:$('#promosi_code').val()},
		                success: function(msg){
							load_items();
		                },
		                error: function(msg){alert(msg);}
		    });
		};
	function load_items(){
		var nomor=$("#promosi_code").val();								
		$('#dgItemPromo').datagrid({url:'<?=base_url()?>index.php/so/promosi_disc/items/'+nomor});
		$("#dgItemPromo").datagrid("reload");
	}

	function dlginventory_categories_find(){
		xurl=CI_ROOT+'so/promosi_disc/save_item';
		$.ajax({
			type: "GET",
			url: xurl,
			data:{item_type:"category",item_no:$('#category').val(),promosi_code:$('#promosi_code').val()},
			success: function(msg){
				load_items();
			},
			error: function(msg){alert(msg);}
		});

	}
	function dlgsuppliers_find(){
		xurl=CI_ROOT+'so/promosi_disc/save_item';
		$.ajax({
			type: "GET",
			url: xurl,
			data:{item_type:"supplier",item_no:$('#supplier_number').val(),promosi_code:$('#promosi_code').val()},
			success: function(msg){
				load_items();
			},
			error: function(msg){alert(msg);}
		});

	}
	function dlgmerk_find(){
		xurl=CI_ROOT+'so/promosi_disc/save_item';
		$.ajax({
			type: "GET",
			url: xurl,
			data:{item_type:"merk",item_no:$('#merk').val(),promosi_code:$('#promosi_code').val()},
			success: function(msg){
				load_items();
			},
			error: function(msg){alert(msg);}
		});

	}


</script>

