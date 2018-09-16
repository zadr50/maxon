<div class="thumbnail">
	<?=link_button('Save', 'simpan()','save');?>	
	<?=link_button('Close', 'close_me()','cancel');?>	
</div>

<div class="thumbnail">
	<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
		<div title="Umum" id="box_section" class="thumbnail">
			<div class="thumbnail">				
				<table class="table">
					<tr>
						<td>Group Id</td><td><?=form_input("user_group_id",$user_group_id,"id='user_group_id'")?></td>
					</tr>
					<tr>
						<td>Group Name</td><td><?=form_input("user_group_name",$user_group_name,"id='user_group_name'")?></td>
					</tr>
					<tr>
						<td>Keterangan</td><td><?=form_input("description",$description,"id='description'")?></td>
					</tr>				
				</table>
			</div>
		</div>
		<div title="Jobs" id='box_section_job' class="thumbnail">
			<div class="thumbnail">
			<p> 
				<?php 
					echo "<label>Pilih Kelompok module: </label>";
					echo form_input("group_module",$group_module,"id='group_module'");	
					echo link_button("", "dlggroup_modules_show();return false;","search");
				?>
				
				<input type='checkbox' name='ck[]' id='select_all' style="width:30px">Select All
			</p>
			
			<i><p>Silahkan contreng modul-modul yang diijinkan untuk diakses oleh kelompok 
				dibawah ini</p></i>
			
			<div id='divDetail' class='thumbnail' style='font-size:small;max-height:400px'>
				<?php echo $modules ?>
			</div>
				
			</div>
		</div>
	</div>
</div>
	
<div id='dlgInputBox' class="easyui-dialog"  
	style="width:400px;height:200px;padding:5px 5px;left:100px;top:20px"
	closed="true"  toolbar="#tbInputBox">
	<div class='thumbnail'>
		<p><i>Silahkan ketikan sebagian kata nama atau id pencarian untuk menampilkan 
		data module dalam table module job dibawah ini</i></p>
		<p></p>
		<p>Enter Text Search:
			<input type='text' id='txtSearchInputBox'  name='txtSearchInputBox' onchange="on_find_module();return false">
			<?=link_button('Filter','on_find_module();return false;','search')?>
		</p>
	</div>
</div>
<div id='dlgEditModule' class="easyui-dialog"  
	style="width:400px;height:200px;padding:5px 5px;left:100px;top:20px"
	closed="true"  toolbar="#tbEditModule">
	<div class='thumbnail'>
		<p><i>Silahkan edit nama module dibawah ini:</i></p>
		<p></p>
		<p><input type='text' id='mod_id' value='' disabled>&nbsp Module Id</p>
		<p><input type='text' id='mod_name' value='' >&nbsp Module Name</p>
		<p><input type='text' id='mod_desc' value='' >&nbsp Module Description</p>
	</div>
</div>
<?php
echo $lookup_group_modules;

?>
<script>
	function simpan(){
		
  		if($('#user_group_id').val()==''){log_err('Isi kode kelompok user !');return false;}
  		if($('#user_group_name').val()==''){log_err('Isi nama kelompok user !');return false;}
		 var allVals = [];
	     $('.checkbox').each(function() {
	       allVals.push($(this).val());
	     });
	    param={modules:allVals,user_group_id:$("#user_group_id").val(),
	    	user_group_name:$("#user_group_name").val(),
	    	description:$("#description").val()
	    }
		url='<?=base_url()?>index.php/jobs/save';
		$.ajax({
			type: "POST",data:param, url: url,
			success: function(result)
			{
					var result = eval('('+result+')');
					if (result.success){
						log_msg("Data sudah tersimpan.")
					} else {
						log_err(result.msg);
					}
			}
		});
		
	}
	function list_modules_show(){
		if($('#user_group_id').val()==""){log_err("Isi Kode kelompok !");return false};
		url=CI_ROOT+'jobs/list_modules_show/'+$('#user_group_id').val()+'/'+$('#group_module').val();
		get_this(url,'','divDetail');
		$('#select_all').prop('checked',false);		
		
		return true;
		//url=CI_ROOT+'jobs/view/'+$('#user_group_id').val()+'/'+$('#group_module').val();
		//window.open(url,"_self");
		
	}
	function load_modules(){
		if($('#user_group_id').val()==""){alert("Isi Kode kelompok !");return false};
		url=CI_ROOT+'jobs/list_modules_json/'+$('#user_group_id').val()+'/'+$('#group_module').val();
		//get_this(url,'','divDetail');
		return true;
	}
	$( document ).ready(function() {
		var lStartNode=false;
		$('#tt').tree({	onClick: function(node) { lStartNode=true; } });
		
		$('#tt').tree({
			url:'<?=base_url()?>index.php/jobs/modules/<?=$user_group_id?>',
			onCheck: function(node){
				if(lStartNode) {
					if(node.checked){
						var url='<?=base_url()?>index.php/jobs/un_check/<?=$user_group_id?>/'+node.id;
					} else {
						var url='<?=base_url()?>index.php/jobs/check/<?=$user_group_id?>/'+node.id;
					}
					$.ajax({
						type: "GET",
						url: url,
						data:'',
						success: function(msg){
							console.log(msg);
						},
						error: function(msg){console.log(msg);}
					});
				};
			}
		});
	});	
	function find_module(){
		$('#dlgInputBox').dialog('open').dialog('setTitle','Enter text');
	}
	function on_find_module() {
		var ugi=$("#user_group_id").val();
		if(ugi==""){alert("Group ID belum diisi !");return false};
		var search=$('#txtSearchInputBox').val();
		var url='<?=base_url()?>index.php/jobs/list_modules_html/'+ugi+'/'+search;
		get_this(url,'','divDetail');	
	}
	function edit_module(mod_id) {
		$("#mod_id").val(mod_id);
		$('#udlgEditModule').dialog('open').dialog('setTitle','Edit nama module');		
	}
	function mod_expand(module_id){
		alert(module_id);
	}
	function daftar_job(){
		window.open("<?=base_url()?>index.php/jobs","_self");
	}
    $().ready(function (){
        $('#select_all').change(function() {
            var checkboxes = $(this).closest('#box_section_job').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        }); 
    });
	$(document).on('change', '.checkbox', function() {
		var ugix="<?=$user_group_id?>";
	    if(this.checked) {
	      // checkbox is checked
		  var url='<?=base_url()?>index.php/jobs/check/'+ugi+'/'+this.value;
	      console.log(this.value);
	    } else {
		  var url=CI_ROOT+'jobs/un_check/'+ugi+'/'+this.value;
	    }
	    console.log(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(msg){
				console.log(msg);
			},
			error: function(msg){log_err(msg);}
		});

	    
	});    
	function close_me(){
		remove_tab_parent();
	}
</script>