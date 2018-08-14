<div><h1>JENIS PENDAPATAN<div class="thumbnail">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/jenis_tunjangan/add');		
	echo link_button('Search','','search','true',base_url().'index.php/jenis_tunjangan');		
	
	?>
</div></H1>
<div class="thumbnail">	
<form id="myform"  method="post" action="<?=base_url()?>index.php/jenis_tunjangan/save">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php echo validation_errors(); ?>
   <table>
	<tr>
		<td>Kode</td><td>
		<?php
		if($mode=='view'){
			echo "<strong>$kode</strong>";
			echo form_hidden('kode',$kode);
		} else { 
			echo form_input('kode',$kode);
		}		
		?></td>
	</tr>	 
       <tr><td>Nama Pendapatan</td><td><?=form_input('keterangan',$keterangan,"style='width:300px'");?></td></tr>
       <tr><td>Kode ini diset sebagai variabel dalam rumus</td><td><?=form_checkbox('is_variable',$is_variable);?></td></tr>
       <tr><td>Kode ini diset sebagai data absensi</td><td><?=form_input('is_absen',$is_absen);?></td></tr>
       <tr><td>Sifat dalam hitungan PPH21 (Di Setahunkan, Tidak di Setahunkan, None)</td><td><?=form_input('sifat',$sifat);?></td></tr>
       <tr><td>Berkait ke field dalam PPH21</td><td><?=form_input('ref_column',$ref_column);?></td></tr>
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

 
 