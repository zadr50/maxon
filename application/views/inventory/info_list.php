<?php if($offset==0){ ?>
	<div class='thumbnail'>
		<?=link_button("Add", "add();return false;","add","true");?>
		<?=link_button('List','list();return false;','list');?>
		<?=link_button('Search','search_stock('.$offset.');','search');?>
	</div>
	<div class='thumbnail'>
		<form id='frmSearch'>
		<?php echo $criteria_text; ?>
		</form>
	</div>
	<?php
}

	$s="select item_number,description,unit_of_measure,quantity_in_stock,category,
		sub_category,supplier_number,item_picture 
			from inventory where 1=1";
	if(isset($sid_kode)){
		if($sid_kode!=''){
			$s .= " and item_number like '%".$sid_kode."%'";
		}
	}
	if(isset($sid_nama)){
		if($sid_nama!=''){
			$s .= " and description like  '%".$sid_nama."%'";
		}
	}
	if(isset($sid_supp)){
		if($sid_supp!=''){
			$s .= " and supplier_number like  '%".$sid_supp."%'";
		}
	}
	if(isset($sid_cat)){
		if($sid_cat!=''){
			$s .= " and category like  '%".$sid_cat."%'";
		}
	}
	
	$s=$s." order by description";
	$s=$s." limit ".$offset.",9";		
	if($q=$this->db->query($s)){
		$i=0;
		foreach($q->result() as $row){
			$i++;
			echo "<div class='info-maxon thumbnail' onclick=on_view('$row->item_number');>";
			echo "<div class='photo'>
					   <img src='".base_url()."tmp/".$row->item_picture."' />
				  </div>";
			echo "<div class='detail'>";
			echo "Kode: <strong>".$row->item_number."</strong>";
			echo "</br>Sisa Qty : ".number_format($row->quantity_in_stock);
			echo "</br>Satuan : ".($row->unit_of_measure);
			echo "</br>Supplier : ".$row->supplier_number;
			echo "</br>Category : ".$row->category;
			echo "</br>Nama : ".$row->description;
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
	var url='<?=base_url()."index.php/inventory/list_info"?>';
	return get_this(url,'offset='+offset,'next_row_info'+offset);
};
function on_view(kode) {
	var url='<?=base_url()."index.php/inventory/view/"?>'+kode;    
	window.open(url,"_self");
}
function add() {
	var url='<?=base_url()."index.php/inventory/add"?>';    
	window.open(url,"_self");
}
function list() {
	var url='<?=base_url()."index.php/inventory/browse/"?>';    
	window.open(url,"_self");
}
function search_stock(offset) {
  	xsearch=$('#frmSearch').serialize();
	var url='<?=base_url()."index.php/inventory/list_info?"?>'+xsearch;
	window.open(url,"_self");
}
</script>
