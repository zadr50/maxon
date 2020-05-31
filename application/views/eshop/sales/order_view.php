<?php 
$caption="View Order";
$form_input_html = "<form id='frmOrder' method='post'>
<div class='thumbnail'>
		<div class='form-group'>
			<label class='control-label' >Judul</label>".
				form_input('subject','','id="subject" 
				class="form-control" ').
			"
			<label class='control-label' >Isi Pesan</label>".
				form_textarea('message','','id="message" 
				class="form-control" ').
			"
		</div>
		<input type='hidden' id='frmOrder_sales_order_number' name='frmOrder_sales_order_number'>";
$form_input_html .= "</div></form>";

$id_modal="myModalOrder";
$fnc_save="update_order";
include_once "admin/modal_panel.php";

?>
<script language='javascript'>
	function update_order()
	{
		var url="<?=base_url()?>index.php/eshop/pesan/save";
		var next="<?=base_url()?>index.php/eshop/toko/view";
		if(_id>0)next="<?=base_url()?>index.php/eshop/pesan";
		$("#frmOrder").ajax_post(url,'myModalOrder',next);
	}
	function order_view(){
		$("#myModalOrder").modal();
	}
</script>