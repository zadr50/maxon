<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

if ( ! function_exists('app_active')) {
    function app_active($app_id){
        $CI =& get_instance();
        $retval=false;
        $qapp=$CI->db->select("is_active")->where("app_id",$app_id)->get("maxon_apps");
        if($row=$qapp->row()){
            $retval=$row->is_active==1?true:false;
        }
        return $retval;
    }
}

if(!function_exists('c_')){
    function c_($value){
        return str_replace(',','',$value);
    }
}

if(!function_exists("menu")){
function menu($title,$url,$func=false){
		if(!$func){
			echo "<div><a href='".base_url()."index.php/".$url."' class='easyui-linkbutton' data-options='plain:true'>".$title."</a></div>";	
		} else {
			echo "<div><a href='#' onclick=\"load_menu('$url')\"  class='easyui-linkbutton' data-options='plain:true'>".$title."</a></div>";
		}
	}
}
if(!function_exists("add_menu_drop")){
	function add_menu_drop($menu_id,$caption,$mod_id) {
		if(allow_mod($mod_id)){
			echo "<li><a onclick=load_menu('$menu_id') href='#'>$caption</a></li>";
		}
	}
}
if(!function_exists("add_menu_drop_2")){
	function add_menu_drop_2($menu_id,$caption,$mod_id) {
		if(allow_mod($mod_id)){
			echo "<li><a href='".base_url()."index.php/$menu_id'
			class='info_link' >$caption</a></li>";
		}
	}
	
}
if(!function_exists("load_picture")){
	function load_picture($file=''){
		if($file=='') return base_url()."images/no-images.png";
		$f=FCPATH . "tmp/".$file;
		if(file_exists($f)){
			return base_url()."tmp/".$file;
		} else {
			return base_url()."images/no-images.png";
		}
	}
}
if(!function_exists("my_input_date")){
	function my_input_date($caption,$field_name,$field_value,$class_cap="",$class_text=""){
		echo "<div class='form-group'>
		<label class='control-label ".$class_cap."' for='".$field_name."'>".$caption."</label>
		<div class='".$class_text."'>".form_input($field_name,$field_value,
		"id='".$field_name."' class='form-control input-sm easyui-datetimebox' 
		data-options='formatter:format_date,parser:parse_date'
		style='width:200px'
		")."</div></div>";
	}
}
if(!function_exists("form_input_date")){
	function form_input_date($field_name,$field_value,$class_cap="",$class_text=""){
		echo form_input($field_name,$field_value,
		"id='".$field_name."' class='easyui-datetimebox' 
		data-options='formatter:format_date,parser:parse_date'
		");
	}
}
if(!function_exists("my_button")){
	function my_button($caption,$func,$icon,$tooltip){
		echo "<a href='#' onclick='$func'
		class='btn btn-primary glyphicon glyphicon-$icon'
		title='$tooltip'>$caption</a>";
	}
}
if(!function_exists("my_button_submit")){
	function my_button_submit($caption='Submit'){
		echo "<input type='submit' value='$caption' name='submit' name='submit' 
		class='btn btn-primary'>";
	}
}

if(!function_exists("my_input_2")){
	function my_input_2($data,$field_name='',$field_value=''){
	   my_input($data,$field_name,$field_value,"x","x");
		
	}
}
if(!function_exists("my_input3")){
    function my_input3($param){
        $par=(object)$param;
        if(!isset($par->extra))$par->extra="";
        if(!isset($par->value))$par->value="";
        $id_name=$par->field;
        if(isset($par->id))$id_name=$par->id;
        $s=form_input($par->field,$par->value,"id='$id_name' $par->extra");
        if(isset($par->button))$s.=link_button('',$par->func,"search");
        if(isset($par->button_add))$s.=link_button('',$par->func_add,"add");
        return $s;
    }
}

if(!function_exists("my_input")){
	function my_input($data,$field_name='',$field_value='',$caption_class="",$text_class="",$style=""){
		$caption=$data;
		$sub_caption="";
		$align="";
		$text_class_field='';
		$param=""; $show_button="";
		$clear_line="";
		if(is_array($data)){
			foreach($data as $key=>$value)
			{
				if ( $key == "caption" ) $caption=$value;
				if ( $key == "sub_caption" ) $sub_caption=$value;
				if ( $key == "field_name" ) $field_name=$value;
				if ( $key == "value" ) $field_value=$value;
				if ( $key == "caption_class" ) $caption_class=$value;
				if ( $key == "text_class" ) $text_class=$value;
				if ( $key == "style" ) $style=$value;
				if ( $key == "align" ) $align=' align="'.$value.'" ';
				if ( $key == "text_class_field" ) $text_class_field=$value;
				if ( $key == "param" ) $param=$value;
				if ( $key == "show_button" ) $show_button=$value;
				if ( $key == "clear_line" ) $clear_line=$value;
			}
		}
		if($caption_class=="")$caption_class="col-xs-3";
		if($text_class=="")$text_class="col-xs-4";
		echo "<div class='form-group'>
		<label $align class='control-label $caption_class ' for='$field_name'>$caption</label>
		<div class='$text_class'>"
		.form_input($field_name,$field_value,
		"$param id='$field_name' class='form-control input-sm  $text_class_field ' $style")
		."";
		if ($clear_line!="") echo "<div class='clear'>";
		if ($sub_caption!="") echo "<i>$sub_caption</i>";
		if ($clear_line!="") echo "</div>";
		echo "</div>";
		if ($show_button!="") echo $show_button;
		echo "</div>";
	}
}
if(!function_exists("my_hidden")){
	function my_hidden($data,$field_name='',$field_value='',$caption_class="",$text_class="",$style=""){
		$caption=$data;
		if(is_array($data)){
			foreach($data as $key=>$value)
			{
				if ( $key == "field_name" ) $field_name=$value;
				if ( $key == "value" ) $field_value=$value;
			}
		}
		echo form_hidden($field_name,$field_value,"id='$field_name'");
	}
}

if(!function_exists("my_textarea")){
	function my_textarea($data,$field_name='',$field_value='',$caption_class="",$text_class="",$style=""){
		$caption=$data;
		$sub_caption="";
		$align="";
		$text_class_field='';
		if(is_array($data)){
			foreach($data as $key=>$value)
			{
				if ( $key == "caption" ) $caption=$value;
				if ( $key == "sub_caption" ) $sub_caption=$value;
				if ( $key == "field_name" ) $field_name=$value;
				if ( $key == "value" ) $field_value=$value;
				if ( $key == "caption_class" ) $caption_class=$value;
				if ( $key == "text_class" ) $text_class=$value;
				if ( $key == "style" ) $style=$value;
				if ( $key == "align" ) $align=' align="'.$value.'" ';
				if ( $key == "text_class_field" ) $text_class_field=$value;
			}
		}
		echo "<div class='form-group ' >
		<label  $align class='control-label $caption_class' for='$field_name'>$caption</label>
			<div class='$text_class'>"
			.form_textarea($field_name,$field_value,
			"id='$field_name' class='form-control input-sm $text_class_field ' $style ")
			."</div>
		</div>";
	}
}

if(!function_exists("my_input_file")){
	function my_input_file($data,$field_name='',$field_value='',$caption_class="",$text_class="",$style=""){
		$caption=$data;
		$sub_caption="";
		$align="";
		$text_class_field='';
		$add_text_field=false;
		$new_control='';
		$show_images=false;
		$images_control='';
		if(is_array($data)){
			foreach($data as $key=>$value)
			{
				if ( $key == "caption" ) $caption=$value;
				if ( $key == "sub_caption" ) $sub_caption=$value;
				if ( $key == "field_name" ) $field_name=$value;
				if ( $key == "value" ) $field_value=$value;
				if ( $key == "caption_class" ) $caption_class=$value;
				if ( $key == "text_class" ) $text_class=$value;
				if ( $key == "style" ) $style=$value;
				if ( $key == "align" ) $align=' align="'.$value.'" ';
				if ( $key == "text_class_field" ) $text_class_field=$value;
				if ( $key == "add_text_field" ) $add_text_field=$value;
				if ( $key == "show_images" ) $show_images=$value;
			}
		}
		if($add_text_field) {
			$new_control="<input type='text' name='$field_name' id='$field_name'
					value='$field_value'  class='form-control input-sm  $text_class_field ' $style/>";
		}
		if($show_images) {
			$images_control="<div class='thumbnail '>
				<img src='".base_url()."images/$field_value'>
			</div>";
		}
		echo "<div class='form-group'>
			<label class='control-label $caption_class' for='$field_name'>$caption</label>
			<div class='$text_class'>
				<input type='file' name='img_$field_name' id='img_$field_name' title='Select'/>
				$new_control
				$images_control
			</div>
		</div>";
	}
}
if(!function_exists("my_input_tr")){
	function my_input_tr($caption,$field_name,$field_value='',$etc=''){
		$tr="<tr><td>".$caption."</td><td>
		<input type='text' name='".$field_name."' id='".$field_name."' value='$field_value'>";
		if($etc!="") $tr .= $etc;
		$tr .= "</td></tr>";
		echo $tr;
	}
}
if(!function_exists("my_input_td")){
    function my_input_td($caption,$field_name,$field_value='',$etc=''){
        $tr="<td>".$caption."</td><td>
        <input type='text' name='".$field_name."' id='".$field_name."' value='$field_value'>";
        if($etc!="") $tr .= $etc;
        $tr .= "</td>";
        echo $tr;
    }
}

if(!function_exists("my_input_date_tr")){
	function my_input_date_tr($caption,$field_name,$field_value='',$etc=''){
		$tr="<tr><td>".$caption."</td><td>
		<input type='text' name='".$field_name."' id='".$field_name."' value='$field_value' 
		class='easyui-datetimebox' 
		data-options='formatter:format_date,parser:parse_date'
		>";
		if($etc!="") $tr .= $etc;
		$tr .= "</td></tr>";
		echo $tr;
	}
}
if(!function_exists("my_input_date_td")){
    function my_input_date_td($caption,$field_name,$field_value='',$etc=''){
        $tr="<td>".$caption."</td><td>
        <input type='text' name='".$field_name."' id='".$field_name."' value='$field_value' 
        class='easyui-datetimebox' 
        data-options='formatter:format_date,parser:parse_date'
        >";
        if($etc!="") $tr .= $etc;
        $tr .= "</tdxxxxxxxxxxxxxxxxxxxxxxxxxxx>";
        echo $tr;
    }
}

		
if(!function_exists("my_dropdown")){
	function my_dropdown($caption,$field_name,$field_value,$array_list,$class_cap="",$class_text=""){
		echo "<div class='form-group'>
		<label class='control-label ".$class_cap."' for='".$field_name."'>".$caption."</label>
		<div class='".$class_text."'>".form_dropdown($field_name,$array_list,$field_value,
		"id='".$field_name."' class='form-control'")."</div></div>";
	}
}
if(!function_exists("array_data_table")){
	function array_data_table($table,$field_key,$field_val,$query=""){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$data2=$CI->db->select("$field_key,$field_val")->get("$table")->result_array();
		$data[]=array($field_key=>"",$field_val=>"--Select--");
		$data=array_merge($data,$data2);
		$list=null;for($i=0;$i<count($data);$i++){$list[$data[$i][$field_key]]=$data[$i][$field_val];}
		return $list;
	}
}
if(!function_exists("my_checkbox")){
	function my_checkbox($caption,$field_name,$field_value,$array_list,$class_cap="col-sm-4",$class_text="col-sm-2"){
		if(is_array($array_list)){
		echo "<div class='form-group' >
		<label class='control-label ".$class_cap."' for='".$field_name."'>".$caption."</label>
		<div class='col-md-6'>";
		$field_value_array=explode(",",$field_value);
		foreach( $array_list as $key => $value ) {
			$found=false;
			if(is_array($field_value_array)){
				for($j=0;$j<count($field_value_array);$j++) {
					if($field_value_array[$j]==$value){
						$found=true;
					}
				}
				$checked=$found;
			} else {
				$checked=$field_value==$value?true:false;
			}
			echo "<label class='control-label col-md-4'>";
			echo form_checkbox($field_name.'[]', $key, $checked,
				"id='".$field_name."' class='checkbox'").' '.$value.' ';
			echo "</label>";
		}
		echo "</div>
		</div>
		<div class='clearfix'></div>";
		} else {
			$checked=$field_value=="1"?true:false;
			echo "<div class='form-group'>
			<label class='control-label ".$class_cap."' for='".$field_name."'>".$caption."</label>
			<div class='".$class_text."'>".form_checkbox($field_name,$field_value,$checked,
			"id='".$field_name."' class='form-control input-sm'")."</div></div>";	

		}
	}
}
if(!function_exists("render_form")) {
	function render_form($form) {
	$data[]=null;
	foreach($form as $frm)
	{
		$data=array_merge($data,$frm['data']);
		switch($frm['input_type'])
		{
			case "dropdown":
				break;
			case "datetime":
				break;
			case "textarea":
				my_textarea($data);
				break;
			case "file":
				my_input_file($data);
				break;
			case "hidden":
				my_hidden($data);
				break;
			default:
				my_input($data);
				break;
		}
	}
	}
}
if(!function_exists("add_button_menu")){
	function add_button_menu($caption,$modul,$ico,$description,$on_click=""){
	$click="href='".base_url()."index.php/$modul'";
	if($on_click<>"") $click=" onclick='$on_click'";
	echo "<div class='col-lg-3 col-md-4 col-sm-12 info thumbnail info_link box-gradient' $click>
				<div class='photo'><img src='".base_url()."images/$ico'/></div>
				<div class='detail'><h4>$caption</h4></br>$description</div>
		</div>";
	}
}
if(!function_exists("format_sql_date")){
	function format_sql_date($value){
		return  date('Y-m-d H:i:s', strtotime($value));
	}
}
if(!function_exists("dropdown_data")){
	function dropdown_data($table,$field_key="",$field_value="",$where=""){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$ret['']='- Select -';
		$sql="select $field_key,$field_value from $table";
		if($where!="")$sql .= $where;
		if($query=$CI->db->query($sql)) {
			foreach ($query->result_array_assoc() as $row){
				$ret[]=$row;
			}
		}
		return $ret;
	}
}
if(!function_exists('add_date')){
	function add_date($givendate,$day=0,$mth=0,$yr=0) {
		  $cd = strtotime($givendate);
		  $newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
		date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
		date('d',$cd)+$day, date('Y',$cd)+$yr));
		  return $newdate;
	}
}
if(!function_exists('add_log_run')){
	function add_log_run($url){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$max_id=$CI->db->select('max(id) as z_max')->get('sys_log_run')->row();
		if($max_id->z_max>100){
			$CI->db->query("delete from sys_log_run where id<".($max_id->z_max-100));
		} 
		$data['user_id']=$CI->access->user_id();
		$data['url']=$url;
		$data['controller']=$CI->uri->segment(1);
		$data['method']=$CI->uri->segment(2);
		$data['param1']=$CI->uri->segment(3);
		$CI->db->insert("sys_log_run",$data);
		//var_dump(mysql_error());
	}
}
if(!function_exists("view_syslog")){
	function view_syslog(){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$sql="select url,controller,method,param1
		from sys_log_run where user_id='".$CI->access->user_id()."'
		group by url,controller,method,param1 limit 20 ";
		$q=$CI->db->query($sql);
		$sys_log_run="";
		if($q){
			foreach ($q->result() as $row) {
				$url=$row->controller;
				if(!$row->method=='0')$url.="/".$row->method;
				if(!$row->param1=='0')$url.="/".$row->param1;
				$sys_log_run.="<li><a  class='info_link'  href='".base_url()."index.php/".$url."'>".$url."</a></li>";
			}
		}
		return $sys_log_run;
	}
}
if(!function_exists("my_log")){
	function my_log($jenis,$text,$user_id=""){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$CI->db->insert("syslog",array("tgljam"=>date("Y-m-d H:i:s"),
			"userid"=>$user_id!=""?$user_id:$CI->access->user_id(),"jenis"=>$jenis,"logtext"=>$text));
	}
}
if(!function_exists("user_id")){
	function user_id(){
        $CI =& get_instance();
		return $CI->access->user_id();
	}
}
if(!function_exists("alert_count")){
    function alert_count(){
        $CI =& get_instance();
                    
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        $userid=$CI->access->user_id();
        $sql="select * from syslog where tgljam>'2017-12-01' and userid='$userid'";
        $q=$CI->db->query($sql);
        $cnt=$q->num_rows();        
        
        $title= "$userid ";
        return $title;
    }
}

