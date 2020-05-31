<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save();return false;','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/customer/view/'.$customer_number);		
	
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'customer\')','help');		
	
	?>
	
		<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help('customer')">Help</div>
			<div onclick="show_syslog('customers','<?=$customer_number?>')">Log Aktifitas</div>
			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
		<?=link_button('Close', 'remove_tab_parent();return false;','cancel')?>		
	
	</div>
</div>
<div class="thumbnail">	
<form id="myform"  method="post" role="form">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
<?php 
echo validation_errors(); 
$readonly="";
?>
<div class="easyui-tabs">
	<div title="General" style="padding:10px">
		<table class="table2" width="100%">
    <tr>
        <td>Kode</td> 
        <td><?php
            if($mode=='view'){
               $readonly=" readonly";
            }  
            echo form_input('customer_number',$customer_number,"id='customer_number' $readonly");
            ?>
        </td>
        <td colspan=2 width=100>
            Aktif <?=form_radio('active',1,$active=='1'?TRUE:FALSE,"style='width:30px'");?>Yes 
            <?php echo form_radio('active',0,$active=='0'?TRUE:FALSE,"style='width:30px'");?>No
            
        </td>
  </tr>
	   <tr>
         <td>Nama </td>       
         <td ><?=form_input('company',$company,'style="width:250px" id=company');?>
         </td>
	       
	   </tr>	    
       <tr>
         <td>Alamat</td>
         <td colspan="4"><?php echo form_input('street',
                        $street,'style="width:90%"');?></td>
       </tr>
	   <tr>
	     <td>&nbsp;</td>
	   
	     <td colspan="4"><?php echo form_input('suite',
                        $suite,'style="width:90%"');?></td>
       </tr>
	<tr><td>Kontak Person : </td><td colspan=3>
         	Mr/Mrs <?=form_input("salutation",$salutation,"style='width:40px'")
         	."First Name ".form_input("first_name",$first_name)
			."Midle Name ".form_input("middle_initial",$middle_initial,"style='width:50px'")
			."Last Name ".form_input("last_name",$last_name);?></td>
	</tr>
	<tr>
         <td>Email</td><td colspan=3><?=form_input('email',$email,'style="width:350px"');?></td>
  	</tr>
  	<tr>
         <td>Kota</td><td><?php echo form_input('city',$city,"id=city");?>
             <?=link_button("", "dlgcity_show()","search","false","","Cari kota")?>
             <?=link_button("", "add_city();return false;","add")?>
		 </td>
         <td>Kode Pos</td><td><?php echo form_input('zip_postal_code',$zip_postal_code);?></td>
       </tr>
       <tr>
         <td>Telphon</td>
         <td><?php echo form_input('phone',$phone);?></td>
         <td>Faximile</td>
         <td><?php echo form_input('fax',$fax);?></td>
  		</tr>
  		<tr>
         <td>Wilayah</td><td><?php echo form_input('region',$region,"id=region");?>
              <?=link_button("", "dlgregion_show()","search","false","","Cari wilayah")?>
             <?=link_button("", "add_region();return false;","add")?>

		 </td>
         <td>Negara</td><td><?php echo form_input('country',$country,"id=country");?>
             <?=link_button("", "dlgcountry_show()","search","false","","Cari negara")?>
             <?=link_button("", "add_country();return false;","add")?>
		 </td>
       </tr>

			<tr><td>Kelompok </td>
			 <td><?php echo form_input('customer_record_type',$customer_record_type,"id=customer_record_type");?>
                 <?=link_button("", "dlgcustomer_record_type_show()","search","false","","Cari kelompok customer")?>
                 <?=link_button("", "add_cust_type();return false","add")?>
			 </td>
             <td>Tanggal Tagih</td><td><?=form_input('tgl_tagih',$tgl_tagih);?></td>
			 
