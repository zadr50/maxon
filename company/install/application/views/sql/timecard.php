<?php
$table='time_card_detail';
 
$sql=" 

CREATE TABLE time_card_detail (
	id int(11) NOT NULL auto_increment,
	salary_no int not null,
	nip varchar(50) not null,
	absen_type int null,
	shift_code varchar(10) null,
	work_status int null,
	tanggal datetime NULL,
	time_in varchar(5) null,
	time_out varchar(5) null,
	time_hour varchar(5) null,
	ot_in varchar(5) null,
	ot_out varchar(5) null,
	ot_hour varchar(5) null,
	ot_type varchar(10) null,
	ot_exclude int null,
	ot_amount double null,
	tc_1 real null,
	tc_2 real null,
	tc_3 real null,
	tc_4 real null,
	tc_sum real null,
	tc_run real null,
	tc_exp real null,
	free_in varchar(5) null,
	free_out varchar(5) null,
	free_hour varchar(5) null,
	
	PRIMARY KEY  (id) 
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table='time_card';

$sql=" 

create view qry_payroll_component as 
select 'income' as jenis, kode,keterangan,sifat,is_variable,ref_column from jenis_tunjangan
union all
select  'deduct' as jenis,  kode,keterangan,sifat,is_variable,ref_column from jenis_potongan;";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

$table='time_card';

$sql=" 


create table sys_log_run (
	id int(11) NOT NULL auto_increment,
	user_id varchar(50),
	url varchar(200),
	controller varchar(50),
	method varchar(50),
	param1 varchar(50),
	PRIMARY KEY  (id) 
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if(mysqli_query($link,$sql))$msg .="<br>-$table..OK";else $msg .="<br>-$table..<br>ERROR -" . mysqli_error($link);

?>