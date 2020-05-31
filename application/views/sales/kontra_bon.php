<div class="thumbnail box-gradient">
	<?php
	$min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_kontra_bon();return false;','save');		
	echo link_button('Print', 'print_faktur();return false','print');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/so/kontra_bon/view/'.$bill_id);		
	echo link_button('Delete', 'delete_nomor();return false','cut');
    ?>
	<div style="float:right"> 
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('sales_kotra_bon')">Help</div>
		<div onclick="show_syslog('sales_kotra_bon','<?=$bill_id?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');  ?>    

	</div>
</div>

	<form id='frmPo' method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table2" width="100%">
		<tr>
			<td>Nomor Kontra Bon</td><td width=300>
				<?php echo form_input('bill_id',$bill_id,"id='bill_id'"); ?>
			</td>
			<td rowspan='3' >
			    <div class='thumbnail' id='customer_info' 
			    style='min-height:100px'>Nama Pelanggan : 
			    <br><?=$customer_info?>
			    </div>
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
            <td>Customer</td><td><?php             
            echo form_input('customer_number',$customer_number,
            "id=customer_number  
            class='easyui-validatebox' data-options='required:true,
			validType:length[3,30]'");
			echo link_button('','dlgcustomers_show()',"search","false"); 			   
			?>
            </td>
            
        </tr>	 
       <tr>
             <td>Tanggal Jth Tempo</td>
            <td><?=form_input('date_to',$date_to,
			'id=date_to  class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required');?></td>
       </tr>
       
        <tr>
            <td>Total Amount</td><td>
                <?php echo form_input('amount',$amount,"id=amount"); ?>
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
			<?php include_once "kontra_bon_items.php"; ?>
		</div>
		<table id="dg" class="easyui-datagrid table"  width="100%"
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/so/kontra_bon/items/<?=$bill_id?>'
			">
			<thead>
				<tr>
					<th data-options="field:'invoice_number',width:80">Faktur</th>
					<th data-options="field:'tanggal',width:80">Tanggal</th>
                    <th data-options="<?=col_number('amount',2)?>">Jumlah</th>
                    <th data-options="<?=col_number('saldo',2)?>">Saldo</th>
					<th data-options="field:'row_type',width:80">Type</th>
					<th data-options="field:'id',width:30,align:'right'">Id</th>
				</tr>
			</thead>
		</table>
	<!-- END LINEITEMS -->
	</div>		
	</div>

</div>	
	
	
<?=$lookup_customer?>

<script type="text/javascript">
	var url;	
    function save_kontra_bon(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var bill_date=$('#bill_date').datetimebox('getValue'); 
        if(bill_date<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#bill_id').val()==''){log_err('Isi nomor kontra bon !');return false;}
        if($('#customer_number').val()==''){log_err('Pilih kode pelanggan !');return false;}
        //if($('#termin').val()==''){alert('Pilih termin !');return false;}        
		url='<?=base_url()?>index.php/so/kontra_bon/save';

			$('#frmPo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#divItem').show('slow');
						$('#bill_id').val(result.bill_id);
						var nomor=$('#bill_id').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/so/kontra_bon/items/'+nomor+'/json'});
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }		
	function print_faktur(){
		nomor=$("#bill_id").val();
		url="<?=base_url()?>index.php/so/kontra_bon/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function delete_nomor()
	{

		if(closed){alert("Periode sudah ditutup tidak bisa dihapus !");	return false;}
        var nomor=$("#bill_id").val();
        if(nomor==""){
            log_err("Nomor tidak dikenal !");return false
        }
        $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
            if(!r){
                $.ajax({
                        type: "GET",
                        url: "<?=base_url()?>/index.php/so/kontra_bon/delete/"+nomor,
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
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/sales_kontra_bon");
	}
</script>
    
