<?
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($this->access->cid)->row();
$dept=$this->input->post('text1');
$divisi=$this->input->post('text2');
$sql="select nip,nama,dept,divisi,kelamin,status,emptype,emplevel,alamat
 from employee ";
if($dept!="")$sql.=" and dept='$dept'";
if($divisi!="")$sql.=" and divisi='$divisi'";
$data['content']=browse_select( array('sql'=>$sql));
$data['caption']='DAFTAR KARYAWAN';
echo load_view('simple_print.php',$data);    

?>
