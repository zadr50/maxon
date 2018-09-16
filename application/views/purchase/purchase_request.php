<div class="max-tool "><div class="thumbnail tool box-gradient">
	<?php
    $min_date=$this->session->userdata("min_date","");	
	$disabled="";$disabled_edit="";
	if(!($mode=="add" or $mode=="edit"))$disabled=" disabled";
	if($mode=="edit")$disabled_edit=" disabled";
	echo load_view("aed_button",array(
		"mode"=>$mode,"help"=>"purchase_request"
	));
	?>
</div>
<div class="thumbnail">	
<div class="easyui-tabs" >
    <div title="General" style="padding:10px">
        <form id='frmPo' method="post">
        <input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
        <?php echo validation_errors(); ?>
           <table class='table2' width="100%">
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
                	class="easyui-datetimebox" data-options="formatter:format_date,parser:parse_date"
                	required:true ');?></td>
                    <td>Department</td><td><?php echo form_dropdown('dept_code',$dept_list,$dept_code,
        			"id=dept_code ");?></td>
               </tr>	 
               <tr>
                    <td>Nama Pegawai yang mengajukan</td>
                    <td><?php echo form_input('ordered_by',$ordered_by,"id='ordered_by'           
                    ");?>
                    <?=link_button('','dlgemployee_show()',"search","false"); ?>  
                    </td>
        			
        			<td rowspan='2' colspan='5' >
        				<span id='info' name='info' class='thumbnail' style='height:100px;width:300px'><?=$info?></span>
        			</td>
        			
               </tr>
               <tr>
                    <td>Tanggal diinginkan barang datang</td>
                    <td><?=form_input('due_date',$po_date,'id=due_date  class="easyui-datetimebox" 
        			data-options="formatter:format_date,parser:parse_date"
        			required');?></td>
        			
               </tr>
               <tr>
                    <td>Status pengajuan</td><td><?php echo form_dropdown('doc_status',$status_po_request_list,$doc_status,
        			"id=doc_status ");?></td>
                    <td>Untuk dipakai di Proyek</td><td><?php 
                    echo form_input('project_code',$project_code,"id=project_code ");
        			//if($mode=="add") 
        				echo link_button('','dlggl_projects_show();return false;',"search","false"); 
                    ?>
        			</td>
               </tr>
               <tr>
                    <td>Keterangan</td><td colspan="3"><?php echo form_input('comments',$comments,'id=comments style="width:80%"');?></td>
               </tr>
           </table>
        </form>
    </div>
	<div title="Items" style="padding:10px">
    	<!-- PURCASE_ORDER_LINEITEMS -->	
    	<div id='divItem'>
			<?php 
			echo $this->detail_grid->render(
				array(
					"id"=>"dgItem",
					"field_key"=>"line_number",
					"controller"=>"purchase_order",
					"parent_value"=>$purchase_order_number,
					"fields"=>array("item_number","description","quantity",
						"unit","line_type","line_status","comment",
						"mu_qty","multi_unit","line_number"),
					"fields_numeric"=>array("quantity","mu_qty"),
					"buttons"=>array("add","edit",'delete')	
				)
			)
			?>
		</div>
	</div>
	<div title='Receive' style="padding:10px">
		<?php 
			echo $this->detail_grid->render(
				array("id"=>"dgRcv","field_key"=>"shipment_id",	"controller"=>"receive_po",
					"parent_value"=>$purchase_order_number,
					"fields"=>array("shipment_id","date_received","warehouse_code",
						"item_number","description","quantity_received","receipt_by",
						"selected"),
					"buttons"=>array("edit")
				)
			)
		?>
	</div>
	<div title='Purchase Order' style="padding:10px">
			<?php 
			echo $this->detail_grid->render(
				array("id"=>"dgInvoice","field_key"=>"purchase_order_number","controller"=>"purchase_order",
					"parent_value"=>$purchase_order_number,
					"fields"=>array("purchase_order_number","po_date","terms","amount") 
				)
			)
			?>
	</div>
</div>
</div>

 
<?php
 echo $lookup_employee;
 echo $lookup_project;
 include_once "po_req_item.php"; 
?>
<script type="text/javascript">
	var url;	
	var has_receive='<?=$has_receive?>';
	
	function refresh_aed(){
		var nomor=$("#purchase_order_number").val();
		var url=CI_ROOT+"purchase_request/view/"+nomor;
		window.open(url,"_self");
	}
    function save_aed(){

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
		
		loading();
		
			$('#frmPo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						
						loading_close();
						
						$('#divItem').show('slow');
						$('#purchase_order_number').val(result.purchase_order_number);
						var nomor=$('#purchase_order_number').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_request/items/'+nomor+'/json'});
						//$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						loading_close();
						log_err(result.msg);
					}
				}
			});
    }
		 
		function print_aed(){
			po_number=$("#purchase_order_number").val();
			url="<?=base_url()?>index.php/purchase_request/print_bukti/"+po_number;
			window.open(url,'_blank');
		}
		
	function delete_aed()
	{
		
//		$.messager.confirm('Confirm','Are you sure you want to remove this?',
//			function(r){
//				if(!r)return false;
//			}
//		);
		var nomor=$('#purchase_order_number').val();
		loading();
		
		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/purchase_request/delete/"+nomor,
				data: "",
				success: function(result){
					
					loading_close();
					
					var result = eval('('+result+')');
					
					if(result.success){
						view_aed();
					} else {
						log_err(result.msg);
					};
				},
				error: function(msg){log_err(msg);}
		}); 				
	}		
	
	function dgRcv_reload()
	{
		var url='<?=base_url()?>index.php/receive_po/list_by_po/<?=$purchase_order_number?>';
		$('#dgRcv').datagrid({url:url});
		$('#dgRcv').datagrid('reload');
	}
	function dgRcv_view()
	{
        row = $('#dgRcv').datagrid('getSelected');
        if (row){
			shipment_id=row['shipment_id'];
			url="<?=base_url()?>index.php/receive_po/view/"+shipment_id;
			window.open(url,"_self");
		}
	
	}
	function dgInvoice_reload(){
		
	}

		
</script>



