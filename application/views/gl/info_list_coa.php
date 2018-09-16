<?php if($offset==0){ ?>
	<div class='thumbnail'>
		<?=link_button('Add','','add','true',base_url().'index.php/coa/add');?>		
		<?=link_button('List','list();return false;','list');?>
		<?=link_button('Search','search_coa('.$offset.');','search');?>
	</div>
	<div class='thumbnail'>
		<form id='frmSearch'>
		<? echo $criteria_text; ?>
		</form>
	</div>
	<?php
}

	$s="select * from chart_of_accounts where 1=1";
	if(isset($sid_nama)){
		if($sid_nama!=''){
			$s .= " and account_description like '%".$sid_nama."%'";
		}
	}
	if(isset($sid_kel)){
		if($sid_kel!=''){
			$s .= " and group_type like  '%".$sid_kel."%'";
		}
	}
	if(isset($sid_no)){
		if($sid_no!=''){
			$s .= " and account like  '%".$sid_no."%'";
		}
	}
	
	$s=$s." order by account";
	$s=$s." limit ".$offset.",9";		
	if($q=$this->db->query($s)){
		$i=0;
		foreach($q->result() as $row){
			$i++;
			echo "<div class='info thumbnail' onclick=on_view('$row->id');>";
			echo "<div class='photo'>
					   <img src='' />
				  </div>";
			echo "<div class='detail'>";
			echo "Account : <strong>".$row->account."</strong>";
			echo "</br>".$row->account_description;
			echo "</br>Group Type : ".($row->group_type);
			echo "</br>Sald Awal : ".$row->beginning_balance;
			echo "</div>";
			echo "</div>";
		}
		$offset=$offset+9;
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
	var url='<?=base_url()."index.php/coa/list_info"?>';
	return get_this(url,'offset='+offset,'next_row_info'+offset);
};
function on_view(kode) {
	var url='<?=base_url()."index.php/coa/view/"?>'+kode;    
	window.open(url,"_self");
}
function add_coa() {
	var url='<?=base_url()."index.php/coa/add"?>';    
	window.open(url,"_self");
}
function list() {
	var url='<?=base_url()."index.php/coa/browse/"?>';    
	window.open(url,"_self");
}
function search_coa(offset) {
  	xsearch=$('#frmSearch').serialize();
	var url='<?=base_url()."index.php/coa/list_info?"?>'+xsearch;
	window.open(url,"_self");
}
</script>
