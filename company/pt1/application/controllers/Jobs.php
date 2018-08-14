<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Jobs extends CI_Controller {
	private $limit=10;
   	private $table_name='modules_groups';
    private $sql="select user_group_id,user_group_name,description from modules_groups";
    private $file_view='admin/user_jobs';
	private $controller="jobs";
	private $primary_key="user_group_id";

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
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('user_jobs_model');
        $this->load->model('modules_groups_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            return $data;
	}
	function index()
	{	
		if (!allow_mod2('_00010')){
			if($this->access->user_id!="admin") exit;
		}
        $this->browse();
	}
	function get_posts(){
        $data=  data_table_post($this->table_name);
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
		 	$modules=$this->input->post('modules');
		 	$group_id=$this->input->post('user_group_id');
			$this->modules_groups_model->save($data);		
			 
			if($modules)$this->modules_groups_model->save_module($group_id,$modules);
            $message='Update Success';
            $data['mode']='view';
			
			$this->syslog_model->add($group_id,"jobs","add");

            $this->browse();
		} else {
			$data['mode']='add';
			$data['message']='';
			$data['modules']='';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function save()
	{   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
		 	$modules=$this->input->post('modules');
		 	$group_id=$this->input->post('user_group_id');
			$this->modules_groups_model->save($data);		
			if($modules)$this->modules_groups_model->save_module($group_id,$modules);
            $message='Update Success';
            $data['mode']='view';
			$ok=true;
			$this->syslog_model->add($group_id,"jobs","edit");

		} else {
			$ok=false;
		}	
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>"Ada kesalahan input tidak bisa simpan."));
		}
	}	
	 
	function view($id,$message=null){
		 $id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->modules_groups_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
		 $data['modules']=$this->list_modules($id);
         $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('user_group_id','User Group Id', 'required|trim');
		 $this->form_validation->set_rules('user_group_name','User Group Name',	 'required');
	}
   function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']='jobs';
		$data['fields_caption']=array('User Group','Nama User Group','Keterangan');
		$data['fields']=array('user_group_id','user_group_name','description');
		$data['field_key']='user_group_id';
		$data['caption']='DAFTAR USER JOB';
		$data['print_visible']=true;

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama user","sid_nama");
		$faa[]=criteria("Kelompok","sid_kel");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get('sid_nama')!='')$sql.=" user_group_id like '".$this->input->get('sid_nama')."%'";
		if($this->input->get('sid_kel')!='')$sql.=" user_group_name like '".$this->input->get('sid_kel')."%'";
        echo datasource($sql);
    }	      
    
	function deletex($id){
		$this->load->model("modules_groups_model");
		$id=urldecode($id);
	 	$this->modules_groups_model->delete($id);
//	 	$this->browse();
		$this->syslog_model->add($id,"jobs","delete");

	}
	
	function list_modules_html($group_id,$filter=''){
		$group_id=urldecode($group_id);
		$filter=urldecode($filter);
		$html=$this->list_modules($group_id,$filter);
		echo $html;
	}
	function list_modules_json(){
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		$sql="select * from modules where parentid='$id'";
		echo datasource($sql);
	}
	function has_child($id){
		return $this->db->query("select * from modules where parentid='$id' limit 1")->num_rows();
	}
	function list_modules($group_id,$filter=''){
		$group_id=urldecode($group_id);
		$filter=urldecode($filter);
		$sql="select * from modules where (parentid='0' or parentid is null)";
		$sql.=" order by module_id";
		$modules=$this->db->query($sql);
		$tbl="<table class='table2', style='width:100%' data-options='singleSelect:true'>
		<thead><th>Cek</th><th data-options=\"field:'0'\">Module Name</th>
		<th data-options=\"field:'1'\">Module Description</th>
		</thead>
		<tbody>";
		 
		foreach($modules->result() as $row){
			if($this->modules_groups_model->exist($group_id,$row->module_id)){
				$checked='checked';
			} else {
				$checked="";
			}
			$tbl.="
			<tr>
			<td>
				<input type='checkbox' name='modules[]' value='".$row->module_id."' $checked>
			</td>
			<td><strong>".anchor("#",$row->module_name,"onclick=\"mod_expand('".$row->module_id."');return false;\"")."</strong></td>
			<td><strong>".$row->description." - (".$row->module_id.")</strong></td>
			</tr>
			";	
			$tbl .= $this->level2($row,$filter,$group_id);
		}
		$tbl.="
				<tr>
			</tbody>		
		</table>"; 
	   $s="
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
                <script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
            ";
		return $tbl;	
	}
	function level2($row,$filter,$group_id){
		$tbl="";
		$sql = "select * from modules 
		where parentid='".$row->module_id."'";
		if($filter!='') {
			$sql.=" and (module_id like '%$filter%' or module_name like '%$filter%')";	
		}
		$sql .= " order by module_id";

		if($mod_lvl_1=$this->db->query($sql)){
			foreach($mod_lvl_1->result() as $lvl1){
				if($this->modules_groups_model->exist($group_id,$lvl1->module_id)){
					$checked='checked';
				} else {
					$checked="";
				}
				$tbl.="<tr>
				<td><input type='checkbox' name='modules[]' value='".$lvl1->module_id."' $checked></td>
				<td>&nbsp&nbsp&nbsp".$lvl1->module_name."</td>	
				<td>&nbsp&nbsp&nbsp".$lvl1->description." (".$lvl1->module_id.")</td>	
				</tr>";
//						<td>".link_button("Edit","edit_module('".$lvl1->module_id."')","edit")."</td>
				$tbl.=$this->level3($lvl1,$filter,$group_id);
			}
		}
		return $tbl;
	}
	function level3($lvl1,$filter,$group_id){	
		$tbl="";
		$sql = "select * from modules 
		where parentid='".$lvl1->module_id."'"; 
		if($filter!='') {
			$sql.=" and (module_id like '%$filter%' or module_name like '%$filter%')";	
		}
		$sql .= " order by module_id";
		
		if($mod_lvl_2=$this->db->query($sql)) {
			foreach($mod_lvl_2->result() as $lvl2) {
				if($this->modules_groups_model->exist($group_id,$lvl2->module_id)){
					$checked='checked';
				} else {
					$checked="";
				}
				$tbl.="<tr>
				<td><input type='checkbox' name='modules[]' value='".$lvl2->module_id."' $checked></td>
				<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$lvl2->module_name."</td>	
				<td>".$lvl2->description." (".$lvl2->module_id.")</td>
				</tr>";
//								<td>".link_button("Edit","edit_module('".$lvl2->module_id."')","edit")."</td>
				
			}
		}						
		return $tbl;
	}
	function select($job=''){
		$job=urldecode($job);
		$sql="select user_group_id,user_group_name
		from modules_groups where 1=1";
		if($job!="")$sql.=" and user_group_name like '%$job%'";
		echo datasource($sql);	
	}
	function check($group_id,$module_id){
		$group_id=urldecode($group_id);
		$module_id=urldecode($module_id);
		$this->modules_groups_model->add_module($group_id,$module_id);
	}
	function un_check($group_id,$module_id){
		$group_id=urldecode($group_id);
		$module_id=urldecode($module_id);
		$this->modules_groups_model->delete_module($group_id,$module_id);
	}	
	function print_jobs()
	{
		$this->load->helper('browse_select');
		$data['caption']="JOB MODULES ROLES";
		$sql="select mg.user_group_id,mg.user_group_name
			,m.parentid,mp.module_name
			,ugm.module_id,m.module_name,m.description
			from modules_groups mg
			join user_group_modules ugm on ugm.group_id=mg.user_group_id
			join modules m on m.module_id=ugm.module_id
			left join modules mp on mp.module_id=m.parentid 
			where (m.parentid='_00000' or m.parentid='0' or m.parentid like '_%0000')";
		$data['content']=browse_select(	
		array('sql'=>$sql,
			'show_action'=>false,
			'group_by'=>array('user_group_id','parentid','module_id'),
			'hidden'=>array('user_group_id','user_group_name'),
			'order_column'=>'user_group_id,module_id'
			)
		);
		$data['header']=company_header();
		$this->load->view('simple_print.php',$data);    		
	}
}
