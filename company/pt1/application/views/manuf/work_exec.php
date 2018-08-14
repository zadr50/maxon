<legend>WORK ORDER EXECUTION</legend>
<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/manuf/work_exec/add');		
	echo link_button('Search','','search','false',base_url().'index.php/manuf/work_exec');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/manuf/work_exec/view/'.$work_exec_no);		
	echo "<div style='float:right'>";	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('work_exec')">Help</div>
		<div onclick="show_syslog('work_exec','<?=$work_exec_no?>')">Log Aktifitas</div>
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


<form id="frmWoe" method="post" >
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class='table2' width='100%'>
		<tbody>
			<tr><td>WOE Number</td>
				<td><?=form_input("work_exec_no",$work_exec_no,"id='work_exec_no'")?></td>
				<td colspan='6' rowspan='7'>
					<div class='thumbnail'>
					<h4>Workorder Information</h4>
					<table><tr><td>Customer</td><td><input type='text' readonly name='wo_customer' 
					id='wo_customer' value='<?=$wo_customer?>'></td></tr>
					<tr><td>Date From</td><td><input type='text' readonly 
					name='wo_date_from' id='wo_date_from' 
					value='<?=$wo_date_from?>' ></td>
					</tr>
					<tr><td>To </td><td><input type='text' readonly name='wo_date_to' 
					id='wo_date_to' value='<?=$wo_date_to?>' ></td></tr>
					<tr><td>SO Number</td><td><input type='text' readonly name='wo_so_number' 
					id='wo_so_number' value='<?=$wo_so_number?>' > </td></tr>
					<tr><td>Comments </td><td><input type='text' readonly name='wo_comment' 
					id='wo_comment' value='<?=$wo_comment?>' > </td></tr>
					</table></div>
				</td>
				
			</tr>
			<tr>
				<td>WO Number</td><td><?=form_input("wo_number",$wo_number,"id='wo_number'")?>
				<?=link_button('','lookup_work_order()','search');?>
				</td>
			</tr>
			<tr><td>Start Date</td><td><?=form_input("start_date",$start_date,
                                "id='start_date' 
			data-options='formatter:format_date,parser:parse_date'
			class='easyui-datetimebox' style='width:150px'")?></td></tr>
			<tr><td>Expect Date</td><td><?=form_input("expected_date",$expected_date,
                                "id='expected_date' class='easyui-datetimebox' 
			data-options='formatter:format_date,parser:parse_date'
			style='width:150px'")?></td></tr>
			<tr><td>Department</td><td><?=form_dropdown("dept_code",$dept_list,$dept_code,"id='dept_code' style='height:25px'")?></td></tr>
			<tr><td>Person</td><td><?=form_dropdown("person_in_charge",$person_list,$person_in_charge,"id='person_in_charge' style='height:25px'")?></td></tr>
			<tr><td>Status</td><td><?=form_input("status",$status,"id='status'")?></td></tr>
			<tr><td>Comments</td><td colspan='6'><?=form_input("comments",$comments,"id='comments' style='width:500px'")?></td></tr>
		</tbody>
	</table>
	<div id="divWoItem">
			<table id="dg" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit',fitColumns: true, 
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/manuf/work_exec/items/<?=$work_exec_no?>'
			">
			<thead>
				<tr>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
					<th data-options="field:'price',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Price</th>
					<th data-options="field:'total',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Total</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>	
	</div>
<!-- WORK ORDER PRODUCT - kode,nama barang, wo_qty, unit, exe_qty, saldo_qty, warehouse -->
<!-- MATERIAL USE - kode,nama barang, qty,unit,cost,total_cost,number,tanggal,id -->
<!-- PRODUCT RESULT - kode,nama,qty,unit,cost,total,number,tanggal,id -->
<!-- TOTAL COST - calculate summary class kode barang -->
<!-- ADD MATERIAL USE, ADD FINISHED PRODUCT RESULTS, ADD DELIVERY PRODUCT -->
	</form>
</div>
<div id='dlgWo'class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px;left:100px;top:20px"
		closed="true" buttons="#btnWo">
		<table id="dgWo" class="easyui-datagrid" width='100%' data-options="singleSelect: true, fitColumns: true">
			<thead>
				<tr>
					<th data-options="field:'work_order_no',width:150">Nomor Work Order</th>
					<th data-options="field:'start_date',width:80">Tanggal Mulai</th>
					<th data-options="field:'expected_date',width:80">Tanggal Akhir</th>
					<th data-options="field:'wo_status',width:80">Status</th>
				</tr>
			</thead>
		</table>
</div>
<div id="btnWo"><?=link_button("Select","select_work_order();return false;","ok")?></div>	   

<script type="text/javascript">
    function save_this(){
                var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#start_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

  		if($('#work_exec_no').val()==''){alert('Isi nomor bukti !');return false;}
  		if($('#work_order_no').val()==''){alert('Isi nomor work order !');return false;}
		url='<?=base_url()?>index.php/manuf/work_exec/save';
			$('#frmWoe').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#work_exec_no').val(result.work_exec_no);
						var no=$('#work_exec_no').val();
						window.open("<?=base_url()?>index.php/manuf/work_exec/view/"+no,"_self");
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
    }
	function lookup_work_order()
	{
		$('#dlgWo').dialog('open').dialog('setTitle','Cari nomor work order');
		$('#dgWo').datagrid({url:'<?=base_url()?>index.php/manuf/workorder/select_wo_open'});
		$('#dgWo').datagrid('reload');
	}
	function select_work_order()
	{
		var row = $('#dgWo').datagrid('getSelected');
		if (row){
			$('#wo_number').val(row.work_order_no);
			load_work_order();
			$('#dlgWo').dialog('close');
		}
	}
	function load_work_order(){
 		if($('#wo_number').val()==''){alert('Pilih nomor work order !');return false;}
 		$("#divWoItem").fadeIn("slow");
 		var url=CI_ROOT+"manuf/workorder/load_item_exec";
 		param="q=open&wo="+$('#wo_number').val();

 		void get_this(url,param,'divWoItem');
		
		var xurl="<?=base_url()?>index.php/manuf/workorder/info/"+$("#wo_number").val();
		$.ajax({
			type: "GET", url: xurl,
			success: function(msg){
				var result = eval('('+msg+')');
					if (result.success){
					console.log(msg);
					$("#wo_customer").val(result.customer_number);
					$("#wo_date_from").val(result.start_date);
					$("#wo_date_to").val(result.expected_date);
					$("#wo_so_number").val(result.sales_order_number);
					$("#wo_comment").val(result.comments);
					$("#start_date").val(result.start_date);
					$("#expected_date").val(result.expected_date);

					}
			},
			error: function(msg){alert(msg);}
        }); 
		
		
	}
	
</script>  

 