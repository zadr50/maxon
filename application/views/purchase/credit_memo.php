<div class="thumbnail box-gradient">
	<?php
   $min_date=$this->session->userdata("min_date","");
	
    echo link_button('Add','','add','false',base_url().'index.php/purchase_crmemo/add');     
	echo link_button('Save', 'save_db_memo()','save');		
	echo link_button('Print', 'print_bukti()','print');		
	echo link_button('Search','','search','false',base_url().'index.php/purchase_crmemo');		
    
    echo link_button('Delete','delete_memo()','cut');       
    if($posted) {
        echo link_button('UnPosting','','cut','false',base_url().'index.php/purchase_crmemo/unposting/'.$kodecrdb);     
    } else {
        echo link_button('Posting','','ok','false',base_url().'index.php/purchase_crmemo/posting/'.$kodecrdb);      
    }
    echo link_button('Refresh','','reload','false',base_url().'index.php/purchase_crmemo/view/'.$kodecrdb);     
    
    
	
	?>
	
		<a href="#" class="easyui-splitbutton" 
		data-options="menu:'#mmOptions',iconCls:'icon-tip', plain:false 
		">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div onclick="show_syslog('crdb','<?=$kodecrdb?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');?>
          
</div>

<div class="thumbnail">		
<form id="frmCrDb"  method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>	
<input type='hidden' name='trans_type' id='trans_type'	value='Purchase'>	
   <table class='table2' width='100%'>
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
            <td>Supplier</td>
            <td><?=form_input('supplier_number',$supplier_number,'id="supplier_number"');?>
                <?=link_button("Find",'dlgsuppliers_show()','search','false')?>
            </td>
            <td rowspan="2">
                <div id='faktur_info' name='faktur_info' class='thumbnail' style='height:50px;width:300px'>
                    Nomor Faktur.<?=$faktur_info?>
                </div>
            </td>
            
       </tr>
        
       <tr>
            <td>Faktur</td>
            <td><?=form_input('docnumber',$docnumber,'id="docnumber"');?>
            	<?=link_button("Find",'dlgpurchase_invoice_show();return false;','search')?>
            </td>
       </tr>
       <tr>
       		<td>Jumlah: </td>
       		<td><?php echo form_input('amount',$amount,'id=amount');?></td>
            <td>Percent%: <?php echo form_input('prc_value',$prc_value,
            "id='prc_value' onblur='calc_prc_value()' ");?></td>
       		
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


<div class="easyui-tabs">
    <div id="divItem" title="Kode Perkiraan" style="padding:10px">  
    <div id='dgItem'>
        <table width="100%" class="table2">
            <tr>
                <td>Kode Akun</td><td>Nama Akun</td><td>Jumlah</td><td>
            </tr>
            <tr>
                <form id="frmItem" method='post' >
                     <td><input id="account" style='width:80px' 
                        name="account"   class="easyui-validatebox" required="true">
                        <a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
                        onclick="lookup_coa();return false;"></a>
                     </td>
                     <td><input id="description" name="description" style='width:280px'></td>
                    <td><input id="amount" name="amount"   class="easyui-validatebox" validType="numeric"></td>
                    <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
                       plain='false' onclick='save_item();return false;'>Save Item</a>
                    </td>
                    <input type='hidden' id='kodecrdb_no' name='kodecrdb_no'>
                    <input type='hidden' id='line_number' name='line_number'>
                </form>             
            </tr>
        </table>        
    </div>
    <table id="dgItemMemo" class="easyui-datagrid"  width="100%"        
        data-options="
            iconCls: 'icon-edit',fitColumns: true, 
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
    
<!-- JURNAL -->
    <DIV title="Jurnal" style="padding:10px">
        <div id='divJurnal' class='thumbnail'>
        <table id="dgCrdb" class="easyui-datagrid"  width="100%"
            data-options="
                iconCls: 'icon-edit', fitColumns: true, 
                singleSelect: true,toolbar:'#tbCrdb',
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
    
</div>

</div>
<div id="tb" style="height:auto">
	<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem()">Edit</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem()">Delete</a>	
</div>

<?=load_view('gl/select_coa')?>
<?php 
echo $lookup_suppliers;
echo $lookup_faktur;
?>


<script type="text/javascript">
	var url;	
    var saldo_faktur=0;
    function calc_prc_value(){
        prc_value=$('#prc_value').val();
        if(prc_value>1){
            prc_value=prc_value/100;
        }   
        
        $('#amount').val(saldo_faktur*prc_value);
        
    }
	
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
			
			if($("#kodecrdb").val()=="AUTO"){
				log_err("Simpan dulu !");return false;
			}
			
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
            var url='<?=base_url()?>index.php/purchase_crmemo/delete/'+$("#kodecrdb").val();
            $.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
                if (r){
                    $.post(url,null,function(result){
                        if (result.success){
                            window.open('<?=base_url()?>index.php/purchase_crmemo','_self');
                        } else {
                            $.messager.show({   // show error message
                                title: 'Error',
                                msg: result.msg
                            });
                        }
                    },'json');
                }
            });
            
        }
  	function print_bukti(){
            txtNo='<?=$kodecrdb?>'; 
            window.open("<?=base_url().'index.php/crdb/print_bukti/'?>"+txtNo,"new");  		
  	}
	function find_faktur(){
		var nomor=$('#docnumber').val();
		if(nomor=="")return false;
		xurl=CI_ROOT+'purchase_invoice/find/'+nomor;
		loading();
		$.ajax({
					type: "GET",
					url: xurl,
					data:'invoice_number='+nomor,
					success: function(msg){
						var obj=jQuery.parseJSON(msg);
						$('#faktur_info').html('Tanggal: '+obj.po_date+', Jumlah: '+obj.amount+', Saldo: '+obj.saldo);
						saldo_faktur=c_(obj.saldo);
						loading_close();
					},
					error: function(msg){alert(msg);}
		});
	};

		function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/purchase_crmemo");
		}

    
</script>
