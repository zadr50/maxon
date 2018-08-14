 <script src="<?=base_url();?>js/lib.js"></script>

 <div id='containerz'>
   <?php echo validation_errors(); ?>
   <?php 
    if($mode=='view') {
            echo form_open('inventory/update','id=myform');
            $disabled='disable';
    } else {
            $disabled='';
            echo form_open('inventory/add','id=myform'); 
    }
   ?>
     <div class='box6x'>
         <h1>DATA MASTER BARANG</h1>
	   <div id='box_section' class='section_show'><h2>General Information</h2>
<table  width="100%">     
    <tr><td>Item Number</td>
        <td>:</td>
        <td>  
            <?php
            if($mode=='view'){
                    echo $item_number;
                    echo form_hidden('item_number',$item_number);
            } else { 
                    echo form_input('item_number',$item_number);
            }		
            ?>        </td>        
        <td>Active</td>
        <td>:</td>
        <td><?=form_radio('active',1,$active=='1'?TRUE:FALSE);?>
          Yes <?php echo form_radio('active',0,$active=='0'?TRUE:FALSE);?>No </td>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" style="width:100px;height:30px" value="Simpan"/></td>
    </tr>
     <tr><td>Description</td>
       <td>&nbsp;</td>
       <td colspan="6"><?php echo form_input('description',$description,
				'style="width:400px"');?></td>
      </tr>
     <tr>
       <td>Supplier</td>
       <td>:</td>
       <td><?php echo form_dropdown('supplier_number',$supplier_list,$supplier_number);?> </td>
       <td>Class</td>
      <td>:</td>
      <td><?php echo form_dropdown('class',$class_list,$class);?> </td>
      <td>&nbsp;</td>
      <td></td>
     </tr>
     <tr>
       <td>Harga Jual</td>
       <td>:</td>
       <td><?php echo form_input('retail',$retail);?> </td>
       <td>Category</td>
       <td>:</td>
       <td><?php echo form_dropdown('category',$category_list,$category);?> </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>

     <tr>
       <td>Harga Beli</td>
       <td>:</td>
       <td><?php echo form_input('cost_from_mfg',$cost_from_mfg);?> </td>
       <td>Sub Category </td>
       <td>:</td>
       <td><?php echo form_dropdown('sub_category',$category_list,$sub_category);?> </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>Harga Pokok </td>
       <td>:</td>
       <td><?php echo form_input('cost',$cost);?> </td>
       <td>Unit</td>
       <td>:</td>
       <td><?php echo form_input('unit_of_measure',$unit_of_measure);?> </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
