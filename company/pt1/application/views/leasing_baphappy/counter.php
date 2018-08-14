<legend><?=$title?></legend>
<?	if($mode=='view'){ 	$disabled='disable';} else {$disabled='';}
$form_controller="leasing/counter";
require_once(__DIR__.'../../aed_button.php');	
echo validation_errors();
 
?>
 
<form id="frmMain"  method="post" role='form' class='form-horizontal'>
	<?=my_input('Kode','counter_id',$counter_id)?>
	<?=my_input('Nama Counter','counter_name',$counter_name)?>
	<?=my_input('Kode Area','area',$area)?>
	<?=my_input('Nama Area','area_name',$area_name)?>
	<?=my_dropdown('Sales Agent','sales_agent',$sales_agent,$sales_agent_list)?>
	<?=my_input('Alamat','address',$address)?>
	<?=my_input('Telfon','phone',$phone)?>
	<?=my_input('Tanggal Gabung','join_date',$join_date)?>
	<?=my_input('Target','target',$target)?>
	<?=my_checkbox('Aktif','active',$active,'')?>
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
</form>
 


	
 <script language='javascript'>
	function refresh_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/view/<?=$counter_id?>";	
		window.open(url,"_self");
	}
	function search_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>";	
		window.open(url,"_self");
	}
	function edit_aed() {
		var url="<?=base_url()?>index.php/<?=$form_controller?>/edit/<?=$counter_id?>";	
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
					url='<?=base_url()?>index.php/<?=$form_controller?>/view/'+$counter_id;
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
				var url="<?=base_url()?>index.php/<?=$form_controller?>/delete/<?=$counter_id?>";	
				window.open(url,"_self");
			}
		})
	}
	function posting_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/posting/<?=$counter_id?>";	
		window.open(url,"_self");	
	}
	function print_aed(){
		var url="<?=base_url()?>index.php/<?=$form_controller?>/print/<?=$counter_id?>";	
		window.open(url,"_self");
	}	
</script>