<?php
class Pph21_model extends CI_Model {

	private $primary_key='id';
	private $table_name='hr_pph_form';
    private $tahun=0;
    private $bulan=0;
    private $nip="";
    private $pay_period="";
    private $pay_no="";
    private $vars_row=null;
	
	function __construct(){
		parent::__construct();        
       
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$ok=$this->db->insert($this->table_name,$data);
		return $ok;
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$ok= $this->db->update($this->table_name,$data);
		return $ok;
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->delete($this->table_name);
		return $ok;
	}	
	function calculate($tahun,$bulan,$nip){
		
        $pay_period=$tahun."-".$bulan;
        
        $pay_no="";
        if($q=$this->db->select("pay_no")->where("pay_period",$pay_period)
            ->where("employee_id",$nip)->get("hr_paycheck")){
            if($r=$q->row()){
                $pay_no=$r->pay_no;
            }        
        }
			
        $this->tahun=$tahun;
        $this->bulan=$bulan;
        $this->nip=$nip;
        $this->pay_period=$pay_period;
        $this->pay_no=$pay_no;
        
        $template="PPh21 Atas Gaji";
        //load data paycheck periode ini
        //$this->paycheck_sal_com_model->vars_component($nip,$tahun,$bulan);
        $s="select * from hr_paycheck_sal_comp where pay_no='$pay_no'";
        if($q=$this->db->query($s)){
            foreach($q->result() as $row){
                $vars[$row->salary_com_code] = $row->org_value;
            }
        }
        
        
        $s="select * from hr_pph_form where template='$template' order by kelompok,nomor";
        if($q=$this->db->query($s)){
            foreach($q->result() as $row){
                $jumlah=0;
                $rumus=$row->rumus;
                //echo "<br>$rumus";
                if($row->nomor==11){
                    //echo "STOP";
                }
                //var="$"."R".strzero($row->nomor,2);
                //eval("$var = $row->jumlah");
                $vars_row["R".strzero($row->nomor,2)]=$row->jumlah;
                $data=null;
                $jumlah=0;
                if($rumus!=""){
                    if(substr($rumus, 0,1)=="+"){
                        //row calculation
                        $row_data=explode(",",$rumus);
                        $val_sum=0;
                        for($i=0;$i<count($row_data);$i++){
                            $var=$row_data[$i];
                            $sign=substr($var,0,1);
                            $sign_r=substr($var,1,1);
                            $var=substr($var,1,10);
                            if($sign=="-"){
                                if($sign_r=="R"){
                                    $val_sum-=$vars_row[$var];
                                } else {
                                    $val_sum-=$$var;
                                }
                            } else if ($sign=="+")  {
                                if($sign_r=="R"){
                                    $val_sum+=$vars_row[$var];                                
                                } else {
                                    $val_sum+=$var;
                                }
                            } else if ($sign == "*") {
                                if($sign_r=="R"){
                                    $val_sum*=$vars_row[$var];
                                } else {
                                    $val_sum*=$var;
                                }
                            }  
                        }
                        $jumlah=$val_sum;
                    } else if (substr($rumus, 0,1)=="@")  {
                        //symbol function misal @PTKP
                        $jumlah=$this->calc_func($rumus);
                    } else {
                        //component value
                        $component=explode(",", $rumus);
                        $val_sum=0;
                        for($i=0;$i<count($component);$i++){
                            if(isset($vars[$component[$i]])){
	                                $val_sum+=$vars[$component[$i]];                                
																	
                            } else {
                            	$com=$component[$i];
								if(substr($com,0,1)=="*"){
									$comval=substr($com,1,20);
									if($comval>0){
										$val_sum*=$comval;
										
									}
								}
								if(substr($com,0,1)=="+"){
									$comval=substr($com,1,20);
									if($comval>0){
										$val_sum+=$comval;
										
									}
								}
								if(substr($com,0,1)=="-"){
									$comval=substr($com,1,20);
									if($comval>0){
										$val_sum-=$comval;
										
									}
								}
								if(substr($com,0,1)=="/"){
									$comval=substr($com,1,20);
									if($comval>0){
										$val_sum/=$comval;
										
									}
								}
                            	
                            }
                        }
                        $jumlah=$val_sum;
                    }
                }
                $data["jumlah"]=$jumlah;
                $vars_row["R".strzero($row->nomor,2)]=$jumlah;
                
                $this->vars_row=$vars_row;
                
                if($data){
                    $this->db->where("id",$row->id)->update("hr_pph_form",$data);                    
                }
            }
        }
        		
	}

    function calc_func($rumus){
        $sign=substr($rumus,0,1);
        if($sign!="@")return 0;
        $rumus=strtolower(substr($rumus,1,50));
        $retval=0;
        switch ($rumus) {
            case 'ptkp':
                $retval=$this->calc_ptkp();                
                break;
            case substr($rumus,0,6)=="pph21(":
                $rumus=str_replace("pph21(", "", $rumus);
                $rumus=str_replace(")","",$rumus);
                $var=strtoupper($rumus);
                $kena_pajak=$this->vars_row[$var];
                if($kena_pajak){
                    $retval=$this->calc_pph_rate($kena_pajak);
                }
				if($retval>0){
					$retval=$retval/12;
				}
                $this->update_employee_pph($retval);
                break;
            default:
                
                break;
        }
        return $retval;
    }
    function update_employee_pph($jumlah_pph=0){
        $s="select * from employee_pph where nip='$this->nip' 
            and nomor='$this->pay_no'";
        if($q=$this->db->query($s)){
            if($row=$q->row()){
                $data["jumlah"]=$jumlah_pph;
                $this->db->where("id",$row->id)->update("employee_pph",$data);
            } else {
                $data["nip"]=$this->nip;
                $data["nomor"]=$this->pay_no;
                $data["tahun"]=$this->tahun;
                $data["bulan"]=$this->bulan;
                $data["jumlah"]=$jumlah_pph;
                $this->db->insert("employee_pph",$data);
            }
        }
    }
    function calc_ptkp(){
        $retval=0;
		$status_kawin="TK";
		$s="select status from employee where nip='$this->nip'";
		if($q=$this->db->query($s)){
			if($r=$q->row()){
				if($r->status!=""){
					$status_kawin=$r->status;
				}
			}
		}
        $s="select p.jumlah from  hr_ptkp p where p.kode='$status_kawin'";
        if($q=$this->db->query($s)){
            if($r=$q->row()){
                $retval=$r->jumlah;
            }
        }
        return $retval;
    }
    function calc_pph_rate($kena_pajak){
        $retval=0;
        $kena_pajak12=$kena_pajak;
        $s="select percent_value from hr_pph h where $kena_pajak12 between low_value and high_value";
        if($q=$this->db->query($s)){
            if($r=$q->row()){
                $retval=$r->percent_value;               
            }
        }
        if($retval>1)$retval=$retval/100;
        $retval=$retval*$kena_pajak;
        return $retval;
    }
	
}