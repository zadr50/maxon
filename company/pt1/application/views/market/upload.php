<div class="col-md-12 thumbnail alert alert-info">
<p>Halaman ini diperuntukkan developer atau programmer yang ingin 
berkontribusi menambah thema atau modul-modul aplikasi sebagai 
addons untuk MaxOn ERP Software.</p>
<p>Modul yang anda upload akan kami review dulu sebelum kami 
publish di website ini.</p>
</div>
<?
echo form_open_multipart("",array("class='form' method='post'"));
?>
<div class="form-group">
		<label class="control-label" for="app_title">Judul</label>
		<input type="text" name="app_title" value="<?=$app_title?>" id="app_title" 
		class="form-control">
</div>
<div class="form-group">
		<label class="control-label" for="app_create_by">Create By</label>
		<input type="text" name="app_create_by" value="<?=$app_create_by?>" id="app_create_by" 
		class="form-control">
</div>
<div class="form-group">
		<label class="control-label col-sm-4" for="app_desc">Description</label>
		<textarea name="app_desc" class="form-control" rows=3><?=$app_desc?></textarea>
</div>
<div class='col-sm-12'>
    <p><strong>Pilih jenis file yang diupload</strong></p> 	
    <p><input type="radio" name="app_type" id="app_type_1" value="themes" checked>
       Modul yang diupload adalah jenis thema </p>
    <p>   
        <input type="radio" name="app_type" id="app_type_2" value="apps">
        Modul yang diupload adalah jenis aplikasi atau modul.
    </p>
    <p><input type="radio" name="app_type" id="app_type_3" value="books">
        File yang diupload adalah buku atau tutorial.
    </p>
</div>
<div class='col-sm-12'>
    <p><strong>Pilih jenis lisensi file yang diupload</strong></p> 	
    <p><input type="radio" name="lic_type" id="lic_type_1" value="free" checked>
    Lisensi aplikasi / thema free</p>
    <p><input type="radio" name="lic_type" id="lic_type_2" value="paid">
    Lisensi aplikasi / thema berbayar.</p>
</div>
 
<div class="form-group">
    <label for="app_ico">File Icon</label>
    <input type="file" id="app_ico" name="app_ico" style="width:400px">
    <p class="help-block">Pilih nama file gambar JPG sebagai icon untuk aplikasi anda.</p>
  </div>
<div class="form-group">
    <label for="app_file">File ZIP</label>
    <input type="file" id="app_file" name="app_file" style="width:400px">
    <p class="help-block">Pilih nama file ZIP modul yang ingin diupload.</p>
  </div>
 
	<h4>Screenshoot</h4>
	<div class="form-group">
		<label for="app_ico">Screenshoot 1</label>
		<input type="file" id="app_scr_1" name="app_scr_1" style="width:400px">
		<p class="help-block">Pilih nama file.</p>
	</div>
	<div class="form-group">
		<label for="app_ico">Screenshoot 2</label>
		<input type="file" id="app_scr_2" name="app_scr_2" style="width:400px">
		<p class="help-block">Pilih nama file.</p>
	</div>
	<div class="form-group">
		<label for="app_ico">Screenshoot 3</label>
		<input type="file" id="app_scr_3" name="app_scr_3" style="width:400px">
		<p class="help-block">Pilih nama file.</p>
	</div>
	<div class="form-group">
		<label for="app_ico">Screenshoot 4</label>
		<input type="file" id="app_scr_4" name="app_scr_4" style="width:400px">
		<p class="help-block">Pilih nama file.</p>
	</div>
	<div class="form-group">
		<label for="app_ico">Screenshoot 5</label>
		<input type="file" id="app_scr_5" name="app_scr_5" style="width:400px">
		<p class="help-block">Pilih nama file.</p>
	</div>

 
<input type='submit' class='btn btn-primary'>
</form>

