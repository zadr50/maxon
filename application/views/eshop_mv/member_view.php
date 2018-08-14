<div class='thumbnail'  style='margin-top:30px'>
<?=load_view("eshop/member_form");?>
</div>
<script language='javascript'>
function frmMain_Save(){
  		if($('#customer_number').val()==''){alert('Isi username !');return false;}
  		if($('#company').val()==''){alert('Isi nama anda !');return false;}
		var cust_id=$('#customer_number').val();
		url='<?=base_url()?>index.php/eshop/member/save/view';
			$('#frmMain').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						alert("Terimakasih data keanggotaan sudah tersimpan, silahkan login.");
					} else {
						alert(result.message);
					}
				}
			});
	
}
</script>