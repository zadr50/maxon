 <h1>Daftar Transaksi Work Order</h1>
 <div class="paging"><?php echo $pagination;?></div>
 <div class="data"><?php echo $table;?></div>
 <div class="paging"><?php echo $pagination;?></div><br/>
 <?php echo anchor('manuf/workorder/add/',
 'Tambah data baru',array('class'=>'add'));?>
 