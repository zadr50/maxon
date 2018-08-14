<div class="thumbnail box-gradient">
    <?php
    if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/company/view/'.$company_code);        
    echo "<div style='float:right'>";
    echo link_button('Help', 'load_help(\'banks\')','help');        
    
    ?>
    <a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
    <div id="mmOptions" style="width:200px;">
        <div onclick="load_help('banks')">Help</div>
        <div onclick="show_syslog('company','<?=$company_code?>')">Log Aktifitas</div>
        <div>Update</div>
        <div>MaxOn Forum</div>
        <div>About</div>
    </div>
</div>

<div class="thumbnail">	
   <?php 
   echo validation_errors(); 
   
	if($mode=='view'){
		echo form_open('company/update'," name='myform' id='myform' ");
		$disabled='disable';
	} else {
		$disabled='';
		echo form_open('company/add'," name='myform' id='myform' "); 
	}
		
   ?> 
   <div class="easyui-tabs" >
    <div title="General" style="padding:10px">
       <table class='table' width="100%">
    	<tr>
    		<td>Kode</td>
    		<td>
    		<?php
    		if($mode=='view'){
    			echo "<strong>$company_code</strong>";
    			echo form_hidden('company_code',$company_code," id='company_code' ");
    		} else { 
    			echo form_input('company_code',$company_code," id='company_code' ");
    		}		
    		?>
    		</td>
    		
    	</tr>	 
        <tr>
                <td>Nama Perusahaan</td>
                <td><?php 
                echo form_input('company_name',$company_name,
                "id='company_code' style='width:200px' ");
                ?>
                </td>
    
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
    	<tr><td><?=link_button('Save', 'save_this()','save'); ?></td>
        </tr>	
       </table>
       </form>
   
    </div>
    
    <div title="Outlet">
    
       <div id='divOutlet'>
            <div id='tb' name='tb' class='box-gradient'>
                <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem();return false;">Add</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem();return false;">Edit</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem(); return false;">Delete</a>  
            </div>
            <?php
                $sql="select code,toko_name,address,contact,phone,fax,id
                from toko_master where code_company='$company_code'";
                
                echo browse2($sql,"Daftar toko terkait perusahaan ini","company/toko",
                    0,50,'','asc','','',$company_code);
            ?>
       </div>
    
    </div>
    
    <div title="Seting Account Link">
        <div class='thumbnail'>
            <?php 
            $data=$this->company_model->setting_data($company_code);
            echo load_view('admin/gl_link',$data); ?>
        </div>
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
	function save_this(){
        if($('#company_code').val()===''){alert('Isi dulu kode perusahaan !');return false;};
        if($('#company_name').val()===''){alert('Isi dulu nama perusahaan !');return false;};
        $('#myform').submit();
	    
	}
	function addItem(){
		if(mode=="add"){
			alert("Simpan dulu sebelum tambah !");
			return false;
		}
		//$('#dgItem').window({left:100,top:window.event.clientY+20});
		$("#dgItem").dialog("open").dialog('setTitle','Input kode toko');
	}
   function editItem(){
    }
    function deleteItem(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
                    if(!r)return false;
                    xurl=CI_ROOT+'company/toko/delete/'+row['id'];                             
                    xparam='';
                    $.ajax({
                            type: "GET",
                            url: xurl,
                            param: xparam,
                            success: function(result){
                            try {
                                    var result = eval('('+result+')');
                                    if(result.success){
                                        $.messager.show({
                                            title:'Success',msg:result.msg
                                        });
                                        $('#dg').datagrid('reload');   
                                    } else {
                                        $.messager.show({
                                            title:'Error',msg:result.msg
                                        });
                                        log_err(result.msg);
                                    };
                                } catch (exception) {       
                                    $('#dg').datagrid('reload');   
                                }
                            },
                            error: function(msg){$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
                    });         
                });
        }
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
