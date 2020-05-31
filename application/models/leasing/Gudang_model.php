<?php
class Gudang_model extends CI_Model {
	private $_gudang="";
	private $_user_id="";
	private $_app_id="";
	private $_item_no="";
	private $_app_master_items=null;
	private $_error_message="";
	private $_arMutasi=null;
	private $_nomor_po="",$_nomor_trx="",$_nomor_so;
	private $_customer_number="",$_supplier_number="";
	
	function __construct(){
		parent::__construct();        
		$this->load->model("leasing/app_master_model");
	}
	function notify_warehouse($app_id){
		$this->load->model("customer_model");
		$this->load->model("supplier_model");
		$this->_app_id = $app_id;
		$this->_user_id = user_id();
		$this->_gudang=$this->access->current_gudang();
		$this->_app_master=$this->app_master_model->get_by_id($app_id)->row();
		$this->_app_master_items=$this->app_master_model->get_items();
		$this->_customer_number=$this->_app_master->cust_id;
		if(!$this->customer_model->exist($this->_app_master->cust_id)){
			$this->customer_model->convert_from_ls_cust_master($this->_customer_number);
		};
		$this->_supplier_number="";
		$item=$this->_app_master_items->row()->obj_id;
		$s="select supplier_number from inventory where item_number='$item'";
		$this->_supplier_number=$this->db->query($s)->row()->supplier_number;
		
		return true;
	}
	function qty_available(){
		$this->load->model("inventory_model");
		$is_qty_ok=true;
		
		foreach($this->_app_master_items->result() as $item){
			if($is_qty_ok==true){
				$qty_stock=$this->inventory_model->get_qty_gudang($item->obj_id,$this->_gudang);
				if($qty_stock < $item->qty ){
					//stock gak cukup
					$this->_error_message.="<p>Qty tidak cukup ! ItemNo: ".$item->obj_id.", 
					QtySaatIni: ".$qty_stock.", Gudang: ".$this->_gudang."</p>";
					
					//echo $this->_error_message;
					
					return false;
				}
				
			}
		}
		return true;
	}
	function displayError(){
		echo $this->_error_message;
	}
	function create_sales_order(){
		$this->load->model("sales_order_model");
		$nomor_so=$this->sales_order_model->nomor_bukti();
		$customer=$this->_app_master->cust_id;
		$data=array("sales_order_number"=>$nomor_so,
			"sales_date"=>Date("Y-m-d H:i:s"),"delivered"=>0,
			"type_of_invoice"=>"Simple",
			"sold_to_customer"=>$customer,
			"ship_to_customer"=>$customer,
			"source_of_order"=>$this->_app_id,
			"payment_terms"=>"KREDIT",
			"salesman"=>$this->_user_id,
			"currency_code"=>"IDR",
			"currency_rate"=>1,
			"warehouse_code"=>$this->_gudang,
			"due_date"=>Date("Y-m-d H:i:s"));
		if($this->sales_order_model->save($data)){
			$this->sales_order_model->nomor_bukti(true);
			foreach($this->_app_master_items->result() as $item){
				$this->sales_order_model->add_item(
					$nomor_so,$item->obj_id,
					$item->qty);
			}
			$this->_nomor_so=$nomor_so;
		} else {
			$this->_error_message.="<br>Unable register new sales order.<br>";
		}
	}
	function create_delivery_order(){
		$this->load->model("invoice_model");
		$nomor=$this->invoice_model->nomor_bukti_do();
		$customer=$this->_app_master->cust_id;
		$data=array("invoice_number"=>$nomor,
			"invoice_date"=>Date("Y-m-d H:i:s"),"your_order__"=>$this->_app_id,
			"type_of_invoice"=>"Simple","sales_order_number"=>$this->_nomor_so,
			"invoice_type"=>"D",
			"sold_to_customer"=>$customer,
			"ship_to_customer"=>$customer,
			"payment_terms"=>"KREDIT",
			"salesman"=>$this->_user_id,
			"currency_code"=>"IDR",
			"currency_rate"=>1,
			"warehouse_code"=>$this->_gudang,
			"due_date"=>Date("Y-m-d H:i:s"));
		if($this->invoice_model->save($data)){
			$this->invoice_model->nomor_bukti_do(true);
			foreach($this->_app_master_items->result() as $item){
				$this->invoice_model->add_item(
					$nomor,$item->obj_id,
					$item->qty);
			}
		} else {
			$this->_error_message.="<br>Unable register new invoice.<br>";
		}
		
	}
	function load_qty_gudang($item_no){
		$rstGudang=$this->db->get("shipping_locations");
		foreach($rstGudang->result() as $gdg){
			$qty = $this->inventory_model->get_qty_gudang(
				$item_no,$gdg->location_number);
			$arrQtyGdg[]=array("item_no"=>$item_no,
				"gudang"=>$gdg->location_number,"qty"=>$qty,
				"qty_used"=>0);
		}
		return $arrQtyGdg;
	}
	function qty_on_other_gudang(){
		foreach($this->_app_master_items->result() as $item){
			$qty=$item->qty;
			$item_no=$item->obj_id;
			$arrQtyGdg=$this->load_qty_gudang($item_no);	
			//echo "--before";
			//var_dump($arrQtyGdg);
			for($i=0;$i<count($arrQtyGdg);$i++){
				if($arrQtyGdg[$i]["item_no"]==$item_no && $arrQtyGdg[$i]["qty"]>=$qty){
					$arrQtyGdg[$i]["qty_used"]=$arrQtyGdg[$i]["qty_used"]+$qty;
					$arrQtyGdg[$i]["qty"]=$arrQtyGdg[$i]["qty"]-$arrQtyGdg[$i]["qty_used"];				
					$qty=$qty-$arrQtyGdg[$i]["qty_used"];
					//echo "--while";
					//var_dump($arrQtyGdg);
				}
				if($qty<0) exit;
			}
			//echo "--after";
			//var_dump($arrQtyGdg);
			$this->_arMutasi=$arrQtyGdg;
		}
		for($i=0;$i<count($arrQtyGdg);$i++){
			if($arrQtyGdg[$i]["qty_used"]>0){
				return true;
			}
		}
		return false;
	}
	function create_transfer_item(){
		if($this->_arMutasi == null) {
			$this->_error_message.="<br>_arMutasi is null<br>";
			//echo $this->_error_message;
			//exit;
			return;
		}
		$this->load->model("inventory_moving_model");
		$nomor=$this->inventory_moving_model->nomor_bukti();
		$this->inventory_moving_model->nomor_bukti(true);
		for($i=0;$i<count($this->_arMutasi);$i++){
			$cost=0;
			$amount=0;
			$unit="Pcs";
			if($this->_arMutasi[$i]["qty_used"] > 0 ) {
				$data=array("transfer_id"=>$nomor,"date_trans"=>Date("Y-m-d H:i:s"),
					"item_number"=>$this->_arMutasi[$i]['item_no'],
					"from_location"=>$this->_arMutasi[$i]['gudang'],
					"to_location"=>$this->_gudang,"comments"=>$this->_app_id,
					"from_qty"=>$this->_arMutasi[$i]['qty_used'],
					"to_qty"=>$this->_arMutasi[$i]['qty_used'],
					"trans_by"=>$this->_user_id,
					"cost"=>$cost,"trans_type"=>"Mutasi","total_amount"=>$amount,
					"unit"=>$unit,"status"=>0);
				
				//echo "<br>create_transfer_item().item $nomor ".$this._arMutasi[$i]['item_number'];
				$this->inventory_moving_model->add_item($data);
			}
		}
		$this->_nomor_trx=$nomor;
	}
	function create_sales_order_from_transfer(){
		$this->load->model("sales_order_model");
		$this->load->model("inventory_moving_model");
		$this->load->model("customer_model");
		$rsIm=$this->inventory_model->get_by_id($this->_nomor_trx);
		$nomor_so=$this->sales_order_model->nomor_bukti();
		$this->_nomor_so=$nomor_so;
		$customer=$this->_customer_number;
		$this->_app_master->cust_id;
		
		$data=array("sales_order_number"=>$nomor_so,"your_order__"=>$this->_app_id,
			"sales_date"=>Date("Y-m-d H:i:s"),"delivered"=>0,
			"type_of_invoice"=>"Simple",
			"sold_to_customer"=>$customer,
			"ship_to_customer"=>$customer,
			"source_of_order"=>"Leasing",
			"payment_terms"=>"KREDIT",
			"salesman"=>$this->_user_id,
			"currency_code"=>"IDR",
			"currency_rate"=>1,
			"warehouse_code"=>$this->_gudang,
			"due_date"=>Date("Y-m-d H:i:s"));
		//echo "<br>create_sales_order_from_transfer() $nomor";
		if($this->sales_order_model->save($data)){
			$this->sales_order_model->nomor_bukti(true);
			foreach($rsIm->result() as $item){
				$this->sales_order_model->add_item(
					$nomor_so,$item->item_number,
					$item->$from_qty);
				//echo "<br>create_sales_order_from_transfer().item $nomor, $item->item_number";
			}
		} else {
			$this->_error_message.="<br>Unable register new sales order.<br>";
		}
	}
	function create_delivery_order_from_transfer(){
		$this->load->model("inventory_moving_model");
		$this->load->model("invoice_model");
		$nomor=$this->invoice_model->nomor_bukti_do();
		$customer=$this->_customer_number;
		$rsIm=$this->inventory_model->get_by_id($this->_nomor_trx);
		$data=array("invoice_number"=>$nomor,"your_order__"=>$this->_app_id,
			"invoice_date"=>Date("Y-m-d H:i:s"),"sales_order_number"=>$this->_nomor_so,
			"type_of_invoice"=>"Simple",
			"invoice_type"=>"D",
			"sold_to_customer"=>$customer,
			"ship_to_customer"=>$customer,
			"payment_terms"=>"KREDIT",
			"salesman"=>$this->_user_id,
			"currency_code"=>"IDR",
			"currency_rate"=>1,
			"warehouse_code"=>$this->_gudang,
			"due_date"=>Date("Y-m-d H:i:s"));
		//echo "<br>create_delivery_order_from_transfer() $nomor";
		if($this->invoice_model->save($data)){
			$this->invoice_model->nomor_bukti_do(true);
			foreach($rsIm->result() as $item){
				$this->invoice_model->add_item(
					$nomor,$item->item_number,
					$item->$from_qty);
				//echo "<br>create_delivery_order_from_transfer().item $nomor $item->item_number";
					
			}
		} else {
			$this->_error_message.="<br>Unable register new DO.<br>";
		}
		
	}
	function create_purchase_order(){
		$this->load->model("purchase_order_model");
		$nomor=$this->purchase_order_model->nomor_bukti();
		$supplier=$this->_supplier_number;
		$data=array("purchase_order_number"=>$nomor,
			"po_date"=>Date("Y-m-d H:i:s"),
			"potype"=>"O","po_ref"=>$this->_app_id,
			"supplier_number"=>$supplier,
			"terms"=>"KREDIT",
			"ordered_by"=>$this->_user_id,
			"currency_code"=>"IDR",
			"currency_rate"=>1,
			"warehouse_code"=>$this->_gudang,
			"due_date"=>Date("Y-m-d H:i:s"));
		//echo "<br>create_purchase_order() $nomor";
		if($this->purchase_order_model->save($data)){
			$this->purchase_order_model->nomor_bukti(true);
			foreach($this->_app_master_items->result() as $item){
				$this->purchase_order_model->add_item(
					$nomor,$item->obj_id,
					$item->qty);
			//	echo "<br>create_purchase_order().item $nomor, $item->obj_id";
					
			}
		} else {
			$this->_error_message.="<br>Unable register new PO.<br>";
		}
		$this->_nomor_po=$nomor;
	}
	function create_sales_order_from_po(){
		$this->load->model("sales_order_model");
		$this->load->model("purchase_order_lineitems_model");
		$rsItems=$this->purchase_order_lineitems_model->get_by_nomor($this->_nomor_po);
		$nomor_so=$this->sales_order_model->nomor_bukti();
		$this->_nomor_so=$nomor_so;
		$customer=$this->_customer_number;
		$data=array("sales_order_number"=>$nomor_so,"your_order__"=>$this->_app_id,
			"sales_date"=>Date("Y-m-d H:i:s"),
			"type_of_invoice"=>"Simple",
			"sold_to_customer"=>$customer,
			"ship_to_customer"=>$customer,
			"source_of_order"=>"Leasing",
			"payment_terms"=>"KREDIT",
			"salesman"=>$this->_user_id,
			"currency_code"=>"IDR",
			"currency_rate"=>1,
			"warehouse_code"=>$this->_gudang,
			"due_date"=>Date("Y-m-d H:i:s"),
			"delivered"=>0);
		//echo "<br>create_sales_order_from_po() $nomor_so";
		if($this->sales_order_model->save($data)){
			$this->sales_order_model->nomor_bukti(true);
			foreach($rsItems->result() as $item){
				$this->sales_order_model->add_item(
					$nomor_so,$item->item_number,
					$item->quantity);
				//echo "<br>create_sales_order_from_po().item $nomor_so, $item->item_number ";
			}
		} else {
			$this->_error_message.="<br>Unable register new sales order.<br>";
		}
		
	}
	function create_delivery_order_from_po(){
		$this->load->model("purchase_order_lineitems_model");
		$this->load->model("invoice_model");
		$nomor=$this->invoice_model->nomor_bukti_do();
		$customer=$this->_customer_number;
		$rsItems=$this->purchase_order_lineitems_model->get_by_nomor($this->_nomor_po);
		$data=array("invoice_number"=>$nomor,"your_order__"=>$this->_app_id,
			"invoice_date"=>Date("Y-m-d H:i:s"),"sales_order_number"=>$this->_nomor_so,
			"type_of_invoice"=>"Simple",
			"invoice_type"=>"D",
			"sold_to_customer"=>$customer,
			"ship_to_customer"=>$customer,
			"payment_terms"=>"KREDIT",
			"salesman"=>$this->_user_id,
			"currency_code"=>"IDR",
			"currency_rate"=>1,
			"warehouse_code"=>$this->_gudang,
			"due_date"=>Date("Y-m-d H:i:s"));

		//echo "<br>create_delivery_order_from_po().save $nomor";
			
		if($this->invoice_model->save($data)){
			$this->invoice_model->nomor_bukti_do(true);
			foreach($rsItems->result() as $item){
				$this->invoice_model->add_item(
					$nomor,$item->item_number,
					$item->quantity);
				//echo "<br>create_delivery_order_from_po().add_item $nomor , $item->item_number";
			}
		} else {
			$this->_error_message.="<br>Unable register new DO.<br>";
		}
		
	}
	
	
}
?>