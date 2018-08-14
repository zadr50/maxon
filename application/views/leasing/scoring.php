<div class='thumbnail box-gradient'>
<?=link_button("Help","load_help()","help")?>
</div>
<legend>PROSES SCORING</legend>
<p>Dibawah ini adalah daftar aplikasi permohonan kredit yang sudah diverifikasi
dan menunggu untuk dilakukan scoring oleh anda, silahkan klik nomor tersebut untuk 
proses scoring.</p>

<?=$not_scored?>

<div class='' id='divResult' style="display:none">
	<legend>STEP 1 - Beri Score pada baris yang sama dibawah ini : </legend>
	<p>Dibawah ini adalah data-data yang perlu anda beri nilai score sebagai berikut: Silahkan contreng apabila sesuai anda baris SA (Data Sales Asistant)
	dan baris PV (Phone Verificator) </br>
	Tekan tombol <strong>SIMPAN</strong> dibawah apabila sudah selesai 
dan ingin di proses ke database.	</p>
	<div id='divResultContent'>
	
	</div>
	<p></p>
	<div class='thumbnail'>
		<button type="button" onclick="hitung()" class="btn btn-info">HITUNG SCORE</button>
		<button type="button" onclick="save()" class="btn btn-info">SIMPAN</button>
	</div>
</div>

<script language="javascript">
	var m_app_id="";
	function step1(app_id){
		m_app_id=app_id;
		var url="<?=base_url()?>index.php/leasing/scoring/step1/"+app_id;
		get_this(url,"","divResultContent");
		$("#divResult").fadeIn('slow');
		$("#divResultStep1").fadeOut('slow');
	}
  	function save(){
  		if(m_app_id==''){alert('Isi kode aplikasi !');return false;}
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/scoring/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					url="<?=base_url()?>index.php/leasing/scoring";
					log_msg('Data sudah tersimpan.');
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	 
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/scoring");
	}
	function hitung(){
		var n = $( "input:checked" ).length;
		var num=(n/14)*100;
		num=Math.round(num * 100) / 100;
		var s="Score : "+num;
		alertMX(s);
		$("#score_value").html(num);
	};
	function view_spk(nomor){
		var url="<?=base_url()?>index.php/leasing/app_master/view/"+nomor+"/view/false";
		add_tab_parent("ViewSpk"+nomor,url);
	}
	function view_cust(nomor){
		var url="<?=base_url()?>index.php/leasing/cust_master/view/"+nomor+"/view/false";
		add_tab_parent("ViewCst"+nomor,url);
	}
</script>