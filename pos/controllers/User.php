<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class User extends CI_Controller {
	private $limit=10;
   	private $table_name='user';
    private $sql="select user_id,username,cid from user";
    private $file_view='admin/user';
	private $controller="user";
	private $primary_key="user_id";

	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('user_jobs_model');
		$this->load->model('modules_groups_model');
		$this->load->model('branch_model');
		//$this->load->model('user_group_modul_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
			$data['id']="";

			$this->load->library("list_of_values");

			$setting['dlgBindId']="divisions";
			$setting['dlgCols']=array( 
				array("fieldname"=>"div_code","caption"=>"Kode","width"=>"80px"),
				array("fieldname"=>"div_name","caption"=>"Nama Kelompok","width"=>"200px")
			);
			$setting['dlgRetFunc']="$('#divisions_search').val(row.div_code);";
			$data['lookup_division']=$this->list_of_values->render($setting);
			 
			$setting['dlgBindId']="warehouse";
			$setting['dlgCols']=array( 
				array("fieldname"=>"location_number","caption"=>"Gudang","width"=>"80px"),
				array("fieldname"=>"address_type","caption"=>"Jenis","width"=>"200px")
			);
			$setting['dlgRetFunc']="$('#warehouse_search').val(row.location_number);";
			$data['lookup_gudang']=$this->list_of_values->render($setting);

            return $data;
	}
	function index()
	{	
		if (!allow_mod2('_00020')){
			if($this->access->user_id!="admin") exit;
		}

		$this->list_info();
	}
	function get_posts(){
        $data=data_table_post($this->table_name);
		return $data;
	}
	function add()
	{
		if (!allow_mod2('_00021')) exit;
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$groups=$this->input->post('groups');
			$pilih=$this->input->post('pilih');
			unset($data['groups']);
			unset($data['pilih']);
			$user_id=$data['user_id'];
			$this->user_model->save($data);
			$data['jobs']=$pilih;
			$this->user_jobs_model->update($user_id,$data);
			$message='update success';
			$data['mode']='view';
			$this->syslog_model->add($user_id,"users","add");
			$this->browse();
		} else {
			$data['mode']='add';
			$data['joblist']=$this->modules_groups_model->get_all();
		 	$data['userjobs']="";
			$data['supervisor_list']=array_data_table('user','user_id','username');
			$data['branch_list']=array_data_table('branch','branch_code','branch_name');
			$this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update(){ 
		 $data=$this->set_defaults(); 
		 $this->_set_rules();
 		 $id=$this->input->post('user_id');
		 $user_id=$id;
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['jobs']=$this->input->post('jobs');
			$this->user_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"users","edit");

			$this->browse();
		} else {
			$message='Error Update';
			$this->view($id,$message);
		}	  
	}
 	function view($id,$message=null){
		if (!allow_mod2('_00020')) exit;
		 $id=urldecode($id);
		 $model=$this->user_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['id']=$id;
		 $data['mode']='view';
         $data['message']=$message;
		 $data['joblist']=$this->modules_groups_model->get_all();
		 $data['userjobs']=$this->user_jobs_model->list_jobs($id);
		 $data['supervisor_list']=array_data_table('user','user_id','username');
 		 $data['branch_list']=array_data_table('branch','branch_code','branch_name');
		 
         $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('user_id','User ID', 'required|trim');
		 $this->form_validation->set_rules('username','User Name', 'required|trim');
         $this->form_validation->set_rules('password','Password', 'required|trim');
         $this->form_validation->set_rules('cid','CID', 'required|trim');
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
        $data['controller']='user';
        $data['fields_caption']=array('User ID','Nama User','Kelompok');
        $data['fields']=array('user_id','username','cid');
        $data['field_key']='user_id';
        $data['print_visible']=true;
        $data['caption']='DAFTAR USER LOGIN';
        $data['list_info']=false;

        $this->load->library('search_criteria');
        $faa[]=criteria("Nama user","sid_nama");
        $faa[]=criteria("Kelompok","sid_kel");
        $data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_json($offset=0,$limit=100,$nama=''){
    	$this->browse_data($offset=0,$limit=100,$nama='');
	}
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
        if($this->input->get('sid_nama')!='')$sql.=" username like '".$this->input->get('sid_nama')."%'";
        if($this->input->get('sid_kel')!='')$sql.=" cid like '".$this->input->get('sid_kel')."%'";
        echo datasource($sql);
    }	      
    
	function deletex($id){
		if (!allow_mod2('_00023')) exit;
		$id=urldecode($id);
	 	$this->user_model->delete($id);
		$this->syslog_model->add($id,"user","delete");

	 	$this->browse();
	}
	function list_info($offset=0){
		if(isset($_GET['offset'])){
			$offset=$_GET['offset'];
		}
		$data['offset']=$offset;
		$this->load->library('search_criteria');

		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Kelompok","sid_kel");
	
		$data['criteria']=$faa;
		$data['criteria_text']=criteria_text($faa);
		$data['sid_nama']=$this->session->userdata('sid_nama');
		$data['sid_kel']=$this->session->userdata('sid_kel');
		
		$this->template->display_form_input('admin/info_list',$data);	
	}	
	function save()
	{   
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('user_id');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			//if($id=="admin")$data["password"]="admin";
			$mode=$this->input->post("mode");
			unset($data["mode"]);
			unset($data['path_image']);
			if($mode=="view"){
      	if($id=="admin")$data["password"]="admin";
				$ok=$this->user_model->update($id,$data);			
			} else {
				$ok=$this->user_model->save($data);
			}
		} else {
			$ok=false;
		}	
		if ($ok){
			echo json_encode(array('success'=>true,'user_id'=>$id));
		} else {
			echo json_encode(array('msg'=>"Ada kesalahan input !"));
		}
	}	
	function list_job($user_id) {
		$user_id=urldecode($user_id);
		$s="select uj.group_id,mg.user_group_name
		from user_job uj
		join modules_groups mg on uj.group_id=mg.user_group_id
		where uj.user_id='$user_id'";
		echo datasource($s);
	}
	function add_job(){
		$user_id=$this->input->get('user_id');
		$group_id=$this->input->get('job');
		$this->load->model('user_jobs_model');
		$this->user_jobs_model->add_job($user_id,$group_id);
	}
	function del_job($user_id,$group_id) {
		$user_id=urldecode($user_id);
		$group_id=urldecode($group_id);
		$this->db->query("delete from user_job where user_id='$user_id' and group_id='$group_id'");
	}
	function do_upload_picture()
	{
		//var_dump($_POST);
		//var_dump($_GET);
		//var_dump($_FILES);
		$user_id=$this->input->post('user_id_image');
		
		$config['upload_path'] = './tmp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$userfile=$this->input->get('userfile');

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' =>'Error upload !! Maximum size gambar 100kb');
		    echo json_encode($error);
		} else {
			$data=$this->upload->data();
			$this->db->query("update user set path_image='".$data['file_name']."' 
				where user_id='$user_id'");
			$data = array('success'=>'Sukses','upload_data' => $this->upload->data());
			echo json_encode($data);
		}
	}
	function preference(){
		if(!isset($_POST["submit"])){
			$data['last_running_visible']=$this->session->userdata('last_running_visible');
			$data['sidebar_position_left']=$this->session->userdata('sidebar_position')=="left"?1:0;
			$data['sidebar_position_right']=$this->session->userdata('sidebar_position')=="right"?1:0;
			$data['donate_visible']=$this->session->userdata('donate_visible');
			$data['google_ads_visible']=$this->sysvar->getvar('google_ads_visible','true');
			$data['chatbox_visible']=$this->session->userdata('chatbox_visible');
			$data['header_visible']=$this->session->userdata('header_visible');

			$this->template->display_form_input("preference",$data);
		} else {
			if($this->input->post("last_running_visible")){
				$this->session->set_userdata('last_running_visible',TRUE);
			} else {
				$this->session->set_userdata('last_running_visible',FALSE);			
			}
			$this->session->set_userdata('sidebar_position',$this->input->post("sidebar_position"));
			if($this->input->post("donate_visible")){
				$this->session->set_userdata('donate_visible',TRUE);
			} else {
				$this->session->set_userdata('donate_visible',FALSE);
			}
			$this->sysvar->save('google_ads_visible',$this->input->post("google_ads_visible"));

			if($this->input->post("chatbox_visible")){
				$this->session->set_userdata('chatbox_visible',TRUE);
			} else {
				$this->session->set_userdata('chatbox_visible',FALSE);
			}
			if($this->input->post("header_visible")){
				$this->session->set_userdata('header_visible',TRUE);
			} else {
				$this->session->set_userdata('header_visible',FALSE);
			}
			echo "Pengaturan sudah disimpan. Tekan refersh atau F5.";		
		}
	}
	function statistic(){
		header('Content-type: application/json');
		$data['label']="USER STATISTIC FOR PERIOD ".date("Y-M");
		$sql="select DATE_FORMAT(tgljam,'%d') as hari, count(1) as nval 
		from syslog
		where year(tgljam)=".date("Y")." and month(tgljam)=".date("m")."
		group by DATE_FORMAT(tgljam,'%d')
		order by tgljam asc
		limit 0,50";
		$query=$this->db->query($sql);
		$dt[]='';
		foreach($query->result() as $row){
			$prd=$row->hari;
			if($prd=="")$prd="00-00";
			$nval=$row->nval;
			if($nval==null)$nval=0;
			$dt[]=array($prd,$nval);
		}
		$data['data']=$dt;
		echo json_encode($data);
	}
	function stat_log(){
		header('Content-type: application/json');
		$sql="select userid,count(1) as nval 
		from syslog
		where year(tgljam)=".date("Y")." and month(tgljam)=".date("m")."
		group by userid
		limit 0,50";
		$query=$this->db->query($sql);
		foreach($query->result() as $row){
			$nval=$row->nval;
			if($nval==null)$nval=0;
			$dt[]=array($row->userid,$nval);
		}
		$data['label']="USER LOG FOR PERIOD ".date("Y-M");
		$data['data']=$dt;
		echo json_encode($data);
	}
	function log_activity_run(){
		$sql="select * from sys_log_run order by id desc limit 100";
		$data['syslog']=$this->db->query($sql);
		$this->template->display("log_list",$data);
		
	}
	function log_activity(){
		$sql="select * from syslog where 1=1";
		$nomor="";$jenis="";$user="";
		if($this->input->post()){
			if($nomor=$this->input->post('nomor')){
				if($nomor!="")$sql.=" and no_bukti='$nomor'";
			}
			if($user=$this->input->post('user')){
				if($user!="")$sql.=" and userid='$user'";
			}
			if($jenis=$this->input->post('jenis')){
				if($jenis!="")$sql.=" and jenis_cmd='$jenis'";
			}
			
		}
		$sql.=" order by tgljam desc limit 1000";
		$data["user"]=$user;
		$data["nomor"]=$nomor;
		$data["jenis"]=$jenis;
		
		$data['syslog']=$this->db->query($sql);
		$this->template->display("log_list",$data);
	}
	function roles($cmd,$user_id="",$type="",$id="")
	{	
		switch($cmd) {
		case "add":
			$data['user_id']=$this->input->get('user_id');
			$data['roles_type']=$type;
			$data['roles_item']=$this->input->get('roles_item');
			if($type=="1"){
				$data['description']=$this->db->select('div_name')
					->where('div_code',$data['roles_item'])
					->get('divisions')->row()->div_name;
			}
			if($type=="2"){
				$data['description']=$data['roles_item'];
			}
			$ok=$this->user_model->roles_add($data);
			break;
		case "update":
			$data['user_id']=$this->input->get('user_id');
			$data['roles_type']=$type;
			$data['roles_item']=$this->input->get('roles_item');
			$ok=$this->user_model->roles_update($id,$data);
			break;
		case "delete":
			$ok=$this->user_model->roles_delete($id);
			break;
		case "list":
			return $this->user_model->roles_list($user_id,$type);
			break;
		}
	}
	function print_user()
	{
		$this->load->helper('browse_select');
		$data['caption']="USERNAME AND ROLES";
		$sql="select u.username,mg.user_group_id,mg.user_group_name,mg.description
			,u.supervisor,u.active,u.branch_code,u.active
			from modules_groups mg
			join user_job uj on uj.group_id=mg.user_group_id
			join user u on u.user_id=uj.user_id";
		$data['content']=browse_select(	
		array('sql'=>$sql,
			'show_action'=>false,
			'group_by'=>array('username')
			)
		);
		$data['header']=company_header();
		$this->load->view('simple_print.php',$data);    		
	}
    function session(){
        $data=$this->input->post();
        $outlet="";
        $company="";
        if($data['shipping_location']!=""){
            $outlet=$data['shipping_location'];
            $this->session->set_userdata("session_outlet",$outlet);
            if($q=$this->db->query("select company_name from shipping_locations 
                where location_number='$outlet'")){
                if($r=$q->row()){
                    $company=$r->company_name;
                    $this->session->set_userdata("session_company_code",$company);
                    $data["company_code"]=$company;
                }
            }
        }
        echo json_encode($data);
    }
	
}
?>
