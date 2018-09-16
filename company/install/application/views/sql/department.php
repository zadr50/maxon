<?php

$table="department";

$sql="

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL auto_increment,
  `dept_code` varchar(50) character set utf8 default NULL,
  `dept_name` varchar(50) character set utf8 default NULL,
  `company_code` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`dept_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
	
?>