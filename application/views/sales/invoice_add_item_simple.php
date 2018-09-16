<div id='dgItemInv' class="easyui-dialog" style="width:600px;height:400px;padding:5px 5px;left:100px;top:100px"
closed="true" buttons="#btnItem" >
	<form id="frmItemInv" method='post' >
		<input type='hidden' id='invoice_number_item' name='invoice_number_item'>
		<input type='hidden' id='line_number' name='line_number'>
		<div class="easyui-tabs"  >
			<div id='dgItemInvItem' title='Item'>
				<table class='table2' width='100%'>
				<tr>
					<td>Kode Barang</td>
					<td><input onblur='find();return false;' id="item_number" style='width:150px' 
			         	name="item_number"  >
						<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
						onclick="searchItem();return false;"></a>
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
							M_Price <?=form_input("mu_harga","","id='mu_harga'")?>					</span>
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
				</table>
			</div>
			<div id='dgItemInvCoa' title='Akuntansi'>
				<table class="table2" width="100%">
					<tr><?php 
						echo "<td>Persediaan</td><td>".form_input("coa1","","id='coa1' style='width:250px'");
						echo link_button("", "cari_coa(1);return false;","search");
						echo "</td>";
					?>
					</tr>
					<tr>
						<?php 
						echo "<td>Penjualan</td><td>".form_input("coa2","","id='coa2' style='width:250px'");
						echo link_button("", "cari_coa(2);return false;","search");
						echo "</td>";
						?>
					</tr>
					<tr><?php 
						echo "<td>Cost</td><td>".form_input("coa3","","id='coa3' style='width:250px'");
						echo link_button("", "cari_coa(3);return false;","search");
						echo "</td>";
						?>
					</tr>			
				</table>
			</div>	
		</div>
	</form>
</div>	
<div id='btnItem'>
	<?=link_button("Submit", "save_item();return false;","save")?>
	<?=link_button("Cancel", "dgItemInv_close();return false;","cancel")?>
</div>
<?php 
	if(!isset($show_tool))$show_tool=true; 
	if($show_tool){
?>
	<div id="tb" class='box-gradient'>
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem();return false;">Add</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem();return false;">Edit</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem(); return false;">Delete</a>	
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="loadItem(); return false;">Refresh</a>	
	</div>
<?php } ?>

<?=load_view("inventory/select_unit_jual")?>

<script language="JavaScript">
	
	var qty_conv = 0;

   $().ready(function (){
        $('#dg').datagrid({
            onDblClickRow:function(){
            	editItem();
            }
        });        
    });
 
 	
	function dgItemInv_close(){
		$("#dgItemInv").dialog("close");
	}
	function loadItem(){
		$('#dg').datagrid('reload');		
	}
	function addItem(){
		var mode=$('#mode').val();
		if(mode=="add"){
			log_err("Simpan dulu sebelum tambah item barang !");
			return false;
		}
		clear_input();
		qty_conv=0;
		$("#dgItemInv").dialog("open").dialog('setTitle','Input barang');
	}
	function close_item(){
		clear_input();
		$("#dgItemInv").dialog("close");	
	}
 
	function find(){
		var item=$("#item_number").val();
		if( item=="" || item=="undefined")return false;
		var cust_type=$('#cust_type').val();
		xurl=CI_ROOT+'inventory/find/'+$('#item_number').val()+'/'+cust_type;
		$.ajax({
					type: "GET",
					url: xurl,
					data:'item_no='+$('#item_number').val(),
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#item_number').val(obj.item_number);
						$('#price').val(obj.retail);
						$('#cost').val(obj.cost);
						$('#unit').val(obj.unit_of_measure);
						$('#description').val(obj.description);
						$('#discount').val(obj.disc_prc_1);
						$('#disc_2').val(obj.disc_prc_2);
						$('#disc_3').val(obj.disc_prc_3);
						
						hitung();
					},
					error: function(msg){alert(msg);}
		});
	};
	function hitung(){
		if($('#quantity').val()==0)$('#quantity').val(1);
		gross=$('#quantity').val()*$('#price').val();
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
	
	function save_item(){
		var mode=$('#mode').val();
		if(mode=="add"){log_err("Simpan dulu nomor ini !");return false;}
		var url = '<?=base_url()?>index.php/invoice/save_item';
		$('#invoice_number_item').val($('#invoice_number').val());
		loading();
		hitung();
					 
		$('#frmItemInv').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				loading_close();
				var result = eval('('+result+')');
				if (result.success){
					$('#dg').datagrid('reload');
					clear_input();
					$("#dgItemInv").dialog("close");						
					log_msg("Success");
				} else {
					log_err(result.msg);
				}
			}
		});
	}
	function clear_input(){
		$('#frmItemInv').form('clear');
		$('#item_number').val('');
		$('#discount').val('0');
		$('#unit').val('Pcs');
		$('#item_number').val('');
		$('#line_number').val('');
		$('#quantity').val(1);
		$('#description').val('');
		$('#price').val('');
		$('#disc_2').val('');
		$('#disc_3').val('');
		$("#coa1").val("");
		$("#coa2").val("");
		$("#coa3").val("");		
	}
	function deleteItem(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/invoice/delete_item';
					loading();
					$.post(url,{line_number:row.line_number},function(result){
						if (result.success){							
							$('#dg').datagrid('reload');	// reload the user data
							loading_close();
						} else {
							loading_close();
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
			$('#invoice_number_item').val(row.invoice_number);
			$("#coa1").val(row.revenue_acct_id);
			$("#coa2").val(row.coa2);
			$("#coa3").val(row.coa3);
			$("#dgItemInv").dialog("open").dialog('setTitle','Input barang');
			load_item_row(row.line_number);
		}
	}
	function load_item_row(line_number){
		var xurl=CI_ROOT+"invoice/line_number/"+line_number;
		$.ajax({
			type: "GET",
			url: xurl,
			success: function(msg){
				var obj=jQuery.parseJSON(msg);				
				$('#coa1').val(obj.coa1_account);
				$('#coa2').val(obj.coa2_account);
				$('#coa3').val(obj.coa3_account);
			},
			error: function(msg){log_err(msg);}
		});
				
	}
	function cari_coa(nomor){
		lookup1({id:"coa"+nomor, 
			url:CI_ROOT+"lookup/query/chart_of_accounts",
			fields: [[
		        {field:'account',title:'Account',width:80},
		        {field:'account_description',title:'Account Description',width:300},
		        {field:'id',title:'Id',width:40,align:'right'}
    		]],
    		result: function result(){
    			$("#"+r.idd).val(r.data.account+' - '+r.data.account_description);
    		}
		});
	}
		
</script>
