<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_slip()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/payroll/salary/add');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/payroll/salary/view/'.$pay_no);		
	echo link_button('Search','','search','false',base_url().'index.php/payroll/salary');		
	
	?>
	<div style='float:right'>
    	<?=link_button('Help', 'load_help(\'salary\')','help');	?>	
    	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip',plain:false">Options</a>
    	<div id="mmOptions" style="width:200px;">
    		<div onclick="load_help()">Help</div>
    		<div>Update</div>
    		<div>MaxOn Forum</div>
    		<div>About</div>
    	</div>
        <?=link_button('Close', 'remove_tab_parent();return false;','cancel');?>     
	</div>
</div>

<?php echo validation_errors(); ?>

<form id="frmSalary"  method="post">

<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">
 
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		
	   <table class='table2' width='100%'>
			<tr><td>Nomor Slip</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$pay_no</strong></span>";
						echo "<input type='hidden' name='pay_no' id='pay_no' value='$pay_no'>";
					} else { 
						echo form_input('pay_no',$pay_no,"id=pay_no");
					}		
					?>
				</td>
				<td rowspan='4' colspan='2'>
					<div class="thumbnail" style="width:400px;height:100px">
						<span id='nama'><?=$nama_pegawai?></span>
						<span id='dept'></span>
						<span id='divisi'></span>
						
					</div>
				</td>
		
			</tr>	 
			<tr>
				<td>NIP</td>
				<td><? echo form_input('employee_id',$employee_id,"id=employee_id"); 
				echo link_button("","dlgemployee_show();return false","search")?></td>
			</tr>
		    <tr>
				<td>Periode </td><td><?=form_input('pay_period',$pay_period,"id='pay_period'");
				echo link_button("","dlghr_period_show();return false;","search")?></td>
		   </tr>
		    <tr>
				<td>From Date </td><td><?=form_input('from_date',$from_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='from_date'");?></td>
		   </tr>
		    <tr>
				<td>To Date </td><td><?=form_input('to_date',$to_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='to_date'");?></td>
		   </tr>
		   <tr>
				<td>Tanggal</td><td><?=form_input('pay_date',$pay_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px'");?></td>
				<td>Pendapatan</td><td><?=$total_pendapatan?></td>
		   </tr>
			<tr>
				<td>Pay Type</td><td><?=form_input('pay_type',$pay_type,"id=pay_type");?></td>
				<td>Potongan</td><td><?=$total_potongan?></td>
			</tr>
			<tr>
				<td>Kelompok</td><td><?=form_input('emp_level',$emp_level,"id=emp_level");
				echo link_button("","dlghr_emp_level_show();return false;","search")?></td>
				<td>Net Gaji</td><td><?=$salary?></td>
			</tr>
	   </table>
	</div>
	
	<?php if($mode=="view") { ?>
	
	<div title="Pendapatan" style="padding:10px">
		<table class='table'>
			<thead>
				<tr>
					<th>No Urut</th><th>Nama Komponen</th><th>Jumlah</th>
					<th>Kode</th><th>Rumus</th><th>Id</th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<count($tunjangan_list);$i++) {
						$jenis=$tunjangan_list[$i];
						echo "<tr><td>".$jenis['no_urut']."</td><td>".$jenis['salary_com_name']."</td>
						<td><input type='text' name='com_code[".$jenis['salary_com_code']."]'  
						    value='".$jenis['amount']."'>
						</td><td>".$jenis['salary_com_code']."</td>
						<td>".$jenis['formula_string']."</td><td>".$jenis['id']."</td>
						</tr>";
				
				} ?>
			</tbody>
		</table>
	</div>
	<div title="Potongan" style="padding:10px">
		<table class='table'>
			<thead>
				<tr>
					<th>No Urut</th><th>Nama Komponen</th><th>Jumlah</th>
					<th>Kode</th><th>Rumus</th><th>Id</th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<count($potongan_list);$i++) {
						$jenis=$potongan_list[$i];
						echo "<tr><td>".$jenis['no_urut']."</td><td>".$jenis['salary_com_name']."</td>
						<td><input type='text' name='com_code[".$jenis['salary_com_code']."]'  
						    value='".$jenis['amount']."'>
						</td><td>".$jenis['salary_com_code']."</td>
						<td>".$jenis['formula_string']."</td><td>".$jenis['id']."</td>
						</tr>";				
				} ?>
			</tbody>
		</table>
		
	</div>
	<div title="Absensi" style="padding:10px">
		<table id="dg" class="easyui-datagrid"  
				style="width:100%"
				data-options="
					iconCls: 'icon-edit',
					singleSelect: true,
					toolbar: '#tb', fitColumns: true,
					url: '<?=base_url()?>index.php/payroll/absensi/data_nip/<?=$pay_period?>/<?=$employee_id?>'
				">
				<thead>
					<tr>
						<th data-options="field:'absen_type'">Type</th>
						<th data-options="field:'tanggal'">Tanggal</th>
						<th data-options="field:'time_in'">TimeIn</th>
						<th data-options="field:'time_out'">TimeOut</th>
						<th data-options="field:'ot_in'">OT In</th>
						<th data-options="field:'ot_out'">OT Out</th>
						<th data-options="field:'nip'">NIP</th>
						<th data-options="field:'nama'">Nama</th>
						<th data-options="field:'dept'">Dept</th>
						<th data-options="field:'divisi'">Divisi</th>
						<th data-options="field:'id',align:'right'">Line</th>
					</tr>
				</thead>
		</table>
	</div>
	
	<?php } ?>
</div>	

</form>
	
<?php 
 echo $lookup_employee;
 echo $lookup_periode;
 echo $lookup_emp_type;
 
?>

<script type="text/javascript">
    function save_this(){
        if($('#employee_id').val()===''){alert('Isi dulu NIP Karyawan !');return false;};

		url='<?=base_url()?>index.php/payroll/salary/save';
			$('#frmSalary').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#pay_no').val(result.pay_no);
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
			window.parent.$("#help").load("<?=base_url()?>index.php/payroll/help/load/salary");
	}
	function print_slip(){
		var pay_no=$("#pay_no").val();
		url="<?=base_url()?>index.php/payroll/salary/print_slip/"+pay_no;
		window.open(url,'_blank');
	}
		
</script>  
