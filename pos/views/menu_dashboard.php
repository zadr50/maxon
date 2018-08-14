<?
date_default_timezone_set("Asia/Jakarta");
//echo gmdate("Y-m-d H:i:s", time()+60*60*7);
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-M-d H:i:s");
if($set_tanggal=$this->session->userdata("set_tanggal")){
    $tanggal=$set_tanggal;
}

//$tanggal = date("d F Y");
//echo $tanggal;
/*
if($this->session->userdata('pos')==''){
	echo "<p>Belum ada session yang aktif untuk user anda, silahkan bikin terlebih dahulu.</p>";
	echo "<p><a href='".base_url()."index.php/pos/new_session'>Buat Session Baru</a></p>";
} else {
*/

///	header('Location: http://'.base_url().'index.php/pos');
//}
$ukuran_nota=getvar("ukuran_nota",0);
if($ukuran_nota=="")$ukuran_nota=0; 
if($ukuran_nota==1){
    $width_nota=800;
} else {
    $width_nota=500;
}
$user_id=user_id();
if($pembulatan=="")$pembulatan=0;

?>
<input type='hidden' id='debit' name='debit'>

<div class='row thumbnail'>
    
                
    
    <div class='col-md-12'>
        
    <div class='col-md-9'>
        
        
<div class='pos'>    
    <div class='pos-content'>
        <div class='col-sm-12'>
            <div class='row'>
                
        <div class='col-sm-12' id='pos_top' style="background: #e2e2f4;padding-top:10px;">
            <span class='nama_toko' style='font-weight:900;'>
                <?php 
                
            echo form_dropdown("shipping_location",$shipping_location_list,$shipping_location,"id='shipping_location' style='width:185px'");
            echo link_button('Change','submit_session()','save','false');
            
            echo "<span style='color:black'> $company_name - $company_code</span>";
                
            //    $company_name
                
            ?></span>
            
            <span class='label_display' style='float:right;font-size:24px;'>
                Rp. <span class='total' id='ttl_nota'>0</span>
            </span>        
        </div>
                
                <div class='col-sm-12' style="background: #e0d3f6;">
                    <span>
                    <span class='glyphicon glyphicon-edit'></span> : <span id='nota' style='font-weight:900'>AUTO</span>
                       <span id='nota_tmp'></span>
                        <span class='glyphicon glyphicon-time'></span>
                         : <span id='tanggal' style='font-weight:900'>
                             <?php echo $tanggal; ?>
                           </span> 
                    <span class='glyphicon glyphicon-user'></span> : <span id='userid' style='font-weight:900'><?=$user_id?></span>
                        Cust : <span id='cust' style='font-weight:900'>CASH</span>
                        <?=link_button('Find','dlgcustomers_show();return false','search','false')?>
                        <span id='cust_name'></span>
                        <br>
                        Qty: <?=form_input("qty","0","id='qty_top' class='calc_input' style='width:50px'")?>
                        <span class='glyphicon glyphicon-barcode'></span>
                        Item: <?php echo form_input("barcode","","id='barcode_top' style='width:200px'");?>
                        Type: <?=form_dropdown('cust_type',array('Umum','Member','Tourguide','Lain-lain'),
                             'Umum',"id='cust_type'")?>
                        Qty: <span id='qty_total' style='font-weight:900'>1</span>  
                        Count: <span id='qty_jenis' style='font-weight:900'>1</span>
                                                     
                    </span>
               </div>
               
            </div>
            <div class='row thumbnail'>
                <div class='nota col-sm-12' id="divNota" style=""></div>
            </div>
            <div class='row thumbnail'>
                <p>
                    <button id="btn_up" class="glyphicon glyphicon-triangle-top" > Up </button>
                    <button id="btn_dn" class="glyphicon glyphicon-triangle-bottom" > Down </button>
                    <button id="btn_del" class="del-button glyphicon glyphicon-scissors" > Del </button>

                </p>
                <table width='100%'>
                    <tr><th>Sub Total</th><th>Disc%</th><th>Disc Rp</td><th>Ppn %</th><th>PPn Rp</th><th>Pembulatan</th><th>Total</th></tr>
                    <tr>
                        <td><?=form_input('sub_total',0,"id='sub_total'   class='calc_total'   style='width:100px' ")?></td>
                        <td><?=form_input('disc_nota_prc',0,"id='disc_nota_prc'  class='calc_total'   style='width:50px'")?></td>
                        <td><?=form_input('disc_nota_rp',0,"id='disc_nota_rp'   class='calc_total'    style='width:100px' ")?></td>
                        <td><?=form_input('ppn_prc',0,"id='ppn_prc'  class='calc_total' style='width:50px'")?></td>
                        <td><?=form_input('ppn_rp',0,"id='ppn_rp'   class='calc_total'    style='width:100px' ")?></td>
                        <td><?=form_input('pbulat',0,"id='pbulat'  class='calc_total'  style='width:100px' ")?></td>
                        <td><?=form_input('total_nota',0,"id='total_nota'   class='calc_total'   style='width:100px' ")?></td>
                        <td><?=link_button('Calc','total_nota()','sum','false')?></td>
                    </tr>
                </table>
            </div>
            <div class='row thumbnail' style="background: #e0d3f6;">
                <p><strong>Data Pembayaran</strong></p>
                <table width='100%'>
                    <tr><th>Cash</th><th>Kartu Kredit/Debit</th><th>Voucher</th><th>Jumlah</th><th>Kembalian</th></tr>
                    <tr>
                        <td><?=form_input('pay_cash',0,"id='pay_cash'   class='calc_total' style='width:100px' ")?></td>
                        <td><?=form_input('pay_card',0,"id='pay_card'   class='calc_total'  style='width:100px' ")?>
                            <?=link_button('','card_info()','search')?>
                        </td>
                        <td><?=form_input('pay_voucher',0,"id='pay_voucher'   class='calc_total'  style='width:100px' ")?>
                            <?=link_button('','voucher_info()','search')?>
                        </td>
                        <td><?=form_input('pay_total',0,"id='pay_total'   class='calc_total'  style='width:100px' ")?></td>
                        <td><?=form_input('kembali',0,"id='kembali'   class='calc_total'  style='width:100px' ")?></td>
                        <td><?=link_button('Submit','pay_nota_bawah()','save','false')?></td>
                    </tr>
                </table>
            </div>
            
            <div class='row thumbnail' style="color:white;background: #6868a8;">
                <p><span id='msg-box-wrap'>Ready..</span></p>

            </div>            
        </div>
    </div>