<!--			 <td>Sales Type/Price List</td><td><?=form_input('pricing_type',$pricing_type);?></td>
-->
			</tr>
			<tr><td>Salesman</td><td>
				<? echo form_input('salesman',$salesman,"id='salesman'");?>
                 <?=link_button("", "dlgsalesman_show()","search","false","","Cari salesman")?>
                 <?=link_button("", "add_salesman();return false;","add")?>
			</td>
			 <td>Termin Jual</td><td><?=form_input('payment_terms',$payment_terms,"id='payment_terms'");?>
                 <?=link_button("", "dlgpayment_terms_show()","search","false","","Cari termin")?>
                 <?=link_button("", "add_payment();return false;","add")?>
			 </td>
			 </tr>
		 <tr>
		     <td>Credit Limit</td><td><?=form_input('credit_limit',number_format($credit_limit,2));?></td>
			 <td>Credit Balance</td><td><?=form_input('credit_balance',number_format($credit_balance,2));?></td>
		   </tr>
		   <tr>
                <td>Current Balance</td><td><?=form_input('current_balance',number_format($current_balance,2));?></td>                
		   </tr>
	   
      </table>
      </div>
	<div title="Sales" style="padding:10px">
		<table class="table" width="100%">
		   <tr>
			<td>Discount % (1+2+3)</td><td>
			<?php
			echo form_input('discount_percent',$discount_percent,"style='width:50px'");
			echo "+".form_input('disc_prc_2',$disc_prc_2,"style='width:50px'");
			echo "+".form_input('disc_prc_3',$disc_prc_3,"style='width:50px'");
			
			?></td>
			<td>Mark Up %</td><td><?=form_input('markup_percent',$markup_percent);?></td>
		   </tr>
		   <tr>
			<td>Discount Amount</td><td><?=form_input('discount_amount',$discount_amount);?></td>
			<td>Mark Up Amount</td><td><?=form_input('markup_amount',$markup_amount);?></td>
		   </tr>
		   <tr>
			<td>Discount Qty Sold</td><td><?=form_input('disc_min_qty',$disc_min_qty);?></td>
			<td>Discount Category</td><td> 
             <?=link_button("", "dlgCustomerDisc()","add","false","","Cari discount")?>
    		</td>
		   </tr>
		   <tr>
			 <td>Akun Piutang </td>
			 <td colspan="6"><?=form_input('finance_charge_acct',$finance_charge_acct,"id='finance_charge_acct' style='width:300px'");?>
             <?=link_button("", "lookup_coa('finance_charge_acct')","search","false","","Cari kode perkiraan")?>
             <?=link_button("", "add_coa();return false;","add")?>
		   </tr>
		   <tr>
			<td>Catatan</td><td colspan='6'><?=form_input('comments',$comments,"style='width:300px'");?></td>
		   </tr>
		   <tr>
			<td>Kirim Via</td><td><?=form_input('shipped_via',$shipped_via);?></td>
			<td>NPWP</td><td><?=form_input('npwp',$npwp);?></td>
			</tr>       	
		</table>
	</div>

   </form>

<!-- SHIPTO -->
	<div title="Ship To" style="padding:10px">
		<table id="dgShipTo" class="easyui-datagrid" width="100%"
			data-options="iconCls: 'icon-edit',singleSelect: true,fitColumns: true, width: '100%',toolbar: '#tbShipTo',
				url: '<?=base_url()?>index.php/customer/list_shipto/<?=$customer_number?>'">
			<thead>
				<tr>
					<th data-options="field:'location_code', width:'80'">Kode</th>
					<th data-options="field:'alamat', width:'200'">Alamat</th>
					<th data-options="field:'kota', width:'80'">Kota</th>
					<th data-options="field:'kode_pos', width:'80'">Kode Pos</th>
					<th data-options="field:'telp', width:'80'">Telp</th>
					<th data-options="field:'fax', width:'80'">Fax</th>
					<th data-options="field:'contact', width:'80'">Kontak</th>
					<th data-options="field:'id',align:'right', width:'80'">Line</th>
				</tr>
			</thead>
		</table>
	</div>
