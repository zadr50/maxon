<?php
class Table_model extends CI_Model {
	function __construct(){
		parent::__construct();        
        
        
	}
	function check_tables(){
		    
		$this->load->library("upgrade");
        
        $this->ct_agent();
        $this->ct_booking_dom_detail();
        $this->ct_booking_int_detail();
        $this->ct_branch();
        $this->ct_courier_machine();
        $this->ct_courier_mode();
        $this->ct_courier_news();
        $this->ct_courier_state();
        $this->ct_customer_bank();
        $this->ct_customer_rate();
        $this->ct_customer_rate_add();
        $this->ct_delivery_boy();
        $this->ct_insurance();
        $this->ct_invoice_courier();
        $this->ct_invoice_router();
        $this->ct_kecamatan();
        $this->ct_machine();
        $this->ct_manifest();
        $this->ct_manifest_detail();
        $this->ct_news();
        $this->ct_other();
        $this->ct_porter();
        $this->ct_province();
        $this->ct_service();
        $this->ct_state();
        $this->ct_supplier_bank();
        $this->ct_supplier_contact();
        $this->ct_tarif();
        $this->ct_tarif_zone();
        $this->ct_tax_master();
        $this->ct_thirdty_detail();
        $this->ct_thirdty_party();
        $this->ct_thirdty_rate_add();
        $this->ct_vehicle();
        $this->ct_zone();
        $this->ct_zone_detail();
		$this->add_field('booking_dom',"ship_type","int");
        $this->add_field("invoice", "price_type", "int");
        $this->add_field("invoice", "insurance_used", "int");
        $this->add_field("invoice", "distance", "float");
        $this->add_field("invoice", "item_count", "int"); 
        $this->add_field("invoice", "sub_total", "float");
        $this->add_field("invoice", "how_paid");
        $this->add_field("invoice_lineitems", "weight");
        $this->add_field("invoice_lineitems", "tall");
        $this->add_field("invoice_lineitems", "item_long");
        $this->add_field("invoice_lineitems", "destination");
        $this->add_field("invoice_lineitems", "service");
    
        $this->add_field("payments", "cc_exp_month");
        $this->add_field("payments", "cc_ccv");
    
        $this->add_field("customers", "abr");
        $this->add_field("customers", "pin");
        $this->add_field("customers", "zone");
        $this->add_field("customers", "website");
        $this->add_field("city", "zone");
        $this->add_field("city", "pin");

        $this->add_field("customer_shipto", "designation");
        $this->add_field("customer_shipto", "dept");
        $this->add_field("customer_shipto", "mobile");
        $this->add_field("customer_shipto", "extra_amount");
        $this->add_field("check_writer_items", "db_cr", "double");
        $this->add_field("check_writer_items", "particular");
        $this->add_field("check_writer_items", "cheque");
        $this->add_field("check_writer_items", "ch_bank");
        $this->add_field( "check_writer_items", "ch_date");
    
        $this->add_field("employee", "email");
        $this->add_field("suppliers", "website","nvarchar(200)");
        $this->add_field("suppliers", "area");
        $this->add_field("suppliers", "abr");
        $this->add_field("suppliers", "pin");
        $this->add_field("suppliers", "mobile");
        $this->add_field("suppliers", "region");

        $this->add_field("invoice", "is_uploaded", "int");
        $this->add_field("invoice_shipment", "awb");
        $this->add_field("invoice_shipment", "thirdty");
        $this->add_field("invoice_shipment", "is_th_party", "int");
        $this->add_field("invoice_shipment", "service");
        $this->add_field("invoice_shipment", "is_service", "int");
        $this->add_field("invoice_shipment", "forwading");
        $this->add_field("invoice_shipment", "sender");
        $this->add_field("invoice_shipment", "sender_name","nvarchar(200)");
        $this->add_field("invoice_shipment", "vendor");
        $this->add_field("invoice_shipment", "pcs", "int");
        $this->add_field("invoice_shipment", "weight", "int");
        $this->add_field("invoice_shipment", "wg_total", "int");
        $this->add_field("invoice_shipment", "is_origin", "int");
        $this->add_field("invoice_shipment", "is_destination", "int");
        $this->add_field("invoice_shipment", "content", "nvarchar(200)");
        $this->add_field("invoice_shipment", "spc_instruction", "nvarchar(200)");
        $this->add_field("invoice_shipment", "dimension");
        $this->add_field("invoice_shipment", "is_doc", "int");
        $this->add_field("invoice_shipment", "is_customer", "int");
        $this->add_field("invoice_shipment", "is_received", "int");
        $this->add_field("invoice_shipment", "abr_cust");
         $this->add_field("invoice_shipment", "email");
         $this->add_field("invoice_shipment", "phone");
         $this->add_field("invoice_shipment", "pin");
        $this->add_field("invoice_shipment", "ref");
        $this->add_field("invoice_shipment", "CustTerima_email");
        $this->add_field("invoice_shipment", "CustTerima_phone");
         $this->add_field("invoice_shipment", "branch");
        $this->add_field("invoice_shipment", "is_branch", "int");
        $this->add_field("invoice_shipment", "is_receiver", "int");
        $this->add_field("booking_dom", "status");
        $this->add_field("booking_int", "status");
        $this->add_field("booking_dom", "is_print_label", "int");
        $this->add_field("booking_int", "is_print_label", "int");
        $this->add_field("booking_dom", "barcode");
        $this->add_field("booking_int", "barcode");
    
        $this->add_field( "invoice", "status");
    
        $this->add_field(  "invoice_lineitems", "l", "float");
        $this->add_field(  "invoice_lineitems", "v", "float");
        $this->add_field(  "booking_dom", "pay_method", "int");
        $this->add_field(  "booking_dom_detail", "jenis_biaya");
         $this->add_field( "booking_dom", "sub_ship");
        $this->add_field( "booking_dom", "create_by");
        $this->add_field( "booking_dom", "create_date", "datetime");
        $this->add_field( "booking_int", "create_by");
        $this->add_field( "booking_int", "create_date", "datetime");
        $this->add_field( "booking_int", "ship_type");
    
        $this->add_field( "booking_dom", "hide_address_pengirim", "int");
        $this->add_field( "booking_dom", "hide_address_penerima", "int");
        $this->add_field( "booking_dom", "paid_by","int");
        $this->add_field( "booking_dom", "ship_type");
                
        $this->add_field( "manifest", "jumlah", "float");
        $this->add_field( "manifest", "banyaknya", "float");
        $this->add_field( "manifest", "berat", "float");
        $this->add_field( "manifest", "barang", "nvarchar(200)");
        $this->add_field( "manifest", "pengirim");
        $this->add_field( "manifest", "tujuan", "nvarchar(200)");
        $this->add_field( "manifest", "create_by");
        $this->add_field( "manifest", "create_date", "datetime");
        $this->add_field( "manifest", "update_by");
        $this->add_field( "manifest", "update_date", "datetime");
        $this->add_field( "manifest_detail", "volume", "float");
        $this->add_field( "manifest_detail", "dimension");
        $this->add_field( "manifest_detail", "no_urut", "int");
        $this->add_field( "manifest_detail", "notes", "nvarchar(200)");

        $this->add_field( "tarif_zone", "create_by");
        $this->add_field( "tarif_zone", "create_date", "datetime");
        $this->add_field( "tarif_zone", "update_by");
        $this->add_field( "tarif_zone", "update_date", "datetime");
                        
        $this->add_field( "zone", "create_by");
        $this->add_field( "zone", "create_date", "datetime");
        $this->add_field( "zone", "update_by");
        $this->add_field( "zone", "update_date", "datetime");
        $this->add_field( "zone_detail", "create_by");
        $this->add_field( "zone_detail", "create_date", "datetime");
        $this->add_field( "zone_detail", "update_by");
        $this->add_field( "zone_detail", "update_date", "datetime");
        
        
        $this->add_field('kecamatan','kab');
        $this->add_field("booking_dom_detail","delivered","int");
                
        $this->add_field( "booking_dom", "tarif_berat", "float");
        $this->add_field( "booking_dom", "tarif_volume", "float");
                                
    }
    function create_table($table,$fields){
        $key = "Flag [$table] add table";
        if(""==$this->sysvar->getvar($key) ){       
            $this->upgrade->create_table($table,$fields);
            $this->sysvar->update($key,"1",$key);
        }            
    }
     function add_field($table,$field,$type="varchar(50)")
     {
        $key="Flag [$table] add field [$field]";
        if(""==$this->sysvar->getvar($key) ){       
            $this->sysvar->insert($key,"1","auto");
            $fields=$this->db->query("DESCRIBE ".$table)->result();
            $exist=false;
            for($i=0;$i<count($fields);$i++)
            {
                if($fields[$i]->Field==$field){
                    $exist=true;
                }
            }
            if(!$exist){
                $s="ALTER TABLE `$table` ADD COLUMN `$field` $type ; "; 
                if($this->db->query($s)){
                    $this->sysvar->update($key,"1");
                }
            } else {
                 
                $this->sysvar->update($key,"1");            
            }
        } else {
             
        }
     }
    
