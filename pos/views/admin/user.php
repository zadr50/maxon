<div class="thumbnail">
	<?
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print_item()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/user/add');		
	echo link_button('Search','','search','false',base_url().'index.php/user');		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/user/view/'.$id);		
	echo link_button('Delete', 'delete_user()','remove');		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help()','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div onclick="show_syslog('user','<?=$id?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/user");
		}
	</script>
	
</div>
		

<?php echo validation_errors(); ?>
<div class="col-md-12" >	
	<form id="frmUser"  method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
   <?php 
   		if($mode=='view'){
			$disabled='disable';
		} else {
			$disabled='';
   		}
   ?> 
   <table class='table'>
	<tr><td>User ID </td>
		<td>
			<?php
			if($mode=='view'){
				echo form_input('user_id',$id,"id='user_id' readonly");
			} else { 
				echo form_input('user_id',$id,"id='user_id'");
			}		
		?></td>
		<td>Supervisor</td><td><?php echo form_dropdown('supervisor',$supervisor_list,$supervisor,"id=supervisor");?></td>
	</tr>	 
    <tr><td>Username &nbsp&nbsp</td><td><?php echo form_input('username',$username,"id=username");?></td>
		<td>CID </td><td><?php echo form_input('cid',$cid,"id=cid");?></td>
	</tr>
	<tr><td>Password </td><td><?php echo form_input('password',$password,"id=password");?></td>
		<td>Cabang</td><td><?php echo form_dropdown('branch_code',$branch_list,$branch_code,"id=branch_code");?></td>       	
	</tr> 
	<tr><td colspan=6><?=form_checkbox("flag1",1,$flag1)?>&nbsp Tampilkan penjualan hanya untuk user ini saja</td>
	</tr> 
   </table>	
	</form>
</div>
<div class="col-md-12" >
	<div class="easyui-tabs">
		<div title="User Jobs" style="padding:10px">
			<?=load_view("admin/user_job_widget.php")?>
		</div>
		<div title="Picture" style="padding:10px">
			<?=load_view("admin/user_foto_widget.php")?>
		</div>
		<div title="Division" style="padding:10px">
			<?=load_view("admin/user_roles_widget.php")?>
		</div>
		<div title="Warehouse" style="padding:10px">
			<?=load_view("admin/user_roles_gudang_widget.php")?>
		</div>
	</div>
</div>
<script language='javascript'>
	var url;	
 
  	function save(){
  		if($('#user_id').val()==''){alertMX('Isi user id !');return false;}
  		if($('#username').val()==''){alertMX('Isi user name !');return false;}
  		if($('#password').val()==''){alertMX('Isi password !');return false;}
		if($('#cid').val()==""){alertMX("Isi kode CID !");return false;}
		url='<?=base_url()?>index.php/user/save';
			$('#frmUser').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
						url='<?=base_url()?>index.php/user/view/'+$('#user_id').val();
						window.open(url,"_self");
					} else {
						log_err(result.msg);
					}
				}
			});
  	}


	function delete_user() {
		$.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
			if (r){
				var user_id=$("#user_id").val();
				var url=CI_ROOT+"user/delete/"+user_id;	
				window.open(url,"_self");
			}
		})
	}

</script>

