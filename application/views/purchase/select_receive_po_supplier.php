<div id='dlgSelectReceive'class="easyui-dialog" style="width:800px;height:380px;
padding:10px 20px;left:100px;top:20px"
     closed="true" buttons="#btnSelectReceive">
	 <form id='frmReceive' method='post'>
     <div id='divSelectReceive'> 
		  
    </div>   
	</form>
</div>
<div id="btnSelectReceive" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="false" onclick="selected_received_no();return false;">Proses</a>
</div>
<SCRIPT language="javascript">
	function select_receive(){
		var supplier=$("#supplier_number").val();
		if(supplier==""){alert("Pilih supplier dulu !");return false};
		if($("#mode").val()=="add"){alert("Simpan dulu nomor ini !");return false};
		
		var url='<?=base_url()?>index.php/receive_po/list_open/'+supplier;
		var param='';
		void get_this(url,param,'divSelectReceive');
		$('#dlgSelectReceive').dialog('open').dialog('setTitle','Cari nomor receive');

	};	
	function selected_received_no(){
		$('#dgSelectReceive').dialog('close');
		var nomor=$("#purchase_order_number").val();
		var url='<?=base_url()?>index.php/receive_po/create_new_invoice/'+nomor;
			$('#frmReceive').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
					    $("#ref1").val(result.ref1);
					    $("#po_ref").val(result.ref2);
						$('#dlgSelectReceive').dialog('close');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+nomor+'/json'});
						$('#dg').datagrid('reload');					
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
	}	
</SCRIPT>


