<?
$q=$this->db->where("item_id",$item_id)->get("eshop_discuss");
echo "<div class='box-comments-wrapper'>";
if($q->num_rows()==0){
	echo "Belum ada tanya jawab antara penjualan dan calon pembeli.";
} else {
	foreach($q->result() as $cm) {
		echo "
		<div class='box-comments'>
			<div class='bc-header'>
				<span class='bc-user'>$cm->cm_username</span>
				<span class='bc-date'>$cm->cm_date</span>
			</div>	
			<div class='bc-content'>
				$cm->comments
			</div>
		</div>";
	}
}
if($this->session->userdata("cust_login")){
	if(cust_id()!='') include_once "discuss.php";
}

echo "</div> <!-- box-comments-wrapper --!>";
?>