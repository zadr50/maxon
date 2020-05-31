<div class="thumbnail box-gradient" id='aed_button'>
	<?php echo load_view("aed_button.php");?>
</div>
<div class="thumbnail">	
	<form id="myform"  method="post" role="form">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<input type='hidden' name='id' id='id'	value='<?=$id?>'>
	
	<?php 
		$msg=validation_errors();
		if($msg!="") echo "<div class='alert alert-info'>".validation_errors()."</div>"; 
		$readonly="";
	?>
	<div class="easyui-tabs">
		<div title="General" style="padding:10px">
			<table class="table" width="100%">
		    <tr>
		    	<td>Jenis Ticket</td><td><?=form_input("ticket_type",$ticket_type,"id=ticket_type $readonly")?></td>
		  		<td>Keterangan</td><td><?=form_input("description",$description,"id=description style='width:300px'")?></td>  		
		  	</tr>
		  	<tr>
		  	</tr>
		  	<tr>
		  		<td>Harga Rp</td><td><?=form_input("price",$price,"id=price")?></td>
		  		<td>Aktif ?</td><td><?=form_checkbox("active",1,$active,"id=active")?></td>  		
		  	</tr>
		  	<tr>
		  	</tr>
		    <tr>
		         <td>Percent(%)</td><td><?=form_input("prc1",$prc1)?></td>
		         <td>Akun Penjualan</td><td><?php echo form_input('coa1',$coa1,'id=coa1  style="width:300px" ' );?>
		             <?=link_button("", "dlgcoa1_show()","search","false","","Cari")?>
			     </td>
		    </tr>
		  	<tr>
		         <td>Percent(%)</td><td><?=form_input("prc2",$prc2)?></td>
		         <td>Akun Penjualan</td><td><?php echo form_input('coa2',$coa2,'id=coa2  style="width:300px"  ' );?>
		             <?=link_button("", "dlgcoa2_show()","search","false","","Cari")?>
			     </td>
		  	</tr>
			<tr>
		         <td>Percent(%)</td><td><?=form_input("prc3",$prc3)?></td>
		         <td>Akun Penjualan</td><td><?php echo form_input('coa3',$coa3,'id=coa3  style="width:300px"  ' );?>
		             <?=link_button("", "dlgcoa3_show()","search","false","","Cari")?>
			     </td>
		  	</tr>
		  	<tr>
		         <td>Percent(%)</td><td><?=form_input("prc4",$prc4)?></td>
		         <td>Akun Penjualan</td><td><?php echo form_input('coa4',$coa4,'id=coa4  style="width:300px"  ' );?>
		             <?=link_button("", "dlgcoa4_show()","search","false","","Cari")?>
			     </td>
		    </tr>
		    <tr>
		         <td>Percent(%)</td><td><?=form_input("prc5",$prc5)?></td>
		         <td>Akun Penjualan</td><td><?php echo form_input('coa5',$coa5,'id=coa5  style="width:300px"  ' );?>
		             <?=link_button("", "dlgcoa5_show()","search","false","","Cari")?>
			     </td>
		  	</tr>
	      </table>
	 </div> <!-- GENERAL TAB -->
	
	
	</form>
</div>   
 
<?=$lookup_coa1?>
<?=$lookup_coa2?>
<?=$lookup_coa3?>
<?=$lookup_coa4?>
<?=$lookup_coa5?>

<script>
	function refresh_aed(){
		var id=$("#id").val();
		var url=CI_ROOT+"ticketing/ticket_type/view/"+id;
		window.open(url,"_self");
	}
  	function save_aed(){
  		if($('#ticket_type').val()==''){log_err('Isi kode atau jenis ticket !');return false;}  		
//		$("#aed_button_save").linkbutton('disable');
		var url='<?=base_url()?>index.php/ticketing/ticket_type/save';
		
		$('#myform').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$("#mode").val("view");
					$("#id").val(result.id);
					log_err('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});
  	}	
  	function delete_aed(){
  		var id=$("#id").val();
  		if(id!="" || id!="0"){
				$.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
					if(!r)return false;
	                var xurl_delete=CI_ROOT+'ticketing/ticket_type/delete/'+id;                             
	                xparam='';
	                loading();
	                $.ajax({
	                        type: "GET",
	                        url: xurl_delete,
	                        param: xparam,
	                        success: function(result){
							try {
									var result = eval('('+result+')');
									if(result.success){
										loading_close();
										log_msg(result.msg);
										remove_tab_parent();
									} else {
										loading_close();
										log_err(result.msg);
									};
								} catch (exception) {		
								}
	                        },
	                        error: function(msg){log_err("Error");
	                        	$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
	                });         
  			})
  		}
  	}
  	function print_aed(){
  	}  	
</script>	
   