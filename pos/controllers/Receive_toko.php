<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Receive_toko extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_products';
    private $receipt_type="ETC_IN";
    private $sql='';
    private $file_view='inventory/receive_toko';
    private $primary_key='nomor_bukti';
    private $controller='receive_toko';
    private $doc_type='3';      //terima barang dari toko
    
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
        $this->sql="select distinct shipment_id,
                format(date_received,'%Y-%m-%d) as date_received,
                ip.warehouse_code,
                ip.supplier_number, ip.doc_type,ip.ref1
                from inventory_products ip left join inventory i
                on ip.item_number=i.item_number
                where receipt_type='$this->receipt_type' and doc_type='$this->doc_type'
        ";
        
        
	}
	function nomor_bukti($add=false)
	{
		$key="$this->receipt_type $this->doc_type Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!EI3~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!EI3~$00001');
				$rst=$this->inventory_products_model->get_by_id($no)->row();
				if($rst){
				    //panggil nomor bukti / addnew langsung increase !
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
            $data['warehouse_list']=$this->shipping_locations_model->select_list();
			if($record==NULL){
				$data['date_received']=date("Y-m-d H:i:s");
				$data['shipment_id']="AUTO";
                $data['warehouse_code']=current_gudang();
			}
            $nomor=$data['shipment_id'];
            $warehouse_code=$data['warehouse_code'];
            $supplier_number=$data['supplier_number'];
            
            $setting['dlgBindId']="do_gudang";
            $setting['dlgCols']=array( 
                array("fieldname"=>"shipment_id","caption"=>"Kode","width"=>"250px"),
                array("fieldname"=>"date_received","caption"=>"Tanggal","width"=>"200px"),
                array("fieldname"=>"warehouse_code","caption"=>"Sumber","width"=>"200px"),
                array("fieldname"=>"supplier_number","caption"=>"Tujuan","width"=>"200px")
            );
            $setting['show_date_range']=true;
            $setting['dlgRetFunc']="add_sj_item(row.shipment_id);";
			
            $data['lookup_do_gudang']=$this->list_of_values->render($setting);
            
            return $data;
	}
	function index()
	{	
		if(!allow_mod2('_80060'))return false;   
        $this->browse();
	}
	function get_posts(){
        $data=data_table_post($this->table_name);
        return $data;
	}
	function add()
	{
		if(!allow_mod2('_80061'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['receipt_type']=$this->receipt_type;
			$data['shipment_id']=$this->nomor_bukti();
			$id=$this->inventory_products_model->save($data);
			$this->nomor_bukti(true);
	        $data['message']='update success';
	        $data['mode']='view';
			$this->syslog_model->add($id,"receive_toko","add");

	        $this->browse();
		} else {
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
			$this->syslog_model->add($id,"receive_toko","edit");
			$this->browse();
		} else {
			$message='Error Update';
			$this->view($id,$message);		
		}		
	}
	
	function view($id,$message=null){
		//if(!allow_mod2('_80070'))return false;   
		 $id=urldecode($id);
		 $data['shipment_id']=$id;
		 $model=$this->inventory_products_model->get_by_id($id)->row();	
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['ref1']=$data['other_doc_number'];
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
        $data['caption']='DAFTAR PENERIMAAN BARANG DARI GUDANG';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Nomor Bukti','Tanggal',
		'Gudang','Asal','Doc Type','Ref');
		$data['fields']=array('shipment_id'
        ,'date_received','warehouse_code',
        'supplier_number','doc_type','ref1');
		$data['field_key']='shipment_id';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("Supplier","sid_supplier");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=20,$nama=''){
		$sql=$this->sql;
    	$nama=$this->input->get('sid_supplier');
		$no=$this->input->get('sid_nomor');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }

		if($no!=''){
			$sql.=" and shipment_id='".$no."'";
		} else {
		    if($search==""){
                $sql.=" and date_received between '$d1' and '$d2'";
                if($nama!='')$sql.=" and supplier_name like '$nama%'";  
		        
		    } else {
                $sql.=" and (shipment_id like '%$search%' or ref1 like '%$search%') ";
		        
		        
		    }
		}
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
     
        
        echo datasource($sql);
    }
	function delete($id){
		if(!allow_mod2('_80063'))return false;   
		$id=urldecode($id);
	 	$this->inventory_products_model->delete($id);
		$this->syslog_model->add($id,"receive_toko","delete");

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
    function save_items(){
        $data=$this->input->post();
        $rcv_list=$data["ck"];
        $ok=true;
        $msg="";
        $shipment_id=$data['item_shipment_id'];
        $supplier_number=$data['item_supplier_number'];
        $gudang=$data['item_warehouse_code'];
        if($shipment_id=="AUTO"){
            $shipment_id=$this->nomor_bukti();
            $this->nomor_bukti(true);
        }
        for($i=0;$i<count($rcv_list);$i++){
            $rcv_no=$rcv_list[$i];
            if($rcv_no!=""){
                $ok=$this->add_item_with_recv_no($shipment_id,$rcv_no,$gudang,$supplier_number);
            }
        }
        echo json_encode(array("success"=>$ok,"msg"=>$msg,"shipment_id"=>$shipment_id));
        
    }
    function add_item_with_recv_no($to_id,$from_id,$gudang,$supplier_number){
        $to_id=urldecode($to_id);
        $from_id=urldecode($from_id);
        $gudang=urldecode($gudang);
        $supplier_number=urldecode($supplier_number);
        $ok=false;
        $msg="";
        if($to_id=="AUTO"){
            $to_id=$this->nomor_bukti();
            $this->nomor_bukti(true);            
        }
        if($q=$this->db->where("shipment_id",$from_id)->get("inventory_products")){
            foreach($q->result_array() as $data){
                $data2["shipment_id"]=$to_id;
                $data2['date_received']= date( 'Y-m-d H:i:s');
                $data2['from_line_number']=$data["id"];
                $data2["receipt_type"]=$this->receipt_type;
                $data2['doc_type']=$this->doc_type;
                $multi_unit="";
                $price=0;
                if($qitem=$this->inventory_model->get_by_id($data['item_number'])){
                     $item=$qitem->row();
                    $multi_unit=$item->unit_of_measure;
                    $price=$item->cost;   
                }
                $data2['multi_unit']=$multi_unit;
                $data2['mu_price']=$price;
                $data2['mu_qty']=$data['mu_qty'];
                
                $data2['quantity_received']=$data['quantity_received'];
                $data2['cost']=$price;
                $data2['unit']=$multi_unit;
                
                $data2['warehouse_code']=$gudang;
                $data2["supplier_number"]=$supplier_number;
                $data2["item_number"]=$data['item_number'];
                $data2["other_doc_number"]=$from_id;
                $data2['ref1']=$from_id;
                $data2['total_amount']=$data2['quantity_received']*$data2['cost'];
                
                $ok=$this->db->insert("inventory_products",$data2);
                                                
            }
        }
        if(!$ok)$msg="Some error !";
        echo json_encode(array("success"=>$ok,"msg"=>$msg,"shipment_id"=>$to_id));
    }
 
	function save() {
	    $data=$this->input->post();
        
        $id=$data['shipment_id'];
        $data2['date_received']=$data['date_received'];
        $data2['warehouse_code']=$data['warehouse_code'];
        $data2['supplier_number']=$data['supplier_number'];
        $data2['comments']=$data['comments'];
		$ok=$this->db->where("shipment_id",$id)->update("inventory_products",$data2);
		 
		if ($ok){
			$this->syslog_model->add($id,"delivery_gudang","edit");
			echo json_encode(array('success'=>true,'shipment_id'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
		
	}
    function save_item(){
        $data=$this->input->post();        
		$id=$data['shipment_id'];
        if($id=="AUTO"){
            $id=$this->nomor_bukti();
        }
		$line=$data['id'];
        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
       	$cost=item_cost($data['item_number']);
        $data['cost']=$cost;
        $data['shipment_id']=$id;
        $data['total_amount']=$data['quantity_received']*$data['cost'];
		$data['receipt_type']=$this->receipt_type;
        $data['doc_type']=$this->doc_type;
        if(isset($data['description']))unset($data['description']);
		if($line>0){
			$ok=$this->inventory_products_model->update($line,$data);
		} else {
		    unset($data['id']);
			$ok=$this->inventory_products_model->save($data);			
		}
		if ($ok){
			echo json_encode(array('success'=>true,'shipment_id'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}         
    function print_bukti($nomor){
		if(!allow_mod2('_80064'))return false;   
		$nomor=urldecode($nomor);
        $adj=$this->inventory_products_model->get_by_id($nomor)->row();
		$data['shipment_id']=$adj->shipment_id;
		$data['date_received']=$adj->date_received;
		$data['warehouse_code']=$adj->warehouse_code;
		$data['comments']=$adj->comments;
        $data['supplier_number']=$adj->supplier_number;
		$data['content']=load_view('inventory/rpt/print_receive_etc',$data);
        $this->load->view('pdf_print',$data);                
        
    }
    function delete_item($id){
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
		p.unit,p.cost,p.id as line_number,p.total_amount,p.ref1
		from inventory_products p
		left join inventory i on i.item_number=p.item_number
		where shipment_id='$nomor'";
		 
		echo datasource($sql);
	}
    
    function items_with_input($nomor){
        $nomor=urldecode($nomor);
        if($nomor){
            $sql="select p.item_number,i.description,p.quantity_received as quantity, 
            p.unit,p.cost,p.id as line_number,p.total_amount,p.id
            from inventory_products p
            left join inventory i on i.item_number=p.item_number
            where shipment_id='$nomor'";
            $query=$this->db->query($sql);
            $i=0;
            $rows[0]='';
            if($query){ 
                foreach($query->result_array() as $row){
                    $row['item_number']=form_input("item_number[]",$row['item_number']);
                    $row['quantity']=form_input("quantity[]",$row['quantity'],"style='width:50px'");
                    $row['line_number']=form_input("line_number[]",$row['id'],"style='width:50px'");
                    $rows[$i++]=$row;
                };
            }
            $data['total']=$i;
            $data['rows']=$rows;
                        
            echo json_encode($data);

        }
    }    
    
    
}
