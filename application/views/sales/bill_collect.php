<div class="thumbnail box-gradient">
	<?php
	$min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_me();return false;','save');		
	echo link_button('Print', 'print_me();return false','print');		
	echo link_button('Delete', 'delete_me();return false','cut');
    ?>
	<div style="float:right"> 
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('bill_collect')">Help</div>
		<div onclick="show_syslog('bill_collect','<?=$bill_id?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');  ?>    

	</div>
</div>

	<form id='frmMain' method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table2" width="100%">
		<tr>
			<td>Nomor</td><td>
				<?php echo form_input('bill_id',$bill_id,"id='bill_id'"); ?>
			</td>
        </tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('bill_date',$bill_date,'id=bill_date   
			class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required');?>
            </td>
        </tr>	 
       <tr>
            <td>Kolektor</td><td><?php             
            echo form_input('collector',$collector,"id=collector ");
			//echo link_button('','dlgemployee_show()',"search","false"); 			   
			?>
            </td>
            
        </tr>	 
        <tr>
            <td>Total Amount</td><td>
                <?php echo form_input('amount',number_format($amount),"id=amount"); ?>
            </td>
            <td> </td>              
        </tr>    
       
       <tr>
            <td>Keterangan</td><td colspan="3"><?php echo form_input('comments'
                    ,$comments,'id=comments style="width:400px"');?></td>
       </tr>	  
	   
   </table>



	</form>

<div class="easyui-tabs" >
	<div title="Faktur" style="padding:5px">
		<!-- LINEITEMS -->	
		<div id='divItem'>
		<div id='dgItem'>
			<?php include_once "bill_collect_items.php"; ?>
		</div>
		<table id="dg" class="easyui-datagrid table"  width="100%"
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/so/bill_collect/items/<?=$bill_id?>'
			">
			<thead>
				<tr>
					<th data-options="field:'invoice_number',width:80">Faktur</th>
					<th data-options="field:'invoice_date',width:80">Tanggal</th>
                    <th data-options="<?=col_number('amount',2)?>">Jumlah</th>
                    <th data-options="<?=col_number('saldo',2)?>">Saldo</th>
					<th data-options="field:'company',width:180">Customer</th>
					<th data-options="field:'id',width:30,align:'right'">Id</th>
				</tr>
			</thead>
		</table>
	<!-- END LINEITEMS -->
	</div>		
	</div>

</div>	
	
	
<?=$lookup_employee?>

<script type="text/javascript">
	var url;	
    function save_me(){        
        if($('#bill_id').val()==''){log_err('Isi nomor kontra bon !');return false;}
        if($('#collector').val()==''){log_err('Pilih kode collector !');return false;}
		url='<?=base_url()?>index.php/so/bill_collect/save';

			$('#frmMain').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#divItem').show('slow');
						$('#bill_id').val(result.bill_id);
						$("#amount").val(result.amount);
						var nomor=$('#bill_id').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/so/bill_collect/items/'+nomor+'/json'});
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }		
	function print_me(){
		nomor=$("#bill_id").val();
		url="<?=base_url()?>index.php/so/bill_collect/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function delete_nomor()
	{

        var nomor=$("#bill_id").val();
        if(nomor==""){
            log_err("Nomor tidak dikenal !");return false
        }
        $.messager.confirm('Confirm','Are you sure you want to remove ',function(r){
            if(!r){
                $.ajax({
                        type: "GET",
                        url: "<?=base_url()?>/index.php/so/bill_collect/delete/"+nomor,
                        data: "",
                        success: function(result){
                            var result = eval('('+result+')');
                            if(result.success){
                                log_msg("Success");
                                remove_tab_parent();
                            } else {
                                log_err(result.msg);
                            };
                        },
                        error: function(msg){alert(msg);}
                });                 
                
            }            
        });
        
	}		
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/bill_collect");
	}
</script>
    
