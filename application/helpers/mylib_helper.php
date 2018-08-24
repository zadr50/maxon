<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");


	if ( ! function_exists('set_show_columns')) {
    function set_show_columns($key,$data){
	        $CI =& get_instance();
			$show_cols=$CI->session->userdata("cols_".$key,null);
			
			if($ck_reset=$CI->input->get("ck_reset")){
				$CI->session->unset_userdata("cols_".$key);
				$show_cols=null;
				echo json_encode(array("success"=>true,"msg"=>"Success"));
				return false;
				
			} else{			
				if($ck_cols=$CI->input->get("ck_cols")){
					$show_cols=$ck_cols;
					$CI->session->set_userdata("cols_".$key,$ck_cols);
					echo json_encode(array("success"=>true,"msg"=>"Success"));
					return false;
				}
				
			}
						
			if($show_cols){
				$data_tmp=null;
				$data_tmp_caption=null;
				$flds=$data['fields'];
				$fldscap=$data['fields_caption'];
				for($icols=0;$icols<count($show_cols);$icols++){
					$fld=$show_cols[$icols];
					for($iflds=0;$iflds<count($flds);$iflds++){
						if($fld==$flds[$iflds]){
							$data_tmp[$icols]=$fld;
							$data_tmp_caption[$icols]=$fldscap[$iflds];
							break;
						}
					}
				}
				if($data_tmp){
					$data['fields']=$data_tmp;
					$data['fields_caption']=$data_tmp_caption;
				}
			}
			return $data;		
		}
	}

if ( ! function_exists('app_active')) {
    function app_active($Vsu4bmcg5nqv){
        $Vnpr0xe0jkmu =& get_instance();
        $Vbnoleywpry2=false;
        $Vn3aoffkjo5h=$Vnpr0xe0jkmu->db->select("is_active")->where("app_id",$Vsu4bmcg5nqv)->get("maxon_apps");
        if($V2i4525nidrh=$Vn3aoffkjo5h->row()){
            $Vbnoleywpry2=$V2i4525nidrh->is_active==1?true:false;
        }
        return $Vbnoleywpry2;
    }
}

if(!function_exists('c_')){
    function c_($Vhwsbz520bqc){
        return str_replace(',','',$Vhwsbz520bqc);
    }
}

if(!function_exists("menu")){
function menu($Vwl05d2zvcw2,$Vnkbdrgv0cj1,$Vptcygd5bjzq=false){
		if(!$Vptcygd5bjzq){
			echo "<div><a href='".base_url()."index.php/".$Vnkbdrgv0cj1."' class='easyui-linkbutton' data-options='plain:true'>".$Vwl05d2zvcw2."</a></div>";	
		} else {
			echo "<div><a href='#' onclick=\"load_menu('$Vnkbdrgv0cj1')\"  class='easyui-linkbutton' data-options='plain:true'>".$Vwl05d2zvcw2."</a></div>";
		}
	}
}
if(!function_exists("add_menu_drop")){
	function add_menu_drop($Vb05r3xmnxrh,$Vyfsyvpoqvi0,$V50zhcrdvbej) {
		if(allow_mod($V50zhcrdvbej)){
			echo "<li><a onclick=load_menu('$Vb05r3xmnxrh') href='#'>$Vyfsyvpoqvi0</a></li>";
		}
	}
}
if(!function_exists("add_menu_drop_2")){
	function add_menu_drop_2($Vb05r3xmnxrh,$Vyfsyvpoqvi0,$V50zhcrdvbej) {
		if(allow_mod($V50zhcrdvbej)){
			echo "<li><a href='".base_url()."index.php/$Vb05r3xmnxrh'
			class='info_link' >$Vyfsyvpoqvi0</a></li>";
		}
	}
	
}
if(!function_exists("load_picture")){
	function load_picture($Vnyvzcl1a2q5=''){
		if($Vnyvzcl1a2q5=='') return base_url()."images/no-images.png";
		$V15dbrpajeab=FCPATH . "tmp/".$Vnyvzcl1a2q5;
		if(file_exists($V15dbrpajeab)){
			return base_url()."tmp/".$Vnyvzcl1a2q5;
		} else {
			return base_url()."images/no-images.png";
		}
	}
}
if(!function_exists("my_input_date")){
	function my_input_date($Vyfsyvpoqvi0,$V15dbrpajeabield_name,$V15dbrpajeabield_value,$Vuhvbhltib2h="",$Vvw3402cj5ls=""){
		echo "<div class='form-group'>
		<label class='control-label ".$Vuhvbhltib2h."' for='".$V15dbrpajeabield_name."'>".$Vyfsyvpoqvi0."</label>
		<div class='".$Vvw3402cj5ls."'>".form_input($V15dbrpajeabield_name,$V15dbrpajeabield_value,
		"id='".$V15dbrpajeabield_name."' class='form-control input-sm easyui-datetimebox' 
		data-options='formatter:format_date,parser:parse_date'
		style='width:200px'
		")."</div></div>";
	}
}
if(!function_exists("form_input_date")){
	function form_input_date($V15dbrpajeabield_name,$V15dbrpajeabield_value,$Vuhvbhltib2h="",$Vvw3402cj5ls=""){
		echo form_input($V15dbrpajeabield_name,$V15dbrpajeabield_value,
		"id='".$V15dbrpajeabield_name."' class='easyui-datetimebox' 
		data-options='formatter:format_date,parser:parse_date'
		");
	}
}
if(!function_exists("my_button")){
	function my_button($Vyfsyvpoqvi0,$Vptcygd5bjzq,$Vzdk5vpgmbjh,$Vdtdzduxx0b5){
		echo "<a href='#' onclick='$Vptcygd5bjzq'
		class='btn btn-primary glyphicon glyphicon-$Vzdk5vpgmbjh'
		title='$Vdtdzduxx0b5'>$Vyfsyvpoqvi0</a>";
	}
}
if(!function_exists("my_button_submit")){
	function my_button_submit($Vyfsyvpoqvi0='Submit'){
		echo "<input type='submit' value='$Vyfsyvpoqvi0' name='submit' name='submit' 
		class='btn btn-primary'>";
	}
}

if(!function_exists("my_input_2")){
	function my_input_2($Vpyytnrwhwf3,$V15dbrpajeabield_name='',$V15dbrpajeabield_value=''){
	   my_input($Vpyytnrwhwf3,$V15dbrpajeabield_name,$V15dbrpajeabield_value,"x","x");
		
	}
}
if(!function_exists("my_input3")){
    function my_input3($V3ku5mlhrixi){
        $Vmrazjfdzmoy=(object)$V3ku5mlhrixi;
        if(!isset($Vmrazjfdzmoy->extra))$Vmrazjfdzmoy->extra="";
        if(!isset($Vmrazjfdzmoy->value))$Vmrazjfdzmoy->value="";
        $V02o1un3iowo=$Vmrazjfdzmoy->field;
        if(isset($Vmrazjfdzmoy->id))$V02o1un3iowo=$Vmrazjfdzmoy->id;
        $Vfa0ao3qzwif=form_input($Vmrazjfdzmoy->field,$Vmrazjfdzmoy->value,"id='$V02o1un3iowo' $Vmrazjfdzmoy->extra");
        if(isset($Vmrazjfdzmoy->button))$Vfa0ao3qzwif.=link_button('',$Vmrazjfdzmoy->func,"search");
        if(isset($Vmrazjfdzmoy->button_add))$Vfa0ao3qzwif.=link_button('',$Vmrazjfdzmoy->func_add,"add");
        return $Vfa0ao3qzwif;
    }
}

if(!function_exists("my_input")){
	function my_input($Vpyytnrwhwf3,$V15dbrpajeabield_name='',$V15dbrpajeabield_value='',$Vyfsyvpoqvi0_class="",$Vtuoz1tgdkjb="",$Vfa0ao3qzwiftyle=""){
		$Vyfsyvpoqvi0=$Vpyytnrwhwf3;
		$Vfa0ao3qzwifub_caption="";
		$Vhtvpgztfiyp="";
		$Vtuoz1tgdkjb_field='';
		$V3ku5mlhrixi=""; $Vfa0ao3qzwifhow_button="";
		$Viuwkmsl0bs3="";
		if(is_array($Vpyytnrwhwf3)){
			foreach($Vpyytnrwhwf3 as $Vm0pnfecgctz=>$Vhwsbz520bqc)
			{
				if ( $Vm0pnfecgctz == "caption" ) $Vyfsyvpoqvi0=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "sub_caption" ) $Vfa0ao3qzwifub_caption=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "field_name" ) $V15dbrpajeabield_name=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "value" ) $V15dbrpajeabield_value=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "caption_class" ) $Vyfsyvpoqvi0_class=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "text_class" ) $Vtuoz1tgdkjb=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "style" ) $Vfa0ao3qzwiftyle=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "align" ) $Vhtvpgztfiyp=' align="'.$Vhwsbz520bqc.'" ';
				if ( $Vm0pnfecgctz == "text_class_field" ) $Vtuoz1tgdkjb_field=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "param" ) $V3ku5mlhrixi=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "show_button" ) $Vfa0ao3qzwifhow_button=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "clear_line" ) $Viuwkmsl0bs3=$Vhwsbz520bqc;
			}
		}
		if($Vyfsyvpoqvi0_class=="")$Vyfsyvpoqvi0_class="col-xs-3";
		if($Vtuoz1tgdkjb=="")$Vtuoz1tgdkjb="col-xs-4";
		echo "<div class='form-group'>
		<label $Vhtvpgztfiyp class='control-label $Vyfsyvpoqvi0_class ' for='$V15dbrpajeabield_name'>$Vyfsyvpoqvi0</label>
		<div class='$Vtuoz1tgdkjb'>"
		.form_input($V15dbrpajeabield_name,$V15dbrpajeabield_value,
		"$V3ku5mlhrixi id='$V15dbrpajeabield_name' class='form-control input-sm  $Vtuoz1tgdkjb_field ' $Vfa0ao3qzwiftyle")
		."";
		if ($Viuwkmsl0bs3!="") echo "<div class='clear'>";
		if ($Vfa0ao3qzwifub_caption!="") echo "<i>$Vfa0ao3qzwifub_caption</i>";
		if ($Viuwkmsl0bs3!="") echo "</div>";
		echo "</div>";
		if ($Vfa0ao3qzwifhow_button!="") echo $Vfa0ao3qzwifhow_button;
		echo "</div>";
	}
}
if(!function_exists("my_hidden")){
	function my_hidden($Vpyytnrwhwf3,$V15dbrpajeabield_name='',$V15dbrpajeabield_value='',$Vyfsyvpoqvi0_class="",$Vtuoz1tgdkjb="",$Vfa0ao3qzwiftyle=""){
		$Vyfsyvpoqvi0=$Vpyytnrwhwf3;
		if(is_array($Vpyytnrwhwf3)){
			foreach($Vpyytnrwhwf3 as $Vm0pnfecgctz=>$Vhwsbz520bqc)
			{
				if ( $Vm0pnfecgctz == "field_name" ) $V15dbrpajeabield_name=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "value" ) $V15dbrpajeabield_value=$Vhwsbz520bqc;
			}
		}
		echo form_hidden($V15dbrpajeabield_name,$V15dbrpajeabield_value,"id='$V15dbrpajeabield_name'");
	}
}

