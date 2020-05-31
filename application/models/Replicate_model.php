<?php
class Replicate_model extends CI_Model {
    	
    private $message="";
	public $source_db="";
	public $nomor="";
	
	function __construct(){
		parent::__construct();        
		$this->load->model(array("inventory_products_model"));
		
	}
	function message_text(){
		if($this->message!=""){
			$this->message="Replicate: ".$this->message;
		}
		return $this->message;
	}
	function inventory($item_number){
		//return false;	///nanti dulu
		if($item_number==""){
			return false;
		}				
		if($db=db_names("inventory")){
			$this->message .= "\r ->inventory($item_number)";
			for($i=0;$i<count($db);$i++){
				$dbname=$db[$i];
				
				if($qs=$this->db->where("item_number",$item_number)->get("inventory")){
					if($data_src=(array)$qs->row()){
						//$this->message.= "$dbname, ";			
						if(isset($data_src['id']))unset($data_src['id']);			
						$s2="";
						$s="select item_number from $dbname.inventory where item_number='$item_number'";
						if($qt=$this->db->query($s)){
							$s3="";
							if($qt->num_rows()){
								$s="update $dbname.inventory set ";
								$s2=sql_fields($data_src,"item_number");
								$s3=" where item_number='$item_number' ";
							} else {
								$s="insert IGNORE  into $dbname.inventory set ";
								$s2=sql_fields($data_src);
							}							
							if(strlen($s2)){
								$sql=$s.$s2.$s3; 
								@$this->db->query($sql);
							}
							
						}
					}
				}
			}
		}
		return true;
	}

	function suppliers($supplier_number){
		if($supplier_number=="")return false;		
		if($db=db_names()){
			for($i=0;$i<count($db);$i++){
				$dbname=$db[$i];
				if($qs=$this->db->where("supplier_number",$supplier_number)->get("suppliers")){
					if($data_src=(array)$qs->row()){
						$s2="";
						$s="select supplier_number from $dbname.suppliers 
							where supplier_number='$supplier_number'";
						if($qt=$this->db->query($s)){
							$s3="";
							if($qt->num_rows()){
								$s="update $dbname.suppliers set ";
								$s3=" where supplier_number='$supplier_number' ";
								$s2=sql_fields($data_src,"supplier_number");
							} else {
								$s="insert into $dbname.suppliers set ";
								$s2=sql_fields($data_src);
							}
							if(strlen($s2)){
								$sql=$s.$s2.$s3; 
								@$this->db->query($sql);
							}
							
						}
					}
				}
			}
		}
		return true;
	}


	function customers($customer_number){
		if($customer_number=="")return false;		
		if($db=db_names()){
			for($i=0;$i<count($db);$i++){
				$dbnames=$db[$i];
				if($qs=$this->db->where("customer_number",$customer_number)->get("customers")){
					if($data_src=(array)$qs->row()){
						$s2="";
						$s="select customer_number from $dbname.customers 
							where customer_number='$customer_number'";
						if($qt=$this->db->query($s)){
							$s3="";
							if($qt->num_rows()){
								$s="update $dbname.customers set ";
								$s3=" where customer_number='$customer_number' ";
								$s2=sql_fields($data_src,"customer_number");
							} else {
								$s="insert into $dbname.customers set ";
								$s2=sql_fields($data_src);
							}
							if(strlen($s2)){
								$sql=$s.$s2.$s3; 
								@$this->db->query($sql);
							}
							
						}
					}
				}
			}
		}
		return true;
	}

