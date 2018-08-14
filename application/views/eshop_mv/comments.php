<div class='row-fluid'>
	<button class='btn btn-default' onclick='post_comment("<?=$item_id?>");return false'>
	Post Comment</button>
</div>
<?

$caption="Enter your comment: ";
$form_input_html = "<form id='frmComm' method='post'>
<div class='thumbnail'>
		<div class='form-group'>
			<label class='control-label' >Comment</label>".
				form_textarea('comments','','id="comments" 
				class="form-control" ').
			"
		</div>";
$form_input_html .= my_radio_rate('Kwalitas','rate_quality');
$form_input_html .= my_radio_rate('Akurasi','rate_accurate');
$form_input_html .= my_radio_rate('Kecepatan','rate_speed');
$form_input_html .= my_radio_rate('Pelayanan','rate_service');

$form_input_html .= "</div></form>";

$id_modal="myModal";

include "admin/modal_panel.php";
function my_radio_rate($caption,$name)
{
	$s="<div class='row' style='margin-left:5px;margin-right:5px' >
	<div style='width:90px;height:30px;float:left'>$caption &nbsp&nbsp</div>";
	for($i=1;$i<=5;$i++)
	{
		$s .= form_radio($name,$i,($i==1)?TRUE:FALSE).
		" $i Rate &nbsp&nbsp";
	}
	$s .= "</div>";
	return $s;
}
?>
<script language='javascript'>
	function post_comment(item_id){
		$("#myModal").modal();
	}
	function save_item()
	{
		var url="<?=base_url()?>index.php/eshop/comment/save/<?=$item_id?>";
		var next="<?=base_url()?>index.php/eshop/item/view/<?=$item_id?>";
		$("#frmComm").ajax_post(url,'myModal',next);
	}
</script>