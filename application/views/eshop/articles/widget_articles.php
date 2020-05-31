<?php
$q=$this->db->where('category','eshop')->get('articles');
foreach($q->result() as $article) {
	echo "<li>".$article->title."</li>";
}
?>
