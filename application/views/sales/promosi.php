<div class='alert alert-info'>
<strong>Setting discount promosi barang</strong>
<p>Dibawah ini adalah data promosi barang, silahkan tambahkan data barang yang
ada promosi dengan klik  tombol <strong>Add</strong> kemudian pilih barang dan klik tombol <strong>Simpan</strong>
</p>
<p>Tombol <strong>Cari</strong> bisa dipakai untuk mencari data promosi yang 
sudah tersimpan</p>
</div>

<table id="dgItem" class="easyui-datagrid" width="100%"       
data-options="iconCls: 'icon-edit',fitColumns:true,
singleSelect: true,toolbar: '#tb',
url: '<?=base_url()?>index.php/so/promosi/load_items' ">
    <thead>
        <tr>
            <th data-options="field:'item_type'">Type</th>
            <th data-options="field:'item_number'">Item</th>
            <th data-options="field:'description'">Description</th>
            <th data-options="field:'disc_prc_1',align:'right'">Disc1</th>
            <th data-options="field:'disc_prc_2',align:'right'">Disc2</th>
            <th data-options="field:'disc_prc_3',align:'right'">Disc2</th>
            <th data-options="field:'from_date'">Date From</th>
            <th data-options="field:'to_date'">Date To</th>
            <th data-options="field:'time_range'">Time Range</th>
            <th data-options="field:'member_group'">Group</th>
            <th data-options="field:'min_qty'">Min Qty</th>
            <th data-options="field:'id'">Line</th>
        </tr>
    </thead>
</table>

<div id="tb" style="height:auto">
    <?php 
        echo "Find: ";
        echo form_input("txtSearchItem","","id = 'txtSearchItem'");    
        echo link_button('Search','load_item()','search');     
        echo link_button('Add', 'add_item()','add');     
        echo link_button('Delete', 'remove_item()','remove');       
        echo link_button('Print', 'print_item()','print');       
    ?>
</div>
    
<div id='dlgItem' class="easyui-dialog"  
style="width:600px;height:380px;padding:5px 5px"
closed="true" buttons ="#dlgItemTool">

<input id='id' type='hidden'/>

<table class='table2' width='100%'>
<tr>
    <td>Type</td><td> 
    <?php
    $data["item"]="Item";
    $data["category"]="Category";
    $data["supplier"]="Supplier";
    $data["merk"]="Merk";
    $data["model"]="Model";
    
    echo form_dropdown("item_type",$data,"Item","id='item_type'");
    
    ?>
    Item <input id='item_number'/>
    <?=link_button('','select_item()','search')?>        
    </td>
</tr>
<tr><td>Description </td><td><input id='description' style='width:280px'/></td>
</tr>
<tr>
<td>Date From</td>
<td><?php echo form_input('from_date',date("Y-m-d"),'id=from_date 
        class="easyui-datetimebox" required style="width:120px"
        data-options="formatter:format_date,parser:parse_date"
    ');
    ?>
</td>
</tr>
<tr>
<td>Date To</td>
<td><?php
    echo form_input('to_date',date("Y-m-d 23:59:59"),'id=to_date 
        class="easyui-datetimebox" required style="width:120px"
        data-options="formatter:format_date,parser:parse_date"
    ');
    
    ?>
</td>
</tr>
<tr>
    <td>Disc%1</td><td><input id='disc_prc_1' style='width:50px'/>
    Disc%2 <input id='disc_prc_2' style='width:50px'/>    
    Disc%3 <input id='disc_prc_3' style='width:50px'/>
    </td>
</tr>
<tr>
    <td>Promo Range Jam: </td>
    <td><input id='time_range' style='width:180px'/>
        <br><i style='text-size:small'>*isi dg format seperti (09~10,18~20) artinya berlaku pada jam 9 s/d 10</i>
    </td>
</tr>
<tr>
    <td>Minimum Qty: </td><td><input id='min_qty'/></td>
</tr>

<tr>
    <td>Member Group</td>
    <td><input id='member_group' style='width:180px'/>
        <?=link_button('','dlgmember_group_show()','search')?>        
    </td>
</tr>
</table>
</div>    
<div id='dlgItemTool'>
<?php 
    echo link_button('Save', 'save_item()','save');     
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
        void load_item();
    });
	function select_item(){
	    var item_type=$("#item_type").val();
	    if(item_type=="item"){
            dlgitem_number_show();	        
	    } else if (item_type=="supplier"){
	        dlgsuppliers_show();
	    } else if (item_type=='category'){
	        dlgcategories_show();
        } else if (item_type=='sub_category'){
            dlgsub_categories_show();
	    } else if (item_type=="merk"){
	        dlgmerk_show();
	    } else if (item_type=="model"){
	        dlgmodel_show();
	    }
	}
    function add_item() {
        //$('#dlgItem').window({left:100,top:window.event.clientY+20});
        $('#dlgItem').dialog('open').dialog('setTitle','Pilih');
    }
	function load_item(){
	    var search=$("#txtSearchItem").val();
        $('#dgItem').datagrid({url:'<?=base_url()?>index.php/so/promosi/load_items/'+search});
        $('#dgItem').datagrid('reload');
	}
	function edit_item(){
	    clear_input();
        var row = $('#dgItem').datagrid('getSelected');
        if (row){


        }	    
	}
	function remove_item(){
        if(closed){alert("Tidak bisa ubah jurnal ini karena sudah diclose!");return false;}
        var row = $('#dgItem').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
                if (r){
                    url='<?=base_url()?>index.php/so/promosi/delete_item/'+row.id;
                    $.post(url,function(result){
                        if (result.success){
                            load_item();
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
		$("#item_number").val("");        $("#min_qty").val("");
		$("#description").val("");        $("#member_group").val("");
		$("#disc_prc_1").val("");
		$("#disc_prc_2").val("");
		$("#disc_prc_3").val("");
	}
	function save_item(){
		loading();
		var xparam={item_number:$("#item_number").val(),
			description:$("#description").val(),from_date:$("#from_date").val(),
			to_date:$("#to_date").val(),disc_prc_1:$("#disc_prc_1").val(),
			disc_prc_2:$("#disc_prc_2").val(),disc_prc_3:$("#disc_prc_3").val(),
			member_group:$("#member_group").val(),item_type:$("#item_type").val(),
			time_range:$("#time_range").val(),min_qty:$("#min_qty").val()};
		$.ajax({
            type: "POST",data: xparam,url: CI_BASE+"index.php/so/promosi/save/",
            success: function(msg){
				console.log(msg);
				var result = eval('('+msg+')');
				if (result.success){
					loading_close();
					log_err(result.message);
                    $('#dlgItem').dialog('close');					
					load_item();
					clear_input();
				} else {
					loading_close();
					log_msg(result.message);
				}
            },
            error: function(msg){
				loading_close();
				log_msg(msg);
			}
        });         
		
	}
</script>