if(!function_exists("my_textarea")){
	function my_textarea($Vpyytnrwhwf3,$V15dbrpajeabield_name='',$V15dbrpajeabield_value='',$Vyfsyvpoqvi0_class="",$Vtuoz1tgdkjb="",$Vfa0ao3qzwiftyle=""){
		$Vyfsyvpoqvi0=$Vpyytnrwhwf3;
		$Vfa0ao3qzwifub_caption="";
		$Vhtvpgztfiyp="";
		$Vtuoz1tgdkjb_field='';
		if(is_array($Vpyytnrwhwf3)){
			foreach($Vpyytnrwhwf3 as $Vm0pnfecgctz=>$Vhwsbz520bqc)
			{
				if ( $Vm0pnfecgctz == "caption" ) $Vyfsyvpoqvi0=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "sub_caption" ) $Vfa0ao3qzwifub_caption=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "field_name" ) $V15dbrpajeabield_name=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "value" ) $V15dbrpajeabield_value=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "caption_class" ) $Vyfsyvpoqvi0_class=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "text_class" ) $Vtuoz1tgdkjb=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "style" ) $Vfa0ao3qzwiftyle=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "align" ) $Vhtvpgztfiyp=' align="'.$Vhwsbz520bqc.'" ';
				if ( $Vm0pnfecgctz == "text_class_field" ) $Vtuoz1tgdkjb_field=$Vhwsbz520bqc;
			}
		}
		echo "<div class='form-group ' >
		<label  $Vhtvpgztfiyp class='control-label $Vyfsyvpoqvi0_class' for='$V15dbrpajeabield_name'>$Vyfsyvpoqvi0</label>
			<div class='$Vtuoz1tgdkjb'>"
			.form_textarea($V15dbrpajeabield_name,$V15dbrpajeabield_value,
			"id='$V15dbrpajeabield_name' class='form-control input-sm $Vtuoz1tgdkjb_field ' $Vfa0ao3qzwiftyle ")
			."</div>
		</div>";
	}
}

if(!function_exists("my_input_file")){
	function my_input_file($Vpyytnrwhwf3,$V15dbrpajeabield_name='',$V15dbrpajeabield_value='',$Vyfsyvpoqvi0_class="",$Vtuoz1tgdkjb="",$Vfa0ao3qzwiftyle=""){
		$Vyfsyvpoqvi0=$Vpyytnrwhwf3;
		$Vfa0ao3qzwifub_caption="";
		$Vhtvpgztfiyp="";
		$Vtuoz1tgdkjb_field='';
		$V5hxss51qpx5=false;
		$Vmzmrfyi2srq='';
		$Vfa0ao3qzwifhow_images=false;
		$Vmrfp5yojgbx='';
		if(is_array($Vpyytnrwhwf3)){
			foreach($Vpyytnrwhwf3 as $Vm0pnfecgctz=>$Vhwsbz520bqc)
			{
				if ( $Vm0pnfecgctz == "caption" ) $Vyfsyvpoqvi0=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "sub_caption" ) $Vfa0ao3qzwifub_caption=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "field_name" ) $V15dbrpajeabield_name=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "value" ) $V15dbrpajeabield_value=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "caption_class" ) $Vyfsyvpoqvi0_class=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "text_class" ) $Vtuoz1tgdkjb=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "style" ) $Vfa0ao3qzwiftyle=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "align" ) $Vhtvpgztfiyp=' align="'.$Vhwsbz520bqc.'" ';
				if ( $Vm0pnfecgctz == "text_class_field" ) $Vtuoz1tgdkjb_field=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "add_text_field" ) $V5hxss51qpx5=$Vhwsbz520bqc;
				if ( $Vm0pnfecgctz == "show_images" ) $Vfa0ao3qzwifhow_images=$Vhwsbz520bqc;
			}
		}
		if($V5hxss51qpx5) {
			$Vmzmrfyi2srq="<input type='text' name='$V15dbrpajeabield_name' id='$V15dbrpajeabield_name'
					value='$V15dbrpajeabield_value'  class='form-control input-sm  $Vtuoz1tgdkjb_field ' $Vfa0ao3qzwiftyle/>";
		}
		if($Vfa0ao3qzwifhow_images) {
			$Vmrfp5yojgbx="<div class='thumbnail '>
				<img src='".base_url()."images/$V15dbrpajeabield_value'>
			</div>";
		}
		echo "<div class='form-group'>
			<label class='control-label $Vyfsyvpoqvi0_class' for='$V15dbrpajeabield_name'>$Vyfsyvpoqvi0</label>
			<div class='$Vtuoz1tgdkjb'>
				<input type='file' name='img_$V15dbrpajeabield_name' id='img_$V15dbrpajeabield_name' title='Select'/>
				$Vmzmrfyi2srq
				$Vmrfp5yojgbx
			</div>
		</div>";
	}
}
if(!function_exists("my_input_tr")){
	function my_input_tr($Vyfsyvpoqvi0,$V15dbrpajeabield_name,$V15dbrpajeabield_value='',$Vpgxedlkcze2=''){
		$Vgln3nzd1pum="<tr><td>".$Vyfsyvpoqvi0."</td><td>
		<input type='text' name='".$V15dbrpajeabield_name."' id='".$V15dbrpajeabield_name."' value='$V15dbrpajeabield_value'>";
		if($Vpgxedlkcze2!="") $Vgln3nzd1pum .= $Vpgxedlkcze2;
		$Vgln3nzd1pum .= "</td></tr>";
		echo $Vgln3nzd1pum;
	}
}
if(!function_exists("my_input_td")){
    function my_input_td($Vyfsyvpoqvi0,$V15dbrpajeabield_name,$V15dbrpajeabield_value='',$Vpgxedlkcze2=''){
        $Vgln3nzd1pum="<td>".$Vyfsyvpoqvi0."</td><td>
        <input type='text' name='".$V15dbrpajeabield_name."' id='".$V15dbrpajeabield_name."' value='$V15dbrpajeabield_value'>";
        if($Vpgxedlkcze2!="") $Vgln3nzd1pum .= $Vpgxedlkcze2;
        $Vgln3nzd1pum .= "</td>";
        echo $Vgln3nzd1pum;
    }
}

