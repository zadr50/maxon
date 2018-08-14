<form id="frSo">
<div id="divList" style="margin:10px">
    <table>
    <tr><td style='width:100px'>Nomor Bukti SO: </td><td class="field"><h1><?=$sales_order_number?></h1></td></tr>
    <tr><td>Tanggal: </td><td class="field"><?=$sales_date?></td></tr>
    <tr><td>Pelanggan: </td><td class="field"><?=$customer_info?></td></tr>
    <tr><td>Termin: </td><td class="field"><?=$payment_terms?></td></tr>
    <tr><td>Salesman: </td><td class="field"><?=$salesman?></td></tr>
    <tr><td>Kirim Tanggal: </td><td class="field"><?=$due_date?></td></tr>
    <tr><td>Keterangan: </td><td class="field"><?=$comments?></td></tr>
    
</table>
</form>
<table id="dg" class="easyui-datagrid" 
		title="Silahkan input barang yang dijual." 
		style="width:800px;min-height:300px"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/sales_order/items/<?=$sales_order_number?>/json'
			">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
				<th data-options="field:'price',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Harga</th>
				<th data-options="field:'discount',width:50,editor:'numberbox'">Disc%</th>
				<th data-options="field:'amount',width:60,align:'right',editor:'numberbox'">Jumlah</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>

	<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">New Item</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Edit Item</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteItem()">Delete Item</a>	</div>
	
	<script type="text/javascript">
		var url;
		function newItem(){
			$('#dlg').dialog('open').dialog('setTitle','Tambah data barang');
			$('#fm').form('clear');
			$('#sales_order_number').val('<?=$sales_order_number?>');
			url = '<?=base_url()?>index.php/sales_order/save_item';
		}
		function editItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Item');
				$('#fm').form('load',row);
				url = '<?=base_url()?>index.php/sales_order/save_item';
			}
		}
		function saveItem(){
			 
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
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
						console.log(url);
						console.log(row.line_number);
						$.post(url,{line_number:row.line_number},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
		
		function find(){
		    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val();
		    console.log(xurl);
		    $.ajax({
		                type: "GET",
		                url: xurl,
		                data:'item_no='+$('#item_number').val(),
		                success: function(msg){
		                    var obj=jQuery.parseJSON(msg);
		                    $('#item_number').val(obj.item_number);
		                    $('#price').val(obj.retail);
		                    //$('#cost').val(obj.cost);
		                    //$('#unit').val(obj.unit_of_measure);
							//$('#discount').val("10+20+10");
							//$('#disc_2').val(2);
							//$('#disc_3').val(3);							
							//alert("here");
		                    $('#description').val(obj.description);
		                    hitung();
		                },
		                error: function(msg){alert(msg);}
		    });
		};
		function hitung(){
	        if($('#quantity').val()==0)$('#quantity').val(1);
	        gross=$('#quantity').val()*$('#price').val();
	        d=$('#discount').val();
			d2=d.split("+");
			console.log(d2);
			if(d2.legth==0)   	$('#discount').val(disc_prc);
			gross_disc=gross;
			for(i=0;i<d2.length;i++){
				disc_prc=d2[i];
				if(disc_prc>1){
					disc_prc=disc_prc/100;
				}	
				disc_amt=Math.round(gross_disc*disc_prc,2);
				gross_disc=gross_disc-disc_amt;
			}
	        $('#amount').val(gross_disc);			
		}


	</script>
	
	
	
<div id="dlg" class="easyui-dialog" style="width:400px;height:380px;left:100px;top:20px;padding:10px 20px"
        closed="true" buttons="#dlg-buttons">
    <div class="ftitle">Pilih nama barang untuk [<?=$sales_order_number?>]</div>
    <form id="fm" method="post">
        <div class="fitem"><label>Kode Barang:</label>
            <input id="item_number" name="item_number"   class="easyui-validatebox" required="true">
        </div>
        <div class="fitem"><label>Nama Barang:</label>
            <input id="description" name="description">
        </div>
        <div class="fitem"><label>Qty:</label>
            <input id="quantity" name="quantity" onblur="hitung()">
        </div>
        <div class="fitem"><label>Harga:</label>
        	<input id="price" name="price"  onblur="hitung()" class="easyui-validatebox" validType="numeric">
        </div>
        <div class="fitem"><label>Discount%:</label>
        	<input id="discount" name="discount"  onblur="hitung()" class="easyui-validatebox" validType="numeric">
        </div>
        <div class="fitem"><label>Jumlah:</label>
        	<input id="amount" name="amount" class="easyui-validatebox" validType="numeric">
        </div>
        <input type='hidden' id='sales_order_number' name='sales_order_number'>
        <input type='hidden' id='line_number' name='line_number'>
    </form>
</div>
<div id="dlg-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveItem()">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
</div>

<script type="text/javascript">
$(function() {
//	url=CI_ROOT+'inventory/lookup_json';
	url='http://localhost/jQuery/jquery-autocomplete-master/demo/search.php?output=json';
 	$("#item_number").autocomplete(url, {
        remoteDataType: 'json',
        processData: function(data) {
			var i, processed = [];
			for (i=0; i < data.length; i++) {
				processed.push([data[i][0] + " - " + data[i][1]]);
			}
			return processed;
        }
    });
    
});    
</script>
    
    
    
    
