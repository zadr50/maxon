<?php class Frontend_eshop extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
	redirect("eshop/home"); 
 }
}

?>

