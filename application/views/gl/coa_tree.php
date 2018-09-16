<div class='thumbnail'>
    <?php
    echo link_button('Print','','print','false',base_url().'index.php/coa/print');      
    echo link_button('Import','','more','false',base_url().'index.php/coa/import');
    echo link_button('List','','more','false',base_url()."index.php/coa/browse");
    $arJenis=array("1"=>"1. Aktiva","2"=>"2. Pasiva","3"=>"3. Modal","4"=>"4. Penjualan",
    "5"=>"5. Pembelian","6"=>"6. Biaya","7"=>"7. Pendapatan Lainnya","8"=>"8. Biaya Lainya");
    
    echo "Type: &nbsp ".form_dropdown("coa_type",$arJenis,$coa_type,"id='coa_type' style='width:200px'");
    echo link_button('Refresh','on_refresh()','reload');      
          
    echo "<div style='float:right'>";
    echo link_button('Help', 'load_help()','help');     
    ?>
    
    <a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',
        iconCls:'icon-tip',plain:false">Options</a>
    <div id="mmOptions" style="width:200px;">
        <div onclick="load_help()">Help</div>
        <div>Update</div>
        <div>MaxOn Forum</div>
        <div>About</div>
    </div>
    <?=link_button("Close", "remove_tab_parent();return false","cancel")?>
    </div>
</div>
    <div class="thumbnail">
        <ul id='tt' class="easyui-tree"
            data-options="url:'<?=base_url()?>index.php/coa/loadlist/<?=$coa_type?>',
            animate:true,
            onContextMenu: function(e,node){
                e.preventDefault();
                _top=e.pageY; _left=e.pageX;
                $(this).tree('select',node.target);
                $('#mm').menu('show',{
                    left: e.pageX,
                    top: e.pageY
                });
            }
            
            ">
        </ul>
    </div>

<div id="mm" class="easyui-menu" style="width:200px;">
    <div onclick="change()" data-options="iconCls:'icon-edit'">Change</div>
    <div onclick="append_group()" data-options="iconCls:'icon-add'">Append Group</div>
    <div onclick="append_account()" data-options="iconCls:'icon-add'">Append Account</div>
    <div onclick="remove()" data-options="iconCls:'icon-remove'">Remove</div>
</div>

<div id='dlgCoa' class="easyui-dialog"  style="width:400px;height:300px;"
     closed="true"  buttons="#tbCoa">
    <?=form_open('',"id='frmCoa'");?>
    <div style='padding:10px'>
    <table>
        <tr><td>Account</td><td><?=form_input("account","","id='account'")?></td></tr>
        <tr><td>Account Description</td><td><?=form_input("account_description",'',"id='account_description' style='width:200px'")?></td></tr>
        <tr><td>Normal (DB/CR)</td><td><?=form_input("db_or_cr","","id='db_or_cr'")?>
               <br><i>0 - Debit, 1 - Credit</i>
        </td></tr>
        <tr><td>Begining Balance</td><td><?=form_input("beginning_balance","","id='beginning_balance'")?></td></tr>
        <tr><td>Account Type</td><td><?=form_input("account_type","","id='account_type'")?></td></tr>
        <tr><td>Group Type</td><td><?=form_input("group_type","","id='group_type'")?></td></tr>
        <input type='hidden' name='mode' id='mode'>
    </table>
    <?=form_close();?>
    </div>
</div>
<div id='tbCoa'>
    <?=link_button('Save','save_coa()','save')?>
</div>
<div id='dlgGroup' class="easyui-dialog"  style="width:400px;height:300px;"
     closed="true"  buttons="#tbGroup">
    <?=form_open('',"id='frmGroup'");?>
    <div style='padding:10px'>
    <table>
        <tr><td>Group Type</td><td><?=form_input("group_type",'',"id='group_type2'")?></td></tr>
        <tr><td>Group Name</td><td><?=form_input("group_name",'',"id='group_name' style='width:200px'")?></td></tr>
        <tr><td>Parent Group Type</td><td><?=form_input("parent_group_type","","id='parent_group_type'")?></td></tr>
        <tr><td>Account Type</td><td><?=form_input("account_type","","id='account_type2'")?></td></tr>
        <input type='hidden' name='mode_group' id='mode_group'>
    </table>
    <?=form_close();?>
    </div>
