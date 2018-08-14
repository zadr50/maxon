<div class="thumbnail box-gradient">
	<?
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
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
	</div>
</div>
<?php 
echo $lookup_bank_accounts;

?>
<div class="col-lg-12" >
        <DIV title="Cards" style="padding:10px">
        <div class='thumbnail'>
            <form method="post">
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
            <td><?=form_input('date_to',date("Y-m-d"),'id=date_to  class="easyui-datetimebox"
                data-options="formatter:format_date,parser:parse_date"  ');?></td>
            <td><?=link_button('Search','search_cards()','search');?></td>
            </tr>
            </table>
            </form>
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
                    <th data-options="field:'voucher',width:80">Nomor</th>
                    <th data-options="field:'check_date',width:80">Tanggal</th>
                    <th data-options="field:'trans_type',width:80">Type</th>
                    <th data-options="field:'deposit_amount',width:100,align:'right'">Masuk</th>
                    <th data-options="field:'payment_amount',width:100,align:'right'">Keluar</th>
                    <th data-options="field:'saldo',width:100,align:'right'">Saldo</th>
                    <th data-options="field:'supplier_number',width:50">Ref1</th>
                    <th data-options="field:'payee',width:50">Ref2</th>
                    <th data-options="field:'memo',width:150">Memo</th>
                </tr>
            </thead>
        </table>
    
    </DIV>
    
</div>

<script type="text/javascript">
    function save_this(){
        if($('#bank_account_number').val()===''){alert('Isi dulu kode bank !');return false;};
        if($('#bank_name').val()===''){alert('Isi dulu nama bank !');return false;};
        $('#myform').submit();
    }
    function search_cards()
    {
        var d1=$("#date_from").datebox('getValue');
        var d2=$("#date_to").datebox('getValue');
        var rek=$("#rekening").val();
        if(rek=='')rek='undefined';
        var xurl='<?=base_url()?>index.php/banks/banks/list_trans/'+rek+'/?d1='+d1+'&d2='+d2;
        $('#dgCard').datagrid({url:xurl});
    }
    
</script>  

 