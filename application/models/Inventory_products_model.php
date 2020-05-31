<?php
class Inventory_products_model extends CI_Model {

private $primary_key='shipment_id';
private $table_name='inventory_products';
private $message="";

    function __construct(){
    	parent::__construct();               
        $this->load->model("inventory_model");
        $this->load->model("inventory_prices_model");
        $this->load->model("jurnal_model");
        $this->load->model("company_model");
		$this->load->model("replicate_model");
		
    }
	function message_text()
	{
		return $this->message;
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function valid_data($data){
		
		$item_no=$data['item_number'];
		if (isset($data['mu_qty'])){
			if($data['mu_qty']==''){
				$data['mu_qty']=$data['quantity_received'];
				$data['multi_unit']=$data['unit'];
				$data['mu_price']=$data['cost'];
			}
		}

 	    if(!isset($data['date_received']))$data['date_received']= date( 'Y-m-d H:i:s', strtotime($data['date_received']));
		if(!isset($data['description']))$data['description']="";
		if ( $this->input->post("description")){
			$data['description']=$this->input->post("description");
		}		
		$item=null;
		
		if(getvar("find_item_before_save")){
			$itemq=$this->inventory_model->get_by_id($item_no);
			if($itemq){
				if($item=$itemq->row())	{
					if(trim($data['unit'])=="") $data['unit']=$item->unit_of_measure;
					if($data['cost']=="") $data['cost']=$item->cost;
					if($data['cost']=="0") $data['cost']=$item->cost;	
				}		 
			}			
		}

		
		// apabila default satuan tidak sama dg inputan 
		$lFoundOnPrice=false;
		if($item){
			if(getvar("find_multi_unit_before_save")){
				if($item->unit_of_measure!=$data['unit']) {
					if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
						$data['unit'])->row())
					{
						$lFoundOnPrice=true;
						if($unit_price->quantity_high>0) $data['mu_qty']=$data['quantity_received']*$unit_price->quantity_high;
						$data['mu_price']=$item->cost_from_mfg;
						if($data['mu_price']==0)$data['mu_price']=$item->cost;			
						$data['multi_unit']=$item->unit_of_measure;			
					}
					if($unit=exist_unit($data['unit']) && !$lFoundOnPrice){
						$lFoundOnPrice=true;
						$data['mu_qty']=$data['quantity_received']*$unit['unit_value'];
						$data['mu_price']=item_cost($data['item_number']);
						$data['multi_unit']=$unit['from_unit'];					
					} 
					if(!$lFoundOnPrice){
						$data['mu_qty']=$data['quantity_received'];
						$data['mu_price']=$data['cost'];
						$data['multi_unit']=$data['unit'];
					}	
	
				}				
			}
			
		}
		$data['total_amount']=floatval($data['quantity_received'])*floatval($data['cost']);
		$id=0;
		if(isset($data['id']))$id=$data['id'];
		if($id==0){
	        $data['create_by']=user_id();
	        $data['create_date']=date( 'Y-m-d H:i:s');
		} 
        $data['update_by']=user_id();
        $data['update_date']=date( 'Y-m-d H:i:s');
        item_need_update($item_no);
		item_need_update_arsip($item_no, $data['warehouse_code'], $data['date_received']);

