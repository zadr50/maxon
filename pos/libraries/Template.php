<?php
class Template {
 protected $_ci;
 private $library_src='';
 private $script_head='';
 private $bootstrap_only='';
 private $jquery_easyui='';
 private $bootstrap='';
 private $flexslider='';
 function _cjs($s,$l=true){
	 return $this->_ci->jquery->script(base_url().$s,$l);
 }
 function __construct()
 {
    $this->_ci =&get_instance();
        
    
    $this->_ci->load->library(array('javascript',"sysvar","upgrade"));
    $this->_ci->load->model("bank_accounts_model");
    
	$this->_ci->upgrade->process();
	$themes=$this->_ci->sysvar->getvar('themes','standard');
	if($themes==""){
		$themes="standard";
	}
	$base=base_url();
	$this->bootstrap='
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.5/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'themes/'.$themes.'/style.css">
	';
	$this->bootstrap_only ="<link rel='stylesheet' type='text/css' href='".base_url()."assets/bootstrap-3.3.5/css/bootstrap.css'>";
	$this->bootstrap_only.=$this->_cjs('assets/jquery/jquery-1.11.3.min.js',true);
    $this->bootstrap_only.=$this->_cjs('assets/bootstrap-3.3.5/js/bootstrap.min.js',true);
    $this->bootstrap_only.=$this->_cjs('js/lib.js',true);
	
	$this->library_src =$this->_cjs('assets/jquery/jquery-1.11.3.min.js',true);
    $this->library_src.=$this->_cjs('assets/bootstrap-3.3.5/js/bootstrap.min.js',true);
    $this->library_src.=$this->_cjs('assets/datepicker/bootstrap-datepicker.js',true);
    $this->library_src.=$this->_cjs('assets/jquery-easyui-1.4.3/jquery.easyui.min.js',true);
    //$this->library_src.=$this->_cjs('assets/jquery-easyui-1.4.3/jquery.easyui.mobile.js',true);
    $this->library_src.=$this->_cjs('js/autocomplete/jquery.autocomplete.min.js',true);
    $this->library_src.=$this->_cjs('js/lib.js',true);
    $this->library_src.=$this->_cjs('js/jquery.formatNumber.js',true);
    $this->library_src.=$this->_cjs('assets/flexslider/jquery.flexslider.js',true);
    $this->library_src.=$this->_cjs('js/lib_error.js',true);
	
    $this->flexslider=$this->_cjs('assets/flexslider/jquery.flexslider.js',true);
	
  /// $this->script_head=$this->_ci->jquery->_compile();
	$this->script_head='
	
	<link rel="stylesheet" type="text/css" href="'.base_url().'js/autocomplete/jquery.autocomplete.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/jquery-easyui-1.4.3/themes/'.$themes.'/easyui.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/jquery-easyui-1.4.3/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'themes/'.$themes.'/style.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/datepicker/datepicker.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/bootstrap-3.3.5/css/bootstrap.min.css">
	
	';
//	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/jquery-easyui-1.4.3/themes/mobile.css">
//	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/flexslider/flexslider.css">
	
	$this->jquery_easyui='
 	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/jquery-easyui-1.4.3/themes/'.$themes.'/easyui.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/jquery-easyui-1.4.3/themes/icon.css">
	<script type="text/javascript" charset="utf-8" src="'.base_url().'asset/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="'.base_url().'assets/jquery-easyui-1.4.3/jquery.easyui.min.js"></script>
	';

}
function display_main($template="",$data=null){
	if($template=="")$template='blank';
	$data['library_src']=$this->library_src;
	$data['script_head']=$this->script_head;
	$data['body_class']='bg1';
	$data['user_id']=$this->_ci->access->user_id();
	$header_visible=$this->_ci->session->userdata('header_visible');
    
    $data['company_code']=$this->_ci->session->userdata('session_company_code','');
    if($data['company_code']=="")$data['company_code']=$this->_ci->access->cid();
    
    $this->_ci->load->model("company_model");
    $data['company_list']=$this->_ci->company_model->datalist();
    $data["company_name"]=$this->_ci->company_model->company_name($data['company_code']);
    
    $this->_ci->load->model("shipping_locations_model");
    $data['shipping_location']=$this->_ci->session->userdata('session_outlet','');
    if($data['shipping_location']=="")$data['shipping_location']=$this->_ci->session->userdata('default_warehouse','');
    $data['shipping_location_list']=$this->_ci->shipping_locations_model->select_list();
    if($qgdg=$this->_ci->shipping_locations_model->get_by_id($data["shipping_location"])){
        if($rgdg=$qgdg->row()){
            $data["nama_toko"]=$rgdg->attention_name;
            $data['alamat']=$rgdg->street;
            $data["telp"]=$rgdg->phone;
            $data["kota"]=$rgdg->city;
        }        
    }
    if(!isset($data["nama_toko"])){
        $data["nama_toko"]=$data["company_name"];
    }
    
    if($data["nama_toko"]=="")$data["nama_toko"]=$data["company_name"];    
    
	if($header_visible=="false"){
		$data['_header']='';
		$data['header_show']=false;
	} else {
		$data['_header']=$this->_ci->load->view('template/standard/header',$data, true);
	}
	
	
	$data['_footer']=$this->_ci->load->view('template/standard/footer',$data, true);
	
 
			$data["sidebar_show"]=false;
			$data['hide_menu_header']=true;
    
	$data['_content']=$this->_ci->load->view($template,$data, true);
	   			
	$this->_ci->load->view('template/standard/template',$data);              		
}
 function display($template,$data=null)
 {

		
	if($template=="")$template='blank';
	  $data['body_class']='';
	 if(!$this->is_ajax())
	 {
		$data['user_id']=$this->_ci->access->user_id();
	  	$data['library_src']=$this->library_src;
	  	$data['script_head']=$this->script_head;
		if(!isset($data['ajaxed']))$data['ajaxed']=true;
		$header_visible=$this->_ci->session->userdata('header_visible');
		if($header_visible){
			$data['_header']='';
		} else {
			$data['_header']=$this->_ci->load->view('template/standard/header',$data, true);
		}
		
		$data['_footer']=$this->_ci->load->view('template/standard/footer',$data, true);

		$sql="select distinct controller,method,param1 from sys_log_run where user_id='".$this->_ci->access->user_id()."' order by id desc limit 10 ";
		$url=base_url()."/pos.php/".$template;

		add_log_run($url);
		$data['sys_log_run']=view_syslog();

		if($template=="pos/menu")$data['sidebar_show']=false;

		if(isset($data['_right_menu'])){
			$fm=$data['_right_menu'];
			$data['_right_menu']=$this->_ci->load->view($fm,$data, true);
		} else {
			$data['_right_menu']='';
		}				
		
		$fm=$this->_ci->session->userdata('_right_menu');
		if($fm!=''){	
			$data['_right_menu']=$this->_ci->load->view($fm,$data, true);
		}
		$fm=$this->_ci->session->userdata('_left_menu');
		if($fm!='') {
			//echo $fm;
			$data['_left_menu']=$this->_ci->load->view($fm,$data, true);
		}
		$data['_left_menu_caption']=$this->_ci->session->userdata('_left_menu_caption');

		if($template==$fm){
			
			if($template=="pos/menu"){
				$data["sidebar_show"]=false;
				$data["header_show"]=false;
				$data['hide_menu_header']=true;				
			}
			
			$dashboard=$fm."_dashboard";

			if(file_exists(APPPATH."views/$dashboard.php")){
				$data['body_class']='';
				$data['_content']=$this->_ci->load->view($dashboard,$data, true);						
			} else {
				$data['_content']="Dashboard view not found! <br>".$dashboard;
			}
		} else {
			if($template=="welcome_message"){
				$data["sidebar_show"]=false;
				$data['body_class']='';
				$data['hide_menu_header']=true;
			}  
			$data['_content']=$this->_ci->load->view($template,$data, true);
		} 			
		if($data['_right_menu']=='')$data['sidebar_show']=false;
		
		$this->_ci->load->view('template/standard/template',$data);              
	 } else  {
		$data['google_ads_visible']=$this->_ci->sysvar->getvar('google_ads_visible','true');
		$this->_ci->load->view($template,$data);
	 }
 }
 function display_single($template,$data=null) {
  	$data['library_src']=$this->library_src;
  	$data['script_head']=$this->script_head;
	if($template=="")$template='blank';
	$this->_ci->load->view($template,$data);
 }
 function display_website($template,$data=null){
  	$data['library_src']=$this->library_src;
  	$data['script_head']=$this->script_head;
	$data['file_content']=$template;	
	$this->_ci->load->view("template/standard/template_articles",$data);	
 }
  function display_login($template,$data=null) {
	$library_src='
		<script type="text/javascript" charset="utf-8" 
		src="'.base_url().'assets/jquery/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" charset="utf-8" 
		src="'.base_url().'assets/jquery-easyui-1.4.3/jquery.easyui.min.js"></script>
	';
	
	$script_head='
	<link rel="stylesheet" type="text/css" href="'.base_url().'assets/bootstrap-3.3.5/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="'.base_url().'themes/standard/style.css">
	';
//  $data['library_src']=$library_src;
// 	$data['script_head']=$script_head;

  	$data['library_src']=$this->library_src;
  	$data['script_head']=$this->script_head;
		
	$this->_ci->load->view($template,$data);
 }

