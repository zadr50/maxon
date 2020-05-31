
<?php
echo $lookup_suppliers;

$date_from=date("Y-m-1");
$date_to=date("Y-m-d 23:59:59");
$supplier_number='';

?>

<div class='alert alert-info'>
    <table class='table'>
    <tr><td colspan=4><strong>Isi filter data penjualan barang-barang konsinyasi dari supplier dibawah ini :</strong></td></tr>
    <tr>
        <td>Penjualan dari tanggal</td><td><?php echo form_input('date_from',$date_from,"id='date_from'   
        class='easyui-datetimebox' 
        data-options='formatter:format_date,parser:parse_date'
        style='width:200px' ");?>
        </td>
        <td>
            <?=link_button("Load Sales","on_load();return false","search")?>            
        </td>
    </tr>    
    <tr>
        <td>sampai tanggal</td><td><?php echo form_input('date_to',$date_to,"id='date_to'   
        class='easyui-datetimebox' 
        data-options='formatter:format_date,parser:parse_date'
        style='width:200px' ");?>
        </td>
        <td>
            <?=link_button("Create Invoice","on_submit();return false","save")?>            
        </td>
    </tr>    
   <tr>
        <td>Supplier</td><td><?php         
        echo form_input('supplier_number',$supplier_number,
        "id=supplier_number  
        class='easyui-validatebox' data-options='required:true'");
        echo link_button('','dlgsuppliers_show()',"search","false");               
        ?>
        </td>
        
    </tr>    
    <tr>
    	<td colspan=3>
        Total Amount Jual: <b><span id='jual_amt'>0</span></b>
        Total Cost: <b><span id='cost_amt'>0</span></b>
        Margin Percent: <b><span id='margin_prc'>0</span></b>   		
    	</td>
    </tr>
    </table>
</div>
    
<?php    
    
    echo "<div class='row'><div class='col-md-12'>";
    $this->browse->load_js(false);
    $this->browse->set_fields(array("item_number","description","qty","margin","amount_jual","amount_cost","supplier_number"));
    $this->browse->set_url(base_url("index.php/po/konsinyasi/item_sales"));
    $this->browse->_format_numeric=array("qty","margin","amount_jual","amount_cost");
    $this->browse->set_id("dgItems");
    $this->browse->set_tool("tb");
    echo $this->browse->refresh();
    
    echo "</div>"

    
?>


<script type="text/javascript">
    function on_submit()
    {
        var d1=$("#date_from").val();
        var d2=$("#date_to").val();
        var sup=$("#supplier_number").val();        
        
        var xurl="<?=base_url("index.php/po/konsinyasi/save")?>";
        var param={supplier_number:sup,date_from:d1,date_to:d2}
            
        $.ajax({type: "POST",url: xurl,data: param,
            success: function(msg){
            var result = eval('('+msg+')');
            if(result.success){
                alert(result.msg);
                remove_tab_parent();
            }
        },
            error: function(msg){alert(msg);}
        }); 
    }
    function on_load(){
    	
        hitung_total()
    	
        var d1=$("#date_from").val();
        var d2=$("#date_to").val();
        var sup=$("#supplier_number").val();
        var vUrl='<?=base_url()?>index.php/po/konsinyasi/item_sales/'+d1+'/'+d2+'/'+sup;
        $('#dgItems').datagrid({url:vUrl});     
        $('#dgItems').datagrid('reload');
    }
    function hitung_total(){
        var d1=$("#date_from").val();
        var d2=$("#date_to").val();
        var sup=$("#supplier_number").val();
        var vUrl='<?=base_url()?>index.php/po/konsinyasi/item_sales_total/'+d1+'/'+d2+'/'+sup;
        $.ajax({type: "GET",url: vUrl,
            success: function(msg){
            var result = eval('('+msg+')');
            if(result.success){
            	$("#jual_amt").html(result.jual_amt);
            	$("#cost_amt").html(result.cost_amt);
            	$("#margin_prc").html(result.margin_prc);
            }
        }
        }); 
    	
    }
    
</script>    