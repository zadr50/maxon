<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade
 {
 function __construct()
 {
	$this->CI =& get_instance();	 
     
 }
 function process(){
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
  
}
