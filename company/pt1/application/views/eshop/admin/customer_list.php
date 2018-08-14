<div class="row-fluid">
		<?
		include 'tool_list.php';
		if($q=$this->db->limit(10,$page*10)->get("customers")){
			echo "<table id='tbl' class='table'><thead><th>Kode#</th><th>Nama Customer</th>
			<th>Kota</th><th>Telp</th><th>Email</th><th>Alamat</th>
			<th>Edit</th><th>Delete</th></thead>
			<tbody>";
			foreach($q->result() as $item) {
				echo "<tr><td>$item->customer_number</td><td>$item->company</td>
				<td>$item->city</td><td>$item->phone</td><td>$item->email</td>
				<td>$item->street</td>
				<td><input type='button' kode='$item->customer_number' 
					value='View' class='btn btn-primary'  data-toggle='modal'   
					data-target='#myModal'
					onclick='view_item(this);return false;'>
				</td><td>
					<a href='#' value='$item->customer_number' class='deleteLink btn btn-warning'>Delete</a> 
				</td></tr>";
			}
			echo "</tbody></table>";
		}
		include 'tool_list.php';
		$form_input='member_form.php';
		$caption="MEMBER INFO";
		include_once 'modal_panel.php';
		?>
	
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
<script language='javascript'>
$(document).ready(function() {
    $("#tbl .deleteLink").on("click",function() {
		var kode=$(this).attr("value");
		var url="<?=base_url()?>index.php/eshop/member/delete/"+kode;
		var tr = $(this).closest('tr');
 		$.ajax({
			type: "GET", url: url,
			success: function(msg){
				tr.css("background-color","#FF3700");
				tr.fadeOut(400, function(){
					tr.remove();
				});
				console.log(msg);
			},
			error: function(msg){console.log(msg);}
		}); 
		
        return false;
    });
});

function add_item() {
	var url="<?=base_url()?>index.php/eshop/member/add";
	$("#frmMain")[0].reset();
	$("#mode").val("add");
	$("#myModal").modal();
}
function view_item_modal(t)
{
	var kode=t.getAttribute("kode");
	if(kode==""){alert("Nomor tidak dipilih !");return false;}
	var url="<?=base_url()?>index.php/eshop/member/load_json/"+kode;
	$("#customer_number").val(kode);
	
	$("#mode").val("edit");
	$.ajax({type: "GET", url: url, 
		success: function(result){
			if(IsJsonString(result)){
				result = eval('('+result+')');
				if (result.success){
					$("#company").val(result.company);
					$("#password").val(result.password);
					$("#city").val(result.city);
					$("#phone").val(result.phone);
					$("#email").val(result.email);
					$("#zip_postal_code").val(result.zip_postal_code);
					$("#street").val(result.street);
			} else {
				alert(result.message);
			}
			} else {
				console.log(result);
				log_err('Unknown Error');
			}
		},
		error: function(msg){alert(result);}
	}); 		
}
function view_item(t){
	var kode=t.getAttribute("kode");
	if(kode==""){alert("Nomor tidak dipilih !");return false;}
	var url="<?=base_url()?>index.php/eshop/admin/customers/view/"+kode;
	window.open(url,"_self");
}
function list_item(idx) {
	var url="<?=base_url()?>index.php/eshop/admin/customers/"+idx;
	window.open(url,"_self");
}
function save_item(){
	var url="<?=base_url()?>index.php/eshop/admin/customers/save";
	$("#frmMain").ajax_post(url,"myModal");
};
</script>