</div>

    </div>
    
    <div class='col-md-3' style="background: #6868a8;padding:4px">
            <div class='thumbnail'>
            <?php include_once "input_barang.php"; ?>
            </div>
      
            <div class='thumbnail'>
               <?=link_button('New','tambah()','add','false')?>
               <?=link_button('Save','save_nota()','save','false')?>
               <?=link_button('Reports','reports()','print','false')?>
               <?=link_button('Reprint','reprint_nota()','print','false')?>
               <?=link_button('Proses','dlgMenuProcess_Show()','search')?>
               <?=link_button('Setting','dlgSetting_Show()','lock')?>
               <?=link_button('Logout','','man','false',base_url('pos.php/login/logout'))?>
            </div>
            <div class='thumbnail'>
                <p><strong>Daftar Nota Open</strong></p>
                <div id='divNotaOpen'>
                    
                </div>
            </div>
    </div>        
    
    
</div>

<div id='dlgNotaPrint'  class="easyui-dialog"  closed="true"  buttons="#btnPrint"
	 style="width:<?=$width_nota?>px;height:600px;padding:5px 5px;left:100px;top:20px">
    <div id='divNotaPrint' style="padding:10px; font-family: 'Arial';"></div>	 
</div>
<div id="btnPrint">
	<?=link_button("Close","print_close()","cancel","false");?>
	<?=link_button("Cetak","print_nota()","print","false");?>
</div>

<?php 
include_once("payment.php"); 
include_once("setting.php");
include_once("menu_process.php"); 
include_once("card_payment.php");
include_once("voucher_payment.php");

echo $lov_customers;
echo $lov_inventory;
?>

<div id="dlgMain"  name='dlgMain' class="easyui-dialog" style="width:1200px;height:650px" 
    closed="true" >
    <div class="easyui-tabs" id="tt"></div>
</div>

<script type='text/javascript' language="JavaScript">	
    var base_url='<?=base_url()?>';
    var url_cat='<?=base_url()?>pos.php/inventory/pos_category/';
    var url_item_filter='<?=base_url()?>pos.php/inventory/pos_items_filter/';
    var url_list_barang ='<?=base_url()?>pos.php/inventory/pos_items/';
    var url_save_pos="<?=base_url()?>pos.php/invoice/save_pos";
    var url_edit_nota="<?=base_url()?>pos.php/invoice/edit_nota/";
    var url_print_nota="<?=base_url()?>pos.php/invoice/print_nota/";
    var url_nota="<?=base_url()?>pos.php/invoice/";
    var nama_toko="<?=$nama_toko?>";
    var alamat="<?=$street?>";
    var telp="<?=$phone_number?>";
    var kota="<?=$city_state_zip_code?>";
    var url_item_find ='<?=base_url()?>pos.php/inventory/find/';
    var tanggal="<?=str_pad(date("Y-m-d H:i:s"),10,"&nbsp")?>";
    var kasir="<?=str_pad(user_id(),10,"&nbsp")?>";
    var trun=0;
    var ukuran_nota=<?=$ukuran_nota?>;
    var pembulatan=<?=$pembulatan?>;
    
    $(document).ready(function(){
        
        tambah();
        
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
        
        run_timer();
        
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
    function submit_session(){
        _url=CI_BASE+'pos.php/user/session';        
        _data={shipping_location:$("#shipping_location").val()};
        
        console.log(_data);
        
        $.ajax({
                type: "POST",
                url: _url,data: _data,
                success: function(msg){
                    console.log(msg);
                    window.open(CI_BASE+"pos.php","_self");
                }
        });
    }

        
</script>
<style>
.calc_total{width:100px;}
</style>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/pos/style.css">
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>assets/printThis-master/printThis.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>assets/pos/lib_pos.js"></script>
