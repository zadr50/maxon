<?php 

if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sales_order extends CI_Controller {
    private $limit=10;
    private $sql="select i.sales_order_number,i.sales_date,i.due_date,i.amount, 
            i.sold_to_customer,c.company,i.salesman,c.city,i.warehouse_code,i.delivered,
			i.status
            from sales_order i
            left join customers c on c.customer_number=i.sold_to_customer";
    private $controller='sales_order';
    private $primary_key='sales_order_number';
    private $file_view='sales/sales_order';
    private $table_name='sales_order';
	function __construct()
	{
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('sales_order_model');
		$this->load->model('customer_model');
		$this->load->model('inventory_model');
        $this->load->model('type_of_payment_model');
		$this->load->model('salesman_model');
		$this->load->model('syslog_model'); 
	}
	function nomor_bukti($add=false)
	{
		$key="Sales Order Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!SO~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!SO~$00001');
				$rst=$this->sales_order_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
					}
	}
	
	function set_defaults($record=NULL)
	{
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            if($record==NULL)$data['sales_order_number']="AUTO";    //$this->nomor_bukti();
			if($data['sales_date']=='')$data['sales_date']= date("Y-m-d H:i:s");
			if($data['due_date']=='')$data['due_date']= date("Y-m-d H:i:s");
			$data['customer_info']=""; 
			$data['cust_type']=""; 
			$data['status_list']=array("0"=>"Draft","1"=>"Open",
			"2"=>"Close","3"=>"Canceled","4"=>"Pending","5"=>"Auto Close");
			$data["payment_terms"]="KREDIT"; 
            $data["salesman"]="OFFICE";
			$data['allow_add']=allow_mod('_30051');
			$data['allow_edit']=allow_mod('_30052');
			$data['allow_delete']=allow_mod('_30053');
			$data['allow_print']=allow_mod('_30056');
			$data['allow_posting']=allow_mod('_30051');
			$data['allow_approve']=allow_mod('_30057');

			return $data;
	}
	function index()
	{            
		if (!allow_mod2('_30050'))  exit;
        $this->browse();
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		if (!allow_mod2('_30051'))  exit;
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['sales_order_number']=$this->nomor_bukti(); 
			$this->sales_order_model->save($data);
			$this->nomor_bukti(true);

            //redirect('/sales_order/view/'.$$data['purchase_order_number'], 'refresh');
		} else {
			$data['mode']='add';
			$data['message']='';
            $data['sold_to_customer']=$this->input->post('sold_to_customer');
            //$data['customer_list']=$this->customer_model->select_list();
			$data['salesman_list']=$this->salesman_model->select_list();
            $data['amount']=$this->input->post('amount');
            $data['payment_terms_list']=$this->type_of_payment_model->select_list();
			$data['mode']='add';			
			$this->template->display_form_input($this->file_view,$data,'');			
		}        
	}
	function save()	{ 
        $data=$this->input->post();
        $mode=$data['mode'];
        $id=$data['sales_order_number'];           
		if($mode=="add" || $id=="AUTO"){
	        $id=$this->nomor_bukti();
		} 
		 
		$data['sales_order_number']=$id;
		$data['delivered']=$data['delivered'];
		$data['discount']=$data['disc_total_percent']; 
		$data['amount']=$data['total']; 
		unset($data['mode']);
		unset($data['sub_total']);
		unset($data['disc_total_percent']);
		unset($data['total']);
		unset($data['cust_type']); 
			/*
			$data['sales_date']=$this->input->post('sales_date');
			$data['sold_to_customer']=$this->input->post('sold_to_customer');
			$data['salesman']=$this->input->post('salesman');
			$data['payment_terms']=$this->input->post('payment_terms');
			$data['due_date']=$this->input->post('due_date');
			$data['comments']=$this->input->post('comments');			
			$data['sales_tax_percent']=$this->input->post('sales_tax_percent');
			*/

	        $this->session->set_userdata('sales_order_number',$id);
			 
		if($mode=="add"){
		    $data["status"]=0;
			$ok=$this->sales_order_model->save($data);
			$this->syslog_model->add($id,"sales_order","add");

		} else {
			$ok=$this->sales_order_model->update($id,$data);
			$this->syslog_model->add($id,"sales_order","edit");

		}
		$this->recalc($id);
		if ($ok){
			if($mode=="add") $this->nomor_bukti(true);
			echo json_encode(array('success'=>true,"msg"=>"Sukses",'sales_order_number'=>$id,"data"=>$data));
		} else {
			echo json_encode(array('success'=>false,'msg'=>'Some errors occured.'));
		}
	}
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('sales_order_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			 
			$this->sales_order_model->update($id,$data);
			$this->syslog_model->add($id,"sales_orde","edit");

            $message='Update Success';
		} else {
			$message='Error Update';
		}                
 		$this->view($id,$message);		
	}
	function view($id,$message=null){
		if (!allow_mod2('_30050'))  exit;
		$id=urldecode($id);
		$this->sales_order_model->recalc_ship_qty($id);
		 $data['id']=$id;
		 $model=$this->sales_order_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
         $data['customer_list']=$this->customer_model->select_list();  
         $data['customer_info']=$this->customer_model->info($data['sold_to_customer']);
		 $data['salesman_list']=$this->salesman_model->select_list();
		 $data['cust_type']=$this->customer_model->customer_type($data['sold_to_customer']);
         $menu='sales/menu_sales_order';
		 $this->session->set_userdata('_right_menu',$menu);
         $this->session->set_userdata('sales_order_number',$id);
         $data['payment_terms_list']=$this->type_of_payment_model->select_list();
		 $this->template->display_form_input($this->file_view,$data,'');			
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('sales_order_number','Nomor Sales Order', 'required|trim');
		 $this->form_validation->set_rules('sales_date','Tanggal','callback_valid_date');
	}
	 
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'Format tanggal salah, seharusnya yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
	function search(){$this->browse();}
	
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['_left_menu_caption']='Search';
		$data['fields_caption']=array('Nomor SO','Tanggal','Tgl Kirim','Jumlah','Nama Customer','Salesman'
			,'Terkirim','Status');
		$data['fields']=array('sales_order_number','sales_date','due_date','amount'
			,'company','salesman','delivered','status');
		$data['field_key']='sales_order_number';
		$data['caption']='DAFTAR SALES ORDER';

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor SO","sid_so_number");
		$faa[]=criteria("Pelanggan","sid_cust");
		$faa[]=criteria("Salesman","sid_salesman");
		$faa[]=criteria("Terkirim","sid_delivered");
		$data['criteria']=$faa;
		$this->template->display_browse2($data);
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		
		$time_start = microtime(true);

		
    	$nama=$this->input->get('sid_cust');
		$no=$this->input->get('sid_so_number');
		$salesman=$this->input->get('sid_salesman');
		$delivered=$this->input->get('sid_delivered');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql=$this->sql." where 1=1";
        
        $tb_search=$this->input->get("tb_search");
        if($tb_search){
            if($tb_search!="")$no=$tb_search;
        }
		if($no!=''){
			$sql.=" and sales_order_number='".$no."'";
		} else {
			$sql.=" and sales_date between '$d1' and '$d2'";
			if($nama!='')$sql.=" and company like '$nama%'";	
		}
		if ($salesman!="") $sql.=" and salesman='$salesman'";
		if ($delivered!="") $sql.=" and delivered=$delivered";
		if(lock_report_salesman())$sql.=" and i.salesman='".current_salesman()."'";
        //$sql.=" limit $offset,$limit";
		//echo $sql;
		//get script end time
		$time_end = microtime(true);

		//calculate the difference between start and stop
		$time = $time_end - $time_start;

		//echo it 
		//echo "Did whatever in $time seconds\n";


        echo datasource($sql);
		
		$time_end = microtime(true);

		//calculate the difference between start and stop
		$time = $time_end - $time_start;

		//echo it 
		//echo "Did whatever in $time seconds\n";
		
    }	 
	function delete($id){
		if (!allow_mod2('_30053',true))  exit;
		$id=urldecode($id);
	 	$this->sales_order_model->delete($id);
		$this->syslog_model->add($id,"sales_order","delete");

        $this->browse();
	}
    function detail(){
        $data['sales_date']=$this->input->get('sales_date');
        $data['sold_to_customer']=$this->input->get('sold_to_customer');
        $data['payment_terms']=$this->input->get('payment_terms');
        $data['comments']=$this->input->get('comments');
		$data['salesman']=$this->input->get('salesman');
		$data['due_date']=$this->input->get('due_date');
		$data['sales_order_number']=$this->nomor_bukti();	// ambil nomor terbaru
        $this->sales_order_model->save($data);
        $this->nomor_bukti(true);
		header("location: ".base_url()."index.php/sales_order/view/".$data['sales_order_number']);
    }
	function view_detail($nomor){
		$nomor=urldecode($nomor);
            $sql="select p.item_number,p.description,p.quantity 
            ,p.unit,p.price,p.amount,p.line_number
            from sales_order_lineitems p
            left join inventory i on i.item_number=p.item_number
            where sales_order_number='$nomor'";
            echo browse_simple($sql);
    }
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,p.description,p.quantity 
		,p.unit,p.price,p.discount,p.amount,p.line_number,p.ship_qty,p.ship_date
		,p.disc_2,p.disc_3
		from sales_order_lineitems p
		left join inventory i on i.item_number=p.item_number
		where sales_order_number='$nomor'";
		echo datasource($sql);
	}
    function add_item(){
    	$nomor=$this->input->get('sales_order_number');            
        if(!$nomor){
            $data['message']='Nomor SO tidak diisi.!';
			return false;
        }
        $data['sales_order_number']=$nomor;
        
        $this->load->model('inventory_model');
        $data['item_lookup']=$this->inventory_model->item_list();
        $this->load->view('sales/sales_order_add_item',$data);
    }
    function save_item(){
		$this->load->model('inventory_prices_model');
		$this->load->model("sales_order_lineitems_model");
		$this->load->model("sales/promosi_model");
		$id=$this->input->post('line_number');
		if($id!='')$data['line_number']=$id;		
        $item_no=$this->input->post('item_number');
		$so=$this->input->post('so_number');
        $data['sales_order_number']=$so;
        $data['item_number']=$item_no;
        $unit=$this->input->post('unit');
		$cost=$this->input->post('cost');
		if($cost=="")$cost=0;
        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
		if($item){
            $data['description']=$item->description;
			if($unit=="")$unit=$item->unit_of_measure;
			if($cost==0)$cost=$item->cost;
		}
        $qty=$this->input->post('quantity');
		if($qty=="")$qty=1;
        $price=$this->input->post('price');
		if($price=="")$price=0;
		$amount=$qty*$price;
		$disc1=$this->input->post('discount');
		if($disc1=="")$disc1=0;	if($disc1>1)$disc1=$disc1/100;
		$disc2=$this->input->post('disc_2');
		if($disc2=="")$disc2=0;	if($disc2>1)$disc2=$disc2/100;
		$disc3=$this->input->post('disc_3');
		if($disc3=="")$disc3=0; if($disc3>1)$disc3=$disc3/100;
		$disc_amt_1=$amount*$disc1;
		$amount=$amount-$disc_amt_1;
		$disc_amt_2=$amount*$disc2;
		$amount=$amount-$disc_amt_2;
		$disc_amt_3=$amount*$disc3;
		$amount=$amount-$disc_amt_3;
        $data['cost']=$cost;
		$data['unit']=$unit;
		$data['quantity']=$qty;        
		$data['discount']=$disc1;
		$data['discount_amount']=$disc_amt_1;
		$data['disc_2']=$disc2;
		$data['disc_amount_2']=$disc_amt_2;
		$data['disc_3']=$disc3;
		$data['disc_amount_3']=$disc_amt_3;
		$data['amount']=$amount;
		$data['price']=$price;
		
		// apabila default satuan tidak sama dg inputan 
		$lFoundOnPrice=false;
		if($item->unit_of_measure!=$data['unit']) {
			if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
				$data['unit'])->row())
			{
				 
				$lFoundOnPrice=true;
				if($unit_price->quantity_high>0) $data['mu_qty']=$data['quantity']*$unit_price->quantity_high;
				$data['mu_harga']=$item->cost_from_mfg;
				if($data['mu_harga']==0)$data['mu_harga']=$item->cost;			
				$data['multi_unit']=$item->unit_of_measure;			
			}
		}
		if($unit=exist_unit($data['unit']) && !$lFoundOnPrice ){
			$lFoundOnPrice=true;
			$data['mu_qty']=$data['quantity']*$unit['unit_value'];
			$data['mu_harga']=item_sales_price($data['item_number']);
			$data['multi_unit']=$unit['from_unit'];		
		} 
		if(!$lFoundOnPrice){
			$data['mu_qty']=$data['quantity'];
			$data['mu_harga']=$data['price'];
			$data['multi_unit']=$data['unit'];
		}	

	
		
		if($id!=''){
			$ok=$this->sales_order_lineitems_model->update($id,$data);
		} else {
        	$ok=$this->sales_order_lineitems_model->save($data);
		}
		if($qty_extra=$this->promosi_model->promo_qty_extra($item_no,$data['quantity'])){
			if($qty_extra>0){
				$data['description']="***extra ".$data['description'];
				$data["quantity"]=$qty_extra;
				$data['price']=0;				$data['amount']=0;
				$data['discount']=0;			$data['discount_amount']=0;
				$data['disc_2']=0;				$data['disc_amount_2']=0;
				$data['disc_3']=0;				$data['disc_amount_3']=0;
				$this->sales_order_lineitems_model->save($data);
			}
		}
		
		$this->sales_order_model->recalc($so);
		 
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
	function recalc($nomor){
		$nomor=urldecode($nomor);
		$this->sales_order_model->recalc($nomor);
	}
    function delete_item($id=0){
		$id=urldecode($id);
    	if($id==0)$id=$this->input->post('line_number');
        $this->load->model('sales_order_lineitems_model');
        if($this->sales_order_lineitems_model->delete($id)) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
    function print_so($nomor){
		$nomor=urldecode($nomor);
        $invoice=$this->sales_order_model->get_by_id($nomor)->row();
		 
		$saldo=$this->sales_order_model->recalc($nomor);
		$data['sales_order_number']=$invoice->sales_order_number;
		$data['sales_date']=$invoice->sales_date;
		$data['sold_to_customer']=$invoice->sold_to_customer;
		$data['payment_terms']=$invoice->payment_terms;
		$data['amount']=$invoice->amount;
		$data['sub_total']=$invoice->subtotal;
		$data['discount']=$invoice->discount;
		$data['disc_amount']=$invoice->subtotal*$invoice->discount;
		$data['freight']=$invoice->freight;
		$data['others']=$invoice->other;
		$data['tax']=$invoice->sales_tax_percent;
		$data['tax_amount']=$invoice->sales_tax_percent*($data['sub_total']-$data['disc_amount']);
		$data['comments']=$invoice->comments;
		$data['salesman']=$invoice->salesman;
		$data['due_date']=$invoice->due_date;
		
        $data['content']=load_view('sales/rpt/print_so',$data);
        $this->load->view('pdf_print',$data);
   	}
	function list_open_so($customer){
		$customer=urldecode($customer);
		$sql="select p.sales_order_number,p.sales_date,p.due_date,p.payment_terms,p.salesman 
		from sales_order  p
		where p.sold_to_customer='$customer'";
		echo browse_simple($sql,'',500,300,'dgSoList');

	}
	function select_so_open($search='',$cust=""){
		$search=urldecode($search);
		$sql="select sales_order_number,sales_date,sold_to_customer,company
		 from sales_order so left join customers c on c.customer_number=so.sold_to_customer
		 where (delivered=false or delivered is null)";
         if($search!="")$sql.=" and sales_order_number='$search'";
         if($cust!="")$sql.=" and sold_to_customer='$cust'";
		 $sql.=" limit 100";
         
            
		echo datasource($sql);
		
	}  

	function list_item_delivery($nomor){
		$nomor=urldecode($nomor);
		$this->load->model('sales_order_lineitems_model');
		$query=$this->db->query("select * from sales_order_lineitems where sales_order_number='$nomor'");
		$table="<table class='table' width='100%'>
		<thead><tr><th>Item Number</th>
			<th>Description</th>
			<th>Qty Order</th>
			<th>Unit</th>
			<th>Q Terkirim</th>
			<th>Qty Sisa</th>
			<th>Qty Kirim</th>
			<th>Satuan</th>
		</tr></thead>";
		
		$table.="
		<tbody>";
		foreach($query->result() as $row){
			$qty_sisa=$row->quantity-$row->ship_qty;
			$q_tkirim=0;
			if($row->ship_qty)$q_tkirim=$row->ship_qty;
			if($qty_sisa>0) {
				$table.="<tr><td>".$row->item_number."</td><td>".$row->description."</td><td>"
				.$row->quantity."</td><td>".$row->unit."</td>
				<td>".$q_tkirim."</td><td>".$qty_sisa."</td>
				<td><input type='text' name='qty_order[]' style='width:80px' value='' 
				    id='qty_id_$row->line_number' onblur='qty_max($qty_sisa,$row->line_number);return false;'</td>
				<td><input type='text' name='qty_unit[]' style='width:80px' value='' '</td>
				<input type='hidden' name='line_number[]' value='".$row->line_number."'>
				</tr>";
			}
		}
		$table.="</tbody>
		</table>";
		echo $table;			 

	}
	function delivery($sales_order_number) {
		$sales_order_number=urldecode($sales_order_number);
		$sql="select i.invoice_number,invoice_date,il.warehouse_code,il.item_number,il.description,il.quantity,il.unit
			from invoice i left join invoice_lineitems il on il.invoice_number=i.invoice_number
			where invoice_type='D' 
			and sales_order_number='$sales_order_number'";
		  
		echo datasource($sql);
	}
	function view_delivery($sales_order_number)
	{             
		$sales_order_number=urldecode($sales_order_number);
		$this->load->model('invoice_model');
		$sql="select distinct invoice_number as nomor_surat_jalan,
			invoice_date as tanggal,sales_order_number,warehouse_code 
			from invoice
			where invoice_type='D' 
			and sales_order_number='$sales_order_number'";
		$data['list_delivery']=browse_simple($sql, 
				"Daftar Pengiriman atas nomor sales order [".$sales_order_number."]"
				, 400, 0, "dgItem", "cmdButtons");
		$sales=$this->sales_order_model->get_by_id($sales_order_number)->row();
		$data['sold_to_customer']=$sales->sold_to_customer;
		$data['customer_info']=$this->customer_model->info($sales->sold_to_customer);
		$data['sales_order_number']=$sales_order_number;
		$this->template->display('sales/list_delivery',$data);            
	}
	function sub_total($nomor){
		$nomor=urldecode($nomor);
		$disc_prc=$_GET['discount'];
		if($disc_prc=='')$disc_prc=0;
		$tax=$_GET['tax'];if($tax=='')$tax=0;
		
		$sql="update sales_order set discount='".$disc_prc."',sales_tax_percent='".$tax
			."',freight='".$_GET['freight']."',other='".$_GET['other']."'
			where sales_order_number='$nomor'";
			
		$rs=$this->db->query($sql);
		$saldo=$this->sales_order_model->recalc($nomor);
		$sub_total=$this->sales_order_model->sub_total;
		$data=array('sub_total'=>$sub_total,'amount'=>$this->sales_order_model->amount,
		'disc_amount_1'=>$this->sales_order_model->disc_amount_1,'tax'=>$this->sales_order_model->tax);
		echo json_encode($data);				
	}
	function find($sales_order_number=''){
		$sales_order_number=urldecode($sales_order_number);
		$query=$this->db->query("select s.sales_order_number,s.sales_date,s.sold_to_customer,
		c.company from sales_order s left join customers c on s.sold_to_customer=c.customer_number");
		echo json_encode($query->row_array());
 	}
	function approve($sales_order_number=''){
		$sales_order_number=urldecode($sales_order_number);
		$sql="update sales_order set status=1 
			where sales_order_number='$sales_order_number'";
		
		if($qry=$this->db->query($sql)){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('success'=>false));
		}
	}			
		
	function print_more(){
		echo "Modul ini belum tersedia !";
	}	
}

?>
