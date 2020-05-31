<?
if(is_array($toko)){
	$rcp_from=$toko['user_id'];
} else {
	$rcp_from=$toko->user_id;
}
$caption="Enter your personal message : ";
$form_input_html = "<form id='frmInbox' method='post'>
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
		<input type='hidden' id='id' name='id' value='0'>
		<input type='hidden' id='rcp_from' name='rcp_from' value='$rcp_from'>";
$form_input_html .= "</div></form>";

$id_modal="myModalInbox";
$fnc_save="save_inbox";
include_once "admin/modal_panel.php";
?>
<script language='javascript'>
	var _id=0;
	function save_inbox()
	{
		var url="<?=base_url()?>index.php/eshop/pesan/save/<?=$rcp_from?>";
		var next="<?=base_url()?>index.php/eshop/toko/view/<?=$rcp_from?>";
		if(_id>0)next="<?=base_url()?>index.php/eshop/pesan";
		$("#frmInbox").ajax_post(url,'myModalInbox',next);
	}
	function kirim_pesan(){
		$("#myModalInbox").modal();
	}
	function reply(id){
		_id=id;
		$('#id').val(id);
		$("#myModalInbox").modal();
	}
	function sampah(id){
		$('#id').val(id);
		$("#myModalInbox").modal();
	}
	function hapus(id){
		_id=id;
		$("#myModalInbox").modal();
	}

</script>