if(!function_exists("my_input_date_tr")){
	function my_input_date_tr($Vyfsyvpoqvi0,$V15dbrpajeabield_name,$V15dbrpajeabield_value='',$Vpgxedlkcze2=''){
		$Vgln3nzd1pum="<tr><td>".$Vyfsyvpoqvi0."</td><td>
		<input type='text' name='".$V15dbrpajeabield_name."' id='".$V15dbrpajeabield_name."' value='$V15dbrpajeabield_value' 
		class='easyui-datetimebox' 
		data-options='formatter:format_date,parser:parse_date'
		>";
		if($Vpgxedlkcze2!="") $Vgln3nzd1pum .= $Vpgxedlkcze2;
		$Vgln3nzd1pum .= "</td></tr>";
		echo $Vgln3nzd1pum;
	}
}
if(!function_exists("my_input_date_td")){
    function my_input_date_td($Vyfsyvpoqvi0,$V15dbrpajeabield_name,$V15dbrpajeabield_value='',$Vpgxedlkcze2=''){
        $Vgln3nzd1pum="<td>".$Vyfsyvpoqvi0."</td><td>
        <input type='text' name='".$V15dbrpajeabield_name."' id='".$V15dbrpajeabield_name."' value='$V15dbrpajeabield_value' 
        class='easyui-datetimebox' 
        data-options='formatter:format_date,parser:parse_date'
        >";
        if($Vpgxedlkcze2!="") $Vgln3nzd1pum .= $Vpgxedlkcze2;
        $Vgln3nzd1pum .= "</tdxxxxxxxxxxxxxxxxxxxxxxxxxxx>";
        echo $Vgln3nzd1pum;
    }
}

		
if(!function_exists("my_dropdown")){
	function my_dropdown($Vyfsyvpoqvi0,$V15dbrpajeabield_name,$V15dbrpajeabield_value,$Vo4jreid3ahw,$Vuhvbhltib2h="",$Vvw3402cj5ls=""){
		echo "<div class='form-group'>
		<label class='control-label ".$Vuhvbhltib2h."' for='".$V15dbrpajeabield_name."'>".$Vyfsyvpoqvi0."</label>
		<div class='".$Vvw3402cj5ls."'>".form_dropdown($V15dbrpajeabield_name,$Vo4jreid3ahw,$V15dbrpajeabield_value,
		"id='".$V15dbrpajeabield_name."' class='form-control'")."</div></div>";
	}
}
if(!function_exists("array_data_table")){
	function array_data_table($V4t0nvjolfqr,$V15dbrpajeabield_key,$V15dbrpajeabield_val,$Vmsas2mchsb3=""){
        $Vnpr0xe0jkmu =& get_instance();
		            
		$Vpyytnrwhwf32=$Vnpr0xe0jkmu->db->select("$V15dbrpajeabield_key,$V15dbrpajeabield_val")->get("$V4t0nvjolfqr")->result_array();
		$Vpyytnrwhwf3[]=array($V15dbrpajeabield_key=>"",$V15dbrpajeabield_val=>"--Select--");
		$Vpyytnrwhwf3=array_merge($Vpyytnrwhwf3,$Vpyytnrwhwf32);
		$Vznlqv1txnwq=null;for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($Vpyytnrwhwf3);$Vu0pjn5k3qbk++){$Vznlqv1txnwq[$Vpyytnrwhwf3[$Vu0pjn5k3qbk][$V15dbrpajeabield_key]]=$Vpyytnrwhwf3[$Vu0pjn5k3qbk][$V15dbrpajeabield_val];}
		return $Vznlqv1txnwq;
	}
}
if(!function_exists("my_checkbox")){
	function my_checkbox($Vyfsyvpoqvi0,$V15dbrpajeabield_name,$V15dbrpajeabield_value,$Vo4jreid3ahw,$Vuhvbhltib2h="col-sm-4",$Vvw3402cj5ls="col-sm-2"){
		if(is_array($Vo4jreid3ahw)){
		echo "<div class='form-group' >
		<label class='control-label ".$Vuhvbhltib2h."' for='".$V15dbrpajeabield_name."'>".$Vyfsyvpoqvi0."</label>
		<div class='col-md-6'>";
		$V15dbrpajeabield_value_array=explode(",",$V15dbrpajeabield_value);
		foreach( $Vo4jreid3ahw as $Vm0pnfecgctz => $Vhwsbz520bqc ) {
			$V15dbrpajeabound=false;
			if(is_array($V15dbrpajeabield_value_array)){
				for($Voocn2l14sua=0;$Voocn2l14sua<count($V15dbrpajeabield_value_array);$Voocn2l14sua++) {
					if($V15dbrpajeabield_value_array[$Voocn2l14sua]==$Vhwsbz520bqc){
						$V15dbrpajeabound=true;
					}
				}
				$V5yekxe4oy02=$V15dbrpajeabound;
			} else {
				$V5yekxe4oy02=$V15dbrpajeabield_value==$Vhwsbz520bqc?true:false;
			}
			echo "<label class='control-label col-md-4'>";
			echo form_checkbox($V15dbrpajeabield_name.'[]', $Vm0pnfecgctz, $V5yekxe4oy02,
				"id='".$V15dbrpajeabield_name."' class='checkbox'").' '.$Vhwsbz520bqc.' ';
			echo "</label>";
		}
		echo "</div>
		</div>
		<div class='clearfix'></div>";
		} else {
			$V5yekxe4oy02=$V15dbrpajeabield_value=="1"?true:false;
			echo "<div class='form-group'>
			<label class='control-label ".$Vuhvbhltib2h."' for='".$V15dbrpajeabield_name."'>".$Vyfsyvpoqvi0."</label>
			<div class='".$Vvw3402cj5ls."'>".form_checkbox($V15dbrpajeabield_name,$V15dbrpajeabield_value,$V5yekxe4oy02,
			"id='".$V15dbrpajeabield_name."' class='form-control input-sm'")."</div></div>";	

		}
	}
}
if(!function_exists("render_form")) {
	function render_form($V15dbrpajeaborm) {
	$Vpyytnrwhwf3[]=null;
	foreach($V15dbrpajeaborm as $V15dbrpajeabrm)
	{
		$Vpyytnrwhwf3=array_merge($Vpyytnrwhwf3,$V15dbrpajeabrm['data']);
		switch($V15dbrpajeabrm['input_type'])
		{
			case "dropdown":
				break;
			case "datetime":
				break;
			case "textarea":
				my_textarea($Vpyytnrwhwf3);
				break;
			case "file":
				my_input_file($Vpyytnrwhwf3);
				break;
			case "hidden":
				my_hidden($Vpyytnrwhwf3);
				break;
			default:
				my_input($Vpyytnrwhwf3);
				break;
		}
	}
	}
}
if(!function_exists("add_button_menu")){
	function add_button_menu($Vyfsyvpoqvi0,$Vpckg22z3gi4,$Vu0pjn5k3qbkco,$Vcoivezkelba,$Vqlidxeiorll=""){
	$Vr24ddw5fsns="href='".base_url()."index.php/$Vpckg22z3gi4'";
	if($Vqlidxeiorll<>"") $Vr24ddw5fsns=" onclick='$Vqlidxeiorll'";
	echo "<div class='col-lg-3 col-md-4 col-sm-12 info thumbnail info_link box-gradient' $Vr24ddw5fsns>
				<div class='photo'><img src='".base_url()."images/$Vu0pjn5k3qbkco'/></div>
				<div class='detail'><h4>$Vyfsyvpoqvi0</h4></br>$Vcoivezkelba</div>
		</div>";
	}
}
if(!function_exists("format_sql_date")){
	function format_sql_date($Vhwsbz520bqc){
		return  date('Y-m-d H:i:s', strtotime($Vhwsbz520bqc));
	}
}
if(!function_exists("dropdown_data")){
	function dropdown_data($V4t0nvjolfqr,$V15dbrpajeabield_key="",$V15dbrpajeabield_value="",$Vwtvrjk3xhc2=""){
        $Vnpr0xe0jkmu =& get_instance();
		$Vywv2o3maeva['']='- Select -';
		$Vfa0ao3qzwifql="select $V15dbrpajeabield_key,$V15dbrpajeabield_value from $V4t0nvjolfqr";
		if($Vwtvrjk3xhc2!="")$Vfa0ao3qzwifql .= $Vwtvrjk3xhc2;
		if($Vmsas2mchsb3=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql)) {
			foreach ($Vmsas2mchsb3->result_array_assoc() as $V2i4525nidrh){
				$Vywv2o3maeva[]=$V2i4525nidrh;
			}
		}
		return $Vywv2o3maeva;
	}
}
if(!function_exists('add_date')){
	function add_date($Vwyub51m1igs,$Vxec3ip1xh03=0,$Vtqgof0nw0q5=0,$Vo5dmj0fab1q=0) {
		  $Vwjune35k3c5 = strtotime($Vwyub51m1igs);
		  $Vduclvfkniqu = date('Y-m-d h:i:s', mktime(date('h',$Vwjune35k3c5),
		date('i',$Vwjune35k3c5), date('s',$Vwjune35k3c5), date('m',$Vwjune35k3c5)+$Vtqgof0nw0q5,
		date('d',$Vwjune35k3c5)+$Vxec3ip1xh03, date('Y',$Vwjune35k3c5)+$Vo5dmj0fab1q));
		  return $Vduclvfkniqu;
	}
}
if(!function_exists('add_log_run')){
	function add_log_run($Vnkbdrgv0cj1){
        $Vnpr0xe0jkmu =& get_instance();
		$V0oqsq3ew5ry=$Vnpr0xe0jkmu->db->select('max(id) as z_max')->get('sys_log_run')->row();
		if($V0oqsq3ew5ry->z_max>100){
			$Vnpr0xe0jkmu->db->query("delete from sys_log_run where id<".($V0oqsq3ew5ry->z_max-100));
		} 
		$Vpyytnrwhwf3['user_id']=$Vnpr0xe0jkmu->access->user_id();
		$Vpyytnrwhwf3['url']=$Vnkbdrgv0cj1;
		$Vpyytnrwhwf3['controller']=$Vnpr0xe0jkmu->uri->segment(1);
		$Vpyytnrwhwf3['method']=$Vnpr0xe0jkmu->uri->segment(2);
		$Vpyytnrwhwf3['param1']=$Vnpr0xe0jkmu->uri->segment(3);
		$Vnpr0xe0jkmu->db->insert("sys_log_run",$Vpyytnrwhwf3);
		
	}
}
if(!function_exists("view_syslog")){
	function view_syslog(){
        $Vnpr0xe0jkmu =& get_instance();
		            
		$Vfa0ao3qzwifql="select url,controller,method,param1
		from sys_log_run where user_id='".$Vnpr0xe0jkmu->access->user_id()."'
		group by url,controller,method,param1 limit 20 ";
		$Vtvympurzd4r=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql);
		$Vfa0ao3qzwifys_log_run="";
		if($Vtvympurzd4r){
			foreach ($Vtvympurzd4r->result() as $V2i4525nidrh) {
				$Vnkbdrgv0cj1=$V2i4525nidrh->controller;
				if(!$V2i4525nidrh->method=='0')$Vnkbdrgv0cj1.="/".$V2i4525nidrh->method;
				if(!$V2i4525nidrh->param1=='0')$Vnkbdrgv0cj1.="/".$V2i4525nidrh->param1;
				$Vfa0ao3qzwifys_log_run.="<li><a  class='info_link'  href='".base_url()."index.php/".$Vnkbdrgv0cj1."'>".$Vnkbdrgv0cj1."</a></li>";
			}
		}
		return $Vfa0ao3qzwifys_log_run;
	}
}
if(!function_exists("my_log")){
	function my_log($Voocn2l14suaenis,$Vlcfm5q4qhbl,$Vhfqeopxuvuf=""){
        $Vnpr0xe0jkmu =& get_instance();
		            
		$Vnpr0xe0jkmu->db->insert("syslog",array("tgljam"=>date("Y-m-d H:i:s"),
			"userid"=>$Vhfqeopxuvuf!=""?$Vhfqeopxuvuf:$Vnpr0xe0jkmu->access->user_id(),"jenis"=>$Voocn2l14suaenis,"logtext"=>$Vlcfm5q4qhbl));
	}
}
if(!function_exists("user_id")){
	function user_id(){
        $Vnpr0xe0jkmu =& get_instance();
		return $Vnpr0xe0jkmu->access->user_id();
	}
}
if(!function_exists("alert_count")){
    function alert_count(){
        $Vnpr0xe0jkmu =& get_instance();
        $Vounkozvzwxd=$Vnpr0xe0jkmu->access->user_id();
        $Vfa0ao3qzwifql="select * from syslog where tgljam>'2017-12-01' and userid='$Vounkozvzwxd'";
        $Vtvympurzd4r=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql);
        $Vcb40tjgdnex=$Vtvympurzd4r->num_rows();        
        
        $Vwl05d2zvcw2= "$Vounkozvzwxd ";
        return $Vwl05d2zvcw2;
    }
}

