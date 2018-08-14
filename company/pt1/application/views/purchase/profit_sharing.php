<?php 
	echo $supplier_list;
	echo $item_list;
	echo $category_list;
	
	echo "<div class='alert alert-info'>
		<p>Isi filter pilihan dibawah ini :</p>";
	echo "</div>";
	echo "<table class='table'>";
	echo "<tr><td>Type Kode</td><td>".form_dropdown("type_code",
		array("SUPPLIER"=>"SUPPLIER",
			"CATEGORY"=>"CATEGORY",
			"BARANG"=>"BARANG"),"SUPPLIER","id='type_code'");
	echo "</td><td>Pilihan</td><td><input type='text' name='item_no' id='item_no'>
		".link_button("","on_pilih();return false","search")."</td></tr>";
	$tgl=date("Y-m-d");
	echo "<tr><td> </td><td> </td><td>Profit%</td><td><input  type='text' name='profit' id='profit'></td></tr>";
	echo "<tr><td>Date From (YYYY-MM-DD)</td><td><input value='$tgl' type='text' name='date_from' id='date_from'></td>";
	echo "<td>Date To (YYYY-MM-DD)</td><td><input value='$tgl' type='text' name='date_to' id='date_to'></td></tr>";
	echo "<tr><td> </td><td> </td><td> </td><td>".link_button("Submit","on_submit();return false","save")."</td></tr>";
	echo "</table>";
	echo "<div class='row'><div class='col-md-12'>";
	$this->browse->load_js(false);
	$this->browse->set_fields(array("type_code","item_no","item_name",
		"profit_prc","date_from","date_to","remarks","id"));
	$this->browse->set_url(base_url("index.php/po/profit_sharing/browse_data"));
	$this->browse->set_id("dgItems");
	$this->browse->set_tool("tb");
	echo $this->browse->refresh();
	echo "<div id='tb' class='box-gradient'>";
	echo link_button("Delete","on_delete_item();return false","remove");
	echo link_button("Refresh","reload();return false","search");
	echo "</div>"

	
?>


<script type="text/javascript">
	function on_delete_item(){
		var row = $('#dgItems').datagrid('getSelected');
		if (row){
			var xurl="<?=base_url("index.php/po/profit_sharing/delete_row")?>"+"/"+row.id;
			$.ajax({url: xurl,success: function(msg){
				var result = eval('('+msg+')');
				if(result.success){
					reload();
				}
			},
				error: function(msg){alert(msg);}
			}); 			
		}
	}
	function on_change_supp(){
		$("#item_no").val($("#supplier").val());
	}
	function on_pilih(){
		var typecode=$("#type_code").val();
		if(typecode=="BARANG"){
			dlgitem_no_show();
		}
		if(typecode=="SUPPLIER"){
			dlgsupplier_show();
		}
		if(typecode=="CATEGORY"){
			dlgcategory_show();
		}
		
	}
    function on_submit()
    {
		var xurl="<?=base_url("index.php/po/profit_sharing/save")?>";
		var param={item_no:$("#item_no").val(),type_code:$("#type_code").val(),
			date_from:$("#date_from").val(),date_to:$("#date_to").val(),
			remarks:$("#remarks").val(),profit_prc:$("#profit").val()}
			
		$.ajax({type: "POST",url: xurl,data: param,
			success: function(msg){
			var result = eval('('+msg+')');
			if(result.success){
				reload();
			}
		},
			error: function(msg){alert(msg);}
		}); 
    }
	function reload(){
		$('#dgItems').datagrid({url:'<?=base_url()?>index.php/po/profit_sharing/browse_data'});		
		$('#dgItems').datagrid('reload');
	}
	
</script>    