    function ct_other(){
        $this->create_table("so_other",array(
        
        "counter nvarchar(50)","so_number nvarchar(50),ship_type int",
        "trans_no nvarchar(50)","lc_no nvarchar(50)",
        "ref_no nvarchar(50)",                 "dlev_agent nvarchar(50)",
        "dlev_contact nvarchar(50)",           "dlev_phone nvarchar(50)",
         "dlev_closed int",                    "dlev_date datetime",
        "dlev_by nvarchar(50)",                "dlev_name nvarchar(50)",
        "dlev_instruction nvarchar(200)",      "dlev_remark nvarchar(200)",
        "dlev_status nvarchar(50)",
        "pkg_proses nvarchar(50)",          "pkg_ship_type nvarchar(50)",
         "pkg_type nvarchar(50)",           "pkg_request nvarchar(50)",
         "pik_name nvarchar(50)",           "pik_contact nvarchar(50)",
         "pik_phone nvarchar(50)",          "pik_date datetime",
         "pik_by nvarchar(50)",             "pik_instruction nvarchar(50)",
         "pik_remark nvarchar(200)",        "pik_closed int"
                
        ));
   }
   function ct_courier_mode(){
       $this->create_table("courier_mode",array(
         "code nvarchar(50)",
         "mode_name nvarchar(50)",
         "service nvarchar(50)"
       ));
   }
    function ct_courier_machine(){
        $this->create_table("courier_machine",array(
         "code nvarchar(50)",
         "mac_address nvarchar(50)",
         "loc_name nvarchar(100)"                
        ));
    }
    function ct_courier_news(){
        $this->create_table("courier_news",array(
        
         "code nvarchar(50)",
         "date_nw nvarchar(50)",
         "heading nvarchar(100)",
         "detail nvarchar(200)"                
        ));
    }    
    function ct_courier_state(){
        $this->create_table("courier_state",array(
        
         "code nvarchar(50)",
         "state_name nvarchar(50)",
         "country nvarchar(50)",
         "abr nvarchar(50)"
        ));        
    }
    function ct_zone(){
        $this->create_table("zone",array(
         "code nvarchar(50)",
         "zone_name nvarchar(50)",
         "description nvarchar(300)"));
    }
    function ct_zone_detail(){
        $this->create_table("zone_detail",array(
        
         "zone_code nvarchar(50)",
         "city_code nvarchar(50)",
         "city_name nvarchar(200)"
        ));
    }            
    
