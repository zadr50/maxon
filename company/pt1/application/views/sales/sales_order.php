<div class="thumbnail box-gradient">
	<?
		echo link_button("Save","save_so()","save");
		echo link_button('Print', 'print_so()','print');
		echo link_button('Add','','add','false',base_url().'index.php/sales_order/add');		
		echo link_button('Delete','delete()','cut');		
		echo link_button('Search','','search','false',base_url().'index.php/sales_order');		
		echo link_button('Refresh','','reload','false',base_url().'index.php/sales_order/view/'.$sales_order_number);		
		echo link_button('Approve','approve()','man');		
		
		echo "<div style='float:right'>";
		echo link_button('Help', 'load_help(\'sales_order\')','help');		
				
	?>	
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('sales_order')">Help</div>
		<div onclick="show_syslog('sales_order','<?=$sales_order_number?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<?php
$user_admin=$this->session->userdata("user_admin");
$enabled_status="disabled";
if($user_admin)$enabled_status="";
    $min_date=$this->session->userdata("min_date","");

?>
<input type='hidden' id='cust_type' value='<?=$cust_type?>'>
<div class='col-lg-12'>
	<form id="frmSo"  method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<?php include_once "so_header_top.php"; ?>
	<div class="easyui-tabs" >
		<div id="divItem" title="Items">
			<?php include_once "so_items.php"; ?>
 	    </div>
		<div id="divDo" title="Surat Jalan" >
			<?php include_once "do_items.php"; ?>						
		</div>
	</div>
	 
	<?php include_once "so_header_bottom.php"; ?>
	</form>
</div>	



 
<?php 

include_once "so_items_input.php";  
include_once 'customer_select.php';
echo load_view('inventory/inventory_select');

?>

<script type="text/javascript">

	var allow_add=<?=$allow_add?>;
	var allow_edit=<?=$allow_edit?>;
	var allow_delete=<?=$allow_delete?>;
	var allow_print=<?=$allow_print?>;
	var allow_posting=<?=$allow_posting?>;
	var allow_approve=<?=$allow_approve?>;

	$().ready(function(){
		//$('#dgDo').datagrid({url: '<?=base_url()?>index.php/sales_order/delivery/<?=$sales_order_number?>'});
		//$('#dgDo').datagrid('reload');
	});

	var url;	
	
    function save_so(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#sales_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

		if( ! (allow_add || allow_edit) ) {
			log_msg(ERR_ACCESS_MODULE);
			return false;
		}
	
        if($('#sales_order_number').val()==''){alert('Isi nomor sales order !');return false;}
        if($('#sold_to_customer').val()==''){alert('Pilih pelanggan !');return false;}
        if($('#salesman').val()==''){alert('Pilih salesman !');return false;}        
		
		hitung_jumlah();
		
		url='<?=base_url()?>index.php/sales_order/save';
			$('#frmSo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#sales_order_number').val(result.sales_order_number);
						var so=$('#sales_order_number').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/sales_order/items/'+so+'/json'});
						//$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang');
					} else {
						log_err(result.msg);
					}
				}
			});

    }

		function hitung_jumlah(){
		    url=CI_ROOT+'sales_order/sub_total/'+$('#sales_order_number').val();
		    if($('#disc_total_percent').val()=='')$('#disc_total_percent').val(0);
		    disc_prc=$('#disc_total_percent').val();
	        if(disc_prc>1){
	        	disc_prc=disc_prc/100;
	        	$('#disc_total_percent').val(disc_prc);
	        }	
		    if($('#sales_tax_percent').val()=='')$('#sales_tax_percent').val(0);
		    tax_prc=$('#sales_tax_percent').val();
	        if(tax_prc>1){
	        	tax_prc=tax_prc/100;
	        	$('#sales_tax_percent').val(tax_prc);
	        }	
		    if($('#freight').val()=='')$('#freight').val(0);
		    if($('#other').val()=='')$('#other').val(0);
		    
		    $.ajax({
                type: "GET",
                url: url,
				contentType: 'application/json; charset=utf-8',
                data:{discount:$("#disc_total_percent").val(),
					tax:$("#sales_tax_percent").val(),
					other:$("#other").val(),
					freight:$("#freight").val()}, 
                success: function(msg){
                    var obj=jQuery.parseJSON(msg);
                    $('#sub_total').val(obj.sub_total);
                    $('#total').val(obj.amount);
                    $('#disc_amount_1').val(obj.disc_amount_1);
                    $('#tax').val(obj.tax);
                },
                error: function(msg){alert(msg);}
		    });			
		}

  	function print_so(){
		if(!allow_print) {
			log_msg(ERR_ACCESS_MODULE);
			return false;
		}
		so=$('#sales_order_number').val(); 
		window.open("<?=base_url().'index.php/sales_order/print_so/'?>"+so,"new");  		
  	}
	function approve(){
		if(!allow_approve) {
			log_msg(ERR_ACCESS_MODULE);
			return false;
		}
		    url=CI_ROOT+'sales_order/approve/'+$('#sales_order_number').val();
		    $.ajax({type: "GET", url: url,
                success: function(msg){
					var result=eval('('+msg+')');
					if(result.success){
						log_msg(MSG_HAS_APPROVED); 
					} else {
						log_msg(result);
					}
				},
                error: function(msg){log_msg(msg);}
	    });			
	}
</script>
