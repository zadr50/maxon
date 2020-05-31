$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
  $("#btnPrint").click(function(e) {
    e.preventDefault();
	$("#table_wrapper").printThis({
    importCSS: false,
    loadCSS: "assets/dist/css/printing.css"});
	});
    
    $(".link2").click(function(event){
		event.preventDefault(); 
		var url = $(this).attr('href');
		console.log(url);
		var n = url.lastIndexOf("/");
        var j=url.lastIndexOf("#");
        var param={is_ajax:true};
		if(j>0){
			var title=url.substr(j+1);
		} else {
			var title=url.substr(n+1);
		}
		if(title=='reports'){
			title=url.substr(n-10);
			title=title.substr(title.indexOf("/"));
		}
		if(url.indexOf("/menu")>5){
			window.open(url,"_self");
		} else {
            $('#content').html("<img src='"+CI_BASE+"images/loading.gif'>");
            $.ajax({ type: "GET", url: url, data: param,
                success: function(msg){
                    if(!IsJsonString(msg))return;
                    var result = eval('('+msg+')');
                    var ofield=result.fields;
                    var ocaption=result.fields_caption;
                    
                    var i=0;
                    var afield=[];
                    for(i=0;i<ofield.length;i++){
                        afield.push({field:ofield[i],title:ocaption[i],width:100});
                    }
                    _controller=CI_ROOT+"/"+result.controller;
                    var ctrl = _controller + "/browse_data/";
                    $("#content-header").html(result.caption);

                    $('#dgTable').datagrid({
                        url: ctrl,  
                        columns:[afield]
                    });                    
                    $("#divTable").show();
                    $('#content').html(msg);    
                    return true;
                },
                error: function(msg){
                    console.log(msg);
                }
            }); 

		}
    });
      
});


function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
};

