<?php
class Pinjaman_model extends CI_Model {

private $primary_key='loan_number';
private $table_name='hr_emp_loan';

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
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}

	function save($data){
		if($data['date_loan'])$data['date_loan']= date('Y-m-d H:i:s', strtotime($data['date_loan']));		
		if($data['loan_last_date'])$data['loan_last_date']= date('Y-m-d H:i:s', strtotime($data['loan_last_date']));		
		$data=$this->recalc($data);
		$id=$this->db->insert($this->table_name,$data);
		$this->save_cicilan($data['loan_number']);
		return $id;
	}
	function update($id,$data){
		if($data['date_loan'])$data['date_loan']= date('Y-m-d H:i:s', strtotime($data['date_loan']));		
		if($data['loan_last_date'])$data['loan_last_date']= date('Y-m-d H:i:s', strtotime($data['loan_last_date']));		
		$data=$this->recalc($data);

		$this->save_cicilan($id);

		$this->db->where($this->primary_key,$id);
		$id=$this->db->update($this->table_name,$data);
		return $id;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function recalc($data) {
		if($data['loan_count']==0)$data['loan_count']=12;
		if($data['pokok']==0)$data['pokok']=$data['loan_amount']/$data['loan_count'];
		return $data;
	}
	function save_cicilan($id) {
		$table='hr_emp_loan_schedule';
		$loan=$this->get_by_id($id)->row();
		$tanggal=$loan->date_loan;
		$awal=$loan->loan_amount;
		$pokok=$loan->pokok;
		$bunga=$loan->bunga;
		
		for($i=0;$i<$loan->loan_count-1;$i++) {
			$tanggal = date('Y-m-d', strtotime("+1 months", strtotime($tanggal)));

		
			$data['loan_number']=$loan->loan_number;
			$data['no_urut']=$i+1;
			$data['tanggal_jth_tempo']=$tanggal;
			$data['awal']=$awal;
			$data['pokok']=$pokok;
			$data['bunga']=$bunga;
			$data['angsuran']=$data['pokok']+$data['bunga'];
			$data['akhir']=$awal-$data['angsuran'];
 

			 
			
			$this->db->where('loan_number',$id);
			$this->db->where('no_urut',$i+1);
			if($this->db->get($table)->row()){
				$this->db->where('loan_number',$id);
				$this->db->where('no_urut',$i+1);
				
				unset($data['loan_number']);
				unset($data['no_urut']);
				$this->db->update($table,$data);
			} else {
				 
				$this->db->insert($table,$data);
			}
			//echo mysql_error();
			$awal=$data['akhir'];
		}
	}

}
