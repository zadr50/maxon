<?php 
	echo $supplier_list;
	echo $item_list;
	echo $category_list;
?>
<div class='alert alert-info'>	
	<table class='table'>
		<tr><td colspan=4><b>Isi pilihan untuk filter dibawah ini</b></td>
		<tr><td>Supplier</td><td><?=form_input("supplier","","id='supplier'")
			.link_button("","dlgsupplier_show();return false","search")?></td>
			<td>Category</td><td><?=form_input("category","","id='category'")
				.link_button("","dlgcategory_show();return false","search")?></td></tr>
		<tr><td>Kode Barang</td><td><?=form_input("item_no","","id='item_no'")
			.link_button("","dlgitem_no_show();return false","search")?></td>
			<td>Umur</td><td><?=form_input("supplier","30","id='umur'")?></td>
		<td><?=link_button("Refresh Data","on_search();return false","reload")?></td></tr>			
	</table>	
</div>
<?php
	echo "<div class='row'><div class='col-md-12'>";
	$this->browse->load_js(false);
	$this->browse->set_fields(array("item_number","description","last_inventory_date",
		"umur","quantity_in_stock","category","supplier_number","supplier_name"));
	$this->browse->set_url(base_url("index.php/po/umur_barang/browse_data"));
	echo $this->browse->refresh();
	echo "</div>";
?>
<script type="text/javascript">
    function on_search()
    {
		var supplier=$("#supplier").val();
		var item_no=$("#item_no").val();
		var category=$("#category").val();
		var umur=$("#umur").val();
		$('#dg').datagrid({url:'<?=base_url()?>index.php/po/umur_barang/browse_data/?supplier='+
			supplier+'&item_no='+item_no+"&category="+category+"&umur="+umur});
    }
</script>    