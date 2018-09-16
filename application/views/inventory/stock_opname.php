<div class="thumbnail box-gradient" >  
	<?php
	echo link_button('Add','','add','false',base_url().'index.php/stock_opname/add');		
    echo link_button('Save','simpan();return false;','save');     
	echo link_button("Print","print_bukti()","print");
	echo link_button('Search','','search','false',base_url().'index.php/stock_opname');		
	
	?>	
	<div style='float:right'>
	<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',
		iconCls:'icon-tip',plain:false">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('stock_opname')">Help</div>
		<div onclick="show_syslog('stock_opname','<?=$transfer_id?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button('Help', 'load_help(\'stock_opname\')','help');?>		
    <?=link_button('Close','remove_tab_parent()','cancel');?>
	</div>
</div>
<div class="thumbnail">	
<form id="frmItem" method='post'>
   <table width="100%" class="table2">
	<tr>
		<td>Doc Number</td><td><?=form_input('transfer_id',$transfer_id,'id=transfer_id');?></td>
        <td>Create By</td><td><?=form_input("trans_by",$trans_by,"id='trans_by'")?></td>
	</tr>
       <tr>
		<td>Tanggal</td><td><?php  
                echo form_input('date_trans',$date_trans
				,"id='date_trans' class='easyui-datetimebox' required 
				data-options='formatter:format_date,parser:parse_date'");
                
        ?></td>
        <td>Verify By</td><td><?=form_input("verify_by",$verify_by,"id='verify_by'")?></td>
       </tr>
	<tr>
		<td>Gudang</td><td><?php 
            echo form_input('from_location',$from_location,'id=from_location');
            echo link_button('','dlgwarehouse_show()',"search","false");  
                
                ?></td>
        <td>Verify Date</td><td><?=form_input('verify_date',$verify_date,"id='verify_date' 
                    class='easyui-datetimebox' 
                    data-options='formatter:format_date,parser:parse_date'");?>
                    </td>
	</tr>
    <tr>
		<td>Catatan</td>
		<td><?php 
                	echo form_input('comments',$comments,'style="width:400px"');
        ?></td>
        <td>Doc Status</td><td><?=form_input("status",$status,"id='status'")?></td>
     </tr>
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
				<th data-options="field:'quantity_received',width:50,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty</th>
				<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
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
?>


<script type="text/javascript">
 	var grid_output="dg";
	var url_save_item = '<?=base_url()?>index.php/stock_opname/save_item';
	var url_load_item = url_detail();
	var url_del_item  = '<?=base_url()?>index.php/stock_opname/del_item';
	
    function simpan(){
        if($('#transfer_id').val()==''){alert('Isi dulu nomor bukti !');return false;}
        if($('#from_location').val()==''){alert('Pilih kode gudang !');return false;}
        var _url='<?=base_url()?>index.php/stock_opname/update';
        
        $('#frmItem').form('submit',{
            param: {item_number:'aaaa'}, 
            url: _url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    log_msg("Data sudah tersimpan.");
                } else {
                    log_err(result.msg);
                }
            }
        });


        
    }

    function url_detail(){
	 	var nomor=$('#transfer_id').val();
    	return ('<?=base_url()?>index.php/stock_opname/items/'+nomor);
    }
	function print_bukti(){
		nomor=$("#transfer_id").val();
		url="<?=base_url()?>index.php/stock_opname/print_bukti/"+nomor;
		window.open(url,'_blank');
	}

	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/stock_opname");
	}
</script>