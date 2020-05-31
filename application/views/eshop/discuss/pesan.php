<?php 
	$active_tab=1;
?>
<h1><?=$title?></h1>
<p>Halaman ini berisi pesan atau inbox yang dikirimkan oleh pengguna lain.</p>
<div class="alert alert-warning" >
<p>Harap tidak menginformasikan <strong>user &amp; password</strong> 
Anda kepada siapapun, termasuk pihak yang mengatasnamakan kami.</p>
</div>
<p>Tampilkan: 
<a href='<?=base_url()?>index.php/eshop/inbox/all'> Semua</a> | 
<a href='<?=base_url()?>index.php/eshop/inbox/unread'> Belum Dibaca</a>
<div role="tabpanel">
	<ul class="nav nav-tabs" role='tablist'>
	  <li role="presentation" class='active'>
		<a href='#tab1'  role="tab" data-toggle="tab" class=' glyphicon glyphicon-inbox'> Kotak Masuk</a></li>
	  <li role="presentation" >
		<a href='#tab2'  role="tab" data-toggle="tab" class='glyphicon glyphicon-transfer'> Terkirim</a></li>
	  <li role="presentation">
		<a href='#tab3' role="tab" data-toggle="tab"  class='glyphicon glyphicon-briefcase'> Arsip</a></li>
	  <li role="presentation">
		<a href='#tab4' role="tab" data-toggle="tab"  class='glyphicon glyphicon-briefcase'> Sampah</a></li>
	</ul>
	<div class='tab-content'>
		<div id='tab1'  role="tabpanel" class="tab-pane fade in active" >
		<table class='table'><thead><th>From</th><th>Subject</th><th>Date</th>
		<th>Read</th><th>Action</th></thead>
		<tbody>
			<?php foreach($messages->result() as $message) { 
				if ($message->rcp_from != '') { ?>
				<tr style='background-color: #fcf8e3;'><td><?=$message->rcp_from?></td>
					<td><?=$message->subject?></td>
					<td><?=$message->msg_date?></td>
					<td><?=$message->is_read?></td>
					<td><a href='#' onclick='reply(<?=$message->id?>);return false'>Reply</a> | 
					<a href='#' onclick='sampah(<?=$message->id?>);return false'>Delete</a> </td>
				</tr>
				<tr><td colspan='5'><?=$message->message?></td></tr>
				<?php } } ?>
		</tbody>
		</table>
		</div>
		<div id='tab2' role="tabpanel" class="tab-pane fade"> 
		<table class='table'><thead><th>To</th><th>Subject</th><th>Date</th>
		<th>Action</th></thead>
		<tbody>
			<?php foreach($message_send->result() as $message) { 
				if ($message->rcp_to != '') { ?>
				<tr style='background-color: #fcf8e3;'><td><?=$message->rcp_to?></td>
					<td><?=$message->subject?></td>
					<td><?=$message->msg_date?></td>
					<td><a href='#' onclick='sampah(<?=$message->id?>);return false'>Delete</a> </td>
				</tr>
				<tr><td colspan='5'><?=$message->message?></td></tr>
				<?php } } ?>
		</tbody>
		</table>		
		</div>
		<div id='tab3' role="tabpanel" class="tab-pane fade"> 
		<table class='table'><thead><th>From</th><th>Subject</th><th>Date</th>
		<th>Action</th></thead>
		<tbody>
			<?php foreach($message_arsip->result() as $message) { 
				if ($message->rcp_from != '') { ?>
				<tr style='background-color: #fcf8e3;'><td><?=$message->rcp_from?></td>
					<td><?=$message->subject?></td>
					<td><?=$message->msg_date?></td>
					<td><a href='#' onclick='sampah(<?=$message->id?>);return false'>Delete</a> </td>
				</tr>
				<tr><td colspan='5'><?=$message->message?></td></tr>
			<?php } } ?>
		</tbody>
		</table>		
		</div>
		<div id='tab4' role="tabpanel" class="tab-pane fade"> 
		<table class='table'><thead><th>From</th><th>To</th><th>Subject</th><th>Date</th>
		<th>Action</th></thead>
		<tbody>
			<?php foreach($message_sampah->result() as $message) { ?>
				<tr style='background-color: #fcf8e3;'><td><?=$message->rcp_from?></td>
					<td><?=$message->rcp_to?></td>
					<td><?=$message->subject?></td>
					<td><?=$message->msg_date?></td>
					<td><a href='#' onclick='kill(<?=$message->id?>);return false'>Delete</a> </td>
				</tr>
				<tr><td colspan='5'><?=$message->message?></td></tr>
			<?php }  ?>
		</tbody>
		</table>		
		</div>
	</div>
</div>
 <?php echo load_view('eshop/pesan_form.php') ?>
		