    function ct_thirdty_party(){
        $this->create_table("thirdty_party",array(
         "code nvarchar(50) ",
         "thirdty_name nvarchar(200)"));
    }
    function ct_thirdty_detail(){
        $this->create_table("thirdty_detail",array(
        
         "th_code nvarchar(50)",
         "th_type nvarchar(50)",
         "wt_from nvarchar(50)",
         "wt_to nvarchar(50)",
         "service nvarchar(50)",
         "rate double",
         "zone nvarchar(50)"));
    }
    function ct_thirdty_rate_add(){
        $this->create_table("thirdty_rate_add",array(
        
         "th_code nvarchar(50)",
         "th_type nvarchar(50)",
         "wt_from nvarchar(50)",
         "wt_to nvarchar(50)",
         "service nvarchar(50)",
         "rate double",
         "zone nvarchar(50)"));
    }
     
  
    function ct_customer_rate(){
        $this->create_table("customer_rate",array(
        
         "cust_no nvarchar(50)",        "darat_vol float",
         "wt_from float",               "laut_wg float",
         "wt_to float",                 "laut_vol float",
         "service nvarchar(50)",        "udara_wg float",
         "rate float",                  "udara_vol float",
         "darat_wg_min float",          "darat_vol_min float",
         "laut_wg_min float",           "laut_vol_min float",
         "udara_wg_min float",          "udara_vol_min float",
         "zone nvarchar(50)"));     
         }
    function ct_customer_rate_add(){
        $this->create_table("customer_rate_add",array(
        
         "cust_no nvarchar(50)",        "darat_vol float",
         "wt_from float",               "laut_wg float",
         "wt_to float",                 "laut_vol float",
         "service nvarchar(50)",        "udara_wg float",
         "rate float",                  "udara_vol float",
         "darat_wg_min float",          "darat_vol_min float",
         "laut_wg_min float",           "laut_vol_min float",
         "udara_wg_min float",          "udara_vol_min float",
         "zone nvarchar(50)"));     
    }
    
