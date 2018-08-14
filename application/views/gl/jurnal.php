<div class="thumbnail box-gradient">
	<?php
	   $min_date=$this->session->userdata("min_date","");
	
	if(!isset($closed))$closed=false;
	if($closed=="")$closed=false;
	
	echo link_button('Save','save_jurnal();return false;','save');		
	echo link_button('Search','','search','false',base_url().'index.php/jurnal');		
	if($mode=="view") echo link_button('Refresh','','reload','false',base_url().'index.php/jurnal/view/'.$gl_id);		
	if($mode=="view") echo link_button('Delete','','cut','false',base_url().'index.php/jurnal/delete/'.$gl_id);		
	echo link_button('Print', 'print()','print');		
	
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'jurnal\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('jurnal')">Help</div>
		<div onclick="show_syslog('jurnal','<?=$gl_id?>')">Log Aktifitas</div>

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


 
   <table class="table" width="100%">
    <tr><td colspan=4'><strong>JURNAL TRANSAKSI</strong></td></tr>
	<tr>
		<td>Kode Jurnal</td><td>
		<?php echo form_input('gl_id',$gl_id,"id=gl_id"); ?>
                </td>
            <td>Jenis Transaksi</td><td><?php echo form_input('operation',$operation,'id=operation');?></td>
	</tr>	 
       <tr>
            <td>Tanggal</td><td><?php echo form_input('date',$date,'id=date 
             class="easyui-datetimebox" required style="width:150px"
			data-options="formatter:format_date,parser:parse_date"
			');?>
            </td>

            <td>Keterangan</td><td><?php echo form_input('source',$source,'id=source style="width:400px"');?></td>
			
       </tr>
   </table>
   <div id='divItem' >
		<table class="table" width="100%">
			<tr>
				<td>Kode Akun</td><td>Nama Akun</td><td>Debit</td><td>Credit</td><td>
			</tr>
			<tr>
			         <td><input id="account" style='width:80px' 
			         	name="account"   class="easyui-validatebox" required="true">
						<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
						onclick="lookup_coa();return false"></a>
			         </td>
			         <td><input id="description" name="description" style='width:180px'></td>
			        <td><input id="debit" name="debit"  style='width:80px'  class="easyui-validatebox" validType="numeric"></td>
			        <td><input id="credit" name="credit"  style='width:80px'  class="easyui-validatebox" validType="numeric"></td>
			        <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'"  
             		   plain='false' onclick='save_item();return false;'>Add Item</a>
					</td>
			        <input type='hidden' id='transaction_id' name='transaction_id'>
			</tr>
		</table>   	
   </div>
 
	<table id="dgItemJurnal" class="easyui-datagrid" width="100%"  		
		data-options="
			iconCls: 'icon-edit',fitColumns:true,
			singleSelect: true,
			toolbar: '#tb',
			url: '<?=base_url()?>index.php/jurnal/items/<?=$gl_id?>'
		">
		<thead>
			<tr>
				<th data-options="field:'account',width:80">Kode Akun</th>
				<th data-options="field:'account_description',width:150">Nama Perkiraan</th>
				<th data-options="field:'debit',width:60,align:'right'">Debit</th>
				<th data-options="field:'credit',width:60,align:'right'">Credit</th>
				<th data-options="field:'source',width:150">Source</th>
				<th data-options="field:'operation',width:150">Operation</th>
				<th data-options="field:'transaction_id',width:30,align:'right'">Line</th>
			</tr>
		</thead>
	</table>
	<div class=''>
	    <p>Total Debit: <?=form_input("db_tot",number_format($db_tot),"id='db_tot'")?>
	        Total Credit: <?=form_input("cr_tot",number_format($cr_tot),"id='cr_tot'")?>
	        Saldo: <?=form_input("sisa",number_format($sisa),"id='sisa'")?></p>
    </div>
	<div id="tb" style="height:auto">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="false" onclick="editItem()">Edit</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="deleteItem()">Delete</a>	
	</div>
	
</div></div>	
   
<?=load_view('gl/select_coa')?>   	
   
   
<script type="text/javascript">
    
    var closed='<?=$closed?>';
    
    function save_jurnal(){
        
        var sisa=getNum($("#sisa").val());
        if(sisa!=0){alert("Masih ada sisa !");return false;}
        
        var items = [];
 
     rows = $('#dgItemJurnal').datagrid('getRows');  // get all rows of Datagrid
     for(var i=0; i<rows.length; i++){
         var jur = rows[i];                    
         items.push({
             "gl_id"                : $("#gl_id").val(), 
             "date"                 : $('#date').datetimebox('getValue'),
             "source"               : $("#source").val(),  
             "operation"            : $("#operation").val(), 
             "account"              : jur.account,
             "account_description"  : jur.account_description, 
             "debit"                : jur.debit,
             "credit"               : jur.credit,
             "transaction_id"       : jur.transaction_id        
             });      
         }     
        url='<?=base_url()?>index.php/jurnal/save/';
        
        $.ajax({url: url,data:{items:items}, type:'POST',
            error: 
                function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);
                    log_err(xhr.responseText);
                    loading_close();
                },
            success: 
                function(result) {
                    var result = eval('('+result+')');
                    if (result.success)
                    {
                        loading_close();
                        log_msg(result.message);
                        remove_tab_parent();
                         
                    } else {
                        loading_close();
                        log_err(result.message);
                    }
                }
        });     
    }
	   function save_item(){
	       var db=$("#debit").val();
	       if(db=="")db=0;
	       var cr=$("#credit").val();
	       if(cr=="")cr=0;
	       $('#dgItemJurnal').datagrid('appendRow',{
                account: $("#account").val(),
                account_description: $("#description").val(),
                debit: db,
                credit: cr,
                source: $("#source").val(),
                operation: $("#operation").val(),
            });
            calc_total();            
            clear_input();
	   }
	   function calc_total(){
           var db=0,cr=0;
	       var rows = $('#dgItemJurnal').datagrid('getRows');
            for(var i=0; i<rows.length; i++){
              db=db+getNum(rows[i]['debit']);
              cr=cr+getNum(rows[i]['credit']);
            }
            $("#db_tot").val(cf_(db));
            $("#cr_tot").val(cf_(cr));
            $("#sisa").val(cf_(db-cr));

	   }

		function save_item_ex(){
		    
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#date').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
		    
			if(closed){alert("Tidak bisa ubah jurnal ini karena sudah diclose!");return false;}
			
			url = '<?=base_url()?>index.php/jurnal/save_item';
			$('#frmItem').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						gl_id=$('#gl_id').val();
						url='<?=base_url()?>index.php/jurnal/items/'+gl_id;
						$('#dgItemJurnal').datagrid('reload');
						clear_input();
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
		}
		function clear_input(){
            $('#account').val('');
            $('#description').val('');
            $('#debit').val('0');
            $('#credit').val('0');
            $('#transaction_id').val('');
		}
		function deleteItem(){
			if(closed){alert("Tidak bisa ubah jurnal ini karena sudah diclose!");return false;}
			var row = $('#dgItemJurnal').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if (r){
						url='<?=base_url()?>index.php/jurnal/delete_item/'+row.transaction_id;
						$.post(url,function(result){
							if (result.success){
								$('#dgItemJurnal').datagrid('reload');	// reload the user data
								calc_total();
								
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			$('#dgItemJurnal').datagrid('reload');
			}
		}
		function editItem(){
			if(closed){alert("Tidak bisa ubah jurnal ini karena sudah diclose!");return false;}
			var row = $('#dgItemJurnal').datagrid('getSelected');
			if (row){
				$('#frmItem').form('load',row);
				$('#account').val(row.account);
				$('#account_description').val(row.account_description);
				$('#debit').val(row.debit);
				$('#credit').val(row.credit);
				$('#transaction_id').val(row.transaction_id);
			}
		}
    
</script>