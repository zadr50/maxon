<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Modules extends CI_Controller {
    private $table_name='modules';
    private $field_key='module_id';
	private $sql="select module_id,module_name,description,parentid,form_name,type,sequence 
	from modules ";
	function __construct()
	{
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
        $this->load->model('modules_model');
		$this->load->model("syslog_model");
		
	}
	function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record); 
		$data['mode']='';
		$data['message']='';
		return $data;
	}
	function index()
	{	
		$this->modules('_00000');
	}
	function modules($parent_id) {
		$parent_id=urldecode($parent_id);
		$data['parent_id']=$parent_id;
        $data['parent_id_list']=$this->modules_model->parent_id_list();
		$this->template->display_form_input("admin/module_list",$data);
	}
  
	function list_json($parent_id=""){
	    $kelompok="_00000";
        if($parent_id!="")$kelompok=$parent_id;
	    if($this->input->get("txtKelompok")){	        
	        $kelompok=$this->input->get("txtKelompok");
	    }
	    if($kelompok=="")$kelompok="_00000";
	    $this->modules_model->parent_id=$kelompok;
		$this->modules_model->module_list();
	}
	function get_posts(){
        $data=data_table_post($this->table_name);
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
	
		 $this->_set_rules();
		 if ($this->form_validation->run()){
			$data=$this->get_posts();
			if($this->input->post('mode')=='add'){ 
				$this->modules_model->save($data);
			} else {
				$this->modules_model->update($this->input->post('module_id'),$data);
			}
			$data['mode']='view';
            $message='Update Success';
			$this->view($this->input->post($this->field_key),$message);
		} else {
			$data['mode']='add';
			$data['message']='';
			$this->template->display_form_input(
            "admin/modules",$data,$this->table_name.'_menu');			
		}
	}
	function save()
	{   
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('module_id');
		  
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$mode=$this->input->post("mode");
			unset($data["mode"]);
			if($mode=="view"){
				$ok=$this->modules_model->update($id,$data);			
			} else {
				$ok=$this->modules_model->save($data);
			}
			$this->syslog_model->add($id,"modules",$mode);

		} else {
			$ok=false;
		}	
		if ($ok){
			echo json_encode(array('success'=>true,'module_id'=>$id));
		} else {
			echo json_encode(array('msg'=>"Ada kesalahan input !"));
		}
	}		
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post($this->field_key);
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$this->modules_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"modules","edit");

		} else {
			$message='Error Update';
		}
 		$this->view($id,$message);		
	}
	
	function view($id,$message=null){
		$id=urldecode($id);
		 $model=$this->modules_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['id']=$id;
		 $data['mode']='view';
         $data['message']=$message;
		 $this->template->display_form_input("admin/modules",$data,$this->table_name.'_menu');
	}
	function _set_rules(){	
		 $this->form_validation->set_rules(
                         $this->field_key,$this->field_key, 'required|trim');
	}

   function browse($offset=0,$limit=50,$order_column='module_id',$order_type='asc'){
		$data['controller']='modules';
		$data['fields_caption']=array('Kode','Nama Modul','Keterangan','Parent','Form Name','Type','No Urut');
		$data['fields']=array('module_id','module_name','description','parentid','form_name','type','sequence');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='module_id';
		$data['caption']='DAFTAR MODUL';

		$this->load->library('search_criteria');
		$faa[]=criteria("Nama Modul","sid_nama");
		$data['criteria']=$faa;
//        $data['with_tab']="false";
//        $data['view_file']="admin/modules";
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		if($this->input->get('sid_nama')!='')$sql.=" and module_name like '".$this->input->get('sid_nama')."%'";
        if($this->input->get('tb_search')){
            $search=$this->input->get("tb_search");
            $sql.=" and (module_id like '$search%' or module_name like '%$search%')";
        }
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";

        
        echo datasource($sql);
    }	 
	function delete($id){
		$id=urldecode($id);
	 	$this->modules_model->delete($id);
		$this->syslog_model->add($id,"modules","delete");

	 	$this->browse();
	}
	function find($module_id=''){
		$module_id=urldecode($module_id);
		if($query=$this->db->query($this->sql." where module_id='$module_id'")){
			echo json_encode($query->row_array());
		}
 	}

    function select($search=""){
        
        $search=urldecode($search);
        $sql=$this->sql;

        if($search!=""){
            $sql.=" where (module_id like '$search%' 
                or module_name like '$search%')";
        }
        $sql.=" order by module_id";

        $offset=0; $limit=10;
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";        
        
        echo datasource($sql);
    }	
}
