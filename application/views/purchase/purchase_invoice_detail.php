<div id="divList" style="margin:10px">
    <table>
    <tr><td style='width:100px'>Nomor Faktur: </td><td class="field"><?=$purchase_order_number?></td></tr>
    <tr><td>Tanggal: </td><td class="field"><?=$po_date?></td></tr>
    <tr><td>Supplier: </td><td class="field"><?=$supplier_number?> - <?=$supplier_info?></td></tr>
    <tr><td>Termin: </td><td class="field"><?=$terms?></td></tr>
    <tr><td>Keterangan: </td><td class="field"><?=$comments?></td></tr>
    <tr><td colspan='4'>
    	<div class="easyui-tabs" style="width:700px;height:450px">
    	<div title='General' padding='5px'>
			<div>
			    <a onclick="addnew_item()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" >Append</a>
			    <a onclick="remove_item()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" >Remove</a>
			    <a onclick="refresh_item()"href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" >Refresh</a>
			</div>
	    	<div id='divDgItem'>*klik refresh diatas apabila tidak tampil.</div>
    	</div>
    	<div title='Payments' padding='5px'>
			<div>
			    <a onclick="addnew_pay()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" >Append</a>
			    <a onclick="remove_pay()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" >Remove</a>
			    <a onclick="refresh_pay();return false;" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" >Refresh</a>
			</div>
	    	<div id='divDgPay'></div>
    		
    	</div>
    	<div title='Retur' padding='5px'>
			<div>
			    <a onclick="addnew_retur()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" >Append</a>
			    <a onclick="remove_retur()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" >Remove</a>
			    <a onclick="refresh_retur()"href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" >Refresh</a>
			</div>
	    	<div id='divDgRetur'></div>
    		
    	</div>
    	<div title='Credit Memo' padding='5px'>
			<div>
			    <a onclick="addnew_crdb()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" >Append</a>
			    <a onclick="remove_crdb()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" >Remove</a>
			    <a onclick="refresh_crdb()"href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" >Refresh</a>
			</div>
	    	<div id='divDgCrDb'></div>
    		
    	</div>
    	<div title='Jurnal' padding='5px'>
			<div>
			    <a onclick="addnew_jurnal()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" >Append</a>
			    <a onclick="remove_jurnal()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" >Remove</a>
			    <a onclick="refresh_jurnal()"href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" >Refresh</a>
			</div>
	    	<div id='divDgJurnal'></div>
    		
    	</div>
    	</div>	
	</td></tr>
</table>
    
<div id="dlgItem" style='margin:2px;z-index:1001'><div id='divItem'></div></div>
<div id="dlgPay" style='margin:2px;z-index:1001'><div id='divPay'></div></div>
<div id="dlgRetur" style='margin:2px;z-index:1001'><div id='divRetur'></div></div>
<div id="dlgCrDb" style='margin:2px;z-index:1001'><div id='divCrDb'></div></div>
<div id="dlgJurnal" style='margin:2px;z-index:1001'><div id='divJurnal'></div></div>

<script type="text/javascript">
    $(document).ready(function(){
	   void refresh_item();
       void refresh_pay();
       void refresh_retur();
       void refresh_crdb();
       void refresh_jurnal();
    });

//--- ITEMS ----//
 
    function addnew_item(){
        param='purchase_order_number=<?=$purchase_order_number?>
        &po_date=<?=$po_date?>&terms=<?=$terms?>
        &supplier_number=<?=$supplier_number?>&comments=<?=$comments?>';
        console.log(param);
        xurl='<?=base_url()?>index.php/purchase_invoice/add_item';
        $.ajax({
	        type: "GET", url: xurl, data: param,
	        success: function(msg){
	            $('#divItem').html(msg);
	            $('#dlgItem').dialog({  
	               title: 'Pilih Nama Barang',width: 400,height: 400,  closed: false, cache: false, modal: true,
	                buttons: [{text:'Ok', iconCls:'icon-ok',handler:function(){
	                           		void save_item();$('#dlgItem').dialog('close');
	                           		void refresh_item();
	                           		}},
	                          {text:'Cancel',iconCls:'icon-cancel',handler:function(){
	                                $('#dlgItem').dialog('close');}
	                         }]
	            });
	        },error: function(msg){alert(msg);}
        }); 
   }
   function remove_item(){
        row = $('#dgItem').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'purchase_invoice/delete_item/'+row['line_number'];                             
            xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	void refresh_item();
                },
                error: function(msg){$.messager.alert('Info',msg);
           }
        });         
	 }
  }
	 function refresh_item(){
	     param="";$('#divDgItem').html('');
		 get_this('<?=base_url()?>index.php/purchase_invoice/view_detail/<?=$purchase_order_number?>'
		 ,param,'divDgItem');
	     return false;
	 }   
	  function save_item(){
	    var url="<?=base_url()?>index.php/purchase_invoice/save_item";
		var param=$('#frmItem').serialize();
		return post_this(url,param,'message');
	  }
