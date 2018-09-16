<div id='dgItem' class="easyui-dialog" style="width:700px;height:400px;
    left:100px;top:20px;padding:5px 5px"
    closed="true" buttons="#btnItem" >

    <form id="frmItemInv" method='post' >
        <table class='table2' width='100%'>
        <tr>
            <td>Kode Barang</td>
            <td><input onblur='find();return false;' id="item_number" style='width:150px' 
                name="item_number"  >
                <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
                onclick="dlginventory_show();return false;"></a>
             </td>
        </tr>
        <tr>
            <td>Nama Barang</td>
             <td><input id="description" name="description" style='width:300px'></td>
        </tr>
        <tr>
             <td>Qty</td><td><input id="quantity"  style='width:80px'  name="quantity" onblur="hitung()">
             Unit <input id="unit" name="unit"  style='width:80px' >
            
                <a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
                onclick="searchUnit();return false;" 
                style='display:none' id='cmdLovUnit'>
                             
             
             </td>
        </tr>
			<tr>
				<td colspan=3>
				<span id='divMultiUnit' style='display:none'>
					M_Qty <?=form_input("mu_qty","","id='mu_qty' style='width:60px'")?>
					M_Unit <?=form_input("multi_unit","","id='multi_unit' style='width:60px' ")?>
					M_Price <?=form_input("mu_harga","","id='mu_harga'")?>
				</span>
				</td>
			</tr>


        <tr>
            <td>Harga</td>
            <td><input id="price" name="price"  style='width:180px'   onblur="hitung()" class="easyui-validatebox" validType="numeric"></td>
        </tr>
        <tr>
            <td>Disc%1</td>
            <td><input id="discount" name="discount"  style='width:80px'   onblur="hitung()" class="easyui-validatebox" validType="numeric">
            Disc%2 <input id="disc_2" name="disc_2"  style='width:80px'   onblur="hitung()" class="easyui-validatebox" validType="numeric">
            Disc%3 <input id="disc_3" name="disc_3"  style='width:80px'   onblur="hitung()" class="easyui-validatebox" validType="numeric">
            </td>
        </tr>
        <tr>
            <td>Jumlah</td><td><input id="amount" name="amount"  style='width:80px'  class="easyui-validatebox" validType="numeric"></td>
        </tr>
        <input type='hidden' id='so_number' name='so_number'>
        <input type='hidden' id='line_number' name='line_number'>
        
        </table>
    </form>
</div>  
<div id='btnItem'>
    <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
       plain='false'    onclick='save_item();return false'>Simpan</a>
</div>
<?php 
if(!isset($show_tool))$show_tool=true; 

if($show_tool){
?>
    <div id="tbItem" class='box-gradient'>
        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem();return false;">Add</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem();return false;">Edit</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem(); return false;">Delete</a>   
        <a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="load_items(); return false;">Refresh</a>   
    </div>
<?php } ?>


<?=load_view("inventory/select_unit_jual")?>

<script type="text/javascript">
var qty_conv = 0;
function addItem(){
	var mode=$('#mode').val();
	if(mode=="add"){
		log_err("Simpan dulu sebelum tambah item barang !");
		return false;
	}
	qty_conv=0;
	clear_input();
	$("#dgItem").dialog("open").dialog('setTitle','Input barang');
}
function close_item(){
	clear_input();
	$("#dgItem").dialog("close");	
}
function clear_input(){
	$('#frmItemInv').form('clear');
	$('#item_number').val('');
	$('#discount').val('0');
	$('#disc_2').val('0');
	$('#disc_3').val('0');
	$('#unit').val('');
	$('#description').val('');
	$('#line_number').val('');
	$('#quantity').val(1);
	$('#price').val(0);	
	$("#mu_qty").val("");
	$("#multi_unit").val("");
	$("#mu_price").val("");
	
}
function save_item(){
	var mode=$('#mode').val();
	if(mode=="add"){
		log_err("Simpan dulu sebelum tambah item barang !");
		return false;
	}
	url = '<?=base_url()?>index.php/sales_order/save_item';
	$('#so_number').val($('#sales_order_number').val());
	loading();
	$('#frmItemInv').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('('+result+')');
			if (result.success){
				loading_close();
				load_items();
				hitung();
				$("#dgItem").dialog("close");
				log_msg("Success");
			} else {
				loading_close();
				log_err(result.msg);
			}
		}
	});
}

