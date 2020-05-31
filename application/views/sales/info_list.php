<? if($offset==0){ ?>
	<div class='thumbnail'>
		<?=link_button("Add", "add();return false;","add","true");?>
		<?=link_button('List','list();return false;','search');?>
		<?=link_button('Search','search_list('.$offset.');','search');?>
	</div>
	<div class='thumbnail'>
		<form id='frmSearch'>
		<? echo $criteria_text; ?>
		</form>
	</div>
	<?php
}

	$s="select customer_number,company,city,phone,fax,first_name,street,salesman,current_balance
	from customers where 1=1";
	if(isset($sid_kode)){
		if($sid_kode!=''){
			$s .= " and customer_number like '%".$sid_kode."%'";
		}
	}
	if(isset($sid_nama)){
		if($sid_nama!=''){
			$s .= " and company like  '%".$sid_nama."%'";
		}
	}
	if(isset($sid_city)){
		if($sid_city!=''){
			$s .= " and city like  '%".$sid_city."%'";
		}
	}
	
	$s=$s." order by company";
	$s=$s." limit ".$offset.",9";		
	if($q=$this->db->query($s)){
		$i=0;
		foreach($q->result() as $row){
			$i++;
			echo "<div class='info-maxon thumbnail' onclick=on_view('$row->customer_number');>";
			echo "<div class='photo'>
					   <img src='' />
				  </div>";
			echo "<div class='detail'>";
			echo "Kode: <strong>".$row->customer_number."</strong>";
			echo "</br>Saldo Piutang : ".number_format($row->current_balance);
			echo "</br>Customer : ".($row->company);
			echo "</br>Kota : ".$row->city;
			echo "</br>Telp/Fax : ".$row->phone.'/'.$row->fax;
			echo "</br>Kontak : ".$row->first_name.': Salesman: '.$row->salesman;
			echo "</br>Alamat: ".$row->street;
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
	var url='<?=base_url()."index.php/customer/list_info"?>';
	return get_this(url,'offset='+offset,'next_row_info'+offset);
};
function on_view(kode) {
	var url='<?=base_url()."index.php/customer/view/"?>'+kode;    
	window.open(url,"_self");
}
function add() {
	var url='<?=base_url()."index.php/customer/add"?>';    
	window.open(url,"_self");
}
function list() {
	var url='<?=base_url()."index.php/customer/browse/"?>';    
	window.open(url,"_self");
}
function search_list(offset) {
  	xsearch=$('#frmSearch').serialize();
	var url='<?=base_url()."index.php/customer/list_info?"?>'+xsearch;
	window.open(url,"_self");
}
</script>
