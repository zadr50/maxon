<?php 
//var_dump($type_id);
if($type_id==""){
	echo "<p class='alert alert-warning'>Kode kelompok pelanggan belum dipilih</p>";	
} else {
	//if($item_prices){
		echo "<p class='alert alert-info'>Isi harga jual barang dan discount untuk kelompok pelanggan 
		<strong>$type_id</strong> pada daftar tabel dibawah ini, 
		tekan tombol [Add] dibawah ini 	: </p>";
		
		$sql="select i.item_number,i.description,i.retail,ipc.sales_price,
			ipc.min_qty,ipc.disc_prc_from,ipc.disc_prc_to,ipc.id
			from inventory i join inventory_price_customers ipc 
			on i.item_number=ipc.item_no where ipc.cust_type='$type_id'";
		$this->session->set_userdata("cust_type_price",$type_id);	
		echo browse2(array("sql"=>$sql,
		"controller"=>"customer_type",
		"toolbar"=>"tb_price",
		"fields_numeric"=>array("retail","sales_price")));
		

}
echo $lookup_inventory;
include_once "cust_type_price_input.php";

?>
<div id='tb_price'>
	<?=link_button("Add", "dlgItem_add();return false","add")?>
	<?=link_button("Edit", "edit_item();return false","edit")?>
	<?=link_button("Delete", "del_item();return false","remove")?>
	<?=link_button("Refresh", "refresh_item();return false","reload")?>
</div>
<script>
var cust_type='<?=$type_id?>';

function edit_item(){
	dlgItem_clear();
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#item_number').val(row.item_number);
		$('#description').val(row.description);
		$('#min_qty').val(row.min_qty);
		$('#disc_prc_from').val(row.disc_prc_from);
		$('#disc_prc_to').val(row.disc_prc_to);
		$('#id').val(row.id);
		$("#sales_price").val(row.sales_price);
		$("#dlgItem").dialog("open").dialog("setTitle","Input Price");
	}	
}
function refresh_item(){
	$("#dg").datagrid("reload");
}
function save_item(item_no){
	var param={cust_type:cust_type,item_no:item_no, 
		p:$('#p_'+item_no).val(), 
		q:$('#q_'+item_no).val(), 
		d1:$('#d1_'+item_no).val(), 
		d2:$('#d2_'+item_no).val(), 
		i:$('#i_'+item_no).val() 
		};
	console.log(param);
	
	$.ajax({
			type: "GET",
			url: "<?=base_url()?>index.php/customer_type/save_item_price",
			data: param,
			success: function(msg){
				var retval = eval('('+msg+')');
				console.log(retval);
				if(retval.success){
					$('i_'+item_no).val(retval.id);
					log_msg('Sukses');
				} else {
					log_err('Error!');
				}
				return true;
			},
			error: function(msg){log_err('Unknown');}
	}); 	
}
function del_item(){
	var cust_type='<?=$type_id?>';
	
	var row = $('#dg').datagrid('getSelected');
	if (row){
		var _url = CI_ROOT+'customer_type/delete_item_price/'+row.id;
		$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
			if (r){
				$.ajax({
						type: "GET",url: _url,
						success: function(msg){
							var retval = eval('('+msg+')');
							if(retval.success){
								log_msg(retval.msg);
								$("#dg").datagrid("reload");
							} 
							log_err(retval.msg);
							return true;
						},
						error: function(msg){log_err('Unknown');}
				}) 	
				
				
			}
		})
	}
	
}
</script>