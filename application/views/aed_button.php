<div class="box-gradient" id="divToolbar">
	<?php 
	$help=!isset($help)?"unknown":$help;
	$show_tool=!isset($show_tool)?true:$show_tool;
	$show_add=!isset($show_add)?true:$show_add;
	$show_search=!isset($show_search)?true:$show_search;
	$show_edit=!isset($show_edit)?true:$show_edit;
	$show_print=!isset($show_print)?true:$show_print;
	$show_refresh=!isset($show_refresh)?true:$show_refresh;
	$show_delete=!isset($show_delete)?true:$show_delete;
	$show_save=!isset($show_save)?true:$show_save;
	$show_posting=!isset($show_posting)?false:$show_posting;
	$only_posting=!isset($only_posting)?false:$only_posting;
	$posted=!isset($posted)?false:$posted;
	
	if($only_posting){
		$show_tool=true;
		$show_add=false;$show_search=false;$show_edit=false;
		$show_print=false; $show_refresh=false; $show_delete=false;
		$show_save=false;
	}
	if($show_tool) {
		//if($show_add) echo link_button('Add','add_aed()','add');		
		//if($show_search) echo link_button('Search','search_aed()','search');
	}
	if($mode=="view" || $mode=="edit") {
		if($show_tool) {
			//if($show_edit) echo link_button('Edit','edit_aed()','edit');		
            if($show_save) echo link_button('Save', 'save_aed()','save','false',"" ,"","aed_button_save");   
			if($show_print) echo link_button('Print', 'print_aed();return false;','print');		
			if($show_refresh) echo link_button('Refresh','refresh_aed();return false;','reload');
			if($show_delete) echo link_button('Delete', 'delete_aed();return false;','remove');		
		}
	} else {
		if($show_tool) {
			if($show_save) echo link_button('Save', 'save_aed()','save','false',"" ,"","aed_button_save");	
			if($show_print) echo link_button('Print', 'print_aed();return false;','print');		
		}
	}
	if($show_tool) {
		if($posted) {
			if($show_posting) echo link_button('UnPosting','unposting_aed()','cut');
		} else {
			if($show_posting) echo link_button('Posting','posting_aed()','ok');
		}		
	}
    if(isset($extra_button)){
        echo $extra_button;
    }
    ?>
	<div style='float:right'>
    	<?=link_button('Help', 'load_help()','help')?>
    	<a href="#" class="easyui-splitbutton" 
    	data-options="menu:'#mmOptions',iconCls:'icon-tip',plain:false">Options</a>
    	<div id="mmOptions" style="width:200px;">
    		<div onclick="load_help('<?=$help?>')">Help</div>
    		<div>Update</div>
    		<div>MaxOn Forum</div>
    		<div>About</div>
		</div>
    	<?=link_button('Close', 'remove_tab_parent()','cancel')?>

	</div>
</div>
