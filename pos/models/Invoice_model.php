<?php
class Invoice_model extends CI_Model {

private $primary_key='invoice_number';
private $table_name='invoice';

public $amount_paid=0;
public $retur_amount=0;
public $crdb_amount=0;
public $saldo=0;
public $amount=0;
public $sub_total=0;
public $warehouse_code='';
public $disc_amount_1=0;
public $tax=0;
function __construct(){
	parent::__construct();        
    
    $this->load->model('payment_model');
    $this->load->model('crdb_model');
    $this->load->model('invoice_lineitems_model');
    $this->load->model('customer_model');
        
    
}
 
function recalc($nomor){
	if($nomor=='undefined')$nomor=$this->session->userdata('invoice_number');
	
    $inv=$this->get_by_id($nomor)->row();
    if($inv) {
		$this->invoice_lineitems_model->check_revenue_acct($nomor,$inv->invoice_type);
	    
	    $this->sub_total=$this->invoice_lineitems_model->sum_total_price($nomor);
        
		if($inv->discount=='')$inv->discount=0;
		if($inv->sales_tax_percent=='')$inv->sales_tax_percent=0;
		
		if($inv->discount>1)$inv->discount=$inv->discount/100;
		$this->disc_amount_1=$inv->discount*$this->sub_total;
		
	    $this->amount=$this->sub_total-$this->disc_amount_1;
		
		if($inv->sales_tax_percent>1)$inv->sales_tax_percent=$inv->sales_tax_percent/100;
		$this->tax=$inv->sales_tax_percent*$this->amount;
		
		$this->amount=$this->amount+$this->tax;
		
		$this->amount=$this->amount+$inv->freight;
		$this->amount=$this->amount+$inv->other;
	
	    $this->amount_paid=$this->payment_model->total_amount($nomor);
		$this->retur_amount=$this->total_retur($nomor);
		//$this->crdb_amount=$this->crdb_model->total_by_invoice($nomor);
		
	    $this->saldo=$inv->amount-$this->amount_paid
			-$this->retur_amount
			+$this->crdb_amount;
		
		$sql="update invoice set paid=";
		if($this->saldo==0){
			$sql.="true";
		} else {
			$sql.="false";
		}
		$sql.=",amount=".$this->amount.",subtotal=".$this->sub_total
		.",saldo_invoice=".$this->saldo.",disc_amount_1='".$this->disc_amount_1."',
		discount='".$inv->discount."',sales_tax_percent='".$inv->sales_tax_percent."',
		disc_amount='".$this->disc_amount_1."',tax='".$this->tax."' 
			where invoice_number='$nomor'";
		//var_dump($sql);
		
		$this->db->query($sql);

	}
    return $this->saldo;
}
	function total_retur($nomor)
	{
		$q=$this->db->query("select sum(amount) as sum_amt from invoice where invoice_type='R' 
			and your_order__='$nomor'")->row();
		if($q){
			return $q->sum_amt;
		} else {
			return 0;
		}
	}
	function paid_amont($faktur){
		$this->load->model('payment');
		return $this->payment_model->total_amount($faktur);
	}
	function retur_amount($faktur){
		return $this->total_retur($faktur);
	}
	function crdb_amount($faktur){
		$this->load->model('crdb_model');
		return $this->crdb_model->total_by_invoice($faktur);
	}
	
function get_paged_list($limit=10,$offset=0,
$order_column='',$order_type='asc')
{
    $nama='';
    if(isset($_GET['nama'])){
        $nama=$_GET['nama'];
    }
    $this->db->select('i.invoice_number,i.invoice_date,i.sold_to_customer,
        c.company,i.amount');
    $this->db->join('customers c','c.customer_number=i.sold_to_customer','left');
    $this->db->from('invoice i');
    if($nama!='') $this->db->where("c.company like '%$nama%' 
            or i.[invoice number] like '%$nama%'
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
	$data['invoice_date']= date('Y-m-d H:i:s', strtotime($data['invoice_date']));
	$data['due_date']= date('Y-m-d H:i:s', strtotime($data['due_date']));

    $warehouse_code="";
    if(isset($data['warehouse_code'])){
        $warehouse_code=$data['warehouse_code'];
    } else {
        $warehouse_code=current_gudang();
    }
    $data['warehouse_code']=$warehouse_code;
	
    if(!isset($data['inv_amount']))$data["inv_amount"]=0;
    
//	$this->db->insert($this->table_name,$data);
//	echo $this->db->_error_message();
//	return $this->db->insert_id();


    $amount=c_($data["inv_amount"]);
    $sold_to_customer=$data['sold_to_customer'];
    $this->customer_model->update_saldo($sold_to_customer,$amount);
	$ok = $this->db->insert($this->table_name,$data);
	return $ok;
	
}
function update($id,$data){
    $inv_amount=0;
    if(isset($data['inv_amount'])){
        $inv_amount=$data['inv_amount'];
        if($inv_amount=="")$inv_amount=0;
    }
    if(isset($data['amount'])){
        $inv_amount=c_($data['amount']);
    }
	$invoice_date="";
    if(isset($data['invoice_date'])){
        $invoice_date=$data['invoice_date'];
    }
    if($invoice_date==""){
        $invoice_date=date("Y-m-d H:i:s");
    }
    $warehouse_code="";
    if(isset($data['warehouse_code'])){
        $warehouse_code=$data['warehouse_code'];
    } else {
        $warehouse_code=current_gudang();
    }
    if($warehouse_code!=""){
        $this->db->query("update invoice_lineitems set warehouse_code='$warehouse_code' 
            where invoice_number='$id' and (warehouse_code='' or warehouse_code is null)");           
    }    

    $payment_terms="";
    $due_date="";
    if(isset($data['due_date'])){
        $due_date=$data['due_date'];
    }
    
    if(isset($data['payment_terms'])){
        $payment_terms=$data["payment_terms"];
        if(strtoupper($payment_terms!="CASH")){
            if($t=$this->db->query("select days from type_of_payment 
                where type_of_payment='$payment_terms'")){
                if($t=$t->row()){
                    $due_date=add_date($invoice_date,$t->days);
                }
            }
        } else {
            $due_date=$invoice_date;
        }
    } else {
        $payment_terms="CASH";
    }
    if($due_date==""){
        $due_date=$invoice_date;
    }
    $inv_amount=c_($inv_amount);

    $data['invoice_date']= date('Y-m-d H:i:s', strtotime($invoice_date));
    $data['warehouse_code']=$warehouse_code;
    $data['due_date']= date('Y-m-d H:i:s', strtotime($due_date));
    $data['inv_amount']=$inv_amount;
         
    ///update saldo
    $amount=$inv_amount;
    $sold_to_customer=$data['sold_to_customer'];
    $amount_old=0;
    if($qinv=$this->db->query("select inv_amount,amount from invoice 
        where invoice_number='$id'")){
            if($rinv=$qinv->row()){
                $amount_old=$rinv->inv_amount;
                if($amount_old==0){
                    $amount_old=$rinv->amount;
                }
            }
        }
    $this->customer_model->update_saldo($sold_to_customer,$amount,$amount_old,false);
    
	$this->db->where($this->primary_key,$id);
	return $this->db->update($this->table_name,$data);
}
function delete($id){
   	$this->db->where($this->primary_key,$id);
	$this->db->delete('invoice_lineitems');
	        
	$this->db->where($this->primary_key,$id);
	$this->db->delete($this->table_name);
}

    function add_item($id,$item,$qty){
        $sql="select description,retail,cost,unit_of_measure
            from inventory
            where item_number='".$item."'";
        
        $query=$this->db->query($sql);
        $row = $query->row_array(); 
         
        $data = array('invoice_number' => $id, 'item_number' => $item, 
            'quantity' => $qty,'description'=>$row['description'],
            'price' => $row['retail'],'amount'=>$row['retail']*$qty,
            'unit'=>$row['unit_of_measure']
            );
        $str = $this->db->insert_string('invoice_lineitems', $data);
        $query=$this->db->query($str);
    }
    function del_item($line){
        $query=$this->db->query("delete from invoice_lineitems
            where line_number=".$line);
    }
	function save_from_so_items($faktur,$qty_order,$from_so_line,$gudang,
		$ship_date,$qty_unit){
		$this->load->model('sales_order_lineitems_model');
		$this->load->model('inventory_model');
		$this->load->model('invoice_lineitems_model');
		for($i=0;$i<=count($qty_order)-1;$i++){
			$line_number=$from_so_line[$i];
			$qty_do=$qty_order[$i];
			
			if($line_number>0){
				if($qty_do>0) {
					$so=$this->sales_order_lineitems_model->get_by_id($line_number)->row();
					$unit="Pcs";
					if($item=$this->inventory_model->get_by_id($so->item_number)->row()){
						$unit=$item->unit_of_measure;
					}
					
					$data['invoice_number']=$faktur;
					$data['item_number']=$so->item_number;
					$data['description']=$so->description;
					$data['unit']=$so->unit;
					if($qty_unit[$i]!=""){
						$data['unit']=$qty_unit[$i];
					}
					if($data['unit']=='')$data['unit']=$unit;
					
					
					
					$data['quantity']=$qty_do;
					$data['price']=$so->price;
					$data['discount']=$so->discount;
					$data['discount_amount']=$so->discount_amount;
					$data['disc_2']=$so->disc_2;
					$data['disc_amount_2']=$so->disc_amount_2;
					$data['disc_3']=$so->disc_3;
					$data['disc_amount_3']=$so->disc_amount_3;
					$data['mu_qty']=$so->mu_qty;
					$data['mu_harga']=$so->mu_harga;
					$data['multi_unit']=$so->multi_unit;
					
					$data['amount']=$data['quantity']*$data['price'];
					$data['warehouse_code']=$gudang;	
					$data['from_line_number']=$line_number;
					$data['from_line_doc']=$so->sales_order_number;
					$data['from_line_type']="SO";
					$data['ship_date']=date('Y-m-d H:i:s', strtotime($ship_date));
					 
					$this->invoice_lineitems_model->save($data);
					$this->db->query("update sales_order_lineitems set ship_date='".$data['ship_date']."' 
					 where line_number='".$so->line_number."'");
				 }
			}
		}
	}
	function unposting($nomor) {
		$saldo=$this->invoice_model->recalc($nomor);
		$faktur=$this->invoice_model->get_by_id($nomor)->row();

		$this->load->model("periode_model");
		if($this->periode_model->closed($faktur->invoice_date)){
			echo "ERR_PERIOD";
			return false;
		}
		// validate jurnal
		$this->load->model('jurnal_model');
		if($this->jurnal_model->del_jurnal($nomor)) {
			$data['posted']=false;
		} else {
			$data['posted']=true;
		}
		$this->invoice_model->update($nomor,$data);
	
	}
	function unposting_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select invoice_number 
		from invoice where invoice_type='I' 
		and invoice_date between '$date_from' and '$date_to' and posted=true 
		order by invoice_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				$this->unposting($r_inv_hdr->invoice_number);
				echo "<br>Delete Jurnal: ".$r_inv_hdr->invoice_number;
			}
		}
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		<p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
	}
	function posting($nomor) {
	 
		$saldo=$this->recalc($nomor);
		$faktur=$this->get_by_id($nomor)->row();
		$message="";
		$this->load->model("periode_model");
		if($this->periode_model->closed($faktur->invoice_date)){
			$message="Tidak bisa posting karena periode sudah ditutup.<br>";
			return $message;
		}
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('company_model');
		$this->load->model('invoice_lineitems_model');

		$cid=$this->access->cid;
		$set=$this->company_model->get_by_id($cid)->row();
		 

		$coa_tax=$set->so_tax;
		$coa_freight=$set->so_freight;
		$coa_other=$set->so_other;
		$coa_ar=$set->accounts_receivable;
		$coa_disc=$set->so_discounts_given;
		$coa_sales=$set->inventory_sales;

		$detail=$this->invoice_lineitems_model->get_by_nomor($nomor);
		foreach($detail->result() as $item) {
			//-- posting invoice_lineitems
			//-- ambil akun dari master barang
			$r_stok=$this->db->query("select sales_account,inventory_account,cogs_account,cost,cost_from_mfg 
				from inventory where item_number='".$item->item_number."'")->row();
			if($r_stok){
				$coa_sales=$item->revenue_acct_id>0?$item->revenue_acct_id:$r_stok->sales_account;
				if($coa_sales=="" or $coa_sales=="0")	$coa_sales=$set->inventory_sales;
				$coa_stock=$r_stok->inventory_account>0?$r_stok->inventory_account:$set->inventory;
				$coa_hpp=$r_stok->cogs_account>0?$r_stok->cogs_account:$set->inventory_cogs;
				if($item->cost==0){
					$item->cost=$r_stok->cost;
					$this->db->query("update invoice_lineitems set cost=".floatval($item->cost)." where line_number=".$item->line_number);
				}
				if($item->cost==0){
					$item->cost=$r_stok->cost_from_mfg;
					$this->db->query("update invoice_lineitems set cost=".$item->cost." where line_number=".$item->line_number);
				}
			}
			
			$sales_amt=$item->price*$item->quantity;
			$disc_amt=$item->discount*$sales_amt;
			$hpp_amt=$item->cost*$item->quantity;
			if($hpp_amt>0){
				//-- posting persediaan
				$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_stock, 
					$faktur->invoice_date,0,$hpp_amt,"Inventory",$faktur->comments,$cid,$item->item_number);
				//-- posting hpp
				$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_hpp, 
					$faktur->invoice_date,$hpp_amt,0,"Cogs",$faktur->comments,$cid,$item->item_number);
			}
			//-- posting penjualan
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_sales, 
					$faktur->invoice_date,0,$sales_amt,"Sales",$faktur->comments,$cid,$item->item_number);

			if($disc_amt>0){
			//-- posting discount item
				$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_disc, 
					$faktur->invoice_date,$disc_amt,0,"Sales Discount",$faktur->comments,$cid,$item->item_number);
			} 
		}
		//-- posting piutang
		$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_ar, 
			$faktur->invoice_date,$faktur->amount,0,"Account Receivable",$faktur->comments,$cid,$faktur->sold_to_customer);
		if($faktur->disc_amount!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_disc, 
				$faktur->invoice_date,$faktur->disc_amount,0,"Sales Discount",$faktur->comments,$cid,$faktur->sold_to_customer);
		}
		if($faktur->tax!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_tax, 
				$faktur->invoice_date,0,$faktur->tax,"Sales Tax",$faktur->comments,$cid,$faktur->sold_to_customer);					
		}
		if($faktur->freight!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_freight, 
				$faktur->invoice_date,0,$faktur->freight,"Sales Freight",$faktur->comments,$cid,$faktur->sold_to_customer);					
		}
		if($faktur->other!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_other, 
				$faktur->invoice_date,0,$faktur->other,"Sales Other",$faktur->comments,$cid,$faktur->sold_to_customer);					
		}
		// validate jurnal
		if($this->jurnal_model->validate($nomor)) {	$data['posted']=true;	} else {$data['posted']=false;}
		$this->invoice_model->update($nomor,$data);
		
	
	}
	function posting_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('company_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select invoice_number 
		from invoice where invoice_type='I' 
		and invoice_date between '$date_from' and '$date_to' and ifnull(posted,false)=false 
		order by invoice_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				
				echo "<br>Posting...".$r_inv_hdr->invoice_number;
				$this->posting($r_inv_hdr->invoice_number);
						
			} // foreach rst_inv_hdr
		} // if rst_inv_hdr
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		Apabila ada kesalahan silahkan periksa mungkin seting akun-akun belum benar, 
		atau jurnal tidak balance. Silahkan cek ke nomor bukti yang bersangkutan 
		dan posting secara manual atau ulangi lagi 
		<a class='btn btn-primary' href='#' onclick='window.history.go(-1); return false;'> Go Back </a>.
		<p>&nbsp</p><p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
			
	} // posting
	function posting_retur($nomor) {
		$saldo=$this->recalc($nomor);
		$faktur=$this->get_by_id($nomor)->row();
		$message="";
		$this->load->model("periode_model");
		if($this->periode_model->closed($faktur->invoice_date)){
			$message="Tidak bisa posting karena periode sudah ditutup.<br>";
			return $message;
		}
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('company_model');
		$this->load->model('invoice_lineitems_model');

		$cid=$this->access->cid;
		$set=$this->company_model->get_by_id($cid)->row();

		$coa_tax=$set->so_tax;
		$coa_freight=$set->so_freight;
		$coa_other=$set->so_other;
		$coa_ar=$set->accounts_receivable;
		$coa_disc=$set->so_discounts_given;

		$detail=$this->invoice_lineitems_model->get_by_nomor($nomor);
		foreach($detail->result() as $item) {
			//-- posting invoice_lineitems
			//-- ambil akun dari master barang
			$r_stok=$this->db->query("select sales_account,inventory_account,cogs_account,cost,cost_from_mfg 
				from inventory where item_number='".$item->item_number."'")->row();
			if($r_stok){
				$coa_sales=$item->revenue_acct_id>0?$item->revenue_acct_id:$r_stok->sales_account;
				if($coa_sales=="" or $coa_sales=="0")	$coa_sales=$set->inventory_sales;
				$coa_stock=$r_stok->inventory_account>0?$r_stok->inventory_account:$set->inventory;
				$coa_hpp=$r_stok->cogs_account>0?$r_stok->cogs_account:$set->inventory_cogs;
				if($item->cost==0){
					$item->cost=$r_stok->cost;
					$this->db->query("update invoice_lineitems set cost=".$item->cost." where line_number=".$item->line_number);
				}
				if($item->cost==0){
					$item->cost=$r_stok->cost_from_mfg;
					$this->db->query("update invoice_lineitems set cost=".$item->cost." where line_number=".$item->line_number);
				}
			}
			
			$sales_amt=$item->price*$item->quantity;
			$disc_amt=$item->discount*$sales_amt;
			$hpp_amt=$item->cost*$item->quantity;
			if($hpp_amt>0){
				//-- posting persediaan
				$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_stock, 
					$faktur->invoice_date,$hpp_amt,0,"Inventory",$faktur->comments,$cid,$item->item_number);
				//-- posting hpp
				$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_hpp, 
					$faktur->invoice_date,0,$hpp_amt,"Cogs",$faktur->comments,$cid,$item->item_number);
			}
			//-- posting penjualan
			if($sales_amt>0){
				$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_sales, 
					$faktur->invoice_date,$sales_amt,0,"Sales",$faktur->comments,$cid,$item->item_number);
			}
			//-- posting discount item
			if($disc_amt>0){
				$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_disc, 
					$faktur->invoice_date,0,$disc_amt,"Sales Discount",$faktur->comments,$cid,$item->item_number);
			}						
		}
		//-- posting piutang
		$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_ar, 
			$faktur->invoice_date,0,$faktur->amount,"Account Receivable",$faktur->comments,$cid,$faktur->sold_to_customer);
		if($faktur->disc_amount!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_disc, 
				$faktur->invoice_date,0,$faktur->disc_amount,"Sales Discount",$faktur->comments,$cid,$faktur->sold_to_customer);
		}
		if($faktur->tax!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_tax, 
				$faktur->invoice_date,0,$faktur->tax,"Sales Tax",$faktur->comments,$cid,$faktur->sold_to_customer);					
		}
		if($faktur->freight!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_freight, 
				$faktur->invoice_date,$faktur->freight,0,"Sales Freight",$faktur->comments,$cid,$faktur->sold_to_customer);					
		}
		if($faktur->other!=0){
			$this->jurnal_model->add_jurnal($faktur->invoice_number,$coa_other, 
				$faktur->invoice_date,$faktur->other,0,"Sales Other",$faktur->comments,$cid,$faktur->sold_to_customer);					
		}
		// validate jurnal
		if($this->jurnal_model->validate($nomor)) {	$data['posted']=true;	} else {$data['posted']=false;}
		$this->invoice_model->update($nomor,$data);
	}	
	function posting_retur_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('company_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select invoice_number 
		from invoice where invoice_type='R' 
		and invoice_date between '$date_from' and '$date_to' and ifnull(posted,false)=false 
		order by invoice_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				
				echo "<br>Posting...".$r_inv_hdr->invoice_number;
				$this->posting_retur($r_inv_hdr->invoice_number);
						
			} // foreach rst_inv_hdr
		} // if rst_inv_hdr
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		Apabila ada kesalahan silahkan periksa mungkin seting akun-akun belum benar, 
		atau jurnal tidak balance. Silahkan cek ke nomor bukti yang bersangkutan 
		dan posting secara manual atau ulangi lagi 
		<a class='btn btn-primary' href='#' onclick='window.history.go(-1); return false;'> Go Back </a>.
		<p>&nbsp</p><p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
			
	} // posting
	function unposting_retur_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select invoice_number 
		from invoice where invoice_type='R' 
		and invoice_date between '$date_from' and '$date_to' and posted=true 
		order by invoice_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				$this->unposting_retur($r_inv_hdr->invoice_number);
				echo "<br>Delete Jurnal: ".$r_inv_hdr->invoice_number;
			}
		}
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		<p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
	}
	function nomor_bukti($add=false)
	{
		$key="Invoice Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!FJ~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!FJ~$00001');
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
	function nomor_bukti_do($add=false)
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
	function list_do_new($d1,$d2){
		$sql="select i.invoice_number,i.invoice_date,i.sold_to_customer,i.invoice_date,
			i.sold_to_customer, c.company, il.item_number,il.description, 
			il.quantity 
			from invoice i left join invoice_lineitems il 
			on i.invoice_number = il.invoice_number 
			left join inventory s on s.item_number=il.item_number
			left join customers c on c.customer_number=i.sold_to_customer
			where i.invoice_type='D' and i.invoice_date between '$d1' and '$d2'
			and (i.status is null  or i.status=0)";
		return $this->db->query($sql);
	}
	function warehouse($invoice_number){
	    $warehouse="";
        if($q=$this->db->select("warehouse_code")->where("invoice_number",$invoice_number)
        ->where("warehouse_code<>''")->limit(1)->get("invoice_lineitems")){
            if($r=$q->row()){
                $warehouse=$r->warehouse_code;
            }
        } 
         
	    return $warehouse;
	}

} ?>