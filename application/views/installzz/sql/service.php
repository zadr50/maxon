<?

$sql="

CREATE TABLE IF NOT EXISTS `service_jobs` (
  `job_id` varchar(50) character set utf8 NOT NULL,
  `service_number` varchar(50) character set utf8 default NULL,
  `teknisi` varchar(50) character set utf8 default NULL,
  `garansi` bit(1) default NULL,
  `job_finish` bit(1) default NULL,
  `ongkos_kerja` double default NULL,
  `masalah` varchar(50) character set utf8 default NULL,
  `pekerjaan` varchar(50) character set utf8 default NULL,
  `biaya_lain` double default NULL,
  `total_amt_part` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `x1` (`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if($link->query($sql))$msg .="<br>- service_jobs..OK";else $msg .="<br>- service_jobs..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `service_job_sparepart` (
  `job_id` varchar(50) character set utf8 default NULL,
  `qty` int(11) default NULL,
  `item_number` varchar(50) character set utf8 default NULL,
  `description` varchar(200) character set utf8 default NULL,
  `harga` double default NULL,
  `total` double default NULL,
  `update_status` int(11) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
if($link->query($sql))$msg .="</br>- service_job_sparepart..OK";else $msg .="</br>- service_job_sparepart..<br>ERROR -" . mysql_error();

$sql="

CREATE TABLE IF NOT EXISTS `service_order` (
  `no_bukti` varchar(50) character set utf8 NOT NULL,
  `customer` varchar(50) character set utf8 default NULL,
  `alt_phone` varchar(50) character set utf8 default NULL,
  `cust_po` varchar(50) character set utf8 default NULL,
  `serv_rep` varchar(50) character set utf8 default NULL,
  `manufacture` varchar(50) character set utf8 default NULL,
  `model` varchar(50) character set utf8 default NULL,
  `serial` varchar(50) character set utf8 default NULL,
  `alt_id` varchar(50) character set utf8 default NULL,
  `service_amt` double default NULL,
  `ongkos_amt` double default NULL,
  `kirim_amt` double default NULL,
  `lain_amt` double default NULL,
  `ppn_prc` double(11,0) default NULL,
  `ppn_amt` double default NULL,
  `disc_prc` double(11,0) default NULL,
  `disc_amt` double default NULL,
  `comments` double default NULL,
  `tanggal` datetime default NULL,
  `tanggal_selesai` datetime default NULL,
  `tanggal_beli` datetime default NULL,
  `selesai` bit(1) default NULL,
  `part_amt` double default NULL,
  `tanggal_akhir_garansi` datetime default NULL,
  `source_invoice_no` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`no_bukti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if($link->query($sql))$msg .="</br>- service_order..OK";else $msg .="</br>- service_order..<br>ERROR -" . mysql_error();


?>