<?php
class Bank_Accounts_model extends CI_Model {

private $primary_key='bank_account_number';
private $table_name='bank_accounts';

function __construct(){
	parent::__construct();        
      
        
    
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
                $nama='';
                if(isset($_GET['nama'])){
                    $nama=$_GET['nama'];
                }
                if($nama!='')$this->db->where("category like '%$nama%'");

		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$id=urldecode($id);
		rekening_need_update($id);
		
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_by_account($id){
		$this->db->where("account_id",$id);
		return $this->db->get($this->table_name);		
	}
    function get_account_id($account_number){
        $ret=0;
        if($q=$this->get_by_id($account_number)){
            if($r=$q->row()){
                $ret=$r->account_id;
            }
        }
        return $ret;
    }
	function save($data){
		$id=$data[$this->primary_key];
		rekening_need_update($id);
	    $data=$this->cek_setting_no_bukti($data);
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
			
		rekening_need_update($id);
		
        $data=$this->cek_setting_no_bukti($data);
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
    function cek_setting_no_bukti($data){
            
        $acc=$data["bank_account_number"];
        $in=$data["no_bukti_in"];
        $out=$data["no_bukti_out"];
        
        $key="Acc In $acc Numbering";
        $val=$this->sysvar->getvar($key);
        if($val!=""){
            $data["no_bukti_in"]=$val;
        } else {
            if($in!=""){
                $this->sysvar->insert($key,$in);
            }
        }
        $key="Acc Out $acc Numbering";
        $val=$this->sysvar->getvar($key);
        if($val!=""){
            $data["no_bukti_out"]=$val;
        } else {
            if($out!=""){
                $this->sysvar->insert($key,$out);
            }
        }
       
        return $data;
    }
	function delete($id){
		
		$id=urldecode($id);
		
		rekening_need_update($id);
		
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
    function account_number_list(){
        $query=$this->db->query("select bank_account_number,bank_name 
            from bank_accounts");
        $ret=array();
        $ret['']='- Select -';
        foreach ($query->result() as $row)
        {
                $ret[$row->bank_account_number]=$row->bank_account_number.' - '.$row->bank_name;
        }		 
        return $ret;
	}
	function saldo_rekening()
	{
		$sql="select b.bank_account_number,b.bank_name,sum(cw.deposit_amount-cw.payment_amount) as sum_amount 
		from bank_accounts b left join check_writer cw on cw.account_number=b.bank_account_number
		group by b.bank_account_number,b.bank_name
		order by sum(cw.deposit_amount-cw.payment_amount)  desc
		limit 0,10";
		$query=$this->db->query($sql);
		foreach($query->result() as $row){
			$item=$row->bank_account_number;	//. ' - '.$row->bank_name;
			if($item=="")$item="Unknown";
			$qty=$row->sum_amount;
			if($qty==null)$qty=0;
            if($qty>1)$qty=$qty/10000;
			$data[]=array(substr($item,0,10),$qty);
		}
		return $data;
	}
	function saldo_rekening_old()
	{
		$sql="select b.bank_account_number,b.bank_name,sum(cw.deposit_amount-cw.payment_amount) as sum_amount 
		from bank_accounts b left join check_writer cw on cw.account_number=b.bank_account_number
		group by b.bank_account_number,b.bank_name
		order by sum(cw.deposit_amount-cw.payment_amount)  desc
		limit 0,10";
		$query=$this->db->query($sql);
		foreach($query->result() as $row){
			$item=$row->bank_account_number;	//. ' - '.$row->bank_name;
			if($item=="")$item="Unknown";
			$qty=$row->sum_amount;
			if($qty==null)$qty=0;
			$data[$item]=$qty;
		}
		return $data;
	}
	function account_id($id) {
		$ret=0;
		if($q=$this->get_by_id($id)){
			if($q2=$q->row()){
				$ret=intval($q2->account_id);				
			}
		}
		return $ret;
	}
	function get_bank_name($bank_account_number){
		$ret="";
		$this->db->select("bank_name")->where("bank_account_number",$bank_account_number);
		if($row=$this->db->get($this->table_name)->row()){
			$ret=$row->bank_name;
		}
		return $ret;
	}
    
    function select_edc(){
        $ret[""]="--Pilih Rekening--";
        $sql="select bank_account_number,bank_name,org_id 
            from bank_accounts 
            where has_edc=1 and org_id='".current_company()."' 
            order by bank_name";
        if($q=$this->db->query($sql)){
            foreach($q->result() as $row){
                $ret[$row->bank_account_number]="$row->bank_name - $row->bank_account_number - $row->org_id";
            }
        }
        return $ret;
    }
    function next_bank_recalc(){
    	
    }
	
}
?>