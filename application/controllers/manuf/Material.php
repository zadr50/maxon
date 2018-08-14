<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Material extends CI_Controller {

    private $limit=10;
    private $table_name='inventory';
    private $sql="select item_number,description,unit_of_measure,i.category,i.sub_category ,i.retail,i.cost,s.supplier_name
                from inventory i
				left join suppliers s on s.supplier_number=i.supplier_number
				where i.class='Material'
                ";
   private $file_view='manuf/material';
   private $controller="manuf/material";
 	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
                  
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_model');
        $this->load->model('chart_of_accounts_model');
        $this->load->model('supplier_model');
		
	}
	function set_defaults($record=NULL){          
        $data=data_table('inventory',$record); 
		$data['mode']='';
		$data['message']='';
        $data['akun_list']=$this->chart_of_accounts_model->select_list();
		$data['category_list']=$this->inventory_model->category_list();
		$data['sub_category_list']=$this->inventory_model->category_list();               
		$data['supplier_list']=$this->supplier_model->select_list();
	 
		return $data;
	}
	function index()
	{	
            $this->browse();
	}
	function get_posts(){
        $data=data_table_post('inventory');
		return $data;
	}
	function add()
	{
		$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input($this->file_view,$data,'');
   }        
	function delete($id){
		$id=urldecode($id);
	 	$this->inventory_model->delete($id);
	 	$this->browse();
	}

	function save()
	{   
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('item_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$mode=$this->input->post("mode");
			unset($data["mode"]);
			
			$data['sales_account']=$this->acc_id($data['sales_account']);
			$data['inventory_account']=$this->acc_id($data['inventory_account']);
			$data['cogs_account']=$this->acc_id($data['cogs_account']);
			$data['tax_account']=$this->acc_id($data['tax_account']);
			$data['class']='Material';
			if($mode=="view"){
				$ok=$this->inventory_model->update($id,$data);			
			} else {
				$ok=$this->inventory_model->save($data);
			}
		} else {
			$ok=false;
		}	
		if ($ok){
			echo json_encode(array('success'=>true,'item_number'=>$id));
		} else {
			echo json_encode(array('msg'=>"Ada kesalahan input, cek kode barang atau satuan.".mysql_error()));
		}
		  
	}
	function acc_id($account){
		$account=urldecode($account);
		$data=explode(" - ", $account);
		$coa=$this->chart_of_accounts_model->get_by_id($data[0])->row();
		if($coa){
			return $coa->id;
		} else {
			return 0;
		}
	}
	
	function view($id,$message=null){
		$id=urldecode($id);
		$message=urldecode($message);
		 $inventory=$this->inventory_model->get_by_id($id)->row();
		 $data=$this->set_defaults($inventory);
		 $data['id']=$id;
		 $data['mode']='view';
         $data['message']=$message;
		 $sql="select q.item_number,i.description,q.gudang,sum(q.qty_masuk)-sum(q.qty_keluar) as quantity 
				from qry_kartustock_union q left join inventory i on i.item_number=q.item_number 
				where q.item_number='$id'   		
				group by q.item_number,i.description,q.gudang ";
		 $data['qty_gudang']=browse_simple($sql);
		 $data['inventory_account']=account($data['inventory_account']);
		 $data['sales_account']=account($data['sales_account']);
		 $data['cogs_account']=account($data['cogs_account']);
		 $data['tax_account']=account($data['tax_account']);
         $this->template->display_form_input($this->file_view,$data,'');
	}
	function _set_rules(){	
		if($this->input->post("mode")=="add"){
			$this->form_validation->set_rules('item_number','Item Number','required|trim|callback_exist');
		}
		 $this->form_validation->set_rules('description','Description',	 'required');
		 $this->form_validation->set_rules('category','Category', 'required');
	}
	function valid_exist($id){return $this->exist($id);}
	function exist($id){
	   if($this->inventory_model->exist($id)>0) {
		   $this->form_validation->set_message('invoice_number', 'Nomor sudah ada !');
		   return false;
	   } else {
		   return true;
	   }
	}
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')
	{
        $data['caption']='DAFTAR MATERIAL BAHAN BAKU';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Kode','Nama Barang','Unit','Kelompok','Sub','Harga Jual','Cost','Supplier');
		$data['fields']=array('item_number','description','unit_of_measure','category','sub_category','retail','cost','supplier_name');
		$data['field_key']='item_number';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Kelompok","sid_cat");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql;
		if($this->input->get('sid_kode')!=''){
			$sql.=" and item_number='".$this->input->get('sid_kode')."'";
		} else {
			if($this->input->get('sid_nama')!='')$sql.=" and description like '".$this->input->get('sid_nama')."%'";
			if($this->input->get('sid_cat')!='')$sql.=" and category='".$this->input->get('sid_cat')."'";
		}
		 
        echo datasource($sql);		
    }
	 
    function lookup($offset=0,$limit=20,$order_column='item_number',$order_type='asc'){           
        return $this->inventory_model->lookup($offset,$limit,
                $order_column,$order_type);
    }
	function filter($nama='',$type='json'){
		$nama=urldecode($nama);
		$sql="select item_number,description
		 from inventory  where 1=1 and description like '".$nama."%' limit 100";
		 echo datasource($sql);
	}
	function find($item_number=''){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select item_number,description,retail,
		unit_of_measure,cost from inventory where item_number='$item_number'");
		echo json_encode($query->row_array());
 	}
   function qty_gudang($item_number){
   		$item_number=htmlspecialchars_decode($item_number);
   		$sql="select q.item_number,i.description,q.gudang,sum(q.qty_masuk)-sum(q.qty_keluar) as quantity 
   		from qry_kartustock_union q left join inventory i on i.item_number=q.item_number 
		where q.item_number='$item_number'   		
   		group by q.item_number,i.description,q.gudang ";
		$this->template->browse_sql($sql);
   }
}
