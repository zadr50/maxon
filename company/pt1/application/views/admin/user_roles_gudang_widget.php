<?php 
$form="warehouse";
?>
 <p class='alert alert-info'><i>Silahkan cari kode gudang  
		  yang ingin dikaitkan ke user ini, tekan tombol add untuk menambahkan.</i></p>
		  <p>
		  <?=link_button('Set','setting_gudang();return false;','tip');?>
		  <strong>Pilih Gudang </strong> : 
		  <input type='text' name='<?=$form?>_search' id='<?=$form?>_search' style='width:100px'>
		  <?=link_button('Find','dlg'.$form.'_show()','search');?>
		  <?=link_button('Add',$form.'_save()','save');?>
		  </p>
		<table id="<?=$form?>_grid" class="easyui-datagrid"  
			data-options="
				iconCls: 'icon-edit', 
				singleSelect: true, fitColoumns:true,
				url: '<?=base_url()?>index.php/user/roles/list/<?=$id?>/2',
				toolbar:'#<?=$form?>_tool',
			">
			<thead>
				<tr>
					<th data-options="field:'roles_item',width:80">Kode</th>
					<th data-options="field:'description',width:200">Gudang</th>
					<th data-options="field:'id',width:10">Id</th>
				</tr>
			</thead>
		</table>  
	 

<div id='<?=$form?>_tool'>
	<?=link_button('Remove',$form.'_delete()','remove');?>
</div>

<?=$lookup_gudang?>  	

<script language='javascript'>
	user_id='<?=$id?>';
	function <?=$form?>_save() {
		var gudang=$("#<?=$form?>_search").val();
		var url=CI_ROOT+'user/roles/add/'+user_id+'/2';
		if(gudang==""){alert('Isi kode gudang terlebih dahulu.');return false;}
		$.ajax({
			type: "GET",
			url: url,
			data:'user_id='+user_id+'&roles_item='+gudang,
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
			xurl=CI_ROOT+'user/roles/delete/'+user_id+'/2/'+row.id;                             
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
	function setting_gudang(){
		var url=CI_ROOT+'shipping_locations';
		add_tab_parent("gudang",url);
	}	
</script>