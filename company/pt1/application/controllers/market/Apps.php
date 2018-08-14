<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Apps extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template');
	}
	function index()
	{	
		$data['message']='';
		$data['free_themes']=$this->get_free_themes();
		$data['paid_themes']=$this->get_paid_themes();
		$data['page']='themes.php';
		$this->template->display_form_input('market/home',$data,'');
	}
	function view($id){
		$data['apps']=$this->db->where('id',$id)->get("maxon_market")->row();
		$this->template->display("market/view",$data);
	}
	function success(){
		$data['message']='Application Success Uploaded, please check on application/themes link.';
		$data['free_themes']=$this->get_free_themes();
		$data['paid_themes']=$this->get_paid_themes();
		$data['page']='themes.php';
		$this->template->display_form_input('market/home',$data,'');
	
	}
	function modules(){
		$data['message']='';
		$data['free_apps']=$this->get_free_apps();
		$data['paid_apps']=$this->get_paid_apps();
		$data['page']='modules.php';
		$this->template->display_form_input('market/home',$data,'');
	}
	function books(){
		$data['message']='';
		$data['free_books']=$this->get_free_books();
		$data['paid_books']=$this->get_paid_books();
		$data['page']='books.php';
		$this->template->display_form_input('market/home',$data,'');
	}
	function upload(){
		$this->success=false;
		$data['message']='';
		$data['page']='upload.php';
		$data['app_type']='';
		$data['app_desc']='';
		$data['app_title']='';
		$data['app_create_by']='';
		if($this->input->post()){
			$this->success=true;
			$data['app_type']=$this->input->post('app_type');
			$data['app_desc']=$this->input->post('app_desc');
			$data['app_title']=$this->input->post('app_title');
			$data['app_create_by']=$this->input->post('app_create_by');
			$data2=$this->input->post();
		}
		$data2['app_ico']=$this->file_upload('app_ico','market/images','gif|jpg|png','500');
		$data2['app_file']=$this->file_upload('app_file','market','*','2500');
		$data2['app_scr_1']=$this->file_upload('app_scr_1','market/images','gif|jpg|png','500');
		$data2['app_scr_2']=$this->file_upload('app_scr_2','market/images','gif|jpg|png','500');
		$data2['app_scr_3']=$this->file_upload('app_scr_3','market/images','gif|jpg|png','500');
		$data2['app_scr_4']=$this->file_upload('app_scr_4','market/images','gif|jpg|png','500');
		$data2['app_scr_5']=$this->file_upload('app_scr_5','market/images','gif|jpg|png','500');
		if($this->success){
			$ok=$this->db->insert("maxon_market",$data2);			
			$url=base_url()."index.php/market/apps/success";
			header("location: ".$url);
			return true;
		}
		$data['message']=$this->message;
		$this->template->display_form_input('market/home',$data,'');
		
	}
	function file_upload($fieldname,$folder,$filetype,$maxsize) {
		$new_file="";
		$this->load->library('upload');
 		if(isset($_FILES[$fieldname])){
			if($_FILES[$fieldname]['name']!=""){
				$config['upload_path'] = $folder;
				$config['allowed_types'] = $filetype;
				$config['max_size']	= $maxsize;
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload($fieldname)) {
					$this->message.= "<span>".$fieldname." : ". $this->upload->display_errors()."</span>";
					$this->success=false;
				} else {
					$this->message.= "<p>Success Upload ".$fieldname."</p>";
				}
				$new_file=$this->upload->file_name;
			}
		}
		return $new_file;
	}
		
	
	function get_free_apps(){
		return $this->db->where("lic_type","free")
		->where("app_type","apps")->get("maxon_market");
	}
	function get_paid_apps(){
		return $this->db->where("lic_type","paid")
		->where("app_type","apps")->get("maxon_market");
	}
	function get_free_themes(){
		return $this->db->where("lic_type","free")
		->where("app_type","themes")->get("maxon_market");
	}
	function get_paid_themes(){
		return $this->db->where("lic_type","paid")
		->where("app_type","themes")->get("maxon_market");
	}
	function get_free_books(){
		return $this->db->where("lic_type","free")
		->where("app_type","books")->get("maxon_market");
	}
	function get_paid_books(){
		return $this->db->where("lic_type","paid")
		->where("app_type","books")->get("maxon_market");
	}
	
 
}