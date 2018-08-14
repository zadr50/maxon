<?php
$company_name="";
if(!isset($company_code))$company_code=cid();
if($q=$this->company_model->get_by_id($company_code)){
    if($r=$q->row()){
        $company_name=$r->company_name;
    }
}
?> 
<div class='alert alert-info'>
Dibawah ini adalah seting dan pengaturan link akun yang berfungsi untuk 
mengintegrasikan kode akun standard/default untuk semua transaksi yang 
ada dalam software ini. Silahkan isi atau pilih dengan akun yang bersesuaian.
<br>Company: <?="<strong>$company_code - $company_name</strong>"?>
</div>
 
<ul class="nav nav-tabs">
    <li class="active"><a href="#pur-tab" data-toggle="tab">Pembelian <i class="fa"></i></a></li>
    <li><a href="#sal-tab" data-toggle="tab">Penjualan <i class="fa"></i></a></li>
    <li><a href="#inv-tab" data-toggle="tab">Inventory <i class="fa"></i></a></li>
    <li><a href="#fin-tab" data-toggle="tab">Finansial <i class="fa"></i></a></li>
</ul>
<?php
function show_fields($fields){
	for($i=0;$i<count($fields);$i++) {
	$fld=$fields[$i];
        
	my_input(array("caption"=>$fld['caption'],
		"field_name"=>$fld['field'],"value"=>$fld['value'],
		"show_button"=>link_button('','lookup_coa(\''.$fld['field'].'\')','search')
		));
	}
    
}
?>
<form  id="frmLink" method='post'  
    action="<?php
    
    if($company_code!=cid()){
        $next_url="?next_url=company/view/$company_code";        
    } else {
        $next_url="";
    }
    
    echo base_url("index.php/company/gl_link$next_url")?>"
    class="form-horizontal" style="margin-top:20px">
    <?=form_hidden("company_code",$company_code,"id='company_code'")?>
	<div class="tab-content">
        <div class="tab-pane active" id="pur-tab">
			<?php 
			$fields=array(
			array("caption"=>"Hutang (Account Payable)",
				"field"=>"accounts_payable","value"=>$accounts_payable),
			array("caption"=>"Ongkos Angkut (Freight)",
				"field"=>"po_freight","value"=>$po_freight),
			array("caption"=>"Biaya Lainnya (Other Expense)",
				"field"=>"po_other","value"=>$po_other),
			array("caption"=>"Pajak Pembelian (Purchase Tax)",
				"field"=>"po_tax","value"=>$po_tax),
			array("caption"=>"Potongan Pembelian",
				"field"=>"po_discounts_taken","value"=>$po_discounts_taken),
			array("caption"=>"Kredit/Debit Memo",
				"field"=>"supplier_credit_account_number","value"=>$supplier_credit_account_number),
			array("caption"=>"Uang Muka Pembelian",
				"field"=>"txtUangMukaBeli","value"=>$txtUangMukaBeli)
			
			);
			show_fields($fields);
			?>

		</div>
        <div class="tab-pane " id="sal-tab">
		<?php
			$fields=array(
			array("caption"=>"Piutang (Account Receivable)",
				"field"=>"accounts_receivable","value"=>$accounts_receivable),
			array("caption"=>"Ongkos Angkut Penjualan",
				"field"=>"so_freight","value"=>$so_freight),
			array("caption"=>"Biaya Lainnya",
				"field"=>"so_other","value"=>$so_other),
			array("caption"=>"Pajak Penjualan",
				"field"=>"so_tax","value"=>$so_tax),
			array("caption"=>"Potongan Penjualan",
				"field"=>"so_discounts_given","value"=>$so_discounts_given),
			array("caption"=>"Debit/Kredit Memo Piutang",
				"field"=>"customer_credit_account_number","value"=>$customer_credit_account_number),
			array("caption"=>"Uang Muka Penjualan",
				"field"=>"txtUangMukaJual","value"=>$txtUangMukaJual),
			array("caption"=>"Charge Kartu Kredit",
				"field"=>"txtChargeCC","value"=>$txtChargeCC),
			array("caption"=>"Biaya Promosi",
				"field"=>"txtPromo","value"=>$txtPromo),
			array("caption"=>"Biaya Bonus / Hadiah",
				"field"=>"txtGift","value"=>$txtGift)			
			);
			show_fields($fields); 			
		?>		
		</div>
        <div class="tab-pane " id="inv-tab">
		<?php
			$fields=array(
			array("caption"=>"Penjualan Barang (Inventory Sales)",
				"field"=>"inventory_sales","value"=>$inventory_sales),
			array("caption"=>"Persediaan (Inventory)",
				"field"=>"inventory","value"=>$inventory),
			array("caption"=>"Harga Pokok Persediaan",
				"field"=>"inventory_cogs","value"=>$inventory_cogs),
			array("caption"=>"Retur Penjualan",
				"field"=>"txtReturJual","value"=>$txtReturJual),
			array("caption"=>"Pengeluaran Barang Lainnya",
				"field"=>"txtCoaItemOut","value"=>$txtCoaItemOut),
			array("caption"=>"Penerimaan Barang Lainnya",
				"field"=>"txtCoaItemIn","value"=>$txtCoaItemIn),
			array("caption"=>"Penyesuaian Stock (Stock Adjust)",
				"field"=>"txtCoaItemAdj","value"=>$txtCoaItemAdj)
			
			);
			show_fields($fields);
		?>
		</div>
        <div class="tab-pane " id="fin-tab">
		<?php
			$fields=array(
			array("caption"=>"PPerkiraan Transaksi Kas",
				"field"=>"default_cash_payment_account","value"=>$default_cash_payment_account),
			array("caption"=>"Perkiraan Transaksi Bank",
				"field"=>"default_bank_account_number","value"=>$default_bank_account_number),
			array("caption"=>"Nomor Kartu Kredit",
				"field"=>"default_credit_card_account","value"=>$default_credit_card_account),
			array("caption"=>"Laba/Rugi Periode Berjalan",
				"field"=>"earning_account","value"=>$earning_account),
			array("caption"=>"Laba/Rugi Ditahan",
				"field"=>"year_earning_account","value"=>$year_earning_account),
			array("caption"=>"Historical Balance",
				"field"=>"historical_balance_account","value"=>$historical_balance_account)
			
			);
			show_fields($fields);
		?>
		</div>
	</div>	
    <?=link_button('Copy GL Link From Other', 'dlgpreferences_show()','search'); ?>
    <?=link_button('Save', 'save_gl_link()','save'); ?>
</form>
 
   
<?=load_view('gl/select_coa_link')?>   	
<?=$lookup_company?>
   
<script language="JavaScript">
    var mode='<?=$mode?>';
    var company_code="<?=$company_code?>";
    function save_gl_link(){
        $('#frmLink').submit();
    }
    function copy_from_gl_link(from_company_code){
        loading();
        var url=CI_ROOT+"company/gl_link_copy/"+company_code+"/"+from_company_code;
        $('#frmLink').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                loading_close();
                var result = eval('('+result+')');
                if (result.success){
                    $.messager.show({
                        title: 'Success',
                        msg: 'Success'
                    });
                    window.open(CI_ROOT+"company/view/"+company_code,"_self");
                    
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
            },
            
            error: function(msg){
                $.messager.alert('Info',"Tidak bisa copy data !");
                loading_close();
                }

        });
        
    }
    

</script>