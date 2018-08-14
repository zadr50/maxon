<div class="thumbnail box-gradient">
	<?
	echo link_button('Add','','add','false',base_url().'index.php/periode/add');		
	echo link_button('Search','','search','false',base_url().'index.php/periode');		
	echo link_button('Save', 'save_periode();return false;','save');		
	echo link_button('Closing', '','edit','false',base_url().'index.php/periode/closing/'.$period);		
	echo link_button('ReOpen', '','edit','false',base_url().'index.php/periode/reopen/'.$period);		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'periode\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('periode')">Help</div>
		<div onclick="show_syslog('periode','<?=$period?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div> 
<?php 
	echo validation_errors();
	if($mode=='view'){
		echo form_open('periode/update','id=\'myform\' name=\'myform\' class=\'form-horizontal\' role=form');
		$disabled='disable';
	} else {
		$disabled='';
		echo form_open('periode/add','id=myform name=myform  class=form-horizontal  role=form'); 
	}
?>
<table class='table' >
<? 
	echo my_input_tr("Periode Id",'period',$period);
	echo my_input_tr("Periode Month",'month_name',$month_name);
	echo my_input_tr("Year",'year_id',$year_id);
	echo my_input_tr("Sequence",'sequence',$sequence);
	echo my_input_date_tr("Start Dtae",'startdate',$startdate);
	echo my_input_date_tr("End Date",'enddate',$enddate);
	echo "<tr><td>Sudah Tutup Buku ?</td>
		<td colspan='2'>".form_radio('closed','No',$closed=='0'||$closed=='')
		." &nbsp No ".form_radio('closed','Yes',!($closed=='0'||$closed==''))
		." &nbsp Yes </td></tr>";
	echo "</table>";
	echo form_close();
?>
<div title='Beginning Balance'>
	<legend>Saldo Awal</legend>
	<p>Dibawah ini adalah saldo awal dan akhir untuk periode diatas</p>
	<table id='dgSaldo' name='dgSaldo' class="easyui-datagrid"  width='100%'
		data-options="
			iconCls: 'icon-edit', fitColumns: true,
			singleSelect: true,  
			url: '<?=base_url()?>index.php/periode/saldo_awal/<?=$period?>',
			toolbar:'#tbSaldo'," width="100%">
		<thead>
			<tr>
				<th data-options="field:'account',width:80">Account</th>
				<th data-options="field:'account_description',width:180">Account Description</th>
				<th data-options="field:'beginning_balance',width:80,align:'right'">Awal</th>
				<th data-options="field:'debit_base',width:80,align:'right'">Debit</th>
				<th data-options="field:'credit_base',width:80,align:'right'">Credit</th>
				<th data-options="field:'ending_balance',width:80,align:'right'">Akhir</th>
				<th data-options="field:'company_code',width:180,align:'left'">Keterangan</th>
			</tr>
		</thead>
	</table>
</div>
				
<script type="text/javascript">
    function save_periode(){
        if($('#period').val()===''){alert('Isi dulu kode periode !');return false;};
        if($('#year_id').val()===''){alert('Isi dulu tahun !');return false;};
        $('#myform').submit();
    }
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/periode");
	}
</script>
	
