<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sysvar
 {
 /**
 * Constructor
 */
private $primary_key='varname',$company_code="";
private $table_name='system_variables';
private $debug=false;
 
function __construct()
{
     $this->CI =& get_instance();               
     $this->CI->load->helper('mylib');
     $this->CI->load->library("list_of_values");
 }
     function debug_true(){
    	 $this->debug=true;
     }
      function debug_false(){
    	 $this->debug=false;
     }
    
    function count_all(){
    	return $this->db->count_all($this->table_name);
    }
    function get_by_id($id){
    	$this->db->where($this->primary_key,$id);
    	return $this->db->get($this->table_name);
    } 
	function exist_var($varname){
		$retval=false;
		$sql="select * from system_variables where varname='$varname'";		
    	if($q=$this->CI->db->query($sql)) {
            $retval=$q->num_rows()>0;
    	}
		return $retval;		
	}
    function getvar($varname, $varvalue="", $debug=false){
    	if($varname=="COA Hutang Komisi"){
    		$ret="";
    	}
    	$ret="";
    	if($this->debug){
    		$sql="select * from system_variables_debug where varname='$varname'";
    	} else {
    		$sql="select * from system_variables where varname='$varname'";		
    	}
        //echo "<br>$sql";
        
    	if($q=$this->CI->db->query($sql)) {
            if($q->num_rows()){
                $row=$q->row();
                $ret=$row->varvalue;
    		} else {
    		    if($varvalue!=""){
                    $ret=$varvalue;
                    $this->insert($varname,$varvalue,'auto');
    		    }
    		}
    	}
        if($ret=="")$ret=$varvalue;
    	return $ret;
    }
    function update($varname,$varvalue){
    	$this->save($varname,$varvalue);
    }
    function save($varname,$varvalue){    	
    	$data['varvalue']=$varvalue;
    	return $this->CI->db->where($this->primary_key,$varname)->update($this->table_name,$data);
    }
    function insert($varname,$varvalue,$vardesc=''){
    	$data['varname']=$varname;
    	$data['varvalue']=$varvalue;
        $data['keterangan']=$vardesc;
    	//$this->CI->db->where($this->primary_key,$varname);
    	//echo "</br></br>Insert: ";
    	//var_dump($data);
    	$ok= $this->CI->db->insert($this->table_name,$data);
    	return $ok;
    }
    function _varX($sKey) {
    	if($this->debug){
    		$sql="select * from system_variables_debug where varname='$sKey'";
    	} else {
    		$sql="select * from system_variables where varname='$sKey'";		
    	}
    	if($q=$this->CI->db->query($sql)) {
    		if($row=$q->row()){
    			return $row->varvalue;
    		} else {
    			return "";
    		}
    	} else {
    		return "";
    	}
    }
    function autonumber($varname,$step=0,$default=''){
    
    	$varvalue=$this->getvar($varname);
           
    	if($varvalue=="") {
                $varvalue=$default;
                    
                if($varvalue=='') return $varvalue;
                $this->insert($varname, $varvalue,'Numbering');
            }    
    	$arRomawi=array("","I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
    	$aa=explode("~",$varvalue);
    	$sFlagAdaCounter=false;
    	$nCtrPos=0;
    	$nCtrLen=0;
    	$sVal="";
    	$sLF="";$sMD="";$sRG="";$nextkode="";
    	$autoKey=-1;
    	foreach($aa as $a){
    		$code=substr($a,0,1);
    		$nilai=substr($a,1,strlen($a));
    		$pj=strlen($nilai);
    		$nextkode.=$code;
    		//echo "<br>code: ".$code." nilai: ".$nilai." nextkode: ".$nextkode;
    		switch ($code) {
    		case "!":
    			$sVal.=$nilai;
    			//echo "<br>val ! ".$sVal;
    			break;
    		case "@":
    			if($nilai=="COM"){
    				$sVal.=cid();
    			} else if($nilai=="TK"){
    				//kode toko
    				$sVal.="TK";
    			}else if($nilai=="PTK"){
    				//kode PT untuk toko yg aktif
    				$sVal.="PTK";
                }else if($nilai=="GDG"){
                    $sVal.=current_gudang();
    			} else {
    				$sVal.=$nilai;				
    			}
    			//echo "<br>val @ ".$sVal;
    			break;
    		case "#":
    			$sFlagDDMMYY=$nilai;
    			if($nilai=="MM") $sNew=date("m");
    			elseif($nilai=="YY") $sNew=date("y");
    			elseif($nilai=="DD") $sNew=date("d");
    			else {
    				$sFlagDDMMYY="";
    				$sNew=$arRomawi[strval(date("m"))];
    			}
    			$sVal.=$sNew;
    			break;
    		case "$":
    			$nCurCounter=strval($nilai);
    			$nCtrPos=strlen($sVal);
    			$nCtrLen=$pj;
    			$sVal.=strzero(strval($nilai),$pj);
    			$nilai = strzero(strval($nilai)+$step, $pj);
    			//echo 'nilai='.$nilai;
    			$sFlagAdaCounter=True;
    			//echo "<br>val $ ".$nilai ;
    			break;
    		case "?":	//reset 
    			if(($sFlagAdaCounter and strlen($sFlagDDMMYY))>0) {
    				$nOldMM=strval(substr($a,0,4));
    				$nl=substr($nilai,0,2);
    				if($nl=="MM"){
    					if(strval(date("m"))<>strval($nOldMM)){
    						$sLF=substr($sVal,$nCtrPos,$nCtrLen);
    						$sMd=strzero(1,$nCtrLen);
    						$sRG=substr($sVal,$nCtrPos+$nCtrLen+1,strlen($sVal));
    						$sVal=$sLF.$sMd.$sRG;
    					}
    				} elseif ($nl=="DD") {
    					if(strval(date("d"))<>strval($nOldMM)){
    						$sLF=substr($sVal,$nCtrPos);
    						$sMd=strzero(1,$nCtrLen);
    						$sRG=substr($sVal,$nCtrPos+$nCtrLen+1,strlen($sVal));
    						$sVal=$sLF.$sMd.$sRG;
    					}
    				} elseif ($nl=="YY") {
    					if(strval(date("Y"))-2000<>strval($nOldMM)){
    						$sLF=substr($sVal,$nCtrPos);
    						$sMd=strzero(1,$nCtrLen);
    						$sRG=substr($sVal,$nCtrPos+$nCtrLen+1,strlen($sVal));
    						$sVal=$sLF.$sMd.$sRG;
    					}
    				}
    			}
    			break;
    		} //end switch
    			
    		$nextkode.=$nilai."~";		
    	}	/// for each
    	
    	if($step<>0){
    		if(substr($nextkode,-1,1)=="~") $nextkode=substr($nextkode,0,strlen($nextkode)-1);
    		//echo "<br>NextKode: ".$nextkode;
    		$this->save($varname,$nextkode);
    	}
            
    	return $sVal;
    }
    function autonumber_inc($varName){
    	$this->autonumber($varName,1);
    }
    function autonumber_dec($varName){
    	$this->autonumber($varName,-1);
    }
    function lookup($varname){
		$query=$this->CI->db->query("select varvalue,keterangan from ".$this->table_name
			." where varname='Lookup.".$varname."' order by varvalue");
		$ret=array();$ret['']='- Select -';
 		foreach ($query->result() as $row){$ret[$row->varvalue]=$row->keterangan;}		 
		return $ret;
	}
    function get_section($section){
        return $this->CI->db->where("section",$section)->get($this->table_name);
    }
    function input_text($vartype,$varname,$varvalue,$varlist){
        $vartype=strtoupper($vartype);
        $input="";
        if($vartype=="BOOLEAN"){
            $input=form_checkbox($varname,$varvalue,$varvalue==""?false:false,"id='$varname'");
        } else if ($vartype=="LIST"){
            if($varlist!=""){
                $varlist_value=$this->list_of_values->get_by_name($varlist);
                $input=form_dropdown($varname,$varlist_value,$varvalue,"id='$varname'");
            } 
        } else if ($vartype=="DATETIME"){
            $input=my_input_date(array("field_name"=>$varname,"field_value"=>$varvalue,"id='$varname'"));
        } else if ($vartype=="NUMERIC"){
            if($varvalue=="" || !is_numeric($varvalue))$varvalue=0;
        }
        if($input==""){
            $input=form_input($varname,$varvalue,"id='$varname' style='width:300px'");
        }                
        return $input;        
    }
}
