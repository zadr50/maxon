<script type="text/javascript">
	CI_ROOT = "<?=base_url()?>index.php/";
	CI_BASE = "<?=base_url()?>"; 		
    CI_CONTROL='<?=$controller?>';
    FIELD_KEY='<?=$field_key?>';
    CI_CAPTION='<?=$caption?>';
</script>

<?php
date_default_timezone_set("Asia/Jakarta");
echo $library_src;
echo $script_head;
$controller_name=str_replace("/","_",$controller);
?>
<div class="col-md-12">
	<h2>MaxOn Market</h2> 
	<p>	You can download free application or paid application from publisher. 
		<?=anchor("market/apps","Download")?>
	</p>
</div>
<div id='divLoading'><img src="<?=base_url("images/loading_little.gif")?>"></div>
<div id='isi' class='col-lg-12 '></div>

<script type="text/javascript">
function view_url(){
	var url="<?=base_url()?>index.php/market/apps";
	add_tab_parent("market",url);
}

$(document).ready(function(){
	var xurl=CI_ROOT+CI_CONTROL+'/browse_data';                             
	var xparam='';
	$.ajax({ type: "GET", url: xurl, param: xparam,
		success: function(result){
		try {
				var result = eval('('+result+')');
				console.log(result);
				if(result.rows.length){
					var html='';
					for(i=0;i<result.rows.length;i++){
						app=result.rows[i];
						html=html+'<div class="col-md-6 col-sm-6	"> ';
						html=html+'<div class="panel panel-info info2 ">';
						html=html+"<div class='panel-heading '><div class='glyphicon glyphicon-list'>";
						html=html+"<strong> "+app.app_name+"</strong> &nbsp [AppId: <i>"+app.app_id+"</i>]";
						html=html+"</div>";
						html=html+"<div class='top-legend'>By: "+app.app_create_by+"</div>";
						html=html+"</div>";
						html=html+"<div class='panel-body'>";
						html=html+"<div class='photo'><img src='"+CI_BASE+"images/"+app.app_ico+"'></div>";
						html=html+"<div class='detail'>";
						html=html+app.app_desc;	
						html=html+"</div>";
						if(app.is_active=="1"){
							html=html+"<a href='#' onclick='uninstall(\""+app.app_id+"\",\""+app.is_core+"\");return false;' class='btn btn-warning'>UnInstall</a>";
						} else {
							html=html+"<a href='#' onclick='install(\""+app.app_id+"\");return false;' class='btn btn-info'>Install</a>";
						}
						html=html+"</div>";
						html=html+"</div>";
						html=html+"</div>"
					}
					$('#isi').html(html);
					$("#divLoading").hide();	 
				} else {
					$.messager.show({
						title:'Error',msg:result.msg
					});
				};
			} catch (exception) {		
				alert("Some Errors !");
			}
		},
		error: function(msg){
			$.messager.alert('Info',"Some Errors !");
		}
	});        
});
function uninstall(id,is_core){
	if(is_core=="1"){alert("This application cannot uninstalled !");return false;}
	$.messager.confirm('Confirm','Are you sure ?',function(r){
		var xurl=CI_ROOT+"apps/uninstall/"+id;
		var xparam="";
		$.ajax({ type: "GET", url: xurl, param: xparam,
		success: function(result){
			try {
					var result = eval('('+result+')');
					console.log(result);
					if(result.success){
//						alert("Sukses, application has been uninstalled.");
						window.parent.location.reload(); 
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});
					};
				} catch (exception) {		
					alert("Some Errors !");
				}
			},
		error: function(msg){
			$.messager.alert('Info',"Some Errors !");
			}
		});
	})
}
function install(id){
	$.messager.confirm('Confirm','Are you sure ?',function(r){
		var xurl=CI_ROOT+"apps/install/"+id;
		var xparam="";
		$.ajax({ type: "GET", url: xurl, param: xparam,
		success: function(result){
		try {
				var result = eval('('+result+')');
				console.log(result);
				if(result.success){
//						alert("Sukses, application installed.");
						window.parent.location.reload(); 
				} else {
					$.messager.show({
						title:'Error',msg:result.msg
					});
				};
			} catch (exception) {		
				alert("Some Errors !");
			}
		},
		error: function(msg){
			$.messager.alert('Info',"Some Errors !");
		}
		});
	})
}

</script>