function deleteItem(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
			if (r){
				url='<?=base_url()?>index.php/sales_order/delete_item';
				$.post(url,{line_number:row.line_number},function(result){
					if (result.success){
						load_items();
					} else {
						log_err(result.msg);
					}
				},'json');
			}
		});
	}
}
function editItem(){
	var row = $('#dg').datagrid('getSelected');
	if (row){
		$('#frmItemInv').form('load',row);
		$('#item_number').val(row.item_number);
		$('#description').val(row.description);
		$('#quantity').val(row.quantity);
		$('#unit').val(row.unit);
		$('#price').val(row.price);
		$('#discount').val(row.discount);
		$('#disc_2').val(row.disc_2);
		$('#disc_3').val(row.disc_3);
		$('#amount').val(row.amount);
		$('#line_number').val(row.line_number);
		$('#so_number').val(row.so_number);
		$("#mu_qty").val(row.mu_qty);
		$("#multi_unit").val(row.multi_unit);
		$("#dgItem").dialog("open");
	}
}

function hitung(){
	if($('#quantity').val()==0)$('#quantity').val(1);
	gross=$('#quantity').val()*$('#price').val();
	
	        d=$('#discount').val();
			d2=d.split("+");
			for(i=0;i<d2.length;i++){
				disc_prc=d2[i];
				if(disc_prc>1){
					disc_prc=disc_prc/100;
				}	
				if(i==0){
					$("#discount").val(disc_prc);
				} else {
					$("#disc_"+(i+1)).val(disc_prc);
				}
			}
	
	disc_1=$('#discount').val(); if(disc_1>1)disc_1=disc_1/100;
	disc_2=$('#disc_2').val();  if(disc_2>1)disc_2=disc_2/100;
	disc_3=$('#disc_3').val(); if(disc_3>1)disc_3=disc_3/100;
	gross=gross-(gross*disc_1);
	gross=gross-(gross*disc_2);
	gross=gross-(gross*disc_3);
	$('#amount').val(gross);			


	calc_qty_unit();

	hitung_jumlah();
}
function calc_qty_unit(){
	if(qty_conv=="")qty_conv=1;
	if(qty_conv=="0")qty_conv=1;
	qty=$("#quantity").val();
	qty=qty*qty_conv;
	$("#mu_qty").val(qty);
}
function qty_change_hitung(){
	var item=$("#item_number").val();
	var qty=$("#quantity").val();
	if($('#quantity').val()==0)$('#quantity').val(1);
	var cust_no=$("#sold_to_customer").val();
	if( item=="" || item=="undefined")return false;
		
			 
	xurl=CI_ROOT+'inventory/sales_discount/'+item+'/'+cust_no+'/'+qty ;
	 
	$.ajax({
		type: "GET",
		url: xurl,
		 
		success: function(msg){
			var obj=jQuery.parseJSON(msg);
			if(obj.discount!="") {
				$("#discount").val(obj.discount);
				hitung();
			}
		},
		error: function(msg){alert(msg);}
	});	
	 
}
function find(){
		var cust_type=$('#cust_type').val();			 
		var item=$("#item_number").val();
		if( item=="" || item=="undefined")return false;
		var cust_no=$("#sold_to_customer").val();
	    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val()+'/'+cust_type ;
		var param={item_no:item,cust_type:cust_type,cust_no:cust_no};
		
		loading();
		
	    $.ajax({
			type: "GET",
			url: xurl,
			data: param,
			success: function(msg){
				var obj=jQuery.parseJSON(msg);
				$('#item_number').val(obj.item_number);
				$('#price').val(obj.retail);
				$('#cost').val(obj.cost);
				$('#unit').val(obj.unit_of_measure);
				$('#description').val(obj.description);
				$("#discount").val(obj.discount);
				if(obj.discount==0) $("#discount").val(obj.disc_prc_1);
				$("#disc_2").val(obj.disc_prc_2);
				$("#disc_3").val(obj.disc_prc_3);
				if(obj.multiple_pricing){
					$("#cmdLovUnit").show();
					$("#divMultiUnit").show();
				} else {
					$("#cmdLovUnit").hide();
					$("#divMultiUnit").hide();
				}
				$("#quantity").val("1");

				loading_close();
				
				hitung();
			},
			error: function(msg){
				loading_close();
				log_err(msg);
			}
	    });
	};	

</script>