if(!function_exists("user_pass")){
	function user_pass(){
        $Vnpr0xe0jkmu =& get_instance();
		return $Vnpr0xe0jkmu->access->user_pass();
	}
}
if(!function_exists("current_gudang")){
    function current_gudang(){
        $Vnpr0xe0jkmu =& get_instance();
       $V1rsrxupxxp4=$Vnpr0xe0jkmu->session->userdata("session_outlet",'');     
       $V31baunwn3zi=$Vnpr0xe0jkmu->access->current_gudang();
       $Vbnoleywpry2="";
       if($V1rsrxupxxp4!="")$Vbnoleywpry2=$V1rsrxupxxp4;
       if($Vbnoleywpry2=="")$Vbnoleywpry2=$V31baunwn3zi;
       return $Vbnoleywpry2;
    }
}

if(!function_exists("cid")){
	function cid(){
        $Vnpr0xe0jkmu =& get_instance();
       $Vh3rxmmxtqp2=$Vnpr0xe0jkmu->session->userdata("session_company_code",'');     
       $Vxlup4argmlf=$Vnpr0xe0jkmu->access->cid();
       $Vbnoleywpry2="";
       if($Vh3rxmmxtqp2!="")$Vbnoleywpry2=$Vh3rxmmxtqp2;
       if($Vbnoleywpry2=="")$Vbnoleywpry2=$Vxlup4argmlf;
       return $Vbnoleywpry2;
	}
}
if(!function_exists("cidt")){
	function cidt(){
        $Vnpr0xe0jkmu =& get_instance();
		$Vxlup4argmlf=$Vnpr0xe0jkmu->access->cid();
		return "";
	}
}

if(!function_exists("lock_report_salesman")){
	function lock_report_salesman(){
        $Vnpr0xe0jkmu =& get_instance();
		$Vfa0ao3qzwifalesman="";
		$Vzjags5fxlah=false;
		if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->select('salesman,lock_report')->where('user_id',$Vnpr0xe0jkmu->access->user_id())
			->get("salesman")){
			if($Vtvympurzd4rrow=$Vtvympurzd4r->row()){
				$Vfa0ao3qzwifalesman=$Vtvympurzd4rrow->salesman;
				$Vzjags5fxlah=$Vtvympurzd4rrow->lock_report;
			}
		}
		return $Vzjags5fxlah;
	}
}
if(!function_exists("current_salesman")){
	function current_salesman(){
        $Vnpr0xe0jkmu =& get_instance();
		$Vfa0ao3qzwifalesman="";
		$Vzjags5fxlah=false;
		if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->select('salesman,lock_report')->where('user_id',$Vnpr0xe0jkmu->access->user_id())
			->get("salesman")){
			if($Vtvympurzd4rrow=$Vtvympurzd4r->row()){
				$Vfa0ao3qzwifalesman=$Vtvympurzd4rrow->salesman;
				$Vzjags5fxlah=$Vtvympurzd4rrow->lock_report;
			}
		}
		return $Vfa0ao3qzwifalesman;
	}
}

if(!function_exists("cust_id")){
	function cust_id(){
        $Vnpr0xe0jkmu =& get_instance();
		return $Vnpr0xe0jkmu->session->userdata('cust_id');
	}
}

