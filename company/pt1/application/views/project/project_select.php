<!-- PILIH PROYEK --> 
<div id='dlgSelectPrj'class="easyui-dialog" style="width:600px;height:380px;
padding:5px 5px;left:100px;top:20px"
     closed="true" buttons="#btn1">
     <div id='divSelectPrj'> 
		<table id="dgSelectPrj" class="easyui-datagrid"  width='100%'
			data-options="
				toolbar: '',fitColumns: true, 
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'keterangan',width:'180'">Nama Proyek</th>
					<th data-options="field:'kode',width:'80'">Kode</th>
					<th data-options="field:'lokasi',width:'80'">Lokasi</th>
					<th data-options="field:'tgl_mulai',width:'80'">Tanggal Mulai</th>
					<th data-options="field:'tgl_selesai',width:'80'">Tanggal Selesai</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="btn1" name="btn1" class='box-gradient'>
	<input  id="search_prj" style='width:100' name="search_prj" placeholder='Search'>
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="select_project();return false;">Cari</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="selected_project();return false;">Pilih</a>
</div>
<SCRIPT language="javascript">
	function select_project(){
			search=$('#search_prj').val();
			$('#dlgSelectPrj').dialog('open').dialog('setTitle','Cari Data Proyek');
			$('#dgSelectPrj').datagrid({url:'<?=base_url()?>index.php/project/project/select/'+search});
			$('#dgSelectPrj').datagrid('reload');
	};	
	function selected_project(){
		var row = $('#dgSelectPrj').datagrid('getSelected');
		if (row){
			$('#project_code').val(row.kode);
			$('#project_name').val(row.keterangan);
			$('#dlgSelectPrj').dialog('close');
		} else {
			alert("Pilih salah nama proyek !");
		}
	}	
</SCRIPT>
<!-- END PILIH PROYEK -->