<div class="thumbnail  box-gradient">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/type_of_payment/add');		
	echo link_button('Search','','search','false',base_url().'index.php/type_of_payment');		
	echo link_button('Close', 'remove_tab_parent();return false;','cancel');		
	
	?>
</div>
<div class="thumbnail">	
<form id="myform"  method="post" action="<?=base_url()?>index.php/type_of_payment/save">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php echo validation_errors(); ?>
     <table class="table">
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
        if($('#type_of_payment').val()===''){alert('Isi dulu kode termin !');return false;};
			$('#myform').form('submit',{
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						log_msg('Data sudah tersimpan. ');
						remove_tab_parent();
					} else {
						log_err(result.msg);
					}
				}
			});
        
        
    }
</script>  

 
 