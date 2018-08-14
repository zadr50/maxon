<script src="<?=base_url();?>js/lib.js"></script>
<script src="<?=base_url();?>js/jquery-ui/jquery.easyui.min.js"></script>
<form id='myform' method='post' action='<?=base_url()?>index.php/receive_po/proses'>
 
<h1>PENERIMAAN BARANG DARI PO</H1>
   <table>
       <tr>
            <td>Nomor PO:</td><td><strong><?=$purchase_order_number?></strong>
            <?=form_hidden('purchase_order_number',$purchase_order_number);?>
            </td>            
             <td colspan='4'><?=$supplier_info?>
            <?=form_hidden('supplier_number',$supplier_number);?>
             
             </td>            
      </tr>
       <tr>
            <td>Tanggal:</td>
            <td><?=form_input('date_received',
                    $date_received,'id=date_received');?>
            </td>
            <td>Gudang:</td><td><?php echo form_dropdown('warehouse_code',
                    $warehouse_list,$warehouse_code,'id=warehouse_code');?>
            </td>
       </tr>
      <tr>
            <td>Keterangan</td>
            <td colspan="4"><?=form_input('comments',$comments,
                    'id=comments style="width:300px"');?>
            </td>
       </tr>
       <tr>
           <td>Receipt By:</td>
           <td><?=form_input('receipt_by',$receipt_by,'id=receipt_by');?></td>
           <td>
                
           </td> 
       </tr>
 
   </table>

<div id='divPoItemWrap'><div id='divPoItem'>

<h1>DAFTAR BARANG PO</h1>
<h3></h3>

                    
<table class="table1">
<thead><tr><td>#</td><td>Item No</td><td>Description</td><td>Pesan</td>
<td>Unit</td><td>Sudah</td><td>Sisa</td><td>Terima</td></tr>
</thead>
<tbody>
    <?php
    $i=1;
    foreach($po_item->result() as $row){
        $bal=($row->quantity)-($row->qty_recvd==null?0:$row->qty_recvd);
        echo "<tr>
            <td>".$i++."</td>
            <td>".$row->item_number."</td>
            <td>".$row->description."</td>
            <td>".$row->quantity."</td>
            <td>".$row->unit."</td>
            <td>".($row->qty_recvd==null?0:$row->qty_recvd)."</td>
            <td>".$bal."</td>            
            <td><input type='text' name='qty[]' value='".$bal."'>
            <input type='hidden' name='line_number[]' value='".$row->line_number."'>
            </td>
        </tr>";
    }
    ?>
</tbody>
</table>        
<div id="divBtnProses"  >
               <a href="#" class="easyui-linkbutton" 
                    data-options="iconCls:'icon-save'"
                    onclick='proses()'>Proses</a>
                   *Isi kolom quantity terima terlebih dahulu dalam tabel dibawah ini, 
                    klik tombol [PROSES] apabila sudah selesai.
</div>        
 </div></div>
</form>
<script type="text/javascript">
    function proses()
    {
        if($('#warehouse_code')==''){
            alert('Pilih gudang penerima');
            return false;
        }
        $('#myform').submit();
    }    
</script>
    