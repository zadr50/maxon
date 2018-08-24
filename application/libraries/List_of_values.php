<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
		// $setting['dlgCols']=array( 
			// array("fieldname"=>"city_id","caption"=>"Kode","width"=>"80px"),
			// array("fieldname"=>"city_name","caption"=>"Kota","width"=>"200px")
		// );
		// $setting['dlgRetFunc']="$('#'+idd).val(row.city_id+' - '+row.city_name);";

class List_of_values
{
	function __construct(){
	   $this->CI =& get_instance();        
       	 $this->CI->load->helper('mylib');	 
	}
	function render($setting){
		$bind_id=$setting['dlgBindId'];
		$sysvar_lookup="";
		if(!isset($setting['dlgTitle'])) $setting['dlgTitle']="Daftar Pilihan [$bind_id]";
		if(!isset($setting['dlgId'])) $setting['dlgId']=$bind_id;
		if(!isset($setting['dlgWidth'])) $setting['dlgWidth']="750";
		if(!isset($setting['dlgHeight'])) $setting['dlgHeight']="450";
		if(!isset($setting['dlgTool'])) $setting['dlgTool']="tb".$bind_id;
        $other_filter="";if(isset($setting['filter']))$other_filter=$filter;		
		$dlgId=$setting['dlgId'];
        $is_sysvar_lookup=false;
        if(isset($setting['sysvar_lookup'])){
            $is_sysvar_lookup=true;
            if($setting['sysvar_lookup']=='')$is_sysvar_lookup="";
        }
        $url_data=base_url("index.php/lookup/query/$dlgId/");
		if($is_sysvar_lookup){
		    $fnc="$('#".$bind_id."').val(row.varvalue);";
		    if(isset($setting['dlgRetFunc']))$fnc.=$setting['dlgRetFunc'];
			$setting['dlgRetFunc']=$fnc;
			$setting['dlgCols']=array( 
						array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
						array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
					);			
			$key=$setting['sysvar_lookup'];
			if(!isset($setting['dlgUrlQuery'])){
			    $url_data=base_url()."index.php/lookup/query_sysvar_lookup/$key/";
            }
		} 
        if($other_filter!="")$url_data.="&filter=$other_filter";
        
        $setting['dlgUrlQuery']=$url_data;
        
		return load_view('frmLov',$setting);
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
         
        switch($what){
            case "purchase_order":
                $supplier=$this->CI->input->get("supplier_number");
                $sql="select i.purchase_order_number,i.po_date,i.supplier_number,s.supplier_name,
                i.warehouse_code from purchase_order i left join suppliers s 
                on i.supplier_number=s.supplier_number 
                where i.potype='O' ";
                if($search!="")$sql.=" and (i.purchase_order_number='$search' 
                    or s.supplier_name like '$search%')";
                if($supplier!="")$sql.=" and i.supplier_number='$supplier'";
                
                $sql.=" order by i.po_date desc";
                
                break;
            case "purchase_invoice":
                $sql="select i.purchase_order_number,i.po_date,i.supplier_number,s.supplier_name,
                i.warehouse_code from purchase_order i left join suppliers s 
                on i.supplier_number=s.supplier_number 
                where i.potype='I' ";
                if($search!="")$sql.=" and (i.purchase_order_number='$search' 
                    or s.supplier_name like '$search%')";
                $sql.=" order by i.po_date desc";
                break;

            case "stock_opname";
                $sql="select distinct concat('<input type=checkbox name=ck[] 
                value=',ip.transfer_id,'>') as ck,
                ip.transfer_id,
                concat(year(date_trans),'-',month(date_trans),'-',day(date_trans)) as date_trans,
                ip.from_location,ip.status,ip.trans_by,ip.comments
                from inventory_moving ip
                where trans_type='opname'";
                break;
                 
            case "zone":
                $sql="select zone_name,code from zone";
                break;
            case "kecamatan2":
            case "kecamatan":
                $sql="select kec,prov,country from kecamatan";
                break;
            case "customers2":
            case "customers":
                $sql="select company,customer_number,street,suite,city,country 
                from customers";
                break;
                
            case ("voucher_cash_out"):
                $sql="select voucher,check_date,supplier_number,payee,payment_amount 
                from check_writer where trans_type in ('cash out','trans out','cheque out')";
                break;
                
            case ("recv_po"):
                $sql="select distinct shipment_id,date_received,supplier_number,purchase_order_number 
                    from inventory_products where receipt_type='PO'";
                if($search!="")$sql.=" and (purchase_order_number like '%$search%' or shipment_id like '%$search%')";
                $sql.=" order by date_received desc";
                
                break;
            case ("do_gudang"):
                $sql="select distinct shipment_id,date_received,warehouse_code,supplier_number  
                    from inventory_products where receipt_type='ETC_OUT' and doc_type='1'";
                if($search!="")$sql.=" and (shipment_id like '%$search%' or supplier_number like '%$search%')";
                if($from!=""){
                    $sql.=" and date_received between '$from' and '$to'";                    
                }
                $sql.=" order by date_received desc";
                break;
                                    
