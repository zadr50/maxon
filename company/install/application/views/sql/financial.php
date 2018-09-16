<?php

	$table="finance_charge_defaults";

	$sql="

CREATE TABLE IF NOT EXISTS `finance_charge_defaults` (
  `minimum_days_past_due` int(11) default NULL,
  `minimum_customer_balance` double default NULL,
  `minimum_finance_charge` double default NULL,
  `number_days_between_charges` int(11) default NULL,
  `use_one_month_or_actual_days` varchar(15) character set utf8 default NULL,
  `annual_finance_charge_pct` double default NULL,
  `daily_finance_charge_pct` double default NULL,
  `include_fin_chg_in_past_due_amt` bit(1) default NULL,
  `finance_charge_acct` int(11) default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);


	$table="financial_periods";
$sql="

CREATE TABLE IF NOT EXISTS `financial_periods` (
  `year_id` int(11) default NULL,
  `sequence` double default NULL,
  `period` varchar(50) character set utf8 default NULL,
  `startdate` datetime default NULL,
  `enddate` datetime default NULL,
  `closed` tinyint(1) default NULL,
  `update_status` int(11) default NULL,
  `id` int(11) NOT NULL auto_increment,
  month_name varchar(50) NULL,
  PRIMARY KEY  (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="financial_periods";

$sql="

INSERT INTO `financial_periods` (`year_id`, `sequence`, `period`, `startdate`, `enddate`, `closed`, `update_status`, `id`) VALUES
(2014, 2, '2014-02', '2014-02-01 00:00:00', '2014-02-28 00:00:00', 0, 0, 23),
(2013, 7, '2013-07', '2013-07-01 00:00:00', '2013-07-30 00:00:00', 0, 0, 14),
(2013, 6, '2013-06', '2013-06-01 00:00:00', '2013-06-30 00:00:00', 0, 0, 20),
(2013, 5, '2013-05', '2013-05-01 00:00:00', '2013-05-31 00:00:00', 0, 0, 12),
(2013, 4, '2013-04', '2013-04-01 00:00:00', '2013-04-30 00:00:00', 0, 0, 11),
(2013, 3, '2013-03', '2013-03-01 00:00:00', '2013-03-31 00:00:00', 0, 0, 10),
(2013, 2, '2013-02', '2013-02-01 00:00:00', '2013-02-28 00:00:00', 1, 0, 9),
(2013, 8, '2013-08', '2013-08-01 00:00:00', '2013-08-31 00:00:00', 0, 0, 21),
(2014, 1, '2014-01', '2014-01-01 00:00:00', '2014-01-31 23:59:00', 0, 0, 22);
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="gl_begbalarc_year";

$sql="

CREATE TABLE IF NOT EXISTS `gl_begbalarc_year` (
  `account_id` int(11) default NULL,
  `company_code` varchar(15) character set utf8 default NULL,
  `year` datetime default NULL,
  `beginning_balance` double default NULL,
  `debit_base` double default NULL,
  `credit_base` double default NULL,
  `ending_balance` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

	$table="gl_beginning_balance_archive";

$sql="

CREATE TABLE IF NOT EXISTS `gl_beginning_balance_archive` (
  `account_id` int(11) default NULL,
  `company_code` varchar(15) character set utf8 default NULL,
  `year` datetime default NULL,
  `beginning_balance` double default NULL,
  `debit_base` double default NULL,
  `credit_base` double default NULL,
  `ending_balance` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	?>