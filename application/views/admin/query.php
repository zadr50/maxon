<div class='containerx'>
	<div class="col-md-12 thumbnail box-gradient">
		<?=link_button("Execute", "execute_sql();return false;","save")?>
		<?=link_button(" Close ", "remove_tab_parent()","cancel")?>
	</div>
	<div class="col-md-12">
		<p><b>Enter SQL Syntax</b></p>
		<textarea name='sql' id='sql' style="height:200px;width:99%"></textarea>
	</div>
	<div class="col-md-12">
		<div id='sql_result' class='thumbnail' style="width:99%	;margin-top:10px">
			
		</div>
	</div>
</div>
<script language="JavaScript">
	function execute_sql(){
		var _sql=$("#sql").val();
		if(_sql==""){
			log_err("Enter SQL Syntax !");return false;
		}
		var _param={sql:_sql};
		$.ajax({
			method:"POST",data: _param,
			url: CI_ROOT+"admin/query/execute",
			error: function(result){
				$("#sql_result").html(result);				
			},
			success: function(result){
				$("#sql_result").html(result);
			}
		});
	}
</script>