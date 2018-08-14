<legend>INPUT DATA OVERTIME</legend>
<div class='row'>
<div class="col-sm-5 ">
	<form id="frmOvertime" method="POST">
	<table class='table' width='100%'>
	    
	  <tr><td>NIP</td><td><input value='<?=$nip?>' id="nip" <?=$flag1==1?'disabled':''?> 
	      onblur="cari_nip();return false;" name="nip">
	  <?php
	  if($flag1!=1) echo link_button('','lookup_employee()','search')?>
	  </td></tr>
	  <tr><td>Tanggal</td><td><input id="tanggal" name="tanggal" value="<?=$tanggal?>" class="easyui-datetimebox" 
					data-options="formatter:format_date,parser:parse_date"
					style="width:140px"></td></tr>
	  <tr><td>Jam Awal</td><td><input id="time_in" name="time_in"></td></tr>
	  <tr><td>Jam Akhir</td><td><input id="time_out" name="time_out"></td></tr>
	  <tr><td>Supervisor</td><td><input id="supervisor" name="supervisor"></td></tr>
	  <tr><td>Hari Libur</td><td><input id="hari_libur" name="hari_libur" type="checkbox"></td></tr>
	  <tr><td>&nbsp;</td></tr>
	  <tr><td  colspan='5'> <?=link_button('Simpan','add_ot()','save','false')?></td></tr>
	  <tr><td><input id="id" name="id" type="hidden"></td></tr>
	</table>
	</form>
</div>
<div class="col-sm-6 thumbnail">
   <table width='100%' class='table'>
	  <tr><td>Nama</td><td><input id="nama" name="nama" disabled value='<?=$nama?>'></td></tr>
	  <tr><td>Dept</td><td><input id="dept" name="dept" disabled value='<?=$dept?>'></td></tr>
	  <tr><td>Divisi</td><td><input id="divisi" name="divisi" disabled value='<?=$divisi?>'></td></tr>
	  <tr><td>Nip Id</td><td><input id="nip_id" name="nip_id" disabled></td></tr>
	  <tr><td>Type</td><td><input id="emptype" disabled></td></tr>
	  <tr><td>
	 
	  </td></tr>
   </table>
</div>
</div>
<div class='thumbnail'>
<table id="dg" class="easyui-datagrid"  
				style="width:auto;height:400px"
				data-options="iconCls: 'icon-edit',singleSelect: true,toolbar: '#tb', fitColumns: true,
					url: '<?=base_url()?>index.php/payroll/overtime/data/<?=$nip?>'">
				<thead>
					<tr>
						<th data-options="field:'nip',width:100">NIP</th>
						<th data-options="field:'nama',width:200">Nama</th>
						<th data-options="field:'tanggal',width:200">Tanggal</th>
						<th data-options="field:'time_in',align:'right',editor:{type:'numberbox',options:{precision:2}}">Time In</th>
						<th data-options="field:'time_out',align:'right',editor:{type:'numberbox',options:{precision:2}}">Time Out</th>
						<th data-options="field:'time_total',align:'right',editor:{type:'numberbox',options:{precision:2}}">OT Hour</th>
						<th data-options="field:'supervisor',align:'right',editor:{type:'numberbox',options:{precision:2}}">Supervsr</th>
						<th data-options="field:'time_total_calc',align:'right',editor:{type:'numberbox',options:{precision:2}}">TTC</th>
						<th data-options="field:'hari_libur',align:'right',editor:{type:'numberbox',options:{precision:2}}">Holiday</th>
						<th data-options="field:'id',align:'right'">Line</th>
						<th data-options="field:'tcid',width:200">TcId</th>
					</tr>
				</thead>
			</table>		
</div>
<?php if($flag1<>1) { ?>
<div id='tb'>
	<?=link_button("Edit","edit_row()","edit");?>
	<?=link_button("Remove	","delete_row()","remove");?>
</div>
<?php } ?>
<? include_once "employee_lookup.php" ?>
<script type="text/javascript">
	function load_overtime(){
		var row = $('#dg').datagrid('getSelected');
		if(row){
			window.open('<?=base_url()?>index.php/payroll/overtime/detail/'+row.nip,'_self');
		} else {
			alert("Pilih satu baris untuk melihat data overtime.");
		}
	}
	function cari_nip(){
		var nip=$("#nip").val();
		var url="<?=base_url()?>index.php/payroll/employee/find/"+nip;
	    $.ajax({
	                type: "GET", url: url,
	                success: function(msg){
	                    var obj=jQuery.parseJSON(msg);
	                    $('#nama').val(obj.nama);
	                    $('#nip_id').val(obj.nip_id);
	                    $('#dept').val(obj.dept);
	                    $('#divisi').val(obj.divisi);
	                    $('#emptype').val(obj.emptype);
	                },
	                error: function(msg){alert(msg);}
	    });
		
	}
    function add_ot(){
        if($('#nip').val()===''){alert('Isi NIP !');return false;};
		url='<?=base_url()?>index.php/payroll/overtime/save';
		$('#frmOvertime').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$("#nip").val('');
					$("#nama").val('');
					$("#time_in").val('');
					$("#time_out").val('');
					$("#supervisor").val('');
					$("#hari_libur").val('');
					$("#id").val(0);
					
					$('#dg').datagrid({url:'<?=base_url()?>index.php/payroll/overtime/data'});
					$('#dg').datagrid('reload');
					log_msg("Data sudah tersimpan.");
				} else {
					log_err(result.msg);
				}
			}
		});
    }
	function delete_row() {
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#id').val(row.id);
				var url="<?=base_url()?>index.php/payroll/overtime/delete/"+row.id;
				$.ajax({
							type: "GET", url: url,
							success: function(msg){
								$('#dg').datagrid({url:'<?=base_url()?>index.php/payroll/overtime/data'});
								$('#dg').datagrid('reload');
							},
							error: function(msg){alert(msg);}
				});
			}	
	}
	
 
	function edit_row()	{
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#id').val(row.id);
				var url="<?=base_url()?>index.php/payroll/overtime/get_id/"+row.id;
				$.ajax({
							type: "GET", url: url,
							success: function(msg){
								var obj=jQuery.parseJSON(msg);
								
								$('#time_in').val(obj.time_in);
								$('#time_out').val(obj.time_out);
								$('#tanggal').val(obj.tanggal);
								$('#supervisor').val(obj.supervisor);
								$('#hari_libur').val(obj.hari_libur);
								
								$('#nip').val(obj.nip);
								$('#nama').val(obj.nama);
								$('#nip_id').val(obj.nip_id);
								$('#dept').val(obj.dept);
								$('#divisi').val(obj.divisi);
								$('#emptype').val(obj.emptype);
							},
							error: function(msg){alert(msg);}
				});
			}	
	}
	
   
</script>  
			