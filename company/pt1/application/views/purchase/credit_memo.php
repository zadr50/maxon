<div>
	<h1>CREDIT MEMO<div class="thumbnail">
	<?php
   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_db_memo()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','true',base_url().'index.php/purchase_crmemo/add');		
	echo link_button('Search','','search','true',base_url().'index.php/purchase_crmemo');		
	echo link_button('Help', 'load_help()','help');		
	
	?>
	
		<a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div onclick="show_syslog('crdb','<?=$kodecrdb?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<script type="text/javascript">
		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/purchase_crmemo");
		}
	</script>


</div></H1>
<div class="thumbnail">		
<form id="frmCrDb"  method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>	
<input type='hidden' name='trans_type' id='trans_type'	value='Purchase'>	
   <table>
		<tr>
		<td>Nomor Bukti</td>
			<td>
				<?php echo form_input('kodecrdb',$kodecrdb,"id=kodecrdb"); ?>
            </td>
        </tr>	 
        <tr>
            <td>Tanggal</td><td><?php echo form_input('tanggal',$tanggal,'id=tanggal 
             class="easyui-datetimebox" required 
			data-options="formatter:format_date,parser:parse_date"
			style="width:150px"');?>
            </td>
        </tr>
       <tr>
            <td>Faktur</td>
            <td><?=form_input('docnumber',$docnumber,'id="docnumber"');?>
            	<?=link_button("",'select_faktur()','search','true')?>
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
			        <input type='hidden' id='transtype' name='transtype' value='PO-CREDIT MEMO'>
       </td></tr>
   </table>
</form>

<div id='divItem' >
<h5>DEBIT MEMO - PILIH KODE PERKIRAAN</H5>
	<div id='dgItem'>
		<table>
			<tr>
				<td>Kode Akun</td><td>Nama Akun</td><td>Jumlah</td><td>
			</tr>
			<tr>
			    <form id="frmItem" method='post' >
			         <td><input id="account" style='width:80px' 
			         	name="account"   class="easyui-validatebox" required="true">
						<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" 
						onclick="lookup_coa()"></a>
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
	<table id="dgItemMemo" class="easyui-datagrid"  		
		style="width:600px;min-height:800px"
		data-options="
			iconCls: 'icon-edit',
			singleSelect: true,
			toolbar: '#tb',
			url: '<?=base_url()?>index.php/crdb/items/<?=$kodecrdb?>/json'
		">
		<thead>
			<tr>
				<th data-options="field:'account',width:80">Kode Akun</th>
				<th data-options="field:'description',width:150">Nama Perkiraan</th>
				<th data-options="field:'amount',width:60,align:'right'">Jumlah</th>
				<th data-options="field:'line_number',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
</div>
</div>
<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteItem()">Delete</a>	
</div>

<?=load_view('gl/select_coa')?>
<? include_once 'faktur_select_crdb.php' ?>


<script type="text/javascript">
	var url;	
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
					$('#divItem').show('slow');
					$('#kodecrdb').val(result.kodecrdb);
					var nomor=$('#kodecrdb').val();
					$('#mode').val('view');
					url='<?=base_url()?>index.php/crdb/items/'+nomor+'/json';
					$('#dgItemMemo').datagrid({url:url});
					$('#dgItemMemo').datagrid('reload');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
			}
		});
    }
		function save_item(){
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
    
</script>
