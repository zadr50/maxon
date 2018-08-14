<div class='thumbnail box-gradient'>
<?=link_button("Help","load_help()","help")?>
</div>
<legend>REVIEW HASIL SCORING</legend>
<p>Dibawah ini adalah daftar aplikasi permohonan kredit yang sudah dilakukan scoring 
dan menunggu untuk dilakukan rekomendasi untuk dilakukan proses survey, 
silahkan klik nomor tersebut untuk  proses survey.</p>

<form id="frmMain" name="frmMain" method="post">
	<?=$score_result?>
</form>

<p>&nbsp</p>
<div class='thumbnail'>
	<button type="button" onclick="save()" class="btn btn-info">Recomended</button>
	<button type="button" onclick="save_not_recom()" class="btn btn-warning">Not Recomend</button>
	<p><i>*Tombol RECOMEND akan menyimpan baris yang dicontreng dan direkomendasikan untuk 
	dilakukan proses survey</i></p>
</div>


<script language="javascript">
	var m_app_id="";
	function view_spk(app_id){
		m_app_id=app_id;
		var url="<?=base_url()?>index.php/leasing/app_master/view/"+app_id+"/false";
		add_tab_parent("view/"+app_id,url);
	}
	function view_score(app_id){
		var url="<?=base_url()?>index.php/leasing/scoring/view_result/"+app_id;
		add_tab_parent("score/"+app_id,url);
	
	}
  	function save(){
		if($("#catatan").val()==""){alert("Isi catatan !");return false;}
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/scoring/recomend_save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
					url="<?=base_url()?>index.php/leasing/scoring/recomend";
					window.open(url,"_self");
			}
		});
  	}
	function save_not_recom(){
		if(!confirm('Data sudah benar ? Yakin mau disimpan ?')) return false;
		url='<?=base_url()?>index.php/leasing/scoring/not_recomend_save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
					url="<?=base_url()?>index.php/leasing/scoring/recomend";
					window.open(url,"_self");
			}
		});
  	}
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/score_result");
	}
	function hitung(){
		var n = $( "input:checked" ).length;
		var num=(n/33)*100;
		var s="Score : "+Math.round(num * 100) / 100;
		alertMX(s);
	};
</script>