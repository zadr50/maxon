<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Test extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		echo $this->config->item('base_url');	
           echo " <h1>HALOO TEST</h1>";
            echo "<br>POST<br>";
            var_dump($_POST);
            echo "<br>GET<br>";
            var_dump($_GET);
            echo "<br>SESSION<br>";
            var_dump($_SESSION);
	}
 
}
