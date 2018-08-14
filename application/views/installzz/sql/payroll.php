<?
 
$table="payroll_link";

$sql="

CREATE TABLE IF NOT EXISTS `payroll_link` (
  `last_check_file` varchar(255) character set utf8 default NULL,
  `last_gl_file` varchar(255) character set utf8 default NULL,
  `last_bank_account` varchar(50) character set utf8 default NULL,
  `last_source` int(11) default NULL,
  `last_selchecks` bit(1) default NULL,
  `last_selgl` bit(1) default NULL,
  `update_status` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

";
if($link->query($sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysql_error();


$sql=" 

CREATE TABLE hr_emp_angsuran (
	id int(11) NOT NULL auto_increment,
	loan_number varchar (50) character set utf8 NOT NULL ,
	nip varchar (50) character set utf8 NOT NULL ,
	bulan int(2) NULL,
	tahun int(4) NULL,
	tanggal datetime null,
	angsuran double null,
	angsuran_bungan double null,
	bayar double null,
	bunga double,
	tanggal_bayar datetime null,
	no_bukti_bayar varchar(50) null,
	jenis_bayar int null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_emp_angsuran..OK";else $msg .="</br>- hr_emp_angsuran..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_emp_default_com (
	id int(11) NOT NULL auto_increment,
	nip varchar (50) character set utf8 NOT NULL ,
	def_com_code varchar (50) character set utf8 NULL ,
	def_com_value double NULL ,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_emp_default_com..OK";else $msg .="</br>- hr_emp_default_com..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_emp_level_com (
	id int(11) NOT NULL auto_increment,
	level_code varchar (50) character set utf8 NOT NULL ,
	no_urut varchar (50) character set utf8 NULL ,
	formula_string varchar (250) character set utf8 NULL ,
	take_home_pay int NULL ,
	salary_com_code varchar (50) character set utf8 NULL ,
	salary_com_name varchar (50) character set utf8 NULL ,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_emp_level_com..OK";else $msg.="</br>- hr_emp_level_com..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_emp_loan (
	loan_number varchar (50) character set utf8 NULL ,
	level_type varchar (50) character set utf8 NOT NULL ,
	date_loan datetime null ,
	loan_amount double NULL ,
	loan_balance double NULL ,
	angsuran double NULL ,
	loan_count int  NULL ,
	loan_last_to int  NULL ,
	loan_last_date datetime NULL ,
	approved_by varchar(50) null,
	pay_method int null,
	nip varchar(50) null,
	id int(11) NOT NULL auto_increment,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if($link->query($sql))$msg .="</br>- hr_emp_loan..OK";else $msg.="</br>- hr_emp_loan..<br>ERROR -" . mysql_error();

$sql=" 
CREATE TABLE hr_pph (
	kode varchar (50) character set utf8 NULL ,
	percent_value real NULL ,
	low_value double NULL ,
	high_value double NULL ,
	PRIMARY KEY  (kode)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_pph..OK";else $msg .="</br>- hr_pph..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_pph_form (
	id int(11) NOT NULL auto_increment,
	kelompok varchar (50) character set utf8 NULL ,
	nomor varchar (50) character set utf8 NULL ,
	keterangan varchar (250) character set utf8 NULL ,
	jumlah double NULL ,
	header bit null,
	rumus varchar(250) null,
	template varchar(50) null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_pph_form..OK";else $msg .="</br>- hr_pph_form..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_pph (
	id int(11) NOT NULL auto_increment,
	nip varchar (50) character set utf8 NULL ,
	nomor varchar (50) character set utf8 NULL ,
	jumlah double NULL ,
	tahun int NULL ,
	bulan int null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- employee_pph..OK";else $msg .= "</br>- employee_pph..<br>ERROR -" . mysql_error();
$sql=" 

CREATE TABLE hr_shift (
	kode varchar (50) character set utf8 NOT NULL ,
	time_in datetime NULL ,
	time_out datetime NULL ,
	different_day bit NULL ,
	PRIMARY KEY  (kode)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_shift..OK";else $msg .="</br>- hr_shift..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE employee_shift (
	id int(11) NOT NULL auto_increment,
	nip varchar (50) character set utf8 NULL ,
	kode_shift varchar (50) character set utf8 NULL ,
	tanggal datetime NULL ,
	keterangan int NULL ,
	tcid varchar(50) null,
	PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_shift..OK";else $msg .="</br>- hr_shift..<br>ERROR -" . mysql_error();

$sql=" 

CREATE TABLE hr_ptkp (
	kode varchar (50) character set utf8 NOT NULL ,
	keterangan varchar(50) null,
	jumlah double NULL ,
	PRIMARY KEY  (kode)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($link->query($sql))$msg .="</br>- hr_ptkp..OK";else $msg .="</br>- hr_ptkp..<br>ERROR -" . mysql_error();

$sql=" 

INSERT INTO hr_ptkp(kode,keterangan,jumlah)
values('K0','KAWIN ANAK 0',26326000),
('K1','KAWIN ANAK 1',28350000),
('K2','KAWIN ANAK 2',30375000),
('K3','KAWIN ANAK 3',32400000),
('TK','BELUM KAWIN',24300000);";
if($link->query($sql))$msg .="</br>- hr_ptkp..OK";else $msg .="</br>- hr_ptkp..<br>ERROR -" . mysql_error();
?>