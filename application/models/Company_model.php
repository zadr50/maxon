<?php
class Company_model extends CI_Model {

private $primary_key='company_code';
private $table_name='preferences';

function __construct(){
    
	parent::__construct();        
       
    
}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
        $nama='';
        if(isset($_GET['nama'])){
            $nama=$_GET['nama'];
        }
        if($nama!='')$this->db->where("company_name like '%$nama%'");

		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id=''){
		$id=urldecode($id);
		 if($id=="ALL" || $id==""){
			 //bila all ambil saja yang paling atas
			 $id=$this->db->select("company_code")->get("preferences")->row()->company_code;
		 }
		$this->db->where($this->primary_key,$id);
		$result=$this->db->get($this->table_name);
		if($result->num_rows()==0){
			$result=$this->db->get($this->table_name);
		}
		return $result;
	}
    function info($id){
		$id=urldecode($id);
        $data=$this->get_by_id($id)->row();
        if(count($data)){    
            $ret='<br/><strong>'.$id.' - '.$data->company_name.'</strong><br/>'
                    .$data->street.'<br/>'.$data->phone;
        } else $ret='';
        return $ret;
    }
	function save($data){
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		 if($id=="ALL" || $id==""){
			 //bila all ambil saja yang paling atas
			 $id=$this->db->select("company_code")->get("preferences")->row()->company_code;
		 }
		
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function setting($key){
		//echo "CID: ".$this->access->cid;
		//$this->access->cid
		$retval=$this->get_by_id()->result_array();
		//echo "company_model: setting: ";
		 
		if(count($retval)){
			return $retval[0][$key];
		} else {
			return $retval[$key];
		}
	}
    function setting_data($company_code){
        $set=$this->get_by_id($company_code)->row();
     
        $data['accounts_payable']=account($set->accounts_payable);
        $data['po_freight']=account($set->po_freight);
        $data['po_other']=account($set->po_other);
        $data['po_tax']=account($set->po_tax);
        $data['po_discounts_taken']=account($set->po_discounts_taken);
        $data['supplier_credit_account_number']=account($set->supplier_credit_account_number);
        $data['inventory_sales']=account($set->inventory_sales);
        $data['inventory']=account($set->inventory);
        $data['inventory_cogs']=account($set->inventory_cogs);
        $data['accounts_receivable']=account($set->accounts_receivable);
        $data['so_freight']=account($set->so_freight);
        $data['so_other']=account($set->so_other);
        $data['so_tax']=account($set->so_tax);
        $data['so_discounts_given']=account($set->so_discounts_given);
        $data['customer_credit_account_number']=account($set->customer_credit_account_number);
        $data['default_cash_payment_account']=account($set->default_cash_payment_account);
        $data['earning_account']=account($set->earning_account);
        $data['year_earning_account']=account($set->year_earning_account);
        $data['historical_balance_account']=account($set->historical_balance_account);
        $data['default_bank_account_number']=account($set->default_bank_account_number);
        $data['default_credit_card_account']=account($set->default_credit_card_account);

        $data['txtUangMukaBeli']=account($this->sysvar->getvar('COA Uang Muka Pembelian'));
        $data['txtReturJual']=account($this->sysvar->getvar('COA Retur Penjualan',"0"));
        $data['txtReturBeli']=account($this->sysvar->getvar('COA Retur Pembelian',"0"));
        $data['txtCoaItemOut']=account($this->sysvar->getvar('COA Item Out Others'));
        $data['txtCoaItemIn']=account($this->sysvar->getvar('COA Item In Others'));
        $data['txtCoaItemAdj']=account($this->sysvar->getvar('COA Item Adjustment'));
        $data['txtUangMukaJual']=account($this->sysvar->getvar('COA Uang Muka Penjualan'));
        $data['txtChargeCC']=account($this->sysvar->getvar('CoaChargeCreditCard'));
        $data['txtPromo']=account($this->sysvar->getvar('CoaPromo'));
        $data['txtGift']=account($this->sysvar->getvar('CoaGift'));        
        $data['txtHutangKomisi']=account($this->sysvar->getvar('COA Hutang Komisi'));        
        
        return $data;
    }
	function datalist(){
	        $query=$this->db->query("select company_code,company_name from preferences");
	        $ret=array(); $ret['']='- Select -';
	        foreach ($query->result() as $row){ $ret[$row->company_code]=$row->company_code.' -'.$row->company_name;}		 
	        return $ret;
	}
}
