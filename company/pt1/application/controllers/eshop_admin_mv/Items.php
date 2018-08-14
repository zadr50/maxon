<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Items extends CI_Controller {
	private $success=false;
	private	$message="";
	private $sql="select item_number,description,category,sub_category,
			retail,cost,item_picture,unit_of_measure,item_picture2,item_picture3,
			item_picture4,special_features,sales_min,insr_name,weight,
			delivery_by,manufacturer
			from inventory";

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
		$data['breadcrumb']=array(array("url"=>"items/browse","title"=>"Items"));	
		$data['page']=$page;
		$data['limit']=$limit;
		$data['cmd']='list';
		$this->template_eshop_admin->display('eshop/admin/item',$data);		
	}
	function view($id='',$message='') {
		$id=urldecode($id);
		if($id==""){
			$this->browse();
		} else {
			$this->sql.=" where item_number='$id'";
			$record=$this->db->query($this->sql)->result();
			$data=to_array($record); 
			
			$data['caption']="Manage Item";
			$data['item_id']=$id;
			$data['mode']='view';
			$breadcrumb=array(
				array("url"=>"items/browse","title"=>"Items"),
				array("url"=>"items/view/".$id,"title"=>"Edit")
			);
			$data['breadcrumb']=$breadcrumb;
			$data['cmd']='form';
			$data['message']=$message;
			
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

			$this->template_eshop_admin->display("eshop/admin/item",$data);
		}
	}
	function add(){
		$data=array("item_number"=>"",'description'=>'','unit_of_measure'=>'',
		'retail'=>'','cost'=>0,'item_picture'=>'','item_picture2'=>'',
		'item_picture3'=>'','item_picture4'=>'','category'=>'',
		'sub_category'=>'','special_features'=>'','manufacturer'=>'',
		'sales_min'=>'','insr_name'=>'','weight'=>'',
		'delivery_by'=>''); 
		
		$data['caption']='Addnew Item Master';
		$data['mode']='add';
		$breadcrumb=array(
			array("url"=>"items/browse","title"=>"Items"),
			array("url"=>"items/add","title"=>"Addnew")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
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
		
		$this->template_eshop_admin->display("eshop/admin/item",$data);
	}
	function delete($id) {
		$id=urldecode($id);
		$data['success']=$this->db->where("item_number",$id)->delete("inventory");
		$data['message']="OK";
		echo json_encode($data);
	}
	function save(){
		$data=$this->input->post();
		$item_no=$data['item_number'];
		$mode=$data['mode'];
		unset($data['mode']);
		if($_FILES['img_item_picture_img']['name']!=""){
			$data['item_picture']=$this->upload_foto('img_item_picture_img');
		}
		if($_FILES['img_item_picture2_img']['name']!=""){
			$data['item_picture2']=$this->upload_foto('img_item_picture2_img');
		}
		if($_FILES['img_item_picture3_img']['name']!=""){
			$data['item_picture3']=$this->upload_foto('img_item_picture3_img');
		}
		if($_FILES['img_item_picture4_img']['name']!=""){
			$data['item_picture4']=$this->upload_foto('img_item_picture4_img');
		}
		$data['update_date']= date('Y-m-d H:i:s');
		$data['update_by']=cust_id();
		$data['create_by']=cust_id();
		if($mode=="add"){
			$ok=$this->db->insert("inventory",$data);
		} else {
			unset($data['item_number']);
			$ok=$this->db->where("item_number",$item_no)->update("inventory",$data);
		}
		$data2['success']=$ok;
		if($ok){
			$message="Data berhasil disimpan.";
			$controller=base_url()."index.php/eshop/item/browse";
			redirect($controller);
			//base_url().'index.php/eshop_admin/items'
		} else {
			$message="Data gagal disimpan.";
			$this->view($item_no,$message);
		}
	}	
	function upload_foto($field){
		$config['upload_path'] = './tmp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '5024';
		$config['max_height']  = '1768';
		$this->load->library('upload', $config);
		if($this->upload->do_upload($field)){
			$data=$this->upload->data();
			return $data['file_name'];
		} else { 
			echo  $this->upload->display_errors();
			return null; 
		}
	}
	function load_json($id){
		$id=urldecode($id);
		$ok=false;	$message="";	$data2['success']=false;
		$data2['message']="Error";
		if($q=$this->db->select("item_number,description,category,sub_category,
			retail,cost,item_picture,unit_of_measure,item_picture2,item_picture3,
			item_picture4,special_features")->where("item_number",$id)
			->get("inventory"))
		{
			$item=$q->row();
			$data['item_number']=$item->item_number;	
			$data['description']= strip_tags($item->description);	
			$data['category']=$item->category;	
			$data['sub_category']=$item->sub_category;	
			$data['retail']=$item->retail;	
			$data['cost']=$item->cost;	
			$data['item_picture']=$item->item_picture;	
			$data['unit_of_measure']=$item->unit_of_measure;
			$data['item_picture2']=$item->item_picture2;	
			$data['item_picture3']=$item->item_picture3;	
			$data['item_picture4']=$item->item_picture4;	
			$data['special_features']= strip_tags($item->special_features);
			$data['success']=true;
			$data['message']="Berhasil";
		}
		echo json_encode($data);
	}
	function set_default($model=null)
	{
		
	}
		
}
?>