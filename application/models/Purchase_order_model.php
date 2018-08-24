<?php
class Purchase_order_model extends CI_Model {

private $primary_key='purchase_order_number';
private $table_name='purchase_order';
public $amount_paid=0;
public $saldo=0;
public $amount=0;
public $sub_total=0;
	function __construct(){
		parent::__construct();        
       
		$this->load->model('purchase_order_lineitems_model');
	}
	function retur_amount($purchase_order_number) {
		$sql="select sum(amount) as z_amount 
			from purchase_order i
			where i.potype='R' and po_ref='$purchase_order_number'";
		return $this->db->query($sql)->row()->z_amount;
	}
	function crdb_amount($purchase_order_number) {
		$sql="select sum(case transtype 
				when 'PO-DEBIT MEMO' then -1*(amount) 
				else (amount) end) as z_amount 
			from crdb_memo i
			where docnumber='$purchase_order_number'";
		return $this->db->query($sql)->row()->z_amount;
	}
	function paid_amount($nomor){
	    $this->load->model('payables_payments_model');
		return $this->payables_payments_model->total_amount($nomor);
	}

	function recalc($nomor){
	    $this->load->model('payables_payments_model');
		$this->load->model('purchase_order_lineitems_model');
	    $this->amount=$this->purchase_order_lineitems_model->sum_total_price($nomor);
		$this->sub_total=$this->amount;
    	$po=$this->get_by_id($nomor)->row();
		if(count($po)==0){
			return 0;
		}
		$disc_amount=$po->discount*$this->sub_total;
	    $this->amount=$this->sub_total-$disc_amount;
		if($po->tax>1)$po->tax=$po->tax/100;
		
		$tax_amount=$po->tax*$this->amount;
		$this->amount=$this->amount+$tax_amount;
		$this->amount=$this->amount+$po->freight;
		$this->amount=$this->amount+$po->other;

		$this->db->where($this->primary_key,$nomor);
		$this->db->update($this->table_name,array('amount'=>$this->amount,
		'tax_amount'=>$tax_amount,'subtotal'=>$this->sub_total));
		
		$this->add_payables($nomor);
	    $this->amount_paid=$this->payables_payments_model->total_amount($nomor);
		
	    $this->saldo= $this->amount-$this->amount_paid-$this->retur_amount($nomor)+$this->crdb_amount($nomor);
		
		$data['saldo_invoice']=$this->saldo;
		$data['paid']=$this->saldo==0;		
		$this->db->where('purchase_order_number',$nomor)->update('purchase_order',$data);
		
	    return $this->saldo;
	}
	
	function add_payables($nomor)
	{
		$this->load->model('payables_model');
		$faktur=$this->get_by_id($nomor)->row();
		$bill_id=$this->payables_model->get_bill_id($nomor);
		//valid only purchase invoice
		$po_type=$this->db->select("potype")->where('purchase_order_number',$nomor)
			->get('purchase_order')->row()->potype;
		if($po_type!='I'){
			$this->db->query("delete from payables_items where bill_id='$bill_id'");
			$this->db->query("delete from payables where bill_id='$bill_id'");
			return false;
		}
		$data['purchase_order']=1;
		$data['purchase_order_number']=$nomor;
		$data['expense_type']='Purchase Order';
		$data['invoice_number']=$nomor;
		$data['invoice_date']=$faktur->po_date;
		$data['supplier_number']=$faktur->supplier_number;
		$data['amount']=$faktur->amount;
		$data['due_date']=$faktur->due_date;
		$data['terms']=$faktur->terms;
		$data['purpose_of_expense']='Purchase Order';
		
		if($bill_id==0){
			$this->payables_model->save($data);
		} else {
			$this->payables_model->update($bill_id,$data);		
		}
		
		
	}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
	    $nama='';
	    if(isset($_GET['nama'])){
	        $nama=$_GET['nama'];
	    }
	    $this->db->select('i.purchase_order_number,i.po_date,i.supplier_number,
	        c.supplier_name,i.amount');
	    $this->db->join('suppliers c','c.supplier_number=i.supplier_number','left');
	    $this->db->from('purchase_order i');
	    if($nama!='') $this->db->where("c.supplier_number like '%$nama%' 
	            or i.purchase_order_number like '%$nama%'
	            ");
	    if (empty($order_column)||empty($order_type))
	    { 
	        $this->db->order_by($this->primary_key,'asc');
	    } else {
	        $this->db->order_by($order_column,$order_type);
	    }
	    return $this->db->get('',$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		if($data['po_date'])$data['po_date']= date('Y-m-d H:i:s', strtotime($data['po_date']));
		if(isset($data['due_date']))$data['due_date']= date('Y-m-d H:i:s', strtotime($data['due_date']));
		if(isset($data['po_expire_date']))$data['po_expire_date']= date('Y-m-d H:i:s', strtotime($data['po_expire_date']));
        if(isset($data['tax']))if($data['tax']>1)$data['tax']=$data['tax']/100;
        if(isset($data['discount']))if($data['discount']>1)$data['discount']=$data['discount']/100;
        
        if(!isset($data["warehouse_code"]))$data["warehouse_code"]=current_gudang();
        if(!isset($data['currency_code']))$data['currency_code']="IDR";
        if($data['currency_code']=="")$data["currency_code"]="IDR";
        if(!isset($data['currency_rate']))$data['currency_rate']=1;
        if($data['currency_rate']=="")$data["currency_rate"]=1;
        
		return $this->db->insert($this->table_name,$data);
//		return $this->db->insert_id();
	}
	function update($id,$data){
        
		if(isset($data['po_date']))$data['po_date']= date('Y-m-d H:i:s', strtotime($data['po_date']));
		if(isset($data['due_date']))$data['due_date']= date('Y-m-d H:i:s', strtotime($data['due_date']));
		if(isset($data['po_expire_date']))$data['po_expire_date']= date('Y-m-d H:i:s', strtotime($data['po_expire_date']));
		if(isset($data['warehouse_code'])){
			if($data['warehouse_code']!=""){
				$this->db->query("update purchase_order_lineitems 
					set warehouse_code='".$data['warehouse_code']."' 
					where purchase_order_number='$id'");
			}
		} 
        if(!isset($data['tax']))$data['tax']=0;
        if($data['tax']>1)$data['tax']=$data['tax']/100;
        if(!isset($data['discount']))$data['discount']=0;
        if($data['discount']>1)$data['discount']=$data['discount']/100;
        
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		$this->recalc($id);
		return $ok;
	}
	function validate_delete_po($po_number)
	{
		// check receive from po
		$cnt=$this->db->query("select count(1) as cnt from inventory_products 
			where purchase_order_number='$po_number'")->row()->cnt;
		if($cnt) return false;
	
		return true;
	}
	function delete($id){
	
		$this->db->where($this->primary_key,$id);
		$this->db->delete('purchase_order_lineitems'); 
       
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
     function add_item($id,$item,$qty){
        $sql="select description,retail,cost,unit_of_measure
            from inventory
            where item_number='".$item."'";
        
        $query=$this->db->query($sql);
        $row = $query->row_array(); 
         
        $data = array('purchase_order_number' => $id, 'item_number' => $item, 
            'quantity' => $qty,'description'=>$row['description'],
            'price' => $row['retail'],'total_price'=>$row['retail']*$qty,
            'unit'=>$row['unit_of_measure']
            );
        $str = $this->db->insert_string('purchase_order_lineitems', $data);
        $query=$this->db->query($str);
    }
    function del_item($line){
        $query=$this->db->query("delete from purchase_order_lineitems
            where line_number=".$line);
    }
	function update_received($nomor){
		$po=$this->db->query("select sum(quantity) as z_qty, sum(ifnull(qty_recvd,0)) as z_rcv 
		from purchase_order_lineitems where purchase_order_number='$nomor'")->row();
		if($po){
			if($po->z_qty<=$po->z_rcv){
				$this->db->query("update purchase_order set received=true where purchase_order_number='$nomor'");
			} else {
				$this->db->query("update purchase_order set received=false where purchase_order_number='$nomor'");
			
			}
		}
	}
	function get_bill_id($invoice)
	{
		$row=$this->db->query("select bill_id from payables where purchase_order_number='".$invoice."'");
		if($row){
			return $row->row()->bill_id;
		} else {
			return 0;
		}
	}
	function recalc_qty_recvd($nomor_po)
	{
		$s="update  purchase_order_lineitems 
			left join (

			select purchase_order_number, from_line_number, 
			sum(quantity_received) as z_qty from inventory_products
			where purchase_order_number='$nomor_po' 
			group by purchase_order_number,from_line_number

			) ip
			on ip.purchase_order_number=purchase_order_lineitems.purchase_order_number 
			and ip.from_line_number=purchase_order_lineitems.line_number

			set qty_recvd=z_qty, received=false  

			where purchase_order_lineitems.purchase_order_number='$nomor_po'";
		
		$this->db->query($s);
		$this->update_received($nomor_po); 
	}
	function nomor_bukti($add=false)
	{
		$key="Purchase Order Numbering";
		$no='';
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!PO~$00001');
		 
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!PO~$00001');
				$rst=$this->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
		}
		return $no;
	}
	function add_item_with_rfq($req_no,$po_no){
		$supplier_number="";
		if($q=$this->db->query("select supplier_number from purchase_order 
			where purchase_order_number='$po_no'"))
		{
			if($r=$q->row()){
				$supplier_number=$r->supplier_number;
			}
		}
		$this->db->where("purchase_order_number",$req_no);
		if($q=$this->db->get("purchase_order_lineitems")){
			foreach($q->result_array() as $r){
				$data=$r;
				$data['purchase_order_number']=$po_no;
				unset($data['line_number']);
				$this->db->insert("purchase_order_lineitems",$data);
			}
		}
	}
	function create_po_by_request($row_id) {
		$in_row_id='';for($i=0;$i<count($row_id);$i++){
			if($row_id[$i]=='') $in_row_id .= $row_id[$i].',';	
		}
		if(substr($in_row_id,-1,1)==',')$in_row_id=substr($in_row_id,0,strlen($in_row_id)-1);
		$new_po=null;
		if($in_row_id<>''){
			$sql="select distinct i.supplier_number	from purchase_order_lineitems p 
			left join inventory i on i.item_number=p.item_number where line_number in (".$in_row_id.") 	";
			if($query=$this->db->query($sql)){
				$sql='';
				foreach($query->result() as $row){
					$data=data_table($this->table_name,null);
					$supplier_number='UNKNOWN';
					if($row->supplier_number)$supplier_number=$row->supplier_number;
					$purchase_order_number=$this->nomor_bukti();
					if($purchase_order_number=='')$purchase_order_number='PO'.date('Y-m-d H:i:s');
					$data['purchase_order_number']=$purchase_order_number;
					$data['po_date']=date('Y-m-d H:i:s');
					$data['potype']='P';			$data['supplier_number']=$supplier_number;
					$data['terms']=$this->supplier_model->valueof('payment_terms',$data['supplier_number']);
					if($data['terms']=='')$data['terms']=$this->type_of_payment_model->default_terms();
					$data['due_date']=$this->type_of_payment_model->due_date($data['terms'],$data['po_date']);
					$data['ordered_by']=user_id();	$data['po_ref']='PO Request';
					if($ok=$this->save($data)){
						$new_po[]=$purchase_order_number;
						$this->purchase_order_lineitems_model->create_po_by_request($supplier_number,$purchase_order_number);
						$this->nomor_bukti(true);
						$this->recalc($data['purchase_order_number']);
					}
				}
			}
		}
		return $new_po;
	}
		function list_po_new($d1,$d2){
		$sql="select po.purchase_order_number,po.po_date,po.supplier_number,
			s.supplier_name,pol.item_number,pol.description,pol.quantity
			from purchase_order po 
			left join purchase_order_lineitems pol
			on po.purchase_order_number=pol.purchase_order_number 
			left join suppliers s on s.supplier_number=po.supplier_number
			where po.potype='O' and po.po_date between '$d1' and '$d2' 
			and (po.status is null  or po.status=0)";
		return $this->db->query($sql);
	}

}	 
