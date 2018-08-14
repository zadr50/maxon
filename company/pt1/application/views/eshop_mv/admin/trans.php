<div class="row-fluid" >
	<div class="col-sm-3">
		<div class="panel panel-default">
		  <div class="panel-body">
			<h4><?$caption?></h4>
			<ul class="list-group">
			  <li class="list-group-item"><a href='<?=base_url()?>index.php/eshop/member/view/<?=$customer_number?>'>Member Info</a></li>
			  <li class="list-group-item"><a href='<?=base_url()?>index.php/eshop/member/order/<?=$customer_number?>'>New Order Status</a></li>
			  <li class="list-group-item"><a href='<?=base_url()?>index.php/eshop/member/trans/<?=$customer_number?>'>Sales History</a></li>
			</ul>
		  </div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class='row-fluid'>
			<ol class="breadcrumb box-bcum">
			  <li><a  class='glyphicon glyphicon-home'
			  href="<?=base_url()?>index.php/eshop/home"> Home</a></li>
			  <li class="active">Member Info</li>
			</ol>
		</div>
		<h1><?=$caption?></h1>
		<?=load_view("eshop/member_form");?>		
	</div>
</div>
<script language='javascript'>
function frmMain_Save(){
  		if($('#customer_number').val()==''){alert('Isi username !');return false;}
  		if($('#company').val()==''){alert('Isi nama anda !');return false;}
		var cust_id=$('#customer_number').val();
		url='<?=base_url()?>index.php/eshop/member/save';
		$('#frmMain').ajax_post(url,{
			success: function(){
				alert("Terimakasih data keanggotaan sudah tersimpan, silahkan login.");
				window.open("<?=base_url()?>index.php/eshop/login","_self");
			}
		});
	
}
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
