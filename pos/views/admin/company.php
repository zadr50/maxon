<legend>PERUSAHAAN</legend> 
<div class="thumbnail">	
   <?php echo validation_errors(); ?>
   <?php 
   		if($mode=='view'){
			echo form_open('company/update');
			$disabled='disable';
		} else {
			$disabled='';
   			echo form_open('company/add'); 
   		}
		
   ?> 
   
   <table class='table' width="100%">
	<tr>
		<td>Kode</td><td>
		<?php
		if($mode=='view'){
		    $readonly=" readonly";
		} else {
		    $readonly=""; 
		}		
        echo form_input('company_code',$company_code," $readonly");
        
		?></td>
		
	</tr>	 
       <tr>
            <td>Nama Perusahaan</td><td><?php echo form_input('company_name',$company_name,
            'style="width:200px"');?></td>

       </tr>
	<tr>	 
		<td>Alamat</td><td><?php echo form_input('street',
                        $street,'style="width:90%"');?></td>		 
	</tr>
	<tr><td>Kota</td><td><?php echo form_input('city_state_zip_code',
                        $city_state_zip_code,'style="width:300px"');?></td></tr>
	<tr><td>Telp</td><td><?php echo form_input('phone_number',
                        $phone_number,'style="width:300px"');?></td></tr>
	<tr><td>Fax</td><td><?php echo form_input('fax_number',
                        $fax_number,'style="width:300px"');?></td></tr>
	<tr><td>Email</td><td><?php echo form_input('email',
                        $email,'style="width:300px"');?></td></tr>
      	
	 <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="Save" class='btn btn-info'/></td></tr>
		
   </table>
   </form>
   
   <div id='divOutlet'>
		<div id='tb' name='tb' class='box-gradient'>
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addItem();return false;">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem();return false;">Edit</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteItem(); return false;">Delete</a>	
		</div>
   		<?php
   			echo browse2("select code,toko_name,address,contact,phone,fax
   			 from toko_master where code_company='".$company_code."'",
   			 "Daftar toko terkait perusahaan ini","company/toko");
   		?>
   </div>
   
 </div>
 <div id='dgItem' class="easyui-dialog" style="width:600px;height:480px;
	left:100px;top:20px;padding:5px 5px"
    closed="true" buttons="#btnItem" >
	<?php 
    echo $this->form_builder->open_form(array('id' => 'frmItem','action'=>''));
    echo $this->form_builder->build_form_horizontal(array(
        array(
            'id' => 'code','label'=>'Kode Toko',
            'placeholder' => 'Kode toko' 
        ),
        array(
            'id' => 'toko_name','label'=>'Nama Toko',
            'placeholder' => 'Nama Toko'
        ),
        array(
            'id' => 'address','label'=>'Alamat'
        ),
        array(
            'id' => 'phone','label'=>'Telpon'
        ),
        array(
            'id' => 'contact','label'=>'Penanggung Jawab'
        ),
        array('id'=>'company_code_item','type'=>'input','value'=>$company_code) 
    ));
    echo $this->form_builder->close_form();
	?>
</div>
<div id='btnItem'>
	<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
	   plain='false'	onclick='save_item()'>Simpan</a>
</div>

<script language="JavaScript">
	var mode='<?=$mode?>';
	function addItem(){
		if(mode=="add"){
			alert("Simpan dulu sebelum tambah !");
			return false;
		}
		//$('#dgItem').window({left:100,top:window.event.clientY+20});
		$("#dgItem").dialog("open").dialog('setTitle','Input kode toko');
	}
	function close_item(){
		clear_input();
		$("#dgItem").dialog("close");	
	}
	function clear_input(){
		$("#code").val("");
		$("#toko_name").val("");
		$("#address").val("");
		$("#contact").val("");		$("#phone").val("");
	}
 	function save_item(){
		if(mode=="add"){alert("Simpan dulu nomor ini !");return false;}
		var url = '<?=base_url()?>index.php/company/toko_add';
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#dg').datagrid('reload');
					clear_input();
					$("#dgItem").dialog("close");						
					$.messager.show({
						title: 'Success',
						msg: 'Success'
					});
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
 </script>
