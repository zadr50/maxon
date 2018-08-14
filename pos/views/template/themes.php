<legend>Manage Themes</legend>
Halaman ini berisi daftar tema tampilan MaxOn yang dapat anda download secara gratis 
atau berbayar. </br>
<? 
echo link_button('Get More Themes','','search','false',base_url().'index.php/themes/more/');		
?>
<p></p>
<legend>Themes</legend>
<?
for($i=0;$i<count($themes_list);$i++){
	$name=$themes_list[$i]['name'];
	$version=$themes_list[$i]['version'];
	$create_by=$themes_list[$i]['create_by'];
	$description=$themes_list[$i]['description'];
	$title=ucfirst($name);
	if($name==$themes_name) $title=ucfirst($name) . " - Current";
?>
<div class='col-md-8'>
	<div class="easyui-panel themes" title="<?=$title?>" 
			data-options="iconCls:'icon-save',closable:true,
			collapsible:true,minimizable:true,maximizable:true">
		<div class='col-md-3'>
			<img src='<?=base_url()?>themes/<?=$name?>/images/screenshoot.png'  >
			<div class='tm_info'>
				Themes Name : <?=$name?>, 
				Version: <?=$version?>, 
				By: <?=$create_by?>
			</div>
			<div class='tm_content'>
				<?=$description?>
			</div>
			<div class='tm_button'>
				<?=link_button("Apply","themes_apply('$name')","save","false");?>
				<?=link_button("Preview","themes_preview('$name')","search","false");?>
			</div>
		</div>
	</div>
</div>
<? } ?>
<script language="javascript">
	function themes_apply(tm_name){
		var url="<?=base_url()?>index.php/admin/themes/save/"+tm_name;
		window.parent.open(url,"_self");
//		location.reload();
	}
	function themes_preview(tm_name){
		alert(tm_name);
	}
</script>
<style>
.themes img {
	margin-right: 10px;
	width:150px;
	height:150px;
	float: left;
}
.themes .tm_info {
	font-weight: 900;
	margin-bottom: 10px;
}
.themes .tm_button {
	margin-top: 10px;
}
</style>