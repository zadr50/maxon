<div class='thumbnail'>
	<?=link_button("Add", "add_supplier();return false;","add","true");?>
	<?=link_button('List','list_supplier();return false;','list');?>
	<?=link_button('Search','search_supplier('.$offset.');','search');?>
</div>
<div class='thumbnail'>
	<form id='frmSearch'>
	<? echo $criteria_text; ?>
	</form>
</div>
<?php
	$s="select supplier_number,supplier_name,city,phone,email,plafon_hutang,credit_balance,street 
			from suppliers where 1=1";
	if(isset($sid_nama)){
		if($sid_nama!=''){
		$s .= " and supplier_name like '%".$sid_nama."%'";
		}
	}
	if(isset($sid_city)){
		if($sid_city!=''){
			$s .= " and city like  '%".$sid_city."%'";
		}
	}
	$s=$s." order by supplier_name";
	$s=$s." limit ".$offset.",9";		
	if($q=$this->db->query($s)){
		$i=0;
		foreach($q->result() as $row){
			$i++;
			echo "<div class='info-maxon thumbnail' onclick=on_view_supplier('$row->supplier_number');>";
			echo "<div class='photo'>
					   <img src='' />
				  </div>";
			echo "<div class='detail'>";
			echo "Kode: <strong>".$row->supplier_number."</strong>";
			echo "</br>Nama : ".$row->supplier_name;
			echo "</br>Plafon : ".number_format($row->plafon_hutang);
			echo "</br>Saldo Hutang : ".number_format($row->credit_balance);
			echo "</br>City : ".$row->city;
			echo "</br>Alamat : ".$row->street;
			echo "</br>";
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
		echo "Supplier not found !";
	}
?>

<script language="javascript">
function on_next_row(offset){
	var url='<?=base_url()."index.php/supplier/list_info"?>';
	return get_this(url,'offset='+offset,'next_row_info'+offset);
};
function on_view_supplier(kode) {
	var url='<?=base_url()."index.php/supplier/view/"?>'+kode;    
	window.open(url,"_self");
}
function add_supplier() {
	var url='<?=base_url()."index.php/supplier/add"?>';    
	window.open(url,"_self");
}
function list_supplier() {
	var url='<?=base_url()."index.php/supplier/browse/"?>';    
	window.open(url,"_self");
}
function search_supplier(offset) {
  	xsearch=$('#frmSearch').serialize();
	var url='<?=base_url()."index.php/supplier/list_info?"?>'+xsearch;
	window.open(url,"_self");
}
</script>
