<!-- PILIH FAKTUR --> 
<div id='dlgSalesTran'class="easyui-dialog" 
style="width:700px;height:380px;padding:10px 20px;left:10px;top:20px"
     closed="true" toolbar="#dlgSalesTran-button">
<?php     
    $this->browse->load_js(false);
    $this->browse->set_fields(array("item_number","description","qty","margin","amount_jual","amount_cost","supplier_number"));
    //$this->browse->set_url(base_url("index.php/po/konsinyasi/item_sales"));
    $this->browse->_format_numeric=array("qty","margin","amount_jual","amount_cost");
    $this->browse->set_id("dlgSalesTranGrid");
    $this->browse->set_tool("dlgSalesTranGrid-button");
    echo $this->browse->refresh();

?>      
     
</div>
<div id="dlgSalesTran-button" style="height:auto">
    <?php
    $date_from=date("Y-m-1");
    $date_to=date("Y-m-d 23:59:59");
    
    echo "<strong>Tanggal :</strong>".form_input('txtDateFrom',$date_from,'id="txtDateFrom" 
                         class="easyui-datetimebox" required style="width:150px"
                        data-options="formatter:format_date,parser:parse_date"
                        ')."
          <strong> s/d </strong>".form_input('txtDateTo',$date_to,'id="txtDateTo" 
                 class="easyui-datetimebox" required style="width:150px"
                data-options="formatter:format_date,parser:parse_date"
            ')."
        ";
                
    ?> 
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="filter_sales();return false;"></a>        
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selected_sales();return false;">Proses</a>
    <?=link_button('Close','dlgSelectFaktur_Close()','cancel');?>      	
</div>
<SCRIPT language="javascript">
	function dlgSelectFaktur_Close(){
		$('#dlgSelectFaktur').dialog('close');
	}
	function dlgsales_show(){

		if($("#mode").val()=="add"){log_err("Simpan dulu nomor ini untuk meneruskan memilih nomor receive! ");return false};
		
        var supp=$('#supplier_number').val();
        if(supp==""){
            log_err("Pilih dulu supplier ! Untuk membuat daftar penjualan untuk supplier yang bersaangkutan.");
            return false;
        }
		
        //$('#dlgSalesTran').window({left:100,top:window.event.clientY-50});
		$('#dlgSalesTran').dialog('open').dialog('setTitle','Filter transaksi penjualan');
		filter_sales();
	};	
	function filter_sales(){
        var d1=$("#txtDateFrom").val();
        var d2=$("#txtDateTo").val();
        var supp=$('#supplier_number').val();
        
        var vUrl='<?=base_url()?>index.php/po/konsinyasi/item_sales/'+d1+'/'+d2+'/'+supp;
        $('#dlgSalesTranGrid').datagrid({url:vUrl});
	}
	function selected_sales(){
		var row = $('#dlgSalesTranGrid').datagrid('getSelected');
		if (row){
			var nomor=row.purchase_order_number;
			$('#purchase_order_number').val(nomor);
			$("#supplier_number").val(row.supplier_number);
			$('#dlgSelectFaktur').dialog('close');
	 		$("#divItem").fadeIn("slow");
			po_items(nomor);
		} else {
			alert("Pilih salah satu nomor purchase order !");
		}
	}	
	function po_items(nomor_po)
	{
		url=CI_ROOT+"purchase_order/items_not_received/"+nomor_po;
		$('#dgRcv').datagrid({url:url});
		//$('#dgRcv').datagrid('reload');
	}
	
</SCRIPT>
<!-- END PILIH FAKTUR -->

