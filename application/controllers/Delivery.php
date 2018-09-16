<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Delivery extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_products';
    private $sqlx="select distinct shipment_id,ip.item_number,i.description,
    	
        concat(year(date_received),'-',month(date_received),'-',day(date_received)) as date_received,
        ip.warehouse_code,ip.doc_type
                from inventory_products ip left join inventory i
                on ip.item_number=i.item_number
                where receipt_type='ETC_OUT' 
                ";
    private $sql="select distinct shipment_id,ip.ref2,
        concat(year(date_received),'-',month(date_received),'-',day(date_received)) as date_received,
       ip.warehouse_code,ip.doc_type,ip.supplier_number
                from inventory_products ip 
                where receipt_type='ETC_OUT' 
                ";
    private $file_view='inventory/delivery';
    private $primary_key='nomor_bukti';
    private $controller='delivery';
    
	function __construct()
	{
		parent::__construct();        
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper','browse_select'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_products_model');
		$this->load->model('inventory_model');
		$this->load->model('shipping_locations_model');
		$this->load->model('syslog_model');
        $this->load->library("list_of_values");      
        
	}
	function nomor_bukti($add=false)
	{
		$key="Other Delivery Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!EOUT~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!EOUT~$00001');
				$rst=$this->inventory_products_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
					}
	}
	
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            $data['item_number_list']=$this->inventory_model->item_list();
			if($record==NULL){
				$data['date_received']=date("Y-m-d H:i:s");
				$data['shipment_id']="AUTO";    //$this->nomor_bukti();
                $data["warehouse_code"]=current_gudang();
                $data["receipt_by"]=user_id();
								
				
			}
            $setting['dlgBindId']="doc_type";
            $setting['sysvar_lookup']='doc_type_delivery';
            $data['lookup_doc_type']=$this->list_of_values->render($setting);
            $data["ref1"]=account($data["ref1"]);
            $setwh['dlgBindId']="warehouse";
            $setwh['dlgRetFunc']="$('#warehouse_code').val(row.location_number);";
            $setwh['dlgCols']=array( 
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $data['lookup_gudang']=$this->list_of_values->render($setwh);

            $data['lookup_project']=$this->list_of_values->render(
                array(
                    "dlgBindId"=>"gl_projects",
                    "dlgRetFunc"=>"$('#ref2').val(row.kode);$('#project_name').val(row.keterangan);",
                    "dlgCols"=>array(
                        array("fieldname"=>"kode","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
                    )
                )
            );
            $data['lookup_cost_account']=$this->list_of_values->render(
                array("dlgBindId"=>"cost_account",
                    "dlgRetFunc"=>"$('#cost_account').val(row.account+' - '+row.account_description);",
                    "dlgCols"=>array(
                        array("fieldname"=>"account","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"account_description","caption"=>"Perkiraan","width"=>"200px")
                    )    
                )
            );
            return $data;
	}
	function index()
	{	
		if(!allow_mod2('_80070'))return false;   
        $this->browse();
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		if(!allow_mod2('_80071'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['receipt_type']='etc_out';
			$data['shipment_id']=$this->nomor_bukti();
			$id=$this->inventory_products_model->save($data);
			$this->nomor_bukti(true);
	        $data['message']='update success';
	        $data['mode']='view';
			$this->syslog_model->add($id,"delivery","add");

	        $this->browse();
		} else {
            $data['warehouse_list']=$this->shipping_locations_model->select_list();
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post($this->primary_key);
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                    
			unset($data['id']);
			$this->inventory_products_model->update($id,$data);
			$message='Update Success';
			$this->syslog_model->add($id,"delivery","edit");

			$this->browse();
		} else {
			$message='Error Update';
			$this->view($id,$message);		
		}		
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80070'))return false;   
		$id=urldecode($id);
		 $data['shipment_id']=$id;
		 $model=$this->inventory_products_model->get_by_id($id)->row();	
		 $data=$this->set_defaults($model);
		 if($data['cost_account']!=""){
		     $data['cost_account']=account($data['cost_account']);
		 }
		 $data['mode']='view';
         $data['warehouse_list']=$this->shipping_locations_model->select_list();
		  
		$this->template->display_form_input($this->file_view,$data);
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules($this->primary_key,'Nomor Bukti', 'required|trim');
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
	function browse($offset=0,$limit=10,$order_column='shipment_id',$order_type='asc')
	{
        $data['caption']='DAFTAR PENGELURAN BARANG NON SALES ORDER';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Nomor Bukti','Tanggal',
		'Gudang','Tujuan','Doc Type','Project');
		$data['fields']=array('shipment_id','date_received',
		'warehouse_code','supplier_number',
        'doc_type','ref2');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='shipment_id';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("Supplier","sid_supplier");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql;
        
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }
        
    	$nama=$this->input->get('sid_supplier');
		$no=$this->input->get('sid_nomor');
        
        
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));

		if($no!=''){
			$sql.=" and shipment_id='".$no."'";
		} else {
			$sql.=" and date_received between '$d1' and '$d2'";
			if($nama!='')$sql.=" and supplier_name like '$nama%'";	
		}
        //$sql.=" limit $offset,$limit";
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        
        echo datasource($sql);
    }
	function delete($id){
		if(!allow_mod2('_80073'))return false;   
		$id=urldecode($id);
	 	$this->inventory_products_model->delete($id);
		$this->syslog_model->add($id,"delivery","delete");

	 	$this->browse();
	}
	function detail(){
		$data['shipment_id']=isset($_GET['shipment_id'])?$_GET['shipment_id']:'';
		$data['shipment_id']=$this->nomor_bukti();
		$this->nomor_bukti(true);
		$data['date_received']=isset($_GET['date_received'])?$_GET['date_received']:'';
		$data['supplier_number']=isset($_GET['supplier_number'])?$_GET['supplier_number']:'';
		$data['comments']=isset($_GET['comments'])?$_GET['comments']:'';
		$this->template->display('inventory/delivery_detail',$data);
	}
	function view_detail($nomor){
		$nomor=urldecode($nomor);
		$sql="select ip.item_number,i.description,ip.quantity_received as qty
		,ip.unit,ip.cost,ip.id,ip.total_amount
		from inventory_products ip
		left join inventory i on i.item_number=ip.item_number
		where shipment_id='$nomor'";
		$s="
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
			<script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
		";
		echo $s." ".browse_simple($sql);
	} 
	function save() {
		$id=$this->input->post('shipment_id');
		$data['warehouse_code']=$this->input->post('warehouse_code');
		$data['date_received']=$this->input->post('date_received');
		$data['supplier_number']=$this->input->post('supplier_number');
        $data['doc_type']=$this->input->post('doc_type');
		$ok=$this->inventory_products_model->update($id,$data);
		 
		if ($ok){
			$this->syslog_model->add($id,"delivery","edit");
			echo json_encode(array('success'=>true,'shipment_id'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
		
	}
    function save_nomor(){
        $data=$this->input->post();
        $nomor=$data['shipment_id'];
        unset($data['shipment_id']);
        if($nomor!="AUTO"){
            $this->inventory_products_model->update_header($nomor,$data);
        }
        echo json_encode(array("success"=>true,"msg"=>"Finish"));
    }
    function save_item(){
        $item_no=$this->input->post('item_number');
		$id=$this->input->post('shipment_id');
        if($id=="AUTO"){
            $id=$this->nomor_bukti();
        }
		$line=$this->input->post("id");
        $data['item_number']=$item_no;
		
		$qty=$this->input->post('quantity');
		if($qty==0 || $qty=="")$qty=1;
		
        $data['quantity_received']=$qty;
		
        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
		
		$cost=$this->input->post("cost");
       	if($cost==0 || $cost==""){
	       	$cost=item_cost($item_no);       		
       	}
		
        $data['cost']=$cost;
        $data['unit']=$this->input->post('unit');
        $data['shipment_id']=$id;
        $data['warehouse_code']=$this->input->post('warehouse_code');
        
        $data['total_amount']=$qty*$cost;
		
		$data['receipt_type']='ETC_OUT';
		$data['date_received']=$this->input->post('date_received');;
		$data['comments']=$this->input->post('comments');;
		$data['supplier_number']=$this->input->post('supplier_number');
        $data['ref1']=$this->input->post('ref1');
        $data['ref2']=$this->input->post('ref2');
        $data['doc_type']=$this->input->post('doc_type');
        $data['cost_account']=$this->input->post('cost_account');
        if($data['cost_account']!="" || $data["cost_account"]!="0"){
            $data["cost_account"]=account_id($data["cost_account"]);
        }
		if($line>0){
			$ok=$this->inventory_products_model->update($line,$data);
		} else {
			$ok=$this->inventory_products_model->save($data);			
		}
		if ($ok){
			echo json_encode(array('success'=>true,'shipment_id'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}         
    function print_bukti($nomor){
		if(!allow_mod2('_80074'))return false;   
		$nomor=urldecode($nomor);
        $adj=$this->inventory_products_model->get_by_id($nomor)->row();
		$data['shipment_id']=$adj->shipment_id;
		$data['date_received']=$adj->date_received;
		$data['warehouse_code']=$adj->warehouse_code;
		$data['comments']=$adj->comments;
        $data['content']=load_view('inventory/rpt/print_delivery_etc',$data);
        $this->load->view('pdf_print',$data);
    }
    function del_item($id){
        $ok=$this->inventory_products_model->delete_item($id);
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
	
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity_received as quantity, 
		p.unit,p.cost,p.id as line_number,p.total_amount,p.multi_unit,p.mu_qty,p.mu_price
		from inventory_products p
		left join inventory i on i.item_number=p.item_number
		where shipment_id='$nomor'";
		 
		echo datasource($sql);
	}
	function posting($nomor){
		$this->inventory_products_model->posting($nomor);
		redirect("delivery/view/$nomor");
	}
	function unposting($nomor){
		$this->inventory_products_model->unposting($nomor);
		redirect("delivery/view/$nomor");		
	}
    
    
    
    
    
    
}
