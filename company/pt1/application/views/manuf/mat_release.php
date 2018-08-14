<legend>MATERIAL RELEASE</legend>
<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/manuf/mat_release/add');		
	echo link_button('Search','','search','false',base_url().'index.php/manuf/mat_release');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/manuf/mat_release/view/'.$mat_rel_no);		
	echo "<div style='float:right'>";
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('mat_release)">Help</div>
		<div onclick="show_syslog('mat_release','<?=$mat_rel_no?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">	

<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<h4>Terjadi Kesalahan!</h4> 
	<?php echo validation_errors(); ?>
	</div>
<?php } ?>
 <?php if($message!="") { ?>
<div class="alert alert-success"><? echo $message;?></div>
<? } ?>


<form id="frmExec" method='post'>
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class='table2' width='100%'>
		<tbody>
			<tr><td>Release Number</td>
				<td><?=form_input("mat_rel_no",$mat_rel_no,"id='mat_rel_no'")?></td>
				<td>Warehouse</td><td><?=form_dropdown("warehouse",$warehouse_list,$warehouse,"id='warehouse'")?></td>
			</tr>
			<tr><td>Date</td>
				<td><?=form_input("date_rel",$date_rel,"id='date_rel' 
					class='easyui-datetimebox' style='width:150px'
					data-options='formatter:format_date,parser:parse_date'
					")?>
				</td>
				<td>Person</td><td><?=form_input("person",$person,"id='person'")?></td>
			</tr>
			<tr><td>Work Exec Number</td><td><?=form_input("exec_number",$exec_number,"id='exec_number'")?>
				<?=link_button('','lookup_exec()','search');?>
				<?=link_button('View','wo_exec_view()','tip');?>
			</td>
			<td>Work Order Number</td><td><?=form_input("wo_number",$wo_number,"id='wo_number'")?>
			</td></tr>
			<tr><td>Comments</td><td colspan='6'><?=form_input("comments",$comments,"id='comments' style='width:500px'")?></td></tr>
			<tr><td colspan='7'><i>*** Item material release akan diload setelah anda tekan simpan</i></td></tr>
		</tbody>
	</table>
	<div id="divWoItem"> 
		<table id="dg" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit', fitColumns: true,
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/manuf/mat_release/items/<?=$mat_rel_no?>'
			">
			<thead>
				<tr>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
					<th data-options="field:'cost',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Cost</th>
					<th data-options="field:'amount',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Total</th>
					<th data-options="field:'warehouse',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Warehouse</th>
					<th data-options="field:'line_exec_no',width:30,align:'right'">line_exec_no</th>
					<th data-options="field:'id',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>	
	
	</div>
</form> 
</div>
<div id="btnExec"><?=link_button("Select","select_exec();return false;","ok")?></div>	
<div id='dlgExec'class="easyui-dialog" style="width:500px;height:380px;
padding:10px 20px;left:100px;top:20px"
	closed="true"  buttons="#btnExec">
	<table id="dgExec" class="easyui-datagrid"  
		data-options="singleSelect: true">
		<thead>
			<tr>
				<th data-options="field:'work_exec_no',width:150">Exec Number</th>
				<th data-options="field:'start_date',width:80">Exec Date</th>
				<th data-options="field:'wo_number',width:80">WO Number</th>
				<th data-options="field:'person_in_charge',width:80">Person</th>
			</tr>
		</thead>
	</table>
</div>
 
<script type="text/javascript">
    function save_this(){
                var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_rel').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

  		if($('#mat_rel_no').val()==''){alert('Isi nomor bukti !');return false;}
  		if($('#exec_number').val()==''){alert('Pilih nomor work exec !');return false;}
		url='<?=base_url()?>index.php/manuf/mat_release/save';
			$('#frmExec').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#mat_rel_no').val(result.mat_rel_no);
						var no=$('#mat_rel_no').val();
						window.open("<?=base_url()?>index.php/manuf/mat_release/view/"+no,"_self");
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
						log_err(result.msg);
					}
				}
			});
    }
	function deleteItem()
	{
		var row = $('#dgExec').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/manuf/mat_release/delete_item';
					$.post(url,{work_exec_no:row.work_exec_no},function(result){
						if (result.success){
							$('#dgExec').datagrid('reload');	// reload the user data
						} else {
							$.messager.show({	// show error message
								title: 'Error',
								msg: result.msg
							});
						}
					},'json');
				}
			});
		}
	}
	function lookup_exec()
	{
		$('#dlgExec').dialog('open').dialog('setTitle','Cari nomor work execute');
		$('#dgExec').datagrid({url:'<?=base_url()?>index.php/manuf/work_exec/select'});
		$('#dgExec').datagrid('reload');
	}
	function select_exec()
	{
		var row = $('#dgExec').datagrid('getSelected');
		if (row){
			$('#exec_number').val(row.work_exec_no);
			$('#wo_number').val(row.wo_number);
			$('#dlgExec').dialog('close');
		}
	}
	function clear_item_release() {
		var no=$('#mat_rel_no').val();
  		if(no==''){alert('Pilih nomor release !');return false;}
		$.messager.confirm('Confirm','Are you sure you want to remove this item material release ?',function(r){
			if (r){
				url='<?=base_url()?>index.php/manuf/mat_release/delete_material_release';
				$.post(url,{mat_rel_no:no},function(result){
					if (result.success){
						save_this();
					} else {
						$.messager.show({	// show error message
							title: 'Error',
							msg: result.msg
						});
					}
				},'json');
			}
		});
	}
	function wo_exec_view(){
		var exec_no=$("#exec_number").val();
		var url="<?=base_url()?>index.php/manuf/work_exec/view/"+exec_no;
		if(exec_no==""){alert("Kode WorkExec belum dipilih !");return false;}
		add_tab_parent("view_exec",url);
	}
		
</script>

 