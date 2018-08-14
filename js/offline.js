$("<style type='text/css'>"+
"#boxOff{display:none;background: #333;padding: 10px;border: 2px solid #ddd;"+
"float: left;font-size: 1.2em;position: fixed;top: 90%; left: 1%;z-index: 99999;"+
"box-shadow: 0px 0px 20px #999; -moz-box-shadow: 0px 0px 20px #999;"+
"-webkit-box-shadow: 0px 0px 20px #999; border-radius:6px 6px 6px 6px; "+
"-moz-border-radius: 6px; -webkit-border-radius: 6px; "+
"font:13px Arial, Helvetica, sans-serif; padding:6px 6px 4px;width:300px; color: white;"+
"}</style>").appendTo("head");
function start_offline(){
	var t="HALOOO";
	$( "body" ).append( $( "<div id='boxOff'><p class='msgOff'></p></div>" ) );
	$('.msgOff').text(t); 
	var popMargTop = ($('#boxOff').height()), 
	popMargLeft = 10; 
	$('#boxOff').css({ 'margin-top' : -popMargTop,
	'margin-left' : -popMargLeft}).fadeIn(600);	
	$("#boxOff").click(function() { $(this).remove(); });  
	
	var url=CI_ROOT+"inventory/lookup_json2";
	var param={category:"all"};
	loading();
	$.ajax({
		url: url, 
		type: "GET",             
		data: param,
		contentType: false,       
		cache: false,             
		processData:false,
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
			log_err(xhr.responseText);
			loading_close();
		},
		success: function(result)
		{
			console.log(result);
			if(IsJsonString(result))
			{
				var result = eval('('+result+')');
				if (result.success)
				{
					loading_close();
					
					var items=result.items;
					var itm=JSON.parse(localStorage['items']);
					localStorage['items']=JSON.stringify(items);
 
				} else {
					loading_close();
					log_err(result.message);
				}
			} else { 
				loading_close();
				log_err(result);
			}
		}
	});		
	
};
