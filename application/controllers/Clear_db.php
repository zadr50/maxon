<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Clear_db extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
       
 		$this->load->helper(array('url','form'));
		$this->load->library('template');;
	}
	function index()
	{	
		if (!allow_mod2('_18000.900'))  exit;
		if (!allow_mod2('_18000.901'))  exit;

		$data['message']='';
		if($this->input->post()){
			$process=$this->input->post('prdel');
			for($i=0;$i<count($process);$i++){
				$proc=$process[$i];
				switch($proc) {
				case 'ms_coaxxxxxxxxxxxxx':
					$tables = array("Bank Accounts", "Financial Periods", "GL Report Groups", 
						"Chart of Accounts");
					$s="Master Data Kode Perkiraan";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				
				case 'ms_bank':
					$tables= array("Bank Accounts");
					$s="Master Data Rekening Bank/Kas";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'ms_customer':
					$tables = array("Customer Statement Defaults", 
					"Customer ShipTo", "Customers","Salesman", 
					"Salesman Komisi", "Kendaraan", "Departments" 
					);
					$s="Master Data Customers";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'ms_supplier':
					$tables = array("Suppliers");
					$s="Master Data Supplier";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'ms_iventory':
					$tables = array(
					 "Inventory Suppliers", "Inventory Prices", "Inventory Assembly", 
					 "Inventory Warehouse", "Inventory Categories", "Inventory"
					);
					$s="Transaksi Penjualan";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'ms_payroll':
					$s="Transaksi Penjualan";
					echo "Payroll belum tersedia...";
					/*
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s;
					*/
					break;
				case 'ms_leasing':
					echo "Leasing Belum tersedia...";
					/*
					$s="Transaksi Penjualan";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s;
					*/
					break;
				case 'ms_pabrik':
					$s="Master Data Pabrik";
					$tables=array("inventory","inventory_categories",
					"departments","divisions"
					);
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'ms_travel':
					echo "Travel belum tersedia...";
					/*
					$s="Transaksi Penjualan";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s;
					break;
					*/
				case 'tr_jual':
					//"promosi_item_gift"
					$tables=array("Invoice Shipment Export", "Bill Detail", "Bill Header", "Payments", "Quotation Lineitems", "Quotation", 
						 "Sales Order Lineitems", "Sales Order", 
						 "Invoice Lineitems", "Invoice", "CRDB_MEMO_DTL", "CRDB_MEMO", "promosi_time", "promosi_point_transactions", 
						 "promosi_outlet", "promosi_item_customer", "promosi_item_category", "promosi_item", 
						 "promosi_extra_item", "promosi_disc", "voucher_master");
					$s="Transaksi Penjualan";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_beli':
					$s="Transaksi Pembelian";
					$tables=array("purchase_order","purchase_order_lineitems",
					"payables","payables_payments","payables_bill_detail","payables_bill_header");
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_bank':
					$tables = array("Check Writer Recurring Payment Items", "Check Writer Recurring Payments", 
					 "Check Writer Deposit Detail", "Payables Payments", "Payables Items", "Payables", 
					 "Check Writer Items", "Check Writer Undeposited Checks", "Check Writer"
					 );
					$s="Transaksi Kas Bank";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_jurnal':
					// "GL Transactions Deleted"
					$tables = array("Budget", "GL Transactions", "GL Beginning Balance Archive", 
					 "GL Transactions Archive"
					 );
					$s="Transaksi Jurnal dan Akuntansi";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_inventory':
					//, "Inventory FIFO"
					$tables = array("Inventory Serialized Items", "Inventory Products", 
					 "Inventory Price History", "Inventory Moving", "Inventory Price History", 
					 "Inventory Beginning Balance"
					);
					$s="Transaksi Inventory";					
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_customer':
					$tables = array("Customer Beginning Balance");
					$s="Transaksi Customer";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_supplier':
					$tables = array("Supplier Beginning Balance");
					$s="Transaksi Supplier";
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_pos':
					$s="Transaksi Penjualan POS";
					
					$tables= array("FB Partners Book", "FB Table Reservation", "Kas Kasir", 
						"POS_BILL", "POS_OE_ITEM", "POS_OE_LADY", "POS_OE_ROOM", 
						"POS_OE_TABLE", "POS_PAY", "POS_RESV_LADY", "POS_RESV_ROOM", 
						"POS_RESV_TABLE", "POS_TRX_COE", "FB Room Reservation", 
						"POS_OE");
/* 					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
 */					echo $s & "</br>";
					
					break;
				case 'tr_pabrik':
					$s="Transaksi Penjualan";
					$tables=array("mat_release_detail","mat_release_header",
					"work_order","work_order_detail","work_exec","work_exec_detail"
					);
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					break;
				case 'tr_leasing':
					$s="Transaksi Penjualan";
					echo $s." belum tersedia.";
					/*
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s;
					*/
					break;
				case 'tr_payroll':
					$s="Transaksi Penjualan";
					echo $s." belum tersedia.";
					/*
					if(!$this->delete_tables($tables)){
						$s.="...OK";
					} else {
						$s.="...ERROR";
					}
					echo $s & "</br>";
					*/
					break;
				}
			}			
			echo "Database sudah dihapus !!!";
			exit;
		}
		$this->template->display_form_input('admin/clear_db',$data,'');
	}
	function delete_tables($arTable){
		for($i=0;$i<count($arTable);$i++)
		{
			$table=$arTable[$i];
			$table=str_ireplace(" ","_",$table);
			$table=strtolower($table);
			echo "...starting delete " . $table;
			try{
				if(@$this->db->query("TRUNCATE TABLE ".$table)){
					echo "...OK</br>";
				} else {
					echo "...ERROR</br>";
				}
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
	}
}
