<?php

$table="payments";

$sql="

CREATE TABLE IF NOT EXISTS `payments` (
  `invoice_number` varchar(50) character set utf8 default NULL,
  `line_number` int(11) NOT NULL auto_increment,
  `date_paid` datetime default NULL,
  `how_paid` varchar(50) character set utf8 default NULL,
  `how_paid_acct_id` int(11) default NULL,
  `credit_card_number` varchar(50) character set utf8 default NULL,
  `expiration_date` varchar(50) character set utf8 default NULL,
  `authorization` varchar(50) character set utf8 default NULL,
  `amount_paid` double default NULL,
  `amount_alloc` double default NULL,
  `comments` double default NULL,
  `check_type` int(11) default NULL,
  `curr_code` varchar(50) character set utf8 default NULL,
  `curr_rate` double default NULL,
  `curr_rate_exc` double default NULL,
  `curr_code_org` varchar(50) character set utf8 default NULL,
  `curr_rate_org` double default NULL,
  `curr_selisih` double default NULL,
  `no_bukti` varchar(50) character set utf8 default NULL,
  `trans_id` int(11) default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `receipt_by` varchar(50) character set utf8 default NULL,
  `credit_card_type` varchar(50) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `jenisuangmuka` int(11) default NULL,
  `angsur_no_dari` int(11) default NULL,
  `angsur_no_sampai` int(11) default NULL,
  `angsur_sisa` double default NULL,
  `angsur_lunas` double default NULL,
  `angsur_lunas_bunga` int(11) default NULL,
  `from_bank` varchar(50) default NULL,
  `from_account` varchar(50) default NULL,
  `account_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`line_number`),
  KEY `x1` (`invoice_number`),
  KEY `x2` (`date_paid`),
  KEY `x3` (`how_paid`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


?>