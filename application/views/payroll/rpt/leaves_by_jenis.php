<?php
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($this->access->cid)->row();
$date_from=$this->input->post('txtDateFrom');
$date_to=$this->input->post('txtDateTo');
$sql="select v.keterangan as jenis_cuti,e.nip,e.nama,e.sisa_cuti,
l.from_date,l.to_date,l.leave_day,l.reason,l.doc_type
from hr_leaves l left join employee e on e.nip=l.nip 
left join system_variables v on v.varvalue=l.doc_type 
where l.from_date between '$date_from' and '$date_to' 
 and varname='lookup.doc_type_cuti' 
 order by v.keterangan,e.nip";
//if($dept!="")$sql.=" and dept='$dept'";
//if($divisi!="")$sql.=" and divisi='$divisi'";
$data['content']=browse_select( array('sql'=>$sql));
$data['caption']='DAFTAR CUTI KARYAWAN BY JENIS CUTI';
echo load_view('simple_print.php',$data);    

?>
