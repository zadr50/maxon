<div class='row bg-head-foot well well-sm' >
<div id='section-footer' >
	
	<div class='col-lg-12'>
		
	<?php
	$rst=$this->db->where("section_name","section-footer")->get("articles");
	foreach($rst->result() as $article)
	{
		echo "<div class='$article->class_name'>";
		echo $article->content;
		echo "</div>";
	}
	?>
	
	</div>
</div>
</div>
	<div class='col-lg-12'>
		<?php
			if($this->config->item("google_ads_visible")){
				echo load_view('google_ads');
			}
		?>
	</div>
	
