<div class='thumbnail box-gradient'>
	<?=link_button("Import CSV","import_csv()","csv")?>
	<?=link_button("Import CSV Klik BCA","import_csv_bca()","csv")?>
	<?=link_button("Help","load_help('payment_leasing')","help")?>
</div>

<legend>Proses Pembayaran Cicilan</legend>


<div class='thumbnail box-gradient'>
<table class='table2' width='100%'>
<tr><td>Cari Nama atau nomor kontrak : </td>
<td><input type='text' name='txtSearch' id='txtSearch'></td>
<td><input type='button' class='btn btn-info' 
	onclick='cmdSearch_Click();return false' value='Cari Belum Lunas'>
<input type='button' class='btn btn-info' 
	onclick='cmdSearchBilling_Click();return false' value='Cari Billing'>
</td>
</tr>
</table>
<p><i>Dibawah ini adalah data tagihan berdasarkan pencarian diatas, silahkan isi kode pencarian.</i></p>
</div>
<div class='row' id="lstResult" style="display:none">
	<p><i>Silahkan klik pada nomor tagihan dibawah ini untuk melakukan pembayaran cicilan, kemudian klik tombol BAYAR </i></p>
	<table id="dgItems" class="easyui-datagrid"  style="width:auto;height:auto"
	data-options="iconCls: 'icon-edit',	singleSelect: true,	toolbar: '#tbItems',url: ''">
	<thead><tr>
		<th data-options="field:'cust_name'">Pelanggan</th>
		<th data-options="field:'cust_id'">Kode Pelanggan</th>
		<th data-options="field:'invoice_number'">Nomor Faktur</th>
		<th data-options="field:'invoice_date'">Tanggal</th>
		<th data-options="field:'idx_month'">Bulan Ke</th>
		<th data-options="field:'amount2',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Jumlah+Saldo</th>
		<th data-options="field:'amount',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Jumlah Tagihan</th>
		<th data-options="field:'paid'">Sudah Bayar</th>
		<th data-options="field:'date_paid'">Tanggal Bayar</th>
		<th data-options="field:'how_paid'">Jenis Bayar</th>
		<th data-options="field:'amount_paid',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Jumlah Bayar</th>
		<th data-options="field:'hari_telat'">Hari Telat</th>
		<th data-options="field:'denda_tagih',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Denda Tagih</th>
		<th data-options="field:'bunga',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Bunga</th>
		<th data-options="field:'pokok',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Pokok</th>
		<th data-options="field:'bunga_paid',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Bunga Paid</th>
		<th data-options="field:'pokok_paid',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Pokok Paid</th>
		<th data-options="field:'denda',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Denda Paid</th>
		<th data-options="field:'saldo',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Saldo</th>
		<th data-options="field:'saldo_titip',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Saldo Titip</th>
		
	</tr></thead></table>
</div>
<div id='tbItems'>
<input type='button' class='btn btn-info' 
	onclick='tbItems_Bayar_Click();return false' value='BAYAR'>
</div>
<div id='dlgBayar'class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px" closed="true" 
	buttons="#tbBayar">
	<legend>Pembayaran Cicilan</legend>
	<?
		echo "<table class='table'>"; 
		echo form_open('',array("action"=>"","name"=>"frmBayar","id"=>"frmBayar"));
		echo "<tr><td>Tanggal Bayar</td><td>";
		//echo my_input_date("","date_paid",date("Y-m-d H:i:s"));
		echo "<input type='text' 
			id='date_paid' name='date_paid' value='".date("Y-m-d H:i:s")."' >";
		echo "</td></tr>";
		echo "<tr><td>Nomor Faktur :</td><td><input name='invoice_number' id='invoice_number' type='text' readonly ></td></tr>";
		echo "<tr><td>Cara Bayar :</td><td><input name='how_paid' id='how_paid' type='text' readonly ></td></tr>";
		echo "<tr><td>Saldo tagihan bulan lalu :</td><td><input name='saldo_titip' id='saldo_titip' type='text' readonly ></td></tr>";
		echo "<tr><td>Tagihan bulan ini :</td><td><input name='tagihan' id='tagihan' type='text' readonly ></td></tr>";
		echo "<tr><td>Jumlah Tagihan+Saldo :</td><td><input name='tagihan_saldo' id='tagihan_saldo' type='text' readonly >
		</td></tr>";
		echo "<tr><td><span style='font-size:24px;weight:80'>Bayar Rp.:</span>
		</td>
			<td><input name='amount_paid' id='amount_paid' 
			type='text' style='font-size:24px;width:150px' >
			</br><span class=''><i>**Isi tanpa koma atau titik, 
			contoh: 100000 jangan: 100,000
			</i>
			</span>
			</td>
			</tr>";
		echo "<tr><td colspan='2'><legend>Perhitungan</legend></td></tr>";
		echo "<tr><td>Denda :</td><td><input name='denda' id='denda' type='text' readonly ></td></tr>";
		echo "<tr><td>Bunga :</td><td><input name='bunga' id='bunga' type='text' readonly ></td></tr>";
		echo "<tr><td>Pokok :</td><td><input name='pokok' id='pokok' type='text' readonly ></td></tr>";
		echo form_close();
		echo "<tr><td><legend>Info</legend></td></tr>";
		echo "<tr><td>Tanggal Tagih :</td><td><input name='invoice_date' id='invoice_date' type='text' readonly ></td></tr>";
		echo "<tr><td>Hari Telat :</td><td><input name='hari_telat' id='hari_telat' type='text' readonly ></td></tr>";
		echo "</table>";
	?>		
