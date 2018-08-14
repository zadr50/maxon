<?php 
$form="divisions";
if(!isset($set_hide))$set_hide=false;

?>
		  <?php 
		  if(!$set_hide)  echo link_button('Set','setting_division();return false;','tip');?>
		  <strong>Pilih Divisi Barang </strong> : 
		  <input type='text' name='<?=$form?>_search' id='<?=$form?>_search' style='width:100px'>
		  <?=link_button('Find','dlg'.$form.'_show()','search');?>
		  <?php 
		  if(!$set_hide)  echo link_button('Add',$form.'_save()','save');?>
		  </p>
		<table id="<?=$form?>_grid" class="easyui-datagrid"  
			data-options="
				iconCls: 'icon-edit', 
				singleSelect: true, fitColoumns:true,
				url: '<?=base_url()?>index.php/user/roles/list/<?=$id?>/1',
				toolbar:'#<?=$form?>_tool',
			">
			<thead>
				<tr>
					<th data-options="field:'roles_item',width:80">Divisi</th>
					<th data-options="field:'description',width:200">Nama Divisi</th>
					<th data-options="field:'id',width:10">Id</th>
				</tr>
			</thead>
		</table>  
  <p class='alert alert-info'><i>Silahkan cari divisi master barang 
          yang ingin dikaitkan ke user ini, pilih tombol divisi dan tekan tombol add.</i></p>
          <p>
 
<div id='<?=$form?>_tool'>
	<?=link_button('Remove',$form.'_delete()','remove');?>
</div>

<?=$lookup_division?>  	

<script language='javascript'>
	user_id='<?=$id?>';
	function <?=$form?>_save() {
		var divisi=$("#<?=$form?>_search").val();
		var url=CI_ROOT+'user/roles/add/'+user_id+'/1';
		if(divisi==""){alert('Isi kode divisi terlebih dahulu.');return false;}
		$.ajax({
			type: "GET",
			url: url,
			data:'user_id='+user_id+'&roles_item='+divisi,
			success: function(msg){
				$('#<?=$form?>_grid').datagrid('reload');
				$('#<?=$form?>_search').val('');
			},
			error: function(msg){alert(msg);}
		});
	}
	function <?=$form?>_delete(){
		row = $('#<?=$form?>_grid').datagrid('getSelected');
		if (row){
			xurl=CI_ROOT+'user/roles/delete/'+user_id+'/1/'+row.id;                             
			$.ajax({
				type: "GET",
				url: xurl,
				success: function(msg){
					$('#<?=$form?>_grid').datagrid('reload');
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});         
		}
	}
	function setting_division(){
		var url=CI_ROOT+'company/division';
		add_tab_parent("division",url);
	}
</script>