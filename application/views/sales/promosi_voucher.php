<div class="thumbnail box-gradient">
    <?
    $url=base_url("index.php/so/promosi_voucher");
        echo link_button("Save","simpan()","save");
        echo link_button('Print', 'cetak()','print');
        echo link_button('Add','','add','false',"$url/add");       
        echo link_button('Delete','delete_promo()','cut');        
        echo link_button('Search','','search','false',$url);     
        echo link_button('Refresh','','reload','false',"$url/view/$promosi_code");        
        echo "<div style='float:right'>";
        echo link_button('Help', 'load_help(\'promosi_voucher\')','help');        
                
    ?>  
    <a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
    <div id="mmOptions" style="width:200px;">
        <div onclick="load_help('promosi_point')">Help</div>
        <div>Update</div>
        <div>MaxOn Forum</div>
        <div>About</div>
    </div>
    </div>
</div>
<div class='col-lg-12'>
    <form id="frmMain"  method="post">
    <input type='hidden' name='mode' id='mode'  value='<?=$mode?>'>
    <table class='table'>
    <tr><td>Kode Promosi</td><td><?=form_input("promosi_code",$promosi_code,"id='promosi_code'")?></td>
        <td>Nama Promosi</td><td><?=form_input("description",$description,"id='description'")?></td></tr>
    <tr><td>Dari Tanggal</td><td><?=form_input_date("date_from",$date_from,"id='date_from'")?></td>
        <td>Sampai Tanggal</td><td><?=form_input_date("date_to",$date_to,"id='date_to'")?></td></tr>
    </table>
    </form>
</div>  
<table id="dgItem" class="easyui-datagrid" width="100%"       
data-options="iconCls: 'icon-edit',fitColumns:true,
singleSelect: true,toolbar: '#tb',
url: '<?=$url?>/load_voucher/<?=$promosi_code?>/' ">
    <thead>
        <tr>
            <th data-options="field:'voucher_no'">Nomor Voucher</th>
            <th data-options="field:'voucher_amt',align:'right'">Nilai</th>
            <th data-options="field:'tanggal_dibuat'">Dibuat</th>
            <th data-options="field:'tanggal_aktif'">Aktif</th>
            <th data-options="field:'tanggal_expire'">Expire</th>
            <th data-options="field:'status'">Status</th>
            <th data-options="field:'id'">Line</th>
        </tr>
    </thead>
</table>

<div id="tb" style="height:auto">
    <?php 
        echo "Find: ";
        echo form_input("txtSearchItem","","id = 'txtSearchItem'");    
        echo link_button('Search','load_voucher()','search');     
        echo link_button('Add', 'add_voucher()','add');     
        echo link_button('Delete', 'remove_voucher()','remove');       
        echo "<i>Data yang diload hanya 10 baris, gunakan pencarian nomor</i>";    
    ?>
</div>
    
<div id='dlgItem' class="easyui-dialog"  
style="width:600px;height:380px;padding:5px 5px"
closed="true" buttons ="#dlgItemTool">
    <form id="frmVoucher"  method="post">
        <input id='id' type='hidden'/>
        <input id='promosi_code2' name='promosi_code2' value='<?=$promosi_disc?>' type='hidden'/>
        <table class='table2' width='100%'>
            <tr>
                <td>Prefix </td><td><input name='prefix' id='prefix' style='width:80px'/></td>
            </tr>
            <tr>
                <td>Nomor Awal</td><td><input name='awal' id='awal' style='width:80px'/></td>
            </tr>
            <tr>    
                <td>Banyaknya</td><td><input name='banyak' id='banyak' style='width:80px'/></td>
            </tr>
            <tr>
                <td>Nilai</td><td><input name='voucher_amt' id='voucher_amt' style='width:180px'/></td>
            </tr>
            <tr><td>Aktif</td><td><?=form_input_date("tanggal_aktif",date("Y-m-d"),"id='tanggal_aktif'")?></td>
            <tr><td>Expire</td><td><?=form_input_date("tanggal_expire",date("Y-m-d"),"id='tanggal_expire'")?></td>
        </table>
    </form>
</div>    
<div id='dlgItemTool'>
<?php 
    echo link_button('Save', 'save_voucher()','save');     
?>    
</div>
<?php 
    echo $lookup_inventory;
    echo $lookup_category;
    echo $lookup_supplier;
    echo $lookup_merk;
    echo $lookup_model;
    echo $lookup_member_group;
?>
<script language="javascript">
    
    var page=0;

    $().ready(function(){
        void load_voucher();
    });
    
    function add_voucher() {
        var mode=$("#mode").val();
        if(mode!='view'){
            alert("Simpan dulu !");
            return false;
        }
        $("promosi_code2").val($("#promosi_code").val());
        //$('#dlgItem').window({left:100,top:window.event.clientY+20});
        $('#dlgItem').dialog('open').dialog('setTitle','Pilih');
    }
    function load_voucher(){
        var search=$("#txtSearchItem").val();
        var promosi_code=$("#promosi_code").val();
        $('#dgItem').datagrid({url:'<?=$url?>/load_voucher/'+promosi_code+'/'+search});
        $('#dgItem').datagrid('reload');
    }
    function remove_voucher(){
        var row = $('#dgItem').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
                if (r){
                    url='<?=$url?>/delete_voucher/'+row.voucher_no;
                    $.post(url,function(result){
                        if (result.success){
                            load_voucher();
                        } else {
                            $.messager.show({   // show error message
                                title: 'Error',
                                msg: result.msg
                            });
                        }
                    },'json');
                }
            });
        }       
    }
    function clear_input(){
        $("#prefix").val("");
        $("#awal").val("");
        $("#banyak").val("");
    }
    function simpan(){  
        if($('#promosi_code').val()==''){alert('Isi kode promosi !');return false;}
        if($('#description').val()==''){alert('Isi nama promosi !');return false;}
        url='<?=$url?>/save';
        $('#frmMain').form('submit',{
            url: url, onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $('#promosi_code').val(result.promosi_code);
                    $('#promosi_code2').val(result.promosi_code);                    
                    $('#mode').val('view');
                    log_msg('Data sudah tersimpan. Silahkan buat nomor vouocher');
                } else {
                    log_err(result.msg);
                }
            }
        });
    } 
    
    function save_voucher(){
        if($('#prefix').val()==''){alert('Isi prefix nomor voucher !');return false;}
        if($('#awal').val()==''){alert('Isi nomor awal voucher !');return false;}
        if($('#banyak').val()==''){alert('Isi banyaknya voucher !');return false;}
        $("#promosi_code2").val($("#promosi_code").val());
        url='<?=$url?>/save_voucher';
        $('#frmVoucher').form('submit',{
            url: url, onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    $('#dlgItem').dialog('close');
                    load_voucher();
                    clear_input()
                } else {
                    log_err(result.msg);
                }
            }
        });
    }
    
    function delete_promo(){
    $.messager.confirm('Confirm','Are you sure you want to remove this ?',
        function(r){
            if (r){
                url='<?=$url?>/delete/'+$("#promosi_code").val();
                $.post(url,function(result){
                    if (result.success){
                        remove_tab_parent();
                    } else {
                        $.messager.show({   // show error message
                            title: 'Error',
                            msg: result.msg
                        });
                    }
                },'json');
            }
        });
    }
</script>

