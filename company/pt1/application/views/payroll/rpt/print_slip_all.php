<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">

<?php 
    $CI =& get_instance();
    $CI->load->model('company_model');
    $model=$CI->company_model->get_by_id($this->access->cid)->row();
    
    $CI->load->model('payroll/paycheck_sal_com_model');
    $CI->load->model("payroll/employee_model");

    $dept=$this->input->post('text1');
    $divisi=$this->input->post('text2');
    $period=$this->input->post('text3');
    $sql="select pay_no,pay_period,employee_id,e.nama,p.dept,p.divisi, 
    p.total_pendapatan,p.total_potongan,pay_date,from_date,to_date
     from hr_paycheck p 
     left join employee e on e.nip=p.employee_id where 1=1 ";
    if($dept!="")$sql.=" and p.dept='$dept'";
    if($divisi!="")$sql.=" and p.divisi='$divisi'";
    if($period!="")$sql.=" and pay_period='$period'";
    
    if($query=$CI->db->query($sql)) {
        foreach($query->result() as $pay) {
            $emp=$CI->employee_model->get_by_id($pay->employee_id)->row();
            $CI->paycheck_sal_com_model->employee_id=$emp->nip;
            $CI->paycheck_sal_com_model->paycheck_no=$pay->pay_no;
            $CI->paycheck_sal_com_model->init();
            $absensi=$CI->paycheck_sal_com_model->absensi_list();
            $pendapatan=$CI->paycheck_sal_com_model->tunjangan_list();
            $potongan=$CI->paycheck_sal_com_model->potongan_list();
        
            include_once "print_slip.php";   
        }
        
    }
?>

 
