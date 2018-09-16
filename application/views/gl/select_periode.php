<!-- DIALOG PERIODE -->
<div id='dlgPeriode' class="easyui-dialog"  style="width:600px;height:380px;padding:5px 5px;left:100px;top:20px"
closed="true" 
>
		<table id="dgPeriode" class="easyui-datagrid"  
		data-options="toolbar: '#tbPeriode', singleSelect: true,
			url: ''">
			<thead>
				<tr>
					<th data-options="field:'period',width:80">Periode</th>
					<th data-options="field:'startdate',width:80">Start Date</th>
					<th data-options="field:'enddate',width:80">End Date</th>
					<th data-options="field:'closed',width:80">Closed</th>
				</tr>
			</thead>
		</table>
</div>
<div id="tbPeriode" style="height:auto">
	Enter Text: <input  id="search_periode" style='width:180' name="search_periode" onchange="lookup_periode();return false;" >
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
	onclick="lookup_periode();return false"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="false" onclick="select_periode();return false;">Select</a>
	<div style="float:right"><?=link_button("Close","remove_tab_parent();return false","cancel")?></div>
</div>
<script type="text/javascript">
    $().ready(function (){
        $('#dgPeriode').datagrid({
            onDblClickRow:function(){
            	select_periode();
            }
        });        
    });

	function lookup_periode() {
		$('#dlgPeriode').dialog('open').dialog('setTitle','Cari periode');
		periode=$('#search_periode').val();
		var _url='<?=base_url()?>index.php/periode/select';
		if(periode!="")_url=_url+"/"+periode;
		$('#dgPeriode').datagrid({url:_url});
		$('#dgPeriode').datagrid('reload');
	}
	function select_periode() {
		var row = $('#dgPeriode').datagrid('getSelected');
		if (row){
			$('#periode').val(row.period);
			$('#dlgPeriode').dialog('close');
		}			
	}
</script>
<!-- END DIALOG PERIODE -->
