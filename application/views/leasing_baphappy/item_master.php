<legend><?=$title?></legend>
<?	if($mode=='view'){ 	$disabled='disable';} else {$disabled='';}
require_once(__DIR__.'../../aed_button.php');	
echo validation_errors(); 
?>
 
<form id="frmMain"  method="post" role='form' class='form-horizontal'>
	<?=my_input('Item Number','item_number',$item_number)?>
	<?=my_input('Description','description',$description)?>
	<?=my_input('Harga Jual','retail',$retail)?>
	<?=my_input('Harga Beli','cost_from_mfg',$cost_from_mfg)?>
	<?=my_input('Satuan','unit_of_measure',$unit_of_measure)?>
	<?=my_input('Category','category',$category)?>
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
</form>
 


	
 <script language='javascript'>
	function refresh_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/view/<?=$item_number?>";	
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
	function edit_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/edit/<?=$item_number?>";	
		window.open(url,"_self");
	
	}
	function validnum(){
		var fld=['retail','cost_from_mfg'];
		var n=0;
		for(i=0;i<fld.length;i++){
			n=$("#frmMain input[name="+fld[i]+"]").val();
			if(!isNumber(n)){
			alert("Isi field "+fld[i]+" dengan angka !!"); 
			return false;}
		}
		return true;
	}
	function valid(){
		var fld=["item_number","description","unit_of_measure","category"];
		for(i=0;i<fld.length;i++){
			if($("#frmMain input[name="+fld[i]+"]").val()==""){
			alert('Isi field '+fld[i]+' !!'); return false;}
		}
		return true;		
	}
	
  	function save_aed(){
		if(!valid())return false;
		if(!validnum())return false;
		url='<?=base_url()?>index.php/<?=$form_controller?>/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#mode').val('view');
					log_msg('Data sudah tersimpan.');
					url='<?=base_url()?>index.php/<?=$form_controller?>/view/'+$item_number;
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
				var url="<?=base_url()?>index.php/<?=$form_controller?>/delete/<?=$item_number?>";	
				window.open(url,"_self");
			}
		})
	}
	function posting_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/posting/<?=$item_number?>";	
		window.open(url,"_self");	
	}
	function print_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/print/<?=$item_number?>";	
		window.open(url,"_self");
	}
	
</script>