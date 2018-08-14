 
<?
			$day=date("d",strtotime($date_post));
			$dayname=date("D",strtotime($date_post));
			$daydate=date("Y-M",strtotime($date_post));
?>
<article id='post-$id' >
			<header class='post-title'><h1><?=$title?></h1></header>
			<p class='post-date'><strong><?=$day?></strong></br>
			<em><?=$dayname?></em></br><span><?=$daydate?></span>
			</p>
	<div class='post-info clear-fix'>
		<p>Posted 
		<span class='by-author'> by 
		<span class='author vcard'>
			<a class='url fn n' href=''
			title='View all posts by $author' 
			rel='author'><?=$author?>
			</a>
		</span>
		</span>
			in <a href=''
			rel='category tag'><?=$category?></a>
		</p>
			<p class='post-com-count'>
			<strong>˜ <a href=''
			title=<?=$title?>>Leave a comment</a></strong>
		</p>
	</div>

	<div class='post-content clear-fix'>
		<div class='post-extras'>
			<p><strong>Tags</strong></p><p><a href='' rel='tag'></a></p>	
		</div>  

		<div class='post-entry'>
			<p><?=$content?></p>			 
		</div>
	</div>
	
			</article>

 
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>themes/standard/article.css">
