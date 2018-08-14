<div id='dgItemForm' class="easyui-dialog" style="width:800px;height:400px;left:10px;top:10px;padding:5px 5px"
    closed="true" buttons="#tbItemForm" > 
	    <form id="frmItem" method='post' >
			<div id='divPilihFaktur'>
			</div>
		 </form>
 
	</div>
	
 
	
<div id="tbItemForm">
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
		onclick='close_item();return false;' title='Close'>Cancel</a>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
		onclick='save_item();return false;' title='Save Item'>Submit</a>
</div>
<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem()" data-options="plain:false">Add Faktur</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItemRecv()" data-options="plain:false">Add Receive</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem()" data-options="plain:false">Delete</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="viewItem()" data-options="plain:false">View</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="reloadItem()" data-options="plain:false">Refresh</a>	
</div>

<script language="JavaScript">
    function addItemRecv(){
        var nomor=$('#nomor').val();
        if(nomor=='' || nomor=="AUTO"){alert('Isi nomor kontra bon, atau disimpan dulu !');return false;}
        
        dlgrecv_po_show();
    }
    function add_receive_no(nomor_recv){
        console.log(nomor_recv); 
        var nomor_kontra=$("#nomor").val();
        $.ajax({
            type: "GET",url: CI_ROOT+"po/kontra_bon/add_receive_no/"+nomor_recv+"/"+nomor_kontra,
            success: function(result){
                var result = eval('('+result+')');
                if (result.success) {
                     $("#amount").val(result.amount);
                    void reloadItem();
                    
                }
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });
          
    }
	function addItem(){
		var mode=$('#mode').val();
		if(mode=="add"){
			alert("Simpan dulu sebelum tambah item barang !");
			return false;
		}
		var supplier=$("#supplier_number").val();
		if(supplier==""){
			alert("Supplier belum diisi !");
			return false;
		}
		//$('#dgItemForm').window({left:100,top:window.event.clientY+20});
		$("#dgItemForm").dialog("open").dialog('setTitle','Pilih nomor faktur');
		var url='<?=base_url()?>index.php/po/kontra_bon/select_faktur/'+supplier;
		$.ajax({
			type: "GET",url: url,param: '',
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)	{
					var fakturs=result.faktur;
					var html="<table class='table'><thead><th width=10>X</th><th>Faktur</th><th>Tanggal</th><th>Termin</th><th>Jth Tempo</th>" +
						"<th>Jumlah</th><th>Saldo</th><th>Recv No</th></thead><tbody>";
					for(i=0;i<fakturs.length;i++){
					    fkt=fakturs[i].purchase_order_number;
					    
						html=html+"<tr>";
						html=html+"<td width=10><input type='checkbox' name='faktur[]' id='faktur"+i+"'  value='"+fakturs[i].purchase_order_number+"' style='width:30px' '></td>";
						html=html+"<td>"+fkt+"</td><td>"+fakturs[i].po_date+"</td>";
						html=html+"<td>"+fakturs[i].terms+"</td><td>"+fakturs[i].due_date+"</td><td>"+fakturs[i].amount+"</td>";
						html=html+"<td>"+fakturs[i].saldo+"</td>";
                        html=html+"<td>"+fakturs[i].recv_no+"</td>";
						html=html+"</tr>";
					}
					html=html+"</tbody></table>";
					$("#divPilihFaktur").html(html);								
				}
			},
			error: function(msg){$.messager.alert('Info',msg);}
		});				
	}
	function close_item(){
		clear_input();
		$("#dgItemForm").dialog("close");	
	}
	function save_item(){
		var url = '<?=base_url()?>index.php/po/kontra_bon/save_item';
		var nomor =$('#nomor').val();
		if($("#mode").val()=="add"){alert("Simpan dulu nomor ini.");return false;};
		$('#nomor').val(nomor);
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
				    $("#amount").val(result.amount);
					$('#dg').datagrid({url:'<?=base_url()?>index.php/po/kontra_bon/items/'+nomor});
					$('#dg').datagrid('reload');
					$.messager.show({
						title: 'Success',
						msg: 'Success'
					});
					close_item();
					
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
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
		var nomor=$('#nomor').val();
		var xurl='<?=base_url()?>index.php/po/kontra_bon/items/'+nomor;
		$('#dg').datagrid({url: xurl});
		$('#dg').datagrid('reload');	// reload the user data
	}
	function viewItem(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            var faktur=row.faktur;
            var _url=CI_ROOT+"purchase_invoice/view/"+faktur;
            add_tab_parent("View_"+faktur,_url);
            
        }
	    
	}
	function deleteItem(){
		var po=$('#nomor').val();
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/po/kontra_bon/delete_item/'+row.id;
					$.ajax({
						type: "GET",url: url,param: '',
						success: function(result){
							var result = eval('('+result+')');
							if (result.success)	{
							     $("#amount").val(result.amount);
							    void reloadItem();
							    
							}
						},
						error: function(msg){$.messager.alert('Info',msg);}
					});
				}
			})
		}
	}
	function editItem(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			console.log(row);
			$('#frmItem').form('load',row);
			$('#faktur').val(row.faktur);
			$('#tanggal').val(row.tanggal);
			$('#jumlah').val(row.jumlah);
			$('#saldo').val(row.saldo);
			$('#id').val(row.id);
		}
		//$('#dgItemForm').window({left:100,top:window.event.clientY+20});
		$("#dgItemForm").dialog("open");
	}
</script>
