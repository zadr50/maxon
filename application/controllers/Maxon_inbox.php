<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Maxon_Inbox extends CI_Controller {
	
	private $table_name="maxon_inbox";
	
	function __construct() {
		parent::__construct();
         

		if(!$this->access->is_login())redirect(base_url());
		
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model("maxon_inbox_model");
		
	}
	function index() {}
	
	function send($from,$to,$subject,$message){
		$data['rcp_from']=$from;
		$data['rcp_to']=$to;
		$data['subject']=$subject;
		$data['message']=$message;
		$data['msg_date']=date('Y-m-d H:i:s');
		return $this->maxon_inbox_model->save($data);
	}
	function delete_msg($id){
		$this->db->where("id",$id);
        echo "Message was deleted, back to message list.";
        echo "<script>setTimeout(function(){
                 window.open('".base_url()."index.php/maxon_inbox/list_msg','_self'); 
              }, 3000);</script>";
		return $this->db->delete("maxon_inbox");
	}
	function view_msg($id){
		$this->db->where("id",$id);
		if($q=$this->db->get("maxon_inbox")){
			$row=$q->row();
			$tbl="<table style='width:100%'   cellspacing=1 cellpadding=5px>";
			$tbl.="<tr><td><strong>From</strong></td><td>".$row->rcp_from."</td>";
			$tbl.="<td><strong>To</strong></td><td>".$row->rcp_to."</td>";
            $tbl.="<td><strong>Date</strong></td><td>".$row->msg_date."</td>";
            $tbl.="<tr><td><strong>Doc</strong></td><td>".$row->doc_no."</td>";
            $tbl.="<td><strong>Type</strong></td><td>".$row->doc_type."</td></tr>";
            $tbl.="<tr><td><strong>Subject</strong></td><td colspan=5>".$row->subject."</td></tr>";
			$tbl.="<tr><td><strong>Message</strong></td></tr>
			<tr><td colspan=6>".$row->message."</td></tr>";
			$tbl.="</table>";
			$data['list_msg']=$tbl;
			$data["id"]=$row->id;
			$this->db->query("update maxon_inbox set is_read=1 where id=$id");
			
			$this->template->display("maxon_inbox/list_msg",$data);
		}
	}
	function list_msg_json() {
		$msg=""; $last_id=0;$data=null;
		$s="select rcp_from,subject,message,id,msg_date from maxon_inbox
		where rcp_to='".$this->access->user_id."' order by id desc limit 50";
		if($q=$this->db->query($s)){
			foreach($q->result() as $row){
				$data[]=$row;
			}
		}
		echo json_encode($data);
	}
	function list_msg() {
		$msg=""; $last_id=0;$data="";
		$s="select rcp_from,subject,message,id,msg_date,is_read from maxon_inbox";
		$s.=" where rcp_to='".$this->access->user_id."' order by id desc limit 50";
		
		$tbl="<table style='width:100%'>
		<thead><tr><th>From</th><th>Subject</th><th>Date</th><th>Read</th></tr></thead>
		<tbody>";
		if($q=$this->db->query($s)){
			foreach($q->result() as $row){
			    $subject=trim($row->subject);
                if(strlen($subject)>80)$subject=substr($subject,0,80)."...";
				$tbl.="<tr>";
				$tbl.="<td>".$row->rcp_from."</td>
				<td>".anchor("maxon_inbox/view_msg/".$row->id,$subject)."</td>
				<td>".$row->msg_date."</td><td>".$row->is_read."</td>";
				$tbl.="</tr>";
			}
		}
		$tbl.="</tbody></table>";
		$data['list_msg']=$tbl;
		$year=date("Y")-1;
		$s="delete from maxon_inbox where year(msg_date)<$year";
		$this->db->query($s);
        $this->template->display("maxon_inbox/list_msg",$data);
	}
	function notify(){
		$user_id=$this->input->get("user_id");
		$s="select count(1) as cnt from maxon_inbox where rcp_to='$user_id' and (is_read is null or is_read=0)";
		$cnt=$this->db->query($s)->row()->cnt;
		echo "<div class='info_link' href='".base_url()."index.php/maxon_inbox/list_msg'>Inbox <span class='box-badge'>$cnt</span> unread.</div>";	
	}
    function alert_count(){
        $user_id=user_id();
        $s="select count(1) as cnt from maxon_inbox where rcp_to='$user_id' and (is_read is null or is_read=0)";
        $cnt=$this->db->query($s)->row()->cnt;
        $data['success']=true;
        $data['count']=$cnt;
        echo json_encode($data);        
    }
		
}
