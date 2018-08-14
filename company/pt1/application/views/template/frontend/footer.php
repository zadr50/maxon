 
	<?php
		$rst=$this->db->where("section_name","section-footer")->get("articles");
		foreach($rst->result() as $article)
		{
			echo "<div class='$article->class_name'>";
			echo $article->content;
			echo "</div>";
		}
	?>
	
	<div class='col-md-3'>
		<? $this->load->view('google_ads');	?>
	</div>
 
