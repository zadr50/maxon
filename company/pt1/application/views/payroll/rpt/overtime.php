<?php
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($this->access->cid)->row();
$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
$nip=$this->input->post('text1');
$divisi=$this->input->post('text2');
$period=$this->input->post('text3');
$sql="select e.nip,e.nama,t.tanggal,
t.time_in,t.time_out,t.time_total 
 from overtime_detail t 
 left join employee e on e.nip=t.nip 
 where t.tanggal between '$date1' and '$date2' 
  ";
if($nip!="")$sql.=" and e.nip='$nip'";
$sql.=" order by t.tanggal";

 $data['content']=browse_select( array('sql'=>$sql));
$data['caption']='DAFTAR OVERTIME';
echo load_view('simple_print.php',$data);    

?>
