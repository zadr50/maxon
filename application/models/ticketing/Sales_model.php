<?php
class Sales_model extends CI_Model {

	private $primary_key="id";
	private $table_name='ticket_sales';
	public $fields=null;
	public $message='';

	function __construct(){
		parent::__construct();
		$this->fields[]=array('name'=>'tanggal','type'=>'datetime','size'=>50,'caption'=>"Tanggal",'control'=>'text');
		$this->fields[]=array('name'=>'ticket_type','type'=>'nvarchar','size'=>50,'caption'=>"Jenis",'control'=>'text');
		$this->fields[]=array('name'=>'how_paid','type'=>'nvarchar','size'=>50,'caption'=>"Bayar",'control'=>'text');
		$this->fields[]=array('name'=>'cust_name','type'=>'nvarchar','size'=>250,'caption'=>"Nama Member",'control'=>'text');
		$this->fields[]=array('name'=>'cust_no','type'=>'nvarchar','size'=>250,'caption'=>"Kode Member",'control'=>'text');
		$this->fields[]=array('name'=>'qty_ticket','type'=>'nvarchar','size'=>50,'caption'=>"Qty",'control'=>'text');
		$this->fields[]=array('name'=>'price','type'=>'nvarchar','size'=>50,'caption'=>"Price",'control'=>'text');
		$this->fields[]=array('name'=>'netto','type'=>'nvarchar','size'=>50,'caption'=>"Jumlah",'control'=>'text');
		$this->fields[]=array('name'=>'user_id','type'=>'nvarchar','size'=>50,'caption'=>"User Id",'control'=>'text');
		$this->fields[]=array('name'=>'edc','type'=>'nvarchar','size'=>50,'caption'=>"EDC",'control'=>'text');
		$this->fields[]=array('name'=>'posted','type'=>'nvarchar','size'=>50,'caption'=>"Posted",'control'=>'text');
		$this->fields[]=array('name'=>'id','type'=>"nvarchar",'size'=>50,'caption'=>"Id",'control'=>'text');		
		
		$this->load->model(array("jurnal_model","setting_model","bank_accounts_model"));
		
	}
	function message_text(){
		return $this->message;
	}
	function create_new_table(){
		
//		$this->fields[]=array('name'=>'country_code','type'=>'nvarchar','size'=>50,'caption'=>"Country",'control'=>'text');
//		$this->fields[]=array('name'=>'province_code','type'=>'nvarchar','size'=>50,'caption'=>"Province",'control'=>'text');
		
		$this->load->dbforge();
		if(!$this->db->table_exists($this->table_name)){	
			foreach($this->fields as $fld){
				$size="";$type=$fld['type'];
				if($fld['type']=="nvarchar")$size="(".$fld['size'].")";
				if($fld['name']=="id"){
					$type="";
				} else {
					$type =" ".$type.' '.$size;
				}
				$this->dbforge->add_field($fld['name'].$type);
			}
			$this->dbforge->add_key($this->primary_key,TRUE);
			$this->dbforge->create_table($this->table_name);
		}	
		
	}
	function get_paged_list($limit=100,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['city_name']))$nama=$_GET['city_name'];
		if($nama!='')$this->db->where("city_name like '%$nama%'");

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
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$data['user_id']=user_id();
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$id=urldecode($id);
		$data['user_id']=user_id();
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function next_unposted_id(){
		$id='';
		$s="select id from ".$this->table_name." where (posted=false or posted is null) 
		 order by tanggal limit 1";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$id=$r->id;
			}
		}
		return $id;
	}
	function unposting($id){
		$glid="TKT".$id;
		$ok =	$this->jurnal_model->unposting($glid);
		$this->db->query("update ".$this->table_name." set posted=false where id=$id");
		return $ok;		
	}
	function posting($id=''){
		$ok=false;
		if($id==''){
			$id=$this->next_unposted_id();
		}
		$id=urldecode($id);
		$glid='';
		if($q=$this->get_by_id($id)){
			if($r=$q->row() ){
				$glid="TKT" . $id;
				$coa_rek=$this->setting_model->vars("default_cash_payment_account");
				$coa_sales_ticket=$this->setting_model->vars("coa_sales_ticket");
				$tanggal=$r->tanggal;
				$ticket_type=$r->ticket_type;
				$amount=$r->netto;		
				$posted=$r->posted;
				$cid=cid();
				$edc=$r->edc;
				$how_paid=$r->how_paid;
			}
		}
		if($id==''){
			$this->message="ticket id not found or blank !, skip...";
			return false;
		}
		if($posted){
			$this->jurnal_model->unposting($glid);
			$this->db->query("update ".$this->table_name." set posted=false where id=$id");
		}
		
		if($how_paid==1){
			$coa_rek=$this->bank_accounts_model->account_id($edc);
		}
		$this->jurnal_model->silent_mode=true;
		
		//-- ALOKASI percent profit sharing ticket
		$amount_sales=$amount;
		$s="select * from ticket_type where ticket_type='$ticket_type' ";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$coa1=$r->coa1;	$prc1=$r->prc1;if($prc1>1)$prc1=$prc1/100;
				$coa2=$r->coa2;	$prc2=$r->prc2;if($prc2>1)$prc2=$prc2/100;
				$coa3=$r->coa3;	$prc3=$r->prc3;if($prc3>1)$prc3=$prc3/100;
				$coa4=$r->coa4;	$prc4=$r->prc4;if($prc4>1)$prc4=$prc4/100;
				$coa5=$r->coa5;	$prc5=$r->prc5;if($prc5>1)$prc5=$prc5/100;
				
				$amt_prc=$amount_sales*$prc1;$amount_sales=$amount_sales-$amt_prc;
				if($amt_prc>0 && $coa1>0){
					$db=0; $cr=$amt_prc;
					$this->jurnal_model->add_jurnal($glid,$coa1,$tanggal,$db,$cr,"Ticketing Sales","Ticketing",$cid,$ticket_type);
				}
				$amt_prc=$amount_sales*$prc2;$amount_sales=$amount_sales-$amt_prc;
				if($amt_prc>0 && $coa2>0){
					$db=0; $cr=$amt_prc;
					$this->jurnal_model->add_jurnal($glid,$coa2,$tanggal,$db,$cr,"Ticketing Sales","Ticketing",$cid,$ticket_type);
				}
				$amt_prc=$amount_sales*$prc3;$amount_sales=$amount_sales-$amt_prc;
				if($amt_prc>0 && $coa3>0){
					$db=0; $cr=$amt_prc;
					$this->jurnal_model->add_jurnal($glid,$coa3,$tanggal,$db,$cr,"Ticketing Sales","Ticketing",$cid,$ticket_type);
				}
				$amt_prc=$amount_sales*$prc4;$amount_sales=$amount_sales-$amt_prc;
				if($amt_prc>0 && $coa4>0){
					$db=0; $cr=$amt_prc;
					$this->jurnal_model->add_jurnal($glid,$coa4,$tanggal,$db,$cr,"Ticketing Sales","Ticketing",$cid,$ticket_type);
				}
				$amt_prc=$amount_sales*$prc5;$amount_sales=$amount_sales-$amt_prc;
				if($amt_prc>0 && $coa5>0){
					$db=0; $cr=$amt_prc;
					$this->jurnal_model->add_jurnal($glid,$coa5,$tanggal,$db,$cr,"Ticketing Sales","Ticketing",$cid,$ticket_type);
				}
				
				
			}
		}
		$db=$amount; $cr=0;
		$this->jurnal_model->add_jurnal($glid,$coa_rek, 
			$tanggal,$db,$cr,"Ticketing Cash In","Ticketing",$cid,$ticket_type);
			
		$db=0; $cr=$amount_sales;
		$this->jurnal_model->add_jurnal($glid,$coa_sales_ticket, 
			$tanggal,$db,$cr,"Ticketing Sales","Ticketing",$cid,$ticket_type);
			
			
		if ($this->jurnal_model->validate($glid)){
			$ok=true;
		}
		$this->db->query("update ".$this->table_name." set posted=true where id=$id");
		
		$this->message.="\n ".$this->jurnal_model->message_text();
		return $ok;
	}
}