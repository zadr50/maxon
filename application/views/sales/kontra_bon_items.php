<div id='dgItemForm' class="easyui-dialog" style="width:800px;height:400px;left:10px;top:10px;padding:5px 5px"
    closed="true" buttons="#tbItemForm" > 
	    <form id="frmItem" method='post' >
			<div id='divPilihFaktur'>
			</div>
			<?=form_input("row_type","","id='row_type'")?>
		 </form>
 
	</div>
	
 
	
<div id="tbItemForm">
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
		onclick='close_item();return false;' title='Close'>Cancel</a>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
		onclick='save_item();return false;' title='Save Item'>Submit</a>
</div>
<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem();return false;" data-options="plain:false">Add Faktur</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addRetur();return false;" data-options="plain:false">Add Retur</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem();return false" data-options="plain:false">Delete</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="viewItem();return false" data-options="plain:false">View</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="reloadItem();return false" data-options="plain:false">Refresh</a>	
</div>

<script language="JavaScript">
	function addItem(){
		var mode=$('#mode').val();
		if(mode=="add"){
			log_err("Simpan dulu sebelum pilih faktur !");
			return false;
		}
		var customer=$("#customer_number").val();
		if(customer==""){
			log_err("Kode Pelanggan belum diisi !");
			return false;
		}
		$("#row_type").val("faktur");
		
		//$('#dgItemForm').window({left:100,top:window.event.clientY+20});
		$("#dgItemForm").dialog("open").dialog('setTitle','Pilih nomor faktur');
		var url='<?=base_url()?>index.php/so/kontra_bon/select_faktur/'+customer;
		$.ajax({
			type: "GET",url: url,param: '',
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)	{
					var fakturs=result.faktur;
					var html="<table class='table'><thead><th width=10>X</th><th>Faktur</th><th>Tanggal</th><th>Termin</th><th>Jth Tempo</th>" +
						"<th>Jumlah</th><th>Saldo</th></thead><tbody>";
					for(i=0;i<fakturs.length;i++){
					    fkt=fakturs[i].invoice_number;
					    
						html=html+"<tr>";
						html=html+"<td width=10><input type='checkbox' name='faktur[]' id='faktur"+i+"'  value='"+fakturs[i].invoice_number+"' style='width:30px' '></td>";
						html=html+"<td>"+fkt+"</td><td>"+fakturs[i].invoice_date+"</td>";
						html=html+"<td>"+fakturs[i].payment_terms+"</td><td>"+fakturs[i].due_date+"</td><td>"+fakturs[i].amount+"</td>";
						html=html+"<td>"+fakturs[i].saldo+"</td>";
						html=html+"</tr>";
					}
					html=html+"</tbody></table>";
					$("#divPilihFaktur").html(html);								
				}
			},
			error: function(msg){log_err(msg);}
		});				
	}
	function addRetur(){
		var mode=$('#mode').val();
		if(mode=="add"){
			log_err("Simpan dulu sebelum pilih faktur !");
			return false;
		}
		var customer=$("#customer_number").val();
		if(customer==""){
			log_err("Kode Pelanggan belum diisi !");
			return false;
		}
		$("#row_type").val("retur");
		
		//$('#dgItemForm').window({left:100,top:window.event.clientY+20});
		$("#dgItemForm").dialog("open").dialog('setTitle','Pilih nomor faktur');
		var url='<?=base_url()?>index.php/so/kontra_bon/select_retur/'+customer;
		$.ajax({
			type: "GET",url: url,param: '',
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)	{
					var fakturs=result.faktur;
					var html="<table class='table'><thead><th width=10>X</th><th>Faktur</th><th>Tanggal</th><th>Termin</th><th>Jth Tempo</th>" +
						"<th>Jumlah</th><th>Saldo</th></thead><tbody>";
					for(i=0;i<fakturs.length;i++){
					    fkt=fakturs[i].invoice_number;
					    
						html=html+"<tr>";
						html=html+"<td width=10><input type='checkbox' name='faktur[]' id='faktur"+i+"'  value='"+fakturs[i].invoice_number+"' style='width:30px' '></td>";
						html=html+"<td>"+fkt+"</td><td>"+fakturs[i].invoice_date+"</td>";
						html=html+"<td>"+fakturs[i].payment_terms+"</td><td>"+fakturs[i].due_date+"</td><td>"+fakturs[i].amount+"</td>";
						html=html+"<td>"+fakturs[i].saldo+"</td>";
						html=html+"</tr>";
					}
					html=html+"</tbody></table>";
					$("#divPilihFaktur").html(html);								
				}
			},
			error: function(msg){log_err(msg);}
		});				
	}	
	function close_item(){
		clear_input();
		$("#dgItemForm").dialog("close");	
	}
	function save_item(){
		var url = '<?=base_url()?>index.php/so/kontra_bon/save_item';
		var nomor =$('#bill_id').val();
		if($("#mode").val()=="add"){alert("Simpan dulu nomor ini.");return false;};
		$('#bill_id').val(nomor);
		loading();
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
			    loading_close();
				var result = eval('('+result+')');
				if (result.success){
				    $("#amount").val(result.amount);
				    reloadItem();
					log_msg("Success");
					close_item();
				} else {
				    log_err(result.msg);
				}
			}
		});
	}
	function clear_input(){
		$('#frmItem').form('clear');
		$('#faktur').val('');
		$('#tanggal').val('');
		$('#amount').val('0');
		$('#saldo').val('0');
	}
	function reloadItem(){
		var nomor=$('#bill_id').val();
		var xurl='<?=base_url()?>index.php/so/kontra_bon/items/'+nomor;
		$('#dg').datagrid({url: xurl});
	}
	function viewItem(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            var faktur=row.invoice_number;
            var _url=CI_ROOT+"invoice/view/"+faktur;
            add_tab_parent("View_"+faktur,_url);
            
        }
	    
	}
	function deleteItem(){
		var bill_id=$('#bill_id').val();
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/so/kontra_bon/delete_item/'+row.id;
					$.ajax({
						type: "GET",url: url,param: '',
						success: function(result){
							var result = eval('('+result+')');
							if (result.success)	{
							     $("#amount").val(result.amount);
							    void reloadItem();
							    
							}
						},
						error: function(msg){log_err(msg);}
					});
				}
			})
		}
	}
	function editItem(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#frmItem').form('load',row);
			$('#invoice_number').val(row.faktur);
			$('#tanggal').val(row.tanggal);
			$('#jumlah').val(row.jumlah);
			$('#saldo').val(row.saldo);
			$('#id').val(row.id);
		}
		$("#dgItemForm").dialog("open");
	}
</script>
