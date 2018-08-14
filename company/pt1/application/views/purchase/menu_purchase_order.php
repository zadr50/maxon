<?php
$purchase_order_number=$this->session->userdata('purchase_order_number');
?>
 
 <h1>Base On Current PO</h1>
 <strong><?=$purchase_order_number?>
 <a href='<?=base_url().'index.php/purchase_order/view/'.$purchase_order_number?>'
     class="easyui-linkbutton" plain='true'
     data-options="iconCls:'icon-edit'"    
 >View</a>
 </strong>
 <ul>
 <li><?=anchor('receive_po/add_with_po/'.$purchase_order_number,'Terima Barang');?></li>
 <li><?=anchor('purchase_order/view_receive/'.$purchase_order_number,'Daftar Penerimaan');?></li>
 <li><?=anchor('purchase_order/create_invoice/'.$purchase_order_number,'Buatkan Faktur');?></li>
 <li><?=anchor('purchase_order/print_po/'.$purchase_order_number,'Cetak Nomor PO');?></li>
 <li><?=anchor('purchase_order/copy/'.$purchase_order_number,'Duplikat PO');?></li>
 <li><?=anchor('purchase_order/close/'.$purchase_order_number,'Tutup Nomor PO');?></li>
 </ul> 