
<table class='table' width="100%">
	<tr>
		<td>Nomor Bukti SO</td>
			<td>
				<?php echo form_input('sales_order_number',
                        $sales_order_number,"id=sales_order_number"); ?>
            </td>
			<td rowspan="3" colspan='6'>
				<div class="thumbnail" id="customer_info" style="width:300px;height:100px"><?=$customer_info?></div>
			</td>
	</tr>
	<tr>
            <td>Tanggal</td><td><?php echo form_input('sales_date',$sales_date,'id=sales_date 
             class="easyui-datetimebox" required style="width:150px"
			data-options="formatter:format_date,parser:parse_date"
			');?>
            </td>

        </tr>	 
    <tr>
            <td>Pelanggan</td>
			<td><?php 
				echo form_input('sold_to_customer',$sold_to_customer,"id=sold_to_customer");
				echo link_button("","select_customer();return false;","search");
			?></td>
	</tr>
	<tr>
            <td>Termin</td><td><?php echo form_dropdown('payment_terms'
                    ,$payment_terms_list,$payment_terms,"id=payment_terms");?>
            </td>
			<td>Status Order</td>
			<td>
				<?php 
				echo form_dropdown('status',$status_list,$status,"id=status $enabled_status");
				
				?>
			</td>
       </tr>
    <tr>
       		<td>Salesman: </td>
       		<td><?php echo form_dropdown('salesman',$salesman_list,$salesman,'id=salesman');?></td>
            <td>Rencana Dikirim</td>
            <td><?=form_input('due_date',$due_date,'id=due_date class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required style="width:150px"');?></td>
	</tr>
    <tr>
            <td>Keterangan</td><td colspan="6"><?php echo form_input('comments'
                    ,$comments,'id=comments style="width:400px"');?>
            </td>
    </tr>
   <tr>
		<td>Barang Terkirim : </td> 
		<td><?=form_radio('delivered',1,$delivered=='1'?TRUE:FALSE);?>Yes 
		<?php echo form_radio('delivered',0,$delivered=='0'?TRUE:FALSE);?>No
		</td>
		<td>Tanggal Kirim : </td>
		<td><?=$ship_date?></td>
	</tr>
    
</table>