</div>

<!-- SEARCH BILLING -->
<div class='row' id="divResultBilling" style="display:none">
	<table id="divRbItems" class="easyui-datagrid"  style="width:auto;height:auto"
	data-options="iconCls: 'icon-edit',	singleSelect: true,	toolbar: '#divRbTool',url: ''">
	<thead><tr>
		<th data-options="field:'cust_name'">Pelanggan</th>
		<th data-options="field:'cust_id'">Kode Pelanggan</th>
		<th data-options="field:'invoice_number'">Nomor Faktur</th>
		<th data-options="field:'invoice_date'">Tanggal</th>
		<th data-options="field:'idx_month'">Bulan Ke</th>
		<th data-options="field:'amount2',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Jumlah+Saldo</th>
		<th data-options="field:'amount',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Jumlah Tagihan</th>
		<th data-options="field:'paid'">Sudah Bayar</th>
		<th data-options="field:'date_paid'">Tanggal Bayar</th>
		<th data-options="field:'how_paid'">Jenis Bayar</th>
		<th data-options="field:'amount_paid',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Jumlah Bayar</th>
		<th data-options="field:'hari_telat'">Hari Telat</th>
		<th data-options="field:'denda_tagih'">Denda Tagih</th>
		<th data-options="field:'bunga',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Bunga</th>
		<th data-options="field:'pokok',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Pokok</th>
		<th data-options="field:'bunga_paid',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Bunga Paid</th>
		<th data-options="field:'pokok_paid',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Pokok Paid</th>
		<th data-options="field:'denda',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Denda Paid</th>
		<th data-options="field:'saldo',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Saldo</th>
		<th data-options="field:'saldo_titip',width:100,align:'right',editor:'numberbox',
			formatter: function(value,row,index){
			return number_format(value,2,'.',',');}">Saldo Titip</th>
		
	</tr></thead></table>
</div>
<div id='divRbTool'>
<input type='button' class='btn btn-info' 
	onclick='divRbToolView_Click();return false' value='VIEW'>
</div>


<div id="tbBayar">
	<?=form_checkbox("check_print","",1,"id='check_print'")." Cetak kwitansi."?>
	<?=link_button("Hitung","dlgBayar_Recalc()","reload","false")?>
	<?=link_button("Keluar","dlgBayar_Close()","remove","false")?>
	<span id='divBtnSave'>
	<?=link_button("Proses","dlgBayar_Save()","save","false")?>
	</span>