    function ct_customer_bank(){
        $this->create_table("customer_bank",array(
        
         "cust_no nvarchar(50)",
         "b_account nvarchar(50)",
         "b_name nvarchar(50)",
         "author nvarchar(50)",
         "address nvarchar(200)"));
   }    
    function ct_invoice_courier(){
        $this->create_table("invoice_courier",array(
        
         "inv_no nvarchar(50)",
         "code nvarchar(50)",
         "contact nvarchar(50)",
         "phone nvarchar(50)",
         "driver1 nvarchar(50)",
         "driver2 nvarchar(50)",
         "email nvarchar(100)",
         "address nvarchar(200)"));
    }
    function ct_invoice_router(){
        $this->create_table("invoice_router",array(
        
         "inv_no nvarchar(50)",
         "stage nvarchar(50)",
         "pickup nvarchar(50)",
         "delivery nvarchar(50)",
         "service nvarchar(50)",
         "distance nvarchar(50)",
         "items nvarchar(50)",
         "status nvarchar(50)"));
    }
        
    function ct_branch(){
        $this->create_table("branch",array(
        
         "code nvarchar(50)",
         "br_name nvarchar(50)",
         "br_type nvarchar(50)",
         "address nvarchar(200)",
         "state nvarchar(50)",
         "country nvarchar(50)",
         "phone nvarchar(50)",
         "email nvarchar(100)",
        "is_head int",
         "abr nvarchar(50)",
         "city nvarchar(50)",
         "contact nvarchar(50)",
         "pin nvarchar(50)",
         "mobil nvarchar(50)",
         "parent nvarchar(50)"));
         }

    function ct_tax_master(){
        $this->create_table("tax_master",array(
        
         "code nvarchar(50)",
         "tax_name nvarchar(50)",
         "tax_percent float"));
         }
    
    function ct_supplier_bank(){
        $this->create_table("supplier_bank",array(
        
         "supp_no nvarchar(50)",
         "b_account nvarchar(50)",
         "b_name nvarchar(50)",
         "author nvarchar(50)",
         "address nvarchar(200)"));
         }

    function ct_supplier_contact(){
        $this->create_table("supplier_contact",array(
        
         "supp_no nvarchar(50)",
         "contact nvarchar(50)",
         "designation nvarchar(50)",
         "dept nvarchar(50)",
         "telp nvarchar(50)",
         "mobile nvarchar(50)",
         "extra_amount double"));
         }
    function ct_porter(){
        $this->create_table("porter",array(
        
         "code nvarchar(50)",
         "porter nvarchar(50)",
         "address nvarchar(200)"));
    }
    
    function ct_vehicle(){
        $this->create_table("vehicle",array(
        
         "code nvarchar(50)",
         "vh_name nvarchar(50)",
         "plat_no nvarchar(50)",
         "capacity nvarchar(50)",
         "tall nvarchar(50)",
         "vh_long nvarchar(50)"));
    }

    function ct_service(){
        $this->create_table("service",array(
        
         "code nvarchar(50)",
         "srv_name nvarchar(50)",
         "vendor nvarchar(50)"));
         }

