<?php
class Employee_model extends CI_Model {

private $primary_key='nip';
private $table_name='employee';
private $record=null;

function __construct(){
	parent::__construct();        
      
}
function get_nama($nip){
    $nama="";
    if(!$this->record){
        if($q=$this->get_by_id($nip)){
            if($this->record=$q->row()){
                $nama=$this->record->nama;                
            }
        }
    }
    return $nama;
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')	{
        $nama='';
        if(isset($_GET['nama'])){
            $nama=$_GET['nama'];
        }
        if($nama!='')$this->db->where("category like '%$nama%'");

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
		return $this->db->get($this->table_name);
	}
	function info($id){
		if($emp=$this->get_by_id($id)->row()){
			return $emp->nama.', Type: '.$emp->emptype.", Status: ".$emp->status.", Alamat: ".$emp->alamat;
		} else {
			return "";
		}
	}
	function save($data){
		if(isset($data['hireddate']))$data['hireddate']= date('Y-m-d H:i:s', strtotime($data['hireddate']));
		if(isset($data['tgllahir']))$data['tgllahir']= date('Y-m-d H:i:s', strtotime($data['tgllahir']));
        if(isset($data['resigned_date']))if($data['resigned_date']=='')$data['resigned_date']='1900-01-01';
		//if($data['gp']=="")$data['gp']=0;
		//if($data['tjabatan']=="")$data['tjabatan']=0;
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		if(isset($data['hireddate']))$data['hireddate']= date('Y-m-d H:i:s', strtotime($data['hireddate']));
		if(isset($data['tgllahir']))$data['tgllahir']= date('Y-m-d H:i:s', strtotime($data['tgllahir']));
        if(isset($data['resigned_date']))if($data['resigned_date']=='')$data['resigned_date']='1900-01-01';
        
		//if($data['gp']=="")$data['gp']=0;
		//if($data['tjabatan']=="")$data['tjabatan']=0;
		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
    function lookup(){        
        $lookup = $this->list_of_values->render(array(
        	"dlgBindId"=>"employee","modules"=>"employee",
        	"dlgRetFunc"=>"			
				$('#nip').val(row.nip);
                $('#collector').val(row.nama);
        	",
        	"dlgCols"=>array(
                array("fieldname"=>"nama","caption"=>"Nama","width"=>"180px"),
                array("fieldname"=>"nip","caption"=>"NIP","width"=>"80px")
        	)
        ));
		return $lookup;
        
    }	
	
	function lookup_list(){
		
		$query=$this->db->query("select nip,nama from ".$this->table_name);
		$ret=array();$ret['']='- Select -';
 		foreach ($query->result() as $row){$ret[$row->nip]=$row->nama;}		 
		return $ret;
	}
	function loadlist($where=''){
		if($where!="")$this->db->where($where);
		return $this->db->order_by('nama')->get($this->table_name);
	}
function exist($id){
   return $this->db->count_all($this->table_name." where nip='".$id."'")>0;
}
		
}

?>