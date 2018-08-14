 <div class="max-tool "><div class="thumbnail tool box-gradient">
	<?php
   $min_date=$this->session->userdata("min_date","");
	
	$disabled="";$disabled_edit="";
	if(!($mode=="add" or $mode=="edit"))$disabled=" disabled";
	if($mode=="edit")$disabled_edit=" disabled";
	if($mode=="edit" or $mode=="add") echo link_button('Save', 'save_po()','save');		
	if($mode=="view") {
		echo link_button('Edit', '','edit','false',base_url().'index.php/purchase_request/view/'.$purchase_order_number.'/edit');		
		echo link_button('Add','','add','false',base_url().'index.php/purchase_request/add');		
		echo link_button('Refresh','','reload','false',base_url().'index.php/purchase_request/view/'.$purchase_order_number);		
		echo link_button('Delete', 'delete_nomor()','cut');		
	}
	echo link_button('Print', 'print_po()','print');		
	echo link_button('Search','','search','false',base_url().'index.php/purchase_request');	
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'purchase_request\')','help');		
	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('purchase_request')">Help</div>
		<div onclick="show_syslog('purchase_request','<?=$purchase_order_number?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">	
<form id='frmPo' method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php echo validation_errors(); ?>
   <table class='table' width="100%">
		<tr>
			<td>Nomor Request #</td>
			<td><?php
				 echo form_input('purchase_order_number',
				$purchase_order_number,"id='purchase_order_number' 
				class='easyui-validatebox' data-options='required:true,	validType:length[3,30]' ".$disabled.$disabled_edit); 
			?></td>

            <td>Cabang</td><td><?php echo form_dropdown('branch_code',$branch_list,$branch_code,
			"id=branch_code ".$disabled);?></td>
       </tr>	 
       <tr>
        	<td>Tanggal Permintaan</td><td><?php echo form_input('po_date',$po_date,'id=po_date  
        	class="easyui-datetimebox" required:true '.$disabled);?></td>
            <td>Department</td><td><?php echo form_dropdown('dept_code',$dept_list,$dept_code,
			"id=dept_code ".$disabled);?></td>
       </tr>	 
       <tr>
            <td>Nama Pegawai yang mengajukan</td><td><?php echo form_dropdown('ordered_by',$employee_list,$ordered_by,"id=ordered_by 
			class='easyui-validatebox' data-options='required:true,
			validType:length[3,30]'            
            ".$disabled);?></td>
			
			<td rowspan='2' colspan='5' >
				<span id='info' name='info' class='thumbnail' style='height:100px;width:300px'><?=$info?></span>
			</td>
			
       </tr>
       <tr>
            <td>Tanggal diinginkan barang datang</td>
            <td><?=form_input('due_date',$po_date,'id=due_date  class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required'.$disabled);?></td>
			
       </tr>
       <tr>
            <td>Status pengajuan</td><td><?php echo form_dropdown('doc_status',$status_po_request_list,$doc_status,
			"id=doc_status ".$disabled);?></td>
            <td>Untuk dipakai di Proyek</td><td><?php 
            echo form_input('project_code',$project_code,
            "id=project_code ".$disabled);
			//if($mode=="add") 
				echo link_button('','select_project()',"search","true"); 
            ?>
			</td>

       </tr>
       <tr>
            <td>Keterangan</td><td colspan="3"><?php echo form_input('comments',$comments,'id=comments style="width:80%"'.$disabled);?></td>
       </tr>
   </table>
</form>
</div> 
 
<div class="easyui-tabs" >
	<div title="Items" style="padding:10px">
	<!-- PURCASE_ORDER_LINEITEMS -->	
	<div id='divItem'>
		<table id="dg" class="easyui-datagrid"  width="100%"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/purchase_order/items/<?=$purchase_order_number?>/json'
			">
			<thead>
				<tr>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'quantity',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
					<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
					<th data-options="field:'line_type',width:80">Type</th>
					<th data-options="field:'line_status',width:80">Status</th>
					<th data-options="field:'comment',width:80">Alasan</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	<!-- END PURCHASE_ORDER_LINEITEMS -->
 
	</div>	
	</div>
	<div title='Receive' style="padding:10px">
		<table id="dgRcv" class="easyui-datagrid"  
			style="min-height:700px"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true, toolbar: '#tbRcv',
				url: '<?=base_url()?>index.php/receive_po/list_by_po/<?=$purchase_order_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'shipment_id',width:100">Nomor</th>
					<th data-options="field:'date_received',width:100">Tanggal</th>
					<th data-options="field:'warehouse_code',width:100">Gudang</th>
					<th data-options="field:'item_number',width:100">Item Number</th>
					<th data-options="field:'description',width:100">Description</th>
					<th data-options="field:'quantity_received',width:100">Quantity</th>
					<th data-options="field:'receipt_by',width:100">Petugas</th>
					<th data-options="field:'selected',width:100">Invoiced</th>
				</tr>
			</thead>
		</table>
		
	</div>

	<div title='Purchase Order' style="padding:10px">
		<table id="dgInvoice" class="easyui-datagrid"  
			style="min-height:700px"
			data-options="
				iconCls: 'icon-edit',
				singleSelect: true, toolbar: '#tbInvoice',
				url: '<?=base_url()?>index.php/purchase_invoice/list_by_po/<?=$purchase_order_number?>'
			">
			<thead>
				<tr>
					<th data-options="field:'purchase_order_number',width:100">Nomor</th>
					<th data-options="field:'po_date',width:100">Tanggal</th>
					<th data-options="field:'terms',width:100">Terms</th>
					<th data-options="field:'amount',width:100">Amount</th>
				</tr>
			</thead>
		</table>
	
	</div>

</div>


<? include_once 'supplier_select.php' ?>
<? echo load_view('project/project_select') ?>
<div id="tbRcv" class="box-gradient	">
	<?=link_button('Add','','add','true',base_url().'index.php/receive_po/add/'.$purchase_order_number);	?>	
	<?=link_button('Refresh','load_receive()','reload');	?>	
	<?=link_button('View','view_receive()','edit');	?>	
</div>
<script type="text/javascript">
	var url;	
	var has_receive='<?=$has_receive?>';
    function save_po(){

        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#po_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        //if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#purchase_order_number').val()==''){alert('Isi nomor purchase order !');return false;}
        if($('#ordered_by').val()==''){alert('Pilih kode pegawai yang mengajukan !');return false;}
		url='<?=base_url()?>index.php/purchase_request/save';
			$('#frmPo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#divItem').show('slow');
						$('#purchase_order_number').val(result.purchase_order_number);
						var nomor=$('#purchase_order_number').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_request/items/'+nomor+'/json'});
						$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
		 
		function print_po(){
			po_number=$("#purchase_order_number").val();
			url="<?=base_url()?>index.php/purchase_request/print_bukti/"+po_number;
			window.open(url,'_blank');
		}
		
	function delete_nomor()
	{
		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/purchase_request/delete/"+$('#purchase_order_number').val(),
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}		
	function load_receive()
	{
		var url='<?=base_url()?>index.php/receive_po/list_by_po/<?=$purchase_order_number?>';
		$('#dgRcv').datagrid({url:url});
		$('#dgRcv').datagrid('reload');
	}
	function view_receive()
	{
        row = $('#dgRcv').datagrid('getSelected');
        if (row){
			shipment_id=row['shipment_id'];
			url="<?=base_url()?>index.php/receive_po/view/"+shipment_id;
			window.open(url,"_self");
		}
	
	}
		
</script>
<!-- lineitems --->
		 
<div id='dgItem'>
	<?php if(($mode=="add" or $mode=="edit" or $mode=="view")) {  ?>
	<div id='dgItemForm' class="easyui-dialog" 
	style="width:500px;height:400px;left:100px;top:10px;padding:5px 5px"
    closed="true" buttons="#tbItemForm" >
	    <form id="frmItem" method='post' >
	        <input type='hidden' id='po_number_item' name='po_number_item'>
	        <input type='hidden' id='line_number' name='line_number'>
	        <input type='hidden' id='gudang_item' name='gudang_item'>
				<table class='table' style='width:250px;float:left'>
				 <tr><td >Kode Barang</td><td colspan='3'><input onblur='find()' id="item_number" style='width:180px' 
					name="item_number"   class="easyui-validatebox" required="true">
					<a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
					onclick="searchItem();return false;"></a>
				 </td>
				 
				 </tr>
				 <tr><td>Nama Barang</td><td colspan='3'><input id="description" name="description" style='width:300px'></td></tr>
				 <tr><td>Qty</td><td><input id="quantity"  style='width:60px'  name="quantity" onblur="hitung()">
				 Unit <input id="unit" name="unit"  style='width:60px' >
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
					onclick="searchUnit();return false;" 
					style='display:none' id='cmdLovUnit'></a> 
				 </td></tr>
				 <tr><td>Category</td><td colspan='3'>
				 	<?=form_dropdown('line_type',array('Repeat'=>'Repeat','Non Repeat'=>'Non Repeat'),'Non Repeat');?>
				 </tr>
				 <tr><td>Status</td><td colspan='3'>
				 	<?=form_dropdown('line_status',array('Accept'=>'Accept','Pending'=>'Pending','Reject'=>'Reject'),'Pending');?>
				 </tr>
				 <tr><td>Alasan</td><td colspan='3'><input id="comment" name="comment" style='width:300px'></td></tr>
			</table>				
	    </form>
	</div>
	
<? } ?>
</div>

	
<div id="tbItemForm">
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
		onclick='close_item();return false;' title='Close'>Cancel</a>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
		onclick='save_item();return false;' title='Save Item'>Submit</a>
</div>
<div id="tb" style="height:auto">
<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="addItem()" data-options="plain:false">Add</a>
<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem()" data-options="plain:false">Edit</a>
<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem()" data-options="plain:false">Delete</a>
<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="false" onclick="reloadItem()" data-options="plain:false">Refresh</a>	
</div>
 
<?php 
	echo load_view("inventory/inventory_select");
	echo load_view("inventory/select_unit");	
?>
 
<script language="JavaScript">
	function addItem(){
		var mode=$('#mode').val();
		if(mode=="add"){
			alert("Simpan dulu sebelum tambah item barang !");
			return false;
		}
		//$('#dgItemForm').window({left:window.event.clientX*0.5,top:window.event.clientY*0.5});
		$("#dgItemForm").dialog("open").dialog('setTitle','Input barang');
	}
	function close_item(){
		clear_input();
		$("#dgItemForm").dialog("close");	
	}
	function find(){
		xurl=CI_ROOT+'inventory/find/'+$('#item_number').val();
		console.log(xurl);
		$.ajax({
					type: "GET",
					url: xurl,
					data:'item_no='+$('#item_number').val(),
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#item_number').val(obj.item_number);
						$('#unit').val(obj.unit_of_measure);
						$('#description').val(obj.description);
						if(obj.multiple_pricing){
							$("#cmdLovUnit").show();
						} else {
							$("#cmdLovUnit").hide();
						}
						$('#quantity').val("1");
					},
					error: function(msg){alert(msg);}
		});
	};
	function save_item(){
		var gudang=$("#warehouse_code").val();
		var url = '<?=base_url()?>index.php/purchase_order/save_item';
		var po=$('#purchase_order_number').val();

		if($("#mode").val()=="add"){alert("Simpan dulu nomor ini.");return false;};
		if(gudang==""){alert("Pilih dulu kode gudang !");return false;};
		$('#po_number_item').val(po);
		$("#gudang_item").val(gudang);			 
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+po+'/json'});
					$('#dg').datagrid('reload');
					
					$.messager.show({
						title: 'Success',
						msg: 'Success'
					});
					close_item();
					
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	}
	function clear_input(){
		$('#frmItem').form('clear');
		$('#item_number').val('');
		$('#unit').val('Pcs');
		$('#description').val('');
		$('#line_number').val('');
		$('#quantity').val(1);
		$('#comment').val('');

	}
	function reloadItem(){
		var po=$('#purchase_order_number').val();
		var xurl='<?=base_url()?>index.php/purchase_order/items/'+po+'/json';
		$('#dg').datagrid({url: xurl});
		$('#dg').datagrid('reload');	// reload the user data
	}
	function deleteItem(){
		var po=$('#purchase_order_number').val();
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/purchase_order/delete_item/'+row.line_number;
					$.ajax({
						type: "GET",url: url,param: '',
						success: function(result){
							var result = eval('('+result+')');
							if (result.success)	void reloadItem();
						},
						error: function(msg){$.messager.alert('Info',msg);}
				});
					
				}
			})
		}
	}
	function editItem(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			console.log(row);
			$('#frmItem').form('load',row);
			$('#item_number').val(row.item_number);
			$('#description').val(row.description);
			$('#quantity').val(row.quantity);
			$('#unit').val(row.unit);
			$('#line_type').val(row.line_type);			
			$('#line_status').val(row.line_status);
			$('#line_number').val(row.line_number);
			$('#comment').val(row.comment);
		}
		//$('#dgItemForm').window({left:100,top:window.event.clientY+20});
		$("#dgItemForm").dialog("open");
	}
	function hitung(){
	    
	}

</script>
    
