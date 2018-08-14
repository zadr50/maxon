<?php
$invoice_number=$this->session->userdata('invoice_number');
?>
 
 <h1>Current Invoice</h1>
 <strong><?=$invoice_number?>
 	</br><a href='<?=base_url().'index.php/invoice/view/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-edit'" >View</a>
 	</br><a href='<?=base_url().'index.php/invoice/print_faktur/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-print'" >Print</a>
 	</br><a href='<?=base_url().'index.php/invoice/posting/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-save'" >Posting</a>
 	</br><a href='<?=base_url().'index.php/invoice/payment/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-save'" >Payment</a>
 	</br><a href='<?=base_url().'index.php/invoice/retur/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-save'" >Retur</a>
 	</br><a href='<?=base_url().'index.php/invoice/credit_memo/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-save'" >Credit Memo</a>
 	</br><a href='<?=base_url().'index.php/invoice/debit/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-save'" >Debit Memo</a>
 	</br><a href='<?=base_url().'index.php/invoice/delete/'.$invoice_number?>'
     class="easyui-linkbutton" plain='true' data-options="iconCls:'icon-remove'" >Delete</a>

 </strong>
 