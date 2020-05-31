 <?php
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
 
		
			<div class='info-maxon thumbnail info_link_no_frame' href="<?=base_url()?>index.php/travel/tour">
				<div class='photo'><img src='<?=base_url()?>images/applets-screenshooter.png'/></div>
				<div class='detail'>
					<h4>Paket Tour</h4>
					Pemesanan paket tour dan seting data master paket.
				</div>
			</div>

			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/travel/pesawat">
				<div class='photo'><img src='<?=base_url()?>images/rocket.png'/></div>
				<div class='detail'>
					<h4>Tiket Pesawat</h4>
					Pembuatan invoice untuk tiket pesawat dan rute kota tujuan
				</div>
			</div>
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/travel/kereta">
				<div class='photo'><img src='<?=base_url()?>images/tor-icon.png'/></div>
				<div class='detail'>
					<h4>Ticket Kereta</h4>
					Pembuatan invoice untuk pemesanan tiket kereta api
				</div>
			</div>
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/travel/bus">
				<div class='photo'><img src='<?=base_url()?>images/desktop.png'/></div>
				<div class='detail'>
					<h4>Ticket Bus</h4>
					Pembuatan invoice untuk pemesanan tiket bus atau kendaraan
				</div>
			</div>
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/travel/hotel">
				<div class='photo'><img src='<?=base_url()?>images/scribus.png'/></div>
				<div class='detail'>
					<h4>Voucher Hotel</h4>
					Pembuatan invoice untuk pemesanan hotel
				</div>
			</div>
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/travel/airline">
				<div class='photo'><img src='<?=base_url()?>images/rocket.png'/></div>
				<div class='detail'>
					<h4>Airlines</h4>
					Data master airline maskapai penerbangan
				</div>
			</div>
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/city">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Data Master Kota</h4>
					Data master kota keberangkatan atau kota tujuan
				</div>
			</div>
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/customer">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Data Master Pelanggan</h4>
					Data master pelanggan
				</div>
			</div>
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/country">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Data Master Negara</h4>
					Data master negara
				</div>
			</div>
		 
			<div class='info-maxon thumbnail info_link' href="<?=base_url()?>index.php/province">
				<div class='photo'><img src='<?=base_url()?>images/ico_setting.png'/></div>
				<div class='detail'>
					<h4>Data Master Provinsi</h4>
					Data master province
				</div>
			</div>
 
    </div>
</div>


<script  language="javascript">
$().ready(function(){
    
    var _title_tab="";
    
	//void get_this(CI_ROOT+'purchase_invoice/daftar_kartu_gl','','divGL');
    $(".info_link_no_frame").click(function(event){
        event.preventDefault(); 
        var url = $(this).attr('href');
        console.log(url);
        var n = url.lastIndexOf("/");
        var j=url.lastIndexOf("#");
        if(j>0){
            var title=url.substr(j+1);
        } else {
            var title=url.substr(n+1);
        }
        if(title=='reports'){
            title=url.substr(n-10);
            title=title.substr(title.indexOf("/"));
        }
        if(url.indexOf("/menu")>5){
            window.open(url,"_self");
        } else {
            add_tab_ajax_nf(title,url);
        }
    });
	
});
    
    function add_tab_ajax_nf(title,url){
        
        _title_tab=title;
        
        if ($('#tt').tabs('exists', title)){ 
            $('#tt').tabs('select', title); 
        } else {            
            index++;
            var img=CI_BASE+"images/loading.gif";
            var content = "<div id='tab"+title+"'><img src='"+img+"'>Loading...</div>"; 
            $('#tt').tabs('add',{
                title: title,
                content: content,
                closable: true
            });
            $('#tt').tabs('select', title); 
            get_this2(url,'','tab'+title);
        }   
         window.top.scrollTo(0,0);
    }
    
	
</script>

