<legend><?=$caption?></legend>
<div class='row'><div class='col-md-10'>
<?php 
echo my_input("Kelompok Pelanggan","cust_type");
echo my_button("Filter","filter();return false","filter","Load Price for this customer type");
echo my_button("Add","add();return false","plus","Addnew customer type");
$type=$this->db->select("type_id,type_name")->order_by("type_id")->get("customer_type");
?>
<div id='info'>
<?php 
$data="";
foreach($type->result() as $row)
{
	$data.=$row->type_id." = ".$row->type_name.", ";
}
echo "<i style='color:red'>* Kode Harga: ".$data."</i>";
?>
</div>
<div id="price_output">
</div>
<script language="javascript">
function add(){
	add_tab_parent("add_customer_type","<?=base_url()?>index.php/customer_type/add");
}
function filter()
{
	loading();
	$.ajax({
		type: "GET",
		url: "<?=base_url()?>index.php/inventory/filter",
		success: function(msg){
			loading_close();
			parseScript(msg);
			var result = eval('('+msg+')');
			var table="<table class='table'><thead><tr><td>Kode</td><td>Nama Barang</td>"
				+ "<td>Harga Standard</td>";
			table=table+"<td>Harga 1</td>";
			table=table+"<td>Harga 2</td>";
			table=table+"<td>Harga 3</td>";
			table=table+"</tr></thead>";
			var tbody="<tbody>";
			for(var i=0; i< result.length; i++) {
				r=result[i];
				var item_number=r.item_number;
				var retail=r.retail;
				var description=r.description;
				tbody=tbody+"<tr><td>"+item_number+"</td>"
				+ "<td>"+r.description+"</td>"
				+ "<td align='right'>"+number_format(retail)+"</td>"
				+ "<td><input type='text' name='price1_"+item_number+"' "
				+ " value='' style='width:100px' align='right'></td>"
				+ "<td><input type='text' name='price2_"+item_number+"' "
				+ " value='' style='width:100px' align='right'></td>"
				+ "<td><input type='text' name='price3_"+item_number+"' "
				+ " value='' style='width:100px' align='right'></td>"
				+ "<td><input type='button' onclick=save_row('"+item_number+"');return false; class='btn' value='Save'>";
				+ "</tr>";
			}
			table=table+tbody;
			table=table+"</tbody></table>";
			$('#price_output').html(table);
			return true;
		},
		error: function(msg){
			loading_close();
			log_msg(msg);
		}
	});	
}
function save_row(item_number){
	alert(item_number);
	var price1=$("input name=['price1_"+item_number+"']").val();
	console.log(price1);
}
</script>