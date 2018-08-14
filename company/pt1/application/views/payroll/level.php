<legend>EMPLOYEE LEVEL</legend>
	<div class="thumbnail box-gradient">
		<form id="frmNew" method="POST">
			<table width="100%" class='table2'>
				<tr>	
					<td>Kode</td><td><?=form_input('levelkode')?></td>
					<td>Nama Level</td><td><?=form_input('levelname')?></td>
					<td>Keterangan</td><td><?=form_input('keterangan')?></td>
					<td><?=link_button("Tambah","add_level()","save")?></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="thumbnail" >
			<table class="table2" width="100%">
				<thead><tr><th>Kode</th><th>Level Name</th><th>Keterangan</th><th>Action</th></tr></thead>
				<tbody>
					<?     			
					$CI =& get_instance();
					
					$sql="select * from employee_level";
					$rst_item=$CI->db->query($sql);
					foreach($rst_item->result() as $row_item){
						echo "
						<tr><td>".$row_item->levelkode."</td>
						<td>".$row_item->levelname."</td>
						<td>".$row_item->keterangan."</td>
						<td>".link_button('Hapus',"del_level('".$row_item->levelkode."')","remove")."
						";
					}
					?>
					<tr></tr>
				</tbody>
			</table>
	</div>
</div>
<script language="JavaScript">
	function add_level(){
		url='<?=base_url()?>index.php/payroll/payroll/employee/level_add';
			$('#frmNew').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
			            window.open(CI_ROOT+'payroll/employee/level','_self');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
 	}
 	function del_level(kode){
        xurl=CI_ROOT+'payroll/employee/level_delete/'+kode;                             
        $.ajax({
            type: "GET",
            url: xurl,
            success: function(msg){
	            window.open(CI_ROOT+'payroll/employee/level','_self');
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });         
 	}
	
</script>