 
<p>Seting tugas dan wewenang modul yang boleh di akses berdasarkan kelompok user yang bersangkutan</p>
<div class="thumbnail">
	<?=link_button('Save', 'simpan()','save');?>
	<?=link_button("Find Module","find_module()","search");?>
	<?=link_button("Daftar Job","daftar_job()","reload");?>
</div>
<div class="thumbnail">
	<?php	
		echo form_open('',"id='myform'");
		echo my_input('Group ID','user_group_id',$user_group_id,"","col-md-5");
		echo my_input('Group Name','user_group_name',$user_group_name,"","col-md-5");
		echo my_input('Description','description',$description,"","col-md-5");
	?>
	<p></p><i><p>Silahkan contreng modul-modul yang diijinkan untuk diakses oleh kelompok dibawah ini</p></i>
	<div id='divDetail' class='thumbnail' style='font-size:small'>
		<? echo $modules ?>
		<!--
		<ul id="tt" class="easyui-tree"
			url="<?=base_url()?>index.php/jobs/list_modules">
		</ul>
		-->

	</div>
	<?=form_close();?>
</div>	
<div id='dlgInputBox' class="easyui-dialog"  
	style="width:400px;height:200px;padding:5px 5px;left:100px;top:20px"
	closed="true"  toolbar="#tbInputBox">
	<div class='thumbnail'>
		<p><i>Silahkan ketikan sebagian kata nama atau id pencarian untuk menampilkan 
		data module dalam table module job dibawah ini</i></p>
		<p></p>
		<p>Enter Text Search:
			<input type='text' id='txtSearchInputBox'  name='txtSearchInputBox'>
			<?=link_button('Filter','on_find_module()','search')?>
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

<script>
	function simpan(){
  		if($('#user_group_id').val()==''){alert('Isi kode kelompok user !');return false;}
  		if($('#user_group_name').val()==''){alert('Isi nama kelompok user !');return false;}
		url='<?=base_url()?>index.php/jobs/save';
			$('#myform').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
	}
	function load_modules(){
		if($('#user_group_id').val()==""){alert("Isi Kode kelompok !");return false};
		url=CI_ROOT+'jobs/list_modules/'+$('#user_group_id').val();
		get_this(url,'','divDetail');
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

</script>