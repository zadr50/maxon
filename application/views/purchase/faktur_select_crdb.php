<!-- PILIH FAKTUR --> 
<div id='dlgSelectFaktur'class="easyui-dialog" style="width:700px;height:380px;
padding:10px 20px;left:10px;top:20px"
     closed="true" buttons="#toolbar-search-faktur">
     <div id='divSelectFaktur'> 
		<table id="dgSelectFaktur" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '',fitColumns: true, 
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'purchase_order_number',width:80">Faktur</th>
					<th data-options="field:'po_date',width:80">Tanggal</th>
					<th data-options="field:'terms',width:80">Termin</th>
					<th data-options="field:'nomor_recv',width:180">Nomor Recv#</th>
					<th data-options="field:'nomor_po',width:180">Nomor PO#</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<div id="toolbar-search-faktur" class="box-gradient">
	Enter Text: <input  id="search_supp" style='width:180' name="search_supp"  onchange="select_faktur();return false;">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search"  onclick="select_faktur();return false;">Filter</a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selected_faktur();return false;">Select</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-cancel"  onclick="dlgSelectFaktur_Close();return false;">Close</a>
</div>
<SCRIPT language="javascript">

    $().ready(function (){
        $('#dgSelectFaktur').datagrid({
            onDblClickRow:function(){
                var row = $('#dgSelectFaktur').datagrid('getSelected');
                if (row){
                   selected_faktur();
                }       
            }
        });        
    });



	function dlgSelectFaktur_Close(){
		$("#dlgSelectFaktur").dialog("close");
	}
	function select_faktur(){
		var supp=$("#supplier_number").val();
		if(supp==""){alert("Pilih supplier dulu.");return false;}
		var xurl='<?=base_url()?>index.php/purchase_invoice/select/'+supp;
		console.log(xurl);
		$('#dlgSelectFaktur').dialog('open').dialog('setTitle','Cari nomor faktur');
		$('#dgSelectFaktur').datagrid({url:xurl});
		$('#dgSelectaktur').datagrid('reload');
	};	
	function selected_faktur(){
		var row = $('#dgSelectFaktur').datagrid('getSelected');
		if (row){
			$('#docnumber').val(row.purchase_order_number);
			$('#dlgSelectFaktur').dialog('close');
			find_faktur();
		} else {
			alert("Pilih salah satu nomor faktur !");
		}
	}	
	function find_faktur(){
		var nomor=$('#docnumber').val();
		if(nomor=="")return false;
		xurl=CI_ROOT+'purchase_invoice/find/'+nomor;
		loading();
		$.ajax({
					type: "GET",
					url: xurl,
					data:'invoice_number='+nomor,
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#faktur_info').html('Tanggal: '+obj.po_date+', Jumlah: '+obj.amount+', Saldo: '+obj.saldo);
						saldo_faktur=c_(obj.saldo);
						loading_close();
					},
					error: function(msg){alert(msg);}
		});
	};

</SCRIPT>
<!-- END PILIH PELANGGAN -->

