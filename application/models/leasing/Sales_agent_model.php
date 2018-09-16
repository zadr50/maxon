<?php
class Sales_agent_model extends CI_Model {
	function __construct(){
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
	}
	function dropdown(){
		$ret=array();
		$ret['']='- Select -';
		$this->load->model('user_model');
		if($data=$this->user_model->list_user_by_group("SA")){
			foreach($data->result() as $row){
				$ret[$row->user_id]=$row->username;
			}
		}
		return $ret;
	}
	
}

?>
