<?php 
echo my_button(" AutoNumber","dlgAutoNumberShow();return false","save","");
?>
<!-- DIALOG FOR AUTONUMBER -->
<div id='dlgAutoNumber' class="easyui-dialog"  background='black'
style="width:600px;height:600px;padding:5px 5px;left:100px;top:20px"
closed="true"
>
	<?php 
	echo my_input("AutoNumber");
	
	?>
	
	 
		<a href="#" class="easyui-linkbutton" iconCls="icon-save"   
			onclick="dlgAutoNumber_Save();return false;">Save</a>
		
	
</div>

<script type="text/javascript">
	var idd='';
	function dlgAutoNumberShow(){
		$('#dlgAutoNumber').dialog("open").dialog("setTitle","Enter Setting");
	}
	function dlgAutoNumber_Save() {
	}
</script>
<!-- END DIALOG -->