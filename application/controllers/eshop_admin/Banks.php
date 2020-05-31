<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Banks extends CI_Controller {
	private $success=false;
	private	$message="";
	private $tablename='bank_accounts';
	private $primary_key='bank_account_number';
	private $sql="";
	private $title='Rekening';
	private $file_view='banks';

	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('url','form'));
		$this->load->library('template_eshop_admin');
	}
	function index() {
		$this->sql="SELECT * FROM ".$this->tablename;
		$this->browse();
	}
	function browse($page=0,$limit=10)
	{
		$data['message']='';
		$data['breadcrumb']=array(array("url"=>"banks/browse","title"=>"Banks"));	
		$data['page']=$page;
		$data['limit']=$limit;
		$data['cmd']='list';

		if(!isset($page))$page=0;

		$this->load->library("browser");
		$browse=new browser();
		$config=array('tablename'=>$this->tablename,
			'primary_key'=>$this->primary_key,
			'order_by'=>$this->primary_key,
			'caption'=>$this->title,
			'controller'=>get_class($this),
			'page'=>$page,
			'fields'=>array(
				'bank_account_number'=>array("caption"=>"Nomor Rekening"),
				'bank_name'=>array('caption'=>'Nama Bank'),
				'contact_name'=>array('caption'=>'Pemilik'),
				'city'=>array('caption'=>'Cabang')
			)
		);
		$browse->init($config);
		$data['browse']=$browse->render(true);
		$this->template_eshop_admin->display('eshop/admin/banks',$data);		
	}
	function add() {
		$data=$this->set_default();
		$data['caption']='Tambah '.$this->title;
		$data['mode']='add';
		$breadcrumb=array(
			array("url"=>get_class($this),"title"=>$this->title),
			array("url"=>get_class($this).'/add',"title"=>"Addnew")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
		$this->template_eshop_admin->display("eshop/admin/".$this->file_view,$data);
	}
	function set_default() {
		$data=data_table($this->tablename);
		$data['mode']='add';
		return $data;
	}
	
	function load_json($id) 
	{
		$id=urldecode($id);
		$success=false;
		$message='Unknown $id';
		$data=$this->set_default();
		if($q=$this->db->where($this->primary_key,$id)->get($this->tablename))
		{
			if($row=$q->row())
			{
				$data=data_table($row);
				$success=true;
				$message='Loaded';
			}
		}
		$data['success']=$success;
		$data['message']=$message;
		echo json_encode($data);
	}
	function delete($id)
	{
		$id=urldecode($id); 
		$message="Success";
		if( !$success=$this->db->where($this->primary_key,$id)->delete($this->tablename) )
		{
			$message="Unable Delete Record.";
		}
		echo json_encode(array("result"=>$success,"message"=>$message));
	}
	function view($id)
	{
		$id=urldecode($id);
		
		$record=$this->db->query("select * from bank_accounts where ".$this->primary_key."='".$id."'")->row();
		$data=data_table($this->tablename,$record); 
		
		$data[$this->primary_key]=$id;
		$data['mode']='view';
		$breadcrumb=array(
			array("url"=>get_class($this)."/browse","title"=>$this->title),
			array("url"=>get_class($this)."/view/".$id,"title"=>"Edit")
		);
		$data['breadcrumb']=$breadcrumb;
		$data['cmd']='form';
		$data['caption']=$this->title;
		$this->template_eshop_admin->display("eshop/admin/".$this->file_view,$data);
	}
	function save(){
		$data=$this->input->post();
		$kode=$data[$this->primary_key];
		$mode=$data['mode'];
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->db->insert($this->tablename,$data);
		} else {
			unset($data[$this->primary_key]);
			$ok=$this->db->where($this->primary_key,$kode)->update($this->tablename,$data);
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