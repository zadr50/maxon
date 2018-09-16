<div class="row-fluid" >
	<?php
	$limit=100;
	if($cmd=="list") {
		$this->load->library("browser");
		$browse=new browser();
		$config['tablename']='';
		$config['sql']='select id,title,category,date_post,author from articles';
		$config['primary_key']="id";
		$config['order_by']="title";
		$config['where']="where category='eshop'";
		$config['use_bootstrap']=true;
		$config['id']="tblArt";
		$config['limit']=$limit;
		$config['caption']='Manage Article';
		$config['show_view_button']=true;
		$config['show_edit_button']=false;
		$config['show_delete_button']=false;
		
		$config['fields']=array(
			'id'=>array("caption"=>"Id",'size'=>50),
			'title'=>array('caption'=>'Judul','size'=>50),
			'category'=>array('caption'=>'Kelompok','size'=>200),
			'date_post'=>array('caption'=>'Tanggal','size'=>50),
			'author'=>array('caption'=>'Author','size'=>50)
		);
		$config['controller']="articles";

		if(!isset($page))$page=0;
		$config['page']=$page;
		$config['exclude_script']=false;

		$browse->init($config);
		$browse->render();		
		
	} else {
		$s='select id,title,category,date_post,author,content from articles';
		if($q=$this->db->where('id',$id)->get('articles')) {
			echo $q->row()->content;
		}
	?>
	
	<?php } ?>
</div>
