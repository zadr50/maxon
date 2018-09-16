	<div class='col-md-12'>
		<?php 
		$rst=$this->db->where("section_name","section-content")->get("articles");
		foreach($rst->result() as $article)
		{
			echo "<div class='$article->class_name'>";
			echo $article->content;
			echo "</div>";
		}
		?>
	</div>	
