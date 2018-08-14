<!-- PILIH PELANGGAN --> 
<div id='dlgSelectSupp'class="easyui-dialog" style="width:600px;
	height:380px;padding:10px 20px;left:100px;top:20px;left:100px;top:20px"
	
     closed="true" toolbar="#button-select-supp">
     <div id='divSelectSupp'> 
		<table id="dgSelectSupp" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '',fitColumns: true, 
				singleSelect: true,pagination:true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'supplier_name',width:180">Supplier</th>
					<th data-options="field:'supplier_number',width:80">Kode</th>
                    <th data-options="field:'first_name',width:80">Kontak Person</th>
					<th data-options="field:'city',width:80">Kota</th>
					<th data-options="field:'region',width:80">Wilayah</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="button-select-supp" class="thumbnail box-gradient" style="height:auto">
	Enter Text: <input id="search_supp_lov" style='width:180' name="search_supp_lov">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  onclick="filter_supplier();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selected_supplier();return false;">Select</a>
</div>


<SCRIPT language="javascript">
	function select_supplier(){
		//$('#dlgSelectSupp').window({left:100,top:window.event.clientY-50});
		filter_supplier();
	};	
	function filter_supplier(){
        $('#dlgSelectSupp').dialog('open').dialog('setTitle','Cari nama supplier');
        var search=$('#search_supp_lov').val();
        var xurl='<?=base_url()?>index.php/supplier/select/'+search;
        console.log(xurl);
        $('#dgSelectSupp').datagrid({url:xurl});
	}
	function selected_supplier(){
		var row = $('#dgSelectSupp').datagrid('getSelected');
		if (row){
			$('#supplier_number').val(row.supplier_number);
			$('#supplier_name').val(row.supplier_name);
			$('#supplier_name').html(row.supplier_name);
			$("#contact_person").val(row.first_name);
			$('#dlgSelectSupp').dialog('close');
		} else {
			alert("Pilih salah satu nomor supplier !");
		}
	}	
	function dlgSelectSupp_Close(){
		$("#dlgSelectSupp").dialog("close");
	}
</SCRIPT>
<!-- END PILIH PELANGGAN -->

