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
		<?=link_button("Close", 'remove_tab_parent()','cancel');?>
	</div>
</div>
<div class='thumbnail'>
<?php echo validation_errors(); ?>
 
	<form id="frm"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table class='table'>
			<tr><td>Kode</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$kode</strong></span>";
						echo "<input type='hidden' id='kode' value='$kode'>";
					} else { 
						echo form_input('kode',$kode,"id=kode");
					}		
					?>
				</td>
			</tr>	 
			<tr>
				<td>Nama Kelompok</td><td><?php echo form_input('kelompok',$kelompok,"id=kelompok"); 
				?></td>
			</tr>
	   </table>
	   </form>
</div>
 
 
<script type="text/javascript">
    function save_this(){
        if($('#kode').val()===''){alert('Isi dulu kode kelompok !');return false;};

		url='<?=base_url()?>index.php/koperasi/kelompok/save';
			$('#frm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#kode').val(result.kode);
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
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/kelompok_anggota");
	}
		
</script>  
