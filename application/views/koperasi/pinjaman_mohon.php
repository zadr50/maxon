<div><h4>FORMULIR PERMOHONAN PINJAMAN</H4>
<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/pinjaman_mohon/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/pinjaman_mohon/view/'.$nomor);		
	echo link_button('Search','','search','true',base_url().'index.php/pinjaman_mohon');		
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

 
	<form id="frmLoan"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table>
			<tr>
				<td>Nomor Anggota</td><td><? echo form_input('no_anggota',$no_anggota,"id=no_anggota"); 
				echo link_button("","lookup_anggota()","search")?></td>

				<td rowspan='4' colspan='4'>
					<div class="thumbnail" style="width:400px;height:100px">
						<?=$anggota?>
					</div>
				</td>
				
			</tr>
			<tr>
				<td>Jenis Pinjaman</td><td><? echo form_input('jenis_pinjaman',$jenis_pinjaman,"id=jenis_pinjaman"); 
				echo link_button("","lookup_jenis_pinjaman()","search")?></td>
			</tr>
			<tr><td>Nomor Pinjaman</td>
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
				<td>Nomor Simpanan</td><td><? echo form_input('no_simpanan',$no_simpanan,"id=no_simpanan"); 
				echo link_button("","lookup_no_simpanan()","search")?></td>
			</tr>
			<tr><td>Jumlah Pinjaman</td><td><?=form_input('jumlah',$jumlah);?></td></tr>
			<tr><td>Jangka Waktu (Bulan)</td><td><?=form_input('jangka_waktu',$jangka_waktu);?></td></tr>
			<tr><td>Cara Pembayaran</td><td><?=form_input('cara_bayar',$cara_bayar);?></td></tr>
			<tr><td>Status</td><td><?=form_input('status',$status);?></td></tr>
			<tr><td>Untuk Keperluan</td><td><?=form_input('keperluan',$keperluan);?></td></tr>
			<tr><td>Keterangan</td><td><?=form_input('comments',$comments);?></td></tr>

		</table>
	   </form>
	</div>
	  

</div>	
	
<?php include_once "employee_lookup.php" ?>
<script type="text/javascript">
    function save_this(){
        if($('#no_anggota').val()===''){alert('Isi dulu nomor anggota !');return false;};

		url='<?=base_url()?>index.php/pinjaman_mohon/save';
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
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/pinjaman_mohon");
	}
		
</script>  
