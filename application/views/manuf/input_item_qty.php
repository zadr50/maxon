<!-- ITEM TO PROCESS -->
<div id='divItem' class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px;left:100px;top:20px"
		closed="true" buttons="#divItemButton">
		<table class='table2' width='100%'>
			<thead>
				<tr><td>Item Number</td><td>Description</td><td>Qty</td><td>Unit</td><td>Action</td></tr>
			</thead>
			<tbody>
				<tr>
					<form id="frmItem" method='post'>
						 <td><input id="item_number" style='width:80px' 
							name="item_number"   class="easyui-validatebox" required="true">
							<?=link_button('','dlginventory_show()','search');?>
						 </td>
						 <td><input id="description" name="description" style='width:200px'></td>
						 <td><input id="quantity"  style='width:50px'  name="quantity"></td>
						 <td><input id="unit" name="unit"  style='width:50px' ></td>
						<td>
							<?=link_button('Add Item','save_item()','save');?>
						</td> 
						<input type='hidden' id='ref1' name='ref1'>
						<input type='hidden' id='ref2' name='ref2'>
					</form>
				</tr>
			</tbody>
		</table>
</div>

