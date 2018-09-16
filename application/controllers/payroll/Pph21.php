<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Pph21 extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='pph21_form';
    private $sql="select * from pph21_form ";
    private $file_view="pph21";
    private $controller="payroll/pph21";
    private $field_key="id";
    
    function __construct()
    {
        parent::__construct();
                 
        if(!$this->access->is_login())header("location:".base_url());
        $this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('template');
        $this->load->library('form_validation');
        $this->load->model("payroll/pph21_model");

    }
    function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record);
        $data['lookup_employee']=$this->list_of_values->lookup_employee();        
        $data['mode']='';
        $data['message']='';
        return $data;
    }
    function index(){
        $this->browse();
    }

    function add()  {
        $data=$this->set_defaults();           
        $this->_set_rules();
        $data['mode']='add';
        $this->template->display_form_input('payroll/'.$this->file_view,$data);
    }
    function save(){
         $this->_set_rules();
         if ($this->form_validation->run()=== TRUE){            
            $data=$this->input->post();
            $id=$data["id"];
            $mode=$data["mode"];
            unset($data['mode']);
            if($mode=="add"){
                unset($data['id']); 
                $ok=$this->pph21_model->save($data);
            } else {
                $ok=$this->pph21_model->update($id,$data);               
            }
            if($ok){echo json_encode(array("success"=>true,"id"=>$id));} 
            else {echo json_encode(array("msg"=>"Error "));}
         }  
         else {echo json_encode(array("msg"=>"Error ".validation_errors()));}
    }
    function view($id,$message=null){
         $id=urldecode($id);
         $model=$this->pph21_model->get_by_id($id)->row();
         $data=$this->set_defaults($model);
         $data['mode']='view';
         $data['message']=$message;
         $this->template->display_form_input('payroll/'.$this->file_view,$data);
    }
    function _set_rules(){  
         $this->form_validation->set_rules('nip','Isi NIP Pegawai', 'required|trim');
    }
           
    function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')  {
        $data['caption']='DATA PPH21';
        $data['controller']=$this->controller;     
        $data['fields_caption']=array('Kelompok','Nomor Baris','Keterangan','Amount','Rumus','Nip','Tahun','Bulan','Id');
        $data['fields']=array('kelompok','nomor','keterangan','jumlah','rumus','nip','tahun','bulan','id');
        $data['field_key']='id';
        $this->load->library('search_criteria');
        
        $faa[]=criteria("Kelompok","sid_kelompok");
        $faa[]=criteria("NIP","sid");
        $faa[]=criteria("Tahun","sid_tahun");
        $faa[]=criteria("Bulan","sid_bulan");
        

        $data['criteria']=$faa;
        $this->template->display_browse($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        
        $sql=$this->sql." where 1=1";        
        $s=$this->input->get('sid');        
        if($s!='')$sql.=" and nip='$s'";
        if($tahun=$this->input->get('sid_tahun'))$sql.=" and tahun='$tahun'";
        if($bulan=$this->input->get('sid_bulan'))$sql.=" and bulan='$bulan'";
        if($kelompok=$this->input->get('sid_kelompok'))$sql.=" and kelompok='$kelompok'";
        
        $search=$this->input->get("tb_search");       
        if($search!="")$sql.=" and (nip='$search' or nama like '%$search%')";
        
        $sql.=" order by kelompok,nip,nomor";
        

        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);      
    }
      
    function delete($id){
        $id=urldecode($id);                
        if ($this->pph21_model->delete($id)){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }      
        $this->browse();
    }
}
