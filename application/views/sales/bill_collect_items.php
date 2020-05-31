<div id='dgItemForm' class="easyui-dialog" style="width:800px;height:400px;left:10px;top:10px;padding:5px 5px"
    closed="true" buttons="#tbItemForm" > 
    <form id="frmItem" method='post' >
		<div id='divPilihFaktur'>
		</div>
	 </form> 
</div>
	
 
	
<div id="tbItemForm">
	Find: <?=form_input("tb_search","","id='tb_search'")?>
	<?=link_button("", "tb_search_click();return false","search")?>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
		onclick='close_item();return false;' title='Close'>Cancel</a>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
		onclick='save_item();return false;' title='Save Item'>Submit</a>
</div>
<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem();return false;" data-options="plain:false">Add Faktur</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem();return false" data-options="plain:false">Delete</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="viewItem();return false" data-options="plain:false">View</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="reloadItem();return false" data-options="plain:false">Refresh</a>	
</div>

<script language="JavaScript">
	function tb_search_click(){
		select_faktur();
	}
	function select_faktur(){
		$("#dgItemForm").dialog("open").dialog('setTitle','Pilih nomor faktur');
		var search=$("#tb_search").val();
		var url='<?=base_url()?>index.php/so/bill_collect/select_faktur/?q='+search;
		$.ajax({
			type: "GET",url: url,param: '',
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)	{
					var fakturs=result.faktur;
					var html="<table class='table'><thead><th width=10>X</th><th>Faktur</th><th>Tanggal</th>" +
						"<th>Jumlah</th><th>Saldo</th><th>Company</th></thead><tbody>";
					for(i=0;i<fakturs.length;i++){
					    fkt=fakturs[i].invoice_number;
					    
						html=html+"<tr>";
						html=html+"<td width=10><input type='checkbox' name='faktur[]' id='faktur"+i+"'  value='"+fakturs[i].invoice_number+"' style='width:30px' '></td>";
						html=html+"<td>"+fkt+"</td><td>"+fakturs[i].invoice_date+"</td>";
						html=html+"<td align='right'>"+fakturs[i].amount+"</td>";
						html=html+"<td align='right'>"+fakturs[i].saldo+"</td>";
						html=html+"<td>"+fakturs[i].company+"</td>";
						html=html+"</tr>";
					}
					html=html+"</tbody></table>";
					$("#divPilihFaktur").html(html);								
				}
			},
			error: function(msg){log_err(msg);}
		});					
	}
	function addItem(){
		var mode=$('#mode').val();
		if(mode=="add"){
			log_err("Simpan dulu sebelum pilih faktur !");
			return false;
		}
		select_faktur();			
	}
	function close_item(){
		clear_input();
		$("#dgItemForm").dialog("close");	
	}
	function save_item(){
		var url = '<?=base_url()?>index.php/so/bill_collect/save_item';
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
		var xurl='<?=base_url()?>index.php/so/bill_collect/items/'+nomor;
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
					url='<?=base_url()?>index.php/so/bill_collect/delete_item/'+row.id;
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
			$('#tanggal').val(row.invoice_date);
			$('#jumlah').val(row.amount);
			$('#saldo').val(row.saldo);
			$('#id').val(row.id);
		}
		$("#dgItemForm").dialog("open");
	}
</script>
