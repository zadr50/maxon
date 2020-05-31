<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print()','print');		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'project\')','help');	
          
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip',plain:false">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('project')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Close','remove_tab_parent()','cancel');?>
	</div>
	
</div>
<div class="thumbnail">	
	
	
<form id="myform"  method="post" role="form">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php $err=validation_errors();if($err<>"")echo "<div class='alert alert-warning'>$err</div>"; ?>


<table class="table2" width="100%">
	<tr>
		<td>Kode Proyek</td> 
		<td><?php
			$readonly="";
			if($mode=="view")$readonly=" readonly";
			echo form_input('kode',$kode,"id=kode $readonly");
			?>
		</td>
		<td>Pelanggan Terkait</td><td><? echo form_input('client',$client,'id=client');
			if($mode=='add') { 
				echo '<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
				onclick="select_customer();return false;"></a>';
			} 	
		?></td>
  </tr>
  <tr>
     <td>Nama Proyek / Keterangan</td>       
     <td colspan=3><?=form_input('keterangan',$keterangan,"id=keterangan style='width:400px' ");?></td>
  	
  </tr>
	<tr>
		<td>Penanggung Jawab</td><td><?=form_input('person_in_charge',$person_in_charge);?></td>
		<td>Lokasi</td><td><?=form_input("lokasi",$lokasi);?></td>
	</tr>
	<tr><td>Tanggal Mulai</td><td><?=form_input('tgl_mulai',$tgl_mulai,'id=tgl_mulai  class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required style="width:150px"');?></td>
		<td>Tanggal Selesai</td><td><?=form_input('tgl_selesai',$tgl_selesai,'id=tgl_selesai  class="easyui-datetimebox" required 
			data-options="formatter:format_date,parser:parse_date"
			style="width:150px"');?></td>
	</tr>
</table>
<div class="easyui-tabs">
	<div title="General" style="padding:10px">
	  <table class="table2" width="100%">
		<tr><td>Nilai Proyek</td><td><?=form_input('project_amount',$project_amount);?></td>
			<td>Total Penjualan</td><td><?=form_input('sales',$sales);?></td>			
			
		</tr>
		<tr><td>Nilai Budget</td><td><?=form_input('budget_amount',$budget_amount);?></td>
			<td>Total Pembelian</td><td><?=form_input('cost',$cost);?></td>
		</tr>
		<tr>
			<td>Status Proyek</td>
			<td><?=form_input("status_project",$status_project,"id='status_project' style='width:100px'")?>
    			<?=link_button('','dlgstatus_project_show()',"search","false"); ?>	
                <?=link_button('',"dlgstatus_project_list('status_project')","add");?>                   
            </td>		
            <td>Total Biaya</td><td><?=form_input('expense',$expense);?></td>
		</tr>			

		<tr>
			<td>Kelompok Proyek</td>
			<td><?=form_input("category_project",$category_project,"id='category_project' style='width:100px'")?>
    			<?=link_button('','dlgcategory_project_show()',"search","false"); ?>	
                <?=link_button('',"dlgcategory_project_list('category_project')","add");?>                   
            </td>		
            <td>Laba/Rugi</td><td><?=form_input('labarugi',$labarugi);?></td>
		</tr>			
			
		<tr>
			<td>Nomor Faktur Penjualan Terkait</td><td><?=form_input('invoice_number',$invoice_number);?></td>
			<td>Pencapaian %</td><td><?=form_input('finish_prc',$finish_prc);?></td>
		</tr>
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
<?php 
echo $lookup_status_project;
echo $lookup_category_project;

?>
   
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
   