<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="divList" style="margin:10px">
    <table>
    <tr><td style='width:100px'>Nomor Bukti: </td><td><?=$shipment_id?></td></tr>
    <tr><td>Tanggal: </td><td><?=$date_received?></td></tr>
    <tr><td>Pengirim: </td><td><?=$supplier_number?></td></tr>
    <tr><td>Keterangan: </td><td><?=$comments?></td></tr>
    <tr><td colspan='2' >
        <div id="tbj" style="height:auto">
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append()">Append</a>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="remove_item()">Remove</a>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="refresh_items()">Refresh</a>
         </div>
         <div id='dgItem' style="width:800px;height:200px"></div>
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
        param='shipment_id=<?=$shipment_id?>&date_received=<?=$date_received?>
        &supplier_number=<?=$supplier_number?>&comments=<?=$comments?>';
        console.log(param);
        xurl='<?=base_url()?>index.php/delivery/add_item';
        $.ajax({
                    type: "GET",
                    url: xurl,
                    data: param,
                    success: function(msg){
                        $('#dlgItem').dialog({  
                           title: 'Pilih Barang',  
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
                            xurl=CI_ROOT+'delivery/delete_item/'+row['id'];                             
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
         get_this('<?=base_url()?>index.php/delivery/view_detail/<?=$shipment_id?>',param,'dgItem');
         return false;
     }   
      function save_item(){
        var url="<?=base_url()?>index.php/delivery/save_item";
        var param=$('#frmItem').serialize();
        return post_this(url,param,'message');
      }
</script>
    