<?
class Test_browse1 extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper('browse_helper');
	}
	function index()
	{
	   echo "
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
                <script src=\"".base_url()."js/jquery/jquery-1.8.0.min.js\"></script>                
                <script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
            ";
		
		$sql="select customer_number,company,phone,city,country,street from customers";
		echo browse_simple($sql);	
	}
 
}
