<?php if(!defined('BASEPATH'))exit('No direct script access allowed');
class Login extends CI_Controller {
 private $library_src='';
 private $script_head='';
 private $data; 
 function __construct()
 {
   parent::__construct();           
   $this->load->helper(array('url','form','mylib_helper'));
   $this->load->library('template');
   $this->load->model('user','',TRUE);
   $this->load->library('form_validation');
   $this->load->helper("language");
   $this->lang->load("common");
 	$this->load->model('user_model');

 }

 function index() {
	// cek file maxon_installed.php, if no content install maxon
	// maxon_installed.php should containt text after install	
	$filename="./application/config/maxon_installed.php";
	if(filesize($filename) == 0) {
		header("location:".base_url()."install");
		exit;
	}

	if(eshop_activated()){
		// e-commerce view when table maxon_apps contain 'eshop' text
		header("location:".base_url()."index.php/eshop/home");
		exit;
	}  
	
 	if(website_activated()){
		// website view when table maxon_apps contain _20000 text
		$login_view="login_view";
	} else {
		// default view
		$login_view="login_view_simple";
	}
    $submit_value=$this->input->post("submit");
	
    if($submit_value=="Change Password"){
        header("location:".base_url()."index.php/login/change_password"); 
    } else if($submit_value=="Create User"){
        header("location:".base_url()."index.php/login/create_user"); 
    } else if($submit_value=="Login" && $this->input->post("user_id") && $this->input->post("password")) {
	   if(!$company_code=$this->input->post('company'))$company_code="";	 
	   $multi_company=$this->config->item('multi_company');
	   if($multi_company){
	        $this->session->set_userdata("company_code",$company_code);
	   }             	
	   $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
	   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
	   $this->form_validation->set_message('check_database', "<strong>Unknown User or Password !</strong>");
	   if(!$this->form_validation->run()) {	   	
			$data["message"]=validation_errors();			
            $data['multi_company']=$this->config->item('multi_company');
	   }
	} 
	// default view
	if($this->access->is_login()){
	    
        $this->welcome();       
        
	} else {
		$this->load->model('article_model');
		$data['message']='';
		$data['article_cats']=$this->article_model->categories();
		$data['multi_company']=$this->config->item('multi_company');
        
        $data['warehouse_code']="";
        
		$this->template->display_login($login_view,$data);
	}
 }
 function simple(){
	$login_view="login_view_simple";
	$this->load->model('article_model');
	$data['message']='';
	$data['article_cats']=$this->article_model->categories();
	$this->template->display_login($login_view,$data);
} 
function verify_json(){
   if(!$company_code=$this->input->post('company'))$company_code="";
   $user_id = $this->input->post('user_id');
   $password = $this->input->post('password');
   $ok=$this->check_database($password);
   if($ok){
   		$message="Please wait...";
   } else  {
   		$message="User atau password salah !";
   }	
   echo json_encode(array("success"=>$ok,"message"=>$message));
}
function verify(){
  if(!$company_code=$this->input->post('company'))$company_code="";
 
   $multi_company=$this->config->item('multi_company');
   if($multi_company){
        $this->session->set_userdata("company_code",$company_code);
   }         
 	if(website_activated()){
		// website view when table maxon_apps contain _20000 text
		$login_view="login_view";
	} else {
		// default view
		$login_view="login_view_simple";
	}
    $submit_value=$this->input->post("submit");
    if($submit_value=="Change Password"){
        header("location:".base_url()."index.php/login/change_password"); 
    } else if($submit_value=="Create User"){
        header("location:".base_url()."index.php/login/create_user"); 
    } else {
	   //$this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
	   if($this->form_validation->run()) {
			//echo json_encode(array('success'=>true));
			//header("location:".base_url()."index.php");
			$this->index();	
	   } else {
	   		//echo json_encode(array('msg'=>'User atau password salah ! '.strip_tags(validation_errors())));
			$data["message"]="UserID atau Password salah !";			
            $data['multi_company']=$this->config->item('multi_company');
			$this->template->display_login("login_view_simple",$data);
	   }
   }
}
 
function create_user(){
    $data['message']='';
    $this->template->display("admin/user_new",$data);    
}
function add_user()
    {
        $ok=true;
        $data=$this->input->post();
        if($q=$this->db->where("user_id",$data["user_id"])->get("user")){
            if($q->num_rows()>0){
                $ok=false;
                $data['message']="Tidak bisa membuat user baru ! </br>Userid tersebut sudah ada !";
                $this->template->display("admin/user_new",$data);        
            }
        }
        if($ok) {
            if($ok=$this->db->insert("user",$data))header("location: ".base_url("index.php"));
        }  
}
    
function change_password(){
   $user_id = $this->input->post('user_id');
   if($this->input->post()){
       $password = $this->input->post('password');
       $password_new = $this->input->post('password_new');
       if($password_new==""){
            $data["message"]="Password baru tidak diiisi !";            
       } else {
           $result = $this->user->login($user_id, $password);
           if($result)  {
               $this->user->change_password($user_id,$password_new);
               header("location:".base_url("index.php"));
           } else {
                $data["message"]="UserID atau Password lama anda salah !";            
           }    
           
       }
   } else {
       $data["user_id"]=$user_id;       
       $data['message']='';
   }
   $this->template->display_login("login_change_pass",$data);
           
}
function welcome(){
	$data=$this->session->userdata('logged_in');
	$data['message']='welcome';
	$data['_content']='';
	$data['visible_right']='';
	$data['ajaxed']=false;
	$data['body_class']="bg1";
    $data['warehouse_code']='';
	$this->session->set_userdata('_left_menu_caption',"");
	$this->session->set_userdata('_left_menu', "");
	$this->session->set_userdata('_right_menu','');
    
    $view="welcome_message";
	
	$this->template->display_main($view,$data);
}
	
