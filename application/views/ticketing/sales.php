<script type="text/javascript" charset="utf-8" src="<?=base_url('assets/printThis-master/printThis.js')?> "></script>

<div class="thumbnail box-gradient" id='aed_button'>
	<?php echo load_view("aed_button.php",array("show_posting"=>true,"posted"=>$posted));?>
</div>
<div class="thumbnail">	
<form id="myform"  method="post" role="form">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<input type='hidden' name='id' id='id'	value='<?=$id?>'>

<?php 
$msg=validation_errors();
if($msg!="") echo "<div class='alert alert-info'>".validation_errors()."</div>"; 
$readonly="";

?>
<div class="easyui-tabs">
	<div title="General" style="padding:10px">
		<table class="table2" width="100%">
    <tr>
    	<td>Bayar Pakai </td>
        <td colspan=5>
            <?=form_radio('how_paid',0,$how_paid=='CASH'||$how_paid=='0'?TRUE:FALSE,"style='width:30px'   onclick='how_paid_click(0)' id='how_paid_cash' ");?>CASH 
            <?=form_radio('how_paid',1,$how_paid=='CARD'||$how_paid=='1'?TRUE:FALSE,"style='width:30px' onclick='how_paid_click(1)' id='how_paid_card' ");?>CARD

		
		<span id='divEdc' style="display:none">
			Mesin EDC / Rek Bank# : <?=form_dropdown("edc",$list_rekening,$edc," id='edc' style='width:300px' ")?>
			</span>           
			
		
        </td>        
  	</tr>
    <tr>
         <td>Jenis Ticket</td>
         <td ><?php echo form_input('ticket_type',$ticket_type,'id=ticket_type onblur="calc_amount()" ' );?>
             <?=link_button("", "dlgticket_type_show()","search","false","","Cari")?>
             <?=link_button("", "ticket_type_add();return false;","add")?>
	     </td>
	     <td>Harga Ticket: </td><td><?php echo form_input('price',$price,
	         "id=price  onblur='calc_amount();return false;'");?>
         </td>
    </tr>
  	<tr>
  		<td>Kode Member</td>
         <td colspan=3><?=form_input('cust_no',$cust_no,'id=cust_no');?>
             <?=link_button("", "dlgcustomers_show()","search","false","","Cari")?>
            </br>
         	<?=form_input('cust_name',$cust_name,'style="width:250px" id=company readonly');?>
             
         </td>
  		
  	</tr>
	<tr>
         <td>Jumlah Ticket</td><td colspan=6><?=form_input('qty_ticket',$qty_ticket,
         "id='qty_ticket' onblur='calc_amount();return false;' ");?></td>
  	</tr>
  	<tr>
         <td>Jumlah Kartu</td><td><?php echo form_input('qty_card',$qty_card,"id=qty_card");?>
		 </td>
    </tr>
    <tr>
         <td>Disc %</td><td><?php echo form_input('disc_prc',$disc_prc, "id = disc_prc onblur='calc_amount()' ");?>
         </td><td>Disc Amount: </td><td><?php echo form_input('disc_amt',$disc_amt, "id = disc_amt");?>
         </td>
  	</tr>
	<tr>
     	<td>Netto</td><td><?php echo form_input('netto',$netto,"id=netto");?></td>
     	<td>Jml Bayar</td><td><?php echo form_input('bayar',$bayar,"id=bayar onblur='calc_amount()'");?></td>
     	
   </tr>
   <tr>
     <td>Kelompok Ticket</td><td><?php echo form_dropdown('how_type',
     	array("Perorangan","Rombongan"),$how_type,"id=how_type");?>
	 </td>
     	<td>Jml Kembali</td><td><?php echo form_input('kembali',$kembali,"id=kembali ");?></td>
   </tr>
   <tr>
     	<td>Tanggal</td><td><?         
         echo form_input('tanggal',$tanggal,' id="tanggal" class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required style="width:200px" ');                 
         ?>
         </td>
   </tr>
      </table>
 </div> <!-- GENERAL TAB -->
	<div title="Jurnal" style="padding:10px">
	<?php 
		$glid="TKT".$id;
		echo load_view("gl/jurnal_view",array("gl_id"=>$glid));
	?>
	</div>
	

</form>


    
</div>   
 
<?=$lookup_customer?>
<?=$lookup_ticket_type?>


<div id='dlgNotaPrint'  class="easyui-dialog"  closed="true"  buttons="#btnPrint"
	 style="width:500px;height:400px;padding:5px 5px;left:100px;top:20px">
    <div id='divNotaPrint' style="padding:10px; font-family: 'Arial';"></div>	 
</div>
<div id="btnPrint">
	<?=link_button("Close","print_close()","cancel","false");?>
	<?=link_button("Cetak","print_nota()","print","false");?>
</div>

