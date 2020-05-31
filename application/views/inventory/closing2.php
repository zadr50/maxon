<label>Arsip Quantity Stock</label>
<div class='alert alert-info'>
	<p>Silahkan isi tanggal awal dan akhir kemudian proses untuk mengarsipkan quantity stock masing-masing barang dibawah ini.</p>
</div>
<div class='thumbnail'>
	<?php 
		$date_from=date("Y-m-d");
		echo "<strong>Tanggal :</strong>";
		echo "<p>".form_input('txtDateFrom',$date_from,'id="txtDateFrom" 
				 class="easyui-datetimebox" required style="width:180px"
				data-options="formatter:format_date,parser:parse_date" 
				')."</p>";
		echo link_button("Proses", "proses();return false","print");
	
	?>
</div>
<div id='divOutput'>
	
</div>
<script language="JavaScript">
	var cnt=0;
	var cnt_index=0;
	var still_proses=false;
	var t=null;
	function proses(){
		if(still_proses){
			log_err("Tunggu masih proses !");
			return false;
		}
		var tgl1=$('#txtDateFrom').datetimebox('getValue'); 
		$.ajax({
				type: "GET",
				url: CI_ROOT+"inventory/closing_proses",
				data: {tanggal:tgl1},
				success: function(result){
					var result = eval('('+result+')');
					console.log(result);
					if(result.success){
						cnt=result.count_item;
						still_proses=true;
						$("#divOutput").append("</br>Jumlah barang yang akan diproses <b>["+cnt+"]</b></br>Please wait....");	
						t=setTimeout(function(){proses2();},300);	
					}
				},
				error: function(msg){$("#divOutput").append(msg);}
		}) 	
	}
	function proses2(){
		var tgl1=$('#txtDateFrom').datetimebox('getValue'); 
		cnt_index++;
		$.ajax({
				type: "GET",
				url: CI_ROOT+"inventory/closing_proses_run",
				data: {tanggal:tgl1,count_index:cnt_index},
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						cnt=result.count_item;
						still_proses=true;
						if(cnt==0){
							cnt_index=0;						
							still_proses=false;	
							s="</br><b>Finish..</b>";
							$("#divOutput").append(s);
							clearTimeout(t);
						} else {
							s="</br>["+cnt_index+"] - ["+result.item_number+"] "+result.description+", Qty: "+result.qty;
							$("#divOutput").append(s);	
							t=setTimeout(function(){proses2();},300);	
							
						}
					}
				},
				error: function(msg){$("#divOutput").append("</br>"+msg);}
		}) 	
		
	}
</script>