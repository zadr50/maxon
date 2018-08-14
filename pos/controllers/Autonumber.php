<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Autonumber extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
        
        $this->load->library('sysvar');
		if(!$this->access->is_login())redirect(base_url());
	}
	function index()
	{
            $kode=$this->input->get('q');
            if($kode){
                echo $this->sysvar->autonumber($kode);
                $this->sysvar->autonumber_inc($kode);
            }
	}
 
}
