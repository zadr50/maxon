<div><h1>TERMIN PEMBAYARAN<div class="thumbnail">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/type_of_payment/add');		
	echo link_button('Search','','search','true',base_url().'index.php/type_of_payment');		
	
	?>
</div></H1>
<div class="thumbnail">	
<form id="myform"  method="post" action="<?=base_url()?>index.php/type_of_payment/save">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php echo validation_errors(); ?>
     <table >
	<tr>
		<td>Termin Pembayaran</td>
		<td>
		<?php
		if($mode=='view'){
			echo "<strong>".$type_of_payment."</strong>";
			echo form_hidden('type_of_payment',$type_of_payment);
		} else { 
			echo form_input('type_of_payment',$type_of_payment);
		}		
		?></td>
       </tr>	 
       <tr>
         <td>Discount Percents</td>
         <td><?php echo form_input('discount_percent',$discount_percent);?></td>
       </tr>
       <tr>
         <td>Discount Day</td>
 
         <td><?php echo form_input('discount_days',$discount_days);?></td>
       </tr>
	   <tr>
 
         <td>Day</td>
         <td><?php echo form_input('days',$days);?></td>
	   </tr>

   </table>
   </form>
    
</div>   
<script type="text/javascript">
    function save_this(){
        if($('#bank_account_number').val()===''){alert('Isi dulu kode bank !');return false;};
        if($('#bank_name').val()===''){alert('Isi dulu nama bank !');return false;};
        $('#myform').submit();
    }
</script>  

 
 