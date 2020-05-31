<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Set_toko extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {	
		$this->tab(1);
	}
	function tab($active_tab=1) {
		$message='';
		switch($active_tab){
			case 2:
				$title='Pengaturan Toko - Informasi Pengiriman';
				$page='eshop/set_toko_delivery';
				$data['provinsi']='';
				$data['kabupaten']='';
				$data['kota']='';
				$data['kode_pos']='';
				$data['jasa_kirim_list']=array('TIKI'=>'TIKI','POS'=>'POS',
				'RPX'=>'RPX','WAHANA'=>'WAHANA','CAHAYA'=>'CAHAYA');
				$data['jasa_kirim']='';
				$data['mode']='';
				$user_id=$this->session->userdata('cust_id');
				if($query=$this->db->where('user_id',$user_id)->get('eshop_toko')){
					if($rst=$query->row()){
						$data['provinsi']=$rst->provinsi;
						$data['kabupaten']=$rst->kabupaten;
						$data['kota']=$rst->kota;
						$data['jasa_kirim']=$rst->jasa_kirim;
						$data['kode_pos']=$rst->kode_pos;
						$data['id']=$rst->id;
						$data['mode']='edit';
						
					}
				}				
				if($this->input->post('submit_delivery')){
					$data['provinsi']=$this->input->post('provinsi');
					$data['kabupaten']=$this->input->post('kabupaten');
					$data['kota']=$this->input->post('kota');
					$jasa_kirim=$this->input->post('jasa_kirim');
					$js='';
					for($i=0;$i<count($jasa_kirim);$i++){
						$js.=$jasa_kirim[$i].',';
					}
					$data['jasa_kirim']=$js;
					$data['kode_pos']=$this->input->post('kode_pos');
					$data['user_id']=$user_id;
					$data['id']=$this->input->post('id');
					
					$id=$this->input->post('id');
					$mode=$this->input->post('mode');
					$ok=false;
					if($mode=='' and $id==0) {
						unset($data['mode']);
						$js=$data['jasa_kirim_list'];
						unset($data['jasa_kirim_list']);
						$ok=$this->db->insert('eshop_toko',$data);
						$data['id']=mysql_insert_id();
						$data['jasa_kirim_list']=$js;
					} else {
						unset($data['mode']);
						$js=$data['jasa_kirim_list'];
						unset($data['jasa_kirim_list']);
						$ok=$this->db->where('id',$id)->update('eshop_toko',$data);
						$data['jasa_kirim_list']=$js;
					}
					if($ok){
						$message='Data sudah disimpan.';
						$data['mode']='edit';
					} else {
						$data['mode']=$this->input->post('mode');
						$message='Gagal menyimpan data!';
					}
					
				}				
				break;
			case 3:
				$data['jenis_bayar_list']=array('REKBER'=>'REKBER', 
				'BCA'=>'BCA', 'MANDIRI'=>'MANDIRI');
				$data['jenis_bayar']='';
				$title='Pengaturan Toko - Informasi Pembayaran';
				$page='eshop/set_toko_payment';
				$data['mode']='';
				$user_id=$this->session->userdata('cust_id');
				if($query=$this->db->where('user_id',$user_id)->get('eshop_toko')){
					if($rst=$query->row()){
						$data['jenis_bayar']=$rst->jenis_bayar;
						$data['id']=$rst->id;
						$data['mode']='edit';						
					}
				}				
				if($this->input->post('submit_payment')){
					$jenis_bayar=$this->input->post('jenis_bayar');
					$id=$this->input->post('id');
					$mode=$this->input->post('mode');
					$js='';
					for($i=0;$i<count($jenis_bayar);$i++){
						$js.=$jenis_bayar[$i].',';
					}
					$data['jenis_bayar']=$js;
					$data['user_id']=$user_id;
					$data['id']=$id;
					
					$ok=false;
					if($mode=='' and $id==0) {
						unset($data['mode']);
						$js=$data['jenis_bayar_list'];
						unset($data['jenis_bayar_list']);
						$ok=$this->db->insert('eshop_toko',$data);
						$data['id']=mysql_insert_id();
						$data['jenis_bayar_list']=$js;
					} else {
						unset($data['mode']);
						$js=$data['jenis_bayar_list'];
						unset($data['jenis_bayar_list']);
						$ok=$this->db->where('id',$id)->update('eshop_toko',$data);
						$data['jenis_bayar_list']=$js;
					}
					if($ok){
						$message='Data sudah disimpan.';
						$data['mode']='edit';
					} else {
						$data['mode']=$this->input->post('mode');
						$message='Gagal menyimpan data!';
					}
					
				}				
				break;
			case 4:
				$title='Pengaturan Toko - Etalase';
				$page='eshop/set_toko_etalase';
				$data['mode']='';
				$user_id=$this->session->userdata('cust_id');
				$id=0;
				$data['nama_etalase']='';
				$data['keterangan']='';
				$data['kelompok']='';
				$data['banner_etalase']='';
				$data['id']=$id;
				if($query=$this->db->select('id')->where('user_id',$user_id)->get('eshop_toko')){
					if($rst=$query->row()){
						$id=$rst->id;
					}
				}				
				$data['etalase_list']=$this->db->where('id_toko',$id)->get('eshop_etalase');
				break;
			case 5:
				$title='Pengaturan Toko - Catatan';
				$page='eshop/set_toko_catatan';
				break;
			case 6:
				$title='Pengaturan Toko - Lokasi';
				$page='eshop/set_toko_lokasi';
				break;
			default:
				$title='Pengaturan Toko - Informasi Toko';
				$page='eshop/set_toko_general';
				$data['nama_toko']='';
				$data['slogan']='';
				$data['description']='';
				$data['status_toko']='';
				$data['foto_sampul']='';
				$data['id']='';
				$data['mode']='';
				$user_id=$this->session->userdata('cust_id');
				if($query=$this->db->where('user_id',$user_id)->get('eshop_toko')){
					if($rst=$query->row()){
						$data['nama_toko']=$rst->nama_toko;
						$data['slogan']=$rst->slogan;
						$data['description']=$rst->description;
						$data['status_toko']=$rst->status_toko;
						$data['foto_sampul']=$rst->foto_sampul;
						$data['id']=$rst->id;
						$data['mode']='edit';
					}
				}				
				if($this->input->post('submit_general')){
					$data['nama_toko']=$this->input->post('nama_toko');
					$data['slogan']=$this->input->post('slogan');
					$data['description']=$this->input->post('description');
					$data['status_toko']=$this->input->post('status_toko');
					$data['foto_sampul']=$this->input->post('foto_sampul');
					$data['user_id']=$user_id;
					$data['id']=$this->input->post('id');
					
					$id=$this->input->post('id');
					$mode=$this->input->post('mode');
					$ok=false;
					if($mode=='' and $id==0) {
						unset($data['mode']);
						$ok=$this->db->insert('eshop_toko',$data);
						$data['id']=mysql_insert_id();
					} else {
						unset($data['mode']);
						$ok=$this->db->where('id',$id)->update('eshop_toko',$data);
					}
					if($ok){
						$message='Data sudah disimpan.';
						$data['mode']='edit';
					} else {
						$data['mode']=$this->input->post('mode');
						$message='Gagal menyimpan data!';
					}
					
				}
		}
		$data['page']=$page;
		$data['title']=$title;
		$data['active_tab']=$active_tab;
		$data['message']=$message;
		$this->template_eshop->display("eshop/set_toko",$data);			
	}
}

?>