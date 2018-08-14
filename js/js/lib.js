//new run module on tab
var index = 0;
$("<style type='text/css'>"+
"#boxMX{display:none;background: #333;padding: 10px;border: 2px solid #ddd;"+
"float: left;font-size: 1.2em;position: fixed;top: 50%; left: 50%;z-index: 99999;"+
"box-shadow: 0px 0px 20px #999; -moz-box-shadow: 0px 0px 20px #999;"+
"-webkit-box-shadow: 0px 0px 20px #999; border-radius:6px 6px 6px 6px; "+
"-moz-border-radius: 6px; -webkit-border-radius: 6px; "+
"font:13px Arial, Helvetica, sans-serif; padding:6px 6px 4px;width:300px; color: white;"+
"}</style>").appendTo("head");
function alertMX(t){
	$( "body" ).append( $( "<div id='boxMX'><p class='msgMX'></p></div>" ) );
	$('.msgMX').text(t); 
	var popMargTop = ($('#boxMX').height() + 24) / 2, 
	popMargLeft = ($('#boxMX').width() + 24) / 2; 
	$('#boxMX').css({ 'margin-top' : -popMargTop,
	'margin-left' : -popMargLeft}).fadeIn(600);
	$("#boxMX").click(function() { $(this).remove(); });  
};

	function is_assoc($a){	
	   $a = array_keys($a);
	   return ($a != array_keys($a));
	}

	
	function add_tab_parent(title,url){
		if (window.parent.$('#tt').tabs('exists', title)){ 
			window.parent.$('#tt').tabs('select', title); 
		} else { 			
			index++;
			var content = '<iframe scrolling="auto" frameborder="0" src="'+url+'" style=";width:99%;height:900px;"></iframe>'; 
			window.parent.$('#tt').tabs('add',{
				title: title,
				content: content,
				closable: true
			});
		}	
		 window.top.scrollTo(0,0);
	}
	
	function add_tab(title,url){
		if ($('#tt').tabs('exists', title)){ 
			$('#tt').tabs('select', title); 
		} else { 			
			index++;
			var content = '<iframe scrolling="auto" frameborder="0" src="'+url+'" style=";width:99%;height:900px;"></iframe>'; 
			$('#tt').tabs('add',{
				title: title,
				content: content,
				closable: true
			});
		}	
		 window.top.scrollTo(0,0);
	}
	function remove_tab(){
		var tab = $('#tt').tabs('getSelected');
		if (tab){
			var index = $('#tt').tabs('getTabIndex', tab);
			$('#tt').tabs('close', index);
		}
	}
//logging on top section
var t=0;
	function hide_log(){
		window.parent.$("#msg-box-wrap").slideUp( 300 ).delay( 800 ).fadeOut( 400 );
		$("#boxMX").slideUp(300).delay(800).fadeOut(400);
	}
	function show_log(){
		window.parent.$("#msg-box-wrap").slideUp( 300 ).delay( 50 ).fadeIn( 100 );
//		t=setTimeout(function(){hide_log()}, 1000);
	}
	function log_msg(msg) {
		var s="<div id='msg-box' class=''>";
		s=s+"<div id='msg-text' class='log-msg-ok'> "+msg+"</div></div>";			
		window.parent.$("#msg-box-wrap").html(s);
		show_log();
//		alertMX(msg);	
	}
	function log_err(msg) {
		var s="<div id='msg-box' class=''>";
		s=s+"<div id='msg-text'  class='log-msg-err'> "+msg+"</div></div>";			
		window.parent.$("#msg-box-wrap").html(s);
		show_log();
		alertMX(msg);
	}

var utils = {};
	utils.inArray = function(searchFor, property) {
		var retVal = -1;
		var self = this;
		for(var index=0; index < self.length; index++){
			var item = self[index];
			if (item.hasOwnProperty(property)) {
				if (item[property].toLowerCase() === searchFor.toLowerCase()) {
					retVal = index;
					return retVal;
				}
			}
		};
		return retVal;
	};
	Array.prototype.inArray = utils.inArray;
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function run_menu(path){
     xurl=CI_ROOT+path;
     
     window.open(xurl,'_self');
    
 }
