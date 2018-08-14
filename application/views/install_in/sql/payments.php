<?
$table="payments";

	$sql="

CREATE TABLE IF NOT EXISTS `".$cid."payments` (
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
  PRIMARY KEY  (`line_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;
";
if($link->query($sql))echo mysqli_error($link);

$sql="

INSERT INTO `".$cid."payments` (`invoice_number`, `line_number`, `date_paid`, `how_paid`, `how_paid_acct_id`, `credit_card_number`, `expiration_date`, `authorization`, `amount_paid`, `amount_alloc`, `comments`, `check_type`, `curr_code`, `curr_rate`, `curr_rate_exc`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `no_bukti`, `trans_id`, `org_id`, `update_status`, `receipt_by`, `credit_card_type`, `sourceautonumber`, `sourcefile`, `jenisuangmuka`, `angsur_no_dari`, `angsur_no_sampai`, `angsur_sisa`, `angsur_lunas`, `angsur_lunas_bunga`, `from_bank`, `from_account`) VALUES
('SO00055', 1, '2012-09-04 00:00:00', 'TRANS IN', NULL, NULL, NULL, 'dfasfda', 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abadfas', 'dasdf'),
('PJL00106', 160, '2014-03-02 00:00:00', '0', NULL, NULL, NULL, NULL, 101300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00083', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00106', 161, '2014-03-02 00:00:00', '0', NULL, NULL, NULL, NULL, 6000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00084', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00150', 162, '2014-03-02 00:00:00', '0', NULL, NULL, NULL, NULL, 9000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00085', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00104', 163, '2014-03-02 07:00:00', '0', 0, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00086', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00104', 164, '2014-03-02 07:00:00', '0', 0, NULL, NULL, NULL, 8000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00086', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00107', 140, '2014-02-28 00:00:00', '0', 0, NULL, NULL, NULL, 800000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00073', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PJL00153', 175, '2014-03-25 07:00:00', '0', 0, NULL, NULL, NULL, 9500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ARP00095', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

";
if($link->query($sql))echo mysqli_error($link);

?>