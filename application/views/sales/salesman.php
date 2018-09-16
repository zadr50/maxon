<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Target', 'frmTarget_show()','search');		
	///	echo link_button('Print', 'print()','print');		
//	echo link_button('Add','','add','false',base_url().'index.php/salesman/add');		
//	echo link_button('Search','','search','false',base_url().'index.php/salesman');		
	echo tool_option("salesman");
	?>
</div>
<?php 
	$readonly="";
	if($mode=="view")$readonly=" readonly";

?>
<div class="thumbnail">	
<form id="myform"  method="post" action="<?=base_url()?>index.php/salesman/save">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>

<?php echo validation_errors(); ?>
   <table class='table' width='100%'>
	<tr>
		<td>Salesman</td><td>
		<?php
			echo form_input('salesman',$salesman,"id=salesman $readonly");
		?></td>
	</tr>	 
       <tr>
            <td>Kelompok</td><td><?php echo form_input('salestype',$salestype,"id='salestype'");
            	echo link_button("",'dlgsalestype_show()','search');
            	echo link_button("",'dlgsalestype_add();return false;','add');
            	?>
			</td>
       </tr>
       <tr>
            <td>Komisi Rate 1 (%)</td><td><?php echo form_input('commission_rate_1',$commission_rate_1);?></td>
       </tr>
       <tr>
            <td>Komisi Rate 2 (%)</td><td><?php echo form_input('commission_rate_2',$commission_rate_2);?></td>
       </tr>
       <tr>
            <td>User Login</td>
            <td><?php echo form_input('user_id',$user_id,"id='user_id'");
            	echo link_button("","dlguser_id_show()","search");
            	?>
	            </br><i>User id yang terkait dengan salesman ini</i>
			</td>
       </tr>
      <tr>
            <td>Wilayah</td><td><?php echo form_input('wilayah',$wilayah,"id='wilayah'");
            	echo link_button("",'dlgwilayah_show()','search');
            	echo link_button("",'dlgwilayah_add();return false;','add');
            	?>
			</td>
       </tr>
	   <tr>
			<td>Tampilkan</td>
			<td><?=form_radio('lock_report',1,$lock_report=='1'?TRUE:FALSE,"style='width:20px' ");?>&nbsp Yes 
		  	<?php echo form_radio('lock_report',0,$lock_report=='0'?TRUE:FALSE,"style='width:20px' ");?>&nbsp No
			</br><i>Tampilkan data penjualan hanya untuk salesman ini</i>
			</td>
		</tr>			
			
   </table>
</form>
<?php 
echo $lookup_salesman_type;
echo $lookup_user;
echo $lookup_wilayah;
?>    
  
</div>   
<script type="text/javascript">
    function save_this(){
        if($('#salesman').val()===''){alert('Isi dulu kode salesman !');return false;};
        $('#myform').submit();
    }
    function dlgsalestype_add(){
    	var url=CI_ROOT+"salesman/kelompok/browse";
    	add_tab_parent("SalesType",url);
    }
    function dlgwilayah_add(){
    	var url=CI_ROOT+"company/wilayah";
    	add_tab_parent("Wilayah",url);
    }
    function frmTarget_show(){
    	var salesman=$("#salesman").val();
    	var url=CI_ROOT+"salesman/target/"+salesman;
    	add_tab_parent("SalesTarget",url);
    }
</script>  

 
 