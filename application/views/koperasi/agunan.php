<div><h4>FORMULIR AGUNAN PINJAMAN</H4>
<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/agunan/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/agunan/view/'.$no_pinjaman);		
	echo link_button('Search','','search','true',base_url().'index.php/agunan');		
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
 
	<form id="frmPinjaman"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table>
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
				<td rowspan='4' colspan='4'>
					<div class="thumbnail" style="width:400px;height:100px">
						<span id='nama'></span>
						<span id='dept'></span>
						<span id='divisi'></span>
						<?=$nama_anggota?>
					</div>
				</td>
			</tr>	 
			<tr>
				<td>Jenis Agunan</td><td><? echo form_dropdown('jenis_agunan',$jenis_agunan_list,"id=jenis_agunan"); ?></td>
			</tr>
		   <tr>
				<td>Petugas</td><td><?=form_input('petugas',$petugas);?></td>
		   </tr>
		   <tr>
				<td>Jumlah Taksiran</td><td><?=form_input('taksiran',$taksiran);?></td>
		   </tr>
			<tr>
				<td>Keterangan</td><td><?=form_input('keterangan',$keterangan);?></td>
			</tr>
	   </table>
	   </form>
	</div>
</div>	
	
<?php include_once "employee_lookup.php" ?>
<script type="text/javascript">
    function save_this(){
        if($('#no_pinjaman').val()===''){alert('Isi dulu nomor pinjaman !');return false;};

		url='<?=base_url()?>index.php/agunan/save';
			$('#frmAgunan').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#no_pinjaman').val(result.loan_number);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/agunan");
	}
		
</script>  