if(!function_exists("user_name")){
	function user_name($Vhfqeopxuvuf=""){
        $Vnpr0xe0jkmu =& get_instance();
		if($Vhfqeopxuvuf==""){
			return $Vnpr0xe0jkmu->access->user_name();
 		} else {
 			if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->where('user_id',$Vhfqeopxuvuf)->get('user')){
				if($V2i4525nidrh=$Vtvympurzd4r->row()){
					return $V2i4525nidrh->username;
				} else {
					return $Vnpr0xe0jkmu->access->user_name();
				}
			} else {
				return $Vnpr0xe0jkmu->access->user_name();

			}
 		}

	}
}
if(!function_exists("user_admin")){
	function user_admin(){
        $Vnpr0xe0jkmu =& get_instance();
		return $Vnpr0xe0jkmu->session->userdata('user_admin');
	}
}
if(!function_exists('account')){
	function account($V1ckfcwm1nbl){
        $Vnpr0xe0jkmu =& get_instance();
        $Vmsas2mchsb3=$Vnpr0xe0jkmu->db->query("select account,account_description from chart_of_accounts
        where id='$V1ckfcwm1nbl'")->row();
		if($Vmsas2mchsb3){
			return $Vmsas2mchsb3->account." - ".$Vmsas2mchsb3->account_description;
		} else {
			return "";
		}
	}
}
if(!function_exists('account_id')){
	function account_id($Vkpc0vecc4sp){
		$Vkpc0vecc4sp=urldecode($Vkpc0vecc4sp);
        $Vnpr0xe0jkmu =& get_instance();
		$Vpyytnrwhwf3=explode(" - ", $Vkpc0vecc4sp);
		$Vzy1oh04mqqf=$Vnpr0xe0jkmu->chart_of_accounts_model->get_by_id($Vpyytnrwhwf3[0])->row();
		if($Vzy1oh04mqqf){
			return $Vzy1oh04mqqf->id;
		} else {
			return 0;
		}
	}
}
        
if(!function_exists('invalid_account')){
	function invalid_account($V1ckfcwm1nbl){
		$Vywv2o3maeva= ($V1ckfcwm1nbl=="" || $V1ckfcwm1nbl=="0" || $V1ckfcwm1nbl==0);
		if( !$Vywv2o3maeva ) $Vywv2o3maeva=account($V1ckfcwm1nbl)=="";
		return $Vywv2o3maeva;
	}
}

if(!function_exists('criteria')){
	function criteria($Vd3wp2cgkz3a,$V15dbrpajeabld,$V3tw2q0jijei='easyui-input',$Vfa0ao3qzwiftyle=""){
        $Vnpr0xe0jkmu =& get_instance();
		$V15dbrpajeabnc=new search_criteria();
		if($Vnpr0xe0jkmu->input->get($V15dbrpajeabld) or $Vnpr0xe0jkmu->input->get($V15dbrpajeabld)==''){
			$Vhwsbz520bqc=$Vnpr0xe0jkmu->input->get($V15dbrpajeabld);
			$Vnpr0xe0jkmu->session->set_userdata($V15dbrpajeabld,$Vhwsbz520bqc);
		} else {
			$Vhwsbz520bqc=$Vnpr0xe0jkmu->session->userdata($V15dbrpajeabld);
		}
		$V15dbrpajeabnc->caption=$Vd3wp2cgkz3a;
		$V15dbrpajeabnc->field_id=$V15dbrpajeabld;
		$V15dbrpajeabnc->field_class=$V3tw2q0jijei;
		$V15dbrpajeabnc->field_value=$Vhwsbz520bqc;
		$V15dbrpajeabnc->field_style=$Vfa0ao3qzwiftyle;
		return $V15dbrpajeabnc;
	}
}
if(!function_exists('link_button')){
    function link_button($Vyfsyvpoqvi0,$Vptcygd5bjzq,$Vzdk5vpgmbjh='',$Vvaogvlyae2u='false',$Vnkbdrgv0cj1='',$Vwl05d2zvcw2=''){
    	if($Vnkbdrgv0cj1==''){
	        return '<a href="#" class="easyui-linkbutton"
	        data-options="iconCls:\'icon-'.$Vzdk5vpgmbjh.'\',
	        plain: '.$Vvaogvlyae2u.'" onclick="'.$Vptcygd5bjzq.';return false;">'.$Vyfsyvpoqvi0.'</a>';
		} else {
	        return '<a href="'.$Vnkbdrgv0cj1.'" class="easyui-linkbutton"
	        data-options="iconCls:\'icon-'.$Vzdk5vpgmbjh.'\',
	        plain: '.$Vvaogvlyae2u.'"  " >'.$Vyfsyvpoqvi0.'</a>';
		}
    }
}
if(!function_exists('link_button2')){
    function link_button2($Vyfsyvpoqvi0,$Vptcygd5bjzq,$Vzdk5vpgmbjh='',$Vvaogvlyae2u='false',$Vnkbdrgv0cj1='',$Vwl05d2zvcw2=''){
    	if($Vnkbdrgv0cj1==''){
	        return '<a href="#" class="btn btn-default glyphicon glyphicon-'.$Vzdk5vpgmbjh.'"
	        data-optionsx="iconClsx:\'icon-'.$Vzdk5vpgmbjh.'\',
	        plain: '.$Vvaogvlyae2u.'" onclick="'.$Vptcygd5bjzq.';return false;"> '.$Vyfsyvpoqvi0.'</a>';
		} else {
	        return '<a href="'.$Vnkbdrgv0cj1.'" class="btn btn-default glyphicon glyphicon-'.$Vzdk5vpgmbjh.'"
	        data-optionsx="iconClsx:\'icon-'.$Vzdk5vpgmbjh.'\',
	        plain: '.$Vvaogvlyae2u.'"  " > '.$Vyfsyvpoqvi0.'</a>';
		}
    }
}
if(!function_exists('datasource')){
    function datasource($sql,$with_checkbox=false,$primary_key="",$row_count=0){
        $CI =& get_instance();
//    $CI->benchmark->mark('code_start');        
       $pages=1000;
       if($row_count>0)$pages=$row_count;
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
    $Vnpr0xe0jkmu =& get_instance();
 	            
       $V53kxz2hlhla=$Vnpr0xe0jkmu->config->item('multi_company');
       if($V53kxz2hlhla){
            $Vdxtlp2zja1w=$Vnpr0xe0jkmu->session->userdata("company_code","");
            if($Vdxtlp2zja1w!=""){
               $Vnpr0xe0jkmu->db = $Vnpr0xe0jkmu->load->database($Vdxtlp2zja1w, TRUE);
           }
       }         
 	return (
	       $Vnpr0xe0jkmu->input->server('HTTP_X_REQUESTED_WITH')&&
	           ($Vnpr0xe0jkmu->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
     }
}
if ( ! function_exists('valid_date')) {
	function valid_date($Vfa0ao3qzwiftr)
	{
         $Vnpr0xe0jkmu =& get_instance();
         if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$Vfa0ao3qzwiftr))
    	 {
    		 $Vnpr0xe0jkmu->form_validation->set_message('valid_date',
    		 'date format is not valid. yyyy-mm-dd');
    		 return false;
    	 } else {
    	 	return true;
    	 }
	}
}
if ( ! function_exists('strzero')) {
	function strzero($Vu0pjn5k3qbknput,$Vc0qlmrwpvpo){
		return str_pad($Vu0pjn5k3qbknput,$Vc0qlmrwpvpo, "0", STR_PAD_LEFT );
	}
}
if ( ! function_exists('pad')) {
    function pad($Vu0pjn5k3qbknput,$Vc0qlmrwpvpo){
        return str_pad($Vu0pjn5k3qbknput,$Vc0qlmrwpvpo, ".", STR_PAD_RIGHT );
    }
}

if(!function_exists('company_header')){
    function company_header(){
         $Vnpr0xe0jkmu =& get_instance();
         $Vnpr0xe0jkmu->load->model('company_model');
         $Vpkiogqd4nvg=$Vnpr0xe0jkmu->company_model->get_by_id($Vnpr0xe0jkmu->access->cid)->row();
		 $Vpyytnrwhwf3='';
		 if($Vpkiogqd4nvg){
         	$Vpyytnrwhwf3='<div id="divHeader"><h1>'.$Vpkiogqd4nvg->company_name."</h1><h3>".$Vpkiogqd4nvg->street
                 ."<br/>".$Vpkiogqd4nvg->suite." ".$Vpkiogqd4nvg->city_state_zip_code
                 ." - Phone: ".$Vpkiogqd4nvg->phone_number.'</h3>
                     </div>';
         };
        return $Vpyytnrwhwf3;
    }
}
if(!function_exists('getColoumn')){
function getColoumn($V4t0nvjolfqr) {
		$Vi25tpdnh4in=array();	$V15dbrpajeabieldnames=array();	$Vc0qlmrwpvpo=array(); $V15dbrpajeablag=array();
		if($V15dbrpajeabields=$Vnpr0xe0jkmu->db->field_data("SHOW COLUMNS FROM ".$V4t0nvjolfqr)){
			foreach($V15dbrpajeabields as $V15dbrpajeabld){
				$V15dbrpajeabieldnames[]=$V15dbrpajeabld->name;
			}
		}

      return $V15dbrpajeabieldnames;
}
}


if(!function_exists('data_table_v2')){
function data_table_v2($table,$record=null,$is_sql=false){
    $CI =& get_instance();
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
//          $fields=getColoumn($table);
//          var_dump($fields);
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
                        }  
                        break;
                    case 'varchar':
                    case 'string':
                        $val='';
                        if(isset($_POST[$name])){
                            $data[$name]=$CI->input->post($name);
                        }  
                        break;
                    default:
                        $val=0;
                        if(isset($_POST[$name])){
                            if($_POST[$name]!="") $val=$data[$name]=$CI->input->post($name);
                            $data[$name]=$val;
                        }
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
                        }  
                        break;
                    case 'varchar':
                    case 'string':
                        $val='';
                        if(isset($_GET[$name])){
                            $data[$name]=$CI->input->post($name);
                        }  
                        break;
                    default:
                        $val=0;
                        if(isset($_GET[$name])){
                            $data[$name]= (int)$CI->input->post($name);
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
                    } 
                    break;
                case 'string':
                    $val='';
                    if(isset($_POST[$name])){
                        $data[$name]=$CI->input->post($name);    
                    }  
                    break;
                default:
                    $val=0;
                    if(isset($_POST[$name])){
                        if($_POST[$name]!="") $val=$data[$name]=$CI->input->post($name);
                        $data[$name]=$val;
                    }
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
                    }  
                    break;
                case 'string':
                    $val='';
                    if(isset($_GET[$name])){
                        $data[$name]=$CI->input->post($name);    
                    }  
                    break;
                default:
                    $val=0;
                    if(isset($_GET[$name])){
                        $data[$name]= (int)$CI->input->post($name);    
                    }  
                    break;
            }
    }   
    return $data;
}}


if (!function_exists("load_view")){
    function load_view($Vomidrjltv0a,$Vpyytnrwhwf3 = array()){
        $Vnpr0xe0jkmu = & get_instance();
		if($Vomidrjltv0a<>""){
			$Vshjehuukcvw = $Vnpr0xe0jkmu->load->view($Vomidrjltv0a,$Vpyytnrwhwf3,true);
			return $Vshjehuukcvw;
		}
		
    }
}

if (!function_exists("criteria_text")){

	function criteria_text($V15dbrpajeabaa) {
		$Vu0pjn5k3qbk=0;
		$Vfa0ao3qzwif='';
		foreach($V15dbrpajeabaa as $V15dbrpajeaba){
			$Vi25tpdnh4in="text";
			$Vohwkgehnd1f="";
			if($V15dbrpajeaba->field_class=="easyui-datetimebox"){
				$Vohwkgehnd1f=date("Y-m-d 00:00:00");
				if(strpos($V15dbrpajeaba->field_id,"date_to"))$Vohwkgehnd1f=date("Y-m-d 23:59:59");
				if($V15dbrpajeaba->field_value!="")$Vohwkgehnd1f=$V15dbrpajeaba->field_value;
				$Vfa0ao3qzwif .= " ".$V15dbrpajeaba->caption.'
				<input type="'.$Vi25tpdnh4in.'" value="'.$Vohwkgehnd1f.'" id="'.$V15dbrpajeaba->field_id.'"  name="'.$V15dbrpajeaba->field_id.'"
				class="'.$V15dbrpajeaba->field_class.'" style="width:80px">';
				$Vfa0ao3qzwif .= " ";
			} else if($V15dbrpajeaba->field_class=="checkbox"){
				if($V15dbrpajeaba->field_value!="")$Vohwkgehnd1f=$V15dbrpajeaba->field_value;
				$Vfa0ao3qzwif .= "
				<input type='checkbox' value='$Vohwkgehnd1f' id='".$V15dbrpajeaba->field_id."'  name='".$V15dbrpajeaba->field_id."'
				> ".$V15dbrpajeaba->caption;
				$Vfa0ao3qzwif .= " ";

			} else {
				if($V15dbrpajeaba->field_value!="")$Vohwkgehnd1f=$V15dbrpajeaba->field_value;
				$Vfa0ao3qzwif .= " ".$V15dbrpajeaba->caption.'
				<input type="'.$Vi25tpdnh4in.'" value="'.$Vohwkgehnd1f.'" id="'.$V15dbrpajeaba->field_id.'"  name="'.$V15dbrpajeaba->field_id.'"
				class="'.$V15dbrpajeaba->field_class.'" style="width:80px">';
				$Vfa0ao3qzwif .= " ";

			}

			$Vu0pjn5k3qbk++;
		}
		return $Vfa0ao3qzwif;
	 }

}
if ( ! function_exists('allow_mod')) {
	function allow_mod($V50zhcrdvbej){
		$Vbnoleywpry2=false;
        $Vnpr0xe0jkmu =& get_instance();
		$Vzg4naelvb55=$Vnpr0xe0jkmu->access->user_id();
        $Vfa0ao3qzwifql="select distinct ugm.module_id from user_job uj
		join modules_groups mg on mg.user_group_id=uj.group_id
		join user_group_modules ugm on ugm.group_id=uj.group_id
		where uj.user_id='$Vzg4naelvb55' and ugm.module_id='$V50zhcrdvbej'";
        if($Vmsas2mchsb3=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql)){
			$Vbnoleywpry2=$Vmsas2mchsb3->num_rows();
		}
		return $Vbnoleywpry2;
	}
}
if ( ! function_exists('user_job_exist')) {
	function user_job_exist($Voocn2l14suaob_id){
		$Vbnoleywpry2=false;
        $Vnpr0xe0jkmu =& get_instance();
		$Vzg4naelvb55=$Vnpr0xe0jkmu->access->user_id();
        $Vfa0ao3qzwifql="select id from user_job where user_id='$Vzg4naelvb55' and group_id='$Voocn2l14suaob_id'";
        if($Vmsas2mchsb3=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql)){
			$Vbnoleywpry2=$Vmsas2mchsb3->num_rows();
		}
		return $Vbnoleywpry2;
	}
}

