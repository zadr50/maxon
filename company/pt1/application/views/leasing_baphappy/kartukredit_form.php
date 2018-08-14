<div id='dlgAddCrCard'class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px" closed="true" 
	buttons="#tbAddCrCard">	 
	<?
		echo form_open('',array("action"=>"","name"=>"frmAddCrCard","id"=>"frmAddCrCard"));
		echo my_input("Nomor",'card_no','','col-sm-5');
		echo my_input("Bank",'card_bank','','col-sm-5');
		echo my_input("Expire",'card_expire','','col-sm-5');
		echo my_input("Jenis",'card_type','','col-sm-5');
		echo my_input("Limit",'card_limit','','col-sm-5');
		echo "<input type='hidden' name='frmAddCrCard_id' id='frmAddCrCard_id'>";
		echo form_hidden("frmAddCrCard_cust_id",$cust_id);
		echo form_close();
	?>
</div>	   
<div id='tbAddCrCard'>
	<?=link_button('Save', 'dlgAddCrCard_Save()','ok');?>
	<?=link_button('Close', 'dlgAddCrCard_Close()','no');?>
</div>

<script language="JavaScript">
	function dlgAddCrCard_Close(){
		$('#dlgAddCrCard').dialog('close');
	}
	function dlgAddCrCard_Save(){
		var cust_id=$("#cust_id").val();
		if(cust_id==""){alert("Isi kode pelanggan ");return false};
		url='<?=base_url()?>index.php/leasing/cust_master/kartukredit/save';
		$('#frmAddCrCard').form('submit',{
			url: url, param: "cust_id="+cust_id, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					dgCards_Refresh();
					log_msg('Data sudah tersimpan.');
					$('#dlgAddCrCard').dialog('close');
					$("#frmAddCrCard").resetForm();
				} else {
					log_err(result.msg);
				}
			}
		});	
	}
</script>
