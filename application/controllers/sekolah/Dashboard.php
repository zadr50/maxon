<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index() {
		if(!$this->session->userdata("logged_in",false)) {
		    ///redirect("index.php/sekolah/login");
        }
        $this->load->view('template/admin-lte/design/header');
		$this->load->view('sekolah/dashboard/admin');
        $this->load->view('template/admin-lte/design/footer');
    }
    public function murid(){
        $this->load->view('template/admin-lte/design/header');
        //$data=$this->set_defaults();
        //$data['active']=true;   
        //$this->_set_rules();
        //$data['mode']='add';
        $data['caption']='DAFTAR MASTER PELANGGAN';
        
        $data['controller']='customer';     
        $data['fields_caption']=array('Kode','Nama Pelanggan','Wilayah','Kota','Telp','Fax','Salesman','Kelompok');
        $data['fields']=array('customer_number','company','region','city','phone','fax','salesman','customer_record_type');
                    
        if(!$data=set_show_columns($data['controller'],$data)) return false;
            
        $data['field_key']='customer_number';
        
        $this->load->library('search_criteria');
        
        $faa[]=criteria("Nama","sid_cust");
        $faa[]=criteria("Kode","sid_kode");
        $faa[]=criteria("Salesman","sid_sales");
        $faa[]=criteria("Kota","sid_city");
        $data['list_info_visible']=true;
        $data['criteria']=$faa;
        $data['import_visible']=true;
        
        $this->load->library("template");
        $this->template->display_browse2($data);            

        
//        $this->load->view('sales/customer',$data);
        $this->load->view('template/admin-lte/design/footer');
        
    }
    function _set_rules(){  
         $this->form_validation->set_rules('customer_number','Customer Number', 'required|trim');
         $this->form_validation->set_rules('company','Customer Name',    'required');
    }
    
    function set_defaults($record=NULL){
        $data=data_table("customers",$record,true); 
        $data['mode']='';
        $data['message']='';

        $setting['dlgBindId']="payment_terms";
        $setting['dlgCols']=array( 
            array("fieldname"=>"type_of_payment","caption"=>"Termin","width"=>"280px")
        );
        $setting['dlgRetFunc']="$('#payment_terms').val(row.type_of_payment);";
        $data['lookup_termin']=$this->list_of_values->render($setting);

        $setting['dlgBindId']="salesman";
        $setting['dlgCols']=array( 
            array("fieldname"=>"salesman","caption"=>"Salesman","width"=>"280px")
        );
        $setting['dlgRetFunc']="$('#salesman').val(row.salesman);";
        $data['lookup_salesman']=$this->list_of_values->render($setting);
        
        $setting['dlgBindId']="city";
        $setting['dlgCols']=array( 
            array("fieldname"=>"city_id","caption"=>"Kode","width"=>"80px"),
            array("fieldname"=>"city_name","caption"=>"Kota","width"=>"200px")
        );
        $setting['dlgRetFunc']="$('#'+idd).val(row.city_id+' - '+row.city_name);";
        $data['lookup_city']=$this->list_of_values->render($setting);

        $setting['dlgBindId']="country";
        $setting['dlgCols']=array( 
            array("fieldname"=>"country_id","caption"=>"Kode","width"=>"80px"),
            array("fieldname"=>"country_name","caption"=>"Negara","width"=>"200px")
        );
        $setting['dlgRetFunc']="$('#country').val(row.country_id+' - '+row.country_name);";
        $data['lookup_country']=$this->list_of_values->render($setting);

        $setting['dlgBindId']="region";
        $setting['dlgCols']=array( 
            array("fieldname"=>"region_id","caption"=>"Kode","width"=>"80px"),
            array("fieldname"=>"region_name","caption"=>"Nama Wilayah","width"=>"200px")
        );
        $setting['dlgRetFunc']="$('#region').val(row.region_id);";
        $data['lookup_region']=$this->list_of_values->render($setting);

        $setting['dlgBindId']="customer_record_type";
        $setting['dlgCols']=array( 
            array("fieldname"=>"type_id","caption"=>"Kode","width"=>"80px"),
            array("fieldname"=>"type_name","caption"=>"Nama Kelompok","width"=>"200px")
        );
        $setting['dlgRetFunc']="$('#customer_record_type').val(row.type_id+' - '+row.type_name);";
        $data['lookup_cust_type']=$this->list_of_values->render($setting);
        
        return $data;
    }
}