if ( ! function_exists('allow_mod2')) {
	function allow_mod2($V50zhcrdvbej,$Voocn2l14suason_format=false){
		if(user_admin())return true;
        $Vnpr0xe0jkmu =& get_instance();
		$Vzg4naelvb55=$Vnpr0xe0jkmu->access->user_id();
        $Vfa0ao3qzwifql="select distinct ugm.module_id from user_job uj
		join modules_groups mg on mg.user_group_id=uj.group_id
		join user_group_modules ugm on ugm.group_id=uj.group_id
		where uj.user_id='$Vzg4naelvb55' and ugm.module_id='$V50zhcrdvbej'";
        $Vmsas2mchsb3=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql);
		if($Vmsas2mchsb3->num_rows()){
			if($Voocn2l14suason_format){
				echo json_encode(array("success"=>false,"msg"=>"Not Found Row !"));
			} else {
				return true;
			}
		} else {
			if($Voocn2l14suason_format){
				echo json_encode(array("success"=>false,"msg"=>"Anda tidak diijinkan  !"))				;
			} else {
				echo "<span class='not_access alert alert-warning'>
				Anda tidak diijinkan menjalankan proses module ini.
				<br>Silahkan hubungi administrator.
				<br>Module Id: <strong>[$V50zhcrdvbej]</strong>
				</span>";
				return false;
			}
		}
	}
}
if ( ! function_exists('to_array')) {
	function to_array($Vpyytnrwhwf3){
		$Vywv2o3maeva=null;
		foreach($Vpyytnrwhwf3 as $Vm0pnfecgctz=>$Vhwsbz520bqc){
			foreach($Vhwsbz520bqc as $Vm0pnfecgctz2=>$Vhwsbz520bqc2){
				$Vywv2o3maeva[$Vm0pnfecgctz2]=$Vhwsbz520bqc2;
			}
		}
		return $Vywv2o3maeva;
	}
}
if(!function_exists("inbox_send")){
	function inbox_send($V15dbrpajeabrom,$Vjb352a5gr3k,$Vfa0ao3qzwifubject,$Vqeqevj53d2l,$V1cmmprxbg5p='',$V4bz2ibs243m=''){
        $Vnpr0xe0jkmu =& get_instance();
		$Vnpr0xe0jkmu->load->model("maxon_inbox_model");
		if ( !is_array($Vjb352a5gr3k) ) {
			$Vpyytnrwhwf3['rcp_from']=$V15dbrpajeabrom;
			$Vpyytnrwhwf3['rcp_to']=$Vjb352a5gr3k;
			$Vpyytnrwhwf3['subject']=$Vfa0ao3qzwifubject;
			$Vpyytnrwhwf3['message']=$Vqeqevj53d2l;
			$Vpyytnrwhwf3['msg_date']=date('Y-m-d H:i:s');
            $Vpyytnrwhwf3['doc_no']=$V1cmmprxbg5p;
            $Vpyytnrwhwf3['doc_type']=$V4bz2ibs243m;
			return $Vnpr0xe0jkmu->maxon_inbox_model->save($Vpyytnrwhwf3);
		} else {
			for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($Vjb352a5gr3k);$Vu0pjn5k3qbk++)
			{
				$Vpyytnrwhwf3['rcp_from']=$V15dbrpajeabrom;
				$Vpyytnrwhwf3['rcp_to']=$Vjb352a5gr3k[$Vu0pjn5k3qbk]['user_id'];
				$Vpyytnrwhwf3['subject']=$Vfa0ao3qzwifubject;
				$Vpyytnrwhwf3['message']=$Vqeqevj53d2l;
				$Vpyytnrwhwf3['msg_date']=date('Y-m-d H:i:s');
                $Vpyytnrwhwf3['doc_no']=$V1cmmprxbg5p;
                $Vpyytnrwhwf3['doc_type']=$V4bz2ibs243m;
				return $Vnpr0xe0jkmu->maxon_inbox_model->save($Vpyytnrwhwf3);
			}

		}
	}

}
	if(!function_exists("col_number")){
		function col_number($V15dbrpajeabld,$Vuit3ldmgeqp=0){
			return "field:'$V15dbrpajeabld',width:80,align:'right',
					editor:'numberbox',
					formatter: function(value,row,index){
					return number_format(value,$Vuit3ldmgeqp,'.',',');}";
		}
	}
    if(!function_exists("sqlinto")){
        function sqlinto($Vfa0ao3qzwifql){
            $Vnpr0xe0jkmu =& get_instance();
            $Vywv2o3maeva=null;
            if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql)){
                $Vywv2o3maeva=(array)$Vtvympurzd4r->row();
            }
            return $Vywv2o3maeva;
        }
    }
	if(!function_exists("getvar")){
		function getvar($Vheloqro25dq,$V1mvx1icblm4=null){
			$Vnpr0xe0jkmu =& get_instance();
        	$Vnpr0xe0jkmu->load->library("sysvar");
			$Vnpr0xe0jkmu->load->model("company_model");
			$Vxlup4argmlf=$Vnpr0xe0jkmu->access->cid;
			if($Vxlup4argmlf=="ALL" || $Vxlup4argmlf==""){
				$Vxlup4argmlf=$Vnpr0xe0jkmu->db->select("company_code")->get("preferences")->row()->company_code;
			}
			$Vaszyvizbaj4=$Vnpr0xe0jkmu->company_model->get_by_id($Vxlup4argmlf)->row_array();
			if(isset($Vaszyvizbaj4[$Vheloqro25dq])){
				$Vbnoleywpry2=$Vaszyvizbaj4[$Vheloqro25dq];
			} else {
				$Vbnoleywpry2=$Vnpr0xe0jkmu->sysvar->getvar($Vheloqro25dq,$V1mvx1icblm4);
			}
			return $Vbnoleywpry2;
		}
	}
	if(!function_exists("putvar")){
		function putvar($Vheloqro25dq,$V1mvx1icblm4){
			$Vnpr0xe0jkmu =& get_instance();
			$Vnpr0xe0jkmu->load->library("sysvar");
			return $Vnpr0xe0jkmu->sysvar->save($Vheloqro25dq,$V1mvx1icblm4);
		}
	}
	if(!function_exists("website_activated")){
		function website_activated(){
			$Vnpr0xe0jkmu =& get_instance();
 			$Vq2qtgofhuf2=false;
			if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->where("app_id","_20000")->get("maxon_apps")){
				if($V2i4525nidrh=$Vtvympurzd4r->row()){
					$Vq2qtgofhuf2=$V2i4525nidrh->is_active == "1";
				}
			}
			return $Vq2qtgofhuf2;
		}
	}
	if(!function_exists("eshop_activated")){
		function eshop_activated(){
			$Vnpr0xe0jkmu =& get_instance();
         	$Vq2qtgofhuf2=false;
			if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->where("app_id","eshop")->get("maxon_apps")){
				if($V2i4525nidrh=$Vtvympurzd4r->row()){
					$Vq2qtgofhuf2=$V2i4525nidrh->is_active == "1";
				}
			}
			return $Vq2qtgofhuf2;
		}
	}
	if(!function_exists("html_table")){
		function html_table($Vfa0ao3qzwifql,$Vycqfcmjjrba=false,$Vfa0ao3qzwiftyle=""){
			$Vnpr0xe0jkmu =& get_instance();
         	$Vxgeomoqhwja="";
			if($Vycqfcmjjrba){
			$Vxgeomoqhwja="<html><head><style>
					body {font-family: Arial;}
					table {	border-collapse: collapse;}
					th {background-color: #cccccc;}
					th, td {border: 1px solid #000;}
				</style></head><body>";
			}
			$Vxgeomoqhwja.="<table class='$Vfa0ao3qzwiftyle'><thead>";
			if($Vmsas2mchsb3=$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwifql)){
				$V15dbrpajeablds=$Vmsas2mchsb3->list_fields();
				$Vxgeomoqhwja .= '<tr>';
				for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($V15dbrpajeablds);$Vu0pjn5k3qbk++){
					$V15dbrpajeabld=$V15dbrpajeablds[$Vu0pjn5k3qbk];
					$V15dbrpajeabld=str_replace('_',' ',$V15dbrpajeabld);
					$V15dbrpajeabld=ucfirst($V15dbrpajeabld);
					$Vxgeomoqhwja .='<th>'.$V15dbrpajeabld.'</th>';
				}
				$Vxgeomoqhwja .= "</tr></thead><tbody>";
				foreach($Vmsas2mchsb3->result_array() as $V2i4525nidrh){
					$Vxgeomoqhwja .="<tr>";
					for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($V2i4525nidrh);$Vu0pjn5k3qbk++){
						$Vxgeomoqhwja.="<td>".$V2i4525nidrh[$V15dbrpajeablds[$Vu0pjn5k3qbk]]."</td>";
					}
				}
				$Vxgeomoqhwja.="</tbody></table>";
				if($Vycqfcmjjrba) $Vxgeomoqhwja.="</body></html>";
			}
			return $Vxgeomoqhwja;
		}
	}
	if(!function_exists("breadcrumb")){
		function breadcrumb($Vxizmuhpq1it){
 			$Vywv2o3maeva="<ol class='breadcrumb box-bcum'>";
			for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($Vxizmuhpq1it);$Vu0pjn5k3qbk++) {
				if($Vu0pjn5k3qbk==0) {
					$Vywv2o3maeva.=" <li><a class='glyphicon glyphicon-home'
					  href='".$Vxizmuhpq1it[$Vu0pjn5k3qbk][1]."'> Home</a></li>";
				} else {
					$Vywv2o3maeva.=" <li class='".$Vxizmuhpq1it[$Vu0pjn5k3qbk][1]==""?"":"active"."'>
					<a href='".$Vxizmuhpq1it[$Vu0pjn5k3qbk][1]."'> ".$Vxizmuhpq1it[$Vu0pjn5k3qbk][0]."</a></li>";
				}
			}
			$Vywv2o3maeva.="</ol>";
			return $Vywv2o3maeva;
		}
	}
	if(!function_exists("add_log_ip_address")){
		function add_log_ip_address(){
			$Vnpr0xe0jkmu =& get_instance();
         	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$Vu0pjn5k3qbkp = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$Vu0pjn5k3qbkp = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$Vu0pjn5k3qbkp = $_SERVER['REMOTE_ADDR'];
			}
			$Vfa0ao3qzwif="INSERT INTO maxon_log_ip (period, ip_address)
			SELECT * FROM (SELECT CURDATE()+0, '".$Vu0pjn5k3qbkp."') AS tmp
			WHERE NOT EXISTS (
				SELECT ip_address FROM maxon_log_ip
				WHERE period = CURDATE()+0 AND ip_address='".$Vu0pjn5k3qbkp."'
			) LIMIT 1;";
			$Vnpr0xe0jkmu->db->query($Vfa0ao3qzwif);
		}
	}
	if ( !function_exists('my_date_diff') ) {
		function my_date_diff($Vtxvb5igyibb,$V5qmlhprvad3=null) {
			if( $V5qmlhprvad3==null ) $V5qmlhprvad3=date("Y-m-d",time());
 			$Vjf33jbravim = new DateTime($Vtxvb5igyibb);
			$Vvh5isf2ncfx  = new DateTime($V5qmlhprvad3);
 			$Vjvveupmrp4s = $Vjf33jbravim->diff($Vvh5isf2ncfx);
 			return ($Vjvveupmrp4s->m*30)+$Vjvveupmrp4s->d;
		}
	}
	if ( !function_exists('is_num_format') ) {
	function is_num_format($V15dbrpajeabld_name,$V15dbrpajeabld_fmt){
		for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($V15dbrpajeabld_fmt);$Vu0pjn5k3qbk++){
			if($V15dbrpajeabld_name==$V15dbrpajeabld_fmt[$Vu0pjn5k3qbk]){
				return true;
			}
		}
	}
	if ( !function_exists('add_field') ) {
		function add_field($V4t0nvjolfqr,$V15dbrpajeabield,$Vi25tpdnh4in='varchar',$Vfa0ao3qzwifize='50'){
			$Vnpr0xe0jkmu =& get_instance();
 			$Vnpr0xe0jkmu->load->dbforge();
			$V15dbrpajeabield_info=array(
				$V15dbrpajeabield=>array('type'=>$Vi25tpdnh4in.'('.$Vfa0ao3qzwifize.')','size'=>$Vfa0ao3qzwifize,'caption'=>$V15dbrpajeabield,'control'=>'text')
			);
			if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->query("SHOW COLUMNS FROM $V4t0nvjolfqr LIKE '$V15dbrpajeabield'")){
				if(!$Vtvympurzd4r->row()){
					$Vnpr0xe0jkmu->dbforge->add_column($V4t0nvjolfqr,$V15dbrpajeabield_info);
				}
			}
		}
	}
	if ( !function_exists('save_data_table') ) {
		function save_data_table($V4t0nvjolfqr,$Vpyytnrwhwf3,$Vu0pjn5k3qbkd='',$V15dbrpajeabield_key=''){
			$Vnpr0xe0jkmu =& get_instance();
         	$Vbnoleywpry2=false;
			if($Vu0pjn5k3qbkd==""){
				$Vbnoleywpry2=$Vnpr0xe0jkmu->db->insert($V4t0nvjolfqr,$Vpyytnrwhwf3);
			} else {
				$Vbnoleywpry2=$Vnpr0xe0jkmu->db->where($V15dbrpajeabield_key,$Vu0pjn5k3qbkd)->update($V4t0nvjolfqr,$Vpyytnrwhwf3);
			}
		}
	}
	if (!function_exists('exist_unit')){
		function exist_unit($Vz5jsdpw3ddn){
			$Vnpr0xe0jkmu=&get_instance();
         	$Vbnoleywpry2=null;
			if($Vz5jsdpw3ddn!="")
			{
				if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->where("to_unit",$Vz5jsdpw3ddn)
					->get("unit_of_measure"))
				{
					if($V2i4525nidrh=$Vtvympurzd4r->row())
					{
						$Vbnoleywpry2['from_unit']=$V2i4525nidrh->from_unit;
						$Vbnoleywpry2['to_unit']=$V2i4525nidrh->to_unit;
						$Vbnoleywpry2['unit_value']=$V2i4525nidrh->unit_value;
					}				
					
				}
			}
			return $Vbnoleywpry2;
		}
	}
	if (!function_exists('item_sales_price')){
		function item_sales_price($Vu0pjn5k3qbktem_number){
			$Vnpr0xe0jkmu=&get_instance();
         	$Vbnoleywpry2=0;
			if($Vu0pjn5k3qbktem_number!="")
			{
				if($Vdb11a1jn1ua=$Vnpr0xe0jkmu->db->select("retail")
				->where("item_number",$Vu0pjn5k3qbktem_number)
				->get('inventory')->row()){
					$Vbnoleywpry2=$Vdb11a1jn1ua->retail;
				}
			}
			return $Vbnoleywpry2;
		}
	}
	if (!function_exists('item_purchase_price')){
		function item_purchase_price($Vu0pjn5k3qbktem_number){
			$Vnpr0xe0jkmu=&get_instance();
          	$Vbnoleywpry2=0;
			if($Vu0pjn5k3qbktem_number!="")
			{
				if($Vdb11a1jn1ua=$Vnpr0xe0jkmu->db->select("cost_from_mfg")
				->where("item_number",$Vu0pjn5k3qbktem_number)
					->get('inventory')){
					$Vdb11a1jn1uaesult=$Vdb11a1jn1ua->row()->cost_from_mfg;
				}
			}
			return $Vbnoleywpry2;
		}
	}
	if (!function_exists('item_cost')){
		function item_cost($Vu0pjn5k3qbktem_number){
			$Vnpr0xe0jkmu=&get_instance();
	     	$Vbnoleywpry2=0;
			if($Vu0pjn5k3qbktem_number!="")
			{
				if($V2i4525nidrh=$Vbnoleywpry2=$Vnpr0xe0jkmu->db->select("cost")
				->where("item_number",$Vu0pjn5k3qbktem_number)
				->get('inventory')->row()){
					$Vbnoleywpry2=$V2i4525nidrh->cost;
				}
			}
			return $Vbnoleywpry2;
		}
	}
	if (!function_exists('sql_in')){
		function sql_in($Vpyytnrwhwf3){
			$Vbnoleywpry2="(";
			$Vpmkll0w2ttn="";
			for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($Vpyytnrwhwf3);$Vu0pjn5k3qbk++)$Vpmkll0w2ttn.="'".$Vpyytnrwhwf3[$Vu0pjn5k3qbk]."',";
			if(substr($Vpmkll0w2ttn,-1,1)==",")$Vpmkll0w2ttn=substr($Vpmkll0w2ttn,0,strlen($Vpmkll0w2ttn)-1);
			$Vbnoleywpry2.=$Vpmkll0w2ttn.")";
			return $Vbnoleywpry2;
		}
	}
	if(!function_exists('kode_tahun')){
	    function kode_tahun(){
	        $Va4j5knbtb2q=date('y');
            
            if($Va4j5knbtb2q==17)return "0";
            if($Va4j5knbtb2q==18)return "1";
            if($Va4j5knbtb2q==19)return "2";
            if($Va4j5knbtb2q==20)return "3";
            if($Va4j5knbtb2q==21)return "4";
            if($Va4j5knbtb2q==22)return "5";
            if($Va4j5knbtb2q==23)return "6";
            if($Va4j5knbtb2q==24)return "7";
            if($Va4j5knbtb2q==25)return "8";
            if($Va4j5knbtb2q==26)return "9";
            if($Va4j5knbtb2q==27)return "A";
            if($Va4j5knbtb2q==28)return "B";
            if($Va4j5knbtb2q==29)return "C";
            if($Va4j5knbtb2q==30)return "D";
            if($Va4j5knbtb2q==31)return "E";
            if($Va4j5knbtb2q==32)return "F";
	    }
	}
    if(!function_exists('kode_bulan')){
        function kode_bulan(){
            $Va4j5knbtb2q=date('m');
            
            if($Va4j5knbtb2q==1)return "1";
            if($Va4j5knbtb2q==2)return "2";
            if($Va4j5knbtb2q==3)return "3";
            if($Va4j5knbtb2q==4)return "4";
            if($Va4j5knbtb2q==5)return "5";
            if($Va4j5knbtb2q==6)return "6";
            if($Va4j5knbtb2q==7)return "7";
            if($Va4j5knbtb2q==8)return "8";
            if($Va4j5knbtb2q==9)return "9";
            if($Va4j5knbtb2q==10)return "A";
            if($Va4j5knbtb2q==11)return "B";
            if($Va4j5knbtb2q==12)return "C";
        }
    }

}
if(!function_exists('grid_fields')){
    function grid_fields($V4t0nvjolfqr,$Vfa0ao3qzwiffield){
        $Vnpr0xe0jkmu =& get_instance();
        $Vfa0ao3qzwiffield=str_replace(" ","",$Vfa0ao3qzwiffield);
        $Vpmkll0w2ttnfields=explode(",",$Vfa0ao3qzwiffield);
        $Vfa0ao3qzwif='';
        $V15dbrpajeabields=$Vnpr0xe0jkmu->db->field_data($V4t0nvjolfqr);
        for($Vu0pjn5k3qbk=0;$Vu0pjn5k3qbk<count($Vpmkll0w2ttnfields);$Vu0pjn5k3qbk++){
            $Vvnmd1mbccf0=false;
            foreach($V15dbrpajeabields as $V15dbrpajeabld){
                $Vi25tpdnh4in=$V15dbrpajeabld->type;
                $Vyickfhjehfx=$V15dbrpajeabld->name;
                $Vc0qlmrwpvpo=$V15dbrpajeabld->max_length;
                if($Vpmkll0w2ttnfields[$Vu0pjn5k3qbk]==$Vyickfhjehfx){
                    switch ($Vi25tpdnh4in) {
                        case 'datetime':
                        case 'varchar':
                        case 'string':
                            $Vfa0ao3qzwif.="<th data-options=\"field:'$Vyickfhjehfx',width:'$Vc0qlmrwpvpo' \">".ucfirst($Vyickfhjehfx)."</th>";
                            break;
                        default:
                            $Vfa0ao3qzwif.="<th data-options=\"field:'$Vyickfhjehfx',width:'$Vc0qlmrwpvpo', 
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
                                 \">".ucfirst($Vyickfhjehfx)."</th>";
                            break;
                    }
                    $Vvnmd1mbccf0=true;
                    break;
                }    
            }
        }
        return $Vfa0ao3qzwif;
    }
}

