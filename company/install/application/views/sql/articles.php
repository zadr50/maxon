<?php
$table="articles";
$sql="
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `date_post` datetime DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `show_on_top` int(11) DEFAULT NULL,
  `icon_file` varchar(250) DEFAULT NULL,
  `doc_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;
";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);
 
?>