</table>	
	</div>

	   <div id='box_section' class='section_hide'><h2>Quantity Stock</h2>
			<table width="100%">
			<tr><td>Qty Saat Ini</td><td>:</td>
                            <td><?php echo form_input('quantity_in_stock',$quantity_in_stock
                                    ,"style='width:100px'");?></td>
			  <td>Qty Minimum  </td>
			  <td>:</td>
			  <td><?php echo form_input('reorder_quantity'
                                  ,$reorder_quantity,"style='width:100px'");?></td>
			  <td>Qty Maximum </td>
			  <td>:</td>
			  <td><?php echo form_input('quantity_on_back_order'
                                  ,$quantity_on_back_order,"style='width:100px'");?></td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Point Pemesanan </td>
			  <td>:</td>
			  <td><?php echo form_input('reorder_point',
                                  $reorder_point,"style='width:100px'");?></td>
			  <td>Tgl Terakhir Pesan </td>
			  <td>:</td>
			  <td><?php echo form_input('last_order_date',
                                  $last_order_date,"style='width:100px'");?></td>
			  <td>Lokasi</td>
			  <td>:</td>
			  <td><?php echo form_input('location',$location,"style='width:100px'");?></td>
			  <td></td>
			  <td></td>
			  </tr>
			<tr>
			  <td>Jangka Waktu </td>
			  <td>:</td>
			  <td><?php echo form_input('lead_time',$lead_time,"style='width:100px'");?></td>
			  <td>Qty Pesanan PO </td>
			  <td>:</td>
			  <td><?php echo form_input('quantity_on_order',
                                  $quantity_on_order,"style='width:100px'");?></td>
			  <td>Nomor Rak </td>
			  <td>:</td>
			  <td><?php echo form_input('bin',$bin,"style='width:100px'");?></td>
			  <td></td>
			  <td></td>
			  </tr>
			<tr>
			  <td>Qty Pesanan SO </td>
			  <td>:</td>
			  <td><?php echo form_input('picking_order',$picking_order,"style='width:100px'");?></td>
			  <td>Amount Pesanan PO </td>
			  <td>:</td>
			  <td><?php echo form_input('amount_ordered',$amount_ordered,
                                  "style='width:100px'");?></td>
			  <td>Kode Barcode </td>
			  <td>:</td>
			  <td><?php echo form_input('upc_code',$upc_code,"style='width:100px'");?></td>
			  <td></td>
			  <td></td>
			  </tr>
			<tr>
			  <td>Tgl Perkiraan Penerimaan </td>
			  <td>:</td>
			  <td><?php echo form_input('expected_delivery',
                                  $expected_delivery,"style='width:100px'");?></td>
			  <td>Tgl Terakhir Penerimaan </td>
			  <td>:</td>
			  <td><?php echo form_input('last_order_date',
                                  $last_order_date,"style='width:100px'");?></td>
			  <td>Multiple Warehouse </td>
			  <td>:</td>
			  <td><?=form_radio('multiple_warehouse',1,$multiple_warehouse=='1'?TRUE:FALSE);?>
			    Yes <?php echo form_radio('active',0,$multiple_warehouse=='0'?TRUE:FALSE);?>No </td>
			  <td></td>
			  <td></td>
			  </tr>
			</table>		
	   </div>

   <div id='box_section' class='section_hide'><h2>General Ledger</h2>
     <table width="100%">
       <tr>
         <td>Akun Persediaan </td>
         <td>:</td>
         <td><?php echo form_dropdown('inventory_account',
                 $akun_list,$inventory_account);?></td>
         <td>Boleh Ubah Harga Penjualan </td>
         <td>:</td>
         <td><?=form_radio('allowchangeprice',1,$allowchangeprice=='1'?TRUE:FALSE);?>
           Yes <?php echo form_radio('allowchangeprice',0,$allowchangeprice=='0'?TRUE:FALSE);?>No </td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>Akun Penjualan </td>
         <td>:</td>
         <td><?php echo form_dropdown('sales_account',$akun_list,$sales_account);?></td>
         <td>Boleh Ubah Discount Penjualan </td>
         <td>:</td>
         <td><?=form_radio('allowchangedisc',1,$allowchangedisc=='1'?TRUE:FALSE);?>
           Yes <?php echo form_radio('allowchangedisc',0,$allowchangedisc=='0'?TRUE:FALSE);?>No </td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>Akun Harga Pokok Persediaan </td>
         <td>:</td>
         <td><?php echo form_dropdown('inventory_account',$akun_list,$inventory_account);?></td>
         <td>Persentase Discount Penjualan </td>
         <td>:</td>
         <td><?php echo form_input('discount_percent',$discount_percent);?></td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>Akun Pajak Penjualan </td>
         <td>:</td>
         <td><?php echo form_dropdown('tax_account',$akun_list,$tax_account);?></td>
         <td>Pakai Pajak </td>
         <td>:</td>
         <td><?=form_radio('taxable',1,$taxable=='1'?TRUE:FALSE);?>
           Yes <?php echo form_radio('taxable',0,$taxable=='0'?TRUE:FALSE);?>No </td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
     </table>
  
   </div>
 <div id='box_section' class='section_hide'><h2>Lain-Lain</h2>
   <table width="100%">
     <tr>
       <td>Kode Barang Supplier </td>
       <td>:</td>
       <td><?php echo form_input('manufacturer_item_number',$manufacturer_item_number);?></td>
       <td>Item Assembly </td>
       <td>:</td>
       <td><?=form_radio('assembly',1,$assembly=='1'?TRUE:FALSE);?>
         Yes <?php echo form_radio('assembly',0,$assembly=='0'?TRUE:FALSE);?>No </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>Fitur Khusus </td>
       <td>:</td>
       <td><?php echo form_input('special_features',$special_features);?></td>
       <td>Multi Unit </td>
       <td>:</td>
       <td><?=form_radio('multiple_pricing',1,$multiple_pricing=='1'?TRUE:FALSE);?>
         Yes <?php echo form_radio('multiple_pricing',0,$multiple_pricing=='0'?TRUE:FALSE);?>No </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>Gamabar Barang </td>
       <td>:</td>
       <td><?php echo form_input('item_picture',$item_picture);?></td>
       <td>Weight</td>
       <td>:</td>
       <td><?php echo form_input('weight',$weight);?></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>Manufacturer</td>
       <td>:</td>
       <td><?php echo form_input('manufacturer',$manufacturer);?></td>
       <td>Weight Unit </td>
       <td>:</td>
       <td><?php echo form_input('weight_unit',$weight_unit);?></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>Model</td>
       <td>:</td>
       <td><?php echo form_input('model',$model);?></td>
       <td>Case Pack </td>
       <td>:</td>
       <td><?php echo form_input('case_pack',$case_pack);?></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>Multiple Style </td>
       <td>:</td>
       <td><?=form_radio('style',1,$style=='1'?TRUE:FALSE);?>
         Yes <?php echo form_radio('style',0,$style=='0'?TRUE:FALSE);?>No </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>Pakai Nomor Serial </td>
       <td>:</td>
       <td><?=form_radio('serialized',1,$serialized=='1'?TRUE:FALSE);?>
         Yes <?php echo form_radio('serialized',0,$serialized=='0'?TRUE:FALSE);?>No </td>
       <td>&nbsp;</td>
       <td>&nbsp;</td> 
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
   </table>
 </div>

   </div></form>
  