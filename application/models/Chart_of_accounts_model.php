<?php
class Chart_of_accounts_model extends CI_Model {

private $table_name='chart_of_accounts';
private $primary_key='account';
private $_error="";
private $id=0;

    function __construct(){
            parent::__construct();        
     
            
    }
	function select_list(){
		$query=$this->db->query("select id,account,account_description
                    from ".$this->table_name);
		$ret=array();
		$ret['']='- Select -';
 		foreach ($query->result() as $row)
		{
			$ret[$row->id]=$row->account.' - '.$row->account_description;
		}		 
		return $ret;
	}
	function account_type_list(){
			$query=$this->db->query("select account_type_num,account_type
				from chart_of_account_types order by account_type");
			$ret=array();
			$ret['']='- Select -';
			foreach ($query->result() as $row)
			{
					$ret[$row->account_type_num]=$row->account_type_num.' - '.$row->account_type;
			}		 
			return $ret;
	}
	function group_type_list(){
			$query=$this->db->query("select group_type,group_name 
				from gl_report_groups where group_type<>'' order by group_type");
			$ret=array();
			$ret['']='- Select -';
			foreach ($query->result() as $row)
			{
					$ret[$row->group_type]=$row->group_type.' - '.$row->group_name;
			}		 
			return $ret;
	}
    function save_account_type(){
        
    }
	function save($data){
        $id=$data['account'];
        $fld['account_type']=$data['account_type'];
        $fld['account']=$id;
        $fld['account_description']=$data['account_description'];
        $fld['group_type']=$data['group_type'];
        $fld['beginning_balance']=$data['beginning_balance'];
        $db_or_cr=$data['db_or_cr'];
        if($db_or_cr=='D')$db_or_cr='0';
        if($db_or_cr=="C") $db_or_cr='1';
        $fld['db_or_cr']=$db_or_cr;
        $mode="";
        if(isset($data['mode']))$mode=$data['mode'];
        $cnt=$this->db->query("select count(1) as cnt from chart_of_accounts  
            where account='$id'")->row()->cnt;
        if($cnt>0)$mode="view";
        if($mode=='view'){
            $this->db->where($this->primary_key,$id);
            return $this->db->update($this->table_name,$fld);            
        } else {
            $this->db->insert($this->table_name,$fld);            
            return $this->db->insert_id();
        }
	}
    function update($id,$data){
        $id=$data['account'];
        $fld['account_type']=$data['account_type'];
        $fld['account']=$id;
        $fld['account_description']=$data['account_description'];
        $fld['group_type']=$data['group_type'];
        $fld['beginning_balance']=$data['beginning_balance'];
        $db_or_cr=$data['db_or_cr'];
        if($db_or_cr=='D'){
            $db_or_cr='0';
        } else {
            $db_or_cr='1';
        };
        $fld['db_or_cr']=$db_or_cr;
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$fld);
	}
	function delete($id){
	    $id=urldecode($id);
        $ok=false;
        $this->id=0;
        if($q=$this->get_by_id($id)){
            if($r=$q->row()){
                $this->id=$r->id;
            }
        }
        if(!$this->exist_account_used($id)){
            $this->db->where($this->primary_key,$id);
            $ok= $this->db->delete($this->table_name);
            if(!$ok) $ok= $this->db->where("id",$id)->delete($this->table_name);            
        }
        return $ok;
	}
    function exist_account_used($id){
        $retval=false;
        $cnt=$this->db->query("select count(1) as cnt from gl_transactions 
            where account_id='$$this->id'")->row()->cnt;
        if($cnt>0){
            $this->_error="Masih ada transaksi di table gl_transactions, account_id: $this->id";
            $retval=true;
        }
        if($cnt==0){
            
        }
        return $retval;
    }
    function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
    function get_group_by_id($id){
		$this->db->where('group_type',$id);
		return $this->db->get('gl_report_groups');
	}
    function get_by_account_id($id){
		$this->db->where("id",$id);
		return $this->db->get($this->table_name);
	}
    function data_tree_rugi_laba(){
        return $this->data_tree("account_type_num>3");
    }
    function data_tree_neraca(){
        return $this->data_tree("account_type_num<4");
    }
    function data_tree($where){
        $retval=null;
        $s="select * from chart_of_account_types where $where order by account_type_num";
        if($qtype=$this->db->query($s)){
           foreach($qtype->result() as $rtype){
                $data['account_id']=0;
                $data['account']=$rtype->account_type_num;
                $data['account_description']=$rtype->account_type;
                $data['row_type']='T';
                $data['account_type']=$rtype->account_type;
                $retval[]=$data;
               
               $s="select * from gl_report_groups where account_type='$rtype->account_type_num' 
                    and parent_group_type='0' order by group_type ";
                if($qgrp=$this->db->query($s)){
                    foreach($qgrp->result() as $rgrp){
                        //group level 1
                        $data['account_id']=0;
                        $data['account']=$rgrp->group_type;
                        $data['account_description']="-- ".$rgrp->group_name;
                        $data['row_type']='G';
                        $data['account_type']=$rgrp->account_type;
                        $retval[]=$data;
                        $s="select * from chart_of_accounts where group_type='$rgrp->group_type' order by account";
                        if($qcoa=$this->db->query($s)){
                            $coa_data=null;
                            foreach($qcoa->result() as $rcoa){
                                $coa_data['account_id']=$rcoa->id;
                                $coa_data['account']=$rcoa->account;
                                $coa_data['account_description']="-- -- ".$rcoa->account_description;
                                $coa_data["row_type"]="D";
                                $coa_data["account_type"]=$rcoa->account_type;
                                $retval[]=$coa_data;                                
                                
                                
                            }
                        }
                        //group level 2
                       $s="select * from gl_report_groups where account_type='$rtype->account_type_num' 
                            and parent_group_type='$rgrp->group_type' order by group_type ";
                                                
                        if($qgrp2=$this->db->query($s)){
                           foreach ($qgrp2->result() as $rgrp2) {
                                $data['account_id']=0;
                                $data['account']=$rgrp2->group_type;
                                $data['account_description']="-- -- ".$rgrp2->group_name;
                                $data['row_type']='G';
                                $data['account_type']=$rgrp2->account_type;
                                $retval[]=$data;
                                
                                $s="select * from chart_of_accounts where group_type='$rgrp2->group_type' order by account";
                                if($qcoa=$this->db->query($s)){
                                    $coa_data=null;
                                    foreach($qcoa->result() as $rcoa){
                                        $coa_data['account_id']=$rcoa->id;
                                        $coa_data['account']=$rcoa->account;
                                        $coa_data['account_description']="-- -- -- ".$rcoa->account_description;
                                        $coa_data["row_type"]="D";
                                        $coa_data["account_type"]=$rcoa->account_type;
                                        
                                        $retval[]=$coa_data;                                
                                        
                                    }
                                }
                           } 
                        }
                        
                    }
                }               
              //sub total account_type
                $data['account_id']=0;
                $data['account']=$rtype->account_type_num;
                $data['account_description']="SUB TOTAL: ".$rtype->account_type;
                $data['row_type']='T';
                $data['account_type']=$rtype->account_type;
                //$retval[]=$data;
                             
           }                 
        }
        //var_dump($retval);
        
        return $retval;
    }
    function arsip_saldo($enddate,$coa_id){
        
    }
	function lookup($dlgId){
        return $this->list_of_values->render(
	        array('dlgBindId'=>$dlgId,"dlgId"=>$dlgId,"dlgUrlQuery"=>"coa/browse_data",
	        'dlgRetFunc'=>"$('#$dlgId').val(row.account+' - '+row.account_description);",
	        'dlgCols'=>array( 
	                        array("fieldname"=>"account","caption"=>"Kode Akun","width"=>"80px"),
	                        array("fieldname"=>"account_description","caption"=>"Nama Perkiraan","width"=>"200px")
	                    )
			)
		);          
		
	}


}
?>
