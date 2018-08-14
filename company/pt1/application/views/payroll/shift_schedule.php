<div class="thumbnail box-gradient">
	<?php
    $url=base_url("index.php/payroll/shift_schedule");
		
	echo link_button('Print', 'print_this()','print');		
	echo link_button('Add','','add','false',$url.'/add');		
    echo link_button('Delete','','remove','false',$url.'/delete/'.$tcid);       
	
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'shift_schedule\')','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	
	</div>
	
</div>
<?php 
    $msg=validation_errors();
    if($msg!=""){
        echo "<div class='alert alert-warning'>$msg</div>";
    }
?>
 
<div id='divCriteria' class="thumbnail col-sm-5">	
   <input type='hidden' name='mode' id='mode' value='<?=$mode?>'>
   <table class='table2' >
	<tr>
       <td>Kelompok </td><td><?=my_input3(array("field"=>"kelompok",
            "value"=>$kelompok,"button"=>true,"func"=>"dlgkelompok_show()",
            "button_add"=>true,"func_add"=>"add_kelompok()"))?>
       </td>
   </tr>
   <tr>
        <td>Dari </td><td><?=form_input_date('date_from',$date_from)?></td>
   </tr>
   <tr>
        <td>Sampai </td><td><?=form_input_date('date_to',$date_to)?></td>
    </tr>
    <tr>
       <td>Doc No# </td><td><?=my_input3(array("field"=>"tcid","value"=>$tcid))?> 
        <?=link_button("Next", "load_items()","search")?></td>
    </tr>
   </table>
    <table id="dgEmp"  class='easyui-datagrid'
          data-options="iconCls: 'icon-search',
            singleSelect: true, fitColumns: false",
            url: '<?=$url.'/employee'?>' >
        <thead>
            <tr>
               <th data-options="field:'nip',width:'80'">NIP</th>
               <th data-options="field:'nama',width:'180'">Nama Karyawan</th>
               <th data-options="field:'dept',width:'80'">Dept</th>
            </tr>
        </thead>
    </table>    
</div>   

<div id='divDetail' class='col-sm-6'  style='display:nonexx'>
    <table id="dgItem" height="500" width="100%"  class='easyui-datagrid'
          data-options="iconCls: 'icon-edit',
            singleSelect: true,toolbar: '#tbItem',fitColumns: false",
            url: '<?=$url.'/items/'?>' >
        <thead>
            <tr>
               <th data-options="field:'tanggal',width:'180'">Tanggal</th>
               <th data-options="field:'kode_shift',width:'150', editor:'text'">Shift</th>
               <th data-options="field:'id',width:'5'">Id</th>
            </tr>
        </thead>
</table>    v
</div>
 
<?php
echo $lov_employee_group;
?>
<script type="text/javascript">
    
    var _url="<?=$url?>";
    var _mode="<?=$mode?>";
    
    $(document).ready(function(){
         if(_mode=="view")load_items();
    })
    function load_items(){
        var kelompok=$("#kelompok").val();
        var nomor=$("#tcid").val();
        if(kelompok=="" ){
            alert("Pilih kelompok atau nomor !");
            return false;
        }
        $("#divDetail").fadeIn("slow");
        
        var _data="?kelompok="+kelompok+"&date1="+$("#date_from").datetimebox('getValue')
        +"&date2="+$("#date_to").datetimebox('getValue')+"&tcid="+nomor;
        
        $('#dgEmp').edatagrid({url: _url+'/employee/'+_data});        
        
        $('#dgItem').edatagrid({
            url: _url+'/items/'+_data,
            saveUrl: _url+'/item_save',
            updateUrl:_url+'/item_update',
            destroyUrl:_url+'/item_delete'
        });        
        
    }    
    function load_itemsx(){
        var nomor=$("#tcid").val();

        var _data="?kelompok="+kelompok+"&date1="+$("#date_from").datetimebox('getValue')
        +"&date2="+$("#date_to").datetimebox('getValue')+"&tcid="+nomor;

        $('#dgItem').datagrid({url:_url+'/items/'+_data});
        $('#dgItem').datagrid('reload');
    }
       
    function save_this(){
        if($('#kode').val()===''){alert('Isi kode !');return false;};

		url='<?=base_url()?>index.php/payroll/shift/save';
		loading();
			$('#frmShift').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					loading_close();
					var result = eval('('+result+')');
					if (result.success){
						$('#kode').val(result.status);
						$('#mode').val('view');
						$.messager.show({
							title:'Success',msg:'Data sudah tersimpan.'
						});
						remove_tab_parent();
					} else {
						loading_close();
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
        
        
        
    }
    function add_kelompok(){
        add_tab_parent("Kelompok",CI_ROOT+"sysvar_data/view_list/lookup.employee_group");
    }

</script>  

 
 