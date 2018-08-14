<?php 
    $disabled="";$disabled_edit="";
    if(!($mode=="add" or $mode=="edit"))$disabled=" disabled";
    if($mode=="edit")$disabled_edit=" disabled";
	$url=base_url()."index.php/courier/zone";
    echo load_view("aed_button");
    $err=validation_errors(); 
    if($err!="") echo "<div class='alert alert-warning'>$err</div>"; 
    
?>
    
<form id='frmMain' method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
   <table class='table' width="100%">
       <tr><td>Code </td><td><?=my_input3(array("field"=>"code","value"=>$code))?></td></tr>
       <tr><td>Zone Name </td><td><?=my_input3(array("field"=>"zone_name","value"=>$zone_name,
            "extra"=>"style='width:400px'"))?></td></tr>
       <tr><td>Id </td><td><?=my_input3(array("field"=>"id","value"=>$id))?></td></tr>     
   </table>
</form>
 
<?php if($mode=="edit") { ?> 
    
<div class="easyui-tabs" >
    <div title="Items" style="padding:10px">
    <!-- DETAIL --> 
    <div id='divItem'>
        <table id="dgItem" class="easyui-datagrid"  width="100%"
              data-options="iconCls: 'icon-edit',
                singleSelect: true,toolbar: '#tbItem',fitColumns: true, 
                url: '<?=$url.'/items/'.$code?>' ">
            <thead>
                <tr>
                    <?=grid_fields("zone_detail","city_code,city_name,id")?>
                </tr>   
            </thead>
        </table>
    <!-- END DETAIL -->
    </div>  
    </div>
</div>
<div id="tbItem" class="box-gradient">
    <?=link_button('Add','add_item()','add');   ?>  
    <?=link_button('Refresh','load_item()','reload');   ?>  
    <?=link_button('View','view_item()','edit');    ?>  
    <?=link_button('Delete','delete_item()','remove');    ?>  
</div>

<div id='dlgItem' class="easyui-dialog"  background='black'
 closed="true"  buttons="#btnItem">
   <form id='frmItem' method="post">
   <table class='table' width="100%">
        <tr>
            <td>City Code </td><td><?=my_input3(array("field"=>"city_code",
                "button"=>true,"func"=>"dlgcity_show()"))?>
            </td>
        </tr>
        <tr>
            <td>City Name </td><td><?=form_input("city_name","","id='city_name'")?></td>                
        </tr>
        <tr>    
            <td>Zone Code </td><td><?=form_input("zone_code",$code)?></td>                
        </tr>
        <tr>    
            <td>Id </td><td><?=form_input("id","","id='id'")?></td>                
        </tr>
   </table>
   </form> 
</div>
<div id="btnItem" class='box-gradient'>
    <?=link_button('Submit','save_item()','save');?>  
</div>

<?php } ?>
 
<?php 
echo $lov_city;
?>

<script type="text/javascript">
	var _url="<?=$url?>";	
	function valid(){
	    var field=['code','zone'];
	    var ret=true;
	    for(i=0;i<field.length;i++){
	        if($("#"+field[i]).val()==''){
	            ret=false;
	            break;
	        }
	    }
	    return ret;
	}
    function save_aed(){
        if(!valid()){alert("Isi zone tujuan!");return false;}
		url=_url+'/save';
		$('#frmMain').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
				    $("#mode").val("edit");
					log_msg('Data sudah tersimpan.');
					window.open(CI_ROOT+"courier/zone/view/"+result.id,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
    }
	function print_aed(){ 
	}
	function add_aed(){
	    window.open(_url+'/add','_self');
	}	
	function delete_aed()
	{
	    var id=$('#id').val();
		$.ajax({url: _url+"/delete/"+id,
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						remove_tab_parent();
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}
	function edit_aed(){
	    
	}
	function refresh_aed(){
        var nomor=$('#id').val();
        window.open(_url+'/view/'+nomor,'_self');	    
	}
    function add_item(){
        $('#dlgItem').dialog('open').dialog('setTitle','Add Item');
    }
    function valid_item(){
        var field=['city_code'];
        var ret=true;
        for(i=0;i<field.length;i++){
            if($("#"+field[i]).val()==''){
                ret=false;
                break;
            }
        }
        return ret;
    }
    function save_item(){
        if(!valid_item()){alert("Isi item qty,berat !");return false;}
        url=_url+'/items/save';
        $('#frmItem').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $("#dlgItem").dialog("close");
                    load_item();
                    log_msg('Data sudah tersimpan. Silahkan isi detail barang.');
                } else {
                    log_err(result.msg);
                }
            }
        });
    }
    function load_item(){
        var nomor=$("#code").val();
        $('#dgItem').datagrid({url:_url+'/items/'+nomor});
        $('#dgItem').datagrid('reload');
    }
    function delete_item(){
        var row = $('#dgItem').datagrid('getSelected');
        if (row){
            $.ajax({url: _url+"/items/delete/"+row.id,
                success: function(result){
                    var result = eval('('+result+')');
                    if(result.success){
                        load_item();
                    }
                }
            })
        };                 
    }
	 
</script>
    
