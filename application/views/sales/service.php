<?php echo load_view("aed_button",
	array("extra_button"=>link_button("Buat Tagihan", "create_faktur();return false;","save"))); 
	if(isset($message)){
		$msg="";
		if(is_array($message)){
			for($i=0;$i<count($message);$i++){
				$msg=$message[$i]."</br>";
			}
		} else {
			$msg=$message;
		}
		
		echo "<div class='alert alert-warning'>$msg</div>";
	}
?>

<form id='frmMain' method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table">
		<tr>
			<td>Nomor Service</td><td>
				<?php echo form_input('no_bukti',$no_bukti,"id='no_bukti'"); ?>
			</td>
			<td rowspan='3' >
			    <div class='thumbnail' id='customer_info' 
			    style='min-height:100px'>Nama Pelanggan : 
			    <br><?=$customer_info?>
			    </div>
		  </td>				
        </tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('tanggal',$tanggal,'id=tanggal   
			class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required');?>
            </td>
        </tr>	 
       <tr>
            <td>Customer</td><td><?php             
            echo form_input('customer',$customer,
            "id=customer_number  
            class='easyui-validatebox' data-options='required:true,
			validType:length[3,30]'");
			echo link_button('','dlgcustomers_show()',"search","false"); 			   
			?>
            </td>
            
        </tr>	 
       <tr>
             <td>Jumlah</td>
            <td><?=form_input('service_amt',$service_amt);?></td>
            <td>Jenis Masalah</td>
            <td>
            	<?=form_input("jenis_masalah",$jenis_masalah,"id='jenis_masalah'")?>
            	<?=link_button("", "dlgjenis_masalah_service_show()","search")?>
            	<?=link_button("", "dlgjenis_masalah_service_list('jenis_masalah_service')","add")?>
            </td>
       </tr>
       
        <tr>
            <td>Teknisi</td><td>
                <?php echo form_input('serv_rep',$serv_rep,"id=serv_rep"); ?>
            </td>
            <td>Transportasi</td><td><?=form_input("transportasi",$transportasi)?></td>
        </tr>    
        <tr>
            <td>Mesin / Item</td><td>
                <?php echo form_input('serial',$serial,"id=serial"); 
                	echo link_button("", "dlginventory_show()","search");
                
                ?>
            </td>
        </tr>    
       
       <tr>
            <td>Masalah</td><td colspan="3">
            	<?php echo form_input('masalah',$masalah,'id=masalah style="width:600px"');?></td>
       </tr>	  
       <tr>
            <td>Catatan</td><td colspan="3">
            	<?php echo form_input('comments',$comments,'id=comments style="width:600px"');?></td>
       </tr>	  
	   
   </table>
</form>

<div class="easyui-tabs" >
	<div title="General" style="padding:5px">
	</div>
</div>	
	
	
<?php 
echo $lookup_customer;
echo $lookup_jenis_masalah;
echo $lookup_item_service;

?>

<script type="text/javascript">
	var url;	
    function save_aed(){
        if($('#no_bukti').val()==''){log_err('Isi nomor service !');return false;}
        if($('#customer').val()==''){log_err('Pilih kode pelanggan !');return false;}

		var url='<?=base_url()?>index.php/so/service/save';

		$('#frmMain').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#no_bukti').val(result.no_bukti);
					$('#mode').val('view');
					log_msg('Data sudah tersimpan.');
				} else {
					log_err(result.msg);
				}
			}
		});
    }		
	function print_aed(){
		nomor=$("#no_bukti").val();
		url="<?=base_url()?>index.php/so/service/print_bukti/"+nomor;
		window.open(url,'_blank');
	}
	function delete_aed()
	{
        var nomor=$("#no_bukti").val();
        if(nomor==""){
            log_err("Nomor tidak dikenal !");return false
        }
        $.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
            if(!r){
                $.ajax({
                        type: "GET",
                        url: "<?=base_url()?>/index.php/so/service/delete/"+nomor,
                        data: "",
                        success: function(result){
                            var result = eval('('+result+')');
                            if(result.success){
                                log_msg("Success");
                                remove_tab_parent();
                            } else {
                                log_err(result.msg);
                            };
                        },
                        error: function(msg){log_err(msg);}
                });                 
                
            }            
        });
        
	}		
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/sales_service_order");
	}
	function create_faktur(){
		var nomor=$("#no_bukti").val();
		if(nomor=="" || nomor=="AUTO"){
			log_err("Simpan dulu !");return false;
		}
		var url=CI_ROOT+"so/service/create_invoice/"+nomor;
		add_tab_parent("NewInvoice",url);
	}
	function refresh_aed(){
		var nomor=$("#no_bukti").val();
		if(nomor=="AUTO" || nomor==""){
			log_err("Simpan dulu nomor ini !");return false;
		}
		var url=CI_ROOT+"so/service/view/"+nomor
		window.open(url,"_self");
	}
</script>
    
