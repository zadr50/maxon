<div class="thumbnail box-gradient">
	<?php
	$min_date=$this->session->userdata("min_date","");
	echo link_button('Save', 'process()','save');		
	echo link_button('Print', 'print_pay()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/payables_payments/add');		
	echo link_button('Search','','search','false',base_url().'index.php/payables_payments');		
    
	?>
	<div style='float:right'>
		<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('payables_payments')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');?>      
	</div>
</div>
<div class="thumbnail">	
	<form id="myform" method="POST" action="<?=base_url()?>index.php/payables_payments/save">
	<table width="100%" class="table">	
		<tr>
			<td>Supplier: </td><td colspan=4><?=form_input('supplier_number',$supplier_number,"id=supplier_number");?>
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
				onclick="dlgsuppliers_show();return false;"></a>	
				<span id="supplier_name" >Supplier Information</div>
			</td>
		</tr>
		<tr>
			<td>Rekening: </td><td><?=form_input('how_paid_account_id',$how_paid_account_id,"id='how_paid_account_id'");
                echo link_button("","dlgbank_accounts_show();return false","search");
			    
			    ?>
			    
			    
			    
			</td>
			 
			<td>Jenis Bayar: <?=form_dropdown('how_paid',array('Cash','Giro','Transfer'),$how_paid,"id='how_paid'  style='width:200px'");?></td>
			
            <td>Nomor Bukti</td><td><?=form_input("no_bukti",$no_bukti,"id='no_bukti'")?></td> 
			
		</tr>
		<tr>
			<td>Tanggal Bayar: </td><td><?=form_input('date_paid',$date_paid,
			'class="easyui-datetimebox"
			data-options="formatter:format_date,parser:parse_date"
			id="date_paid"
			
			');?></td>
			<td colspan=3>
				<p><?=form_input('credit_card_number',$credit_card_number)?>&nbsp Giro Nomor </p>
				<p><?=form_input('expiration_date',$expiration_date,'class="easyui-datetimebox"
					data-options="formatter:format_date,parser:parse_date"
					')?>&nbsp Tanggal Cair Giro					</p>
				<p><?=form_input('from_bank',$from_bank)?>&nbsp Nama Bank Penerbit							</p>
				<p><i>	*apabila dilakukan pembayaran dengan giro silahkan isi informasi giro dan tanggal 
				jatuh tempo giro.</i></p>			
			</td>
		</tr>
		<tr>
			<td>Jumlah Bayar: </td><td><?=form_input('amount_paid',$amount_paid,"id='amount_paid'");?></td>
			<td>Nomor Kontra Bon</td><td colspan=2><?php echo form_input("ref1",$ref1,"id='ref1'");
                echo link_button('Pilih','dlgpayables_bill_header_show()','search');      
			    ?>
			    
			</td>
		</tr>	
	</table>

	<div id="divItem" >
		<p><i>*Dibawah ini adalah nomor-nomor faktur hutang supplier yang bersangkutan 
			yang masih memiliki saldo atau belum lunas, silahkan isi jumlah 
			pembayaran dikolom bayar dibaris faktur.</i></p>
		<table id="dgInvoice" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '', fitColumns: true,
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'purchase_order_number',width:80">Faktur</th>
					<th data-options="field:'po_date',width:80">Tanggal</th>
					<th data-options="field:'terms',width:80">Termin</th>
					<th data-options="field:'due_date',width:80">Tempo</th>
					<th data-options="field:'amount',width:80,align:'right'">Jumlah</th>
					<th data-options="field:'saldo',width:80,align:'right'">Saldo</th>
					<th data-options="field:'bayar',width:'100'">Bayar</th>
				</tr>
			</thead>
		</table>
	</div>

	
	</form>
</div>
<?php
echo $lookup_suppliers;
echo $lookup_rekening;
echo $lookup_kontra_bon;
?>

<script language='javascript'>
	function selected_supplier(){
		var row = $('#dgSelectSupp').datagrid('getSelected');
		if (row){
			$('#supplier_number').val(row.supplier_number);
			$('#supplier_name').val(row.supplier_name);
			$('#supplier_name').html(row.supplier_name);
			$('#dlgSelectSupp').dialog('close');
			
			select_invoice();
			
		} else {
			alert("Pilih salah satu nomor supplier !");
		}
	}	
	
	function select_invoice(){
 		if($('#how_paid').val()==''){alert('Pilih jenis pembayaran !');return false;}
		$('#dgInvoice').datagrid({url:'<?=base_url()?>index.php/purchase_invoice/invoice_not_paid/'+$('#supplier_number').val()});
		//$('#dgInvoice').datagrid('reload');
	}
	function process(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_paid').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
	    
 		if($('#supplier_number').val()==''){alert('Pilih supplier !');return false;}
 		if($('#how_paid_account_id').val()==''){alert('Pilih rekening !');return false;}
		if($('#amount_paid').val()=='0' || $('#amount_paid').val()==''){
			alert('Input jumlah bayar !');
			return false;
		}
		$('#myform').submit();
	}
	function selected_bon(nomor){
	    $("#ref1").val(nomor);
        $.ajax({
            type: "GET",
            url: CI_ROOT+"payables_payments/selected_kontra_bon/"+nomor,
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    $.messager.show({
                        title:'Success',msg:result.msg
                    });
                    $("#supplier_number").val(result.supplier_number);
                    $("#how_paid_account_id").val(result.how_paid_account_id);
                    $("#amount_paid").val(result.amount_paid); 
                    $('#dgInvoice').datagrid({url:CI_ROOT+'payables_payments/kontra_bon/'+nomor});
                    
                    
                } else {
                    $.messager.show({
                        title:'Error',msg:result.msg
                    });                         
                };
            },
            error: function(msg){alert(msg);}
        });                 
	    
	}
</script>
 	