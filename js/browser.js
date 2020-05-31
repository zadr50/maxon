function list_item(idx) {
	var row=$("#rows").val();
	var url=M_CONTROL+"/browse/"+idx+"/"+row;
	window.open(url,"_self");	
}
function page() {
	var idx=$("#page").val();
	var url=M_CONTROL+"/browse/"+idx;
	window.open(url,"_self");	
	
}
function rows() {
	var idx=$("#page").val();
	var row=$("#rows").val();
	var url=M_CONTROL+"/browse/"+idx+"/"+row;
	window.open(url,"_self");	
	
}
function add_item() {
	var url=M_CONTROL+"/add";
	window.open(url,"_self");
}
$(document).ready(function() {
	$("#"+M_ID_TABLE+" .deleteLink").on("click",function() {
		var kode=$(this).attr("value");
		var url=M_CONTROL+"/delete/"+kode;
		var tr = $(this).closest("tr");
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
	$("#"+M_ID_TABLE+" .editLink").on("click",function() {
		var kode=$(this).attr("value");
		var url=M_CONTROL+"/view/"+kode;
		window.open(url,"_self");
	});
	$("#"+M_ID_TABLE+" .viewLink").on("click",function() {
		var kode=$(this).attr("value");
		var url=M_CONTROL+"/view/"+kode;
		window.open(url,"_self");
	});
	
});
