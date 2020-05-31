<div class='thumbnail'  style='margin-top:30px'>
<?=load_view("eshop/customers/member_form",array("mode"=>"edit"));?>
<p><a href="#" onclick='frmMain_Save();return false;' class='btn btn-primary'>Submit</a></p>

</div>
<script language='javascript'>
function frmMain_Save(){
  		if($('#customer_number').val()==''){alert('Isi username !');return false;}
  		if($('#company').val()==''){alert('Isi nama anda !');return false;}
		var cust_id=$('#customer_number').val();
		url='<?=base_url()?>index.php/eshop/member/save';
		next_url="<?=base_url()?>index.php/eshop/setting";
		$('#frmMain').ajax_post(url,'',next_url);			
}
</script>