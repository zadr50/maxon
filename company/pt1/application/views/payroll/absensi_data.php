<?php

?>
<div class="col-md-12 thumbnail">
	<table class='table'>			 
		<tr><td>Periode</td><td colspan='5'><?php 
		
		echo form_dropdown('periode',$periode_list,$periode,"id='periode'")
		
		?>
		NIP <?php 
		$disabled="";
        if($flag1==1)$disabled="disabled";
		echo form_input('nip',$nip,"id='nip' $disabled");
        if($flag1!=1)echo link_button('','lookup_employee()','search');
		echo "Nama ".form_input('nama',$nama,'id=nama disabled');
		echo link_button('Filter','load_absen()',"reload");
		
		?>		
		</td>
		</tr>
		<tr>
		<td colspan='5'>Department <?=form_input('dept',$dept,'id=dept disabled')?>
		Divisi <?=form_input('divisi',$divisi,'id=divisi disabled')?></td>
		</tr>
		<tr><td colspan='8'>
		<div class='alert alert-info'>
			<p>Isi informasi data absensi tanggal dan jam masuk/keluar 
			dan overtime dibawah ini kemudian klik tombol submit</p>
			<p><i>Type: 0 - Hadir, 1 - Tidak, 2 - Sakit, 3 - Ijin, 9 - Off</i></p>
		</div>
        <?php if($flag1<>1) { ?>
		<div class='thumbnail'>
		<table class='table'><thead>
			<th>Type</th><th>Tanggal</th><th>Time In</th><th>Time Out</th>
			<th>OT In</th><th>OT Out</th><th>Id</th></thead>
			<tbody><tr><td><?=form_input('absen_type',"","id=absen_type style='width:40px'")?></td>
			<td><?=form_input('tanggal',date('Y-m-d'),"id=tanggal style='width:100px'")?></td>
			<td><?=form_input('time_in','0000',"id=time_in style='width:50px'")?></td>
			<td><?=form_input('time_out','0000',"id=time_out style='width:50px'" )?></td>
			<td><?=form_input('ot_in','0000',"id=ot_in style='width:50px'")?></td>
			<td><?=form_input('ot_out','0000',"id=ot_out style='width:50px'" )?></td>
			<td><?=form_input('id','',"id=id style='width:20px'" )?></td>
			<td><?=link_button('Submit','submit_absen()',"save")?></td>
			</tr></tbody>
		</table>
		</div>
		<?php } ?>
		</td>
		</tr>
	</table>
</div>

<div class="col-md-12" >
		<table id="dg" class="easyui-datagrid"  
				style="width:100%"
				data-options="
					iconCls: 'icon-edit',
					singleSelect: true,
					toolbar: '#tb', fitColumns: true,
					url: '<?=base_url()?>index.php/payroll/absensi/data_nip/<?=$periode?>/<?=$nip?>'
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

<div id="tb">
    <?php if($flag1<>1) { ?>
	<div class="thumbnail">
		<?=link_button('Edit','edit_item()','edit')?>
		<?=link_button('Remove','del_item()','remove')?>
		<?=link_button("Generate","","save","false",base_url()."index.php/payroll/absensi/generate/".$periode)?>
        <?=link_button('Import','import_excel()','csv','false');?>
	</div>
	<?php }  ?>
</div>
<?=load_view('payroll/employee_lookup')?>
<script language="JavaScript">
	function add_item(){
 	}
 	function del_item(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			xurl=CI_BASE+'index.php/payroll/absensi/delete/'+row.id;                        
			delete_row("dg",xurl);
		}
	}
	function delete_row(grid_id,xurl){
		$.messager.confirm('Confirm','Are you sure you want to remove this line?',
		function(r)	{
			if(!r)return false;
			$.ajax({
				type: "GET",	url: xurl,
				success: function(result){
				try {
						var result = eval('('+result+')');
						if(result.success){
							$.messager.show({
								title:'Success',msg:result.msg
							});
							$('#'+grid_id).datagrid('reload');	 
						} else {
							$.messager.show({
								title:'Error',msg:result.msg
							});
							log_err(result.msg);
						};
					} catch (exception) {		
						$('#'+grid_id).datagrid('reload');	 
					}
				},
				error: function(msg){$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
			});         
		});
	}
 	function edit_item(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$("#tanggal").val(row.tanggal);
			$("#time_in").val(row.time_in);
			$("#time_out").val(row.time_out);
			$("#ot_in").val(row.ot_in);
			$("#ot_out").val(row.ot_out);
			$("#id").val(row.id);
			$("#absen_type").val(row.absen_type);
		}		
	}
 	function load_absen(){
 		var nip=$("#nip").val();
 		var periode=$("#periode").val();
		$('#dg').datagrid({url:'<?=base_url()?>index.php/payroll/absensi/data_nip/'+periode+'/'+nip});
		$('#dg').datagrid('reload');
 	}
	function submit_absen(){
		var xurl="<?=base_url()?>index.php/payroll/absensi/save";
		var nip=$("#nip").val();
		if(nip==""){alert("Pilih NIP karyawan !");return false;};
		
		var param={"nip":nip,"tanggal": $("#tanggal").val(), 
			"time_in":$("#time_in").val(),
			"time_out":$("#time_out").val(), 
			"ot_in":$("#ot_in").val(),
			"ot_out":$("#ot_out").val(),
			"id":$("#id").val(),
			"absen_type":$("#absen_type").val()
			};
		var ok=false;
		loading();
		$.ajax({type: "GET",url: xurl,data: param,
			success: function(result){
				console.log(result);
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					log_msg("Success");
					load_absen();
				}
			},
			error: function(result){
				loading_close();
				log_err("Error");
				return false;
			}			
		}); 		
		
	}
    function import_excel(){
        add_tab_parent("Import",CI_ROOT+"payroll/absensi/import");
    }
	
</script>