</div>
<div id='tbGroup'>
    <?=link_button('Save','save_group()','save')?>
</div>


<script language="javascript">
    
    var _top=0, _left=0;
    
    function save_coa() {
        if($('#account').val()==''){alert('Isi Account !');return false;}
        url='<?=base_url()?>index.php/coa/save';
            $('#frmCoa').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                        $("#mode").val("view");
                        $('#dlgCoa').dialog('close');
                        log_msg('Data sudah tersimpan. Tekan refresh bila diperlukan.');
                    } else {
                        log_err(result.msg);
                    }
                }
            });     
    }
    function save_group() {
        if($('#group_type2').val()==''){alert('Isi group type !');return false;}
        url='<?=base_url()?>index.php/coa/save_group';
            $('#frmGroup').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                        $("#mode_group").val("view");
                        $('#dlgGroup').dialog('close');
                        log_msg('Data sudah tersimpan. Tekan refresh bila diperlukan.');
                    } else {
                        log_err(result.msg);
                    }
                }
            });     
    }
 
    function change() {
        var node = $('#tt').tree('getSelected');
        var ga_type=node.id.substring(0,2);
        var ga_id=node.id.substring(2,30);
        console.log(ga_type+","+ga_id);
        
        $("#mode").val('view');
        if(ga_type=="G_"){
            xurl=CI_ROOT+'coa/find_group/'+ga_id;
            dlg="#dlgGroup";
            title="Change Group";            
        } else {
            xurl=CI_ROOT+'coa/find/'+ga_id;            
            dlg="#dlgCoa";
            title="Change Account";
        }
        loading();
        $.ajax({
            type: "GET",
            url: xurl,
            data:'',
            success: function(msg){
                loading_close();
                var obj=jQuery.parseJSON(msg);
                if(ga_type=="G_"){
                    $('#group_type2').val(obj.group_type);
                    $('#group_name').val(obj.group_name);
                    $('#account_type2').val(obj.account_type);
                    $('#parent_group_type').val(obj.parent_group_type);
                    
                } else {
                    $('#account').val(obj.account);
                    $('#account_description').val(obj.account_description);
                    $('#db_or_cr').val(obj.db_or_cr);
                    $('#beginning_balance').val(obj.beginning_balance);
                    $('#group_type').val(obj.group_type);
                    $('#account_type').val(obj.account_type);
                    $('#id').val(obj.id);
                }
            },
            error: function(msg){alert(msg);}
        });     
        
        $(dlg).window({left:_left, top:_top});        
        $(dlg).dialog('open').dialog('setTitle',title);     
   
    }
    function append_group(){
        $("#mode").val('add');
        $('#dlgMod').dialog('open').dialog('setTitle','Append Group');        
    }
    function remove() {
        var node = $('#tt').tree('getSelected');
        var ga_type=node.id.substring(0,2);
        var ga_id=node.id.substring(2,30);
        xurl=CI_ROOT+'coa/delete/'+ga_id;
        if(ga_type=="G_")xurl=CI_ROOT+'coa/delete_group/'+ga_id;
        $.ajax({type: "GET", url: xurl, data:'',
            success: function(msg){
                var obj=jQuery.parseJSON(msg);
                alert(obj.message)
            },
            error: function(msg){alert(msg);}
        });          
    
    }
    function append_account(){
        $("#mode").val('add');
        $('#dlgCoa').dialog('open').dialog('setTitle','Append Account');        
    }
    function append_group(){
        $("#mode_group").val('add');
        $('#dlgGroup').dialog('open').dialog('setTitle','Append Group Account');        
    }

        function load_help() {
            window.parent.$("#help").load("<?=base_url()?>index.php/help/load/coa");
        }
        function on_refresh(){
            loading();
            coa_type=$("#coa_type").val();
            window.open(CI_ROOT+'coa/coa_type/'+coa_type,"_self");
        }
        function invalid_coa(){
            url=CI_ROOT+'coa/unknown';
            add_tab_parent("InalidCOA",url);
        }
    </script>
