<?php
class Giro extends CI_Controller {
	    
    
	function __construct()
	{
		parent::__construct();        
         
        $this->load->helper(array('url','browse_select_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');

	}
	function index(){
		
	}
	
    function masuk_not_cleared(){
    	if($this->input->get('d1')){
    		$d1=$this->input->get("d1");
			$d2=$this->input->get("d2");
			$rek=$this->input->get("rek");
			if($rek=="undefined")$rek="";
			$sql="select * from check_writer 
				where trans_type='cheque in' 
				and check_date between  '$d1' and '$d2' and (cleared=0 or cleared is null)";
			if($rek!="")$sql=" and account_number='$rek'";
			$sql.=" order by check_date";			
			echo datasource($sql,true,'trans_id');
    	} else {
			$data["cleared"]=false;
			$this->template->display("bank/giro_masuk",$data);    	
    		
    	}
    }
	function giro_cair(){
		$ck=null;	
		$ok=false;
		$message="Unknown error !";
		if($this->input->post("date_from")){
			$d1=$this->input->post("date_from");
			$d2=$this->input->post("date_to");
			$rek=$this->input->post("rekening");
			$ck=$this->input->post("ck");
		} else {
			$d1=$this->input->get("d1");
			$d2=$this->input->get("d2");
			$rek=$this->input->get("rek");
			
		}
		
		
		if($rek=="undefined")$rek="";
		if($ck){
			for($i=0;$i<count($ck);$i++){
				$trans_id=$ck[$i];
				$sql="update check_writer set cleared=1 where trans_id='$trans_id'"; 			
				$ok=$this->db->query($sql);
				$sql="select trans_type,voucher from check_writer where trans_id='$trans_id'";
				if($q=$this->db->query($sql)){
					if($r=$q->row()){
						if($r->trans_type=="cheque in"){
							$sql="update payments set doc_status='1' where no_bukti='$r->voucher'";
							$this->db->query($sql);
						}
						if($r->trans_type=="cheque out" || $r->trans_type=="cheque"){
							$sql="update payables_payments set doc_status='1' where no_bukti='$r->voucher'";
							$this->db->query($sql);
						}
						
					}
				}
			}	
			
			$message="Nomor giro berhasil dicairkan.";
		}
		echo json_encode(array("success"=>$ok,"message"=>$message));
	}
	
	function keluar_not_cleared(){
    	if($this->input->get('d1')){
    		$d1=$this->input->get("d1");
			$d2=$this->input->get("d2");
			$rek=$this->input->get("rek");
			if($rek=="undefined")$rek="";
			$sql="select * from check_writer 
				where trans_type in ('cheque','cheque out') 
				and check_date between  '$d1' and '$d2' and (cleared=0 or cleared is null)";
			if($rek!="")$sql=" and account_number='$rek'";
			$sql.=" order by check_date";			
			echo datasource($sql,true,'trans_id');
    	} else {
			$data["cleared"]=false;
			$this->template->display("bank/giro_keluar",$data);    	
    		
    	}
		
	}
 
}
?>
