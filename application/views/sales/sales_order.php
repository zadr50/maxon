<div class="thumbnail box-gradient" id='divToolbar'>
	<?php
		echo link_button("Save","save_so()","save");
		echo link_button('Print', 'print_so()','print');
//		echo link_button('Add','','add','false',base_url().'index.php/sales_order/add');		
		echo link_button('Delete','delete();return false','cut');		
		echo link_button('Search','','search','false',base_url().'index.php/sales_order');		
		echo link_button('Refresh','display();return false;','reload');		
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
		<?=link_button('Close', 'remove_tab_parent();return false;','cancel')?>		
		
	</div>
</div>
<?php
	$user_admin=$this->session->userdata("user_admin");
	$enabled_status="disabled";
	if($user_admin)$enabled_status="";
    $min_date=$this->session->userdata("min_date","");
?>
<input type='hidden' id='cust_type' value='<?=$cust_type?>'>
<div class='col'>
	<div class="easyui-tabs" >
		<div id="divGeneral" title="General">	
			<form id="frmSo"  method="post">
				<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
				<?php include_once "so_header_top.php"; ?>
				<?php include_once "so_header_bottom.php"; ?>
			</form>		
		</div>
		<div id="divItem" title="Items">
			<?php include_once "so_items.php"; ?>
 	    </div>
		<div id="divDo" title="Surat Jalan" >
			<?php include_once "do_items.php"; ?>						
		</div>
	</div>	 
</div>	
 
<?php 
	include_once "so_items_input.php";  
	echo $lookup_customers;
	echo $lookup_inventory;
	echo $lookup_gudang;
	echo $lookup_salesman;
	echo $lookup_payment_terms;	
?>

<script type="text/javascript">

	var allow_add=<?=$allow_add?>;
	var allow_edit=<?=$allow_edit?>;
	var allow_delete=<?=$allow_delete?>;
	var allow_print=<?=$allow_print?>;
	var allow_posting=<?=$allow_posting?>;
	var allow_approve=<?=$allow_approve?>;
	var url;	
	
	$().ready(function(){
		load_items();		
	});

	function load_items(){
		var so=$("#sales_order_number").val();								
		$('#dg').datagrid({url:'<?=base_url()?>index.php/sales_order/items/'+so+'/json'});
		$("#dg").datagrid("reload");
	}
	function display(){
		var so=$("#sales_order_number").val();
		window.open(CI_ROOT+"sales_order/view/"+so,"_self");
	}
    function save_so(){
        if($('#sales_order_number').val()==''){log_err('Isi nomor sales order !');return false;}
        if($('#sold_to_customer').val()==''){log_err('Pilih pelanggan !');return false;}
        if($('#salesman').val()==''){log_err('Pilih salesman !');return false;}        
		if($('#warehouse_code').val()==''){
			log_err("Isi kode gudang !");
			return false;
		}
		
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#sales_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){log_err("Tanggal tidak benar ! Mungkin sudah closing !");return false;}

		if( ! (allow_add || allow_edit) ) {
			log_msg(ERR_ACCESS_MODULE);
			return false;
		}
		$("#divToolbar").hide();
		
		loading();
		
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
						loading_close();
						$('#sales_order_number').val(result.sales_order_number);
						var so=$('#sales_order_number').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/sales_order/items/'+so+'/json'});
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang');
						$("#divToolbar").show();
						
					} else {
						loading_close();
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
