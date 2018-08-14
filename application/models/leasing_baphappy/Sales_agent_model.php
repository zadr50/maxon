<?php
class Sales_agent_model extends CI_Model {
	function __construct(){
		parent::__construct();
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
