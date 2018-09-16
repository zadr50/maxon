<?php date_default_timezone_set("Asia/Jakarta"); ?>

<div id="lstPeriode" class="col-md5 thumbnail" >
	<strong>Pilih Periode: </strong>
	<input id='periode' name='periode' type='text' class="input-small" value='<?=date('Y-m')?>'>
	<?=link_button('Cari','lookup_periode();return false;','search')?> 
	<?=link_button('Recalc','load_asset(true);return false;','remove')?> 
	<div style="float:right">
		<?=link_button('Help', 'load_help(\'aktiva_proses\')','help');?>			
		<?=link_button("Close","remove_tab_parent();return false","cancel")?></div>
</div>
<div id="divAktiva" class="col-md-6 thumbnail">
		<table id="dgAktiva" class="easyui-datagrid"  
			style="width:800px;min-height:600px"
			data-options="iconCls: 'icon-edit',
				singleSelect: true,	toolbar: '',url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'id',width:80">Nomor Aktiva</th>
					<th data-options="field:'description',width:380">Nama Aktiva</th>
					<th data-options="field:'depr_amount',width:90,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Penyusutan</th>
					<th data-options="field:'book_amount',width:90,align:'right',editor:'numberbox',
						formatter: function(value,row,index){
							return number_format(value,2,'.',',');}">Nilai Buku</th>
				</tr>
			</thead>
		</table>

</div>

<?=load_view("gl/select_periode");?>

<script  language="javascript">
	function load_asset(reload=false) {
		var periode=$("#periode").val();		
		$('#dgAktiva').datagrid({url:'<?=base_url()?>index.php/aktiva/aktiva_proses/load/'+periode+'/'+reload});
		$('#dgAktiva').datagrid('reload');		
	}
	function view_asset(id){
		var url=CI_ROOT+"aktiva/aktiva/view/"+id;
		add_tab_parent("View:"+id,url);
	}
    $().ready(function (){
        $('#dgAktiva').datagrid({
            onDblClickRow:function(){
			var row = $('#dgAktiva').datagrid('getSelected');
			if (row){
            	view_asset(row.id);
            }
            }
        });        
    });
	function select_periode() {
		var row = $('#dgPeriode').datagrid('getSelected');
		if (row){
			$('#periode').val(row.period);
			$('#dlgPeriode').dialog('close');
			load_asset();
		}			
	}



	 
	
</script>