if(!function_exists("user_pass")){
	function user_pass(){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		return $CI->access->user_pass();
	}
}
if(!function_exists("current_gudang")){
    function current_gudang(){
        $CI =& get_instance();
       $gudang_session=$CI->session->userdata("session_outlet",'');     
       $gudang=$CI->access->current_gudang();
       $retval="";
       if($gudang_session!="")$retval=$gudang_session;
       if($retval=="")$retval=$gudang;
       return $retval;
    }
}

if(!function_exists("cid")){
	function cid(){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
       
       $cid_session=$CI->session->userdata("session_company_code",'');     
       $cid=$CI->access->cid();
       $retval="";
       if($cid_session!="")$retval=$cid_session;
       if($retval=="")$retval=$cid;
       return $retval;
	}
}
if(!function_exists("cidt")){
	function cidt(){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$cid=$CI->access->cid();
		//if($cid=="ALL" || $cid==""){
			return "";
		//} else {
		//	return $cid."_";
		//}
	}
}

if(!function_exists("lock_report_salesman")){
	function lock_report_salesman(){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$salesman="";
		$lock=false;
		if($q=$CI->db->select('salesman,lock_report')->where('user_id',$CI->access->user_id())
			->get("salesman")){
			if($qrow=$q->row()){
				$salesman=$qrow->salesman;
				$lock=$qrow->lock_report;
			}
		}
		return $lock;
	}
}
if(!function_exists("current_salesman")){
	function current_salesman(){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$salesman="";
		$lock=false;
		if($q=$CI->db->select('salesman,lock_report')->where('user_id',$CI->access->user_id())
			->get("salesman")){
			if($qrow=$q->row()){
				$salesman=$qrow->salesman;
				$lock=$qrow->lock_report;
			}
		}
		return $salesman;
	}
}

