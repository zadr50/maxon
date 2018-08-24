<div class="thumbnail box-gradient">
	<?
	echo link_button(lang('save'), 'save();return false;','save');		
	echo link_button(lang('print'), 'print_item();return false;','print');		
	echo link_button(lang('add'),'','add','false',base_url().'index.php/inventory/add');		
	if($mode=="view") echo link_button(lang('refresh'),'','reload','false',base_url().'index.php/inventory/view/'.$item_number);		
	echo link_button(lang('picture'), 'upload_gambar();return false;','man');		
//	echo link_button('Saldo', 'add_tab_parent(\'saldo_stock\',\''.base_url('index.php/inventory/saldo_stock').'\');','lock');		
	echo link_button('Barcode', 'print_barcode();return false;','print');		
	echo "<div style='float:right'>";
	echo link_button(lang('help'), 'load_help(\'inventory\');return false;','help');	
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">
		<?=lang('options')?></a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="add_supplier()">Add Supplier</div>
		<div onclick="add_category()">Add Category</div>
		<div onclick="load_help()">Help</div>
		<div onclick="show_syslog('inventory','<?=$item_number?>')">Log Aktifitas</div>

		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
		


<div class="thumbnail">	
	<form id="frmBarang"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>

	     <div class='boxx6'>
	       <div id='box_section' class='section_show'>
		     <table class='table2h' width='100%' height='100%'>     
	    <tr><td>Item Number</td>
	        <td>:</td>
	        <td colspan='5'>  
	            <?php
	            if($mode=='add'){
	                $item_number="AUTO";                    
                    echo form_input('item_number',$item_number,"id=item_number");
	            } else { 
	                    echo "<strong>".$item_number."</strong>";
	                    echo "<input type='hidden' name='item_number' id='item_number' value='".$item_number."'>";
	            }		
                echo " Category : ";
                echo form_input('category',$category," id='category' style='width:80px'");
                echo link_button('','dlginventory_categories_show()','search');
                echo link_button('','add_category();return false;','add'); 
                echo " Sub : ";
                echo form_input('sub_category',$sub_category," id='sub_category' style='width:80px'");
                echo link_button('','dlginventory_sub_categories_ex_show()','search');
                
                echo " Sistim : ".form_input('type_of_invoice',$type_of_invoice,"id='type_of_invoice' style='width:50px'");
                echo link_button('','dlgtype_of_invoice_show()',"search","false");
                
                ?>        
	            
	       </td>        
	
			
	      </tr>
	     <tr><td>Description</td>
	       <td>:</td>
	       <td colspan=4><?php echo form_input('description',$description,
					'style="width:80%"');?></td>
	      </tr>
	     <tr>
	       <td>Supplier</td>
	       <td>:</td>
	       <td colspan=5><?
			echo form_input('supplier_number',$supplier_number," id='supplier_number' style='width:20%'");
			echo link_button('Pilih','dlgsuppliers_show()','search');
			echo " ".form_input('supplier_name',$supplier_name," id='supplier_name' disabled style='width:50%'");
			echo link_button(lang('add'),'add_supplier();return false;','add');			
		   ?> </td>
	
	
	      </tr>
		  <tr>
	       <td>Active </td><td>:</td><td> <?=form_radio('active',1,$active=='1'?TRUE:FALSE,"style='width:30px'");?>&nbsp&nbsp
	         Yes <?php echo form_radio('active',0,$active=='0'?TRUE:FALSE,"style='width:30px'");?>&nbsp&nbsp No </td>
			<td>Divisi</td>
			<td>:</td>
			<td>
				<?php 
					echo form_input('division',$division,"id='division'");
					echo link_button('Pilih','dlgdivisions_show()','search');
				?>
			</td>
		  </tr>
		  <tr>
		      <td colspan=5>
		          <?php
                  echo " Class : ".form_dropdown('class',$class_list,$class);      
                  echo " Colour : ";
                  echo form_input("colour",$colour,"id='colour' style='width:50px'");
                  echo link_button('','dlgcolour_show()','search');
                  echo " Size: ";            
                  echo form_input("size",$size,"id='size'  style='width:50px'");
                  echo link_button('','dlgsize_show()','search');
                   ?>         
		      </td>
		  </tr>
	</table>	
			<div>
			<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
				<div title="Umum" id="box_section" style="padding:10px">
					<table class='table2' width='100%'>
				     <tr>
					       <td>Harga Jual</td>
					       <td>:</td>
					       <td><?php echo form_input('retail',$retail,"id='retail'");
                              echo link_button('','dlgJualShow()','sum',"title='Hitungan harga jual beli margin'");
					           
					           
					           ?> </td>
					
					       <td>Harga Beli</td>
					       <td>:</td>
					       <td><?php echo form_input('cost_from_mfg',$cost_from_mfg,"id='cost_from_mfg'");?> </td>
				      </tr>
				     <tr>
					       <td>Harga Pokok </td>
					       <td>:</td>
					       <td><?php echo form_input('cost',$cost,"id='cost'");?> </td>
					
					       <td>Unit</td>
					       <td>:</td>
					       <td><?php 
						   echo form_input('unit_of_measure',$unit_of_measure);
						   ?> </td>
				      </tr>
                     <tr>
                           <td>Margin % </td>
                           <td>:</td>
                           <td><?php echo form_input('margin',$margin,"id='margin'");?> </td>
                    
                           <td></td>
                           <td></td>
                           <td></td>
                      </tr>
				     <tr>
					       <td>Merk</td>
					       <td>:</td>
					       <td><?php echo form_input('manufacturer',$manufacturer);?> </td>
					
					       <td>Model</td>
					       <td>:</td>
					       <td><?php echo form_input('model',$model);?> </td>
					       
				      </tr>
				     <tr>
					       <td>Maximum Qty</td>
					       <td>:</td>
					       <td><?php echo form_input('quantity_on_back_order',$quantity_on_back_order);?> </td>
					
					       <td>Minimum Qty</td>
					       <td>:</td>
					       <td><?php echo form_input('reorder_quantity',$reorder_quantity);?> </td>
				      </tr>
				     <tr>
					       <td>Quantity saat ini</td>
					       <td>:</td>
					       <td><?php echo form_input('quantity_in_stock',$quantity_in_stock);?> </td>
					
					       <td>Quantity dalam pesanan</td>
					       <td>:</td>
					       <td><?php echo form_input('quantity_on_order',$quantity_on_order);?> </td>
				      </tr>
						
				      <tr>
							<td>Multiple Style </td>
					       <td>:</td>
					       <td><?=form_radio('style',1,$style=='1'?TRUE:FALSE,"style='width:30px'");?>
					         Yes <?php echo form_radio('style',0,$style=='0'?TRUE:FALSE,"style='width:30px'");?>No </td>
							<td>Tgl TrAkhir Masuk</td><td>:</td><td><?php echo form_input('last_inventory_date',$last_inventory_date);?></td>

					  </tr>
				      <tr>
				      </tr> 
				     

					</table>
				</div>
				<div title="Akuntansi" id='box_section' style="padding:10px;" class='section_hide'>
				     <table class='table2' width='100%'>
			       <tr>
			         <td>Akun Persediaan </td>
			         <td>:</td>
			         <td><?php echo form_input('inventory_account',$inventory_account,"id='inventory_account' style='width:70%'");?>
			         	<?=link_button('',"lookup_coa('inventory_account')",'search')?>			         	
			         </td>
			       </tr>
			       <tr>
			         <td>Akun Penjualan </td>
			         <td>:</td>
			         <td><?php echo form_input('sales_account',$sales_account,"id='sales_account' style='width:70%'");?>
			         	<?=link_button('',"lookup_coa('sales_account')",'search')?>
			         	
			         </td>
			       </tr>
			       <tr>
			         <td>Akun Harga Pokok Persediaan </td>
			         <td>:</td>
			         <td><?php echo form_input('cogs_account',$cogs_account,"id='cogs_account' style='width:70%'");?>
			         	<?=link_button('',"lookup_coa('cogs_account')",'search')?>
			         </td>
			       </tr>
			       <tr>
			         <td>Akun Pajak Penjualan </td>
			         <td>:</td>
			         <td><?php echo form_input('tax_account',$tax_account,"id='tax_account' style='width:70%'");?>
			         	<?=link_button('',"lookup_coa('tax_account')",'search')?>			         	
			         </td>
			       </tr>
			       <tr>
			         <td>&nbsp;</td>
			         <td>&nbsp;</td>
			         <td>&nbsp;</td>
			       </tr>
			     </table>
			  
			   </div>
				<div  title="Lain-lain"  id='box_section' style="padding:10px;" class='section_hide'>
					 <table class='table2' width='100%'>
					 <tr>
					   <td>Kode Barang Supplier </td>
					   <td>:</td>
					   <td><?php echo form_input('manufacturer_item_number',$manufacturer_item_number);?></td>
					   <td>Kode Barang Lama</td>
					   <td>:</td>
					   <td><?php echo form_input('kode_lama',$kode_lama);?></td>
					  </tr>
					 <tr>
					   <td>Fitur Khusus </td>
					   <td>:</td>
					   <td colspan="3"><?php echo form_input('special_features',$special_features,"style='width:400px'");?></td>
					  </tr>
					 <tr>
					   <td>Gambar Barang </td>
					   <td>:</td>
					   <td><?php echo form_input('item_picture',$item_picture,"style='width:200px' id='item_picture'");?></td>
					   <td rowspan="8">
							<img id="imgBarang" src="<?=base_url()."/tmp/".$item_picture?>" style="width:200px;height:200px;border:1px solid lightgray">
					   </td>  
					  </tr>
					
					 <tr>
					   <td>Pakai Nomor Serial </td>
					   <td>:</td>
					   <td><?=form_radio('serialized',1,$serialized=='1'?TRUE:FALSE);?>
						 Yes <?php echo form_radio('serialized',0,$serialized=='0'?TRUE:FALSE);?>No </td>
						 
					  </tr>
					  
					 <tr>
					   <td>Weight</td>
					   <td>:</td>
					   <td><?php echo form_input('weight',$weight);?></td>
					 </tr> 
					 <tr>
					   <td>Weight Unit </td>
					   <td>:</td>
					   <td><?php echo form_input('weight_unit',$weight_unit);?></td>
					 </tr>
					 <tr>
					   <td>Case Pack </td>
					   <td>:</td>
					   <td><?php echo form_input('case_pack',$case_pack);?></td>
					  </tr>
					 <tr>
					   <td>&nbsp;</td>
					   <td>&nbsp;</td>
					   <td>&nbsp;</td>
					  </tr>
				   </table>
				</div>
			<!-- QUANTITY -->				
				<div title="Quantity" style="padding:10px">
					<table id="dgGudang" class="easyui-datagrid"  width='100%'
                        data-options="
                            iconCls: 'icon-edit', fitColumns: true, 
                            singleSelect: true,  
                            url: '<?=base_url("inventory/qty_gudang2/".$item_number)?>',toolbar:'',
                        ">
                        <thead>
                            <tr>
                                <th data-options="field:'warehouse_code',width:80">Gudang</th>
                                <th data-options="field:'quantity',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Quantity</th>
                                <th data-options="field:'description',width:80">Keterangan</th>
                                <th data-options="field:'create_by',width:80">Crt By</th>
                                <th data-options="field:'create_date',width:80">Crt Date</th>
                                <th data-options="field:'update_by',width:80">Upd By</th>
                                <th data-options="field:'update_date',width:80">Upd Date</th>
                                <th data-options="field:'id',width:80,align:'left',editor:'text'">Id</th>
                            </tr>
                        </thead>
                    </table>

				</div>
			<!-- CARDS -->				
				<div title="Cards" style="padding:10px">
					<div class='thumbnail'>
						 
						<table width='100%' class='box-gradient'>
						<tr><td>Date From</td>
						<td><?=form_input('date_from',date("Y-m-1"),'id=date_from 
							data-options="formatter:format_date,parser:parse_date"
							class="easyui-datetimebox" ');?></td>
						<td>Date To</td>
						<td><?=form_input('date_to',date("Y-m-d 23:59:59"),'id=date_to  
							data-options="formatter:format_date,parser:parse_date"
							class="easyui-datetimebox" ');?></td>
						<td><?=form_input('gudang','','id=gudang');?></td>
						<td><?=link_button('Search','search_cards()','search');?></td>
						</tr>
						</table>
						 
					</div>
					<table id="dgCard" class="easyui-datagrid"  width='100%'
						data-options="
							iconCls: 'icon-edit', fitColumns: true, 
							singleSelect: true,  
							url: '',toolbar:'',
						">
						<thead>
							<tr>
								<th data-options="field:'no_sumber',width:80">Nomor</th>
								<th data-options="field:'tanggal',width:80">Tanggal</th>
								<th data-options="field:'jenis',width:80,align:'left',editor:'text'">Jenis</th>
								<th data-options="field:'qty_masuk',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty Masuk</th>
								<th data-options="field:'qty_keluar',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Qty Keluar</th>
								<th data-options="field:'saldo',width:80,align:'right'">Saldo</th>
								<th data-options="field:'gudang',width:80,align:'right'">Gudang</th>
							</tr>
						</thead>
					</table>
					
				</div>
				<div title='Satuan'>
					<div class='thumbnail'>
						<p>Item Multi Unit &nbsp &nbsp<?=form_radio('multiple_pricing',1,$multiple_pricing=='1'?TRUE:FALSE,"style='width:30px'");?>
							 Yes <?php echo form_radio('multiple_pricing',0,$multiple_pricing=='0'?TRUE:FALSE,"style='width:30px'");?>No 
						</p>
					</div>
					<table id='dgUnitPrice' name='dgUnitPrice' class="easyui-datagrid"  
						data-options="
							iconCls: 'icon-edit', fitColumns: true,
							singleSelect: true,  
							url: '<?=base_url()?>index.php/inventory/unit_price_list/<?=$item_number?>',
							toolbar:'#dgUnitPrice_Tool',
						" width="100%">
						<thead>
							<tr>
								<th data-options="field:'customer_pricing_code',width:80">Satuan</th>
								<th data-options="field:'quantity_low',width:80,align:'right'">Qty Low</th>
								<th data-options="field:'quantity_high',width:80,align:'right'">Qty High</th>
								<th data-options="field:'retail',width:80,align:'right'">Harga Jual</th>
								<th data-options="field:'cost',width:80,align:'right'">Harga Beli</th>
								<th data-options="field:'date_from',width:80">Date From</th>
								<th data-options="field:'date_to',width:80">Date To</th>
							</tr>
						</thead>
					</table>
				</div>
				<div title='Assembly'>
					<div class='thumbnail box-gradient'>
						<p>Item Assembly atau Paket &nbsp &nbsp<?=form_radio('assembly',1,$assembly=='1'?TRUE:FALSE);?>
							 Yes <?php echo form_radio('assembly',0,$assembly=='0'?TRUE:FALSE);?>No 
						</p>
					</div>
					<table id='dgAsm' name='dgAsm' class="easyui-datagrid"  width='100%'
						data-options="
							iconCls: 'icon-edit', fitColumns: true,
							singleSelect: true,  
							url: '<?=base_url()?>index.php/inventory/assembly_list/<?=$item_number?>',
							toolbar:'#dgAsm_Tool'," width="100%">
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
				<div title='Suppliers'>
					<table id='dgSupp' name='dgSupp' class="easyui-datagrid"  
						data-options="
							iconCls: 'icon-edit', fitColumns: true, 
							singleSelect: true,  
							url: '<?=base_url()?>index.php/inventory/supplier_list/<?=$item_number?>',
							toolbar:'#dgSupp_Tool'," width="100%">
						<thead>
							<tr>
								<th data-options="field:'supplier_number',width:80">Kode Supplier</th>
								<th data-options="field:'supplier_name',width:80">Nama Supplier</th>
								<th data-options="field:'supplier_item_number',width:80">Kode Barang Supplier</th>
								<th data-options="field:'cost',width:180">Harga Beli</th>
								<th data-options="field:'lead_time',width:80,align:'right'">Lead Time</th>
							</tr>
						</thead>
					</table>
				</div>

			</div>
		</div>  
	</form>
</div>	

<div id='dlgPrintBarcode' class="easyui-dialog" style="width:500px;height:180px;;left:100px;top:20px"
        closed="true" toolbar="#tbPrint_barcode">
		<table class='table'>
		<tr><td>Quantity</td><td><input type='text' id='txtBarQty' value='1'></td></tr>
		<tr><td>Ukuran (0-Kecil, 1-Besar)</td><td><input type='text' id='txtBarSize' value='0'></td></tr>
		</table>
    </div>   
</div>
<div id='tbPrint_barcode' align='right'>
	<?php
		echo link_button('Print','print_barcode_action()','print');
	?>
</div>


<?php 
echo $lookup_po_type;
echo $lookup_colour;
echo $lookup_size;
?>


 <script language='javascript'>
	var url="";	
 
  	function save(){
  		if($('#item_number').val()==''){alert('Isi kode barang !');return false;}
  		if($('#frmBarang input[name=description]').val()==''){alert('Isi nama barang !');return false;}
  		if($('#unit_of_measure').val()==''){alert('Isi satuan !');return false;}
		url='<?=base_url()?>index.php/inventory/save';
			$('#frmBarang').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
					    $("#item_number").val(result.item_number);
						$('#mode').val('view');
						remove_tab_parent();
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
  	}
  	function print_item(){
            txtNo=$("#item_number").val(); 
            window.open("<?=base_url().'index.php/inventory/print_item/'?>"+txtNo,"new");  		
  	}
  	function unit_price(){
		txtNo=$("#item_number").val(); 
		if(txtNo==""){alert("Isi kode barang !");return false}
		dlgUnitPrice_Add();
  	}
  	function item_assembly(){
            txtNo=$("#item_number").val(); 
            window.open("<?=base_url().'index.php/inventory/assembly/'?>"+txtNo,"_self");  		
  	}
  	function others_supplier(){
            txtNo=$("#item_number").val(); 
            window.open("<?=base_url().'index.php/inventory/supplier/'?>"+txtNo,"_self");  		
  	}
  	function qty_gudang(){
            txtNo=$("#item_number").val(); 
            window.open("<?=base_url().'index.php/inventory/qty_gudang/'?>"+txtNo,"_self");  		
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
	function upload_gambar()
	{
		$('#dlgGambar').dialog('open').dialog('setTitle','Upload Gambar');
	}
	function search_cards()
	{
		var d1=$("#date_from").datebox('getValue');
		var d2=$("#date_to").datebox('getValue');
		var gudang=$("#gudang").val();
		
		var xurl='<?=base_url()?>index.php/inventory/kartu_stock/<?=$item_number?>?d1='+d1+'&d2='+d2+"&gudang="+gudang;
		console.log(xurl);
		$('#dgCard').datagrid({url:xurl});
		$('#dgCard').datagrid('reload');
	}
	function dgUnitPrice_Refresh(){
		var url='<?=base_url()?>index.php/inventory/unit_price_list/<?=$item_number?>'
		$('#dgUnitPrice').datagrid({url:url});
	}
	function dgSupp_Refresh(){
		var url='<?=base_url()?>index.php/inventory/supplier_list/<?=$item_number?>'
		$('#dgSupp').datagrid({url:url});
	}
	function dgAsm_Refresh(){
		var url='<?=base_url()?>index.php/inventory/assembly_list/<?=$item_number?>'
		$('#dgAsm').datagrid({url:url});
	}
	
	function import_excel(){
		$("#dlgExcel").dialog("open");
	}
	function dlgExcelSubmit(){
		var xurl='<?=base_url()?>index.php/inventory/import_excel';
		$('#dlgExcelForm').form('submit',{
			url: url, onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				console.log(result);
				var result = eval('('+result+')');
				if (result.success){
					$('#dlgExcel').dialog('close')
					log_msg("Data sudah diimport, periksa data table search.");
				} else {
					log_err(result.msg);
				}
			}
		});
	}
	function add_category()
	{
		void add_tab_parent("add_category","<?=base_url()?>index.php/category");
	}
	function add_supplier()
	{
		void add_tab_parent("add_supplier","<?=base_url()?>index.php/supplier/add");		
	}
	function print_barcode()
	{
		$("#dlgPrintBarcode").dialog('open')
		.dialog('setTitle','Print Barcode');;

	}
	function print_barcode_action(){
		var qty=$("#txtBarQty").val();
		var ukuran=$("#txtBarSize").val();
		if(qty=="0")qty=1;
		item_number=$("#item_number").val();
		if(item_number==""){alert("Pilih kode barang !");return false;}
        window.open("<?=base_url().'index.php/inventory/print_barcode/'?>"+item_number+"/"+qty+"/"+ukuran,"_barcode");  		
		
		
	}
	function add_satuan()
	{
		void add_tab_parent("add_satuan","<?=base_url()?>index.php/company/inventory");		
	}
	
</script>



						
<?=load_view('gl/select_coa_link')?>   	
 

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
<div id='dgUnitPrice_Tool'>
	<?=link_button('Add', 'dlgUnitPrice_Add()','add');?>
	<?=link_button('Edit', 'dlgUnitPrice_Edit()','edit');?>
	<?=link_button('Delete', 'dlgUnitPrice_Delete()','remove');?>
	<?=link_button('Refresh', 'dgUnitPrice_Refresh()','reload');?>
</div>
<div id='dgSupp_Tool'>
	<?=link_button('Add', 'dlgSupp_Add()','add');?>
	<?=link_button('Edit', 'dlgSupp_Edit()','edit');?>
	<?=link_button('Delete', 'dlgSupp_Delete()','remove');?>
	<?=link_button('Refresh', 'dgSupp_Refresh()','reload');?>
</div>

<?
echo load_view("inventory/unit_price");
echo load_view("inventory/assembly");
echo load_view("inventory/supplier");
echo $lookup_division;
echo $lookup_category;
echo $lookup_sub_category;
echo load_view("inventory/calc_sales_price");
echo $lookup_suppliers;

?>
<div id="dlgExcel" class="easyui-dialog"  
 style="width:400px;height:300px;padding:5px 5px;left:100px;top:20px" closed="true" >
	<div class="thumbnail">
	<?php 
		echo form_open_multipart(base_url()."index.php/inventory/import_excel","id='dlgExcelForm'");
	?>
		<input type="file" name="file_excel" id="file_excel" size="150" stye="float:left" />
		<input type="button" value="Submit" onclick="dlgExcelSubmit()">  
		</form>
		<p class="help-block">Only Excel/CSV File Import.</p>
	</div>
	<div id='dlgExcelInfo'></div>
</div>
<script language='JavaScript'>
function dlginventory_sub_categories_ex_show() {
    cat=$("#category").val();
    if(cat==""){
        alert("Pilih kategori terlebih dahulu !");return false;
    }
    $('#dlginventory_sub_categories').dialog('open').dialog('setTitle','Daftar Pilihan');
    search_id=$('#dlginventory_sub_categories_search_id').val();
    $('#dginventory_sub_categories').datagrid({url:'<?=base_url()?>index.php/lookup/query/inventory_sub_categories/'+search_id+'?parent_id='+cat});
    $('#dginventory_sub_categories').datagrid('reload');
}
</script>
