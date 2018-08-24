<?php
class Purchase_order_lineitems_model extends CI_Model {

private $primary_key='line_number';
private $table_name='purchase_order_lineitems';

function __construct(){
	parent::__construct();        
      
	$this->load->model('inventory_model');
	$this->load->model('inventory_prices_model');
    
}
  
function count_all(){
	return $this->db->count_all($this->table_name);
}
function get_by_id($id){
	$this->db->where($this->primary_key,$id);
	return $this->db->get($this->table_name);
}
function get_by_nomor($nomor) {
	$this->db->where('purchase_order_number',$nomor);
	return $this->db->get($this->table_name);
}
function default_values($data){
//	if(!isset($data['warehouse_code']))$data['warehouse_code']='GUDANG';
//	if($data['warehouse_code']=='')$data['warehouse_code']='GUDANG';
    if(!isset($data['unit']))$data['unit']='';
	if(!isset($data['currency_code']))$data['currency_code']='IDR';
	if($data['currency_code']=='')$data['currency_code']='IDR';
	if(!isset($data['currency_rate']))$data['currency_rate']=1;
	if($data['currency_rate']<=0)$data['currency_rate']=1;
	if(!isset($data['mu_qty']))$data['mu_qty']=$data['quantity'];
	if($data['mu_qty']<=0)$data['mu_qty']=$data['quantity'];
	if(!isset($data['price']))$data['price']=0;
	if(!isset($data['mu_harga']))$data['mu_harga']=$data['price'];
	if($data['mu_harga']<=0)$data['mu_harga']=$data['price'];
	if(!isset($data['multi_unit']))$data['multi_unit']=$data['unit'];
	if($data['multi_unit']=='')$data['multi_unit']=$data['unit'];
	if(!isset($data["warehouse_code"]))$data["warehouse_code"]=current_gudang();
    if(isset($data['inventory_account'])){
        if($data['inventory_account']=='') $data['inventory_account']=0;
    }
	return $data;
}
function save($data){
    
    if($data['quantity']=='')$data['quantity']=1;
    if($data['quantity']=='0')$data['quantity']=1;
    
    if(!isset($data["description"]))$data["description"]="";
    
	if(isset($data['retail']))if($data['retail']=="")$data['retail']=0;
    if(isset($data['retail_real']))if($data['retail_real']=="")$data['retail_real']=0;
    if(isset($data['margin_real']))if($data['margin_real']=="")$data['margin_real']=0;
    if(isset($data['margin']))if($data['margin']=="")$data['margin']=0;
    
    if(isset($data['discount']))if($data['discount']=="")$data['discount']=0;
    
	$data=$this->default_values($data);
	$id=0;
	if(isset($data['line_number']))$id=$data['line_number'];
	
	$item=$this->inventory_model->get_by_id($data['item_number'])->row();
	
	if(isset($data['line_number']))$id=$data['line_number'];

	if(!isset($data['discount']))$data['discount']=0;	
	if($data['discount']>1)$data['discount']=$data['discount']/100;

	if(!isset($data['disc_2']))$data['disc_2']=0;
	if($data['disc_2']>1)$data['disc_2']=$data['disc_2']/100;

	if(!isset($data['disc_3']))$data['disc_3']=0;
	if($data['disc_3']>1)$data['disc_3']=$data['disc_3']/100;
	if(!isset($data['unit']))$data['unit']='';
    
	// apabila default satuan tidak sama dg inputan 
	$lFoundOnPrice=false;
	$mu_qty=0;
	$multi_unit="";
	$mu_harga=0;
	
	if($item) {
		
	    if($item->unit_of_measure!=$data['unit']){
    		if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
    			$data['unit'])->row())
    		{
    			 
    			$lFoundOnPrice=true;
    			if($unit_price->quantity_high>0) {
    				
    				$mu_qty=$data['quantity']*$unit_price->quantity_high;
					
				}
    			$mu_harga=$item->cost_from_mfg;
    			if($mu_harga==0)$mu_harga=$item->cost;			
    			$multi_unit=$item->unit_of_measure;			
    		}
        }
	}
    $unit=exist_unit($data['unit']);
    
	if( $unit && !$lFoundOnPrice ){
		$lFoundOnPrice=true;
		$mu_qty=$data['quantity']*$unit['unit_value'];
		$mu_harga=item_purchase_price($data['item_number']);
		$multi_unit=$unit['from_unit'];		
        
        
	} 
	if(!$lFoundOnPrice){
		$mu_qty=$data['quantity'];
		$mu_harga=$data['price'];
		$multi_unit=$data['unit'];
	}	
	if($item){
		if($data['description']=="") $data['description']=$item->description;
		if($data['unit']=="") $data['unit']=$item->unit_of_measure;
        if($data['price']==0) $data['price']=$item->cost_from_mfg;
	}
    if($multi_unit=='' && $data['unit']!=''){
        
    }
    if($mu_harga==0)$mu_harga=$data["price"];
    
	if(isset($data['mu_qty'])){
		if($data['mu_qty']!="")$mu_qty=$data['mu_qty'];
	}
	if(isset($data['mu_harga'])){
		if($data['mu_harga']!="")$mu_harga=$data['mu_harga'];
	}
	if(isset($data['multi_unit'])){
		if($data['multi_unit']!="")$multi_unit=$data['multi_unit'];
	}
	$data["multi_unit"]=$multi_unit;
	$data["mu_qty"]=$mu_qty;
	$data["mu_harga"]=$mu_harga;
	
	$gross=floatval($data['quantity'])*floatval($data['price']);
	$disc_amount=floatval($data['discount'])*$gross;
	$gross=$gross-$disc_amount;
	
	$disc_amount_2=floatval($data['disc_2'])*$gross;
	$gross=$gross-$disc_amount_2;

	$disc_amount_3=floatval($data['disc_3'])*$gross;
	$gross=$gross-$disc_amount_3;
	
	$data['disc_amount_1']=$disc_amount;
	$data['disc_2']=floatval($data['disc_2']);
	$data['disc_amount_2']=$disc_amount_2;
	$data['disc_3']=floatval($data['disc_3']);
	$data['disc_amount_3']=$disc_amount_3;
	$data['total_price']=$gross;
    if($data['unit']=='')$data['unit']='Pcs';
    
    $item_no=$data['item_number']; item_need_update($item_no);
    
    if($data["warehouse_code"]=="")$data["warehouse_code"]=current_gudang();
    if(!isset($data['currency_code']))$data['currency_code']="IDR";
    if($data['currency_code']=="")$data["currency_code"]="IDR";
    if(!isset($data['currency_rate']))$data['currency_rate']=1;
    if($data['currency_rate']=="")$data["currency_rate"]=1;
    
	unset($data['amount']);
	if($id!=0){
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
		return $id;
	} else {
	    if(isset($data['line_number']))unset($data['line_number']);
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
}
function updatexxxxx($id,$data){
	$data=$this->default_values($data);
	if($unit=exist_unit($data['unit'])){
		$data['mu_qty']=$data['quantity']*$unit['unit_value'];
		$data['mu_harga']=item_purchase_price($data['item_number']);
		$data['multi_unit']=$unit['from_unit'];		
	} else {
		$data['mu_qty']=$data['quantity'];
		$data['mu_harga']=$data['price'];
		$data['multi_unit']=$data['unit'];
	}
	$this->db->where($this->primary_key,$id);
	return $this->db->update($this->table_name,$data);
}
function delete($id){
    $item_no=$id; item_need_update($item_no);    
	$this->db->where($this->primary_key,$id);
	return $this->db->delete($this->table_name);
}
function lineitems($po_number){
	$this->db->where('purchase_order_number',$po_number);
	return $this->db->get($this->table_name);
}
function sum_total_price($nomor)
{
	$rst=$this->db->query("select sum(total_price) as sum_total_price 
		from purchase_order_lineitems 
        where purchase_order_number='".$nomor."'");
    if($rst->num_rows()){    
        return $rst->row()->sum_total_price;
	} else {
		return 0;
	}
}
	function browse($nomor)
	{
		$sql="select p.item_number,i.description,p.quantity 
		,p.unit,p.price,p.discount,p.total_price,coa.account,coa.account_description,p.line_number
		from purchase_order_lineitems p
		left join inventory i on i.item_number=p.item_number
		left join chart_of_accounts coa on coa.id=p.inventory_account
		where purchase_order_number='$nomor'";
		$this->load->helper('browse_helper');
		return browse_simple($sql,"Data Barang / Jasa",500,300,"dgItem");
	}
	function update_qty_received($line,$qty){
		$sql="update purchase_order_lineitems set qty_recvd=IFNULL(qty_recvd,0)+$qty where line_number=$line";
		$this->db->query($sql);
		$sql="select quantity-IFNULL(qty_recvd,0) from purchase_order_lineitems 
		where line_number=$line";
		$sql="update purchase_order_lineitems set received=true 
		where line_number=$line and ifnull(qty_recvd,0)>=quantity";
		$this->db->query($sql);
	}
	function create_po_by_request($supplier,$purchase_order_number) {
		if(strtolower($supplier)=='unknown')$supplier='';
		$sql="select p.purchase_order_number,p.po_date,p.due_date,p.terms,p.project_code,p.branch_code,p.dept_code,p.ordered_by,p.doc_status,
		i.item_number,i.description,i.quantity,i.unit,t.supplier_number,i.line_number,t.cost,t.cost_from_mfg
		from purchase_order  p left join purchase_order_lineitems i on i.purchase_order_number=p.purchase_order_number
		left join inventory t on t.item_number=i.item_number 
		where ifnull(selected,0)=0 and  p.doc_status='open' and p.potype='Q' and ifnull(t.supplier_number,'')='".$supplier."' 
		order by i.item_number";								
		if($qline=$this->db->query($sql)){
			foreach($qline->result() as $row_items){
				$dline=data_table('purchase_order_lineitems',null);
				$dline['purchase_order_number']=$purchase_order_number;
				$dline['item_number']=$row_items->item_number;
				$dline['description']=$row_items->description;
				$dline['quantity']=$row_items->quantity;
				$dline['unit']=$row_items->unit;
				$dline['price']=$row_items->cost_from_mfg;
				if(!$dline['price'])$dline['price']=$row_items->cost;
				if(!$dline['price'])$dline['price']=0;
				$dline['total_price']=$dline['quantity']*$dline['price'];
				$dline['from_line_doc']=$row_items->purchase_order_number;
				$dline['from_line_type']='PO Request';
				$dline['from_line_number']=$row_items->line_number;
				if($this->save($dline)){
					$this->db->query("update purchase_order_lineitems set selected=1 where line_number=".$row_items->line_number);
				}
			}
		}
		
	}
	function save_alloc($data){
         
		$qty=$data['qty_alloc'];
		$line=$data['line_number_alloc'];
		$gdg=$data['gdg'];
		$ok=true;
         
		for($i=0;$i<count($qty);$i++){
			$d2['wh_code']=$gdg[$i];
			$d2['qty']=$qty[$i];
            if($d2['qty']=="")$d2['qty']=0;            
			$d2['line_id_po']=$line;
			if($q=$this->db->where("wh_code",$d2['wh_code'])->where("line_id_po",$line)
				->get("po_qty_alloc")){
				if($q->num_rows()){
					unset($d2['wh_code']);
					unset($d2['line_id_po']);
					$this->db->where("wh_code",$gdg[$i])->where("line_id_po",$line);
					$this->db->update("po_qty_alloc",$d2);
				} else {
					$this->db->insert("po_qty_alloc",$d2);
				}
			}
		}
		return $ok;
	}
	function load_alloc($po_line){
		return $this->db->query("select * from po_qty_alloc  where line_id_po='$po_line' 
		  and wh_code<>''");
	}

}
