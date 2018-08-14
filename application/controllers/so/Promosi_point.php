<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Promosi_point extends CI_Controller {
    private $limit=10;
    private $table_name='promosi_disc';
    private $sql="select * from promosi_disc";
    private $file_view='sales/promosi_point';
    private $primary_key='id';
    private $controller='so/promosi_point';

    function __construct()    {
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_model');
		$this->load->model('sales/promosi_model');
		$this->load->model('sales/promosi_item_model');
		$this->load->library('list_of_values');
    }
	function nomor_bukti($add=false)
	{
		$key="Promosi Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!PR~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!PR~$00001');
				$rst=$this->promosi_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	
	function set_defaults($record=NULL)
	{
		$data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		if($record==NULL)$data['promosi_code']=$this->nomor_bukti();
		
		$setting['dlgUrlQuery']=base_url()."index.php/inventory/filter";
		$setting['dlgBindId']="item_number";
		$setting['dlgCols']=array( 
			array("fieldname"=>"item_number","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"description","caption"=>"Nama Barang","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#item_number').val(row.item_number);";
		$data['lookup_item_number']=$this->list_of_values->render($setting);

		$setting['dlgUrlQuery']=base_url()."index.php/category/browse_data";
		$setting['dlgBindId']="category";
		$setting['dlgCols']=array( 
			array("fieldname"=>"kode","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"category","caption"=>"Kelompok","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#category').val(row.category);";
		$data['lookup_category']=$this->list_of_values->render($setting);

		$setting['dlgUrlQuery']=base_url()."index.php/category/browse_data";
		$setting['dlgBindId']="sub_category";
		$setting['dlgCols']=array( 
			array("fieldname"=>"kode","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"category","caption"=>"Kelompok","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#sub_category').val(row.kode);";
		$data['lookup_sub_category']=$this->list_of_values->render($setting);

		$setting['dlgUrlQuery']=base_url()."index.php/inventory/manufacturer/lookup";
		$setting['dlgBindId']="manufacturer";
		$setting['dlgCols']=array( 
			array("fieldname"=>"manufacturer","caption"=>"Merek","width"=>"80px")
		);
		$setting['dlgRetFunc']="$('#manufacturer').val(row.manufacturer);";
		$data['lookup_manufacturer']=$this->list_of_values->render($setting);

		$setting['dlgUrlQuery']=base_url()."index.php/inventory/model/lookup";
		$setting['dlgBindId']="model";
		$setting['dlgCols']=array( 
			array("fieldname"=>"model","caption"=>"Kode","width"=>"80px")
		);
		$setting['dlgRetFunc']="$('#model').val(row.model);";
		$data['lookup_model']=$this->list_of_values->render($setting);
		
		$setting['dlgUrlQuery']=base_url()."index.php/supplier/browse_data";
		$setting['dlgBindId']="supplier_number";
		$setting['dlgCols']=array( 
			array("fieldname"=>"supplier_number","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"supplier_name","caption"=>"Nama supplier","width"=>"200px")			
		);
		$setting['dlgRetFunc']="$('#supplier_number').val(row.supplier_number);";
		$data['lookup_supplier_number']=$this->list_of_values->render($setting);
		
		
		return $data;
	}
	function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
	}
	
    function index(){	
        $this->browse();
    }
 	function add()
	{
		 $data=$this->set_defaults();
		 
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['promosi_code']=$this->nomor_bukti(); 
			$this->promosi_model->save($data);
			$this->nomor_bukti(true);
		} else {
			$data['mode']='add';
			$data['message']='';
			$this->template->display_form_input($this->file_view,$data,'');			
		}        
	}
	
	function delete_items($id){
		$data['success']=true;
		if($this->db->where("id",$id)->delete($this->table_name)){
			$data['message']="Sukses.";
		} else {
			$data['success']=false;
			$data['message']=mysql_error();
		}
		echo json_encode($data);
	}
	function items($category){
		echo datasource("select * from promosi_item");
	}
    function load_items($page=0){
		$data['success']=true;
		$promosi_code=$this->input->get('promosi_code');
		$description=$this->input->get("description");
		$date_from=$this->input->get('date_from');
		$date_to=$this->input->get('date_to');
		$category=$this->input->get('category');
		$nilai=$this->input->get('nilai');
		$qty=$this->input->get('qty');
		
		$items=$this->input->get('items');
		
		$this->db->limit(100,$page*100);
		$this->db->where('category',6);
		$this->db->where('promosi_code',$promosi_code);
		$sql="select p.item_number,s.description,p.id from promosi_item p 
		left join inventory s on s.item_number=p.item_number";
		if($q=$this->db->query($sql)){
			$data['data']=$q->result_array();
		} else {
			$data['success']=false;
			$data['message']=$this->db->display_error();
		}
		echo json_encode($data);
    }
    function save()   {
		$mode=$this->input->post('mode');
		if($mode=="add"){
	        $id=$this->nomor_bukti();
		} else {
			$id=$this->input->post('promosi_code');			
		}
		$data=$this->input->post();
		$data['promosi_code']=$id;
		$data['category']=6;
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->promosi_model->save($data);
		} else {
			$ok=$this->promosi_model->update($id,$data);
		}
		if ($ok){
			if($mode=="add") $this->nomor_bukti(true);
			echo json_encode(array('success'=>true,'promosi_code'=>$id));
		} else {
			echo json_encode(array('success'=>false,'msg'=>mysql_error()));
		}
    }
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('promosi_code');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();			 
			$this->promosi_model->update($id,$data);
            $message='Update Success';
		} else {
			$message='Error Update';
		}                
 		$this->view($id,$message);		
	}
	function view($id,$message=null){
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->promosi_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
		 $this->template->display_form_input($this->file_view,$data);			
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('promosi_code','Promosi code', 'required|trim');
	}
	 
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('from_date',
		 'Format tanggal salah, seharusnya yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
	function search(){$this->browse();}
	
    function browse($offset=0,$limit=50,$order_column='promosi_code',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['_left_menu_caption']='Search';
		$data['fields_caption']=array('Kode Promo','Nama Promosi','Tgl Awal','Tgl Akhir');
		$data['fields']=array('promosi_code','description','date_from','date_to');
		$data['field_key']='promosi_code';
		$data['caption']='DAFTAR KODE PROMOSI';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Promosi Code","sid_code");
		$data['criteria']=$faa;
		$this->template->display_browse2($data);
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$nama_promo=$this->input->get('sid_nama');
		$no=$this->input->get('sid_nama');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql=$this->sql." where 1=1";
		if($no!=''){
			$sql.=" and promosi_code='$no'";
		} else {
			$sql.=" and date_from between '$d1' and '$d2'";
		}
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	function delete($id){
		$id=urldecode($id);
	 	$this->promosi_model->delete($id);
        $this->browse();
	}
    function detail(){
        $data['promsoi_code']=$this->input->get('promosi_code');
        $this->promosi_model->save($data);
		header("location: ".base_url()."index.php/so/promosi_point/view/".$data['promosi_code']);
    }
	function view_detail($nomor){
		$nomor=urldecode($nomor);
		$sql="select d.item_number,d.description
		from promosi_item d
		where promosi_code='$nomor'";
		echo browse_simple($sql);
    }
    function add_item(){
    	$nomor=$this->input->get('promsoi_code');            
        if(!$nomor){
            $data['message']='Kode promosi tidak diisi.!';
			return false;
        }
        $data['promosi_code']=$nomor;
        $this->load->view('so/promosi_point',$data);
    }
    function save_item(){
		$id=$this->input->post('promosi_item_id');
        $item_number=$this->input->post('item_number');
		$promosi_code=$this->input->post('promosi_code_item');
        $category=$this->input->post('category');
        $sub_category=$this->input->post('sub_category');
        $supplier_number=$this->input->post('supplier_number');
        $manufacturer=$this->input->post('manufacturer');
        $model=$this->input->post('model');
        $data['promosi_code']=$promosi_code;
        $data['item_number']=$item_number;
		if($id!=''){
			$ok=$this->promosi_item_model->update($id,$data);
		} else {
        	$sql="insert into promosi_item(promosi_code,item_number,description)
			 select '$promosi_code' as promosi_code,item_number,description 
			 from inventory where 1=1";
			if($category<>"")$sql.=" and category='$category'";
			if($sub_category<>"")$sql.=" and sub_category='$sub_category'";
			if($supplier_number<>"")$sql.=" and supplier_number='$supplier_number'";
			if($manufacturer<>"")$sql.=" and manufacturer='$manufacturer'";
			if($model<>"")$sql.=" and model='$model'";
			if($item_number<>"")$sql.=" and item_number='$item_number'";
			$ok=$this->db->query($sql);
		}
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('success'=>false,'msg'=>'Some errors occured.'));
		}
    }        
    function delete_item($id=0){
		$id=urldecode($id);
    	if($id==0)$id=$this->input->post('id');
        if($this->promosi_item_model->delete($id)) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
	
	
}
?>
