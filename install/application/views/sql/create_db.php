<?php

//start creating tables
for($nomor=1;$nomor<44;$nomor++){
//	ob_start();
	switch($nomor){
	case 1: 
		include "maxon_apps.php";
		break;
 
	case 2: include 'articles.php'; break;
	case 3: include "modules.php"; break; 
	case 4: include "sysvar.php"; break;
	case 5: include "sysgrid.php"; break;
	case 6: include "location.php"; break;
	case 7: include "user_seting.php"; break;
	case 8: include "banks.php"; break;
	case 9: include "inventory_beg_bal.php"; break;
	case 10: include "pending_stock_op.php"; break;
	case 11: include "sales_qto.php"; break;
	case 12: include "bill.php"; break;
	case 13: include "budget.php"; break;
	case 14: include "salesman.php"; break;
	case 15: include "service.php"; break;
	case 16: include "coa.php"; break;
	case 17: include "check_writer.php"; break;
	case 18: include "city.php"; break;
	case 19: include "customer.php"; break;
	case 20: include "department.php"; break;
	case 21: include "fixed_asset.php"; break;
 
	case 22: 
		include "financial.php"; break;
 
	case 23: include "gl_project.php"; break;
	case 24: include "accounting.php"; break;
	case 25: include "inventory.php"; break;
	case 26: include "inventory_products.php"; break;
	case 27: include "invoice.php"; break;
	case 28: include "payables.php"; break;
	case 29: include "payments.php";	break;
	case 30: 
		include "preferences.php"; 
		break;
	case 31: include "promosi.php"; break;
	case 32: include "purchase_order.php"; break;
	case 33: include "report_list.php"; break;
	case 34: include "sales.php"; break;
	case 35: include "purchase.php"; break;
	case 36: include "voucher.php"; break;
	case 37: include "qry_backoffice.php"; break;
	case 38: include "qry_kartu_piutang.php"; break;
	case 39: include "qry_kartu_hutang.php"; break;
	case 40: include "payroll_master.php"; break;
	case 41: include "payroll.php"; break;
	case 42: include "timecard.php"; break;
	case 43: include "employee.php"; break;
	}
	//ob_flush();
}
//ob_end_flush(); 
?>
