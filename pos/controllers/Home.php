
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

 function __construct()
 {
   parent::__construct();        
        
 }

 function index()
 {
   if($this->session->userdata('logged_in'))
   {
        $this->load->model("company_model");
        $this->load->model("shipping_locations_model");
    
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $data['company_code']=$this->session->userdata('session_company_code','');
        if($data['company_code']=="")$data['company_code']=$this->access->cid();
        //$data['company_list']=$this->company_model->datalist();
        $data['shipping_location']=$this->session->userdata('session_outlet','');
        if($data['shipping_location']=="")$data['shipping_location']=$this->session->userdata('default_warehouse','');
        $data['shipping_location_list']=$this->shipping_locations_model->select_list();
     
        $this->load->view('home_view', $data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }

}

?>

