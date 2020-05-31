<table class='table2' width="100%">
	<tr>
		<td><label>Nomor Bukti SO</label></td>
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
				echo link_button("","dlgcustomers_show();return false;","search");
			?></td>
	</tr>
	<tr>
        <td>Termin</td><td><?php
            echo form_input('payment_terms',$payment_terms,"id='payment_terms'");                 
            echo link_button("","dlgtype_of_payment_show()","search");
        ?></td>     
		<td>Status Order</td>
		<td>
			<?php 
			echo form_dropdown('status',$status_list,$status,"id=status $enabled_status");
			
			?>
		</td>
       </tr>
    <tr>
         <td>Salesman</td><td><?php
            echo form_input('salesman',$salesman,"id='salesman'");                 
            echo link_button("","dlgsalesman_show()","search");
                 
        ?></td> 
        <td>Rencana Dikirim</td>
        <td><?=form_input('due_date',$due_date,'id=due_date class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required style="width:150px"');?>
		</td>
	</tr>
    <tr>
        <td>Gudang/Toko</td>
        <td><?php         
            echo form_input('warehouse_code',$warehouse_code,"id='warehouse_code'");                 
            echo link_button("","dlgwarehouse_show()","search");
        ?>
         </td>      
    </tr>
    <tr>
        <td>Keterangan</td><td colspan="6"><?php echo form_input('comments'
                ,$comments,'id=comments style="width:400px"');?>
        </td>
    </tr>
   <tr>
		<td>Barang Terkirim : </td> 
		<td><?=form_radio('delivered',1,$delivered=='1'?TRUE:FALSE,"style='width:20px'");?>Yes 
		<?php echo form_radio('delivered',0,$delivered=='0'?TRUE:FALSE,"style='width:20px'");?>No
		</td>
		<td>Tanggal Kirim : </td>
		<td><?=$ship_date?></td>
	</tr>
</table>