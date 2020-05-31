<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Categories extends CI_Controller {
	private $success=false;
	private	$message="";
	private $sql="select * from inventory_categories";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index() {
		$this->browse();
	}
	function browse($page=0,$limit=10)
	{
		$data['message']='';
		$data['breadcrumb']=array(array("url"=>"categories/browse","title"=>"Categories"));	
		$data['page']=$page;
		$data['limit']=$limit;
		$data['cmd']='list';
		$this->template_eshop_admin->display('eshop/admin/category',$data);		
	}
	
	function add(){
		$data=data_table('inventory_categories');
		$data['caption']='Addnew Category';
		$data['mode']='add';
		$breadcrumb=array(
			array("url"=>"categories/browse","title"=>"Items"),
			array("url"=>"categories/add","title"=>"Addnew")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
		$this->template_eshop_admin->display("eshop/admin/category",$data);
	}
	
	function view($id) {	
		if($id==""){
			header("location: ".base_url()."index.php/eshop_admin/categories/browse");
			exit;
		}
		$id=urldecode($id);
		
		$this->sql.=" where kode='$id'";
		$record=$this->db->query($this->sql)->result();
		$data=to_array($record); 
		
		$data['caption']="Manage Category";
		$data['item_id']=$id;
		$data['mode']='view';
		$breadcrumb=array(
			array("url"=>"categories/browse","title"=>"Categories"),
			array("url"=>"categories/view/".$id,"title"=>"Edit")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
		$this->template_eshop_admin->display("eshop/admin/category",$data);
	}	
	function load_json($id){
		$id=urldecode($id);
		$ok=false;	$message="";	$data2['success']=false;
		$data2['message']="Error";
		if($q=$this->db->select("kode,category,item_picture,parent_id")->where("kode",$id)
			->get("inventory_categories"))
		{
			$item=$q->row();
			$data['kode']=$item->kode;	
			$data['category']=$item->category;	
			$data['item_picture']=$item->item_picture;	
			$data['parent_id']=$item->parent_id;	
			$data['success']=true;
			$data['message']="Berhasil";
		}
		echo json_encode($data);
	}
	function upload_foto($field){
		$config['upload_path'] = './tmp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if($this->upload->do_upload($field)){
			$data=$this->upload->data();
			return $data['file_name'];
		} else { 
			echo  $this->upload->display_errors();
			return null; 
		}
	}
	function delete($id) {
		$id=urldecode($id);
		$data['success']=$this->db->where("kode",$id)->delete("inventory_categories");
		$data['message']="OK";
		echo json_encode($data);
	}
	function save(){
		$data=$this->input->post();
		$mode=$data['mode'];
		unset($data['mode']);
		if($_FILES['img_item_picture']['name']!=""){
			$data['item_picture']=$this->upload_foto('img_item_picture');
		}
		if($_FILES['img_icon_picture']['name']!=""){
			$data['icon_picture']=$this->upload_foto('img_icon_picture');
		}
		$item_no=$data['kode'];
		if($mode=="add"){
			$ok=$this->db->insert("inventory_categories",$data);
		} else {
			unset($data['kode']);
			$ok=$this->db->where("kode",$item_no)->update("inventory_categories",$data);
		}
		$data2['success']=$ok;
		if($ok){
			$data2['message']="Berhasil.";
		} else {
			$data2['message']="Gagal.";
		}
		echo json_encode($data2);
	}	
}