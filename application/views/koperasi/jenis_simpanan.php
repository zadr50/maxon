<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save_this()','save');		

	echo link_button('Help', 'load_help()','help');		
	
	?>
	<div style='float:right'>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Close', 'remove_tab_parent()','cancel');?>
	</div>		
	
</div>

<?php echo validation_errors(); ?>

	<form id="frm"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table style="width:90%">
			<tr><td>Nama Simpanan</td>
				<td>
					<?php
					$readonly="";
					if($mode=='view') $readonly="readonly";
					echo form_input('nama',$nama,"id=nama $readonly");
					?>
				</td>
			</tr>	 
			<tr>
				<td>Jenis</td><td><? echo form_dropdown('jenis',array("Pokok","Sukarela","Wajib","Berjangka"),$jenis,"id=jenis"); ?></td>
			</tr>
		   <tr>
				<td>Berjangka (Bulan)</td><td><?=form_input('jangka_waktu',$jangka_waktu);?></td>
		   </tr>
			<tr>
				<td>Suku Bunga %</td><td><?=form_input('bunga_prc',$bunga_prc);?></td>
			</tr>
			<tr>
				<td>Keterangan</td><td><?=form_input('keterangan',$keterangan,"style='width:300px'");?></td>
			</tr>
	</table>	   
	<h4>Link Akun Perkiraan untuk anggota dan non anggota </h4>
	<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="Anggota" style="padding:10px">
		<table>
		   <tr>
				<td>Kas</td><td> 
					<?=form_input('coa_ag_kas',$coa_ag_kas,"id='coa_ag_kas' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_kas')",'search')?>	
				</td>		   
		   </tr>
		   <tr>
				<td>Simpanan</td><td><?=form_input('coa_ag_simpanan',$coa_ag_simpanan,"id='coa_ag_simpanan' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_simpanan')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Administrasi</td><td><?=form_input('coa_ag_admin',$coa_ag_admin,"id='coa_ag_admin' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_admin')",'search')?></td>
		   </tr>
		   <tr>
				<td>Beban Bunga</td><td><?=form_input('coa_ag_beban_bunga',$coa_ag_beban_bunga,"id='coa_ag_beban_bunga' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_beban_bunga')",'search')?></td>
		   </tr>
	   </table>
	</div>

	<div title="Non Anggota" style="padding:10px">
		<table>
		   <tr>
				<td>Kas</td><td><?=form_input('coa_nag_kas',$coa_nag_kas,"id='coa_nag_kas' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_kas')",'search')?></td>		   
		   </tr>
		   <tr>
				<td>Simpanan</td><td><?=form_input('coa_nag_simpanan',$coa_nag_simpanan,"id='coa_nag_simpanan' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_simpanan')",'search')?></td>
		   </tr>
		   <tr>
				<td>Administrasi</td><td><?=form_input('coa_nag_admin',$coa_nag_admin,"id='coa_nag_admin' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_admin')",'search')?></td>
		   </tr>
		   <tr>
				<td>Beban Bunga</td><td><?=form_input('coa_nag_beban_bunga',$coa_nag_beban_bunga,"id='coa_nag_beban_bunga' style='width:350px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_beban_bunga')",'search')?></td>
		   </tr>
	   </table>
	</div>


   	</div>

	   </form>
 
</div>	
			
<?=load_view('gl/select_coa_link')?>   	
 
<script type="text/javascript">
    function save_this(){
        if($('#nama').val()===''){alert('Isi nama simpanan !');return false;};

		url='<?=base_url()?>index.php/koperasi/jenis_simpanan/save';
			$('#frm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#loan_number').val(result.loan_number);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
						remove_tab_parent();
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/jenis_simpanan");
	}
		
</script>  
