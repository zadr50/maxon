<div class='row bg-head-foot' >
<div id='section-footer' >
	<?php
	$rst=$this->db->where("section_name","section-footer")->get("articles");
	foreach($rst->result() as $article)
	{
		echo "<div class='$article->class_name'>";
		echo $article->content;
		echo "</div>";
	}
	if($this->config->item("google_ads_visible")){
		echo "<div class='col-md-3'>".$this->load->view('google_ads')."</div>";
	}
	?>
</div>
</div>
