<!-- PILIH FAKTUR --> 
<div id='dlgSelectFaktur'class="easyui-dialog" style="width:600px;height:380px;
padding:10px 20px;left:100px;top:20px"
     closed="true" toolbar="#toolbar-search-faktur">
     <div id='divSelectFaktur'> 
		<table id="dgSelectFaktur" class="easyui-datagrid"  width='100%'
			data-options="
				toolbar: '', fitColumns: true, 
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'invoice_number',width:80">Faktur</th>
					<th data-options="field:'invoice_date',width:80">Tanggal</th>
					<th data-options="field:'payment_terms',width:180">Termin</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="toolbar-search-faktur" class='box-gradient'>
	Enter Text: <input  id="search_supp" style='width:180' name="search_supp">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="select_faktur();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selected_faktur();return false;">Select</a>
</div>
<SCRIPT language="javascript">
	function select_faktur(){
		var cust=$("#customer_number").val();
		if(cust==""){alert("Pilih kode pelanggan dulu !");return false;}
			$('#dlgSelectFaktur').dialog('open').dialog('setTitle','Cari nomor faktur');
			$('#dgSelectFaktur').datagrid({url:'<?=base_url()?>index.php/invoice/select/'+cust});
			$('#dgSelectaktur').datagrid('reload');
	};	
	function selected_faktur(){
		var row = $('#dgSelectFaktur').datagrid('getSelected');
		if (row){
			$('#docnumber').val(row.invoice_number);
			//$('#company').val(row.company);
			find_faktur();
			$('#dlgSelectFaktur').dialog('close');
		} else {
			alert("Pilih salah satu nomor faktur !");
		}
	}	
	function find_faktur(){
		var nomor=$('#docnumber').val();
		if(nomor=="")return false;
		xurl=CI_ROOT+'invoice/find/'+nomor;
		$.ajax({
					type: "GET",
					url: xurl,
					data:'invoice_number='+nomor,
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#faktur_info').html('Tanggal: '+obj.invoice_date+', Jumlah: '+obj.amount+', Saldo: '+obj.saldo);
					},
					error: function(msg){alert(msg);}
		});
	};
	
</SCRIPT>
<!-- END PILIH PELANGGAN -->

