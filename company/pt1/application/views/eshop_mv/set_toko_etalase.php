Dibawah ini adalah nama-nama etalase yang anda punya:
<hr>
<?php 
echo "<table class='table'><thead><th>Nama Etalase</th><th>Keterangan</th>
<th>Kelompok</th><th>Admin</th><th>Banner</th></thead>
<tbody>";
foreach($etalase_list->result() as $row) {
	echo "<tr><td>$row->nama_etalase</td><td>$row->keterangan</td>
	<td>$row->kelompok</th><td>$row->user_admin</td><td>$row->banner_etalase</td>
	</tr>";
}
echo "</tbody></table>";
if($etalase_list->num_rows()==0){
	echo "<div class='alert alert-default'>Belum ada data etalase</div>";
}

?>
<p></p>
 
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Tambah Etalase
</button>

<div class="modal fade" id='myModal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Etalase</h4>
      </div>
      <div class="modal-body">
        <?php 
			echo my_input("Nama Etalase",'nama_etalase',$nama_etalase);
			echo my_input("Keterangan",'keterangan',$keterangan);
			echo my_input("Kelompok",'kelompok',$kelompok);
			echo my_input("Banner",'banner_etalase',$banner_etalase);
			echo my_input("ID TOKO",'id_toko',$id);		
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
