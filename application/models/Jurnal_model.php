<?php
class Jurnal_model extends CI_Model {

private $primary_key='transaction_id';
private $table_name='gl_transactions';
private $message="";
public $silent_mode=false;

	function __construct(){
		parent::__construct();          
	    $this->load->model("chart_of_accounts_model");   
	    
	}
	function message_text(){
		return $this->message;
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')
	{
        $nama='';
        if(isset($_GET['gl_id'])){
            $nama=$_GET['gl_id'];
        }
        if($nama!='')$this->db->where("gl_id like '%$nama%'");

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
	function get_by_gl_id($id){
		$this->db->where("gl_id",$id);
		return $this->db->get($this->table_name);
	}
	function exist_gl_id($id){
		return $this->get_by_gl_id($id)->num_rows();
	}
	
	function save($data){
		$data['date']= date('Y-m-d H:i:s', strtotime($data['date']));
        $id=0;
        if(isset($data["transaction_id"]))$id=$data["transaction_id"];
        $acc_id=0;
        if(isset($data["account_id"]))$acc_id=$data["account_id"];
        if($acc_id==0){
            
            if(isset($data["account"])){
                $acc=$data["account"];
                unset($data["account"]);
                unset($data["account_description"]);            
                $coa=$this->chart_of_accounts_model->get_by_id($acc);
                $acc_id=0;
                if($row=$coa->row())$acc_id=$row->id;
                $data["account_id"]=$acc_id;
                
            }
        }
		$ok=false;
        if($id>0){
            if($data["account_id"]>0)$this->update($id,$data);
            $ok=$id;
        } else {
            if($data["account_id"]>0){
                $this->db->insert($this->table_name,$data);
                $ok=$this->db->insert_id();
            }
        }
		return $ok;
	}
	function update($id,$data){
	    if(isset($data["transaction_id"]))unset($data["transaction_id"]);
	    $data['date']= date('Y-m-d H:i:s', strtotime($data['date']));
		return $this->db->where($this->primary_key,$id);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function delete_item($id){
		$this->db->where('transaction_id',$id);
		return $this->db->delete($this->table_name);
	}
	function add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source,$cid="",$ref=""){
		
		if($cid=="")$cid=$this->access->cid;
		
		$data['date']= date('Y-m-d H:i:s', strtotime($date));
		$data['gl_id']=$gl_id;
		$data['account_id']=$account_id;
		$data['debit']=$debit;
		$data['credit']=$credit;
		$data['operation']=$operation;
		$data['source']=$source;
		$data['company_code']=$cid;
		$data['custsuppbank']=$ref;
		$credit_tmp=0;
		if($data['debit']<0){
			$data['credit']=abs($data['debit']);
			$data['debit']=0;
		} else if($data['credit']<0) {
			$data['debit']=abs($data['credit']);
			$data['credit']=0;
		}
		//var_dump($data);
		if($account_id=="" or $account_id=="0") {
			if(is_ajax()){
				$this->message.="ERR_INVALID_COA : AccountId: [$account_id] not found !, Operation: $operation, Source: $source, RefId: $ref, GLId: $gl_id";
				
				echo json_encode(array("success"=>false,"message"=>$this->message));
				
			} else {
				if(!$this->silent_mode){
					
					echo "<div class='alert alert-info'><div class='alert alert-warning'>
					ERR_INVALID_COA : <strong>AccountId:</strong> [$account_id] not found !, "
					."<strong>Operation:</strong> $operation, <strong>Source:</strong> $source, 
					<strong>RefId:</strong> $ref <b>GLId: </b>$gl_id </p></div></div>";
				}
				
				return false;
				
			}
			$this->add_jurnal_error($gl_id,$data['date'],$this->message);
		}
		if($data['debit']-$data['credit']==0){
			return false;
		} else {
			$ok=$this->save($data);
		}
	}
	function add_jurnal_error($gl_id,$tanggal,$message){
		$data['gl_id']=$gl_id;
		$data['tanggal']=$tanggal;
		$data['error_message']=$message;
		$this->db->insert("zzz_jurnal_error",$data);
		
	}
    function unposting($gl_id){
        return $this->del_jurnal($gl_id);
    }
	function del_jurnal($gl_id){
		//return false;
		if($q=$this->db->query("select date from gl_transactions where gl_id='$gl_id' limit 1")) {
			if($r=$q->row()){
				$this->load->model("periode_model");
				if($this->periode_model->closed($r->date)){
					echo "ERR_PERIOD: date: ".$r->date.", closed? ".$this->periode_model->closed($r->date);
					return false;
				}
			}
		}
		$this->db->where('gl_id',$gl_id);
		return $this->db->delete($this->table_name);
	}
	function balance($gl_id) {
		if($this->db->query("select count(1) as cnt from gl_transactions where gl_id='$gl_id'")->row()->cnt==0) {
			//echo "ERR_GL_NOT_FOUND";
			return false;
		} else {
			$ret = $this->db->query("select sum(debit)-sum(credit) as z_amt 
			from gl_transactions where gl_id='$gl_id'")->row()->z_amt==0;
			return $ret;
		}
	}
	function validate($gl_id,$delete=true,$display_error=false){
	    $dont_validate_journal=$this->session->userdata('dont_validate_journal',FALSE);
        if($dont_validate_journal)return true;
		if(!$this->balance($gl_id)){
			$tanggal=date("Y-m-d");
			if($q=$this->db->query("select `date` from gl_transactions where gl_id='$gl_id' ")){
				if($r=$q->row()){
					$tanggal=$r->date;
				}
			}
			$this->add_jurnal_error($gl_id, $tanggal, "Jurnal tidak balance [$gl_id]...");
			if($display_error) {
				echo "</br>ERR_NOT_BALANCE";
			} else {
				$this->message.="\r $gl_id Not Balance !";
			}
			if($delete) $this->del_jurnal($gl_id);
			return false;
		}
		return true;
	}
	function validate_process($gl_id,$valid_status=""){
	    $gl_id=urldecode($gl_id);
        if($valid_status=="")$valid_status="1";
	    return $this->db->where("gl_id",$gl_id)
	       ->update("gl_transactions",array("valid_by"=>user_id(),
            "valid_date"=>date("Y-m-d H:i:s"),"valid_status"=>$valid_status));
	}
    function loadlist_validate($period,$operation="",$valid_status=''){
        $prd=$this->periode_model->get_by_id($period)->row();
        if($valid_status==""){
            $valid_status=" and (valid_status is null or valid_status='0')";
        } else {
            $valid_status=" and valid_status='$valid_status'";
        }
        $sql="select gl_id,concat(year(date),'-',month(date),'-',day(date)) as date1,
            sum(debit) as debit_sum,
            sum(credit) as credit_sum,sum(debit-credit) as saldo 
            from gl_transactions 
            where date between '$prd->startdate' and '$prd->enddate' 
            $valid_status";
        if($operation!="")$sql.=" and operation='$operation'";
        $sql.=" group by gl_id,concat(year(date),month(date),day(date))";
        $result=array();
        if($q=$this->db->query($sql)){
            foreach($q->result() as $row){
                $result[]=$row;
            }
        }
        return $result;
    }	
	function exist_account_id($id){
		return $this->db->query("select count(1) as cnt from chart_of_accounts where id='$id'")->row()->cnt>0;
	}
}

?>