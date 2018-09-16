<?
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
    		if($app->app_id=="_19000"){
    			echo 1;
    		}
    		if(allow_mod($app->app_id)){
    			add_shortcut($app->app_name,$app->app_ico,'#cdc',$app->app_controller,
    			$app->app_desc,$app->app_id);
    		}
    	}
    } else {
    	echo 'error: maxon_apps table not found or empty';
    }
}


function add_shortcut($label,$icon,$color='#cdc',$url='',$content='',$app_id='') {
    echo "<div class='mxmod col-lg-5 col-md-5 col-sm-12 col-xs-12' 
        onclick='load_menu(\"$url\");'> 
        <div class='mxicon'>
            <img src='".base_url()."images/$icon' width='90' height='90'>
        </div>
        <div class='mxlabel'>$label</div>
        <div class='mxdesc'>$content [<i>$app_id</i>]</div>
    </div>";
}

            
	
?>
