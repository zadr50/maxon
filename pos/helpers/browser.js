$(document).ready(function() {
    $("#tbl .deleteLink").on("click",function() {
		var item_number=$(this).attr("value");
		var url="<?=base_url()?>index.php/eshop/item/delete/"+item_number;
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
	var url="<?=base_url()?>index.php/eshop_admin/items/add";
	window.open(url,"_self");
}
function view_item(t){
	var item_number=t.getAttribute("kode");
	if(item_number==""){alert("Nomor tidak dipilih !");return false;}
	var url="<?=base_url()?>index.php/eshop/item/load_json/"+item_number;
	$("#item_number").val(item_number);
	$("#item_picture_img").val('');
	$("#item_picture2_img").val('');
	$("#item_picture3_img").val('');
	$("#item_picture4_img").val('');
	$.ajax({type: "GET", url: url, 
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				console.log(result);
				$("#description").val(result.description);
				$("#unit_of_measure").val(result.unit_of_measure);
				$("#category").val(result.category);
				$("#sub_category").val(result.sub_category);
				$("#retail").val(result.retail);
				$("#cost").val(result.cost);
				$("#item_picture").val(result.item_picture);
				$("#item_picture2").val(result.item_picture2);
				$("#item_picture3").val(result.item_picture3);
				$("#item_picture4").val(result.item_picture4);
				$("#special_features").val(result.special_features);
			} else {
				alert(result.message);
			}
				
		},
		error: function(msg){alert(result);}
	}); 	
}
function list_item(idx) {
	alert(idx);
	var url="<?=base_url()?>index.php/eshop_admin/items/browse/"+idx;
	window.open(url,"_self");	
}
function save_item(){
	var url="<?=base_url()?>index.php/eshop_admin/items/save";
	$("#frmBarang").ajax_post(url,"myModal");
};


