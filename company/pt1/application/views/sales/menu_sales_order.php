<?php
$sales_order_number=$this->session->userdata('sales_order_number');
?>
 
 <h1>Base On Current SO</h1>
 <strong><?=$sales_order_number?>
 	<a href='<?=base_url().'index.php/sales_order/view/'.$sales_order_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-edit'" >View</a>
 </strong>
 <ul>
 <li><?=anchor('delivery/add_with_so/'.$sales_order_number,'Kirim Barang');?></li>
 <li><?=anchor('sales_order/list_delivery/'.$sales_order_number,'Daftar Pengiriman');?></li>
 <li><?=anchor('sales_order/create_invoice/'.$sales_order_number,'Buatkan Faktur');?></li>
 <li><?=anchor('sales_order/print_so/'.$sales_order_number,'Cetak Nomor S.O.');?></li>
</ul>