<div id="dlgAsm" class="easyui-dialog"  buttons="#tbAsm"
	style="width:400px;height:300px;padding:5px 5px;left:100px;top:20px" closed="true" >
	<form id="frmAsm" name="frmAsm" method="POST">
	<table class="table2" width="100%">
		<?
		$search=link_button('','frmAsm_CariBarang()','search');
		my_input_tr("Kode Baramg","assembly_item_number","",$search);
		my_input_tr("Nama Baramg","description");
		my_input_tr("Quantity","quantity");
		my_input_tr("Cost","default_cost");
		my_input_tr("Comment","comment");
		?>
	</table>
	</form>
</div>
<div id='tbAsm'>
	<? 
	echo link_button("Save","dlgAsm_Save()","save");
	echo link_button("Close","dlgAsm_Close()","cancel");
	?>
</div>
 

<script language="JavaScript">
	function frmAsm_CariBarang(){
		var fields=[[
				{field:'item_number',title:'Item Number',width:100},
				{field:'description',title:'Name',width:100},
				{field:'cost',title:'Cost',width:100,align:'right'}
			]];
		var url='<?=base_url()?>index.php/inventory/filter/';
		void lookup(fields,"item",url);
	}
	function on_search_item(){
		var search=$("#search_item").val();
		var url='<?=base_url()?>index.php/inventory/filter/'+search;
		$('#table_item').datagrid({url:url});
		$('#table_item').datagrid('reload');
	}
	function on_select_item(){
		var row = $('#table_item').datagrid('getSelected');
		if (row){
			$("#quantity").val(1);
			$("#assembly_item_number").val(row.item_number);
			$("#frmAsm input[name=description]").val(row.description);
			$("#default_cost").val(row.cost);
			$("#dialog_item").dialog("close");
		}
	}
	function dlgAsm_Clear(){
		$("#assembly_item_number").val("");
		$("#frmAsm input[name=description]").val("");
		$("#quantity").val("");
		$("#default_cost").val("");
		$("#comments").val("");
	}
	function dlgAsm_Add(){
		var item_no=$("#item_number").val();
		if(item_no==""){alert("Kode Barang belum diisi !");return false;}
		dlgAsm_Clear();
		$("#dlgAsm").dialog('open').dialog('setTitle','Assembly Items');
	}
	function dlgAsm_Edit(){
		var row = $('#dgAsm').datagrid('getSelected');
		if (row){
			var assembly_item_number=row.assembly_item_number;
			if(assembly_item_number==""){alert("Kode tidak ada !");return false;}
			xurl=CI_ROOT+'inventory/assembly_load/<?=$item_number?>/'+assembly_item_number;                             
			$.ajax({
				type: "GET", url: xurl,
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#assembly_item_number").val(result.assembly_item_number);
						$("#frmAsm input[name=description]").val(result.description);
						$("#quantity").val(result.quantity);
						$("#default_cost").val(result.default_cost);
						$("#comment").val(result.comment);
						$('#dlgAsm').dialog('open').dialog('setTitle','Assembly');
					}
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});       
		}
		
	}
	function dlgAsm_Close(){
		$("#dlgAsm").dialog("close");
	}
	function dlgAsm_Save(){
		url='<?=base_url()?>index.php/inventory/assembly_add/<?=$item_number?>';
		$('#frmAsm').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					dlgAsm_Close();
					dgAsm_Refresh();
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
 	}
 	function dlgAsm_Delete(){
		var item_number=$("#item_number").val();
		var kode='';
		if(item_number==""){alert("Kode belum diisi !");return false}
		var row = $('#dgAsm').datagrid('getSelected');
		if (row) kode=row.assembly_item_number;
        xurl=CI_ROOT+'inventory/assembly_delete/<?=$item_number?>/'+kode;                             
        $.ajax({
            type: "GET",
            url: xurl,
            success: function(msg){
				dlgAsm_Close();
				dgAsm_Refresh();
            },
            error: function(msg){$.messager.alert('Info',msg);}
        });         
 	}
	
</script>