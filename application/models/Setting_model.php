<?php 
class Setting_model extends CI_Model {
		
	private $dataset=null;
	
	function __construct(){
		parent::__construct();        
		$this->load->model(array("company_model"));
	}
	function vars($varname){
		if(!$this->dataset){
			
			// load setting from table preferences
			$cid=cid();
			if($q=$this->company_model->get_by_id($cid)){
				
				if($r=$q->row()){
					$dataset=(array)$r;
				}
			}
			
			
		}
		// load seting from system_variables
		if ( !isset($dataset[$varname])){
			$dataset[$varname]=getvar($varname);
		}
		
		return $dataset[$varname];
	}


}

