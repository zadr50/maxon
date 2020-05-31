<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
		// $setting['dlgCols']=array( 
			// array("fieldname"=>"city_id","caption"=>"Kode","width"=>"80px"),
			// array("fieldname"=>"city_name","caption"=>"Kota","width"=>"200px")
		// );
		// $setting['dlgRetFunc']="$('#'+idd).val(row.city_id+' - '+row.city_name);";

class List_of_values
{
	private $setting=null;
	function __construct(){
	   $this->CI =& get_instance();       
       	 $this->CI->load->helper('mylib');	 
		 $this->setting=null;
	}
	function render($setting){
	    /* dlgId :    id yang akan dicari di lookup query
         * dlgBindId: id dialog lov,search,select dan lainnya
         */
        $this->setting=$setting;
		$bind_id=$this->setting['dlgBindId'];
		$sysvar_lookup="";
		if(!isset($this->setting['dlgTitle'])) $this->setting['dlgTitle']="Daftar Pilihan [$bind_id]";
		if(!isset($this->setting['dlgId'])) $this->setting['dlgId']=$bind_id;
		if(!isset($this->setting['dlgWidth'])) $this->setting['dlgWidth']="800";
		if(!isset($this->setting['dlgHeight'])) $this->setting['dlgHeight']="500";
		if(!isset($this->setting['dlgTool'])) $this->setting['dlgTool']="tb".$bind_id;
        if(!isset($this->setting['modules'])) $this->setting['modules']="";
        if(!isset($this->setting['show_check1'])) $this->setting['show_check1']=false;
        if(!isset($this->setting['show_checkbox'])) $this->setting['show_checkbox']=false;
        if(!isset($this->setting['show_date_range'])) $this->setting['show_date_range']=false;
		
		$dlgColsData=null;if(isset($this->setting["dlgColsData"])){
			$dlgColsData=$this->setting["dlgColsData"];
			for($i=0;$i<count($dlgColsData);$i++){
				$this->setting["dlgCols"][]=array("fieldname"=>$dlgColsData[$i],
					"caption"=>ucfirst($dlgColsData[$i]),"width"=>"80px");
								
			}
		} 
        $other_filter="";if(isset($this->setting['filter']))$other_filter=$this->setting['filter'];		
		
        
        $is_sysvar_lookup=false;
        if(isset($this->setting['sysvar_lookup'])){
            $is_sysvar_lookup=true;
            if($this->setting['sysvar_lookup']=='')$is_sysvar_lookup="";
        }
		if(isset($this->setting['dlgUrlQuery'])){
	        $url_data=base_url("pos.php/".$this->setting['dlgUrlQuery']."/");
			
		} else {
	        $url_data=base_url("pos.php/lookup/query/".$this->setting['dlgId']."/");			
		}
        
		if($is_sysvar_lookup){
		    $fnc="$('#".$bind_id."').val(row.varvalue);";
		    if(isset($this->setting['dlgRetFunc']))$fnc.=$this->setting['dlgRetFunc'];
			$this->setting['dlgRetFunc']=$fnc;
			$this->setting['dlgCols']=array( 
						array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
						array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
					);			
			$key=$this->setting['sysvar_lookup'];
			if(!isset($this->setting['dlgUrlQuery'])){
			    $url_data=base_url()."pos.php/lookup/query_sysvar_lookup/$key/";
            }
		} 
        if($other_filter!="")$url_data.="&filter=$other_filter";
        
        $this->setting['dlgUrlQuery']=$url_data;
        $this->setting['dlgId']=$this->setting['dlgBindId'];    //untuk render view id dikembalikan ke dlgBindId
                                                    //agar bisa dibuat function dlgId_show()
		return load_view('frmLov',$this->setting);
	}
    function get_by_name($what,$search=""){        
        $sql="";
        $from="";       $to="";
        $search=urldecode($search);
        if($this->CI->input->get('from')){
            $from=$this->CI->input->get("from");    
            $to=$this->CI->input->get("to");
            $to=date("Y-m-d",strtotime($to))." 23:59:59";
        }
        if($this->CI->input->get("sort")){
            $sort_by=$this->CI->input->get("sort");
        } else {
            $sort_by="";
        }
		if($this->CI->input->get("search")){
			$search2=$this->CI->input->get("search");
			if($search2!="")$search=$search2;
		}
		if($this->CI->input->get("tb_search")){
			$search2=$this->CI->input->get("tb_search");
			if($search2!="")$search=$search2;
		}
		
		if($this->CI->input->get("check1")){
			$check1=$this->CI->input->get("check1");			
		} else {
			$check1="";
		}
		if($this->CI->input->get("check1_value")){
			$check1_value=$this->CI->input->get("check1_value");
		} else {
			$check1_value="";
		}
        switch($what){
            case "NotaOpen":
                $sql="select invoice_number,invoice_date,i.amount,i.sold_to_customer,
                i.salesman,c.company from invoice i 
                left join customers c on c.customer_number=i.sold_to_customer 
                where invoice_type='I' and (paid=0 or paid is null) 
                and (saldo_invoice>0 or saldo_invoice is null)";
                if($search!="")$sql.=" and (i.invoice_number like '$search%' or c.company like '$search%')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by invoice_date desc";
                }
                break;
			case "group_modules":
				$sql="select module_id,module_name from modules where (parentid='0' or parentid is null)";
				if($search!="")$sql=" and module_name like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
    				$sql.=" order by module_id";
	            }					
				break;
			case "sales_order_open":
				$sql="select p.sales_order_number,p.sales_date,p.due_date,p.payment_terms,p.salesman,
				 p.sold_to_customer,c.company
				from sales_order  p
				left join customers c on c.customer_number=p.sold_to_customer
				where delivered=false ";
                if($search!="")$sql.=" and (p.sales_order_number='$search' 
                    or s.company like '$search%' or p.sold_to_customer like '$search%' )";
                
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by p.sales_date desc";
                }
				break;
            case "purchase_order":
                $supplier=$this->CI->input->get("supplier_number");
                $sql="select i.purchase_order_number,i.po_date,i.supplier_number,s.supplier_name,
                i.warehouse_code from purchase_order i left join suppliers s 
                on i.supplier_number=s.supplier_number 
                where i.potype='O' ";
                if($search!="")$sql.=" and (i.purchase_order_number='$search' 
                    or s.supplier_name like '$search%')";
                if($supplier!="")$sql.=" and i.supplier_number='$supplier'";
                
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by i.po_date desc";
                }
                break;
            case "purchase_invoice":
                $sql="select i.purchase_order_number,i.po_date,i.supplier_number,s.supplier_name,
                i.warehouse_code from purchase_order i left join suppliers s 
                on i.supplier_number=s.supplier_number 
                where i.potype='I' ";
                if($search!="")$sql.=" and (i.purchase_order_number='$search' 
                    or s.supplier_name like '$search%')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by i.po_date desc";
                }
                break;

            case "stock_opname";
                $sql="select distinct concat('<input type=checkbox name=ck[] 
                value=',ip.transfer_id,'>') as ck,
                ip.transfer_id,
                concat(year(date_trans),'-',month(date_trans),'-',day(date_trans)) as date_trans,
                ip.from_location,ip.status,ip.trans_by,ip.comments
                from inventory_moving ip
                where trans_type='opname'";
                
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by ip.trasnfer_id";        
                }
                break;
                 
            case "zone":
                $sql="select zone_name,code from zone";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by zone_name";
                }
                break;
            case "kecamatan2":
            case "kecamatan":
                $sql="select kec,prov,country from kecamatan";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by kec";
                }
                break;
            case "customers2":
            case "customers":
                $sql="select company,customer_number,street,suite,city,country,salesman,
                	payment_terms,discount_percent,payment_terms,credit_limit,credit_balance 
                from customers where 1=1 " ;
                if($search!="")$sql.=" and (customer_number like '%$search%' 
                	or company like '%$search%')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by company";
                }
                break;
                
            case ("voucher_cash_out"):
                $sql="select voucher,check_date,supplier_number,payee,payment_amount 
                from check_writer where trans_type in ('cash out','trans out','cheque out')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by voucher";
                }
                break;
                
            case ("recv_po"):
                $sql="select distinct shipment_id,date_received,supplier_number,purchase_order_number 
                    from inventory_products where receipt_type='PO'";
                if($search!="")$sql.=" and (purchase_order_number like '%$search%' or shipment_id like '%$search%')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by date_received desc";
                }
                break;
            case ("do_gudang"):
                $sql="select distinct shipment_id,date_received,warehouse_code,supplier_number  
                    from inventory_products where receipt_type='ETC_OUT' and doc_type='1'";
                if($search!="")$sql.=" and (shipment_id like '%$search%' or supplier_number like '%$search%')";
                if($from!=""){
                    $sql.=" and date_received between '$from' and '$to'";                    
                }
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by date_received desc";
                }
                break;
                                    
            case ("req_no"):
                $sql="select purchase_order_number as req_no,po_date,due_date,ordered_by,dept_code 
                    from purchase_order where potype='Q' ";
                if($search!="")$sql.=" and purchase_order_number like '%$search%'";
                $sql.=" and po_date between '$from' and '$to' ";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by po_date desc";
                }
                break;
            case ("type_of_invoice"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.po_type'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by varvalue";
                }
                break;
            case ("colour"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.colour'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by varvalue";
                }
                break;
            case ("size"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.size'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by varvalue";
                }
                break;
                
            case ("user_id"):
                $sql="select user_id,username from user";
                if($search!="")$sql.=" where username like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by user_id";
                }
                break;
            case ("salestype"):
                $sql="select groupid,komisiprc,remarks from salesman_group";
                if($search!="")$sql.=" where groupid like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by groupid";
                }
                    
                break;
            
            case('city'):
                $sql="select city_id,city_name from city";
                if($search!="")$sql.=" where city_name like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by city_id";
                }
                break;
            case('salesman'):
                $sql="select salesman from salesman";
                if($search!="")$sql.=" where salesman like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by salesman";
                }
                break;
            case('terms'):
            case('payment_terms'):
                $sql="select type_of_payment,days from type_of_payment";
                if($search!="")$sql.=" where type_of_payment like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by type_of_payment";
                }
                break;
            case('country'):
                $sql="select country_id,country_name from country";
                if($search!="")$sql.=" where country_name like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by country_id";
                }
                break;
            case('region'):
                $sql="select region_id,region_name from region";
                if($search!="")$sql.=" where region_name like '%$search%'";
                 if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by region_id";
                }
                break;
            case('customer_record_type'):
                $sql="select type_id,type_name from customer_type";
                if($search!="")$sql.=" where type_name like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by type_id";
                }
                break;
            case('departments'):
                $sql="select dept_code,dept_name from departments";
                if($search!="")$sql.=" where dept_name like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by dept_code";
                }
                break;
            case('divisions'):
                $sql="select div_code,div_name from divisions";
                if($search!="")$sql.=" where div_name like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by div_code";
                }
                break;
            case('inventory'):
            case('inventory2'):
                $sql="select i.description,i.item_number,
                i.quantity_in_stock,i.unit_of_measure,ip.customer_pricing_code,ip.qty_last,
                i.retail,i.cost,
                i.cost_from_mfg,i.category,i.supplier_number,s.supplier_name,i.kode_lama
                from inventory i 
                left join suppliers s on s.supplier_number=i.supplier_number 
                left join inventory_prices ip on ip.item_number=i.item_number
                where 1=1 
                ";
                if($search!=""){
                	$sql.=" and (i.item_number like '$search%' 
                		or i.description like '%$search%' 
                		or i.kode_lama='$search' )";
				}
				if($check1){
					$sql.=" and i.supplier_number='$check1_value' ";
				}
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by i.description";
                }
                //$sql.=" limit 100";
                break;
			case("gudang");	
			case("gudang2");	
			case("warehouse2");	
            case("shipping_locations"):
            case("warehouse"):
                $sql="select g.location_number, g.attention_name, 
                g.company_name,c.company_name as company, 
                g.address_type 
                from shipping_locations g 
                left join preferences c on c.company_code=g.company_name";
                if($search!="")$sql.=" where g.location_number like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by g.location_number";
                }
                break;      
            case("inventory_sub_categories"):
                $parent_id=$this->CI->input->get("parent_id");
                $sql="select kode,category from inventory_categories_sub where 1=1 ";
                if($search!=""){
                    $sql.=" and kode like '%$search%'";
                } 
                if($parent_id){
                    $sql.=" and parent_id='$parent_id'";
                }
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by kode";
                }
                break;                  
            
            case("inventory_categories"):
                $sql="select kode,category from inventory_categories";
                if($search!="")$sql.=" where kode like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by kode";
                }
                break;      
            case("suppliers"):
                $sql="select supplier_number,supplier_name,first_name from suppliers";
                if($search!="")$sql.=" where (supplier_name like '%$search%' or supplier_number like '%$search%')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by supplier_name";                    
                }
                break;      
            case "person":
            case("employee"):
                $sql="select nama,nip,dept,divisi,nip_id,emptype from employee  ";
                if($search!="")$sql.=" where (nama like '%$search%' or nip='$search' or nip_id='$search')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by nama";
                }
                break;      
            case("company"):
            case("preferences"):
                $sql="select company_code,company_name from preferences";
                if($search!="")$sql.=" company_name like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by company_code";
                }
                break;
            case("bank_accounts"):
            case("bank_accounts2"):
                $sql="select * from bank_accounts";
                if($search!="")$sql.=" where (bank_account_number like '%$search%' or bank_name like '%$search%')";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by bank_account_number";
                }
                break;
            case "bank_accounts_cash":
                $sql="select bank_account_number,bank_name,org_id
                 from bank_accounts where 1=1 ";
                $comp=session_company_code();
                if($comp!="")$sql.=" and (org_id='$comp' or type_bank='1')";
                if($search!='')$sql.=" and bank_account_number like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by bank_account_number";
                }
                break;
            case "bank_accounts_bank":
                $sql="select bank_account_number,bank_name,org_id
                 from bank_accounts where 1=1 ";
                $comp=session_company_code();
                if($comp!="")$sql.=" and (org_id='$comp')";
                if($search!='')$sql.=" and bank_account_number like '%$search%'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by bank_account_number";
                }
                
                break;
            case "retur_toko":
                $sql="select distinct shipment_id,
                concat(year(date_received),'-',month(date_received),'-',day(date_received)) as date_received,
                ip.warehouse_code,
                ip.supplier_number, ip.doc_type,ip.doc_status
                from inventory_products ip left join inventory i
                on ip.item_number=i.item_number
                where receipt_type='ETC_OUT' and doc_type='1'";
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by date_received desc ";
                }
                break;
            case "inventory_account":
			case "chart_of_accounts":
            case "cost_account":
            case "inventory_account":    
                $sql="select account,account_description,id from chart_of_accounts";
                if($search!="")$sql.=" where (account like '$search%' or account_description like '%$search%')";
                                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by account";
				}
                break;                                   
            case "invoice":    
                $sql="select i.invoice_number,i.invoice_date,i.payment_terms,
                i.sold_to_customer, 
                c.company,i.salesman,i.amount
                from invoice i left join customers c on c.customer_number=i.sold_to_customer 
                where 1=1 ";
                if($search!=""){
                	$sql.=" and (i.sold_to_customer like '$search%' 
                    or c.company like '$search%' 
                    or i.invoice_number='$search')";
				}
                if($sort_by!=""){
                    $sql.=" order by $sort_by";
                } else {
                    $sql.=" order by i.invoice_number";
                }            
                break;                                
			case "emptype": 
				$sql="select kode,keterangan from hr_emp_level order by kode";
				
				break;  
            default:
               $sql="select * from $what";    
            }

        if($this->CI->input->get("page"))$offset=$this->CI->input->get("page");
        if($this->CI->input->get("rows"))$limit=$this->CI->input->get("rows");
        if($this->CI->input->post("page"))$offset=$this->CI->input->post("page");
        if($this->CI->input->post("rows"))$limit=$this->CI->input->post("rows");
        if(!isset($offset))$offset=0;
        if(!isset($limit))$limit=10;
        if($offset==0)$offset++;
        $offset--;
        $offset=10*$offset;
        $sql.=" limit $offset,$limit";

 
        return $sql;           
    }
	function lookup_suppliers(){
        $lookup = $this->render(array(
        	"dlgBindId"=>"suppliers","modules"=>"supplier",
        	"dlgRetFunc"=>"			
				$('#sold_to_customer').val(row.customer_number);
                $('#customer_number').val(row.customer_number);
				$('#company').val(row.company);
				$('#customer_info').html(row.company);
                $('#supplier_number').val(row.customer_number);
                $('#payee').val(row.company);
                $('#payment_terms').val(row.payment_terms);
        	",
        	"dlgCols"=>array(
                array("fieldname"=>"company","caption"=>"Company","width"=>"180px"),
                array("fieldname"=>"customer_number","caption"=>"Kode","width"=>"80px"),
                array("fieldname"=>"payment_terms","caption"=>"Termin","width"=>"80px"),
                array("fieldname"=>"region","caption"=>"Region","width"=>"80px"),
                array("fieldname"=>"city","caption"=>"City","width"=>"80px")        	        		
        	)
        ));
		return $lookup;
	}

	function lookup_customers(){
        $lookup = $this->render(array(
        	"dlgBindId"=>"customers","modules"=>"customer",
        	"dlgRetFunc"=>"			
				$('#sold_to_customer').val(row.customer_number);
                $('#customer_number').val(row.customer_number);
				$('#company').val(row.company);
				$('#customer_info').html(row.company);
                $('#supplier_number').val(row.customer_number);
                $('#payee').val(row.company);
                $('#payment_terms').val(row.payment_terms);
        	",
        	"dlgCols"=>array(
                array("fieldname"=>"company","caption"=>"Company","width"=>"180px"),
                array("fieldname"=>"customer_number","caption"=>"Kode","width"=>"80px"),
                array("fieldname"=>"payment_terms","caption"=>"Termin","width"=>"80px"),
                array("fieldname"=>"region","caption"=>"Region","width"=>"80px"),
                array("fieldname"=>"city","caption"=>"City","width"=>"80px")        	        		
        	)
        ));
		return $lookup;
	}
	function lookup_inventory(){
        $lookup = $this->render(array(
        	"dlgBindId"=>"inventory",        	
       		'show_checkbox'=>false,
       		'show_check1'=>true,'check1_title'=>"Supplier",'check1_field'=>'supplier_number',
        	"dlgRetFunc"=>"			
				$('#item_number').val(row.item_number);
				$('#description').val(row.description);
				$('#retail').html(row.retail);
				$('#price').html(row.cost_from_mfg);
				$('#unit').html(row.unit_of_measure);
				$('#cost').val(row.cost);
				if(row.cost==0){
					$('#cost').val(row.cost_from_mfg);
				}
				find();
        	",
        	"dlgCols"=>array(
                array("fieldname"=>"item_number","caption"=>"Kode","width"=>"80px"),
                array("fieldname"=>"description","caption"=>"Nama Barang","width"=>"180px"),
                array("fieldname"=>"quantity_in_stock","caption"=>"Qty","width"=>"80px"),
                array("fieldname"=>"unit_of_measure","caption"=>"Unit","width"=>"80px"),
                array("fieldname"=>"retail","caption"=>"H Jual","width"=>"80px"),
                array("fieldname"=>"qty_last","caption"=>"Qty2","width"=>"80px"),
                array("fieldname"=>"customer_pricing_code","caption"=>"Unit2","width"=>"80px"),
                array("fieldname"=>"category","caption"=>"Category","width"=>"80px"),
                array("fieldname"=>"supplier_number","caption"=>"Supplier","width"=>"80px"),
                array("fieldname"=>"supplier_name","caption"=>"Supplier Name","width"=>"80px"),
                array("fieldname"=>"kode_lama","caption"=>"Kode Lama","width"=>"80px")
        	)
        ));
		return $lookup;
	}
	function lookup_gudang(){
       		$dlgBindId="warehouse";
       		$output="#warehouse_code";	
       		$setwh['show_checkbox']=false;
			$setwh['dlgBindId']=$dlgBindId;
            $setwh['dlgRetFunc']="$('$output').val(row.location_number); ";
            $setwh['dlgCols']=array( 
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $setwh['show_date_range']=false;
			return $this->render($setwh);		
	}
	
	function lookup_gl_projects($optional_field=""){
		$ret_func="$('#project_name').html(row.keterangan);";
		if($optional_field!=""){
			$ret_func.="		$('#$optional_field').val(row.kode);";
       }
        $lookup = $this->render(array(
        	"dlgBindId"=>"gl_projects",
        	"dlgRetFunc"=>$ret_func,
        	"modules"=>"project/project",
        	"dlgColsData"=>array("kode","keterangan")
        	)
        );
		return $lookup;
	}
    function lookup_employee(){
        $ret_func="$('#nip').val(row.nip);
        $('#nama').html(row.nama);
        $('#dept').html(row.dept);
        $('#divisi').html(row.divisi);";
        $lookup = $this->render(array(
            "dlgBindId"=>"employee",
            "dlgRetFunc"=>$ret_func,
            "modules"=>"payroll/employee",
            "dlgColsData"=>array("nip","nama","dept","divisi")
            )
        );
        return $lookup;
    }

    function lookup_bank_accounts(){
        $setcom['dlgBindId']="bank_accounts";
        $setcom['dlgRetFunc']="$('#rekening').val(row.bank_account_number);";
        $setcom['dlgCols']=array( 
                    array("fieldname"=>"bank_account_number","caption"=>"Rekening","width"=>"180px"),
                    array("fieldname"=>"bank_name","caption"=>"Nama Bank","width"=>"200px")
                );          
    
    	return $setcom;
	}
	function render_bank_accounts(){
		return $this->render($this->lookup_bank_accounts());
	}
	function sysvar($varname){
		return $this->render(array(
			"sysvar_lookup"=>$varname,
			"dlgBindId"=>$varname
		));
	}
		    
    		
}
?>