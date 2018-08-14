<?php 
	$active_tab=1;
?>
<h1><?=$title?></h1>
<p>Halaman ini berisi daftar nomor pesanan atas produk yang anda jual.</p>
<div class='alert alert-warning'>
	<p>Order Anda akan otomatis kami batalkan apabila Anda melewati batas 
	waktu respon <strong>(3 hari)</strong> setelah order diverifikasi.
	</p>	
</div>
<div class='col-lg-12 form' role='form'>
	<label>Periode : <input type='text' name='tgl' id='tgl' placeholder='Hari' style='width:100px'>
	<input  type='text' name='bln' id='bln' placeholder='Bulan' style='width:200px'>
	<input  type='text' name='thn' id='thn' placeholder='Tahun' style='width:100px'>
	<a href='#' class='btn btn-default'>Unduh Laporan</a>
</div>
<div role="tabpanel">
	<ul class="nav nav-tabs" role='tablist'>
	  <li role="presentation" class='active'>
		<a href='#tab1'  role="tab" data-toggle="tab" class=' glyphicon glyphicon-inbox'> Pesanan Baru</a></li>
	  <li role="presentation" >
		<a href='#tab2'  role="tab" data-toggle="tab" class='glyphicon glyphicon-transfer'> Konfirmasi Pengiriman</a></li>
	  <li role="presentation">
		<a href='#tab3' role="tab" data-toggle="tab"  class='glyphicon glyphicon-briefcase'> Status Pengiriman</a></li>
	  <li role="presentation">
		<a href='#tab4' role="tab" data-toggle="tab"  class='glyphicon glyphicon-briefcase'> Daftar Transaksi</a></li>
	</ul>
	</br>
	<div class='tab-content'>
		<div id='tab1' role="tabpanel" class="tab-pane fade in active">
			<div class='thumbnail'> 
			Search: <input type='text' name='order_no' id='order_no' placeholder='Invoice/Nama Pembeli'>
			 Jatuh Tempo Respon: <?=form_dropdown('jth_temp',array(''=>'Pilih',
				'0'=>'Hari Ini','1'=>'Besok','2'=>'2 Hari','3'=>'3 Hari'),"");?>
			<button class='btn btn-default'>Refresh</button>
			 <?php if(isset($orders)){ ?>
			 <table class='table'><thead><th>Nota#</th><th>Tanggal</th><th>Customer</th>
				<th>Amount</th><th>Status</th><th>Day</th><th>Supplier</th></thead>
				<tbody>
					<?php foreach($orders->result() as $row) { ?>
					<tr>
					<td><a href='#' onclick='order_view(<?=$row->sales_order_number?>);return false'>
						<?=$row->sales_order_number?></td>
					<td><?=$row->sales_date?></td>
					<td><?=$row->sold_to_customer?> - <?=$row->company?></td>
					<td align='right'><?=number_format($row->amount*1)?></td>
					<td><?=$row->status?></td>
					<td><?=my_date_diff($row->sales_date,date('Y-m-d'))?></td>
					<td><?=$row->supplier_number?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			 <?php } else { 
			 echo "Belum ada pesanan.";
			 }
			 ?>
			</div>
		</div>	
		<div id='tab2' role="tabpanel" class="tab-pane fade">
			<div class='alert alert-info'>
				<p>Order Anda akan otomatis kami batalkan apabila Anda melewati 
				batas waktu respon <strong>5 hari kerja (Senin - Jumat)</strong> setelah order 
				diverifikasi.</p>			
			</div>
			<div class='col-lg-10'>
			<input type='text' name='order_no' id='order_no' placeholder='Invoice/Nama Pembeli'>
			Jatuh Tempo: <?=form_dropdown('jth_tempo_kirim',array(''=>'Pilih',
				'0'=>'Hari Ini','1'=>'Besok','2'=>'2 Hari','3'=>'3 Hari',
				'4'=>'4 Hari','5'=>'5 Hari','6'=>'6 Hari','7'=>'7 Hari'),"");?>
				Kurir: <?=form_dropdown('kurir',array(""=>"Pilih",'1'=>'Tiki','2'=>'Pandu'),"");?>
				<button class='btn btn-default'>Refresh</button>
			
			</div>			
		</div>
		<div id='tab3' role="tabpanel" class="tab-pane fade">
			<input type='text' name='order_no' id='order_no' placeholder='Invoice/Nama Pembeli'>
			<?=form_dropdown('status_trans',array('0'=>'Transaksi Belum Selesai',
			'1'=>'Semua Status','2'=>'Pesanan Baru','3'=>'Dalam Pengiriman',
			'4'=>'Transaksi Resi Valid','5'=>'Transaksi Terkirim','6'=>'Transaksi Selesai',
			'7'=>'Transaksi Dibatalkan'),0);?>
			<button class='btn btn-default'>Refresh</button>

		</div>
		<div id='tab4' role="tabpanel" class="tab-pane fade">
				<p>Tidak ada data </p>
		</div>
	</div>
</div>
<?=load_view('eshop/order_view')?>