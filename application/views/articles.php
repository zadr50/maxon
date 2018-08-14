<?
	if($model=$this->db->where("category",$category)->get("articles")){
		foreach($model->result() as $article){
			$found_article=true;
			$id=$article->id;
			$tgl=$article->date_post;
			$day=date("d",strtotime($tgl));
			$dayname=date("D",strtotime($tgl));
			$daydate=date("Y-M",strtotime($tgl));
			$author=$article->author;
			$category=$article->category;
			$title=$article->title;
			$article=strip_tags($article->content);
			if (strlen($article) > 500) {
				$stringCut = substr($article, 0, 500);
				$article = substr($stringCut, 0, strrpos($stringCut, ' '));
			}
			$article .= '... <a href="'.base_url().'index.php/articles/view_article/'.$id
				.'"> Read More</a>'; 

			echo "<article id='post-$id' >
			<header class='post-title'><h1>
				<a href='".base_url()."index.php/articles/view_article/$id'>$title</a>
			</h1></header>
			<p class='post-date'><strong>$day</br></strong><em>$dayname</br></em>
				<span>$daydate</span>
			</p>
	<div class='post-info clear-fix'>
		<p>
			Posted <span class='by-author'> by <span class='author vcard'>
			<a class='url fn n' href=''
			title='View all posts by $author' rel='author'>$author</a></span></span>
			in <a href=''
			rel='category tag'>$category</a>		</p>
		<p class='post-com-count'>
			<strong>˜ <a href=''
			title='$title'></a></strong>
		</p>
	</div>

	<div class='post-content clear-fix'>
		<div class='post-extras'>
			<p><strong>Tags</strong></p><p><a href='' rel='tag'></a></p>	
		</div>  

		<div class='post-entry'>
			<p>$article</p>			 
		</div>
	</div>
	
			</article>";
		}
	}
?>
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>themes/standard/article.css">