//--- PAYMENTS ----//
    function addnew_pay(){
        param='purchase_order_number=<?=$purchase_order_number?>';
        xurl='<?=base_url()?>index.php/payables_payments/add';
        $.ajax({
	        type: "GET", url: xurl, data: param,
	        success: function(msg){
	            $('#divPay').html(msg);
	            $('#dlgPay').dialog({  
	               title: 'Proses Pembayaran',width: 400,height: 400,  closed: false, cache: false, modal: true,
	                buttons: [{text:'Ok', iconCls:'icon-ok',handler:function(){
	                           		void save_pay();$('#dlgPay').dialog('close');
	                           		void refresh_pay();
	                           		}},
	                          {text:'Cancel',iconCls:'icon-cancel',handler:function(){
	                                $('#dlgPay').dialog('close');}
	                         }]
	            });
	        },error: function(msg){alert(msg);}
        }); 
   }
   function remove_pay(){
        row = $('#dgPay').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'payables_payments/delete_no_bukti/'+row['no_bukti'];                             
            console.log(xurl);xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	void refresh_pay();
                },
                error: function(msg){$.messager.alert('Info',msg);
           }
        });         
	 }
  }
	 function refresh_pay(){
	     param="";$('#divDgPay').html('');
		 get_this('<?=base_url()?>index.php/purchase_invoice/list_payment/<?=$purchase_order_number?>'
		 ,param,'divDgPay');
		  
	     return false;
	 }   
	  function save_pay(){
	    var url="<?=base_url()?>index.php/payables_payments/save";
		var param=$('#frmAddPay').serialize();
		console.log(param);
		return post_this(url,param,'message');
	  }	  
//--- RETUR ----//
    function addnew_retur(){
        xurl='<?=base_url()?>index.php/purchase_retur/add/<?=$purchase_order_number?>';
        window.open(xurl,'_self');
   }
   function remove_retur(){
        row = $('#dgItem').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'purchase_invoice/delete_retur/'+row['nomor_bukti'];                             
            console.log(xurl);xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	void refresh_retur();
                },
                error: function(msg){$.messager.alert('Info',msg);
           }
        });         
	 }
  }
	 function refresh_retur(){
	     param="";$('#divDgRetur').html('');
		 get_this('<?=base_url()?>index.php/purchase_invoice/list_retur/<?=$purchase_order_number?>'
		 ,param,'divDgRetur');
	     return false;
	 }   
	  function save_retur(){
	    var url="<?=base_url()?>index.php/purchase_invoice/save_retur";
		var param=$('#frmRetur').serialize();
		return post_this(url,param,'message');
	  }	  
//--- CREDIT DEBIT MEMO ----//
    function addnew_crdb(){
        param='';
        xurl='<?=base_url()?>index.php/purchase_invoice/add_crdb/<?=$purchase_order_number?>';
        $.ajax({
	        type: "GET", url: xurl, data: param,
	        success: function(msg){
	            $('#divCrDb').html(msg);
	            $('#dlgCrDb').dialog({  
	               title: 'Proses Debit / Credit Memo',width: 400,height: 400,  closed: false, cache: false, modal: true,
	                buttons: [{text:'Ok', iconCls:'icon-ok',handler:function(){
	                           		void save_crdb();$('#dlgCrDb').dialog('close');
	                           		void refresh_crdb();
	                           		}},
	                          {text:'Cancel',iconCls:'icon-cancel',handler:function(){
	                                $('#dlgCrDb').dialog('close');}
	                         }]
	            });
	        },error: function(msg){alert(msg);}
        }); 
   }
   function remove_crdb(){
        row = $('#dgCrDb').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'purchase_invoice/delete_crdb/'+row['nomor_bukti'];                             
            console.log(xurl);xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	void refresh_crdb();
                },
                error: function(msg){$.messager.alert('Info',msg);
           }
        });         
	 }
  }
	 function refresh_crdb(){
	     param="";$('#divDgCrDb').html('');
		 get_this('<?=base_url()?>index.php/purchase_invoice/list_crdb/<?=$purchase_order_number?>'
		 ,param,'divDgCrDb');
	     return false;
	 }   
	  function save_crdb(){
	    var url="<?=base_url()?>index.php/purchase_invoice/save_crdb";
		var param=$('#frmCrDb').serialize();
		return post_this(url,param,'message');
	  }
//--- CREDIT JURNAL ----//
    function addnew_jurnal(){
        param='';
        xurl='<?=base_url()?>index.php/purchase_invoice/add_jurnal/<?=$purchase_order_number?>';
        $.ajax({
	        type: "GET", url: xurl, data: param,
	        success: function(msg){
	            $('#divJurnal').html(msg);
	            $('#dlgJurnal').dialog({  
	               title: 'Jurnal Penjualan',width: 400,height: 400,  closed: false, cache: false, modal: true,
	                buttons: [{text:'Ok', iconCls:'icon-ok',handler:function(){
	                           		void save_jurnal();$('#dlgJurnal').dialog('close');
	                           		void refresh_jurnal();
	                           		}},
	                          {text:'Cancel',iconCls:'icon-cancel',handler:function(){
	                                $('#dlgJurnal').dialog('close');}
	                         }]
	            });
	        },error: function(msg){alert(msg);}
        }); 
   }
   function remove_jurnal(){
        row = $('#dgJurnal').datagrid('getSelected');
        if (row){
            xurl=CI_ROOT+'purchase_invoice/delete_Jurnal/'+row['gl_id'];                             
            console.log(xurl);xparam='';
            $.ajax({
                type: "GET",url: xurl,param: xparam,
                success: function(msg){
                	void refresh_jurnal();
                },
                error: function(msg){$.messager.alert('Info',msg);
           }
        });         
	 }
  }
	 function refresh_jurnal(){
	     param="";$('#divDgJurnal').html('');
		 get_this('<?=base_url()?>index.php/purchase_invoice/list_jurnal/<?=$purchase_order_number?>'
		 ,param,'divDgJurnal');
	     return false;
	 }   
	  function save_jurnal(){
	    var url="<?=base_url()?>index.php/purchase_invoice/save_jurnal";
		var param=$('#frmJurnal').serialize();
		return post_this(url,param,'message');
	  }	  	  	  
</script>
    