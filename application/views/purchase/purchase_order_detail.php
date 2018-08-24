<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="divList" style="margin:10px">
	<h1>PURCHASE ORDER</h1>
    <table>
    <tr><td style='width:100px'>Nomor Bukti: </td><td><?=$purchase_order_number?></td></tr>
    <tr><td>Tanggal: </td><td><?=$po_date?></td></tr>
    <tr><td>Pengirim: </td><td><?=$supplier_number?> - <?=$supplier_info?></td></tr>
    <tr><td>Keterangan: </td><td><?=$comments?></td></tr>
    <tr><td colspan='2' >
        <div id="tbj" style="height:auto">
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append()">Append</a>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="remove_item()">Remove</a>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="refresh_items()">Refresh</a>
         </div>
         <div id='dgItem' style="width:700px;height:200px"></div>
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
        param='purchase_order_number=<?=$purchase_order_number?>
                &po_date=<?=$po_date?>
        &supplier_number=<?=$supplier_number?>&comments=<?=$comments?>';
        console.log(param);
        xurl='<?=base_url()?>index.php/purchase_order/add_item';
        $.ajax({
                    type: "GET",
                    url: xurl,
                    data: param,
                    success: function(msg){
                        $('#dlgItem').dialog({  
                           title: 'Pilih Nama Barang', 
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
                            xurl=CI_ROOT+'purchase_order/delete_item/'+row['line_number'];                             
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
         get_this('<?=base_url()?>index.php/purchase_order/view_detail/<?=$purchase_order_number?>'
         ,param,'dgItem');
         return false;
     }   
      function save_item(){
        var url="<?=base_url()?>index.php/purchase_order/save_item";
        var param=$('#frmItem').serialize();
        return post_this(url,param,'message');
      }
      
		function calc_qty_unit(){
			if(qty_conv=="")qty_conv=1;
			if(qty_conv=="0")qty_conv=1;
			qty=$("#quantity").val();
			qty=qty*qty_conv;
			$("#mu_qty").val(qty);
		}
      
</script>
    