</div>
<script language='javascript'>
	var sudah_hitung=false;
	var denda_hari=<?=getvar("denda_hari",7)?>;
	var denda_prc=<?=getvar("denda_prc",5)?>;
	var def_denda=0;
	var def_bunga=0;
	var def_pokok=0;
	if(denda_prc>=1)denda_prc=denda_prc/100;
	function cmdSearch_Click() {
		$("#divResultBilling").fadeOut();
		if($("#txtSearch").val()==""){alert("Isi nomor atau nama debitur !");return false};
		var xurl='<?=base_url()?>index.php/leasing/loan/list_not_paid/'+$('#txtSearch').val();
		$('#lstResult').fadeIn();
		$('#dgItems').datagrid({url:xurl});
		$('#dgItems').datagrid('reload');		
	}
	function tbItems_Bayar_Click() {
		var row = $('#dgItems').datagrid('getSelected');
		
		if (row){
			console.log(row);
			$('#dlgBayar').dialog('open').dialog('setTitle','Proses Bayar Cicilan');
			$('#invoice_number').val(row.invoice_number);
			$('#how_paid').val("Cash");
			$("#invoice_date").val(row.invoice_date);
			$("#hari_telat").val(row.hari_telat);
			$("#denda").val(number_format(row.denda_tagih));
			$("#bunga").val(number_format(row.bunga));
			$("#pokok").val(number_format(row.pokok));
			//$("#amount_paid").val(0);	//row.amount2
			load_recalc();			

			//var denda=0,saldo_titip=0;
			//var amount=row.amount,amount_paid=0,tagihan_saldo=row.amount2;
			//$("#tagihan").val(number_format(amount));
			//$("#saldo_titip").val(number_format(saldo_titip));
			//if (row.saldo_titip) saldo_titip=row.saldo_titip;
			//saldo_titip=$("#saldo_titip").val();
			//var amount_paid=parseFloat(amount)-parseFloat(saldo_titip);
			//$("#tagihan_saldo").val(number_format(tagihan_saldo));
			//load_recalc();			
			$("#amount_paid").val("0");
		}
	}
	function tbItems_Edit_Click() {
		alert("edit");
	}
	function tbItems_Hapus_Click(){
		alert("hapus");
	}
	function dlgBayar_Close(){
		$("#dlgBayar").dialog("close");
	}
	function dlgBayar_Save(){

		if(!sudah_hitung){alert("Belum tekan tombol hitung !!!");return false}

		load_recalc();			
	
		var invoice_number=$("#invoice_number").val();
		var tgl=$("#date_paid").val();
		var amount_paid=$("#amount_paid").val().replace(",","");
		var tagihan_saldo=$("#tagihan_saldo").val().replace(",","");
		var amount_paid=$("#amount_paid").val().replace(",","");
		var sisa=parseFloat(amount_paid)-parseFloat(tagihan_saldo);
		
		if(invoice_number==""){alert("Isi kode faktur ");return false};
		if(parseFloat(amount_paid)<=0){alert("Isi jumlah bayar !");return false};
		if(sisa>2){
				alert("Jumlah pembayaran tidak boleh lebih dari tagihan !");
				return false;
		}
		url='<?=base_url()?>index.php/leasing/loan/add_payment/'+invoice_number;
		$('#frmBayar').form('submit',{
			url: url, param: "", 
			onSubmit: function(){	
				 $("#divBtnSave").html("<img src='<?=base_url()?>images/loading_little.gif'> Wait.");
				return $(this).form('validate'); 
				
				},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					cmdSearch_Click();
					log_msg('Data sudah tersimpan.');
					dlgBayar_Close();
					if($("#check_print").attr('checked')){
						var url="<?=base_url()?>index.php/leasing/payment/kwitansi_by_id/"+result.id;
						window.open(url,"Kwitansi_"+result.id);
					}
					window.location.reload();					
				} else {
					log_err(result.msg);
				}
			}
		});			
	}
	function cmdSearchBilling_Click() {
		$("#lstResult").fadeOut();
		if($("#txtSearch").val()==""){alert("Isi nomor atau nama debitur !");return false};
		var xurl='<?=base_url()?>index.php/leasing/loan/list_all/'+$('#txtSearch').val();
		$('#divResultBilling').fadeIn();
		$('#divRbItems').datagrid({url:xurl});
		$('#divRbItems').datagrid('reload');		
	}
	function  divRbToolView_Click() {
		var row = $('#divRbItems').datagrid('getSelected');
		if (row){
			var url="<?=base_url()?>index.php/leasing/invoice_header/view/"+row.invoice_number;
			add_tab_parent("ViewInvoice_"+row.invoice_number,url);
		}
	}
	function import_csv(){
		var url='<?=base_url()?>index.php/leasing/payment/import_csv';
		add_tab_parent('import_csv',url);
	}
	function import_csv_bca(){
		var url='<?=base_url()?>index.php/leasing/payment/import_csv_bca';
		add_tab_parent('import_csv_bca',url);
	}
	function load_recalc() {
		sudah_hitung=true
		var invoice_number=$("#invoice_number").val();
		var amount_paid=$("#amount_paid").val();
		$.ajax({
				type: "GET",
				url: "<?=base_url()?>index.php/leasing/invoice_header/get_payment_json/"+invoice_number,
				success: function(msg){
					var result = eval('('+msg+')');
					if (result.success){
						var data=result.data;
						var saldo_titip=data.saldo_titip;
						var tagihan=data.amount;
						var denda=0,bunga=0,pokok=0;
						denda=data.denda_tagih;
						if(parseFloat(amount_paid)>=parseFloat(denda)){
							amount_paid=parseFloat(amount_paid)-parseFloat(denda);
						} else {
							denda=amount_paid;
							amount_paid=0;
						}
						bunga=data.bunga;
						if(parseFloat(amount_paid)>=parseFloat(bunga)){
							amount_paid=parseFloat(amount_paid)-parseFloat(bunga);
						} else {
							bunga=amount_paid;
							amount_paid=0;
						}
						pokok=data.pokok;
						if(parseFloat(amount_paid)>=parseFloat(pokok)){
							amount_paid=parseFloat(amount_paid)-parseFloat(pokok);
						} else {
							pokok=amount_paid;
							amount_paid=0;
						}
						if(pokok<0) pokok=0;
						$("#denda").val(number_format(denda,2,'.',','));	
						$("#bunga").val(number_format(bunga,2,'.',','));
						$("#pokok").val(number_format(pokok,2,'.',','));
						$("#saldo_titip").val(number_format(saldo_titip,2,'.'));
						$("#tagihan").val(number_format(tagihan,2,'.',','));
						tagihan_saldo=parseFloat(tagihan)-parseFloat(saldo_titip);
						$("#tagihan_saldo").val(number_format(tagihan_saldo,2,'.',','));
					}
				},
				error: function(msg){alert(msg);}
		}); 		
		
	}
	function dlgBayar_Recalc(){
		//ambil dari database saja
		var invoice_number=$("#invoice_number").val();
		var amount_paid=$("#amount_paid").val();
		if(parseFloat(amount_paid)==0){alert("Isi jumlah bayar !");return false;}
		load_recalc();
	}
	 
	
</script>