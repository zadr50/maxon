
 	<link rel="stylesheet" href="<?php echo base_url();?>public/ui/themes/default/easyui.css">
 	<link rel="stylesheet" href="<?php echo base_url();?>public/ui/themes/icon.css">
	<script src="<?php echo base_url();?>public/ui/jquery-1.8.0.min.js"></script>
	<script src="<?php echo base_url();?>public/ui/jquery.easyui.min.js"></script>
	<script src="<?php echo base_url();?>public/js/lib.js"></script>

   <h2>Transaksi Work Order</h2>
   <h3>Formulir ini dipakai untuk input data workorder</h3>
 	
 	<?php 
  $min_date=$this->session->userdata("min_date","");
 	
 	echo $message;?>
   <?php echo validation_errors(); ?>
   <?php 
   		if($mode=='view'){ 
			echo form_open('workorder/update');
			$disabled='disable';
		} else {
			$disabled='';
   			echo form_open('workorder/add'); 
   		}
		
   ?>
   <table>
	 <tr>
	 	<td>
	 	<input type="submit" value="Save" style="width:90px;height:30px"/>	 
	 	</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	 </tr>

	<tr>
		<td>Workorder No</td><td>
		<?php
		if($mode=='view'){
			echo "<input type='hidden' id='wo_number' name='wo_number' value='$wo_number'/>";
			echo $wo_number;
		} else { 
			echo "<input  id='wo_number' name='wo_number' value='$wo_number'/>";
		}		
		?></td>
		<td>Customer</td><td><?php echo form_input('customer',$customer);?></td>
	</tr>	 
	<tr>
		<td>Tanggal</td><td><?php echo form_input('wo_date',$wo_date);?></td>
		<td>SO Number</td><td><?php echo form_input('so_number',$so_number);?></td>
	</tr>	 
	<tr>
		<td>Warehouse</td><td><?php echo form_input('warehouse',$warehouse);?></td>
		<td>Amount</td><td><?php echo form_input('amount',$amount);?></td>
	</tr>	 
	<tr>
		<td>Status</td><td><?php echo form_input('status',$status);?></td>
		<td>Ordered By</td><td><?php echo form_input('ordered_by',$ordered_by);?></td>
	</tr>	 
	<tr>
		<td>Worked By</td><td><?php echo form_input('worked_by',$worked_by);?></td>
		<td>Comments</td><td><?php echo form_input('comments',$comments,'style="width:300px"');?></td>
	</tr>	 

   </table>

   </form>
     	 
     <?php if($mode=='view'){ 
     	?>
		<a  href="javascript:void(0)" class="easyui-linkbutton l-btn"
	 	onclick="frmItem_Show()">Add Item</a>
	<?php } ?>
    <div id="dbItems">
   		<?php  echo $detail; ?>
	</div>     
		
	
	<div id="frmItem" align='center'>
		<br/>Description <br/>
		<select id="item_number" style="width:200px"
		<?php
		$q=$this->db->query("select item_number,description from inventory order by description");
		foreach($q->result() as $row){
			echo '<option value="'.$row->item_number.'">'.$row->description.'</option>';			
		}
		?>
		</select>
		
		<input type="hidden" id="description"/>
		<br/>Qty <br/><input id="qty" style="width:80px"/>
		<br/>Unit<br/><input id="unit"/>
		<br/>Price <br/><input id="price"/>
		<br/>Amount <br/><input id="amount"/>
		<br/><a  href="javascript:void(0)" class="easyui-linkbutton l-btn"
		onclick="add_item();">Save</a>
		
	</div>

   </div>
	
<script>
	$('#frmItem').window({  
		title: 'Select Item Number',
		width:500,
		height:400 
	});  
	$('#frmItem').window('close');
	
	$('#item_number').blur(function(){
		//var data = [{"aid":"1","atitle":"Ameya R. Kadam"},{"aid":"2","atitle":"Amritpal Singh"}];
		//alert(data[0].atitle);
		$.ajax({
			type:"POST",
			url:CI_ROOT+'inventory/find/'+$(this).val(),
			success: function(data){
				var d=eval(data);
				$('#description').val(d[0].description);
				$('#price').val(d[0].retail);
				$('#unit').val(d[0].unit_of_measure);
				$('#qty').val(1);
				$('#amount').val(d[0].retail);
				
			}
		})
	});
	
 


function add_item() {
  wo_number=$('#wo_number').val();
  item_number=$('#item_number').val();
  description=$('#description').val();
  qty=$('#qty').val();
  unit=$('#unit').val();
  price=$('#price').val();
  amount=$('#amount').val();
  param='item_number='+item_number+'&description='+description+'&wo_number='+wo_number
  +'&qty='+qty+'&unit='+unit+'&price='+price+'&amount='+amount
  ;
   
  xurl=CI_ROOT+'workorder/save_detail';
	$.ajax({
		type: "POST",
		url: xurl,
		data: param,
		success: function(msg){
			$('#dbItems').html(msg);
			$('#frmItem').window('close');
		},
		error: function(msg){alert(msg);}
	}); 

}
function del_item(rowid) {
  xurl=CI_ROOT+'workorder/del_item/';
  wo_number=$('#wo_number').val();
  param='wo_number='+wo_number+'&rowid='+rowid;
	$.ajax({
		type: "POST",
		url: xurl,
		data: param,
		success: function(msg){
			$('#dbItems').html(msg);
		},
		error: function(msg){alert(msg);}
	}); 

}
function frmItem_Show(){
	$('#item_number').val('');
	$('#description').val('');
	$('#qty').val('');
	$('#unit').val('');
	$('#price').val('');
	$('#amount').val('');
	 $('#frmItem').window('open');
}
  
</script>

