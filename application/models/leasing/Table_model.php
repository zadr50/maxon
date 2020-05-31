<?php
class Table_model extends CI_Model {

	private $primary_key='';
	private $table_name='';
	public $fields=null;

	function __construct(){
		parent::__construct();        
	}
	function check_tables(){
		$this->CustMaster();
		$this->CustPersonal();
		$this->CustShipTo();
		$this->CustCompany();
		$this->CustCompanyOwner();	
		$this->app_approved();
		$this->app_bill_cust_address();
		$this->app_confirm();
		$this->AppCost();
		$this->AppInstallment();
		$this->AppInsurance();
		$this->AppMaster();
		$this->AppObjectItems();
		$this->AppSurvey();
		$this->CustCard();
		$this->LoanMaster();
		$this->LoanObjItems();
		$this->InvoiceHeader();
		$this->ls_counter();
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
		$table_name=strtolower($table_name);
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
			if ($primary_key <>"id") $this->dbforge->add_key($primary_key,TRUE);
			$this->dbforge->create_table($table_name);
			echo($table_name." created.<br>");
		} else {
			//show_error($table_name." exist.");			
		}
	}
	function app_approved() {
		$this->table_name="ls_app_approved";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'approved_date','type'=>'date','size'=>50,'caption'=>"approve by",'control'=>'date');
		$fields[]=array('name'=>'approved_by','type'=>'nvarchar','size'=>50,'caption'=>"approve by",'control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>"comments",'control'=>'text');
		$fields[]=array('name'=>'approved_rate','type'=>'nvarchar','size'=>50,'caption'=>"rate",'control'=>'text');
		$fields[]=array('name'=>'first_score','type'=>'nvarchar','size'=>50,'caption'=>"first rate",'control'=>'text');
		$fields[]=array('name'=>'last_score','type'=>'nvarchar','size'=>50,'caption'=>"last rate",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function app_bill_cust_address() {
		$this->table_name="ls_app_bill_cust_address";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'loan_id','type'=>'nvarchar','size'=>50,'caption'=>'loan_id','control'=>'text');
		$fields[]=array('name'=>'default_ship_to_id','type'=>'nvarchar','size'=>50,'caption'=>'default_ship_to_id','control'=>'text');
		$fields[]=array('name'=>'coll_id','type'=>'nvarchar','size'=>50,'caption'=>'coll_id','control'=>'text');
		$fields[]=array('name'=>'coll_cost','type'=>'nvarchar','size'=>50,'caption'=>'coll_cost','control'=>'text');
		$fields[]=array('name'=>'send_letter_via','type'=>'nvarchar','size'=>50,'caption'=>'send_letter_via','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function app_confirm() {
		$this->table_name="ls_app_confirm";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'confirm_date','type'=>'date','size'=>50,'caption'=>'confirm_date','control'=>'date');
		$fields[]=array('name'=>'confirm_by','type'=>'nvarchar','size'=>50,'caption'=>'confirm_by','control'=>'text');
		$fields[]=array('name'=>'confirm_count','type'=>'int','size'=>50,'caption'=>'confirm_count','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>'comments','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function AppCost() {
		$this->table_name="ls_app_cost";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'cost_type','type'=>'nvarchar','size'=>50,'caption'=>'cost_type','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'nvarchar','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function AppInstallment() {
		$this->table_name="ls_app_installment";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'bank_id','type'=>'nvarchar','size'=>50,'caption'=>'bank_id','control'=>'text');
		$fields[]=array('name'=>'inst_date','type'=>'nvarchar','size'=>50,'caption'=>'inst_date','control'=>'text');
		$fields[]=array('name'=>'loan_amount','type'=>'nvarchar','size'=>50,'caption'=>'loan_amount','control'=>'text');
		$fields[]=array('name'=>'inst_amount','type'=>'nvarchar','size'=>50,'caption'=>'inst_amount','control'=>'text');
		$fields[]=array('name'=>'disc_amount','type'=>'nvarchar','size'=>50,'caption'=>'disc_amount','control'=>'text');
		$fields[]=array('name'=>'subsidi_dealer_amount','type'=>'nvarchar','size'=>50,'caption'=>'subsidi_dealer_amount','control'=>'text');
		$fields[]=array('name'=>'dp_received_by','type'=>'nvarchar','size'=>50,'caption'=>'dp_received_by','control'=>'text');
		$fields[]=array('name'=>'inst_id','type'=>'nvarchar','size'=>50,'caption'=>'inst_id','control'=>'text');
		$fields[]=array('name'=>'inst_type','type'=>'nvarchar','size'=>50,'caption'=>'inst_type','control'=>'text');
		$fields[]=array('name'=>'inst_top','type'=>'nvarchar','size'=>50,'caption'=>'inst_top','control'=>'text');
		$fields[]=array('name'=>'inst_first_date','type'=>'nvarchar','size'=>50,'caption'=>'inst_first_date','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function AppInsurance() {
		$this->table_name="ls_app_insurance";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'insr_id','type'=>'nvarchar','size'=>50,'caption'=>'insr_id','control'=>'text');
		$fields[]=array('name'=>'insr_type','type'=>'nvarchar','size'=>50,'caption'=>'insr_type','control'=>'text');
		$fields[]=array('name'=>'insr_top','type'=>'nvarchar','size'=>50,'caption'=>'insr_top','control'=>'text');
		$fields[]=array('name'=>'insr_season','type'=>'nvarchar','size'=>50,'caption'=>'insr_season','control'=>'text');
		$fields[]=array('name'=>'flat_rate_prc','type'=>'nvarchar','size'=>50,'caption'=>'flat_rate_prc','control'=>'text');
		$fields[]=array('name'=>'eff_rate_prc','type'=>'nvarchar','size'=>50,'caption'=>'eff_rate_prc','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>50,'caption'=>'comments','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function AppMaster() {
		$this->table_name="ls_app_master";
		$this->primary_key="app_id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'app_date','type'=>'nvarchar','size'=>50,'caption'=>'app_date','control'=>'text');
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'counter_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'terms_id','type'=>'nvarchar','size'=>50,'caption'=>'terms_id','control'=>'text');
		$fields[]=array('name'=>'notes','type'=>'nvarchar','size'=>50,'caption'=>'notes','control'=>'text');
		$fields[]=array('name'=>'status','type'=>'nvarchar','size'=>50,'caption'=>'status','control'=>'text');
		$fields[]=array('name'=>'contract_id','type'=>'nvarchar','size'=>50,'caption'=>'contract_id','control'=>'text');
		$fields[]=array('name'=>'dp_amount','type'=>'nvarchar','size'=>50,'caption'=>'dp_amount','control'=>'text');
		$fields[]=array('name'=>'insr_amount','type'=>'nvarchar','size'=>50,'caption'=>'insr_amount','control'=>'text');
		$fields[]=array('name'=>'admin_amount','type'=>'nvarchar','size'=>50,'caption'=>'admin_amount','control'=>'text');
		$fields[]=array('name'=>'inst_amount','type'=>'nvarchar','size'=>50,'caption'=>'inst_amount','control'=>'text');
		$fields[]=array('name'=>'inst_month','type'=>'nvarchar','size'=>50,'caption'=>'inst_month','control'=>'text');
		$fields[]=array('name'=>'loan_amount','type'=>'float','size'=>50,'caption'=>'loan_amount','control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function AppObjectItems() {
		$this->table_name="ls_app_object_items";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'obj_id','type'=>'nvarchar','size'=>50,'caption'=>'obj_id','control'=>'text');
		$fields[]=array('name'=>'description','type'=>'nvarchar','size'=>50,'caption'=>'description','control'=>'text');
		$fields[]=array('name'=>'qty','type'=>'float','size'=>50,'caption'=>'qty','control'=>'text');
		$fields[]=array('name'=>'price','type'=>'float','size'=>50,'caption'=>'price','control'=>'text');
		$fields[]=array('name'=>'disc_prc','type'=>'float','size'=>50,'caption'=>'disc_prc','control'=>'text');
		$fields[]=array('name'=>'disc_amount','type'=>'float','size'=>50,'caption'=>'disc_amount','control'=>'text');
		$fields[]=array('name'=>'tax_prc','type'=>'float','size'=>50,'caption'=>'tax_prc','control'=>'text');
		$fields[]=array('name'=>'tax_amount','type'=>'float','size'=>50,'caption'=>'tax_amount','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'float','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>50,'caption'=>'comments','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function AppSurvey() {
		$this->table_name="ls_app_survey";
		$this->primary_key="id";
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'app_id','control'=>'text');
		$fields[]=array('name'=>'survey_times','type'=>'nvarchar','size'=>50,'caption'=>'survey_times','control'=>'text');
		$fields[]=array('name'=>'survey_date','type'=>'nvarchar','size'=>50,'caption'=>'survey_date','control'=>'text');
		$fields[]=array('name'=>'survey_by','type'=>'nvarchar','size'=>50,'caption'=>'survey_by','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>50,'caption'=>'comments','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function BpkbMaster() {
		$this->table_name="ls_bpkb_master";
		$this->primary_key="id";
		$fields[]=array('name'=>'bpkb_no','type'=>'nvarchar','size'=>50,'caption'=>'bpkb_no','control'=>'text');
		$fields[]=array('name'=>'bpkb_reg_no','type'=>'nvarchar','size'=>50,'caption'=>'bpkb_reg_no','control'=>'text');
		$fields[]=array('name'=>'name_on_bpkb','type'=>'nvarchar','size'=>50,'caption'=>'name_on_bpkb','control'=>'text');
		$fields[]=array('name'=>'bpkb_address','type'=>'nvarchar','size'=>50,'caption'=>'bpkb_address','control'=>'text');
		$fields[]=array('name'=>'police_no','type'=>'nvarchar','size'=>50,'caption'=>'police_no','control'=>'text');
		$fields[]=array('name'=>'stnk_date','type'=>'nvarchar','size'=>50,'caption'=>'stnk_date','control'=>'text');
		$fields[]=array('name'=>'item_type','type'=>'nvarchar','size'=>50,'caption'=>'item_type','control'=>'text');
		$fields[]=array('name'=>'item_brand','type'=>'nvarchar','size'=>50,'caption'=>'item_brand','control'=>'text');
		$fields[]=array('name'=>'item_model','type'=>'nvarchar','size'=>50,'caption'=>'item_model','control'=>'text');
		$fields[]=array('name'=>'made_in','type'=>'nvarchar','size'=>50,'caption'=>'made_in','control'=>'text');
		$fields[]=array('name'=>'mfg_year','type'=>'nvarchar','size'=>50,'caption'=>'mfg_year','control'=>'text');
		$fields[]=array('name'=>'colour','type'=>'nvarchar','size'=>50,'caption'=>'colour','control'=>'text');
		$fields[]=array('name'=>'frame_no','type'=>'nvarchar','size'=>50,'caption'=>'frame_no','control'=>'text');
		$fields[]=array('name'=>'engine_no','type'=>'nvarchar','size'=>50,'caption'=>'engine_no','control'=>'text');
		$fields[]=array('name'=>'engine_capacity','type'=>'nvarchar','size'=>50,'caption'=>'engine_capacity','control'=>'text');
		$fields[]=array('name'=>'branch_id','type'=>'nvarchar','size'=>50,'caption'=>'branch_id','control'=>'text');
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function BpkbTransDetail() {
		$this->table_name="ls_bpkb_trans_detail";
		$this->primary_key="id";
		$fields[]=array('name'=>'doc_no','type'=>'nvarchar','size'=>50,'caption'=>'doc_no','control'=>'text');
		$fields[]=array('name'=>'bpkb_no','type'=>'nvarchar','size'=>50,'caption'=>'bpkb_no','control'=>'text');
		$fields[]=array('name'=>'status','type'=>'nvarchar','size'=>50,'caption'=>'status','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function BpkbTransHeader() {
		$this->table_name="ls_bpkb_trans_header";
		$this->primary_key="id";
		$fields[]=array('name'=>'doc_no','type'=>'nvarchar','size'=>50,'caption'=>'doc_no','control'=>'text');
		$fields[]=array('name'=>'doc_type','type'=>'nvarchar','size'=>50,'caption'=>'doc_type','control'=>'text');
		$fields[]=array('name'=>'doc_date','type'=>'nvarchar','size'=>50,'caption'=>'doc_date','control'=>'text');
		$fields[]=array('name'=>'from_location','type'=>'nvarchar','size'=>50,'caption'=>'from_location','control'=>'text');
		$fields[]=array('name'=>'to_location','type'=>'nvarchar','size'=>50,'caption'=>'to_location','control'=>'text');
		$fields[]=array('name'=>'to_loc_type','type'=>'nvarchar','size'=>50,'caption'=>'to_loc_type','control'=>'text');
		$fields[]=array('name'=>'ref_doc_no','type'=>'nvarchar','size'=>50,'caption'=>'ref_doc_no','control'=>'text');
		$fields[]=array('name'=>'person_name','type'=>'nvarchar','size'=>50,'caption'=>'person_name','control'=>'text');
		$fields[]=array('name'=>'total_bpkb','type'=>'nvarchar','size'=>50,'caption'=>'total_bpkb','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'street','control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>50,'caption'=>'suite','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'city','control'=>'text');
		$fields[]=array('name'=>'zip_pos','type'=>'nvarchar','size'=>50,'caption'=>'zip_pos','control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>50,'caption'=>'region','control'=>'text');
		$fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>'province','control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>'country','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'phone','control'=>'text');
		$fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>'fax','control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>50,'caption'=>'email','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>50,'caption'=>'comments','control'=>'text');
		$fields[]=array('name'=>'parent_recvdoc_no','type'=>'nvarchar','size'=>50,'caption'=>'parent_recvdoc_no','control'=>'text');
		$fields[]=array('name'=>'status','type'=>'nvarchar','size'=>50,'caption'=>'status','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function CollGroupAggr() {
		$this->table_name="ls_coll_group_aggr";
		$this->primary_key="aggr_doc_id";
		$fields[]=array('name'=>'aggr_doc_id','type'=>'nvarchar','size'=>50,'caption'=>'aggr_doc_id','control'=>'text');
		$fields[]=array('name'=>'group_id','type'=>'nvarchar','size'=>50,'caption'=>'group_id','control'=>'text');
		$fields[]=array('name'=>'aggr_date','type'=>'nvarchar','size'=>50,'caption'=>'aggr_date','control'=>'text');
		$fields[]=array('name'=>'plafon_unit','type'=>'nvarchar','size'=>50,'caption'=>'plafon_unit','control'=>'text');
		$fields[]=array('name'=>'plafon_amount','type'=>'nvarchar','size'=>50,'caption'=>'plafon_amount','control'=>'text');
		$fields[]=array('name'=>'plafon_unit_sold','type'=>'nvarchar','size'=>50,'caption'=>'plafon_unit_sold','control'=>'text');
		$fields[]=array('name'=>'plafon_amount_sold','type'=>'nvarchar','size'=>50,'caption'=>'plafon_amount_sold','control'=>'text');
		$fields[]=array('name'=>'eff_rate_1','type'=>'nvarchar','size'=>50,'caption'=>'eff_rate_1','control'=>'text');
		$fields[]=array('name'=>'eff_rate_2','type'=>'nvarchar','size'=>50,'caption'=>'eff_rate_2','control'=>'text');
		$fields[]=array('name'=>'eff_rate_3','type'=>'nvarchar','size'=>50,'caption'=>'eff_rate_3','control'=>'text');
		$fields[]=array('name'=>'eff_rate_4','type'=>'nvarchar','size'=>50,'caption'=>'eff_rate_4','control'=>'text');
		$fields[]=array('name'=>'adv_rate_1','type'=>'nvarchar','size'=>50,'caption'=>'adv_rate_1','control'=>'text');
		$fields[]=array('name'=>'adv_rate_2','type'=>'nvarchar','size'=>50,'caption'=>'adv_rate_2','control'=>'text');
		$fields[]=array('name'=>'adv_rate_3','type'=>'nvarchar','size'=>50,'caption'=>'adv_rate_3','control'=>'text');
		$fields[]=array('name'=>'adv_rate_4','type'=>'nvarchar','size'=>50,'caption'=>'adv_rate_4','control'=>'text');
		$fields[]=array('name'=>'arr_rate_1','type'=>'nvarchar','size'=>50,'caption'=>'arr_rate_1','control'=>'text');
		$fields[]=array('name'=>'arr_rate_2','type'=>'nvarchar','size'=>50,'caption'=>'arr_rate_2','control'=>'text');
		$fields[]=array('name'=>'arr_rate_3','type'=>'nvarchar','size'=>50,'caption'=>'arr_rate_3','control'=>'text');
		$fields[]=array('name'=>'arr_rate_4','type'=>'nvarchar','size'=>50,'caption'=>'arr_rate_4','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>50,'caption'=>'comments','control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function CollGroup() {
		$this->table_name="ls_coll_group";
		$this->primary_key="id";
		$fields[]=array('name'=>'group_id','type'=>'nvarchar','size'=>50,'caption'=>'group_id','control'=>'text');
		$fields[]=array('name'=>'description','type'=>'nvarchar','size'=>50,'caption'=>'description','control'=>'text');
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'emp_id','type'=>'nvarchar','size'=>50,'caption'=>'emp_id','control'=>'text');
		$fields[]=array('name'=>'first_name','type'=>'nvarchar','size'=>50,'caption'=>'first_name','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function CollSchedule() {
		$this->table_name="ls_coll_schedule";
		$this->primary_key="id";
		$fields[]=array('name'=>'coll_id','type'=>'nvarchar','size'=>50,'caption'=>'coll_id','control'=>'text');
		$fields[]=array('name'=>'schedule_type','type'=>'nvarchar','size'=>50,'caption'=>'schedule_type','control'=>'text');
		$fields[]=array('name'=>'schedule_date','type'=>'nvarchar','size'=>50,'caption'=>'schedule_date','control'=>'text');
		$fields[]=array('name'=>'visit_reason','type'=>'nvarchar','size'=>50,'caption'=>'visit_reason','control'=>'text');
		$fields[]=array('name'=>'Sp_number','type'=>'nvarchar','size'=>50,'caption'=>'Sp_number','control'=>'text');
		$fields[]=array('name'=>'loan_id','type'=>'nvarchar','size'=>50,'caption'=>'loan_id','control'=>'text');
		$fields[]=array('name'=>'brach_id','type'=>'nvarchar','size'=>50,'caption'=>'brach_id','control'=>'text');
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'notes','type'=>'nvarchar','size'=>50,'caption'=>'notes','control'=>'text');
		$fields[]=array('name'=>'visit_result','type'=>'nvarchar','size'=>50,'caption'=>'visit_result','control'=>'text');
		$fields[]=array('name'=>'is_visited','type'=>'nvarchar','size'=>50,'caption'=>'is_visited','control'=>'text');
		$fields[]=array('name'=>'visit_date','type'=>'nvarchar','size'=>50,'caption'=>'visit_date','control'=>'text');
		$fields[]=array('name'=>'created_date','type'=>'nvarchar','size'=>50,'caption'=>'created_date','control'=>'text');
		$fields[]=array('name'=>'created_by','type'=>'nvarchar','size'=>50,'caption'=>'created_by','control'=>'text');
		$fields[]=array('name'=>'installment_time','type'=>'nvarchar','size'=>50,'caption'=>'installment_time','control'=>'text');
		$fields[]=array('name'=>'installment_balance','type'=>'nvarchar','size'=>50,'caption'=>'installment_balance','control'=>'text');
		$fields[]=array('name'=>'installment_last_amount','type'=>'nvarchar','size'=>50,'caption'=>'installment_last_amount','control'=>'text');
		$fields[]=array('name'=>'installment_last_date','type'=>'nvarchar','size'=>50,'caption'=>'installment_last_date','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function CustCompany() {
		$this->table_name="ls_cust_company";
		$this->primary_key="id";
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'comp_type','type'=>'nvarchar','size'=>50,'caption'=>'comp_type','control'=>'text');
		$fields[]=array('name'=>'bussiness_type','type'=>'nvarchar','size'=>50,'caption'=>'bussiness_type','control'=>'text');
		$fields[]=array('name'=>'industry_type','type'=>'nvarchar','size'=>50,'caption'=>'industry_type','control'=>'text');
		$fields[]=array('name'=>'office_status','type'=>'nvarchar','size'=>50,'caption'=>'office_status','control'=>'text');
		$fields[]=array('name'=>'npwp','type'=>'nvarchar','size'=>50,'caption'=>'npwp','control'=>'text');
		$fields[]=array('name'=>'notaris_no','type'=>'nvarchar','size'=>50,'caption'=>'notaris_no','control'=>'text');
		$fields[]=array('name'=>'notaris_date','type'=>'nvarchar','size'=>50,'caption'=>'notaris_date','control'=>'text');
		$fields[]=array('name'=>'notaris_name','type'=>'nvarchar','size'=>50,'caption'=>'notaris_name','control'=>'text');
		$fields[]=array('name'=>'tdp_number','type'=>'nvarchar','size'=>50,'caption'=>'tdp_number','control'=>'text');
		$fields[]=array('name'=>'tdp_date','type'=>'nvarchar','size'=>50,'caption'=>'tdp_date','control'=>'text');
		$fields[]=array('name'=>'siup_number','type'=>'nvarchar','size'=>50,'caption'=>'siup_number','control'=>'text');
		$fields[]=array('name'=>'siup_date','type'=>'nvarchar','size'=>50,'caption'=>'siup_date','control'=>'text');
		$fields[]=array('name'=>'contact_name','type'=>'nvarchar','size'=>50,'caption'=>'contact_name','control'=>'text');
		$fields[]=array('name'=>'contact_phone','type'=>'nvarchar','size'=>50,'caption'=>'contact_phone','control'=>'text');
		$fields[]=array('name'=>'total_employee','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'comp_name','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'since_year','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'rtrw','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'kel','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'kec','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'phone_ext','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'spv_name','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'job_status','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'job_level','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'job_type','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'job_status_etc','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'job_type_etc','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'emp_status','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'emp_status_etc','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'comp_desc','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'office_status_etc','type'=>'nvarchar','size'=>50,'caption'=>'total_empoloyee','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function CustCompanyOwner() {
		$this->table_name="ls_cust_company_owner";
		$this->primary_key="id";
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'owner_name','type'=>'nvarchar','size'=>50,'caption'=>'owner_name','control'=>'text');
		$fields[]=array('name'=>'id_ktp','type'=>'nvarchar','size'=>50,'caption'=>'id_ktp','control'=>'text');
		$fields[]=array('name'=>'npwp','type'=>'nvarchar','size'=>50,'caption'=>'npwp','control'=>'text');
		$fields[]=array('name'=>'jabatan','type'=>'nvarchar','size'=>50,'caption'=>'jabatan','control'=>'text');
		$fields[]=array('name'=>'pangsa','type'=>'nvarchar','size'=>50,'caption'=>'pangsa','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'street','control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>50,'caption'=>'suite','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'city','control'=>'text');
		$fields[]=array('name'=>'zip_pos','type'=>'nvarchar','size'=>50,'caption'=>'zip_pos','control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>50,'caption'=>'region','control'=>'text');
		$fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>'province','control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>'country','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'phone','control'=>'text');
		$fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>'fax','control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>50,'caption'=>'email','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function CustMaster() {
		$this->table_name="ls_cust_master";
		$this->primary_key="id";
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'cust_name','type'=>'nvarchar','size'=>50,'caption'=>'cust_name','control'=>'text');
		$fields[]=array('name'=>'first_name','type'=>'nvarchar','size'=>50,'caption'=>'first_name','control'=>'text');
		$fields[]=array('name'=>'last_name','type'=>'nvarchar','size'=>50,'caption'=>'last_name','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'street','control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>50,'caption'=>'suite','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'city','control'=>'text');
		$fields[]=array('name'=>'zip_pos','type'=>'nvarchar','size'=>50,'caption'=>'zip_pos','control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>50,'caption'=>'region','control'=>'text');
		$fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>'province','control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>'country','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'phone','control'=>'text');
		$fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>'fax','control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>50,'caption'=>'email','control'=>'text');
		$fields[]=array('name'=>'bank_name','type'=>'nvarchar','size'=>50,'caption'=>'bank_name','control'=>'text');
		$fields[]=array('name'=>'bank_acc_number','type'=>'nvarchar','size'=>50,'caption'=>'bank_acc_number','control'=>'text');
		$fields[]=array('name'=>'credit_card_number','type'=>'nvarchar','size'=>50,'caption'=>'credit_card_number','control'=>'text');
		$fields[]=array('name'=>'is_send_email','type'=>'nvarchar','size'=>50,'caption'=>'is_send_email','control'=>'text');
		$fields[]=array('name'=>'is_active','type'=>'nvarchar','size'=>50,'caption'=>'is_active','control'=>'text');
		$fields[]=array('name'=>'balance_amount','type'=>'nvarchar','size'=>50,'caption'=>'balance_amount','control'=>'text');
		$fields[]=array('name'=>'credit_amount','type'=>'nvarchar','size'=>50,'caption'=>'credit_amount','control'=>'text');
		$fields[]=array('name'=>'credit_balance','type'=>'nvarchar','size'=>50,'caption'=>'credit_balance','control'=>'text');
		$fields[]=array('name'=>'credit_limit','type'=>'nvarchar','size'=>50,'caption'=>'credit_limit','control'=>'text');
		$fields[]=array('name'=>'status','type'=>'nvarchar','size'=>50,'caption'=>'status','control'=>'text');
		$fields[]=array('name'=>'ref_doc_id','type'=>'nvarchar','size'=>50,'caption'=>'ref_doc_id','control'=>'text');
		$fields[]=array('name'=>'cust_type','type'=>'nvarchar','size'=>50,'caption'=>'cust_type','control'=>'text');
		$fields[]=array('name'=>'parent_cust_id','type'=>'nvarchar','size'=>50,'caption'=>'parent_cust_id','control'=>'text');
		$fields[]=array('name'=>'call_name','type'=>'nvarchar','size'=>50,'caption'=>'call_name','control'=>'text');
		$fields[]=array('name'=>'id_card_no','type'=>'nvarchar','size'=>50,'caption'=>'id_card_no','control'=>'text');
		$fields[]=array('name'=>'id_card_exp','type'=>'nvarchar','size'=>50,'caption'=>'id_card_exp','control'=>'text');
		$fields[]=array('name'=>'rtrw','type'=>'nvarchar','size'=>50,'caption'=>'rtrw','control'=>'text');
		$fields[]=array('name'=>'kel','type'=>'nvarchar','size'=>50,'caption'=>'kel','control'=>'text');
		$fields[]=array('name'=>'kec','type'=>'nvarchar','size'=>50,'caption'=>'kec','control'=>'text');
		$fields[]=array('name'=>'lama_thn','type'=>'nvarchar','size'=>50,'caption'=>'lama_thn','control'=>'text');
		$fields[]=array('name'=>'lama_bln','type'=>'nvarchar','size'=>50,'caption'=>'lama_bln','control'=>'text');
		$fields[]=array('name'=>'mother_name','type'=>'nvarchar','size'=>50,'caption'=>'mother_name','control'=>'text');
		$fields[]=array('name'=>'spouse_name','type'=>'nvarchar','size'=>50,'caption'=>'spouse_name','control'=>'text');
		$fields[]=array('name'=>'spouse_birth_place','type'=>'nvarchar','size'=>50,'caption'=>'spouse_birth_place','control'=>'text');
		$fields[]=array('name'=>'spouse_birth_date','type'=>'nvarchar','size'=>50,'caption'=>'spouse_birth_date','control'=>'text');
		$fields[]=array('name'=>'spouse_phone','type'=>'nvarchar','size'=>50,'caption'=>'spouse_phone','control'=>'text');
		$fields[]=array('name'=>'salary_source','type'=>'nvarchar','size'=>50,'caption'=>'salary_source','control'=>'text');
		$fields[]=array('name'=>'spouse_salary_source','type'=>'nvarchar','size'=>50,'caption'=>'spouse_salary_source','control'=>'text');
		$fields[]=array('name'=>'other_income_source','type'=>'nvarchar','size'=>50,'caption'=>'other_income_source','control'=>'text');
		$fields[]=array('name'=>'deduct_source','type'=>'nvarchar','size'=>50,'caption'=>'deduct_source','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function CustPersonal() {
		$this->table_name="ls_cust_personal";
		$this->primary_key="id";
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'subcust_id','type'=>'nvarchar','size'=>50,'caption'=>'subcust_id','control'=>'text');
		$fields[]=array('name'=>'first_name','type'=>'nvarchar','size'=>50,'caption'=>'first_name','control'=>'text');
		$fields[]=array('name'=>'last_name','type'=>'nvarchar','size'=>50,'caption'=>'last_name','control'=>'text');
		$fields[]=array('name'=>'gender','type'=>'nvarchar','size'=>50,'caption'=>'gender','control'=>'text');
		$fields[]=array('name'=>'birth_place','type'=>'nvarchar','size'=>50,'caption'=>'birth_place','control'=>'text');
		$fields[]=array('name'=>'birth_date','type'=>'nvarchar','size'=>50,'caption'=>'birth_date','control'=>'text');
		$fields[]=array('name'=>'religion','type'=>'nvarchar','size'=>50,'caption'=>'religion','control'=>'text');
		$fields[]=array('name'=>'occupation','type'=>'nvarchar','size'=>50,'caption'=>'occupation','control'=>'text');
		$fields[]=array('name'=>'education','type'=>'nvarchar','size'=>50,'caption'=>'education','control'=>'text');
		$fields[]=array('name'=>'marital_status','type'=>'nvarchar','size'=>50,'caption'=>'marital_status','control'=>'text');
		$fields[]=array('name'=>'house_status','type'=>'nvarchar','size'=>50,'caption'=>'house_status','control'=>'text');
		$fields[]=array('name'=>'salary','type'=>'nvarchar','size'=>50,'caption'=>'salary','control'=>'text');
		$fields[]=array('name'=>'spouse_salary','type'=>'nvarchar','size'=>50,'caption'=>'spouse_salary','control'=>'text');
		$fields[]=array('name'=>'other_income','type'=>'nvarchar','size'=>50,'caption'=>'other_income','control'=>'text');
		$fields[]=array('name'=>'no_of_dependents','type'=>'nvarchar','size'=>50,'caption'=>'no_of_dependents','control'=>'text');
		$fields[]=array('name'=>'year_of_service','type'=>'nvarchar','size'=>50,'caption'=>'year_of_service','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function CustShipTo() {
		$this->table_name="ls_cust_ship_to";
		$this->primary_key="id";
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'ship_to_type','type'=>'nvarchar','size'=>50,'caption'=>'ship_to_type','control'=>'text');
		$fields[]=array('name'=>'ship_to_id','type'=>'nvarchar','size'=>50,'caption'=>'ship_to_id','control'=>'text');
		$fields[]=array('name'=>'first_name','type'=>'nvarchar','size'=>50,'caption'=>'first_name','control'=>'text');
		$fields[]=array('name'=>'last_name','type'=>'nvarchar','size'=>50,'caption'=>'last_name','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'street','control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>50,'caption'=>'suite','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'city','control'=>'text');
		$fields[]=array('name'=>'zip_pos','type'=>'nvarchar','size'=>50,'caption'=>'zip_pos','control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>50,'caption'=>'region','control'=>'text');
		$fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>'province','control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>'country','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'phone','control'=>'text');
		$fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>'fax','control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>50,'caption'=>'email','control'=>'text');
		$fields[]=array('name'=>'kel','type'=>'nvarchar','size'=>50,'caption'=>'kel','control'=>'text');
		$fields[]=array('name'=>'kec','type'=>'nvarchar','size'=>50,'caption'=>'kec','control'=>'text');
		$fields[]=array('name'=>'rtrw','type'=>'nvarchar','size'=>50,'caption'=>'rtrw','control'=>'text');
		$fields[]=array('name'=>'hp','type'=>'nvarchar','size'=>50,'caption'=>'hp','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function Dealers() {
		$this->table_name="ls_dealers";
		$this->primary_key="id";
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'dealer_name','type'=>'nvarchar','size'=>50,'caption'=>'dealer_name','control'=>'text');
		$fields[]=array('name'=>'first_name','type'=>'nvarchar','size'=>50,'caption'=>'first_name','control'=>'text');
		$fields[]=array('name'=>'last_name','type'=>'nvarchar','size'=>50,'caption'=>'last_name','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'street','control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>50,'caption'=>'suite','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'city','control'=>'text');
		$fields[]=array('name'=>'zip_pos','type'=>'nvarchar','size'=>50,'caption'=>'zip_pos','control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>50,'caption'=>'region','control'=>'text');
		$fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>'province','control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>'country','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'phone','control'=>'text');
		$fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>'fax','control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>50,'caption'=>'email','control'=>'text');
		$fields[]=array('name'=>'bank_name','type'=>'nvarchar','size'=>50,'caption'=>'bank_name','control'=>'text');
		$fields[]=array('name'=>'bank_acc_number','type'=>'nvarchar','size'=>50,'caption'=>'bank_acc_number','control'=>'text');
		$fields[]=array('name'=>'is_active','type'=>'nvarchar','size'=>50,'caption'=>'is_active','control'=>'text');
		$fields[]=array('name'=>'balance_amount','type'=>'nvarchar','size'=>50,'caption'=>'balance_amount','control'=>'text');
		$fields[]=array('name'=>'credit_amount','type'=>'nvarchar','size'=>50,'caption'=>'credit_amount','control'=>'text');
		$fields[]=array('name'=>'credit_balance','type'=>'nvarchar','size'=>50,'caption'=>'credit_balance','control'=>'text');
		$fields[]=array('name'=>'credit_limit','type'=>'nvarchar','size'=>50,'caption'=>'credit_limit','control'=>'text');
		$fields[]=array('name'=>'status','type'=>'nvarchar','size'=>50,'caption'=>'status','control'=>'text');
		$fields[]=array('name'=>'created_date','type'=>'nvarchar','size'=>50,'caption'=>'created_date','control'=>'text');
		$fields[]=array('name'=>'aggr_doc_id','type'=>'nvarchar','size'=>50,'caption'=>'aggr_doc_id','control'=>'text');
		$fields[]=array('name'=>'aggr_date','type'=>'nvarchar','size'=>50,'caption'=>'aggr_date','control'=>'text');
		$fields[]=array('name'=>'aggr_valid_from','type'=>'nvarchar','size'=>50,'caption'=>'aggr_valid_from','control'=>'text');
		$fields[]=array('name'=>'aggr_valid_to','type'=>'nvarchar','size'=>50,'caption'=>'aggr_valid_to','control'=>'text');
		$fields[]=array('name'=>'achv_l_ytd_unit','type'=>'nvarchar','size'=>50,'caption'=>'achv_l_ytd_unit','control'=>'text');
		$fields[]=array('name'=>'achv_l_ytd_amount','type'=>'nvarchar','size'=>50,'caption'=>'achv_l_ytd_amount','control'=>'text');
		$fields[]=array('name'=>'target_unit','type'=>'nvarchar','size'=>50,'caption'=>'target_unit','control'=>'text');
		$fields[]=array('name'=>'target_amount','type'=>'nvarchar','size'=>50,'caption'=>'target_amount','control'=>'text');
		$fields[]=array('name'=>'achv_ytd_unit','type'=>'nvarchar','size'=>50,'caption'=>'achv_ytd_unit','control'=>'text');
		$fields[]=array('name'=>'achv_ytd_amount','type'=>'nvarchar','size'=>50,'caption'=>'achv_ytd_amount','control'=>'text');
		$fields[]=array('name'=>'insentif_type','type'=>'nvarchar','size'=>50,'caption'=>'insentif_type','control'=>'text');
		$fields[]=array('name'=>'insentif_adm_prc','type'=>'nvarchar','size'=>50,'caption'=>'insentif_adm_prc','control'=>'text');
		$fields[]=array('name'=>'insentif_adm_amount','type'=>'nvarchar','size'=>50,'caption'=>'insentif_adm_amount','control'=>'text');
		$fields[]=array('name'=>'insentif_insr_unit_amount','type'=>'nvarchar','size'=>50,'caption'=>'insentif_insr_unit_amount','control'=>'text');
		$fields[]=array('name'=>'insentif_insr_prc','type'=>'nvarchar','size'=>50,'caption'=>'insentif_insr_prc','control'=>'text');
		$fields[]=array('name'=>'csl_amount','type'=>'nvarchar','size'=>50,'caption'=>'csl_amount','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function DpMaster() {
		$this->table_name="ls_dp_master";
		$this->primary_key="id";
		$fields[]=array('name'=>'dp_id','type'=>'nvarchar','size'=>50,'caption'=>'dp_id','control'=>'text');
		$fields[]=array('name'=>'date_trans','type'=>'nvarchar','size'=>50,'caption'=>'date_trans','control'=>'text');
		$fields[]=array('name'=>'dp_type','type'=>'nvarchar','size'=>50,'caption'=>'dp_type','control'=>'text');
		$fields[]=array('name'=>'dp_person','type'=>'nvarchar','size'=>50,'caption'=>'dp_person','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'nvarchar','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function EmpMaster() {
		$this->table_name="ls_emp_master";
		$this->primary_key="emp_id";
		$fields[]=array('name'=>'emp_id','type'=>'nvarchar','size'=>50,'caption'=>'emp_id','control'=>'text');
		$fields[]=array('name'=>'first_name','type'=>'nvarchar','size'=>50,'caption'=>'first_name','control'=>'text');
		$fields[]=array('name'=>'last_name','type'=>'nvarchar','size'=>50,'caption'=>'last_name','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'street','control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>50,'caption'=>'suite','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'city','control'=>'text');
		$fields[]=array('name'=>'zip_pos','type'=>'nvarchar','size'=>50,'caption'=>'zip_pos','control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>50,'caption'=>'region','control'=>'text');
		$fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>'province','control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>'country','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'phone','control'=>'text');
		$fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>'fax','control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>50,'caption'=>'email','control'=>'text');
		$fields[]=array('name'=>'bank_name','type'=>'nvarchar','size'=>50,'caption'=>'bank_name','control'=>'text');
		$fields[]=array('name'=>'bank_acc_number','type'=>'nvarchar','size'=>50,'caption'=>'bank_acc_number','control'=>'text');
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'brach_id','type'=>'nvarchar','size'=>50,'caption'=>'brach_id','control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function InsentifData() {
		$this->table_name="ls_insentif_data";
		$this->primary_key="id";
		$fields[]=array('name'=>'brach_id','type'=>'nvarchar','size'=>50,'caption'=>'brach_id','control'=>'text');
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'ref_doc','type'=>'nvarchar','size'=>50,'caption'=>'ref_doc','control'=>'text');
		$fields[]=array('name'=>'ref_date','type'=>'nvarchar','size'=>50,'caption'=>'ref_date','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'nvarchar','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'is_paid','type'=>'nvarchar','size'=>50,'caption'=>'is_paid','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function InsentifMaster() {
		$this->table_name="ls_insentif_master";
		$this->primary_key="id";
		$fields[]=array('name'=>'insf_id','type'=>'nvarchar','size'=>50,'caption'=>'insf_id','control'=>'text');
		$fields[]=array('name'=>'insf_type','type'=>'nvarchar','size'=>50,'caption'=>'insf_type','control'=>'text');
		$fields[]=array('name'=>'unit_sold','type'=>'nvarchar','size'=>50,'caption'=>'unit_sold','control'=>'text');
		$fields[]=array('name'=>'unit_amount','type'=>'nvarchar','size'=>50,'caption'=>'unit_amount','control'=>'text');
		$fields[]=array('name'=>'description','type'=>'nvarchar','size'=>50,'caption'=>'description','control'=>'text');
		$fields[]=array('name'=>'valid_from','type'=>'nvarchar','size'=>50,'caption'=>'valid_from','control'=>'text');
		$fields[]=array('name'=>'valid_to','type'=>'nvarchar','size'=>50,'caption'=>'valid_to','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function InsrMaster() {
		$this->table_name="ls_insr_master";
		$this->primary_key="id";
		$fields[]=array('name'=>'insr_id','type'=>'nvarchar','size'=>50,'caption'=>'insr_id','control'=>'text');
		$fields[]=array('name'=>'insr_company','type'=>'nvarchar','size'=>50,'caption'=>'insr_company','control'=>'text');
		$fields[]=array('name'=>'insr_group','type'=>'nvarchar','size'=>50,'caption'=>'insr_group','control'=>'text');
		$fields[]=array('name'=>'insr_type','type'=>'nvarchar','size'=>50,'caption'=>'insr_type','control'=>'text');
		$fields[]=array('name'=>'insr_object','type'=>'nvarchar','size'=>50,'caption'=>'insr_object','control'=>'text');
		$fields[]=array('name'=>'join_date','type'=>'nvarchar','size'=>50,'caption'=>'join_date','control'=>'text');
		$fields[]=array('name'=>'first_name','type'=>'nvarchar','size'=>50,'caption'=>'first_name','control'=>'text');
		$fields[]=array('name'=>'last_name','type'=>'nvarchar','size'=>50,'caption'=>'last_name','control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>50,'caption'=>'street','control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>50,'caption'=>'suite','control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>50,'caption'=>'city','control'=>'text');
		$fields[]=array('name'=>'zip_pos','type'=>'nvarchar','size'=>50,'caption'=>'zip_pos','control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>50,'caption'=>'region','control'=>'text');
		$fields[]=array('name'=>'province','type'=>'nvarchar','size'=>50,'caption'=>'province','control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>50,'caption'=>'country','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'phone','control'=>'text');
		$fields[]=array('name'=>'fax','type'=>'nvarchar','size'=>50,'caption'=>'fax','control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>50,'caption'=>'email','control'=>'text');
		$fields[]=array('name'=>'bank_name','type'=>'nvarchar','size'=>50,'caption'=>'bank_name','control'=>'text');
		$fields[]=array('name'=>'bank_acc_number','type'=>'nvarchar','size'=>50,'caption'=>'bank_acc_number','control'=>'text');
		$fields[]=array('name'=>'top_month','type'=>'nvarchar','size'=>50,'caption'=>'top_month','control'=>'text');
		$fields[]=array('name'=>'buy_rate_prc','type'=>'nvarchar','size'=>50,'caption'=>'buy_rate_prc','control'=>'text');
		$fields[]=array('name'=>'sell_rate_prc','type'=>'nvarchar','size'=>50,'caption'=>'sell_rate_prc','control'=>'text');
		$fields[]=array('name'=>'deal_portion_rate_prc','type'=>'nvarchar','size'=>50,'caption'=>'deal_portion_rate_prc','control'=>'text');
		$fields[]=array('name'=>'policy_fee','type'=>'nvarchar','size'=>50,'caption'=>'policy_fee','control'=>'text');
		$fields[]=array('name'=>'stamp_fee','type'=>'nvarchar','size'=>50,'caption'=>'stamp_fee','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	
	function Inventoryprices() {
		$this->table_name="ls_inventoryprices";
		$this->primary_key="id";
		$fields[]=array('name'=>'item_number','type'=>'nvarchar','size'=>50,'caption'=>'item_number','control'=>'text');
		$fields[]=array('name'=>'price_id','type'=>'nvarchar','size'=>50,'caption'=>'price_id','control'=>'text');
		$fields[]=array('name'=>'price_desc','type'=>'nvarchar','size'=>50,'caption'=>'price_desc','control'=>'text');
		$fields[]=array('name'=>'item_type','type'=>'nvarchar','size'=>50,'caption'=>'item_type','control'=>'text');
		$fields[]=array('name'=>'item_brand','type'=>'nvarchar','size'=>50,'caption'=>'item_brand','control'=>'text');
		$fields[]=array('name'=>'item_model','type'=>'nvarchar','size'=>50,'caption'=>'item_model','control'=>'text');
		$fields[]=array('name'=>'item_price','type'=>'nvarchar','size'=>50,'caption'=>'item_price','control'=>'text');
		$fields[]=array('name'=>'max_loan_month','type'=>'nvarchar','size'=>50,'caption'=>'max_loan_month','control'=>'text');
		$fields[]=array('name'=>'disc_amount','type'=>'nvarchar','size'=>50,'caption'=>'disc_amount','control'=>'text');
		$fields[]=array('name'=>'dp_amount','type'=>'nvarchar','size'=>50,'caption'=>'dp_amount','control'=>'text');
		$fields[]=array('name'=>'insr_company','type'=>'nvarchar','size'=>50,'caption'=>'insr_company','control'=>'text');
		$fields[]=array('name'=>'insr_name','type'=>'nvarchar','size'=>50,'caption'=>'insr_name','control'=>'text');
		$fields[]=array('name'=>'insr_policy_no','type'=>'nvarchar','size'=>50,'caption'=>'insr_policy_no','control'=>'text');
		$fields[]=array('name'=>'insr_order_no','type'=>'nvarchar','size'=>50,'caption'=>'insr_order_no','control'=>'text');
		$fields[]=array('name'=>'insr_date_from','type'=>'nvarchar','size'=>50,'caption'=>'insr_date_from','control'=>'text');
		$fields[]=array('name'=>'insr_date_to','type'=>'nvarchar','size'=>50,'caption'=>'insr_date_to','control'=>'text');
		$fields[]=array('name'=>'insr_amount','type'=>'nvarchar','size'=>50,'caption'=>'insr_amount','control'=>'text');
		$fields[]=array('name'=>'flat_rate_prc','type'=>'nvarchar','size'=>50,'caption'=>'flat_rate_prc','control'=>'text');
		$fields[]=array('name'=>'loan_type','type'=>'nvarchar','size'=>50,'caption'=>'loan_type','control'=>'text');
		$fields[]=array('name'=>'adm_cost','type'=>'nvarchar','size'=>50,'caption'=>'adm_cost','control'=>'text');
		$fields[]=array('name'=>'gross_dp_min','type'=>'nvarchar','size'=>50,'caption'=>'gross_dp_min','control'=>'text');
		$fields[]=array('name'=>'gross_dp_max','type'=>'nvarchar','size'=>50,'caption'=>'gross_dp_max','control'=>'text');
		$fields[]=array('name'=>'firstinst_amount','type'=>'nvarchar','size'=>50,'caption'=>'firstinst_amount','control'=>'text');
		$fields[]=array('name'=>'inst_amount','type'=>'nvarchar','size'=>50,'caption'=>'inst_amount','control'=>'text');
		$fields[]=array('name'=>'valid_date_from','type'=>'nvarchar','size'=>50,'caption'=>'valid_date_from','control'=>'text');
		$fields[]=array('name'=>'valid_date_to','type'=>'nvarchar','size'=>50,'caption'=>'valid_date_to','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function InventoryProdDetail() {
		$this->table_name="ls_inventory_prod_detail";
		$this->primary_key="id";
		$fields[]=array('name'=>'item_number','type'=>'nvarchar','size'=>50,'caption'=>'item_number','control'=>'text');
		$fields[]=array('name'=>'obj_iem_id','type'=>'nvarchar','size'=>50,'caption'=>'obj_iem_id','control'=>'text');
		$fields[]=array('name'=>'item_type','type'=>'nvarchar','size'=>50,'caption'=>'item_type','control'=>'text');
		$fields[]=array('name'=>'item_brand','type'=>'nvarchar','size'=>50,'caption'=>'item_brand','control'=>'text');
		$fields[]=array('name'=>'item_model','type'=>'nvarchar','size'=>50,'caption'=>'item_model','control'=>'text');
		$fields[]=array('name'=>'item_price','type'=>'nvarchar','size'=>50,'caption'=>'item_price','control'=>'text');
		$fields[]=array('name'=>'disc_amount','type'=>'nvarchar','size'=>50,'caption'=>'disc_amount','control'=>'text');
		$fields[]=array('name'=>'dp_amount','type'=>'nvarchar','size'=>50,'caption'=>'dp_amount','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'nvarchar','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'made_in','type'=>'nvarchar','size'=>50,'caption'=>'made_in','control'=>'text');
		$fields[]=array('name'=>'mfg_year','type'=>'nvarchar','size'=>50,'caption'=>'mfg_year','control'=>'text');
		$fields[]=array('name'=>'colour','type'=>'nvarchar','size'=>50,'caption'=>'colour','control'=>'text');
		$fields[]=array('name'=>'name_on_bpkp','type'=>'nvarchar','size'=>50,'caption'=>'name_on_bpkp','control'=>'text');
		$fields[]=array('name'=>'frame_no','type'=>'nvarchar','size'=>50,'caption'=>'frame_no','control'=>'text');
		$fields[]=array('name'=>'engine_no','type'=>'nvarchar','size'=>50,'caption'=>'engine_no','control'=>'text');
		$fields[]=array('name'=>'engine_capacity','type'=>'nvarchar','size'=>50,'caption'=>'engine_capacity','control'=>'text');
		$fields[]=array('name'=>'police_no','type'=>'nvarchar','size'=>50,'caption'=>'police_no','control'=>'text');
		$fields[]=array('name'=>'insr_policy_no','type'=>'nvarchar','size'=>50,'caption'=>'insr_policy_no','control'=>'text');
		$fields[]=array('name'=>'insr_order_no','type'=>'nvarchar','size'=>50,'caption'=>'insr_order_no','control'=>'text');
		$fields[]=array('name'=>'insr_date_from','type'=>'nvarchar','size'=>50,'caption'=>'insr_date_from','control'=>'text');
		$fields[]=array('name'=>'insr_date_to','type'=>'nvarchar','size'=>50,'caption'=>'insr_date_to','control'=>'text');
		$fields[]=array('name'=>'insr_amount','type'=>'nvarchar','size'=>50,'caption'=>'insr_amount','control'=>'text');
		$fields[]=array('name'=>'obj_desc','type'=>'nvarchar','size'=>50,'caption'=>'obj_desc','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>50,'caption'=>'comments','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function InvoiceDetail() {
		$this->table_name="ls_invoice_detail";
		$this->primary_key="id";
		$fields[]=array('name'=>'invoice_number','type'=>'nvarchar','size'=>50,'caption'=>'invoice_number','control'=>'text');
		$fields[]=array('name'=>'item_number','type'=>'nvarchar','size'=>50,'caption'=>'item_number','control'=>'text');
		$fields[]=array('name'=>'description','type'=>'nvarchar','size'=>50,'caption'=>'description','control'=>'text');
		$fields[]=array('name'=>'qty','type'=>'nvarchar','size'=>50,'caption'=>'qty','control'=>'text');
		$fields[]=array('name'=>'price','type'=>'nvarchar','size'=>50,'caption'=>'price','control'=>'text');
		$fields[]=array('name'=>'disc_prc','type'=>'nvarchar','size'=>50,'caption'=>'disc_prc','control'=>'text');
		$fields[]=array('name'=>'disc_amount','type'=>'nvarchar','size'=>50,'caption'=>'disc_amount','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'nvarchar','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'item_type','type'=>'nvarchar','size'=>50,'caption'=>'item_type','control'=>'text');
		$fields[]=array('name'=>'item_brand','type'=>'nvarchar','size'=>50,'caption'=>'item_brand','control'=>'text');
		$fields[]=array('name'=>'item_model','type'=>'nvarchar','size'=>50,'caption'=>'item_model','control'=>'text');
		$fields[]=array('name'=>'made_in','type'=>'nvarchar','size'=>50,'caption'=>'made_in','control'=>'text');
		$fields[]=array('name'=>'mfg_year','type'=>'nvarchar','size'=>50,'caption'=>'mfg_year','control'=>'text');
		$fields[]=array('name'=>'colour','type'=>'nvarchar','size'=>50,'caption'=>'colour','control'=>'text');
		$fields[]=array('name'=>'name_on_bpkp','type'=>'nvarchar','size'=>50,'caption'=>'name_on_bpkp','control'=>'text');
		$fields[]=array('name'=>'frame_no','type'=>'nvarchar','size'=>50,'caption'=>'frame_no','control'=>'text');
		$fields[]=array('name'=>'engine_no','type'=>'nvarchar','size'=>50,'caption'=>'engine_no','control'=>'text');
		$fields[]=array('name'=>'engine_capacity','type'=>'nvarchar','size'=>50,'caption'=>'engine_capacity','control'=>'text');
		$fields[]=array('name'=>'police_no','type'=>'nvarchar','size'=>50,'caption'=>'police_no','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function InvoiceHeader() {
		$this->table_name="ls_invoice_header";
		$this->primary_key="invoice_number";
		$fields[]=array('name'=>'loan_id','type'=>'nvarchar','size'=>50,'caption'=>'loan_id','control'=>'text');
		$fields[]=array('name'=>'idx_month','type'=>'int','size'=>5,'caption'=>'idx_month','control'=>'text');
		$fields[]=array('name'=>'invoice_number','type'=>'nvarchar','size'=>50,'caption'=>'invoice_number','control'=>'text');
		$fields[]=array('name'=>'invoice_date','type'=>'nvarchar','size'=>50,'caption'=>'invoice_date','control'=>'text');
		$fields[]=array('name'=>'invoice_type','type'=>'nvarchar','size'=>50,'caption'=>'invoice_type','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'float','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'paid','type'=>'int','size'=>50,'caption'=>'paid','control'=>'text');
		$fields[]=array('name'=>'date_paid','type'=>'datetime','size'=>50,'caption'=>'date_paid','control'=>'text');
		$fields[]=array('name'=>'payment_method','type'=>'nvarchar','size'=>50,'caption'=>'payment_method','control'=>'text');
		$fields[]=array('name'=>'amount_paid','type'=>'float','size'=>50,'caption'=>'amount_paid','control'=>'text');
		$fields[]=array('name'=>'voucher','type'=>'nvarchar','size'=>50,'caption'=>'voucher','control'=>'text');
		$fields[]=array('name'=>'cust_deal_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_deal_id','control'=>'text');
		$fields[]=array('name'=>'cust_deal_ship_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_deal_ship_id','control'=>'text');
		$fields[]=array('name'=>'gross_amount','type'=>'float','size'=>50,'caption'=>'gross_amount','control'=>'text');
		$fields[]=array('name'=>'disc_amount','type'=>'float','size'=>50,'caption'=>'disc_amount','control'=>'text');
		$fields[]=array('name'=>'insr_amount','type'=>'float','size'=>50,'caption'=>'insr_amount','control'=>'text');
		$fields[]=array('name'=>'admin_amount','type'=>'float','size'=>50,'caption'=>'admin_amount','control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function ItemMaster() {
		$this->table_name="ls_item_master";
		$this->primary_key="item_number";
		$fields[]=array('name'=>'item_number','type'=>'nvarchar','size'=>50,'caption'=>'item_number',
		'control'=>'text','group'=>'General','required'=>FALSE,'unique'=>FALSE,
		'validation'=>'alpha_dash','ref_table_db_name' => '','ref_field_db_name' => '',
		'ref_field_type' => '','type_relation' => '','form_default' =>'','visible'=>TRUE,
		'form_visible' => TRUE);
		$fields[]=array('name'=>'description','type'=>'nvarchar','size'=>50,'caption'=>'description','control'=>'text');
		$fields[]=array('name'=>'category','type'=>'nvarchar','size'=>50,'caption'=>'category','control'=>'text');
		$fields[]=array('name'=>'unit','type'=>'nvarchar','size'=>50,'caption'=>'unit','control'=>'text');
		$fields[]=array('name'=>'retail','type'=>'double','size'=>0,'caption'=>'retail','control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function CustCard() {
		$this->table_name="ls_cust_crcard";
		$this->primary_key="id";
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id',
		'control'=>'text','group'=>'General','required'=>FALSE,'unique'=>FALSE,
		'validation'=>'alpha_dash','ref_table_db_name' => '','ref_field_db_name' => '',
		'ref_field_type' => '','type_relation' => '','form_default' =>'','visible'=>TRUE,
		'form_visible' => TRUE);
		$fields[]=array('name'=>'card_no','type'=>'nvarchar','size'=>50,'caption'=>'card_no','control'=>'text');
		$fields[]=array('name'=>'card_bank','type'=>'nvarchar','size'=>50,'caption'=>'card_no','control'=>'text');
		$fields[]=array('name'=>'card_exp','type'=>'nvarchar','size'=>50,'caption'=>'card_exp','control'=>'text');
		$fields[]=array('name'=>'card_type','type'=>'nvarchar','size'=>50,'caption'=>'card_type','control'=>'text');
		$fields[]=array('name'=>'card_type_etc','type'=>'nvarchar','size'=>50,'caption'=>'card_type_etc','control'=>'text');
		$fields[]=array('name'=>'card_limit','type'=>'nvarchar','size'=>50,'caption'=>'card_limit','control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function LoanMaster() {
		$this->table_name="ls_loan_master";
		$this->primary_key="id";
		$fields[]=array('name'=>'cust_id','type'=>'nvarchar','size'=>50,'caption'=>'cust_id','control'=>'text');
		$fields[]=array('name'=>'loan_id','type'=>'nvarchar','size'=>50,'caption'=>'Loan Id','control'=>'text');
		$fields[]=array('name'=>'app_id','type'=>'nvarchar','size'=>50,'caption'=>'App Id','control'=>'text');
		$fields[]=array('name'=>'loan_date','type'=>'datetime','size'=>50,'caption'=>'loan_date','control'=>'date');
		$fields[]=array('name'=>'loan_amount','type'=>'float','size'=>50,'caption'=>'loan_amount','control'=>'text');
		$fields[]=array('name'=>'interest_amount','type'=>'float','size'=>50,'caption'=>'interest_amount','control'=>'text');
		$fields[]=array('name'=>'dp_amount','type'=>'float','size'=>50,'caption'=>'dp_amount','control'=>'text');
		$fields[]=array('name'=>'adm_amount','type'=>'float','size'=>50,'caption'=>'adm_amount','control'=>'text');
		$fields[]=array('name'=>'insr_amount','type'=>'float','size'=>50,'caption'=>'insr_amount','control'=>'text');
		$fields[]=array('name'=>'ar_amount','type'=>'float','size'=>50,'caption'=>'ar_amount','control'=>'text');
		$fields[]=array('name'=>'ar_bal_amount','type'=>'float','size'=>50,'caption'=>'ar_bal_amount','control'=>'text');
		$fields[]=array('name'=>'first_dp_amount','type'=>'float','size'=>50,'caption'=>'first_dp_amount','control'=>'text');
		$fields[]=array('name'=>'inst_amount','type'=>'float','size'=>50,'caption'=>'Cicilan','control'=>'text');
		$fields[]=array('name'=>'first_paid_amount','type'=>'float','size'=>50,'caption'=>'first_paid_amount','control'=>'text');
		$fields[]=array('name'=>'first_paid_date','type'=>'datetime','size'=>50,'caption'=>'first_paid_date','control'=>'text');
		$fields[]=array('name'=>'first_adm_amount','type'=>'float','size'=>50,'caption'=>'first_adm_amount','control'=>'text');
		$fields[]=array('name'=>'first_adm_date','type'=>'datetime','size'=>50,'caption'=>'first_adm_date','control'=>'text');
		$fields[]=array('name'=>'first_insr_amount','type'=>'float','size'=>50,'caption'=>'first_insr_amount','control'=>'text');
		$fields[]=array('name'=>'first_insr_date','type'=>'datetime','size'=>50,'caption'=>'first_insr_date','control'=>'text');
		$fields[]=array('name'=>'paid','type'=>'int','size'=>1,'caption'=>'paid','control'=>'text');
		$fields[]=array('name'=>'status','type'=>'nvarchar','size'=>50,'caption'=>'status','control'=>'text');
		$fields[]=array('name'=>'first_dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'first_dealer_id','control'=>'text');
		$fields[]=array('name'=>'max_month','type'=>'int','size'=>5,'caption'=>'max_month','control'=>'text');
		$fields[]=array('name'=>'interest_percent','type'=>'float','size'=>50,'caption'=>'interest_percent','control'=>'text');
		$fields[]=array('name'=>'insr_percent','type'=>'float','size'=>50,'caption'=>'insr_percent','control'=>'text');
		$fields[]=array('name'=>'dp_percent','type'=>'float','size'=>50,'caption'=>'dp_percent','control'=>'text');
		$fields[]=array('name'=>'dealer_id','type'=>'nvarchar','size'=>50,'caption'=>'dealer_id','control'=>'text');
		$fields[]=array('name'=>'dealer_name','type'=>'nvarchar','size'=>50,'caption'=>'dealer_name','control'=>'text');

		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function LoanObjItems() {
		$this->table_name="ls_loan_obj_items";
		$this->primary_key="id";
		$fields[]=array('name'=>'obj_item_id','type'=>'nvarchar','size'=>50,'caption'=>'obj_item_id','control'=>'text');
		$fields[]=array('name'=>'qty','type'=>'float','size'=>50,'caption'=>'qty','control'=>'text');
		$fields[]=array('name'=>'unit','type'=>'nvarchar','size'=>50,'caption'=>'unit','control'=>'text');
		$fields[]=array('name'=>'price','type'=>'float','size'=>50,'caption'=>'price','control'=>'text');
		$fields[]=array('name'=>'discount','type'=>'float','size'=>50,'caption'=>'discount','control'=>'text');
		$fields[]=array('name'=>'disc_amount','type'=>'float','size'=>50,'caption'=>'disc_amount','control'=>'text');
		$fields[]=array('name'=>'amount','type'=>'float','size'=>50,'caption'=>'amount','control'=>'text');
		$fields[]=array('name'=>'loan_id','type'=>'nvarchar','size'=>50,'caption'=>'Loan Id','control'=>'text');
		$fields[]=array('name'=>'line_type','type'=>'nvarchar','size'=>50,'caption'=>'line_type','control'=>'text');
		$fields[]=array('name'=>'price_list_id','type'=>'nvarchar','size'=>50,'caption'=>'price_list_id','control'=>'text');
		$fields[]=array('name'=>'item_type','type'=>'nvarchar','size'=>50,'caption'=>'item_type','control'=>'text');
		$fields[]=array('name'=>'item_brand','type'=>'nvarchar','size'=>50,'caption'=>'item_brand','control'=>'text');
		$fields[]=array('name'=>'item_model','type'=>'nvarchar','size'=>50,'caption'=>'item_model','control'=>'text');
		$fields[]=array('name'=>'dp_amount','type'=>'float','size'=>50,'caption'=>'dp_amount','control'=>'text');
		$fields[]=array('name'=>'made_in','type'=>'nvarchar','size'=>50,'caption'=>'made_in','control'=>'text');
		$fields[]=array('name'=>'mfg_year','type'=>'nvarchar','size'=>50,'caption'=>'mfg_year','control'=>'text');
		$fields[]=array('name'=>'colour','type'=>'nvarchar','size'=>50,'caption'=>'colour','control'=>'text');
		$fields[]=array('name'=>'name_on_bpkp','type'=>'nvarchar','size'=>50,'caption'=>'name_on_bpkp','control'=>'text');
		$fields[]=array('name'=>'frame_no','type'=>'nvarchar','size'=>50,'caption'=>'frame_no','control'=>'text');
		$fields[]=array('name'=>'engine_no','type'=>'nvarchar','size'=>50,'caption'=>'engine_no','control'=>'text');
		$fields[]=array('name'=>'engine_capacity','type'=>'nvarchar','size'=>50,'caption'=>'engine_capacity','control'=>'text');
		$fields[]=array('name'=>'police_no','type'=>'nvarchar','size'=>50,'caption'=>'police_no','control'=>'text');
		$fields[]=array('name'=>'insr_company','type'=>'nvarchar','size'=>50,'caption'=>'insr_company','control'=>'text');
		$fields[]=array('name'=>'insr_policy_no','type'=>'nvarchar','size'=>50,'caption'=>'insr_policy_no','control'=>'text');
		$fields[]=array('name'=>'insr_name','type'=>'nvarchar','size'=>50,'caption'=>'insr_name','control'=>'text');
		$fields[]=array('name'=>'insr_order_no','type'=>'nvarchar','size'=>50,'caption'=>'insr_order_no','control'=>'text');
		$fields[]=array('name'=>'insr_date_from','type'=>'datetime','size'=>50,'caption'=>'insr_date_from','control'=>'text');
		$fields[]=array('name'=>'insr_date_to','type'=>'datetime','size'=>50,'caption'=>'insr_date_to','control'=>'text');
		$fields[]=array('name'=>'insr_amount','type'=>'float','size'=>50,'caption'=>'insr_amount','control'=>'text');
		$fields[]=array('name'=>'flat_rate_prc','type'=>'float','size'=>50,'caption'=>'flat_rate_prc','control'=>'text');
		$fields[]=array('name'=>'obj_desc','type'=>'nvarchar','size'=>50,'caption'=>'obj_desc','control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>150,'caption'=>'comments','control'=>'text');

		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"Id",'control'=>'text');
	
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	function ls_counter() {
		$this->table_name="ls_counter";
		$this->primary_key="counter_id";
		$fields[]=array('name'=>'counter_id','type'=>'nvarchar','size'=>50,'caption'=>'Kode','control'=>'text');
		$fields[]=array('name'=>'counter_name','type'=>'nvarchar','size'=>50,'caption'=>'Nama Counter','control'=>'text');
		$fields[]=array('name'=>'area','type'=>'nvarchar','size'=>50,'caption'=>'Area','control'=>'text');
		$fields[]=array('name'=>'sales_agent','type'=>'nvarchar','size'=>50,'caption'=>'Sales Agent','control'=>'text');
		$fields[]=array('name'=>'address','type'=>'nvarchar','size'=>250,'caption'=>'Alamat','control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>'Phone','control'=>'text');
		$fields[]=array('name'=>'join_date','type'=>'datetime','size'=>50,'caption'=>'Tgl Gabung','control'=>'text');
		$fields[]=array('name'=>'target','type'=>'float','size'=>50,'caption'=>'Target','control'=>'text');
		$fields[]=array('name'=>'active','type'=>'int','size'=>5,'caption'=>'Aktif','control'=>'text');

		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}	
	
}


?>