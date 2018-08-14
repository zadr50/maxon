<div id="divList" style="margin:10px">
    <table>
    <tr><td style='width:100px'>Nomor Faktur: </td><td><?=$purchase_order_number?></td></tr>
    <tr><td>Tanggal: </td><td><?=$po_date?></td></tr>
    <tr><td>Supplier: </td><td><?=$supplier_number?> - <?=$supplier_info?></td></tr>
    <tr><td>Termin: </td><td><?=$terms?></td></tr>
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
        param='purchase_order_number=<?=$purchase_order_number?>';
        console.log(param);
        xurl='<?=base_url()?>index.php/payables_payments/add';
        $('#divItem').html('');
        get_this(xurl,param,'divItem');
        $.ajax({
                    type: "GET",
                    url: xurl,
                    data: param,
                    success: function(msg){
                        $('#dlgItem').dialog({  
                           title: 'Daftar Pembayaran',  
                           width: 400,height: 400,  closed: false, cache: false,
                           modal: true,
                            buttons: [{
                                            text:'Ok',
                                            iconCls:'icon-ok',
                                            handler:function(){
                                               save_payment();
                                               $('#dlgItem').dialog('close');
                                            }
                                    },{
                                            text:'Cancel',
                                            iconCls:'icon-cancel',
                                            handler:function(){
                                                $('#dlgItem').dialog('close');
                                            }
                                    }] 
                       })
               		},
                    error: function(msg){
                        alert(msg);
                    }
            });
        $('dlgItem').dialog('refresh');     
     }
     function remove_item(){
            row = $('#dg').datagrid('getSelected');
            if (row){
                xurl=CI_ROOT+'payables_payments/delete/'+row['line_number'];                             
                console.log(xurl);
                xparam='';
                $.ajax({
                    type: "GET",
                    url: xurl,
                    param: xparam,
                    success: function(msg){
                    	refresh_items();
                        //$.messager.alert('Info','Berhasil hapus baris, silahkan refresh.')
                    },
                    error: function(msg){$.messager.alert('Info',msg);}
           });         
		};
     }
    
     function refresh_items(){
         xurl='<?=base_url()?>index.php/payables_payments/list_by_invoice/<?=$purchase_order_number?>';
         get_this(xurl,'','dgItem');
         return false;
     } 
     function save_payment()
     {
            url= '<?=base_url();?>index.php/payables_payments/save';
            $.post(url, $('#frmAddPay').serialize(), 
            function (data, textStatus) {
                 //refresh_items();
                 $('#message').html(data);
            });
            return false;
     }  
      
</script>
    