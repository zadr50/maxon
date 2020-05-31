<?php
class Overtime_model extends CI_Model {

private $primary_key='id';
private $table_name='overtime_detail';
	private $salary_no="";
	
	function __construct(){
		parent::__construct();        
      
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_by_tcid($tcid){
		$this->db->where("tcid",$tcid);
		return $this->db->get($this->table_name);
	}

	function save($data){
        if($data["time_in"] == "" ) {
            return false;
        }
		if(!$data['salary_no']){
			return false;
		}
		if($data['salary_no']==""){
			$data['salary_no']=$this->paycheck_model->get_salary_no($data['nip'],$data['tanggal']);
		}
		$this->salary_no=$data['salary_no'];
		
        $nip=$data['nip'];
        $tanggal=date('Y-m-d',strtotime($data['tanggal']));
        $s="select * from overtime_detail where nip='$nip' and tanggal='$tanggal'";
        if($q=$this->db->query($s)){
            $data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal'])); 
            if($r=$q->row()){
                $data2=(array)$r;
                $id=$data2['id'];
				if($id==33){
					$idd=$id;
				}
				
				$data2['time_in']=$data['time_in'];
				$data2['time_out']=$data['time_out'];
				$data2['work_status']=$data['work_status'];
				$data2['hari_libur']=$data['hari_libur'];
				if($data['work_status']=='OTL' || $data['work_status']=="OTN"){
					$data2['hari_libur']=true;
				}
                $data3=$this->recalc($data2);
                unset($data3['id']);
                $this->db->where("id",$id)->update($this->table_name,$data3);
            } else {
                $data2=$this->recalc($data);
				if($data2){
	                $id=$this->db->insert($this->table_name,$data2);                				
				} else {
					$data3=$data2;
				}
            }
        }
        	
		return $id;
	}
	function update($id,$data){
		if($data['tanggal'])$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));		
		$data1=$this->recalc($data);
		
		$this->db->where($this->primary_key,$id);
		$id=$this->db->update($this->table_name,$data1);
		return $id;
	}
	function delete($kode){
		$this->db->where($this->primary_key,$kode);
		return $this->db->delete($this->table_name);
	}
	function recalc($data) {
		if($data['time_in']=="0" || $data["time_in"]=="0:00" || $data['time_in']==""){
			$data['time_in']="00:00";
		}
		$first  = new DateTime( $data['time_in'] );
		$second = new DateTime( $data['time_out'] );

		$diff = $first->diff( $second );

		$ot_hour=$diff->format( '%H:%I:%S' ); // -> 00:25:25
		$ot_hour=$diff->format( '%H.%I' ); //03.00 -> 00:25:25
		$oth=$diff->format('%H');
		$otm=$diff->format('%I');
		if($otm>29){
			$otm=50;
		} else {
			$otm=0;
		}
		$ot_hour=$oth.".".$otm;
		
		$data['time_total']=$diff->format( '%H:%I' );
		$data['ttc_1x']=0;
		$data['ttc_2x']=0;
		$data['ttc_3x']=0;
		$data['ttc_4x']=0;
		
		$hari_libur=false;
		
		if(isset($data['hari_libur'])){
			if($data['hari_libur']=='1'){
				$hari_libur=true;
			}
		}
		if(isset($data['work_status'])){
			if($data['work_status']=="OTL" || $data['work_status']=="OTN"){
				$hari_libur=true;
			}
		}
		$amount=0;
        $ratio=$this->get_ratio($data['nip'],$data['salary_no']);
		
		if($ot_hour>0){
			$data['ttc_1x']=1.5;		//1.5
			if($hari_libur){
				$data['ttc_1x']=0;
			}
			$amount+=($data['ttc_1x']*$ratio);
			$ot_hour--;		//otl/otn kurangi 1 jam istrihat
		}
		if($ot_hour>0){
			if($hari_libur){
				//ot 2 adalh 7 jam pertama kali 2
				//ot 2 adalah 6 jam karena potong istirahat 1 jam
				if($ot_hour>7){
					$data['ttc_2x']=7*2;
				} else {
					$data['ttc_2x']=$ot_hour*2;
				}
				$ot_hour=$ot_hour-7;
			} else {
				$data['ttc_2x']=$ot_hour*2;
			}
			$amount+=($data['ttc_2x']*$ratio);
			
		}
		if($hari_libur and $ot_hour>0) {
			//jam ke 3 kali 3
			if($ot_hour>=1){
				$data['ttc_3x']=1*3;
				$ot_hour--;
				
			} else {
				$data['ttc_3x']=$ot_hour*3;
				$ot_hour=0;;
				
			}
			$amount+=($data['ttc_3x']*$ratio);
		}
		if($hari_libur and $ot_hour>0) {
			//jam ke 4 kali 4
			$data['ttc_4x']=$ot_hour*4;
			$amount+=($data['ttc_4x']*$ratio);
			$ot_hour--;
		}
		
		if($hari_libur){
			$data['hari_libur']=1;
		} else {
			$data['hari_libur']=0;
		}
		$data['time_total_calc']=$data['ttc_1x']+$data['ttc_2x']+$data['ttc_3x']+$data['ttc_4x'];
        $data['amount']=$amount;
		return $data;
	}
    function get_ratio($nip,$salary_no){
        $retval=0;
		$gp=0;
        if($q=$this->db->query("select gp,tjabatan from employee where nip='$nip'")){
            if($r=$q->row()){
                if($r->gp>0){
                    $gp=$r->gp+$r->tjabatan;                    
                }
            }
        }
		//kalo job GW / kerja harian ambil dari slip gaji
		//GPHARI spesial case !!
		$this->salary_no=$salary_no;
		$s="select org_value from hr_paycheck_sal_comp where pay_no='$this->salary_no' 
			and  salary_com_code='GPHARI'";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				$gp=$r->org_value;
			}
		}
		$retval=round($gp/173);
        return $retval;
    }

}