	function stock_mutasi($data=null){
		if(!$data){
			return false;
		}
		if (!$this->config->item("multi_company")){
			return false;
		}
		// doc_type: 1 = kirim barang ke toko
		// receipt_type: ETC_OUT
		$doc_type="";
		$receipt_type="";
		
		if(isset($data['doc_type']))$doc_type=$data['doc_type'];
		if(isset($data['receipt_type']))$receipt_type=$data['receipt_type'];
		$id=0;
		if(isset($data['id']))$id=$data['id'];
		$shipment_id=$data['shipment_id'];
		$item_number=$data['item_number'];
		$gudang1=$data['warehouse_code'];
		$gudang2=$data['supplier_number'];
		
		if (($doc_type==1 || $doc_type==2) && $receipt_type=="ETC_OUT"){
			$this->kirim_barang_ke_toko($data,$gudang2,$id);
		}
	}
	function kirim_barang_ke_toko($data,$gudang2,$id){
		if($data['warehouse_code']==$gudang2){
			return false;
		}
		$company="";
		$s="select company_name from shipping_locations where location_number='$gudang2' ";
		if($qgdg=$this->db->query($s)){
			if($rgdg=$qgdg->row()){
				$company=$rgdg->company_name;
			}
		}
		if($company==""){
			return false;
		}
		$company_db="kagum_$company";
		
		$s2=sql_fields($data,"id");
		if($id>0){
			//$s="update ".$company_db.".inventory_products set $s2 where from_line_number='$id' ";	
		} else {
			$s="insert into ".$company_db.".inventory_products set $s2 ";
		}
		$this->db->query($s);
		
	}
	function jual(){
			
		
		if(!$db=db_names("jual"))return false;
		
		$invoice_number="";
		$invoice_date=date("Y-m-d H:i:s");
		
		if($this->nomor!=""){
			$invoice_number=$this->nomor;
		}
		$sql="select invoice_number,invoice_date from invoice where invoice_type='I' ";
			
		if($invoice_number!=""){
			$sql.=" and invoice_number='$invoice_number' ";
		} else {
			$sql.=" and (update_status=0 or update_status is null) 	limit 1";
			
		}
		
		
		if($qinv=$this->db->query($sql)){
			if($rinv=$qinv->row()){
				$invoice_number=$rinv->invoice_number;
				$invoice_date=$rinv->invoice_date;
			}
		}
		if($invoice_number=="") return false;
		
		$this->message.="\r jual($invoice_number,$invoice_date)";
		
		$first  = new DateTime( $invoice_date );
		$second = new DateTime( date("Y-m-d H:i:s") );

		$diff = $first->diff( $second );

		$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) {
			$this->message.="--SKIP($minutes / 15 minute)";
			return false;
		}
		
		$sql="update invoice set update_status=1 where invoice_number='$invoice_number' ";
		$this->db->query($sql);
		
