<div id='dgItem' class="easyui-dialog" 
	style="width:600px;height:300px;padding:15px 15px;left:100px;top:20px"
    closed="true" buttons="#tbItem" >
	<form id="frmItem" method='post' >
	<table class='table2' width="100%">
		<tr>
			<td>Kode Barang</td>
			 <td><input  id="item_number"  name="item_number" >
				<?=link_button('','dlgitem_number_show()','search');?>
			 </td>
		</tr>
		<tr>
			<td>Category</td>
			 <td><input  id="category"  name="category" >
				<?=link_button('','dlgcategory_show()','search');?>
			 </td>
		</tr>
		<tr>
			<td>Sub Category</td>
			 <td><input  id="sub_category"  name="sub_category" >
				<?=link_button('','dlgsub_category_show()','search');?>
			 </td>
		</tr>
		<tr>
			<td>Supplier</td>
			 <td><input  id="supplier_number"  name="supplier_number" >
				<?=link_button('','dlgsupplier_number_show()','search');?>
			 </td>
		</tr>
		<tr>
			<td>Merek</td>
			 <td><input  id="manufacturer"  name="manufacturer" >
				<?=link_button('','dlgmanufacturer_show()','search');?>
			 </td>
		</tr>
		<tr>
			<td>Model</td>
			 <td><input  id="model"  name="model" >
				<?=link_button('','dlgmodel_show()','search');?>
			 </td>
		</tr>
		
	</table>
	<input type='hidden' id='promosi_code_item' name='promosi_code_item' value='<?=$promosi_code?>'>
	<input type='hidden' id='promosi_code_id' name='promosi_code_id'>
	</form>	
</div>
<div id="tbItem">
	<?=link_button('CLOSE','close_item()','cancel');?>
	<?=link_button('SUBMIT','save_item()','save');?>
</div>
<?php 
echo $lookup_item_number;
echo $lookup_category;
echo $lookup_sub_category;
echo $lookup_manufacturer;
echo $lookup_model;
echo $lookup_supplier_number;

?>
