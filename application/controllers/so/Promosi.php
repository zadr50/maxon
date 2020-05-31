<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Promosi extends CI_Controller {
    private $limit=10;
    private $table_name='promosi_item';
    private $sql="select * from promosi_item";
    private $file_view='sales/promosi';
    private $primary_key='id';
    private $controller='so/promosi';

    function __construct()    {
        parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('template');
        $this->load->library('form_validation');
        $this->load->model('sales/promosi_model');
    }
    function index()    {	
		$data['caption']="Promosi Item Discount";
        
        $setting['dlgId']="inventory";
        $setting['dlgBindId']="item_number";
        $setting['dlgRetFunc']="$('#item_number').val(row.item_number);
            $('#description').val(row.description);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"description","caption"=>"Nama Barang","width"=>"280px"),
                    array("fieldname"=>"item_number","caption"=>"Kode","width"=>"100px")
                );          
        $data['lookup_inventory']=$this->list_of_values->render($setting);
        
        $data['lookup_extra_items']=$this->list_of_values->render(array(
            'dlgId'=>'extra_items','dlgBindId'=>'extra_items',
            'dlgRetFunc'=>"$('#extra_items').val(row.item_number);
                $('#extra_item_name').val(row.description);",
            'dlgCols'=>array( 
                    array("fieldname"=>"description","caption"=>"Nama Barang","width"=>"280px"),
                    array("fieldname"=>"item_number","caption"=>"Kode","width"=>"100px")
                )
        ));

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
        
                
            
        $this->template->display_form_input($this->file_view,$data);			
    }
	function delete_item($id){
		$data['success']=true;
		if($this->db->where("id",$id)->delete($this->table_name)){
			$data['message']="Sukses.";
		} else {
			$data['success']=false;
			$data['message']=$this->db->error();
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
    function save()   {
		$data=$this->input->post();
		$result['success']=true;
        $data['disc_type']=1;
		if(!isset($data['promosi_code']))$data['promosi_code']="*";
		if($q=$this->db->insert($this->table_name,$data)){
			$result['message']="Data sudah tersimpan.";
			$result['id']=$this->db->insert_id();
		} else {
			$result['success']=false;
			$result['message']=$this->db->display_error();
		}
		echo json_encode($result);
    }
}
?>
