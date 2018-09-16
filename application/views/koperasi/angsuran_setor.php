<div><h4>FORMULIR SETORAN  ANGSURAN</H4>
<div class="thumbnail">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/angsuran_setor/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/angsuran_setor/view/'.$id);		
	echo link_button('Search','','search','true',base_url().'index.php/angsuran_setor');		
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
						echo "<span class='thumbnail'><strong>$no_bukti_bayar</strong></span>";
						echo "<input type='hidden' id='no_bukti_bayar' value='$no_bukti_bayar'>";
					} else { 
						echo form_input('no_bukti_bayar',$no_bukti_bayar,"id=no_bukti_bayar");
					}		
					?>
				</td>
				<td rowspan='4' colspan='4'>
					<div class="thumbnail" style="width:400px;height:100px">
						<?=$nama_anggota?>
					</div>
				</td>
			</tr>	 
		   <tr>
				<td>Nomor Anggota</td><td><?=form_input('no_anggota',$no_anggota);?></td>
		   </tr>
		   <tr>
				<td>Angsuran Ke</td><td><?=form_input('bulan_ke',$bulan_ke);?></td>
		   </tr>
			<tr>
				<td>Tanggal</td><td><? echo form_input('tanggal_bayar',$tanggal_bayar,"id=no_anggota"); echo link_button("","lookup_anggota()","search")?></td>
			</tr>
		   <tr>
				<td>Tanggal Bayar</td><td><?=form_input('tanggal_bayar',$date_loan,"class='easyui-datetimebox' style='width:150px'");?></td>
		   </tr>
		   <tr>
				<td>Jumlah Bayar</td><td><?=form_input('bayar',$bayar);?></td>
		   </tr>
			<tr>
				<td>Denda</td><td><?=form_input('denda',$denda,"id=denda");?></td>
			</tr>
		   <tr>
				<td>Admin</td><td><?=form_input('administrasi',$administrasi);?></td>
		   </tr>
		   <tr><td>Catatan</td><td colspan="4"><?=form_input('comments',$comments,"style='width:400px'");?></td></tr>
		   <tr>
		   </tr>
	   </table>
	   </form>
	</div>
	 
	 
</div>	
	
<?php include "anggota_lookup.php" ?>

<script type="text/javascript">
    function save_this(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#tanggal_bayar').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
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
