<?
class Form_builder_test extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
		$this->load->helper('form');
		$this->load->library('form_builder');		
		$this->load->library("template");
	}
	function index()
	{
		$this->template->display("test/form_builder.php");
	}
 
}
