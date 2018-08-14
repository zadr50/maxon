<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Help extends CI_Controller {
    private $table_name='articles';
    private $sql="select * from articles";
    private $file_view='help/article';
    private $primary_key='doc_name';
    private $controller='help';

	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model("article_model");
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
			$data['date_post']=date('Y-m-d 00:00:00');
			$data['category_list']=array("Purchasing","Sales","Inventory","Accounting","Fixed Asset","Payroll","Manufacure","Leasing","Hotel","Koperasi");
            return $data;
	}
	function index()
	{	
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	 
	function load($modul) {
		$modul=urldecode($modul);
		echo "<div class='widget-help'><div class=' glyphicon glyphicon-info-sign thumbnail'> 
			HELP_MOD : ".$modul." - [".link_button("EDIT","add_tab_parent('help/edit/$modul','"
			.base_url()."index.php/help/edit/".$modul."');","save","false")."]</div>";
		$this->load->model('article_model');
		$article=$this->article_model->get_by_id($modul);
		if($article){
			$content="";
			if($article->row()) $content=$article->row()->content;
			if($content=="") {
				echo "<p>Tampaknya untuk modul ini belum ada helpnya gan, mau ikut berkonstribusi membuatkan helpnya 
				dan tatacara input transaksi ini silahkan klik tautan [Edit] dibawah ini.</p>";
			} else {
				$content=str_replace('\r','</br>',$content);
				echo $content;
			}
		} 	
		echo " </div>";
	}
	function edit($modul) {
		$modul=urldecode($modul);
		 $model=$this->article_model->get_by_id($modul)->row();
		 $data=$this->set_defaults($model);
 		 $data['doc_name']=$modul;
		 $data['mode']='add';
         $data['message']="";
		$this->load->library('ckeditor'); 
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                );
		$this->ckeditor->config['language'] = 'it';
		$this->ckeditor->config['width'] = '730px';
		$this->ckeditor->config['height'] = '300px';          
		$this->template->display_form_input($this->file_view,$data,'');
	}
	function _set_rules(){	
		 $this->form_validation->set_rules($this->primary_key,'Kode', 'required|trim');
	}
		
	function save(){
		$mode=$this->input->post("mode");
		$this->_set_rules();
		
		$data=$this->get_posts();
 		$id=$data['doc_name'];
		$data['message']='Save Success';
		$data['mode']='view';
	
		if ($this->form_validation->run()=== TRUE){
			unset($data['message']);
			unset($data['mode']);
			if($mode=="add"){
				if($this->article_model->get_by_id($id)->row()){
					unset($data['doc_name']);
					$this->article_model->update($id,$data);
				} else {
					$this->article_model->save($data);
				}
				$data['message']=mysql_error();
				if($data['message']==''){
					$data['mode']='view';					
					$data['message']='Data sudah disimpan.';
				} else {
					$data['mode']='add';
				}
			} else {
				unset($data['doc_name']);
				$this->article_model->update($id,$data);
				$data['message']=mysql_error();
				if($data['message']==''){
					$data['message']='Data sudah disimpan.';
				}
				$data['mode']='view';
			}
			
		} else {
			$data['message']='Error Validation.';
		}
		$data['doc_name']=$id;
		$data['category_list']=array("Purchasing","Sales","Inventory","Accounting","Fixed Asset","Payroll","Manufacure");
		$this->template->display_form_input($this->file_view,$data,'');
	} 
	function doc_help(){
		echo "<p>Following this community you can interact with other user.</p>
		<li><a href='http://help.maxonerp.com'  target='_blank'>Maxon Tutorial</li>
		<li><a href='http://forum.maxonerp.com'  target='_blank'>Maxon ERP Forum</li>
		<li><a href='http://www.facebook.com/maxon51' target='_blank'>Maxon ERP Facebook</li>
		<li><a href='http://www.twitter.com/talagasoft' target='_blank'>Maxon ERP Twitter</li>";
	}
	function error(){
		echo "<p>Following this community you can submit error and interact with other user.</p>
		<li><a href='http://forum.maxonerp.com'>Maxon ERP Forum</li>
		<li><a href='http://www.facebook.com/maxon51' target='new'>Maxon ERP Facebook</li>
		<li><a href='http://www.twitter.com/talagasoft' target='new'>Maxon ERP Twitter</li>";
	}
 }
