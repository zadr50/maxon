<?
$q=$this->db->where("item_id",$item_id)->get("eshop_discuss");
echo "<div class='box-comments-wrapper'>";
if($q->num_rows()==0){
	echo "Belum ada barang sejenis.";
} else {
}
echo "</div>";
?>