if(!function_exists('konversi')){
function konversi($V3aibgekzfc1){
  
  $V3aibgekzfc1 = abs($V3aibgekzfc1);
  $Vpmkll0w2ttnngka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $Vkgutjy3geoj = "";
  
  if($V3aibgekzfc1 < 12){
   $Vkgutjy3geoj = " ".$Vpmkll0w2ttnngka[$V3aibgekzfc1];
  }else if($V3aibgekzfc1<20){
   $Vkgutjy3geoj = konversi($V3aibgekzfc1 - 10)." belas";
  }else if ($V3aibgekzfc1<100){
   $Vkgutjy3geoj = konversi($V3aibgekzfc1/10)." puluh". konversi($V3aibgekzfc1%10);
  }else if($V3aibgekzfc1<200){
   $Vkgutjy3geoj = " seratus".konversi($V3aibgekzfc1-100);
  }else if($V3aibgekzfc1<1000){
   $Vkgutjy3geoj = konversi($V3aibgekzfc1/100)." ratus".konversi($V3aibgekzfc1%100);   
  }else if($V3aibgekzfc1<2000){
   $Vkgutjy3geoj = " seribu".konversi($V3aibgekzfc1-1000);
  }else if($V3aibgekzfc1<1000000){
   $Vkgutjy3geoj = konversi($V3aibgekzfc1/1000)." ribu".konversi($V3aibgekzfc1%1000);   
  }else if($V3aibgekzfc1<1000000000){
   $Vkgutjy3geoj = konversi($V3aibgekzfc1/1000000)." juta".konversi($V3aibgekzfc1%1000000);
  }else if($V3aibgekzfc1<1000000000000){
   $Vkgutjy3geoj = konversi($V3aibgekzfc1/1000000000)." milyar".konversi($V3aibgekzfc1%1000000000);
  }
  
  return $Vkgutjy3geoj;
 }
 }  
