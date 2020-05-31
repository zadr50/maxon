<?php
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($this->access->cid)->row();
$dept=$this->input->post('text1');
$divisi=$this->input->post('text2');
$period=$this->input->post('text3');
$sql="select e.nama, 
p.total_pendapatan as pendapatan,p.total_potongan as potongan,
p.total_pendapatan-p.total_potongan as salary,
pay_no,pay_period,employee_id,p.dept,p.divisi
 from hr_paycheck p 
 left join employee e on e.nip=p.employee_id where 1=1 ";
 
$sql="
select p.employee_id,e.nama,e.divisi,e.emptype,e.status,e.bank_name,e.account,e.sisa_cuti,
p.pay_no,p.pay_period,p.from_date,p.to_date,p.salary,p.total_pendapatan,p.total_potongan,
c1.gaji_pokok,c2.tun_jabatan,c3.tun_makan,c4.medical_claim,c5.overtime,
c6.pot_makan,c7.pot_bpjs,c8.pot_pph21,c9.pot_unpaid_leave,c10.air_ticket,
c11.bpjs_tk,c12.pot_uang_makan,c13.pot_pinjaman
from hr_paycheck p
left join employee e on e.nip=p.employee_id
left join ( 
	select pay_no,org_value as gaji_pokok from hr_paycheck_sal_comp where salary_com_code='G_POKOK'
	) c1 on c1.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as tun_jabatan from hr_paycheck_sal_comp where salary_com_code='TJBT'
	) c2 on c2.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as tun_makan from hr_paycheck_sal_comp where salary_com_code='TJMKN'
	) c3 on c3.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as medical_claim from hr_paycheck_sal_comp where salary_com_code='MC'
	) c4 on c4.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as overtime from hr_paycheck_sal_comp where salary_com_code='OT'
	) c5 on c5.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as pot_makan from hr_paycheck_sal_comp where salary_com_code='PM'
	) c6 on c6.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as pot_bpjs from hr_paycheck_sal_comp where salary_com_code='BPJS'
	) c7 on c7.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as pot_pph21 from hr_paycheck_sal_comp where salary_com_code='PPH21'
	) c8 on c8.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as pot_unpaid_leave from hr_paycheck_sal_comp where salary_com_code='UP'
	) c9 on c9.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as air_ticket from hr_paycheck_sal_comp where salary_com_code='LB'
	) c10 on c10.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as bpjs_tk from hr_paycheck_sal_comp where salary_com_code='BPJSTK'
	) c11 on c11.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as pot_uang_makan from hr_paycheck_sal_comp where salary_com_code='POT_UMAKAN'
	) c12 on c12.pay_no=p.pay_no
left join ( 
	select pay_no,org_value as pot_pinjaman from hr_paycheck_sal_comp where salary_com_code='LOAN'
	) c13 on c13.pay_no=p.pay_no

where 1=1
"; 
if($dept!="")$sql.=" and p.dept='$dept'";
if($divisi!="")$sql.=" and p.divisi='$divisi'";
if($period!=""){
	$sql.=" and p.pay_period='$period'";
	
}
$data['content']=browse_select( array('sql'=>$sql,
'fields_sum'=>array(
	'salary','total_pendapatan','total_potongan',
	'gaji_pokok','tun_jabatan','tun_makan','medical_claim','overtime',
	'pot_makan','pot_bpjs','pot_pph21','pot_unpaid_leave','air_ticket',
	'bpjs_tk','pot_uang_makan','pot_pinjaman'
)

));
$data['caption']='DAFTAR SLIP GAJI';
echo load_view('simple_print.php',$data);    

?>
