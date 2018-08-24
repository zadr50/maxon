<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Delivery_order extends CI_Controller {
    private $limit=10;
    private $controller='delivery_order';
    private $primary_key='invoice_number';
    private $file_view='sales/delivery_order';
    private $table_name='invoice';
	function __construct()
	{
		parent::__construct();        
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('invoice_model');
		$this->load->model('customer_model');
        $this->load->model('inventory_model');
        $this->load->model('type_of_payment_model');
		$this->load->model('salesman_model');
		$this->load->library("list_of_values");
		$this->load->model('syslog_model');
	}
	function nomor_bukti($add=false)
	{
		$key="Delivery Order Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!SJ~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!SJ~$00001');
				$rst=$this->invoice_model->get_by_id($no)->row();
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
		if($record==NULL){
		    $data['invoice_number']="AUTO";  ///$this->nomor_bukti();
            $data['invoice_type']='D';
            $data['invoice_date']= date("Y-m-d H:i:s");
            $data['warehouse_code']=current_gudang();
        }
		$data['allow_add']=allow_mod('_30061');
		$data['allow_edit']=allow_mod('_30062');
		$data['allow_delete']=allow_mod('_30063');
		$data['allow_print']=allow_mod('_30066');
		$data['allow_posting']=allow_mod('_30061');
		$data['allow_approve']=allow_mod('_30067');
        
        $setwh['dlgBindId']="warehouse";
        $setwh['dlgRetFunc']="$('#warehouse_code').val(row.location_number);
        $('#bill_to_contact').val(row.company_name);";
        $setwh['dlgCols']=array( 
                array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
            );          
        
        $data['lookup_gudang']=$this->list_of_values->render($setwh);
        
        $setwh['dlgBindId']="salesman";
        $setwh['dlgRetFunc']="$('#salesman').val(row.salesman);";
        $setwh['dlgCols']=array( 
                    array("fieldname"=>"salesman","caption"=>"Salesman","width"=>"180px")
                );          
        $data['lookup_salesman']=$this->list_of_values->render($setwh);

        
        		
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
		if (!allow_mod2('_30061'))  exit;
	    $data=$this->set_defaults();
	    $this->_set_rules();
		$this->load->model('invoice_lineitems_model');        
		$this->load->model('sales_order_model');               
		$this->load->model('shipping_locations_model');
		$data['mode']='add';
		$data['message']='';
        //$data['customer_list']=$this->customer_model->select_list();
		//$data['salesman_list']=$this->salesman_model->select_list();
		//$data['so_list']=$this->sales_order_model->select_list_not_delivered();
        $data['sold_to_customer']="";
        $data['amount']=$this->input->post('amount');
        $data['customer_info']=$this->customer_model->info($data['sold_to_customer']);
		 
		$this->template->display_form_input($this->file_view,$data,'');			
	}
	function save()
	{
		$this->load->model('sales_order_model');
		$mode=$this->input->post('mode');
		if($mode=="add" || $this->input->post("invoice_number")=="AUTO"){
	        $id=$this->nomor_bukti();
		} else {
			$id=$this->input->post('invoice_number');			
		}
		$data['invoice_type']='D';
		$data['invoice_number']=$id;
		$data['sold_to_customer']=$this->input->post('sold_to_customer');
		$data['invoice_date']=$this->input->post('invoice_date');
		$data['sales_order_number']=$this->input->post('sales_order_number');
		$data['due_date']=$this->input->post('due_date');
		$data['comments']=$this->input->post('comments');
		$data['warehouse_code']=$this->input->post('warehouse_code');	 
		$data['salesman']=$this->sales_order_model->get_salesman($data['sales_order_number']);
		
		
		if($mode=="add"){

			$ok=$this->invoice_model->save($data);
			$this->invoice_model->save_from_so_items($data['invoice_number'],
			$this->input->post('qty_order'),
			$this->input->post('line_number'),
			$this->input->post('warehouse_code'),
			$this->input->post('invoice_date'),
			$this->input->post('qty_unit')
			
			);

		} else {
			$ok=$this->invoice_model->update($id,$data);
		}
		$this->syslog_model->add($id,"delivery_order",$mode);
		
		$this->sales_order_model->recalc_ship_qty($data['sales_order_number']);
		
		if ($ok){
			if($mode=="add") $this->nomor_bukti(true);
			echo json_encode(array('success'=>true,'msg'=>'Success',
			 'invoice_number'=>$id,"data"=>$data));
		} else {
			echo json_encode(array('success'=>false,'msg'=>'Some errors occured.'));
		}
	}
	
	function sales_order_not_delivered(){
		$this->load->model('sales_order_model');
		var_dump($this->sales_order_model->select_list_not_delivered());
		return true;
	}
	function updatex()
	{
		 $data=$this->set_defaults();              
		 $this->_set_rules();
 		 $id=$this->input->post('invoice_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['invoice_type']='D'; 
			$this->invoice_model->update($id,$data);
            $message='Update Success';
		} else {
			$message='Error Update';
		}
                
 		$this->view($id,$message);		
	}
	function add_item(){
        	$nomor=$this->input->get('invoice_number');            
            if(!$nomor){
                $data['message']='Nomor faktur tidak diisi.!';
				echo $data['message'];
				return false;
            }
            $data['invoice_number']=$nomor;
            $data['item_lookup']=$this->inventory_model->item_list();
            $this->load->view('sales/invoice_add_item',$data);
   }
	function save_item(){
        $item_no=$this->input->post('item_number');
		$faktur=$this->input->post('invoice_number_item');
        if(!($item_no||$faktur)){
        	$msg='Kode barang atau nomor faktur tidak diisi !';
        }

		$id=$this->input->post('line_number');
		if($id!='')$data['line_number']=$id;

        $data['invoice_number']=$faktur;
        $data['item_number']=$item_no;
        $data['quantity']=$this->input->post('quantity');
        $data['unit']=$this->input->post('unit');
        $data['price']=$this->input->post('price');
        $data['cost']=$this->input->post('cost');			
        $data['discount']=$this->input->post('discount');			

        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
		if($item){
            $data['description']=$item->description;
		}
		if($data['cost']==0)$data['cost']=$item->cost;
        $gross=$data['quantity']*$data['price'];
		$disc_amount=$data['discount']*$gross;
		$data['amount']=$gross-$disc_amount;
	
        $this->load->model('invoice_lineitems_model');
		
		if($id!=''){
			$ok=$this->invoice_lineitems_model->update($id,$data);
		} else {
        	$ok=$this->invoice_lineitems_model->save($data);
		}
//		$msg=var_dump($data);
		//$this->invoice_model->recalc($faktur);
		 
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }    
    function save_item_ex(){ 
        $item_no=$this->input->post('item_number');
		$faktur=$this->input->post('invoice_number');
		$data['warehouse_code']=$this->input->post('warehouse_code');
        if(!($item_no||$faktur)){
        	$data['message']='Kode barang atau nomor faktur tidak diisi !';
        	echo $data['message'];
        	return false;
        }
        $data['invoice_number']=$faktur;
        $data['item_number']=$item_no;
        $data['quantity']=$this->input->post('quantity');
        $data['unit']=$this->input->post('unit');
        $data['price']=$this->input->post('price');
        $data['cost']=$this->input->post('cost');			

        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
		if($item){
            $data['description']=$item->description;
		}
        $data['amount']=$data['quantity']*$data['price'];

        $this->load->model('invoice_lineitems_model');
        return $this->invoice_lineitems_model->save($data);
    }        
    function delete_item($id){
		$id=urldecode($id);
        $this->load->model('invoice_lineitems_model');
        return $this->invoice_lineitems_model->delete($id);
    }        
	function view($id,$message=null){
		if(!allow_mod2('_80060'))return false;   
		$id=urldecode($id);
		$message=urldecode($message);
		$this->load->model('invoice_lineitems_model');
		$this->load->model('shipping_locations_model');
		 $data['id']=$id;
		 $model=$this->invoice_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['warehouse_code']=$this->invoice_model->warehouse_code;
		 $data['mode']='view';
         $data['message']=$message;
		 $cst=$this->invoice_model->get_by_id($data['sold_to_customer'])->row();
		 if($cst){
		 	
		 } else {
		 	
		 }
         $data['customer_info']=$this->customer_model->info($data['sold_to_customer']);
        $data['warehouse_list']=$this->shipping_locations_model->select_list();
         $menu='';
		 $this->session->set_userdata('_right_menu',$menu);
         $this->session->set_userdata('invoice_number',$id);
         $this->template->display($this->file_view,$data);                 
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('invoice_number','Nomor Faktur', 'required|trim');
		 //$this->form_validation->set_rules('invoice_date','Tanggal','callback_valid_date');
		 $this->form_validation->set_rules('sold_to_customer','Pelanggan', 'required|trim');
	}
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date','Format tanggal salah, seharusnya yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
	function search(){$this->browse();}
	
    function browse($offset=0,$limit=50,$order_column='invoice_number',$order_type='asc'){
        $data['caption']='DAFTAR BUKTI PENGIRIMAN';
		$data['controller']=$this->controller;		
		$data['_left_menu_caption']='Search';
		$data['fields_caption']=array('Nomor DO','Tanggal','Nomor SO','Kode Cust','Nama Customer','Kota','Gudang');
		$data['fields']=array('invoice_number','invoice_date','sales_order_number','sold_to_customer'
			,'company','city','warehouse_code');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='invoice_number';
		
		$this->load->library('search_criteria');
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor DO","sid_do_number");
		$faa[]=criteria("Pelanggan","sid_cust");
		$faa[]=criteria("Nomor SO","sid_so_number");
		$data['criteria']=$faa;

        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	$nama=$this->input->get('sid_cust');
		$no=$this->input->get('sid_do_number');
		$so=$this->input->get('sid_so_number');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        if($d1<'2000-01-01')$d1=date("Y-m-d");        
        if($d2<'2000-01-01')$d2=date("Y-m-d H:i:s");        
		
     	$sql="select i.invoice_number,i.invoice_date,i.sales_order_number, 
            i.sold_to_customer,c.company,c.city,i.warehouse_code
            from invoice i
            left join customers c on c.customer_number=i.sold_to_customer
            where   invoice_type='D'";
        $tb_search=$this->input->get("tb_search");
        if($tb_search){
            if($tb_search!="")$no=$tb_search;
        }
		if($no!=''){
			$sql.=" and invoice_number='".$no."'";
		} else {
			$sql.=" and invoice_date between '$d1' and '$d2'";
			if($nama!='')$sql.=" and company like '$nama%'";	
			if($so!='')$sql.=" and sales_order_number='$so'";
		}
		if(lock_report_salesman())$sql.=" and i.salesman='".current_salesman()."'";
        //$sql.=" limit $offset,$limit";
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        		
        echo datasource($sql);
    }	 
	function delete($id){
		if (!allow_mod2('_30063',true))  exit;
		$id=urldecode($id);
		$so='';
		if($q=$this->invoice_model->get_by_id($id)->row()){
			$so=$q->sales_order_number;
		}
	 	$this->invoice_model->delete($id);
		if($so!='') {
			$this->syslog_model->add($id,"delivery_order","delete");

			$this->load->model('sales_order_model');
			$this->sales_order_model->recalc_ship_qty($so);
		}
        $this->browse();

	}
    function detail(){
        $data['invoice_date']=isset($_GET['invoice_date'])?$_GET['invoice_date']:'';
        $data['sold_to_customer']=isset($_GET['sold_to_customer'])?$_GET['sold_to_customer']:'';
        $data['payment_terms']=isset($_GET['payment_terms'])?$_GET['payment_terms']:'';
        $data['comments']=isset($_GET['comments'])?$_GET['comments']:'';
		$data['salesman']=isset($_GET['salesman'])?$_GET['salesman']:'';
		$data['invoice_number']=$this->nomor_bukti();	// ambil nomor terbaru
        $this->invoice_model->save($data);
        $this->nomor_bukti(true);
		redirect("/delivery_order/view/".$data['invoice_number']);
    }
	function view_detail($nomor){
		$nomor=urldecode($nomor);
        $sql="select p.item_number,i.description,p.quantity 
        ,p.unit,p.price,p.amount,p.line_number
        from invoice_lineitems p
        left join inventory i on i.item_number=p.item_number
        where invoice_number='$nomor'";
        echo browse_simple($sql);
   }
    function print_faktur($nomor){
		if(!allow_mod2('_80064'))return false;   
		$nomor=urldecode($nomor);
        $invoice=$this->invoice_model->get_by_id($nomor)->row();
		$saldo=$this->invoice_model->recalc($nomor);
		$data['invoice_number']=$invoice->invoice_number;
		$data['invoice_date']=$invoice->invoice_date;
		$data['sold_to_customer']=$invoice->sold_to_customer;
		$data['comments']=$invoice->comments;
		$data['sales_order_number']=$invoice->sales_order_number;
		$data['due_date']=$invoice->due_date;
        $data['content']=load_view('sales/rpt/print_do',$data);
        $this->load->view('pdf_print',$data);
    }    
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity 
		,p.unit,p.price,p.discount,p.amount,p.line_number,
		p.discount,p.disc_2,p.disc_3
		from invoice_lineitems p
		left join inventory i on i.item_number=p.item_number
		where invoice_number='$nomor'";
		echo datasource($sql);
	}
	function select_do_open($cust) {
		$cust=urldecode($cust);
		$sql="select invoice_number,invoice_date,salesman,shipped_via,warehouse_code,due_date
		from invoice where invoice_type='D'
		and sold_to_customer='$cust' and (do_invoiced is null or do_invoiced=0)";
		echo datasource($sql);
	}
	function insert_invoice($nomor_do,$nomor_faktur) {
		$nomor_do=urldecode($nomor_do);
		$nomor_faktur=urldecode($nomor_faktur);
		$this->load->model("invoice_lineitems_model");
		if($q=$this->db->where("invoice_number",$nomor_do)
			->get("invoice_lineitems"))
		{
			foreach($q->result() as $row)
			{
				$price=$row->price;
				$discount=$row->discount;
				$disc_2=$row->disc_2;
				$disc_3=$row->disc_3;
				$cost=$row->cost;
				$unit=$row->unit;
				$from_line_so=$row->from_line_number;
				if((double)$from_line_so>0){
					if($q=$this->db->where("line_number",$from_line_so)->get("sales_order_lineitems"))
					{
						if($r=$q->row()){
							$discount=$r->discount;
							$disc_2=$r->disc_2;
							$disc_3=$r->disc_3;
							if($unit==$r->unit){
								$price=$r->price;
								$cost=$r->cost;
								$unit=$r->unit;
							}
						}
					}
				}
				$data['item_number']=$row->item_number;
				$data['description']=$row->description;
				$data['warehouse_code']=$row->warehouse_code;
				$data['from_line_number']=$row->line_number;
				$data['from_line_type']="DO";
				$data['from_line_doc']=$row->invoice_number;
				$data['price']=$price;
//				$data['mu_harga']=$row->mu_harga;
				$data['discount']=$discount;
//				$data['discount_amount']=$row->discount_amount;
				$data['disc_2']=$disc_2;
//				$data['disc_amount_2']=$row->disc_amount_2;
				$data['disc_3']=$disc_3;
//				$data['disc_amount_3']=$row->disc_amount_3;
				$data['cost']=$cost;
//				$data['amount']=$row->amount;
				$data['quantity']=$row->quantity;
//				$data['mu_qty']=$row->mu_qty;
				$data['unit']=$unit;
//				$data['multi_unit']=$row->multi_unit;
				$data['invoice_number']=$nomor_faktur;
				$this->invoice_lineitems_model->save($data);
			}
		} else {
		    echo "Nomor: $nomor_do tidak ada !";
		}
		$sql="update invoice set do_invoiced=true where invoice_number='$nomor_do'";
		$this->db->query($sql);
		
	}
	function alloc_item_line($line_number)
	{
		$do=$this->db->select("item_number,description,quantity,unit")
			->where("line_number",$line_number)->get("invoice_lineitems");
		if($row=$do->row()){
			$data["item_no_old"]=$row->item_number;
			$data["item_qty_old"]=$row->quantity;
			$data["item_unit_old"]=$row->unit;
			$data["item_desc_old"]=$row->description;
		}
		$data["item_no_line"]=$line_number;
		
		$setting['dlgBindId']="inventory";
		$setting['dlgCols']=array( 
			array("fieldname"=>"item_number","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"description","caption"=>"Nama Barang","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#item').val(row.item_number); 
		$('#desc').val(row.description); ";
		$data['lookup_items']=$this->list_of_values->render($setting);
		
		$session=array();
		$key="DO_ALLOC_LINE_".$line_number;
		$this->session->set_userdata($key,$session);
		
		$this->template->display("sales/delivery_alloc_line",$data);
	}
	function alloc_item_submit()
	{
		$this->load->model("invoice_lineitems_model");
		$line=$this->input->get('from_line');
		$sj=$this->db->where("line_number",$line)->get("invoice_lineitems")->row();
		$ok=false;
		if($data=$this->session->userdata("DO_ALLOC_LINE_".$line))
		{
			for($i=0;$i<count($data);$i++)
			{
				$d2=$data[$i];			
				$ok=$this->invoice_lineitems_model->save($d2);
			}
			
		}
		if($ok){
			//if success delete / update line to other
			if($line){
				$this->db->where("line_number",$line)
				->update("invoice_lineitems",
				array("invoice_number"=>$sj->invoice_number."-DO_ALLOC"));
			}
			$result=true;
			$msg="Success.";
			$data=$this->db->where("from_line_number",$line)
				->where("from_line_doc","DO_ALLOC")
				->get("invoice_lineitems")->result_array();
				
			$session=array();
			$key="DO_ALLOC_LINE_".$line;
			$this->session->set_userdata($key,$session);
			$this->session->unset_userdata($key);
				
		} else {
			$result=false;
			$msg="Error !";
		};
		echo json_encode(array("success"=>true,"msg"=>$msg,"data"=>$session));
	}
	function alloc_item_line_add()
	{
		$line=$this->input->get('from_line');
		$d2['item_number']=$this->input->get("item");
		$sj=$this->db->where("line_number",$line)->get("invoice_lineitems")->row();
		$item=$this->db->where("item_number",$d2['item_number'])
			->get("inventory")->row();
		$d2['invoice_number']=$sj->invoice_number;
		$d2['discount']=$sj->discount;
		$d2['disc_2']=$sj->disc_2;
		$d2['disc_3']=$sj->disc_3;
		$d2['warehouse_code']=$sj->warehouse_code;
		$d2['quantity']=$this->input->get('qty');
		$d2['description']=$item->description;
		$d2['unit']=$item->unit_of_measure;
		$d2['price']=$item->retail;
		$d2['cost']=$item->cost;
		$d2['from_line_number']=$line;
		$d2['from_line_doc']="DO_ALLOC";
		$d2['amount']=$d2['quantity']*$d2['price'];
		$session=$this->session->userdata("DO_ALLOC_LINE_".$line);
		$session[]=$d2;
		$this->session->set_userdata("DO_ALLOC_LINE_".$line,$session);
		$msg="";
		echo json_encode(array("success"=>true,"msg"=>$msg,"data"=>$session));
	}
	function alloc_item_line_delete($id)
	{
		$id=urldecode($id);
		if($result=$this->db->where("line_number",$id)
			->delete("invoice_lineitems"))
		{
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("success"=>false));
		}
	}
	function approve($nomor=''){
		$nomor=urldecode($nomor);
		$sql="update invoice set status=1 where invoice_number='$nomor'";
		
		if($qry=$this->db->query($sql)){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('success'=>false));
		}
	}		
}
?>
