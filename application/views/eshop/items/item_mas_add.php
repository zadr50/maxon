<div class="row-fluid" >
	<div class="col-md-10">
		<div class="thumbnail">
			<ol class="breadcrumb">
			  <li><a  class='glyphicon glyphicon-home'
			  href="<?=base_url()?>index.php/eshop/home"> Home</a></li>
			  <li><a href="<?=base_url()?>index.php/eshop/setting/view/items_mas/3"> Items</a></li>
			  <li><a  class='active' 
			  href="<?=base_url()?>index.php/eshop/item/add"> Add</a></li>
			</ol>
		</div>
		<?php 
		include_once "item_mas_form_input.php"; 
		?>
		<div style='float:right'>
		<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" onclick='save_item();return false'>Save changes</button>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

<script language='javascript'>
function save_item(){
	var item_no=$("#item_number").val();
	var item_name=$("#description").val();
	if(item_no==""){alert("Isi kode barang !");return false}
	if(item_name==""){alert("Isi nama barang !");return false}
	var url="<?=base_url()?>index.php/eshop/item/save";
	
	$('#frmBarang').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				$("#frmBarang")[0].reset();
				log_msg('Data sudah tersimpan.');
			} else {
				alert(result.message);
			}
		}
	});	
};

</script>