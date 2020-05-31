<script type='text/javascript' language="JavaScript">	
    var base_url='<?=base_url()?>';
	var CI_BASE=base_url;
	var CI_ROOT=base_url;
    var url_cat='<?=base_url()?>index.php/inventory/pos_category_json/';
    var url_item_filter='<?=base_url()?>index.php/inventory/pos_items_filter_json/';
    var url_list_barang ='<?=base_url()?>index.php/inventory/pos_items/';
    var url_save_pos="<?=base_url()?>pos.php/invoice/save_pos";
    var url_edit_nota="<?=base_url()?>pos.php/invoice/edit_nota/";
    var url_print_nota="<?=base_url()?>pos.php/invoice/print_nota/";
    var url_nota="<?=base_url()?>pos.php/invoice/";
    var nama_toko="";
    var alamat="";
    var telp="";
    var kota="";
    var url_item_find ='<?=base_url()?>index.php/inventory/find/';
    var tanggal="<?=str_pad(date("Y-m-d H:i:s"),10,"&nbsp")?>";
    var kasir="<?=str_pad(user_id(),10,"&nbsp")?>";
    var trun=0;
    var ukuran_nota="";
    var pembulatan="";

</script>

<?php 
date_default_timezone_set("Asia/Jakarta");
//echo gmdate("Y-m-d H:i:s", time()+60*60*7);
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-M-d H:i:s");
if($set_tanggal=$this->session->userdata("set_tanggal")){
    $tanggal=$set_tanggal;
}
$ukuran_nota=getvar("ukuran_nota",0);
if($ukuran_nota=="")$ukuran_nota=0; 
if($ukuran_nota==1){
    $width_nota=800;
} else {
    $width_nota=500;
}
$user_id=user_id();
$pembulatan=0;
$nama_toko="MaxOn";

include_once "design/header.php";
if(!isset($_page)){
	include_once "dashboard/admin.php";
}
include_once "design/footer.php";
?>

<script type='text/javascript' language="JavaScript">	
    
    
    $(document).ready(function(){
        
        refresh_cat();
        
        
        $(".info_link2").click(function(event){
            
            event.preventDefault(); 
            $("#dlgMenuProcess").dialog("close");
            $("#dlgMain").dialog("open").dialog('setTitle','Dialog'); 
            
            var url = $(this).attr('href');
            console.log(url);
            var n = url.lastIndexOf("/");
            var j=url.lastIndexOf("#");
            if(j>0){
                var title=url.substr(j+1);
            } else {
                var title=url.substr(n+1);
            }
            
            add_tab_parent(title,url);
            
        });
        
//        run_timer();
//        run_timer_replicate();
        
    });
    function run_timer() {
        $('#msg-box-wrap').html("Loading...");     
        trun=setTimeout(function(){run_timer()},68000);
        $.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/inventory/recalc',
                contentType: 'application/json; charset=utf-8',
                success: function(msg){
                    console.log(msg);
                }
        });
    }
    function run_timer_replicate() {
        $('#msg-box-wrap').html("Loading...replicate");     
        trun=setTimeout(function(){run_timer_replicate()}, 48000);
        $.ajax({
                type: "GET",
                url: '<?=base_url();?>index.php/replicate/process',
                contentType: 'application/json; charset=utf-8',
                success: function(msg){
                    console.log(msg);
                    $("#msg-box-wrap").html(msg);
                }
        });
    }

</script>
