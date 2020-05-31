<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	
	?>
	<div style="float:right">
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Help', 'load_help()','help');?>		
	<?=link_button('Close', 'remove_tab_parent()','cancel');?>		
	</div>
</div>

<?php echo validation_errors(); ?>

<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">
 
	<form id="frmLoan"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table class='table'>
			<tr><td>Nomor Simpanan</td>
				<td>
					<?php
					$readonly="";
					if($mode=='view')$readonly="readonly";
					echo form_input('nomor',$nomor,"id=nomor $readonly");
					?>
				</td>
				<td rowspan='4' colspan='4'>
					<div id='nama_anggota' class="thumbnail" style="width:400px;height:100px">
						<?=$anggota?>
					</div>
				</td>
			</tr>	 
			<tr>
				<td>Nomor Anggota</td><td><?php echo form_input('kode_anggota',$kode_anggota,"id=kode_anggota"); 
				echo link_button("","select_anggota();return false","search");?></td>
			</tr>
		   <tr>
				<td>Tanggal Daftar</td><td><?=form_input('tanggal_daftar',$tanggal_daftar,"class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' style='width:180px'");?></td>
		   </tr>
		   <tr>
				<td>Jenis Simpanan</td><td><?php echo form_input('jenis_simpanan',$jenis_simpanan,"id='jenis_simpanan'"); ?>
					<?=link_button("", "select_jenis();return false","search")?>
				</td>
		   </tr>
			<tr>
				<td>Setoran Awal</td><td><?=form_input('setor_awal',$setor_awal);?></td>
				<td>Administrasi</td><td><?=form_input('setor_admin',$setor_admin);?></td>
		   </tr>
		   <tr>
				<td>Jumlah SetoranAwal+Admin</td><td><?=form_input('setor_total',$setor_total);?></td>
				<td>Nomor Bukti Kas</td><td><?=form_input('voucher',$voucher);?></td>       
		   </tr>
		   <tr>
				<td>Deposito Jangka Waktu</td><td><?=form_input('deposito_jangka',$deposito_jangka);?></td>       
				<td>Bunga Percent</td><td><?=form_input('deposito_percent',$deposito_percent);?></td>
		   </tr>
		   <tr><td>Catatan</td><td colspan="5"><?=form_input('catatan',$catatan,"style='width:400px'");?></td></tr>
		   <tr>
		   </tr>
	   </table>
	   </form>
	</div>
	 

</div>	
<script type="text/javascript">
    function save_this(){
        if($('#nomor').val()===''){alert('Isi dulu nomor simpanan !');return false;};

		url='<?=base_url()?>index.php/koperasi/rekening/save';
			$('#frmLoan').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#nomor').val(result.nomor);
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
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/rekening_simpanan");
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
    			$("#kode_anggota").val(r.data.no_anggota);
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
    			$("#jenis_simpanan").val(r.data.nama);
    		}
		});		
	}
	
	
		
</script>  