 function logout(){

	my_log("LOGOUT","");			
    
   $single_login=getvar("SingleLogin","");
   if($single_login==1){
    
        $user_id=user_id();
        $this->db->query("update `user` set logged_in=0,session_id='' where user_id='$user_id'");
    
    }
    $set=array('header_visible','_left_menu','_right_menu','logged_in',
        'dont_validate_journal','user_admin','company_code','nip','sidebar_position',
        'default_warehouse','default_warehouse_list','default_division',
        'default_division_list','min_date','max_date','_left_menu_caption',
        'logged_in','session_company_code','session_outlet');
    for($i=0;$i<count($set);$i++){
        $this->session->unset_userdata($set[$i]);
    }    
    $this->load->helper(array('form'));
    redirect(base_url());
 }
 function check_database($password)  {
   $password=urldecode($password);
   $user_id = $this->input->post('user_id');
   $warehouse_code=$this->input->post("warehouse_code");
   
   $this->load->model("periode_model");
   $this->periode_model->current_periode();
   $min_date=$this->periode_model->start_date();
   $max_date=$this->periode_model->end_date();
   $min_date="2018-01-01";
   $max_date="2018-12-01";
   
   $multi_company=$this->config->item('multi_company');
   if($multi_company){
       $company_code=$this->input->post("company");
       $this->session->set_userdata("company_code",$company_code);
   } else {
       $this->session->unset_userdata("company_code");
   }
   
   $result = $this->user->login($user_id, $password);
   
   if($result)  {
	 my_log("LOGIN","",$user_id);			
     $sess_array = array();
     foreach($result as $row) {
       $sess_array = (array)$row;
       unset($sess_array['password']);
       
       $this->session->set_userdata('logged_in', $sess_array);
	   
		// check if this user as admin for backend application ?
		$this->load->model("user_jobs_model");
		$user_admin=$this->user_jobs_model->is_job("ADM",$user_id);
		$this->session->set_userdata("user_admin",$user_admin);
        
        $default_warehouse=$warehouse_code;
        $this->session->set_userdata("session_outlet",$warehouse_code);
            if($q=$this->db->query("select company_name from shipping_locations 
                where location_number='$warehouse_code'")){
                if($r=$q->row()){
                    $company_code=$r->company_name;
                    $this->session->set_userdata("session_company_code",$company_code);
                }
            }
        
		// warehouse roles
		$default_warehouse_list=$this->user_model->roles_gudang($user_id);
		if(is_array($default_warehouse_list)){
			if(count($default_warehouse_list)==0){
				$default_warehouse="";
			} else if ( count($default_warehouse_list)==1 ) {
				$default_warehouse=$default_warehouse_list[0];
			} else {
				$default_warehouse="MULTI";
			}
		} else {
			$default_warehouse=$default_warehouse_list;	
		}
		$this->session->set_userdata("default_warehouse",$default_warehouse);
		$this->session->set_userdata("default_warehouse_list",$default_warehouse_list);
        
        
		// item division roles 
		$default_division_list=$this->user_model->roles_division($user_id);
		$default_division="";
		if(is_array($default_division_list)){
			if(count($default_division_list)==0){
				$default_division="";
			} else if ( count($default_division_list)==1 ) {
				$default_division=$default_division_list[0];
			} else {
				$default_division="MULTI";
			}
		} else {
			$default_division=$default_division_list;	
		}
		$this->session->set_userdata("default_division",$default_division);
		$this->session->set_userdata("default_division_list",$default_division_list);
        $this->session->set_userdata("min_date",$min_date);
        $this->session->set_userdata("max_date",$max_date);
        
        //$this->session->set_userdata("session_id",$this->session->userdata());
        
        
     }
     return true;
   } else {
     $this->form_validation->set_message('password', "Error user_id or password !");
     return false;
   }
 }
 
 
}

