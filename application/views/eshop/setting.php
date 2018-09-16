<?php
if(!isset($active_tab))$active_tab=1;
?>
 
		<img src="<?=base_url()?>images/ico_setting.png" 
		style="float:left"><h1 class='glyphicon glyphicon-ok'> <?=$caption?></h1>
		<p>Dihalaman ini anda dipersilahkan untuk merubah data 
		keanggotan di sistim kami berikut ini</p>
		<p>Klik tab tagihan untuk melihat informasi tagihan 
		yang baru atau lama dan status tagihan</p>
		<ul class="nav nav-tabs" style='background-color:white'>
		  <li role="presentation" 
				class=" <?=$active_tab==1?"active":""?>">
				<a href='<?=base_url()?>index.php/eshop/setting/view/member_view/1'>
				<span class='glyphicon glyphicon-user' ></span> UMUM</a></li>
		  <li role="presentation"class="<?=$active_tab==2?"active":""?>">
				<a href='<?=base_url()?>index.php/eshop/setting/view/member_trans/2'>
				<span class='glyphicon glyphicon-euro'></span> TAGIHAN</a></li>
		</ul>
		<?php echo load_view("eshop/$file") ?>
 
<script language='javascript'>

var cart=null;
$(document).ready(function() {
    $("#tblCart .deleteLink").on("click",function() {
        var tr = $(this).closest('tr');
        tr.css("background-color","#FF3700");
        tr.fadeOut(400, function(){
            tr.remove();
        });
		var idx=$(this).attr("value");
		var xurl="<?=base_url()?>index.php/eshop/item/del_cart/"+idx;
 		$.ajax({
			type: "GET", url: xurl,
			success: function(msg){
				console.log(msg);
			},
			error: function(msg){console.log(msg);}
		}); 
		
        return false;
    });
});

function edit_row(idx){
	alert(idx);
}
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">
