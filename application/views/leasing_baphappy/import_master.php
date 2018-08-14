<legend><?=$caption?></legend>
<p>Halaman ini menyiapkan tool untuk melakukan import data item master ke dalam 
database, contoh template file CSV dan kolom yang diijinkan silahkan filenya
download disini <?=anchor(base_url()."import/item_master.csv","item_master.csv")?></p>
<p>Setelah file item_master.csv silahkan isi dengan data item master yang 
anda ingin import</p>
<p>Hati-hati dengan kode yang sama akan mengupdate kode yang sudah ada didatabase</p>
<p>
<div class='thumbnail'>
<?php 
	echo form_open_multipart(base_url()."index.php/inventory/import_excel","id='dlgExcelForm'");
?>
	<input type="file" name="file_excel" id="file_excel" size="150" stye="float:left" />
	<input type="button" value="Submit" onclick="dlgExcelSubmit()">  
	</form>
	<p class="help-block"><i>Only Excel/CSV File Import.</i></p>
</div>
 <script language='javascript'>
	function dlgExcelSubmit(){
		var url='<?=base_url()?>index.php/inventory/import_excel';
		$('#dlgExcelForm').form('submit',{
			url: url, onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				console.log(result);
				var result = eval('('+result+')');
				if (result.success){
					log_msg("Data sudah diimport, periksa data item master di daftar.");
				} else {
					log_err(result.msg);
				}
			}
		});
	}
</script>
