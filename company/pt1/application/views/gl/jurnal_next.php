<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>js/jquery-ui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>js/jquery-ui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>js/jquery-ui/themes/demo.css">
<script src="<?=base_url();?>js/jquery-ui/jquery.easyui.min.js"></script>

<div id="divList" style="margin:10px">
    <table>
    <tr><td style='width:100px'>Kode Jurnal: </td><td><?=$gl_id?></td></tr>
    <tr><td>Tanggal: </td><td><?=$date?></td></tr>
    <tr><td>Operation: </td><td><?=$operation?></td></tr>
    <tr><td>Keterangan: </td><td><?=$source?></td></tr>
    <tr><td colspan='2' >
        <div id="tbj" style="height:auto">
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append()">Append</a>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="remove_item()">Remove</a>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="refresh_items()">Refresh</a>
         </div>
         <div id='dgJurnalItem' style="width:800px;height:200px"></div>
</td></tr>
</table>
    
<div id="dlgItem" style='margin:2px;z-index:1001'>
    <div id='divItem'></div>    
</div>

<script type="text/javascript">
    $(document).ready(function(){
       refresh_items();
    });
 
    function append(){
        param='gl_id=<?=$gl_id?>&date=<?=$date?>&source=<?=$source?>&operation=<?=$operation?>';
        console.log(param);
        //$('#divItem').html('');
        
        // get_this('<?=base_url()?>index.php/jurnal/add_item',param,'divItem');
        xurl='<?=base_url()?>index.php/jurnal/add_item';
        $.ajax({
                    type: "GET",
                    url: xurl,
                    data: param,
                    success: function(msg){
                        $('#dlgItem').dialog({  
                           title: 'Pilih Account',  
                           width: 400,height: 400,  closed: false, cache: false,
                           modal: true,
                            buttons: [{
                                            text:'Ok',
                                            iconCls:'icon-ok',
                                            handler:function(){
                                               save_item();
                                               $('#dlgItem').dialog('close');
                                            }
                                    },{
                                            text:'Cancel',
                                            iconCls:'icon-cancel',
                                            handler:function(){
                                                $('#dlgItem').dialog('close');
                                            }
                                    }],

                           modal: true  
                       });
                        $('#divItem').html(msg);
                    },
                    error: function(msg){
                        alert(msg);
                    }
            }); 
         

          

     }
     function remove_item(){
            row = $('#dg').datagrid('getSelected');
            if (row){
                            xurl=CI_ROOT+'jurnal/delete_item/'+row['id'];                             
                            console.log(xurl);
                            xparam='';
                            $.ajax({
                                    type: "GET",
                                    url: xurl,
                                    param: xparam,
                                    success: function(msg){
                                        $.messager.alert('Info','Berhasil hapus baris, silahkan refresh.')
                                    },
                                    error: function(msg){$.messager.alert('Info',msg);}
                            });         
	}
     }
     function refresh_items(){
         param="";
         get_this('<?=base_url()?>index.php/jurnal/view_jurnal/<?=$gl_id?>',param,'dgJurnalItem');
         return false;
     }   
      function save_item(){
                    var url="<?=base_url()?>index.php/jurnal/save_item";
                    var param=$('#frmItem').serialize();
                    return post_this(url,param,'divItem');
                }
</script>
    