		return $data;		
	}
	function save($data){
		$item_no=$data['item_number'];
		if($item_no=="")return false;
		$data=$this->valid_data($data);		
		$ok=$this->db->insert($this->table_name,$data);
		$ok=$this->db->insert_id();				
        item_need_update($item_no);
		item_need_update_arsip($item_no, $data['warehouse_code'], $data['date_received']);		
        return $ok;
	}
    function update_header($id,$data){
        if(isset($data['cost_account'])){
            $data['cost_account']=account_id($data['cost_account']);
        }
        $data['date_received']= date( 'Y-m-d H:i:s', strtotime($data['date_received']));
        $ok = $this->db->where("shipment_id",$id)->update($this->table_name,$data);
		
        $s="select ip.id,ip.item_number,ip.description,ip.unit,ip.quantity_received,ip.cost, 
        ip.mu_qty,ip.mu_price,ip.warehouse_code,ip.date_received,
        i.unit_of_measure, i.cost as cost_stock,i.cost_from_mfg,i.description as description_stock,
        i.kode_lama,i.item_number as item_number_stock
        from inventory_products ip join inventory i  on (ip.item_number=i.item_number or ip.item_number=i.kode_lama)
        where ip.shipment_id='$id' ";
		  
		if($q=$this->db->query($s)){
			foreach($q->result() as $r){
				if($r->item_number==$r->kode_lama){
					$dt['item_number']="".$r->item_number_stock;
				}
				if("".$r->description=="")$dt['description']=$r->description_stock;
				if(c_($r->mu_qty)==0){
					$dt['mu_qty']=$r->quantity_received;
				}
				$dt['mu_price']=c_($r->mu_price);
				if($dt['mu_price']==0){
					$dt['mu_price']=c_($r->cost);
				}
				if($r->unit==""){
					$dt['unit']=$r->unit_of_measure;
					$dt['multi_unit']=$r->unit_of_measure;
				}
				$dt['cost']=c_($r->cost);
				if($dt['cost']==0){
					$dt['cost']=c_($r->cost_stock);
					if($dt['cost']==0)$dt['cost']=c_($r->cost_from_mfg);
					$dt['total_amount']=$dt['cost']*$r->quantity_received;
					$dt['mu_price']=$dt['cost'];
					$dt['multi_unit']="".$r->multi_unit;
					if($dt['multi_unit']=="")$dt['multi_unit']=''.$r->unit;
				}
				$this->db->where("id",$r->id)->update($this->table_name,$dt);
				
		        item_need_update($r->item_number);
				item_need_update_arsip($r->item_number, $r->warehouse_code, $r->date_received);
								
			}
		}
		return $ok;
    }
	function update($id,$data){
		$id=urldecode($id);
		if($id=="")return false;
		$item_no=$id;
		$data=$this->valid_data($data);
		if(isset($data['id']))unset($data['id']);
		$this->db->where("id",$id);		
		$ok =  $this->db->update($this->table_name,$data);
		if(isset($data['item_number']))$item_no=$data['item_number'];
        item_need_update($item_no);
		
		return $id;
	}
	function validate_delete_receive_po($nomor_receive)
	{
		$cnt=$this->db->query("select count(1) as cnt from purchase_order_lineitems pol
			join inventory_products ip on ip.id=pol.from_line_number
			where ip.shipment_id='$nomor_receive'")->row()->cnt;
		if(intval($cnt)>0) {
			return false;
		} else {
			return true;
		}
	}
	function has_invoice($shipment_id){
		return $this->validate_delete_receive_po($shipment_id);
	}
	function delete($shipment_id){
		$sql="select id from inventory_products 
			where shipment_id='$shipment_id'";
		$ok=true;
        if($q=$this->db->query($sql)){
        	foreach($q->result() as $r){
        		$ok = $this->delete_by_id($r->id);
        	}
        }		
		return $ok;
	}
	function delete_by_id($id){
		if($q=$this->db->query("
		select item_number,warehouse_code,date_received 
			from inventory_products where id='$id'")){
			if($r=$q->row()){
				if($r->item_number!=""){
			        item_need_update($r->item_number);
					item_need_update_arsip($r->item_number, $r->warehouse_code, $r->date_received);
				}
			}
		}
		$this->db->where('id',$id);
		$ok = $this->db->delete($this->table_name);
		
		return $ok;
	}
	function delete_item($id){
		return $this->delete_by_id($id);		
	}
	function list_receive($purchase_order_number)
	{
		$query=$this->db->query("select distinct shipment_id,
			date_received,warehouse_code,receipt_by 
			from inventory_products
			where receipt_type='PO' 
			and purchase_order_number='$purchase_order_number'");
		return $query;
	}
	function unposting($shipment_id){
        $sql="update inventory_products set posted=0 where shipment_id='$shipment_id'";
        $this->db->query($sql);	    
        $this->jurnal_model->unposting($shipment_id);
	    return true;
	}
	function posting($shipment_id){
		$cid=$this->access->cid;
//                $cid=cid();
		
		$set=$this->company_model->get_by_id($cid)->row();

		$coa_tax=$set->so_tax;
		$coa_freight=$set->so_freight;
		$coa_other=$set->so_other;
		$coa_ar=$set->accounts_receivable;
		$coa_disc=$set->so_discounts_given;
		$coa_hpp=$set->inventory_cogs;
		$coa_sales=$set->inventory_sales;
		$coa_stock=$set->inventory;
		$coa_hpp=$set->inventory_cogs;
		
	    $retval=false;
	    $total=0;
	    if($q=$this->db->where("shipment_id",$shipment_id)->get($this->table_name)){
	        foreach($q->result() as $row){
	            $inv=0;
                $cogs=0;
                $amount=$row->total_amount;
				$date=$row->date_received;
			$coa_stock_in=$coa_stock;
			$coa_hpp_in=$coa_hpp;
			$coa_sales_in=$coa_sales;
			$cost=0;
			
			$q_stok=$this->db->query("select i.cost,i.cost_from_mfg,i.sales_account, i.inventory_account, i.cogs_account, i.cost,
				i.cost_from_mfg,c.inventory_account as inventory_account_cat,
				c.cogs_account as cogs_account_cat,c.sales_account as sales_account_cat 
				from inventory i 
				left join inventory_categories c on c.kode=i.category
				where i.item_number='".$row->item_number."'");
			$r_stok=$q_stok->row();
				
			if($r_stok){
				$cost=$r_stok->cost;
				if($cost==0){
					$cost=$r_stok->cost_from_mfg;
				}
				//coa sales
				$coa_sales2=c_($r_stok->sales_account_cat);	//akun dari categor				
				if($coa_sales2>0){
					$coa_sales_in=$coa_sales2;
				}
				
				$coa_sales2=c_($r_stok->sales_account);	//akun di set di barang
				if($coa_sales2>0){
					$coa_sales_in=$coa_sales2;
				}
				//coa stock
				$coa_stock2=c_($r_stok->inventory_account_cat);
				if($coa_stock2>0){
					$coa_stock_in=$coa_stock2;
				}
				$coa_stock2=c_($r_stok->inventory_account);
				if($coa_stock2>0){
					$coa_stock_in=$coa_stock2;
				}
				//coa hpp
				$coa_hpp2=c_($r_stok->cogs_account_cat);
				if($coa_hpp2>0){
					$coa_hpp_in=$coa_hpp2;
				}
								
				$coa_hpp2=c_($r_stok->cogs_account);
				if($coa_hpp2>0){
					$coa_hpp_in=$coa_hpp2;
				}

				
			}				
			$amount=$cost*$row->quantity_received;
			
				
				
                if($row->cost_account){
                    $coa_hpp_in=$row->cost_account;
                }

                $total+=$amount;
                $gl_id=$row->shipment_id;
                $account_id=$coa_stock_in;
                $debit=$amount;
                $credit=0;
				if($row->receipt_type=="ETC_OUT"){
					$debit=0;
					$credit=$amount;					
				}
                $operation="Posting $row->receipt_type";
                $source=$row->comments;
                $ref=$row->item_number;
                
                $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,
                    $source,$cid="",$ref="");
                    
                $account_id=$coa_hpp_in;
                $debit=0;
                $credit=$amount;
				if($row->receipt_type=="ETC_OUT"){
					$debit=$amount;
					$credit=0;					
				}
                
                $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,
                    $source,$cid="",$ref="");
                    
                $retval=true;    
                    
	        }
	    }
        $sql="update inventory_products set posted=1 where shipment_id='$shipment_id'";
        $this->db->query($sql);
	    return $retval;
	}
		function replicate($receipt_type,$db_proc,$doc_type=''){
			
			if(!$db=db_names($db_proc))	return false;
			
			$nomor="";
			$tanggal="";
			$gudang=current_gudang();
			if($doc_type!="")$doc_type=" and doc_type='$doc_type' ";
			
			$s="select shipment_id,date_received from inventory_products 
				where warehouse_code='$gudang' and receipt_type='$receipt_type'
				and (update_status=0 or update_status is null)
				$doc_type
				limit 1";
			if($q=$this->db->query($s)){
				if($r=$q->row()){
					$nomor=$r->shipment_id;
					$tanggal=$r->date_received;
				}
			}
			if($nomor=="") return false;
			$first  = new DateTime( $tanggal );
			$second = new DateTime( date("Y-m-d H:i:s") );
		$diff = $first->diff( $second );
	
		$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) return false;

			$this->message.="\r inv_prod_$db_proc($nomor,$receipt_type)";
						
			for($i=0;$i<count($db);$i++){
				$db_name=$db[$i];
				$s="select * from inventory_products where shipment_id='$nomor' 
					and (update_status=0 or update_status is null)";
				if($qinvsrc=$this->db->query($s)){
					foreach($qinvsrc->result_array() as $rinvsrc){
							
						$gudang_tujuan=$rinvsrc['supplier_number'];	
						
						if(for_this_gudang($gudang_tujuan,$db_name)){
						
							$s="select * from $db_name.inventory_products where shipment_id='$nomor' 
							and sourceautonumber='".$rinvsrc['id']."' ";
							$new=true;				
							if($qinvtgt=$this->db->query($s)){
								$s3="";
								$id=0;
								$description=$rinvsrc['description'];
								$item_number=$rinvsrc['item_number'];
								if($description==""){
									$s="select item_number,description from $db_name.inventory where kode_lama='$item_number' ";
									if($qtgtitem=$this->db->query($s)){
										if($rtgtitem=$qtgtitem->row()){
											if($rtgtitem->description!=""){
												$description=$rtgtitem->description;
												$rinvsrc['item_number']=$rtgtitem->item_number;
												$rinvsrc['description']=$rtgtitem->description;
											}
										}
									}
								}
								
								if($qinvtgt->num_rows()){
									$rinvtgt=$qinvtgt->row();
									$id=$rinvtgt->id;
									
									$s="update $db_name.inventory_products set ";
									$s3=" where shipment_id='$nomor' and id='$id' ";
									$s2=sql_fields($rinvsrc,"id");						
									$new=false;
								} else {
									$s="insert into $db_name.inventory_products set ";
									$s2=sql_fields($rinvsrc,"id");
								}					
								if(strlen($s2)){
									$sql=$s.$s2.$s3; 
									
									//echo $sql;
									
									$this->db->query($sql);
									if($id==0){
										$id=$this->db->insert_id();
									}						
								}					
							}
							if($id>0){
								
								$sql="update $db_name.inventory_products 
									set sourceautonumber='".$rinvsrc['id']."',update_status='1'  
									where id='$id' and shipment_id='$nomor' ";
								$this->db->query($sql);
							
							}
						
						}
					}
					
				}
				$s="update inventory_products set update_status=1 where shipment_id='$nomor'";
				$this->db->query($s);
	
	


			
			}
			
		}

}
?>