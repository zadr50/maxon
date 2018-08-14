<div class="easyui-panel " title="USER LOGIN">
    <?php
    echo $this->access->print_info();
    echo "</br>".date('l jS \of F Y h:i:s A');
	echo "&nbsp&nbsp<a href='#' onclick='dlgSession_Show();return false'>Session</a>";
    ?>
</div>
<div class="easyui-panel " title="MENU">
    <?php echo $_left_menu; ?>
</div>
<div class="easyui-panel " title="HELP">
    <div id="help">Untuk bantuan anda bisa tekan tombol help atau panduan 
        secara lengkap silahkan kunjungi 
        <a href='http://help.maxonerp.com' target='_new'>Online Help</a>
    </div>
</div>
<?php 
if($this->session->userdata('last_running_visible'))include_once "syslog.php";
//if($this->session->userdata('donate_visible'))
include_once "donate.php";
//if($this->config->item('google_ads_visible'))
$this->load->view('google_ads');

include_once "widget_session.php";
?>
