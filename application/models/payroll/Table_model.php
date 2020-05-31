<?php
class Table_model extends CI_Model {
	function __construct(){
		parent::__construct();        
       
        
	}
	function check_tables(){
		$this->load->library("upgrade");
		$this->create_table_hr_period();	 
		$this->create_table_hr_paycheck();
		$this->create_table_hr_jenis_potongan();
		$this->create_table_hr_jenis_tunjangan();
		$this->create_table_hr_emp_level();
		$this->create_table_hr_emp_level_com();
		$this->create_table_hr_paycheck_sal_comp();
		$this->create_table_hr_leaves();
		$this->create_table_hr_jenis_absensi();
		$this->upgrade->add_field('hr_shift',"time_count","int");
		$this->upgrade->add_field('hr_shift',"time_rest","int");
		$this->upgrade->add_field('hr_shift',"time_rest_count","int");
        $this->upgrade->add_field('employee',"shift_group");
        $this->upgrade->add_field('employee',"is_resigned","int");
        $this->upgrade->add_field('employee',"resigned_date","datetime");
        $this->upgrade->add_field('employee_shift',"shift_group");
        $this->create_table_hr_emp_loan_schedule();
        
	}
   
    function create_table_hr_emp_loan_schedule(){
        $fields[]="loan_number nvarchar(50)";
        $fields[]="no_urut int";
        $fields[]="tanggal_jth_tempo datetime";
        $fields[]="awal double";
        $fields[]="pokok double";
        $fields[]="bunga double";
        $fields[]="angsuran double";
        $fields[]="akhir double";
        $fields[]="keterangan nvarchar(250)";
        
        $this->upgrade->create_table("hr_emp_loan_schedule",$fields);
    }
    
	function create_table_hr_jenis_absensi(){
		$fields[]="kode nvarchar(50)";
		$fields[]="keterangan nvarchar(250)";
		$this->upgrade->create_table("hr_jenis_absensi",$fields);
	}
	function create_table_hr_leaves(){
		$fields[]="nip nvarchar(50)";
		$fields[]="from_date date";
		$fields[]="to_date date";
		$fields[]="leave_type nvarchar(50)";
		$fields[]="leave_day nvarchar(50)";
		$fields[]="reason nvarchar(250)";
		$this->upgrade->create_table("hr_leaves",$fields);
	}
	
	
	function create_table_hr_paycheck_sal_comp(){
		$fields[]="pay_no nvarchar(50)";
		$fields[]="salary_com_code nvarchar(50)";
		$fields[]="salary_com_name nvarchar(150)";
		$fields[]="org_value double";
		$fields[]="calc_value double";
		$fields[]="unit nvarchar(50)";
		$this->upgrade->create_table("hr_paycheck_sal_comp",$fields);
	}
	
	function create_table_hr_emp_level_com(){
		$fields[]="level_code nvarchar(50)";
		$fields[]="no_urut int";
		$fields[]="salary_com_code nvarchar(50)";
		$fields[]="formula_string nvarchar(250)";
		$fields[]="take_home_pay int";
		$fields[]="keterangan nvarchar(250)";
		$this->upgrade->create_table("hr_emp_level_com",$fields);
	}
	function create_table_hr_emp_level(){
		$fields[]="kode nvarchar(50)";
		$fields[]="keterangan nvarchar(250)";
		$this->upgrade->create_table("hr_emp_level",$fields);
	}
	function create_table_hr_jenis_potongan(){
		$fields[]="kode nvarchar(50)";
		$fields[]="keterangan nvarchar(250)";
		$fields[]="sifat nvarchar(50)";
		$fields[]="is_variable int";
		$fields[]="ref_column nvarchar(50)";
		$this->upgrade->create_table("hr_jenis_potongan",$fields);
		
	}
	function create_table_hr_jenis_tunjangan(){
		$fields[]="kode nvarchar(50)";
		$fields[]="keterangan nvarchar(250)";
		$fields[]="sifat nvarchar(50)";
		$fields[]="is_variable int";
		$fields[]="ref_column nvarchar(50)";
		$this->upgrade->create_table("hr_jenis_tunjangan",$fields);
	}
	
	function create_table_hr_paycheck(){
		$fields[]="pay_no varchar(50)";
		$fields[]="pay_period varchar(50)";
		$fields[]="from_date date";
		$fields[]="to_date date";
		$fields[]="employee_id varchar(50)";
		$fields[]="bank_account_no varchar(50)";
		$fields[]="marital varchar(50)";
		$fields[]="dept varchar(50)";
		$fields[]="divisi varchar(50)";
		$fields[]="position varchar(50)";
		$fields[]="salary double";
		$fields[]="emp_level varchar(50)";
		$fields[]="pay_type varchar(50)";
		$fields[]="pay_date date";
		$fields[]="print_date date";
		$fields[]="create_by varchar(50)";
		$fields[]="create_date date";
		$fields[]="update_by varchar(50)";
		$fields[]="upddate_date date";
		$fields[]="posted int";
		$this->upgrade->create_table("hr_paycheck",$fields);
		
	}
	function create_table_hr_period(){
		$fields[]="period varchar(50)";
		$fields[]="period_name varchar(50)";
		$fields[]="from_date date";
		$fields[]="to_date date";
		$fields[]="status int";
		$this->upgrade->create_table("hr_period",$fields);
		
	}
}

?>