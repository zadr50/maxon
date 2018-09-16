<div class="panel panel-primary" >
	<div class="panel-heading">
		<h3 class="panel-title"  style="padding:1px;color:white">CATEGORIES</h3>
	</div>
	<div class="panel-body"   style="padding:10px;">
		<div class='box-menu'>
		<?
		if($categories=$this->db->query("select distinct category 
			from articles a group by category")){
			$article_cats=array();
			$i=0;
			foreach($categories->result() as $row){
				$cnt=$this->db->query("select count(1) as cnt 
				from articles where category='".$row->category."'")->row()->cnt;
				$article_cats[$i]=array($row->category,$cnt);
				$i++;
			}
			for($i=0;$i<count($article_cats);$i++){
				$cats=$article_cats[$i];
				echo "<p><a href='".base_url()."index.php/website/articles/view_category/".$cats[0]."'>
				".ucwords(str_replace("_"," ",$cats[0]))."&nbsp&nbsp<span>(".$cats[1].")
				</a></span></p>";
			}
		} else {
			echo "<p>No Available Articles</p>";
		}
		
		?>
		</div>
	</div>	 
</div>	
<style>
.box-menu {
	font-weight:99;
}
.box-menu p {
	height:30px;
	width:100%;
	padding:3px;
	border-bottom:1px solid #ccc;
}
.box-menu span {	 
	color:red;
}
</style>