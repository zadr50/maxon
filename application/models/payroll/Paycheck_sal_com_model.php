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
	private $from_date='',$to_date='',$pay_period='';
	
	function __construct(){
		parent::__construct();        
       
		$this->load->model('payroll/employee_model');
		$this->load->model('payroll/pph21_model');
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
		$manual=false;
		
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
				if($row->salary_com_code=="OT"){
					//echo 1;
				}
				if($row->salary_com_code!=""){
					$manual=false;
					$idrow=0;
					$s="select manual,id from hr_paycheck_sal_comp where pay_no='$this->paycheck_no' and salary_com_code='$row->salary_com_code' ";
					if($q=$this->db->query($s)){
						if($r=$q->row()){
							$manual="".$r->manual;
							$idrow="".$r->id;
						}
					}	
				$data[]=array('no_urut'=>$row->no_urut,
					'salary_com_code'=>$row->salary_com_code,
					'salary_com_name'=>$row->salary_com_name,
					'formula_string'=>$row->formula_string,
					'take_home_pay'=>$row->take_home_pay,
					'id'=>$idrow,"sifat"=>$row->sifat,
					'amount'=>$this->value($row->salary_com_code),
					'manual'=>$manual
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
		$s="select * from hr_paycheck where pay_no='$this->paycheck_no'";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$this->from_date=$r->from_date;
				$this->to_date=$r->to_date;
				$this->pay_period=$r->pay_period;
				$this->nip=$r->employee_id;
			} else {
				$this->pay_period=date("Y-m");
				if($this->db->query("select from_date,to_date from hr_period where period='$this->pay_period'")){
					$this->from_date=$r->from_date;
					$this->to_date=$r->to_date;
				}
			}
		}

		$vars=null;
		
		
		//---ABSENSI
		$s="select c.salary_com_code,c.org_value,
			c.calc_value,e.formula_string,t.sifat,c.manual 
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
					$value=$this->time_card_detail_model->calc_hari_hadir($this->paycheck_no);
					$vars["HARI_HADIR"]=$value;
				}
				if($com->salary_com_code=="HARI_ABSEN"){
					$value=$this->time_card_detail_model->calc_hari_absen($this->paycheck_no);
					$vars[$com->salary_com_code]=$value;						
				}
                if($com->salary_com_code=="JAM_LEMBUR"){
                	
                    $vars[$com->salary_com_code]=$this->calc_ot();
                }
				$tmp="$".$com->salary_com_code."=".$value.";";
				eval($tmp);
			}				
		}
		if($vars){
			foreach ($vars as $key => $value) {
				$s="update hr_paycheck_sal_comp 
				set org_value='".$value."' where salary_com_code='".$key."' 
				and pay_no='$this->paycheck_no'";
				//echo $s."</br>";
				$this->db->query($s);
			}
		}
