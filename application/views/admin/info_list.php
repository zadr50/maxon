<? if($offset==0){ ?>
	<div class='thumbnail'>
		<?=link_button("Add", "add_user();return false;","add","false");?>
		<?=link_button('List','list();return false;','more');?>
		<?=link_button('Search','search_user('.$offset.');','search');?>
		
        <?=link_button('Close','remove_tab_parent()','remove');?>      
		
	</div>
	<div class='thumbnail'>
		<form id='frmSearch'>
		<? echo $criteria_text; ?>
		</form>
	</div>
	<?
}

	$s="select user_id,username,email,path_image,active,userlevel,cid 
			from user where 1=1";
	if(isset($sid_nama)){
		if($sid_nama!=''){
			$s .= " and username like '%".$sid_nama."%'";
		}
	}
	if(isset($sid_kel)){
		if($sid_kel!=''){
			$s .= " and userlevel like  '%".$sid_kel."%'";
		}
	}
	
	$s=$s." order by username";
	$s=$s." limit ".$offset.",20";		
	if($q=$this->db->query($s)){
		$i=0;
		foreach($q->result() as $row){
			$i++;
			echo "<div class='info thumbnail' onclick=on_view('$row->user_id');>";
			echo "<div class='photo'>";
				$file=base_url()."tmp/".$row->path_image;
				if($row->path_image==""){
						echo "<img src='".base_url()."tmp/no_img.png'/>";
				} else {
					if(file_exists("tmp/".$row->path_image) ){
						echo "   <img src='".$file."' />";
					} else {
						echo "<img src='".base_url()."tmp/no_img.png'/>";
					}
				}
			echo "	  </div>";
			echo "<div class='detail'>";
			echo "User ID: <strong>".$row->user_id."</strong>";
			echo "</br>Nama : ".$row->username;
			echo "</br>Email : ".($row->email);
			echo "</br>Kelompok : ".$row->cid;
			echo "</div>";
			echo "</div>";
		}
		$offset=$offset+20;
		echo "<div class='clear'></div>";
		if($i<3){
			echo "Finish";
		} else {
			echo "<div id='next_row_info$offset'>";
			echo "<a href='#' onclick='on_next_row(".$offset.");return false;'>More...</a></div></br>";
			echo "</div>";
		}
	} else {
		echo "Data not found !";
	}
?>

<script language="javascript">
function on_next_row(offset){
	var url='<?=base_url()."index.php/user/list_info"?>';
	return get_this(url,'offset='+offset,'next_row_info'+offset);
};
function on_view(kode) {
	var url='<?=base_url()."index.php/user/view/"?>'+kode;    
    add_tab_parent("View "+kode,url);
}
function add_user() {
	var url='<?=base_url()."index.php/user/add"?>';    
    add_tab_parent("Add User ",url);
}
function list() {
	var url='<?=base_url()."index.php/user/browse/"?>';    
	window.open(url,"_self");
}
function search_user(offset) {
  	xsearch=$('#frmSearch').serialize();
	var url='<?=base_url()."index.php/user/list_info?"?>'+xsearch;
	window.open(url,"_self");
}
</script>
