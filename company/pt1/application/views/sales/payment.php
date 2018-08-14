<div>
<? 
 
$action="";
if(!isset($line_number))$line_number=0;
echo form_open($action,"id='frmAddPay' ");?>    
<table class='table' style="width:100%;">
    <?=form_hidden('invoice_number',$invoice_number,'id="invoice_number"')?>
    <tr><td>Nomor</td><td>AUTO<?=form_hidden('no_bukti',$no_bukti)?></td></tr>
    <tr><td>Tanggal </td><td><?=form_input('date_paid',$date_paid,'class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			')?></td></tr>
    <tr><td>Jenis Bayar</td><td><?=form_dropdown('how_paid',
            array('Cash','Giro','Transfer'),$how_paid)?></td></tr>
    <tr><td><strong>Jumlah Bayar Rp.</strong></td><td><?=form_input('amount_paid',$amount_paid,"id=amount_paid")?></td></tr>
    <tr><td>&nbsp;</td><td><?=form_hidden('mode_pay',$mode,'id=mode_pay')?></td></tr>    
    <tr><td>&nbsp;</td><td><?=form_hidden('line_number_pay',$line_number,"id=line_number_pay")?></td></tr>    
</table>
<? echo form_close();?>    
</div>