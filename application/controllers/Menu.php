<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Menu extends CI_Controller {
   
	function __construct()
	{
		parent::__construct();        
         
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper','path_helper'));
        $this->load->library(array('sysvar','template'));
        $this->load->model(array("apps_model",'company_model'));     
	}
	function index(){
    }
	function load($m){
		
        if($m=="pos"){
        	
            redirect(base_url("pos.php"));
            
        } else {
        	
        	if($com=$this->company_model->get_by_id($this->access->cid)){
	            if($company=$com->row()){
		            $data['company_name']=$company->company_name;
		            $data['street']=$company->street;
		            $data['suite']=$company->street;
		            $data['city_state_zip_code']=$company->city_state_zip_code;
		            $data['phone_number']=$company->phone_number;
	            } else {
	            	$data['company_name']="";
					$data['street']="";
					$data['suite']="";
					$data['city_state_zip_code']="";
					$data['phone_number']="";
	            }        		
        	}
			
            $data['default_warehouse']=$this->session->userdata("default_warehouse");
            $url=$m.'/menu';

			$table_model=APPPATH.'models/'. $m . '/Table_model.php';
			if ( file_exists($table_model)){
				$this->load->model($m . '/table_model');
				$this->table_model->check_tables();
			}
			
            $this->session->set_userdata('_left_menu_caption',$m);
            $this->session->set_userdata('_left_menu', $url);
            $this->session->set_userdata('_right_menu','');
			
            if(is_ajax()){
            	
                $url.="_dashboard";
                $this->load->view($url);
				
            } else {
            	
                $data['_content']=$url;
                $data['ajaxed']=false;
                $ok=true;
                
                if($url=="admin/menu"){
                   $ok=allow_mod2('_00010');
                }

                if($ok) {
                	
					if ($m=="resto"){
				 		$data['username']=$this->session->userdata("user_name","Guest");
						$data['url_search']="index.php/resto/search";
						$data['url_dashboard']='menu/load/resto';
						$this->load->view("resto/home",$data);
					} else {
						
	                	$this->template->display_main($url,$data);
					}
				}
				
				
            }
            
        }
	}
}