		for($i=0;$i<count($db);$i++){
			$this->invoice_header($invoice_number,$db[$i]);
			$this->invoice_lineitems($invoice_number,$db[$i]);
			$this->invoice_payments($invoice_number,$db[$i]);
		}
		
	}
	function invoice_header($invoice_number,$db_name){
		
		$db_src="";
		if($this->source_db!="")$db_src=$this->source_db.".";
		
		$s="select * from ".$db_src."invoice where invoice_number='$invoice_number' ";
		if($qinvsrc=$this->db->query($s)){
			if($rinvsrc=$qinvsrc->row()){
				$rinvsrc_data=(array)$rinvsrc;
				$s="select * from $db_name.invoice where invoice_number='$invoice_number'";
				if($qinvtgt=$this->db->query($s)){
					$s3="";
					if($qinvtgt->num_rows()){
						$s="update $db_name.invoice set ";
						$s3=" where invoice_number='$invoice_number' ";
						$s2=sql_fields($rinvsrc,"invoice_number");						
					} else {
						$s="insert into $db_name.invoice set ";
						$s2=sql_fields($rinvsrc);
					}
					if(strlen($s2)){
						$sql=$s.$s2.$s3; 
						@$this->db->query($sql);
					}
					
				}

				
			}
		}
		return true;				
	}
	function invoice_lineitems($invoice_number,$db_name){
		
		$db_src="";
		if($this->source_db!="")$db_src=$this->source_db.".";

		$s="select * from ".$db_src."invoice_lineitems where invoice_number='$invoice_number' ";
		if($qinvsrc=$this->db->query($s)){
			foreach($qinvsrc->result_array() as $rinvsrc){
				$s="select * from $db_name.invoice_lineitems where invoice_number='$invoice_number' 
					and sourceautonumber='".$rinvsrc['line_number']."' ";
				$new=true;				
				if($qinvtgt=$this->db->query($s)){
					$s3="";
					$line_number=0;
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
						$line_number=$rinvtgt->line_number;
						
						
						$s="update $db_name.invoice_lineitems set ";
						$s3=" where invoice_number='$invoice_number' and line_number='$line_number' ";
						$s2=sql_fields($rinvsrc,"line_number");						
						$new=false;
					} else {
						$s="insert into $db_name.invoice_lineitems set ";
						$s2=sql_fields($rinvsrc,"line_number");
					}					
					if(strlen($s2)){
						$sql=$s.$s2.$s3; 
						$this->db->query($sql);
						if($line_number==0){
							$line_number=$this->db->insert_id();
						}						
					}					
				}
				$sql="update $db_name.invoice_lineitems 
					set sourceautonumber='".$rinvsrc['line_number']."' where invoice_number='$invoice_number'  
					and line_number='$line_number' ";
				$this->db->query($sql);
				
				
			}
				
		}
		return true;				
	}

	function invoice_payments($invoice_number,$db_name){
		$db_src="";
		if($this->source_db!="")$db_src=$this->source_db.".";
		$s="delete from ".$db_name."payments where invoice_number='$invoice_number'";
		
		$s="select * from ".$db_src."payments where invoice_number='$invoice_number' ";
		if($qinvsrc=$this->db->query($s)){
			foreach($qinvsrc->result_array() as $rinvsrc){
				$s="select * from $db_name.payments where invoice_number='$invoice_number' 
				and sourceautonumber='".$rinvsrc['line_number']."' ";
				$new=true;
				if($qinvtgt=$this->db->query($s)){
					$s3="";
					$line_number=0;
					if($qinvtgt->num_rows()){
						$rinvtgt=$qinvtgt->row();
						$line_number=$rinvtgt->line_number;
						$s="update $db_name.payments set ";
						$s3=" where invoice_number='$invoice_number' and line_number='$line_number' ";
						$s2=sql_fields($rinvsrc,"line_number");						
						$new=false;
					} else {
						$s="insert into $db_name.payments set ";
						$s2=sql_fields($rinvsrc,"line_number");
					}					
					if(strlen($s2)){
						$sql=$s.$s2.$s3; 
						$this->db->query($sql);
						if($line_number==0){
							$line_number=$this->db->insert_id();
						}						
					}					
				}
				$sql="update $db_name.payments 
					set sourceautonumber='".$rinvsrc['line_number']."' where invoice_number='$invoice_number' and line_number='$line_number' ";
				$this->db->query($sql);
				
				
			}
				
		}
		return true;				
	}	
	
		function purchase_order(){
			
			if( !$db=db_names("po") ) return false;
		    $potype=getvar("PoType","O");

			$purchase_order_number="";
			$po_date=date("Y-m-d H:i:s");
			$sql="select purchase_order_number,po_date from purchase_order 
				where potype='$potype' and (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$purchase_order_number=$rinv->purchase_order_number;
					$po_date=$rinv->po_date;
				}
			}
			if($purchase_order_number=="") return false;
	
			$first  = new DateTime( $invoice_date );
			$second = new DateTime( date("Y-m-d H:i:s") );
	
			$diff = $first->diff( $second );

		$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) return false;
			
			$sql="update purchase_order set update_status=1 where purchase_order_number='$purchase_order_number' ";
			$this->db->query($sql);
			$this->message.="\r po($purchase_order_number), ";
			
			for($i=0;$i<count($db);$i++){
				$this->purchase_header($purchase_order_number,$db[$i]);
				$this->purchase_lineitems($purchase_order_number,$db[$i]);
			}			
			return true;
		}
		function purchase_header($purchase_order_number,$db_name){
			$s="select * from purchase_order where purchase_order_number='$purchase_order_number' ";
			if($qinvsrc=$this->db->query($s)){
				if($rinvsrc=$qinvsrc->row()){
					$rinvsrc_data=(array)$rinvsrc;
					$s="select * from $db_name.purchase_order where purchase_order_number='$purchase_order_number'";
					if($qinvtgt=$this->db->query($s)){
						$s3="";
						if($qinvtgt->num_rows()){
							$s="update $db_name.purchase_order set ";
							$s3=" where purchase_order_number='$purchase_order_number' ";
							$s2=sql_fields($rinvsrc,"purchase_order_number");						
						} else {
							$s="insert into $db_name.purchase_order set ";
							$s2=sql_fields($rinvsrc);
						}
						if(strlen($s2)){
							$sql=$s.$s2.$s3; 
							@$this->db->query($sql);
						}						
					}
				}			
			}
			return true;
		}
		function purchase_lineitems($purchase_order_number,$db_name){
			$s="select * from purchase_order_lineitems where purchase_order_number='$purchase_order_number' ";
			if($qinvsrc=$this->db->query($s)){
				foreach($qinvsrc->result_array() as $rinvsrc){
					$s="select * from $db_name.purchase_order_lineitems where purchase_order_number='$purchase_order_number' 
					and sourceautonumber='".$rinvsrc['line_number']."' ";
					$new=true;				
					if($qinvtgt=$this->db->query($s)){
						$s3="";
						$line_number=0;
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
							$line_number=$rinvtgt->line_number;
							
							$s="update $db_name.purchase_order_lineitems set ";
							$s3=" where purchase_order_number='$purchase_order_number' and line_number='$line_number' ";
							$s2=sql_fields($rinvsrc,"line_number");						
							$new=false;
						} else {
							$s="insert into $db_name.purchase_order_lineitems set ";
							$s2=sql_fields($rinvsrc,"line_number");
						}					
						if(strlen($s2)){
							$sql=$s.$s2.$s3; 
							$this->db->query($sql);
							if($line_number==0){
								$line_number=$this->db->insert_id();
							}						
						}					
					}
					$sql="update $db_name.purchase_order_lineitems 
						set sourceautonumber='".$rinvsrc['line_number']."' where line_number='$line_number' ";
					$this->db->query($sql);
				}
					
			}
			return true;	
		}
		function purchase_payments($purchase_order_number,$db_name){
			$s="select * from payables_payments where purchase_order_number='$purchase_order_number' ";
			if($qinvsrc=$this->db->query($s)){
				foreach($qinvsrc->result_array() as $rinvsrc){
					$s="select * from $db_name.payables_payments where purchase_order_number='$purchase_order_number' 
					and sourceautonumber='".$rinvsrc['line_number']."' ";
					$new=true;
					if($qinvtgt=$this->db->query($s)){
						$s3="";
						$line_number=0;
						if($qinvtgt->num_rows()){
							$rinvtgt=$qinvtgt->row();
							$line_number=$rinvtgt->line_number;
							$s="update $db_name.payables_payments set ";
							$s3=" where purchase_order_number='$purchase_order_number' and line_number='$line_number' ";
							$new=false;
						} else {
							$s="insert into $db_name.payments set ";
						}					
						$s2=sql_fields($rinvsrc,"line_number");
						if(strlen($s2)){
							$sql=$s.$s2.$s3; 
							$this->db->query($sql);
							if($line_number==0){
								$line_number=$this->db->insert_id();
							}						
						}					
					}
					$sql="update $db_name.payables_payments 
						set sourceautonumber='".$rinvsrc['line_number']."' 
						where purchase_order_number='$purchase_order_number' and line_number='$line_number' ";
					$this->db->query($sql);
				}
			}
			return true;				
		}
		function beli(){
			if( !$db=db_names("beli") ) return false;
			
			$purchase_order_number="";
			$po_date=date("Y-m-d H:i:s");
			$sql="select purchase_order_number,po_date from purchase_order 
				where potype='I' and (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$purchase_order_number=$rinv->purchase_order_number;
					$po_date=$rinv->po_date;
				}
			}
			if($purchase_order_number=="") return false;
	
			$first  = new DateTime( $invoice_date );
			$second = new DateTime( date("Y-m-d H:i:s") );
	
			$diff = $first->diff( $second );
			
			
		$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) return false;
			
			$sql="update purchase_order set update_status=1 where purchase_order_number='$purchase_order_number' ";
			$this->db->query($sql);
			$this->message.="\r beli($purchase_order_number),";
			
			for($i=0;$i<count($db);$i++){
				$this->purchase_header($purchase_order_number,$db[$i]);
				$this->purchase_lineitems($purchase_order_number,$db[$i]);
				$this->purchase_payments($purchase_order_number,$db[$i]);
			}			
			return true;
						
		}
		function retur_beli(){
				
			if( !$db=db_names("retur_beli") ) return false;
			
			$purchase_order_number="";
			$po_date=date("Y-m-d H:i:s");
			$sql="select purchase_order_number,po_date from purchase_order 
				where potype='R' and (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$purchase_order_number=$rinv->purchase_order_number;
					$po_date=$rinv->po_date;
				}
			}
			if($purchase_order_number=="") return false;
	
			$first  = new DateTime( $invoice_date );
			$second = new DateTime( date("Y-m-d H:i:s") );
	
			$diff = $first->diff( $second );
	
			$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) return false;

		
			$sql="update purchase_order set update_status=1 where purchase_order_number='$purchase_order_number' ";
			$this->db->query($sql);
			$this->message.="\r retur_beli($purchase_order_number)";
			
			for($i=0;$i<count($db);$i++){
				$this->purchase_header($purchase_order_number,$db[$i]);
				$this->purchase_lineitems($purchase_order_number,$db[$i]);
				$this->purchase_payments($purchase_order_number,$db[$i]);
			}			
			return true;
		}
		function payment_beli(){
			
		}
		function crdb_beli(){
			
		}
		function sales_order(){
			
			if( !$db=db_names("so") ) return false;
			
			$sales_order_number="";
			$sales_order_date=date("Y-m-d H:i:s");
			$sql="select sales_order_number,sales_date from sales_order 
				where (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$sales_order_number=$rinv->sales_order_number;
					$sales_date=$rinv->sales_date;
				}
			}
			if($sales_order_number=="") return false;
	
			$first  = new DateTime( $invoice_date );
			$second = new DateTime( date("Y-m-d H:i:s") );
	
			$diff = $first->diff( $second );

					$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) return false;

			
			$sql="update sales_order set update_status=1 where sales_order_number='$sales_order_number' ";
			$this->db->query($sql);
			$this->message.="\r so($sales_order_number),";
			
			for($i=0;$i<count($db);$i++){
				$this->so_header($sales_order_number,$db[$i]);
				$this->so_lineitems($sales_order_number,$db[$i]);
				$this->so_payments($sales_order_number,$db[$i]);
			}
			return true;			
		}
		function so_header($sales_order_number,$db_name){
			$s="select * from sales_order where sales_order_number='$sales_order_number' ";
			if($qinvsrc=$this->db->query($s)){
				if($rinvsrc=$qinvsrc->row()){
					$rinvsrc_data=(array)$rinvsrc;
					$s="select * from $db_name.sales_order where sales_order_number='$sales_order_number'";
					if($qinvtgt=$this->db->query($s)){
						$s3="";
						if($qinvtgt->num_rows()){
							$s="update $db_name.sales_order set ";
							$s3=" where sales_order_number='$sales_order_number' ";
							$s2=sql_fields($rinvsrc,"sales_order_number");						
						} else {
							$s="insert into $db_name.sales_order set ";
							$s2=sql_fields($rinvsrc);
						}
						if(strlen($s2)){
							$sql=$s.$s2.$s3; 
							@$this->db->query($sql);
						}
						
					}
				}
			}
			return true;				
		}
		function so_lineitems($sales_order_number,$db_name){
		
			$s="select * from sales_order_lineitems where sales_order_number='$sales_order_number' ";
			if($qinvsrc=$this->db->query($s)){
				foreach($qinvsrc->result_array() as $rinvsrc){
					$s="select * from $db_name.sales_order_lineitems where sales_order_number='$sales_order_number' 
					and sourceautonumber='".$rinvsrc['line_number']."' ";
					$new=true;				
					if($qinvtgt=$this->db->query($s)){
						$s3="";
						$line_number=0;
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
							$line_number=$rinvtgt->line_number;
							$s="update $db_name.sales_order_lineitems set ";
							$s3=" where sales_order_number='$sales_order_number' and line_number='$line_number' ";
							$new=false;
						} else {
							$s="insert into $db_name.invoice_lineitems set ";
						}					
						$s2=sql_fields($rinvsrc,"line_number");
						if(strlen($s2)){
							$sql=$s.$s2.$s3; 
							$this->db->query($sql);
							if($line_number==0){
								$line_number=$this->db->insert_id();
							}						
						}					
					}
					$sql="update $db_name.sales_order_lineitems 
						set sourceautonumber='".$rinvsrc['line_number']."' where sales_order_number='$sales_order_number' 
						and line_number='$line_number' ";
					$this->db->query($sql);
				}
			}
			return true;			
		}
		function so_payments($sales_order_number,$db_name){

			$s="select * from payments where invoice_number='$sales_order_number' ";
			if($qinvsrc=$this->db->query($s)){
				foreach($qinvsrc->result_array() as $rinvsrc){
					$s="select * from $db_name.payments where invoice_number='$sales_number' 
					and sourceautonumber='".$rinvsrc['line_number']."' ";
					$new=true;
					if($qinvtgt=$this->db->query($s)){
						$s3="";
						$line_number=0;
						if($qinvtgt->num_rows()){
							$rinvtgt=$qinvtgt->row();
							$line_number=$rinvtgt->line_number;
							$s="update $db_name.payments set ";
							$s3=" where invoice_number='$sales_order_number' and line_number='$line_number' ";
							$new=false;
						} else {
							$s="insert into $db_name.payments set ";
						}					
						$s2=sql_fields($rinvsrc,"line_number");						
						if(strlen($s2)){
							$sql=$s.$s2.$s3; 
							$this->db->query($sql);
							if($line_number==0){
								$line_number=$this->db->insert_id();
							}						
						}					
					}
					$sql="update $db_name.payments 
						set sourceautonumber='".$rinvsrc['line_number']."' where invoice_number='$sales_order_number' 
						and line_number='$line_number' ";
					$this->db->query($sql);
				}
			}
			return true;			
		}
						
		function delivery_order(){
			
			if( !$db=db_names("do") ) return false;
			
			$invoice_number="";
			$invoice_date=date("Y-m-d H:i:s");
			$sql="select invoice_number,invoice_date from invoice 
				where invoice_type='D' and (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$invoice_number=$rinv->invoice_number;
					$invoice_date=$rinv->invoice_date;
				}
			}
			if($invoice_number=="") return false;
	
			$first  = new DateTime( $invoice_date );
			$second = new DateTime( date("Y-m-d H:i:s") );
			$diff = $first->diff( $second );
	

		$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) return false;

					$this->message.="\r do($invoice_number),";
			
			$sql="update invoice set update_status=1 where invoice_number='$invoice_number' ";
			$this->db->query($sql);
			
			for($i=0;$i<count($db);$i++){
				$this->invoice_header($invoice_number,$db[$i]);
				$this->invoice_lineitems($invoice_number,$db[$i]);
			}
			return true;			
		}
		function retur_jual(){
			if( !$db=db_names("retur_jual") ) return false;
			
			$invoice_number="";
			$invoice_date=date("Y-m-d H:i:s");
			$sql="select invoice_number,invoice_date from invoice 
				where invoice_type='R' and (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$invoice_number=$rinv->invoice_number;
					$invoice_date=$rinv->invoice_date;
				}
			}
			if($invoice_number=="") return false;
	
			$first  = new DateTime( $invoice_date );
			$second = new DateTime( date("Y-m-d H:i:s") );
	
			$diff = $first->diff( $second );
	
			$minutes = $diff->days * 24 * 60;
		$minutes += $diff->h * 60;
		$minutes += $diff->i;

