<?php class Eshop_admin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
	redirect("eshop_admin_mv/admin/dashboard"); 
 }
}

?>

