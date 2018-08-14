<?php
$purchase_order_number=$this->session->userdata('purchase_order_number');
?>
 
 <h1>Nomor Bukti:</h1>
 <strong><?=$shipment_id?>
 <a href='<?=base_url().'index.php/delivery/view/'.$shipment_id?>'
     class="easyui-linkbutton" plain='true'
     data-options="iconCls:'icon-edit'"    
 >View</a>
 </strong>
 <ul>
 <li><?=anchor('delivery/print_bukti/'.$shipment_id,'Print Bukti');?></li>
 <li><?=anchor('deliery/delete/'.$shipment_id,'Delete');?></li>
 </ul> 