<legend>WILAYAH PEMASARAN SALESMAN</legend>
	<div class="thumbnail box-gradient">
		<form id="frmNew" method="POST">
			<table width="100%" class='table2'>
				<tr>	
					<td>Kode Wilayah</td><td><?=form_input('kode')?></td>
					<td>Nama Wilayah</td><td colspan='4'><?=form_input('wilayah')?></td>
					<td><?=link_button("Tambah","add_wilayah()","save")?></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="thumbnail" >
			<table class="table" width="100%">
				<thead><tr><th>Kode</th><th>Nama Wilayah</th>
					<th>Action</th></tr></thead>
				<tbody>
					<?php     			
					$CI =& get_instance();
					
					$sql="select * from wilayah";
					$rst_item=$CI->db->query($sql);
					foreach($rst_item->result() as $row_item){
						echo "
						<tr><td>".$row_item->kode."</td>
						<td>".$row_item->wilayah."</td>
						<td>".link_button('Hapus',"del_wilayah('".$row_item->kode."')","remove")."</td></tr>
						";
					}
					?>
					<tr></tr>
				</tbody>
			</table>
	</div>

<script language="JavaScript">
	function add_wilayah(){
		url='<?=base_url()?>index.php/company/wilayah_add';
			$('#frmNew').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
			            window.open(CI_ROOT+'company/wilayah','_self');
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
 	}
 	function del_wilayah(kode){
        xurl=CI_ROOT+'company/wilayah_delete/'+kode;                             
        $.ajax({
            type: "GET",
            url: xurl,
            success: function(msg){
	            window.open(CI_ROOT+'company/wilayah','_self');
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });         
 	}
	
</script>