<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Media extends CI_Controller {
	private $success=false;
	private	$message="";
	private $table_name="articles";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form','file'));
		$this->load->library('template_eshop_admin');
	}
	function index() {	
		$data['message']='';
		$data['caption']="Media Collection";
		$data['folder_images']=$this->sysvar->getvar('folder_images','tmp');
		$data['img_files']=get_filenames($data['folder_images']);
		$data['title']='';
		$data['description']='';
		$data['filename']='';
		$data['id']='';
		$data['mode']='add';
		$this->template_eshop_admin->display('eshop/admin/media',$data);
	}
	function save() {
		$data=$this->input->post();
		$id=$data['id'];
		$mode=$data['mode'];
		unset($data['mode']);
		$filename='';
		if($_FILES['img_filename']['name']!=""){
			$filename=$this->upload_foto('img_filename');
			$data['filename']=$filename;
		}		
		if($mode=="edit") {
			unset($data['id']);
			$ok=$this->db->where("id",$id)->update("media_list",$data);
		} else {
			unset($data['id']);
			$ok=$this->db->insert("media_list",$data);
		}
		$ok=true;
		$message='Data sudah disimpan.';
		echo json_encode(array("success"=>$ok,'message'=>$message));		
	}
	function upload_foto($field){
		$folder_images=$this->sysvar->getvar('folder_images','tmp');
		$config['upload_path'] = './'.$folder_images.'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$this->load->library('upload', $config);
		if($this->upload->do_upload($field)){
			$data=$this->upload->data();
			return $data['file_name'];
		} else { 
			echo  $this->upload->display_errors();
			return null; 
		}
	}
	
}
?>