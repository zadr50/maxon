<?php
class Cust_master_model extends CI_Model {

	private $primary_key='cust_id';
	private $table_name='ls_cust_master';
	private $_personal=null;
	private $_company=null;

	function __construct(){
		parent::__construct();
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['cust_name']))$nama=$_GET['cust_name'];
		if($nama!='')$this->db->where("cust_name like '%$nama%'");

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
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->get($this->table_name);
		if($ok){
			$q=$this->db->where($this->primary_key,$id)->get("ls_cust_company");
			if($q) $this->_company=$q->row();
			$q=$this->db->where($this->primary_key,$id)->get("ls_cust_personal");
			if($q) $this->_personal=$q->row();
		}
		return $ok;
	}
	function personal() {
		return (array) $this->_personal;
	}
	function company() {
		return (array) $this->_company;
	}
	function save($data){
	
		$cm=$this->parse_data_cust_master($data);	
		$lok=$this->db->insert('ls_cust_master',$cm);
		
		if($lok)$this->save_personal($data);
		if($lok)$this->save_company($data);

		return $lok;

	}
	function update($id,$data){
		$cm=$this->parse_data_cust_master($data);
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$cm);
		if($ok)$this->save_personal($data);
		if($ok)$this->save_company($data);
		return $ok;
	}
	function delete($id){
		$numrow=$this->db->count_all("ls_app_master where cust_id='$id'");
		if($numrow>0){
			return false;
		}
		
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
		$this->db->where("cust_id",$id);
		$this->db->delete("ls_cust_company");
		$this->db->where("cust_id",$id);
		$this->db->delete("ls_cust_personal");
		return true;
	}
	function save_company($data){
		$com['cust_id']=$data['cust_id'];
		$com['comp_name']=$data['comp_name'];
		$com['comp_desc']=$data['comp_desc'];
		$com['job_status']=$data['job_status'];
		$com['job_status_etc']=$data['job_status_etc'];
		$com['since_year']=$data['since_year'];
		$com['bussiness_type']=$data['bussiness_type'];
		$com['job_level']=$data['job_level'];
		$com['job_type']=$data['job_type'];
		$com['job_type_etc']=$data['job_type_etc'];
		$com['job_type_etc']=$data['job_type_etc'];
		$com['city']=$data['com_city'];
		$com['kel']=$data['com_kel'];
		$com['kec']=$data['com_kec'];
		$com['street']=$data['com_street'];
		$com['rtrw']=$data['com_rtrw'];
		$com['zip_pos']=$data['com_zip_pos'];
		$com['emp_status']=$data['emp_status'];
		$com['emp_status_etc']=$data['emp_status_etc'];
		$com['total_employee']=$data['total_employee'];
		$com['contact_phone']=$data['com_contact_phone'];
		$com['office_status']=$data['office_status'];
		$com['phone_ext']=$data['phone_ext'];
		$com['office_status_etc']=$data['office_status_etc'];
		$com['spv_name']=$data['spv_name'];
		$com['hrd_name']=$data['hrd_name'];
		if($q=$this->db->where($this->primary_key,$com['cust_id'])->get("ls_cust_company")->row()){
			$this->db->where($this->primary_key,$com['cust_id'])->update("ls_cust_company",$com);
		} else {
			$this->db->insert('ls_cust_company',$com);	
		}
	}
	function save_personal($data){
		$cp['cust_id']=$data['cust_id'];
		$cp['gender']=$data['gender'];
		$cp['birth_place']=$data['birth_place'];
		$cp['birth_date']=date('Y-m-d H:i:s', strtotime($data['birth_date']));
		$cp['house_status']=$data['house_status'];
		$cp['marital_status']=$data['marital_status'];
		$cp['no_of_dependents']=$data['no_of_dependents'];
		$cp['salary']=$data['salary'];
		$cp['salary_source']=$data['salary_source'];
		$cp['spouse_salary']=$data['spouse_salary'];
		$cp['spouse_salary_source']=$data['spouse_salary_source'];
		$cp['other_income']=$data['other_income'];
		$cp['other_income_source']=$data['other_income_source'];
		$cp['deduct']=$data['deduct'];
		$cp['other_loan']=$data['other_loan'];
//		$cp['deduct_source']=$data['deduct_source'];
		if($q=$this->db->where($this->primary_key,$cp['cust_id'])->get("ls_cust_personal")->row()){
			$this->db->where($this->primary_key,$cp['cust_id'])->update("ls_cust_personal",$cp);
		} else {
			$this->db->insert('ls_cust_personal',$cp);	
		}
	}
	function parse_data_cust_master($data){
		$cm['cust_id']=$data['cust_id'];	
		$cm['cust_name']=$data['cust_name'];
		$cm['street']=$data['street'];
		$cm['first_name']=$data['first_name'];
		$cm['last_name']=$data['last_name'];
		
		$cm['rt']=$data['rt'];
		$cm['rw']=$data['rw'];
		$cm['rtrw']=$data['rt'].'/'.$data['rt'];
		$cm['call_name']=$data['call_name'];
		$cm['kel']=$data['kel'];
		$cm['kec']=$data['kec'];
		$cm['id_card_no']=$data['id_card_no'];
		$cm['id_card_exp']=date('Y-m-d H:i:s', strtotime($data['id_card_exp']));
		$cm['city']=$data['city'];
		$cm['zip_pos']=$data['zip_pos'];
		$cm['mother_name']=$data['mother_name'];
		$cm['spouse_name']=$data['spouse_name'];
		$cm['spouse_birth_date']=date('Y-m-d H:i:s', strtotime($data['spouse_birth_date']));
		$cm['spouse_phone']=$data['spouse_phone'];
		$cm['spouse_birth_place']=$data['spouse_birth_place'];		
		$cm['spouse_hp']=$data['spouse_hp'];
		$cm['phone']=$data['phone'];
//		$cm['cust_type']=$data['cust_type'];
//		$cm['is_active']=$data['is_active'];
		$cm['lama_thn']=$data['lama_thn'];
		$cm['suite']=$data['suite'];
		$cm['region']=$data['region'];
		$cm['province']=$data['province'];
		$cm['country']=$data['country'];
		$cm['fax']=$data['fax'];
		$cm['bank_name']=$data['bank_name'];
		$cm['bank_acc_number']=$data['bank_acc_number'];
		$cm['credit_card_number']=$data['credit_card_number'];
		$cm['is_send_email']=$data['is_send_email'];
		$cm['parent_cust_id']=$data['parent_cust_id'];
		$cm['email']=$data['email'];
		$cm['cust_foto']=$data['cust_foto'];
		$cm['hp']=$data['hp'];
		$cm['cust_foto_2']=$data['cust_foto_2'];
		$cm['cust_foto_3']=$data['cust_foto_3'];
		$cm['cust_foto_4']=$data['cust_foto_4'];
		$cm['cust_foto_5']=$data['cust_foto_5'];
		$cm['create_by']=$data['create_by'];
		$cm['create_date']=date('Y-m-d H:i:s', strtotime($data['create_date']));
		$cm['update_by']=user_id();
		$cm['update_date']=date('Y-m-d H:i:s');
		
		return $cm;
	}
	function add_alamat($cust_id,$data){
		$id=$data['frmAddAlamat_id'];
		unset($data['frmAddAlamat_id']);
		$this->db->where("id",$id);
		$q=$this->db->get("ls_cust_ship_to");
		if($q){
			if($row=$q->row()){
				$this->db->where("id",$id);
				$ok=$this->db->update("ls_cust_ship_to",$data);				
			} else {
				unset($data['id']);
				$ok=$this->db->insert("ls_cust_ship_to",$data);
			}
			return $ok;
		} else {
		
			return false;
		}
	}
	function delete_alamat($id){
		$this->db->where("id",$id);
		return $this->db->delete("ls_cust_ship_to");
	}
	function view_alamat($id){
		$this->db->where("id",$id);
		return $this->db->get("ls_cust_ship_to");
	}
	function add_crcard($cust_id,$data){
		$id=$data['frmAddCrCard_id'];
		unset($data['frmAddCrCard_id']);
		$this->db->where("id",$id);
		$q=$this->db->get("ls_cust_crcard");
		if($q){
			if($row=$q->row()){
				$this->db->where("id",$id);
				$ok=$this->db->update("ls_cust_crcard",$data);				
			} else {
				unset($data['id']);
				$ok=$this->db->insert("ls_cust_crcard",$data);
			}
			return $ok;
		} else {
		
			return false;
		}
	}
	function delete_crcard($id){
		$this->db->where("id",$id);
		return $this->db->delete("ls_cust_crcard");
	}
	function view_crcard($id){
		$this->db->where("id",$id);
		return $this->db->get("ls_cust_crcard");
	}	
}
?>