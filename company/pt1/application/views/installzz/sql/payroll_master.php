<?
 
$table="payroll";
$sql=" 
CREATE TABLE jenis_tunjangan (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	sifat varchar (50) character set utf8 NULL ,
	is_variable bit(1) default 0,
	ref_column varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="<br>- jenis_tunjangan..OK";else $msg .="<br>- jenis_tunjangan..<br>ERROR -" . mysql_error();

$sql=" 
CREATE TABLE jenis_potongan (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	sifat varchar (50) character set utf8 NULL ,
	is_variable bit(1) default 0,
	ref_column varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- jenis_potongan..OK";else $msg .="</br>- jenis_potongan..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_type (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- employee_type..OK";else $msg.="</br>- employee_type..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_group (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- employee_group..OK";else $msg .="</br>- employee_group..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_status (
	status varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	update_status int NULL ,
	PRIMARY KEY  (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- employee_status..OK";else $msg .="</br>- employee_status..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_level (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar (50) character set utf8 NULL ,
	PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- employee_level..OK";else $msg .="</br>- employee_level..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE divisions (
	div_code varchar (50) character set utf8 NOT NULL ,
	div_name varchar (50) character set utf8 NULL ,
	PRIMARY KEY  (div_code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- divisions..OK";else $msg .="</br>- divisions..<br>ERROR -" . mysql_error();


?>