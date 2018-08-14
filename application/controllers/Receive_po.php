<?php if(!defined('BASEPATH'))	exit('No direct script access allowd');
 
class Receive_po extends CI_Controller {
        private $limit=10;
        private $table_name='inventory_products';
        private $primary_key='shipment_id';
        private $controller='receive_po';
        private $file_view='inventory/receive_po';
        private $sql="select distinct ip.shipment_id, ip.date_received,ip.purchase_order_number, 
        	ip.supplier_number,  s.supplier_name,ip.comments,ip.doc_status            
            from inventory_products ip 
            left join suppliers s on s.supplier_number=ip.supplier_number 
            where ip.receipt_type='PO'";
        
	function __construct()
	{
		parent::__construct();        
         
        
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->model('supplier_model');
        $this->load->model('shipping_locations_model');
        $this->load->model('inventory_products_model');
		$this->load->model('syslog_model');
        $this->load->model('inventory_model');
        $this->load->model('purchase_order_lineitems_model');
        $this->load->model('purchase_order_model');
        $this->load->model('purchase_invoice_model');				
	}
	function index()
	{
		if(!allow_mod2('_80050'))return false;
        $this->browse();
	}
	function nomor_bukti($add=false)
	{
		$key="Receivement Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!TRM~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!TRM~$00001');
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
	        
    function add($po_number='')
    {
		if(!allow_mod2('_80051'))return false;
		$po_number=urldecode($po_number);
        $this->_set_rules();
        $data=$this->set_defaults(); 
        $data['mode']='add';
        //$data['supplier_number']='';
        //$data['date_received']= date("Y-m-d");
		if($po_number!="")
		{
			$this->load->model('purchase_order_model');
			$po=$this->purchase_order_model->get_by_id($po_number);
			if($po){
				$data['supplier_number']=$po->row()->supplier_number;
				$data['purchase_order_number']=$po_number;
				
			} else {
				$data['message']='Po nomor $po_number tidak ditemukan !';
			}
		}
        $this->template->display_form_input($this->file_view,$data,''); 
    }
    function save(){
        $data=$this->input->post();
        $id=$data["shipment_id"];        
        unset($data["shipment_id"]);
        $this->inventory_products_model->update_header($id,$data);        
        header('location: '.base_url().'index.php/receive_po/view/'.$id);
        
    }
	function saveex(){
        $data['potype']='O';
        $id=$this->nomor_bukti();
		$data['purchase_order_number']=$id;
		$data['po_date']=$this->input->post('po_date');
        $data['supplier_number']=$this->input->post('supplier_number');
        $data['terms']=$this->input->post('terms');
        $data['due_date']=$this->input->post('due_date');
        $data['comments']=$this->input->post('comments');

    	if ($this->purchase_order_model->save($data)){
			$this->nomor_bukti(true);
			$this->syslog_model->add($id,"receive_po","edit");

			echo json_encode(array('success'=>true,'purchase_order_number'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		$data['supplier_list']=$this->supplier_model->select_list();
		$data['warehouse_list']=$this->shipping_locations_model->select_list();
		if($record==NULL)  {
		    $data['receipt_by']=user_id();
			$data['date_received']= date("Y-m-d H:i:s");
			$data['receipt_type']='PO';
			$data['shipment_id']=$this->sysvar->autonumber("Receivement Numbering",0,'!TRM~$00001');
            $data['warehouse_code']=$this->session->userdata('session_outlet','');
            $data['doc_status']="OPEN";
		} 
        $setsupp['dlgBindId']="suppliers";
        $setsupp['dlgRetFunc']="$('#supplier_number').val(row.supplier_number);
        $('#supplier_name').html(row.supplier_name);
        ";
        $setsupp['dlgCols']=array( 
                    array("fieldname"=>"supplier_name","caption"=>"Nama Supplier","width"=>"180px"),
                    array("fieldname"=>"supplier_number","caption"=>"Kode","width"=>"80px"),
                    array("fieldname"=>"first_name","caption"=>"Kontak","width"=>"50px"),
                    array("fieldname"=>"city","caption"=>"Kota","width"=>"200px")
                );          
        $data['lookup_suppliers']=$this->list_of_values->render($setsupp);


		return $data;
	}	
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}

	function update()
	{
            $data=$this->set_defaults();
            $this->_set_rules();
            if ($this->form_validation->run()=== TRUE){
                   $data=$this->get_posts();
                   $id=$this->input->post('shipment_id');
                   $this->inventory_products_model->update($id,$data);
                   $message='Update Success';
				   $this->syslog_model->add($id,"receive_po","edit");

           } else {
                   $message='Error Update';
           }
           $this->view($id,$message);		
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80050'))return false;
		$id=urldecode($id);
            $model=$this->inventory_products_model->get_by_id($id)->row();
            $data=$this->set_defaults($model);
            $data['mode']='view';
            $data['message']=$message;
            $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
			$data['has_invoice']=$this->inventory_products_model->has_invoice($id);
             
			$this->template->display('inventory/receive_po_view',$data);
    }
         
    function receive_items($id){
		$id=urldecode($id);
        $sql="select i.item_number,s.description,i.quantity_received,
            i.unit,i.id,i.cost,i.total_amount,s.manufacturer
            from inventory_products i
            left join inventory s on s.item_number=i.item_number
            where shipment_id='".$id."'";
		echo datasource($sql);               
 //       return browse_simple($sql,'Daftar Barang diterima');
    }                 
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('shipment_id','Receive Number', 'required|trim');
		 $this->form_validation->set_rules('supplier_number','Supplier Number',	 'required');
		 $this->form_validation->set_rules('date_received','Tanggal', 'required|trim');
		 $this->form_validation->set_rules('purchase_order_number','Nomor PO', 'required|trim');
	}	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',$str))
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
        $data['caption']='DAFTAR PENERIMAAN BARANG ATAS NOMOR PURCHASE ORDER';
		$data['controller']='receive_po';		
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Nomor PO','Kode Supplier','Nama Supplier','Keterangan','Status','');
		$data['fields']=array('shipment_id', 'date_received', 'purchase_order_number', 
        	'supplier_number','supplier_name','comments','doc_status');
		$data['field_key']='shipment_id';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("Supplier","sid_supplier");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$sql=$this->sql;
    	$nama=$this->input->get('sid_supplier');
		$no=$this->input->get('sid_nomor');
        
        $d1=$this->input->get('sid_date_from');
        $d2=$this->input->get('sid_date_to');
		if($d2!="")$d2= date('Y-m-d H:i:s', strtotime($d2));
        if($d1!=""){
            $d1= date( 'Y-m-d H:i:s', strtotime($d1));
            $sql.=" and date_received between '$d1' and '$d2'";
            
        }

		if($no!=''){
			$sql.=" and shipment_id='".$no."'";
		} else {
		    
			
			if($nama!='')$sql.=" and supplier_name like '$nama%'";	
		}
        $search=$this->input->get("tb_search");
        if($search!=""){
            $sql.=" and (shipment_id like '%$search%')";
        }        
        
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        
        
        
        echo datasource($sql);
    }
	function delete($id){
		if(!allow_mod2('_80053'))return false;
		$id=urldecode($id);
		$nomor_po="";
		if($nomor_po_row=$this->inventory_products_model->get_by_id($id)->row()){
		  $nomor_po=$nomor_po_row->purchase_order_number;   
		};
		if($this->inventory_products_model->validate_delete_receive_po($id) and $this->inventory_products_model->delete($id)){

			$this->load->model('purchase_order_model');
			$this->purchase_order_model->recalc_qty_recvd($nomor_po);
			$this->syslog_model->add($id,"receive_po","delete");

			echo json_encode(array("success"=>true,"msg"=>"Berhasil hapus nomor ini."));
		} else {
			echo json_encode(array("success"=>false,"msg"=>"Gagal hapus nomor ini. <br>Mungkin sudah dibuatkan faktur."));
		};
	}	
    function delete_by_shipment($shipment_id){
        $shipment_id=urldecode($shipment_id);
        $nomor_po="";
        $q=$this->db->query("select purchase_order_number from inventory_products 
            where shipment_id='$shipment_id' and purchase_order_number<>'' limit 1");
        if($q){
            if($r=$q->row()){
                $nomor_po=$r->purchase_order_number;
            }
        }
        $ok=$this->db->where("shipment_id",$shipment_id)->delete("inventory_products");
        $this->purchase_order_model->recalc_qty_recvd($nomor_po);
        echo json_encode(array("success"=>$ok,"msg"=>$ok?"Berhasil hapus nomor ini.":"Error"));
        
    }
	function delete_receive($shipment_id)
        {
		$shipment_id=urldecode($shipment_id);
			$nomor_po=$this->inventory_products_model->get_by_id($shipment_id)->row()->purchase_order_number;
            $this->inventory_products_model->delete($shipment_id);
			$this->load->model('purchase_order_model');
			$this->purchase_order_model->recalc_qty_recvd($nomor_po);
        }
	function add_item($recv_id){                
		$recv_id=urldecode($recv_id);
                $data['shipment_id']=$recv_id;
                $data['quantity_received']=$_GET['qty'];
                $data['item_number']=$_GET['item'];
                $data['receipt_type']='ETC_IN';
                $data['warehouse_code']=$this->access->cid;
                $this->inventory_card_header_model->add_item($data);
                echo $this->receive_items($recv_id);
	}
	function del_item($id,$recv_id){
		$id=urldecode($id);
		$recv_id=urldecode($recv_id);
        $this->db->where('id',$id);
		$this->db->delete('inventory_products');
        echo $this->receive_items($recv_id);
	}	
	function print_bukti($nomor){
		$nomor=urldecode($nomor);
		$rcv=$this->inventory_products_model->get_by_id($nomor)->row();
		$data['shipment_id']=$rcv->shipment_id;
		$data['date_received']=$rcv->date_received;
		$data['warehouse_code']=$rcv->warehouse_code;
		$data['comments']=$rcv->comments;
		$data['purchase_order_number']=$rcv->purchase_order_number;
		$data['content']=load_view('inventory/rpt/print_receive',$data);
		$this->load->view('pdf_print',$data);
	}
    function print_receive_po($nomor){
        $this->print_bukti($nomor);
    }

	function proses()
	{
		if(!allow_mod2('_80050'))return false;
		$po_number=$this->input->post('purchase_order_number');
		$po=$this->purchase_order_model->get_by_id($po_number)->row();
		
		$data['purchase_order_number']=$po_number;
		$data['shipment_id']=$this->nomor_bukti();
		
		$data['supplier_number']=$po->supplier_number;
		$data['date_received']=$this->input->post('date_received');
		$data['warehouse_code']=$this->input->post('warehouse_code');
		$data['comments']=$this->input->post('comments');
		$data['receipt_by']=$this->input->post('receipt_by');
		$data['receipt_type']='PO';
		$data['ref1']=$this->input->post('ref1');
        $data['doc_status']=$this->input->post("doc_status");
        if($data['doc_status']=="")$data["doc_status"]="OPEN";
        
		$qty=$this->input->post('qty');
		$line=$this->input->post('line');
		//var_dump(count($qty));
		for($i=0;$i<count($qty);$i++){
			if($qty[$i]>0){
				$cost=0;
				$poline=$this->purchase_order_lineitems_model->get_by_id($line[$i])->row();
				$itemno=$poline->item_number;
				$stock=$this->inventory_model->get_by_id($itemno)->row();
				$qty_now=$qty[$i];
				$qty_sisa=($poline->quantity-$poline->qty_recvd);
				if($qty_now>$qty_sisa) $qty_now=$qty_sisa;
				$unit=$poline->unit;
				if($unit=="")$unit=$stock->unit_of_measure;
				if($stock){
					$cost=$stock->cost;
					if($cost==0)$cost=$stock->cost_from_mfg;
					$itemno=$stock->item_number;
				}
				$data['item_number']=$itemno;
				$data['cost']=$cost;
				$data['quantity_received']=$qty_now;
				$data['unit']=$unit;
				$data['total_amount']=$data['quantity_received']*$data['cost'];
				$data['from_line_number']=$line[$i];
				$this->inventory_products_model->save($data);
				$this->purchase_order_lineitems_model->update_qty_received($line[$i],$qty_now);
			}
		}
		$this->purchase_order_model->update_received($po_number);
		$this->nomor_bukti(true);
        
        if($po->type_of_invoice!=3){
           //3=selain sistim 3 konsinyasi langsung bikin faktur pembelian        
            if($this->my_setting->create_invoice_from_receive()){
                //1-putus langsung bikinkan faktur
                $this->create_from_recv($data['shipment_id']);
            }
        
        }
        
		header('location: '.base_url().'index.php/receive_po/view/'.$data['shipment_id']);
	}
    function create_from_recv($shipment_id){
            $this->purchase_invoice_model->create_from_recv($shipment_id);        
    }
	function add_with_po($purchase_order_number)
	{
		$purchase_order_number=urldecode($purchase_order_number);
		$data=$this->set_defaults(); 
		$data['message']='update error';
		$data['mode']='add';
		$data['purchase_order_number']=$purchase_order_number;
		$po=$this->purchase_order_model->get_by_id($purchase_order_number)->row();
		$data['supplier_number']=$po->supplier_number;
		$data['supplier_info']=$this->supplier_model->info($po->supplier_number);
		$data['po_item']=$this->purchase_order_lineitems_model->lineitems($purchase_order_number);

		$this->template->display_form_input('inventory/receive_po_number',$data,''); 
		
	}
	function list_open($supplier_number)
	{
		$supplier_number=urldecode($supplier_number);
		$sql="select distinct shipment_id,date_received,warehouse_code,purchase_order_number
		from inventory_products
		where receipt_type='PO' and (selected=false or isnull(selected))
		and supplier_number='$supplier_number'";
		$query=$this->db->query($sql);
		
		$i=0;
		$data="<table class='table'><thead><tr><td>Nomor Receive</td><td>Tanggal</td>
		<td>Gudang</td><td>Nomor PO</td><td>Pilih</td></tr></thead><tbody>";
		foreach($query->result() as $row){
			$data.="<tr><td>".$row->shipment_id."</td><td>".$row->date_received."</td><td>".$row->warehouse_code."</td>";
            $data.="<td>$row->purchase_order_number</td>";
			$data.="<td><input type='checkbox' name='nomor[]' value='".$row->shipment_id."'></td>";
			$data.="</tr>";
			$i++;
		}
		$data.="</tbody></table>";
		echo $data;
	}
	function create_new_invoice($invoice_number)
	{
		$invoice_number=urldecode($invoice_number);
		$nomor=$this->input->post('nomor');
        $recv_nos="";
        $po_nos="";
        $retval=null;
		for($i=0;$i<count($nomor);$i++)
		{
			$retval[]=$this->insert_invoice_items_receive($nomor[$i],$invoice_number);
			$recv_nos.=$nomor[$i].",";
		}
		if($retval){
		    for($i=0;$i<count($retval);$i++){
		        $po_nos.=$retval[$i]['purchase_order_number'].",";
		    }
		}
        $faktur["po_ref"]=$po_nos;
        $faktur['ref1']=$recv_nos;
        $this->db->where("purchase_order_number",$invoice_number)->update("purchase_order",$faktur);
		echo json_encode(array('success'=>true,'purchase_order_number'=>$invoice_number,
		  "ref1"=>$recv_nos,"ref2"=>$po_nos));

	}
	
	function insert_invoice_items_receive($shipment_id,$invoice_number)
	{
		$shipment_id=urldecode($shipment_id);
		$invoice_number=urldecode($invoice_number);
		$query=$this->inventory_products_model->get_by_id($shipment_id);
		
        $po_no="";
        
		foreach($query->result() as $row)
		{
			$item_name='';
			$q=$this->db->query("select description from inventory where item_number='".$row->item_number."'");
			if($q->row()){
				$item_name=$q->row()->description;
			}
			$from_line=$row->from_line_number;
            if($po_no=="")$po_no=$row->purchase_order_number;
            
			$discount=0;	$disc_2=0;	$disc_3=0;	$price=0;
			if($from_line>0){
				if($qpo=$this->db->where("line_number",$from_line)->get("purchase_order_lineitems"))
				{
					if($rpo=$qpo->row()){
						$discount=$rpo->discount;
						$disc_2=$rpo->disc_2;
						$disc_3=$rpo->disc_3;
						$price=$rpo->price;
					}
				}
			}
			$data['purchase_order_number']=$invoice_number;
			$data['item_number']=$row->item_number;
			$data['description']=$item_name;
			$data['price']=$price;
			$data['quantity']=$row->quantity_received;
			$data['unit']=$row->unit;
			$data['warehouse_code']=$row->warehouse_code;
			$data['from_line_number']=$row->id;
			$data['from_line_doc']=$row->shipment_id;
			$data['total_price']=$row->total_amount;
			$data['discount']=$discount;
			$data['disc_2']=$disc_2;
			$data['disc_3']=$disc_3;
			$data['from_line_type']="RCV";
			$ok=$this->purchase_order_lineitems_model->save($data);
            
		}
		$this->db->query("update inventory_products set selected=1 where shipment_id='".$shipment_id."'");
		
        $retval["purchase_order_number"]=$po_no;
        $retval["shipment_id"]=$shipment_id;
        
        return $retval;
	}
	function list_by_po($nomor_po)
	{
		$nomor_po=urldecode($nomor_po);
		$sql="select shipment_id,date_received,warehouse_code,receipt_by,selected ,ip.item_number,
		i.description,quantity_received
		from inventory_products ip left join inventory i on i.item_number=ip.item_number 
		where purchase_order_number='$nomor_po'";
	 
 		echo datasource($sql);
	}
    function status($shipment_id,$status){
        $ok=$this->db->where("shipment_id",$shipment_id)->update("inventory_products",
        array("doc_status"=>$status));
        if($ok){
            echo json_encode(array("success"=>true,"msg"=>"Berhasil."));
        } else {
            echo json_encode(array("success"=>false,"msg"=>"Gagal"));
        }
    }
}
