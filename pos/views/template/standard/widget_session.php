<div id='dlgSession'class="easyui-dialog" style="width:600px;height:380px;left:100px;top:20px;padding:10px 20px"
     closed="true"  >
     <div id=''> 
		<?php 
		$sess=$this->session->userdata();
		$i=0;
		echo "<table><tr><th>Name</th><th>Value</th></tr>";
		foreach ($sess as $key => $value) {
			echo "<tr><td>".$key."</td><td>";
			if(!is_object($value)){
				var_dump($value);
			}
			echo "</td></tr>";
		}		
		echo "</table>";
		?>
    </div>   
</div>
 
<?php 


?>

<script language="javascript">
function dlgSession_Show(){
	$('#dlgSession').dialog('open').dialog('setTitle','User Session Information');
}
function dlgSession_Close(){
	$('#dlgSession').dialog('close');
}
</script>