<?

	$table="employee";

	$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employee` (
  `nip` varchar(50) character set utf8 NOT NULL,
  `nama` varchar(50) character set utf8 default NULL,
  `tgllahir` datetime default NULL,
  `agama` varchar(12) character set utf8 default NULL,
  `kelamin` varchar(1) character set utf8 default NULL,
  `status` varchar(12) character set utf8 default NULL,
  `idktpno` varchar(20) character set utf8 default NULL,
  `hireddate` datetime default NULL,
  `dept` varchar(50) character set utf8 default NULL,
  `divisi` varchar(50) character set utf8 default NULL,
  `level` varchar(50) character set utf8 default NULL,
  `position` varchar(50) character set utf8 default NULL,
  `supervisor` varchar(50) character set utf8 default NULL,
  `payperiod` varchar(50) character set utf8 default NULL,
  `alamat` varchar(100) character set utf8 default NULL,
  `kodepos` varchar(50) character set utf8 default NULL,
  `telpon` varchar(12) character set utf8 default NULL,
  `hp` varchar(25) character set utf8 default NULL,
  `gp` double default NULL,
  `tjabatan` double default NULL,
  `ttransport` double default NULL,
  `tmakan` double default NULL,
  `incentive` double default NULL,
  `sc` double(11,0) default NULL,
  `rateot` double default NULL,
  `tkesehatan` double default NULL,
  `tlain` double default NULL,
  `bjabatang` double default NULL,
  `iurantht` double default NULL,
  `blain` double default NULL,
  `emptype` varchar(20) character set utf8 default NULL,
  `emplevel` varchar(20) character set utf8 default NULL,
  `pathimage` varchar(200) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  `nip_id` varchar(50) default NULL,
  `npwp` varchar(50) default NULL,
  `bank_name` varchar(50) default NULL,
  `account` varchar(50) default NULL,
  `tempat_lahir` varchar(50) default NULL,
  `pendidikan` varchar(50) default NULL,
  `gol_darah` varchar(50) default NULL,
  PRIMARY KEY  (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1

";
if($link->query($sql))echo mysqli_error($link);
	$table="employeeeducations";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeeeducations` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `educationlevel` varchar(255) character set utf8 default NULL,
  `school` varchar(255) character set utf8 default NULL,
  `place` varchar(255) character set utf8 default NULL,
  `major` varchar(255) character set utf8 default NULL,
  `enteryear` int(11) default NULL,
  `graduationyear` int(11) default NULL,
  `yearofattend` varchar(255) character set utf8 default NULL,
  `graduate` bit(1) default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);
	$table="employeeexperience";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeeexperience` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `company` varchar(255) character set utf8 default NULL,
  `startdate` varchar(255) character set utf8 default NULL,
  `finishdate` varchar(255) character set utf8 default NULL,
  `firstposition` varchar(255) character set utf8 default NULL,
  `endposition` varchar(255) character set utf8 default NULL,
  `place` varchar(255) character set utf8 default NULL,
  `lastsalary` varchar(255) character set utf8 default NULL,
  `supervisor` varchar(255) character set utf8 default NULL,
  `referencename` varchar(255) character set utf8 default NULL,
  `referencephone` varchar(255) character set utf8 default NULL,
  `reasontoleave` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);

	$table="employeefamily";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeefamily` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `familyname` varchar(255) character set utf8 default NULL,
  `relationship` varchar(255) character set utf8 default NULL,
  `age` datetime default NULL,
  `education` varchar(255) character set utf8 default NULL,
  `job` varchar(255) character set utf8 default NULL,
  `mariagestatus` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);

	$table="employeelicense";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeelicense` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `licensenumber` varchar(255) character set utf8 default NULL,
  `lincensetype` varchar(255) character set utf8 default NULL,
  `startdate` datetime default NULL,
  `finishdate` datetime default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);
	$table="employeemedical";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeemedical` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `medicaldate` datetime default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);
	$table="employeerewardpunish";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeerewardpunish` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `daterp` datetime default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `rankinglevel` varchar(255) character set utf8 default NULL,
  `typerp` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);
	$table="employeeskill";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeeskill` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `skillname` varchar(255) character set utf8 default NULL,
  `skilllevel` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);
	$table="employeetraining";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employeetraining` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` varchar(255) character set utf8 default NULL,
  `trainingname` varchar(255) character set utf8 default NULL,
  `traningdate` varchar(255) character set utf8 default NULL,
  `place` varchar(255) character set utf8 default NULL,
  `topic` varchar(255) character set utf8 default NULL,
  `certificate` varchar(255) character set utf8 default NULL,
  `sourceautonumber` varchar(50) character set utf8 default NULL,
  `sourcefile` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

";
if($link->query($sql))echo mysqli_error($link);
	$table="employee_level";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employee_level` (
  `levelkode` varchar(50) character set utf8 NOT NULL,
  `levelname` varchar(50) character set utf8 default NULL,
  `creationdate` datetime default NULL,
  `keterangan` varchar(50) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`levelkode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))echo mysqli_error($link);
	$table="employee_type";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."employee_type` (
  `kode` varchar(50) character set utf8 NOT NULL,
  `description` varchar(10) character set utf8 default NULL,
  `update_status` int(11) default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))echo mysqli_error($link);
	$table="exchange_rate";

$sql="

CREATE TABLE IF NOT EXISTS `".$cid."exchange_rate` (
  `er_code` varchar(50) character set utf8 default NULL,
  `sourcecurrency` varchar(50) character set utf8 default NULL,
  `targetcurrency` varchar(50) character set utf8 default NULL,
  `currency_rate` double default NULL,
  `last_update` datetime default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";

	if($link->query($sql))echo mysqli_error($link);	

?>