<?php
class Purchase_invoice_model extends CI_Model {

    private $primary_key='purchase_order_number';           public $potype="";
    private $table_name='purchase_order';                   public $other=0;
    public $amount_paid=0;                                  public $disc_amount_1=0;
    public $saldo=0;                                        public $freight=0;
    public $amount=0;                                       
    public $sub_total=0;
    public $show_finish_message=true;
    public $_amount_faktur=0,$_saldo=0,$_payment=0,$_retur=0,$_cr_memo=0,$_db_memo=0;
    
	function __construct(){
		parent::__construct();        
         
        $this->load->model('inventory_products_model');
        $this->load->model('purchase_order_lineitems_model');
        $this->load->model('purchase_order_model');
        $this->load->model('payables_payments_model');
        $this->load->model('jurnal_model');
        $this->load->model('chart_of_accounts_model');
        $this->load->model('company_model');
        $this->load->model('supplier_model');
        $this->load->model('inventory_model');
        $this->load->model('crdb_model');
        
        
	}
    function expenses($faktur){
        $retval=null;
        if($q=$this->db->where("purchase_order_number",$faktur)->get("purchase_order_expenses")){
            $retval=$q;
        }
        return $retval;
    }
	function retur_amount($purchase_order_number) {
		$sql="select sum(amount) as z_amount 
			from purchase_order i
			where i.potype='R' and po_ref='$purchase_order_number'";
        $retval=0;
        if($q=$this->db->query($sql)){
            if($r=$q->row()){
                $retval=$r->z_amount;
            }
        }
        $this->_retur=$retval;
        return $retval;
	}
    function retur_list($purchase_order_number){
        $sql="select * from purchase_order i where i.potype='R' and po_ref='$purchase_order_number' 
        order by po_date";
        return $this->db->query($sql);
    }
    function crdb_memo_list($purchase_order_number){
        $sql="select * from crdb_memo i where i.docnumber='$purchase_order_number' 
            and transtype in ('PO-DEBIT MEMO','PO-CREDIT MEMO') 
            order by tanggal";
        return $this->db->query($sql);        
    }
    function payment_list($purchase_order_number){
        $sql="select * from payables_payments i where i.purchase_order_number='$purchase_order_number' 
           order by date_paid";
        return $this->db->query($sql);        
    }
    
