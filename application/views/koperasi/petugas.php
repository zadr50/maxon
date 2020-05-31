<h4>FORMULIR PETUGAS</H4>
<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/koperasi/petugas/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/koperasi/petugas/view/'.$nip);		
	echo link_button('Search','','search','true',base_url().'index.php/koperasi/petugas');		
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
			<tr><td>Kode</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$kode</strong></span>";
						echo "<input type='hidden' id='nip' value='$nip'>";
					} else { 
						echo form_input('nip',$nip,"id=nip");
					}		
					?>
				</td>
			</tr>	 
		   <tr>
				<td>Nama Petugas</td><td><?=form_input('nama',$nama);?></td>		   
		   </tr>

	   </table>
	   </form>
 
 
<script type="text/javascript">
    function save_this(){
        if($('#nip').val()===''){alert('Isi dulu kode/nip petugas !');return false;};

		url='<?=base_url()?>index.php/koperasi/petugas/save';
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
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/petugas_koperasi");
	}
		
</script>  