    function ct_delivery_boy(){
        $this->create_table("delivery_boy",array(
        
         "code nvarchar(50)",           "city nvarchar(50)",
         "boy_name nvarchar(50)",       "email nvarchar(100)",
         "phone nvarchar(50)",
         "address nvarchar(200)"));
         }
    function ct_insurance(){
        $this->create_table("insurance",array(
        
         "code nvarchar(50)",
         "in_name nvarchar(50)",
         "phone nvarchar(50)",
         "address nvarchar(200)",
         "city nvarchar(50)",
         "email nvarchar(50)",
         "fax nvarchar(50)",
         "country nvarchar(50)"));
    }
    function ct_state(){
        $this->create_table("state",array(
        
         "code nvarchar(50)",
         "state_name nvarchar(50)",
         "country nvarchar(50)",
         "abr nvarchar(50)"));
    }
    function ct_news(){
        $this->create_table("news",array(
        
         "code nvarchar(50)",
         "date_nw datetime",
         "heading nvarchar(50)",
         "content nvarchar(300)"));
        }
    function ct_machine(){
        $this->create_table("machine",array(
        
         "code nvarchar(50)",
         "mc_no nvarchar(50)",
         "mac_address nvarchar(50)",
         "loc_name nvarchar(50)"));
         }
    function ct_agent(){
        $this->create_table("agent",array( 
         "code nvarchar(50)",           
         "agent_name nvarchar(50)",    
         "abr nvarchar(50)",            
         "branch nvarchar(50)",
         "contact nvarchar(50)",
         "phone nvarchar(50)",
         "address nvarchar(200)"));
         }

    function ct_tarif(){
        $this->create_table("tarif",array(
        
         "code nvarchar(50)",       "zone nvarchar(50)",
         "kab nvarchar(50)",        "tarif_darat_vol float",
         "kec nvarchar(50)",        "tarif_laut float",
         "service nvarchar(50)",    "tarif_laut_vol float",
         "tarif nvarchar(50)",      "tarif_udara float",
         "max_day nvarchar(50)",    "tarif_udara_vol float",
         "loc_type nvarchar(50)",   
         "ket nvarchar(200)"));
    }

    
    function ct_manifest(){
        $this->create_table("manifest",array(
        
         "code nvarchar(50)",
         "date_mf datetime",
         "date_go datetime",
         "date_to datetime",
         "ship_via int",
         "plat_no nvarchar(50)",
         "person_tgg_jawab nvarchar(50)",
         "nama_kapal nvarchar(50)",
         "keterangan nvarchar(200)"));
    }

    function ct_manifest_detail(){
        $this->create_table("manifest_detail",array(
        
         "code_mf nvarchar(50)",
         "book_no nvarchar(50)",
         "pengirim nvarchar(200)",
        "penerima nvarchar(200)",
        "tujuan nvarchar(200)",
        "jenis_barang nvarchar(50)",
         "jumlah float",
         "banyaknya float",
         "berat float",
         "biaya float"));
    }

    function ct_booking_dom_detail(){
        $this->create_table("booking_dom_detail",array(
        
         "book_no nvarchar(50)",        "no_urut int",
         "item nvarchar(50)",           "p int","t int","v int",
         "qty int",                     "l int", "notes nvarchar(100)",
         "weight float",                "total float",  "tarif_berat float",
         "dimension nvarchar(50)",      "tarif_volume float",
         "content nvarchar(200)",       "is_manual int",
         "total_berat float",           "total_volume float",
         "biaya float"));
         }
                  
    function ct_booking_int_detail(){
        $this->create_table("booking_int_detail",array(
        
         "book_no nvarchar(50)",
         "item nvarchar(50)",
         "qty int",
         "weight float",
         "dimension nvarchar(50)",
         "content nvarchar(200)",
         "biaya float"));
     }
    function ct_tarif_zone(){
    $this->create_table("tarif_zone",array(
        
         "zone_from nvarchar(50)",      "tarif_darat_vol float",
         "zone_to nvarchar(50)",        "tarif_laut float",
         "service nvarchar(50)",        "tarif_laut_vol float",
         "tarif nvarchar(50)",          "tarif_udara float",
         "max_day nvarchar(50)",        "tarif_udara_vol float",
         "loc_type nvarchar(50)",
         "ket nvarchar(200)"));
    }
    function ct_kecamatan(){
        $this->create_table("kecamatan",array(
        "kec nvarchar(50)","prov nvarchar(50)","negara nvarchar(50)",
        "code nvarchar(50)","province nvarchar(50)","country nvarchar(50)"));
    }
    function ct_province(){
        $this->create_table("province",array(
        "prov_name nvarchar(50)",
        "code nvarchar(50)","country nvarchar(50)"));
    }
    
}

?>