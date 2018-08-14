<div class="thumbnail box-gradient" >  
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Add','','add','false',base_url().'index.php/stock_adjust/add');		
	echo link_button("Print","print_adjust()","print");
	echo link_button('Search','','search','false',base_url().'index.php/stock_adjust');		
    echo link_button('Pilih Nomor Opname','pilih_stock_opname();return false','search');     
	
	?>	
	<div style='float:right'>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',
		iconCls:'icon-tip',plain:false">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('stock_adjust')">Help</div>
		<div onclick="show_syslog('stock_adjust','<?=$transfer_id?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Help', 'load_help(\'stock_adjust\')','help');?>		
    <?=link_button('Close','remove_tab_parent()','cancel');?>
	</div>
</div>
<div class="thumbnail">	
<form id="frmItem" method='post' >
   <table width="100%" class="table2">
	<tr>
		<td>Nomor</td><td><?php 
                echo form_input('transfer_id',$transfer_id,'id=transfer_id');
        ?></td>
        <td>Doc Status</td><td><?=form_input("status",$status,"id='status'")?></td>
        
	</tr>
       <tr>
		<td>Tanggal</td><td><?php  
                echo form_input('date_trans',$date_trans
				,"id='date_received' class='easyui-datetimebox' required 
				data-options='formatter:format_date,parser:parse_date'");
                
        ?></td>
        
        <td>Create By</td><td><?=form_input("receipt_by",$trans_by,"id='trans_by'")?></td>
        
       </tr>
	<tr>
		<td>Gudang</td><td><?php 
            echo form_input('from_location',$from_location,'id=from_location');
            echo link_button('','dlgwarehouse_show()',"search","false");  
                                    
                ?></td>
	</tr>
    <tr>
		<td>Catatan</td>
		<td><?php 
                	echo form_input('comments',$comments,'style="width:400px"');
        ?></td>
     </tr>
	 <tr><td>&nbsp</td><td>&nbsp</td></tr>
   </table>
<!-- LINEITEMS -->	
<div id='dgItem'><?=load_view('inventory/select_item_no_price.php')?></div>
<div id='divItem' style='display:<?=$mode=="add"?"":""?>'>
	<table id="dg" class="easyui-datagrid"  width="100%"
		data-options="
			iconCls: 'icon-edit',fitColumns:true,
			singleSelect: true,
			toolbar: '#tb',
			url: url_load_item
		">
		<thead>
			<tr>
				<th data-options="field:'item_number',width:80">Kode Barang</th>
				<th data-options="field:'description',width:150">Nama Barang</th>
				<th data-options="field:'from_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty Fisik</th>
                <th data-options="field:'to_qty',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty Adj</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
                <th data-options="field:'from_location',width:50,align:'left',editor:'text'">Gudang</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
</div>	
<!-- LINEITEMS -->

</form>


</div>

<?php 
    echo load_view('inventory/inventory_select'); 
    echo $lookup_gudang;
    echo $lookup_stock_opname;
    
?>
 <script language='javascript'>
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/stock_adjust/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/stock_adjust/del_item';

    function url_detail(){
	 	var nomor=$('#transfer_id').val();
    	$('#ref_number').val(nomor);
    	return ('<?=base_url()?>index.php/stock_adjust/items/'+nomor+'/json');
    }
    function before_submit_stock_opname(){
        console.log("before_submit");
        gudang=$("#from_location").val();
        $("#outlet").val(gudang);
    }
	function print_adjust(){
		nomor=$("#transfer_id").val();
		url="<?=base_url()?>index.php/stock_adjust/print_adjust/"+nomor;
		window.open(url,'_blank');
	}
    function selected_doc(){        
        var nomor=$('#transfer_id').val();
        var _url='<?=base_url()?>index.php/stock_adjust/items/'+nomor;
        $("#dg").datagrid({url:_url});
    }

		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/stock_adjust");
		}
    function pilih_stock_opname(){
        dlgstock_opname_show();
    }
	</script>