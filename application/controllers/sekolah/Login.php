<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Login extends CI_Controller {
	
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('tpl/website/template');
	   $this->load->model('user','',TRUE);
       $this->load->model('user_model');
	}
	function index() {	
		$data['message']='';
		$this->template->display('sekolah/login',$data);
	} 
	
	function verify(){
	  if(!$company_code=$this->input->post('company'))$company_code="";
	 
	   $multi_company=$this->config->item('multi_company');
	   if($multi_company){
	        $this->session->set_userdata("company_code",$company_code);
	   }         
		$login_view="sekolah/login";
	    $submit_value=$this->input->post("submit");
	    if($submit_value=="Change Password"){
	        header("location:".base_url()."index.php/login/change_password"); 
	    } else if($submit_value=="Create User"){
	        header("location:".base_url()."index.php/login/create_user"); 
	    } else {
		   //$this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
		   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		   if($this->form_validation->run()) {
				header("location:".base_url()."index.php");	
		   } else {
		   		//echo json_encode(array('msg'=>'User atau password salah ! '.strip_tags(validation_errors())));
				$data["message"]="UserID atau Password salah !";			
	            $data['multi_company']=$this->config->item('multi_company');
				$this->template->display("sekolah/login",$data);
		   }
	   }
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
	        'logged_in','session_company_code','session_outlet','hide_menu_header',
			'global_module');
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
		$this->session->set_userdata("hide_menu_header",true);
		$this->session->set_userdata("global_module","sekolah");
     }
     return true;
   } else {
     $this->form_validation->set_message('check_database', lang('login_error'));
     return false;
   }
 }
 

}  