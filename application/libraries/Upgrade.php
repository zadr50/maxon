<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade
 {
 	private $display_output=false;
	private $message="";
	
 function __construct()
 {
	$this->CI =& get_instance();	 
     
 }
 function process($display_output_var=false){
 		
 	$this->display_output=$display_output_var;
		$db=current_database();
		$this->message= "<p><b>Checking database struktur [$db]</b></p>";
	
	$key="Flag sysvar varsize";
 //   echo $key." - ".$this->CI->sysvar->getvar($key);
    
	if(""==$this->CI->sysvar->getvar($key) ){
	    		
		$this->CI->sysvar->insert($key,"1",$key);
        //$this->CI->db->insert("system_variables",array("varname"=>$key,"varvalue"=>1,"keterangan"=>$key));
        
		$s="delete from system_variables where varname like 'Flag [%';";
		$this->CI->db->query($s);
		
		$s="ALTER TABLE `system_variables`
			CHANGE COLUMN `varname` `varname` VARCHAR(250) NULL 
			DEFAULT NULL COLLATE 'utf8_general_ci' FIRST;";
			
		$this->CI->db->query($s);
		
		$this->CI->sysvar->update($key,"1");			
        
        //$this->CI->db->query("delete from system_variables where varname='lookup.po_status'");
        //$this->CI->db->query("delete from system_variables where varname='lookup.po_type'");
        //$this->CI->db->query("delete from system_variables where varname='Flag [sysvar] add lookup.po_status'");
        //$this->CI->db->query("delete from system_variables where varname='Flag [sysvar] add lookup.po_type'");
        
	}
    //echo "exist $key";exit;       
	
	$this->add_field("sales_order","status"); 
	$this->add_field("invoice","status"); 
	$this->add_field("purchase_order","doc_status"); 
    $this->add_field("user", "supervisor");
	$this->add_field("user","branch_code"); 
	
	$this->add_field("salesman","lock_report","INT NOT NULL DEFAULT '0' ");
	$this->create_unit_of_measure();
	$this->create_inventory_price_customers();
	$this->user_roles();
	$this->add_field("inventory","division"); 
	$this->add_field("inventory_moving","status"); 
	$this->add_field("inventory_moving","verify_by"); 
	$this->add_field("inventory_moving","verify_date","DATETIME"); 
	$this->add_field("inventory_categories","sales_disc_prc","double"); 
	$this->add_field("customers","disc_min_qty","double"); 
	$this->add_field("customers","markup_amount","double"); 
	$this->add_field("customers","discount_amount","double"); 
	$this->add_field("customers","disc_prc_2","double"); 
	$this->add_field("customers","disc_prc_3","double"); 
	
	$this->add_field("inventory_price_customers","cust_no"); 
	$this->add_field("inventory_price_customers","category"); 
	$this->add_field("inventory_price_customers","disc_amount","double"); 
	$this->add_field("inventory_price_customers","disc_prc_2","double"); 
	$this->add_field("inventory_price_customers","disc_prc_3","double"); 


	$this->add_field("fa_asset_group","warranty_date","datetime"); 

	$this->create_com_list();
	
	$this->add_field("promosi_item","from_date","datetime"); 
	$this->add_field("promosi_item","to_date","datetime"); 
	$this->add_field("promosi_item","disc_prc_1","double"); 
	$this->add_field("promosi_item","disc_prc_2","double"); 
	$this->add_field("promosi_item","disc_prc_3","double"); 
	$this->add_field("promosi_item","disc_type","int"); 
	$this->add_field("promosi_item","min_qty","double"); 

	$key="Flag [hr_shift] change time_in,time_out";
	if(""==$this->CI->sysvar->getvar($key) ){		
		$this->CI->sysvar->insert($key,"1",$key);
		$s="ALTER TABLE `hr_shift`
			CHANGE COLUMN `time_in` `time_in` VARCHAR(50) NULL, 
			CHANGE COLUMN `time_out` `time_out` VARCHAR(50) NULL 
			DEFAULT NULL COLLATE 'utf8_general_ci' FIRST;";
			
		$this->CI->db->query($s);
			 
		$this->CI->sysvar->update($key,"1");	
	}

	$this->add_field("promosi_item","extra_items","nvarchar(250)"); 
	$this->add_field("promosi_item","item_type","nvarchar(50)"); 
	$this->add_field("syslog","no_bukti","nvarchar(50)"); 
	$this->add_field("syslog","id","INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id)"); 
	$this->add_field("syslog","jenis_cmd","nvarchar(50)"); 
            	   		
	$this->add_field("shipping_locations","no_urut","int"); 
	$this->add_field("user","flag1","int"); 
	$this->add_field("user","flag2","int"); 
	$this->add_field("user","flag3","int"); 
	$this->add_field("purchase_order","status","int"); 
	$this->add_field("invoice","status","int"); 

	$this->add_field("inventory_prices","cost","double"); 
	$this->create_po_qty_alloc();
	$this->add_field("purchase_order","po_expire_date","datetime"); 
	$this->create_payables_bill();

	$key="Flag [sysvar] add lookup.po_status";	
	$val=$this->CI->sysvar->getvar($key);
	if(""==$this->CI->sysvar->getvar($key) ){		
		//$this->CI->sysvar->insert($key,"1",$key);
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_status",
		//	"varvalue"=>"OPEN","keterangan"=>"OPEN"));
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_status",
		//	"varvalue"=>"CLOSE","keterangan"=>"CLOSE"));
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_status",
		//	"varvalue"=>"CANCELED","keterangan"=>"CANCELED"));
			
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_type",
		//	"varvalue"=>"KREDIT","keterangan"=>"KREDIT"));
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_type",
		//	"varvalue"=>"KONTAN","keterangan"=>"KONTAN"));
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_type",
		//	"varvalue"=>"KONSINYASI","keterangan"=>"KONSINYASI"));
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_type",
		//	"varvalue"=>"COUNTER","keterangan"=>"COUNTER"));
		//$this->CI->db->insert("system_variables",array("varname"=>"lookup.po_type",
		//	"varvalue"=>"SEMI KONSINYASI","keterangan"=>"SEMI KONSINYASI"));			
		//$this->CI->sysvar->update($key,"1");		
	}
	$this->add_field("inventory_products","doc_type"); 
	$this->add_field("inventory_moving","doc_type"); 
	$this->create_profit_sharing();
	$this->create_toko();
	$this->add_field('purchase_order_lineitems','line_type');
	$this->add_field('purchase_order_lineitems','line_status');
	$this->create_inventory_categories_sub();
	//(pkp,non_pkp) jenis_wp
	//cara bayar = (transfer,bg/cek,cash,spb)
	//sistim_bayar =  (putus,konsinas,counter,sewa)
	//partisipasi =  (hb,hj,lain2)
    $this->add_field("inventory","type_of_invoice"); 
    $fields=array("nomor_hp","penanggung_jawab","jabatan",
        "nama_pemilik","npwp","jenis_wp","no_telp2","fax2","hp2",
        "cara_bayar", "bank", "no_rek","sistim_bayar",
        "lain2","periode","partisipasi");   
    for($i=0;$i<count($fields);$i++){ 
        $this->add_field("suppliers",$fields[$i]);
    }
    $fields=array("alamat_pemilik","kota","email2","jenis_merk","atas_nama");
    for($i=0;$i<count($fields);$i++){ 
        $this->add_field("suppliers",$fields[$i],"varchar(200)");
    }
    $fields=array("margin_prc_min","margin_prc_max","termin_day","biaya_admin");   
    for($i=0;$i<count($fields);$i++){ 
        $this->add_field("suppliers",$fields[$i],"double");
    }
    $this->add_field("suppliers", "city2");
    $this->add_field("suppliers", "kode_pos2");
    $this->add_field("suppliers", "biaya_admin");
    $this->add_field("inventory","colour");
    $this->add_field("inventory","size");
    $this->add_field('purchase_order','req_no');
    $this->add_field('purchase_order','expire_day',"int");
    $this->add_field('purchase_order','contact_person');
    $this->add_field('inventory_products','ref1');
    $this->add_field('inventory_products','ref2');
    $this->add_field('inventory_products','ref3');
    $this->add_field('inventory_products','doc_status');
    $this->add_field('invoice_lineitems','no_urut',"int");
    $this->add_field('purchase_order_lineitems','no_urut',"int");
    $this->add_field('sales_order_lineitems','no_urut',"int");
    $this->add_field('inventory_products','no_urut',"int");
    $this->add_field('inventory_moving','no_urut',"int");
    $this->add_field('check_writer','doc_type');
    $this->add_field('check_writer','ref1');
    $this->add_field('check_writer','ref2');
    $this->add_field('check_writer','ref3');
    $this->add_field('check_writer','doc_status');
    $this->add_field('purchase_order_lineitems','margin','double');
    $this->add_field('purchase_order_lineitems','margin_real','double');
    $this->add_field('purchase_order_lineitems','retail_real','double');
    $this->add_field('inventory_products','doc_status');
    $this->add_field('maxon_inbox','doc_no');
    $this->add_field('maxon_inbox','doc_type');
    $this->add_field('promosi_item','member_group');
    $this->add_field('promosi_item','time_range');
    $this->add_field('promosi_item','extra_qty');
    $this->add_field('voucher_master','id');
    $this->add_field('voucher_master','promosi_code');
    $this->add_field('hr_leaves','doc_status');
    $this->add_field('gl_transactions','valid_by');
    $this->add_field('gl_transactions','valid_date','datetime');
    $this->add_field('gl_transactions','valid_status','int');
    $this->add_field('inventory','margin','double');
    $this->add_field('inventory','margin_real','double');
    $this->add_field('inventory','retail_real','double');
    $this->add_field('inventory','kode_lama');
    $this->add_field('employee','shift_group');
    $this->add_field('employee','is_resigned',"int");
    $this->add_field('employee','resigned_date','datetime');
    
    $this->create_item_need_update();            	
    $this->add_field("shipping_locations","parent_loc");
    $this->add_field("employee","location");
    $this->add_field("purchase_order","rekening");
    
    $this->create_po_expenses();
    
    $this->add_field("inventory_products","posted","int");
    $this->add_field("inventory_moving","posted","int");
    $this->add_field("payables_payments","ref1");
    $this->add_field("employee","sisa_cuti","int");
    $this->add_field("hr_leaves","doc_type");
    $this->add_field("bank_accounts","has_edc");
    $this->add_field("system_variables","coa1");
    $this->add_field("system_variables","coa2");
    $this->add_field("system_variables","coa3");
    $this->add_field("system_variables","coa4");
    $this->add_field("system_variables","coa5");
    
    $this->add_field("customers","tgl_tagih","int");
    $this->add_field('crdb_memo','prc_value','double');
    $this->add_field('inventory_beginning_balance','id','int');
    $this->add_field('invoice_lineitems','disc_amount_ex','double');
    $this->add_field("promosi_disc","nilai2","double");
    $this->add_field("promosi_disc","nilai3","double");
	
    $this->create_stock_proses_arsip();

    
    //hapus inventory_warehouse yg gudang blank
    $this->allways_runing();
    
    $this->add_field("purchase_order","ref1");
    $this->add_field("purchase_order","ref2");
    $this->add_field("purchase_order","ref3");
    $this->add_field("invoice","inv_amount","double");
    $this->add_field("payments","account_number");
    $this->add_field("check_writer_items","org_id");
    $this->add_field("inventory_products","cost_account","double");
    
    $this->add_field("user","session_id");
    $this->add_field("user","logged_in","int");         
    
    $this->create_type_of_vendor();

    $this->add_field('inventory_moving','mu_qty','double');
    $this->add_field('inventory_moving','multi_unit');
    $this->add_field('inventory_moving','mu_price','double');
    $this->add_field('inventory_moving','create_date','datetime');
    $this->add_field('inventory_moving','create_by');
    $this->add_field('inventory_moving','update_date','datetime');
    $this->add_field('inventory_moving','update_by');
    $this->add_field('inventory_moving','cost_account');
	$this->add_field("salesman","wilayah");
	
	$this->create_salesman_target();
	
    $this->create_hr_pph21_form();
    $this->create_employee_pph();
        
    $this->add_field("inventory_categories","inventory_account","int");
    $this->add_field("inventory_categories","cogs_account","int");

    $this->create_table_hr_emp_loan_schedule();
    $this->add_index("time_card_detail","id");
    $this->add_index("time_card_detail","nip");
    $this->add_index("time_card_detail","tanggal");
    $this->add_index("time_card_detail","salary_no");
    $this->add_index("overtime_detail","id");
    $this->add_index("overtime_detail","nip");
    $this->add_index("overtime_detail","tanggal");
                	
                    
    $this->add_field("inventory_categories","sales_account","int");
    $this->add_field("inventory_categories","tax_account","int");

    $this->add_field("inventory_prices","id","INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id)"); 
    $this->add_field("inventory_prices","qty_last","double"); 
    $this->add_field("inventory_prices","calc_date","datetime");
    $this->add_field("inventory_prices","create_date","datetime");
    $this->add_field("inventory_prices","create_by");
    $this->add_field("inventory_prices","update_date","datetime");
    $this->add_field("inventory_prices","update_by");
    $this->add_field("inventory_prices","warehouse_code");
    
    $this->add_field("bill_header", "paid","int");
    $this->add_field("bill_header","termin");
    $this->add_field("bill_detail","saldo","double");
    $this->add_field("bill_detail","create_by");
    $this->add_field("bill_detail","create_date","datetime");
    $this->add_field("bill_detail","update_by");
    $this->add_field("bill_detail","update_date","datetime");
                            
	$this->create_view_qs_stock_unit();						
	$this->create_bill_header_collector();
	                          
	$this->add_field("payments","doc_status","int");
	$this->add_field("payables_payments","doc_status","int");
	$this->add_field("purchase_order","branch_code");
	$this->add_field("purchase_order","dept_code");
	$this->add_field("purchase_order","project_code");
	$this->add_field("system_variables","plus_minus");
	$this->add_field("inventory_categories","sales_target","double");
	$this->add_field("inventory_products","description","varchar(250)");
	$this->add_field("shipping_locations", "default_gudang","int");
	$this->add_field("employeemedical","amount","double");
	
	$this->add_field("inventory","closing_status","int");
	$this->add_field("inventory_beg_bal_gudang","qty_awal_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_akhir_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_po_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_beli_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_retur_beli_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_recv_po_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_recv_etc_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_so_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_do_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_jual_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_retur_jual_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_delivery_etc_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_adjust_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_mutasi_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_work_order_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_finish_good_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_recv_material_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_material_used_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_recv_toko_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_retur_toko_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_roling_masuk_amt","double");			
	$this->add_field("inventory_beg_bal_gudang","qty_roling_keluar_amt","double");		
	$this->add_field("inventory_beg_bal_gudang","qty_adjust_hilang_amt","double");			

	$this->create_item_need_update_arsip();
	$this->add_field("crdb_memo","cust_supp");		                                                        
	$this->add_field("payables_bill_detail","row_type");		                                                        
	$this->add_field("bill_detail","row_type");			        
	                                                

	$this->create_zzz_customer_need_update();
	$this->create_zzz_supplier_need_update();
	$this->create_zzz_rekening_need_update();
			                                                        
	$this->add_field("suppliers","current_balance","double");															
									
	$this->add_field("hr_paycheck_sal_comp","manual","int");															
																		
	$s="insert into zzz_item_need_update(item_no) select i.item_number
		from inventory i join (select item_number,sum(qty_masuk-qty_keluar) as qty_stock
		from qry_kartustock_union group by item_number) as q  on q.item_number=i.item_number
		where abs(q.qty_stock-i.quantity_in_stock)>0.5";
		
	$this->CI->db->query($s);
											
																
	$this->create_zzz_jurnal_error();
	
	$this->create_ticket_sales();
	$this->add_field("ticket_sales","bayar","double");
	$this->add_field("ticket_sales","kembali","double");
	$this->add_field("ticket_sales","posted","int");

    $this->add_field("suppliers", "show_only_item","int");
	$this->add_field("purchase_order","doc_type");
	
	$this->add_field("service_order", "masalah","varchar(500)");
	$this->add_field("service_order","jenis_masalah");
	$this->add_field("service_order","transportasi");
	
	$key="Flag [service_order] comments change";
    
    if(""==$this->CI->sysvar->getvar($key) ){       
        $s="alter table service_order modify comments varchar(500)";
        $this->CI->db->query($s);
        $this->CI->sysvar->insert($key,"1","auto");
    }
	
	$this->add_field("suppliers","jenis_partisipasi");
		
	$this->add_field("crdb_memo","doc_type");
    $this->add_field("crdb_memo","outlet");
    $this->add_field("inventory_moving","ref1","varchar(250)");
    $this->add_field("inventory_moving","ref2","varchar(250)");
    $this->add_field("inventory_moving","ref3","varchar(250)");
    $this->add_field("inventory_products","trans_type");
    $this->add_field("inventory","item_picture2","varchar(250)");
    $this->add_field("inventory","item_picture3","varchar(250)");
    $this->add_field("inventory","item_picture4","varchar(250)");
    	
    if($this->display_output){
    	$this->message.="<br>FINISH";
    	return $this->message;
    }           
    
 }
	function create_ticket_sales(){
		$fields[]="ticket_no nvarchar(50)";
		$fields[]="user_id nvarchar(50)";
        $fields[]="tanggal datetime";
		$fields[]="qty_ticket int";
		$fields[]="qty_card int";
		$fields[]="price double";
		$fields[]="disc_prc float";
		$fields[]="disc_amt double";
		$fields[]="netto double";
		$fields[]="how_type nvarchar(50)";
		$fields[]="cust_no nvarchar(50)";
		$fields[]="cust_name nvarchar(250)";
		$fields[]="com_prc float";
		$fields[]="com_amt double";
		$fields[]="edc nvarchar(250)";
		$fields[]="how_paid nvarchar(50)";
		$fields[]="ticket_type nvarchar(50)";		
        $fields[]="keterangan nvarchar(250)";                
        $this->create_table("ticket_sales",$fields);		
	}
	function create_zzz_jurnal_error(){
        $fields[]="gl_id nvarchar(50)";
        $fields[]="tanggal datetime";
        $fields[]="error_message nvarchar(250)";                
        $this->create_table("zzz_jurnal_error",$fields);		
	}

	function create_zzz_supplier_need_update(){
        $fields[]="supp_no nvarchar(50)";
        $fields[]="tanggal datetime";
        $fields[]="gudang nvarchar(50)";                
        $this->create_table("zzz_supplier_need_update",$fields);		
	}
 	function create_zzz_rekening_need_update(){
        $fields[]="rek_no nvarchar(50)";
        $fields[]="tanggal datetime";
        $fields[]="gudang nvarchar(50)";                
        $this->create_table("zzz_rekening_need_update",$fields);		
	}
 	function create_zzz_customer_need_update(){
        $fields[]="cust_no nvarchar(50)";
        $fields[]="tanggal datetime";
        $fields[]="gudang nvarchar(50)";                
        $this->create_table("zzz_customer_need_update",$fields);		
	}
 	function create_item_need_update_arsip(){
        $fields[]="item_no nvarchar(50)";
        $fields[]="tanggal datetime";
        $fields[]="gudang nvarchar(50)";                
        $this->create_table("zzz_item_need_update_arsip",$fields);		
	}
 
function create_view_qs_stock_unit(){                            
                            
    $sql="create view qs_stock_unit as 
    select `ip`.`item_number`,`ip`.`unit`,sum(`ip`.`quantity_received`) AS `qty`,
    `ip`.`receipt_type` AS `tran_type` from (`inventory_products` `ip` 
    left join `inventory` `s` on ( (`s`.`item_number` = `ip`.`item_number`))) 
    where (`ip`.`unit` <> `s`.`unit_of_measure`) 
    group by `ip`.`item_number`,`ip`.`unit`,`ip`.`receipt_type` 
    union all 
    select `il`.`item_number` AS `item_number`,`il`.`unit` AS `unit`,
    sum((-(1) * `il`.`quantity`)) AS `qty`,`i`.`invoice_type` AS `invoice_type` 
    from ((`invoice_lineitems` `il` left join `invoice` `i` 
    on ((`i`.`invoice_number` = `il`.`invoice_number`))) 
    left join `inventory` `s` on ((`s`.`item_number` = `il`.`item_number`))) 
    where (`il`.`unit` <> `s`.`unit_of_measure`) 
    group by `il`.`item_number`,`il`.`unit`,`i`.`invoice_type`";
                            
    $this->create_view("qs_stock_unit",$sql);
 	
 	
}
	function create_bill_header_collector(){
        $fields[]="bill_id nvarchar(50)";
        $fields[]="bill_date datetime";
        $fields[]="amount double";
        $fields[]="comments nvarchar(250)";
        $fields[]="collector nvarchar(150)";        
	 	$fields[]="create_by varchar(50)";
	 	$fields[]="create_date datetime";
	 	$fields[]="update_by varchar(50)";
	 	$fields[]="update_date datetime";
                
        $this->create_table("bill_header_collector",$fields);
        
        $fields2[]="bill_id nvarchar(50)";
        $fields2[]="invoice_number nvarchar(50)";
        $fields2[]="invoice_date datetime";
        $fields2[]="amount double";
        $fields2[]="saldo double";
        $fields2[]="comments nvarchar(250)";
        $fields2[]="no_urut int";
        $fields2[]="n_giro int";
        $fields2[]="t_giro double";
        $fields2[]="k_giro double";
        $fields2[]="no_giro nvarchar(50)";
        $fields2[]="jumlah_giro double";
        $fields2[]="jumlah_cash double";
	 	$fields2[]="create_by varchar(50)";
	 	$fields2[]="create_date datetime";
	 	$fields2[]="update_by varchar(50)";
	 	$fields2[]="update_date datetime";
                                
        
        $this->create_table("bill_detail_collector",$fields2);
                
	}
    function create_view($view_name,$sql){
        $key="Flag [$view_name] add view";
		if($this->display_output){
			$this->message.="<br>$key";
		}
        
        if(""==$this->CI->sysvar->getvar($key) ){       
            $this->CI->sysvar->insert($key,"1",$key);
            $this->CI->db->query($sql);
        }
    }
 
    function create_table_hr_emp_loan_schedule(){
        $fields[]="loan_number nvarchar(50)";
        $fields[]="no_urut int";
        $fields[]="tanggal_jth_tempo datetime";
        $fields[]="awal double";
        $fields[]="pokok double";
        $fields[]="bunga double";
        $fields[]="angsuran double";
        $fields[]="akhir double";
        $fields[]="payment_no nvarchar(50)";
        $fields[]="comments nvarchar(250)";
        $fields[]="keterangan nvarchar(250)";
        
        $this->create_table("hr_emp_loan_schedule",$fields);
    }


    function create_hr_pph21_form(){
        $fields[]='kelompok varchar(50)';
        $fields[]='nomor int';
        $fields[]='keterangan varchar(500)';
        $fields[]='jumlah double';
        $fields[]='header int';
        $fields[]='rumus varchar(250)';
        $fields[]='template varchar(250)';
        $this->create_table("hr_pph_form", $fields);        
    }
    function create_employee_pph(){
        $fields[]='nip varchar(50)';
        $fields[]='nomor int';
        $fields[]='jumlah double';
        $fields[]='tahun int';
        $fields[]='bulan int';
        $this->create_table("employee_pph", $fields);        
    }


  	function create_salesman_target(){
        $e[]="period_id varchar(50)";
        $e[]="salesman_id varchar(50)";
        $e[]="category_id varchar(50)";
        $e[]="region_id varchar(50)";
        $e[]="sales_target double";
        $e[]="sales_real double";                
        $this->create_table("salesman_target",$e);            
 		
 	}
 
 
 	function create_type_of_vendor(){
        $e[]="type_id varchar(50)";
        $e[]="type_name varchar(200)";
        $this->create_table("type_of_vendor",$e);            
 		
 	}
    function create_stock_proses_arsip(){
        $e[]="item_no varchar(50)";
        $e[]="year_arc int";
        $e[]="month_arc int";
        $this->create_table("zzz_stock_arsip",$e);            
        
        $f[]="item_number varchar(50)";
        $f[]="tanggal datetime";
        $f[]="gudang varchar(50)";
        $f[]='cost double';
        $f[]='retail double';
                
        $f[]='qty_awal double';
        $f[]='qty_akhir double';
                
        $f[]='qty_po double';
        $f[]='qty_beli double';
        $f[]='qty_retur_beli double';
        $f[]='qty_recv_po double';
        $f[]='qty_recv_etc double';
        
        $f[]='qty_so double';
        $f[]='qty_do double';
        $f[]='qty_jual double';
        $f[]='qty_retur_jual double';
        $f[]='qty_delivery_etc double';

        $f[]='qty_adjust double';
        $f[]='qty_mutasi double';
        
        $f[]='qty_work_order double';
        $f[]='qty_finish_good double';
        $f[]='qty_recv_material double';
        $f[]='qty_material_used double';
                
        $f[]='qty_recv_toko double';
        $f[]='qty_retur_toko double';
        $f[]='qty_roling_masuk double';
        $f[]='qty_roling_keluar double';
        $f[]='qty_adjust_hilang double';
        
        
        $this->create_table("inventory_beg_bal_gudang",$f);            
        
    }

    
function allways_runing(){
        
    $this->CI->db->query("delete from inventory_warehouse 
        where (warehouse_code is null or warehouse_code='' or quantity=0)");
    
}
    function create_po_expenses(){
        $f[]="purchase_order_number varchar(50)";
        $f[]="item_no varchar(50)";
        $f[]="item_desc varchar(200)";
        $f[]="amount double";
        $f[]='calc_method int';
        $f[]='qty double';
        $f[]='price double';
        $this->create_table("purchase_order_expenses",$f);    
            
    }


    function create_item_need_update(){
        $f[]="item_no varchar(50)";
        $f[]="item_desc varchar(100)";
        $this->create_table("zzz_item_need_update",$f);    
            
    }
function create_inventory_categories_sub(){
 	$fields[]="kode varchar(50)";
 	$fields[]="category varchar(150)";
 	$fields[]="parent_id varchar(50)";
 	$this->create_table("inventory_categories_sub",$fields);
}
 function create_toko(){
 	$fields[]="code varchar(50)";
 	$fields[]="code_company varchar(50)";
 	$fields[]="toko_name varchar(250)";
 	$fields[]="profit_prc real";
 	$fields[]="date_from datetime";
 	$fields[]="date_to datetime";
 	$fields[]="remarks varchar(250)";
 	$fields[]="address varchar(250)";
 	$fields[]="contact varchar(150)";
 	$fields[]="phone varchar(50)";
 	$fields[]="fax varchar(50)";
 	$fields[]="email varchar(250)";
 	$this->create_table("toko_master",$fields);
}
   function create_profit_sharing(){
 	$fields[]="type_code varchar(50)";
 	$fields[]="item_no varchar(50)";
 	$fields[]="item_name varchar(250)";
 	$fields[]="profit_prc real";
 	$fields[]="date_from datetime";
 	$fields[]="date_to datetime";
 	$fields[]="remarks varchar(250)";
	$this->create_table("profit_sharing",$fields);

   }
  function create_payables_bill(){
 	$fields[]="nomor varchar(50)";
 	$fields[]="supplier_number varchar(50)";
 	$fields[]="termin varchar(50)";
 	$fields[]="tanggal datetime";
 	$fields[]="tgl_jth_tempo datetime";
 	$fields[]="catatan varchar(250)";
 	$fields[]="curr_code varchar(50)";
 	$fields[]="curr_rate double";
 	$fields[]="amount double";
 	$fields[]="paid int";
 	$fields[]="create_by varchar(50)";
 	$fields[]="create_date datetime";
 	$fields[]="update_by varchar(50)";
 	$fields[]="update_date datetime";
	$this->create_table("payables_bill_header",$fields);
 	$fields2[]="nomor varchar(50)";
 	$fields2[]="faktur varchar(50)";
 	$fields2[]="tanggal datetime";
 	$fields2[]="jumlah double";
 	$fields2[]="saldo double";
 	$fields2[]="create_by varchar(50)";
 	$fields2[]="create_date datetime";
 	$fields2[]="update_by varchar(50)";
 	$fields2[]="update_date datetime";
	$this->create_table("payables_bill_detail",$fields2);
	
  }
  function create_po_qty_alloc(){
 	$fields[]="wh_code varchar(50)";
 	$fields[]="qty double";
 	$fields[]="line_id_po double";
	$this->create_table("po_qty_alloc",$fields);
}
 function create_com_list(){
 	$fields[]="com_code varchar(50)";
 	$fields[]="com_db_name varchar(50)";
 	$fields[]="com_url varchar(150)";
 	$fields[]="com_short_desc varchar(250)";
 	$fields[]="com_long_desc varchar(550)";
 	$fields[]="com_logo varchar(150)";
	$this->create_table("com_list",$fields);
}
	   
 function user_roles(){
 	$fields[]="user_id varchar(50)";
	$fields[]="roles_type varchar(50)";
	$fields[]="roles_item varchar(50)";
	$fields[]="roles_value1 double";
	$fields[]="roles_value2 double";
	$fields[]="description varchar(250)";
	$this->create_table("user_roles",$fields);
 }
 function create_inventory_price_customers()
 {
	$fields[]="item_no varchar(50)";
	$fields[]="cust_type varchar(50)";
	$fields[]="sales_price double";
	$fields[]="disc_prc_from double";
	$fields[]="min_qty double";
	$fields[]="disc_prc_to double";
	$fields[]="description varchar(200)";
	$this->create_table("inventory_price_customers",$fields);
 }
 function create_unit_of_measure(){
 	$fields[]="from_unit varchar(50)";
	$fields[]="to_unit varchar(50)";
	$fields[]="unit_value double";
	$this->create_table("unit_of_measure",$fields);
 }
 function create_table($table,$fields)
 {
 	
	$key="Flag [$table] add table";
	if($this->display_output){
		$this->message.="<br>$key";
	}
		
	if(""==$this->CI->sysvar->getvar($key) ){		
		$this->CI->sysvar->insert($key,"1",$key);
		$this->CI->load->dbforge();
		for($i=0;$i<count($fields);$i++)
		{
			$fields2[]=$fields[$i];
		}
		$this->CI->dbforge->add_field($fields2);
		$this->CI->dbforge->add_field("id");
		$this->CI->dbforge->create_table($table,TRUE);
		$this->CI->sysvar->update($key,"1");		
	}
 }
 function add_field($table,$field,$type="varchar(50)")
 {
	$key="Flag [$table] add field [$field]";
	if($this->display_output){
		$this->message.="<br>$key";
	}
	if(""==$this->CI->sysvar->getvar($key) ){		
		$this->CI->sysvar->insert($key,"1","auto");
		$fields=$this->CI->db->query("DESCRIBE ".$table)->result();
		$exist=false;
		for($i=0;$i<count($fields);$i++)
		{
			if($fields[$i]->Field==$field){
				$exist=true;
			}
		}
		if(!$exist){
			$s="ALTER TABLE `$table` ADD COLUMN `$field` $type ; "; 
			if($this->CI->db->query($s)){
				$this->CI->sysvar->update($key,"1");
			}
		} else {
			 
			$this->CI->sysvar->update($key,"1");			
		}
	} else {
		 
	}
 }
 function add_fields($table,$fields)
 {
    $key="Flag [$table] add field [".$fields[0]."]";
    if(""==$this->CI->sysvar->getvar($key) ){       
        $this->CI->sysvar->insert($key,"1","auto");
        $fields_tgt=$this->CI->db->query("DESCRIBE ".$table)->result();
        $exist=false;
        $field_new="";
        for($iflds=0;$i<count($fields);$iflds++){            
            $exist=false;
            for($i=0;$i<count($fields_tgt);$i++)
            {
                if($fields_tgt[$i]->Field==$fields[$iflds]){
                    $exist=true;
                    break;
                }
            }
            if(!$exist){
                $field_new.=$fields[$iflds];
                if($flds<count($fields)-1)$field_new.=",";
            }
        }
        if($this->CI->db->query($s)) $this->CI->sysvar->update($key,"1");
    } else {
        $this->CI->sysvar->update($key,"1");            
    }
 }
 function add_index($table,$field)
 {
    $key="Flag [$table] add index [$field]";
    if($this->display_output){
        $this->message.="<br>$key";
    }
    if(""==$this->CI->sysvar->getvar($key) ){       
        $this->CI->sysvar->insert($key,"1","auto");
        $fields=$this->CI->db->query("DESCRIBE ".$table)->result();
        $exist=false;
        if($q=$this->CI->db->query("SHOW INDEX FROM $table WHERE Key_name = 'ix_$field'")){
            if($q->num_rows())$exist=true;
        }
        
        if(!$exist){
            $s="ALTER TABLE `$table` ADD INDEX `ix_$field`(`$field`); "; 
            if(@$this->CI->db->query($s)){
                $this->CI->sysvar->update($key,"1");
            }
        } else {
             
            $this->CI->sysvar->update($key,"1");            
        }
    } else {
         
    }
 }  
}
