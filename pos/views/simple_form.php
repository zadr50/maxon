<legend><?=$title?></legend>
<?	
if($mode=='view'){ 	$disabled='disable';} else {$disabled='';}
require_once(__DIR__.'/aed_button.php');	
echo validation_errors(); 
?>
<form id="frmMain"  method="post" role='form' class="form-horizontal">
<? 	
$old_group_name="";$new_group_name="";
foreach($fields as $field) { 
	if(isset($field['group_name'])){
		$new_group_name=$field['group_name'];
		if($old_group_name!=$new_group_name){
			$old_group_name=$new_group_name;
			echo "<div class='group_name'><h2>$new_group_name</h2></div>";
		}
	}
?>
	<div class="form-group">
		<label style="text-align:left" class="col-sm-3 control-label" 
		for="<?=$field['name']?>"><?=$field['caption']?></label>
		<div class='col-sm-7 '>
		<?
		$name=$field['name'];
		if($name=="relation"){
		
		} else {
			$field_key_value="";
			$value=$data[$name];
			if($field['name']==$field_key)$field_key_value=$value;
			$caption=$field['caption'];
			$control=$field['control'];
			$readonly="";
			if($name==$field_key && $mode=="view")$readonly=" readonly";
			
			if($control=='radio'){
				$values=$field['list'];
				for($j=0;$j<sizeof($values);$j++) {
					$checked="";
					if($value==$j)$checked="checked";
					echo "<div class='radio-inline  col-sm-3'><label>". form_radio($name,$j,$checked)." ".$values[$j]."</label></div>";
				}
			} else if($control=="dropdown") {
				$values=$field['list'];
				echo "<div class='select  col-sm-3'>". form_dropdown($name,$values,$value,"style='width:300px;'")."</div>";
			} else if($control=="date") {
				$value=date('Y-m-d H:i:s', strtotime($value));
				echo "<div class='input-group date col-sm-3'>
					<input type='text' name='$name' class='datepicker form-control'
					id='$name' placeholder='$caption' value='$value'>
					<span class='input-group-addon'><i class='glyphicon glyphicon-th'></i></span>
				</div>								
					";
			} else {
				echo "<input type='text' class='form-control' name='$name' $readonly
				id='$name' placeholder='$caption' value='$value'>";
			} 
		}
		?>
		</div>
	</div>
<?  	
}
?>
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
</form>
 <script language='javascript'>
	function edit_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/edit/<?=$field_key_value?>";	
		window.open(url,"_self");
	}
	function refresh_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/view/<?=$field_key_value?>";	
		window.open(url,"_self");
	}
	function search_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>";	
		window.open(url,"_self");
	}
	function add_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/add";	
		window.open(url,"_self");
	}
  	function save_aed(){
		url='<?=base_url()?>index.php/<?=$form_controller?>/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#mode').val('view');
					log_msg('Data sudah tersimpan.');
					url='<?=base_url()?>index.php/<?=$form_controller?>/view/'+$field_key_value;
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	function delete_aed() {
		$.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
			if (r){
				var url="<?=base_url()?>index.php/<?=$form_controller?>/delete/<?=$field_key_value?>";	
				window.open(url,"_self");
			}
		})
	}
	function posting_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/posting/<?=$field_key_value?>";	
		window.open(url,"_self");	
	}
	function print_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/print/<?=$field_key_value?>";	
		window.open(url,"_self");
	}
	
</script>