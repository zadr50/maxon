<div class='row-fluid'>
	<button class='btn btn-default' onclick='post_discuss("<?=$item_id?>");return false'>
	Post Discuss</button>
</div>
<?php
$caption="Enter your ask : ";
$form_input_html = "<form id='frmDiscuss' method='post'>
<div class='thumbnail'>
		<div class='form-group'>
			<label class='control-label' >Comment</label>".
				form_textarea('comments','','id="comments" 
				class="form-control" ').
			"
		</div>";
$form_input_html .= "</div></form>";

$id_modal="myModalDiscuss";
$fnc_save="save_item_discuss";
echo load_view("eshop/admin/modal_panel",array("id_modal"=>$id_modal,
    "form_input_html"=>$form_input_html,
    "fnc_save"=>$fnc_save,"caption"=>$caption));
?>
<script language='javascript'>
	function post_discuss(item_id){
		$("#myModalDiscuss").modal();
	}
	function save_item_discuss()
	{
		var url="<?=base_url()?>index.php/eshop/discuss/save/<?=$item_id?>";
		var next="<?=base_url()?>index.php/eshop/item/view/<?=$item_id?>";
		$("#frmDiscuss").ajax_post(url,'myModalDiscuss',next);
	}
</script>