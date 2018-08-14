<script src="<?=base_url();?>js/jquery/jquery-1.8.0.min.js"></script>
<h1>RETUR PEMBELIAN</H1>
<form id='frmReturItem' method="POST" name="frmReturItem" action="<?=base_url()?>index.php/purchase_retur/save"> 
<table>
	<tr>
		<td>Nomor Retur</td><td class='field'><strong><?=$purchase_order_number?></strong></td>
		<?=form_hidden('purchase_order_number',$purchase_order_number);?>
        <td>Tanggal</td><td class='field'><?php echo form_input('po_date',$po_date,'id=po_date');?>
        	*nomor retur sementara
        </td>
    </tr>	 
    <tr>
        <td>Nomor Faktur</td><td class='field'><?=$po_ref?></td>
        <?=form_hidden("po_ref",$po_ref);?>
    </tr>
    <tr>
    	<?=form_hidden("supplier_number",$supplier_number);?>
        <td>Supplier</td><td colspan="4" class='field'><?=$supplier_info?></td>
    </tr>
    <tr>
        <td>Keterangan</td><td colspan="3" class='field'>
        	<?php echo form_input('comments',$comments,'id=comments style="width:300px"');?>
        </td>
    </tr>	  
</table>
<H1></H1>
*Isi quantity yang di retur dikolom [Qty Retur], untuk barang yang tidak diretur
 anda tidak perlu mengisi dikolom tersebut.</br>
*Tekan tombol [Submit] apabila sudah diisi kolom [Qty Retur]
<table class="table1">
<thead>	
<tr><td>Item No</td><td>Description</td><td>Qty</td><td>Unit</td>
	<td>Price</td><td>Amount</td><td>Qty Retur</td>
</tr>
</thead>
<tbody>
<?php foreach ($items->result() as $row) { ?>
<tr><td><?=$row->item_number?></td><td><?=$row->description?></td>
	<td><?=$row->quantity?></td><td><?=$row->unit?></td>
	<td><?=$row->price?></td><td><?=$row->total_price?></td>
	<td><?=form_input('qty[]')?></td>
	<td><?=form_hidden('line_number[]',$row->line_number)?></td>
</tr>					
<?php } ?>
</tbody>
</table>
</form>
<a href='#' onclick="save_retur();return false;" class="easyui-linkbutton" 
data-options="iconCls:'icon-save'">Submit</a>

<script language="JavaScript">
	function save_retur(){$("#frmReturItem").submit();}
</script>

