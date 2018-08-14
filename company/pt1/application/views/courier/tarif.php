<?php 
    $disabled="";$disabled_edit="";
    if(!($mode=="add" or $mode=="edit"))$disabled=" disabled";
    if($mode=="edit")$disabled_edit=" disabled";
	$url=base_url()."index.php/courier/tarif";
    echo load_view("aed_button");
    $err=validation_errors();
    if($err!="") echo "<div class='alert alert-warning'>$err</div>";
?>
    
<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
   <div title="Tarif Zone" id="box_section" style="padding:10px">
       
    <form id='frmMain' method="post">
    <input type='hidden' name='mode' id='mode'  value='<?=$mode?>'>
   <table class='table' width="100%">
		<tr>
            <td>Zone To </td><td><?=my_input3(array("field"=>"zone_to",
                "value"=>$zone_to,"button"=>true,"func"=>"dlgzone_show()",
                "button_add"=>true,"func_add"=>"add_zone()"))?>
            </td>
            <td>Darat Berat </td><td><?=my_input3(array("field"=>"tarif","value"=>$tarif))?></td>
		</tr>
		<tr>	
            <td>Service </td><td><?=my_input3(array("field"=>"service",
                "value"=>$service,"button"=>true,"func"=>"dlgservice_show()",
                "button_add"=>true,"func_add"=>"add_service()"))?>
            </td>
            <td>Darat Volume </td><td><?=my_input3(array("field"=>"tarif_darat_vol","value"=>$tarif_darat_vol))?></td>
        </tr>
        <tr>    
            <td>Laut Berat </td><td><?=my_input3(array("field"=>"tarif_laut","value"=>$tarif_laut))?></td>
            <td>Udara Berat </td><td><?=my_input3(array("field"=>"tarif_udara","value"=>$tarif_udara))?></td>
       </tr>	 
       <tr>
            <td>Laut Volume </td><td><?=my_input3(array("field"=>"tarif_laut_vol","value"=>$tarif_laut_vol))?></td>
            <td>Udara Volume </td><td><?=my_input3(array("field"=>"tarif_udara_vol","value"=>$tarif_udara_vol))?></td>
       </tr>     
       <tr>
            <td>Max Day </td><td><?=my_input3(array("field"=>"max_day","value"=>$max_day))?></td>
            <td>Id </td><td><?=my_input3(array("field"=>"id","value"=>$id))?></td>
       </tr>     
   </table>
    </form>
    </div>
    <div title="Tarif Customer" id='box_section' style="padding:10px;" class='section_hide'>
        <?php include_once("tarif_customer.php");?>
    </div>
</div>        
<?php 
echo $lov_zone_to;
echo $lov_service;
?>

<script type="text/javascript">
	var _url="<?=$url?>";	
	function valid(){
	    var field=['zone_to'];
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
				    $("#mode").val("view");
					log_msg('Data sudah tersimpan.');
					remove_tab_parent();
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
	function add_zone(){
	    add_tab_parent("Zone",CI_ROOT+"courier/zone");
	}
	function add_service(){
	    add_tab_parent("Service",CI_ROOT+"sysvar_data/view_list/lookup.service");
	}
</script>
    
