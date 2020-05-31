<legend>Import sales transactions from TXT file</legend>
<p>Dihalaman ini anda bisa melakukan import transaksi data 
penjualan dari text file dengan aturan dan format yang sudah disediakan.</p>
<p>Contoh format text yang diperlukan bisa di download di sini 
    <a href="<?=base_url("import/sales_20180101.txt")?>">sales_20180101.txt</a>
</p>
<p>Dalam text file tersebut baris-baris kode berikut ini 
menujukkan fungsi dan proses yang akan dilakukan oleh sistim</p>
<li>PR - Kode perusahaan atau outlet</li>
<li>CT - Data master pelanggan </li>
<li>ST - Data master barang </li>
<li>IN - Nomor bukti dokumen faktur penjualan, surat jalan, retur penjualan</li>
<li>IL - Data barang yang dijual atas nomor faktur yang ada di IN</li>
<li>PA - Data pembayaran atas nomor faktur yang ada di IN</li>
<p>Tekan tombol <strong>Choose File</strong> untuk memilih file TXT </p>
<?php 
    echo form_open_multipart(base_url()."index.php/invoice/import_invoice_process",
        "id='frmImport'");
?>
<input type="file" name="file_txt" id="file_txt" style="width:50%"/>

<p>Kemudian tekan tombol <strong>Submit</strong> dibawah ini untuk mulai di proses</p>

<?=link_button("Submit","on_process();return false;","save")?>
<?=link_button("Cancel","on_cancel();return false;","cancel")?>
</form>
<div id="divMsg"></div>
<div class="progress"></div>
<div class="thumbnail">
    <img src="<?=base_url("images/loading_little.gif")?>" style="display:none">
    <p id='dlgOffline_msg_loading' style="display:none">Uploading...</p>
    <p id='dlgOffline_msg'></p>        
</div>
<style>
.progress {
    display: block;
    text-align: center;
    width: 0;
    height: 5px;
    background: red;
    transition: width .3s;
}
.progress.hide {
    opacity: 0;
    transition: opacity 1.3s;
}    
</style>

<script language="JavaScript">
    function on_cancel(){
        remove_tab_parent();
    }
    function on_process(){
        var _counter_item=0;
        var _timer_offline=null;
        var _item_master=null;
        var _online=true;
        
        var _data_bar = [];
        for (var i = 0; i < 100000; i++) {
            var tmp = [];
            for (var i = 0; i < 100000; i++) {
                tmp[i] = 'hue';
            }
            _data_bar[i] = tmp;
        };
        
        loading();
        $('#frmImport').form('submit',{
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //console.log(percentComplete);
                        $('.progress').css({
                            width: percentComplete * 100 + '%'
                        });
                        if (percentComplete === 1) {
                            //$('.progress').addClass('hide');
                            $('.progress').css({width:'1%'});
                        }
                    }
                }, false);
                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        console.log(percentComplete);
                        $('.progress').css({
                            width: percentComplete * 100 + '%'
                        });
                    }
                }, false);
                return xhr;
            },
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                loading_close();
                if(IsJsonString(result)){
                    var result = eval('('+result+')');
                    if (result.success){
                        log_msg('Data sudah tersimpan.');
                        remove_tab_parent();
                    } else {
                        $("#divMsg").html(result.msg);
                    }

                } else {
                    loading_close();
                    $("#divMsg").html(result);
                }
            }
        });        
    }
</script>