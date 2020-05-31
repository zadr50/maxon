<div class='thumbnail'>
	<?php
//	echo link_button('Print', 'print_item()','print');		
	echo link_button('Add','append()','add');		
//	echo link_button('Search', 'search_mod()','search');		
//    echo link_button("Browse","","more","false",base_url('index.php/modules/browse'));
	echo link_button('Refresh','','reload','false',base_url().'index.php/modules');		
    echo "<label>&nbsp Group: </label>";
    echo form_dropdown("txtKelompok",$parent_id_list,$parent_id,"id='txtKelompok' style='width:320px' onchange='load_tree();return false;'");
	?>
	<div style="float:right">
        <?=link_button('Help', 'load_help()','help')?>     
    	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',
    	   plain:false, iconCls:'icon-tip'">Options</a>
    	<div id="mmOptions" style="width:200px;">
    		<div onclick="load_help()">Help</div>
    		<div>Update</div>
    		<div>MaxOn Forum</div>
    		<div>About</div>
    	</div>
        <?=link_button('Close', 'remove_tab_parent()','cancel')?>     
    </div>
</div>
    <div class="easyui-panel box2" title="Daftar Module"  style="max-height:470px;width:95%" 
        data-options="iconCls:'icon-help'" >
        <ul id='tt' class="easyui-tree" 
            data-options="url:'',
            animate:true, height:300,
            onContextMenu: function(e,node){
                e.preventDefault();
                pageX=e.pageX;
                pageY=e.pageY;
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
        <div onclick="reload()" data-options="iconCls:'icon-reload'">Refresh</div>
	</div>

<?php include_once "modules.php"; ?>
<script type="text/javascript">
    function load_help() {
        window.parent.$("#help").load("<?=base_url()?>index.php/help/load/modules");
    }
</script>


<script language="javascript">
    pageX=0;
    pageY=0;
    $(document).ready(function(){
         load_tree();        
    });
    function load_tree(){
        var search=$("#txtKelompok").val();
        var xurl=CI_ROOT+"modules/list_json/"+search;
        loading();
        $("#tt").tree({url:xurl});
    }
    function reload(){
        url="<?=base_url()?>index.php/modules";
        window.open(url,"_self");
    }
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
		$("#module_id").val(node.id);
		$("#mode").val('view');
        $('#dlgEditBox_modules').window({left:10,top:10});
        $('#dlgEditBox_modules').dialog('open').dialog('setTitle','Add / Edit Module Name');        
		xurl=CI_ROOT+'modules/find/'+$('#module_id').val();
		loading();
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
						loading_close();
					},
					error: function(msg){
						log_err(msg);loading_close();
					}
		});		
	}
	function append(){
		$("#mode").val('add');
        $('#dlgEditBox_modules').window({left:100,top:100});
		$('#dlgEditBox_modules').dialog('open').dialog('setTitle','Add / Edit Module Name');		
	}
	function remove() {
	
	}

</script>