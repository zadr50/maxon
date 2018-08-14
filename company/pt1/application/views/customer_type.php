<?
$data['title']="DAFTAR KELOMPOK CUSTOMER";
$data['help']="customer_type";
$data['form_controller']="customer_type";
$data['field_key']="type_id";
echo load_view("simple_form.php",$data);
if($mode=="view"){
	echo load_view("sales/cust_type_prices",$data);
}
?>
<script>
function edit_aed()
{
	alert("edit");
}
</script>