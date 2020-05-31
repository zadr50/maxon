<?
$q=$this->db->where("item_id",$item_id)->get("eshop_comments");
echo "<div class='box-comments-wrapper'>";
if($q->num_rows()==0){
	echo "Belum ada komentar.";
	///echo load_view("eshop/discuss/comments");
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
			<div class='bc-rating'>
				Kualitas <span class='rating-$cm->rate_quality'></span>
				Akurasi <span class='rating-$cm->rate_accurate'></span>
				Kecepatan <span class='rating-$cm->rate_speed'></span>			
				Pelayanan <span class='rating-$cm->rate_service'></span>			
			</div>			
		</div>";
	}
}
if($this->session->userdata("cust_login")){
	if(cust_id()!='')echo load_view("eshop/discuss/comments");
}
echo "</div> <!-- box-comments-wrapper --!>";
	

?>