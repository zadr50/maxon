<div class="thumbnail box-gradient">
	<?php
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'rekon\')','help');		
	?>
		<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
		<div id="mmOptions" style="width:200px;">
			<div onclick="load_help('rekon')">Help</div>
			<div>Update</div>
			<div>MaxOn Forum</div>
			<div>About</div>
		</div>
		<?=link_button('Close', 'remove_tab_parent()','cancel');?>
	
	</div>
</div>
<?php 

echo $this->list_of_values->render_bank_accounts();

?>
<div class="col-lg-12" >
 	<legend>Daftar Giro Masuk yang belum cair</legend>
    <form method="post" id="frmMain">
        <div class='thumbnail'>
            <table width="100%" class="table2">
            <tr>
                <td><?=form_input("rekening","","id='rekening'");
                    echo link_button('','dlgbank_accounts_show()','search');
                    ?>
                    
                </td>
                <td>Date From</td>
            <td><?=form_input('date_from',date("Y-m-d"),'id=date_from class="easyui-datetimebox" 
                data-options="formatter:format_date,parser:parse_date"  ');?></td>
            <td>Date To</td>
            <td><?=form_input('date_to',date("Y-m-d 23:59:59"),'id=date_to  class="easyui-datetimebox"
                data-options="formatter:format_date,parser:parse_date"  ');?></td>
            <td><?=link_button('Search','search_cards()','search');?>
				<?=link_button('Cairkan', 'on_cleared()','save');?>		
            	
            	
            </td>
            </tr>
            </table>
        </div>
        <div class="alert alert-info">
        	Silahkan pilih nomor giro yang akan dicairkan dibawah ini lalu klik tombol [CAIRKAN]
        </div>
    
        <table id="dgCard" class="easyui-datagrid"  
            style="width:auto;height:auto"
            data-options="
                iconCls: 'icon-edit',fitColumns: true,
                singleSelect: true,toolbar: '#tbRetur',
                url: ''
            ">
            <thead>
                <tr>
                    <th data-options="field:'ck',width:30">Cek</th>
                    <th data-options="field:'voucher',width:80">Nomor</th>
                    <th data-options="field:'check_date',width:80">Tanggal</th>
                    <th data-options="<?=col_number("deposit_amount")?>">Jumlah</th>
                    <th data-options="field:'supplier_number',width:50">Ref1</th>
                    <th data-options="field:'payee',width:50">Ref2</th>
                    <th data-options="field:'account_number',width:50">Rekening</th>
                     <th data-options="field:'memo',width:150">Memo</th>
                </tr>
            </thead>
        </table>
    
    </form>
    
</div>

<script type="text/javascript">
	function on_cleared(){
        var xurl='<?=base_url()?>index.php/banks/giro/giro_cair';
        loading();

		$('#frmMain').form('submit',{
			url: xurl,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					loading_close();
					log_msg(result.message);
					remove_tab_parent();
				} else {
					log_err(result.message);
				}
			}
		});
		
	}
    function on_cleared2(){
        var d1=$("#date_from").datebox('getValue');
        var d2=$("#date_to").datebox('getValue');
        var rek=$("#rekening").val();
        if(rek=='')rek='undefined';
        $
        var xurl='<?=base_url()?>index.php/banks/giro/giro_cair/?d1='+d1+'&d2='+d2+"&rek="+rek;
        loading();
        $.ajax({
        	url: xurl,type: 'GET',
			success: function(result)
			{
				console.log(result);
				if(IsJsonString(result))
				{
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
				} else { 
					loading_close();
					log_err(result);
				}
			}


        });
    	
    }
    function search_cards()
    {
        var d1=$("#date_from").datebox('getValue');
        var d2=$("#date_to").datebox('getValue');
        var rek=$("#rekening").val();
        if(rek=='')rek='undefined';
        var xurl='<?=base_url()?>index.php/banks/giro/masuk_not_cleared/?d1='+d1+'&d2='+d2+"&rek="+rek;
        $('#dgCard').datagrid({url:xurl});
    }
    
</script>  

 