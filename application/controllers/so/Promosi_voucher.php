<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Promosi_voucher extends CI_Controller {
    private $limit=10;
    private $table_name='promosi_disc';
    private $sql="select * from promosi_disc";
    private $file_view='sales/promosi_voucher';
    private $primary_key='promosi_code';
    private $controller='so/promosi_voucher';

    function __construct()    {
        parent::__construct();        
         
        if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('template');
        $this->load->library('form_validation');
        $this->load->model('sales/promosi_model');
        $this->load->model('inventory_model');
        $this->load->model('sales/promosi_item_model');
        $this->load->library('list_of_values');
        
    }
    function index(){   
        $this->browse();
    }
    function add()
    {
         $data=$this->set_defaults();
         
         $this->_set_rules();
         if ($this->form_validation->run()=== TRUE){
            $data=$this->get_posts();
            $data['promosi_code']=$this->nomor(); 
            $this->promosi_model->save($data);
            $this->nomor(true);
        } else {
            $data['mode']='add';
            $data['message']='';
            $this->template->display_form_input($this->file_view,$data,'');         
        }        
    }
    
    function get_posts(){
        $data=data_table_post($this->table_name);
        return $data;
    }
    
    function set_defaults($record=NULL)
    {
        $data=data_table($this->table_name,$record);
        $data['caption']="Promosi Voucher";
        $data['mode']='';
        $data['message']='';
        if($record==NULL)$data['promosi_code']="AUTO";
        
        $setting['dlgId']="inventory";
        $setting['dlgBindId']="item_number";
        $setting['dlgRetFunc']="$('#item_number').val(row.item_number);
            $('#description').val(row.description);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"description","caption"=>"Nama Barang","width"=>"280px"),
                    array("fieldname"=>"item_number","caption"=>"Kode","width"=>"100px")
                );          
        $data['lookup_inventory']=$this->list_of_values->render($setting);
        
        $setting['dlgId']="inventory_categories";
        $setting['dlgBindId']="categories";
        $setting['dlgRetFunc']="$('#item_number').val(row.kode);
            $('#description').val(row.category);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"category","caption"=>"Category","width"=>"280px"),
                    array("fieldname"=>"kode","caption"=>"Kode","width"=>"100px")
                );          
        $data['lookup_category']=$this->list_of_values->render($setting);

        $setting['dlgId']="suppliers";
        $setting['dlgBindId']="suppliers";
        $setting['dlgRetFunc']="$('#item_number').val(row.supplier_number);
            $('#description').val(row.supplier_name);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"supplier_name","caption"=>"Nama","width"=>"280px"),
                    array("fieldname"=>"supplier_number","caption"=>"Kode","width"=>"100px")
                );          
        $data['lookup_supplier']=$this->list_of_values->render($setting);
        
        $data['lookup_merk']=$this->list_of_values->render(array(
            "dlgBindId"=>"merk","sysvar_lookup"=>"merk",
            "dlgRetFunc"=>"$('#item_number').val(row.varvalue);
                           $('#description').val(row.keterangan);"
        ));
        $data['lookup_model']=$this->list_of_values->render(array(
            "dlgBindId"=>"model","sysvar_lookup"=>"model",
            "dlgRetFunc"=>"$('#item_number').val(row.varvalue);
                           $('#description').val(row.keterangan);"
        ));
        $data['lookup_member_group']=$this->list_of_values->render(array(
            "dlgBindId"=>"member_group","sysvar_lookup"=>"member_group",
            "dlgRetFunc"=>"$('#member_group').val(row.varvalue);"
        ));
        
        return $data;
    }    
    function delete_item($id){
        $data['success']=true;
        if($this->db->where("id",$id)->delete("promosi_item")){
            $data['message']="Sukses.";
        } else {
            $data['success']=false;
            $data['message']=mysql_error();
        }
        echo json_encode($data);
    }
    function delete_voucher($id){
        $data['success']=true;
        if($this->db->where("voucher_no",$id)->delete("voucher_master")){
            $data['message']="Sukses.";
        } else {
            $data['success']=false;
            $data['message']=mysql_error();
        }
        echo json_encode($data);
    }
        
    function load_items($search=""){
        $data['success']=true;        
        $sql="select * from promosi_item ";
        $sql.="where promosi_code='*'";
        if($search!="")$sql.=" and item_number='$search'";
        $sql.=" and disc_type='1'";
        $sql.=" order by from_date desc";
        echo datasource($sql);
    }
    function save(){
        $data=$this->input->post();
        $mode=$data['mode'];
        if($mode=="add"){
            $id=$this->nomor();
            $this->nomor(true);
        } else {
            $id=$data['promosi_code'];         
        }
        $data['promosi_code']=$id;        
        $result['success']=true;
        $data['category']=10;
        unset($data['mode']);
        if($mode=="add"){
            $ok=$this->promosi_model->save($data);
        } else {
            $ok=$this->promosi_model->update($id,$data);
        }
        if ($ok){
            echo json_encode(array('success'=>true,'promosi_code'=>$id));
        } else {
            echo json_encode(array('success'=>false,'msg'=>mysql_error()));
        }
    }
    function view($id,$message=null){
        $id=urldecode($id);
         $data['id']=$id;
         $model=$this->promosi_model->get_by_id($id)->row();
         $data=$this->set_defaults($model);
         $data['mode']='view';
         $data['message']=$message;
         $this->template->display_form_input($this->file_view,$data);           
    }
   
    function _set_rules(){  
         $this->form_validation->set_rules('promosi_code','Promosi code', 'required|trim');
    }
     
    function valid_date($str)
    {
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
     {
         $this->form_validation->set_message('from_date',
         'Format tanggal salah, seharusnya yyyy-mm-dd');
         return false;
     } else {
        return true;
     }
    }
    function browse($offset=0,$limit=50,$order_column='promosi_code',$order_type='asc'){
        $data['controller']=$this->controller;
        $data['_left_menu_caption']='Search';
        $data['fields_caption']=array('Kode Promo','Nama Promosi','Tgl Awal','Tgl Akhir');
        $data['fields']=array('promosi_code','description','date_from','date_to');
        $data['field_key']='promosi_code';
        $data['caption']='DAFTAR KODE PROMOSI';

        $this->load->library('search_criteria');
        
        $faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
        $faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
        $faa[]=criteria("Promosi Code","sid_code");
        $data['criteria']=$faa;
        $this->template->display_browse2($data);
    }
    function browse_data($offset=0,$limit=100,$nama=''){
        $nama_promo=$this->input->get('sid_nama');
        $no=$this->input->get('sid_nama');
        $d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
        $d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql=$this->sql." where category    ='10'";
        if($no!=''){
            $sql.=" and promosi_code='$no'";
        } else {
            $sql.=" and date_from between '$d1' and '$d2'";
        }
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }    
    function delete($id){
        $id=urldecode($id);
        $this->promosi_model->delete($id);
        $ok=$this->db->where("promosi_code",$id)->delete("voucher_master");
        echo json_encode(array("success"=>$ok,"message"=>"Success"));
    }
        
    function save_voucher(){
        $data=$this->input->post();
        $prefix=$data['prefix'];
        $awal=$data['awal'];
        $banyak=$data['banyak'];
        $success=false;
        $msg="Tidak Success.";
        for($i=0;$i<$banyak;$i++){
            $voucher_no=$prefix.strzero($awal,4);
            $this->db->insert("voucher_master",array(
                "voucher_no"=>$voucher_no,
                "tanggal_dibuat"=>date("Y-m-d"),
                "voucher_amt"=>$data["voucher_amt"],
                "promosi_code"=>$data["promosi_code2"],
                "tanggal_aktif"=>$data["tanggal_aktif"],
                "tanggal_expire"=>$data["tanggal_expire"]
            ));
            $awal++;
            $success=true;
            $msg="Success.";
        }
        echo json_encode(array("success"=>$success,"msg"=>$msg));
    }
    function load_voucher($promosi_code,$search=""){
        $data['success']=true;        
        $sql="select * from voucher_master ";
        $sql.="where promosi_code='$promosi_code'";
        if($search!="")$sql.=" and voucher_no='$search'";
        $sql.=" order by tanggal_aktif desc limit 10";
        echo datasource($sql);
    }
    function nomor($add=false)
    {
        $key="Promo Numbering";
        if($add){
            $this->sysvar->autonumber_inc($key);
        } else {            
            $no=$this->sysvar->autonumber($key,0,'!PR~$00001');
            for($i=0;$i<100;$i++){          
                $no=$this->sysvar->autonumber($key,0,'!PR~$00001');
                $rst=$this->promosi_model->get_by_id($no)->row();
                if($rst){
                    $this->sysvar->autonumber_inc($key);
                } else {
                    break;                  
                }
            }
            return $no;
        }
    }
    
    
}
?>
