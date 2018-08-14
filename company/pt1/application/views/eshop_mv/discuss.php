<div class='row-fluid'>
	<button class='btn btn-default' onclick='post_discuss("<?=$item_id?>");return false'>
	Post Discuss</button>
</div>
<?
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
include "admin/modal_panel.php";
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