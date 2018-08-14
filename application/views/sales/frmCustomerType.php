<div id='frmCustomerType' class="easyui-dialog"   style=";left:100px;top:20px"
	closed="true" buttons="#frmCustomerType_Button">
	<form id='frmCustomerTypeForm' method='post'><table class='table2' width='100%'>
		<tr><td>Location Code</td><td><input type='text' name='location_code' id='location_code'></td></tr>
		<tr><td>Alamat</td><td><input type='text' name='alamat' style="width:300px"></td></tr>
		<tr><td>Kota</td><td><input type='text' name='kota'></td></tr>
		<tr><td>Kode Pos</td><td><input type='text' name='kode_pos'></td></tr>
		<tr><td>Telp</td><td><input type='text' name='telp'></td></tr>
		<tr><td>Fax</td><td><input type='text' name='fax'></td></tr>
		<tr><td>Kontak</td><td><input type='text' name='contact'></td></tr>
	</form></table>
</div>
<div id="frmCustomerType_Button" class='box-gradientx'>
	<?=link_button('Save','frmCustomerType_save()','save')?>
	<?=link_button('Close','frmCustomerType_close()','back')?>
</div>   
<script>
	function frmCustomerType_add(){
		$('#frmCustomerType').dialog('open').dialog('setTitle','Tambah');
	}
	function frmCustomerType_close(){
		$('#frmCustomerType').dialog('close');
	}
	function frmCustomerType_save(){
  		if($('#customer_number').val()==''){alert('Isi kode pelanggan !');return false;}
  		url='<?=base_url()?>index.php/customer/shipto_add/<?=$customer_number?>';
  		$("#frmCustomerTypeForm").form('submit',{
  			url:url,
  			onSubmit:function(){return $(this).form('validate');},
  			success:function(result){
  				var result=eval('('+result+')');
		  		if(result.success){
		  			add_shipto_close();
		  			$('#dgShipTo').datagrid('reload'); 
		  		} else {$.messager.show({title:'Error',msg:result.msg});}
	  		}
  		});	
	}
	
</script>