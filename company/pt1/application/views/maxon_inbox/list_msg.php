<div class='thumbnail'>
<?php 
echo link_button("Inbox","list_msg()","search");
if(isset($id)) echo link_button("Delete","delete_msg($id)","remove");
?>

</div>
<div class='table2'>
<?
echo $list_msg;
?>
</div>

<script language="javascript">
function list_msg(){
	window.open("<?=base_url()?>index.php/maxon_inbox/list_msg","_self");
}
function delete_msg(id){
    window.open("<?=base_url()?>index.php/maxon_inbox/delete_msg/"+id,"_self");    
}
</script>

<style>
</style>