<!-- CARDS -->				
	<div title="Cards" style="padding:10px">
		<div class='thumbnail'>
			<form method="post">
			<table class='table2' width='100%'>
			<tr><td>Date From</td>
			<td><?=form_input('date_from',date("Y-m-d"),'id=date_from 
			class="easyui-datetimebox" style="width:150px"
            data-options="formatter:format_date,parser:parse_date"');?></td>
			<td>Date To</td>
			<td><?=form_input('date_to',date("Y-m-d 23:59:59"),'id=date_to  
			class="easyui-datetimebox" style="width:150px"
            data-options="formatter:format_date,parser:parse_date"');?></td>
			<td><?=link_button('Search','search_cards()','search');?></td>
			</tr>
			</table>
			</form>
		</div>
		<table id="dgCard" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit',fitColumns: true, 
				singleSelect: true,  width: '100%',
				url: '',toolbar:'',
			">
			<thead>
				<tr>
					<th data-options="field:'no_bukti',width:100">Nomor</th>
					<th data-options="field:'tanggal',width:80">Tanggal</th>
					<th data-options="field:'jenis',width:80,align:'left',editor:'text'">Jenis</th>
					<th data-options="field:'jumlah',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Jumlah</th>
					<th data-options="field:'saldo',width:80,align:'right',editor:{type:'numberbox',options:{precision:2}}">Saldo</th>
				</tr>
			</thead>
		</table>
		
	</div>

    
</div>   

 
<div id="tbShipTo" class='box-gradient'>
	<?=link_button('Add','add_shipto()','add')?>
	<?=link_button('Edit','edit_shipto()','edit')?>
	<?=link_button('Delete','del_shipto()','remove')?>
</div>

<?=load_view('gl/select_coa_link')?> 
  
 
<?=$lookup_country?>
<?=$lookup_city?>
<?=$lookup_salesman?>  	
<?=$lookup_termin?>  	
<?=$lookup_region?>  	
<?=$lookup_cust_type?>  	

<div id='divShipTo'class="easyui-dialog"   
	closed="true" buttons="#divShipToButtons" style=";left:100px;top:20px">
	<form id='frmShipTo' method='post'><table class='table2' width='100%'>
		<tr><td>Location Code</td><td><input type='text' name='location_code' id='location_code'></td></tr>
		<tr><td>Alamat</td><td><input type='text' name='alamat' style="width:300px"></td></tr>
		<tr><td>Kota</td><td><input type='text' name='kota'></td></tr>
		<tr><td>Kode Pos</td><td><input type='text' name='kode_pos'></td></tr>
		<tr><td>Telp</td><td><input type='text' name='telp'></td></tr>
		<tr><td>Fax</td><td><input type='text' name='fax'></td></tr>
		<tr><td>Kontak</td><td><input type='text' name='contact'></td></tr>
	</form></table>
</div>
<div id="divShipToButtons" class='box-gradientx'>
	<?=link_button('Save','add_shipto_save()','save')?>
	<?=link_button('Close','add_shipto_close()','back')?>
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
	function add_shipto(){
		$('#divShipTo').dialog('open').dialog('setTitle','Tambah Ship To');
	}
	function add_shipto_close(){
		$('#divShipTo').dialog('close');
	}
	function add_shipto_save(){
  		if($('#customer_number').val()==''){alert('Isi kode pelanggan !');return false;}
  		url='<?=base_url()?>index.php/customer/shipto_add/<?=$customer_number?>';
  		$("#frmShipTo").form('submit',{
  			url:url,
  			onSubmit:function(){return $(this).form('validate');},
  			success:function(result){
  				var result=eval('('+result+')');
		  		if(result.success){
		  			add_shipto_close();
		  			$('#dgShipTo').datagrid('reload'); 
		  		} else {$.messager.show({title:'Error',msg:result.msg});}
	  		}
  		});	
	}
	function del_shipto(){
			var row = $('#dgShipTo').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if (r){
						url='<?=base_url()?>index.php/customer/shipto_del';
						$.post(url,{line_number:row.id},function(result){
							if (result.success){
								$('#dgShipTo').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
	}
  	function save(){
  		if($('#customer_number').val()==''){alert('Isi kode pelanggan !');return false;}
  		if($('#company').val()==''){alert('Isi nama pelanggan !');return false;}
  		if($('#salesman').val()==''){alert('Isi nama salesman !');return false;}
		url='<?=base_url()?>index.php/customer/save';
			$('#myform').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$("#mode").val("view");
						log_msg('Data sudah tersimpan.');
						remmove_tab_parent();
					} else {
						log_err(result.msg);
					}
				}
			});
  	}	
	function search_cards()
	{
	    var cust=$("#customer_number").val();
		var d1=$("#date_from").datebox('getValue');
		var d2=$("#date_to").datebox('getValue');
	 
		var xurl='<?=base_url()?>index.php/customer/kartu_piutang/'+cust+'?d1='+d1+'&d2='+d2;
		console.log(xurl);
		$('#dgCard').datagrid({url:xurl});
		$('#dgCard').datagrid('reload');
	}
	function dlgCustomerDisc(){
		var cust_no='<?=$customer_number?>';
		if(cust_no==""){alert("Kode customer belum dipilih !");return false;}
		var url=CI_BASE+"index.php/category/discount/show/"+cust_no;
		add_tab_parent("disc_cat_"+cust_no,url);
	}
</script>	
   