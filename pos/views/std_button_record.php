<div class="thumbnail">
	<?
	echo link_button('Save', 'save_'.$controller.'();','save');		
	echo link_button('Print', 'print_'.$controller.'()','print');
	echo link_button('Add','add_'.$controller.'()','add'); 	
	echo link_button('Search','search_'.$controller.'()','search');	
	echo link_button('Delete','del_'.$controller.'()','cut');		
	echo link_button('Refresh','reload_'.$controller.'()','reload');		
	echo link_button('Help', 'load_help()','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="my_load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		
		var mode=$("mode").val();
		var nomor=$("#<?=$field_key?>").val();
		
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/<?=$controller?>");
		}
		function add_<?=$controller?>() {
			var url='<?=base_url()?>index.php/<?=$controller?>/add';	
			window.open(url,"_self");
		}
		function search_<?=$controller?>() {
			var url='<?=base_url()?>index.php/<?=$controller?>';	
			window.open(url,"_self");
		}
		function del_<?=$controller?>() {
			if(mode=="view") {
				var url='<?=base_url()?>index.php/<?=$controller?>/delete/'+nomor;	
				window.open(url,"_self");
			}
		}
		function reload_<?=$controller?>() {
			if(mode=="view") {
				var url='<?=base_url()?>index.php/<?=$controller?>/view/'+nomor;	
				window.open(url,"_self");
			}
		}
	</script>
	
</div>