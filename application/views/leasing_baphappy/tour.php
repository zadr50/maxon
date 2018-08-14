<h4>PAKET TOUR DAN UMROH</h4>
<div class="thumbnail">
	<?
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print_item()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/travel/tour/add');		
	echo link_button('Search','','search','true',base_url().'index.php/travel/tour');		
	if($mode=="view") echo link_button('Refresh','','reload','true',base_url().'index.php/travel/tour/view/'.$tour_code);		
	echo link_button('Delete', 'delete_tour()','remove');		
	echo link_button('Help', 'load_help()','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
</div>
<?php echo validation_errors(); ?>
<div class="thumbnail" >	
	<form id="frmTour"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		<?php 
			if($mode=='view'){
				$disabled='disable';
			} else {
				$disabled='';
			}
		?> 
		<table>
			<tr><td>Kode Tour</td>
				<td>
					<?php
					if($mode=='view'){
						echo form_input('tour_code',$tour_code,"id='tour_code' readonly");
					} else { 
						echo form_input('tour_code',$tour_code,"id='tour_code'");
					}		
				?></td>
				<td>Paket Tour/Umroh</td><td><?php echo form_input('tour_name',$tour_name,"id='tour_name'");?></td>
			</tr>	 
			<tr>
				<td>Agent Rekanan</td><td><?php echo form_input('agent',$agent,"id='agent'");?></td>
				<td>Tujuan</td><td><?php echo form_input('destination',$destination);?></td>
			</tr>
			 <tr>
				<td>Harga Paket </td><td><?=form_input('price',$price);?></td>
				<td>Mata Uang </td><td><?=form_input('curr_code',$curr_code);?></td>
			 </tr>
			 <tr>
				<td>Date From</td><td><?=form_input('start',$start,"class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' ");?></td>
				<td>Date To</td><td><?=form_input('until',$until,"class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' ");?></td>
			 </tr>
			 <tr><td>Market Area</td><td><?=form_input('market',$market);?></td>
			 <td>Keterangan</td><td><?=form_input('note',$note);?></td></tr>
			 <tr><td></td><td></td></tr>
		</table>	
	</form>
</div>

<div class='thumbnail'>
	<p><i>Isi jadwal harian, acara dan destinasi.</i></p>
	<div class='thumbnail'>
		<form id="frmDetail" method="post">
			<table>
				<tr><td>Day</td><td>Place</td><td>Description</td><td></td></tr>
				<tr><td><?=form_input('day_no','1',"style='width:50px'")?></td>
				<td><?=form_input("place")?></td>
				<td><?=form_input("description",'',"style='width:250px'")?></td>
				<td><?=form_hidden("id",'',"id='id'")?></td>
				<td colspan='3' align='right'><?=link_button("Add","add_day()","save")?></td>
				</tr>
			</table>
		</form>
	</div>
	<table id="dgDetail" class="easyui-datagrid"  
		data-options="
			iconCls: 'icon-edit',
			singleSelect: true,  
			url: '<?=base_url()?>index.php/travel/tour/detail/<?=$tour_code?>',toolbar:'#cmdDetail',
		">
		<thead>
			<tr>
				<th data-options="field:'day_no',width:20">Hari</th>
				<th data-options="field:'place',width:200">Tempat Kunjungan</th>
				<th data-options="field:'description',width:400">Keterangan</th>
				<th data-options="field:'id',width:20">Id</th>
			</tr>
		</thead>
	</table>  
</div>
<div id='cmdDetail'>
	<?=link_button('Remove','delete_detail()','remove');?>
</div>

<script language='javascript'>
  	function save(){
  		if($('#tour_code').val()==''){alert('Isi kode tour !');return false;}
  		if($('#tour_name').val()==''){alert('Isi nama tour !');return false;}
		url='<?=base_url()?>index.php/travel/tour/save';
		$('#frmTour').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#mode').val('view');
					log_msg('Data sudah tersimpan.');
					url='<?=base_url()?>index.php/travel/tour/view/'+$('#tour_code').val();
					$('#dgDetail').datagrid('reload');
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	function delete_detail(){
		var tour_code=$("#tour_code").val();
		row = $('#dgDetail').datagrid('getSelected');
		if (row){
			var url=CI_ROOT+'travel/tour/del_detail/'+row['id'];                             
			param='';
			$.ajax({
				type: "GET",
				url: url,
				param: param,
				success: function(msg){
					$('#dgDetail').datagrid('reload');
				},
				error: function(msg){$.messager.alert('Info',msg);}
			});         
		}
	}
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/tour");
	}
	function add_day() {
		var tour=$('#tour_code').val();
  		if(tour==''){alert('Isi kode tour !');return false;}
		url='<?=base_url()?>index.php/travel/tour/add_detail/'+tour;
		$('#frmDetail').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url='<?=base_url()?>index.php/travel/tour/detail/'+tour;
					$('#dgDetail').datagrid('reload');
					$("#frmDetail")[0].reset();
				} else {
					log_err(result.msg);
				}
			}
		});
	}	
</script>