if(!function_exists("cust_id")){
	function cust_id(){
        $CI =& get_instance();
		return $CI->session->userdata('cust_id');
	}
}

if(!function_exists("user_name")){
	function user_name($user_id=""){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		if($user_id==""){
			return $CI->access->user_name();
 		} else {
 			if($q=$CI->db->where('user_id',$user_id)->get('user')){
				if($row=$q->row()){
					return $row->username;
				} else {
					return $CI->access->user_name();
				}
			} else {
				return $CI->access->user_name();

			}
 		}

	}
}
if(!function_exists("user_admin")){
	function user_admin(){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		return $CI->session->userdata('user_admin');
	}
}
if(!function_exists('account')){
	function account($account_id){
        $CI =& get_instance();
                    
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        $query=$CI->db->query("select account,account_description from chart_of_accounts
        where id='$account_id'")->row();
		if($query){
			return $query->account." - ".$query->account_description;
		} else {
			return "";
		}
	}
}
if(!function_exists('account_id')){
	function account_id($account){
		$account=urldecode($account);
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$data=explode(" - ", $account);
		$coa=$CI->chart_of_accounts_model->get_by_id($data[0])->row();
		if($coa){
			return $coa->id;
		} else {
			return 0;
		}
	}
}
        
if(!function_exists('invalid_account')){
	function invalid_account($account_id){
		$ret= ($account_id=="" || $account_id=="0" || $account_id==0);
		if( !$ret ) $ret=account($account_id)=="";
		return $ret;
	}
}

if(!function_exists('criteria')){
	function criteria($capt,$fld,$cls='easyui-input',$style=""){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$fnc=new search_criteria();
		if($CI->input->get($fld) or $CI->input->get($fld)==''){
			$value=$CI->input->get($fld);
			$CI->session->set_userdata($fld,$value);
		} else {
			$value=$CI->session->userdata($fld);
		}
		$fnc->caption=$capt;
		$fnc->field_id=$fld;
		$fnc->field_class=$cls;
		$fnc->field_value=$value;
		$fnc->field_style=$style;
		return $fnc;
	}
}
if(!function_exists('link_button')){
    function link_button($caption,$func,$icon='',$plain='false',$url='',$title=''){
    	if($url==''){
	        return '<a href="#" class="easyui-linkbutton"
	        data-options="iconCls:\'icon-'.$icon.'\',
	        plain: '.$plain.'" onclick="'.$func.';return false;">'.$caption.'</a>';
		} else {
	        return '<a href="'.$url.'" class="easyui-linkbutton"
	        data-options="iconCls:\'icon-'.$icon.'\',
	        plain: '.$plain.'"  " >'.$caption.'</a>';
		}
    }
}
if(!function_exists('link_button2')){
    function link_button2($caption,$func,$icon='',$plain='false',$url='',$title=''){
    	if($url==''){
	        return '<a href="#" class="btn btn-default glyphicon glyphicon-'.$icon.'"
	        data-optionsx="iconClsx:\'icon-'.$icon.'\',
	        plain: '.$plain.'" onclick="'.$func.';return false;"> '.$caption.'</a>';
		} else {
	        return '<a href="'.$url.'" class="btn btn-default glyphicon glyphicon-'.$icon.'"
	        data-optionsx="iconClsx:\'icon-'.$icon.'\',
	        plain: '.$plain.'"  " > '.$caption.'</a>';
		}
    }
}

if(!function_exists('datasource')){
    function datasource($sql,$with_checkbox=false,$primary_key=""){
        
    
        $CI =& get_instance();
//    $CI->benchmark->mark('code_start');        
                    
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }    
       $pages=1000;
        $query=$CI->db->query($sql);
		$rows=array();
		if($query){ 
	        foreach($query->result_array() as $row){
				if($row){
                    if($with_checkbox){
                        $row["ck"]=form_checkbox("ck[]",$row[$primary_key],'',"style='width:50px' ");
                    }
					$rows[]=$row;
				}
	        };
			
		}
        $data['total']=$pages;    //count($rows);
        $data['rows']=$rows;
//        var_dump($data);
//$CI->benchmark->mark('code_end');

//echo $CI->benchmark->elapsed_time('code_start', 'code_end');

        return json_encode($data);
		
    }
}
if(!function_exists('is_ajax')){
function is_ajax()
 {
    $CI =& get_instance();
 	            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
 	return (
	 $CI->input->server('HTTP_X_REQUESTED_WITH')&&
	 ($CI->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
 }
}
if ( ! function_exists('valid_date')) {
	function valid_date($str)
	{
         $CI =& get_instance();
	            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $CI->form_validation->set_message('valid_date',
		 'date format is not valid. yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
}
if ( ! function_exists('strzero')) {
	function strzero($input,$len){
		return str_pad($input,$len, "0", STR_PAD_LEFT );
	}
}
if ( ! function_exists('pad')) {
    function pad($input,$len){
        return str_pad($input,$len, ".", STR_PAD_RIGHT );
    }
}

if(!function_exists('company_header')){
    function company_header(){
         $CI =& get_instance();
                
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
         $CI->load->model('company_model');
         $model=$CI->company_model->get_by_id($CI->access->cid)->row();
		 $data='';
		 if($model){
         	$data='<div id="divHeader"><h1>'.$model->company_name."</h1><h3>".$model->street
                 ."<br/>".$model->suite." ".$model->city_state_zip_code
                 ." - Phone: ".$model->phone_number.'</h3>
                     </div>';
         };
        return $data;
    }
}
if(!function_exists('getColoumn')){
function getColoumn($table) {
/*      $result = mysql_query("SHOW COLUMNS FROM ". $table);
      if (!$result) {
        echo 'Could not run query: ' . mysqli_error($link);
      }
      $fieldnames=array();
      if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
          $fieldnames[] = $row['Field'];
        }
      }
 */		$type=array();	$fieldnames=array();	$len=array(); $flag=array();
		if($fields=$CI->db->field_data("SHOW COLUMNS FROM ".$table)){
			foreach($fields as $fld){
				$fieldnames[]=$fld->name;
			}
		}

      return $fieldnames;
}
}

if(!function_exists('data_table_v2')){
function data_table_v2($table,$record=null,$is_sql=false){
    $CI =& get_instance();
	            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
	$data='';
    if($record){
		foreach ($record as $key => $value) {
			$data[$key]=$value;
		}
    } else {
		$result_id=0;
        if($is_sql){
			$q=$CI->db->query($table);
			if($q)$result_id=$q->result_id;
        } else {
//			$fields=getColoumn($table);
//			var_dump($fields);
			$q=$CI->db->get($table,1);
			echo mysqli_error($link);
			if($q)$result_id=$q->result_id;
        }
		if($result_id){	
			$count = mysql_num_fields($result_id);
			for($i=0;$i<=$count-1;$i++){
				$type=mysql_field_type($result_id, $i);
				$name=mysql_field_name($result_id, $i);
				$len=mysql_field_len($result_id, $i);
		//            $flags = mysql_field_flags($result, $i);
					switch ($type) {
						case 'datetime':
							$val=date('Y-m-d');
							break;
						case 'string':
							$val='';
							break;
						default:
							$val=0;
							break;
					}
				$data[$name]=$val;    
			}   
		}
    }
        
    return $data;
}

if(!function_exists('data_table')){
function data_table($table,$record=null,$is_sql=false){
	//CI3 using db->field_data 
	//ci2 using query mysql_num_fields
	if( substr(CI_VERSION,0,1)== '2' ) {
		return data_table_v2($table,$record,$is_sql);
	} else {
		$CI =& get_instance();
	            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
    	$data='';
		if($record){
			foreach ($record as $key => $value) {
				$data[$key]=$value;
			}
		} else {
			 
				if($fields=$CI->db->field_data($table)){
					foreach($fields as $fld){
						$type=$fld->type;
						$name=$fld->name;
						$len=$fld->max_length;
				//            $flags = mysql_field_flags($result, $i);
							switch ($type) {
								case 'datetime':
									$val=date('Y-m-d');
									break;
								case 'varchar':
								case 'string':
									$val='';
									break;
								default:
									$val=0;
									break;
							}
						$data[$name]=$val;
					}
				}
			} 
		}

		return $data;
}
}
if(!function_exists('data_table_post')){
function data_table_post($table,$is_sql=false){
	
	if( substr(CI_VERSION,0,1)== '2' ) {
		return data_table_post_v2($table,$is_sql);
	} else {
		$CI =& get_instance();
    	$fields=$CI->db->field_data($table);
		foreach($fields as $fld){
			$type=$fld->type;
			$name=$fld->name;
			$len=$fld->max_length;
	//            $flags = mysql_field_flags($result, $i);
				switch ($type) {
					case 'datetime':
						$val=date('Y-m-d');
						if(isset($_POST[$name])){
							$data[$name]=$CI->input->post($name);
						} else {
							$data[$name]=$val;
						}
						break;
					case 'varchar':
					case 'string':
						$val='';
						if(isset($_POST[$name])){
							$data[$name]=$CI->input->post($name);
						} else {
							$data[$name]='';
						}
						break;
					default:
						$val=0;
						if(isset($_POST[$name])){
							if($_POST[$name]!="") $val=$data[$name]=$CI->input->post($name);
						}
						$data[$name]=$val;
						break;
				}
		}
		return $data;
	}
}}


if(!function_exists('data_table_get')){
function data_table_get($table,$is_sql=false){
	if( substr(CI_VERSION,0,1)== '2' ) {
		return data_table_get_v2($table,$is_sql);
	} else {
		$CI =& get_instance();
    	$fields=$CI->db->field_data($table);
		foreach($fields as $fld){
			$type=$fld->type;
			$name=$fld->name;
			$len=$fld->max_length;
				switch ($type) {
					case 'datetime':
						$val=date('Y-m-d');
						if(isset($_GET[$name])){
							$data[$name]=$CI->input->post($name);
						} else {
							$data[$name]=$val;
						}
						break;
					case 'varchar':
					case 'string':
						$val='';
						if(isset($_GET[$name])){
							$data[$name]=$CI->input->post($name);
						} else {
							$data[$name]='';
						}
						break;
					default:
						$val=0;
						if(isset($_GET[$name])){
							$data[$name]= (int)$CI->input->post($name);
						} else {
							$data[$name]=$val;
						}
						break;
				}
		}
		return $data;
	}
}}


if(!function_exists('data_table_post_v2')){
function data_table_post_v2($table,$is_sql=false){
    $CI =& get_instance();
        if($is_sql){
            $result_id=$CI->db->query($table)->result_id;                
        } else {
            $result_id=$CI->db->get($table,1)->result_id;
        }
    
    $count = mysql_num_fields($result_id);
    for($i=0;$i<=$count-1;$i++){
        $type=mysql_field_type($result_id, $i);
        $name=mysql_field_name($result_id, $i);
        $len=mysql_field_len($result_id, $i);
//            $flags = mysql_field_flags($result, $i);
            switch ($type) {
                case 'datetime':
                    $val=date('Y-m-d');
                    if(isset($_POST[$name])){
                        $data[$name]=$CI->input->post($name);
                    } else {
                        $data[$name]=$val;
                    }
                    break;
                case 'string':
                    $val='';
                    if(isset($_POST[$name])){
                        $data[$name]=$CI->input->post($name);    
                    } else {
                        $data[$name]='';
                    }
                    break;
                default:
                    $val=0;
                    if(isset($_POST[$name])){
                    	if($_POST[$name]!="") $val=$data[$name]=$CI->input->post($name);
                    }
                    $data[$name]=$val;
                    break;
            }
    }   
    return $data;
}}

                
if(!function_exists('data_table_get_v2')){
function data_table_get_v2($table,$is_sql=false){
    $CI =& get_instance();
        if($is_sql){
            $result_id=$CI->db->query($table)->result_id;
                
        } else {
            $result_id=$CI->db->get($table,1)->result_id;
        }

    $count = mysql_num_fields($result_id);
    for($i=0;$i<=$count-1;$i++){
        $type=mysql_field_type($result_id, $i);
        $name=mysql_field_name($result_id, $i);
        $len=mysql_field_len($result_id, $i);
//            $flags = mysql_field_flags($result, $i);
            switch ($type) {
                case 'datetime':
                    $val=date('Y-m-d');
                    if(isset($_GET[$name])){
                        $data[$name]=$CI->input->post($name);
                    } else {
                        $data[$name]=$val;
                    }
                    break;
                case 'string':
                    $val='';
                    if(isset($_GET[$name])){
                        $data[$name]=$CI->input->post($name);    
                    } else {
                        $data[$name]='';
                    }
                    break;
                default:
                    $val=0;
                    if(isset($_GET[$name])){
                        $data[$name]= (int)$CI->input->post($name);    
                    } else {
                        $data[$name]=$val;
                    }
                    break;
            }
    }   
    return $data;
}}


if (!function_exists("load_view")){
    function load_view($viewName,$data = array()){

        $CI = & get_instance();
            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		if($viewName<>""){
			$content = $CI->load->view($viewName,$data,true);
			return $content;
		}
		
    }
}

if (!function_exists("criteria_text")){

	function criteria_text($faa) {
		$i=0;
		$s='';
		foreach($faa as $fa){
			$type="text";
			$val="";
			if($fa->field_class=="easyui-datetimebox"){
				$val=date("Y-m-d 00:00:00");
				if(strpos($fa->field_id,"date_to"))$val=date("Y-m-d 23:59:59");
				if($fa->field_value!="")$val=$fa->field_value;
				$s .= " ".$fa->caption.'
				<input type="'.$type.'" value="'.$val.'" id="'.$fa->field_id.'"  name="'.$fa->field_id.'"
				class="'.$fa->field_class.'" style="width:80px">';
				$s .= " ";
			} else if($fa->field_class=="checkbox"){
				if($fa->field_value!="")$val=$fa->field_value;
				$s .= "
				<input type='checkbox' value='$val' id='".$fa->field_id."'  name='".$fa->field_id."'
				> ".$fa->caption;
				$s .= " ";

			} else {
				if($fa->field_value!="")$val=$fa->field_value;
				$s .= " ".$fa->caption.'
				<input type="'.$type.'" value="'.$val.'" id="'.$fa->field_id.'"  name="'.$fa->field_id.'"
				class="'.$fa->field_class.'" style="width:80px">';
				$s .= " ";

			}

			$i++;
		}
		return $s;
	 }

}
if ( ! function_exists('allow_mod')) {
	function allow_mod($mod_id){
		$retval=false;
        $CI =& get_instance();
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
              // $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$uid=$CI->access->user_id();
        $sql="select distinct ugm.module_id from user_job uj
		join modules_groups mg on mg.user_group_id=uj.group_id
		join user_group_modules ugm on ugm.group_id=uj.group_id
		where uj.user_id='$uid' and ugm.module_id='$mod_id'";
        if($query=$CI->db->query($sql)){
			$retval=$query->num_rows();
		}
		return $retval;
	}
}
if ( ! function_exists('user_job_exist')) {
	function user_job_exist($job_id){
		$retval=false;
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$uid=$CI->access->user_id();
        $sql="select id from user_job where user_id='$uid' and group_id='$job_id'";
        if($query=$CI->db->query($sql)){
			$retval=$query->num_rows();
		}
		return $retval;
	}
}

if ( ! function_exists('allow_mod2')) {
	function allow_mod2($mod_id,$json_format=false){
		if(user_admin())return true;
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$uid=$CI->access->user_id();
        $sql="select distinct ugm.module_id from user_job uj
		join modules_groups mg on mg.user_group_id=uj.group_id
		join user_group_modules ugm on ugm.group_id=uj.group_id
		where uj.user_id='$uid' and ugm.module_id='$mod_id'";
        $query=$CI->db->query($sql);
		if($query->num_rows()){
			if($json_format){
				echo json_encode(array("success"=>false,"msg"=>"Not Found Row !"));
			} else {
				return true;
			}
		} else {
			if($json_format){
				echo json_encode(array("success"=>false,"msg"=>"Anda tidak diijinkan  !"))				;
			} else {
				echo "<span class='not_access alert alert-warning'>
				Anda tidak diijinkan menjalankan proses module ini.
				<br>Silahkan hubungi administrator.
				<br>Module Id: <strong>[$mod_id]</strong>
				</span>";
				return false;
			}
		}
	}
}
if ( ! function_exists('to_array')) {
	function to_array($data){
		$ret=null;
		foreach($data as $key=>$value){
			foreach($value as $key2=>$value2){
				$ret[$key2]=$value2;
			}
		}
		return $ret;
	}
}
if(!function_exists("inbox_send")){
	function inbox_send($from,$to,$subject,$message,$doc_no='',$doc_type=''){
        $CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
		$CI->load->model("maxon_inbox_model");
		if ( !is_array($to) ) {
			$data['rcp_from']=$from;
			$data['rcp_to']=$to;
			$data['subject']=$subject;
			$data['message']=$message;
			$data['msg_date']=date('Y-m-d H:i:s');
            $data['doc_no']=$doc_no;
            $data['doc_type']=$doc_type;
			return $CI->maxon_inbox_model->save($data);
		} else {
			for($i=0;$i<count($to);$i++)
			{
				$data['rcp_from']=$from;
				$data['rcp_to']=$to[$i]['user_id'];
				$data['subject']=$subject;
				$data['message']=$message;
				$data['msg_date']=date('Y-m-d H:i:s');
                $data['doc_no']=$doc_no;
                $data['doc_type']=$doc_type;
				return $CI->maxon_inbox_model->save($data);
			}

		}
	}

}
	if(!function_exists("col_number")){
		function col_number($fld,$dec=0){
			return "field:'$fld',width:80,align:'right',
					editor:'numberbox',
					formatter: function(value,row,index){
					return number_format(value,$dec,'.',',');}";
		}
	}
    if(!function_exists("sqlinto")){
        function sqlinto($sql){
            $CI =& get_instance();
            $ret=null;
            if($q=$CI->db->query($sql)){
                $ret=(array)$q->row();
            }
            return $ret;
        }
    }
	if(!function_exists("getvar")){
		function getvar($varname,$varvalue=null){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$CI->load->library("sysvar");
			$CI->load->model("company_model");
			$cid=$CI->access->cid;
			if($cid=="ALL" || $cid==""){
				$cid=$CI->db->select("company_code")->get("preferences")->row()->company_code;
			}
			$pref=$CI->company_model->get_by_id($cid)->row_array();
			if(isset($pref[$varname])){
				$retval=$pref[$varname];
			} else {
				$retval=$CI->sysvar->getvar($varname,$varvalue);
			}
			return $retval;
		}
	}
	if(!function_exists("putvar")){
		function putvar($varname,$varvalue){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
			$CI->load->library("sysvar");
			return $CI->sysvar->save($varname,$varvalue);
		}
	}
	if(!function_exists("website_activated")){
		function website_activated(){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
			$aktif=false;
			if($q=$CI->db->where("app_id","_20000")->get("maxon_apps")){
				if($row=$q->row()){
					$aktif=$row->is_active == "1";
				}
			}
			return $aktif;
		}
	}
	if(!function_exists("eshop_activated")){
		function eshop_activated(){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$aktif=false;
			if($q=$CI->db->where("app_id","eshop")->get("maxon_apps")){
				if($row=$q->row()){
					$aktif=$row->is_active == "1";
				}
			}
			return $aktif;
		}
	}
	if(!function_exists("html_table")){
		function html_table($sql,$with_body=false,$style=""){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$html="";
			if($with_body){
			$html="<html><head><style>
					body {font-family: Arial;}
					table {	border-collapse: collapse;}
					th {background-color: #cccccc;}
					th, td {border: 1px solid #000;}
				</style></head><body>";
			}
			$html.="<table class='$style'><thead>";
			if($query=$CI->db->query($sql)){
				$flds=$query->list_fields();
				$html .= '<tr>';
				for($i=0;$i<count($flds);$i++){
					$fld=$flds[$i];
					$fld=str_replace('_',' ',$fld);
					$fld=ucfirst($fld);
					$html .='<th>'.$fld.'</th>';
				}
				$html .= "</tr></thead><tbody>";
				foreach($query->result_array() as $row){
					$html .="<tr>";
					for($i=0;$i<count($row);$i++){
						$html.="<td>".$row[$flds[$i]]."</td>";
					}
				}
				$html.="</tbody></table>";
				if($with_body) $html.="</body></html>";
			}
			return $html;
		}
	}
	if(!function_exists("breadcrumb")){
		function breadcrumb($arData){
 			$ret="<ol class='breadcrumb box-bcum'>";
			for($i=0;$i<count($arData);$i++) {
				if($i==0) {
					$ret.=" <li><a class='glyphicon glyphicon-home'
					  href='".$arData[$i][1]."'> Home</a></li>";
				} else {
					$ret.=" <li class='".$arData[$i][1]==""?"":"active"."'>
					<a href='".$arData[$i][1]."'> ".$arData[$i][0]."</a></li>";
				}
			}
			$ret.="</ol>";
			return $ret;
		}
	}
	if(!function_exists("add_log_ip_address")){
		function add_log_ip_address(){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$s="INSERT INTO maxon_log_ip (period, ip_address)
			SELECT * FROM (SELECT CURDATE()+0, '".$ip."') AS tmp
			WHERE NOT EXISTS (
				SELECT ip_address FROM maxon_log_ip
				WHERE period = CURDATE()+0 AND ip_address='".$ip."'
			) LIMIT 1;";
			$CI->db->query($s);
		}
	}
	if ( !function_exists('my_date_diff') ) {
		function my_date_diff($dFromDate,$dEndDate=null) {
			if( $dEndDate==null ) $dEndDate=date("Y-m-d",time());

			$dStart = new DateTime($dFromDate);
			$dEnd  = new DateTime($dEndDate);

			//echo "dStart=".$dFromDate;
			//echo "dEnd=".$dEndDate;
			$dDiff = $dStart->diff($dEnd);
			//$dDiff->format('%R');
			//var_dump($dDiff);
//			echo $dDiff->days;
			return ($dDiff->m*30)+$dDiff->d;
		}
	}
	if ( !function_exists('is_num_format') ) {
	function is_num_format($fld_name,$fld_fmt){
		for($i=0;$i<count($fld_fmt);$i++){
			if($fld_name==$fld_fmt[$i]){
				return true;
			}
		}
	}
	if ( !function_exists('add_field') ) {
		function add_field($table,$field,$type='varchar',$size='50'){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
			$CI->load->dbforge();
			$field_info=array(
				$field=>array('type'=>$type.'('.$size.')','size'=>$size,'caption'=>$field,'control'=>'text')
			);
			if($q=$CI->db->query("SHOW COLUMNS FROM $table LIKE '$field'")){
				if(!$q->row()){
					$CI->dbforge->add_column($table,$field_info);
				}
			}
		}
	}
	if ( !function_exists('save_data_table') ) {
		function save_data_table($table,$data,$id='',$field_key=''){
			$CI =& get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$retval=false;
			if($id==""){
				$retval=$CI->db->insert($table,$data);
			} else {
				$retval=$CI->db->where($field_key,$id)->update($table,$data);
			}
		}
	}
	if (!function_exists('exist_unit')){
		function exist_unit($unit){
			$CI=&get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$retval=null;
			if($unit!="")
			{
				if($q=$CI->db->where("to_unit",$unit)
					->get("unit_of_measure"))
				{
					if($row=$q->row())
					{
						$retval['from_unit']=$row->from_unit;
						$retval['to_unit']=$row->to_unit;
						$retval['unit_value']=$row->unit_value;
					}				
					
				}
			}
			return $retval;
		}
	}
	if (!function_exists('item_sales_price')){
		function item_sales_price($item_number){
			$CI=&get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$retval=0;
			if($item_number!="")
			{
				if($r=$CI->db->select("retail")
				->where("item_number",$item_number)
				->get('inventory')->row()){
					$retval=$r->retail;
				}
			}
			return $retval;
		}
	}
	if (!function_exists('item_purchase_price')){
		function item_purchase_price($item_number){
			$CI=&get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$retval=0;
			if($item_number!="")
			{
				if($r=$CI->db->select("cost_from_mfg")
				->where("item_number",$item_number)
					->get('inventory')){
					$result=$r->row()->cost_from_mfg;
				}
			}
			return $retval;
		}
	}
	if (!function_exists('item_cost')){
		function item_cost($item_number){
			$CI=&get_instance();
		            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
        	$retval=0;
			if($item_number!="")
			{
				if($row=$retval=$CI->db->select("cost")
				->where("item_number",$item_number)
				->get('inventory')->row()){
					$retval=$row->cost;
				}
			}
			return $retval;
		}
	}
	if (!function_exists('sql_in')){
		function sql_in($data){
			$retval="(";
			$a="";
			for($i=0;$i<count($data);$i++)$a.="'".$data[$i]."',";
			if(substr($a,-1,1)==",")$a=substr($a,0,strlen($a)-1);
			$retval.=$a.")";
			return $retval;
		}
	}
	if(!function_exists('kode_tahun')){
	    function kode_tahun(){
	        $y=date('y');
            //echo "<br>kode_tahun: $y";
            if($y==17)return "0";
            if($y==18)return "1";
            if($y==19)return "2";
            if($y==20)return "3";
            if($y==21)return "4";
            if($y==22)return "5";
            if($y==23)return "6";
            if($y==24)return "7";
            if($y==25)return "8";
            if($y==26)return "9";
            if($y==27)return "A";
            if($y==28)return "B";
            if($y==29)return "C";
            if($y==30)return "D";
            if($y==31)return "E";
            if($y==32)return "F";
	    }
	}
    if(!function_exists('kode_bulan')){
        function kode_bulan(){
            $y=date('m');
            //echo "<br>kode_bulan: $y";
            if($y==1)return "1";
            if($y==2)return "2";
            if($y==3)return "3";
            if($y==4)return "4";
            if($y==5)return "5";
            if($y==6)return "6";
            if($y==7)return "7";
            if($y==8)return "8";
            if($y==9)return "9";
            if($y==10)return "A";
            if($y==11)return "B";
            if($y==12)return "C";
        }
    }

}
if(!function_exists('grid_fields')){
    function grid_fields($table,$sfield){
        $CI =& get_instance();
        $sfield=str_replace(" ","",$sfield);
        $afields=explode(",",$sfield);
        $s='';
        $fields=$CI->db->field_data($table);
        for($i=0;$i<count($afields);$i++){
            $exist=false;
            foreach($fields as $fld){
                $type=$fld->type;
                $name=$fld->name;
                $len=$fld->max_length;
                if($afields[$i]==$name){
                    switch ($type) {
                        case 'datetime':
                        case 'varchar':
                        case 'string':
                            $s.="<th data-options=\"field:'$name',width:'$len' \">".ucfirst($name)."</th>";
                            break;
                        default:
                            $s.="<th data-options=\"field:'$name',width:'$len', 
                                align:'right',editor: 'numberbox',
                                options:{precision:2},
                                formatter: function(value,row,index){
                                    if(isNumber(value)){
                                        return number_format(value,2,'.',',');
                                        return value;
                                    } else {
                                        return value;
                                    }
                                  }
                                 \">".ucfirst($name)."</th>";
                            break;
                    }
                    $exist=true;
                    break;
                }    
            }
        }
        return $s;
    }
}

if(!function_exists('konversi')){
function konversi($x){
  
  $x = abs($x);
  $angka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  
  if($x < 12){
   $temp = " ".$angka[$x];
  }else if($x<20){
   $temp = konversi($x - 10)." belas";
  }else if ($x<100){
   $temp = konversi($x/10)." puluh". konversi($x%10);
  }else if($x<200){
   $temp = " seratus".konversi($x-100);
  }else if($x<1000){
   $temp = konversi($x/100)." ratus".konversi($x%100);   
  }else if($x<2000){
   $temp = " seribu".konversi($x-1000);
  }else if($x<1000000){
   $temp = konversi($x/1000)." ribu".konversi($x%1000);   
  }else if($x<1000000000){
   $temp = konversi($x/1000000)." juta".konversi($x%1000000);
  }else if($x<1000000000000){
   $temp = konversi($x/1000000000)." milyar".konversi($x%1000000000);
  }
  
  return $temp;
 }
 }  
if(!function_exists('tkoma')){
 function tkoma($x){
  $str = stristr($x,".");
  $ex = explode(',',$x);
  $a="";
  
  if(count($ex)>1){
      if(($ex[1]/10) >= 1){
       $a = abs($ex[1]);
      }
  }
  $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
  $temp = "";
  $a2="";
  if(count($ex)>1){
    $a2 = $ex[1]/10;
  }
  $pjg = strlen($str);
  $i =1;
    
  
  if($a>=1 && $a< 12){   
   $temp .= " ".$string[$a];
  }else if($a>12 && $a < 20){   
   $temp .= konversi($a - 10)." belas";
  }else if ($a>20 && $a<100){   
   $temp .= konversi($a / 10)." puluh". konversi($a % 10);
  }else{
   if($a2<1){
    
    while ($i<$pjg){     
     $char = substr($str,$i,1);     
     $i++;
     $temp .= " ".$string[$char];
    }
   }
  }  
  return $temp;
 }
 } 
if(!function_exists('terbilang')){
     function terbilang($x){
          if($x<0){
               $hasil = "minus ".trim(konversi(x));
          }else{
               $poin = trim(tkoma($x));
               $hasil = trim(konversi($x));
          }
          
        if($poin){
                $hasil = $hasil." koma ".$poin;
          }else{
             $hasil = $hasil;
          }
          return $hasil;  
     }
}
if(!function_exists('msgbox')){
     function msgbox($text,$title="Information",$auto_close=false){
        $s= "<div class='alert alert-info'>$text</div>";
        if($auto_close)$s.="<script>remove_tab_parent();</script>";
        $CI =& get_instance();
        $data['content']=$s;
        $data['message']=$title;
        $CI->template->display("blank",$data);
        
     }
}
if(!function_exists('item_need_update')){
     function item_need_update($item_no){
        $CI =& get_instance();
        $item_no=urldecode($item_no);
        if($item_no!="") {
            if($q=$CI->db->where("item_no",$item_no)->get("zzz_item_need_update")){
                if($q->num_rows()==0){
                    $CI->db->insert("zzz_item_need_update",array("item_no"=>$item_no));
                }
            }
        }
     }
}

if(!function_exists("session_company_code")){
    function session_company_code(){
        $CI =& get_instance();
        return $CI->session->userdata("session_company_code","");
    }
}
if(!function_exists("session_outlet")){
    function session_outlet(){
        $CI =& get_instance();
        return $CI->session->userdata("session_outlet","");
    }
}
if(!function_exists("date_diff2")){
    function date_diff2($date1,$date2){
        $first  = new DateTime( $date1 );
        $second = new DateTime( $date2 );

        $diff = $first->diff( $second );

        return $diff->format( '%d' ); // -> 00:25:25
        
    }
}


}
?>
