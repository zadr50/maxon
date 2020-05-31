	<div class="thumbnail box-gradient">
	<?php
   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_db_memo()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Delete','delete_memo()','cut');		
	if($posted) {
		echo link_button('UnPosting','','cut','false',base_url().'index.php/sales_crmemo/unposting/'.$kodecrdb);		
	} else {
		echo link_button('Posting','','ok','false',base_url().'index.php/sales_crmemo/posting/'.$kodecrdb);		
	}
    echo "<div style='float:right'>";
		echo link_button('Help', 'load_help(\'sales_crmemo\')','help');		
		?>
		<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help('sales_crmemo')">Help</div>
			<div onclick="show_syslog('crdb','<?=$kodecrdb?>')">Log Aktifitas</div>
			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
		<?=link_button('Close', 'remove_tab_parent()','cancel')?>		
		
	</div>
</div> 
<div class="thumbnail">		
<form id="frmCrDb"  method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>	
<input type='hidden' name='trans_type' id='trans_type'	value='Sales'>	
   <table class='table2' width='100%'>
		<tr>
		<td>Nomor Bukti</td>
			<td>
				<?php echo form_input('kodecrdb',$kodecrdb,"id=kodecrdb"); ?>
            </td>
			<td rowspan='2'>
				<div id='customer_info' class='thumbnail' style='height:50px;width:300px'>
					Customer Name.<?=$customer_info?>
				</div>
			</td>
			
        </tr>	 
        <tr>
            <td>Tanggal</td><td><?php echo form_input('tanggal',$tanggal,'id=tanggal 
             class="easyui-datetimebox" required style="width:150px"
			data-options="formatter:format_date,parser:parse_date"
			');?>
            </td>
        </tr>
       <tr>
            <td>Pelanggan</td>
            <td><?=form_input('customer_number',$customer_number,'id="customer_number"');?>
            	<?=link_button("",'dlgcustomers_show();return false;','search','false')?>
            </td>
			<td rowspan="3">
				<div id='faktur_info' name='faktur_info' class='thumbnail' style='height:50px;width:300px'>
					Nomor Faktur.<?=$faktur_info?>
				</div>
			</td>
			
       </tr>
       <tr>
            <td>Faktur</td>
            <td><?=form_input('docnumber',$docnumber,'id="docnumber"');?>
            	<?=link_button("",'select_faktur()','search','false')?>
            </td>
       </tr>
       <tr>
       		<td>Jumlah: </td>
       		<td><?php echo form_input('amount',$amount,'id=amount');?></td>
      </tr>
       <tr>
            <td>Keterangan</td>
            <td colspan="6">
            	<?php echo form_input('keterangan',$keterangan,'id=keterangan style="width:300px"');?>
            </td>
       </tr>
       <tr><td colspan="4">
       <input type='hidden' id='transtype' name='transtype' value='SO-CREDIT MEMO'>
       </td></tr>
   </table>
</form>
<div class="easyui-tabs"  >
	<div id="divItem" title="Kode Perkiraan" style="padding:10px">
		<div id='dgItem'>
			<table class='table2' width='100%'>
				<tr>
					<td>Kode Akun</td><td>Nama Akun</td><td>Jumlah</td><td>
				</tr>
				<tr>
					<form id="frmItem" method='post' >
						 <td><input id="account" style='width:80px' 
							name="account"   class="easyui-validatebox" required="true">
							<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
							onclick="lookup_coa();return false;	"></a>
						 </td>
						 <td><input id="description" name="description" style='width:280px'></td>
						<td><input id="amount" name="amount"  style='width:80px'  class="easyui-validatebox" validType="numeric"></td>
						<td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
						   plain='true'	onclick='save_item()'></a>
						</td>
						<input type='hidden' id='kodecrdb_no' name='kodecrdb_no'>
						<input type='hidden' id='line_number' name='line_number'>
					</form>				
				</tr>
			</table>		
		</div>
		<table id="dgItemMemo" class="easyui-datagrid"  	width='100%'	
			data-options="
				iconCls: 'icon-edit', fitColumns: true, 
				singleSelect: true,
				toolbar: '#tb',
				url: '<?=base_url()?>index.php/crdb/items/<?=$kodecrdb?>/json'
			">
			<thead>
				<tr>
					<th data-options="field:'account',width:80">Kode Akun</th>
					<th data-options="field:'description',width:250">Nama Perkiraan</th>
					<th data-options="field:'amount',width:160,align:'right'">Jumlah</th>
					<th data-options="field:'line_number',width:30,align:'right'">Line</th>
				</tr>
			</thead>
		</table>
	</div>

 
<!-- JURNAL -->
	<DIV title="Jurnal" style="padding:10px">
		<div id='divJurnal' class='thumbnail'>
		<table id="dgCrdb" class="easyui-datagrid"  width='100%'
			data-options="
				iconCls: 'icon-edit', fitColumns: true , 
				singleSelect: true, toolbar:'#tbCrdb',
				url: '<?=base_url()?>index.php/jurnal/items/<?=$kodecrdb?>'
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
		</div>
			
	</DIV>
	
	
</DIV>
<div id="tb" class='box-gradient'>
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteItem()">Delete</a>	
</div>

<?php 
	echo load_view('gl/select_coa');
?>
<?php 
include_once 'faktur_select_crdb.php'; 
echo $lookup_customer;

?>


<script type="text/javascript">
	var url;	
	var mode="<?=$mode?>";
    function save_db_memo(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#tanggal').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#kodecrdb').val()==''){alert('Isi nomor bukti !');return false;}
        if($('#docnumber').val()==''){alert('Isi nomor faktur !');return false;}
		url='<?=base_url()?>index.php/crdb/save';
		$('#frmCrDb').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
				    window.open(CI_ROOT+"/sales_crmemo/view/"+result.kodecrdb,"_self");
					log_msg('Data sudah tersimpan. ');
				}
			}
		});
    }
		function save_item(){
		    if(mode=="add"){alert("Simpan dulu !");return false;}
			url = '<?=base_url()?>index.php/crdb/save_item';
			$('#kodecrdb_no').val($('#kodecrdb').val());
						 
			$('#frmItem').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dgItemMemo').datagrid('reload');
						$('#frmItem').form('clear');
						$('#account').val('');
						$('#description').val('');
						$('#line_number').val('');
						$('#amount').val('');
						$.messager.show({
							title: 'Success',
							msg: 'Success'
						});
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		
		function deleteItem(){
			var row = $('#dgItemMemo').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if (r){
						url='<?=base_url()?>index.php/crdb/delete_item';
						$.post(url,{line_number:row.line_number},function(result){
							if (result.success){
								$('#dgItemMemo').datagrid('reload');	// reload the user data
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
		function editItem(){
			var row = $('#dgItemMemo').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#frmCrDb').form('load',row);
				$('#account').val(row.account);
				$('#description').val(row.description);
				$('#amount').val(row.amount);
				$('#line_number').val(row.line_number);
				$('#kodecrdb_id').val(row.kodecrdb);
			}
		}
		function delete_memo() {
			var url='<?=base_url()?>index.php/sales_crmemo/delete/'+$("#kodecrdb").val();
			$.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
				if (r){
					$.post(url,null,function(result){
						if (result.success){
							window.open('<?=base_url()?>index.php/sales_crmemo','_self');
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
  	function print(){
            txtNo='<?=$kodecrdb?>'; 
            window.open("<?=base_url().'index.php/crdb/print_bukti/'?>"+txtNo,"new");  		
  	}
    
</script>