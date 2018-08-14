<?php if(!defined('BASEPATH'))exit('No direct script access allowed');
class Login extends CI_Controller {
 private $library_src='';
 private $script_head='';
 private $data; 
 function __construct()
 {
   parent::__construct();        
      
    $this->load->library('template');
    $this->load->helper(array('url','form','mylib_helper'));
   $this->load->model('user','',TRUE);
   $this->load->library('form_validation');
   $this->load->helper("language");
   $this->lang->load("common");

 }

 function index() {
	// default view
	if($this->access->is_login()){
		$this->welcome();		
	} else {
	    $this->simple();
	}	
 }
 function simple(){
	$login_view="login_view_simple";
	$data['message']='';
	$this->template->display_login($login_view,$data);
} 
function verify(){
       $login_view="login_view_simple";
       $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
       if($this->form_validation->run()) {
    		header("location:".base_url()."pos.php");	
       } else {
       		//echo json_encode(array('msg'=>'User atau password salah ! '.strip_tags(validation_errors())));
            $data["message"]="UserID atau Password salah !";			
            $this->template->display_login("login_view_simple",$data);
       }
}
function welcome(){
    $this->load->library('list_of_values');
	$data=$this->session->userdata('logged_in');
	$data['message']='welcome';
	$data['_content']='';
    $data['header_show']=false;
    $data['sidebar_show']=false;
    
    $this->load->model('company_model');
    $company=$this->company_model->get_by_id($this->access->cid)->row();
    $data['company_name']=$company->company_name;
    $data['street']=$company->street;
    $data['suite']=$company->street;
    $data['city_state_zip_code']=$company->city_state_zip_code;
    $data['phone_number']=$company->phone_number;
    $data['default_warehouse']=$this->session->userdata("default_warehouse");
    
    //loookup custommers    
    $set_cust['dlgBindId']="customers";
    $set_cust['dlgCols']=array( 
        array("fieldname"=>"customer_number","caption"=>"Kode","width"=>"150px"),
        array("fieldname"=>"company","caption"=>"Customer","width"=>"200px"),
        array("fieldname"=>"city","caption"=>"Kota","width"=>"200px"),
        array("fieldname"=>"phone","caption"=>"Phone","width"=>"200px")
    );
    $set_cust['dlgRetFunc']="$('#cust').html(row.customer_number);
        $('#cust_name').html(row.company);";
    $data['lov_customers']= $this->list_of_values->render($set_cust);
    //lookup barang
    $set_item['dlgBindId']="inventory";
    $set_item['dlgCols']=array( 
        array("fieldname"=>"item_number","caption"=>"Kode","width"=>"150px"),
        array("fieldname"=>"description","caption"=>"Nama Barang","width"=>"200px"),
        array("fieldname"=>"category","caption"=>"Category","width"=>"100px"),
        array("fieldname"=>"retail","caption"=>"Price","width"=>"100px")
            );
    $set_item['dlgRetFunc']="$('#barcode').val(row.item_number);find_barcode();";
    $data['lov_inventory']=$this->list_of_values->render($set_item);
    $data['pembulatan']=getvar("pembulatan",0);
    
	$this->template->display_main('menu_dashboard',$data);
}
	
 function logout(){
	my_log("LOGOUT","");			
 	$this->session->set_userdata('_left_menu','');
    $this->session->set_userdata('_right_menu','');	
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('user_admin');
    $this->session->unset_userdata('set_tanggal');
    redirect(base_url('pos.php'));
 }
 function check_database($password)  {
   $password=urldecode($password);
   $user_id = $this->input->post('user_id');
   $warehouse_code=$this->input->post("warehouse_code");

   $result = $this->user->login($user_id, $password);

   $multi_company=$this->config->item('multi_company');        
   
   
   if($multi_company){
       $company_code=$this->input->post("company");
       $this->session->set_userdata("company_code",$company_code);
       
   } else {
       $this->session->unset_userdata("company_code");
   }
   

   if ( !$result )  {
         $this->form_validation->set_message('check_database', lang('login_error'));
         return false;
    } else {
	 my_log("LOGIN","",$user_id);			
     $sess_array = array();
     foreach($result as $row) {
       $sess_array = array(
         'user_id' => $row->user_id,
         'username' => $row->username,
         'cid'=>$row->cid,
		 'flag1'=>$row->flag1,
		 'flag2'=>$row->flag2,
		 'flag3'=>$row->flag3		 
       );
       $this->session->set_userdata('logged_in', $sess_array);
		// check if this user as admin for backend application ?
		$this->load->model("user_jobs_model");
		$user_admin=$this->user_jobs_model->is_job("ADM",$user_id);
		$this->session->set_userdata("user_admin",$user_admin);
		// warehouse roles
		$default_warehouse_list=$this->user_model->roles_gudang($user_id);
        $default_warehouse=$warehouse_code;
   
        
        $this->session->set_userdata("session_outlet",$warehouse_code);
        if($q=$this->db->query("select company_name from shipping_locations 
            where location_number='$warehouse_code'")){
            if($r=$q->row()){
                $company_code=$r->company_name;
                $this->session->set_userdata("session_company_code",$company_code);
            }
        }
    
        
        
        
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
     }
     return true;
   } 
 }
 
 
}

