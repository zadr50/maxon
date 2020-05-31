<legend><?=$caption?></legend>
<div id='divMsg' class='alert alert-warning'></div>
<div class="alert alert-info">
	Silahkan pilih kriteria tanggal dibawah ini kemudian klik tombol posting atau unposting transaksi.
	<?php
	$date_from=date("Y-m-1");
	$date_to=date("Y-m-d 23:59:59");
	$jenis_list['']='';
	if($q=$this->db->query("select distinct jenis from q_all_trans")){
		foreach($q->result() as $r){
			$jenis_list[$r->jenis]=ucfirst($r->jenis);
		}
	}
	echo "<table class='table2'><tr><td><b>Dari Tanggal</b></td>
		<td><b>Sampai Tanggal</b></td>
		<td><b>UnPosted?</b></td>
		<td align=right><b>Jenis</b></td>
		</tr>";
	echo "<tr><td>".form_input('txtDateFrom',$date_from,'id="txtDateFrom" 
			 class="easyui-datetimebox" required style="width:140px"
			data-options="formatter:format_date,parser:parse_date" 
			')."</td>";
	echo "  <td>";
	echo form_input('txtDateTo',$date_to,'id="txtDateTo" 
			 class="easyui-datetimebox" required style="width:140px"
			data-options="formatter:format_date,parser:parse_date"');
	echo "</td>
		<td>".form_checkbox("txtUnposted","1",true,"id='txtUnposted' style='width:50px'")."</td>";
	echo "<td>".form_dropdown("jenis",$jenis_list,"","id='jenis' ")."</td>";		
	echo "<td>".link_button("Load Data", "load_data();return false","reload")
		.link_button("Posting", "posting();return false","save")
		.link_button("UnPosting", "unposting();return false","undo")
		.link_button("Close", "close_me();return false","cancel")		
		."</td>
	</tr></table>";

	?>
	<form id='frmMain' name='frmMain' method='POST'>
		<table id="dgMain" class="easyui-datagrid table"  data-options="
				iconCls: 'icon-save',fitColumns: true,
				singleSelect: false, toolbar: '#tbMain',
				url: ''
			">
			<thead>
				<tr>
					<th field="ck" checkbox="true"></th>
					<th data-options="field:'nomor_bukti',width:80">Faktur#</th>
					<th data-options="field:'tanggal',width:80">Tanggal</th>
					<th data-options="field:'jenis',width:180">Jenis</th>
					<th data-options="field:'posted',width:50">Posted</th>
					<?=col_number2("amount","Amount")?>
					<th data-options="field:'comments',width:150">Keterangan</th>
				</tr>
			</thead>
		</table>
		
	</form>
</div>

<script language="JavaScript">
	function load_data(){
		var d1=$("#txtDateFrom").datetimebox("getValue");
		var d2=$("#txtDateTo").datetimebox("getValue");
		var q=$("#jenis").val();
		var unposted=$("#txtUnposted:checked").val();
		if(unposted!=1)unposted=0;
		var _url=CI_ROOT+"posting/load_data?d1="+d1+"&d2="+d2+"&q="+q+"&unposted="+unposted;
		$('#dgMain').datagrid({url: _url});
		$("#divMsg").fadeOut('slow');
		$('#divMsg').html('<br>Loading...finish apabila sudah posting ke nomor terakhir yg dipilih, silahkan di load_data lagi.');
	}
	function posting(){
		xurl=CI_ROOT+'posting/posting_all2';                        
		var ids = [];
		var rows = $('#dgMain').datagrid('getSelections');
 		if(rows){
 			//console.log(rows);
 			loading();
			$("#divMsg").fadeIn('slow');
			for(var i=0; i<rows.length; i++){
	 			var _data={'row':rows[i]};
				$.ajax({
					type: "POST",	url: xurl, data: _data,
					success: function(result){
					try {
							loading_close();
							var result = eval('('+result+')');
							if(result.success){
								$("#divMsg").append(result.message);
							} else {
							    $("#divMsg").append(result.message);
							};
						} catch (exception) {		
	                            $("#divMsg").append(result.message);
						}
					},
					error: function(msg){$("#divMsg").append("Tidak bisa posting baris ini !");}
				});         
	 						    
			    
			}
 		}
 		
 	}
 	
 		
	function unposting(){
		xurl=CI_ROOT+'posting/unposting_all2';                        
		var ids = [];
		var rows = $('#dgMain').datagrid('getSelections');
 		if(rows){
 			//console.log(rows);
 			loading();
			$("#divMsg").fadeIn('slow');
			for(var i=0; i<rows.length; i++){
	 			var _data={'row':rows[i]};
				$.ajax({
					type: "POST",	url: xurl, data: _data,
					success: function(result){
					try {
							loading_close();
							var result = eval('('+result+')');
							if(result.success){
								$("#divMsg").append(result.message);
							} else {
							    $("#divMsg").append(result.message);
							};
						} catch (exception) {		
	                            $("#divMsg").append(result.message);
						}
					},
					error: function(msg){$("#divMsg").append("Tidak bisa posting baris ini !");}
				});         
	 						    
			    
			}
 		}
		
	}
	function close_me(){
		remove_tab_parent();		
	}
</script>