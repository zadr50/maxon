<table id="dgExpenses" class="easyui-datagrid table"  
    style="min-height:300px;" width="90%"
    data-options="
        iconCls: 'icon-edit',fitColumns: true, 
        singleSelect: true, toolbar: '#tbExpenses',
        url: ''
    ">
    <thead>
        <tr>
            <th data-options="field:'purchase_order_number',width:100">Nomor</th>
            <th data-options="field:'item_no',width:80">Item</th>
            <th data-options="field:'item_desc',width:100">Keterangan</th>
            <th data-options="<?=col_number('amount',2)?>">Amount</th>
            <th data-options="field:'id',width:50">Id</th>
        </tr>
    </thead>
</table>
        
<div id="tbExpenses" class="box-gradient ">
    <?=link_button('Add','add_expenses()','add');    ?>  
    <?=link_button('Refresh','load_expenses()','reload');    ?>  
    <?=link_button('View','view_expenses()','edit'); ?>  
    <?=link_button('Delete','delete_expenses()','remove'); ?>  
</div>
<div id="dlgExpense" name='dlgExpense' class="easyui-dialog" 
style="top:100px;left:100px;width:700px;height:400px"
data-options="title:'Setting'" 
   closed="true" >
 
<div id='divExpense' >
<form method='POST' name='frmExpenses' id='frmExpenses'>
<table class='table' width="100%">
    <tr>
        <td>Item No</td><td><?=form_input("item_no","","id='item_no'")?></td>
    </tr>
    <tr>
        <td>Keterangan / Nama Biaya</td><td><?=form_input("item_desc","","id='item_desc' style='width:300px'")?></td>
    </tr>
    <tr>
        <td>Jumlah </td><td><?=form_input("amount","","id='amount'")?></td>
    </tr>
    <tr>
        <td>Calc Method</td><td><?=form_input("calc_method","","id='calc_method'")?></td>
    </tr>
    <tr>
        <td>Quantity</td><td><?=form_input("qty","","id='qty'")?></td>
    </tr>
    <tr>
        <td>Price</td><td><?=form_input("price","","id='price'")?></td>
    </tr>
    <tr>
        <td>Id</td><td><?=form_input("id","","id='id'")?></td>
    </tr>
    
</table>    
</form>    
</div>
</div>

<script type="text/javascript">

    $().ready(function (){
		refresh_expenses();
    });	

    function add_expenses(){
    	var po=$('#purchase_order_number').val();
	    if(po=="AUTO"){
	    	log_err("Simpan dulu !");return false;
	    }
    	
    	
        $('#dlgExpense').dialog({  
           title: 'Tambah/Edit Data', closed: false, 
           cache: false, modal: true,
            buttons: [{text:'Ok', iconCls:'icon-ok',handler:function(){
                            void save_expenses();
                            }},
                      {text:'Cancel',iconCls:'icon-cancel',handler:function(){
                            $('#dlgExpense').dialog('close');}
                     }]
        });
   }
   function delete_expenses(){
       
        var row = $('#dgExpenses').datagrid('getSelected');
        
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to remove this line?',
            function(r){
                if(!r)return false;
            });
            var xurl='<?=base_url()?>index.php/purchase_order/expenses/'+row.id+'/delete';
            $.ajax({
                type: "GET", url: xurl,
                success: function(result){
                try {
                        var result = eval('('+result+')');
                        if(result.success){
                            $.messager.show({
                                title:'Success',msg:result.msg
                            });
                           $("#others").val(result.total);
                            refresh_expenses();
                        } else {
                            $.messager.show({
                                title:'Error',msg:result.msg
                            });
                            log_err(result.msg);
                        };
                    } catch (exception) {       
                        refresh_expenses();
                    }
                },
                error: function(msg){$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
            });         
       }
   }
   function view_expenses(){
        var row = $('#dgExpenses').datagrid('getSelected');
        var xurl='<?=base_url()?>index.php/purchase_order/expenses/'+row.id+'/view';
        $.ajax({
            type: "GET", url: xurl,
            success: function(result){
            try {
                    var result = eval('('+result+')');
                    if(result.success){
                        $("#item_no").val(result.item_no);
                        $("#item_desc").val(result.item_desc);
                        $("#frmExpenses input[name=amount]").val(result.amount);
                        $("#qty").val(result.qty);
                        $("#frmExpenses input[name=price]").val(result.price);
                        $("#calc_method").val(result.calc_method);
                        $("#id").val(result.id);
                        add_expenses();
                    } else {
                        $.messager.show({
                            title:'Error',msg:result.msg
                        });
                        log_err(result.msg);
                    };
                } catch (exception) {       
                    refresh_expenses();
                }
            },
            error: function(msg){$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
        });         
   }
   function save_expenses(){
        var nomor=$("#purchase_order_number").val();
	    if(nomor=="AUTO"){
	    	log_err("Simpan dulu !");return false;
	    }
        
        url='<?=base_url()?>index.php/purchase_order/expenses/'+nomor+'/save';
        $('#frmExpenses').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                   $('#dlgExpense').dialog('close');
                   $("#others").val(result.total);
                   refresh_expenses();
                    log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
                } else {
                    log_err(result.msg);
                }
            }
        });       
   }
   function refresh_expenses(){
       var nomor=$("#purchase_order_number").val();
       if(nomor=="")nomor="0";
       if(nomor=="AUTO")return false;
       
       var _url='<?=base_url()?>index.php/purchase_order/expenses/'+nomor+'/items';
        $('#dgExpenses').datagrid({url:_url});
   }


</script>        
