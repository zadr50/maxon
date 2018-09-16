<div><h4>PROSES PEMBEBANAN BIAYA ADMIN</H4>
<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/pinjaman/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/pinjaman/view/'.$loan_number);		
	echo link_button('Search','','search','true',base_url().'index.php/pinjaman');		
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
			<tr><td>Nomor Bukti</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$loan_number</strong></span>";
						echo "<input type='hidden' id='nip' value='$loan_number'>";
					} else { 
						echo form_input('loan_number',$loan_number,"id=loan_number");
					}		
					?>
				</td>
				<td rowspan='4' colspan='4'>
					<div class="thumbnail" style="width:400px;height:100px">
						<span id='nama'></span>
						<span id='dept'></span>
						<span id='divisi'></span>
						<?=$nama_pegawai?>
					</div>
				</td>
			</tr>	 
			<tr>
				<td>Tanggal Proses</td><td><?php echo form_input('nip',$nip,"id=nip"); echo link_button("","lookup_employee()","search")?></td>
			</tr>
		   <tr>
				<td>Tahun</td><td><?=form_input('date_loan',$date_loan,"class='easyui-datetimebox' style='width:150px'");?></td>
		   </tr>
		   <tr>
				<td>Bulan</td><td><?=form_input('loan_amount',$loan_amount);?></td>
		   </tr>
			<tr>
				<td>Jenis Biaya</td><td><?=form_dropdown('rate_method',array("Bunga Flat","Bunga Menurun"),$rate_method);?></td>
				<td>Jenis Simpanan</td><td><?=form_input('rate_percent',$rate_percent,"id=rate_percent");?></td>
			</tr>
		   <tr>
				<td>Petugas</td><td><?=form_input('pokok',$pokok);?></td>
				<td>Jumblah Biaya Administrasi</td><td><?=form_input('bunga',$bunga);?></td>       
		   </tr>
		   <tr><td>Catatan</td><td colspan="4"><?=form_input('comments',$comments,"style='width:400px'");?></td></tr>
		   <tr>
		   </tr>
	   </table>
	   </form>
	</div>
	 
	<div title='Cicilan'><?php include_once "cicilan.php" ?></div>

</div>	
	
<?php include_once "employee_lookup.php" ?>
<script type="text/javascript">
    function save_this(){
        if($('#nip').val()===''){alert('Isi dulu NIP Karyawan !');return false;};

		url='<?=base_url()?>index.php/pinjaman/save';
			$('#frmLoan').form('submit',{
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
