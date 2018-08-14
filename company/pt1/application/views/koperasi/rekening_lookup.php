<!-- PILIH NOMOR REKENING --> 
<div id='dlgSelectRek'class="easyui-dialog" style="width:600px;height:380px;padding:10px 20px;left:100px;top:20px"
     closed="true" buttons="#tbRek">
     <div id='divSelectRek'> 
		<table id="dgSelectRek" class="easyui-datagrid"  
			data-options="
				toolbar: '',
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'no_simpanan',width:80">Nomor</th>
					<th data-options="field:'no_anggota',width:80">Nomor Anggota</th>
					<th data-options="field:'nama',width:180">Nama Anggota</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="tbRek" class="thumbnail" style="height:auto">
	Enter Text: <input id="search_Rek_lov" style='width:180' name="search_Rek_lov">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="select_Rek();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="selected_Rek();return false;">Select</a>
</div>


<SCRIPT language="javascript">
	function select_Rek(){
			$('#dlgSelectRek').dialog('open').dialog('setTitle','Cari nomor rekening');
			var search=$('#search_Rek_lov').val();
			var xurl='<?=base_url()?>index.php/koperasi/rekening/select/'+search;
			console.log(xurl);
			$('#dgSelectRek').datagrid({url:xurl});
			$('#dgSelectRek').datagrid('reload');
	};	
	function selected_Rek(){
		var row = $('#dgSelectRek').datagrid('getSelected');
		if (row){
			$('#no_simpanan').val(row.no_simpanan);
			$('#no_anggota').val(row.no_anggota);
			$('#nama').val(row.nama);
			$('#dlgSelectRek').dialog('close');
		} else {
			alert("Pilih salah satu nomor  !");
		}
	}	
</SCRIPT>
<!-- END PILIH -->