<script>

			 
	function  add_region(){
		var url=CI_ROOT+"region/browse";
		add_tab_parent("Region",url);
	}  
	function  add_country(){
		var url=CI_ROOT+"country/browse";
		add_tab_parent("Country",url);
	}  
	function  add_cust_type(){
		var url=CI_ROOT+"customer_type/browse";
		add_tab_parent("Customer Type",url);
	}  
	function  add_salesman(){
		var url=CI_ROOT+"salesman/browse";
		add_tab_parent("Salesman",url);
	}  
	function  add_payment(){
		var url=CI_ROOT+"type_of_payment/browse";
		add_tab_parent("Termin",url);
	}  
	function  add_coa(){
		var url=CI_ROOT+"coa/browse";
		add_tab_parent("Coa",url);
	}  
	function add_city(){
		var url=CI_ROOT+"city/browse";
		add_tab_parent("City",url)
	}
	function refresh_aed(){
		var id=$("#id").val();
		var url=CI_ROOT+"ticketing/sales/view/"+id;
		window.open(url,"_self");
	}
	function save_aed(){
		save();
	}
  	function save(){
  		if($('#cust_no').val()==''){log_err('Isi kode pelanggan !');return false;}
  		if($("#price").val()=="" || $("#price").val()=="0" || $("#qty_ticket").val()=="" || $("#qty_ticket").val()=="0"){
  			log_err("Isi harga ticket atau qty ticket");return false;
  		}
		

  		var how_paid_card=$("input[name='how_paid']:checked").val();
  		
  		
  		if (how_paid_card == "1"){
  			if ($("#edc").val()==""){
  				log_err("Pilih rekening bank EDC !");
  				return false;
  			}
  		}
		calc_amount();
		$("#aed_button_save").linkbutton('disable');
		
		url='<?=base_url()?>index.php/ticketing/sales/save';
			$('#myform').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#mode").val("view");
						$("#id").val(result.id);
						log_err('Data sudah tersimpan.');
						print_aed();												
					} else {
						log_err(result.msg);
					}
				}
			});
  	}	
  	function calc_amount(){
  		var qty=c_($("#qty_ticket").val());
  		var price=c_($("#price").val());
  		var gross=qty*price;
  		var disc_prc=c_($("#disc_prc").val());
  		if(disc_prc>1){
  			disc_prc=disc_prc/100;
  			$("disc_prc").val(disc_prc);
  		}
  		var disc_amt=disc_prc*gross;
  		$("#disc_amt").val(gross*disc_prc);
  		console.log(disc_amt);
  		
  		var nett=gross-disc_amt;
  		$("#netto").val(nett);
  		
  		var bayar=c_($("#bayar").val());
  		if(bayar>0){
  			var kembali=bayar-nett;
  			$("#kembali").val(kembali);
  		}
  		
  	}
  	function delete_aed(){
  		var id=$("#id").val();
  		if(id!="" || id!="0"){
				$.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
					if(!r)return false;
	                xurl_delete=CI_ROOT+'ticketing/sales/delete/'+id;                             
	                xparam='';
	                loading();
	                $.ajax({
	                        type: "GET",
	                        url: xurl_delete,
	                        param: xparam,
	                        success: function(result){
							try {
									var result = eval('('+result+')');
									if(result.success){
										loading_close();
										$.messager.show({
											title:'Success',msg:result.msg
										});
										log_msg(result.msg);
										remove_tab_parent();
									} else {
										loading_close();
										$.messager.show({
											title:'Error',msg:result.msg
										});
										log_err(result.msg);
									};
								} catch (exception) {		
								}
	                        },
	                        error: function(msg){log_err("Error");
	                        	$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
	                });         
  			})
  		}
  	}
  	function print_aed(){
  		var id=$("#id").val();
		loading();
		$("#divNotaPrint").html("");
		
		$.ajax({type: "GET",url: CI_ROOT+"ticketing/sales/print_nota/"+id,
			success: function(result){
				$("#divNotaPrint").html(result);
	  			$('#dlgNotaPrint').dialog({modal: true}).dialog('open').dialog('setTitle','Print Dialog');
				
				loading_close();
			},
			error: function(result){
				loading_close();
				log_err(result);
				return false;
			}			
		}); 				
  		
  	}
  	function print_nota(){
		$("#divNotaPrint").printThis();
		$("#dlgNotaPrint").dialog("close");  		
  	}
  	function print_close(){
		$("#dlgNotaPrint").dialog("close");  		  		
  	}
  	function how_paid_click(no){
  		if(no==0){
  			$("#divEdc").hide();
  	
  		} else {
  			$("#divEdc").show();
  		}
  	}
  	function posting_aed(){
  		var id=$("#id").val();
  		if (id=="" || id=="AUTO"){
  			log_err("Simpan dulu nomor"); return false;
  		}
  		var url=CI_ROOT+"ticketing/sales/posting/"+id;
  		window.open(url,"_self");
  	}
  	function unposting_aed(){
  		var id=$("#id").val();
  		if (id=="" || id=="AUTO"){
  			log_err("Simpan dulu nomor"); return false;
  		}
  		var url=CI_ROOT+"ticketing/sales/unposting/"+id;
  		window.open(url,"_self");
  	}
  	function ticket_type_add(){
  		var url=CI_ROOT+"ticketing/ticket_type/add";
  		add_tab_parent("AddTicketType",url);
  	}
  	
</script>	
   