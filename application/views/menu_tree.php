<?php
    if($qapp=$this->db->where("is_active",1)->order_by("id")->get("maxon_apps")){
    	foreach($qapp->result() as $app){
    		if(allow_mod($app->app_id)){
				$controller=$app->app_controller;
				$filename=APPPATH."/views/".$controller."/menu.php";
				if(file_exists($filename)){			
    				echo load_view("$controller/menu");
				}
    			//add_shortcut($app->app_name,$app->app_ico,'#cdc',$app->app_controller,
    			//$app->app_desc,$app->app_id);
    		}
    	}
    }
	
?>	


