<?php
class Paycheck_sal_com_model extends CI_Model {

	private $primary_key='id';
	private $table_name='hr_paycheck_sal_comp';
	public $employee_id="";
	public $paycheck_no="";
	private $group="";
	private $gaji_pokok=0,$salary=0;
	private $total_pendapatan=0,$total_potongan=0;
	private $hari_hadir=0,$hari_absen=0;
	
	function __construct(){
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		$this->load->model('payroll/employee_model');
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_id($pay_no,$kode){
		$id=null;
		$this->db->select("id")->where("pay_no",$pay_no);
		$this->db->where("salary_com_code",$kode);
		if($rec=$this->db->get($this->table_name)) {
			if($row=$rec->row()){
				$id=$row->id;
			}
		}
		return $id;
	}

	function save($data){
		$this->pay_no=$data['pay_no'];
		$id=$this->db->insert($this->table_name,$data);
		return $id;
	}
	function update($id,$data){
		$this->pay_no=$data['pay_no'];
		$id=$this->db->where("id",$id);
		$this->db->update($this->table_name,$data);
		return $id;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function init(){
		if($this->group==""){
			if($emp=$this->employee_model->get_by_id($this->employee_id)->row()){
				$this->group=$emp->emptype;
				$this->gaji_pokok=$emp->gp;
			}
		}		
	}
	function com_list($jenis,$is_absensi=0){
		$sql="select c.no_urut,c.salary_com_code,c.formula_string,
		c.take_home_pay,t.keterangan  as salary_com_name,c.id,t.sifat
		from hr_emp_level_com c
		left join hr_jenis_".$jenis." t on t.kode=c.salary_com_code
		where c.level_code='".$this->group."' and t.keterangan is not null 
		and t.is_absensi=$is_absensi
		order by c.no_urut";
		$data=null;
		if($q=$this->db->query($sql)){
			foreach($q->result() as $row){
				if($row->salary_com_code!=""){
				$data[]=array('no_urut'=>$row->no_urut,
					'salary_com_code'=>$row->salary_com_code,
					'salary_com_name'=>$row->salary_com_name,
					'formula_string'=>$row->formula_string,
					'take_home_pay'=>$row->take_home_pay,
					'id'=>$row->id,"sifat"=>$row->sifat,
					'amount'=>$this->value($row->salary_com_code)
					);
				}
			}
		}
		return $data;		
	}
	function tunjangan_list(){ return $this->com_list('tunjangan',0); }
	function potongan_list(){ return $this->com_list('potongan',0); }
	function absensi_list(){  return $this->com_list('tunjangan',1); }
	function value($com_code){
		if($this->paycheck_no<>""){
			$this->db->select("org_value")->where("pay_no",$this->paycheck_no);
			$this->db->where("salary_com_code",$com_code);
			if($rec=$this->db->get($this->table_name)->row()) {
				$val= $rec->org_value;
			} else {
				$val= 0;
			}			
			if($val==0 && $com_code=='G_POKOK')$val=$this->gaji_pokok;
			return $val;
		} 
	}
	function recalc($pay_no="",$group=''){		
		if($pay_no<>"")$this->paycheck_no=$pay_no;
		if($group<>"")$this->group=$group;
		if($this->paycheck_no=="" || $this->group=="") return;

		$vars=null;
		
		
		//---ABSENSI
		$s="select c.salary_com_code,c.org_value,
			c.calc_value,e.formula_string,t.sifat 
			from hr_paycheck_sal_comp c 
			left join hr_emp_level_com e on e.salary_com_code=c.salary_com_code
			join hr_jenis_tunjangan t on t.kode=e.salary_com_code
			where e.level_code='$this->group' and c.pay_no='$this->paycheck_no'
			and t.sifat='absensi'
			order by e.no_urut";
		$this->load->model("payroll/time_card_detail_model");
		$value=0;
		if($com_list=$this->db->query($s)) {
				
			foreach($com_list->result() as $com){
				$value=0;
				if($com->salary_com_code=="HARI_HADIR"){
					$value=$this->time_card_detail_model->calc_hari_hadir(
						$this->paycheck_no);
					$vars["HARI_HADIR"]=$value;
				}
				if($com->salary_com_code=="HARI_ABSEN"){
					$value=$this->time_card_detail_model->calc_hari_absen(
						$this->paycheck_no);
					$vars["HARI_ABSEN"]=$value;						
				}
				$tmp="$".$com->salary_com_code."=".$value.";";
				eval($tmp);
			}				
		}
		if($vars){
			foreach ($vars as $key => $value) {
				$s="update hr_paycheck_sal_comp 
				set org_value=".$value." where salary_com_code='".$key."' 
				and pay_no='$this->paycheck_no'";
				//echo $s."</br>";
				$this->db->query($s);
			}
		}
//			var_dump($vars);
		//---PENDAPATAN
		$s="select c.salary_com_code,c.org_value,
			c.calc_value,e.formula_string,t.sifat 
			from hr_paycheck_sal_comp c 
			left join hr_emp_level_com e on e.salary_com_code=c.salary_com_code
			join hr_jenis_tunjangan t on t.kode=e.salary_com_code
			where e.level_code='$this->group' and c.pay_no='$this->paycheck_no'
			
			order by e.no_urut";
		if($com_list=$this->db->query($s)) {
				
			foreach($com_list->result() as $com){
				$com_org_value=0;
				$vars[$com->salary_com_code]=$com->org_value;
				if($com->formula_string<>""){
					$tmp="$".$com->salary_com_code."=".$com->formula_string.";";
					eval($tmp);
					$tmp="$"."vars['".$com->salary_com_code."']=$".$com->salary_com_code.";";
					eval($tmp);
					
				} else {
					$com_org_value=$com->org_value;
					if($com_org_value=="")$com_org_value="0";
					$tmp="$".$com->salary_com_code."=".$com_org_value.";";
					eval($tmp);							
					$tmp="$"."vars['".$com->salary_com_code."']=$".$com->salary_com_code.";";
					eval($tmp);
				}
			}
		}				
		//---POTONGAN
		$s="select c.salary_com_code,c.org_value,
			c.calc_value,e.formula_string,t.sifat 
			from hr_paycheck_sal_comp c 
			left join hr_emp_level_com e on e.salary_com_code=c.salary_com_code
			join hr_jenis_potongan t on t.kode=e.salary_com_code
			where e.level_code='$this->group' and c.pay_no='$this->paycheck_no'
			order by e.no_urut";
		if($com_list=$this->db->query($s)) {
				
			foreach($com_list->result() as $com){
				$com_org_value=0;
				//$com_salary_com_code.",formula=".$com->formula_string;
				//echo "strpos=".strpos($com->formula_string,"\$")."<br>";
				$frm=$com->formula_string;
				
				if( $frm<>""){
					$tmp="$".$com->salary_com_code."=".$com->formula_string.";";
					eval($tmp);
					$tmp2=$com->salary_com_code;
					$tmp="$"."vars['".$tmp2."']=$".$com->salary_com_code.";";
					eval($tmp);
					//var_dump($com->formula_string);
					
				} else {
					$com_org_value="".$com->org_value;
					if($com_org_value=="")$com_org_value="0";
					$tmp="$".$com->salary_com_code."=".$com_org_value.";";
					eval($tmp);
					$tmp2=$com->salary_com_code;
					$tmp="$"."vars['".$tmp2."']=$".$com->salary_com_code.";";
					eval($tmp);
				}
						
			}	
			
			//echo "G_POKOK=$G_POKOK,G_BRUTO=$G_BRUTO,BONUS=$BONUS,HADIR=$HARI_HADIR,ABSEN=$HARI_ABSEN";
			//var_dump($vars);
		}
	
		if($vars){
			foreach ($vars as $key => $value) {
				if($value=="")$value="0";
				$s="update hr_paycheck_sal_comp 
				set org_value=".$value." where salary_com_code='".$key."' 
				and pay_no='$this->paycheck_no'";
				//echo $s."</br>";
				$this->db->query($s);
			}
		}
		$s="select sum(c.org_value) as zSum
			from hr_paycheck_sal_comp  c 
			left join hr_emp_level_com e on e.salary_com_code=c.salary_com_code
			join hr_jenis_tunjangan t on t.kode=e.salary_com_code
			where c.pay_no='$this->paycheck_no' and t.sifat<>'Absensi' 
			 and e.level_code='$this->group'";
		$this->total_pendapatan=$this->db->query($s)->row()->zSum;
		if($this->total_pendapatan==null)$this->total_pendapatan=0;
		$s="select sum(c.org_value) as zSum
			from hr_paycheck_sal_comp  c 
			left join hr_emp_level_com e on e.salary_com_code=c.salary_com_code
			join hr_jenis_potongan t on t.kode=e.salary_com_code
			where c.pay_no='$this->paycheck_no'  and e.level_code='$this->group'";
		$this->total_potongan=$this->db->query($s)->row()->zSum;
		if($this->total_potongan==null)$this->total_potongan=0;

		$this->salary=$this->total_pendapatan-$this->total_potongan;
		$s="update hr_paycheck set salary=".$this->salary.",
			total_pendapatan=".$this->total_pendapatan.",
			total_potongan=".$this->total_potongan." 
			where pay_no='".$this->paycheck_no."'";
		$this->db->query($s);
		
		
	}
}
?>