<div>
<? 
 
$action="";
if(!isset($line_number))$line_number=0;
echo form_open($action,"id='frmAddPay' ");?>    
<table class='table2' style="width:100%;">
    <?=form_hidden('invoice_number',$invoice_number,'id="invoice_number"')?>
    <tr><td>Nomor</td><td><?=form_input('no_bukti',$no_bukti,"id='no_bukti' readonly")?></td></tr>
    <tr><td>Tanggal </td><td><?=form_input('date_paid',$date_paid,'class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			style="width:150px" ')?></td></tr>
    <tr><td>Jenis Bayar</td><td><?=form_input('how_paid',$how_paid,"id='how_paid'")?></td></tr>
    <tr><td><strong>Jumlah Bayar Rp.</strong></td><td><?=form_input('amount_paid',$amount_paid,"id=amount_paid")?></td></tr>
    <tr><td>Mode</td><td><?=form_input('mode_pay',$mode,"id='mode_pay' readonly")?></td></tr>    
    <tr><td>Line</td><td><?=form_input('line_number_pay',$line_number,"id='line_number_pay' readonly ")?></td></tr>    
</table>
<? echo form_close();?>    
</div>