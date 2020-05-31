<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Master extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template');;
		$this->load->model(array("inventory_model"));
	}
	function index()
	{	
		$data['message']='';
//		$this->template->display_form_input('welcome_message',$data,'');
	}
	function update_qty_all(){
		$s="UPDATE inventory
			INNER JOIN (
			select item_number,sum(qty_masuk)-sum(qty_keluar) as qty_saldo
			from qry_kartustock_union	group by item_number
			) q ON q.item_number = inventory.item_number
			SET inventory.quantity_in_stock=q.qty_saldo
			WHERE inventory.quantity_in_stock<>q.qty_saldo";
			
		$this->db->query($s);
		
		$s="select distinct item_number from qs_stock_unit order by item_number";
		if($q=$this->db->query($s)){
			foreach($q->result() as $r){
				$this->inventory_model->recalc_stock_unit($r->item_number);
				
			}
		}
		$data['content']="
		<script language='JavaScript'>
			remove_tab_parent();
		</script>
		";	
		$data['message']="<h1>Finish</h1>";
		$this->template->display("blank",$data);
	}
 
}