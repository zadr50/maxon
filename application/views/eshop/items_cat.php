<div class='thumbnail' style='margin-top:30px'>
<div class="btn-group" role="group" aria-label="...">
  <button onclick="list_item(0);return false;" type="button" class="btn btn-default">First</button>
  <button onclick="list_item(<?=$page-1?>);return false;" type="button" class="btn btn-default">Previous</button>
  <button onclick="list_item(<?=$page+1?>);return false;" type="button" class="btn btn-default">Next</button>
  <button onclick="list_item(<?=$item_page_max-10?>);return false;" type="button" class="btn btn-default">Last</button>
	<button onclick="add_item();return false;" type="button" 
		class="btn btn-default">Add
	</button>
</div>
<?
if($q=$this->db->limit(10,$page*10)->get("inventory_categories")){
	echo "<table id='tbl' class='table'><thead><th>Kode#</th><th>Nama Kategori</th>
	<th>Parent</th><th>Edit</th><th>Delete</th></thead>
	<tbody>";
	foreach($q->result() as $item) {
		echo "<tr><td>$item->kode</td><td>$item->category</td>
		<td>$item->parent_id</td>
		<td><input type='button' kode='$item->kode' 
			value='View' class='btn btn-primary' data-toggle='modal'   
			data-target='#myModal'
			onclick='view_item(this);return false;'>
		</td><td>
			<a href='#' value='$item->kode' class='deleteLink btn btn-warning'>Delete</a> 
		</td></tr>";
	}
	echo "</tbody></table>";
}
?>
<div class="btn-group" role="group" aria-label="...">
  <button onclick="list_item(0);return false;" type="button" class="btn btn-default">First</button>
  <button onclick="list_item(<?=$page-1?>);return false;" type="button" class="btn btn-default">Previous</button>
  <button onclick="list_item(<?=$page+1?>);return false;" type="button" class="btn btn-default">Next</button>
  <button onclick="list_item(<?=$item_page_max?>);return false;" type="button" class="btn btn-default">Last</button>
</div>
</div>
<script language='javascript'>
$(document).ready(function() {
    $("#tbl .deleteLink").on("click",function() {
		var kode=$(this).attr("value");
		var url="<?=base_url()?>index.php/eshop/categories/delete/"+kode;
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


function view_item(t){
	var kode=t.getAttribute("kode");
	if(kode==""){alert("Nomor tidak dipilih !");return false;}
	var url="<?=base_url()?>index.php/eshop/categories/load_json/"+kode;
	$("#kode").val(kode);
	$("#item_picture_img").val('');
	$.ajax({type: "GET", url: url, 
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				console.log(result);
				$("#category").val(result.category);
				$("#item_picture").val(result.item_picture);
				$("#parent_id").val(result.parent_id);
			} else {
				alert(result.message);
			}
		},
		error: function(msg){alert(result);}
	}); 	
}
function list_item(idx) {
	var url="<?=base_url()?>index.php/eshop/setting/view/items_cat/4/"+idx;
	window.open(url,"_self");	
}
function add_item() {
	var url="<?=base_url()?>index.php/eshop/item/add_category";
	$("#myModal").modal("show");
	$("#frmMain")[0].reset();
}
function save_item(){
	var url="<?=base_url()?>index.php/eshop/categories/save/view";
	$('#frmMain').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				$('#myModal').modal('hide');
				log_msg('Data sudah tersimpan.');
			} else {
				alert(result.message);
			}
		}
	});
};

</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
	aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Kelompok Barang</h4>
      </div>
      <div class="modal-body">
			<form  enctype="multipart/form-data" class="form-horizontal" id='frmMain' method='post' >
				<?=my_input("Kode Kategori","kode")?>
				<?=my_input("Nama Kategori","category")?>
				<?=my_input("Parent Kode","parent_id")?>
				<?=my_input("Icon","item_picture")?>				
				<?=my_input_file("","item_picture_img")?>				
			</form>	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick='save_item();return false'>Save changes</button>
      </div>
    </div>
  </div>
</div>