<h4>FORMULIR ANGGOTA KOPERASI</H4>
<div class="thumbnail">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/koperasi/anggota/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/koperasi/anggota/view/'.$no_anggota);		
	echo link_button('Search','','search','true',base_url().'index.php/koperasi/anggota');		
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
 
	<form id="frmAnggota"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table>
			<tr><td>Nomor Anggota</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$no_anggota</strong></span>";
						echo "<input type='hidden' id='no_anggota' name='no_anggota' value='$no_anggota'>";
					} else { 
						echo form_input('no_anggota',$no_anggota,"id=no_anggota");
					}		
					?>
				</td>
				<td>Nama Anggota</td><td><? echo form_input('nama',$nama,"id=nama"); ?></td>
				
			</tr>	 
		   <tr>
				<td>Tanggal gabung</td><td><?=form_input('join_date',$join_date,"class='easyui-datetimebox' style='width:150px'");?></td>
				<td>Kelompok</td><td>
				<? echo form_dropdown('group_type',$list_kelompok,$group_type);	?></td>
		   </tr>
		   <tr>
				<td>Alamat Baris 1</td><td colspan='3'><?=form_input('street',$street,"style='width:400px'");?></td>
		   </tr>
			<tr>
				<td>Alamat Baris 2</td><td colspan='3'><?=form_input('suite',$suite,"style='width:400px'");?></td>
				
			</tr>
		   <tr>
				<td>Negara</td><td><?=form_input('country',$country,"id=country");?></td>
				<td>Provinsi</td><td><?=form_input('state',$state);?></td>
		   </tr>
		   <tr>
				<td>Kota</td><td><?=form_input('city',$city);?></td>       
				<td>Kode Pos</td><td><?=form_input('zip_postal_code',$zip_postal_code);?></td>       
		   </tr>
		   <tr>
				<td>Wilayah</td><td><?=form_input('region',$region);?></td>		   
				<td>Email</td><td><?=form_input('email',$email);?></td>
		   </tr>
		   <tr>
				<td>Telphone 1</td><td><?=form_input('phone',$phone);?></td>
				<td>Telphone 2</td><td><?=form_input('other_phone',$other_phone);?></td>
		   </tr>
		   <tr>
				<td>Identitas</td><td><?=form_input('id_type',$id_type);?></td>
				<td>Nomor Identitas</td><td><?=form_input('id_card',$id_card);?></td>
		   </tr>
		   <tr>
				<td>Expire Identitas</td><td><?=form_input('id_expire',$id_expire);?></td>
				<td>Agama</td><td><?=form_input('religion',$religion);?></td>				
			</tr>
		   <tr><td>Tempat Lahir</td><td><?=form_input('birth_place',$birth_place);?></td>
				<td>Tanggal Lahir</td><td><?=form_input('birth_date',$birth_date,"class='easyui-datetimebox' style='width:150px'");?></td></tr>
		   <tr><td>Nama Pasangan</td><td><?=form_input('nama_pasangan',$nama_pasangan);?></td>
				<td>Pekerjaan</td><td><?=form_input('job',$job);?></td></tr>
		   <tr><td>Penghasilan</td><td><?=form_input('penghasilan',$penghasilan);?></td>
				<td>Perusahaan</td><td><?=form_input('perusahaan',$perusahaan);?></td></tr>
		   <tr><td>Alamat Kantor</td><td><?=form_input('alamat_kantor',$alamat_kantor);?></td>
				<td>Keterangan</td><td><?=form_input('comments',$comments);?></td></tr>
		   <tr>
				<td>Petugas</td><td><?=form_input('petugas',$petugas);?></td></tr>
		   <tr><td>Aktif</td><td><?=form_input('active',$active);?></td>
				<td>Status Member</td><td><?=form_input('status_member',$status_member);?></td></tr>
		   <tr><td>Gender</td><td><?=form_dropdown('jenis_kelamin',array("Pria","Wanita"),$jenis_kelamin);?></td>
				<td>Photo</td><td><?=form_input('photo',$photo);?></td></tr>
	   </table>
	   </form>
	</div>
	  

</div>	
	 
<script type="text/javascript">
    function save_this(){
        if($('#no_anggota').val()===''){alert('Isi dulu nomor anggota !');return false;};

		url='<?=base_url()?>index.php/koperasi/anggota/save';
			$('#frmAnggota').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#no_anggota').val(result.no_anggota);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/anggota");
	}
		
</script>  
