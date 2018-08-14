<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/salesman/add');		
	echo link_button('Search','','search','false',base_url().'index.php/salesman');		
	echo link_button('Help', 'load_help(\'salesman\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('salesman')">Help</div>
		<div onclick="show_syslog('salesman','<?=$salesman?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
</div>
<div class="thumbnail">	
<form id="myform"  method="post" action="<?=base_url()?>index.php/salesman/save">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php echo validation_errors(); ?>
   <table class='table' width='100%'>
	<tr>
		<td>Salesman</td><td>
		<?php
		if($mode=='view'){
			echo "<strong>$salesman</strong>";
			echo form_hidden('salesman',$salesman,"id=salesman");
		} else { 
			echo form_input('salesman',$salesman,"id=salesman");
		}		
		?></td>
	</tr>	 
       <tr>
            <td>Kelompok</td><td><?php echo form_input('salestype',$salestype,"id='salestype'");?>
				 <a href='#' onclick='dlgsalestype_show();return false'
					class='btn btn-default glyphicon glyphicon-search'
					title='Cari kelompok salesman'>
				 </a>
				 <a href='<?=base_url()?>index.php/salesman/kelompok/add#add_kelompok' 
				 class='btn btn-default glyphicon glyphicon-plus info_link' 
				 title='Tambah kelompok salesman'></a>			
			</td>
       </tr>
       <tr>
            <td>Komisi Rate 1 (%)</td><td><?php echo form_input('commission_rate_1',$commission_rate_1);?></td>
       </tr>
       <tr>
            <td>Komisi Rate 2 (%)</td><td><?php echo form_input('commission_rate_2',$commission_rate_2);?></td>
       </tr>
       <tr>
            <td>User Login yang terkait dengan salesman ini</td><td><?php echo form_input('user_id',$user_id,"id='user_id'");?>
				 <a href='#' onclick='dlguser_id_show();return false'
					class='btn btn-default glyphicon glyphicon-search'
					title='Cari user login id'>
				 </a>			
			</td>
       </tr>
	   <tr>
			<td>Tampilkan data penjualan hanya untuk salesman ini</td>
			<td><?=form_radio('lock_report',1,$lock_report=='1'?TRUE:FALSE);?>&nbsp Yes 
		  	<?php echo form_radio('lock_report',0,$lock_report=='0'?TRUE:FALSE);?>&nbsp No
			
			</td>
		</tr>			
			
   </table>
</form>
<?php 
echo $lookup_salesman_type;
echo $lookup_user;

?>    
  
</div>   
<script type="text/javascript">
    function save_this(){
        if($('#salesman').val()===''){alert('Isi dulu kode salesman !');return false;};
        $('#myform').submit();
    }
</script>  

 
 