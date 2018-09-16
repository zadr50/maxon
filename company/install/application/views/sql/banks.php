<?php

	$table="bank_accounts";
	$sql="CREATE TABLE IF NOT EXISTS `bank_accounts` (
	  `bank_account_number` varchar(50) character set utf8 NOT NULL default '',
	  `type_bank` varchar(50) character set utf8 default NULL,
	  `bank_name` varchar(50) character set utf8 default NULL,
	  `aba_number` varchar(50) character set utf8 default NULL,
	  `routing_code` varchar(15) character set utf8 default NULL,
	  `street` varchar(50) character set utf8 default NULL,
	  `suite` varchar(50) character set utf8 default NULL,
	  `city` varchar(50) character set utf8 default NULL,
	  `state_province` varchar(50) character set utf8 default NULL,
	  `zip_postal_code` varchar(50) character set utf8 default NULL,
	  `country` varchar(50) character set utf8 default NULL,
	  `contact_name` varchar(50) character set utf8 default NULL,
	  `phone_number` varchar(50) character set utf8 default NULL,
	  `fax_number` varchar(50) character set utf8 default NULL,
	  `starting_check_number` varchar(50) character set utf8 default NULL,
	  `last_bank_statement_date` datetime default NULL,
	  `last_bank_statement_balance` double default NULL,
	  `account_id` int(50) default NULL,
	  `micr_line` varchar(40) character set utf8 default NULL,
	  `no_bukti_in` varchar(50) character set utf8 default NULL,
	  `no_bukti_out` varchar(50) character set utf8 default NULL,
	  `org_id` varchar(50) character set utf8 default NULL,
	  `update_status` varchar(50) character set utf8 default NULL,
	  PRIMARY KEY  (`bank_account_number`),
	  KEY `x1` (`bank_account_number`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="bank_accounts";
	$sql="
	INSERT INTO `bank_accounts` (`bank_account_number`, `type_bank`, `bank_name`, `aba_number`, `routing_code`, `street`, `suite`, `city`, `state_province`, `zip_postal_code`, `country`, `contact_name`, `phone_number`, `fax_number`, `starting_check_number`, `last_bank_statement_date`, `last_bank_statement_balance`, `account_id`, `micr_line`, `no_bukti_in`, `no_bukti_out`, `org_id`, `update_status`) 
	VALUES('BCA', 'D', 'BCA', '', '', 'JL. RAYA PURWAKARTA NO. 38 a', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, 0, '', 'A', 'B', '', ''),
	('BNI', 'Bank', 'BNI', '', '', 'JL. RAYA PURWAKARTA NO. 38', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, 1374, '', 'A', 'B', '', ''),
	('BRI', 'Bank', 'BRI', '', '', 'JL. RAYA PURWAKARTA NO. 38', '', '', '', '', '', '', '', '', '', '2013-08-12 00:00:00', 0, 0, '', '', '', '', '')
	";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	
	?>