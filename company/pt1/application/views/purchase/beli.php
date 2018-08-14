<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Transaksi Pembelian</title>
   <?php echo $library_src;?>
   <?php echo $script_head;?>   
 </head>
 <script language='javascript'>
    function add_row(nRow,txtItem){
        txtQty=$('#txtQty'+nRow).val();
        txtNo='<?=$purchase_order_number?>';     
        $.ajax({
            type : 'GET',
            url : '<?=base_url();?>index.php/beli/add_item/'+txtNo,
            data: 'cmd=add&item='+txtItem+'&qty='+txtQty,
            success:function (data) {                
                $("#divItems").html(data);              
            }          
        });       

    }
    function del_row(nRow){
        txtNo='<?=$purchase_order_number?>';     
        $.ajax({
            type : 'GET',
            url : '<?=base_url();?>index.php/beli/del_item/'+nRow+'/'+txtNo,
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
            url : xurl,
            data: 'search='+txtSearch,
            success:function (data) {                
                $("#box_item_1").html(data);              
            }          
        });
        $('#txtSearch').val('');
    }
  
    $(document).ready(function(){
        $("#cmdPrint").click(function(){
            txtNo='<?=$purchase_order_number?>'; 
            window.open("<?=base_url().'index.php/beli/print_faktur/'?>"+txtNo,"new");
        });
        $("#cmdPayment").click(function(){
            txtNo='<?=$purchase_order_number?>';     
             
            $.ajax({
                type : 'GET',
                url : '<?=base_url();?>index.php/payables_payments/add/'+txtNo,
                data: '',
                success: function (data) {                
                    $("#divPayment").html(data);
                }
            })
        });
        $("#cmdRecalc").click(function(){
            txtNo='<?=$purchase_order_number?>';     
            $.ajax({
                type : 'GET',
                url : '<?=base_url();?>index.php/beli/sum_info',
                data: 'nomor='+txtNo,
                success: function (data) {                
                    $("#divPayment").html(data);
                }
            })
        });
         
        
    })
     

 </script>
 <body>
 <div id='container'>
   <div class='box6' style="width:400px"><h1>FAKTUR PEMBELIAN</H1>
   <?php echo validation_errors(); ?>
   <?php 
        if($mode=='view') 
        {
                echo form_open('beli/update');
                $disabled='disable';
        } else {
                $disabled='';
                echo form_open('beli/add'); 
        }
		
   ?>
<table>     
    <tr><td>Nomor</td>
        <td>  
            <?php
            if($mode=='view'){
                    echo '<h2>'.$purchase_order_number.'</h2>';
                    echo form_hidden('purchase_order_number',$purchase_order_number);
            } else { 
                    echo form_input('purchase_order_number',$purchase_order_number);
            }		
            ?>
        </td>        
    </tr>
     <tr><td>Tanggal</td><td><?
         
        if($mode=='view') echo $po_date; 
        else echo form_input('po_date',$po_date);
                 
         ?>
         </td></tr>
     <tr><td>Supplier</td><td><?
        if($mode=='view') {
            echo $supplier_info;
        }
        else echo form_dropdown('supplier_number',
             $supplier_list,$supplier_number); 
        ?></td></tr>
             
     <tr><td colspan="2"><div id='divSumInfo'></div></td></tr>
	<tr><td colspan="2">
         <?
            if($mode=='add'){
               echo '<input name="submit" type="submit" 
                       style="width:100px;height:30px" value="Simpan"/>';
            } else {
               echo '<input type="button"  id="cmdPrint" 
                       style="width:100px;height:30px" value="Print"
                       "/>';
               echo '<input type="button"  id="cmdPayment" 
                       style="width:100px;height:30px" value="Payment"
                       "/>';
               echo '<input type="button"  id="cmdRecalc" 
                       style="width:100px;height:30px" value="Recalc"
                       "/>';
            }

            ?>
                <div id="divPayment"></div>
            </td></tr>
   
     <tr><td colspan='4'>
             <div id='divItems'>
             <?php 
                echo $lineitems;
                echo $sum_info;
             ?>
                 
             </div>
         
         </td><td></td></tr>      
</table>	
	   </form>
    </div>
     <? if($mode=='view') { ?>
     <div id='box_item' >
        
         <div id='box_item_1'  name='box_item_1' >
             <?
            echo $pagination;
            echo $table;                 
             ?>
         </div>
     </div>
     
     <? } ?>
   </div>
     
 </body>
</html>

