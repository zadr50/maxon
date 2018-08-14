<h4>FORMULIR REKENING SIMPANAN</H4>
<div class="thumbnail">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/koperasi/rekening/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/koperasi/rekening/view/'.$no_simpanan);		
	echo link_button('Search','','search','true',base_url().'index.php/koperasi/rekening');		
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

<?php echo validation_errors(); ?>

<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">
 
	<form id="frmLoan"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table>
			<tr><td>Nomor Simpanan</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$no_simpanan</strong></span>";
						echo "<input type='hidden' id='no_simpanan' value='$no_simpanan'>";
					} else { 
						echo form_input('no_simpanan',$no_simpanan,"id=no_simpanan");
					}		
					?>
				</td>
				<td rowspan='4' colspan='4'>
					<div class="thumbnail" style="width:400px;height:100px">
						<?=$anggota?>
					</div>
				</td>
			</tr>	 
			<tr>
				<td>Nomor Anggota</td><td><? echo form_input('no_anggota',$no_anggota,"id=no_anggota"); 
				echo link_button("","select_anggota()","search");?></td>
			</tr>
		   <tr>
				<td>Tanggal Daftar</td><td><?=form_input('tanggal',$tanggal,"class='easyui-datetimebox' style='width:150px'");?></td>
		   </tr>
		   <tr>
				<td>Jenis Simpanan</td><td><? echo form_dropdown('jenis',$jenis_list, $jenis); ?></td>
		   </tr>
			<tr>
				<td>Setoran Awal</td><td><?=form_input('setor_awal',$setor_awal);?></td>
		   </tr>
			<tr>
				<td>Administrasi</td><td><?=form_input('setor_admin',$setor_admin);?></td>
			</tr>
		   <tr>
				<td>Jumlah Setoran</td><td><?=form_input('jumlah',$jumlah);?></td>
				<td>Nomor Bukti Kas</td><td><?=form_input('voucher_kas',$voucher_kas);?></td>       
		   </tr>
		   <tr>
				<td>Deposito Jangka Waktu</td><td><?=form_input('deposito_jangka',$deposito_jangka);?></td>       
				<td>Bunga Percent</td><td><?=form_input('deposito_percent',$deposito_percent);?></td>
		   </tr>
		   <tr><td>Catatan</td><td colspan="4"><?=form_input('comments',$comments,"style='width:400px'");?></td></tr>
		   <tr>
		   </tr>
	   </table>
	   </form>
	</div>
	 

</div>	
	
<?=load_view("koperasi/anggota_select.php"); ?>

<script type="text/javascript">
    function save_this(){
        if($('#no_simpanan').val()===''){alert('Isi dulu nomor simpanan !');return false;};

		url='<?=base_url()?>index.php/koperasi/rekening/save';
			$('#frmLoan').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#no_simpanan').val(result.no_simpanan);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/rekening_simpanan");
	}
		
</script>  
