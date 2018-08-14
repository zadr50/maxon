<?php
class Company_model extends CI_Model {

private $primary_key='company_code';
private $table_name='preferences';

function __construct(){
	parent::__construct();        
       
}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
        $nama='';
        if(isset($_GET['nama'])){
            $nama=$_GET['nama'];
        }
        if($nama!='')$this->db->where("company_name like '%$nama%'");

		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id=''){
		$id=urldecode($id);
		 if($id=="ALL" || $id==""){
			 //bila all ambil saja yang paling atas
			 $id=$this->db->select("company_code")->get("preferences")->row()->company_code;
		 }
		$this->db->where($this->primary_key,$id);
		$result=$this->db->get($this->table_name);
		if($result->num_rows()==0){
			$result=$this->db->get($this->table_name);
		}
		return $result;
	}
    function company_name($id){
        $id=urldecode($id);
        $retval="";
        if($q=$this->get_by_id($id)){
            if($r=$q->row()){
                $retval=$r->company_name;   
            }
        }
        return $retval;
    }
    function info($id){
		$id=urldecode($id);
        $data=$this->get_by_id($id)->row();
        if(count($data)){    
            $ret='<br/><strong>'.$id.' - '.$data->company_name.'</strong><br/>'
                    .$data->street.'<br/>'.$data->phone;
        } else $ret='';
        return $ret;
    }
	function save($data){
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		 if($id=="ALL" || $id==""){
			 //bila all ambil saja yang paling atas
			 $id=$this->db->select("company_code")->get("preferences")->row()->company_code;
		 }
		
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function setting($key){
		//echo "CID: ".$this->access->cid;
		//$this->access->cid
		$retval=$this->get_by_id()->result_array();
		//echo "company_model: setting: ";
		 
		if(count($retval)){
			return $retval[0][$key];
		} else {
			return $retval[$key];
		}
	}
	function datalist(){
	        $query=$this->db->query("select company_code,company_name from preferences");
	        $ret=array(); $ret['']='- Select -';
	        foreach ($query->result() as $row){ $ret[$row->company_code]=$row->company_code.'-'.$row->company_name;}		 
	        return $ret;
	}
}
