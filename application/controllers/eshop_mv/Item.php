<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Item extends CI_Controller {
	private $success=false;
	private	$message="";

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop');
	}
	function index() {}
	
	function view($item_id,$page="comments") {	
		if($item_id==""){
			header("location: ".base_url()."index.php/eshop/home");
		}
		$item_id=urldecode($item_id);
		$data['message']='';
		$data['item_id']=$item_id;
		$data['page']=$page;
		$view_count=0;
		$create_by='';
		$cust_id=cust_id();
		
		$create_by=$this->session->userdata('cust_id');
		if($q=$this->db->select('view_count,create_by')->where("item_number",$item_id)->get("inventory")){
				$item=$q->row();
				if($cust_id<>$item->create_by) {
					$view_count=$item->view_count+1;			
					$this->db->where("item_number",$item_id)->update("inventory",array("view_count"=>$view_count));
				}
				$create_by=$item->create_by;
		}
		
		if($cust_id==$create_by && $cust_id != ''){
			$data['item_number']=$item_id;
			$record=$this->db->query("select * from inventory where item_number='$item_id'")->result();
			$data=to_array($record); 
			$data['message']='';
			$this->template_eshop->display('eshop/admin/item',$data);
		} else {
			$this->template_eshop->display('eshop/item',$data);
		}
	}	
	function add() {
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
		
		$data['title']='Item Add';
		$data['cmd']='add';
		$data['message']='';
		$data['controller']=base_url()."index.php/eshop/item";
		$this->template_eshop->display('eshop/admin/item',$data);		
	}
	function beli($item_id,$qty=1) {
		$data['caption']='Kantong Belanja';
		if(! $cart=$this->session->userdata('cart')){
			$cart=array();
			$this->session->set_userdata("rowid",0);
		}
		$rowid=$this->session->userdata("rowid");
		$new=array("item_number"=>$item_id,"qty"=>$qty,'rowid'=>$rowid);
		array_push($cart,$new);
		$this->session->set_userdata("rowid",$rowid+1);
		$this->session->set_userdata('cart',$cart);
		$url=base_url()."index.php/eshop/item/view_cart";
		header("location: ".$url);
	}
	function del_cart($rowid) {
		$cart=$this->session->userdata('cart');
		$this->session->unset_userdata('cart');
		$new_cart=array();
		for($i=0;$i<count($cart);$i++){
			if($cart[$i]['rowid']!=$rowid){
				array_push($new_cart,$cart[$i]);
			}
		}
		$this->session->set_userdata('cart',$new_cart);
	}
	function view_cart(){
		$cart=$this->session->userdata('cart');	
		$data['cart']=$cart;
		$this->template_eshop->display("eshop/cart",$data);
	}
	function search() {
		$search_items=$this->input->post('search_items');
		$cat_id=$this->input->post('search_category');
		if($cat_id==""){
			$this->session->unset_userdata("current_category");
			$this->session->unset_userdata("price_from");
			$this->session->unset_userdata("price_to");
			$this->session->unset_userdata("sales_stat_type");
		}
		$this->session->set_userdata("current_category",$cat_id);
		$data['message']='';
		$data['cat_id']=$cat_id;
		$data['mode']='view';
		$data['cat']=$this->db->where("kode",$cat_id)->get("inventory_categories")->row();
		$data['cat_sub']=$this->db->select("kode,category")
					->where("parent_id",$cat_id)
					->get("inventory_categories");

		$price_from=$this->session->userdata('price_from');
		if(!$price_from)		$price_from=0;
		
		$price_to=$this->session->userdata('price_to');
		if(!$price_to)			$price_to=1000000;

		$price_range_type=$this->session->userdata('price_range_type');
		if(!$price_range_type)	$price_range_type=0;
		
		$this->db->select_max("retail",'price_max');
		if($cat_id){
			$this->db->where("category",$cat_id);
		}
		$price_max=$this->db->get("inventory")->row()->price_max;
		$price_max_2=$price_max/4;
		
		$data['price_range_type']=$price_range_type;
		$from=0;
		$to=$price_max;
		$price_from=0;
		for($i=0;$i<4;$i++){
			$price_from=$price_max_2*$i;
			$price_to=$price_max_2*($i+1);
			$var='range_price_'.($i+1);
			$data[$var]=number_format($price_from)." - ".number_format($price_to);
			if($price_range_type==$i){
				$from=$price_from;
				$to=$price_to;
			}
		}
		
		$data['price_from']=$price_from;
		$data['price_to']=$price_to;
		$data['price_max']=$price_max;
		$this->session->set_userdata("price_from",$price_from);
		$this->session->set_userdata("price_to",$price_to);
		
		$sales_stat_type=$this->session->userdata('sales_stat_type');
		if(!$sales_stat_type)	$sales_stat_type=0;
		
		if($cat_id){
			$this->db->where("category",$cat_id);
		}
		if( $search_items != "" ) {
			$this->db->like('description',$search_items);
		}
		$this->db->where("retail between $from and $to ","",FALSE);
		$this->db->select('item_number,description,item_picture,retail');
		if($sales_stat_type==0){	//item baru
			$this->db->order_by("view_count");
		}
		if($sales_stat_type==1){	//item paling banyak dilihat
			$this->db->order_by("view_count","desc");
		}	
		if($sales_stat_type==2){	// item terlaris
			$this->db->order_by("sales_count","de	sc");
		}
		$this->db->limit(20);
		$data['cat_items']=$this->db->get("inventory");
		$data['data']=$data;
		$data['sales_stat_type']=$sales_stat_type;
		$data['search_items']=$search_items;
		$data['search_category']=$cat_id;
		$this->template_eshop->display('eshop/category',$data);		
	}
	function browse($page=0,$limit=10) {
		$data['title']='Daftar Produk';
		$data['message']='';
		$data['breadcrumb']=array(array("url"=>"items/browse","title"=>"Items"));	
		$data['page']=$page;
		$data['limit']=$limit;
		$data['cmd']='list';
		$data['controller']=base_url()."index.php/eshop/item";;
		$this->template_eshop->display('eshop/admin/item',$data);		
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
		$data['update_by']=user_id();
		$data['create_by']=user_id();
		if($mode=="add"){
			$ok=$this->db->insert("inventory",$data);
		} else {
			unset($data['item_number']);
			$ok=$this->db->where("item_number",$item_no)->update("inventory",$data);
		}
		$data2['success']=$ok;
		if($ok){
			$message="Data berhasil disimpan.";
			redirect(base_url().'index.php/eshop/items');
		} else {
			$message="Data gagal disimpan.";
			$this->view($item_no,$message);
		}
	}	
}

?>