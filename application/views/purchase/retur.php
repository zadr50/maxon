<?php 
echo $lookup_suppliers;
echo $lookup_type_of_invoice;
include_once 'faktur_select.php'; 
echo $lookup_retur_toko;
echo $lookup_warehouse;

?>

<div class="max-tool"> 
<div class="thumbnail tool box-gradient">
	<?php
	$min_date=$this->session->userdata("min_date","");
	if($posted=="")$posted=0;
	echo link_button('Save', 'save_retur()','save');		
	echo link_button('Print', 'print_retur()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/purchase_retur/add');		
	echo link_button('Delete','','cut','false',base_url().'index.php/purchase_retur/delete/'.$purchase_order_number);		
	echo link_button('Search','','search','false',base_url().'index.php/purchase_retur');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/purchase_retur/view/'.$purchase_order_number);		

	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/purchase_retur/unposting/'.$purchase_order_number);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/purchase_retur/posting/'.$purchase_order_number);		
	}
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'purchase_retur\')','help');		
    echo link_button('Close','remove_tab_parent()','cancel');      
	
	?>

	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('purchase_retur')">Help</div>
		<div onclick="show_syslog('purchase_retur','<?=$purchase_order_number?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	</div>
</div>
<div class="thumbnail">

<?php if (validation_errors()) { ?>
	<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<h4>Terjadi Kesalahan!</h4> 
	<?php echo validation_errors(); ?>
	</div>
<?php } ?>
 <?php if($message!="") { ?>
<div class="alert alert-success"><? echo $message;?></div>
<? } ?>

	
<form id='frmRetur' method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<table class="table3" width="100%">
	<tr>
		<td>Nomor Retur</td><td class='field'>
			<?="<input type='text' id='purchase_order_number' name='purchase_order_number' value='$purchase_order_number'>"?>
		</td>
		<td rowspan='3' colspan=2><div id='supplier_name' class='thumbnail' style='height:100px;width:300px;'><?=$supplier_info?></div></td>

    </tr>	 
    <tr>		
        <td>Tanggal</td><td class='field'><?php echo form_input('po_date',$po_date,'id=po_date
           class="easyui-datetimebox"
			data-options="formatter:format_date,parser:parse_date"
			');?></td>
    </tr>	 
    <tr>
    <td>Supplier</td><td   class='field'>
 	   		<?
 	   		echo form_input("supplier_number",$supplier_number,"id='supplier_number'");      	
			echo link_button('','dlgsuppliers_show()',"search","false"); 
			?>
			
			
        </td>
        
    </tr>
    <tr>
        <td>Nomor Faktur</td><td class='field'> 
        	<?
        	echo form_input("po_ref",$po_ref,"id='po_ref'");
        	echo link_button('','select_faktur();return false;',"search","false"); 
        	?>
        </td>
    </tr>
	<tr>
		<td>Gudang:</td><td><?php echo form_input('warehouse_code',$warehouse_code,"id='warehouse_code'");
            echo link_button('','dlgwarehouse_show();',"search","false"); 
			?>
		</td>
        <td>Sistim</td><td class='field'> 
            <?
            echo form_input("type_of_invoice",$type_of_invoice,"id='type_of_invoice'");
            echo link_button('','dlgtype_of_invoice_show();return false;',"search","false"); 
            ?>
        </td>
	</tr>
    <tr>
        <td>Keterangan</td><td colspan="3" class='field'>
        	<?php echo form_input('comments',$comments,'id=comments style="width:400px;height:50px"');?>
        </td>
    </tr>	  
	<tr>
		<td></td>
	</tr>
</table>
            <div id='divTotal'> 
                <table class="table" width="100%">
                    <tr>
                        <td>Sub Total: </td><td><input name='sub_total' id='sub_total' value='<?=$subtotal?>' style='width:100px'></td>              
                        <td>Discount %: </td><td><input name='discount' id='disc_total_percent' value='<?=$discount?>' style='width:50px'></td>
                        <td>Pajak PPN %: </td><td>
                            <input name='tax' id='po_tax_percent' value='<?=$tax?>' style='width:50px'>
                            <input name='tax_amount' id='po_tax_amount' value='<?=$tax_amount?>' style='width:100px'>
                        </td>
                    </tr>
                    <tr>
                        <td>Ongkos Angkut: </td><td><input name='freight' id='freight' value='<?=$freight?>' style='width:80px'></td>
                        <td>Biaya Lain: </td><td><input name='other' id='others' value='<?=$other?>' style='width:80px'></td>
                        <td>JUMLAH: </td><td><input name='amount' id='total' value='<?=$amount?>' style='width:100px'>
                             <a id='divHitung' href="#" class="easyui-linkbutton" data-options="iconCls:'icon-sum'"  
                               plain='false' title='Hitung ulang' onclick='hitung_jumlah()'></a>                     
                        </td>
                    </tr>
                </table>        
            </div>

</form>
  

<!-- PURCASE_ORDER_LINEITEMS -->	
<div class="easyui-tabs">
	<div title="Items" style="padding:5px">
			<div id='dgItem'>
				<?php include_once "purchase_order_items.php"; ?>
			</div>
			<table id="dg" class="easyui-datagrid"  width="100%"
				data-options="
					iconCls: 'icon-edit', fitColumns: true, 
					singleSelect: true,
					toolbar: '#tb',
					url: '<?=base_url()?>index.php/purchase_order/items/<?=$purchase_order_number?>/json'
				">
				<thead>
					<tr>
						<th data-options="field:'item_number',width:80">Kode Barang</th>
						<th data-options="field:'description',width:150">Nama Barang</th>
                        <th data-options="<?=col_number('quantity',2)?>">Qty</th>
						<th data-options="field:'unit',width:50,align:'left',editor:'text'">Satuan</th>
                        <th data-options="<?=col_number('price',2)?>">Harga</th>
						<th data-options="field:'discount',width:50,editor:'numberbox'">Disc%</th>
                        <th data-options="<?=col_number('total_price',2)?>">Jumlah</th>
						<th data-options="field:'line_number',width:30,align:'right'">Line</th>
					</tr>
				</thead>
			</table>
		<!-- END PURCHASE_ORDER_LINEITEMS -->
	</div>
	<!-- JURNAL -->
	<div title="Jurnal" style="padding:5px">
		<DIV title="Jurnal" style="padding:10px">
			<table id="dgCrdb" class="easyui-datagrid" width="100%" 
				data-options="
					iconCls: 'icon-edit', fitColumns: true, 
					singleSelect: true,toolbar:'#tbCrdb',
					url: '<?=base_url()?>index.php/jurnal/items/<?=$purchase_order_number?>'
				">
				<thead>
					<tr>
						<th data-options="field:'account',width:80">Akun</th>
						<th data-options="field:'account_description',width:150">Nama Akun</th>
						<th data-options="field:'debit',width:80,align:'right'">Debit</th>
						<th data-options="field:'credit',width:80,align:'right'">Credit</th>
						<th data-options="field:'custsuppbank',width:50">Ref</th>
						<th data-options="field:'operation',width:50">Operasi</th>
						<th data-options="field:'source',width:50">Keterangan</th>
						<th data-options="field:'transaction_id',width:50">Id</th>
					</tr>
				</thead>
			</table>
		</DIV>
	
	</div>
	

</div>

<script type="text/javascript">
	var url;	
	var posted=<?=$posted?>;
	var closed=<?=$closed?>;
	
    function save_retur(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#po_date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#purchase_order_number').val()==''){alert('Isi nomor bukti retur !');return false;}
        if($('#supplier_number').val()==''){alert('Pilih kode supplier !');return false;}
        if($('#terms').val()==''){alert('Pilih termin !');return false;}        
		url='<?=base_url()?>index.php/purchase_retur/save';
			$('#frmRetur').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#divItem').show('slow');
						$('#purchase_order_number').val(result.purchase_order_number);
						var nomor=$('#purchase_order_number').val();
						$('#mode').val('view');

						$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+nomor+'/json'});
						$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
		function hitung_jumlah(){
		    url=CI_ROOT+'purchase_order/sub_total/'+$('#purchase_order_number').val();
		    if($('#disc_total_percent').val()=='')$('#disc_total_percent').val(0);
		    if($('#po_tax_percent').val()=='')$('#po_tax_percent').val(0);
		    if($('#freight').val()=='')$('#freight').val(0);
		    if($('#others').val()=='')$('#others').val(0);
		    $.ajax({
                type: "GET",
                url: url,
				contentType: 'application/json; charset=utf-8',
                data:{discount:$("#disc_total_percent").val(),tax:$("#po_tax_percent").val(),
                others:$("#others").val(),freight:$("#freight").val()}, 
                success: function(msg){
                    var obj=jQuery.parseJSON(msg);
                    $('#sub_total').val(obj.sub_total);
                    $('#total').val(obj.amount);
                },
                error: function(msg){alert(msg);}
		    });			
		}
		function print_retur(){
			nomor=$("#purchase_order_number").val();
			url="<?=base_url()?>index.php/purchase_retur/print_retur/"+nomor;
			window.open(url,'_blank');
		}
		function add_item_retur_toko(nomor){
            var nomor_retur=$("#purchase_order_number").val();
		    if(nomor==''){
		        alert('Pilih nomor retur toko !');
		        return false;
		    }
            $.ajax({
                type: "GET", url: CI_ROOT+"purchase_retur/add_item_retur/"+nomor+"/"+nomor_retur,
                success: function(result){
                    var result = eval('('+result+')');
                    if(result.success){
                        $.messager.show({
                            title:'Success',msg:result.msg
                        }); 
                        reloadItem();
                    } else {
                        $.messager.show({
                            title:'Error',msg:result.msg
                        });                         
                    };
                },
                error: function(msg){alert("Unknown Error");}
            });         
		    
		}

</script>

