<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Themes extends CI_Controller {
    private $file_view='template/themes';
    private $controller='admin/themes';
    private $sql="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		
    }
    function index()    {	
		$data['themes_name']=$this->sysvar->getvar('themes','standard');
		$data['themes_create_by']='Andri';
		$data['themes_version']='1.1';
		$data['themes_list'][]=array("name"=>"standard","version"=>"1.1","create_by"=>"Andri",
			"description"=>"Standard template themes");
		$data['themes_list'][]=array("name"=>"green","version"=>"1.1","create_by"=>"Andri",
			"description"=>"Green template themes");
		$data['themes_list'][]=array("name"=>"metro","version"=>"1.1","create_by"=>"Andri",
			"description"=>"Metro template themes");
		$data['themes_list'][]=array("name"=>"black","version"=>"1.1","create_by"=>"Andri",
			"description"=>"Black template themes");
		$data['themes_list'][]=array("name"=>"bootstrap","version"=>"1.1","create_by"=>"Andri",
			"description"=>"Bootstrap template themes");
		$data['themes_list'][]=array("name"=>"gray","version"=>"1.1","create_by"=>"Andri",
			"description"=>"Gray template themes");
		$data['themes_list'][]=array("name"=>"admin","version"=>"1.1","create_by"=>"Andri",
			"description"=>"Admin template themes");
		$this->template->display_form_input($this->file_view,$data);			
    }
	function save($themes){
		$ok=$this->sysvar->save("themes",$themes);
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
		header("location: ".base_url()."index.php");
	}	
}
?>
