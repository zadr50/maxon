<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Articles extends CI_Controller {
    private $limit=10;
    private $table_name='articles';
    private $sql="select * from articles";
    private $file_view='articles';
    private $primary_key='id';
    private $controller='articles';
    
	function __construct()
	{
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
	}
	function set_defaults($record=NULL){
            
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            $data['date_post']=date("Y-m-d H:i:s");
            return $data;
	}
	function index()
	{	
            $this->browse();
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $data['mode']='add';
	     $this->template->display_form_input("article_edit",$data,'');
	}
	function save(){
		$data=$this->get_posts();
		$data['date_post']=date("Y-m-d H:i:s",strtotime($data['date_post']));
		$id=$this->input->post("id");
		if($id>0){
			unset($data['id']);
			$ok=$this->db->where("id",$id)->update("articles",$data);
		} else {
			unset($data['id']);
			$ok=$this->db->insert("articles",$data);
		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$this->db->insert_id()));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}
	
	function update(){
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post($this->primary_key);
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                    
            unset($data['id']);
            $this->db->where("id",$id)->update("articles");
            $message='Update Success';
		} else {
			$message='Error Update';
		}	  
        header('location: '.base_url().'index.php/articles/view/'.$id);
	}
	
	function view($id){
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->db->where("id",$id)->get("articles")->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
		$this->load->library('ckeditor'); 
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                );
		$this->ckeditor->config['language'] = 'it';
		$this->ckeditor->config['width'] = '730px';
		$this->ckeditor->config['height'] = '500px';          
         $this->template->display("article_edit",$data,'');		
	}
	function view_article($id,$message=null){
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->db->where("id",$id)->get("articles")->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
         $this->template->display_website("article_view",$data,'');	
	}
	function view_category($catid,$message=null){
		 $catid=urldecode($catid);
		 $data['mode']='view';
         $data['message']=$message;
		 $data['category']=$catid;
		 $data['hide_comments']=true;
         $this->template->display_website("articles",$data,'');	
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules($this->primary_key,'Kode', 'required|trim');
	}
	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'date format is not valid. yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Judul','Tanggal','Author','Category','Doc Name',"Id");
		$data['fields']=array('title','date_post','author','category','doc_name','id');
		$data['field_key']='id';
		$data['caption']='DAFTAR ARTIKEL';
		$data['col_width']=array("title"=>400);
		$this->load->library('search_criteria');
		$faa[]=criteria("Judul","sid_title");
		$faa[]=criteria("Category","sid_category");
		$faa[]=criteria("Pembuat","sid_author");
		
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$judul=$this->input->get('sid_judul');
		$category=$this->input->get('sid_category');
		$author=$this->input->get('sid_author');
        $sql=$this->sql." where 1=1";
		if($judul!='')$sql.=" and title like '%$judul%'";	
		if($category!='')$sql.=" and category like '%$category%'";	
		if($author!='')$sql.=" and author like '%$author%'";	
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	 
	
}