 function display_form_input($template,$data=null,$template_right=null)
 {
  	$data['library_src']=$this->library_src;
  	$data['script_head']=$this->script_head;
 	$data['jquery_easyui']=$this->jquery_easyui;
	$data['ajaxed']=true;
    
	if(!$this->is_ajax()) {	
        $this->display($template,$data);
	} else {
		 $this->_ci->load->view($template,$data);
	}
 }
 function display_browse2($data=null){
		$data['body_class']='panel-body';
        $data['library_src']=$this->library_src;
        $data['script_head']=$this->script_head;
		$data['print_visible']=true;
		if(isset($data['view_mode'])){
			$view_mode=$data['view_mode'];
		} else {
			$view_mode="";
		}
		if($view_mode<>""){
			$this->_ci->load->view('/'.$view_mode,$data);	
		} else {
			$this->_ci->load->view('template/standard/template_browse',$data);				
		}
 }
 function display_browse($data=null)
 {
 	$data['jquery_easyui']=$this->jquery_easyui;
    $this->display_browse2($data);
 }
 function display_browse2_old($data)
 {
     $data['search']='';
     if(isset($_GET['search']))$data['search']=$_GET['search'];
     $data['message']='Ready';
 	 $data['jquery_easyui']=$this->jquery_easyui;
  
	 if(!$this->is_ajax())
	 {
        $data['library_src']=$this->library_src;
        $data['script_head']=$this->script_head;
		$data['_header']=$this->_ci->load->view('template/standard/header',$data, true);
		$data['_content']=$this->_ci->load->view('template/standard/template_browse',$data, true);
		$data['_footer']=$this->_ci->load->view('template/standard/footer',$data, true);
		$data['sys_log_run']=syslog();		
		$data['body_class']='body-child';
		$this->_ci->load->view('template/standard/template',$data);
	 } 	 else 	 {
        $data['library_src']=$this->library_src;
        $data['script_head']=$this->script_head;
		
	    $this->_ci->load->view('template/standard/template_browse',$data);
	 }
 }
 function display_table($data=null) {
    $data['message']='Ready';
	  
	 if(!$this->is_ajax())
	 {	
	  	$data['library_src']=$this->library_src;
	  	$data['script_head']=$this->script_head;
        $data['_left_menu']='';
		if(isset($data['_right_menu'])){
			$fm=$data['_right_menu'];
			$data['_right_menu']=$this->_ci->load->view($fm,$data, true);
		} else {
		   $data['_right_menu']='';
		}				
    	$fm=$this->_ci->session->userdata('_right_menu');
        if($fm!='')$data['_right_menu']=$this->_ci->load->view($fm,$data, true);
		$data['_header']=$this->_ci->load->view('template/standard/header',$data, true);
		$data['_footer']=$this->_ci->load->view('template/standard/footer',$data, true);
		$this->_ci->load->view('template/standard/browse',$data);              
	 } else {
		 $this->_ci->load->view($template,$data);
	 }
 }
 function print_out($template,$data=null){
    $this->_ci->load->view('simple_print.php',$data);
 }
 function is_ajax()
 {
 	return (
	 $this->_ci->input->server('HTTP_X_REQUESTED_WITH')&&
	 ($this->_ci->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
 }
function template_table($class='hor-minimalist-b'){
$tmpl = array (
            'table_open'          => '<table class="'.$class.'" border="0" cellpadding="4" cellspacing="0">',

            'heading_row_start'   => '<tr>',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr>',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<tr>',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
      );
        return $tmpl;

}
function browse_sql($sql){
	$data['message']='';
    $data['library_src']=$this->library_src;
    $data['script_head']=$this->script_head;
 	$fm=$this->_ci->session->userdata('_left_menu');
    $data['_left_menu']=$fm==''?'':$this->_ci->load->view($fm,$data, true);
 	$fm=$this->_ci->session->userdata('_right_menu');
    $data['_right_menu']=$fm==''?'':$this->_ci->load->view($fm,$data, true);
	$data['_header']=$this->_ci->load->view('template/standard/header',$data, true);
	$data['_footer']=$this->_ci->load->view('template/standard/footer',$data, true);
	$data['_content']=browse_simple($sql);
	$this->_ci->load->view('template/standard/template.php',$data);
}

 function pos($template,$data=null)
 {
	  	$data['library_src']=$this->library_src;
	  	$data['script_head']=$this->script_head;
		$data['_header']=$this->_ci->load->view('template/pos/header',$data, true);
		$data['_footer']=$this->_ci->load->view('template/pos/footer',$data, true);
		$this->_ci->load->view('template/pos/template',$data);              
	 
 }
 
 
}
