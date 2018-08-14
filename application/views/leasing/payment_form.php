<div id='dlgPayment'class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px" closed="true" 
	buttons="#tbPayment">
	<? echo form_open('',array("action"=>"","name"=>"frmPayment","id"=>"frmPayment"));
		echo "<table class='table2' width='100%'>";
		echo "<tr><td>Tanggal</td><td>".form_input("date_paid")."</td></tr>";
		echo "<tr><td>Jenis Bayar</td><td>".form_input("how_paid")."</td></tr>";
		echo "<tr><td>Denda</td><td>".form_input("denda_paid")."</td></tr>";
		echo "<tr><td>Pokok</td><td>".form_input("pokok_paid")."</td></tr>";
		echo "<tr><td>Bunga</td><td>".form_input("bunga_paid")."</td></tr>";
		echo "<tr><td>Total Paid</td><td>".form_input("amount_paid")."</td></tr>";
		echo "<tr><td><input type='hidden' name='frmPayment_id' id='frmPayment_id'></td></tr>";
		echo "</table>";
		echo form_close();		
	?>
</div>	   


<div id='tbPayment'>
	<?=link_button('Save', 'dlgPayment_Save()','ok');?>
	<?=link_button('Close', 'dlgPayment_Close()','no');?>
</div>

<script language="JavaScript">
	function dlgPayment_Edit(id) {
		$('#frmPayment_id').val(id);
		var xurl='<?=base_url()?>index.php/leasing/payment/load_by_id/'+id;
		$.ajax({type: "GET", url: xurl,
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$("#frmPayment input[name='amount_paid']").val(result.amount_paid)
					$("#frmPayment input[name='date_paid']").val(result.date_paid)
					$("#frmPayment input[name='how_paid']").val(result.how_paid)
					$("#frmPayment input[name='denda_paid']").val(result.denda)
					$("#frmPayment input[name='pokok_paid']").val(result.pokok)
					$("#frmPayment input[name='bunga_paid']").val(result.bunga)
				}				
			},
			error: function(msg){alert(msg);return false;}
		}); 
		
		$('#dlgPayment').dialog("open").dialog("setTitle","Edit data pembayaran");
	}
	function dlgPayment_Valid(){
		var amount_paid=$("#frmPayment input[name='amount_paid']").val();
		if(amount_paid==0 || amount_paid==''){
			alert('Isi jumlah bayar.');
			return false;
		}
		return true;
	}

	function dlgPayment_Close(){
		$('#dlgPayment').dialog('close');
	}
	function dlgPayment_Save(){
		if(!dlgPayment_Valid())return false;
		url='<?=base_url()?>index.php/leasing/payment/update';
		$('#frmPayment').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(msg){
				var result = eval('('+msg+')');
				if (result.success){
					dlgPayment_Close();
					log_msg('Data sudah tersimpan. Silahkan di refresh.');
					location.reload();
				} else {
					log_err("Error!");
				}
			}
		});
	}

	
</script>
	