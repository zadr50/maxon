 
function company_list()
{
	 
	$.ajax({type: "GET",             
		url: CI_BASE+"index.php/reg_company/com_list", 
		error: function (xhr, ajaxOptions, thrownError) {
			$("#com_list").html("Unable load company list.");
		},
		success: function(result){
			console.log(result);
			if(IsJsonString(result))
			{
				var result = eval('('+result+')');
				var data=result.data;
				var s="";
				for(var i=0;i<data.length;i++)
				{
					com_data=data[i];
					
					s='<div id="box_'+(i+1)+'" class="col-lg-3 col-md-3 col-sm-3 com_box">';
					s=s+'<div class="com_logo"><img src="'+com_data.com_logo+'"></div>';
					s=s+'<div class="com_content"><p>'+com_data.com_short_desc+'</p>';
					s=s+'<p>'+com_data.com_long_desc+'</p>';
					s=s+'<p><strong>Code : '+com_data.com_code+'</strong></p>';
					s=s+'<p><a href="'+com_data.com_url+'" target="_blank">Open This Company...</a></p>';
					s=s+'</div></div>';
					
					$("#com_list").append(s);
					
				} 
			} else { 
				$("#com_list").html("Unable load company list.");
			}
		}
	});		
	
}
function new_company()
{
	var company=$("#company").val();
	if(company==""){alert("Enter your company name.");return false};
	$("#content_process").html("<h1>Please wait...</h1><img src='"+CI_BASE+"images/loading.gif'>");
	$.ajax({
		url: CI_BASE+"index.php/reg_company/new_folder/"+company, 
		type: "GET",             
		progress: loading(),
		finish: loading_close(),
		error: function (xhr, ajaxOptions, thrownError) {
			$("#content_process").html("<div class='alert alert-danger'>Error creating new company</div>");
		},
		success: function(result)
		{
			console.log(result);
			if(IsJsonString(result))
			{
				new_company_process(result);
				company_list();

			} else { 
				$("#content_process").html("<div class='alert alert-danger'>Error creating new company</div>");
			}
		}
	});		
}	
function new_company_process(result)
{	
	console.log(result);
	var result = eval('('+result+')');
	var company = result.company;
	var data=null;
	var err=null;
	if (result.success)
	{
		data=result.data;
		err=result.sql_error;
		
	} else {
		console.log(result.message);
	}
	if(data==null){
		data=['Error creating new company'];
	}
	var s='<h1>Processing.</h1><h3>Please wait...</h3>';
	for(var i=0;i<data.length;i++)
	{
		s=s+'<p>'+data[i]+'</p>';
	}
	s=s+'<div class="alert alert-info"><p>Congratulation your company '+
	'has been created. Please continue for additional setting. </p>' +
	'<p><a href="'+CI_BASE+'company/'+company+'/index.php" class="btn btn-primary" target="blank">Continue</a></p>' +
	'</div>';
	if(err!="") s = s+'</br>Sql: '+err;
	loading_close();
	$("#content").html(s);
	
	
	
	
}
function box_confirm()
{
	bootbox.dialog({
                title: "This is a form in a modal.",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">Name</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input id="name" name="name" type="text" placeholder="Your name" class="form-control input-md"> ' +
                    '<span class="help-block">Here goes your name</span> </div> ' +
                    '</div> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="awesomeness">How awesome is this?</label> ' +
                    '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-0" value="Really awesome" checked="checked"> ' +
                    'Really awesome </label> ' +
                    '</div><div class="radio"> <label for="awesomeness-1"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-1" value="Super awesome"> Super awesome </label> ' +
                    '</div> ' +
                    '</div> </div>' +
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function () {
                            var name = $('#name').val();
                            var answer = $("input[name='awesomeness']:checked").val()
                            Example.show("Hello " + name + ". You've chosen <b>" + answer + "</b>");
                        }
                    }
                }
            }
        );
}
