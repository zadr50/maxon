<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Shipping_locations extends CI_Controller {
    private $limit=10;
    private $table_name='shipping_locations';
    private $sql="select location_number,address_type,street,city,
		attention_name, company_name,no_urut,parent_loc,default_gudang
        from shipping_locations";
    private $file_view='inventory/shipping_locations';

	function __construct()
	{
		parent::__construct();        
       
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('shipping_locations_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';

        $setting['dlgBindId']="address_type";
        $setting['sysvar_lookup']='jenis_gudang';
        $data['lookup_jenis_gudang']=$this->list_of_values->render($setting);
        
        $setcom['dlgBindId']="preferences";
        $setcom['dlgRetFunc']="$('#company_name').val(row.company_code);";
        $setcom['dlgCols']=array( 
                    array("fieldname"=>"company_code","caption"=>"Kode","width"=>"80px"),
                    array("fieldname"=>"company_name","caption"=>"Perusahaan","width"=>"200px")
                );          
        $data['lookup_company_name']=$this->list_of_values->render($setcom);

        $setcom['dlgBindId']="shipping_locations";
        $setcom['dlgRetFunc']="$('#parent_loc').val(row.location_number);";
        $setcom['dlgCols']=array( 
                    array("fieldname"=>"location_number","caption"=>"Kode","width"=>"180px"),
                    array("fieldname"=>"address_type","caption"=>"Type","width"=>"100px"),
                    array("fieldname"=>"attention_name","caption"=>"Kontak","width"=>"100px"),
                    array("fieldname"=>"city","caption"=>"Kota","width"=>"100px"),
                    array("fieldname"=>"company_name","caption"=>"Perusahaan","width"=>"80px")
                );          
        $data['lookup_gudang']=$this->list_of_values->render($setcom);
    
		if($record==NULL){
			$data['location_number']='';
			$data['address_type']='';
			$data['street']='';
			$data['city']='';
			$data['attention_name']='';
			$data['no_urut']='';
            $data['company_name']='';
            $data['parent_loc']='';
            $data['default_gudang']='';
		} else {
			$data['location_number']=$record->location_number;
			$data['address_type']=$record->address_type;
			$data['street']=$record->street;
			$data['city']=$record->city;
			$data['attention_name']=$record->attention_name;
			$data['no_urut']=$record->no_urut;
            $data['company_name']=$record->company_name;
            $data['parent_loc']=$record->parent_loc;
            $data['default_gudang']=$record->default_gudang;
            		}
		return $data;
	}
	function index()
	{	
		if(!allow_mod2('_80030'))return false;   
        $this->browse();
	}
	function get_posts(){
		$data['location_number']=$this->input->post('location_number');
		$data['address_type']=$this->input->post('address_type');
		$data['street']=$this->input->post('street');
		$data['city']=$this->input->post('city');
		$data['attention_name']=$this->input->post('attention_name');
		$data['no_urut']=$this->input->post('no_urut');
        $data['company_name']=$this->input->post('company_name');
        $data['parent_loc']=$this->input->post('parent_loc');
		$data['default_gudang']=$this->input->post("default_gudang");
		return $data;
	}
	function add()
	{
		if(!allow_mod2('_80031'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->shipping_locations_model->save($data);
			$data['message']='update success';
			$data['mode']='view';
			$this->syslog_model->add($id,"shipping_locations","add");
            echo json_encode(array("success"=>true,"msg"=>"Success"));
		} else {
			$data['mode']='add';
			$this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post('location_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                      
			$this->shipping_locations_model->update($id,$data);
			$message='Update Success';
			$this->syslog_model->add($id,"shipping_locations","edit");
            echo json_encode(array("success"=>true,"msg"=>"Data sudah tersimpan."));
		} else {
			$message='Error Update';
            echo json_encode(array("success"=>false,"msg"=>$message));
		}	  		
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80030'))return false;   
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->shipping_locations_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
		 $data['message']=$message;
		 $this->template->display_form_input($this->file_view,$data,'');	
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('location_number','location_number', 'required|trim');
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
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')
	{
        $data['caption']='DAFTAR GUDANG';
		$data['controller']='shipping_locations';		
		$data['fields_caption']=array('Kode Gudang','Jenis Gudang','Alamat','Kota','Kontak Person',
			'Company','Parent','No Urut','Default');
		$data['fields']=array('location_number','address_type','street','city','attention_name',
			'company_name','parent_loc','no_urut','default_gudang');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='location_number';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Nama","sid_nama");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql." where 1=1";
        
		if($this->input->get('sid_nama')!='')$sql.=" and location_number like '".$this->input->get('sid_nama')."%'";

        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        
        
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        
        echo datasource($sql);		
    }
	function delete($id){
		if(!allow_mod2('_80033'))return false;   
		$id=urldecode($id);
	 	$this->shipping_locations_model->delete($id);
		$this->syslog_model->add($id,"shipping_locations","delete");

		
	 	$this->browse();
	}
    function select($search=''){
        $search=urldecode($search);
        $sql=$this->sql;

        if($search!=""){
            $sql.=" where (location_number like '$search%' 
                or attention_name like '$search%')";
        }
        $sql.=" order by location_number";

        $offset=0; $limit=10;
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);
    }

	
}
