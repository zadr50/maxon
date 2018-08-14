<?php 
    $disabled="";$disabled_edit="";
    if(!($mode=="add"))$disabled=" readonly='readonly'";
	$url=base_url()."index.php/courier/manifest";
    $dat['show_print']=true;
    echo load_view("aed_button",$dat);
    $err=validation_errors(); 
    if($err!="") echo "<div class='alert alert-warning'>$err</div>"; 
    
?>
    
<form id='frmMain' method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
   <table class='table' width="100%">
		<tr>
			<td>Nomor </td>
			<td><?php
				echo my_input3(array("field"=>'code',"value"=>$code, 
				"extra"=>"class='easyui-validatebox' 
				    data-options='required:true,	
				    validType:length[3,30]' $disabled")); 
			?></td>
            <td>Tanggal</td><td><?=form_input_date('date_mf',$date_mf)?></td>
            <td>Kendaraan</td><td><?=my_input3(array("field"=>"plat_no",
                "value"=>$plat_no,"button"=>true,"func"=>"dlgkendaraan_show()",
                "button_add"=>true,"func_add"=>"dlgkendaraan_add()"))?>
            </td>
		</tr>
		<tr>	
            <td>Pengg Jawab </td><td><?=my_input3(array("field"=>"person",
                "value"=>$person,"button"=>true,"func"=>"dlgperson_show()",
                "button_add"=>true,"func_add"=>"dlgperson_add()"))?>
            </td>
            <td>Berangkat</td><td><?=form_input_date('date_go',$date_go)?></td>
            <td>Sampai</td><td><?=form_input_date('date_to',$date_to)?></td>
        </tr>
        <tr>    
            <td>Ship Via </td><td><?php 
            $disabled="";
            if($mode=="edit")$disabled="disabled";
            echo form_dropdown("ship_via",
                array("Darat","Laut","Udara","All"),
                $ship_via,"id='ship_via' onblur='change_ship_via()' $disabled")?></td>            
            <td>Armada </td><td><?=form_input("armada",$armada,"id='armada'")?></td>            
            <td>Nama Kapal</td><td><?=my_input3(array("field"=>"nama_kapal",
                "value"=>$nama_kapal,"button"=>true,"func"=>"dlgnama_kapal_show()",
                "button_add"=>true,"func_add"=>"dlgnama_kapal_add()"))?>
            </td>
       </tr>	 
       <tr>
            <td>Keterangan</td><td colspan=6><?=form_input("keterangan",$keterangan,"id='keterangan' style='width:400px'")?></td>            
       </tr>
   </table>
<div id='tbItem'>
    <?php ///echo link_button('Add','add_item()','add');?>  
</div> 
<div class="easyui-tabs" >
	<div title="Items" style="padding:10px">
	<!-- DETAIL -->	
	<div id='divItem'>
		<table id="dgItem" class="easyui-datagrid"  width="100%"
		      data-options="iconCls: 'icon-edit',toolbar:'#tbItem',
				singleSelect: true,fitColumns: true, 
				url: '<?php 
				if($mode=="edit"){
                  echo  $url.'/items/'.$code;				    
				} else {
				  echo $url.'/booking_unprocess/'.$ship_via;  
				}				
				?>' ">
			<thead>
				<tr>
                   <?php  if($mode=="edit") { ?>
                   <th data-options="field:'book_no',width:'80px'">Book No#</th>
                   <th data-options="field:'pengirim',width:'80px'">Pengirim</th>
                   <th data-options="field:'penerima',width:'80px'">Penerima</th>
                   <th data-options="field:'jenis_barang',width:'80px'">Barang</th>
                   <th data-options="field:'banyaknya',width:'80px'">Qty</th>
                   <th data-options="field:'berat',width:'80px'">Berat</th>
                   <th data-options="field:'volume',width:'80px'">Volume</th>
                   <th data-options="field:'tujuan',width:'80px'">Tujuan</th>
                   
                   <?php } else { ?>
                   <th data-options="field:'pilih',width:'50px'">Pilih</th>  
                   <th data-options="field:'book_no',width:'80px'">Book No#</th>
                   <th data-options="field:'bk_date',width:'80px'">Tanggal</th>
                   <th data-options="field:'sender',width:'80px'">Pengirim</th>
                   <th data-options="field:'ce_name',width:'80px'">Penerima</th>
                   <th data-options="field:'content',width:'80px'">Barang</th>
                   <th data-options="field:'pcs',width:'80px'">Qty</th>
                   <th data-options="field:'weight',width:'80px'">Berat</th>
                   <th data-options="field:'volume',width:'80px'">volume</th>
                   <th data-options="field:'destination',width:'80px'">Tujuan</th>
                   <th data-options="field:'ship_type',width:'80px'">Ship Type</th>
                   <?php } ?>
                   
                   <th data-options="field:'biaya',width:'80px',align:'right' 
                   ,editor: 'numberbox',
                                options:{precision:2},
                                formatter: function(value,row,index){
                                    if(isNumber(value)){
                                        return number_format(value,2,'.',',');
                                        return value;
                                    } else {
                                        return value;
                                    }
                                  }
                   ">Biaya</th>                    
                   
                   <th data-options="field:'id',width:'30px'">Id</th>
                   
                   
				</tr>
			</thead>
		</table>
	<!-- END DETAIL -->
	</div>	
	</div>
</div>

</form>

<?php 
echo $lov_kendaraan;
echo $lov_person;
echo $lov_nama_kapal;

?>

<script type="text/javascript">
	var _url="<?=$url?>";	
	function valid(){
	    var field=['code'];
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
        if(!valid()){alert("Isi nomor !");return false;}
		url=_url+'/save';
				
		$('#frmMain').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
                   window.open(_url+"/view/"+result.code,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
    }
	function print_aed(){
	    nomor=$("#code").val();
		window.open(_url+'/print_nomor/'+nomor,'_blank');
	}
	function add_aed(){
	    window.open(_url+'/add','_self');
	}	
	function delete_aed()
	{
	    var nomor=$('#code').val();
		$.ajax({
				type: "GET",
				url: _url+"/delete/"+nomor,
				data: "",
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
        var nomor=$('#code').val();
        window.open(_url+'/view/'+nomor,'_self');	    
	}
	function change_ship_via(){
	    var ship_type=$("#ship_via").val();
        $('#dgItem').datagrid({url:_url+'/booking_unprocess/'+ship_type});
        $('#dgItem').datagrid('reload');	    
	}
    function dlgnama_kapal_add(){
        add_tab_parent("Nama Kapal",CI_ROOT+"sysvar_data/view_list/lookup.nama_kapal");
    }
    function dlgkendaraan_add(){
        add_tab_parent("Kendaraan",CI_ROOT+"sysvar_data/view_list/lookup.kendaraan");
    }
    function dlgperson_add(){
        add_tab_parent("Supir",CI_ROOT+"sysvar_data/view_list/lookup.person");
    }
	
</script>
    
