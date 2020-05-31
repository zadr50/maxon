<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save()','save');		
	echo link_button('Print', 'print_item()','print');		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/manuf/product/view/'.$item_number);		
	//echo link_button('Import', 'import_excel()','year');		
	echo "<div style='float:right'>";
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('product')">Help</div>
		<div onclick="show_syslog('product','<?=$item_number?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button("Close", "remove_tab_parent()","cancel")?>
	</div>
</div>
<div class="thumbnail">	
	<form id="frmBarang"  method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
			<div title="Umum" id="box_section" style="padding:10px">
			<table class='table2' width="100%">
			<tr><td>Item Number</td><td><?=form_input("item_number",$item_number,"id='item_number'")?>
				&nbsp Aktif <?=form_radio('active',1,$active=='1'?TRUE:FALSE,"style='width:30px'").' Yes '
					.form_radio('active',0,$active=='0'?TRUE:FALSE,"style='width:30px'").' No'?>
				</td>
				
			</tr>
			<tr><td>Nama Barang</td>
			<td colspan='4'><?=form_input("description",$description,"id='description' style='width:60%'")?>
			</td>
			</tr>
			<tr><td>Category</td><td><?=form_input('category',$category,"id='category'");?>
				<?=link_button("","dlginventory_categories_show();","search");?>
			</td>
				<td rowspan=5 colspan=2>Deskripsi panjang atau fitur khusus </br>
					<?php echo form_textarea('special_features',$special_features,"style='width:200px;height:200px'");?> 
			   </td>

			</tr>
			<tr><td>Sub Category</td><td><?=form_input('sub_category',$sub_category,"id='sub_category'");?>
				<?=link_button("","dlginventory_sub_categories_show();","search");?>		
				</td>
			</tr>
			<tr><td>Satuan</td><td><?=form_input("unit_of_measure",$unit_of_measure,"id='unit_of_measure'")?></td></tr>
			<tr><td>Harga Jual</td><td><?=form_input("retail",$retail,"id='retail'")?></td>
			</tr>
			<tr><td>Cost</td><td><?=form_input("cost",$cost,"id='cost'")?></td></tr>
			<tr>
			   <td>Pakai Nomor Serial </td>
			   <td><?=form_radio('serialized',1,$serialized=='1'?TRUE:FALSE,"style='width:30px'");?>
				 Yes <?php echo form_radio('serialized',0,$serialized=='0'?TRUE:FALSE,"style='width:30px'");?>No </td>
			</tr>
			<tr>
			</tr>
			</table>
		</div>
		<div title='Accounting' style="padding:10px">
			<table width='100%' class='table2'>
			<tr><td>Akun Persediaan</td><td><?=form_input('inventory_account',$inventory_account,"id='inventory_account' style='width:200px'");?>
	         	<?=link_button('',"lookup_coa('inventory_account')",'search')?>
			</td></tr>
		    <tr>
				 <td>Akun Penjualan </td>
				 <td><?php echo form_input('sales_account',$sales_account,"id='sales_account' style='width:200px'");?>
					<?=link_button('',"lookup_coa('sales_account')",'search')?>
				 </td>
		    </tr>
		    <tr>
				 <td>Akun Harga Pokok Persediaan </td>
				 <td><?php echo form_input('cogs_account',$cogs_account,"id='cogs_account' style='width:200px'");?>
					<?=link_button('',"lookup_coa('cogs_account')",'search')?>
				</td>
		    </tr>
		    <tr>
				 <td>Akun Pajak Penjualan </td>
				 <td><?php echo form_input('tax_account',$tax_account,"id='tax_account' style='width:200px'");?>
					<?=link_button('',"lookup_coa('tax_account')",'search')?>			         	
				 </td>
		    </tr>
			</table>
		</div>
		<div title='Gambar'>
			<table width='100%' class='table2'>
			<tr>
			   <td>Gambar Barang </td>
			   <td><?php echo form_input('item_picture',$item_picture,"style='width:200px' id='item_picture'");?>
				   <?=link_button("Select...", 'upload_gambar()','man');?>	

				</td>
			</tr><td>
			   <td>
					<img id="imgBarang" src="<?=base_url()."/tmp/".$item_picture?>" style="width:200px;height:200px;border:1px solid lightgray">
			   </td>  
			</tr>
			</table>
		</div>
		<div title='Bahan Baku'>
			<div class='thumbnail box-gradient'>
				<p>Item Assembly atau Paket &nbsp &nbsp
					<?=form_radio('assembly',1,$assembly=='1'?TRUE:FALSE,"style='width:30px'");?>
						Yes <?php echo form_radio('assembly',0,$assembly=='0'?TRUE:FALSE,"style='width:30px'");?>No 
				</p>
			</div>
			<table id='dgAsm' name='dgAsm' class="easyui-datagrid"  width='95%' height="300px"
				data-options="
					iconCls: 'icon-edit', fitColumns: true,
					singleSelect: true,  
					url: '<?=base_url()?>index.php/inventory/assembly_list/<?=$item_number?>',
					toolbar:'#dgAsm_Tool'," >
				<thead>
					<tr>
						<th data-options="field:'assembly_item_number',width:80">Item Number</th>
						<th data-options="field:'description',width:180">Description</th>
						<th data-options="field:'quantity',width:80,align:'right'">Qty</th>
						<th data-options="field:'default_cost',width:80,align:'right'">Cost</th>
						<th data-options="field:'comment',width:180,align:'left'">Keterangan</th>
					</tr>
				</thead>
			</table>
		</div>
		<!-- QUANTITY -->				
		<div title="Quantity" style="padding:10px">
			<? if(isset($qty_gudang))echo $qty_gudang; ?>
		</div>
		
		</div>
	</form>
