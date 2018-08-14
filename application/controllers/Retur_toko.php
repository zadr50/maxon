<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Retur_toko extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_products';
    private $receipt_type="ETC_OUT";
    private $sql="";
    private $file_view='inventory/retur_toko';
    private $primary_key='nomor_bukti';
    private $controller='retur_toko';
    private $doc_type='2';      //kode retur toko
    private $error_message="";
    
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
                concat(year(date_received),'-',month(date_received),'-',day(date_received)) as date_received,
                ip.warehouse_code,
                ip.supplier_number, ip.doc_type,ip.doc_status
                from inventory_products ip left join inventory i
                on ip.item_number=i.item_number
                where receipt_type='$this->receipt_type' and doc_type='$this->doc_type'
        ";
        $this->load->model('purchase_invoice_model');
        
	}
	function nomor_bukti($add=false)
	{
		$key="$this->receipt_type $this->doc_type Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!EO2~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!EO2~$00001');
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
			if($record==NULL){
				$data['date_received']=date("Y-m-d H:i:s");
				$data['shipment_id']="AUTO";
                $data['warehouse_code']=current_gudang();                
                $data['doc_status']="OPEN";
			}
            
            $doc_status['dlgBindId']="doc_status";
            $doc_status['sysvar_lookup']='doc_status';
            $data['lookup_doc_status']=$this->list_of_values->render($doc_status);
            $dlgRetFunc="$('#other_doc_number').val(row.purchase_order_number);";
            $data['lookup_faktur']=$this->purchase_invoice_model->lookup('','purchase_invoice',$dlgRetFunc);
            return $data;
	}
	function index()
	{	
		if(!allow_mod2('retur_toko'))return false;   
        $this->browse();
	}
	function get_posts(){
        $data=data_table_post($this->table_name);
        return $data;
	}
	function add()
	{
		if(!allow_mod2('retur_toko_add'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['receipt_type']=$receipt_by;
			$data['shipment_id']=$this->nomor_bukti();
			$id=$this->inventory_products_model->save($data);
			$this->nomor_bukti(true);
	        $data['message']='update success';
	        $data['mode']='view';
			$this->syslog_model->add($id,"retur_toko","add");

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
			$this->syslog_model->add($id,"retur_toko","edit");
			$this->browse();
		} else {
			$message='Error Update';
			$this->view($id,$message);		
		}		
	}
	
	function view($id,$message=null){
		if(!allow_mod2('retur_toko_view'))return false;   
		$id=urldecode($id);
		 $data['shipment_id']=$id;
		 $model=$this->inventory_products_model->get_by_id($id)->row();	
		 $data=$this->set_defaults($model);
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
        $data['caption']='DAFTAR RETUR TOKO';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Nomor Bukti','Tanggal',
		'Gudang','Tujuan','Doc Type','Status');
		$data['fields']=array('shipment_id','date_received','warehouse_code',
        'supplier_number','doc_type','doc_status');
		$data['field_key']='shipment_id';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("Toko","sid_supplier");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
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
        
        $sort_by=$this->my_setting->sort_by();
        if($sort_by=='1'){
            $sql.=" order by date_received desc";
        } else {
            $sql.=" order by shipment_id";
        }
                
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }
	function delete($id){
		if(!allow_mod2('retur_toko_delete'))return false;   
		$id=urldecode($id);
	 	$this->inventory_products_model->delete($id);
		$this->syslog_model->add($id,"retur_toko","delete");

	 	$this->browse();
	}
	function detail(){
		$data['shipment_id']=isset($_GET['shipment_id'])?$_GET['shipment_id']:'';
		$data['shipment_id']=$this->nomor_bukti();
		$this->nomor_bukti(true);
		$data['date_received']=isset($_GET['date_received'])?$_GET['date_received']:'';
		$data['supplier_number']=isset($_GET['supplier_number'])?$_GET['supplier_number']:'';
		$data['comments']=isset($_GET['comments'])?$_GET['comments']:'';
		$this->template->display('inventory/retur_toko_detail',$data);
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
		$this->load->model('inventory_products_model');
		$id=$this->input->post('shipment_id');
		$data['warehouse_code']=$this->input->post('warehouse_code');
		$data['date_received']=$this->input->post('date_received');
		$data['supplier_number']=$this->input->post('supplier_number');
        $data['doc_type']=$this->doc_type;
		$ok=$this->inventory_products_model->update($id,$data);
		 
		if ($ok){
			$this->syslog_model->add($id,"retur_toko","edit");
			echo json_encode(array('success'=>true,'shipment_id'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
		
	}
    function save_item(){
        $item_no=$this->input->post('item_number');
		$id=$this->input->post('shipment_id');
        if($id=="AUTO"){
            $id=$this->nomor_bukti();
            $this->nomor_bukti(true);
        }
		$line=$this->input->post("line_number");
        $data['item_number']=$item_no;
        $data['quantity_received']=$this->input->post('quantity');
        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
       	$cost=item_cost($item_no);
        $data['cost']=$cost;
        $data['unit']=$this->input->post('unit');
        $data['shipment_id']=$id;
        $data['warehouse_code']=$this->input->post('warehouse_code');
        $data['total_amount']=$data['quantity_received']*$data['cost'];
		$data['receipt_type']=$this->receipt_type;
		$data['date_received']=$this->input->post('date_received');;
		$data['comments']=$this->input->post('comments');;
		$data['supplier_number']=$this->input->post('supplier_number');
        $data['ref1']=$this->input->post('ref1');
        $data['doc_type']=$this->doc_type;
        $data['doc_status']=$this->input->post('doc_status');
        $data['supplier_number']=$this->input->post('supplier_number');
        
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
		if(!allow_mod2('retur_toko_print'))return false;   
		$nomor=urldecode($nomor);
        $adj=$this->inventory_products_model->get_by_id($nomor)->row();
		$data['shipment_id']=$adj->shipment_id;
		$data['date_received']=$adj->date_received;
		$data['warehouse_code']=$adj->warehouse_code;
		$data['comments']=$adj->comments;
        $data['supplier_number']=$adj->supplier_number;
		$data['content']=load_view('inventory/rpt/print_retur_toko',$data);
        $this->load->view('pdf_print',$data);                
        
    }
    function print_retur_toko($nomor){
        $this->print_bukti($nomor);
    }
    function del_item(){
    	$id=$this->input->post('line_number');
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
    function approve($nomor){
        $nomor=urldecode($nomor);
        
        if(!allow_mod2('retur_toko_approve',true)){
            
            return false;        
        }
        $ok=$this->db->query("update inventory_products set doc_status='APPROVED' 
            where shipment_id='$nomor'");
        $this->add_receive_from($nomor);
        $this->add_retur_supplier_from($nomor);    
        if($ok){
            echo json_encode(array("success"=>true,"msg"=>"Nomor [$nomor] berhasil di update status."));
        } else {
            echo json_encode(array("success"=>false,"msg"=>"Tidak bisa update status !"));
        }
    }
    function add_retur_supplier_from($nomor){
        $retval=false;
        $nomor_target=$nomor."-R";
        $nomor_faktur=$this->input->get("other_doc_number");
        $sql="update inventory_products set other_doc_number='$nomor_faktur' where shipment_id='$nomor'";
        $this->db->query($sql);
        if($nomor_faktur==""){
            $this->error_message.="<br>Nomor faktur tidak ditemukan !";
            return false;
        }
        if(!$faktur_q=$this->purchase_invoice_model->get_by_id($nomor_faktur)){
            $this->error_message.="<br>Nomor faktur [$nomor_faktur] tidak ditemukan !";
            return false;            
        }
        if(!$faktur=$faktur_q->row()){
            $this->error_message.="<br>Nomor faktur [$nomor_faktur] tidak ditemukan !";
            return false;                        
        }
        $warehouse_code=current_gudang();
        $amount=0;        
        if($source=$this->inventory_products_model->get_by_id($nomor)){
            foreach($source->result_array() as $target){
                   
               $nama_barang="";$hbeli=0;$unit="";$qty=0;
               $qty=$target['quantity_received'];
               if($qty==0)$qty=1;
                
               if($item_q=$this->inventory_model->get_by_id($target['item_number'])){
                   if($item_r=$item_q->row()){
                       $nama_barang=$item_r->description;
                       $hbeli=$item_r->cost;
                       if($hbeli==0)$hbeli=$item_r->cost_from_mfg;
                       $unit=$item_r->unit_of_measure;
                   }
               } 
               $po_line['purchase_order_number']=$nomor_target;
               $po_line['item_number']=$target['item_number'];               
               $po_line['description']=$nama_barang;
               $po_line['price']=$hbeli;
               $po_line['quantity']=$qty;
               $po_line['total_price']=$po_line['price']*$po_line['quantity'];
               $po_line['unit']=$unit;
               $po_line['currency_code']=$faktur->currency_code;
               $po_line['currency_rate']=$faktur->currency_rate;
               $po_line['multi_unit']=$unit;
               $po_line['mu_qty']=$po_line['quantity'];
               $po_line['mu_harga']=$po_line['price'];
               $po_line['from_line_number']=$target['id'];
               $po_line['from_line_doc']=$target['shipment_id'];
               $po_line['from_line_type']='retur_toko';
               $po_line['warehouse_code']=$warehouse_code;
               
                 
               $this->purchase_invoice_model->save_item($po_line);         
               $amount+=$po_line['total_price'];
                    
            }
            $po_header['purchase_order_number']=$nomor_target;
            $po_header['po_date']=$target['date_received'];
            $po_header['potype']='R';
            $po_header['amount']=$amount;
            $po_header['supplier_number']=$faktur->supplier_number;
            $po_header['terms']=$faktur->terms;
            $po_header['po_ref']=$nomor_faktur;
            $po_header['saldo_invoice']=$po_header['amount'];
            $po_header['discount']=$faktur->discount;
            $po_header['disc_2']=$faktur->disc_2;
            $po_header['disc_3']=$faktur->disc_3;
            $po_header['warehouse_code']=$faktur->warehouse_code;
            
            $this->purchase_invoice_model->save($po_header);
       }
       return $retval;         
    }
    function add_receive_from($nomor){
        $nomor_target=$nomor."-X";
        if($source=$this->inventory_products_model->get_by_id($nomor)){
            foreach($source->result_array() as $target){
                unset($target["id"]);    
                $target["shipment_id"]=$nomor_target;
                $target["receipt_by"]=user_id();
                $target["supplier_number"]=$target["warehouse_code"];
                $target["warehouse_code"]=current_gudang();
                $target["doc_type"]=3;
                $target["receipt_type"]="ETC_IN";
                $target["date_received"]=date("Y-m-d h:i:s");
                $target["other_doc_number"]=$nomor;
                $target["comments"]="AutoCreate from approve";
                $this->inventory_products_model->save($target);
            }
        }
    }
}