	function crdb_memo_ex($purchase_order_number){
        $sql="select docnumber,(case transtype 
                when 'PO-DEBIT MEMO' then -1*sum(amount) 
                else sum(amount) end) as z_amount 
            from crdb_memo i
            where docnumber='$purchase_order_number' 
            group by docnumber,transtype";
        $retval=0;
        if($q=$this->db->query($query)){
            if($r=$q->row()){
                $retval=$r->z_amount;
            }
        }
	    
	}
	function crdb_amount($purchase_order_number) {
        $this->_db_memo=$this->crdb_model->amount_sum($purchase_order_number,"PO-DEBIT MEMO");
        $this->_cr_memo=$this->crdb_model->amount_sum($purchase_order_number,"PO-CREDIT MEMO");
        return $this->_cr_memo-$this->_db_memo;
	}
	function paid_amount($nomor){
		$ret= $this->payables_payments_model->total_amount($nomor);
        $this->_payment=$ret;
        return $ret;
	}

	function recalc($nomor){
	    $this->amount=$this->purchase_order_lineitems_model->sum_total_price($nomor);
		$this->sub_total=$this->amount;
    	$po=$this->get_by_id($nomor)->row();
		if(!$po){
			return 0;
		}
		$this->potype=$po->potype;
		$this->other=$po->other;
		$this->freight=$po->freight;
		$this->sub_total=$po->subtotal;
		$this->tax_amount=$po->tax_amount;
        $this->disc_amount_1=$po->disc_amount_1;
        
		$disc_amount=$po->discount*$this->sub_total;
	    $this->amount=$this->sub_total-$disc_amount;
		$tax_amount=$po->tax*$this->amount;
		$this->amount=$this->amount+$tax_amount;
		$this->amount=$this->amount+$po->freight;
		$this->amount=$this->amount+$po->other;

		$this->db->where($this->primary_key,$nomor);
		$this->db->update($this->table_name,array('amount'=>$this->amount,
		'tax_amount'=>$tax_amount,'disc_amount_1'=>$disc_amount,'subtotal'=>$this->sub_total));
		
		$this->add_payables($nomor);
	    $this->amount_paid=$this->payables_payments_model->total_amount($nomor);
		$this->_payment=$this->amount_paid;
        
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
		$ok= $this->db->get($this->table_name);
        
        return $ok;
	}
	function save($data){
		if($data['po_date'])$data['po_date']= date('Y-m-d H:i:s', strtotime($data['po_date']));
		if(isset($data['due_date']))$data['due_date']= date('Y-m-d H:i:s', strtotime($data['due_date']));
		return $this->db->insert($this->table_name,$data);
//		return $this->db->insert_id();
	}
    function save_item($data){
        $ok=$this->purchase_order_lineitems_model->save($data);
        return $ok;
    }
	function update($id,$data){
		if(isset($data['po_date']))$data['po_date']= date('Y-m-d H:i:s', strtotime($data['po_date']));
		if(isset($data['due_date']))$data['due_date']= date('Y-m-d H:i:s', strtotime($data['due_date']));
		if(isset($data['warehouse_code'])){
			if($data['warehouse_code']!=""){
				$this->db->query("update purchase_order_lineitems 
					set warehouse_code='".$data['warehouse_code']."' 
					where purchase_order_number='$id'");
			}
		}
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
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
	function get_bill_id($invoice)
	{
		$row=$this->db->query("select bill_id from payables where purchase_order_number='".$invoice."'");
		if($row){
			if($bill_id_row=$row->row()){
			    $bill_id=$bill_id_row->bill_id;
				return $bill_id;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
    function unposting($nomor) {
        
        $faktur=$this->get_by_id($nomor)->row();

        $this->load->model("periode_model");
        if($this->periode_model->closed($faktur->po_date)){
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
        $this->update($nomor,$data);
        
        return true;
    }
		
	function posting($nomor)
	{
		$this->load->model('purchase_order_model');
        $this->load->model("periode_model");
        $nomor=urldecode($nomor);
		$this->recalc($nomor);
		$faktur=$this->purchase_order_model->get_by_id($nomor)->row();
        if(!$faktur){
            echo "NOT FOUND $nomor";
            return false;
        }

		if($this->periode_model->closed($faktur->po_date)){
			echo "ERR_PERIOD";
			return false;
		}
		$date=$faktur->po_date;
		$supplier=$this->supplier_model->get_by_id($faktur->supplier_number)->row();
		$akun_hutang=$faktur->account_id;
		$gl_id=$nomor;
		$debit=0; $credit=0;$operation="";$source="";
		// posting hutang / ap
		if(invalid_account($akun_hutang))$akun_hutang=$supplier->supplier_account_number;
		if(invalid_account($akun_hutang))$akun_hutang=$this->company_model->setting("accounts_payable");
        
		$account_id=$akun_hutang; $debit=0; $credit=$faktur->amount;
		$operation="AP Posting"; $source=$faktur->comments;
		
		$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source);
		// posting tax amount
		$tax_amount=$faktur->tax_amount;
		if($tax_amount>0){
			$akun_ppn=$this->company_model->setting("po_tax");
			$account_id=$akun_ppn; $debit=0; $credit=$tax_amount;
			$operation="AP Tax Posting"; $source=$faktur->comments;
			$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source);
		}
		// posting discount amount
		$disc_amount_1=$faktur->disc_amount_1;
		if($disc_amount_1>0){
			$akun_disc=$this->company_model->setting("po_discounts_taken");
			$account_id=$akun_disc; $debit=0; $credit=$disc_amount_1;
			$operation="Discount Posting"; $source=$faktur->comments;
			$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source);
		}
		// posting biaya
		$biaya_amount=$faktur->other;
        if($biaya_amount!=0){
            $akun_biaya=$this->company_model->setting("po_other");
            $account_id=$akun_biaya; 
            if($biaya_amount>0){
                $debit=$biaya_amount; $credit=0;                
            } else {
                $debit=0; $credit=abs($biaya_amount);                
            }
            $operation="Biaya Posting"; $source=$faktur->comments;
            $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source);
            
        }
		//posting ongkos
		$ongkos_amount=$faktur->freight;
        if($ongkos_amount!=0){
            $akun_ongkos=$this->company_model->setting("po_freight");
            $account_id=$akun_ongkos; 
            if($ongkos_amount>0){
                $debit=$ongkos_amount; $credit=0;                
            } else {
                $debit=0; $credit=abs($ongkos_amount);                
            }
            $operation="Ongkos Posting"; $source=$faktur->comments;
            $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source);
            
        }
		// posting persediaan
		$items=$this->purchase_order_lineitems_model->get_by_nomor($nomor);
        $account_id=null;
        $sistim=0;
        $account_cogs=0;
		foreach($items->result() as $row) {
		    $sistim=0;
			if($item_q=$this->inventory_model->get_by_id($row->item_number)){
			    if($item_stock=$item_q->row()){
                    $account_id=$item_stock->inventory_account; 
                    $account_cogs=$item_stock->cogs_account;
                    $sistim=$item_stock->type_of_invoice;
			        
			    }
			}
			if(!$account_id)$account_id=$this->company_model->setting('inventory');
            if($sistim!=""){
                $s="select * from system_variables where varname='lookup.po_type' and varvalue='$sistim'";
                if($qsis=$this->db->query($s)){
                    if($rsis=$qsis->row()){
                        //cari dari sistimnya
                        if($rsis->coa1!="")$account_id=$rsis->coa1;                
                        if($rsis->coa2!="")$account_cogs=$rsis->coa2;                
                        
                    }
                }
                
                
            }
			$debit=$row->total_price; $credit=0;
			$operation="Inventory Posting"; $source=$row->description;
			$custsuppbank=$row->item_number;
			$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source,'',$custsuppbank);
			
		}
		
		// validate jurnal
		
		if($this->jurnal_model->validate($nomor)) {
			$data['posted']=true;
		} else {
			$data['posted']=false;
		}
		
		$this->purchase_order_model->update($nomor,$data);
	}	

	function posting_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('company_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select purchase_order_number from purchase_order where potype='I' 
		and po_date between '$date_from' and '$date_to' and ifnull(posted,false)=false 
		order by purchase_order_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				
				echo "<br>Posting...".$r_inv_hdr->purchase_order_number;
				$this->posting($r_inv_hdr->purchase_order_number);
						
			} // foreach rst_inv_hdr
		} // if rst_inv_hdr
		if($this->show_finish_message){
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		Apabila ada kesalahan silahkan periksa mungkin seting akun-akun belum benar, 
		atau jurnal tidak balance. Silahkan cek ke nomor bukti yang bersangkutan 
		dan posting secara manual atau ulangi lagi 
		<a class='btn btn-primary' href='#' onclick='window.history.go(-1); return false;'> Go Back </a>.
		<p>&nbsp</p><p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
		}
	} // posting	
	function unposting_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select purchase_order_number from purchase_order where potype='I' 
		and po_date between '$date_from' and '$date_to' and posted=true 
		order by purchase_order_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				$this->unposting($r_inv_hdr->purchase_order_number);
				echo "<br>Delete Jurnal: ".$r_inv_hdr->purchase_order_number;
			}
		}
		if($this->show_finish_message){
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		<p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
		}
	}
	function has_payment($invoice) {
		$bill_id=intval($this->get_bill_id($invoice));
		$amount=floatval($this->paid_amount($invoice));
		if ( $amount <> 0 ) {
			return true; 
		} else {
			return false;
		}
	}
	function has_retur($invoice){
		if ( floatval($this->retur_amount($invoice))<>0 ) {
			return true; 
		} else {
			return false;
		}
	}
	function has_memo($invoice){
		if ( floatval($this->crdb_amount($invoice))<>0 ) {
			return true; 
		} else {
			return false;
		}
	}
    function nomor_bukti($add=false){
        $key="Purchase Invoice Numbering";
        $no="";
        if($add){
            $this->sysvar->autonumber_inc($key);
        } else {            
            $no=$this->sysvar->autonumber($key,0,'!PI~$00001');
            for($i=0;$i<100;$i++){          
                $no=$this->sysvar->autonumber($key,0,'!PI~$00001');
                $rst=$this->purchase_invoice_model->get_by_id($no)->row();
                if($rst){
                    $this->sysvar->autonumber_inc($key);
                } else {
                    break;                  
                }
            }
        }
        if($no=="")$no="PI".date("YmdHis");
        return $no;
    }
    function get_expenses_from_po($po,$qty_total,$invoice){
        $retval['total']=0;
        $total=0;
        $this->db->where("purchase_order_number",$po);
        if($qexp=$this->db->get('purchase_order_expenses')){
            foreach($qexp->result() as $row){
                $data=(array)$row;
                $data["purchase_order_number"]=$invoice;
                $data["qty"]=$qty_total;
                if($row->calc_method==1){
                    $data["amount"]=$row->price*$qty_total;
                }     
                $total+=$data["amount"];
                unset($data['id']);
                $this->db->insert("purchase_order_expenses",$data);
            }
        }
        $sql="update purchase_order set other=-1*$total where purchase_order_number='$invoice'";
        $this->db->query($sql);
        return $total;
    }
    function create_from_recv($shipment_id){
        $shipment_id=urldecode($shipment_id);
        //create header
        $sql="select purchase_order_number from inventory_products 
            where shipment_id='$shipment_id' and purchase_order_number<>''";
        $po_no=$this->db->query($sql)->row()->purchase_order_number;
        $po=$this->purchase_order_model->get_by_id($po_no)->row();
        
        
        $inv=(array)$po;        
        $invoice_number=$this->nomor_bukti();
        $inv['purchase_order_number']=$invoice_number;
        $inv['potype']='I';
        $inv['po_date']=date("Y-m-d H:i:s");
        $inv['other']=0;
        $inv['po_ref']=$shipment_id;
        
        $this->save($inv);
        
        $this->nomor_bukti(true);
        
        $qty_total=0;
        
        $query=$this->inventory_products_model->get_by_id($shipment_id);
        foreach($query->result() as $row)
        {
            $item_name='';
            $q=$this->db->query("select description from inventory where item_number='".$row->item_number."'");
            if($q->row()){
                $item_name=$q->row()->description;
            }
            $from_line=$row->from_line_number;
            $discount=0;    $disc_2=0;  $disc_3=0;  $price=0;
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
            $qty_total+=$row->quantity_received;
            
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
			$data['mu_qty']=$row->mu_qty;
			$data['multi_unit']=$row->multi_unit;
			$data['mu_harga']=$row->mu_price;
			
            $ok=$this->purchase_order_lineitems_model->save($data);
        }

        $this->get_expenses_from_po($po_no,$qty_total,$invoice_number);

        $this->db->query("update inventory_products set selected=1 where shipment_id='$shipment_id'");
        
        $this->recalc($invoice_number);
        $this->add_payables($invoice_number);        
    }
   function biaya_label_amount($date1,$date2,$supplier="",$outlet="",$category="",$sistim=""){
       $retval['qty']=0;
       $retval['amount']=0;
       $s="select sum(qty) as qty,
       sum(poe.amount) as amount 
       from purchase_order_expenses poe
       left join purchase_order po on po.purchase_order_number=poe.purchase_order_number
       where po.po_date between '$date1' and '$date2' 
       and po.potype='I' and item_no='LABEL'";
       if($supplier!="")$s.=" and po.supplier_number='$supplier'";
       if($q=$this->db->query($s)){
           if($row=$q->row()){
               $retval['qty']=$row->qty;
               $retval['amount']=$row->amount;
           }
       }
       
       return $retval;
  }
   function biaya_admin_amount($date1,$date2,$supplier="",$outlet="",$category="",$sistim=""){
       $retval['qty']=0;
       $retval['amount']=0;
       $s="select sum(qty) as qty,
       sum(poe.amount) as amount 
       from purchase_order_expenses poe
       left join purchase_order po on po.purchase_order_number=poe.purchase_order_number
       where po.po_date between '$date1' and '$date2' 
       and po.potype='I' and item_no='ADMIN'";
       if($supplier!="")$s.=" and po.supplier_number='$supplier'";
       if($q=$this->db->query($s)){
           if($row=$q->row()){
               $retval['qty']=$row->qty;
               $retval['amount']=$row->amount;
           }
       }
       
       return $retval;
  }
   function biaya_htag1_amount($date1,$date2,$supplier="",$outlet="",$category="",$sistim=""){
       $retval['qty']=0;
       $retval['amount']=0;
       $s="select sum(qty) as qty,
       sum(poe.amount) as amount 
       from purchase_order_expenses poe
       left join purchase_order po on po.purchase_order_number=poe.purchase_order_number
       where po.po_date between '$date1' and '$date2' 
       and po.potype='I' and item_no='HTAG1'";
       if($supplier!="")$s.=" and po.supplier_number='$supplier'";
       if($q=$this->db->query($s)){
           if($row=$q->row()){
               $retval['qty']=$row->qty;
               $retval['amount']=$row->amount;
           }
       }
       
       return $retval;
  }
   function biaya_htag2_amount($date1,$date2,$supplier="",$outlet="",$category="",$sistim=""){
       $retval['qty']=0;
       $retval['amount']=0;
       $s="select sum(qty) as qty,
       sum(poe.amount) as amount 
       from purchase_order_expenses poe
       left join purchase_order po on po.purchase_order_number=poe.purchase_order_number
       where po.po_date between '$date1' and '$date2' 
       and po.potype='I' and item_no='HTAG2'";
       if($supplier!="")$s.=" and po.supplier_number='$supplier'";
       if($q=$this->db->query($s)){
           if($row=$q->row()){
               $retval['qty']=$row->qty;
               $retval['amount']=$row->amount;
           }
       }
       
       return $retval;
  }
   function biaya_transfer_amount($date1,$date2,$supplier="",$outlet="",$category="",$sistim=""){
       $retval['qty']=0;
       $retval['amount']=0;
       $s="select sum(qty) as qty,
       sum(poe.amount) as amount 
       from purchase_order_expenses poe
       left join purchase_order po on po.purchase_order_number=poe.purchase_order_number
       where po.po_date between '$date1' and '$date2' 
       and po.potype='I' and item_no='TRANSFER'";
       if($supplier!="")$s.=" and po.supplier_number='$supplier'";
       if($q=$this->db->query($s)){
           if($row=$q->row()){
               $retval['qty']=$row->qty;
               $retval['amount']=$row->amount;
           }
       }
       
       return $retval;
  }
   function biaya_paket_amount($date1,$date2,$supplier="",$outlet="",$category="",$sistim=""){
       $retval['qty']=0;
       $retval['amount']=0;
       $s="select sum(qty) as qty,
       sum(poe.amount) as amount 
       from purchase_order_expenses poe
       left join purchase_order po on po.purchase_order_number=poe.purchase_order_number
       where po.po_date between '$date1' and '$date2' 
       and po.potype='I' and item_no='PAKET'";
       if($supplier!="")$s.=" and po.supplier_number='$supplier'";
       if($q=$this->db->query($s)){
           if($row=$q->row()){
               $retval['qty']=$row->qty;
               $retval['amount']=$row->amount;
           }
       }
       
       return $retval;
  }
   function biaya_lain_amount($date1,$date2,$supplier="",$outlet="",$category="",$sistim=""){
       $retval['qty']=0;
       $retval['amount']=0;
       $s="select sum(qty) as qty,
       sum(poe.amount) as amount 
       from purchase_order_expenses poe
       left join purchase_order po on po.purchase_order_number=poe.purchase_order_number
       where po.po_date between '$date1' and '$date2' 
       and po.potype='I' and item_no='LAIN'";
       if($supplier!="")$s.=" and po.supplier_number='$supplier'";
       if($q=$this->db->query($s)){
           if($row=$q->row()){
               $retval['qty']=$row->qty;
               $retval['amount']=$row->amount;
           }
       }
       
       return $retval;
  }
    function lookup($supplier_number="",$bind_id="purchase_order_number",$dlgRetFunc=""){
        if($dlgRetFunc=="")$dlgRetFunc="$('#purchase_order_number').val(row.purchase_order_number);";
        $retval=$this->list_of_values->render(
                array("dlgBindId"=>$bind_id,
                "dlgRetFunc"=>$dlgRetFunc,
                "dlgCols"=>array(array("fieldname"=>"purchase_order_number","caption"=>"Faktur","width"=>"100px"),
                array("fieldname"=>"supplier_number","caption"=>"Supplier","width"=>"50px"),
                array("fieldname"=>"supplier_name","caption"=>"Supplier Name","width"=>"250px"),
                array("fieldname"=>"po_date","caption"=>"Tanggal","width"=>"180px"))));
        return $retval;
    }   
                                   
           		
}	 
