<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Item_jual extends CI_Controller {
        
    private $sql="";
    
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
        $this->load->model('syslog_model');
        $this->load->library("browse");
        $this->load->model("inventory_model");
        $this->load->model("category_model");
         
    }
    function index()
    {   
        $data['title']="Data Penjualan Barang Supplier";
        $data['supplier_list']=$this->supplier_model->lov('supplier','supplier_no');
        $this->template->display("purchase/jual_item",$data);                 
    }
    function browse_data($supplier="",$date_from="",$date_to=""){
        $date_from=urldecode($date_from);
        $date_to=urldecode($date_to);
        $supplier=urldecode($supplier);
        if($date_from=="")$date_from=date("Y-m-d");
        if($date_to=="") $date_to=date("Y-m-d")." 23:59:59";
        $s="select il.item_number,il.description,sum(il.mu_qty) as qty,il.multi_unit, 
            sum(il.amount) as amount
            from invoice_lineitems il 
            left join invoice i on i.invoice_number=il.invoice_number 
            left join inventory s on s.item_number=il.item_number
            where i.invoice_type in ('I','R')
            and i.invoice_date between '$date_from' and '$date_to' 
            and s.supplier_number='$supplier' 
            group by il.item_number,il.description,il.multi_unit";
       echo datasource($s,true,"item_number");
    }
    function create_po(){
        $this->load->model("purchase_order_model");
        $this->load->model("supplier_model");
        $data=$this->input->post();
        $supplier=$data["supplier_no"];
        $date_from=$data["date_from"];
        $date_to=$data["date_to"];
        $items=$data["ck"];
        $nomor=$this->purchase_order_model->nomor_bukti();
        $termin="KREDIT";
        $qsupp=$this->supplier_model->get_by_id($supplier);
        if($qsupp && $rsupp=$qsupp->row()){
            if($rsupp->payment_terms!=""){
                $termin=$rsupp->payment_terms;
            }
        }
        $header['purchase_order_number']=$nomor;
        $header['potype']="O";
        $header['po_date']=date("Y-m-d H:i:s");
        $header['supplier_number']=$supplier;
        //$header['due_date']=$termin;
        $header['terms']=$termin;
        $total=0;
        for($i=0;$i<count($items);$i++){
            $item_no=$items[$i];
            $s="select sum(il.mu_qty) as qty
            from invoice_lineitems il 
            left join invoice i on i.invoice_number=il.invoice_number 
            where i.invoice_type in ('I','R')
            and i.invoice_date between '$date_from' and '$date_to' 
            and il.item_number='$item_no' ";
            $qty=$this->db->query($s)->row()->qty;
            $item_name="Open item";
            $unit="Pcs"; $cost=0; $beli=0;
            if($qitem=$this->db->select("description,unit_of_measure,cost, 
                cost_from_mfg")->where("item_number",$item_no)
                ->get("inventory")) {
                if($ritem=$qitem->row()){
                    $item_name=$ritem->description;
                    $unit=$ritem->unit_of_measure;
                    $cost=$ritem->cost;
                    $beli=$ritem->cost_from_mfg;
                    if($cost<1)$cost=$beli;           
                }
            }
            $amount=$qty*$cost;
            $total+=$amount;
            $detail["purchase_order_number"]=$nomor;
            $detail["item_number"]=$item_no;
            $detail["description"]=$item_name;
            $detail["unit"]=$unit;
            $detail["price"]=$cost;
            $detail['quantity']=$qty;
            $detail["multi_unit"]=$detail["unit"];
            $detail["mu_harga"]=$detail["price"];
            $detail["mu_qty"]=$detail["quantity"];
            $detail["total_price"]=$amount;
            $detail["currency_code"]="IDR";
            $detail["currency_rate"]=1;
            $this->db->insert("purchase_order_lineitems",$detail);
        }
        $header["amount"]=$total;
        $header["saldo_invoice"]=$total;
        $header["currency_code"]="IDR";
        $header["currency_rate"]=1;
        $this->purchase_order_model->save($header);
        $this->purchase_order_model->nomor_bukti(true);
        echo "<br>Finish create new PO: $nomor";
        
    }
}