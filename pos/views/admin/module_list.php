<div class='thumbnail'>
	<?
	echo link_button('Print', 'print_item()','print');		
	echo link_button('Add','append()','add');		
	echo link_button('Search', 'search_mod()','search');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/modules');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/modules");
		}
	</script>
	
</div>
	<div class="thumbnail">
		<ul id='tt' class="easyui-tree"
			data-options="url:'<?=base_url()?>index.php/modules/list_json',
			animate:true,
			onContextMenu: function(e,node){
				e.preventDefault();
				$(this).tree('select',node.target);
				$('#mm').menu('show',{
					left: e.pageX,
					top: e.pageY
				});
			}
			
			">
		</ul>
	</div>

	<div id="mm" class="easyui-menu" style="width:120px;">
		<div onclick="change()" data-options="iconCls:'icon-edit'">Change</div>
		<div onclick="append()" data-options="iconCls:'icon-add'">Append</div>
		<div onclick="remove()" data-options="iconCls:'icon-remove'">Remove</div>
	</div>

<? include_once "modules.php"; ?>

<script language="javascript">
	function mod_load(mod_id){
		var url="<?=base_url()?>/index.php/modules/list/";
		$.ajax({
			type: "GET",
			url: url,
			data:'user_id='+user_id+'&job='+job,
			success: function(msg){
				$('#dgJob').datagrid('reload');
				$('#txtJob').val('');
			},
			error: function(msg){alert(msg);}
		});
	}
	function change() {
		var node = $('#tt').tree('getSelected');
		$k("#module_id").val(node.id);
		$("#mode").val('view');
		xurl=CI_ROOT+'modules/find/'+$('#module_id').val();
		$.ajax({
					type: "GET",
					url: xurl,
					data:'',
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#module_name').val(obj.module_name);
						$('#description').val(obj.description);
						$('#type').val(obj.type);
						$('#form_name').val(obj.form_name);
						$('#parentid').val(obj.parentid);
						$('#sequnce').val(obj.sequence);
					},
					error: function(msg){alert(msg);}
		});		
		$('#dlgMod').dialog('open').dialog('setTitle','Add / Edit Module Name');		
	}
	function append(){
		$("#mode").val('add');
		$('#dlgMod').dialog('open').dialog('setTitle','Add / Edit Module Name');		
	}
	function remove() {
	
	}

</script>