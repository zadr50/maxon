<?php 
	echo $supplier_list;
	echo $item_list;
	echo $category_list;
	
	echo "<div class='alert alert-info'><p>Isi filter pilihan dibawah ini :</p>";
	my_input(array("caption"=>"Supplier","field_name"=>"supplier",
		"show_button"=>link_button("","dlgsupplier_show();return false","search")));
	my_input(array("caption"=>"Category","field_name"=>"category",
		"show_button"=>link_button("","dlgcategory_show();return false","search")));
	my_input(array("caption"=>"Barang","field_name"=>"item_no",
		"show_button"=>link_button("","dlgitem_no_show();return false","search")));
	my_input(array("caption"=>"Umur","field_name"=>"umur","value"=>"30"));
	echo link_button("Search","on_search();return false","filter");
	echo "</div>";
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