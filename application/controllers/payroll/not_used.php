	<div title="Absensi" style="padding:10px">
		<table id="dg" class="easyui-datagrid"  
				style="width:100%"
				data-options="
					iconCls: 'icon-edit',
					singleSelect: true,
					toolbar: '#tb', fitColumns: true,
					url: '<?=base_url()?>index.php/payroll/absensi/data_salary_no/<?=$pay_no?>/<?=$employee_id?>'
				">
				<thead>
					<tr>
						<th data-options="field:'absen_type'">Type</th>
						<th data-options="field:'tanggal'">Tanggal</th>
						<th data-options="field:'hari'">Hari</th>
						<th data-options="field:'time_in'">TimeIn</th>
						<th data-options="field:'time_out'">TimeOut</th>
						<th data-options="field:'ot_in'">OT In</th>
						<th data-options="field:'ot_out'">OT Out</th>
						<th data-options="field:'work_status'">Work Type</th>
						<th data-options="field:'shift_code'">Shift</th>
						<th data-options="field:'nip'">NIP</th>
						<th data-options="field:'nama'">Nama</th>
						<th data-options="field:'dept'">Dept</th>
						<th data-options="field:'divisi'">Divisi</th>
						<th data-options="field:'id',align:'right'">Line</th>
					</tr>
				</thead>
		</table>
	</div>
	
<div id="tb">
	<div class="thumbnail">
		<?=link_button('Edit','edit_item()','edit')?>
        <?=link_button('Refresh','load_absen();return false',"reload");?>
        <?=link_button('View Absensi','view_absen();return false',"reload");?>
        <?=link_button('View Overtime','view_absen();return false',"reload");?>
	</div>
</div>

<?php include_once("absensi_input.php"); ?>


 	function edit_item(){
//		$("#dg").datagrid("clearChecked"); 		
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$("#tanggal").datetimebox("setValue",row.tanggal);
			$("#time_in").val(row.time_in);
			$("#time_out").val(row.time_out);
			$("#ot_in").val(row.ot_in);
			$("#ot_out").val(row.ot_out);
			$("#id").val(row.id);
			$("#absen_type").val(row.absen_type);
			$("#work_status").val(row.work_status);
			$("#dlgItem").dialog("open");
		}	
		
	}
 	function load_absen(){
 		var nip=$("#employee_id").val();
        if(nip==""){log_err("Pilih NIP karyawan !");return false;};
 		var periode=$("#pay_period").val();
		$('#dg').datagrid({url:'<?=base_url()?>index.php/payroll/absensi/data_nip/'+periode+'/'+nip});
 	}
