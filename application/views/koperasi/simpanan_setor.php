<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_bukti()','print');			
	?>
	<div style="float:right">
		<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help()">Help</div>
			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
		<?=link_button('Help', 'load_help()','help');?>		
		<?=link_button('Close', 'remove_tab_parent()','close');?>		
	</div>
</div>

<?php echo validation_errors(); ?>

<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">
 
	<form id="frmMain"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		<input type='hidden' name='id' id='id'	value='<?=$id?>'>
	   <table>
			<tr>
				<td>Nomor Anggota</td><td><?php echo form_input('no_anggota',$no_anggota,"id=no_anggota"); 
				echo link_button("","select_anggota()","search")?></td>
			</tr>
			<tr>
				<td>Nomor Rekening</td><td><?php echo form_input('no_rekening',$no_rekening,"id=no_rekening"); 
				echo link_button("","select_rekening()","search")?></td>
			</tr>
		   <tr>
				<td>Tanggal Transaksi</td><td><?=form_input('tanggal',$tanggal,"class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' style='width:180px'");?></td>
		   </tr>
		   <tr>
				<td>Jenis Simpanan</td><td><?php echo form_input('jenis_setor',$jenis_setor,"id='jenis_setor'");
					echo link_button("","select_jenis()", "search");
					?></td>
		   </tr>
		   <tr>
				<td>Sandi </td><td colspan="4">
					<?=form_input('sandi',$sandi,"id='sandi'");?>
					</br><i>(0-Setoran, 1-Tarikan, 3-Bunga, 4-Admin, 5-Koreksi)</i>
				</td>
		   </tr>
			<tr>
				<td>Jml Setoran (1)</td><td><?=form_input('jumlah_setor',$jumlah_setor,"id=jumlah_setor onblur='calc_jumlah()'");?></td>
				<td>Biaya Admin (2)</td><td><?=form_input('jumlah_admin',$jumlah_admin,"id=jumlah_admin onblur='calc_jumlah()'");?></td>
			</tr>
		   <tr>
				<td>Jumlah (1+2)</td><td><?=form_input('jumlah',$jumlah,"id=jumlah");?></td>
				<td>Petugas</td><td><?=form_input('petugas',$petugas,"id=petugas");?></td>
		   </tr>
		   <tr><td>Catatan</td><td colspan="4"><?=form_input('catatan',$catatan,"style='width:400px'");?></td></tr>
		   <tr>
		   </tr>
	   </table>
	   </form>
	</div>
	 
	<div title='Daftar 10 Transksi'>
		<div id='divItem' class='box-gradient' style='display:<?=$mode=="add"?"":""?>'>
			<table id="dg" class="easyui-datagrid table"  width="100%"
				data-options="
					iconCls: 'icon-edit',
					singleSelect: true,
					toolbar: '#tb_item',fitColumns:true,
					url: '<?=base_url("index.php/koperasi/simpanan_setor/history/$no_rekening")?>'
				">
				<thead>
					<tr>
						<th data-options="field:'tanggal',width:80">Tanggal</th>
						<th data-options="field:'jenis_setor',width:150">Jenis</th>
						<th data-options="field:'sandi',width:50">Sandi</th>
						<th data-options="<?=col_number('jumlah')?>">Jumlah</th>
						<th data-options="<?=col_number('saldo')?>">Saldo</th>
						<th data-options="field:'id',width:30,align:'right'">Id</th>
					</tr>
				</thead>
			</table>
		</div>	
	</div>
</div>	

<script type="text/javascript">
    function save_this(){
        if($('#no_anggota').val()===''){log_err('Isi nomor anggota !');return false;};
        if($('#no_rekening').val()===''){log_err('Isi nomor rekening !');return false;};
        if(c_($('#jumlah').val())==0){log_err('Isi jumlah !');return false;};

		url=CI_ROOT+'koperasi/simpanan_setor/save';
			$('#frmMain').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
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
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/pinjaman");
	}
	function select_anggota(){
		lookup1({id:"kop_anggota", 
			url:CI_ROOT+"lookup/query/kop_anggota",
			fields: [[
		        {field:'no_anggota',title:'Kode Anggota',width:80},
		        {field:'nama',title:'Nama',width:300},
		        {field:'phone',title:'Phone',width:80},
		        {field:'group_type',title:'Kelompok',width:80}
    		]],
    		result: function result(){
    			$("#no_anggota").val(r.data.no_anggota);
    		}
		});		
	}
	function select_jenis(){
		lookup1({id:"kop_jenis_simpanan", 
			url:CI_ROOT+"lookup/query/kop_jenis_simpanan",
			fields: [[
		        {field:'nama',title:'Nama Simpanan',width:300}
    		]],
    		result: function result(){
    			$("#jenis_setor").val(r.data.nama);
    		}
		});		
	}
	function select_rekening(){
		lookup1({id:"kop_simpanan", 
			url:CI_ROOT+"lookup/query/kop_simpanan",
			fields: [[
		        {field:'nomor',title:'Nomor Rek',width:80},
		        {field:'nama',title:'Nama',width:300},
		        {field:'kode_anggota',title:'Nomor Angg',width:80}
    		]],
    		result: function result(){
    			$("#no_rekening").val(r.data.nomor);
    		}
		});		
	}
	function calc_jumlah(){
		var jml_setor=c_($("#jumlah_setor").val());
		var jml_admin=c_($("#jumlah_admin").val());
		$("#jumlah").val(jml_setor+jml_admin);
	}
	
		
</script>  
