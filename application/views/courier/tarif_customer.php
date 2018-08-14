        <table id='dgCust' name='dgCust' class="easyui-datagrid"  
            data-options="iconCls: 'icon-search', fitColumns: true,
                singleSelect: true,  
                url: '<?=$url.'/customer/load/'.$zone_to?>',
                toolbar:'#dgCustTool',
            " width="100%">
            <thead>
                <tr>
                    <th data-options="field:'cust_name',width:180">Customer</th>
                    <th data-options="field:'cust_no',width:80">Cust Code</th>
                    <th data-options="field:'service',width:80">Service</th>
                    <th data-options="field:'rate',width:80,align:'right'">Darat Wg</th>
                    <th data-options="field:'darat_vol',width:80,align:'right'">Darat Vol</th>
                    <th data-options="field:'laut_wg',width:80,align:'right'">Laut Wg</th>
                    <th data-options="field:'laut_vol',width:80,align:'right'">Laut Vol</th>
                    <th data-options="field:'udara_wg',width:80,align:'right'">Udara Wg</th>
                    <th data-options="field:'udara_vol',width:80,align:'right'">Udara Vol</th>
                    <th data-options="field:'darat_wg_min',width:80,align:'right'">Min Wg</th>
                    <th data-options="field:'darat_vol_min',width:80,align:'right'">Min Vol</th>
                    <th data-options="field:'id',width:80">Id</th>
                </tr>
            </thead>
        </table>        
<div id="dgCustTool">
    <?php
    echo link_button('Add','add_cust()','add');
    echo link_button('Edit','edit_cust()','edit');
    echo link_button('Remove','del_cust()','remove');
    echo link_button('Refresh','load_cust()','reload');
    echo " Find: ".my_input3(array("field"=>"find"));    
    echo link_button('','find_cust()','search');
    ?>
</div>
<div id='dlgCust' class="easyui-dialog"  closed="true" buttons="#btnDlgCust">
        <form id='frmCust' method="post">
        <input type='hidden' name='id' id='id_cust' >
        <table class='table'>
            <tr>
            <td>Customer</td><td><?=my_input3(array("field"=>"cust_no",
                "value"=>"","button"=>true,"func"=>"dlgcustomers_show()"))?>
                <br><span id='nama_cust'></span>
            </td>
            <td>Service</td><td><?=my_input3(array("field"=>"service","id"=>"service2",
                "value"=>"","button"=>true,"func"=>"dlgservice2_show()"))?>
            </td>
            </tr>
            <tr>
            <td>Tarif Darat Berat</td><td><?=my_input3(array("field"=>"darat_wg"))?></td>
            <td>Darat Volume</td><td><?=my_input3(array("field"=>"darat_vol"))?></td>
            </tr>
            <tr>
            <td>Laut Berat</td><td><?=my_input3(array("field"=>"laut_wg"))?></td>
            <td>Laut Volume</td><td><?=my_input3(array("field"=>"laut_vol"))?></td>
            </tr>
            <tr>
            <td>Udara Berat</td><td><?=my_input3(array("field"=>"udara_wg"))?></td>
            <td>Udara Volume</td><td><?=my_input3(array("field"=>"udara_vol"))?></td>
            </tr>
            <tr>
            <td>Minimum Berat</td><td><?=my_input3(array("field"=>"darat_wg_min"))?></td>
            <td>Minimum Volume</td><td><?=my_input3(array("field"=>"darat_vol_min"))?></td>
            </tr>
            <tr>
        </table>
        </form>
    </div>   
<div id="btnDlgCust">
    <?php
    echo link_button('Submit','save_cust()','save');
    ?>
</div>
<?php echo $lov_customer; 
echo $lov_service2;
?>  
<script type="text/javascript">
    
    var _url="<?=$url?>";   
    var _zone="<?=$zone_to?>";
    var _mode="<?=$mode?>";
    function load_cust(){        
        var find=$("#find").val();
        $('#dgCust').datagrid({url:_url+"/customer/load/"+_zone+'/'+find});
        $('#dgCust').datagrid('reload');        
    }
    function add_cust(){
        if(_mode!="edit"){
            alert("Simpan dulu zone ini !");return false;
        }
        $('#dlgCust').dialog('open').dialog('setTitle','Tarif Customer');        
    }
    function save_cust(){
        if($("#cust_no").val()==""){alert("Pilih customer !");return false;}
        if($("#service").val()==""){alert("Pilih service !");return false;}
        url=_url+'/customer/save/'+_zone;
        $('#frmCust').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $("#dlgCust").dialog("close");
                    log_msg('Data sudah tersimpan.');
                    load_cust();
                } else {
                    log_err(result.msg);
                }
            }
        });        
    }
    function edit_cust(){
        var row = $('#dgCust').datagrid('getSelected');
        if (row){
            $("#cust_no").val(row.cust_no);
            $("#nama_cust").html(row.cust_name);
            $("#service2").val(row.service);
            $("#darat_wg").val(row.rate);
            $("#darat_vol").val(row.darat_vol);
            $("#laut_wg").val(row.laut_wg);
            $("#laut_vol").val(row.laut_vol);
            $("#udara_wg").val(row.udara_wg);
            $("#udara_vol").val(row.udara_vol);
            $("#darat_wg_min").val(row.darat_wg_min);
            $("#darat_vol_min").val(row.darat_vol_min);
            $("#id_cust").val(row.id);            
            $('#dlgCust').dialog('open').dialog('setTitle','Tarif Customer');        
        }
        
    }
    function del_cust(){
        var row = $('#dgCust').datagrid('getSelected');
        if (row){
            var id=row.id;
            $.ajax({url: _url+"/customer/delete/"+id,
                    success: function(result){
                        var result = eval('('+result+')');
                        if(result.success){
                            $.messager.show({
                                title:'Success',msg:result.msg
                            }); 
                            load_cust();
                        } else {
                            $.messager.show({
                                title:'Error',msg:result.msg
                            });                         
                        };
                    },
                    error: function(msg){alert(msg);}
            });                 
        }
    }
    function find_cust(){
        load_cust();
    }
    function add_cust_master(){
        add_tab_parent("Customer","<?=base_url('index.php/customers/add')?>");
    }
</script>