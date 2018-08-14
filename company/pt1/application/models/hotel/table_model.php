<?php
class Table_model extends CI_Model {

	private $primary_key='';
	private $table_name='';
	public $fields=null;

	function __construct(){
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
	}
	function open_table($table){
		$this->fields=null;
		switch ($table) {
		  case "hotel_customer":$this->fields=$this->customer();break;
		  default:
			echo "unknown $table check table_model.php";
		}
		return $this->fields;
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
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$data['checkin_date']= format_sql_date($data['checkin_date']);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function dropdown_list($where=""){
		return dropdown_data($table_name,$primary_key,$where);
	}
	
	function create_table($table_name,$fields,$primary_key) {
		$this->load->dbforge();
		if(!$this->db->table_exists($table_name)){	
			foreach($fields as $fld){
				$size="";$type=$fld['type'];
				if($fld['type']=="nvarchar"){
					$size="(".$fld['size'].")";
					if($size=="0")$size="50";
				}
				if($fld['name']=="id"){
					$type="";
				} else {
					$type =" ".$type.' '.$size;
				}
				$this->dbforge->add_field($fld['name'].$type);
			}
			$this->dbforge->add_key($primary_key,TRUE);
			$this->dbforge->create_table($table_name);
		}	
	}
	function customer() {
		$this->table_name="hotel_customer";
		$this->primary_key="cust_no";
		$fields[]=array('name'=>'cust_no','type'=>'nvarchar','size'=>50,'caption'=>"Cust No",'control'=>'text');
		$fields[]=array('name'=>'cust_name','type'=>'nvarchar','size'=>50,'caption'=>"Cust Name",'control'=>'text');
		$fields[]=array('name'=>'address','type'=>'nvarchar','size'=>250,'caption'=>"Address",'control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>"Country",'control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>"City",'control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>"Phone",'control'=>'text');
		$fields[]=array('name'=>'cust_type','type'=>'nvarchar','size'=>50,'caption'=>"Cust Type",'control'=>'text');
		$fields[]=array('name'=>'link_to_cust','type'=>'nvarchar','size'=>50,'caption'=>"Link To",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function reservasi() {
		$this->table_name="hotel_reservasi";
		$this->primary_key="id";
		$fields[]=array('name'=>'checkin_date','type'=>'date','size'=>0,'caption'=>"CheckIn Date",'control'=>'date');
		$fields[]=array('name'=>'checkout_date','type'=>'date','size'=>0,'caption'=>"CheckOut Date",'control'=>'date');
		$fields[]=array('name'=>'checkin_type','type'=>'nvarchar','size'=>50,'caption'=>"Type",'control'=>'text');
		$fields[]=array('name'=>'arrival_date','type'=>'date','size'=>0,'caption'=>"Arival",'control'=>'date');
		$fields[]=array('name'=>'departure_date','type'=>'date','size'=>0,'caption'=>"Departure",'control'=>'date');
		$fields[]=array('name'=>'qty_adults','type'=>'int','size'=>0,'caption'=>"Qty Adult",'control'=>'text');
		$fields[]=array('name'=>'qty_childs','type'=>'int','size'=>0,'caption'=>"Qty Child",'control'=>'text');
		$fields[]=array('name'=>'cust_no','type'=>'nvarchar','size'=>0,'caption'=>"Customer",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function registrasi() {
		$this->table_name="hotel_registrasi";
		$this->primary_key="id";
		$fields[]=array('name'=>'reg_no','type'=>'nvarchar','size'=>50,'caption'=>"Reg Id",'control'=>'text');
		$fields[]=array('name'=>'reg_date','type'=>'date','size'=>0,'caption'=>"Registrasi Date",'control'=>'date');
		$fields[]=array('name'=>'resv_id','type'=>"int",'size'=>0,'caption'=>"Resv Id",'control'=>'text');
		$fields[]=array('name'=>'deposit','type'=>'double','size'=>0,'caption'=>"Deposit",'control'=>'text');
		$fields[]=array('name'=>'reg_status','type'=>'nvarchar','size'=>50,'caption'=>"Status",'control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>"Comments",'control'=>'text');
		$fields[]=array('name'=>'officer_id','type'=>'nvarchar','size'=>50,'caption'=>"Officer",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function payment() {
		$this->table_name="hotel_payment";
		$this->primary_key="id";
		$fields[]=array('name'=>'date_paid','type'=>'date','size'=>0,'caption'=>"Date Paid",'control'=>'date');
		$fields[]=array('name'=>'reg_id','type'=>'int','size'=>0,'caption'=>"Registrasi Id",'control'=>'int');
		$fields[]=array('name'=>'invoice_no','type'=>'nvarchar','size'=>50,'caption'=>"Invoice",'control'=>'text');
		$fields[]=array('name'=>'reg_status','type'=>'nvarchar','size'=>50,'caption'=>"Status",'control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>"Comments",'control'=>'text');
		$fields[]=array('name'=>'officer_id','type'=>'nvarchar','size'=>50,'caption'=>"Officer",'control'=>'text');
		$fields[]=array('name'=>'pay_method','type'=>'nvarchar','size'=>50,'caption'=>"Pay Method",'control'=>'text');
		$fields[]=array('name'=>'amount_paid','type'=>'double','size'=>0,'caption'=>"Amount Paid",'control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'double','size'=>50,'caption'=>"Amount",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function employee() {
		$this->table_name="hotel_employee";
		$this->primary_key="emp_no";
		$fields[]=array('name'=>'emp_no','type'=>'nvarchar','size'=>50,'caption'=>"Nip",'control'=>'text');
		$fields[]=array('name'=>'emp_name','type'=>'nvarchar','size'=>50,'caption'=>"Employee Name",'control'=>'text');
		$fields[]=array('name'=>'position','type'=>'nvarchar','size'=>50,'caption'=>"Position",'control'=>'text');
		$fields[]=array('name'=>'emp_level','type'=>'nvarchar','size'=>50,'caption'=>"Level",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function reservasi_room() {
		$this->table_name="hotel_resv_room";
		$this->primary_key="id";
		$fields[]=array('name'=>'resv_id','type'=>'int','size'=>0,'caption'=>"Reserv Id",'control'=>'text');
		$fields[]=array('name'=>'room_number','type'=>'nvarchar','size'=>50,'caption'=>"Room Number",'control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'double','size'=>0,'caption'=>"Amount",'control'=>'text');
		$fields[]=array('name'=>'expenses','type'=>'double','size'=>0,'caption'=>"Expense",'control'=>'text');
		$fields[]=array('name'=>'paid','type'=>'int','size'=>0,'caption'=>"Paid",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function transaksi_fasilitas() {
		$this->table_name="hotel_tran_facility";
		$this->primary_key="trans_number";
		$fields[]=array('name'=>'trans_date','type'=>'date','size'=>0,'caption'=>"Tanggal",'control'=>'date');
		$fields[]=array('name'=>'trans_number','type'=>'nvarchar','size'=>50,'caption'=>"Nomor",'control'=>'text');
		$fields[]=array('name'=>'reg_id','type'=>'int','size'=>0,'caption'=>"Reg Id",'control'=>'text');
		$fields[]=array('name'=>'person_id','type'=>'nvarchar','size'=>50,'caption'=>"Employee",'control'=>'text');
		$fields[]=array('name'=>'fac_type','type'=>'nvarchar','size'=>50,'caption'=>"Jenis Layanan",'control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'double','size'=>0,'caption'=>"Amount",'control'=>'text');
		$fields[]=array('name'=>'paid','type'=>'int','size'=>0,'caption'=>"Paid",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function transaksi_hotel() {
		$this->table_name="hotel_transactions";
		$this->primary_key="trans_number";
		$fields[]=array('name'=>'trans_date','type'=>'date','size'=>0,'caption'=>"Tanggal",'control'=>'date');
		$fields[]=array('name'=>'trans_number','type'=>'nvarchar','size'=>50,'caption'=>"Nomor",'control'=>'text');
		$fields[]=array('name'=>'reg_id','type'=>'int','size'=>0,'caption'=>"Reg Id",'control'=>'text');
		$fields[]=array('name'=>'person_id','type'=>'nvarchar','size'=>50,'caption'=>"Employee",'control'=>'text');
		$fields[]=array('name'=>'trans_type','type'=>'nvarchar','size'=>50,'caption'=>"Jenis Layanan",'control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'double','size'=>0,'caption'=>"Amount",'control'=>'text');
		$fields[]=array('name'=>'paid','type'=>'int','size'=>0,'caption'=>"Paid",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;

	}
	function transaksi_detail_hotel() {
		$this->table_name="hotel_trans_detail";
		$this->primary_key="id";
		$fields[]=array('name'=>'trans_number','type'=>'nvarchar','size'=>50,'caption'=>"Nomor",'control'=>'text');
		$fields[]=array('name'=>'item_no','type'=>'date','size'=>0,'caption'=>"Tanggal",'control'=>'date');
		$fields[]=array('name'=>'item_desc','type'=>'int','size'=>0,'caption'=>"Paid",'control'=>'text');
		$fields[]=array('name'=>'quantity','type'=>'int','size'=>0,'caption'=>"Reg Id",'control'=>'text');
		$fields[]=array('name'=>'disc_prc','type'=>'nvarchar','size'=>50,'caption'=>"Employee",'control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'double','size'=>0,'caption'=>"Amount",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>"int",'size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function room_number() {
		$this->table_name="hotel_room_number";
		$this->primary_key="room_no";
		$fields[]=array('name'=>'room_no','type'=>'nvarchar','size'=>50,'caption'=>"Nomor",'control'=>'text');
		$fields[]=array('name'=>'room_name','type'=>'nvarchar','size'=>50,'caption'=>"Nama Kamar",'control'=>'text');
		$fields[]=array('name'=>'room_type','type'=>'nvarchar','size'=>50,'caption'=>"Room Type",'control'=>'text');
		$fields[]=array('name'=>'status','type'=>'nvarchar','size'=>50,'caption'=>"Status",'control'=>'text');
		$fields[]=array('name'=>'floor_no','type'=>'nvarchar','size'=>50,'caption'=>"Lantai",'control'=>'text');
		$fields[]=array('name'=>'xyz','type'=>'nvarchar','size'=>50,'caption'=>"Pos XYZ",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function room_type() {
		$this->table_name="hotel_room_type";
		$this->primary_key="room_type";
		$fields[]=array('name'=>'room_type','type'=>'nvarchar','size'=>50,'caption'=>"Jenis Kamar",'control'=>'text');
		$fields[]=array('name'=>'room_type_name','type'=>'nvarchar','size'=>50,'caption'=>"Nama Jenis Kamar",'control'=>'text');
		$fields[]=array('name'=>'room_type_desc','type'=>'nvarchar','size'=>250,'caption'=>"Keterangan",'control'=>'text');
		$fields[]=array('name'=>'normal','type'=>'double','size'=>0,'caption'=>"Normal",'control'=>'text');
		$fields[]=array('name'=>'weekend','type'=>'double','size'=>0,'caption'=>"Weekend",'control'=>'text');
		$fields[]=array('name'=>'dayuse','type'=>'double','size'=>0,'caption'=>"Day Use",'control'=>'text');
		$fields[]=array('name'=>'high_session','type'=>'double','size'=>0,'caption'=>"High Session",'control'=>'text');
		$fields[]=array('name'=>'breakfast','type'=>'double','size'=>0,'caption'=>"Breakfast",'control'=>'text');
		$fields[]=array('name'=>'extra_bad','type'=>'double','size'=>0,'caption'=>"Extra Bed",'control'=>'text');
		$fields[]=array('name'=>'max_adult','type'=>'double','size'=>0,'caption'=>"Max Adult",'control'=>'text');
		$fields[]=array('name'=>'max_child','type'=>'double','size'=>0,'caption'=>"Max Child",'control'=>'text');
		$fields[]=array('name'=>'colour','type'=>'nvarchar','size'=>50,'caption'=>"Warna",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
		
	}
	function room_type_facility() {
		$this->table_name="hotel_room_facility";
		$this->primary_key="id";
		$fields[]=array('name'=>'room_type','type'=>'nvarchar','size'=>50,'caption'=>"Jenis Kamar",'control'=>'text');
		$fields[]=array('name'=>'facility_name','type'=>'nvarchar','size'=>50,'caption'=>"Nama Jenis Kamar",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
		
	}
	
	
}