//		echo "$invoice_date, minutes: $minutes";
		
		if($minutes < 15) return false;
		
			$sql="update invoice set update_status=1 where invoice_number='$invoice_number' ";
			$this->db->query($sql);
			$this->message.="\r retur_jual($invoice_number),";
			
			for($i=0;$i<count($db);$i++){
				$this->invoice_header($invoice_number,$db[$i]);
				$this->invoice_lineitems($invoice_number,$db[$i]);
			}			
			return true;
		}
		function payment_jual(){
			
		}
		function crdb_jual(){
			
		}
		function recv_po(){
			$this->inventory_products_model->replicate("PO","recv_po");
		}
		function recv_etc(){
			$this->inventory_products_model->replicate("ETC_IN","recv_etc");			
		}
		function delivery_etc(){
			$this->inventory_products_model->replicate("ETC_OUT","do_etc");
		}
		function stock_adjust(){
			
		}
		
		function jurnal(){
			
		}
		
        
		//$customer_number=$this->customer_model->next_customer_recalc();
		function customer(){
			if(!$db=db_names("customer"))	return false;
			
			$customer_number="";
			$sql="select customer_number from customers 
				where  (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$customer_number=$rinv->invoice_number;
				}
			}
			$sql="update customers set update_status=1 where customer_number='$customer_number' ";
			$this->db->query($sql);
			$this->message.="\r customer($customer_number),";
			
			$this->customers($customer_number);
			
			return true;			
		}
		
		//$supplier_number=$this->supplier_model->next_supplier_recalc();
		function supplier(){
			
			if(!$db=db_names("suppliers"))	return false;
			
			$supplier_number="";
			$sql="select supplier_number from customers 
				where  (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$supplier_number=$rinv->supplier_number;
				}
			}
			$sql="update suppliers set update_status=1 where supplier_number='$supplier_number' ";
			$this->db->query($sql);
			$this->message.="\r supplier($supplier_number),";
						
			$this->suppliers($supplier_number);
			
			return true;						
		}
		
		//$bank_number=$this->bank_accounts_model->next_bank_recalc();
		function bank(){

			if(!$db=db_names("bank"))	return false;
			
			$bank_account_number="";
			$sql="select bank_account_number from bank_accounts 
				where  (update_status=0 or update_status is null) 
				limit 1";
			if($qinv=$this->db->query($sql)){
				if($rinv=$qinv->row()){
					$bank_account_number=$rinv->bank_account_number;
				}
			}
			$sql="update bank_accounts set update_status=1 where bank_account_number='$bank_account_number' ";
			$this->db->query($sql);
			$this->message.="\r bank($bank_account_number),";
			
			for($i=0;$i<count($db);$i++){
				$dbnames=$db[$i];
				if($qs=$this->db->where("bank_account_number",$bank_account_number)->get("bank_accounts")){
					if($data_src=(array)$qs->row()){
						$s2="";
						$s="select bank_account_number from $dbname.bank_accounts 
							where bank_account_number='$bank_account_number'";
						if($qt=$this->db->query($s)){
							$s3="";
							if($qt->num_rows()){
								$s="update $dbname.bank_accounts set ";
								$s3=" where bank_account_number='$bank_account_number' ";
								$s2=sql_fields($data_src,"bank_account_number");
							} else {
								$s="insert into $dbname.bank_accounts set ";
								$s2=sql_fields($data_src);
							}
							if(strlen($s2)){
								$sql=$s.$s2.$s3; 
								@$this->db->query($sql);
							}
							
						}
					}
				}
			}
			return true;		
						
		}
	

}
