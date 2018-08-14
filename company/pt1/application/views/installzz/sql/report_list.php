<?
 
	$table="report_list";

	$sql="

CREATE TABLE IF NOT EXISTS `report_list` (
  `report_code` varchar(75) character set utf8 NOT NULL,
  `report_name` varchar(255) character set utf8 default NULL,
  `report_category` double default NULL,
  `query_name` double default NULL,
  `description` double default NULL,
  `date_selectors` bit(1) default NULL,
  `category_selectors` bit(1) default NULL,
  `category_query` varchar(255) default NULL,
  `category_text` varchar(255) default NULL,
  `category_2_selectors` bit(1) default NULL,
  `category_2_query` varchar(255) default NULL,
  `category_2_text` varchar(255) default NULL,
  `image` double default NULL,
  `criteriatype` varchar(50) character set utf8 default NULL,
  `criteria2type` varchar(50) character set utf8 default NULL,
  `report_filename` varchar(50) character set utf8 default NULL,
  `field_selection` varchar(255) default NULL,
  `date_field_selection` varchar(255) default NULL,
  `field_2_selection` varchar(255) default NULL,
  `visible` bit(1) default NULL,
  `created_date` datetime default NULL,
  `update_status` int(11) default NULL,
  `criteria3type` varchar(50) character set utf8 default NULL,
  `category_3_selectors` bit(1) default NULL,
  `category_3_query` varchar(250) character set utf8 default NULL,
  `category_3_text` varchar(250) character set utf8 default NULL,
  `field_3_selection` varchar(250) character set utf8 default NULL,
  `criteria4type` varchar(50) character set utf8 default NULL,
  `category_4_selectors` bit(1) default NULL,
  `category_4_query` varchar(250) character set utf8 default NULL,
  `field_4_selection` varchar(250) character set utf8 default NULL,
  `category_4_text` varchar(250) character set utf8 default NULL,
  `criteria5type` varchar(50) character set utf8 default NULL,
  `category_5_selectors` bit(1) default NULL,
  `category_5_query` varchar(250) character set utf8 default NULL,
  `field_5_selection` varchar(250) character set utf8 default NULL,
  `category_5_text` varchar(250) character set utf8 default NULL,
  PRIMARY KEY  (`report_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))$msg .="<br>- report_list..OK";else $msg .="<br>- report_list..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `rpt_open_to_buy` (
  `item_number` varchar(50) character set utf8 default NULL,
  `period_mm` int(11) default NULL,
  `opening_stock` double default NULL,
  `forecast_sales` double default NULL,
  `period_forward_cover` double default NULL,
  `closing_stock_required` double default NULL,
  `intake_required` double default NULL,
  `on_order` double default NULL,
  `otb_remaining` double default NULL,
  `closing_stock` double default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))$msg .="</br>- rpt_open_to_buy..OK";else $msg .="</br>- rpt_open_to_buy..<br>ERROR -" . mysql_error();
	
?>