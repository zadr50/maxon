
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Receive Items</title>
 <script language='javascript'>
    $(document).ready(function(){
        $("#cmdPrint").click(function(){
            txtNo='<?=$shipment_id?>'; 
            window.open("<?=base_url().'index.php/delivery/print_bukti/'?>"+txtNo,"new");
        });
    });
         
    function add_row(nRow,txtItem){
        txtQty=$('#txtQty'+nRow).val();
        txtNo='<?=$shipment_id?>';     
        $.ajax({
            type : 'GET',
            url : '<?=base_url();?>index.php/delivery/add_item/'+txtNo,
            data: 'cmd=add&item='+txtItem+'&qty='+txtQty,
            success:function (data) {                
                $("#divItems").html(data);              
            }          
        });       

    }
    function del_row(nRow){
        txtNo='<?=$shipment_id?>';     
        $.ajax({
            type : 'GET',
            url : '<?=base_url();?>index.php/delivery/del_item/'+nRow+'/'+txtNo,
            data: '',
            success: function (data) {                
                $("#divItems").html(data);              
            }          
        });       
    }
    function b_search(){
        txtSearch=$('#txtSearch').val();
        txtLimit=$('#txtLimit').val();
        xurl='<?=base_url();?>index.php/inventory/lookup/0/'+txtLimit;
        $.ajax({
            type : 'GET',
            url :xurl,
            data: 'search='+txtSearch,
            success:function (data) {                
                $("#box_item_1").html(data);              
            }          
        });
         
    }
 </script>
 </head>
 <body>
 <div id='container'>
     <div class='box6' ><h1>Receive Items</H1>
   
   <h3>Formulir ini dipakai untuk pengelauran item barang </h3>
 
 	<?php echo $message;?>
 
   <?php echo validation_errors(); ?>
   <?php 
   		if($mode=='view'){
			echo form_open('delivery/update');
			$disabled='disable';
		} else {
			$disabled='';
   			echo form_open('delivery/add'); 
   		}
		
   ?>
   
   <table>
	<tr>
		<td>Nomor</td><td><?php 
                    if($mode=='add'){
                        echo form_input('shipment_id',$shipment_id);
                    } else {
                        echo '<h2>'.$shipment_id.'</h2>';
                    }    
                ?></td>
	</tr>
       <tr>
		<td>Tanggal</td><td><?php 
                if($mode=='add')echo form_input('date_received',$date_received,
				'class="easyui-datetimebox" required 
				data-options="formatter:format_date,parser:parse_date"
				');
                else echo $date_received;
                ?></td>
       </tr>
	<tr>
		<td>Tujuan</td><td><?php 
                if($mode=='add')echo form_input('supplier_number',$supplier_number);
                else echo $supplier_number;
                ?></td>
	</tr>
       <tr>
		<td>Referensi</td><td><?php 
                if($mode=='add')echo form_input('package_no',$package_no);
                else $package_no;
                ?></td>
       </tr>
	 <tr><td>&nbsp</td><td>&nbsp</td></tr>
	<tr><td>
         <?
            if($mode=='add') {
               echo '<input name="submit" type="submit" 
                       style="width:100px;height:30px" value="Simpan"/>';
            } else {
               echo '<input type="button" name="cmdPrint" id="cmdPrint" 
                       style="width:100px;height:30px" value="Print"/>';
            }
            
            ?>
            </td><td>&nbsp</td></tr>
   
     <tr><td colspan='4'>
             <div id='divItems'>
             <?=$delivery_items;?>
             </div>
         
         </td><td>&nbsp</td></tr>    
   </table>
   </form>
    </div>
     <? if($mode=='view') { ?>
     <div id='box_item'>
        
         <div id='box_item_1'  name='box_item_1' >
             <?
            echo $pagination;
            echo $select_items;                 
             ?>
         </div>
     </div>
     
     <? } ?>
   </div>
 </body>
</html>

