<?php
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($this->access->cid)->row();
if($CI->input->post()){
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$nip=$this->input->post('text1');
	$divisi=$this->input->post('text2');
	$period=$this->input->post('text3');	
}
$tarif=0;
$nama="";
if($q=$this->db->query("select gp,nama,tjabatan from employee where nip='$nip'")){
	if($r=$q->row()){
		$tarif=round(($r->gp+$r->tjabatan)/173);
		$nama=$r->nama;
	}
}
$sql="select e.nip,e.nama,t.tanggal,
t.time_in,t.time_out,t.time_total,t.ttc_1x,(t.ttc_2x+t.ttc_3x+ttc_4x) as ttc_x, 
time_total_calc as ttc_tot,
t.ttc_1x*$tarif as ttc_1x_amt,
(t.ttc_2x+t.ttc_3x+t.ttc_4x)*$tarif as ttc_x_amt,
t.amount 
 from overtime_detail t 
 left join employee e on e.nip=t.nip 
 where t.tanggal between '$date1' and '$date2' 
  ";
if($nip!="")$sql.=" and e.nip='$nip'";
$sql.=" order by t.tanggal";


 $data['content']=browse_select( array('sql'=>$sql,
 'fields_sum'=>array("ttc_1x","ttc_x","ttc_tot","ttc_1x_amt","ttc_x_amt","amount")));
$data['caption']='DAFTAR OVERTIME';
$data["criteria"]="Nip: $nip, Nama: $nama, Tarif: ".number_format($tarif);

echo load_view('simple_print.php',$data);    

?>
