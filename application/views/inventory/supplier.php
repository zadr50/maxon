<div id="dlgSupp" class="easyui-dialog"  buttons="#tbSupp"
	style="width:400px;height:300px;padding:5px 5px;left:100px;top:20px" closed="true" >
	<form id="frmSupp" name="frmSupp" method="POST">
	<table class="table2" width="100%">
	<?php 
		$search=link_button('','select_supplier()','search');
		my_input_tr("Kode Supplier","supplier_number","",$search);
		my_input_tr("Nama Supplier","supplier_name");
		my_input_tr("Lead Time (Day)","lead_time");
		my_input_tr("Harga Beli","cost");
		my_input_tr("Kode Barang Supplier","supplier_item_number");
	?>
	</table>
	</form>
</div>
<div id='tbSupp'>
	<?php 
	echo link_button("Save","dlgSupp_Save()","save");
	echo link_button("Close","dlgSupp_Close()","cancel");
	?>
</div>

<script language="JavaScript">
	function select_supplier(){
		var fields=[[
				{field:'supplier_number',title:'Supplier Number',width:100},
				{field:'supplier_name',title:'Supplier Name',width:100},
				{field:'city',title:'City',width:100,align:'left'}
			]];
		var url='<?=base_url()?>index.php/supplier/select/';
		void lookup(fields,"supp",url);
	}
	function on_search_supp(){
		var search=$("#search_item").val();
		var url='<?=base_url()?>index.php/supplier/select/'+search;
		$('#table_supp').datagrid({url:url});
		$('#table_supp').datagrid('reload');
	}
	function on_select_supp(){
		var row = $('#table_supp').datagrid('getSelected');
		if (row){
			$("#frmSupp input[name='supplier_number']").val(row.supplier_number);
			$("#frmSupp input[name='supplier_name']").val(row.supplier_name);
			$("#dialog_supp").dialog("close");
		}
	}
	function dlgSupp_Clear(){
		$("#frmSupp").trigger('reset'); 
	}
	function dlgSupp_Add(){
		dlgSupp_Clear();
		$('#dlgSupp').dialog('open').dialog('setTitle','Supplier Alternative');
	}
	function dlgSupp_Edit(){
		var row = $('#dgSupp').datagrid('getSelected');
		if (row){
			var supplier_number=row.supplier_number;
			if(supplier_number==""){alert("Kode tidak ada !");return false;}
			xurl=CI_ROOT+'inventory/supplier_load/<?=$item_number?>/'+supplier_number;                             
			$.ajax({
				type: "GET", url: xurl,
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#frmSupp input[name=supplier_number]").val(result.supplier_number);
						$("#frmSupp input[name=supplier_name]").val(result.supplier_name);
						$("#lead_time").val(result.lead_time);
						$("#cost").val(result.cost);
						$("#supplier_item_number").val(result.supplier_item_number);
						$('#dlgSupp').dialog('open').dialog('setTitle','Supplier Alternative');
					}
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});       
		}
		
	}
	function dlgSupp_Close(){
		$("#dlgSupp").dialog("close");
	}
	function dlgSupp_Save(){
		url='<?=base_url()?>index.php/inventory/supplier_add/<?=$item_number?>';
		$('#frmSupp').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					dlgSupp_Close();
					dgSupp_Refresh();
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
 	}
 	function dlgSupp_Delete(){
		var item_number=$("#item_number").val();
		var kode='';
		if(item_number==""){alert("Kode belum diisi !");return false}
		var row = $('#dgSupp').datagrid('getSelected');
		if (row) kode=row.supplier_number;
        xurl=CI_ROOT+'inventory/supplier_delete/<?=$item_number?>/'+kode;                             
        $.ajax({
            type: "GET",
            url: xurl,
            success: function(msg){
				dlgSupp_Close();
				dgSupp_Refresh();
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });         
 	}
	
</script>
