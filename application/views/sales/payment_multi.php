<div class="thumbnail box-gradient">
	<?php
   $min_date=$this->session->userdata("min_date","");
    
	echo link_button('Save', 'process()','save');		
	echo link_button('Print', 'print()','print');
	echo link_button('Add','','add','false',base_url().'index.php/payment/add');		
	echo link_button('Search','','search','false',base_url().'index.php/payment');
    echo link_button('Close','remove_tab_parent()','remove');      
		
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'payment\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('payment')">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">	
	<form id="myform" method="POST" action="<?=base_url()?>index.php/payment/save">
	<table class='table' width='100%'>
		<tr>
			
			
            <td>Rekening: </td><td><?=form_input('how_paid_acct_id',$how_paid_acct_id,"id='how_paid_acct_id'");
                echo link_button("","dlgbank_accounts_show();return false","search");
                
                ?>
                
                
                
            </td>
			
			<td>Tanggal Bayar: <?=form_input('date_paid',$date_paid,'id="date_paid" 
			class="easyui-datetimebox"
			data-options="formatter:format_date,parser:parse_date"
			');?></td>
		</tr>
		<tr>
			<td>Pelanggan: </td><td colspan='2'><?=form_input('customer_number',$customer_number,"id=customer_number");?>
				<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
				onclick="select_customer()"></a>
				<input type='text' disabled id='company' style='width:40%'> 				
			</td>
			<td>&nbsp</td>

		</tr>
		<tr>
			<td>Jenis Bayar: </td><td><?=form_dropdown('how_paid',array('Cash','Giro','Transfer'),$how_paid,"id=how_paid style='width:150px'");?></td>
			<td>
			<p><?=form_input('credit_card_number',$credit_card_number)?>&nbsp Giro Nomor
			</p>
			<p><?=form_input('expiration_date',$expiration_date,'class="easyui-datetimebox"
			data-options="formatter:format_date,parser:parse_date"
			')?>&nbsp Tanggal Cair Giro
			
			</p>
			<p><?=form_input('from_bank',$from_bank)?>&nbsp Nama Bank Penerbit
			
			</p>
			<p><i>
			*apabila dilakukan pembayaran dengan giro silahkan isi informasi giro dan tanggal 
			jatuh tempo giro.				
			</i></p>
			</td>			
		</tr>
		<tr>
			<td>Jumlah Bayar: </td><td><?=form_input('amount_paid',$amount_paid,"id='amount_paid'");?></td>
			<td>&nbsp</td>
		</tr>
	</table>
	<div id="divItem" >
		<table id="dgInvoice" class="easyui-datagrid"  width='100%'
			data-options="
				toolbar: '', fitColumns: true, 
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'invoice_number',width:80">Faktur</th>
					<th data-options="field:'invoice_date',width:80">Tanggal</th>
					<th data-options="field:'payment_terms',width:80">Termin</th>
					<th data-options="field:'due_date',width:80">Tempo</th>
					<th data-options="field:'amount',width:80,align:'right'">Jumlah</th>
					<th data-options="field:'saldo',width:80,align:'right'">Saldo</th>
					<th data-options="field:'bayar',width:150">Bayar</th>
                    <th data-options="field:'ck',width:80">Pilih</th>
				</tr>
			</thead>
		</table>
	</div>

	</form>
</div>

<?php
	include_once 'customer_select.php';
	echo $lookup_rekening;
?>


<script language='javascript'>

    function cek_this(i,saldo){
        if($("#fkt"+i).val()==""){
            $("#fkt"+i).val(saldo);            
        } else {
            $("#fkt"+i).val("");        
        }
        
        calc_bayar();
    }
    function calc_bayar(){
        total=0;
        for(i=0;i<100;i++){
            n=$("#fkt"+i).val();
            if(n=="")n=0;
            if(n==undefined)n=0;
            
            total=total+parseFloat(n);
        }
        $("#amount_paid").val(total);
        
    }
	function selected_customer(){
		var row = $('#dgSelectCust').datagrid('getSelected');
		if (row){
			$('#customer_number').val(row.customer_number);
			$('#company').val(row.company);
			$('#customer_info').html(row.company);
			$('#dlgSelectCust').dialog('close');
			
			select_invoice();
			
		} else {
			alert("Pilih salah satu nomor customer !");
		}
	}
	
	function select_customer(){
		$('#dlgSelectCust').dialog('open');
		search=$('#search_cust').val();
		$('#dgSelectCust').datagrid({url:'<?=base_url()?>index.php/customer/select/'+search});
	};
	
	function select_invoice(){
 		if($('#customer_number').val()==''){alert('Pilih pelanggan !');return false;}
 		if($('#how_paid_acct_id').val()==''){alert('Pilih rekening !');return false;}
 		if($('#how_paid').val()==''){alert('Pilih jenis pembayaran !');return false;}

		$('#dgInvoice').datagrid({url:'<?=base_url()?>index.php/invoice/invoice_not_paid/'+$('#customer_number').val()});
		
	}
	function process(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date_paid').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
	    
		if($('#amount_paid').val()=='0' || $('#amount_paid').val()==''){
			alert('Input jumlah bayar !');
			return false;
		}
		$('#myform').submit();
	}
</script>
 	