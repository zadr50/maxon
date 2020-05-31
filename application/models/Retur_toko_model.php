<?php
class Retur_toko_model extends CI_Model {
    
	function __construct(){
		parent::__construct();        
	 	$this->load->model(array("inventory_products_model"));
		  
	}
	function lookup($set=null){    
	    $set['dlgBindId']="retur_toko";
	    if(!$set['dlgRetFunc'])$set['dlgRetFunc']="
	        $('#shipment_id').val(row.shipment_id);
	    ";
	    $set['dlgCols']=array( 
	                array("fieldname"=>"shipment_id","caption"=>"Nomor Retur","width"=>"180px"),
	                array("fieldname"=>"date_received","caption"=>"Tanggal","width"=>"80px"),
	                array("fieldname"=>"supplier_number","caption"=>"Sumber","width"=>"50px"),
	                array("fieldname"=>"warehouse_code","caption"=>"Tujuan","width"=>"50px"),
	                array("fieldname"=>"doc_status","caption"=>"Status","width"=>"50px"),
	                array("fieldname"=>"doc_type","caption"=>"Type","width"=>"50px")
	    );          
	
	    return $this->list_of_values->render($set);
	}
	function replicate(){
		$this->inventory_products_model->replicate("ETC_OUT","retur_toko",2);
		
	}

}
?>