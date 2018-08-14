<style>
@media all and (max-width: 720px) {
    .xchat-min {display:none;}
    .xchat {display:none;}
}
.xchat {
	position: fixed;
	left: 1px;
	bottom: 2px;
	height: 300px;
	width: 200px;
	padding: 10px;
	background: #EFF5F7;
	border: 1px solid rgb(143, 143, 235);
	font-size: 10px;
	-border-radius: 4px;
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
	-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}
.xchat .xchat-title {
	background: #46b8da;
	color: white;
	font-size: 15px;
	padding: 5px;
	 
	margin-left: -11px;
	margin-top: -15px;
	margin-bottom: 10px;
	width: 200px;
}

.xchat .xchat-content {
	color: black;
}
.xchat-button {
	float:right;
	cursor:pointer;
}
.xchat .xchat-button:hover {
	color: black;
	display:both;
}
.xchat .xchat-content-user {
	margin-top:5px;
	border-top:1px solid rgb(143,143,235);
	padding:3px;
	display:both;
}
.xchat .xchat-icon {
	display: none;
}
.xchat-content-chat {
	height:220px;
	width:180px;
	overflow:scroll;
}
.xchat-loading {
	background-image:url('<?=base_url()?>images/loading.gif');
	background-repeat: no-repeat;
}

.xchat-min {
	position: fixed;
	--right: 10px;
	bottom: -1px;
	height: 70px;
	width: 70px;
	--background-image: url("<?=base_url()?>images/chatbox.png");
	--background-repeat: no-repeat;
}
.xchat-min .xchat-content-chat {
	display: none;
}	
.xchat-min .xchat-content-user {
	display: none;
}	
.xchat-min .xchat-title {
	display: none;
}	

</style>
<div class="xchat-min xchat-button" id="xchat" title='Ngobrol antar pengguna'>
	<div class='xchat-icon'><img src='<?=base_url()?>images/chatbox.png'></div>
	<div class="xchat-title glyphicon glyphicon-user"> Ngobrol</div>
	<div class="xchat-content">
		<div class="xchat-content-chat" id="xchat-content-chat">
			<p>
				Silahkan ngobrol dong disini yang lagi online ...
			</p>
		</div>
		<div class="xchat-content-user">
			<input  type="text" id="xchat-user" style="margin-left:-5px;width:50px;float:left;margin-right:3px;" value="Guest" placeholder="Guest">
			<input type="text" id="xchat-message" style="width:120px" placeholder="Enter your message">
		</div>
	</div>
</div>

<script>
	var xchat_state=1;
	var t=0;
	
	function load_chat_msg() {
		$('#xchat-content-chat').addClass("xchat-loading");		 
		if(xchat_state==1){
			 clearTimeout(t);
			 return false;
		}
		t=setTimeout(function(){load_chat_msg()}, 18000);
		$.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/maxon_chat/load',
				contentType: 'application/json; charset=utf-8',
                success: function(msg){
					var result = $.parseJSON(msg);
					if(result.userid!=$("#xchat-user").val()) $("#xchat-user").val(result.userid);
					msg=replaceAll('{b}','<b>',result.msg);
					msg=replaceAll('{eb}','</b>',msg);
					$("#xchat-content-chat").html(msg);
					$('#xchat-content-chat').removeClass("xchat-loading");
                }
		});
	}
	function replaceAll(find, replace, str) {
		return str.replace(new RegExp(find, 'g'), replace);
	}
	$().ready(function(){
		$('.xchat-icon').click(function(e){
			e.preventDefault();
			xchat_state=0;
			$('#xchat').removeClass("xchat-min").addClass("xchat");
			load_chat_msg();
		});
		$('.xchat-title').click(function(e){
			e.preventDefault();
			xchat_state=1;
			$('#xchat').removeClass("xchat").addClass("xchat-min");
			clearTimeout(t);
		});
		$('#xchat-message').bind('keypress', function(e) {
			var code = e.keyCode || e.which;
			var msg=$("#xchat-message").val();
			var usr=$("#xchat-user").val().substr(0,10);
			 if(code == 13) {  
				$('#xchat-content-chat').addClass("xchat-loading");
				$.ajax({
						type: "GET",
						url: '<?=base_url();?>index.php/maxon_chat/save',
						data:{u:usr,m:msg}, 
						contentType: 'application/json; charset=utf-8',
						success: function(ret){
							$("#xchat-message").val("");
						}
				});
			 }		
		});		
		
		
	});
</script>