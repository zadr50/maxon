<?php
$msg="";
$table="preferences";
$sql="
CREATE TABLE IF NOT EXISTS `preferences` (
  `company_code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `slogan` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `purchase_order_contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `city_state_zip_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fed_tax_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `perpetual_inventory` tinyint(1) DEFAULT NULL,
  `out_of_stock_checking` tinyint(1) DEFAULT NULL,
  `purchase_order_restocking` tinyint(1) DEFAULT NULL,
  `item_categories` tinyint(1) DEFAULT NULL,
  `supplier_numbering` double DEFAULT NULL,
  `default_invoice_type` double DEFAULT NULL,
  `default_bank_account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `default_credit_card_account` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_numbering` double DEFAULT NULL,
  `use_sales_order_number` tinyint(1) DEFAULT NULL,
  `customer_credit_account_number` int(11) DEFAULT NULL,
  `supplier_credit_account_number` int(11) DEFAULT NULL,
  `po_numbering` double DEFAULT NULL,
  `invoice_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__5` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__5` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `inventory_tracking` double DEFAULT NULL,
  `inventory_costing` double DEFAULT NULL,
  `customer_order` double DEFAULT NULL,
  `customer_numbering` double DEFAULT NULL,
  `general_ledger` tinyint(1) DEFAULT NULL,
  `freight_taxable` tinyint(1) DEFAULT NULL,
  `other_taxable` tinyint(1) DEFAULT NULL,
  `accounts_receivable` int(11) DEFAULT NULL,
  `so_freight` int(11) DEFAULT NULL,
  `so_other` int(11) DEFAULT NULL,
  `so_tax` int(11) DEFAULT NULL,
  `so_tax_2` int(11) DEFAULT NULL,
  `so_discounts_given` int(11) DEFAULT NULL,
  `accounts_payable` int(11) DEFAULT NULL,
  `po_freight` int(11) DEFAULT NULL,
  `po_other` int(11) DEFAULT NULL,
  `po_tax` int(11) DEFAULT NULL,
  `po_tax_2` int(11) DEFAULT NULL,
  `po_discounts_taken` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `inventory_sales` int(11) DEFAULT NULL,
  `inventory_cogs` int(11) DEFAULT NULL,
  `maximize_on_640` tinyint(1) DEFAULT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `po_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quote_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `sales_order_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `gl_post_date` int(11) DEFAULT NULL,
  `security` tinyint(1) DEFAULT NULL,
  `sales_selection` int(11) DEFAULT NULL,
  `printed_check_password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `unpost_password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `undeposited_checks` tinyint(1) DEFAULT NULL,
  `autostub` tinyint(1) DEFAULT NULL,
  `startup_company_schedule` tinyint(1) DEFAULT NULL,
  `po_show_items` double DEFAULT NULL,
  `acctproglocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `payrollproglocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `payrolldatalocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `custbalupdated` datetime DEFAULT NULL,
  `display_shiptos` double DEFAULT NULL,
  `version` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `inventorysearch` int(11) DEFAULT NULL,
  `barcodeinventorystandard` tinyint(1) DEFAULT NULL,
  `barcodeinventorywarehouse` tinyint(1) DEFAULT NULL,
  `barcodepo` tinyint(1) DEFAULT NULL,
  `barcodesales` tinyint(1) DEFAULT NULL,
  `invpridec` int(11) DEFAULT NULL,
  `invqtydec` int(11) DEFAULT NULL,
  `payrollsystem` double DEFAULT NULL,
  `poitemdisplay` int(11) DEFAULT NULL,
  `salesitemdisplay` int(11) DEFAULT NULL,
  `salpridec` int(11) DEFAULT NULL,
  `salqtydec` int(11) DEFAULT NULL,
  `state_tax_id` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `gl_post_date_2` int(11) DEFAULT NULL,
  `earning_account` int(11) DEFAULT NULL,
  `year_earning_account` int(11) DEFAULT NULL,
  `historical_balance_account` int(11) DEFAULT NULL,
  `default_cash_payment_account` int(11) DEFAULT NULL,
  `invamtdec` int(11) DEFAULT NULL,
  `salamtdec` int(11) DEFAULT NULL,
  `purpridec` int(11) DEFAULT NULL,
  `purqtydec` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `file_logo` varchar(200) DEFAULT NULL,
  `handphone` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$sql="
	REPLACE INTO `preferences` (`company_code`, `company_name`, `slogan`, `invoice_contact`, `purchase_order_contact`, `street`, `suite`, `city_state_zip_code`, `phone_number`, `fax_number`, `email`, `fed_tax_id`, `perpetual_inventory`, `out_of_stock_checking`, `purchase_order_restocking`, `item_categories`, `supplier_numbering`, `default_invoice_type`, `default_bank_account_number`, `default_credit_card_account`, `invoice_numbering`, `use_sales_order_number`, `customer_credit_account_number`, `supplier_credit_account_number`, `po_numbering`, `invoice_message_copy__1`, `invoice_message_copy__2`, `invoice_message_copy__3`, `invoice_message_copy__4`, `invoice_message_copy__5`, `po_message_copy__1`, `po_message_copy__2`, `po_message_copy__3`, `po_message_copy__4`, `po_message_copy__5`, `bol_message_copy__1`, `bol_message_copy__2`, `bol_message_copy__3`, `bol_message_copy__4`, `inventory_tracking`, `inventory_costing`, `customer_order`, `customer_numbering`, `general_ledger`, `freight_taxable`, `other_taxable`, `accounts_receivable`, `so_freight`, `so_other`, `so_tax`, `so_tax_2`, `so_discounts_given`, `accounts_payable`, `po_freight`, `po_other`, `po_tax`, `po_tax_2`, `po_discounts_taken`, `inventory`, `inventory_sales`, `inventory_cogs`, `maximize_on_640`, `invoice_number`, `po_number`, `quote_number`, `sales_order_number`, `gl_post_date`, `security`, `sales_selection`, `printed_check_password`, `unpost_password`, `undeposited_checks`, `autostub`, `startup_company_schedule`, `po_show_items`, `acctproglocation`, `payrollproglocation`, `payrolldatalocation`, `custbalupdated`, `display_shiptos`, `version`, `inventorysearch`, `barcodeinventorystandard`, `barcodeinventorywarehouse`, `barcodepo`, `barcodesales`, `invpridec`, `invqtydec`, `payrollsystem`, `poitemdisplay`, `salesitemdisplay`, `salpridec`, `salqtydec`, `state_tax_id`, `gl_post_date_2`, `earning_account`, `year_earning_account`, `historical_balance_account`, `default_cash_payment_account`, `invamtdec`, `salamtdec`, `purpridec`, `purqtydec`, `update_status`, `file_logo`, `handphone`, `country`) VALUES
	('C01', 'PT. xxxxx', NULL, NULL, NULL, 'Apartement xxx', NULL, 'Jakarta', 'xxx', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1485', '1490', NULL, NULL, 1416, 1421, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1373, 1417, 1482, 1458, NULL, 1416, 1393, 1417, 1482, 1458, NULL, 1421, 1374, 1415, 1419, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1483, 1408, 1411, 1370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table="toko_master";

$sql="CREATE TABLE `toko_master` (
  `code` varchar(50) DEFAULT NULL,
  `code_company` varchar(50) DEFAULT NULL,
  `toko_name` varchar(250) DEFAULT NULL,
  `profit_prc` double DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `contact` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);



?>
