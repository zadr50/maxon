<div id='dgItemForm' class="easyui-dialog" 
    style="width:500px;height:400px;padding:5px 5px;top:10px;"
    closed="true" buttons="#tbItemForm" >
    	    
    <form id="frmItem" method='post' >
            <table class='table2' style='width:100%'>
             <tr><td >Kode Barang</td><td colspan='3'><input onblur='find()' id="item_number" style='width:180px' 
                name="item_number"   class="easyui-validatebox" required="true">
                <a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
                onclick="searchItem();return false;"></a>
             </td>
             
             </tr>
             <tr><td>Nama Barang</td><td colspan='3'><input id="description" name="description" style='width:300px'></td></tr>
             <tr><td>Qty</td><td><input id="quantity"  style='width:60px'  name="quantity" 
             	onblur="calc_qty_unit();hitung();">
	             Unit <input id="unit" name="unit"  style='width:60px' >
		            <a href="#" class="easyui-linkbutton" iconCls="icon-search" data-options="plain:false" 
		                onclick="searchUnit();return false;" 
		                style='display:none' id='cmdLovUnit'></a> 
             </td>
             </tr>
            <tr><td>Harga</td><td><?=form_input("cost","","id='cost' onchange='hitung();' ")?></td></tr>
            <tr><td>Amount</td><td><?=form_input("total_amount","","id='total_amount'")?></td></tr>
			<tr>
				<td colspan=3>
				<span id='divMultiUnit' style='display:none'>
					M_Qty <?=form_input("mu_qty","","id='mu_qty' style='width:60px'")?>
					M_Unit <?=form_input("multi_unit","","id='multi_unit' style='width:60px' ")?>
					M_Price <?=form_input("mu_harga","","id='mu_harga'")?>
				</span>
				</td>
			</tr>
            <tr><td>Akun Hpp</td><td><?=form_input("cost_account","","id='cost_account' style='width:250px' ")?>
            	<?=link_button("","coa_hpp();return false","search")?>
            </td></tr>
             
             <tr><td>Id</td><td><input id="id"  style='width:60px'  name="id"></tr>
            </table>
    </form>
</div>
<div id="tbItemForm">
    <a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
        onclick='close_item();return false;' title='Close'>Cancel</a>
    <a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
        onclick='save_item();return false;' title='Save Item'>Submit</a>
</div>

<script language="JavaScript">
	var qty_conv=0;
	
	function calc_qty_unit(){
		if(qty_conv=="")qty_conv=1;
		if(qty_conv=="0")qty_conv=1;
		qty=$("#quantity").val();
		qty=qty*qty_conv;
		$("#mu_qty").val(qty);
	}
	function hitung(){
		if($('#quantity').val()==0)$('#quantity').val(1);
		if($("#cost").val()=="")$("#cost").val(1);		
		
		calc_qty_unit();
		
		gross=$('#quantity').val()*$('#cost').val();
		$('#total_amount').val(gross);			
		
		
	}
	function coa_hpp(){
		lookup1({id:"coa_hpp", 
			url:CI_ROOT+"lookup/query/chart_of_accounts",
			fields: [[
		        {field:'account',title:'Account',width:80},
		        {field:'account_description',title:'Account Description',width:300},
		        {field:'id',title:'Id',width:40,align:'right'}
    		]],
    		result: function result(){
    			$("#cost_account").val(r.data.account+' - '+r.data.account_description);
    		}
		});
	}
		
</script>