            case ("req_no"):
                $sql="select purchase_order_number as req_no,po_date,due_date,ordered_by,dept_code 
                    from purchase_order where potype='Q' ";
                if($search!="")$sql.=" and purchase_order_number like '%$search%'";
                $sql.=" and po_date between '$from' and '$to' ";
                $sql.=" order by po_date desc";
                //echo $sql;
                
                break;
            
            case ("type_of_invoice"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.po_type'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                $sql.=" order by varvalue";
                break;
            case ("colour"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.colour'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                $sql.=" order by varvalue";
                break;
            case ("size"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.size'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                $sql.=" order by varvalue";
                break;
                
            case ("user_id"):
                $sql="select user_id,username from user";
                if($search!="")$sql.=" where username like '%$search%'";
                $sql.=" order by user_id";
                break;
            case ("salestype"):
                $sql="select groupid,komisiprc,remarks from salesman_group";
                if($search!="")$sql.=" where groupid like '%$search%'";
                break;
            
            case('city'):
                $sql="select city_id,city_name from city";
                if($search!="")$sql.=" where city_name like '%$search%'";
                break;
            case('salesman'):
                $sql="select salesman from salesman";
                if($search!="")$sql.=" where salesman like '%$search%'";
                break;
            case('terms'):
            case('payment_terms'):
                $sql="select type_of_payment,days from type_of_payment";
                if($search!="")$sql.=" where type_of_payment like '%$search%'";
                break;
            case('country'):
                $sql="select country_id,country_name from country";
                if($search!="")$sql.=" where country_name like '%$search%'";
                break;
            case('region'):
                $sql="select region_id,region_name from region";
                if($search!="")$sql.=" where region_name like '%$search%'";
                break;
            case('customer_record_type'):
                $sql="select type_id,type_name from customer_type";
                if($search!="")$sql.=" where type_name like '%$search%'";
                break;
            case('departments'):
                $sql="select dept_code,dept_name from departments";
                if($search!="")$sql.=" where dept_name like '%$search%'";
                break;
            case('divisions'):
                $sql="select div_code,div_name from divisions";
                if($search!="")$sql.=" where div_name like '%$search%'";
                break;
            case('inventory'):
            case('inventory2'):
                $sql="select description,item_number from inventory";
                if($search!="")$sql.=" where description like '%$search%'";
                $sql.=" order by description";
                //$sql.=" limit 100";
                break;
            case("shipping_locations"):
            case("warehouse"):
                $sql="select g.location_number, g.attention_name, 
                g.company_name,c.company_name as company, 
                g.address_type 
                from shipping_locations g 
                left join preferences c on c.company_code=g.company_name";
                if($search!="")$sql.=" where g.location_number like '%$search%'";
                $sql.=" order by g.location_number";
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
                $sql.=" order by kode";
                break;                  
            
            case("inventory_categories"):
                $sql="select kode,category from inventory_categories";
                if($search!="")$sql.=" where kode like '%$search%'";
                $sql.=" order by kode";
                break;      
            case("suppliers"):
                $sql="select supplier_number,supplier_name,first_name from suppliers";
                if($search!="")$sql.=" where (supplier_name like '%$search%' or supplier_number like '%$search%')";
                $sql.=" order by supplier_name";
                break;      
            case "person":
            case("employee"):
                $sql="select nama,nip from employee";
                if($search!="")$sql.=" nama like '%$search%'";
                $sql.=" order by nama";
                break;      
            case("company"):
            case("preferences"):
                $sql="select company_code,company_name from preferences";
                if($search!="")$sql.=" company_name like '%$search%'";
                $sql.=" order by company_code";
                break;
            case("bank_accounts"):
            case("bank_accounts2"):
                $sql="select * from bank_accounts";
                if($search!="")$sql.=" where bank_account_number like '%$search%'";
                $sql.=" order by bank_account_number";
                break;
            case "bank_accounts_cash":
                $sql="select bank_account_number,bank_name,org_id
                 from bank_accounts where 1=1 ";
                $comp=session_company_code();
                if($comp!="")$sql.=" and (org_id='$comp' or type_bank='1')";
                if($search!='')$sql.=" and bank_account_number like '%$search%'";
                $sql.=" order by bank_account_number";
                break;
            case "bank_accounts_bank":
                $sql="select bank_account_number,bank_name,org_id
                 from bank_accounts where 1=1 ";
                $comp=session_company_code();
                if($comp!="")$sql.=" and (org_id='$comp')";
                if($search!='')$sql.=" and bank_account_number like '%$search%'";
                $sql.=" order by bank_account_number";
               
                
                break;
            case "retur_toko":
                $sql="select distinct shipment_id,
                concat(year(date_received),'-',month(date_received),'-',day(date_received)) as date_received,
                ip.warehouse_code,
                ip.supplier_number, ip.doc_type,ip.doc_status
                from inventory_products ip left join inventory i
                on ip.item_number=i.item_number
                where receipt_type='ETC_OUT' and doc_type='1'
                order by date_received desc ";
                break;
            case "cost_account":
            case "inventory_account":    
                $sql="select account,account_description,id from chart_of_accounts";
                if($search!="")$sql.=" where (account like '$search%' or account_description like '$search%')";
                $sql.=" order by account";
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
}
?>