</div>	
<div id="dlgGambar" class="easyui-dialog" 
 style="width:300px;height:200px;padding:5px 5px;left:100px;top:20px" closed="true" >
	<div class="thumbnail">
	<?php 
		echo form_open_multipart(base_url()."index.php/inventory/do_upload_picture","id='frmUpload'");
	?>
		<input type="file" name="userfile" id="userfile" size="20" title="Pilih Gambar" stye="float:left" />
		<input type="button" value="Submit" onclick="do_upload()">  
		</form>
	</div>
	<div id='error_upload'></div>
</div>

<div id='dgAsm_Tool'>
	<?=link_button('Add', 'dlgAsm_Add()','add');?>
	<?=link_button('Edit', 'dlgAsm_Edit()','edit');?>
	<?=link_button('Delete', 'dlgAsm_Delete()','remove');?>
	<?=link_button('Refresh', 'dgAsm_Refresh()','reload');?>
</div>
<?php 
 	echo load_view('gl/select_coa_link');
	echo load_view("inventory/assembly");
	echo $lookup_category;
	echo $lookup_sub_category;
?>
 <script language='javascript'>
		var index = 0;
	var url;	
 
  	function save(){
  		if($('#item_number').val()==''){alert('Isi kode barang !');return false;}
  		if($('#description').val()==''){alert('Isi nama barang !');return false;}
  		if($('#unit_of_measure').val()==''){alert('Isi satuan !');return false;}
		url='<?=base_url()?>index.php/manuf/product/save';
			$('#frmBarang').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
  	}
  	function item_assembly(){
            txtNo=$("#item_number").val(); 
			if(txtNo==""){alert("Isi kode barang produksi dulu.");return false};
			add("Bill Material","<?=base_url().'index.php/inventory/assembly/'?>"+txtNo);
  	} 	
	
	function dgAsm_Refresh(){
		var url='<?=base_url()?>index.php/inventory/assembly_list/<?=$item_number?>'
		$('#dgAsm').datagrid({url:url});
	}
		function add(title,url){
			if ($('#tt').tabs('exists', title)){ 
				$('#tt').tabs('select', title); 
			} else { 			
				index++;
				var content = '<iframe scrolling="auto" frameborder="0" src="'+url+'" style="width:100%;height:600px;"></iframe>'; 
				
				$('#tt').tabs('add',{
					title: title,
					content: content,
					closable: true
				});
			}	
		}
		function remove(){
			var tab = $('#tt').tabs('getSelected');
			if (tab){
				var index = $('#tt').tabs('getTabIndex', tab);
				$('#tt').tabs('close', index);
			}
		}
	function upload_gambar()
	{
		$('#dlgGambar').dialog('open').dialog('setTitle','Upload Gambar');
	}
  	function do_upload()
	{
		var xurl='<?=base_url()?>index.php/inventory/do_upload_picture';
			$('#frmUpload').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					console.log(result);
					var result = eval('('+result+')');
					if (result.success){
						
						//$.messager.show({
						//	title:'Success',msg:'Data sudah tersimpan. Silahkan simpan formulir ini.'
						//});
						
						var upload_data=result.upload_data;
						$('#item_picture').val(upload_data['file_name']);
						$('#dlgGambar').dialog('close');
						save();
						
					} else {
						$('#error_upload').html(result.error);
					}
				}
			});
	}		
	function add_category(){
		var url="<?=base_url()?>index.php/category";
		add_tab_parent("category",url);
	}
</script>