if(!function_exists('tkoma')){
 function tkoma($V3aibgekzfc1){
  $Vfa0ao3qzwiftr = stristr($V3aibgekzfc1,".");
  $Vzrteyamdank = explode(',',$V3aibgekzfc1);
  $Vpmkll0w2ttn="";
  
  if(count($Vzrteyamdank)>1){
      if(($Vzrteyamdank[1]/10) >= 1){
       $Vpmkll0w2ttn = abs($Vzrteyamdank[1]);
      }
  }
  $Vfa0ao3qzwiftring = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
  $Vkgutjy3geoj = "";
  $Vpmkll0w2ttn2="";
  if(count($Vzrteyamdank)>1){
    $Vpmkll0w2ttn2 = $Vzrteyamdank[1]/10;
  }
  $Vsh2trnicuoq = strlen($Vfa0ao3qzwiftr);
  $Vu0pjn5k3qbk =1;
    
  
  if($Vpmkll0w2ttn>=1 && $Vpmkll0w2ttn< 12){   
   $Vkgutjy3geoj .= " ".$Vfa0ao3qzwiftring[$Vpmkll0w2ttn];
  }else if($Vpmkll0w2ttn>12 && $Vpmkll0w2ttn < 20){   
   $Vkgutjy3geoj .= konversi($Vpmkll0w2ttn - 10)." belas";
  }else if ($Vpmkll0w2ttn>20 && $Vpmkll0w2ttn<100){   
   $Vkgutjy3geoj .= konversi($Vpmkll0w2ttn / 10)." puluh". konversi($Vpmkll0w2ttn % 10);
  }else{
   if($Vpmkll0w2ttn2<1){
    
    while ($Vu0pjn5k3qbk<$Vsh2trnicuoq){     
     $Vqls2vn5poed = substr($Vfa0ao3qzwiftr,$Vu0pjn5k3qbk,1);     
     $Vu0pjn5k3qbk++;
     $Vkgutjy3geoj .= " ".$Vfa0ao3qzwiftring[$Vqls2vn5poed];
    }
   }
  }  
  return $Vkgutjy3geoj;
 }
 } 
if(!function_exists('terbilang')){
     function terbilang($V3aibgekzfc1){
          if($V3aibgekzfc1<0){
               $V2czxz1hmxtn = "minus ".trim(konversi(x));
          }else{
               $Vm5htvrj3ggm = trim(tkoma($V3aibgekzfc1));
               $V2czxz1hmxtn = trim(konversi($V3aibgekzfc1));
          }
          
        if($Vm5htvrj3ggm){
                $V2czxz1hmxtn = $V2czxz1hmxtn." koma ".$Vm5htvrj3ggm;
          }else{
             $V2czxz1hmxtn = $V2czxz1hmxtn;
          }
          return $V2czxz1hmxtn;  
     }
}
if(!function_exists('msgbox')){
     function msgbox($Vlcfm5q4qhbl,$Vwl05d2zvcw2="Information",$Vpmkll0w2ttnuto_close=false){
        $Vfa0ao3qzwif= "<div class='alert alert-info'>$Vlcfm5q4qhbl</div>";
        if($Vpmkll0w2ttnuto_close)$Vfa0ao3qzwif.="<script>remove_tab_parent();</script>";
        $Vnpr0xe0jkmu =& get_instance();
        $Vpyytnrwhwf3['content']=$Vfa0ao3qzwif;
        $Vpyytnrwhwf3['message']=$Vwl05d2zvcw2;
        $Vnpr0xe0jkmu->template->display("blank",$Vpyytnrwhwf3);
        
     }
}
if(!function_exists('item_need_update')){
     function item_need_update($Vu0pjn5k3qbktem_no){
        $Vnpr0xe0jkmu =& get_instance();
        $Vu0pjn5k3qbktem_no=urldecode($Vu0pjn5k3qbktem_no);
        if($Vu0pjn5k3qbktem_no!="") {
            if($Vtvympurzd4r=$Vnpr0xe0jkmu->db->where("item_no",$Vu0pjn5k3qbktem_no)->get("zzz_item_need_update")){
                if($Vtvympurzd4r->num_rows()==0){
                    $Vnpr0xe0jkmu->db->insert("zzz_item_need_update",array("item_no"=>$Vu0pjn5k3qbktem_no));
                }
            }
        }
     }
}

if(!function_exists("session_company_code")){
    function session_company_code(){
        $Vnpr0xe0jkmu =& get_instance();
        return $Vnpr0xe0jkmu->session->userdata("session_company_code","");
    }
}
if(!function_exists("session_outlet")){
    function session_outlet(){
        $Vnpr0xe0jkmu =& get_instance();
        return $Vnpr0xe0jkmu->session->userdata("session_outlet","");
    }
}
if(!function_exists("date_diff2")){
    function date_diff2($Vpc1zha4cwn3,$Vqgqk1dzme2s){
        $V15dbrpajeabirst  = new DateTime( $Vpc1zha4cwn3 );
        $Vfa0ao3qzwifecond = new DateTime( $Vqgqk1dzme2s );

        $Vdgbiavfme2k = $V15dbrpajeabirst->diff( $Vfa0ao3qzwifecond );

        return $Vdgbiavfme2k->format( '%d' ); 
        
    }
}


}
?>