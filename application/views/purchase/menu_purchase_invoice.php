<?php
$purchase_order_number=$this->session->userdata('purchase_order_number');
?>
 
 <h1>Base On Current Invoice</h1>
 <strong><?=$purchase_order_number?>
 <a href='<?=base_url().'index.php/purchase_invoice/view/'.$purchase_order_number?>'
     class="easyui-linkbutton" plain='true'
     data-options="iconCls:'icon-edit'"    
 >View</a>
 </strong>
 <p><?=anchor('purchase_invoice/payments/'.$purchase_order_number,'Daftar Pembayaran');?></p>
 <p><?=anchor('purchase_invoice/jurnal/'.$purchase_order_number,'Jurnal');?></p>
 <p><?=anchor('purchase_invoice/summary_info/'.$purchase_order_number,'Summary Info');?></p>
 <p><?=anchor('purchase_invoice/print_faktur/'.$purchase_order_number,'Cetak Faktur');?></p>

 <h1>Operations</h1>
 <p><?=anchor('purchase_invoice/browse','Daftar Faktur Pembelian');?></p>
