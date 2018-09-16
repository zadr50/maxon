<div id='dlgSelectReceive'class="easyui-dialog" style="width:700px;height:380px;
padding:10px 20px;left:10px;top:20px"
     closed="true" buttons="#btnSelectReceive">
	 <form id='frmReceive' method='post'>
     <div id='divSelectReceive'> 
		  
    </div>   
	</form>
</div>
<div id="btnSelectReceive" style="height:auto">
    <?=link_button('Close','dlgSelectReceive_Close()','cancel');?>      	
	<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="selected_received_no();return false;">Submit</a>
</div>
<SCRIPT language="javascript">
	function dlgSelectReceive_Close(){
		$('#dlgSelectReceive').dialog('close');
	}
	function select_receive(){
		var supplier=$("#supplier_number").val();
		if(supplier==""){
			log_err("Pilih supplier dulu ! Untuk loading nomor receive berdasarkan supplier bersangkutan.");
			return false;
			
		}
		if($("#mode").val()=="add"){log_err("Simpan dulu nomor ini untuk meneruskan memilih nomor receive! ");return false};
		
		var url='<?=base_url()?>index.php/receive_po/list_open/'+supplier;
		var param='';
		void get_this(url,param,'divSelectReceive');
		$('#dlgSelectReceive').dialog('open').dialog('setTitle','Cari nomor receive');

	};	
	function selected_received_no(){
		$('#dgSelectReceive').dialog('close');
		loading();
		
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
						save_po();
						//$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+nomor+'/json'});
						//$('#dg').datagrid('reload');					
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


