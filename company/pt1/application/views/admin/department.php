<legend>DEPARTMENTS</legend>
	<div class="thumbnail box-gradient">
		<form id="frmNew" method="POST">
			<table width="100%" class='table2'>
				<tr>	
					<td>Kode</td><td><?=form_input('dept_code')?></td>
					<td>Department</td><td colspan='4'><?=form_input('dept_name')?></td>
					<td><?=link_button("Tambah","add_dept()","save")?></td>
			</table>
		</form>
	</div>
	<div class="thumbnail" >
			<table class="table2" width="100%">
				<thead><tr><th>Kode</th><th>Keterangan</th>
					<th>Action</th></tr></thead>
				<tbody>
					<?     			
					$CI =& get_instance();
					
					$sql="select * from departments";
					$rst_item=$CI->db->query($sql);
					foreach($rst_item->result() as $row_item){
						echo "
						<tr><td>".$row_item->dept_code."</td>
						<td>".$row_item->dept_name."</td>
						<td>".link_button('Hapus',"del_dept('".$row_item->dept_code."')","remove")." </td></tr>
						";
					}
					?>
					<tr></tr>
				</tbody>
			</table>
	</div>
<script language="JavaScript">
	function add_dept(){
		url='<?=base_url()?>index.php/company/department_add';
			$('#frmNew').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
			            window.open(CI_ROOT+'company/department','_self');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
 	}
 	function del_dept(kode){
        xurl=CI_ROOT+'company/department_delete/'+kode;                             
        $.ajax({
            type: "GET",
            url: xurl,
            success: function(msg){
	            window.open(CI_ROOT+'company/department','_self');
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });         
 	}
	
</script>