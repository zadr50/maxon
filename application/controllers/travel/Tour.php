<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Tour extends CI_Controller {
    private $limit=10;
    private $table_name='al_tourcode';
    private $sql="select tour_code,tour_name,agent,price,destination,start,until,market,note,curr_code
                from al_tourcode";
    private $file_view='travel/tour';
    private $primary_key='tour_code';
    private $controller='travel/tour';

    function __construct()    {
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
	        $this->load->library('sysvar');
            $this->load->library('template');
            $this->load->library('form_validation');
            $this->load->model('travel/tour_model');
    }
    function set_defaults($record=NULL){
            $data['mode']='';
            $data['message']='';
            $data=data_table($this->table_name,$record);
            return $data;
    }
    function index()    {	
            $this->browse();
    }
    function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
    }
    function add()   {
             $data=$this->set_defaults();
             $this->_set_rules();
             if ($this->form_validation->run()=== TRUE){
                    $data=$this->get_posts();
                    $this->tour_model->save($data);
		            $data['message']='update success';
		            $data['mode']='view';
		            $this->browse();
            } else {
                    $data['mode']='add';
                    $data['message']='';
                    $this->template->dont_load_js=true;
                    $this->template->display_form_input($this->file_view,$data);			
            }
    }
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("tour_code");
		$mode=$data["mode"];	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->tour_model->save($data);
		} else {
			$ok=$this->tour_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}	
    function update() {
             $data=$this->set_defaults();
             $this->_set_rules();
             $id=$this->input->post($this->primary_key);
             if ($this->form_validation->run()=== TRUE){
                    $data=$this->get_posts();
                    $this->tour_model->update($id,$data);
                    $message='Update Success';
                    $this->browse();
            } else {
                    $message='Error Update';
		            $this->view($id,$message);		
            }
    }

    function view($id,$message=null)	{
		$id=urldecode($id);
		$message=urldecode($message);
             $data[$this->primary_key]=$id;
             $model=$this->tour_model->get_by_id($id)->row();
             $data=$this->set_defaults($model);
             $data['mode']='view';
             $data['message']=$message;
            $this->template->display_form_input($this->file_view,$data);
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
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']='travel/tour';
		$data['fields_caption']=array('Kode','Nama Tour','Agent','Harga','Tujuan','Start','Until');
		$data['fields']=array('tour_code','tour_name','agent','price','destination','start','until');
		$data['field_key']=$this->primary_key;
		$data['caption']='DAFTAR KODE PAKET TOUR';

		$this->load->library('search_criteria');
		$faa[]=criteria("Dari","date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","date_to","easyui-datetimebox");
		$faa[]=criteria("Nama Tour","sid_nama");
		$data['criteria']=$faa;
        $this->template->dont_load_js=true;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $sql=$this->sql.' where 1=1';
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('date_to')));
		$sql.=" and start between '$d1' and '$d2'";		
		if($this->input->get('sid_nama')!='')$sql.=" tour_name like '".$this->input->get('sid_nama')."%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
	 	$this->tour_model->delete($id);
		$this->browse();
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select tour_name from $table_name where tour_code='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function detail($id) {
		$id=urldecode($id);
		$s="select * from al_tourdetail where tour_code='$id' order by day_no";
		echo datasource($s);
	}
	function add_detail($id) {
		$id=urldecode($id);
		$data=$this->input->post();
		$data['tour_code']=$id;
		unset($data['id']);
		$ok=$this->db->insert("al_tourdetail",$data);
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}	
	}
	function del_detail($id) {
		$id=urldecode($id);
		$this->db->where("id",$id);
		$this->db->delete("al_tourdetail");
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}	
	}
}
?>
