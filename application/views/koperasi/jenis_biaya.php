<div><h4>JENIS BIAYA</H4>
<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/jenis_biaya/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/jenis_biaya/view/'.$jenis_biaya);		
	echo link_button('Search','','search','true',base_url().'index.php/jenis_biaya');		
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

	<form id="frm"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table>
			<tr><td>Jenis Biaya</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$jenis_biaya</strong></span>";
						echo "<input type='hidden' id='nip' value='$jenis_biaya'>";
					} else { 
						echo form_input('jenis_biaya',$jenis_biaya,"id=jenis_biaya");
					}		
					?>
				</td>
			</tr>	 
			<tr>
				<td>Jumlah Rp.</td><td><?php echo form_input('jumlah',$jumlah,"id=jumlah"); ?></td>
			</tr>
		   <tr>
				<td>Kode Perkiraan</td><td><?=form_input('account_id',$account_id);?></td>
		   </tr>
		   <tr>
				<td>Periode</td><td><?=form_dropdown('periode',array("Harian","Mingguan","Bulanan","Tahunan"),$periode);?></td>
		   </tr>
	   </table>
	   </form>

</div>	
	
<script type="text/javascript">
    function save_this(){
        if($('#jenis_biaya').val()===''){alert('Isi dulu Jenis Biaya !');return false;};

		url='<?=base_url()?>index.php/jenis_biaya/save';
			$('#frm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#jenis_biaya').val(result.loan_number);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/jenis_biaya");
	}
		
</script>  
