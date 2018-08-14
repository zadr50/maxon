<legend>MASTER PROJECT</legend>
<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/project/project/add');		
	echo link_button('Refresh','','reload','true',base_url().'index.php/project/project/view/'.$kode);		
	echo link_button('Search','','search','true',base_url().'index.php/project/project');		
	echo link_button('Help', 'load_help(\'project\')','help');	
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('project')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
</div>
<div class="thumbnail">	
<form id="myform"  method="post" role="form">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php $err=validation_errors();if($err<>"")echo "<div class='alert alert-warning'>$err</div>"; ?>
<table class="table" width="100%">
	<tr>
		<td>Kode Proyek</td> 
		<td><?php
			if($mode=='view'){
				echo "<h4>".$kode."</h4>";
				echo form_hidden('kode',$kode,"id=kode");
			} else { 
				echo form_input('kode',$kode,"id=kode");
			}?>
		</td>
         <td>Nama Proyek / Keterangan</td>       
         <td><?=form_input('keterangan',$keterangan,' id=keterangan');?></td>
  </tr>
	<tr><td>Pelanggan Terkait</td><td><? echo form_input('client',$client,'id=client');
			if($mode=='add') { 
				echo '<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
				onclick="select_customer();return false;"></a>';
			} 	
		?></td>
		<td>Penanggung Jawab</td><td><?=form_input('person_in_charge',$person_in_charge);?></td>
	</tr>
	<tr><td>Tanggal Mulai</td><td><?=form_input('tgl_mulai',$tgl_mulai,'id=tgl_mulai  class="easyui-datetimebox" required style="width:150px"');?></td>
		<td>Tanggal Selesai</td><td><?=form_input('tgl_selesai',$tgl_selesai,'id=tgl_selesai  class="easyui-datetimebox" required style="width:150px"');?></td>
	</tr>
	<tr><td>Lokasi</td><td><?=form_input("lokasi",$lokasi);?></td></tr>
</table>
<div class="easyui-tabs">
	<div title="General" style="padding:10px">
	  <table class="table2" width="100%">
		<tr><td>Nilai Proyek</td><td><?=form_input('project_amount',$project_amount);?></td></tr>
		<tr><td>Nilai Budget</td><td><?=form_input('budget_amount',$budget_amount);?></td></tr>
		<tr><td>Status Proyek</td><td><?
			$status_project_list=$this->sysvar->lookup('status_project');
			echo form_dropdown('status_project',$status_project_list,$status_project);?></td></tr>
		<tr><td>Kelompok</td><td><? 
			$category_project_list=$this->sysvar->lookup('group_project');
			echo form_dropdown('category_project',$category_project_list,$category_project);?></td></tr>
		<tr><td>Total Penjualan</td><td><?=form_input('sales',$sales);?></td></tr>
		<tr><td>Total Pembelian</td><td><?=form_input('cost',$cost);?></td></tr>
		<tr><td>Total Biaya</td><td><?=form_input('expense',$expense);?></td></tr>
		<tr><td>Laba/Rugi</td><td><?=form_input('labarugi',$labarugi);?></td></tr>
		<tr><td>Pencapaian %</td><td><?=form_input('finish_prc',$finish_prc);?></td></tr>
		<tr><td>Nomor Faktur Penjualan Terkait</td><td><?=form_input('invoice_number',$invoice_number);?></td></tr>
      </table>
    </div>
	<div title="Saldo Awal" style="padding:10px">
		<table class="table2" width="100%">      	
		</table>
	</div>

   </form>

<!-- SHIPTO -->
	<div title="Anggaran" style="padding:10px">
		 
	</div>
<!-- CARDS -->				
	<div title="Cards" style="padding:10px">
		<div class='thumbnail'>
			<form method="post">
			<table class='table2' width='100%'>
			<tr><td>Date From</td>
			<td><?=form_input('date_from',date("Y-m-d"),'id=date_from class="easyui-datetimebox" ');?></td>
			<td>Date To</td>
			<td><?=form_input('date_to',date("Y-m-d"),'id=date_to  class="easyui-datetimebox" ');?></td>
			<td><?=link_button('Search','search_cards()','search');?></td>
			</tr>
			</table>
			</form>
		</div>
		<table id="dgCard" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit',fitColumns: true, 
				singleSelect: true,  width: '100%',
				url: '',toolbar:'',
			">
			<thead>
				<tr>
					<th data-options="field:'no_bukti',width:100">Nomor</th>
					<th data-options="field:'tanggal',width:80">Tanggal</th>
					<th data-options="field:'jenis',width:80,align:'left',editor:'text'">Jenis</th>
					<th data-options="field:'jumlah',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Jumlah</th>
					<th data-options="field:'saldo',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Saldo</th>
				</tr>
			</thead>
		</table>
		
	</div>

    
</div>   

  
<?=load_view('gl/select_coa_link')?> 
<?=load_view('sales/customer_select')?> 
   
<script> 
  	function save(){
  		 
		event.preventDefault(); 
  		if($('#kode').val()==''){alert('Isi kode proyek !');return false;}
  		if($('#keterangan').val()==''){alert('Isi nama proyek !');return false;}
		url='<?=base_url()?>index.php/project/project/save';
			$('#myform').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#mode").val("view");
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
  	}	 
	
</script>	
   