 
<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_kontra_bon()','save');		
	echo link_button('Print', 'print_faktur()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/po/kontra_bon/add');		
	echo link_button('Search','','search','false',base_url().'index.php/po/kontra_bon');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/po/kontra_bon/view/'.$nomor);		
	echo link_button('Delete', 'delete_nomor()','cut');
?>
	<div style="float:right"> 
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('purchase_kotra_bon')">Help</div>
		<div onclick="show_syslog('purchase_kotra_bon','<?=$nomor?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');  ?>    

	</div>
</div>

	<form id='frmPo' method="post">
	<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	<table class="table" width="100%">
		<tr>
			<td>Nomor Kontra Bon</td><td width=300>
				<?php echo form_input('nomor',$nomor,"id=nomor"); ?>
			</td>
			<td rowspan='3' colspan='2'>
			    <div class='thumbnail' id='supplier_name' 
			    style='min-height:100px'>Nama Supplier : 
			    <br><?=$supplier_info?>
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
            <td>Supplier</td><td><?php 
            
            echo form_input('supplier_number',$supplier_number,
            "id=supplier_number  
            class='easyui-validatebox' data-options='required:true,
			validType:length[3,30]'");
			echo link_button('','dlgsuppliers_show()',"search","false"); 			   
			?>
            </td>
            
        </tr>	 
       <tr>
            <td>Termin</td><td><?php echo form_dropdown('termin'
                    ,$terms_list,$termin,"id=termin");?>
            </td>

             <td>Tanggal Jth Tempo</td>
            <td><?=form_input('tgl_jth_tempo',$tgl_jth_tempo,
			'id=tgl_jth_tempo  class="easyui-datetimebox" 
			data-options="formatter:format_date,parser:parse_date"
			required');?></td>
       </tr>
       
        <tr>
            <td>Total Amount</td><td>
                <?php echo form_input('amount',$amount,"id=amount"); ?>
            </td>
            <td> </td>              
        </tr>    
       
       <tr>
            <td>Keterangan</td><td colspan="3"><?php echo form_input('catatan'
                    ,$catatan,'id=comments style="width:300px"');?></td>
       </tr>	  
	   
   </table>



	</form>

<div class="easyui-tabs" >
	<div title="Faktur" style="padding:5px">
		<!-- LINEITEMS -->	
		<div id='divItem'>
		<div id='dgItem'>
			<?php include_once "kontra_bon_items.php"; ?>
		</div>
		<table id="dg" class="easyui-datagrid table"  width="100%"
			data-options="
				iconCls: 'icon-edit',fitColumns:true,
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/po/kontra_bon/items/<?=$nomor?>'
			">
			<thead>
				<tr>
					<th data-options="field:'faktur',width:80">Faktur</th>
					<th data-options="field:'tanggal',width:80">Tanggal</th>
                    <th data-options="<?=col_number('jumlah',2)?>">Jumlah</th>
                    <th data-options="<?=col_number('saldo',2)?>">Saldo</th>
					<th data-options="field:'id',width:30,align:'right'">Id</th>
				</tr>
			</thead>
		</table>
	<!-- END LINEITEMS -->
	</div>		
	</div>

</div>	
	
	
<?=$lookup_suppliers?>
<?=$lookup_receive?>

<script type="text/javascript">
	var url;	
    function save_kontra_bon(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#tanggal').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#nomor').val()==''){alert('Isi nomor kontra bon !');return false;}
        if($('#supplier_number').val()==''){alert('Pilih kode supplier !');return false;}
        if($('#termin').val()==''){alert('Pilih termin !');return false;}        
		url='<?=base_url()?>index.php/po/kontra_bon/save';

			$('#frmPo').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#divItem').show('slow');
						$('#nomor').val(result.nomor);
						var nomor=$('#nomor').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/po/kontra_bon/items/'+nomor+'/json'});
						$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }		
	function print_faktur(){
		nomor=$("#nomor").val();
		url="<?=base_url()?>index.php/po/kontra_bon/print_faktur/"+nomor;
		window.open(url,'_blank');
	}
	function delete_nomor()
	{

		if(closed){alert("Periode sudah ditutup tidak bisa dihapus !");	return false;}

		$.ajax({
				type: "GET",
				url: "<?=base_url()?>/index.php/po/kontra_bon/delete/"+$('#nomor').val(),
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						window.open('<?=base_url()?>index.php/po/kontra_bon','_self');
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}		
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/purchase_invoice");
	}
	function selected_supplier(){
        var row = $('#dgSelectSupp').datagrid('getSelected');
        if (row){
            $('#supplier_number').val(row.supplier_number);
            $('#supplier_name').html(row.supplier_name);
            $('#dlgSelectSupp').dialog('close');
            supplier_info();
        } else {
            alert("Pilih salah satu nomor supplier !");
        }
    }   
	function supplier_info(){	   
	    
        $.ajax({
                type: "GET",
                url: "<?=base_url()?>/index.php/po/kontra_bon/supplier_info/"+$('#supplier_number').val(),
                data: "",
                success: function(result){
                    $("#supplier_name").html(result);
                },
                error: function(msg){alert(msg);}
        });                 
	    
	}
</script>
    