function post_this(xurl,param,divout){
    console.log(xurl);
    console.log(param);
	$.ajax({
		type: "POST",
		url: xurl,
		data: param,
		success: function(msg){
			if(divout!="") {
				$('#'+divout).html(msg);
			};
			//errmsg("Ready.");
		},
		error: function(msg){alert(msg);}
	}); 
        return false;
}
function get_this(xurl,param,divout){
		console.log(xurl);        
        if(divout!=''){
			$('#'+divout).html("<img src='"+CI_BASE+"images/loading.gif'>");
//        	event.preventDefault();
            $.ajax({
                    type: "GET",
                    url: xurl,
                    data: param,
                    success: function(msg){
                            if(divout!="") {
                        // ajax strip out <script>???    	
						//		$("#"+divout).get(0).innerHTML = msg;
								parseScript(msg);
                                $('#'+divout).html(msg);
                                
                            };
                            //errmsg("Ready.");
                    },
                    error: function(msg){alert(msg);}
            }); 
            return false;
        } else {
           
            window.open(xurl,'_self');
            return false;
        }
}
function exist_key(table,field,value){
	var exist=false;
	$.ajax({type: "GET",url: CI_BASE+"index.php/table/exist_key",
		data:{"table":table,"field":field,"value":value},
		success: function(msg){
			alert(msg);
			var result = eval('('+msg+')');
			exist=result.exist;
		},error: function(msg){alert(msg);}
	});
	return exist;
}
// this function create an Array that contains the JS code of every <script> tag in parameter
// then apply the eval() to execute the code in every script collected
function parseScript(strcode) {
  var scripts = new Array();         // Array which will store the script's code
  // Strip out tags
  while(strcode.indexOf("<script") > -1 || strcode.indexOf("</script") > -1) {
    var s = strcode.indexOf("<script");
    var s_e = strcode.indexOf(">", s);
    var e = strcode.indexOf("</script", s);
    var e_e = strcode.indexOf(">", e);
    // Add to scripts array
    scripts.push(strcode.substring(s_e+1, e));
    // Strip from strcode
    strcode = strcode.substring(0, s) + strcode.substring(e_e+1);
  }
  
  // Loop through every script collected and eval it
  for(var i=0; i<scripts.length; i++) {
    try {
      eval(scripts[i]);
    }
    catch(ex) {
      // do what you want here when a script fails
    }
  }
}
function myformatter(date){

        var y = date.getFullYear();

        var m = date.getMonth()+1;

        var d = date.getDate();

        return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);

}

function myparser(s){

        if (!s) return new Date();

        var ss = s.split('-');

        var y = parseInt(ss[0],10);

        var m = parseInt(ss[1],10);

        var d = parseInt(ss[2],10);

        if (!isNaN(y) && !isNaN(m) && !isNaN(d)){

                return new Date(y,m-1,d);

        } else {

                return new Date();

        }

}
function next_number(kode,divOutput)
{
    $.ajax({
        type: "GET",
        url: CI_ROOT+'autonumber',
        data: 'q='+kode,
        success: function(msg){
            $('#'+divOutput).html(msg);
        },
        error: function(msg){alert(msg);}
    }); 
}
// this function create an Array that contains the JS code of every <script> tag in parameter
// then apply the eval() to execute the code in every script collected
function parseScript(strcode) {
  var scripts = new Array();         // Array which will store the script's code
  
  // Strip out tags
  while(strcode.indexOf("<script") > -1 || strcode.indexOf("</script") > -1) {
    var s = strcode.indexOf("<script");
    var s_e = strcode.indexOf(">", s);
    var e = strcode.indexOf("</script", s);
    var e_e = strcode.indexOf(">", e);
    
    // Add to scripts array
    scripts.push(strcode.substring(s_e+1, e));
    // Strip from strcode
    strcode = strcode.substring(0, s) + strcode.substring(e_e+1);
  }
  
  // Loop through every script collected and eval it
  for(var i=0; i<scripts.length; i++) {
    try {
      eval(scripts[i]);
    }
    catch(ex) {
      // do what you want here when a script fails
    }
  }
}

function number_format(num,dig,dec,sep) {
  x=new Array();
  s=(num<0?"-":"");
  num=Math.abs(num).toFixed(dig).split(".");
  r=num[0].split("").reverse();
  for(var i=1;i<=r.length;i++){x.unshift(r[i-1]);if(i%3==0&&i!=r.length)x.unshift(sep);}
  return s+x.join("")+(num[1]?dec+num[1]:"");
}		

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
// $(document).ready(function(){
//	 $('.ajax').click(function(e){	  
//                e.preventDefault();
//                $.get($(this).attr('href'),function(Res){
//                $('#main_content').html(Res);
//            });
//	 })
//	 $('.ajax_popup').click(function(e){
//                e.preventDefault();
//                $.get($(this).attr('href'),function(Res){
//                $('#content_popup').html(Res);
//            });
//	 })
//        $('form').submit(function(event) {
//          event.preventDefault(); // Prevent the form from submitting via the browser.
//          var form = $(this);
//          param=form.serialize();
//          console.log(param);
//          $.ajax({
//            type: form.attr('method'),
//            url: form.attr('action'),
//            data: param
//          }).done(function(msg) {     
//            //$('#main_content').html(msg);
//            //$('#dlg').dialog('close');
//           
//            $.messager.alert('Info','Success !')
//          }).fail(function(jqXHR, textStatus, errorThrown) {
//              console.log(jqXHR.responseText);
//              $.messager.alert('Info','Error !')
//          });
//        });
//
// })
