<div id='dlgSelectDo'class="easyui-dialog" style="width:600px;height:380px;
padding:10px 20px;left:100px;top:20px"
     closed="true" toolbar="#toolbar-search-do">
	<table id="dgSelectDo" class="easyui-datagrid"  width='100%'
		data-options="
			toolbar: '', fitColumns: true,
			singleSelect: true,
			url: ''
		">
		<thead>
			<tr>
				<th data-options="field:'invoice_number',width:80">DO Number</th>
				<th data-options="field:'invoice_date',width:80">Tanggal</th>
				<th data-options="field:'salesman',width:80">Salesman</th>
				<th data-options="field:'warehouse_code',width:80">Gudang</th>
				<th data-options="field:'due_date',width:80">Due Date</th>
				<th data-options="field:'shipped_via',width:80">Via</th>
			</tr>
		</thead>
	</table>
</div>
<div id="toolbar-search-do" class='box-gradient'>
	Enter Text: <input  id="search_do" style='width:180' name="search_do">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="select_do_open()"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="selected_do_number()">Select</a>
</div>

 <script language='javascript'>
 
$().ready(function (){
    $('#dgSelectDo').datagrid({
        onDblClickRow:function(){
			selected_do_number();        	
    }
    });        
});

 
	function select_do_open() {
		var cust=$("#sold_to_customer").val();
		if(cust==""){alert("Pilih kode pelanggan dulu.!");return false;}
		var mode=$("#mode").val();
		if(mode=="add"){alert("Simpan dulu nomor ini");return false;};
		$('#dgSelectDo').datagrid({url:'<?=base_url()?>index.php/delivery_order/select_do_open/'+cust});
//		$('#dgSelectDo').datagrid('reload');			
		$('#dlgSelectDo').dialog('open').dialog('setTitle','Cari nomor surat jalan / DO');
	}
	function selected_do_number(){
		var mode=$("#mode").val();
		if(mode=="add"){alert("Simpan dulu nomor ini");return false;};
		var row = $('#dgSelectDo').datagrid('getSelected');
		if (row){
			var nomor_sj=$("#sales_order_number").val();
			if(nomor_sj==""){
				$('#sales_order_number').val(row.invoice_number);
			} else {
				$("#sales_order_number").val("MULTI DO");
			}
			$('#dlgSelectDo').dialog('close');

			load_do_items(row.invoice_number);

		} else {
			alert("Pilih salah satu nomor surat jalan !");
		}
	}
	function load_do_items(nomor) {
		var nomor_do=$("#invoice_number").val();
		if(nomor_do=="" || nomor_do=="AUTO"){
			log_err("Isi nomor surat jalan !");return false;
		}
		$.ajax({
			type : 'GET',
			url : '<?=base_url();?>index.php/delivery_order/insert_invoice/'+nomor+'/'+nomor_do,
			data: '',
			success: function (data) {                
				//console.log(data);
				log_msg("Nomor surat jalan berhasil disimpan. Tekan Simpan lagi bila diperlukan.");
			}
		});
		
		$('#dg').datagrid({url:'<?=base_url()?>index.php/invoice/items/'+nomor_do+'/json'});
				
	}
	
</script>