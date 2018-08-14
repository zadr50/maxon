<!-- PILIH JENIS SIMPANAN --> 
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
					<th data-options="field:'kode',width:80">Nomor</th>
					<th data-options="field:'no_anggota',width:80">Nomor</th>
					<th data-options="field:'nama',width:180">Nama Anggota</th>
					<th data-options="field:'join_date',width:80">Tanggal</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="tbAng" class="thumbnail" style="height:auto">
	Enter Text: <input id="search_ang_lov" style='width:180' name="search_ang_lov">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="select_anggota();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="selected_anggota();return false;">Select</a>
</div>


<SCRIPT language="javascript">
	function select_anggota(){
			$('#dlgSelectAng').dialog('open').dialog('setTitle','Cari nama anggota');
			var search=$('#search_ang_lov').val();
			var xurl='<?=base_url()?>index.php/koperasi/anggota/select/'+search;
			console.log(xurl);
			$('#dgSelectAng').datagrid({url:xurl});
			$('#dgSelectAng').datagrid('reload');
	};	
	function selected_anggota(){
		var row = $('#dgSelectAng').datagrid('getSelected');
		if (row){
			$('#no_anggota').val(row.no_anggota);
			$('#nama').val(row.nama);
			$('#dlgSelectAng').dialog('close');
		} else {
			alert("Pilih salah satu nomor  !");
		}
	}	
</SCRIPT>
<!-- END PILIH PELANGGAN -->

