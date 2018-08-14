//new run module on tab
var index = 0;
var STR_PAD_LEFT = 1;
var STR_PAD_RIGHT = 2;
var STR_PAD_BOTH = 3;

function pad(str, len, pad, dir) {
    if (typeof(len) == "undefined") { var len = 0; }
    if (typeof(pad) == "undefined") { var pad = ' '; }
    if (typeof(dir) == "undefined") { var dir = STR_PAD_RIGHT; }

    if (len + 1 >= str.length) {

        switch (dir){

            case STR_PAD_LEFT:
                str = Array(len + 1 - str.length).join(pad) + str;
            break;

            case STR_PAD_BOTH:
                var right = Math.ceil((padlen = len - str.length) / 2);
                var left = padlen - right;
                str = Array(left+1).join(pad) + str + Array(right+1).join(pad);
            break;

            default:
                str = str + Array(len + 1 - str.length).join(pad);
            break;

        } // switch

    }
	return str;
}
	function fmt_date(sdata){
		var date = new Date(sdata);  //or your date here
		return date.getFullYear()+'-'+(date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours()+':'+date.getMinutes() ;
		//return date;
	}

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

$("<style type='text/css'>"+
"#boxLoading{opacity: 0.8;display:none;background: gray;padding: 10px;border: 2px solid black;"+
"float: left;font-size: 1.2em;position: fixed;top: 50%; left: 50%;z-index: 99999;"+
"-moz-box-shadow: 0px 0px 20px #999;-moz-border-radius: 6px; -webkit-border-radius: 6px; "+
"background: url('"+CI_BASE+"images/loading.gif') norepeat;"+
"font:13px Arial, Helvetica, sans-serif; padding:6px 6px 4px;height:100px;width:200px; color: white;"+
"}</style>").appendTo("head");

function loading()
{	
	var img=CI_BASE+"images/loading.gif";
	$( "body" ).append( $( "<div id='boxLoading' style='text-align:center'><img src='"+img+"'><p class='msgLoading'></p></div>" ) );
	$('.msgLoading').text('Please Wait...'); 
	var popMargTop = ($('#boxLoading').height() + 24) / 2, 
	popMargLeft = ($('#boxLoading').width() + 24) / 2; 
	$('#boxLoading').css({ 'margin-top' : -popMargTop-70,
	'margin-left' : -popMargLeft}).fadeIn(100);
}
function loading_close()
{
	$("#boxLoading").fadeOut(800).remove();   	
}
	function is_assoc($a){	
	   $a = array_keys($a);
	   return ($a != array_keys($a));
	}

	
	function add_tab_parent(title,url){
		if ( window.parent.$('#tt').length ){
			if (window.parent.$('#tt').tabs('exists', title)){ 
				window.parent.$('#tt').tabs('select', title); 
			} else { 			
				index++;
				var content = '<iframe id="frTab" scrolling="auto" frameborder="0" src="'+url+'" style=";width:99%;height:900px;"></iframe>'; 
				window.parent.$('#tt').tabs('add',{
					title: title,
					content: content,
					closable: true
				});
			}	
			 window.top.scrollTo(0,0);
		} else {
			window.open(url,"_blank");
		}
	}
	function refresh_tab_parent(){
		window.parent.$('IFRAME#frTab').get(0).contentDocument.location.reload();
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
	function add_tab_ajax(title,url){
		if ($('#tt').tabs('exists', title)){ 
			$('#tt').tabs('select', title); 
		} else { 			
			index++;
			var img=CI_BASE+"images/loading.gif";
			var content = "<div id='tab"+title+"'><img src='"+img+"'></div>"; 
			$('#tt').tabs('add',{
				title: title,
				content: content,
				closable: true
			});
			get_this(url,'','tab'+title);
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
	function remove_tab_parent(){
		t=setTimeout(function(){remove_tab_parent_delay()}, 3000);
	}
	function remove_tab_parent_delay(){
		var tab = window.parent.$('#tt').tabs('getSelected');
		if (tab){
			var index = window.parent.$('#tt').tabs('getTabIndex', tab);
			window.parent.$('#tt').tabs('close', index);
		}		
	}
	
//logging on top section
var t=0;
	function hide_log(){
		//window.parent.$("#msg-box-wrap").slideUp( 300 ).delay( 800 ).fadeOut( 400 );
		$("#boxMX").slideUp(300).delay(800).fadeOut(400);
	}
	function show_log(){
		window.parent.$("#msg-box-wrap").slideUp( 300 ).delay( 50 ).fadeIn( 100 );
		t=setTimeout(function(){hide_log()}, 3000);
	}
	function log_msg(msg) {
		var s="<div id='msg-box' class=''>";
		s=s+"<div id='msg-text' class='log-msg-ok'> "+msg+"</div></div>";			
		window.parent.$("#msg-box-wrap").html(s);
		show_log();
		alertMX(msg);	
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
	
	function cf_(n){
		return formatNumber(n);
	}
function formatNumber (n) {
	if(n==undefined){
		return 0;
	} else {
		 var parts=n.toString().split(".");
	    return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
    
		//return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
	}
}
   function getNum(val) {
       return parseFloat(c_(val));
    }
    function c_(val){
    	t=val;
		if(t===""){
			t=0;
		} else {
			t=t.toString().replace(/,/g , "");		
		}
		t=(+t);
		return t;
    }
function cval(txt){
	t=0;
	t=$(txt).val();
	if(t===""){
		t=0;
	} else {
		t=t.toString().replace(/,/g , "");		
	}
	t=(+t);
	cvalf(txt,t);
	
	return t;
}
function cvalf(txt,val){
	$(txt).val(formatNumber(val));
}
    

function run_menu(path){
     xurl=CI_ROOT+path;     
     window.open(xurl,'_self');
 }
function post_this(xurl,param,divout){
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
    if(divout!=''){
        $('#'+divout).html("<img src='"+CI_BASE+"images/loading.gif'>");
       	event.preventDefault();
        $.ajax({ type: "GET", url: xurl, data: param,
            success: function(msg){
                if(divout!="") {
                    // ajax strip out <script>???    	
                    // $("#"+divout).get(0).innerHTML = msg;
                    //parseScript(msg);
                    $('#'+divout).html(msg);
                };
                //errmsg("Ready.");
                return true;
            },
            error: function(msg){
                console.log(msg);
            }
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
			//alert(msg);
			var result = eval('('+msg+')');
			exist=result.exist;
		},error: function(msg){alert(msg);}
	});
	return exist;
}
function format_date(date) { return myformatter(date) }
function myformatter(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();
		var h=date.getHours();
		var i=date.getMinutes();
		var s=date.getMilliseconds();
		return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d)+' '+(h<10?('0'+h):h)+':'+(i<10?('0'+i):i)+':'+(s<10?('0'+s):s);
}

function parse_date(date) { return myparser(date) }
function myparser(s){
        if (!s) return new Date();
		var sign=s.indexOf("/")>0?'/':'-';
		var sa = s.split(' ');
		var ss = sa[0].split(sign);
        var y = parseInt(ss[0],10);
        var m = parseInt(ss[1],10);
        var d = parseInt(ss[2],10);
		if(sign=="/"){
			m = parseInt(ss[0],10);
			d = parseInt(ss[1],10);
			y = parseInt(ss[2],10);
		}
		var h=0;
		var i=0;
		var s=0;
		if (sa.length>1) {
			st = sa[1].split(':')
			h = parseInt(st[0],10);
			i = parseInt(st[1],10);
			s = parseInt(st[2],10);
		} 
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d,h,i,s);
        } else {
                return new Date();
        }
}
function next_number(kode,divOutput){
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
    console.log(strcode);
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
function roundNumber(num, scale) {
  if(!("" + num).includes("e")) {
    return +(Math.round(num + "e+" + scale)  + "e-" + scale);
  } else {
    var arr = ("" + num).split("e");
    var sig = ""
    if(+arr[1] + scale > 0) {
      sig = "+";
    }
    return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
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
	function lookup(fields,form,xurl){
		var dlg="dialog_"+form;
		var table="table_"+form;
		if(! $("#"+dlg).html() ){
			var tbl="<div id='"+dlg+"'><table id='"+table+"' width='90%'></table></div>" +
			"<div id='boxTool' class='box-gradient'> " +
			" Enter Text: <input id='search_"+form+"' style='width:180' " +
			" name='search_"+form+"'>&nbsp <a href='#' class='btn btn-sm btn-info' " +
			" iconCls='icon-search' plain='false' " +
			" onclick='on_search_"+form+"();return false;'>&nbsp Search &nbsp </a> " +
			" <a href='#' class='btn btn-sm btn-info' iconCls='icon-ok' " +
			" plain='false' onclick='on_select_"+form+"();return false;'> &nbsp  Select &nbsp </a> </div>" +
			"  ";
			$("body").append( $( tbl ) );
			$('#'+table).datagrid({url:'',singleSelect:true, columns: fields});			
		}
		$('#'+table).datagrid({url:xurl});
		$('#'+table).datagrid('reload');

		$("#"+dlg).dialog({title: 'Pilih baris.', toolbar: '#boxTool',
			width: 500, height: 400,   closed: false,   cache: false,
			modal: true});		
		$("#"+dlg).dialog("open").dialog("setTitle","Pilih baris.");
	}
	function load_help(id) {
		window.parent.$("#help").load(CI_ROOT+"help/load/"+id);
	}
function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
$.fn.ajax_post = function(url,divModal,next_url) {
	loading();
	//console.log(this[0]);
	var data=new FormData(this[0]);
	$.ajax({
		url: url, 
		type: "POST",             
		data: data,
		contentType: false,       
		cache: false,             
		processData:false,
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
			log_err("Unknown Error");
			loading_close();
		},
		success: function(result)
		{
			if(IsJsonString(result))
			{
				var result = eval('('+result+')');
				if (result.success)
				{
					if(divModal!="undefined"){
						$('#'+divModal).modal('hide');
					}
					log_msg('Data sudah tersimpan.');
					if(next_url!='undefined'){
						loading_close();
						var t=setTimeout(function(){
								window.open(next_url,"_self");
						},2000);
					}
				} else {
					loading_close();
					alert(result.message);
				}
			} else { 
				console.log(result);
				loading_close();
				alert("Unknown Error"); 
			}
		}
	});
};

function ajax_get(url,param,next_url)
{
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
					log_msg(result.message);
					if(next_url!='') {
						var t=setTimeout(function(){
							window.open(next_url,"_self");
						},3000);
					}
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
}
 
$(document).ready(function(){
	$(".info_link").click(function(event){
		event.preventDefault(); 
		var url = $(this).attr('href');
		console.log(url);
		var n = url.lastIndexOf("/");
		var j=url.lastIndexOf("#");
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
			add_tab_parent(title,url);
		}
	});
});


function DataGrid(){
	this.table_id="tt";
	this.title="";
	this.columns=null;
	this.url='';
	this.buttons="";
	this.render=function() {
	$('#'+this.table_id).datagrid({
		toolbar:'#'+this.buttons,
		title:this.title,
		iconCls:'icon-edit',
		width:660,	height:250,
		singleSelect:true,
		idField:'item_number',
		url:this.url,
		columns:[this.columns],
		onEndEdit:function(index,row){
		},
		onBeforeEdit:function(index,row){
			row.editing = true;
			$(this).datagrid('refreshRow', index);
		},
		onAfterEdit:function(index,row){
			row.editing = false;
			$(this).datagrid('refreshRow', index);
		},
		onCancelEdit:function(index,row){
			row.editing = false;
			$(this).datagrid('refreshRow', index);
		}
	});
	};
	this.getRowIndex=function(target){
		var tr = $(target).closest('tr.datagrid-row');
		return parseInt(tr.attr('datagrid-row-index'));
	}
	
	this.editrow=function(target){
		$('#'+this.table_id).datagrid('beginEdit', this.getRowIndex(target));
	}
	this.deleterow=function(target){
		$.messager.confirm('Confirm','Are you sure?',function(r){
			if (r){
				$('#'+this.table_id).datagrid('deleteRow', this.getRowIndex(target));
			}
		});
	}
	this.saverow=function(target){
		$('#'+this.table_id).datagrid('endEdit', this.getRowIndex(target));
	}
	this.cancelrow=function(target){
		$('#'+this.table_id).datagrid('cancelEdit', this.getRowIndex(target));
	}
	this.insert=function(){
		var row = $('#'+this.table_id).datagrid('getSelected');
		if (row){
			var index = $('#'+this.table_id).datagrid('getRowIndex', row);
			index++;
		} else {
			index = 0;
		}
		$('#'+this.table_id).datagrid('insertRow', {
			index: index,
			row:{
				status:'P'
			}
		});
		$('#'+this.table_id).datagrid('selectRow',index);
		$('#'+this.table_id).datagrid('beginEdit',index);
	}
} 
function show_syslog(module,nomor){
	$('#dlgSysLog').dialog('open').dialog('setTitle','Log System');
	get_this(CI_BASE+"index.php/syslog/view/"+module+"/"+nomor,"","divSysLog");
	
}
	
 function load_menu(path){
	 xurl=CI_BASE+'index.php/menu/load/'+path;
	 if(path=="courier"){
		add_tab_parent(path,xurl); 	
	 } else {
		 window.open(xurl,'_self');
	 	
	 }
	 return false;
 }
//Finds y value of given object
function findPos(obj) {
    var curtop = 0;
    if (obj.offsetParent) {
        do {
            curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
    return [curtop];
    }
}
$(document).ready(function(){
	$("#user_log").click(function(){
		add_tab_parent("Alert",CI_BASE+"index.php/maxon_inbox/list_msg");
	})
});
	
