<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Articles extends CI_Controller {
	private $success=false;
	private	$message="";
	private $table_name="articles";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index() {	
		$data=data_table('articles');
		$data['message']='';
		$data['caption']="List Articles";
		$data['cmd']='list';
		$this->template_eshop_admin->display('eshop/admin/articles',$data);
	}
	function view($id='') {
		$id=urldecode($id);
		if($id==''){
			$this->index();
			exit;
		}
		$record=$this->db->where("id",$id)->get("articles")->row();
		$data=data_table('articles',$record); 
		$data['message']='';
		$data['caption']="View Articles";
		$data['cmd']='view';
		$data['mode']='view';
		$this->load->library('ckeditor'); 
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy',
				'Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList',
				'BulletedList' )
                );
		$this->ckeditor->config['language'] = 'it';
		$this->ckeditor->config['width'] = '730px';
		$this->ckeditor->config['height'] = '500px';          
		
		$this->template_eshop_admin->display('eshop/admin/articles',$data);
	}
	function add() {
		$data=data_table('articles'); 
		$data['message']='';
		$data['caption']="Addnew Articles";
		$data['cmd']='add';
		$data['mode']='add';
		$this->template_eshop_admin->display('eshop/admin/articles',$data);
	}
	function save(){
		$data=$this->get_posts();
 
		if(isset($data['date_post'])){
			$date_post=$data['date_post'];
		} else {
			$date_post=date("Y-m-d H:i:s");
		}
		$data['date_post']=date("Y-m-d H:i:s",strtotime($date_post));
		$data['category']='eshop';
		$data['author']=user_id();
		$id=$this->input->post("id");
			
		if($id>0){
			unset($data['id']);
			$ok=$this->db->where("id",$id)->update("articles",$data);
		} else {
			unset($data['id']);
			$ok=$this->db->insert("articles",$data);
		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$this->db->insert_id(),'message'=>'Data sudah disimpan.'));
		} else {
			echo json_encode(array("success"=>false,"message"=>"Error ".mysql_error()));
		}
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function delete($id){
		$id=urldecode($id);
		$ok=$this->db->where("id",$id)->delete("articles");
		$this->index();
	}
	
}
?>