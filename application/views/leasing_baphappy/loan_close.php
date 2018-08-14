<legend>Proses Penutupan Kredit</legend> 
<div class='thumbnail box-gradient'>
<? 	echo my_input("Cari nomor kredit atau nama","txtSearch","","col-sm-4",'col-sm-3');
	echo "<input onclick='cmdSearch_Click();return false;' type='button' name='cmdSearch' id='cmdSearch' value='Search' class='btn btn-info'>";
?>
<p><i>Dibawah ini adalah data tagihan berdasarkan pencarian diatas.</i></p>
<p><i>*Pelunasan dipercepat dikenakan penalty potongan 2% dari sisa angsuran</i></p>
</div>
<div class='thumbnail'>
	<div id='divOutStand'></div>
	<div id='divLoanDetail'></div>
</div>
<div id='dlgBayar'class="easyui-dialog" style="width:500px;height:450px;padding:5px 20px" closed="true" 
	buttons="#tbBayar">
	<?
		echo form_open('',array("action"=>"","name"=>"frmBayar","id"=>"frmBayar"));
		echo "<table class='table2' style='width:100%'>";
		echo "<tr><td>Tanggal Bayar</td><td>".form_input('date_paid',date("Y-m-d H:i:s"),"class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' ")."</td>";
		echo "<tr><td>Cara Bayar</td><td>".form_input('how_paid','Cash')."</td>";
		echo "<tr><td>Potongan Rp.</td><td>".form_input('discount',0)."</td>";
		echo "<tr><td>Pokok Rp.</td><td>".form_input('pokok',0)."</td>";
		echo "<tr><td>Finalty Rp.</td><td>".form_input('finalty',0)."</td>";
		echo "<tr><td><span style='font-size:24px;weight:80'>Jumlah Bayar Rp.</span></td><td>".form_input('amount_paid',0)."</td>";
		echo "<tr><td>Keterangan</td><td>".form_input('comment')."</td>";
		echo "</table>";
		echo form_close();
	?>		
</div>
<div id="tbBayar">
	<?=link_button("Keluar","dlgBayar_Close()","remove")?>
	<?=link_button("Proses","dlgBayar_Save()","save")?>
	
</div>

<script language='javascript'>
	var m_loan_id='';
	function cmdSearch_Click() {
		if($("#txtSearch").val()==""){alert("Isi nomor atau nama debitur !");return false};
		var url='<?=base_url()?>index.php/leasing/loan/list_outstand/'+$('#txtSearch').val();
		get_this(url,'','divOutStand');
	}
	function view_loan(loan_id){		
		var url="<?=base_url()?>index.php/leasing/loan/view/"+loan_id+'/false';
		add_tab_parent("loan_"+loan_id,url);
	}
	function dlgBayar_Show(loan_id){
		m_loan_id=loan_id;
		var xurl='<?=base_url()?>index.php/leasing/loan/saldo_pokok/'+loan_id;
		$.ajax({type: "GET", url: xurl,
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$("#frmBayar input[name='pokok']").val(result.saldo_pokok);					
					var amount_paid=result.saldo_pokok;
					var finalty=(0.02*amount_paid);
					amount_paid=parseFloat(amount_paid)+parseFloat(finalty);
					$("#frmBayar input[name='finalty']").val(finalty);					
					$("#frmBayar input[name='amount_paid']").val(amount_paid)
				}				
			},
			error: function(msg){alert(msg);return false;}
		}); 
		
		$("#dlgBayar").dialog("open").dialog('setTitle','Proses Pelunasan Kredit');		
	}
	function dlgBayar_Close(){
		$("#dlgBayar").dialog("close");		
	}
	function dlgBayar_Save(){
		if(m_loan_id==""){alert("Isi nomor kredit");return false};
		url='<?=base_url()?>index.php/leasing/loan_close/save/'+m_loan_id;
		$('#frmBayar').form('submit',{
			url: url, param: "", onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					log_msg('Data sudah tersimpan.');
					dlgBayar_Close();
					cmdSearch_Click();
					dlgBayar_Print(m_loan_id);
				} else {
					log_err(result.msg);
				}
			}
		});	
		
	}
	function dlgBayar_Print(voucher) {
		var url="<?=base_url()?>index.php/leasing/loan_close/kwitansi_by_id/"+voucher;
		window.open(url,"Kwitansi_Close_"+voucher);		
	}
</script>