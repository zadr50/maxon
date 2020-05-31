<?php
$default_home=$this->config->item("default_home");

if(isset($default_home)) {
    $data["default_home"]=$default_home;
    $this->load->view($default_home,$data);            

} else {
    if($qapp=$this->db->where("is_active",1)->order_by("id")->get("maxon_apps")){
    	if($qapp->num_rows()==0){
    		echo 'error: maxon_apps table not found or empty';
    	}
    	foreach($qapp->result() as $app){
            if($app->app_id=="eshop"){
                $new_window=true;
            }
    		if(allow_mod($app->app_id)){
    			$new_window=false;
				if ( $app->app_id == "_30000.0" || strtolower($app->app_id)=="eshop"){
					$new_window=true;
				}
    			add_shortcut($app->app_name,$app->app_ico,'#cdc',$app->app_controller,
    			    $app->app_desc,$app->app_id,$new_window,$app->app_path);
    		}
    	}
    } else {
    	echo 'error: maxon_apps table not found or empty';
    }
}


function add_shortcut($label,$icon,$color='#cdc',$url='',$content='',$app_id='',$new_window=false,$path='') {
	if($path=="" || strlen($path)<3){
        echo "<div class='mxmod col-lg-5 col-md-5' 
            onclick='load_menu(\"$url\",$new_window);'> 
            <div class='mxicon'>
                <img src='".base_url()."images/$icon' width='90' height='90'>
            </div>
            <div class='mxlabel'>$label</div>
            <div class='mxdesc'>$content [<i>$app_id</i>]</div>
        </div>";
	} else {		
        echo "<div class='mxmod col-lg-5 col-md-5' 
            onclick='load_menu_app(\"$url\",$new_window);'> 
            <div class='mxicon'>
                <img src='".base_url()."images/$icon' width='90' height='90'>
            </div>
            <div class='mxlabel'>$label</div>
            <div class='mxdesc'>$content [<i>$app_id</i>]</div>
        </div>";
	} 
		
}

            
	
?>