//			var_dump($vars);
		//---PENDAPATAN
		$s="select c.salary_com_code,c.org_value,
			c.calc_value,e.formula_string,t.sifat,c.manual 
			from hr_paycheck_sal_comp c 
			left join hr_emp_level_com e on e.salary_com_code=c.salary_com_code
			join hr_jenis_tunjangan t on t.kode=e.salary_com_code
			where e.level_code='$this->group' and c.pay_no='$this->paycheck_no'
			
			order by e.no_urut";
		if($com_list=$this->db->query($s)) {
				
			foreach($com_list->result() as $com){
				$com_org_value=0;
				$vars[$com->salary_com_code]=$com->org_value;
                $com_org_value=$com->org_value;
                if($com_org_value=="")$com_org_value="0";
		                
				if(strlen($com->formula_string)>3){
					$tmp="$".$com->salary_com_code."=".$com->formula_string.";";
					eval($tmp);
					$tmp="$"."vars['".$com->salary_com_code."']=$".$com->salary_com_code.";";
					eval($tmp);
					
				} else {
                    if($com->salary_com_code=="OT"){
                    	if(!$com->manual){
	                        $com_org_value=$this->calc_ot_amount();                		
                    	}
                    } 
                    if ($com->salary_com_code=="MC") {
                    	if(!$com->manual){
	                    	$com_org_value=$this->calc_medical_amount();	
                    	}
                    } 
                	if($com_org_value=="")$com_org_value="0";
					$tmp="$".$com->salary_com_code."=".$com_org_value.";";
					eval($tmp);
					$tmp2=$com->salary_com_code;
					$tmp="$"."vars['".$tmp2."']=$".$com->salary_com_code.";";
					eval($tmp);
				}
			}
		}				
		//---POTONGAN
		$s="select c.salary_com_code,c.org_value,
			c.calc_value,e.formula_string,t.sifat,c.manual 
			from hr_paycheck_sal_comp c 
			left join hr_emp_level_com e on e.salary_com_code=c.salary_com_code
			join hr_jenis_potongan t on t.kode=e.salary_com_code
			where e.level_code='$this->group' and c.pay_no='$this->paycheck_no'
			order by e.no_urut";
		if($com_list=$this->db->query($s)) {
				
			foreach($com_list->result() as $com){
				$com_org_value=0;
                
				$frm=$com->formula_string;
				
				if( $frm<>"" && !$com->manual){
					$tmp="$".$com->salary_com_code."=".$com->formula_string.";";
					eval($tmp);
					$tmp2=$com->salary_com_code;
					$tmp="$"."vars['".$tmp2."']=$".$com->salary_com_code.";";
					eval($tmp);
					//var_dump($com->formula_string);
					
				} else {
					$com_org_value="".$com->org_value;                    
					if($com_org_value=="")$com_org_value="0";
                    if($com->salary_com_code=="PPH21"){
                    	if(!$com->manual){
	                        $com_org_value=$this->get_pph21();
                    	}
                    }
                    if($com->salary_com_code=="LOAN"){
                    	if(!$com->manual){
	                        $com_org_value=$this->calc_loan_amount();
                    	}
                    }
                                        
                    
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
	function get_pph21(){
	    $retval=0;
	    if($q=$this->db->query("select jumlah from employee_pph where nomor='$this->paycheck_no'")){
	        if($r=$q->row()){
	            $retval=$r->jumlah;
	        }
	    }
		//if($retval==0){
			//belum hitung pph21 ???
			$tahun=substr($this->pay_period, 0,4);
			$bulan=substr($this->pay_period,5,2);
			$this->pph21_model->calculate($tahun,$bulan,$this->nip);
			
		    if($q=$this->db->query("select jumlah from employee_pph where nomor='$this->paycheck_no'")){
		        if($r=$q->row()){
		            $retval=$r->jumlah;
		        }
		    }
							
		//}
        return $retval;
	}
    function calc_ot(){
        $retval=0;
        $s="select sum(time_total) as ttl_ot from overtime_detail 
            where salary_no='$this->paycheck_no'";
        if($q=$this->db->query($s)){
            if($r=$q->row()){
                $retval=$r->ttl_ot;
            }
        }    
        return $retval;
        
    }
    function calc_ot_amount(){
        $retval=0;
        $s="select sum(amount) as ttl_amount from overtime_detail 
            where salary_no='$this->paycheck_no' and nip='$this->nip'";
        if($q=$this->db->query($s)){
            if($r=$q->row()){
                $retval=$r->ttl_amount;
            }
        }    
        return $retval;
        
    }
	function calc_medical_amount(){
        $retval=0;
        $s="select sum(amount) as ttl_amount from employeemedical 
            where employeeid='$this->nip' and medicaldate between '$this->from_date' and '$this->to_date'";
        if($q=$this->db->query($s)){
            if($r=$q->row()){
                $retval=$r->ttl_amount;
            }
        }    
		return $retval;
	}
	function calc_loan_amount(){
        $retval=0;
        $s="select ls.angsuran from hr_emp_loan_schedule ls 
        left join hr_emp_loan el on el.loan_number=ls.loan_number 
            where el.nip='$this->nip' and tanggal_jth_tempo between '$this->from_date' and '$this->to_date'";
        if($q=$this->db->query($s)){
            if($r=$q->row()){
                $retval=$r->angsuran;
            }
        }    
		return $retval;
	}
		
}
?>