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
		if(!isset($setting['dlgTitle'])) $setting['dlgTitle']="Daftar Pilihan";
		if(!isset($setting['dlgId'])) $setting['dlgId']=$bind_id;
		if(!isset($setting['dlgWidth'])) $setting['dlgWidth']="750px";
		if(!isset($setting['dlgHeight'])) $setting['dlgHeight']="400px";
		if(!isset($setting['dlgTool'])) $setting['dlgTool']="tb".$bind_id;		
		$dlgId=$setting['dlgId'];
        $is_sysvar_lookup=false;
        if(isset($setting['sysvar_lookup'])){
            $is_sysvar_lookup=true;
            if($setting['sysvar_lookup']=='')$is_sysvar_lookup="";
        }
		if($is_sysvar_lookup){
		    $fnc="$('#".$bind_id."').val(row.varvalue);";
		    if(isset($setting['dlgRetFunc']))$fnc.=$setting['dlgRetFunc'];
			$setting['dlgRetFunc']=$fnc;
			$setting['dlgCols']=array( 
						array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
						array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
					);			
			$key=$setting['sysvar_lookup'];
			if(!isset($setting['dlgUrlQuery']))$setting['dlgUrlQuery']=base_url()."index.php/lookup/query_sysvar_lookup/$key/";
			
		} else {
			//$setting['dlgCols']
			if(!isset($setting['dlgUrlQuery']))$setting['dlgUrlQuery']=base_url("index.php/lookup/query/$dlgId/");
		}
		return load_view('frmLov',$setting);
	}
    function get_by_name($what,$search=""){
        $sql="";
        $from="";       $to="";
        if($this->CI->input->get('from')){
            $from=$this->CI->input->get("from");    
            $to=$this->CI->input->get("to");
            $to=date("Y-m-d",strtotime($to))." 23:59:59";
        }
         
        switch($what){
            case "bank_accounts":
                $sql="select bank_account_number,bank_name,attention_name from bank_accounts";
                $comp=session_company_code();
                if($comp!="")$sql.=" where company_code='$comp'";
                $sql.=" order by bank_account_number";
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
                if($search!="")$sql.=" and (shipment_id like '%$search%')";
                if($this->input-get("date_from")){
                    $d1=$this->input->get("date_from");
                    $d2=$this->input->get("date_to");
                    $sql.=" and date_received between '$d1' and '$d2'";
                }
                $sql.=" order by date_received desc";
                
                break;
                                    
            case ("req_no"):
                $sql="select purchase_order_number as req_no,po_date,due_date,ordered_by 
                    from purchase_order where potype='Q' ";
                if($search!="")$sql.=" and purchase_order_number like '%$search%'";
                $sql.=" and po_date between '$from' and '$to' ";
                $sql.=" order by po_date desc";
                //echo $sql;
                
                break;
            
            case ("type_of_invoice"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.po_type'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                break;
            case ("colour"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.colour'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                break;
            case ("size"):
                $sql="select varvalue,keterangan from system_variables where varname='lookup.size'";
                if($search!="")$sql.=" where varvalue like '%$search%'";
                break;
                
            case ("user_id"):
                $sql="select user_id,username from user";
                if($search!="")$sql.=" where username like '%$search%'";
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
            case('payment_terms'):
                $sql="select type_of_payment from type_of_payment";
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
                $sql.=" limit 100";
                break;
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
                $sql="select supplier_number,supplier_name from suppliers";
                if($search!="")$sql.=" where supplier_name like '%$search%'";
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
            default:
               $sql="select * from $what";    
            }
        return $sql;           
    }
}
?>