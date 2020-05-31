<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Slidder extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin','sysvar');
	}
	function index() {	
		$data['message']='';
		$data['caption']="Gambar untuk slider";
		$data['slider1']=$this->sysvar->getvar('slider1','images/slider1.jpg');
		$data['slider2']=$this->sysvar->getvar('slider2','images/slider2.jpg');
		$data['slider3']=$this->sysvar->getvar('slider3','images/slider3.jpg');
		$data['slider4']=$this->sysvar->getvar('slider4','images/slider4.jpg');
		$this->template_eshop_admin->display('eshop/admin/slidder',$data);
	}
	function save() 
	{
		if($_FILES['img_slider1']['name']!=""){
			$this->sysvar->save('slider1',$this->upload_foto('img_slider1'));
		}
		if($_FILES['img_slider2']['name']!=""){
			$this->sysvar->save('slider2',$this->upload_foto('img_slider2'));
		}
		if($_FILES['img_slider3']['name']!=""){
			$this->sysvar->save('slider3',$this->upload_foto('img_slider3'));
		}
		if($_FILES['img_slider4']['name']!=""){
			$this->sysvar->save('slider4',$this->upload_foto('img_slider4'));
		}
		$ok=true;
		$message='Data sudah disimpan.';
		echo json_encode(array("success"=>$ok,'message'=>$message));
		
	}
	function upload_foto($field){
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
//		$config['max_width']  = '1024';
//		$config['max_height']  = '768';
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