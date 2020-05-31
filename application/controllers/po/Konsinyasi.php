<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Konsinyasi extends CI_Controller {
    private $limit=10;
    private $controller='po/konsinyasi';
    private $file_view='purchase/konsinyasi';
	
	function __construct()
	{
		parent::__construct();        
         
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('supplier_model');
		$this->load->model('type_of_payment_model');
		$this->load->model('syslog_model');
        $this->load->library('browse');
        $this->load->model("purchase_invoice_model");
		$this->load->model("purchase_order_model");
        $this->load->model("purchase_order_lineitems_model"); 
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        if(!$record){
    		$data['mode']='';
    		$data['message']='';
    		$data['nomor']="AUTO";    //$this->nomor_bukti();
    		$data['tanggal']= date("Y-m-d");
    		$data['tgl_jth_tempo']=date("Y-m-d");
    		$data['termin']="KREDIT";
        }
        $data['lookup_suppliers']=$this->supplier_model->lookup();
		return $data;
	}
	function index()
	{	
		 
	}
    function create(){
        $data['message']='';
        $data['lookup_suppliers']=$this->supplier_model->lookup();
        $this->template->display_form_input($this->file_view,$data,'');                          
        
    }
    function item_sales($date_from,$date_to,$supplier=""){
        $date_from=urldecode($date_from);
        $date_to=urldecode($date_to);
        $supplier=urldecode($supplier);
        
        $s="select il.item_number,s.description,s.supplier_number,s.margin,sum(il.quantity) as qty, 
        sum(il.amount) as amount_jual,
        sum(il.quantity*coalesce(if(il.cost=0,s.cost_from_mfg,il.cost),0)) as amount_cost 
        from invoice_lineitems il left join invoice i on i.invoice_number=il.invoice_number 
        left join inventory s on s.item_number=il.item_number 
        where  i.invoice_type in ('i') 
        and i.invoice_date between '$date_from' and '$date_to'";
        if($supplier!="")$s.=" and s.supplier_number='$supplier'"; 
        $s.=" group by il.item_number,s.description,s.supplier_number,s.margin";
        
        
        echo datasource($s);
        
    
	}
	
    function item_sales_total($date_from,$date_to,$supplier=""){
        $date_from=urldecode($date_from);
        $date_to=urldecode($date_to);
        $supplier=urldecode($supplier);
        
        $s="select sum(il.amount) as amount_jual,
        sum(il.quantity*coalesce(if(il.cost=0,s.cost_from_mfg,il.cost),0)) as amount_cost 
        from invoice_lineitems il left join invoice i on i.invoice_number=il.invoice_number 
        left join inventory s on s.item_number=il.item_number 
        where  i.invoice_type in ('i') 
        and i.invoice_date between '$date_from' and '$date_to'";
        if($supplier!="")$s.=" and s.supplier_number='$supplier'"; 
        
        $success=true;
        $jual_amt=0;
        $cost_amt=0;
		$margin_prc=0;
		
        if($q=$this->db->query($s)){
        	if($r=$q->row()){
        		$jual_amt=$r->amount_jual;
        		$cost_amt=$r->amount_cost;
        		$margin_prc=round(($jual_amt-$cost_amt)/$jual_amt,4)*100;
				
        	}
        }
        echo json_encode(array("success"=>$success,"jual_amt"=>number_format($jual_amt),
        	"cost_amt"=>number_format($cost_amt),"margin_prc"=>$margin_prc));
        
    }
	
	function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
	}
 
	function add()
	{
	 	$data=$this->set_defaults();
		$data['mode']='add';
		$data['message']='';
        $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
        $data['terms_list']=$this->type_of_payment_model->select_list();
		$this->template->display_form_input($this->file_view,$data,'');			                 
		
	}
    function nomor_bukti($add=false){
        return $this->purchase_invoice_model->nomor_bukti($add);
    }
		
	function save(){
		$date_from=$this->input->post("date_from"); 
        $date_to=$this->input->post("date_to"); 
        $supplier_number=$this->input->post("supplier_number");

        $s="select s.supplier_number,su.payment_terms,su.termin_day
        from invoice_lineitems il left join invoice i on i.invoice_number=il.invoice_number 
        left join inventory s on s.item_number=il.item_number 
        left join suppliers su on su.supplier_number=s.supplier_number
        where i.invoice_type in ('i') and i.invoice_date between '$date_from' and '$date_to' ";
        if($supplier_number!="")$s.=" and s.supplier_number='$supplier_number'";
        $s.=" group by s.supplier_number,su.payment_terms,su.termin_day";
                
        if($qsup=$this->db->query($s)){
            foreach($qsup->result() as $rsup){
                $termin=$rsup->payment_terms;
                if($termin=="")$termin="KREDIT";
                $termin_day=$rsup->termin_day;
                if($termin_day=="" || $termin_day==0)$termin_day=30;
                //$due_date=date_add(, $interval)
                $purchase_order_number=$this->nomor_bukti();
                $ok=false;
                
                $s="select il.item_number,s.cost_from_mfg,s.cost,
                s.margin,sum(il.quantity) as qty, 
                sum(il.amount) as amount_jual,
                sum(il.quantity*coalesce(if(il.cost=0,s.cost_from_mfg,il.cost),0)) as amount_cost 
                from invoice_lineitems il left join invoice i on i.invoice_number=il.invoice_number 
                left join inventory s on s.item_number=il.item_number 
                where s.supplier_number='$rsup->supplier_number' and  i.invoice_type in ('i') and i.invoice_date between '$date_from' and '$date_to' 
                group by il.item_number,s.cost_from_mfg,s.cost,s.margin";
                
                $has_item=false;
                $amt=0;
                
                if($q=$this->db->query($s)){
                    foreach($q->result() as $r){
                        $has_item=true;
                        $d['purchase_order_number']=$purchase_order_number;
                        $d['item_number']=$r->item_number;
                        $d['quantity']=$r->qty;
                        $d['price']=$r->cost_from_mfg;
                        if($d['price']==0)$d['price']=$r->cost;
                        $d['amount']=$d['price']*$d['quantity'];
                        $amt+=$d['amount'];
                        
                        $this->purchase_order_lineitems_model->save($d);
                    }
                }
                if($has_item){
                    $h['purchase_order_number']=$purchase_order_number;
                    $h['po_date']=date("Y-m-d h:i:s");
                    $h['potype']='I';   
                    $h['supplier_number']=$rsup->supplier_number;
                    $h['terms']=$termin;
                    $h['amount']=$amt;
                    $h['saldo_invoice']=$amt;
                    $h['subtotal']=$amt;
                    
                    $ok=$this->purchase_order_model->save($h);
                    
                    $this->nomor_bukti(true);
                        
                    
                }                
            }
        } 

		
		if ($ok){
			echo json_encode(array('success'=>true,'nomor'=>$purchase_order_number,"msg"=>"Sukses"));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));
		}
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select faktur,tanggal,jumlah,saldo,id
		from payables_bill_detail p 
		where nomor='$nomor'";		 
		echo datasource($sql);
	}
	function view($id,$message=null){
		//if(!allow_mod2('_40130'))return false;
		$id=urldecode($id);
		 $this->payables_bill_header_model->recalc($id);
		 $model=$this->payables_bill_header_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['nomor']=$id;
		 $data['mode']='view';
         $data['message']=$message;
         $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
         $data['terms_list']=$this->type_of_payment_model->select_list();
		
		 $this->load->model('periode_model');
		 $data['closed']=$this->periode_model->closed($data['tanggal']);
         //$left='purchase/menu_purchase_invoice';
		 //$this->session->set_userdata('_right_menu',$left);
         $this->session->set_userdata('nomor',$id);		 
         $this->template->display('purchase/kontra_bon',$data);                 
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('nomor','Nomor', 'required|trim');
		 $this->form_validation->set_rules('tanggal','Tanggal','callback_valid_date');
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
     
	
}
