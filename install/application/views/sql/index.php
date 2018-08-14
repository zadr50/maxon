<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MaxOn Installation Wizard</title>
    <link rel="stylesheet" type="text/css" href="installer.css" />
</head>
<body>
<script type="text/javascript" charset="utf-8" src="../js/jquery/jquery-1.8.0.min.js"></script>	
<script type="text/javascript" charset="utf-8" src="../js/jquery-ui/jquery.easyui.min.js"></script>	

<style>
.msg {
	background-color: rgb(209, 209, 201);
	padding: 10px;
	font-family: monospace;
}
.btn_next{
	width:20px;
	height:20px;
	background-color:blue;
	pointer:cursor;
}
</style>
<div id="CanvasDiv">
	<h1>SELAMAT DATANG</h1>
	<H2>PROSES INSTALASI MAXON ERP</H2>
	<P>Silahkan input seting database dan server MySQL dibawah ini:</P>
	<div id='content'>
	<form id="database" action=""  method="POST" >
		<ul><li>
			<fieldset>
				<label for="server">Nama Server atau alamat IP MySQL Server.</label>
					<input type="text" name="server" value="localhost">	
			</fieldset>
			</li>
			<li>
			<fieldset>
				<label for="database">Nama Database untuk MaxOn, gunakan awalan max_ bila perlu.
				</label>
					<input type="text" name="database" value="maxon">	
			</li>
			<li>
			<fieldset>
				<label for="user_id">
					UserID untuk login ke database MySQL.
				</label>
					<input type="text" name="user_id" value="root">
			</fieldset>
			</li>
			<li>
			<fieldset>
				<label for="user_pass">
					Password untuk login ke database MySQL.
				</label>
					<input type="text" name="user_pass" value="">
			</fieldset>
			</li>
			<li>
			<fieldset>
				<button id="cmdSubmit" >Submit</button>	
			</fieldset>
			</li>

		</ul>		
	</form>
	</div>

</div>
</body>

<script>
	var c=0;
	var t;
	var url="create_db_process.php";
	$("#cmdSubmit").click(function(e){
		e.preventDefault();
		$("#database").fadeOut();
		create_db();
	});
	function create_db() {
		var retval=false;
			$('#database').form('submit',{
				url: url,
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						add_log(result.msg);
						run_sql();
						retval= true;
					} else {
						add_log(result.msg);
						retval=false;
					}
				}
			});		
		return retval;
	}
	function run_sql() {
		c=c+1;
		$.ajax({
                type: "GET",
                url: url,
				contentType: 'application/json; charset=utf-8',
                data:{nomor:c}, 
                success: function(msg){
					add_log(msg);
                    //var obj=jQuery.parseJSON(msg);
					//add_log(obj.table);
                },
                error: function(msg){add_log(msg);}
		});		
		t=setTimeout(function(){sql_exec()}, 500);
	}
	function add_log(msg){
		if(msg!=""){
			$( "#content" ).append( "<div class='msg'>"+msg+"</div>" );
		}
	}
	function sql_exec(){
		run_sql();
		if(c>=43){
			clearTimeout(t);
			timer_is_on = 0;	
			add_log("<h1>Finish.</h1> Silahkan kilik link berikut untuk masuk ke program, gunakan login: admin dan pass: admin <a href='../index.php'><h1>Login</h1></a>");
		}
	}
	
</script>
