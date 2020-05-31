<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save_this()','save');		
	
	?>
	<div style="float:right">
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Help', 'load_help()','help');?>		
	<?=link_button('Close', 'remove_tab_parent()','cancel');?>		
	</div>
</div>

<?php echo validation_errors(); ?>

	<form id="frmLoan"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table>
			<tr><td>Nama Pinjaman</td>
				<td>
					<?php
					$readonly="";
					if($mode=='view')$readonly="readonly";
					 
					echo form_input('nama',$nama,"id=nama $readonly style='width:200px'");
							
					?>
				</td>
				<td>Jenis Bunga</td><td><?=form_dropdown('jenis_bunga',array("Bunga Flat","Bunga Efektif","Bunga Anuitas"),$jenis_bunga);?></td>
			</tr>	 
			<tr>
				<td>Periode</td><td><? echo form_dropdown('periode',array("Harian","Mingguan","Bulanan"),$periode,"id=periode"); ?></td>
				<td>Custom Hari</td><td><?=form_input('custom_hari',$custom_hari);?></td>
			</tr>
		   <tr>
		   </tr>
		   <tr>
		   </tr>
			<tr>
				<td>Suku Bunga %</td><td><?=form_input('bunga_prc',$bunga_prc);?></td>
				<td>Provisi %</td><td><?=form_input('provisi_prc',$provisi_prc,"id=provisi_prc");?></td>
			</tr>
		   <tr>
				<td>Resiko %</td><td><?=form_input('resiko_prc',$resiko_prc);?></td>
				<td>Jumlah Angsuran (Bulan)</td><td><?=form_input('angsuran_kali',$angsuran_kali);?></td>       
		   </tr>
		   <tr>
				<td>Angsuran Tiap Bulan Rp. </td><td><?=form_input('angsuran',$angsuran);?></td>       
				<td>Jangka Waktu X Bulan</td><td><?=form_input('loan_count',$loan_count);?></td>
		   </tr>
	</table>	   
	<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="Anggota" style="padding:10px">
		<table>
		   <tr>
				<td>Kas</td><td><?=form_input('coa_ag_kas',$coa_ag_kas,"id='coa_ag_kas' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_kas')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Piutang Pinjaman</td><td><?=form_input('coa_ag_piutang',$coa_ag_piutang,"id='coa_ag_piutang' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_piutang')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Pendapatan Jasa Pinjaman</td><td><?=form_input('coa_ag_jasa',$coa_ag_jasa,"id='coa_ag_jasa' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_jasa')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Provisi Pinjaman</td><td><?=form_input('coa_ag_provisi',$coa_ag_provisi,"id='coa_ag_provisi' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_provisi')",'search')?>
					</td>
		   </tr>
		   <tr>
				<td>Pendapatan Denda</td><td><?=form_input('coa_ag_denda',$coa_ag_denda,"id='coa_ag_denda' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_denda')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Cadangan Resiko Kredit</td><td><?=form_input('coa_ag_resiko',$coa_ag_resiko,"id='coa_ag_resiko' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_resiko')",'search')?>
				</td>
				
			</tr>
		   <tr><td>Pendapatan Administrasi</td><td><?=form_input('coa_ag_admin',$coa_ag_admin,"id='coa_ag_admin' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_ag_admin')",'search')?>
			</td></tr>
		   
	   </table>
	</div>

	<div title="Non Anggota" style="padding:10px">
		<table>
		   <tr>
				<td>Kas</td><td><?=form_input('coa_nag_kas',$coa_nag_kas,"id='coa_nag_kas' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_kas')",'search')?>
					
				</td>		   
		   </tr>
		   <tr>
				<td>Piutang Pinjaman</td><td><?=form_input('coa_nag_piutang',$coa_nag_piutang,"id='coa_nag_piutang' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_piutang')",'search')?>
					
				</td>
		   </tr>
		   <tr>
				<td>Pendapatan Jasa Pinjaman</td><td><?=form_input('coa_nag_jasa',$coa_nag_jasa,"id='coa_nag_jasa' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_jasa')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Provisi Pinjaman</td><td><?=form_input('coa_nag_provisi',$coa_nag_provisi,"id='coa_nag_provisi' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_provisi')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Pendapatan Denda</td><td><?=form_input('coa_nag_denda',$coa_nag_denda,"id='coa_nag_denda' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_denda')",'search')?>
				</td>
		   </tr>
		   <tr>
				<td>Cadangan Resiko Kredit</td><td><?=form_input('coa_nag_resiko',$coa_nag_resiko,"id='coa_nag_resiko' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_resiko')",'search')?>
				</td>
				
			</tr>
		   <tr><td>Pendapatan Administrasi</td><td><?=form_input('coa_nag_admin',$coa_nag_admin,"id='coa_nag_admin' style='width:200px'");?>
			        <?=link_button('',"lookup_coa('coa_nag_admin')",'search')?>
				</td></tr>
		 
		   
	   </table>
	</div>


   	</div>

	   </form>
 
</div>	
 <?=load_view('gl/select_coa_link')?>   	

<script type="text/javascript">
    function save_this(){
        if($('#nama').val()===''){alert('Isi nama jenis pinjaman !');return false;};

		url='<?=base_url()?>index.php/koperasi/jenis_pinjaman/save';
			$('#frmLoan').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#nama').val(result.nama);
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
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/jenis_pinjaman");
	}
		
</script>  
