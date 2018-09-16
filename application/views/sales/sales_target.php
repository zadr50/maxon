<div class="thumbnail">
<p>Silahkan isi formulir ini untuk target penjualan salesman <strong>[<?=$salesman?>]</strong></p>	
<?php
$ci =& get_instance();        
$ci->load->library("crud");
echo $ci->crud->render(array(
	"cr_table"=>"salesman_target",
	"cr_show_box"=>false,
	"cr_default_value"=>array("period_id"=>date("Y-m"),"salesman_id"=>$salesman))
);


?>	
</div>	