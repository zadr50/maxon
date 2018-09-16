<h4>FORMULIR PINJAMAN ANGGOTA</H4>
<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/koperasi/pinjaman/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/koperasi/pinjaman/view/'.$no_pinjaman);		
	echo link_button('Search','','search','true',base_url().'index.php/koperasi/pinjaman');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
</div>

 <div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">

	<form id="frmLoan"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table>
			<tr>
				<td>Nomor Anggota</td><td><?php echo form_input('no_anggota',$no_anggota,"id=no_anggota"); 
				echo link_button("","select_anggota()","search")?></td>

				<td rowspan='4' colspan='4'>
					<div class="thumbnail" style="width:350px;height:100px">
						<input type='text' id='nama' value='<?=$nama?>' disabled style='width:100%'>
					</div>
				</td>
				
			</tr>
			<tr>
				<td>Jenis Pinjaman</td><td><?php echo form_dropdown('jenis_pinjaman',$jenis_pinjaman_list,$jenis_pinjaman,"id=jenis_pinjaman");?></td>
			</tr>
			<tr>
				<td>Nomor Pinjaman</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$no_pinjaman</strong></span>";
						echo "<input type='hidden' id='nip' value='$no_pinjaman'>";
					} else { 
						echo form_input('no_pinjaman',$no_pinjaman,"id=no_pinjaman");
					}		
					?>
				</td>
			</tr>	 
		   <tr>
				<td>Tanggal Pinjam</td><td><?=form_input('tanggal',$tanggal,"class='easyui-datetimebox' style='width:150px'");?></td>
		   </tr>
		   <tr>
				<td>Tanggal Jatuh Tempo</td><td><?=form_input('tanggal_tempo',$tanggal_tempo,"class='easyui-datetimebox' style='width:150px'");?></td>
				<td>Nomor Rekening Simpanan</td><td><? echo form_input('no_simpanan',$no_simpanan,"id=no_simpanan"); 
				echo link_button("","select_Rek()","search")?></td>
			</tr>
			<tr><td>Jumlah Pinjaman</td><td><?=form_input('jumlah',$jumlah);?></td>
				<td>Bunga %</td><td><?=form_input('bunga_prc',$bunga_prc);?></td></tr>
			<tr><td>Provisi %</td><td><?=form_input('provisi_prc',$provisi_prc);?></td>
				<td>Resiko %</td><td><?=form_input('resiko_prc',$resiko_prc);?></td></tr>
			<tr><td>Angsuran Pokok</td><td><?=form_input('angsur_pokok',$angsur_pokok);?></td>
				<td>Angsuran Bunga</td><td><?=form_input('angsur_bunga',$angsur_bunga);?></td></tr>
			<tr><td>Jumlah Angsuran</td><td><?=form_input('angsuran',$angsuran);?></td>
				<td>Jangka Waktu (Bulan)</td><td><?=form_input('jangka_waktu',$jangka_waktu);?></td></tr>
			<tr><td>Keterangan</td><td colspan=4><?=form_input('comments',$comments,"style='width:400px'");?></td></tr>

		</table>
	   </form>
	</div>
	<div title='Cicilan'>
		<?php include_once "cicilan.php" ?>
	</div>
	  


</div>	
	
<?php include_once "anggota_select.php" ?>
<?php include_once "rekening_lookup.php" ?>

<script type="text/javascript">
    function save_this(){
        if($('#no_anggota').val()===''){alert('Isi dulu nomor anggota !');return false;};
        if($('#no_simpanan').val()===''){alert('Isi dulu nomor simpanan !');return false;};

		url='<?=base_url()?>index.php/koperasi/pinjaman/save';
			$('#frmLoan').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#no_pinjaman').val(result.no_pinjaman);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/pinjaman");
	}
		
</script>  
