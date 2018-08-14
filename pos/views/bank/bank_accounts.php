
<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/banks/add');		
	echo link_button('Search','','search','false',base_url().'index.php/banks');		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/banks/view/'.$bank_account_number);		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'banks\')','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('banks')">Help</div>
		<div onclick="show_syslog('banks','<?=$bank_account_number?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="easyui-tabs" >
	<div title="General" style="padding:10px">
	
		<div class="thumbnail">	
		<form id="myform"  method="post" action="<?=base_url()?>index.php/banks/save">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		<?php echo validation_errors(); ?>
		<table class="table" width="100%">
			<tr>
				<td>Nomor Rekening / Kode</td><td>
				<?php
				if($mode=='view'){
					echo "<strong>".$bank_account_number."</strong>";
					echo form_hidden('bank_account_number',$bank_account_number);
				} else { 
					echo form_input('bank_account_number',$bank_account_number);
				}		
				?></td>
			</tr>	 
			   <tr>
					<td>Nama Bank / Kas</td><td><?php echo form_input('bank_name',$bank_name);?></td>
			   </tr>
			   <tr>
					<td>Jenis		</td><td><?php echo form_dropdown('type_bank',array("Bank","Kas"),$type_bank,"style='width:200px'");?></td>
			   </tr>
			   <tr>
					<td>Alamat</td><td><?php echo form_input('street',$street,"style='width:400px;'");?></td>
			   </tr>
			   <tr>
					<td>Kota</td><td><?php echo form_input('city',$city);?></td>
			   </tr>
			   <tr>
					<td>Telp</td><td><?php echo form_input('phone_number',$phone_number);?></td>
			   </tr>
			   <tr>
					<td>Kode Perkiraan Terkait &nbsp;</td>
					<td><?php echo form_input('account_id',$account_id,"id='account_id' style='width:350px'");?>
								<?=link_button('',"lookup_coa('account_id')",'search')?>	
								</td>
			   </tr>

		   </table>
		</form>
		</div>
	</div>

	<DIV title="Cards" style="padding:10px">
		<div class='thumbnail'>
			<form method="post">
			<table width="100%" class="table2">
			<tr><td>Date From</td>
			<td><?=form_input('date_from',date("Y-m-d"),'id=date_from class="easyui-datetimebox" 
				data-options="formatter:format_date,parser:parse_date"  ');?></td>
			<td>Date To</td>
			<td><?=form_input('date_to',date("Y-m-d"),'id=date_to  class="easyui-datetimebox"
				data-options="formatter:format_date,parser:parse_date"  ');?></td>
			<td><?=link_button('Search','search_cards()','search');?></td>
			</tr>
			</table>
			</form>
		</div>
	
		<table id="dgCard" class="easyui-datagrid"  
			style="width:auto;height:auto"
			data-options="
				iconCls: 'icon-edit',fitColumns: true,
				singleSelect: true,toolbar: '#tbRetur',
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'voucher',width:80">Nomor</th>
					<th data-options="field:'check_date',width:80">Tanggal</th>
					<th data-options="field:'trans_type',width:80">Type</th>
					<th data-options="field:'deposit_amount',width:100,align:'right'">Masuk</th>
					<th data-options="field:'payment_amount',width:100,align:'right'">Keluar</th>
					<th data-options="field:'saldo',width:100,align:'right'">Saldo</th>
					<th data-options="field:'supplier_number',width:50">Kode</th>
					<th data-options="field:'payeee',width:50">Nama</th>
					<th data-options="field:'memo',width:150">Memo</th>
				</tr>
			</thead>
		</table>
	
	</DIV>
</div>

<?=load_view('gl/select_coa_link')?>   
  
<script type="text/javascript">
    function save_this(){
        if($('#bank_account_number').val()===''){alert('Isi dulu kode bank !');return false;};
        if($('#bank_name').val()===''){alert('Isi dulu nama bank !');return false;};
        $('#myform').submit();
    }
	function search_cards()
	{
		var d1=$("#date_from").datebox('getValue');
		var d2=$("#date_to").datebox('getValue');
	 
		var xurl='<?=base_url()?>index.php/banks/list_trans/<?=$bank_account_number?>/?d1='+d1+'&d2='+d2;
		console.log(xurl);
		$('#dgCard').datagrid({url:xurl});
		$('#dgCard').datagrid('reload');
	}
	
</script>  

 