<?php


$table="budget";

$sql="CREATE TABLE IF NOT EXISTS `budget` (
  `account_id` int(11) default NULL,
  `budget_year` int(11) default NULL,
  `january` double default NULL,
  `february` double default NULL,
  `march` double default NULL,
  `april` double default NULL,
  `may` double default NULL,
  `june` double default NULL,
  `july` double default NULL,
  `august` double default NULL,
  `september` double default NULL,
  `october` double default NULL,
  `november` double default NULL,
  `december` double default NULL,
  `org_id` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  KEY `x1` (`account_id`,`budget_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
	
	
	?>
	