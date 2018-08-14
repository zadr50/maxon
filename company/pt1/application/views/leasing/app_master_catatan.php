<?php 
if($query=$this->db->query("select * from maxon_inbox where subject like '%".$app_id."%' 
order by msg_date")){
	if($query->num_rows()){
		echo "<H3>MESSAGE CENTER</H3><table class='table'>
		<thead><th>Date</th><th>From</th><th>To</th><th>Subject</th></thead>";
		foreach($query->result() as $msg) {
			echo "<tr><td>$msg->msg_date</td><td>$msg->rcp_from</td><td>$msg->rcp_to</td>
			<td>$msg->subject</td></tr>
			<tr><td colspan='6'>$msg->message</td></tr>";
		}
		echo "</table>";
	}
}

?>