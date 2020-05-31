<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'simpan()','save');		
    echo link_button('Delete', 'on_delete()','save');        
    echo link_button('Refresh', 'on_refresh()','reload');        
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'shipping_locations\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('shipping_locations')">Help</div>
		<div onclick="show_syslog('shipping_locations','<?=$location_number?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button("Close","remove_tab_parent()","cancel")?>
	</div>
</div>
<div class="thumbnail">	
	<div class="easyui-tabs" >
		<div title="Gudang" style="padding:10px">
	   <?php echo validation_errors(); ?>
	   <?php 
			if($mode=='view'){
				echo form_open('shipping_locations/update','id=myform');
				$disabled='disable';
			} else {
				$disabled='';
				echo form_open('shipping_locations/add','id=myform'); 
			}
			
	   ?>
	 
	   <table class="table" width="100%">
		<tr>
			<td>Gudang</td><td>
			<?php
			if($mode=='view'){
				echo form_input('location_number',$location_number,"id=location_number readonly");
			} else { 
				echo form_input('location_number',$location_number,"id=location_number");
			}		
			?></td>
			<td>Company Code</td>
			<td>
                <?php 
                echo form_input('company_name',$company_name,"id='company_name'");
                echo link_button('','dlgpreferences_show()',"search","false");
                echo $lookup_company_name;
                ?>
			</td>
		</tr>	 
		   <tr>
				<td>Jenis Gudang</td><td>
				    <?php 
				        echo form_input('address_type',$address_type,"id='address_type'");
                        echo link_button('','dlgaddress_type_show()',"search","false");
                        echo link_button('','dlgaddress_type_list()',"add","false");
                        echo $lookup_jenis_gudang;
				    ?>
				    
				    
				</td>
				<td>Parent Location</td>
                <td><?php 
                        echo form_input('parent_loc',$parent_loc,"id='parent_loc'");
                        echo link_button('','dlgshipping_locations_show()',"search","false");
                                
                ?></td>
		   </tr>
		   <tr>
				<td>Alamat</td><td colspan=3><?php echo form_input('street',$street,"style='width:400px'");?></td>
		   </tr>
		   <tr>
				<td>Kota</td><td><?php echo form_input('city',$city);?></td>
                <td><?=form_checkbox("default_gudang",1,
                	$default_gudang!=""?true:false," id='default_gudang' style='width:30px'")?>
                	Default Gudang
                </td>
		   </tr>
		   <tr>
				<td>Kontak Person</td><td><?php echo form_input('attention_name',$attention_name);?></td>
                <td></td>
                <td></td>
		   </tr>
		   <tr>
				<td>Nomor Urut</td><td><?php echo form_input('no_urut',$no_urut);?></td>
                <td></td>
                <td></td>
		   </tr>
		 
	   </table>
	   </div>
   		<div title="Stock" style="padding:10px">
			<table id="dgCard" class="easyui-datagrid" fitWidth='true'
				data-options="
					iconCls: 'icon-edit', fitColumns: true, 
					singleSelect: true,  url: '',toolbar:'#tbCard',
				">
				<thead>
					<tr>
						<th data-options="field:'item_number',width:80">Kode Barang</th>
						<th data-options="field:'description',width:180">Nama Barang</th>
						<th data-options="field:'qty_saldo',width:80,align:'right'">Qty</th>
						<th data-options="field:'unit',width:80">Unit</th>
						<th data-options="field:'amount_saldo',width:80,align:'right'">Amount</th>
						<th data-options="field:'category',width:180">Category</th>
						<th data-options="field:'supplier_number',width:180">Supplier</th>
						<th data-options="field:'supplier_name',width:180">Supplier Name</th>
					</tr>
				</thead>
			</table>
		
		</div>

	</div>
	
 </div>
<div id='tbCard'>
	<table class='box-gradient'>
	<tr>
	<td>Date To &nbsp &nbsp</td>
	<td><?=form_input('date_to',date("Y-m-d"),'id=date_to  class="easyui-datetimebox" ');?></td>
	<td><?=link_button('Search','search_cards()','search');?></td>
	</tr>
	</table>
</div>
<?php 
echo $lookup_gudang;

?>

 <script language="JavaScript">
 	function simpan(){
 		if($("#location_number")==""){
 		    log_err("Isi kode gudang !");
 		     return false;
 		 }
        $('#myform').form('submit',{
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    remove_tab_parent();
                    log_msg('Data sudah tersimpan.');
                } else {
                    log_err(result.msg);
                }
            }
        }); 
        
         		
 	}
	function search_cards()
	{
		var d2=$("#date_to").datebox('getValue');
		var gdg=$("#location_number").val();
		var xurl='<?=base_url()?>index.php/inventory/kartu_stock_gudang/'+gdg+'?d2='+d2;
		$('#dgCard').datagrid({url:xurl});
		$('#dgCard').datagrid('reload');
	}
    function on_delete(){
        var id=$("#location_number").val();

        $.messager.confirm('Confirm','Are you sure you want to remove ?',function(r){
            if(!r)return false;
        
            $.ajax({
                url: CI_ROOT+"shipping_locations/delete/"+id,
                success: function(result){
                    log_msg("Success");
                    remove_tab_parent();
                },
                error:function(result){
                    log_msg("Error !");
                }
            })
        })
    }
    function on_refresh(){
        var id=$("#location_number").val();
        window.open(CI_ROOT+"shipping_locations/view/"+id,"_self");
    }
	
 </script>
 